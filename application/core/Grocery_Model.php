<?php
class Grocery_Model extends MY_Model{
	protected $table;
	protected $selectFields = '*';
	
	public function getParentOptions($table){
		$data = $this->db
					->select('id, name, parent')
					->from($table)
					->get()
					->result_array();
		
		$data = treefy($data);
		foreach($data as $item){
			$options[$item['id']] = str_repeat('--', $item['level']).$item['name'];
		}
		
		return $options;
	}
	public function getOptionByField($field, $table){
		$data = $this->db
			->select('id, '.$field)
			->from($table)
			->get()
			->result_array();
		$options = array();
		
		foreach( $data as $item ){
			$options[$item['id']] = $item[$field];
		}
		return 	$options;
	}
	public function getOne($id){
		$data = $this->db
					 ->select($this->selectFields)
					 ->from($this->table)
					 ->where('id', $id)
					 ->get()
					 ->row_array();
		return $data;			 
	}
	public function getDataByField($field, $table, $id){
		$data = $this->db->select('*')->from($table)->where($field, $id)->get()->result_array();
		return $data;
	}
}	
?>