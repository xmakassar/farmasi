<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getMenu($id) {
		$this->db->select("*");
		$this->db->from("menus");
		$this->db->where('parent_id',$id);
		$this->db->where('enable',1);
		$query = $this->db->get();
		return $query;
	}

	public function getLoket($id) {
		$this->db->select("*");
		$this->db->from('loket');
		$this->db->where("USER_ID",$id);
		$this->db->where('aktif',"1");
		return $this->db->get();
	}

}

/* End of file home_model.php */
/* Location: ./application/models/home_model.php */