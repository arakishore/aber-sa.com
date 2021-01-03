<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
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
        //signup

        $data_json = $_POST;
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRegister') {

            $data_json['user_type'] = (isset($data_json['user_type'])) ? $this->common->mysql_safe_string($data_json['user_type']) : '';

            $data_json['first_name'] = (isset($data_json['first_name'])) ? $this->common->mysql_safe_string($data_json['first_name']) : '';
            $data_json['last_name'] = (isset($data_json['last_name'])) ? $this->common->mysql_safe_string($data_json['last_name']) : '';

            $data_json['mobile'] = (isset($data_json['mobile'])) ? $this->common->mysql_safe_string($data_json['mobile']) : '';

            $data_json['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';

            $data_json['address_1'] = (isset($data_json['address_1'])) ? $this->common->mysql_safe_string($data_json['address_1']) : '';
            $data_json['city_id'] = (isset($data_json['city_id'])) ? $this->common->mysql_safe_string($data_json['city_id']) : '';
            $data_json['state_id'] = (isset($data_json['state_id'])) ? $this->common->mysql_safe_string($data_json['state_id']) : '';
            $data_json['passphrase'] = (isset($data_json['passphrase'])) ? $this->common->mysql_safe_string($data_json['passphrase']) : '';

            $data_json['postcode'] = (isset($data_json['postcode'])) ? $this->common->mysql_safe_string($data_json['postcode']) : '';

            $data_json['device_id'] = (isset($data_json['device_id'])) ? $this->common->mysql_safe_string($data_json['device_id']) : 'webbased';
            $data_json['device_type'] = (isset($data_json['device_type'])) ? $this->common->mysql_safe_string($data_json['device_type']) : 'web';
            $errorData = "";
            if ($data_json['user_type'] == '') {
                $errorData = "Please select user type";
            }
            if ($data_json['first_name'] == '') {
                $errorData = "Please enter first name";
            }

            if ($data_json['last_name'] == '') {
                $errorData = "Please enter last name";
            }
            if ($data_json['address_1'] == '') {
                $errorData = "Please enter address";
            }
            if ($data_json['state_id'] == '') {
                $errorData = "Please enter state";
            }
            if ($data_json['city_id'] == '') {
                $errorData = "Please enter city";
            }
            if ($data_json['postcode'] == '') {
                $errorData = "Please enter Zip";
            }

            if ($data_json['email'] == '') {
                $errorData = "Please enter email address";
            }
            if ($data_json['mobile'] == '') {
                $errorData = "Please enter mobile ";
            }
            if ($data_json['passphrase'] == '') {
                $errorData = "Please enter Password";
            }

            if ($errorData == "") {

                $returnData = $this->services->doRegister($data_json, 'ARRAY');
                //print_r($returnData);
                $returnData_temp['status'] = $returnData['status'];

                $returnData_temp['errorMessage'] = (isset($returnData['errorMessage'])) ? $returnData['errorMessage'] : '';
                if ($returnData['status'] == 1) {
                    $returnData_temp['redirecturl'] = site_url("signup/otpverification?u=" . $returnData['userInfo']['uuid']);
                } else {
                    $returnData_temp['retData'] = $returnData['retData'];
                }

                $returnData = $returnData_temp;

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $errorData);
            }

            print_r($this->common->jsonencode($returnData));
            die();
        }
        $data['controller'] = "signup";
        $data['fun_name'] = "";
        $this->load->view('signup', $data);
    }

    public function otpverification()
    {
        $u = (isset($_GET['u'])) ? $this->common->mysql_safe_string($_GET['u']) : '';
        if ($u == "") {
            redirect("login");
        }
        $returnData = array('status' => 0, 'errorMessage' => "Invalid user id");
        if ($u != "") {
            $params['uuid'] = $u;
            $user_info = $this->services->getProfileUUID($params);

            if (isset($user_info['status']) && $user_info['status'] == 1) {
                $data['email'] = $user_info['userInfo']['email'];
            }
        }
        $data_json = $_POST;
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doOTPverification') {

            $add_in['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';

            $add_in['temp_otp'] = (isset($data_json['temp_otp'])) ? $this->common->mysql_safe_string($data_json['temp_otp']) : '';
            $errorData = "";
            if ($add_in['email'] == '') {
                // $errorData = "Please enter email id";
            }
            if ($add_in['temp_otp'] == '') {
                $errorData = "Please enter  OTP";
            }

            if ($errorData == "") {

                $returnData = $this->services->doOTPverification($data_json, 'ARRAY');

                if ($returnData['status'] == 1) {
                    $this->session->sess_regenerate(true);

                    $this->session->set_userdata(array('user_data' => array()));

                    $ar_session_data['user_data'] = $returnData['userInfo'];
                    $ar_session_data['user_data']['logged_in'] = true;
                    $ar_session_data['user_data']['passphrase'] = "";
                    $this->session->set_userdata($ar_session_data);
                    if ($returnData['userInfo']['user_type'] == "Service Provider") {
                        redirect(site_url("serviceprovider"), 'refresh');
                    }
                    if ($returnData['userInfo']['user_type'] == "Customer") {
                        redirect(site_url("customer"), 'refresh');
                    }
                    exit();

                } else {
                    $this->session->set_flashdata('error', $returnData['errorMessage']);
                }

            } else {
                // $returnData = array('status' => 0, 'errorData' => $errorData);
                $this->session->set_flashdata('error', $errorData);
            }

        }

        $data['u'] = $u;
        $data['controller'] = "signup";
        $data['fun_name'] = "otpverification?u=" . $u;
        $this->load->view('otpverification', $data);
    }

    public function resendOTP()
    {

		$u = (isset($_GET['u'])) ? $this->common->mysql_safe_string($_GET['u']) : '';
        if ($u == "") {
            redirect("login");
        }
        $returnData = array('status' => 0, 'errorMessage' => "Invalid user id");
        if ($u != "") {
            $params['uuid'] = $u;
            $returnData = $this->services->getProfileUUID($params);
		 
            if (isset($returnData['status']) && $returnData['status'] == 1) {
				$params['email'] = $returnData['userInfo']['email'];

				$returnData = $this->services->resendOTP($params);
				 
				if($returnData['status']=="1"){
					$this->session->set_flashdata('success', $returnData['successMessage']);	
					redirect("signup/otpverification?u=".$u);
				} else {
					
					$this->session->set_flashdata('error', $returnData['errorMessage']);	
				 	redirect("signup/otpverification?u=".$u);
				}
            } else {
				$this->session->set_flashdata('error', $returnData['errorMessage']);	
				 	redirect("signup/otpverification?u=".$u);
			}
        }
		 
		
		 
    }
	
	public function forgotpassword()
    {
       
		$data_json = $_POST;
		
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doForgotPassword') {

            $add_in['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';
            $errorData = "";
            if ($add_in['email'] == '') {
                $errorData = "Please enter email ";
            }

            if ($errorData == "") {

				$returnData = $this->services->doForgotPassword($data_json, 'ARRAY');
				if($returnData['status']=="1"){
					$this->session->set_flashdata('success', $returnData['successMessage']);
					redirect("signup/otpverification?u=".$returnData['userInfo']['uuid']);	
				} else {
					$this->session->set_flashdata('error', $returnData['errorMessage']);	
				}

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

           
        }
	 
        $data['controller'] = "signup";
        $data['fun_name'] = "forgotpassword";
        $this->load->view('forgot_password', $data);
    }
}
