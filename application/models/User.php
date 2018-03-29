<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends Grocery_Model{
	
	protected $table = 'users';
	
	public function __construct(){
		parent::__construct();
	}
	public function checkLogin($username, $password){
		$this->db
			->where("username", $username)
			->where("password", $password)
			->where('status', 1);
		
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}		
	}
	public function checkAccessAction($roleId, $module, $controller, $action){
		$data = $this->db
			->where('role_id', $roleId)
			->where('module', $module)
			->where('controller', $controller)
			->where('status', 1)
			->get('user_access')
			->row_array();	
		//echo $this->db->last_query();
		if(!$data){
			return false;
		}else{
			$arr = json_decode($data['action']);
			if(in_array($action, $arr)){
				return $arr;
			}else{
				return false;
			}
		}
	}
	public function checkAccessParam($roleId, $module, $controller, $param){
		$data = $this->db
			->where('role_id', $roleId)
			->where('module', $module)
			->where('controller', $controller)
			->where('status', 1)
			->get('user_access')
			->row_array();
			
		if(!$data){
			return false;
		}else{
			$arr = json_decode($data['param']);
			if(in_array($param, $arr)){
				return $arr;
			}else{
				return false;
			}
		}
	}
	public function getParamRole($roleId, $module, $controller){
		$data = $this->db
			->where('role_id', $roleId)
			->where('module', $module)
			->where('controller', $controller)
			->where('status', 1)
			->get('user_access')
			->row_array();	
			
		return json_decode($data['param']);
	}
	public function getRoleOptions(){
		$data = $this->db
			->select('id, role')
			->from('user_role')
			->get()
			->result_array();
		$options = array();
		
		foreach( $data as $item ){
			$options[$item['id']] = $item['role'];
		}
		return 	$options;
	}
}