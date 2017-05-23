<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
		$query = $this->home->getMenu($id);
		$data = array(
			'p'			=> 'dashboard/dashboard',
			'main_menu' => $query
		);
		$this->load->view("home_view",$data);
	}

	public function admission_panel() {
		$loket = "OFF";
		$query = $this->home->getLoket($this->session->userdata('user_id'));
		if ($query->num_rows()>0) {
			$loket = $query->row()->nama_loket;
		}
		if ($this->session->userdata("level_id")!=5) redirect("auth/logout");
		$data = array(
			"loket" => $loket,
			);
		$this->load->view("panel/admission_view",$data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */