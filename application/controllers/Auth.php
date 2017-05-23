<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('user_model','user');
	}
	public function index()
	{
		$this->load->view('login');
	}
        
	public function cek_login() {
		$data = array(
			'USERNAME' => $this->input->post('username', TRUE),
			'PASSWORD' => sha1($this->input->post('password', TRUE))
		);
		$loket_login = $this->input->post("loket_login",TRUE);
	
		$hasil = $this->user->cek_user($data);
		if ($hasil->num_rows()==1) {
			$rs = $hasil->row();
			$sess_data = array(
				"user_id"	 => $rs->USER_ID, 
				"username" 	 => $rs->USERNAME, 
				"session_id" => $rs->session_id, 
				"level_name" => $rs->NAME, 
				"level_id" 	 => $rs->LEVEL_ID, 
				"poli"		 => $loket_login
				);
			$this->session->set_userdata($sess_data);
			$data_login = array(
				"loket" 	=> $loket_login,
				"MODIFIED"	=> date("Y-m-d H:i:s")

				);
			$this->user->set_loket($rs->USER_ID,$data_login);
			if ($rs->LEVEL_ID==1) redirect('home');
			else redirect("home/admission_panel");
		} else {
			$this->session->set_flashdata('info','username dan password tidak ditemukan');
			redirect('auth');
		}

	}	

	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level_name');
		session_destroy();
		redirect('auth');
	}
}
