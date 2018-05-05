<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends Grocery_Model{
	
	public $table = 'users';
	
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
	public function checkUserFacebook($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select('id');
            $this->db->from($this->table);
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'],'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $userData['modified'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->table, $userData, array('id'=>$prevResult['id']));
                
                //get user ID
                $userID = $prevResult['id'];
            }else{
                //insert user data
                $userData['created']  = date("Y-m-d H:i:s");
                $insert = $this->db->insert($this->table, $userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }
    public function loginEmail($email, $password){
		$this->db
			->select('id, email, fullname, phone, address_ship')
			->where("email", $email)
			->where("password", $password)
			->where('status', 1);
		
		$query = $this->db->get($this->table);
		echo $this->db->last_query();
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}		
	}
}