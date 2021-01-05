<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() 
	{
		parent::__construct();
		//$this->load->library('form_validation');
		$this->load->model('Login_Model','logmein');
		$this->load->library('Mypass');
	}

	public function index()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('admin_profile_pic');
		//$this->session->unset_userdata('login_error');
		$this->load->view('login-view');
    }
    
    public function chklogin()
    {
        $getadminusername=$this->input->post('adminuname');
        $getadminpasscode=$this->input->post('adminpasscode');
        
        $return=$this->logmein->logmein_model_func($getadminusername,$getadminpasscode);

        if($return!='')
		{
			redirect(base_url().'login');
			//$this->response($return, 200);
		}
		else
		{
			redirect(base_url().'dashboard');
			//$this->response(NULL, 404);
		}
        //$getvalue=$this->mypass->md5_encrypt('Admin@2020',"qazxsw",16);
        //$getvalue=$this->mypass->md5_decrypt('QMYsMNqlmeW/oaYeQf2HgSfApMUrRDBmK3efQKb+mEI=',"qazxsw",16);
		//echo "Password : ".$getvalue; exit;
        //echo "Kunal";
	}
	
	public function getmelogout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('admin_email');
		$this->session->unset_userdata('login_error');
		$this->session->unset_userdata('admin_profile_pic');
		redirect(base_url().'login');
	}
}
