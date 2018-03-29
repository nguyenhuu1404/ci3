<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Test extends Grocery_Model {
	protected $table = 'tests';
	public function getAll(){
		$data = $this->db
			->select('id, name')
			->where('status', 1)
			->get($this->table)
			->result_array();
		return $data;
	}
}