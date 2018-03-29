<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
class AdminGrocery extends AdminController{
	protected $is_grocery_crud = true;
	protected $crud;
	protected $table;
	protected $columns;
	protected $hiddenFieldFix = array('created', 'createdId', 'modified', 'modifiedId','modifiedIds');
	protected $hiddenFields;
	protected $add_fields = '';
	protected $edit_fields = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$this->crud = $crud;
		
	}
	public function setGrocery(){
		$this->crud->set_language("vietnamese");
		$this->crud->set_table($this->table);
		$this->crud->set_subject($this->subject);
		//set columns
		$this->setColumns();
		//set status field
		$this->setStatusFields();
		//set hidden fields
		$this->hiddenFields();
		//show function by role
		$this->unsetParam();
	}
	public function callbackGrocery(){
		//set created, createdId, modified, modifiedId
		$this->crud->callback_before_insert(array($this, 'customInsert'));
		$this->crud->callback_before_update(array($this, 'customUpdate'));
	}
	public function _example_output($output = null)
	{
		//add dynamic data to view grocery
		$this->setDataForGrocery($output);
		$this->load->view($this->data['masterPage'],(array)$output);
	}
	public function setStatusFields(){
		$this->crud->field_type('status','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));

	}
	public function setColumns(){
		$columns = $this->columns;
		if(is_string($columns)){
			$columns = strToArr($columns);
			$this->crud->set('columns', $columns);
		}
		
	}
	public function addFields(){
		$addFields = $this->add_fields;
		
		if(is_string($addFields)){
			$addFields = strToArr($addFields);
			$this->crud->set('add_fields', $addFields);
		}
		$this->crud->add_fields($addFields);
		
	}
	public function editFields(){
		$editFields = $this->edit_fields;
		
		if(is_string($editFields)){
			$editFields = strToArr($editFields);
			$this->crud->set('edit_fields', $editFields);
		}
		$this->crud->edit_fields($editFields);
		
		
	}
	public function hiddenFields(){
		$hiddenFieldFix = $this->hiddenFieldFix;
		
		foreach($hiddenFieldFix as $hidden){
			$this->crud->field_type($hidden, 'hidden');
		}
		
		if($this->hiddenFields){
			$hiddenFields = $this->hiddenFields;
			if(is_string($hiddenFields)){
				$hiddenFields = strToArr($hiddenFields);
			}
			foreach($hiddenFields as $hidden){
				$this->crud->field_type($hidden, 'hidden');
			}
		}
		
	}
	
	public function setDataForGrocery($output){
		$output->menus = $this->data['menus'];
		$output->module = $this->data['module'];
		$output->controller = $this->data['controller'];
		$output->parents = $this->data['parents'];
	}
	public function unsetParam(){
		$accessParam = $this->data['accessParam'];
		$roles = array('read', 'edit', 'add', 'delete', 'export', 'print');
		if($accessParam){
			foreach($roles as $role){
				if(!in_array($role, $accessParam)){
					$unset = 'unset_'.$role;
					$this->crud->$unset();
				}
			}
		}
	}
	public function customInsert($post_array){
		
		$post_array['created'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
		$post_array['createdId'] = $this->session->userdata("id");
		
		return $post_array;
	}
	public function customUpdate($post_array, $primary_key){
		$dataInfo = $this->db->select('modifiedIds')->from($this->table)->where('id', $primary_key)->get()->row_array();
		$dataModifiedId = $dataInfo['modifiedIds'];
		$sUserId = $this->session->userdata("id");
		if($dataModifiedId){
			$userId = $sUserId.',';
			$pos = strpos($dataModifiedId, $userId);
			//debug($pos);
			if($pos){
				$tam = trim($dataModifiedId);
				$arr = explode(',', $tam);
				if((count($arr) > 1) && (end($arr) != $sUserId)){
					$ids = str_replace(','.$userId, ',', $dataModifiedId);
					$ids .= $userId;
					$post_array['modifiedIds'] = $ids;
				}
			}else{
				$post_array['modifiedIds'] = $dataModifiedId.$userId;
			}
		}else{
			$post_array['modifiedIds'] = ','.$sUserId.',';
		}
		$post_array['modifiedId'] = $sUserId;
		$post_array['modified'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
 
		return $post_array;
	}
}