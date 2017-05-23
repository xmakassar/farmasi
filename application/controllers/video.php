<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class video extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "video";
    var $pk     =   "id";
    var $title  =   "video";

    private $error ;
    private $success;

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('video_model','video');
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
        
		$data = array(
			'judul'		=> $this->title,
			'subjudul'	=> "Tampil Data",
			'p'			=> $this->folder.'/video_view',
			'main_menu' => $this->home->getMenu($id)
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->video->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->id."'>";
            $row[] = $r->id;
            $row[] = $r->judul;
            $row[] = $r->nama_file;
            $row[] = $r->tgl_posting;
            $row[] = status($r->publish);
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->video->count_all(),
                        "iTotalDisplayRecords" => $this->video->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_add()
    {
        if(!empty($_FILES['video_name']['name']))
        {
            // $upload = $this->_do_upload();
            $upload = $this->upload_video();
            //$upload = $_FILES['video_name']['name'];
        } else {
            //$upload = $this->upload_video();
            $upload = "gagal upload file";
        }
        // $this->_valid_videoate();
        $data = array(
                'judul'        => $this->input->post('judul', TRUE),
                'nama_file'    => $upload['file_name'],
                'tgl_posting'  => date("Y-m-d"),
                'publish'      => $this->input->post('enable', TRUE),
            );
        
        $insert = $this->video->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function upload_video() {
        $upload_path = './assets/aplikasi/video';
        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'mp4';
        $config['max_size']             = 128000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = "video_".$_FILES['video_name']['name']; //just milisecond timestamp fot unique name
 

        $video_data = array();

        $is_file_error = false;
        if (!$is_file_error) {
            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('video_name')) {
                return $this->upload->display_errors();
            } else {
                return $this->upload->data();
            }
        }

    }
 
    public function ajax_update()
    {
        //$this->_valid_videoate();
        $data = array(
            'judul'        => $this->input->post('judul', TRUE),
            'tgl_posting'  => date("Y-m-d"),
            'publish'      => $this->input->post('enable', TRUE),
        );

        $this->video->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id_video)
    {
        $rs  = $this->video->get_by_id_video($id_video);
        unlink("./assets/aplikasi/video/".$rs->nama_file);
        $this->video->delete_by_id_video($id_video);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete() {
        $list_id_video = $this->input->post('id_video');
        foreach ($list_id_video as $id_video) {
            $this->video->delete_by_id_video($id_video);
        }
        echo json_encode(array("status"=> true));
    }

     public function ajax_edit($id_video)
    {
        $data = $this->video->get_by_id_video($id_video);
        echo json_encode($data);
    }

    private function _valid_videoate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Tid_videoak Boleh Kosong';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('url') == '')
        {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'Tid_videoak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Tid_videoak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file video.php */
/* Location: ./application/controllers/video.php */