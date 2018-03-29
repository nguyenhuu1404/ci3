<?php
class Access{
	protected $CI;
	public function __construct(){
		parent:: __construct();
		$this->CI = & get_instance();
	}
}