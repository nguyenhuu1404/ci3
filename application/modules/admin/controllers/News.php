<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends AdminGrocery {
	protected $table = 'news';
	protected $subject = 'Tin tức';
	protected $columns = 'id, title, status, created';

	public function index(){
		$this->setGrocery();
		$crud = $this->crud;
		$this->callbackGrocery();
		$this->load->model('new_model');
		$catnewId = $this->new_model->getOptionByField('name', 'cat_news');
		$crud->required_fields('name');
		$crud->set_field_upload('image','assets/uploads/images');
		$crud->field_type('catnewId', 'dropdown', $catnewId);
		
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
