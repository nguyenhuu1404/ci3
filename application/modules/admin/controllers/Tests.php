<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends AdminGrocery {
	protected $table = 'tests';
	protected $subject = 'Đề thi';
	protected $columns = 'id, name, status, created';

	public function index(){
		$this->setGrocery();
		$this->callbackGrocery();
		$this->crud->required_fields('name');
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
