<?php
class Acl extends AdminGrocery{
	protected $table = 'user_access';
	protected $subject = 'Phân quyền';
	protected $columns = 'id, menu_id, role_id, module, controller, action, param';
	public function index(){
		$crud = $this->crud;
		$this->setGrocery();
		$this->callbackGrocery();
		$this->load->model('roleAccess');
		$roleOptions = $this->roleAccess->getRoleOptions();
		$menuOptions = $this->roleAccess->getParentOptions('menus');
		
		$crud->field_type('menu_id', 'dropdown', $menuOptions);
		$crud->field_type('role_id', 'dropdown', $roleOptions);
		$output = $this->crud->render();
		$this->_example_output($output);
	}
}
?>