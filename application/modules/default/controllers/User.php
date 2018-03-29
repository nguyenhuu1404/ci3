<?php
class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		echo "<h1>User Controller - Index Action</h1>";
	}
	public function add(){
		echo "<h1>User Controller - Add Action</h1>";
	}
	public function edit(){
		echo "<h1>User Controller - Edit Action</h1>";
	}
	public function del(){
		echo "<h1>User Controller - Del Action</h1>";
	}
}