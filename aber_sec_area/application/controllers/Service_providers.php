<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Service_providers extends CI_Controller
{
    public $db;
    public $ctrl_name = 'service_providers';
    public $tbl_name = 'user_master_front';
    public $tbl_name_one = 'assets_master';
    public $pg_title = 'Service Provider';
    public $m_act = 4;

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

    public function index()
    {
        $this->listall(0, '');
    }

    public function listall($start = 0, $otherparam = "")
    {

        $data['l_s_act'] = 2;

        $data['title'] = 'Customers List';
        $data['start'] = $start;
        $data['maxm'] = $maxm = 100;
        $data['sub_heading'] = 'Service Provider List';
        $fun_name = $this->ctrl_name . '/listall';
        $data['fun_name'] = $fun_name;
        $data['controller'] = $this->ctrl_name;

        $limit_qry = " LIMIT " . $start . "," . $maxm;

        $data['other_para'] = "";

        $data['msg'] = '';
        $error = '';

        $search_qry = " WHERE um.status_flag in ('Active','Inactive')  and user_type='Service Provider'  and um.parent_id=0   ";
// inner join user_master_front um on o.customer_id = um.user_id
        $sSql = "SELECT um.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `user_master_front` um
         left join master_province mp on um.state_id = mp.id
		 left join master_city md on um.district_id = md.id 
         WHERE um.status_flag in ('Active','Inactive')  and user_type='Service Provider'  and um.parent_id=0
         ORDER BY um.user_id DESC";
        $query = $sSql . " " . $limit_qry;
        $query = $this->db->query($query);
        $data['results'] = $query->result_array();

        $sql = "select count('')  as numrows  from
        `user_master_front` um
         left join master_province mp on um.state_id = mp.id
		 left join master_city md on um.district_id = md.id
        $search_qry        ORDER BY um.user_id DESC";
        $query = $this->db->query($sql);
        $resultdata = $query->row_array();
        $data['num_row'] = $resultdata['numrows']; //= $this->common->numRow($this->tablename,$where_cond);

        $this->load->view('service_providers_list', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function view_service_provider($id = 1)
    {
        $data['msg'] = '';
        $data['id'] = $id;
        $data['l_s_act'] = 2;
        $data['sub_heading'] = 'View Service Provider';
        $data['controller'] = $this->ctrl_name;
        $error = '';
        $data['tab'] = (isset($_GET['tab'])) ? filter_var($_GET['tab'], FILTER_SANITIZE_STRING) : 1;
        $where_edt = "user_id = $id";

        if (isset($_POST['mode_pop']) && $_POST['mode_pop'] == "addchildpoup") {
            $add_in['status'] =  'Active';
           
            $add_in['first_name'] = $first_name = (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['last_name'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['email'] = $email = (isset($_POST['email'])) ? $this->common->mysql_safe_string($_POST['email']) : '';
            $add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';
            $add_in['passphrase'] = $passphrase = (isset($_POST['passphrase'])) ? $this->common->mysql_safe_string($_POST['passphrase']) : '';
		 
            if ($first_name == '') {$error .= "Please enter first name<br>";}
            if ($last_name == '') {$error .= "Please enter last name<br>";}
            if ($mobile == '') {$error .= "Please enter mobile<br>";}
            if ($passphrase == '') {$error .= "Please enter password<br>";}

            if ($error == '') {
                $add_in['parent_id'] = $id;
                $add_in['user_type'] = 'CUST';
                $add_in['business_type'] = 'Branch';
                $this->common->insertRecord($this->tbl_name,$add_in);
                  
                $this->session->set_flashdata('success', 'Information added succssfully!');
                $data['msg'] = 'success';
                redirect($this->ctrl_name . '/view_customer/' . $id . "?tab=2");
                $this->session->set_flashdata('error', $error);
            } else {
                $data['msg'] = $error;
            }
        }

        if (isset($_POST['mode_pop']) && $_POST['mode_pop'] == "frmUpdateData") {
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
           
           
			$childid = (isset($_POST['childid'])) ? $this->common->mysql_safe_string($_POST['childid']) : '';
			if ($childid == '') {$error .= "Please select child user<br>";}

            if ($error == '') {
				$where_edt = "user_id = '" . $childid . "'";
                $update_status = $this->common->updateRecord($this->tbl_name, $add_in, $where_edt);
                $this->session->set_flashdata('success', 'Information updated succssfully!');
                $data['msg'] = 'success';
                redirect($this->ctrl_name . '/view_customer/' . $id . "?tab=2");
                $this->session->set_flashdata('error', $error);
            } else {
                $data['msg'] = $error;
            }
        }
        if (isset($_POST['mode_pop']) && $_POST['mode_pop'] == "frmChangePassword") {
            $login_password = (isset($_POST['login_password'])) ? $this->common->mysql_safe_string($_POST['login_password']) : '';
            $childid = (isset($_POST['childid'])) ? $this->common->mysql_safe_string($_POST['childid']) : '';

            if ($login_password == '') {$error .= "Please enter password<br>";}
            if ($childid == '') {$error .= "Please select child user<br>";}
            if ($error == '') {
                $passphrase = $login_password;
                $array = array(
                    'passphrase' => $passphrase,
                );
                $where_edt = "user_id = '" . $childid . "'";
                $update_status = $this->common->updateRecord($this->tbl_name, $array, $where_edt);
                $this->session->set_flashdata('success', 'Information updated succssfully..');
                redirect($this->ctrl_name . '/view_customer/' . $id . "?tab=2");
            }
        }
       
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
            $add_in['business_type'] = $business_type = (isset($_POST['business_type'])) ? $this->common->mysql_safe_string($_POST['business_type']) : 'General';
            $add_in['enterprise_name'] = $enterprise_name = (isset($_POST['enterprise_name'])) ? $this->common->mysql_safe_string($_POST['enterprise_name']) : '';
            $add_in['bo_ice_id'] = $bo_ice_id = (isset($_POST['bo_ice_id'])) ? $this->common->mysql_safe_string($_POST['bo_ice_id']) : '';
            $add_in['user_language'] = $user_language = (isset($_POST['user_language'])) ? $this->common->mysql_safe_string($_POST['user_language']) : 'EN';
            $add_in['push_notification'] = $push_notification = (isset($_POST['push_notification'])) ? $this->common->mysql_safe_string($_POST['push_notification']) : '1';
            $add_in['credit_limit_status'] = $credit_limit_status = (isset($_POST['credit_limit_status'])) ? $this->common->mysql_safe_string($_POST['credit_limit_status']) : 'Active';
            $add_in['credit_limit'] = $credit_limit = (isset($_POST['credit_limit'])) ? $this->common->mysql_safe_string($_POST['credit_limit']) : '0';
            
            if ($error == '') {
                $update_status = $this->common->updateRecord($this->tbl_name, $add_in, $where_edt);
                $this->session->set_flashdata('success', 'Information updated succssfully!');
                $data['msg'] = 'success';
                redirect($this->ctrl_name . '/view_customer/' . $id . "?tab=1");
                $this->session->set_flashdata('error', $error);
            } else {
                $data['msg'] = $error;
            }
        }
		if (isset($_POST['mode']) && $_POST['mode'] == "edit_content_password") {
            $login_password = $this->common->mysql_safe_string($_POST['login_password']);

            if ($login_password == '') {$error .= "Please enter password<br>";}
            if ($error == '') {
                $passphrase = $login_password;
                $array = array(
                    'passphrase' => $passphrase,
                );

                $update_status = $this->common->updateRecord($this->tbl_name, $array, $where_edt);
                $this->session->set_flashdata('success', 'Information updated succssfully..');
                redirect($this->ctrl_name . '/view_customer/' . $id . "?tab=1");
            }
        }
        //$where_cond = "where user_id=".$id;
        //$data['records'] = $records = $this->common->getOneRow($this->tbl_name,$where_cond);

        $search_qry = " WHERE um.status_flag in ('Active','Inactive')  and user_type='Service Provider'  and user_id='" . $id . "'   ";
        // inner join user_master_front um on o.customer_id = um.user_id
        $sSql = "SELECT um.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `user_master_front` um
		left join master_province mp on um.state_id = mp.id
		left join master_city md on um.district_id = md.id $search_qry  ORDER BY um.user_id DESC";
        $query = $this->db->query($sSql);
        $data['records'] = $query->row_array();

        $sSql = "SELECT csa.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `customer_shipping_address` csa
		left join master_province mp on csa.state_id = mp.id
		left join master_city md on csa.district_id = md.id  where user_id='" . $id . "'   ORDER BY csa.is_default DESC";
        $query = $this->db->query($sSql);
        $data['customer_shipping_address'] = $query->result_array();

// inner join user_master_front um on o.customer_id = um.user_id
        $sSql = "SELECT um.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `user_master_front` um
			left join master_province mp on um.state_id = mp.id
			left join master_city md on um.district_id = md.id  WHERE um.status_flag in ('Active','Inactive')  and user_type='Driver'  and um.parent_id='" . $id . "'   ORDER BY um.user_id DESC";

        $query = $this->db->query($sSql);
        $result = $query->result_array();
		$child_user = [];
		$child_user_id = [];
        foreach ($result as $key => $value) {
			$child_user[$value['user_id']] = $value;
			$child_user_id[] = $value['user_id'];

        }
		$data['child_user'] = $child_user;
		$child_user_id_exp = $id;
		if(sizeof($child_user)>0){
		$child_user_id_exp = $id.",". implode(",",$child_user_id);
		}
		// inner join user_master_front um on o.customer_id = um.user_id
		

	  
        $data['start'] = 0;
        $data['maxm'] = $maxm = 50;
       
        if ( isset( $_GET['page'] ) && $_GET['page'] != '' ) {
            $page = filter_var( $_GET['page'], FILTER_SANITIZE_STRING );
            
            $data['page'] = $page;
            
            
        } //isset( $_GET['page'] ) && $_GET['page'] != ''
        else {
            $page         = 0;
            $data['page'] = 0;
            
        }
        $start_temp = ( ( $page == 0 ) ? 0 : $page - 1 );
        $start      = $start_temp * $maxm;
		
        if ( $start < 0 )
            $start = 0;
        
		$data['start'] = $page;
	 
		$fun_name = $this->ctrl_name ."/view_customer/".$id;
		$data['other_para'] = "tab=3";
		
		$data['fun_name'] = $fun_name . "?" . $data['other_para'];



        $this->load->view('view_service_provider', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');

    }
}
