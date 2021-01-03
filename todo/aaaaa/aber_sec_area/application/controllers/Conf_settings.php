<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf_settings extends CI_Controller {
public $db;
public $ctrl_name = 'conf_settings';
public $tbl_name = 'site_jobs';
public $pg_title = 'Jobs';
public $m_act = 66;
public $s_act = 66;

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
	
	public function list_all(){
		$data['msg'] = '';
		$error = '';
		$data['heading'] = 'Flavours List';
		$data['l_s_act'] = 663;
		$fr_where = '';
		
		$sSql = "select * FROM setting WHERE editable=1 ORDER BY setting_id ";
		
		$query = $this->db->query($sSql);
		$row = $query->result_array(); 
		$data['sel_rs'] = $row;

		//$this->load->view('include/header');
		$this->load->view('settings_list',$data);		
	}
	
	function edit_setting($id=1){
		$data['msg'] = '';
		$data['id'] = $id;
		$error = '';
		$data['l_s_act'] = 663;
		
		$where_edt = "setting_id = $id";
		$where_fetch = "WHERE setting_id=".$id;

		 if(isset($_POST['mode_edt'])=="edit_att"){
			 
					$add_in['value'] = $value = $this->common->mysql_safe_string($_POST['value']);
					
					if ($error=='') {		
						$update_status=$this->common->updateRecord('setting',$add_in,$where_edt);
						$data['msg'] = 'success';
						redirect($this->ctrl_name.'/list_all');
					} else {
						$data['msg'] = $error;
					}
		}

			$where_cond = "where setting_id=".$id;
			$data['sel_rs'] = $sel_rs = $this->common->getOneRow('setting',$where_cond);
		
			//$this->load->view('include/header');
			$this->load->view('edit_setting',$data);
	}
	
	public function commission_list(){
		$data['msg'] = '';
		$error = '';
		$data['heading'] = 'Flavours List';
		$data['l_s_act'] = 9992;
		$fr_where = '';
		
		$sSql = "select * FROM referal_comission_master ORDER BY id ";
		
		$query = $this->db->query($sSql);
		$row = $query->result_array(); 
		$data['sel_rs'] = $row;

		$this->load->view('include/header');
		$this->load->view('commission_list',$data);		
	}	
	
	
	function add_range($id=1){
		$data['msg'] = '';
		$data['id'] = $id;
		$error = '';
		$data['l_s_act'] = 3333;
		
		$where_edt = "events_id = $id";
		$where_fetch = "WHERE events_id=".$id;

		 if(isset($_POST['mode_edt'])=="add_att"){
			 
					$add_in['count_from'] = $count_from = $this->common->mysql_safe_string($_POST['count_from']);
					$add_in['count_to'] = $count_to = $this->common->mysql_safe_string($_POST['count_to']);
					$add_in['refrer_dis_per'] = $refrer_dis_per = $this->common->mysql_safe_string($_POST['refrer_dis_per']);
					$add_in['refrered_dis_amount'] = $refrered_dis_amount = $this->common->mysql_safe_string($_POST['refrered_dis_amount']);
					
					if ($error=='') {		
						$this->common->insertRecord('referal_comission_master',$add_in);
						$data['msg'] = 'success';
						redirect($this->ctrl_name.'/commission_list');
					} else {
						$data['msg'] = $error;
					}
		}

			$this->load->view('include/header');
			$this->load->view('add_range',$data);
	}	
		
	
	function edit_range($id=1){
		$data['msg'] = '';
		$data['id'] = $id;
		$error = '';
		$data['l_s_act'] = 3334;
		
		$where_edt = "id = $id";
		$where_fetch = "WHERE id=".$id;

		 if(isset($_POST['mode_edt'])=="edit_att"){
			 
					$add_in['count_from'] = $count_from = $this->common->mysql_safe_string($_POST['count_from']);
					$add_in['count_to'] = $count_to = $this->common->mysql_safe_string($_POST['count_to']);
					$add_in['refrer_dis_per'] = $refrer_dis_per = $this->common->mysql_safe_string($_POST['refrer_dis_per']);
					$add_in['refrered_dis_amount'] = $refrered_dis_amount = $this->common->mysql_safe_string($_POST['refrered_dis_amount']);

					
					if ($error=='') {		
						$update_status=$this->common->updateRecord('referal_comission_master',$add_in,$where_edt);
						$data['msg'] = 'success';
						redirect($this->ctrl_name.'/commission_list/');
					} else {
						$data['msg'] = $error;
					}
		}

			$where_cond = "where id=".$id;
			$data['sel_rs'] = $sel_rs = $this->common->getOneRow('referal_comission_master',$where_cond);

			$this->load->view('include/header');
			$this->load->view('edit_range',$data);
	}		
	
	function delete_range($id=0){
			$this->common->deleteRecord('referal_comission_master',"id ='".$id."'");
		 	redirect($this->ctrl_name.'/commission_list');
	}		
}

