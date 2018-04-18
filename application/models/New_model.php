<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class New_model extends Grocery_Model {
	protected $table = 'news';
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
			->where('view', 1)
			->order_by('id desc')
			->limit(3)
			->get($this->table)
			->result_array();
		return $data;
	}
	public function getNewNews(){
		$data = $this->db
			->where('status', 1)
			->order_by('id desc')
			->limit(3)
			->get($this->table)
			->result_array();
		return $data;
	}
	
	
}