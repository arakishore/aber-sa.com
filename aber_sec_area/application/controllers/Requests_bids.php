<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Requests_bids extends CI_Controller
{
    public $db;
    public $ctrl_name = 'requests_bids';
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

        $sSql = " SELECT * FROM  lt_requests  ORDER BY request_id DESC ";
        $query = $this->db->query($sSql);
        $data['requests_rs'] = $query->result_array();


        $this->load->view('requests_bids', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function view_request_detail($id = 1)
    {
        $data['msg'] = '';
        $data['id'] = $id;
        $data['l_s_act'] = 1;
        $data['sub_heading'] = 'View Request Details';
        $data['controller'] = $this->ctrl_name;
        $error = '';

        $sSql = " SELECT * FROM  lt_requests WHERE request_id=".$id." ORDER BY request_id DESC ";
        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->row_array();

        $sSql = "SELECT *  FROM `user_master_front` WHERE user_id=" . $requests['user_id'] . " ORDER BY user_id";
        $query = $this->db->query($sSql);
        $data['customer'] = $customer = $query->row_array();

        $sql = "SELECT us.first_name, us.last_name, qt.quote_amount  FROM user_master_front us , lt_request_quotes qt
			WHERE us.user_id=qt.service_provider_id AND
			qt.request_id=" . $id . "
			ORDER BY qt.request_quote_id DESC";
        $rschk = $this->db->query($sql);
        $data['req_quotes'] = $req_quotes = $rschk->result_array();
		
        $sSql = "SELECT *  FROM `lt_requests_items` WHERE request_id=" . $requests['request_id'] . " ORDER BY lt_requests_items_id";
        $query = $this->db->query($sSql);
        $data['items'] = $items = $query->result_array();
	
        $sql = "SELECT us.first_name, us.last_name, qt.*  FROM user_master_front us , lt_request_quotes qt
			WHERE us.user_id=qt.service_provider_id AND
			qt.request_id=" . $requests['request_id'] . "
			ORDER BY qt.request_quote_id DESC";
        $rschk = $this->db->query($sql);
        $data['req_quotes'] = $req_quotes = $rschk->result_array();
				
        $this->load->view('view_request', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');

    }
}
