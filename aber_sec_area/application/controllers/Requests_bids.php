<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Requests_bids extends CI_Controller
{
    public $db;
    public $ctrl_name = 'customers';
    public $tbl_name = 'user_master_front';
    public $tbl_name_one = 'assets_master';
    public $pg_title = 'Requests';
    public $m_act = 21;

		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->model('common');
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
			$this->db = $this->load->database('default',TRUE);
			$this->common->check_user_session();
		}

    public function index()
    {
        $this->listall(0, '');
    }

    public function listall($start = 0, $otherparam = "")
    {

        $data['l_s_act'] = 1;

        $data['title'] = 'Requests List';
        $data['start'] = $start;
        $data['maxm'] = $maxm = 25;
        $data['sub_heading'] = 'Requests List';
        $fun_name = $this->ctrl_name . '/listall';
        $data['fun_name'] = $fun_name;
        $data['controller'] = $this->ctrl_name;

        $limit_qry = " LIMIT " . $start . "," . $maxm;

        $data['other_para'] = "";

        $data['msg'] = '';
        $error = '';

        $sSql = " SELECT * FROM  lt_requests WHERE status_flag!='Delete' ORDER BY request_id DESC ";
        $query = $this->db->query($sSql);
        $data['requests_rs'] = $query->result_array();


        $this->load->view('requests_bids', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function view_bids($id = 1)
    {
        $data['msg'] = '';
        $data['id'] = $id;
        $data['l_s_act'] = 1;
        $data['sub_heading'] = 'View Customer';
        $data['controller'] = $this->ctrl_name;
        $error = '';



        $sSql = "SELECT csa.*,mp.name as cat_name, md.name as sub_cat_name FROM `lt_requests` csa
		left join product_category mp on csa.category_id = mp.category_id
		left join product_category md on csa.subcategory_id = md.category_id  where user_id='" . $id . "'   ORDER BY csa.request_id DESC";
        $query = $this->db->query($sSql);
        $data['requests'] = $query->result_array();
		//die();



        $this->load->view('view_customer', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');

    }
}
