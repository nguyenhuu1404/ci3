<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class CateNew extends Grocery_Model {
	public $table = 'cat_news';
	public function getAll(){
		$data = $this->db
			->select('id, name')
			->where('status', 1)
			->get($this->table)
			->result_array();
		return $data;
	}
}