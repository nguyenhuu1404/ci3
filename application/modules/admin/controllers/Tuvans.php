<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tuvans extends AdminGrocery {
	protected $table = 'tuvan';
	protected $subject = 'Tư vấn';
	protected $columns = 'id, product_name, name, phone, status, created';
	protected $edit_fields = 'status, user_id';

	public function index(){
		$this->setGrocery();
		$this->callbackGrocery();
		$crud = $this->crud;
		$this->load->model('tuvan');
		$users = $this->tuvan->getOptionByField('fullname', 'users');

		$this->editFields();
		$crud->field_type('user_id', 'dropdown', $users);
		$crud->unset_add();
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
