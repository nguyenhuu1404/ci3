<?php 
class Home extends FrontendController{
	
	public function __construct(){
		parent::__construct();     
	}
	public function index(){
		$this->data['layout'] = 'home/content';
		$this->data['title'] = 'School';
		$this->data['description'] = 'School';
		$this->data['css'] = array('plugins', 'responsive');
		$this->data['js'] = array(
			array(
				'name' => 'plugins'
			),
			array(
				'name' => 'main'
			)
		);

		$this->load->view($this->data['masterPage'], $this->data);
	}
}