<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	private $nomor = 0;

	public function __construct()
	{
		parent::__construct();
		$this->load->model("panel_model","panel");
		$this->load->model("pasien_model","pasien");
		$this->cek_day(); 
	}

	public function cek_day() {
		$tanggal_sekarang = date("d");
		$tanggal_simpan = (int)read_file("./assets/aplikasi/data/date.txt");
		if($tanggal_simpan!=$tanggal_sekarang) {
			//$this->save_total_antrian();
			$this->cetak_pasien();
			$this->resetNomorPrint();
			$this->resetNomorAntrian();
			write_file("./assets/aplikasi/data/date.txt",$tanggal_sekarang,"w");
			write_file("./assets/aplikasi/data/antrian.txt",0,"w");
			write_file("./assets/aplikasi/data/antrian_poli.txt",0,"w");
		}

	}

	public function resetNomorPrint() {
		$this->_resetNomorPrint();
	}

	public function save_total_antrian() {
		$row = $this->panel->total_antrian()->row();
		$date_k = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
		$date_f = date("Y-m-d",$date_k);
		$data = array(
			'tanggal_kunjungan' => $date_f,
			'khusus'			=> $row->total_khusus,
			'poli1'				=> $row->total_poli2,
			'poli2'				=> $row->total_poli2,
			'total'				=> $row->total_semua,
		);
		echo $this->panel->saveTotalAntrian($data);

		
	}

	public function _resetNomorPrint() {
		$query = $this->panel->resetNomorAntrian();
		write_file("./assets/aplikasi/data/print_poli1.php",0,"w");
		write_file("./assets/aplikasi/data/print_poli2.php",0,"w");
		write_file("./assets/aplikasi/data/print_khusus.php",0,"w");
	}

	public function cetak_pasien() {
       $data = $this->pasien->getDataPasien();
       $text = "";
       $no = 1;
       foreach ($data->result() as $row) {
            $text.= $no."|".$row->nama."|".$row->type_pasien."|".$row->no_mr."|".$row->petugas."\n";
            $no++;
       }
       $this->to_txt($text);
    }

    public function to_txt($text) {
       $todate= date('Y-m-d');
       echo $todate."\n";
        if ( ! write_file(FCPATH .'/assets/aplikasi/log_pasien/log_'.$todate.'.txt', $text)){
           echo "Unable to write the file\n";
        }
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
		$farmasi 		= read_file("./assets/aplikasi/data/print_farmasi.php");
		$data = array(
			'farmasi' => $farmasi,
			);
		echo json_encode($data);
	}

	public function setNomorPrint() {
		$url = "";
		$type = $this->input->post("type");
		$type_cetak = "";
		if ($type == "poli1") {
			$url = "./assets/aplikasi/data/print_poli1.php";
		} else if ($type == "poli2") {
			$url = "./assets/aplikasi/data/print_poli2.php";
		} else if ($type=="khusus") {
			$url = "./assets/aplikasi/data/print_khusus.php";
		}
		$nomor = read_file($url);
		$nomor+=1;
		write_file($url,$nomor,"w");
		date_default_timezone_set('Asia/Jakarta');
		$data = array(
			'type_pasien' 	=> $type,
			'nomor'			=> $nomor,
			'date_in'		=> date("Y-m-d H:i:s")
			);
		$this->panel->saveNomorAntrian($data);
		if ($type == "poli1") {
			$type_cetak = "Poli Lantai 1";
		} else if($type=="poli2") {
			$type_cetak = "Poli Lantai 2";
		} else {
			$type_cetak = "Pasien Khusus";
		}
		$hasil_print = $this->printStruk($nomor,$type_cetak);
	}

	#antrian
	public function getNomorAntrian() {
		$url = "./assets/aplikasi/data/antrian_farmasi.txt";
		$nomor = read_file($url);
		echo $nomor;
	}

	public function setNomorAntrian() {
		$status = true;
		$url 		= "./assets/aplikasi/data/antrian_farmasi.txt";
		$url_print 	= "./assets/aplikasi/data/print_farmasi.php";
		$nomor = read_file($url);
		$nomor_print = read_file($url_print);
		$nomor+=1;
		if ($nomor>$nomor_print) {
			$status = false;
		} else {
			write_file($url,$nomor,"w");
		}
		echo json_encode(array("nomor"=>$nomor,'status'=>$status));
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
			'panel'	 => 1,
			'lokasi' => $this->input->post('loket_login', TRUE)
			);
		$this->panel->saveQueue($data);
	}

	public function getQueue() {
		$loket_login = $this->input->post('loket_login', TRUE);
		$query = $this->panel->getQueue($loket_login);
		if ($query->num_rows()>0) {
			$r = $query->row();
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
		
	}

	public function resetNomorAntrian() {
		if ($this->input->post('loket_login')=='poli1') {
			$url = "./assets/aplikasi/data/antrian.txt";
		} else {
			$url = "./assets/aplikasi/data/antrian_poli.txt";
		}
		$query = $this->panel->resetQueue();
		write_file($url,0,"w");
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

	public function printStruk($antrian=0,$jenis="nosetting") {
		$wib = date("Y/m/d H:i:s");
		$var_magin_left = 70;
		$p = printer_open('EPSON TM-T82 Receipt');
		printer_set_option($p, PRINTER_MODE, "RAW"); // mode disobek (gak ngegulung kertas)

		//then the width
		printer_set_option($p,PRINTER_FORMAT_A4, 940);
		printer_start_doc($p);
		printer_start_page($p);

		$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "Antrian Admission RSUD Pariaman",$var_magin_left,0);
		//printer_draw_text($p, "",250,20);
		// Header Bon
		$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
		printer_select_pen($p, $pen);
		//printer_draw_line($p, $var_magin_left, 50, 700, 50);
		printer_draw_text($p, "No Antrian:", $var_magin_left, 50);

		$font = printer_create_font("Arial", 98, 37, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "$antrian", 210, 60);

		$font = printer_create_font("Arial", 28, 23, PRINTER_FW_MEDIUM, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "$jenis", 120, 150);


		$font = printer_create_font("Arial", 15, 8, PRINTER_FW_NORMAL, false, false, false, 0);
		printer_select_font($p, $font);
		printer_draw_text($p, "Waktu Antrian :", $var_magin_left, 190);
		printer_draw_text($p, $wib,$var_magin_left, 210);
		printer_draw_line($p, $var_magin_left, 230, 500, 230);
		printer_draw_text($p, "\"Budayakan Antri Untuk Kenyamanan \n Bersama\"", $var_magin_left, 250);
		printer_draw_text($p, "Terimakasih Atas Kunjungannya", $var_magin_left, 270);

		//printer_draw_text($p, "  ", $var_magin_left, 260);

		//$row +=300;
		//printer_draw_text($p, "- ", 0, $row);
		                           
		printer_delete_font($font);

		printer_end_page($p);
		printer_end_doc($p);
		// printer_start_doc($p);
		// printer_start_page($p);
		printer_close($p);
		printer_abort($p);

	}

}

/* End of file panel */
/* Location: ./application/controllers/panel */