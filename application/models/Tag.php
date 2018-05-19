<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Tag extends Grocery_Model {
	public $table = 'tags';

	public function getTags($tags){
		$tags = explode(',', $tags);
		$dataTags = $this->db->select('id, slug, name')->from('tags')->where_in('id', $tags)->where('status', 1)->get()->result_array();
		return $dataTags;
	}
	
}