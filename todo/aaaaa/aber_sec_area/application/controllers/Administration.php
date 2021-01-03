<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Manage_administrators
 *
 * @package Getlised.in
 * @subpackage Manage Administrator
 * @category Administrator
 * @version    1.0
 * @updated    21/04/2020
 */
//use Ifsnop\Mysqldump as IMysqldump;
 use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;



class Administration extends CI_Controller
{
    public $activaation_id = "101";
    public $sub_activaation_id = "101_2";
    public $title = "Staff";
    public $controller = "administration";
	public $m_act = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common');
        //$this->load->model('services');
        $this->load->helper('security');

        $this->load->helper('url_helper');
        //if session not exist

        $this->common->check_user_session();
    }
    public function index()
    {

        $this->listall();
    }

    public function listall()
    {
    
       /*  try {
            $dump = new IMysqldump\Mysqldump('mysql:host='.$this->db->hostname.';dbname='.$this->db->database,$this->db->username, $this->db->password   );
            $dump->start('backupdb/'.$this->db->database."_".date("ymd").'.sql');
        } catch (\Exception $e) {
            echo 'mysqldump-php error: ' . $e->getMessage();
        } */

        $session_user_data = $this->session->userdata('user_data');

        $data['activaation_id'] = 101;
        $data['sub_activaation_id'] = '101_2';
        $data['title'] = 'Staff';

        $data['sub_heading'] = 'List';

        //paging
        $data['start'] = 0;
        $data['maxm'] = $maxm = 100;
        if (isset($_GET['page']) && $_GET['page'] != '') {
            $page = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
            $data['page'] = $page;
        } //isset( $_GET['page'] ) && $_GET['page'] != ''
        else {
            $page = 0;
            $data['page'] = 0;
        }
        $start_temp = (($page == 0) ? 0 : $page - 1);
        $start = $start_temp * $maxm;
        if ($start < 0) {
            $start = 0;
        }
        $data['start'] = $page;
        $data['maxm'] = $maxm;
        //end paging
        //$search_qry = " WHERE user_type='EMP' and  delete_status='0'  ";
		$search_qry = " WHERE  user_status!='Delete'  ";
        $order_by = " order by user_id ";

        $data['results'] = $this->common->getRecordsLimit('user_admin',$search_qry,$start, $maxm);
        $data['num_row'] = $this->common->getRecordsCount('user_admin',$search_qry);

        $fun_name = $this->controller . '/listall';
        $data['fun_name'] = $fun_name;
        $data['controller'] = $this->controller;

        $this->load->view('administration_listall', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function editdata($uuid = 0)
    {

        $session_user_data = $this->session->userdata('user_data');
        $uuid = filter_var($uuid, FILTER_SANITIZE_STRING);

        $data['activaation_id'] = 101;
        $data['sub_activaation_id'] = '101_2';
        $data['title'] = 'Staff';
        $data['sub_heading'] = 'Edit';
		$data['id'] = $uuid;
		$data['controller'] = $this->controller;
		$data['fun'] = "editdata";
        $error = '';
		
		if(isset($_POST['mode']) && $_POST['mode']=="edit_content_password"){
			$login_password = $this->common->mysql_safe_string($_POST['login_password']);
			 $email = $this->common->mysql_safe_string($_POST['email']);
			if ($login_password=='') { $error.="Please enter password<br>";}
				if ($error=='') {
					 $passphrase = $login_password;
					  $array = array(
						'user_pass' => $passphrase,
					);
					$this->db->where('uuid', $uuid); 
					//die();
					 $this->db->update('user_admin', $array);
					 $this->session->set_flashdata('success', 'Information updated succssfully..');
					 redirect($this->controller.'/listall');
				}
		}
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

			$add_in = array();
            $add_in['firstname'] = $first_name =  (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['lastname'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['email'] = $email = (isset($_POST['email'])) ? $this->common->mysql_safe_string($_POST['email']) : '';
			$add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';
            $add_in['user_status'] = $user_status = (isset($_POST['user_status']))?$this->common->mysql_safe_string($_POST['user_status']):'';
			$email_old = $this->common->mysql_safe_string($_POST['email_old']);
            if ($first_name == '') {
                $error .= "Please enter first name<br>";
            }
            if ($last_name == '') {
                $error .= "Please select last name<br>";
            }
            if ($email == '') {
                $error .= "Please email<br>";
			}
			if ($mobile == '') {
                $error .= "Please enter mobile<br>";
            }
			if ($user_status == '') {
                $error .= "Please select status<br>";
			}
			if($email_old!=$email){
			$chkUserInfo = $this->common->getSingleInfoBy("user_admin",'email',$email);
			if(sizeof($chkUserInfo)>0){
				$error = "Email address is already registered";
			}	
		}

            if ($error == '') {
				/*$array = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'username' => $email,
					'user_status' => $user_status,
				);*/
			 
				$this->db->where('uuid', $uuid); 
				//$this->db->update('login_credentials', $array);
			 
				$add_in['edit_date'] = date("Y-m-d");
				$this->db->where('uuid', $uuid);
				$this->db->update('user_admin', $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
                redirect($this->controller . '/listall');
            } else {
				$this->session->set_flashdata('error', $error);
			}
			
			$data_info = $_POST;
        } else {
			$data_info = $this->common->getUserInfo($uuid);
		}

       
        
		//print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select user!');
            $this->session->set_flashdata($newdata);
            redirect($this->controller);
        }
		$data['records'] = $data_info;  
        $this->load->view('administration_editdata', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
	public function profile()
    {

        $session_user_data = $this->session->userdata('user_data');
        $id = filter_var($session_user_data['uuid'], FILTER_SANITIZE_STRING);

        $data['activaation_id'] = 1011;
        $data['sub_activaation_id'] = '101_3';
        $data['title'] = 'Staff';
        $data['sub_heading'] = 'Edit';
		$data['id'] = $id;
		$data['controller'] = $this->controller;
		$data['fun'] = "profile";  
        $error = '';
		if(isset($_POST['mode']) && $_POST['mode']=="edit_content_password"){
			$login_password = $this->common->mysql_safe_string($_POST['login_password']);
			 $email = $this->common->mysql_safe_string($_POST['email']);
			if ($login_password=='') { $error.="Please enter password<br>";}
				if ($error=='') {
					 $passphrase = $login_password;
					  $array = array(
						'passphrase' => $passphrase,
					);
					$this->db->where('uuid', $id); 
					$this->db->update('login_credentials', $array);
					$this->session->set_flashdata('success', 'Information updated succssfully..');
					redirect($this->controller . '/'.$data['fun']);
					exit;
				}
		}
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

			$add_in = array();
            $add_in['first_name'] = $first_name =  (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['last_name'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['email'] = $email = (isset($_POST['email'])) ? $this->common->mysql_safe_string($_POST['email']) : '';
			$add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';
            $add_in['user_status'] = $user_status = (isset($_POST['user_status']))?$this->common->mysql_safe_string($_POST['user_status']):'';
			$email_old = $this->common->mysql_safe_string($_POST['email_old']);
            if ($first_name == '') {
                $error .= "Please enter first name<br>";
            }
            if ($last_name == '') {
                $error .= "Please select last name<br>";
            }
            if ($email == '') {
                $error .= "Please email<br>";
			}
			if ($mobile == '') {
                $error .= "Please enter mobile<br>";
            }
			if ($user_status == '') {
                $error .= "Please select status<br>";
			}
			if($email_old!=$email){
			$chkUserInfo = $this->common->getSingleInfoBy("user_admin",'email',$email);
			if(sizeof($chkUserInfo)>0){
				$error = "Email address is already registered";
			}	
		}

            if ($error == '') {
				$array = array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'username' => $email,
					'user_status' => $user_status,
				);
			 
				$this->db->where('uuid', $id); 
				$this->db->update('login_credentials', $array);
			 
				$add_in['modified'] = date("Y-m-d");
				$this->db->where('uuid', $id);
				$this->db->update('user_admin', $add_in);

                $session_data = $this->session->userdata('user_data');
               
                 $session_data['first_name'] = $add_in['first_name'];
                 $session_data['last_name'] = $add_in['last_name'];
                 $this->session->set_userdata('user_data', $session_data);
                 
                $this->session->set_flashdata('success', 'Information updated succssfully!');
				redirect($this->controller . '/'.$data['fun']);
				exit;
            } else {
				$this->session->set_flashdata('error', $error);
			}
			
			$data_info = $_POST;
        } else {
			$data_info = $this->common->getUserInfo($id);
		}

       
        
		//print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select user!');
            $this->session->set_flashdata($newdata);
            redirect($this->controller);
        }
		$data['records'] = $data_info;  
		

        $this->load->view('administration_editdata', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    public function adddata()
    {

        $session_user_data = $this->session->userdata('user_data');
        

        $data['activaation_id'] = 101;
        $data['sub_activaation_id'] = '101_2';
        $data['title'] = 'Staff';
		$data['sub_heading'] = 'Add New';
		$data['controller'] = $this->controller;
        $data['fun'] = "adddata";
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

			$add_in = array();
            $add_in['firstname'] = $first_name =  (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['lastname'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['email'] = $email = (isset($_POST['email'])) ? $this->common->mysql_safe_string($_POST['email']) : '';
			$add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';
			$add_in['user_status'] = $user_status = (isset($_POST['user_status']))?$this->common->mysql_safe_string($_POST['user_status']):'';
			 $password = $this->common->mysql_safe_string($_POST['password']);

            if ($first_name == '') {
                $error .= "Please enter first name<br>";
            }
            if ($last_name == '') {
                $error .= "Please select last name<br>";
            }
            if ($email == '') {
                $error .= "Please email<br>";
			}
			if ($mobile == '') {
                $error .= "Please enter mobile<br>";
            }
			if ($user_status == '') {
                $error .= "Please select status<br>";
			}
			if ($password == '') {
                $error .= "Please enter password<br>";
			}
			if ($user_status == '') {
                $error .= "Please select status<br>";
			} 
			 $chkUserInfo = $this->common->getSingleInfoBy("user_admin",'email',$email);
				if(sizeof($chkUserInfo)>0){
					$error = "Email address is already registered";
				}	


            if ($error == '') {
				$uuid = "";
				try {

					// Generate a version 4 (random) UUID object
					$uuid4 = Uuid::uuid4();
					$uuid =  $uuid4->toString();
			
					} catch (UnsatisfiedDependencyException $e) {
						//  echo 'Caught exception: ' . $e->getMessage() . "\n";
					}  
				$user_type = "EMP";
			 
				$add_in['uuid'] = $uuid;
				//$add_in['user_type'] = $user_type;
				$add_in['add_date'] = date("Y-m-d");
				$this->db->insert('user_admin', $add_in);
				$user_admin_id = $this->db->insert_id();
				
			//	$password = md5($password.$email);

				/*$array = array(
					'user_id' => $user_admin_id,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'username' => $email,
					'uuid' => $uuid,
					'user_type' => $user_type,
					'user_status' => $user_status,
					'passphrase' => $password
				);

				$this->db->insert('login_credentials', $array);*/

                $this->session->set_flashdata('success', 'Information added succssfully!');
                redirect($this->controller . '/listall');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $data_info = (isset($_POST))?$_POST:'' ;
		$data['records'] = $data_info;  
        $this->load->view('administration_adddata', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function delete_data($uuid = 0)
    {

        $uuid = filter_var($uuid, FILTER_SANITIZE_STRING);

		$chkUserInfo = $this->common->getSingleInfoBy("user_admin",'uuid',$uuid);;

        if (sizeof($chkUserInfo)>0) {
            $sql = "update user_admin set user_status='Delete'   where uuid='" . $uuid . "' ";
            $this->db->query($sql);
            //$sql = "update  login_credentials set delete_status=1    where uuid='" . $uuid . "' ";
            //$this->db->query($sql);
            $this->session->set_flashdata('success', 'Deleted succssfully..');
        } else {
            $this->session->set_flashdata('warning', 'You don\'t have persmission to delete this');
        }

        redirect($this->controller . '/listall','refresh');
    }
 
}
