<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Secure_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function getSecure() {
		$username = $this->session->userdata('username');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('auth');
		}
	}

	public function cekAkses($izin1='',$izin2='',$izin3='') {
		$userakses = $this->session->userdata('login_hash');
		if (empty($userakses) ) {
			redirect('login');
		} 
		if ($userakses!=$izin1  && $userakses!=$izin2 && $userakses!=$izin3) {
			redirect('login');
		}

	}

	public function saveActivity($activity="",$category="") {
		$data = array(
			'user' 		=> $this->session->userdata('username'),
			'activity' 	=> $activity,
			'category'	=> $category
			);
		$this->db->insert('log_activity',$data);
		return $this->db->insert_id();
	}

}

/* End of file secure_model.php */
/* Location: ./application/models/secure_model.php */