<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends Grocery_Model {
	protected $table = 'menus';
	public function getMenuByRole($roleId){
		if($roleId == 1){
            $menus = $this->db
                ->where(array('status',1))
                ->order_by('ordering asc')
				->get($this->table)
				->result_array();
				return $menus;
        }else {
           $menus = $this->db
				->select('m.id, m.name, m.router, m.parent, ua.role_id')
				->from("$this->table m")
				->join('user_access ua', 'm.id = ua.menu_id')
                ->where('ua.role_id', $roleId)
				->where('m.status', 1)
				->get()
				->result_array();
				//echo $this->db->last_query();
				return $menus;
        }
	}
	
	public function getParentsByRouter($router){
		$data = $this->db->select('parents')->from($this->table)->where('router', $router)->get()->row_array();
		
		$tam = trim($data['parents'], ',');
		$arr = explode(',', $tam);
		return $arr;
	}
}