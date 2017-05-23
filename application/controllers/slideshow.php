<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slideshow extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "slideshow";
    var $pk     =   "id_slideshow";
    var $title  =   "slideshow";

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('slideshow_model','slideshow');
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
        
		$data = array(
			'judul'		=> $this->title,
			'subjudul'	=> "Tampil Data",
			'p'			=> $this->folder.'/slideshow_view',
			'main_menu' => $this->home->getMenu($id)
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->slideshow->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_slideshow."'>";
            $row[] = $r->id_slideshow;
            $row[] = $r->title;
            $row[] = $r->file_title;
            $row[] = $r->date_posting;
            $row[] = $r->date_end;
            $row[] = $r->status;
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_slideshow."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_slideshow."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->slideshow->count_all(),
                        "iTotalDisplayRecords" => $this->slideshow->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
       // $this->_valid_slideshowate();
        $data = array(
                'sumber'    => $this->input->post('sumber', TRUE),
                'pesan'     => $this->input->post('pesan', TRUE),
                'foto'      => $this->input->post('foto', TRUE),
                'status'    => $this->input->post('status', TRUE),
            );
        
        $insert = $this->slideshow->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        //$this->_valid_slideshowate();
        $data = array(
            'sumber'    => $this->input->post('sumber'),
            'pesan'     => $this->input->post('pesan'),
            'foto'      => $this->input->post('foto', TRUE),
            'status'    => $this->input->post('status', TRUE)
        );

        $this->slideshow->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id_slideshow)
    {
        $this->slideshow->delete_by_id_slideshow($id_slideshow);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete() {
        $list_id_slideshow = $this->input->post('id_slideshow');
        foreach ($list_id_slideshow as $id_slideshow) {
            $this->slideshow->delete_by_id_slideshow($id_slideshow);
        }
        echo json_encode(array("status"=> true));
    }

     public function ajax_edit($id_slideshow)
    {
        $data = $this->slideshow->get_by_id_slideshow($id_slideshow);
        echo json_encode($data);
    }

    private function _valid_slideshowate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Tid_slideshowak Boleh Kosong';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('url') == '')
        {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'Tid_slideshowak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Tid_slideshowak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file slideshow.php */
/* Location: ./application/controllers/slideshow.php */