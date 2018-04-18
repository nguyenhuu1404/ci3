<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Product extends Grocery_Model {
	protected $table = 'products';
	
	public function getProductByCategoryId($categoryId){
		$data = $this->db->select('*')->from($this->table)->like("CONCAT(',',category_ids,',')", $categoryId)
		->limit(4)->get()->result_array();
		return $data;
	}
	public function getProductByCategoryIds($ids){
		$categories = $this->db->select('id, name')->from('categories')->where_in('id', $ids)->get()->result_array();
		$process = array();
		foreach ($categories as $val) {
			$process[$val['id']] = $val['name'];
		}
		$data = array();
		foreach ($ids as $id) {
			$products = $this->getProductByCategoryId($id);
			$data[$id]['title'] = $process[$id];
			$data[$id]['products'] = $products;
		}
		return $data;
	}
	public function getNewProduct(){
		$data = $this->db->select('*')->from($this->table)
		->limit(4)->order_by('id desc')->get()->result_array();
		return $data;
	}
	public function getHotProduct(){
		$data = $this->db->select('*')->from($this->table)->where('hot', 1)
		->limit(4)->get()->result_array();
		return $data;
	}
	public function getSaleProduct(){
		$data = $this->db->select('*')->from($this->table)->where('sale', 1)
		->limit(4)->get()->result_array();
		return $data;
	}
	public function getRecommendProduct(){
		$data = $this->db->select('*')->from($this->table)->where('recommend', 1)
		->limit(4)->get()->result_array();
		return $data;
	}

}