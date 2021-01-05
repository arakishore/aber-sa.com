<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
public $db;
public $ctrl_name = 'pages';
public $tbl_name = 'site_cms_master';
public $pg_title = 'Pages';
public $m_act = 11;
public $s_act = 11;

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
        $this->list_all();
    }		
		
	public function list_all(){
		$data['msg'] = '';
		$error = '';
		$data['l_s_act'] = 1;

		$where_cond = " WHERE cms_parent_id= 0 ORDER BY cms_sort ";
		$data['sel_rs'] = $sel_rs = $this->common->getAllRow($this->tbl_name,$where_cond);
			 
		///$this->load->view('include/header');
		$this->load->view('pages_list',$data);		
	}	

	function setting(){}
		

	function edit_att($id=1){
		$data['msg'] = '';
		$data['id'] = $id;
		$error = '';
		$data['l_s_act'] = 11;
		
		$where_edt = "cms_id = $id";
		$where_fetch = "WHERE cms_id=".$id;

		 if(isset($_POST['mode_edt'])=="edit_att"){

					$add_in['cms_title'] = $cms_title = $this->common->mysql_safe_string($_POST['cms_title']);	
					$add_in['cms_desc'] = $cms_desc = addslashes($_POST['cms_desc']);
					$add_in['cms_desc_more'] = $cms_desc_more = addslashes($_POST['cms_desc_more']);

					//$add_in['cms_desc_en'] = $cms_desc_en = addslashes($_POST['cms_desc_en']);
					//$add_in['cms_desc_more_en'] = $cms_desc_more_en = addslashes($_POST['cms_desc_more_en']);
					
					//$add_in['cms_alt_title'] = $cms_alt_title = $this->common->mysql_safe_string($_POST['cms_alt_title']);	
					//$add_in['cms_alt_title_en'] = $cms_alt_title_en = $this->common->mysql_safe_string($_POST['cms_alt_title_en']);	

					if(isset($_FILES['cms_image'])){

						if ($_FILES['cms_image']['name']!=""){
								$pusti = $this->common->gen_key(10);
								$extension=strstr($_FILES['cms_image']['name'],".");
								$thumbpath = $_FILES['cms_image']['name'];
								$thumbpath = preg_replace("/[^a-zA-Z0-9.]/", "", $thumbpath);
								copy($_FILES['cms_image']['tmp_name'],"../uploads/para_images/".$pusti.$thumbpath);
								$add_in['cms_image'] = $pusti.$thumbpath;
						}
					}
					
					/*if(isset($_FILES['cms_image_en'])){
						if ($_FILES['cms_image_en']['name']!=""){
								$pusti = $this->common->gen_key(10);
								$extension=strstr($_FILES['cms_image_en']['name'],".");
								$thumbpath = $_FILES['cms_image_en']['name'];
								$thumbpath = preg_replace("/[^a-zA-Z0-9.]/", "", $thumbpath);
								copy($_FILES['cms_image_en']['tmp_name'],"./uploads/para_images/".$pusti.$thumbpath);
								$add_in['cms_image_en'] = $pusti.$thumbpath;
						}
					}*/	
					
					//die();				
					
					if ($error=='') {		
						$update_status=$this->common->updateRecord($this->tbl_name,$add_in,$where_edt);

						$data['msg'] = 'success';
						redirect($this->ctrl_name.'/list_all');
					} else {
						$data['msg'] = $error;
					}
		}

			$where_cond = "where cms_id=".$id;
			$data['sel_rs'] = $sel_rs = $this->common->getOneRow($this->tbl_name,$where_cond);
		
			//$this->load->view('include/header');
			$this->load->view('edt_pages',$data);
	}
	
	
		
}

