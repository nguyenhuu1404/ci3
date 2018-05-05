<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Product extends Grocery_Model {
	public $table = 'products';
	
	public function getProductByCategoryId($categoryId){
		$data = $this->db->select('*')->from($this->table)->like("CONCAT(',',category_ids,',')", $categoryId)
		->limit(4)->order_by('ordering asc')->get()->result_array();
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
	public function getViewProduct(){
		$data = $this->db->select('*')->from($this->table)->order_by('views desc')
		->limit(4)->get()->result_array();
		return $data;
	}
	public function getRecommendProduct(){
		$data = $this->db->select('*')->from($this->table)->where('recommend', 1)
		->limit(4)->get()->result_array();
		return $data;
	}
	public function getImageById($id){
		$data = $this->db->select('image')->from($this->table)->where('id', $id)->get()->row_array();
		return $data['image'];
	}
	
	public function getTagBySlug($slug, $type){
		$data = $this->db->select('id, title, name, description')
			->from('tags')
			->where('slug', $slug)->where('type', $type)
			->get()
			->row_array();
		return $data;	
	}
	public function getTags($tags){
		$tags = explode(',', $tags);
		$dataTags = $this->db->select('id, slug, name')->from('tags')->where_in('id', $tags)->get()->result_array();
		return $dataTags;
	}
	public function getRelateProduct($id, $categoryIds){
		$data = $this->db->from($this->table)->where('category_ids', $categoryIds)->where('id !=', $id)->order_by('rand()')->limit(4)->get()->result_array();
		return $data;
	}
	public function getGalleries($productId){
		$data = $this->db->from('product_galleries')->where('product_id', $productId)->get()->result_array();
		return $data;
	}
	

}