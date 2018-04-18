<?php 
class Page extends FrontendController{
	
	public function __construct(){
		parent::__construct(); 
	}
	public function contact(){
		
		$this->data['layout'] = 'page/contact';
		$this->data['title'] = 'School';
		$this->data['description'] = 'School';
		
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function about(){
		
		$this->data['layout'] = 'page/about';
		$this->data['title'] = 'School';
		$this->data['description'] = 'School';
		
		$this->load->view($this->data['masterPage'], $this->data);
	}
}