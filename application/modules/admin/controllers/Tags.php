<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends AdminGrocery {
	protected $table = 'tags';
	protected $subject = 'Tags';
	protected $columns = 'id, name, status, type, created';

	public function index(){
		$this->setGrocery();
		$this->callbackGrocery();
		$this->crud->required_fields('name');
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
