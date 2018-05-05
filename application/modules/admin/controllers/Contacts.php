<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends AdminGrocery {
	protected $table = 'contacts';
	protected $subject = 'Liên hệ';
	protected $columns = 'id, fullname, phone, content, status, created';
	protected $edit_fields = 'status, user_id';

	public function index(){
		$this->setGrocery();
		$this->callbackGrocery();
		$crud = $this->crud;
		$this->load->model('contact');
		$users = $this->contact->getOptionByField('fullname', 'users');

		$this->editFields();
		$crud->field_type('user_id', 'dropdown', $users);
		$crud->unset_add();
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
