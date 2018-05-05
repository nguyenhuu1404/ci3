<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends AdminGrocery {
	protected $table = 'users';
	protected $subject = 'Quản lí người dùng';
	protected $columns = 'fullname, username, role_id, phone, email';

	public function index(){
		$this->load->model('user');
		$roles = $this->user->getRoleOptions();
		$crud = $this->crud;
		
		$this->setGrocery();
		$crud->required_fields('email', 'username', 'phone');
		$crud->field_type('password', 'password');
		$crud->field_type('role_id', 'dropdown', $roles);
		
		$crud->callback_before_insert(array($this,'insertPassword'));
		
		$crud->callback_edit_field('password',array($this,'set_password_input_to_empty'));
		$crud->callback_before_update(array($this,'updatePassword'));
		
		$output = $this->crud->render();
		$this->_example_output($output);

	}
	function insertPassword($post_array) {
		//custom insert
		$post_array = $this->customInsert($post_array);
		$key = config_item('encryption_key');
		$post_array['password'] = md5($key.$post_array['password']);
		return $post_array;
	}     
	function updatePassword($post_array, $primary_key) {
		//custom update
		$post_array = $this->customUpdate($post_array, $primary_key);
		if(!empty($post_array['password']))
		{
			$key = config_item('encryption_key');
			$post_array['password'] = md5($key.$post_array['password']);
		}
		else
		{
			unset($post_array['password']);
		}
	 
		return $post_array;
	}
 
	function set_password_input_to_empty() {
		return "<input class='form-control' type='password' name='password' value='' />";
	}	
 
}
