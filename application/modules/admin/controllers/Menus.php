<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends AdminGrocery {
	protected $table = 'menus';
	protected $subject = 'Menus';
	protected $columns = 'id, name, module, router, parent, created';
	protected $hiddenFields = 'module, parents';
	protected $add_fields = 'name, router, title, description, status, alias, ordering, parent, created, createdId, module';
	protected $edit_fields = 'name, router, title, description, status, alias, ordering, parent, parents, modified, modifiedId, modifiedIds';
	public function index(){
	
		$parent = $this->menu->getParentOptions($this->table);
		
		$crud = $this->crud;

		$this->setGrocery();
		$this->editFields();
		$this->addFields();
		$crud->required_fields('name');

		$crud->callback_before_insert(array($this, 'customInsertMenu'));
		$crud->callback_after_insert(array($this, 'customAfterInsert'));
		
		$crud->callback_before_update(array($this, 'customBeforeUpdate'));
		
		$crud->field_type('parent','dropdown', $parent);
		$crud->field_type('description', 'text');
		
		$output = $crud->render();
		$this->_example_output($output);

	}
	function customInsertMenu($post_array){
		
		$post_array['module'] = $this->data['module'];
		$post_array = $this->customInsert($post_array);
		return $post_array;
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
