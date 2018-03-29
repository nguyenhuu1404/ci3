<?php
class FrontendController extends MY_Controller{
	protected $data;
	public function __construct(){
		parent:: __construct();
		$this->load->model('category');
		$module = $this->router->fetch_module();
		$controller = $this->router->fetch_class();
		$this->data['module'] = $module;
		$this->data['controller'] = $controller;
		$this->data['masterPage'] = "$module/index";
		$this->load->model('menu');
		$dataMenu = $this->category->getAll();
		$router = $module.'/'.$controller;
		$dataParents = $this->category->getParentsByRouter($router);
		$this->data['parents'] = $dataParents;
		$this->data['categories'] = $dataMenu;
	}
}
?>