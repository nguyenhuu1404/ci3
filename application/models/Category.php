<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Category extends Grocery_Model {
	public $table = 'categories';
	public function getAll(){
		
		$data = $this->db
			->where('status', 1)
			->order_by('ordering desc')
			->get($this->table)
			->result_array();
			return $data;
        
	}

	public function getMainMenu(){
		$data = $this->db->where('status', 1)->where('is_menu', 1)
			->order_by('ordering desc')->get($this->table)->result_array();
		return $data;
	}

	public function getCategoriesByType($type){
		$data = $this->db->where('status', 1)->where('category_type', $type)
			->order_by('ordering desc')->get($this->table)->result_array();
		return $data;
	}
	
	public function getParentsByRouter($router){
		$data = $this->db->select('parents')->from($this->table)->where('router', $router)->get()->row_array();
		
		$tam = trim($data['parents'], ',');
		$arr = explode(',', $tam);
		return $arr;
	}

	public function getCategoryByAlias($alias){
		$data = $this->db->select('parents, title, description')->from($this->table)->where('alias', $alias)->get()->row_array();
		
		return $data;
	}

	public function getCateByParentId($cateId){
		$data = $this->db
			->select('id, name')
			->where('parent', $cateId)
			->get($this->table)
			->result_array();
			return $data;
	}

	public function getNewcategories() {
		$data = $this->db
			->where('status', 1)
			->where('parent', 0)
			->where('category_type', 'new')
			->order_by('id asc')
			->get($this->table)
			->result_array();
		return $data;
	}
	public function getDataParents($parents){
		$parents = trim($parents);
		$parents = explode(',', $parents);
		$data = $this->db->select('id, alias, slug, name')->from($this->table)->where_in('id', $parents)->get()->result_array();
		return $data;
	}
	public function getCategoryBySlug($slug, $type){
		$data = $this->db->select('id, parents, name, title, description')
			->from($this->table)
			->where('slug', $slug)->where('category_type', $type)
			->get()
			->row_array();
		return $data;	
	}
}