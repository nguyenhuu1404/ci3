<?php 
class Home extends FrontendController{
	
	public function __construct(){
		parent::__construct(); 
	}
	public function index(){
		//$this->output->cache(60);
		$this->load->model('product');
		$this->load->model('new_model');

		$this->data['layout'] = 'home/content';
		$this->data['title'] = $this->data['title'];
		$this->data['name'] = 'Sâm ngọc linh - Sâm Hàn Quốc - An cung ngưu hoàng hoàn';
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

		// Get full html:
		
		// Also, for getting full html you may use the following internal method:
		//$body = $this->email->full_html($subject, $message);

		$result = $this->email;
		    $result->from('gowebtut@gmail.com', 'TuThuocNam')
		    ->to('nguyenhuu140490@gmail.com')
		    ->subject('Đặt hàng thành công tại tuthuocnam.com')
		    ->message('vl')
		    ->send();

		var_dump($result);
		echo '<br />';
		echo $this->email->print_debugger();

		exit;
	}
}