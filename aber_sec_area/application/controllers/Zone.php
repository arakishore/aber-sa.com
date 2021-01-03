<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zone extends CI_Controller {
public $db;
public $ctrl_name = 'zone';
public $tbl_name = 'master_city';
public $tbl_name_one = 'master_zone';
public $pg_title = 'City';
public $m_act = 3;


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
		
    public function index(){
        $this->listall();
    }
	
	public function listall(){
		$data['msg'] = '';
		$error = '';
		$data['l_s_act'] = 1;
		 
		 
		 
        $data['title'] = 'City';
        
        $data['sub_heading'] = 'City List';

        $search_qry = " WHERE  status in ('Active','Inactive')   order by added_date desc  ";

        $data['results'] = $this->common->getRecordsLimit($this->tbl_name, $search_qry, 0, 0);

        $data['controller'] = $this->ctrl_name;

        $this->load->view('zone_city_list', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
	}	
	
	public function province(){
		$data['msg'] = '';
		$error = '';
		$data['l_s_act'] = 4;
        $data['title'] = 'States';
        $data['sub_heading'] = 'States List';

        $search_qry = " WHERE  status in ('Active','Inactive')   order by added_date desc  ";
        $data['results'] = $this->common->getRecordsLimit('master_province', $search_qry, 0, 0);
        $data['controller'] = $this->ctrl_name;
		
        $this->load->view('province_list', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
	}	
	//
	
	public function addProvince(){

        $session_user_data = $this->session->userdata('user_data');
        $data['l_s_act'] = 4;
		 
        $data['title'] = 'States';
        $data['sub_heading'] = 'Add New';
        $data['controller'] = $this->ctrl_name;
        $data['fun'] = "addCity";
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
			$add_in['name_en'] = $name_en = (isset($_POST['name_en'])) ? $this->common->mysql_safe_string($_POST['name_en']) : '';
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';

            if ($name == '') {
                $error .= "Please enter province name<br>";
            }
            
            if ($status == '') {
                $error .= "Please select status<br>";
            }
            $search_qry = "  name ='".$name."' and status in ('Active','Inactive')    ";
            $chkInfo = $this->common->getRecord('master_province',$search_qry,'name');
           //    $chkInfo = $this->common->getSingleInfoBy('master_province','name',$name);
            if(sizeof($chkInfo)>0){
            	$error = "$name  is already registered";
            }    

            if ($error == '') {
                 
                $add_in['added_date'] = date("Y-m-d");
                $add_in['edit_date'] = date("Y-m-d");
                $add_in['added_by_userid'] = $session_user_data['user_id'];
                $add_in['edit_by_userid'] = $session_user_data['user_id'];

                $this->db->insert('master_province', $add_in);
				   
				
                $this->session->set_flashdata('success', 'Information added succssfully!');
                redirect($this->ctrl_name . '/province');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $data_info = (isset($_POST)) ? $_POST : '';
        $data['records'] = $data_info;
        $this->load->view('zone_adddprovince', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }


	public function editprovince($duid = 0)
    {

		$session_user_data = $this->session->userdata('user_data');
        $duid = filter_var($duid, FILTER_SANITIZE_STRING);

        $data['l_s_act'] = 4;
		 
        $data['title'] = 'States';
        $data['sub_heading'] = 'Edit';
        $data['controller'] = $this->ctrl_name;
        $data['uuid'] = $duid;
        $error = '';
		 
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

			$add_in = array();
			
            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
			$add_in['name_en'] = $name_en = (isset($_POST['name_en'])) ? $this->common->mysql_safe_string($_POST['name_en']) : '';
			
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';			
           
			$name_old = (isset($_POST['name_old'])) ? $this->common->mysql_safe_string($_POST['name_old']) : '';
			$add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
            if ($name == '') {
                $error .= "Please enter  name<br>";
            }
            

            if ($status == '') {
                $error .= "Please select status<br>";
			}
			if($name_old!=$name){
                //$chkInfo = $this->common->getSingleInfoBy('master_province','name',$name);
                $search_qry = "  name ='".$name."' and status in ('Active','Inactive')    ";
                $chkInfo = $this->common->getRecord('master_province',$search_qry,'name');
				if(sizeof($chkInfo)>0){
					$error = "$name  is already registered";
				}
			}

            if ($error == '') {

                $add_in['edit_date'] = date("Y-m-d");

                $add_in['edit_by_userid'] = $session_user_data['user_id'];

                $this->db->where('id', $duid);
                $this->db->update('master_province', $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
                redirect($this->ctrl_name . '/province');
            } else {
                $this->session->set_flashdata('error', $error);
            }

            $data_info = $_POST;
        } else {

            $data_info = $this->common->getSingleInfoBy('master_province', 'id', $duid, '*');
        }

        //print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select city!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);
        }
        $data['records'] = $data_info;
        $this->load->view('zone_editprovince', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
//district
public function district(){
    $data['msg'] = '';
    $error = '';
    $data['l_s_act'] = 5;
    $data['title'] = 'District';
    $data['sub_heading'] = 'District List';

    $search_qry = " WHERE  status in ('Active','Inactive')   order by added_date desc  ";
    $data['results'] = $this->common->getRecordsLimit('master_city', $search_qry, 0, 0);
    $data['controller'] = $this->ctrl_name;
    
    $this->load->view('district_list', $data);
    $this->session->unset_userdata('success');
    $this->session->unset_userdata('warning');
    $this->session->unset_userdata('error');
}	
//

public function addDistrict($stateid=0){

    $stateid = filter_var($stateid, FILTER_SANITIZE_STRING);
    $session_user_data = $this->session->userdata('user_data');
    $stateInfo = $this->common->getSingleInfoBy('master_province', 'id', $stateid);

    if (sizeof($stateInfo) <= 0) {
        $newdata = array('warning' => 'Please select state!');
        $this->session->set_flashdata($newdata);
        redirect($this->ctrl_name."/province");	
    }
    $data['l_s_act'] = 1;
     
    $data['title'] = 'State-Cities';
    $data['sub_heading'] = 'Add New City in ('.$stateInfo['name_en'].')';
    $data['controller'] = $this->ctrl_name;
    $data['fun'] = "addDistrict";
    $data['stateid'] = $stateid;
    $data['stateInfo'] = $stateInfo;
    $error = '';

    if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

        $add_in = array();
        $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
        $add_in['name_en'] = $name_en = (isset($_POST['name_en'])) ? $this->common->mysql_safe_string($_POST['name_en']) : '';
        $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';

        if ($name == '') {
            $error .= "Please enter district name<br>";
        }
        if ($name_en == '') {
            $error .= "Please enter district name(en)<br>";
        }
        if ($status == '') {
            $error .= "Please select status<br>";
        }
        $search_qry = "  name ='".$name."' and status in ('Active','Inactive')    ";
        $chkInfo = $this->common->getRecord('master_province',$search_qry,'name');
        //   $chkInfo = $this->common->getSingleInfoBy('master_city','name',$name);
        if(sizeof($chkInfo)>0){
            $error = "$name  is already registered";
        }    

        if ($error == '') {
            $add_in['state_id'] = $stateid;
                 
          
            $add_in['added_date'] = date("Y-m-d");
            $add_in['edit_date'] = date("Y-m-d");
            $add_in['added_by_userid'] = $session_user_data['user_id'];
            $add_in['edit_by_userid'] = $session_user_data['user_id'];

            $this->db->insert('master_city', $add_in);
               
            
            $this->session->set_flashdata('success', 'Information added succssfully!');
            redirect($this->ctrl_name . '/addDistrict/'.$stateid);
        } else {
            $this->session->set_flashdata('error', $error);
        }
    }

    $data_info = (isset($_POST)) ? $_POST : '';
    $data['records'] = $data_info;


    $search_qry = " WHERE state_id='".$stateid."' and status in ('Active','Inactive')   order by added_date desc  ";

    $data['results'] = $this->common->getRecordsLimit('master_city', $search_qry, 0, 0);

    
    $this->load->view('zone_adddistrict', $data);

    $this->session->unset_userdata('success');
    $this->session->unset_userdata('warning');
    $this->session->unset_userdata('error');
}


public function editdistrict($stateid = 0,$azid=0)
{

    $session_user_data = $this->session->userdata('user_data');
    $stateid = filter_var($stateid, FILTER_SANITIZE_STRING);
    $azid = filter_var($azid, FILTER_SANITIZE_STRING);

    $stateInfo = $this->common->getSingleInfoBy('master_province', 'id', $stateid);

    if (sizeof($stateInfo) <= 0) {
        $newdata = array('warning' => 'Please select state!');
        $this->session->set_flashdata($newdata);
        redirect($this->ctrl_name."/province");	
    }

    $data['l_s_act'] = 5;
     
    $data['title'] = 'State-Cities';
    $data['sub_heading'] = 'Edit City  in ('.$stateInfo['name_en'].')';
    $data['controller'] = $this->ctrl_name;
    $data['stateid'] = $stateid;
    $error = '';
     
    if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

        $add_in = array();
        $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
        $add_in['name_en'] = $name_en = (isset($_POST['name_en'])) ? $this->common->mysql_safe_string($_POST['name_en']) : '';
       
        $name_old = (isset($_POST['name_old'])) ? $this->common->mysql_safe_string($_POST['name_old']) : '';
        $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
        if ($name == '') {
            $error .= "Please enter  name<br>";
        }
        if ($name_en == '') {
            $error .= "Please enter  name (en)<br>";
        }

        if ($status == '') {
            $error .= "Please select status<br>";
        }
        if($name_old!=$name){
            $search_qry = "  name ='".$name."' and status in ('Active','Inactive')    ";
            $chkInfo = $this->common->getRecord('master_province',$search_qry,'name');
            //$chkInfo = $this->common->getSingleInfoBy('master_city','name',$name);
            if(sizeof($chkInfo)>0){
                $error = "$name  is already registered";
            }
        }

        if ($error == '') {

            $add_in['edit_date'] = date("Y-m-d");

            $add_in['edit_by_userid'] = $session_user_data['user_id'];

            $this->db->where('id', $azid);
            $this->db->where('state_id', $stateid);
            $this->db->update('master_city', $add_in);

            $this->session->set_flashdata('success', 'Information updated succssfully!');
            redirect($this->ctrl_name . '/addDistrict/'.$stateid);
        } else {
            $this->session->set_flashdata('error', $error);
        }

        //$data_info = $_POST;
    }  
    $data_info = $this->common->getSingleInfoBy('master_city', 'id', $azid, '*');
    //print_r($data_info);
    if (sizeof($data_info) == 0) {
        $newdata = array('warning' => 'Please select district!');
        $this->session->set_flashdata($newdata);
        redirect($this->ctrl_name."/addDistrict/".$stateid);
    }
    $data['records'] = $data_info;
    //print_r($data_info);
    $search_qry = " WHERE state_id='".$stateid."' and  status in ('Active','Inactive')  order by added_date desc  ";

    $data['results'] = $this->common->getRecordsLimit('master_city', $search_qry, 0, 0);

    $data['records'] = $data_info;
    $this->load->view('zone_editdistrict', $data);

    $this->session->unset_userdata('success');
    $this->session->unset_userdata('warning');
    $this->session->unset_userdata('error');
}

public function deletedistrict($stateid = 0,$zaid=0)
{
    $session_user_data = $this->session->userdata('user_data');

    $zaid = filter_var($zaid, FILTER_SANITIZE_STRING);
    $stateid = filter_var($stateid, FILTER_SANITIZE_STRING);

    $chkInfo = $this->common->getSingleInfoBy('master_city', 'id', $zaid);

    if (sizeof($chkInfo) > 0) {

        $add_in['edit_date'] = date("Y-m-d h:i:s");
        $add_in['edit_by_userid'] = $session_user_data['user_id'];
        $add_in['status'] = 'Delete';
        $this->db->where('id', $zaid);
        $this->db->where('state_id', $stateid);
        $this->db->update('master_city', $add_in);

        $this->session->set_flashdata('success', 'Deleted succssfully..');
    } else {
        $this->session->set_flashdata('warning', 'You don\'t have persmission to delete this');
    }

    redirect($this->ctrl_name . '/addDistrict/'.$stateid, 'refresh');
}
//end of district			
	/* public function addCity()
    {

        $session_user_data = $this->session->userdata('user_data');

        $data['l_s_act'] = 1;
		 
        $data['title'] = 'City';
        $data['sub_heading'] = 'Add New';
        $data['controller'] = $this->ctrl_name;
        $data['fun'] = "addCity";
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
			$password = $this->common->mysql_safe_string($_POST['password']);
            if ($name == '') {
                $error .= "Please enter city name<br>";
            }
            
            if ($status == '') {
                $error .= "Please select status<br>";
            }

               $chkInfo = $this->common->getSingleInfoBy($this->tbl_name,'name',$name);
            if(sizeof($chkInfo)>0){
            	$error = "$name  is already registered";
            }    

            if ($error == '') {
                

                 
                $add_in['added_date'] = date("Y-m-d");
                $add_in['edit_date'] = date("Y-m-d");
                $add_in['added_by_userid'] = $session_user_data['user_id'];
                $add_in['edit_by_userid'] = $session_user_data['user_id'];

                $this->db->insert($this->tbl_name, $add_in);
				   
				
                $this->session->set_flashdata('success', 'Information added succssfully!');
                redirect($this->ctrl_name . '/listall');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $data_info = (isset($_POST)) ? $_POST : '';
        $data['records'] = $data_info;
        $this->load->view('zone_adddcity', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
	public function editcity($duid = 0)
    {

		$session_user_data = $this->session->userdata('user_data');
        $duid = filter_var($duid, FILTER_SANITIZE_STRING);

        $data['l_s_act'] = 1;
		 
        $data['title'] = 'Drivers';
        $data['sub_heading'] = 'Edit';
        $data['controller'] = $this->ctrl_name;
        $data['uuid'] = $duid;
        $error = '';
		 
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

			$add_in = array();
            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
           
			$name_old = (isset($_POST['name_old'])) ? $this->common->mysql_safe_string($_POST['name_old']) : '';
			$add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
            if ($name == '') {
                $error .= "Please enter  name<br>";
            }
            

            if ($status == '') {
                $error .= "Please select status<br>";
			}
			if($name_old!=$name){
				$chkInfo = $this->common->getSingleInfoBy($this->tbl_name,'name',$name);
				if(sizeof($chkInfo)>0){
					$error = "$name  is already registered";
				}
			}

            if ($error == '') {

                $add_in['edit_date'] = date("Y-m-d");

                $add_in['edit_by_userid'] = $session_user_data['user_id'];

                $this->db->where('id', $duid);
                $this->db->update($this->tbl_name, $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
                redirect($this->ctrl_name . '/listall');
            } else {
                $this->session->set_flashdata('error', $error);
            }

            $data_info = $_POST;
        } else {

            $data_info = $this->common->getSingleInfoBy($this->tbl_name, 'id', $duid, '*');
        }

        //print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select city!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);
        }
        $data['records'] = $data_info;
        $this->load->view('zone_editcity', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    public function deletecity($duid = 0)
    {
        $session_user_data = $this->session->userdata('user_data');

        $duid = filter_var($duid, FILTER_SANITIZE_STRING);

        $chkInfo = $this->common->getSingleInfoBy($this->tbl_name, 'id', $duid);

        if (sizeof($chkInfo) > 0) {

            $add_in['edit_date'] = date("Y-m-d h:i:s");
            $add_in['edit_by_userid'] = $session_user_data['user_id'];
            $add_in['status'] = 'Delete';
            $this->db->where('id', $duid);
            $this->db->update($this->tbl_name, $add_in);

            $this->session->set_flashdata('success', 'Deleted succssfully..');
        } else {
            $this->session->set_flashdata('warning', 'You don\'t have persmission to delete this');
        }

        redirect($this->ctrl_name . '/listall', 'refresh');
	} */
	public function addzonearea($cityid=0)
    {
		$cityid = filter_var($cityid, FILTER_SANITIZE_STRING);
        $session_user_data = $this->session->userdata('user_data');
		$cityInfo = $this->common->getSingleInfoBy($this->tbl_name, 'id', $cityid);

        if (sizeof($cityInfo) <= 0) {
			$newdata = array('warning' => 'Please select city!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);	
		}
        $data['l_s_act'] = 1;
		 
        $data['title'] = 'City-Zone area';
        $data['sub_heading'] = 'Add New zone area in ('.$cityInfo['name'].')';
        $data['controller'] = $this->ctrl_name;
		$data['fun'] = "addzonearea";
		$data['cityid'] = $cityid;
		$data['cityInfo'] = $cityInfo;
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
			$password = $this->common->mysql_safe_string($_POST['password']);
            if ($name == '') {
                $error .= "Please enter  name<br>";
            }
            
            if ($status == '') {
                $error .= "Please select status<br>";
            }

               $addzoneareaInfo = $this->common->getSingleInfoBy($this->tbl_name_one,'name',$name);
            if(sizeof($addzoneareaInfo)>0){
            	$error = "$name  is already registered";
            }    

            if ($error == '') {
                
				$add_in['city_id'] = $cityid;
                 
                $add_in['added_date'] = date("Y-m-d");
                $add_in['edit_date'] = date("Y-m-d");
                $add_in['added_by_userid'] = $session_user_data['user_id'];
                $add_in['edit_by_userid'] = $session_user_data['user_id'];

                $this->db->insert($this->tbl_name_one, $add_in);
				   
				
                $this->session->set_flashdata('success', 'Information added succssfully!');
                redirect($this->ctrl_name . '/addzonearea/'.$cityid);
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $data_info = (isset($_POST)) ? $_POST : '';
		$data['records'] = $data_info;
		
		$search_qry = " WHERE city_id='".$cityid."' and status in ('Active','Inactive')   order by added_date desc  ";

        $data['results'] = $this->common->getRecordsLimit($this->tbl_name_one, $search_qry, 0, 0);

        $this->load->view('zone_addzonearea', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
	public function editzonearea($cityid = 0,$azid=0)
    {

		$session_user_data = $this->session->userdata('user_data');
		$cityid = filter_var($cityid, FILTER_SANITIZE_STRING);
		$azid = filter_var($azid, FILTER_SANITIZE_STRING);

        $data['l_s_act'] = 1;
		 
        $data['title'] = 'City-Zone area';
        $data['sub_heading'] = 'Edit';
        $data['controller'] = $this->ctrl_name;
        $data['cityid'] = $cityid;
        $error = '';
		 
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

			$add_in = array();
            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
           
			$name_old = (isset($_POST['name_old'])) ? $this->common->mysql_safe_string($_POST['name_old']) : '';
			$add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
            if ($name == '') {
                $error .= "Please enter  name<br>";
            }
            

            if ($status == '') {
                $error .= "Please select status<br>";
			}
			if($name_old!=$name){
				$chkInfo = $this->common->getSingleInfoBy($this->tbl_name_one,'name',$name);
				if(sizeof($chkInfo)>0){
					$error = "$name  is already registered";
				}
			}

            if ($error == '') {

                $add_in['edit_date'] = date("Y-m-d");

                $add_in['edit_by_userid'] = $session_user_data['user_id'];

				$this->db->where('id', $azid);
				$this->db->where('city_id', $cityid);
                $this->db->update($this->tbl_name_one, $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
				redirect($this->ctrl_name . '/addzonearea/'.$cityid);
            } else {
                $this->session->set_flashdata('error', $error);
            }

            //$data_info = $_POST;
        }  
        $data_info = $this->common->getSingleInfoBy($this->tbl_name_one, 'id', $azid, '*');
        //print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select city!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);
        }
		$data['records'] = $data_info;
		//print_r($data_info);
		$search_qry = " WHERE city_id='".$cityid."' and  status in ('Active','Inactive')  order by added_date desc  ";

        $data['results'] = $this->common->getRecordsLimit($this->tbl_name_one, $search_qry, 0, 0);


        $this->load->view('zone_editzonearea', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    public function deletezonearea($cityid = 0,$zaid=0)
    {
        $session_user_data = $this->session->userdata('user_data');

		$zaid = filter_var($zaid, FILTER_SANITIZE_STRING);
		$cityid = filter_var($cityid, FILTER_SANITIZE_STRING);

        $chkInfo = $this->common->getSingleInfoBy($this->tbl_name_one, 'id', $zaid);

        if (sizeof($chkInfo) > 0) {

            $add_in['edit_date'] = date("Y-m-d h:i:s");
            $add_in['edit_by_userid'] = $session_user_data['user_id'];
            $add_in['status'] = 'Delete';
			$this->db->where('id', $zaid);
			$this->db->where('city_id', $cityid);
            $this->db->update($this->tbl_name_one, $add_in);

            $this->session->set_flashdata('success', 'Deleted succssfully..');
        } else {
            $this->session->set_flashdata('warning', 'You don\'t have persmission to delete this');
        }

        redirect($this->ctrl_name . '/addzonearea/'.$cityid, 'refresh');
	}
	public function zonearea()
    {
	 
        $session_user_data = $this->session->userdata('user_data');
        $data['l_s_act'] = 2;
		 
        $data['title'] = 'City-Zone area';
        $data['sub_heading'] = 'List';
        $data['controller'] = $this->ctrl_name;
		$data['fun'] = "addzonearea";
		 
        $error = '';

        
		
	 	$search_qry = "select c.name as city_name, c.id as city_id, za.name as area_name,za.id as area_id,za.status,za.added_date from master_city c, master_zone za where c.id=za.city_id and za.status in ('Active','Inactive') ";
 
		$result = $this->db->query($search_qry);
        $data['results'] =  $result->result_array();

        $this->load->view('zone_zonearea', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
}