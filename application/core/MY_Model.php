<?php
class MY_Model extends CI_Model{
	public function get($key){
		return isset($this->$key)?$this->$key : null;
	}
	public function set($key, $value){
		$this->$key = $value;
		return $this;
	}
	public function has($key) {
		return isset($this->$key);
	}
	
	public function del($key) {
		unset($this->$key);
		return $this;
	}
	
}	
?>