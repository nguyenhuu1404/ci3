<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class New_model extends Grocery_Model {
	public $table = 'news';
	public function getAll(){
		
		$data = $this->db
			->where('status', 1)
			->get($this->table)
			->result_array();
			return $data;
        
	}
	public function recentNews($newId){
		$data = $this->db
			->where('status', 1)
			->where("id != $newId")
			->order_by('id desc')
			->where('type', 'post')
			->get($this->table)
			
			->result_array();
		return $data;
	}
	public function getCategories(){
		$data = $this->db
			->where('status', 1)
			->get('cat_news')
			->result_array();
		return $data;
	}
	public function getNewByCateId($cateId){
		$data = $this->db
			->where('status', 1)
			->where('catnewId', $cateId)
			->order_by('id desc')
			->get($this->table)
			
			->result_array();
		return $data;
	}

	public function getTopNews(){
		$data = $this->db
			->where('status', 1)
			->where('type', 'post')
			->order_by('views desc')
			->limit(3)
			->get($this->table)
			->result_array();
		return $data;
	}
	public function getNewNews(){
		$data = $this->db
			->where('status', 1)
			->where('type', 'post')
			->order_by('id desc')
			->limit(3)
			->get($this->table)
			->result_array();
		return $data;
	}
	
	public function getCategoryBySlug($slug, $type){
		$data = $this->db->select('id, parents, title, description')
			->from('categories')
			->where('slug', $slug)->where('category_type', $type)
			->get()
			->row_array();
		return $data;	
	}
	public function getTagBySlug($slug, $type){
		$data = $this->db->select('id, parents, name, title, description')
			->from('tags')
			->where('slug', $slug)->where('type', $type)
			->get()
			->row_array();
		return $data;
	}
	public function getRelateNews($id, $categoryIds){
		$data = $this->db->from($this->table)->where('category_id', $categoryIds)->where('id !=', $id)->where('type', 'post')->order_by('rand()')->limit(4)->get()->result_array();
		return $data;
	}
	
}