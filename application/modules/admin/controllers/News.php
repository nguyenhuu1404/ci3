<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends AdminGrocery {
	protected $table = 'news';
	protected $subject = 'Tin tức';
	protected $columns = 'id, title, status, created';

	public function index(){
		$this->setGrocery();
		$crud = $this->crud;
		$this->callbackGrocery();
		$this->load->model('category');
		$categories = $this->category->getOptionFieldCondition('name', 'categories', array('category_type' => 'new'));
		$tags = $this->category->getOptionByField('name', 'tags', array('type' => 'new'));

		$crud->required_fields('name');
		$crud->set_field_upload('image','assets/sam/images/news');
		$crud->callback_after_upload(array($this,'resizeImage'));
		$crud->callback_before_delete(array($this,'deleteImage'));


		$crud->field_type('view','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		$crud->field_type('category_id', 'dropdown', $categories);
		$crud->field_type('tag_ids', 'multiselect', $tags);

		
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}
	public function resizeImage($uploader_response,$field_info, $files_to_upload){
		$this->load->library('image_moo');
 
		//Is only one file uploaded so it ok to use it with $uploader_response[0].
		$imageName = $uploader_response[0]->name;
		$file_uploaded = $field_info->upload_path.'/'.$imageName; 
		 
		$this->image_moo->load($file_uploaded)->save($file_uploaded, true)
		->resize(260,170)->save($field_info->upload_path.'/category/'.$imageName, true)
		->resize_crop(84,84)->save($field_info->upload_path.'/thumb/'.$imageName, true);

		return true;
	}
	public function deleteImage($primary_key){
		$product= $this->db->where('id', $primary_key)->get($this->table)->row();
		$url= '/assets/sam/images/news/thumb/'.$product->image;
		unlink($url);
		
		return true;
	}

}
