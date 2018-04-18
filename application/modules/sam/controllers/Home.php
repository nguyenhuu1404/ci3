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
		$this->data['description'] = $this->data['description'];
		$this->data['productCategories'] = $this->category->getCategoriesByType('product');

		$this->data['products'] = $this->product->getProductByCategoryIds(array(17, 18, 24));

		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['saleProducts'] = $this->product->getSaleProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();

		$this->data['topNews'] = $this->new_model->getTopNews();
		$this->data['newNews'] = $this->new_model->getNewNews();

		$this->load->view($this->data['masterPage'], $this->data);
	}
}