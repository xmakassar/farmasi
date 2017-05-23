<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function cek_user($data) {
		$query = $this->getUser($data);
		return $query;
	}

	private function getUser($data) {
		$this->db->select("*");
		$this->db->from('users');
		$this->db->join('level','level.LEVEL_ID=users.LEVEL_ID');
		$this->db->where($data);
		return $this->db->get();
	}

	public function set_loket($userid,$data) {
		$this->db->where("USER_ID",$userid);
		$this->db->update("users",$data);
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */