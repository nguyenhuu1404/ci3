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
		
		//xu li main menu
		$dataMenu = $this->category->getMainMenu();
		$alias = $this->uri->uri_string;
		if($alias != ' '){
			$alias = substr($alias, 0, -5);
		}else{
			$alias = '/';
		}
		
		$dataCategory = $this->category->getCategoryByAlias($alias);

		$tam = trim($dataCategory['parents'], ',');
		$dataParents = explode(',', $tam);
		$this->data['title'] = $dataCategory['title'];
		$this->data['description'] = $dataCategory['description'];
		$this->data['parents'] = $dataParents;
		$this->data['categories'] = $dataMenu;
		//debug query
		//$this->output->enable_profiler(TRUE);    
	}
}
?>