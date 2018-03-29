<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Entity extends MY_Model{
	public function load($id){
		
	}
	public function getOne($id){
		$data = $this->db
					 ->select($this->fields)
					 ->from($this->table)
					 ->where('id', $id)
					 ->get_one();
		return $data;			 
	}
}
?>