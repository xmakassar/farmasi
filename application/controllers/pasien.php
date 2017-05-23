<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pasien extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "pasien";
    var $pk     =   "id";
    var $title  =   "pasien";

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('pasien_model','pasien');
		$this->load->model('home_model','home');
        $this->load->helper("directory");
        $this->load->helper("download");
	}

	public function index()
	{
		$id = 0;
        $map_pasien = directory_map('./assets/aplikasi/log_pasien');
        $total_pasien = $this->pasien->totalPasien();
		$data = array(
			'judul'		     => $this->title,
			'subjudul'	     => "Tampil Data",
			'p'			     => $this->folder.'/pasien_view',
			'main_menu'      => $this->home->getMenu($id),
            'map_pasien'     => $map_pasien,
            'total_pasien'   => $total_pasien
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->pasien->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->id."'>";
            $row[] = $r->id;
            $row[] = $r->type_pasien;
            $row[] = $r->nomor;
            $row[] = $r->date_in;
            $row[] = $r->nama;
            $row[] = $r->no_mr;
            $row[] = $r->petugas;
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->pasien->count_all(),
                        "iTotalDisplayRecords" => $this->pasien->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
       // $this->_valid_pasienate();
        $data = array(
                'sumber'    => $this->input->post('sumber', TRUE),
                'pesan'     => $this->input->post('pesan', TRUE),
                'foto'      => $this->input->post('foto', TRUE),
                'status'    => $this->input->post('status', TRUE),
            );
        
        $insert = $this->pasien->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        //$this->_valid_pasienate();
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'nama'          => $this->input->post('nama'),
            'no_mr'         => $this->input->post('no_mr'),
            'petugas'       => $this->session->userdata('username'),
            'status'        => "1",
            'date_modified' => date("Y-m-d H:i:s")
        );

        $this->pasien->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id_pasien)
    {
        $this->_validate_delete();
        $this->pasien->delete_by_id_pasien($id_pasien);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete() {
        $list_id_pasien = $this->input->post('id_pasien');
        foreach ($list_id_pasien as $id_pasien) {
            $this->pasien->delete_by_id_pasien($id_pasien);
        }
        echo json_encode(array("status"=> true));
    }

     public function ajax_edit($id_pasien)
    {
        $data = $this->pasien->get_by_id_pasien($id_pasien);
        echo json_encode($data);
    }

    public function ajax_show() {
        $this->load->library('pdfgenerator');
        $data = array(
            "pasien" => $this->pasien->getDataShow()
            );
        $output = $this->load->view('panel/pasien_show',$data);
        $this->pdfgenerator->generate($output,"contoh");
    }

    public function loadParent() {

        $option =  "<option value='0'>pasien Utama</option>";
        $data = $this->pasien->loadParent();
        foreach ($data->result() as $r) {
            $option.="<option value='".$r->id_pasien."'>".$r->name."</option>";
        }
        echo $option;
    }

    public function cetak_pasien() {
       $data = $this->pasien->getDataPasien();
       // echo "<pre>";
       // print_r($data->result());
       // echo "</pre>";
       $text = "";
       $no = 1;
       foreach ($data->result() as $row) {
            $text.= $no."|".$row->nama."|".$row->type_pasien."|".$row->no_mr."|".$row->petugas."\n";
            $no++;
       }
       $this->to_txt($text);
       $this->to_app();
    }

    public function download_txt($todate=""){
        $todate= date('Y-m-d');
        $url = FCPATH .'/assets/aplikasi/log_pasien/log_'.$todate.'.txt';
        $yourFile = $url;
        $file = @fopen($yourFile, "rb");

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=pasien_'.$todate.'.txt');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }
    }

    public function to_txt($text) {
       $todate= date('Y-m-d');
       echo $todate."\n";
        if ( ! write_file(FCPATH .'/assets/aplikasi/log_pasien/log_'.$todate.'.txt', $text)){
           echo "Unable to write the file\n";
        }
    }
    public function to_app($todate="") {
       $todate= date('Y-m-d');
       $url = FCPATH .'/assets/aplikasi/log_pasien/log_'.$todate.'.txt';
       $data_table = "<table class='table' style='border-collapse: collapse;border: 1px solid black;'>";
       if (file_exists($url)) {
            $string = read_file($url);
            $datas = explode("\n", $string);
            if (count($datas)>0) {
                for ($i=0;$i<count($datas)-1;$i++) {
                    $rows = explode("|",$datas[$i]);
                    $data_table .= "<tr style='border: 1px solid black;'>";
                    foreach($rows as $row ) {
                        $data_table .= "<td style='border: 1px solid black; padding:2px'>".$row."</td>"; 
                    }
                    $data_table .= "</tr>";
                }     
            }
       }
       $data_table .= "</table>";
       print_r($data_table); 
       
    }

    public function download_log_pasien($file) {
        //force_download("/assets/aplikasi/log_pasien/log_2017-04-19.txt");
        $file_text = $file;
        $url = FCPATH .'/assets/aplikasi/log_pasien/'.$file;
        $yourFile = $url;
        $file = @fopen($yourFile, "rb");

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=download_'.$file_text);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }
    }
   

    private function _validate_delete() {
        if($this->session->userdata('level_id')!="1") {
             echo json_encode(array("status" => FALSE));
            exit();
        }
    }

    private function _valid_pasienate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Tid_pasienak Boleh Kosong';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('url') == '')
        {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'Tid_pasienak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Tid_pasienak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file pasien.php */
/* Location: ./application/controllers/pasien.php */