<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CatNews extends AdminGrocery {
	protected $table = 'cat_news';
	protected $subject = 'Danh mục tin tức';
	protected $columns = 'id, name, status, created';

	public function index(){
		$this->setGrocery();
		$crud = $this->crud;
		$this->callbackGrocery();
		
		$crud->required_fields('name');
		
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
