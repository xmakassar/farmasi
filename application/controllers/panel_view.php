<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	private $nomor = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model("panel_model","panel");
	}

	public function index()
	{
		$this->load->view("panel/panel");
	}

	#antrian print
	public function antrian_print()
	{
		$this->load->view("panel/print_view");
	}

	public function lcd_admission()
	{
		$quote 		= $this->panel->getQuote();
		$running 	= $this->panel->getRunning(); 
		$video	 	= $this->panel->getVideo();
		$video_array = array();
		foreach ($video as $vid) {
			$video_array[] = $vid['nama_file'];
		} 
		$data = array(
			"head" 		=> "panel/header_lcd",
			"quote"		=> $quote,
			"running"	=> $running,
			'video'		=> $video_array
			);
		$this->load->view('panel/lcd_admission',$data);
	}

	public function lcd_Poli()
	{
		$quote 		= $this->panel->getQuote();
		$running 	= $this->panel->getRunning(); 
		$video	 	= $this->panel->getVideo();
		$video_array = array();
		foreach ($video as $vid) {
			$video_array[] = $vid['nama_file'];
		} 
		$data = array(
			"head" 		=> "panel/header_lcd",
			"quote"		=> $quote,
			"running"	=> $running,
			'video'		=> $video_array
			);
		$this->load->view('panel/lcd_poli',$data);
	}

	public function getNomorPrint() {
		$nomor = read_file("./assets/aplikasi/data/print.php");
		echo $nomor;
	}

	public function setNomorPrint() {
		$nomor = read_file("./assets/aplikasi/data/print.php");
		$nomor+=1;
		write_file("./assets/aplikasi/data/print.php",$nomor,"w");
		date_default_timezone_set('Asia/Jakarta');
		$data = array(
			'type_pasien' 	=> $this->input->post("type"),
			'nomor'			=> $nomor,
			'date_in'		=> date("Y-m-d H:i:s")
			);
		$this->panel->saveNomorAntrian($data);
	}

	public function resetNomorPrint() {
		$total_antrian = read_file("./assets/aplikasi/data/print.php");
		$query = $this->panel->getTotalPrintByType()->result();
		// echo "<pre>";
		// print_r($query[0]->total_pasien);
		// echo "<pre>";
		// exit();
		$data[$query[0]->type] = $query[0]->total_pasien;
		$data[$query[1]->type] = $query[1]->total_pasien;
		$data['total'] = $total_antrian;
		$query2 = $this->panel->saveTotalAntrian($data);
		$this->_resetNomorPrint();
	}

	public function _resetNomorPrint() {
		$query = $this->panel->resetNomorAntrian();
		write_file("./assets/aplikasi/data/print.php",0,"w");
	}

	#antrian
	public function getNomorAntrian() {
		$nomor = read_file("./assets/aplikasi/data/antrian.txt");
		echo $nomor;
	}

	public function setNomorAntrian() {
		$nomor = read_file("./assets/aplikasi/data/antrian.txt");
		$nomor+=1;
		write_file("./assets/aplikasi/data/antrian.txt",$nomor,"w");
		echo $nomor;
	}

	public function setqueue() {
		$loket =  $this->input->post("loket");
		$nomor_antrian = $this->input->post("nomor_antrian");
		if ($loket=="OFF") echo 0;
			else $loket;
		$data = array(
			"no" 	 => $nomor_antrian,
			'loket'	 => $loket,
			'status' => "y",
			'panel'	 => 1
			);
		$this->panel->saveQueue($data);
	}

	public function getQueue() {
		$r = $this->panel->getQueue()->row();
		$data = array(
			"status" 	=> "ok",
			"loket" 	=> $r->loket,
			"nomor"		=> $r->no  
			);
		echo json_encode($data);
		$data_update = array(
			'status' => "t"
		);
		$query = $this->panel->updateQueue($data_update,array("id"=>$r->id));
	}

	public function resetNomorAntrian() {
		$query = $this->panel->resetQueue();
		write_file("./assets/aplikasi/data/antrian.txt",0,"w");
	}

	public function setNomorLoket() {
		$loket 	= $this->input->post("loket");
		$userid = $this->session->userdata('user_id');
		$cekLoket = $this->panel->cekLoket($userid);
		if ($cekLoket>0) {
			$query = $this->panel->updateLoket($loket,$userid);
		} else {
			$query = $this->panel->insertLoket($loket,$userid);
		}

		if ($query) {
			echo $loket;
		} else {
			echo "OFF";
		}

	}

	function printStruk($antrian=0,$jenis="nosetting") {
		$wib = date("Y/m/d H:i:s");
		$var_magin_left = 10;
		$p = printer_open('EPSON TM-U220 Receipt');
		printer_set_option($p, PRINTER_MODE, "RAW"); // mode disobek (gak ngegulung kertas)

		//then the width
		printer_set_option($p,PRINTER_FORMAT_A4, 940);
		printer_start_doc($p);
		printer_start_page($p);

		$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "Antrian Admission RSUD Pariaman",10,0);
		//printer_draw_text($p, "",250,20);
		// Header Bon
		$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
		printer_select_pen($p, $pen);
		//printer_draw_line($p, $var_magin_left, 50, 700, 50);
		printer_draw_text($p, "No Antrian:", 10, 50);

		$font = printer_create_font("Arial", 98, 37, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "$antrian", 210, 60);

		$font = printer_create_font("Arial", 20, 18, PRINTER_FW_MEDIUM, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "$jenis", 220, 150);


		$font = printer_create_font("Arial", 15, 8, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "Waktu Antrian :", $var_magin_left, 170);
		printer_draw_text($p, $wib,$var_magin_left, 190);
		printer_draw_line($p, $var_magin_left, 210, 700, 210);
		printer_draw_text($p, "\"Budayakan Antri Untuk Kenyamanan \n Bersama\"", $var_magin_left, 230);
		printer_draw_text($p, "Terimakasih Atas Kunjungannya", $var_magin_left, 250);

		//printer_draw_text($p, "  ", $var_magin_left, 260);

		//$row +=300;
		//printer_draw_text($p, "- ", 0, $row);
		                           
		printer_delete_font($font);

		printer_end_page($p);
		printer_end_doc($p);

		printer_start_doc($p);
		printer_start_page($p);
		printer_close($p);
	}

}

/* End of file panel */
/* Location: ./application/controllers/panel */