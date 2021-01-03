<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
 //   public $db;
    public $title = "Dashboard";
    public $controller = "dashboard";
	public $m_act = 0;
 
 

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->helper('url_helper');
        $this->load->model('services');
        $this->db = $this->load->database('default', true);
        $this->common->check_user_session();

    }

    public function index() {

        $data['activaation_id'] = 100;
        $data['sub_activaation_id'] = '100';
        $data['title'] = 'Dashboard';

        $data['maxm'] = $maxm = 50;
        $data['sub_heading'] = 'List';

        $session_user_data = $this->session->userdata('user_data');
        $uid = $session_user_data['user_id'];
        $data['user_id'] = $uid;



		$data['cust_cnt'] = $cust_cnt = $this->common->numRow('user_master_front'," WHERE user_type='Customer'  ORDER BY user_id");
		//$data['driv_cnt'] = $driv_cnt = $this->common->numRow('user_master_front'," WHERE user_type='Driver' ORDER BY user_id");
		$data['ser_provid_cnt'] = $ser_provid_cnt = $this->common->numRow('user_master_front'," WHERE user_type='Service Provider' ORDER BY user_id");

        $data['l_s_act'] = "1";
        $data['page'] = "1";

        $this->load->view('dashboard', $data);

    }

    public function logout()
    {
        $newdata = array(
            'user_id' => '',
            'first_name' => '',
            'last_name' => '',
            'user_type' => '',
            'username' => '',
            'user_email' => '',
            'logged_in' => false,
        );
        $this->session->unset_userdata('user_data');
        $this->session->sess_destroy();
       // print_r($this->session->all_userdata());
        redirect(base_url());

        // echo 'You are logged out';
    }
    public function registertoken() {
        
        $add_in['tokenid'] = $deviceid = (isset($_POST['deviceid'])) ? $this->common->mysql_safe_string($_POST['deviceid']) : '';
        $arr = array('status' => 0, 'errorMessage' => "Some issues");
        if($deviceid!=""){
            $add_in['date_added'] = date("Y-m-d h:i:s");
            $add_in['status'] = 1;
           $sql = "select * from admin_web_tokenid  where tokenid='".$deviceid."'"; 
           $test= $this->db->query($sql);
           if($test->num_rows() <=0 ){
            $this->db->insert('admin_web_tokenid', $add_in);
           }
            $arr = array('status' => 1, 'errorMessage' => $deviceid . " Registered");
        }
        print_r($this->common->jsonencode($arr));
        exit;
    }
}
