<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $controller = "signup";
    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
			$this->load->model('common');
			$this->load->model('services');
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
			 
    }
	
	public function index()
	{
		$data_json = $_POST;
		if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doLogin') {
            $username = (isset($data_json['username'])) ? $this->common->mysql_safe_string($data_json['username']) : '';
            $passphrase = (isset($data_json['passphrase'])) ? $this->common->mysql_safe_string($data_json['passphrase']) : '0';
         
			$returnData = $this->services->doLogin($data_json,'ARRAY');
			if ($returnData['status'] == 1) {
				//do some thing here
				
				$this->session->sess_regenerate(true);

				$this->session->set_userdata(array('user_data' => array()));

				$ar_session_data['user_data'] = $returnData['userInfo'];
				$ar_session_data['user_data']['logged_in'] = true;
				$ar_session_data['user_data']['passphrase'] = "";
				$this->session->set_userdata($ar_session_data);
				if($returnData['userInfo']['user_type']=="Service Provider"){
					redirect(site_url("serviceprovider"), 'refresh');
				}
				if($returnData['userInfo']['user_type']=="Customer"){
					redirect(site_url("customer"), 'refresh');
				}
				exit();

			} else if ($returnData['status'] == 2) {
				redirect("signup/otpverification?u=" . $returnData['userInfo']['uuid']);
			} else {
				//do some thing here
				$this->session->set_flashdata('error', $returnData['errorMessage']);
            }
		}

		$data['controller'] ="login";
		$data['fun_name'] ="";

		$this->load->view('login',$data);
	}

	public function doLogin( )
    {
        header('Content-Type: application/json');
        // $data_json = $this->common->jsonencode($_POST);
        // print_r($data_json);
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = $_POST;// file_get_contents('php://input');
        /* if(debug==1){
            file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        } */  
 
 /*        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);
        header('Content-Type: application/json');

        if ($received_signature != $computed_signature) {
            $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
            print_r($this->common->jsonencode($arr));
            die();
        }
 */
        $data_json = json_decode($data_json, true);
        $address_in = [];
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doLogin') {
            $username = (isset($data_json['username'])) ? $this->common->mysql_safe_string($data_json['username']) : '';
            $passphrase = (isset($data_json['passphrase'])) ? $this->common->mysql_safe_string($data_json['passphrase']) : '0';
         
			$returnData = $this->services->doLogin($data_json,'ARRAY');
			if ($returnData['status'] == 1) {
				
				//do some thing here

			} else {
				//do some thing here
              
                 
            }
		}
		
		return $this->common->jsonencode($returnData);
		die();

 
    }
}
