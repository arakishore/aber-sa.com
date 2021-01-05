<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apiuser extends CI_Controller
{
    public $db;
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

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->helper('url_helper');
        $this->load->model('services');
        // $this->db = $this->load->database('default', true);

    }

    public function index()
    {
        $this->load->view('welcome_message');
    }
    public function doRegister()
    {
        // header('Content-Type: application/json');
        // $data_json = $this->common->jsonencode($_POST);
        // print_r($data_json);
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
         */

        /*
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
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
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRegister') {

            $data_json['user_type'] = 'Customer';
            // $add_in['uuid'] = (isset($data_json['uuid'])) ? $this->common->mysql_safe_string($data_json['uuid']) : null;

            $add_in['first_name'] = (isset($data_json['first_name'])) ? $this->common->mysql_safe_string($data_json['first_name']) : '';
            $add_in['last_name'] = (isset($data_json['last_name'])) ? $this->common->mysql_safe_string($data_json['last_name']) : '';
            $add_in['middle_name'] = (isset($data_json['middle_name'])) ? $this->common->mysql_safe_string($data_json['middle_name']) : null;

            $add_in['mobile'] = (isset($data_json['mobile'])) ? $this->common->mysql_safe_string($data_json['mobile']) : '';

            $add_in['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';

            $add_in['passphrase'] = (isset($data_json['passphrase'])) ? $this->common->mysql_safe_string($data_json['passphrase']) : '';
            $add_in['device_id'] = (isset($data_json['device_id'])) ? $this->common->mysql_safe_string($data_json['device_id']) : '';
            $add_in['device_type'] = (isset($data_json['device_type'])) ? $this->common->mysql_safe_string($data_json['device_type']) : '';
            $errorData = [];

            if ($add_in['first_name'] == '') {
                $errorData[] = "Please enter first name";
            }
            if ($add_in['middle_name'] == '') {
                $add_in['middle_name'] = null;
            }
            if ($add_in['last_name'] == '') {
                $errorData[] = "Please enter last name";
            }
            if ($add_in['email'] == '') {
                $errorData[] = "Please enter email addressme";
            }
            if ($add_in['mobile'] == '') {
                $errorData[] = "Please enter mobile";
            }

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->doRegister($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

            print_r($this->common->jsonencode($returnData));
            die();
        }

    }

    public function doOTPverification()
    {

        // $data_json = $this->common->jsonencode($_POST);
        // print_r($data_json);

        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
         */

        /*
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
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
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doOTPverification') {

            // $add_in['uuid'] = (isset($data_json['uuid'])) ? $this->common->mysql_safe_string($data_json['uuid']) : '';
            $add_in['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';
            //$add_in['user_id'] = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '';
            $add_in['temp_otp'] = (isset($data_json['temp_otp'])) ? $this->common->mysql_safe_string($data_json['temp_otp']) : '';
            $errorData = [];
            if ($add_in['email'] == '') {
                $errorData[] = "Please enter email id";
            }
            if ($add_in['temp_otp'] == '') {
                $errorData[] = "Please send  OTP";
            }

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->doOTPverification($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

            print_r($this->common->jsonencode($returnData));
            die();
        }
    }
    public function doLogin()
    {
        //    header('Content-Type: application/json');
        // $data_json = $this->common->jsonencode($_POST);
        // print_r($data_json);
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
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
            $add_in['device_id'] = (isset($data_json['device_id'])) ? $this->common->mysql_safe_string($data_json['device_id']) : '';
            $errorData = [];
            if ($username == '') {
                $errorData[] = "Please enter mobile/email";
            }
            if ($passphrase == '') {
                $errorData[] = "Please enter password";
            }

            if (sizeof($errorData) <= 0) {
                $returnData = $this->services->doLogin($data_json, 'ARRAY');
            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }

    public function doForgotPassword()
    {
        // $data_json = $this->common->jsonencode($_POST);
        // print_r($data_json);
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
         */

        /*
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
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
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doForgotPassword') {

            $add_in['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';
            $errorData = [];
            if ($add_in['email'] == '') {
                $errorData[] = "Please enter email ";
            }

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->doForgotPassword($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

            print_r($this->common->jsonencode($returnData));
            die();
        }

    }

    public function logout()
    {

        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /*  $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);
        header('Content-Type: application/json');

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'logout') {
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '';
            $errorData = [];
            if ($user_id == '') {
                $errorData[] = "Please enter user id ";
            }

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->doLogout($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function resendOTP()
    {
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /*  $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);
        header('Content-Type: application/json');

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'resendOTP') {
            //    $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '';
            $email = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';
            $errorData = [];
            /*  if ($user_id == '') {
            //  $errorData[] = "Please enter user id ";
            } */
            if ($email == '') {
                $errorData[] = "Please enter email ";
            }
            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->resendOTP($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function setUserLanguage()
    {

        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /* $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'setUserLanguage') {

            $user_language = (isset($data_json['user_language'])) ? $this->common->mysql_safe_string($data_json['user_language']) : 'EN';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            $errorData = [];
            if ($user_id == '') {
                $errorData[] = "Please enter user id ";
            }
            if ($user_language == '') {
                $errorData[] = "Please enter language ";
            }
            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->setUserLanguage($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }

    public function doUpdateProfile()
    {

        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doUpdateProfile') {

            $uuid = (isset($data_json['uuid'])) ? $this->common->mysql_safe_string($data_json['uuid']) : '';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';

            $add_in['first_name'] = (isset($data_json['first_name'])) ? $this->common->mysql_safe_string($data_json['first_name']) : '';
            $add_in['middle_name'] = (isset($data_json['middle_name'])) ? $this->common->mysql_safe_string($data_json['middle_name']) : '';
            $add_in['last_name'] = (isset($data_json['last_name'])) ? $this->common->mysql_safe_string($data_json['last_name']) : '';
            $add_in['email'] = (isset($data_json['email'])) ? $this->common->mysql_safe_string($data_json['email']) : '';
            $add_in['mobile'] = (isset($data_json['mobile'])) ? $this->common->mysql_safe_string($data_json['mobile']) : '';
            // $add_in['passphrase'] = (isset($data_json['passphrase'])) ? $this->common->mysql_safe_string($data_json['passphrase']) : '';
            //   $enterprise_name = (isset($data_json['enterprise_name'])) ? $this->common->mysql_safe_string($data_json['enterprise_name']) : '';
            //  $business_type = (isset($data_json['business_type'])) ? $this->common->mysql_safe_string($data_json['business_type']) : 'General';
            $errorData = [];
            if ($add_in['first_name'] == '') {
                $errorData[] = "Please enter first name";
            }
            if ($add_in['middle_name'] == '') {
                $add_in['middle_name'] = null;
            }
            if ($add_in['last_name'] == '') {
                $errorData[] = "Please enter last name";
            }
            if ($add_in['email'] == '') {
                //     $errorData[] = "Please enter email addressme";
            }

            if ($add_in['mobile'] == '') {
                $errorData[] = "Please enter mobile";
            }
            /* if ($add_in['passphrase'] == '') {
            $errorData[] = "Please enter passphrase";
            } */

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->doUpdateProfile($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

            //print(json_encode($array));
        }

        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function changePassword()
    {

        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }

        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'changePassword') {
            $error = "";
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            //  $LANGCODE = (isset($data_json['LANGCODE'])) ? $this->common->mysql_safe_string($data_json['LANGCODE']) : 'EN';
            //  $oldpassword = (isset($data_json['oldpassword'])) ? $this->common->mysql_safe_string($data_json['oldpassword']) : '';
            $newpassword = (isset($data_json['newpassword'])) ? $this->common->mysql_safe_string($data_json['newpassword']) : '';
            //   $language_ext = $this->services->getLanguageExt($LANGCODE);
            $errorData = [];
            if ($newpassword == '') {
                $errorData[] = "Please enter new password";
            }

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->changePassword($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }
        //print(json_encode($array));
        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function getAddresses()
    {

        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }

        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getAddresses') {
            $error = "";
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            //  $LANGCODE = (isset($data_json['LANGCODE'])) ? $this->common->mysql_safe_string($data_json['LANGCODE']) : 'EN';
            $errorData = [];
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }

            if (sizeof($errorData) <= 0) {
                $returnData = $this->services->getAddresses($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }
        //print(json_encode($array));
        print_r($this->common->jsonencode($returnData));
        die();
    }
    public function doAddAddress()
    {

        $data_json = file_get_contents('php://input');
        /*  if (debug == 1) {
        file_put_contents('debug/' . date("ymd") . '.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        }
         */
        $data_json = json_decode($data_json, true);

        $arr = array('status' => 0, 'errorMessage' => "Ohh try again");
        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doAddAddress') {

            //   $LANGCODE = (isset($data_json['LANGCODE'])) ? $this->common->mysql_safe_string($data_json['LANGCODE']) : 'EN';
            //   $language_ext =   $this->services->getLanguageExt($LANGCODE);
            //  $uuid = (isset($data_json['uuid'])) ? $this->common->mysql_safe_string($data_json['uuid']) : '';
            $add_in['user_id'] = $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            $add_in['address_name'] = $address_name = (isset($data_json['address_name'])) ? $this->common->mysql_safe_string($data_json['address_name']) : '';
            $add_in['firstname'] = $firstname = (isset($data_json['firstname'])) ? $this->common->mysql_safe_string($data_json['firstname']) : '';
            $add_in['lastname'] = $lastname = (isset($data_json['lastname'])) ? $this->common->mysql_safe_string($data_json['lastname']) : '';
            $add_in['mobile'] = $mobile = (isset($data_json['mobile'])) ? $this->common->mysql_safe_string($data_json['mobile']) : '';
            $add_in['address_1'] = $address_1 = (isset($data_json['address_1'])) ? $this->common->mysql_safe_string($data_json['address_1']) : '';
            $add_in['state_id'] = $state_id = (isset($data_json['state_id'])) ? $this->common->mysql_safe_string($data_json['state_id']) : '';
            // $add_in['district_id'] = $district_id = (isset($data_json['district_id'])) ? $this->common->mysql_safe_string($data_json['district_id']) : '';
            $add_in['city_id'] = $city_id = (isset($data_json['city_id'])) ? $this->common->mysql_safe_string($data_json['city_id']) : '';
            $add_in['postcode'] = $postcode = (isset($data_json['postcode'])) ? $this->common->mysql_safe_string($data_json['postcode']) : '';
            $add_in['longitude'] = $longitude = (isset($data_json['longitude'])) ? $this->common->mysql_safe_string($data_json['longitude']) : '';
            $add_in['latitude'] = $latitude = (isset($data_json['latitude'])) ? $this->common->mysql_safe_string($data_json['latitude']) : '';

            $add_in['is_default'] = $is_default = (isset($data_json['is_default'])) ? $this->common->mysql_safe_string($data_json['is_default']) : '0';
            $errorData = [];
            if ($firstname == '') {
                $errorData[] = "Please enter first name";
            }
            if ($lastname == '') {
                $errorData[] = "Please enter last name";
            }
            if ($address_1 == '') {
                $errorData[] = "Please enter  address";
            }
            if ($state_id == '') {
                $errorData[] = "Please select  state";
            }
            if ($city_id == '') {
                $errorData[] = "Please select  city_id";
            }
            if ($postcode == '') {
                $errorData[] = "Please enter  postcode";
            }

            if (sizeof($errorData) <= 0) {
                $returnData = $this->services->doAddAddress($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }

        //print(json_encode($array));
        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function getSingleAddress()
    {
        $arr = array('status' => 0, 'errorMessage' => "Warning: No address is found ");
        $data_json = file_get_contents('php://input');
        /*  if (debug == 1) {
        file_put_contents('debug/' . date("ymd") . '.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getSingleAddress') {

            $address_id = (isset($data_json['address_id'])) ? $this->common->mysql_safe_string($data_json['address_id']) : '';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '';
            $errorData = [];

            if ($address_id == '') {
                $errorData[] = "Please enter address id";
            }
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            if (sizeof($errorData) <= 0) {
                $returnData = $this->services->getSingleAddress($data_json, 0, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }
        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function deleteAddress()
    {
        $arr = array('status' => 0, 'errorMessage' => "Warning: No address is found ");

        $data_json = file_get_contents('php://input');
        /*  if (debug == 1) {
        file_put_contents('debug/' . date("ymd") . '.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'deleteAddress') {

            $address_id = (isset($data_json['address_id'])) ? $this->common->mysql_safe_string($data_json['address_id']) : '';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '';
            $errorData = [];
            if ($address_id == '') {
                $errorData[] = "Please enter address id";
            }
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            if (sizeof($errorData) <= 0) {
                $returnData = $this->services->deleteAddress($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }
        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function getFAQ()
    {
        //  header('Content-Type: application/json');
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*  $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getFAQ') {

            $LANGCODE = (isset($data_json['LANGCODE'])) ? $this->common->mysql_safe_string($data_json['LANGCODE']) : 'EN';
            $language_ext = $this->services->getLanguageExt($LANGCODE);

            $faq_data = array();
            $where = "where status='Active'   ";
            $cms_faq_info = $this->common->getRecordsLimit('cms_faq', $where, 0, 0);
            foreach ($cms_faq_info as $key => $faqValue) {
                $faq_array['id'] = $faqValue['id'];

                $faq_array['question'] = $faqValue['question' . $language_ext];
                $faq_array['answer'] = $faqValue['answer' . $language_ext];
                $faq_data[] = $faq_array;
            }
            $returnData['results'] = $faq_data;
            $returnData['status'] = 1;

        }

        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function getPageData()
    {
        //  header('Content-Type: application/json');
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*  $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);
        $returnData = [];
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getPageData') {

            $section = (isset($data_json['section'])) ? $this->common->mysql_safe_string($data_json['section']) : 'privacy';
            $LANGCODE = (isset($data_json['LANGCODE'])) ? $this->common->mysql_safe_string($data_json['LANGCODE']) : 'EN';
            $language_ext = $this->services->getLanguageExt($LANGCODE);

            $where = "section='" . $section . "'   ";
            $pageInfo = $this->common->getRecord('cms_pages', $where);

            $pageDetail['name'] = $pageInfo['heading' . $language_ext];
            $pageDetail['details'] = $pageInfo['details' . $language_ext];

            $returnData['results'] = $pageDetail;
            $returnData['status'] = 1;
            $returnData['errorMessage'] = '';
        }

        print_r($this->common->jsonencode($returnData));
        die();
    }

    // method=form-data
    public function setProfilePic()
    {

        //header('Content-Type: application/json');
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $today = date("Y-m-d h:i:s");

        $error = "";
        //print_r($_FILES);
        //print_r($_POST);
        if (isset($_POST['frm_mode']) && $_POST['frm_mode'] == 'setProfilePic') {
            $uuid = (isset($_POST['uuid'])) ? $this->common->mysql_safe_string($_POST['uuid']) : '';
            $user_id = (isset($_POST['user_id'])) ? $this->common->mysql_safe_string($_POST['user_id']) : '0';

            if (isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] != '') {

                /*  $file_uuid = "";
                try {

                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $file_uuid = $uuid4->toString();

                } catch (UnsatisfiedDependencyException $e) {
                //  echo 'Caught exception: ' . $e->getMessage() . "\n";
                } */
                $filename = "user_" . $user_id . "_" . date("YmdHis");

                $upload = $this->common->UploadImage('profile_pic', 'uploads/profile_pics/', $filename);

                if ($upload['uploaded'] == 'false') {
                    $error = $upload['uploadMsg'];
                } else {

                    $add_in['profile_pic'] = $upload['imageFile'];

                }

            } else {
                $error = "Please select profile pic";
            }

            if ($error == "") {

                $add_in['edit_date'] = date("Y-m-d h:i:s");
                $where_edt = "user_id = '" . $user_id . "' and status_flag='Active' ";
                $this->common->updateRecord('user_master_front', $add_in, $where_edt);

                if ($add_in['profile_pic'] != '') {
                    $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($add_in['profile_pic']);
                } else {
                    $user_photo = back_path . "uploads/noimage.png";
                }

                $userInfo = array("user_photo" => $user_photo);

                $returnData = array("status" => 1, "successMessage" => 'Information updtaed successfully!', 'userInfo' => $userInfo);

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }

    public function getProfile()
    {
        $returnData = [];
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        //  print_r($data_json);
        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getProfile') {

            // $uuid = (isset($data_json['uuid'])) ? $this->common->mysql_safe_string($data_json['uuid']) : '';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            //   $user_type = (isset($data_json['user_type'])) ? $this->common->mysql_safe_string($data_json['user_type']) : '0';
            //    $LANGCODE = (isset($data_json['LANGCODE'])) ? $this->common->mysql_safe_string($data_json['LANGCODE']) : 'EN';
            $errorData = [];

            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }

            if (sizeof($errorData) <= 0) {

                $returnData = $this->services->getProfile($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

            //print(json_encode($array));
        }

        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function categorySubcategory()
    {
        $returnData = [];
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        //  print_r($data_json);
        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'categorySubcategory') {
            $returnData = $this->services->categorySubcategory($data_json, 'ARRAY');
        }

        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function doRequest($returnformat = "json")
    {
        $returnData = [];
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }

        $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);
        // print_r($data_json);
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRequest') {
            $returnData = $this->services->doRequest($data_json, 'ARRAY');
        }

        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function doUploadConsignmentImage()
    {
        $returnData = [];
        //header('Content-Type: application/json');
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $today = date("Y-m-d h:i:s");

        $error = "";
        //print_r($_FILES);
        //print_r($_POST);
        if (isset($_POST['frm_mode']) && $_POST['frm_mode'] == 'doUploadConsignmentImage') {

            $user_id = (isset($_POST['user_id'])) ? $this->common->mysql_safe_string($_POST['user_id']) : '0';

            if (isset($_FILES['consignmentimage']['name']) && $_FILES['consignmentimage']['name'] != '') {

                /*  $file_uuid = "";
                try {

                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $file_uuid = $uuid4->toString();

                } catch (UnsatisfiedDependencyException $e) {
                //  echo 'Caught exception: ' . $e->getMessage() . "\n";
                } */
                $filename = $user_id . "-" .  date("YmdHis");

                $upload = $this->common->UploadImage('consignmentimage', 'uploads/consignmentimage_temp/', $filename);

                if ($upload['uploaded'] == 'false') {
                    $error = $upload['uploadMsg'];
                } else {
                    chmod("uploads/consignmentimage_temp/" . $upload['imageFile'], 0775);

                    $consignmentimage = back_path . "uploads/consignmentimage_temp/" . $upload['imageFile'];
                }

            } else {
                $error = "Please select consignment image";
            }

            if ($error == "") {

                $returnData = array("status" => 1, "successMessage" => 'Image uploaded successfully!', 'consignmentimage' => $consignmentimage);

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }

    public function allRequest($returnformat = "json")
    {
        $returnData = [];
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');

        /*
        if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }

        $received_signature = $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);
        // print_r($data_json);
        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'allRequest') {
            //$data_json['request_status'] = (isset($data_json['request_status'])) ? $data_json['request_status'] : "";
            $returnData = $this->services->allRequest($data_json, 'ARRAY');
        }

        print_r($this->common->jsonencode($returnData));
        die();
    }
    public function doDeleteConsignmentImage()
    {
        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        //header('Content-Type: application/json');

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doDeleteConsignmentImage') {

            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
            $image_name = (isset($data_json['image_name'])) ? $this->common->mysql_safe_string($data_json['image_name']) : '';
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
            if ($image_name == '') {
                $errorData[] = "Please enter image name";
            }
            if ($error == "") {

                $returnData = $this->services->doDeleteConsignmentImage($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function doRequestUpdate()
    {
        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        //header('Content-Type: application/json');

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRequestUpdate') {

            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
           
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
             
            if ($error == "") {

                $returnData = $this->services->doRequestUpdate($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
     
    public function doAddConsignmentImage()
    {
        $returnData = [];
        //header('Content-Type: application/json');
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $today = date("Y-m-d h:i:s");

        $error = "";
        //print_r($_FILES);
        //print_r($_POST);
        if (isset($_POST['frm_mode']) && $_POST['frm_mode'] == 'doAddConsignmentImage') {

            $user_id = (isset($_POST['user_id'])) ? $this->common->mysql_safe_string($_POST['user_id']) : '0';
            $request_id = (isset($_POST['request_id'])) ? $this->common->mysql_safe_string($_POST['request_id']) : '0';

            if (isset($_FILES['consignmentimage']['name']) && $_FILES['consignmentimage']['name'] != '') {

                /*  $file_uuid = "";
                try {

                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $file_uuid = $uuid4->toString();

                } catch (UnsatisfiedDependencyException $e) {
                //  echo 'Caught exception: ' . $e->getMessage() . "\n";
                } */
                $filename = $request_id."-".$user_id . "-" . date("YmdHis");

                $upload = $this->common->UploadImage('consignmentimage', 'uploads/consignmentimage/', $filename);

                if ($upload['uploaded'] == 'false') {
                    $error = $upload['uploadMsg'];
                } else {
                    @chmod("uploads/consignmentimage/" . $upload['imageFile'], 0775);

                    $consignmentimage = back_path . "uploads/consignmentimage/" . $upload['imageFile'];
                    $add_in_image['request_id'] = $request_id;
                    $add_in_image['user_id'] = $user_id;
                    $add_in_image['image_name'] = $upload['imageFile'];
                    $this->common->insertRecord('lt_request_consignment_imgs', $add_in_image);
                }

            } else {
                $error = "Please select consignment image";
            }

            if ($error == "") {

                $returnData = array("status" => 1, "successMessage" => 'Image uploaded successfully!', 'consignmentimage' => $consignmentimage);

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function getRequestDetail()
    {
        $arr = array('status' => 0, 'errorMessage' => "Warning: No address is found ");
        $data_json = file_get_contents('php://input');
        /*  if (debug == 1) {
        file_put_contents('debug/' . date("ymd") . '.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getRequestDetail') {

             $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '';
            $errorData = [];

            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
            if ($user_id == '') {
            //    $errorData[] = "Please enter user id";
            }
            if (sizeof($errorData) <= 0) {
                $returnData = $this->services->getRequestDetail($data_json,  'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorData' => $errorData);
            }

        }
        print_r($this->common->jsonencode($returnData));
        die();
    }

    public function doDeleteConsignmentImageTemp()
    {
        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        //header('Content-Type: application/json');

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doDeleteConsignmentImageTemp') {

            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
           
            $image_name = (isset($data_json['image_name'])) ? $this->common->mysql_safe_string($data_json['image_name']) : '';
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            
            if ($image_name == '') {
                $errorData[] = "Please enter image name";
            }
            if ($error == "") {

                $returnData = $this->services->doDeleteConsignmentImageTemp($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function doRequestAction()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRequestAction') {

            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
            $action_flag = (isset($data_json['action_flag'])) ? $this->common->mysql_safe_string($data_json['action_flag']) : '0';
            $service_provider_id = (isset($data_json['service_provider_id'])) ? $this->common->mysql_safe_string($data_json['service_provider_id']) : '0';
           
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
            if ($action_flag == '') {
                $errorData[] = "Please enter action ";
            }
            if ($error == "") {

                $returnData = $this->services->doRequestAction($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function doRequestStatusActionByDriver()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRequestStatusActionByDriver') {

            $driver_id = (isset($data_json['driver_id'])) ? $this->common->mysql_safe_string($data_json['driver_id']) : '0';
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
            $action_flag = (isset($params['action_flag'])) ? $this->common->mysql_safe_string($params['action_flag']) : '';
        
          
            if ($driver_id == '') {
                $errorData[] = "Please enter driver id";
            }
            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
            if ($action_flag == '') {
                $errorData[] = "Please enter action ";
            }
            if ($error == "") {

                $returnData = $this->services->doRequestStatusActionByDriver($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }

    public function doLiveTrackingDrver()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doLiveTrackingDrver') {

            $driver_id = (isset($data_json['driver_id'])) ? $this->common->mysql_safe_string($data_json['driver_id']) : '0';
           // $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
           
            
           
            if ($driver_id == '') {
                $errorData[] = "Please enter driver id";
            }
            
            if ($error == "") {

                $returnData = $this->services->doLiveTrackingDrver($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function getLiveTrackingDrver()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getLiveTrackingDrver') {

            $driver_id = (isset($data_json['driver_id'])) ? $this->common->mysql_safe_string($data_json['driver_id']) : '0';
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
           
            
           
            if ($driver_id == '') {
                $errorData[] = "Please enter driver id";
            }
            if ($request_id == '') {
              //  $errorData[] = "Please enter request id";
            }
            if ($error == "") {

                $returnData = $this->services->getLiveTrackingDrver($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();

    }
    public function doAddCompleteConsignmentImage()
    {

        $returnData = [];
        //header('Content-Type: application/json');
        $arr = array('status' => 0, 'errorMessage' => "Warning: No data found ");

        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $today = date("Y-m-d h:i:s");

        $error = "";
        //print_r($_FILES);
        //print_r($_POST);
        if (isset($_POST['frm_mode']) && $_POST['frm_mode'] == 'doAddCompleteConsignmentImage') {

            $driver_id = (isset($_POST['driver_id'])) ? $this->common->mysql_safe_string($_POST['driver_id']) : '0';
            $request_id = (isset($_POST['request_id'])) ? $this->common->mysql_safe_string($_POST['request_id']) : '0';

            if (isset($_FILES['consignmentimage']['name']) && $_FILES['consignmentimage']['name'] != '') {

                /*  $file_uuid = "";
                try {

                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $file_uuid = $uuid4->toString();

                } catch (UnsatisfiedDependencyException $e) {
                //  echo 'Caught exception: ' . $e->getMessage() . "\n";
                } */
                $filename = "comp-".$request_id."-".$driver_id . "-" . date("YmdHis");

                $upload = $this->common->UploadImage('consignmentimage', 'uploads/consignmentimage/', $filename);

                if ($upload['uploaded'] == 'false') {
                    $error = $upload['uploadMsg'];
                } else {
                    @chmod("uploads/consignmentimage/" . $upload['imageFile'], 0775);

                    $consignmentimage = back_path . "uploads/consignmentimage/" . $upload['imageFile'];
                    $add_in_image['request_id'] = $request_id;
                    $add_in_image['driver_id'] = $driver_id;
                    $add_in_image['image_name'] = $upload['imageFile'];
                    $add_in_image['insert_date'] = date("Y-m-d H:i:s");
                    $this->common->insertRecord('lt_request_final_complete_images', $add_in_image);
                }

            } else {
                $error = "Please select consignment image";
            }

            if ($error == "") {

                $returnData = array("status" => 1, "successMessage" => 'Image uploaded successfully!', 'consignmentimage' => $consignmentimage);

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();
    }
    public function doGetCompletedConsignmentImage()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doGetCompletedConsignmentImage') {

            
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
           
            
           
            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
            
            if ($error == "") {

                $returnData = $this->services->doGetCompletedConsignmentImage($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();
    }
    public function doAddReview()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doAddReview') {

            
            $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
            
           
            if ($request_id == '') {
                $errorData[] = "Please enter request id";
            }
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            if ($error == "") {

                $returnData = $this->services->doAddReview($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();
    }
    public function getReviewsList()
    {

        $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
        $data_json = file_get_contents('php://input');
        /*  if(debug==1){
        file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
        }
        $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
        $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

        if ($received_signature != $computed_signature) {
        $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
        print_r($this->common->jsonencode($arr));
        die();
        } */

        $data_json = json_decode($data_json, true);

        $error = "";

        if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'getReviewsList') {

            
            $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
           
            
           
            if ($user_id == '') {
                $errorData[] = "Please enter user id";
            }
            
            if ($error == "") {

                $returnData = $this->services->getReviewsList($data_json, 'ARRAY');

            } else {
                $returnData = array('status' => 0, 'errorMessage' => $error);
            }

        }

        print_r($this->common->jsonencode($returnData));
        die();
   } 

   public function doRequestCancelAction()
   {

       $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
       $data_json = file_get_contents('php://input');
       /*  if(debug==1){
       file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
       }
       $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
       $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

       if ($received_signature != $computed_signature) {
       $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
       print_r($this->common->jsonencode($arr));
       die();
       } */

       $data_json = json_decode($data_json, true);

       $error = "";

       if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doRequestCancelAction') {

           $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
           $request_id = (isset($data_json['request_id'])) ? $this->common->mysql_safe_string($data_json['request_id']) : '0';
           $action_flag = (isset($data_json['action_flag'])) ? $this->common->mysql_safe_string($data_json['action_flag']) : '0';
           $service_provider_id = (isset($data_json['service_provider_id'])) ? $this->common->mysql_safe_string($data_json['service_provider_id']) : '0';
          
           if ($user_id == '') {
               $errorData[] = "Please enter user id";
           }
           if ($request_id == '') {
               $errorData[] = "Please enter request id";
           }
           if ($action_flag == '') {
               $errorData[] = "Please enter action ";
           }
           if ($error == "") {

               $returnData = $this->services->doRequestCancelAction($data_json, 'ARRAY');

           } else {
               $returnData = array('status' => 0, 'errorMessage' => $error);
           }

       }

       print_r($this->common->jsonencode($returnData));
       die();

   }
   public function doLoginViaMedia()
   {

    $returnData = array('status' => 0, 'errorMessage' => 'Something went wrong');
    $data_json = file_get_contents('php://input');
    /*  if(debug==1){
    file_put_contents('debug/'.date("ymd").'.txt', $data_json, FILE_APPEND);
    }
    $received_signature = (isset($_SERVER['HTTP_DOICEX_SIGNATURE'])) ? $this->common->mysql_safe_string($_SERVER['HTTP_DOICEX_SIGNATURE']) : ''; // $_SERVER['HTTP_DOICEX_SIGNATURE'];
    $computed_signature = hash_hmac('sha256', $data_json, Secret_Key);

    if ($received_signature != $computed_signature) {
    $arr = array('status' => 0, 'errorMessage' => "Invalid Signature");
    print_r($this->common->jsonencode($arr));
    die();
    } */

    $data_json = json_decode($data_json, true);

    $error = "";

    if (isset($data_json['frm_mode']) && $data_json['frm_mode'] == 'doLoginViaMidea') {

        $user_id = (isset($data_json['user_id'])) ? $this->common->mysql_safe_string($data_json['user_id']) : '0';
     
        
        if ($error == "") {

            $returnData = $this->services->doLoginViaMidea($data_json, 'ARRAY');

        } else {
            $returnData = array('status' => 0, 'errorMessage' => $error);
        }

    }

            print_r($this->common->jsonencode($returnData));
            die();
       # code...
   }
}
