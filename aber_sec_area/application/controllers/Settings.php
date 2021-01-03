<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
public $db;
public $ctrl_name = 'settings';
public $tbl_name = 'user_admin';
public $pg_title = 'Settings';
public $m_act = 66;
public $s_act = 661;

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
		
	
  function change_pass(){
	  		 
			 $data['l_s_act'] = 662;
			 $userid['user_id']=$this->session->userdata('userid');
			 $userid['selected']=7;
			 
	         $data['errormsg']="";
			 $data['suss']="";
			 $table="user_admin";
			 
	         $session_user_data = $this->session->userdata('user_data');
			 $user_id = $session_user_data['user_id'];
				
			 $admin_details=$this->common->getOneRow($table,'where user_id='.$user_id);
			 $data["admin_details"]=$admin_details;
			
	        if(extract($_POST)){
			    $msg="";
				if($_POST["old_password"]=="")
				{
				  $msg.="Please enter old password.<br>";
				}
				if($_POST["txt_password"]=="")
				{
				  $msg.="Please enter New password.<br>";
				}
				if($_POST["confirm_password"]=="")
				{
				  $msg.="Please enter confirm password.<br>";
				}
				
				
				$data['errormsg']=$msg;
				if($admin_details['user_pass']!=$_POST["old_password"])
				{
				   $msg.="Old password is incorrect.";
				}
				$data['errormsg']=$msg;
				if($data['errormsg']=="") 
				{
					if($_POST["txt_password"]==$_POST["confirm_password"])
					{
						$password=addslashes($_POST["txt_password"]);
						$updatedata['user_pass']=$password;
						$whereupdate="";
						$whereupdate="user_id = 1";
						$this->common->updateRecord('user_admin',$updatedata,$whereupdate);
						$data['suss']="Password is updated successfully.";
						$admin_details=$this->common->getOneRow($table,'where user_id='.$user_id);
						$data["admin_details"]=$admin_details;
					}	
					else
					{
					   $data['errormsg']="Password and Confirm Password doesn't match.";
					}
			   }	
	  		}

			//$this->load->view('include/header');
			$this->load->view('changepassword',$data); 
  }	
}

