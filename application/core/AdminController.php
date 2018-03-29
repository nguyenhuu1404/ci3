<?php
class AdminController extends MY_Controller{
	protected $data; 
	protected $is_grocery_crud = false;
	protected $table;
	public function __construct(){
		parent::__construct();
		$this->setGlobalData();
		$roleId = $this->session->userdata("roleId");
		$this->roleAccess($roleId, $this->data['module'], $this->data['controller'], $this->data['action']);
	}
	public function setGlobalData(){
		$module = $this->router->fetch_module();
		$this->data['module'] = $module;
		$this->data['controller'] = $this->router->fetch_class();
		$this->data['action'] = $this->router->fetch_method();
		
		if($this->is_grocery_crud){
			$this->config->load('grocery_crud');
			$theme = $this->config->item('grocery_crud_default_theme');
			$this->data['masterPage'] = "$module/themes/$theme/index";
		}else{
			$this->data['masterPage'] = "$module/index";
		}
	}
	public function roleAccess($roleId, $module, $controller, $action){
		if(!$roleId){
			redirect(base_url()."admin/verify/login");
		}else if(isset($roleId)){
			$this->getDataMenu($roleId);
			$param = $this->uri->segment(4);
			if(!is_string($param)){
				$param = false;
			}
			$this->acl($roleId, $module, $controller, $action, $param);
		}
	}
	public function getDataMenu($roleId){
		$this->load->model('menu');
		$dataMenu = $this->menu->getMenuByRole($roleId);
		$router = $this->data['module'].'/'.$this->data['controller'];
		$dataParents = $this->menu->getParentsByRouter($router);
		$this->data['parents'] = $dataParents;
		$this->data['menus'] = $dataMenu;
	}
	
	public function acl($roleId, $module, $controller, $action, $param = false){
		if($roleId != 1){
			//phan quyen
			$this->load->model('user');
			$accessAction = $this->user->checkAccessAction($roleId, $module, $controller, $action);
			
			$this->data['accessParam'] = $this->user->getParamRole($roleId, $module, $controller);
			//debug($this->data['accessParam']);
			if(!$accessAction){
				redirect(base_url()."admin/verify/denied");
			}else{
				
				if($param){
					
					$checkAccessParam = $this->user->checkAccessParam($roleId, $module, $controller, $param);

					if(!$checkAccessParam){
						echo $param;die();		
						redirect(base_url()."admin/verify/denied");
					}
				}
				
			}
		}else{
			$this->data['accessParam'] = false;
		}
	}
	public function updateParents($parent, $id){
		$data = $this->db->select('parents')->from($this->table)->where('id', $parent)->get()->row_array();
		if($data['parents']){
			$parents = $data['parents'].$id.',';
		}else{
			$parents = ','.$id.',';
		}
		return $parents;
	}
}