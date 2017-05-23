<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quote extends CI_Controller {

	// Deklarasi Wajib
	var $folder =   "setting";
    var $tables =   "quote";
    var $pk     =   "id_quote";
    var $title  =   "quote";

	public function __construct()
	{
		parent::__construct();
		$this->secure_model->getSecure();
		$this->load->model('quote_model','quote');
		$this->load->model('home_model','home');
	}

	public function index()
	{
		$id = 0;
        
		$data = array(
			'judul'		=> $this->title,
			'subjudul'	=> "Tampil Data",
			'p'			=> $this->folder.'/quote_view',
			'main_menu' => $this->home->getMenu($id)
		);
		$this->load->view("home_view",$data);
	}

	public function ajax_list()
    {

        $list = $this->quote->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        foreach ($list as $r) {
            // $no++;
            $row = array();
            $row[] = "<input type='checkbox' class='data-check' value='".$r->id_quote."'>";
            $row[] = $r->id_quote;
            $row[] = $r->sumber;
            $row[] = $r->pesan;
            $row[] = $r->foto;
            $row[] = status($r->status);
            //add html for action
            $row[] = '<button class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" onclick="update('."'".$r->id_quote."'".')"><i class="ace-icon fa fa-pencil bigger-120"></i></button>
                  <a class="btn btn-xs btn-danger" data-rel="tooltip" title="Hapus" onclick="hapus('."'".$r->id_quote."'".')"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "sEcho" => $_POST['draw'],
                        "iTotalRecords" => $this->quote->count_all(),
                        "iTotalDisplayRecords" => $this->quote->count_filtered(),
                        "aaData" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
       // $this->_valid_quoteate();
        $data = array(
                'sumber'    => $this->input->post('sumber', TRUE),
                'pesan'     => $this->input->post('pesan', TRUE),
                'foto'      => $this->input->post('foto', TRUE),
                'status'    => $this->input->post('status', TRUE),
            );
        
        $insert = $this->quote->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        //$this->_valid_quoteate();
        $data = array(
            'sumber'    => $this->input->post('sumber'),
            'pesan'     => $this->input->post('pesan'),
            'foto'      => $this->input->post('foto', TRUE),
            'status'    => $this->input->post('status', TRUE)
        );

        $this->quote->update(array($this->pk => $this->input->post("id_pk")), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id_quote)
    {
        $this->quote->delete_by_id_quote($id_quote);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_bulk_delete() {
        $list_id_quote = $this->input->post('id_quote');
        foreach ($list_id_quote as $id_quote) {
            $this->quote->delete_by_id_quote($id_quote);
        }
        echo json_encode(array("status"=> true));
    }

     public function ajax_edit($id_quote)
    {
        $data = $this->quote->get_by_id_quote($id_quote);
        echo json_encode($data);
    }

    public function loadParent() {

        $option =  "<option value='0'>quote Utama</option>";
        $data = $this->quote->loadParent();
        foreach ($data->result() as $r) {
            $option.="<option value='".$r->id_quote."'>".$r->name."</option>";
        }
        echo $option;
    }

    private function _valid_quoteate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Tid_quoteak Boleh Kosong';
            $data['status'] = FALSE;
        }
        
        if($this->input->post('url') == '')
        {
            $data['inputerror'][] = 'url';
            $data['error_string'][] = 'Tid_quoteak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('title') == '')
        {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Tid_quoteak Boleh Kosong';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file quote.php */
/* Location: ./application/controllers/quote.php */