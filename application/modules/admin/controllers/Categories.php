<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends AdminGrocery {
	protected $table = 'categories';
	protected $subject = 'Danh mục';
	protected $columns = 'id, name, category_type, type, module, parent, created';
	protected $hiddenFields = 'parents';
	protected $add_fields = 'name, title, description, is_menu, category_type, parent, module, ordering, type, router, alias, status, created, createdId';
	protected $edit_fields = 'name, title, description, is_menu, category_type, parent, module, ordering, type, router, alias, parents, status, modified, modifiedId, modifiedIds';
	public function index(){
	
		$parent = $this->menu->getParentOptions($this->table);
		
		$crud = $this->crud;

		$this->setGrocery();
		$this->editFields();
		$this->addFields();
		$crud->required_fields('name');
		
		$crud->callback_before_insert(array($this, 'customInsert'));
		
		$crud->callback_after_insert(array($this, 'customAfterInsert'));
		
		$crud->callback_before_update(array($this, 'customBeforeUpdate'));
		
		$crud->field_type('parent','dropdown', $parent);
		$crud->field_type('is_id','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		$crud->field_type('is_menu','dropdown',
		array('1' => 'Đã kích hoạt', '0' => 'Chưa kích hoạt'));
		
		$output = $crud->render();
		$this->_example_output($output);

	}
	
	public function customAfterInsert($post_array, $primary_key){
		$parents = $this->updateParents($post_array['parent'], $primary_key);
		$this->db->where('id', $primary_key);
		$this->db->update($this->table, array('parents' => $parents));
		return true;
	}
	public function customBeforeUpdate($post_array, $primary_key){
		$post_array = $this->customUpdate($post_array, $primary_key);
		$parents = $this->updateParents($post_array['parent'], $primary_key);
		$post_array['parents'] = $parents;

		return $post_array;
	}
	
}
