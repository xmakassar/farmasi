<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	
	public function saveQueue($data) {
		$this->db->insert('tmp_queue', $data);
        return $this->db->insert_id();
	}

	public function resetQueue() {
		return $this->db->truncate("tmp_queue");
	}

	public function getQueue($loket_login) {
		$this->db->select("*");
		$this->db->from("tmp_queue");
		$this->db->order_by("id",'asc');
		$this->db->limit("1");
		$this->db->where('status','y');
		$this->db->where('lokasi',$loket_login);
		return $this->db->get();
	}

	public function updateQueue($data,$where) {
		$this->db->update("tmp_queue", $data, $where);
        return $this->db->affected_rows();
	}

	public function resetNomorAntrian() {
		return $this->db->truncate("antrian_print_save");
	}

	public function total_antrian() {
		return $this->db->query("select * from v_total_antrian");
	}

	public function saveTotalAntrian($data) {
		return $this->db->insert('antrian_total',$data);
	}

	public function saveNomorAntrian($data) {
		$this->db->insert('antrian_print_save', $data);
        return $this->db->insert_id();
	}

	public function getNomorAntrianLast() {
		$this->db->select("*");
		$this->db->from("antrian_print_save");
		$this->db->order_by("id","desc");
		$this->db->limit(1);
		return $this->db->get()->row();
	}

	public function getTotalPrintByType() {
		$this->db->select("type_pasien as type,count(id) as total_pasien");
		$this->db->from("antrian_print_save");
		$this->db->group_by("type_pasien");
		return $this->db->get();
	}

	public function getQuote() {
		return $this->db->get('quote');
	}

	public function getRunning() {
		$this->db->where("status","1");
		return $this->db->get('running_text');
	}

	public function getVideo() {
		$this->db->where('publish','1');
		return $this->db->get('video')->result_array();
	}

	function cekLoket($userid) {
		$this->db->where('USER_ID',$userid);
		return $this->db->get("loket")->num_rows();
	}

	public function insertLoket($loket="A",$userid) {
		$data = array(
			'nama_loket' 	=> $loket,
			'USER_ID'	 	=> $userid,
			'aktif'			=> "1"
			);
		return $this->db->insert('loket',$data);
	}

	public function updateLoket($loket,$userid) {
		$data = array(
		'nama_loket'	=> $loket,
		'aktif'			=> "1"
		);
		$where = array('USER_ID'=>$userid);
		return $this->db->update('loket', $data, $where);
	}
}

/* End of file panel_model.php */
/* Location: ./application/models/panel_model.php */