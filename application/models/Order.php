<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Order extends Grocery_Model {
	public $table = 'orders';

	public function getOrderItems($orderId){
		$data = $this->db->from('order_items')->where('order_id', $orderId)->get()->result_array();
		return $data;
	}

	public function getOrderByUser($userId){
		$data = $this->db->from('orders')->where('user_id', $userId)->order_by('id desc')->get()->result_array();
		return $data;
	}

	public function checkOrderByUser($orderId, $userId){
		$data = $this->db->from('orders')->where('id', $orderId)->where('user_id', $userId)->count_all_results();
		if($data > 0){
			return true;
		}
		return false;
	}
	
}