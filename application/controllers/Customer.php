<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customer extends CI_Controller
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
    public $controller = "customer";
    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
            $this->load->model('common');
            $this->load->model('services');
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
            $session_user_data = $this->common->check_user_session();
            if (isset($session_user_data['user_type']) && $session_user_data['user_type'] != "Customer") {
                redirect("serviceprovider");
                exit;
            }  
    }
	
	
    public function index(){
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
		$data['l_s_act'] = 1;
        $data['controller'] = $this->controller;
        $params['user_id'] = $user_id;
        $params['request_status_multple'] = "'Requested','Ongoing','Scheduled'";
       
       $all_request = $this->services->allRequest($params,'ARRAY');
        if($all_request['status']==1){
            $data['all_request'] = $all_request['result'];
        } else {
            $data['all_request'] = [];
        }
       //print_r($all_request['result']);

        $this->load->view("customer", $data);
    }
    public function my_shipment($request_status="Requested")
    {
        $session_user_data = $this->session->userdata('user_data');
        $data['l_s_act'] = 3;
        $data['l_s_act_in'] = 1;
        $data['controller'] = $this->controller;

        $user_id = $session_user_data['user_id'];
	 
        $data['controller'] = $this->controller;
        $params['user_id'] = $user_id;
        if($request_status!=""){
            $params['request_status_multple'] = "'".$request_status."'";
        } else {
            $params['request_status_multple'] = "'Requested'";
        }
       $params['status_flag'] = "'Active','Cancel'";
       $all_request = $this->services->allRequest($params,'ARRAY');
        if($all_request['status']==1){
            $data['all_request'] = $all_request['result'];
        } else {
            $data['all_request'] = [];
        }
        $data['request_status'] = $request_status;
        $this->load->view("my_shipment_customer", $data);
    }
    public function my_shipment_details($request_id = '')
    {
        $data['l_s_act'] = 1;
        $error = '';

        $data['request_id'] = $request_id;
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $user_id = $session_user_data['user_id'];

        $params['user_id'] = $user_id;
        $params['request_id'] = $request_id;
        $params['status_flag'] = "'Active','Cancel'";
       $getRequestDetail = $this->services->getRequestDetail($params,'ARRAY');
        if($getRequestDetail['status']==1){
            $data['requests'] = $getRequestDetail['result'];
        } else {
            $data['requests'] = [];
        }
        if(isset($_POST['mode']) && $_POST['mode']=="doRequestAction"){
            
          
            $action_flag = (isset($_POST['action_flag'])) ? $this->common->mysql_safe_string($_POST['action_flag']) : '0';
            $service_provider_id = (isset($_POST['service_provider_id'])) ? $this->common->mysql_safe_string($_POST['service_provider_id']) : '0';
            $data_json['user_id'] = $user_id;
            $data_json['request_id'] = $request_id;
            $data_json['action_flag'] = $action_flag;
            $data_json['service_provider_id'] = $service_provider_id;

            $returnData = $this->services->doRequestAction($data_json, 'ARRAY');
            if($returnData['status']==1){
                $this->session->set_flashdata('success', $returnData['successMessage']);
            }
            if($returnData['status']==2){
                $this->session->set_flashdata('success', $returnData['errorMessage']);
            }
            if($returnData['status']==0){
                $this->session->set_flashdata('success', $returnData['errorMessage']);
            }
           redirect($this->controller . '/my_shipment_details/' . $request_id);
        }
     // print_r($getRequestDetail);

      $sSql = "SELECT *  FROM `lt_request_final_complete_images` WHERE request_id=" . $request_id . " ORDER BY id";
      $query = $this->db->query($sSql);
      $data['cons_final_images'] = $cons_final_images = $query->result_array();



        $request_status = $this->services->get_request_status_history($params['request_id'],'ARRAY');
       // print_r($request_status);
        $data['request_status'] = (isset($request_status['request_sub_status'])) ? $request_status['request_sub_status'] : [];
        
        $sSql = "SELECT *  FROM `setting` WHERE setting_id='17746' ORDER BY setting_id";
        $query = $this->db->query($sSql);
        $setting = $query->row_array();
        $data['VAT_PERCENTAGE'] = $this->common->getDbValue($setting['value']);

        $sSql = "SELECT *  FROM `setting` WHERE setting_id='17747' ORDER BY setting_id";
        $query = $this->db->query($sSql);
        $setting = $query->row_array();
        $data['ADMIN_COMMISSION'] = $this->common->getDbValue($setting['value']);

        $this->load->view("my_shipment_details_customer", $data);
    }

    public function notifications()
    {
  
 

        $data['l_s_act'] = 2;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $sSql = "SELECT * FROM lt_notification WHERE user_id='" . $id . "' AND not_date > date_sub(curdate(),interval 0 day) ORDER BY not_id";
        $query = $this->db->query($sSql);
        $data['todays_not'] = $nitifications = $query->result_array();

        $sSql = "SELECT * FROM lt_notification WHERE user_id='" . $id . "' AND not_date != date_sub(curdate(),interval 0 day) ORDER BY not_id";
        $query = $this->db->query($sSql);
        $data['all_not'] = $nitifications = $query->result_array();

        $this->load->view("notifications", $data);
    }
    public function change_password(){
		$data['l_s_act'] = 7;
		$error = '';
		$data['controller'] = $controller = $this->controller;
		$session_user_data = $this->session->userdata('user_data');
		
        if (isset($_POST['mode']) && $_POST['mode'] == "change_password") {

            $add_in = array();
			
			$admin_details = $this->common->getSingleInfoBy('user_master_front', 'user_id', $session_user_data['user_id'], '*');
			
            $old_password = (isset($_POST['old_password'])) ? $this->common->mysql_safe_string($_POST['old_password']) : '';
            $txt_password = (isset($_POST['txt_password'])) ? $this->common->mysql_safe_string($_POST['txt_password']) : '';
            $confirm_password = (isset($_POST['confirm_password'])) ? $this->common->mysql_safe_string($_POST['confirm_password']) : '';

            if ($old_password == '') { $error .= "Please enter old password.<br>"; }
			if ($txt_password == '') { $error .= "Please enter New password.<br>"; }
			if ($confirm_password == '') { $error .= "Please enter confirm password.<br>"; }
			
			if($admin_details['passphrase']!=$old_password){
				   $error.="Old password is incorrect.";
			}			
			
            if ($error == '') {
				$add_in['passphrase'] = $txt_password;
                $this->db->where('user_id', $session_user_data['user_id']);
                $this->db->update('user_master_front', $add_in);

                $this->session->set_flashdata('success', 'Password has been changed succssfully!');
                redirect($this->controller . '/change_password');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }		
        $this->load->view("change_password", $data);
    }	

    public function edit_profile(){
        $data['l_s_act'] = 0;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['first_name'] = $first_name = (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['last_name'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';

            if ($first_name == '') {$error .= "Please enter first name<br>";}
            if ($last_name == '') {$error .= "Please enter last name<br>";}
            if ($mobile == '') {$error .= "Please enter phone number<br>";}

            if ($error == '') {
                $this->db->where('user_id', $session_user_data['user_id']);
                $this->db->update('user_master_front', $add_in);

                $this->session->set_flashdata('success', 'Profile has been updated succssfully!');
                redirect($this->controller . '/edit_profile');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $data['results'] = $results = $this->common->getSingleInfoBy('user_master_front', 'user_id', $session_user_data['user_id'], '*');
        $this->load->view("edit_profile", $data);
    }	

    public function profile_pic()
    { 
        $data['controller'] = $this->controller;
        
        if ($_FILES['profile_pic']['name'] != '') {
           $profile_pic =  $this->services->profile_pic('profile_pic');
        }
        echo $profile_pic;
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
    public function log_out()
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
    public function review()
    {
        $data['l_s_act'] = 4;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];
// 
//rq.service_pro_review, rq.service_pro_overall, rq.service_pro_ratings, rq.service_pro_review_date
         $sSql = "SELECT us.first_name, us.last_name, us.profile_pic,
        rq.cust_review as review_text, rq.cust_overall as overall, rq.cust_rating as rating, rq.cust_review_date  as review_date,rq.request_title, rq.insert_date
FROM user_master_front us
 
inner join lt_requests rq on us.user_id = rq.service_provider_id
WHERE rq.user_id='" . $id . "'  AND(  cust_rating IS NOT NULL && cust_rating > 0 ) ORDER BY rq.request_id";
        $query = $this->db->query($sSql);
        $data['reviews'] = $reviews = $query->result_array();

        $this->load->view("review", $data);
    }   


    public function shipment_details_edit($req_uuid=""){
        $req_uuid = (isset($req_uuid)) ? $this->common->mysql_safe_string($req_uuid) : '';
        
        $sql = "select * from lt_requests  where uuid='{$req_uuid}'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            $reqInfo = $query->row_array();
            $req_data_post1['request_id'] = $reqInfo['request_id'];
            $req_data_post1['category_id'] = $reqInfo['category_id'];
            $req_data_post1['category_name'] = $reqInfo['category_name'];
            $req_data_post1['subcategory_id'] = $reqInfo['subcategory_id'];
            $req_data_post1['subcategory_name'] = $reqInfo['subcategory_name'];
            $req_data_post1['pickup_longitude'] = $reqInfo['pickup_longitude'];
            $req_data_post1['pickup_latitude'] = $reqInfo['pickup_latitude'];
            $req_data_post1['pickup_location'] = $reqInfo['pickup_location'];
            $req_data_post1['pickup_date'] =  $this->common->getDateFormat($reqInfo['pickup_date'],'d-m-Y');
            $req_data_post1['destination_longitude'] = $reqInfo['destination_longitude'];
            $req_data_post1['destination_latitude'] = $reqInfo['destination_latitude'];
            $req_data_post1['destination_location'] = $reqInfo['destination_location'];
            $req_data_post1['drop_destination_date'] =  $this->common->getDateFormat($reqInfo['drop_destination_date'],'d-m-Y');
            $req_data_post1['distance_mile'] = $reqInfo['distance_mile'];
            $req_data_post1['expected_travelling_time'] = $reqInfo['expected_travelling_time'];

            $this->session->set_userdata(array('req_data_post1' => $req_data_post1));

            $postdata_temp['request_title'] = $reqInfo['request_title'];
            $sql = "select * from lt_requests_items  where request_id='".$reqInfo['request_id']."'";
            $queryItems = $this->db->query($sql);
            if($queryItems->num_rows()>0){
                $reqItemInfo = $queryItems->result_array();

                foreach($reqItemInfo as $key => $value){
                   
                    $temp_array = array('consignment_qty'=>$value['consignment_qty'],'consignment_width'=>$value['consignment_width'],'consignment_height'=>$value['consignment_height'],'consignment_weight'=>$value['consignment_weight'],'consignment_length'=>$value['consignment_length'],'consignment_details'=>$value['consignment_details']);
                    $postdata_temp['requests_items'][] = $temp_array;
                }
    
                
            }
            $sql = "select * from lt_request_consignment_imgs  where  request_id='".$reqInfo['request_id']."'";
            $request_query = $this->db->query($sql) ;
            if($request_query->num_rows()>0){
                $reqItemInfo = $request_query->result_array();
                 $postdata_temp['lt_request_consignment_imgs'] = $reqItemInfo;
            } 

            $this->session->set_userdata(array('req_data_post2' => $postdata_temp));
            
             $req_data_post3['request_description'] = $reqInfo['request_description'];
            $this->session->set_userdata(array('req_data_post3' => $req_data_post3));

            $this->session->set_userdata(array('req_uuid' => $req_uuid));
            redirect("request/category");
        } else {
            redirect("home");
        }
        
    }
}