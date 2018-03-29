<?php 
class Home extends FrontendController{
	
	public function __construct(){
		parent::__construct();     
	}
	public function index(){
		$this->data['layout'] = 'home/content';
		$this->data['title'] = 'Shop';
		$this->data['description'] = 'Shop';
		$this->data['css'] = array('main', 'blue', 'simple-line-icons', 'owl.carousel', 'owl.transitions', 'animate.min', 'rateit', 'bootstrap-select.min');
		$this->data['js'] = array(
			array(
				'name' => 'bootstrap-hover-dropdown.min'
			),
			array(
				'name' => 'owl.carousel.min'
			),
			array(
				'name' => 'echo.min'
			),
			array(
				'name' => 'jquery.easing-1.3.min'
			),
			array(
				'name' => 'bootstrap-slider.min'
			),
			array(
				'name' => 'jquery.rateit.min'
			),
			array(
				'name' => 'lightbox.min'
			),
			array(
				'name' => 'bootstrap-select.min'
			),
			array(
				'name' => 'wow.min'
			),
			array(
				'name' => 'scripts'
			)
		);
		
		
		$this->load->view($this->data['masterPage'], $this->data);
	}
}