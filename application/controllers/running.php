<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class running extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "running_text";
    var $pk     =   "id";
    var $title  =   "running";

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('running_model','running');
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
        
		$data = array(
			'judul'		=> $this->title,
			'subjudul'	=> "Tampil Data",
			'p'			=> $this->folder.'/running_view',
			'main_menu' => $this->home->getMenu($id)
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->running->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->id."'>";
            $row[] = $r->id;
            $row[] = $r->isi_text;
            $row[] = $r->date_post;
            $row[] = $r->date_end;
            $row[] = status($r->status);
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->running->count_all(),
                        "iTotalDisplayRecords" => $this->running->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
       // $this->_validate();
        $data = array(
                'isi_text' => $this->input->post('isi_text'),
                'status'   => $this->input->post('status'),
                'date_end' => date_database($this->input->post('date_end')),
                'date_post' => date_database($this->input->post('date_post')),
                'date_modified' => date("Y-m-d")
            );
        
        $insert = $this->running->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
            'isi_text' => $this->input->post('isi_text'),
            'status'   => $this->input->post('status'),
            'date_end' => date_database($this->input->post('date_end')),
            'date_post' => date_database($this->input->post('date_post')),
            'date_modified' => date("Y-m-d")
        );

        $this->running->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->running->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete() {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->running->delete_by_id($id);
        }
        echo json_encode(array("status"=> true));
    }

     public function ajax_edit($id)
    {
        $data = $this->running->get_by_id($id);
        echo json_encode($data);
    }

    public function loadParent() {

        $option =  "<option value='0'>running Utama</option>";
        $data = $this->running->loadParent();
        foreach ($data->result() as $r) {
            $option.="<option value='".$r->id."'>".$r->name."</option>";
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

/* End of file running.php */
/* Location: ./application/controllers/running.php */