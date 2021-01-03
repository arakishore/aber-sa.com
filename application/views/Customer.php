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
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
			$this->common->check_user_session();
    }
	
	
    public function index(){
		$data['l_s_act'] = 1;
		$data['controller'] = $this->controller;
        $this->load->view("customer", $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');		
		
    }

    public function notifications(){
		$data['l_s_act'] = 2;
        $this->load->view("notifications", $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');		
		
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
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');		
		
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
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');		
		
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