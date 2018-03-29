<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {
	public function __construct(){
		parent:: __construct();
	}
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