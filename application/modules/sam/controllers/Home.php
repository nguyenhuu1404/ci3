<?php 
class Home extends FrontendController{
	
	public function __construct(){
		parent::__construct(); 
	}
	public function index(){
		$this->load->model('product');
		$this->load->model('new_model');

		$this->data['layout'] = 'home/content';
		$this->data['title'] = $this->data['title'];
		$this->data['name'] = 'Sâm ngọc linh';
		$this->data['seoType'] = 'website';
		$this->data['description'] = $this->data['description'];
		$this->data['productCategories'] = $this->category->getCategoriesByType('product');

		$this->data['products'] = $this->product->getProductByCategoryIds(array(17, 18, 24));

		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['viewProducts'] = $this->product->getViewProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();

		$this->data['topNews'] = $this->new_model->getTopNews();
		$this->data['newNews'] = $this->new_model->getNewNews();

		$this->load->view($this->data['masterPage'], $this->data);
	}
	function testMail(){
		$this->load->library('email');

		$subject = 'This is a test';
		$message = '<p>This message has been sent for testing purposes.</p>';

		// Get full html:
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
		    <title>' . html_escape($subject) . '</title>
		    <style type="text/css">
		        body {
		            font-family: Arial, Verdana, Helvetica, sans-serif;
		            font-size: 16px;
		        }
		    </style>
		</head>
		<body>
		' . $message . '
		</body>
		</html>';
		// Also, for getting full html you may use the following internal method:
		//$body = $this->email->full_html($subject, $message);

		$result = $this->email
		    ->from('gowebtut@gmail.com')
		    ->to('nguyenhuu140490@gmail.com')
		    ->subject($subject)
		    ->message($body)
		    ->send();

		var_dump($result);
		echo '<br />';
		echo $this->email->print_debugger();

		exit;
	}
}