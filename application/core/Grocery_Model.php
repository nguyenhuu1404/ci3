<?php
class Grocery_Model extends MY_Model{
	protected $table;
	protected $selectFields = '*';
	protected $orderBy = 'id desc';
	protected $conditions = false;
	protected $orConditions = false;
	protected $likeConditions = false;
	protected $joins = false;
	public $pageSize = 10;
	public $pageNum = 0;
	public $groupBy = false;
	public $having = false;

	public function getItems(){
		$query = $this->db->select($this->selectFields)->from($this->table);
		if($this->joins){
			foreach($this->joins as $join) {
				$query->join($join['table'], $join['condition'], @$join['type']);
			}
		}	
		if($this->conditions){
			$query->where($this->conditions);
		}
		if($this->likeConditions){
			foreach ($this->likeConditions as $field => $value) {
				$query->like($field, ','.$value.',');
			}
			
		}
		if($this->orConditions){
			$query->or_where($this->orConditions);
		}
		if($this->groupBy){
			$query->group_by($this->groupBy);
		}
		if($this->having){
			$query->having($this->having);
		}
		$data = $query->limit($this->pageSize, $this->pageNum)
			->get()
			->result_array();
		//echo $this->db->last_query();	
		return $data;		
	}
    
    public function getCountItems(){
		$query = $this->db->select($this->selectFields)->from($this->table);
		if($this->joins){
			foreach($this->joins as $join) {
				$query->join($join['table'], $join['condition'], @$join['type']);
			}
		}	
		if($this->conditions){
			$query->where($this->conditions);
		}
		if($this->likeConditions){
			foreach ($this->likeConditions as $field => $value) {
				$query->like($field, ','.$value.',');
			}
			
		}
		if($this->orConditions){
			$query->or_where($this->orConditions);
		}
		if($this->groupBy){
			$query->group_by($this->groupBy);
		}
		if($this->having){
			$query->having($this->having);
		}
		$data = $query->count_all_results();
			
		//echo $this->db->last_query();	
		return $data;		
	}
    
	
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
	public function getOptionByField($field, $table, $condition=false){
		$query = $this->db
			->select('id, '.$field)
			->from($table);
		if($condition){
			$query->where($condition);
		}
		$data =	$query->get()->result_array();
		$options = array();
		if(count($data) > 0){
			foreach( $data as $item ){
				$options[$item['id']] = $item[$field];
			}
		}
		
		return 	$options;
	}
	public function getOptionFieldCondition($field, $table, $condition=false){
		$query = $this->db
			->select('id, parent, '.$field)
			->from($table);
		if($condition){
			$query->where($condition);
		}
		$data =	$query->get()->result_array();
		$options = array();
		//echo $this->db->last_query();
		if(count($data) > 0){
			$data = treefy($data);
			foreach($data as $item){
				$options[$item['id']] = str_repeat('--', $item['level']).$item['name'];
			}
		}
		return $options;
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