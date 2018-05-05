<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends AdminGrocery {
	protected $table = 'products';
	protected $subject = 'Sản phẩm';
	protected $columns = 'id, name, image, price, created';
	protected $add_fields = 'name, title, slug, ordering, description, brief, price, price_sale, image, content, category_ids, tag_ids, outstock, status, hot, new, recommend, sale, created, createdId';
	protected $edit_fields = 'name, title, slug, ordering, description, brief, price, price_sale, image, content, category_ids, tag_ids, outstock, status, hot, new, recommend, sale, modified, modifiedId, modifiedIds';
	public function __construct(){
		parent::__construct();
		$this->load->model('product');
	}
	public function index(){
	
		$crud = $this->crud;

		$this->setGrocery();
		//auto created
		$this->callbackGrocery();
		$this->editFields();
		$this->addFields();
		$crud->add_action('Thêm Gallery', '', '', 'ui-icon-plus', array($this, 'linkGallery'));
		$crud->required_fields('name');
		
		$crud->set_field_upload('image','assets/sam/images/products');
		$crud->callback_after_upload(array($this,'resizeImage'));
		$crud->callback_before_delete(array($this,'deleteImage'));

		
		$categories = $this->product->getOptionFieldCondition('name', 'categories', array('category_type' => 'product'));
		
		$crud->field_type('category_ids', 'multiselect', $categories);

		$tagIds = $this->product->getOptionByField('name', 'tags', array('type' => 'product'));
		
		$crud->field_type('tag_ids', 'multiselect', $tagIds);

		$crud->field_type('outstock','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		$crud->field_type('hot','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		$crud->field_type('new','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		$crud->field_type('recommend','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		$crud->field_type('sale','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));

		$crud->field_type('description', 'text');
		
		$output = $crud->render();
		$this->_example_output($output);

	}
	public function linkGallery($primary_key , $row){
		return site_url('admin/product_galleries/product/').$row->id;
	}
	public function resizeImage($uploader_response,$field_info, $files_to_upload){
		$this->load->library('image_moo');
 
		//Is only one file uploaded so it ok to use it with $uploader_response[0].
		$imageName = $uploader_response[0]->name;
		$file_uploaded = $field_info->upload_path.'/'.$imageName; 
		 
		$this->image_moo->load($file_uploaded)->save($file_uploaded, true)
		->resize(241,241)->save($field_info->upload_path.'/category/'.$imageName, true)
		->resize(176,176)->save($field_info->upload_path.'/home/'.$imageName, true)
		->resize(75,75)->save($field_info->upload_path.'/thumb/'.$imageName, true);

		return true;
	}
	public function deleteImage($primary_key){
		$product= $this->db->where('id', $primary_key)->get($this->table)->row();
		$url= '/assets/sam/images/products/thumb/'.$product->image;
		$url2= '/assets/sam/images/products/home/'.$product->image;
		$url3= '/assets/sam/images/products/category/'.$product->image;
		unlink($url);
		unlink($url2);
		unlink($url3);
		return true;
	}
}
?>