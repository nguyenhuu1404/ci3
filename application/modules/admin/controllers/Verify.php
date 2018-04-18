<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Verify extends MY_Controller{
	public function login(){
		if($this->session->userdata("roleId")){
			redirect(base_url()."admin/home");
		}else{
			$data = array();
			if($this->input->post()){
				$posts = $this->input->post();
				$username = fillter($posts['username']);
				$key = config_item('encryption_key');
				$pass = fillter($posts['password']);
				$password = md5($key.$pass);
				$this->load->model('user');
				$user = $this->user->checkLogin($username, $password);
				
				if($user){
					$dataUser=array(
						"username" => $user['username'],
						"id"	   => $user['id'],
						"roleId"	   => $user['role_id'],
						"email"	   => $user['email']	
					);
					$this->session->set_userdata($dataUser);
					$this->session->set_flashdata("flash_mess","Success");
					redirect(base_url()."admin/home/index");
				}else{
					
					$data['error'] = "Wrong username or password";
				}
				
			}
			$this->load->view('admin/verify/login', $data);	
		}
		
	}
	
	public function logout(){
		$this->session->sess_destroy();
		session_start();
		session_destroy();
		redirect(base_url()."admin/verify/login");
	}
	public function denied(){
		$this->load->view('errors/denied');
	}
}