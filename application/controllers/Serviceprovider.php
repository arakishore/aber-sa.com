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

    public function index()
    {
        $data['l_s_act'] = 1;
        $data['controller'] = $this->controller;

        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        /// TOTAL ORDER COUNT /////////////////////

        $sSql = "SELECT rq.*  FROM lt_requests rq , lt_request_quotes qt
				WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "' AND
				qt.quote_seeker_approval=1
				ORDER BY rq.request_id DESC";
        $query = $this->db->query($sSql);
        //die();
        $data['total_orders'] = $total_orders = $query->num_rows();

        $sSql = "SELECT SUM(qt.quote_amount) as total_reve  FROM lt_requests rq , lt_request_quotes qt
				WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "' AND
				qt.quote_seeker_approval=1
				ORDER BY rq.request_id DESC";
        $query = $this->db->query($sSql);
        $data['total_revenue'] = $total_revenue = $query->row_array();

        $sSql = "SELECT rq.*  FROM lt_requests rq , lt_request_quotes qt
				WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "'
				AND qt.quote_seeker_approval=1 AND
				rq.status_flag='Active' ORDER BY rq.request_id DESC";

        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->result_array();

        $this->load->view("serviceprovider", $data);
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

    public function my_shipment()
    {
        $data['l_s_act'] = 3;
        $data['l_s_act_in'] = 1;
        $data['controller'] = $this->controller;

        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $sSql = "SELECT rq.*  FROM lt_requests rq , lt_request_quotes qt
				WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "'
				AND qt.quote_seeker_approval=1 AND
				rq.status_flag='Active' ORDER BY rq.request_id DESC";

        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->result_array();

        $this->load->view("my_shipment", $data);
    }

    public function my_requests()
    {
        $data['l_s_act'] = 3;
        $data['l_s_act_in'] = 2;
        $data['controller'] = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $sSql = "SELECT rq.*  FROM lt_requests rq , lt_request_quotes qt
				WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "'
				AND rq.request_status='Requested' AND qt.quote_seeker_approval=0 AND
				rq.status_flag='Active' ORDER BY rq.request_id DESC";

        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->result_array();

        $this->load->view("my_requests", $data);
    }

    public function review()
    {
        $data['l_s_act'] = 4;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $sSql = "SELECT us.first_name, us.last_name, us.profile_pic, rq.service_pro_overall, rq.service_pro_ratings,  rq.service_pro_review,rq.request_title, rq.insert_date
FROM user_master_front us
 
left join lt_requests rq on qt.request_id = rq.request_id
WHERE rq.service_provider_id='" . $id . "'   ORDER BY qt.request_quote_id";
        $query = $this->db->query($sSql);
        $data['reviews'] = $reviews = $query->result_array();

        $this->load->view("review", $data);
    }

    public function my_drivers()
    {
        $data['l_s_act'] = 5;

        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $sSql = "SELECT um.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `user_master_front` um
			left join master_province mp on um.state_id = mp.id
			left join master_city md on um.district_id = md.id  WHERE um.status_flag in ('Active','Inactive')  and user_type='Driver'  and um.parent_id='" . $id . "'   ORDER BY um.user_id DESC";

        $query = $this->db->query($sSql);
        $data['my_drivers'] = $my_drivers = $query->result_array();
        $this->load->view("my_drivers", $data);
    }

    public function driver_signup()
    {
        $data['l_s_act'] = 5;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        if (isset($_POST['mode_add']) && $_POST['mode_add'] == "adddriver") {

            $add_in = array();
            $add_in['first_name'] = $first_name = (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['last_name'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';
            $add_in['email'] = $email = (isset($_POST['email'])) ? $this->common->mysql_safe_string($_POST['email']) : '';
            $add_in['status_flag'] = $status_flag = (isset($_POST['status_flag'])) ? $this->common->mysql_safe_string($_POST['status_flag']) : '';
            $add_in['parent_id'] = $id;
            $add_in['user_type'] = 'Driver';
            $add_in['passphrase'] = $password = (isset($_POST['password'])) ? $this->common->mysql_safe_string($_POST['password']) : '';
            $cpassword = (isset($_POST['cpassword'])) ? $this->common->mysql_safe_string($_POST['cpassword']) : '';

            $add_in_add['address_name'] = $address_name = (isset($_POST['address_name'])) ? $this->common->mysql_safe_string($_POST['address_name']) : '';
            $add_in_add['city_id'] = $city_id = (isset($_POST['city_id'])) ? $this->common->mysql_safe_string($_POST['city_id']) : '';
            $add_in_add['state_id'] = $state_id = (isset($_POST['state_id'])) ? $this->common->mysql_safe_string($_POST['state_id']) : '';
            $add_in_add['postcode'] = $postcode = (isset($_POST['postcode'])) ? $this->common->mysql_safe_string($_POST['postcode']) : '';

            if ($first_name == '') {$error .= "Please enter first name<br>";}
            if ($last_name == '') {$error .= "Please enter last name<br>";}
            if ($mobile == '') {$error .= "Please enter phone number<br>";}
            if ($email == '') {$error .= "Please enter email address<br>";}
            if ($password == '') {$error .= "Please enter password<br>";}
            if ($cpassword == '') {$error .= "Please enter confirm password<br>";}

            if ($password != $cpassword) {
                $error .= "Password and confirm password are not same.";
            }

            $chkShipInfo = $this->common->getSingleInfoBy('user_master_front', 'email', $email, 'email');
            if (sizeof($chkShipInfo) > 0) {
                $error .= $email . " Already exist. Please enter another emailaddress<br>";
            }

            if ($error == '') {
                if (isset($_FILES['id_proof'])) {
                    if ($_FILES['id_proof']['name'] != "") {
                        $pusti = $this->common->gen_key(10);
                        $extension = strstr($_FILES['id_proof']['name'], ".");
                        $thumbpath = $_FILES['id_proof']['name'];
                        $thumbpath = preg_replace("/[^a-zA-Z0-9.]/", "", $thumbpath);
                        copy($_FILES['id_proof']['tmp_name'], "./uploads/id_proof/" . $pusti . $thumbpath);
                        $add_in['id_proof'] = $pusti . $thumbpath;
                    }
                }

                $this->common->insertRecord('user_master_front', $add_in);
                $insert_id = $this->db->insert_id();

                $add_in_add['user_id'] = $insert_id;
                $this->common->insertRecord('customer_shipping_address', $add_in_add);

                $this->session->set_flashdata('success', 'Driver profile has been added succssfully!');
                redirect($this->controller . '/my_drivers');
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $this->load->view("driver_signup", $data);
    }

    public function edit_driver($user_id = 0)
    {
        $data['l_s_act'] = 5;
        $data['user_id'] = $user_id;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        if (isset($_POST['mode']) && $_POST['mode'] == "updatedriver") {

            $add_in = array();
            $add_in['first_name'] = $first_name = (isset($_POST['first_name'])) ? $this->common->mysql_safe_string($_POST['first_name']) : '';
            $add_in['last_name'] = $last_name = (isset($_POST['last_name'])) ? $this->common->mysql_safe_string($_POST['last_name']) : '';
            $add_in['mobile'] = $mobile = (isset($_POST['mobile'])) ? $this->common->mysql_safe_string($_POST['mobile']) : '';
            $add_in['status_flag'] = $status_flag = (isset($_POST['status_flag'])) ? $this->common->mysql_safe_string($_POST['status_flag']) : '';

            $add_in_add['address_name'] = $address_name = (isset($_POST['address_name'])) ? $this->common->mysql_safe_string($_POST['address_name']) : '';
            $add_in_add['city_id'] = $city_id = (isset($_POST['city_id'])) ? $this->common->mysql_safe_string($_POST['city_id']) : '';
            $add_in_add['state_id'] = $state_id = (isset($_POST['state_id'])) ? $this->common->mysql_safe_string($_POST['state_id']) : '';
            $add_in_add['postcode'] = $postcode = (isset($_POST['postcode'])) ? $this->common->mysql_safe_string($_POST['postcode']) : '';

            if ($first_name == '') {$error .= "Please enter first name<br>";}
            if ($last_name == '') {$error .= "Please enter last name<br>";}
            if ($mobile == '') {$error .= "Please enter phone number<br>";}
            //if ($email == '') { $error .= "Please enter email address<br>"; }

            if ($error == '') {

                if (isset($_FILES['id_proof'])) {
                    if ($_FILES['id_proof']['name'] != "") {
                        $pusti = $this->common->gen_key(10);
                        $extension = strstr($_FILES['id_proof']['name'], ".");
                        $thumbpath = $_FILES['id_proof']['name'];
                        $thumbpath = preg_replace("/[^a-zA-Z0-9.]/", "", $thumbpath);
                        copy($_FILES['id_proof']['tmp_name'], "./uploads/id_proof/" . $pusti . $thumbpath);
                        $add_in['id_proof'] = $pusti . $thumbpath;
                    }
                }

                $this->db->where('user_id', $user_id);
                $this->db->update('user_master_front', $add_in);

                $chkShipInfo = $this->common->getSingleInfoBy('customer_shipping_address', 'user_id', $user_id, 'user_id');
                if (sizeof($chkShipInfo) > 0) {
                    $this->db->where('user_id', $user_id);
                    $this->db->update('customer_shipping_address', $add_in_add);
                } else {
                    $add_in_add['user_id'] = $user_id;
                    $this->common->insertRecord('customer_shipping_address', $add_in_add);
                }

                $this->session->set_flashdata('success', 'Driver profile has been updated succssfully!');
                redirect($this->controller . '/edit_driver/' . $user_id);
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        if (isset($_POST['mode_pass']) && $_POST['mode_pass'] == "updateDriverPassword") {

            $add_in = array();
            $password = (isset($_POST['password'])) ? $this->common->mysql_safe_string($_POST['password']) : '';
            $cpassword = (isset($_POST['cpassword'])) ? $this->common->mysql_safe_string($_POST['cpassword']) : '';

            if ($password == '') {$error .= "Please enter password<br>";}
            if ($cpassword == '') {$error .= "Please enter confirm password<br>";}

            if ($password != $cpassword) {
                $error .= "Password and confirm password are not same.";
            }

            if ($error == '') {

                $add_in['passphrase'] = $password;
                $this->db->where('user_id', $user_id);
                $this->db->update('user_master_front', $add_in);
                $this->session->set_flashdata('success', 'Driver password has been updated succssfully!');
                redirect($this->controller . '/edit_driver/' . $user_id);
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $data['results'] = $results = $this->common->getSingleInfoBy('user_master_front', 'user_id', $user_id, '*');
        $data['results_address'] = $results_address = $this->common->getSingleInfoBy('customer_shipping_address', 'user_id', $user_id, '*');

        $this->load->view("edit_driver", $data);
    }

    public function change_password()
    {
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

            if ($old_password == '') {$error .= "Please enter old password.<br>";}
            if ($txt_password == '') {$error .= "Please enter New password.<br>";}
            if ($confirm_password == '') {$error .= "Please enter confirm password.<br>";}

            if ($admin_details['passphrase'] != $old_password) {
                $error .= "Old password is incorrect.";
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

    public function edit_profile()
    {
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

    public function find_business()
    {
        $data['l_s_act'] = 0;
        $error = '';
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $sSql = "SELECT *  FROM `lt_requests` WHERE request_status='Requested' AND status_flag='Active' ORDER BY request_id DESC";
        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->result_array();

        $this->load->view("find_business", $data);
    }

    public function shipment_details($request_id = 0)
    {
        $data['l_s_act'] = 0;
        $error = '';
        $data['request_id'] = $request_id;
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        if (isset($_POST['mode_add_bid']) && $_POST['mode_add_bid'] == "add_bid") {

            $add_in = array();
            $add_in['quote_amount'] = $quote_amount = (isset($_POST['quote_amount'])) ? $this->common->mysql_safe_string($_POST['quote_amount']) : '';
            $add_in['quote_note'] = $quote_note = (isset($_POST['quote_note'])) ? $this->common->mysql_safe_string($_POST['quote_note']) : '';
            $add_in['request_user_id'] = $request_user_id = (isset($_POST['request_user_id'])) ? $this->common->mysql_safe_string($_POST['request_user_id']) : '';
            $add_in['service_provider_id'] = $id;
            $add_in['request_id'] = $request_id;
            $add_in['insert_date'] = date("Y-m-d H:i:s");
            $add_in['update_date'] = date("Y-m-d H:i:s");
            $add_in['pickup_date'] = $pickup_date = (isset($_POST['pickup_date'])) ? $this->common->mysql_safe_string($_POST['pickup_date']) : '';
            $add_in['drop_date'] = $drop_date = (isset($_POST['drop_date'])) ? $this->common->mysql_safe_string($_POST['drop_date']) : '';

            $sql = "select * from lt_request_quotes where request_id='" . $request_id . "' and service_provider_id='" . $id . "'";
            $query = $this->db->query($sql);

            if ($query->num_rows() == 0) {
                $this->common->insertRecord('lt_request_quotes', $add_in);
                $insert_id = $this->db->insert_id();
                $this->session->set_flashdata('success', 'Bid request has been added succssfully sent!!');
                redirect($this->controller . '/shipment_details/' . $request_id);
            } else {
                $this->session->set_flashdata('error', 'Error!');
            }
        }

        $sSql = "SELECT *  FROM `lt_requests` WHERE request_status='Requested' AND status_flag='Active' AND request_id=" . $request_id . " ORDER BY request_id DESC";
        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->row_array();

        $sSql = "SELECT *  FROM `user_master_front` WHERE user_id=" . $requests['user_id'] . " ORDER BY user_id";
        $query = $this->db->query($sSql);
        $data['customer'] = $customer = $query->row_array();

        $sSql = "SELECT *  FROM `lt_requests_items` WHERE request_id=" . $requests['request_id'] . " ORDER BY lt_requests_items_id";
        $query = $this->db->query($sSql);
        $data['items'] = $items = $query->result_array();

        $total_weight = 0;
        foreach ($items as $key => $itm) {
            $total_weight = $total_weight + $this->common->getDbValue($itm['consignment_weight']);
        }
        $data['total_weight'] = $total_weight;

        $sql = "SELECT us.first_name, us.last_name, qt.quote_amount  FROM user_master_front us , lt_request_quotes qt
			WHERE us.user_id=qt.service_provider_id AND
			qt.request_id=" . $requests['request_id'] . "
			ORDER BY qt.request_quote_id DESC";
        $rschk = $this->db->query($sql);
        $data['req_quotes'] = $req_quotes = $rschk->result_array();

        $sSql = "SELECT *  FROM `lt_request_consignment_imgs` WHERE request_id=" . $requests['request_id'] . " ORDER BY consignment_img_id";
        $query = $this->db->query($sSql);
        $data['cons_images'] = $cons_images = $query->result_array();

        $this->load->view("shipment_details", $data);
    }

    public function change_ship_status($request_id = 0)
    {

        if (isset($_GET['sel_status']) && $_GET['sel_status'] != '') {
            $sel_status = $this->common->getDbValue($_GET['sel_status']);
            $master_status = 'Ongoing';

            if (strtolower($sel_status) == 'picked up' || strtolower($sel_status) == 'dispatched') {
                $master_status = 'Scheduled';
            } else if ($sel_status == 'Delivered') {
                $master_status = 'Completed';
            }

            $add_in_add['request_sub_status'] = $sel_status;
            $this->db->where('request_id', $request_id);
            $this->db->update('lt_requests', $add_in_add);

            /// HISTORY ///
            $add_in['request_id'] = $request_id;
            $add_in['request_status'] = $master_status;
            $add_in['request_sub_status'] = $sel_status;
            $add_in['date_added'] = date("Y-m-d H:i:s");

            $this->common->insertRecord('lt_requests_history', $add_in);
            $insert_id = $this->db->insert_id();
            /// HISTORY ///

            $this->session->set_flashdata('success', 'status has been changed successfully!');
            redirect($this->controller . '/my_shipment_details/' . $request_id);

        }

    }

    public function my_shipment_details($request_id = 0)
    {
        $data['l_s_act'] = 1;
        $error = '';

        $data['request_id'] = $request_id;
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        /*$sSql = "SELECT rq.*  FROM lt_requests rq , lt_request_quotes qt
        WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "' AND qt.request_id='" . $request_id . "'
        AND rq.request_status='Requested' AND
        rq.status_flag='Active' ORDER BY rq.request_id DESC";

        $rschk = $this->db->query($sSql);
        $no_quotes = $rschk->num_rows();
        if($no_quotes==0){
        redirect($this->controller);
        }*/

        $sSql = "SELECT *  FROM `lt_requests` WHERE status_flag='Active' AND request_id=" . $request_id . " ORDER BY request_id DESC";
        $query = $this->db->query($sSql);
        $data['requests'] = $requests = $query->row_array();

        $sSql = "SELECT *  FROM `user_master_front` WHERE user_id=" . $requests['user_id'] . " ORDER BY user_id";
        $query = $this->db->query($sSql);
        $data['customer'] = $customer = $query->row_array();

        $sSql = "SELECT *  FROM `lt_requests_items` WHERE request_id=" . $requests['request_id'] . " ORDER BY lt_requests_items_id";
        $query = $this->db->query($sSql);
        $data['items'] = $items = $query->result_array();

        $total_weight = 0;
        foreach ($items as $key => $itm) {
            $total_weight = $total_weight + $this->common->getDbValue($itm['consignment_weight']);
        }
        $data['total_weight'] = $total_weight;

        $sql = "SELECT us.first_name, us.last_name, qt.quote_amount  FROM user_master_front us , lt_request_quotes qt
			WHERE us.user_id=qt.service_provider_id AND
			qt.request_id=" . $requests['request_id'] . "
			ORDER BY qt.request_quote_id DESC";
        $rschk = $this->db->query($sql);
        $data['req_quotes'] = $req_quotes = $rschk->result_array();

        $sql = "select * from lt_request_quotes where request_id=" . $requests['request_id'] . " AND service_provider_id=" . $id . " ";
        $rschk = $this->db->query($sql);
        $data['my_quotes'] = $my_quotes = $rschk->row_array();

        $sSql = "SELECT *  FROM `lt_request_consignment_imgs` WHERE request_id=" . $requests['request_id'] . " ORDER BY consignment_img_id";
        $query = $this->db->query($sSql);
        $data['cons_images'] = $cons_images = $query->result_array();

        $sSql = "SELECT *  FROM `setting` WHERE setting_id='17746' ORDER BY setting_id";
        $query = $this->db->query($sSql);
        $setting = $query->row_array();
        $data['VAT_PERCENTAGE'] = $this->common->getDbValue($setting['value']);

        $sSql = "SELECT *  FROM `setting` WHERE setting_id='17747' ORDER BY setting_id";
        $query = $this->db->query($sSql);
        $setting = $query->row_array();
        $data['ADMIN_COMMISSION'] = $this->common->getDbValue($setting['value']);

        $this->load->view("my_shipment_details", $data);
    }

    public function assign_driver($request_id = 0)
    {
        $data['l_s_act'] = 1;
        $error = '';

        $data['request_id'] = $request_id;
        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        /*$sSql = "SELECT rq.*  FROM lt_requests rq , lt_request_quotes qt
        WHERE rq.request_id=qt.request_id AND qt.service_provider_id='" . $id . "' AND qt.request_id='" . $request_id . "'
        AND rq.request_status='Requested' AND qt.quote_seeker_approval=1 AND
        rq.status_flag='Active' ORDER BY rq.request_id DESC";

        $rschk = $this->db->query($sSql);
        $no_quotes = $rschk->num_rows();
        if($no_quotes==0){
        redirect($this->controller);
        }*/

        $sSql = "SELECT um.*,mp.name as state_name, mp.name_en as state_name_en, md.name as district_name , md.name_en as district_name_en  FROM `user_master_front` um
			left join master_province mp on um.state_id = mp.id
			left join master_city md on um.district_id = md.id  WHERE um.status_flag in ('Active')  and user_type='Driver'  and um.parent_id='" . $id . "'   ORDER BY um.user_id DESC";

        $query = $this->db->query($sSql);
        $data['my_drivers'] = $my_drivers = $query->result_array();

        $data['sel_driver_id'] = 0;
        $sSql = "SELECT *  FROM `lt_request_quotes` WHERE request_id=" . $request_id . " AND service_provider_id=" . $id . " ORDER BY request_id DESC";
        $query = $this->db->query($sSql);
        $quots = $query->row_array();

        if ($quots) {
            $data['sel_driver_id'] = $this->common->getDbValue($quots['driver_id']);
        }

        $this->load->view("assign_driver", $data);
    }

    public function get_assign_driver($request_id = 0, $driver_id = 0)
    {

        $request_id = $this->common->getDbValue($request_id);
        $driver_id = $this->common->getDbValue($driver_id);

        $data['controller'] = $controller = $this->controller;
        $session_user_data = $this->session->userdata('user_data');
        $id = $session_user_data['user_id'];

        $add_in_add['driver_id'] = $driver_id;
        $where_edt = "request_id = $request_id AND service_provider_id=" . $id;
        $update_status = $this->common->updateRecord('lt_request_quotes', $add_in_add, $where_edt);

        $add_in_add_1['driver_id'] = $driver_id;
        $where_edt = "request_id = " . $request_id;
        $update_status = $this->common->updateRecord('lt_requests', $add_in_add_1, $where_edt);

        $this->session->set_flashdata('success', 'Driver has been assigned successfully!');
        redirect($this->controller . '/assign_driver/' . $request_id);
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

}
