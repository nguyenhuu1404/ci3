<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends AdminGrocery {
	protected $table = 'user_role';
	protected $subject = 'Nhóm người dùng';
	protected $columns = 'id, role, status, created';

	public function index(){
		$this->setGrocery();
		$this->callbackGrocery();
		$this->crud->required_fields('role');
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
