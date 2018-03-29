<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends AdminGrocery {
	protected $table = 'user';
	protected $subject = 'Quản lí người dùng';
	protected $columns = 'id, name, username, phone, email';

	public function index(){
		
		$crud = $this->crud;
		
		$this->setGrocery();

		$output = $this->crud->render();
		$this->_example_output($output);

	}
}