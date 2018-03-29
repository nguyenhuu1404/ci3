<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class RoleAccess extends Grocery_Model {
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