<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "menus";
    var $pk     =   "menus_id";
    var $title  =   "Menu";

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('menu_model','menu');
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
        
		$data = array(
			'judul'		=> $this->title,
			'subjudul'	=> "Tampil Data",
			'p'			=> $this->folder.'/menu_view',
			'main_menu' => $this->home->getMenu($id)
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->menu->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->menus_id."'>";
            $row[] = $r->menus_id;
            $row[] = $r->name;
           	$row[] = $r->url;
            $row[] = $r->title;
            $row[] = $r->parent_id;
           	$row[] = $r->enable;
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->menus_id."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->menus_id."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->menu->count_all(),
                        "iTotalDisplayRecords" => $this->menu->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'url'       => $this->input->post('url'),
                'title' => $this->input->post('title'),
                'date_modified' => date("Y-m-d"),
                'parent_id' => $this->input->post('parent_id', TRUE),
                'enable' => $this->input->post('enable', TRUE)
            );
        
        $insert = $this->menu->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
            'name' => $this->input->post('name'),
            'url'       => $this->input->post('url'),
            'title' => $this->input->post('title'),
            'parent_id' => $this->input->post('parent_id', TRUE),
            'enable' => $this->input->post('enable', TRUE)
        );

        $this->menu->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->menu->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

     public function ajax_edit($id)
    {
        $data = $this->menu->get_by_id($id);
        echo json_encode($data);
    }

    public function loadParent() {

        $option =  "<option value='0'>Menu Utama</option>";
        $data = $this->menu->loadParent();
        foreach ($data->result() as $r) {
            $option.="<option value='".$r->menus_id."'>".$r->name."</option>";
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

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */