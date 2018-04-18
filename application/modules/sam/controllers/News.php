<?php 
class News extends FrontendController{
	
	public function __construct(){
		parent::__construct();  
		$this->load->model('new_model');
	}
	public function index(){
		$this->data['layout'] = 'new/list';
		$this->data['title'] = 'News';
		$this->data['description'] = 'News';
		$this->data['news'] = $this->new_model->getAll();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function detail($newId){
		$this->data['layout'] = 'new/detail';
		$this->data['title'] = 'News detail';
		$this->data['description'] = 'News detail';
		
		//$this->data['catNews'] = $this->new_model->getCategories();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function category($cateId){
		$this->load->model('cateNew');
		//$cateNew = $this->cateNew->getOne($cateId);
		$this->data['layout'] = 'news/list';
		$this->data['title'] = 'Category';
		$this->data['description'] = 'Category';
		//$this->data['news'] = $this->new_model->getNewByCateId($cateId);
		//$this->data['cateNew'] = $cateNew; 
		$this->load->view($this->data['masterPage'], $this->data);
	}
}