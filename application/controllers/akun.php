<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Akun extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "users";
    var $pk     =   "USER_ID";
    var $title  =   "akun";

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('akun_model','akun');
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
        
		$data = array(
			'judul'		=> $this->title,
			'subjudul'	=> "Tampil Data",
			'p'			=> $this->folder.'/akun_view',
			'main_menu' => $this->home->getMenu($id)
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->akun->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->USER_ID."'>";
            $row[] = $r->USER_ID;
            $row[] = $r->USERNAME;
            $row[] = $r->NAMA_LENGKAP;
            $row[] = $r->ALAMAT;
            $row[] = $r->NAME;
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->USER_ID."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->USER_ID."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->akun->count_all(),
                        "iTotalDisplayRecords" => $this->akun->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
       // $this->_validate();
        $data = array(
                'USERNAME'     => $this->input->post('username', TRUE),
                'NAMA_LENGKAP' => $this->input->post('nama_lengkap', TRUE),
                'ALAMAT'       => $this->input->post('alamat', TRUE),
                'BLOKIR'       => $this->input->post('blokir', TRUE),
                'LEVEL_ID'     => $this->input->post('level', TRUE),
                'PASSWORD'     => sha1($this->input->post('password', TRUE)),
            );
        
        $insert = $this->akun->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
            'USERNAME'    => $this->input->post('username', TRUE),
            'NAMA_LENGKAP'     => $this->input->post('nama_lengkap', TRUE),
            'ALAMAT'      => $this->input->post('alamat', TRUE),
            'BLOKIR'    => $this->input->post('blokir', TRUE),
            'LEVEL_ID'    => $this->input->post('level', TRUE),
        );
        if ($this->input->post('password', TRUE)!="noset") {
            $data['PASSWORD'] = sha1($this->input->post('password', TRUE));
        }

        $this->akun->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->akun->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete() {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->akun->delete_by_id($id);
        }
        echo json_encode(array("status"=> true));
    }

     public function ajax_edit($id)
    {
        $data = $this->akun->get_by_id($id);
        echo json_encode($data);
    }

    public function loadParent() {

        $option =  "<option value='0'>akun Utama</option>";
        $data = $this->akun->loadParent();
        foreach ($data->result() as $r) {
            $option.="<option value='".$r->id."'>".$r->name."</option>";
        }
        echo $option;
    }

    public function loadLevel() {

        $option =  "";
        $data = $this->akun->loadLevel();
        foreach ($data->result() as $r) {
            $option.="<option value='".$r->LEVEL_ID."'>".$r->NAME."</option>";
        }
        echo $option;
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('url') == '')
        {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Tidak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file akun.php */
/* Location: ./application/controllers/akun.php */