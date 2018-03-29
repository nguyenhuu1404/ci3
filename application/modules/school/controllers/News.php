<?php 
class News extends FrontendController{
	
	public function __construct(){
		parent::__construct();  
		$this->load->model('new_model');
	}
	public function index(){
		$this->data['layout'] = 'news/lists';
		$this->data['title'] = 'News';
		$this->data['description'] = 'News';
		$this->data['news'] = $this->new_model->getAll();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function detail($newId){
		$this->data['layout'] = 'news/detail';
		$this->data['title'] = 'News detail';
		$this->data['description'] = 'News detail';
		$this->data['new'] = $this->new_model->getOne($newId);
		$this->data['recentNews'] = $this->new_model->recentNews($newId);
		$this->data['catNews'] = $this->new_model->getCategories();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function category($cateId){
		$this->load->model('cateNew');
		$cateNew = $this->cateNew->getOne($cateId);
		$this->data['layout'] = 'news/lists';
		$this->data['title'] = 'Category';
		$this->data['description'] = 'Category';
		$this->data['news'] = $this->new_model->getNewByCateId($cateId);
		$this->data['cateNew'] = $cateNew; 
		$this->load->view($this->data['masterPage'], $this->data);
	}
}