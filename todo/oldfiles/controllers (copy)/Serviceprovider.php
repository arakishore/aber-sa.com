<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Serviceprovider extends CI_Controller
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
    public $controller = "serviceprovider";
    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
			$this->load->model('common');
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
			$this->common->check_user_session();
    }
	
	
    public function index(){
		$data['l_s_act'] = 1;
		$data['controller'] = $this->controller;
        $this->load->view("serviceprovider", $data);
    }

    public function notifications(){
		$data['l_s_act'] = 2;
        $this->load->view("notifications", $data);
    }

    public function my_shipment(){
		$data['l_s_act'] = 3;
		$data['l_s_act_in'] = 1;		
        $this->load->view("my_shipment", $data);
    }

    public function my_requests(){
		$data['l_s_act'] = 3;
		$data['l_s_act_in'] = 2;		
        $this->load->view("my_requests", $data);
    }
	
    public function review(){
		$data['l_s_act'] = 4;
        $this->load->view("review", $data);
    }	

    public function my_drivers(){
		$data['l_s_act'] = 5;

		$error = '';
		$data['controller'] = $controller = $this->controller;
		$session_user_data = $this->session->userdata('user_data');
		$id = $session_user_data['user_id'];
		
        $sSql = "SELECT um.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `user_master_front` um
			left join master_province mp on um.state_id = mp.id
			left join master_city md on um.district_id = md.id  WHERE um.status_flag in ('Active','Inactive')  and user_type='Driver'  and um.parent_id='" . $id . "'   ORDER BY um.user_id DESC";

        $query = $this->db->query($sSql);
        $data['my_drivers'] =  $my_drivers = $query->result_array();
        $this->load->view("my_drivers", $data);
    }	

    public function driver_signup(){
		$data['l_s_act'] = 5;
		$error = '';
		$data['controller'] = $controller = $this->controller;
		$session_user_data = $this->session->userdata('user_data');
		$id = $session_user_data['user_id'];

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['first_name'] = $first_name = (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['last_name'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';

            if ($first_name == '') { $error .= "Please enter first name<br>"; }
			if ($last_name == '') { $error .= "Please enter last name<br>"; }
			if ($mobile == '') { $error .= "Please enter phone number<br>"; }
			
            if ($error == '') {
                $this->db->where('user_id', $session_user_data['user_id']);
                $this->db->update('user_master_front', $add_in);

                $this->session->set_flashdata('success', 'Profile has been updated succssfully!');
                redirect($this->controller . '/edit_profile');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }
				
        $this->load->view("driver_signup", $data);
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

            if ($first_name == '') { $error .= "Please enter first name<br>"; }
			if ($last_name == '') { $error .= "Please enter last name<br>"; }
			if ($mobile == '') { $error .= "Please enter phone number<br>"; }
			
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

    public function find_business(){
		$data['l_s_act'] = 0;
		$error = '';
		$data['controller'] = $controller = $this->controller;
		$session_user_data = $this->session->userdata('user_data');
		$id = $session_user_data['user_id'];
		
        $this->load->view("find_business", $data);
    }	

    public function shipment_details(){
		$data['l_s_act'] = 0;
		$error = '';
		$data['controller'] = $controller = $this->controller;
		$session_user_data = $this->session->userdata('user_data');
		$id = $session_user_data['user_id'];
		
        $this->load->view("shipment_details", $data);
    }	

    public function my_shipment_details(){
		$data['l_s_act'] = 1;
		$error = '';
		$data['controller'] = $controller = $this->controller;
		$session_user_data = $this->session->userdata('user_data');
		$id = $session_user_data['user_id'];
		
        $this->load->view("my_shipment_details", $data);
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
}