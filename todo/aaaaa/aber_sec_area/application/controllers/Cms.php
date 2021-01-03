<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Cms
 *
 * @package Getlised.in
 * @subpackage Manage Cms
 * @category Cms
 * @version    1.0
 * @updated    21/04/2020
 */
 
class Cms extends CI_Controller
{
    public $db;
    public $ctrl_name = 'cms';
    public $tbl_name = 'master_driver';
    public $pg_title = 'Cms';
    public $m_act = 11;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common');
        $this->load->helper('security');
        $this->load->library('email');
        $this->load->helper('url_helper');
        $this->db = $this->load->database('default', true);
        $this->common->check_user_session();
    }

    public function index()
    {
        $this->notification();
    }

    public function notification()
    {

        $data['title'] = 'Notification';
        $data['l_s_act'] = 2;
        $data['sub_heading'] = 'Notification List';

        $search_qry = " WHERE  1=1 ";

        $data['results'] = $this->common->getRecordsLimit('site_notifications', $search_qry, 0, 0);

        $data['controller'] = $this->ctrl_name;

        $this->load->view('notification', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    public function editnotification($id=0)
    {

        $session_user_data = $this->session->userdata('user_data');
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $data['l_s_act'] = 3;
        
        $data['title'] = 'Notification';
        $data['sub_heading'] = 'Edit';
        $data['controller'] = $this->ctrl_name;
        $data['email_id'] = $id;
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['description'] = $description = (isset($_POST['description'])) ? $this->common->mysql_safe_string($_POST['description']) : '';
            
            if ($description == '') {
                $error .= "Please enter description<br>";
            }
            
            if ($error == '') {

               
                $this->db->where('id', $id);
                $this->db->update('site_notifications', $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
                redirect($this->ctrl_name . '/notification');
            } else {
                $this->session->set_flashdata('error', $error);
            }

            $data_info = $_POST;
        } else {

            $data_info = $this->common->getSingleInfoBy('site_notifications', 'id', $id, '*');
        }

        //print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select data!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);
        }
        $data['records'] = $data_info;
        $this->load->view('editnotification', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    
    public function emailtemplate()
    {
        $data['title'] = 'Email template';
        $data['l_s_act'] = 3;
        $data['sub_heading'] = 'Email template List';

        $search_qry = " WHERE  1=1 ";

        $data['results'] = $this->common->getRecordsLimit('site_email_template_master', $search_qry, 0, 0);

        $data['controller'] = $this->ctrl_name;

        $this->load->view('emailtemplate', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
   
    public function editemailtemplate($id=0)
    {

        $session_user_data = $this->session->userdata('user_data');
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $data['l_s_act'] = 3;
        
        $data['title'] = 'Email template';
        $data['sub_heading'] = 'Edit';
        $data['controller'] = $this->ctrl_name;
        $data['email_id'] = $id;
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['email_description'] = $email_description = (isset($_POST['email_description'])) ? $this->common->mysql_safe_string($_POST['email_description']) : '';
            $add_in['email_subject'] = $email_subject = (isset($_POST['email_subject'])) ? $this->common->mysql_safe_string($_POST['email_subject']) : '';
            if ($email_description == '') {
                $error .= "Please enter description<br>";
            }
            if ($email_subject == '') {
                $error .= "Please enter subject<br>";
            }
            if ($error == '') {

               
                $this->db->where('email_id', $id);
                $this->db->update('site_email_template_master', $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
                redirect($this->ctrl_name . '/emailtemplate');
            } else {
                $this->session->set_flashdata('error', $error);
            }

            $data_info = $_POST;
        } else {

            $data_info = $this->common->getSingleInfoBy('site_email_template_master', 'email_id', $id, '*');
        }

        //print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select data!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);
        }
        $data['records'] = $data_info;
        $this->load->view('editemailtemplate', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    
    public function faq()
    {

        $session_user_data = $this->session->userdata('user_data');
        
        $data['l_s_act'] = 2;
        
        $data['title'] = 'FAQ';
        $data['sub_heading'] = 'FAq List';
        $data['controller'] = $this->ctrl_name;
        
        $error = '';
        $search_qry = " WHERE  status!='Delete' ";
        $data['results'] = $this->common->getRecordsLimit('cms_faq', $search_qry, 0, 0);

        $this->load->view('cms_faq', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    public function faqedit($id=0)
    {

        $session_user_data = $this->session->userdata('user_data');
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $data['l_s_act'] = 2;
        
        $data['title'] = 'CMS ';
        $data['sub_heading'] = 'FAQ Edit';
        $data['controller'] = $this->ctrl_name;
        $data['id'] = $id;
        $error = '';
        $data['funcationname'] = "faqedit/".$id;
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
            $add_in['sort_no'] = $sort_no = (isset($_POST['sort_no'])) ? $this->common->mysql_safe_string($_POST['sort_no']) : '';
            $add_in['question'] = $question = (isset($_POST['question'])) ? $this->common->mysql_safe_string($_POST['question']) : '';
            $add_in['question_en'] = $question_en = (isset($_POST['question_en'])) ? $this->common->mysql_safe_string($_POST['question_en']) : '';
            if ($question == '') {
                $error .= "Please enter question<br>";
            }
             
            $add_in['answer'] = $answer = (isset($_POST['answer'])) ? $_POST['answer']: '';
            $add_in['answer_en'] = $answer_en = (isset($_POST['answer_en'])) ? $_POST['answer_en'] : '';
            if ($answer == '') {
                $error .= "Please enter answer<br>";
            }
            
            if ($error == '') {

               
                $this->db->where('id', $id);
                $this->db->update('cms_faq', $add_in);

                $this->session->set_flashdata('success', 'Information updated succssfully!');
                redirect($this->ctrl_name . '/faq');
            } else {
                $this->session->set_flashdata('error', $error);
            }

            $data_info = $_POST;
        } else {

            $data_info = $this->common->getSingleInfoBy('cms_faq', 'id', $id, '*');
        }

        //print_r($data_info);
        if (sizeof($data_info) == 0) {
            $newdata = array('warning' => 'Please select data!');
            $this->session->set_flashdata($newdata);
            redirect($this->ctrl_name);
        }
        $data['records'] = $data_info;
        $this->load->view('cms_faqedit', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }
    public function faqadd()
    {

        $session_user_data = $this->session->userdata('user_data');
       
        $data['l_s_act'] = 2;
        
        $data['title'] = 'CMS ';
        $data['sub_heading'] = 'FAQ Add';
        $data['controller'] = $this->ctrl_name;
        $data['funcationname'] = "faqadd";
        $error = '';
        
        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in = array();
            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : 'Active';
            $add_in['sort_no'] = $sort_no = (isset($_POST['sort_no'])) ? $this->common->mysql_safe_string($_POST['sort_no']) : '';
            $add_in['question'] = $question = (isset($_POST['question'])) ? $this->common->mysql_safe_string($_POST['question']) : '';
            $add_in['question_en'] = $question_en = (isset($_POST['question_en'])) ? $this->common->mysql_safe_string($_POST['question_en']) : '';
            if ($question == '') {
                $error .= "Please enter question<br>";
            }
             
            $add_in['answer'] = $answer = (isset($_POST['answer'])) ? $this->common->mysql_safe_string($_POST['answer']) : '';
            $add_in['answer_en'] = $answer_en = (isset($_POST['answer_en'])) ? $this->common->mysql_safe_string($_POST['answer_en']) : '';
            if ($answer == '') {
                $error .= "Please enter answer<br>";
            }
            $chkUserInfo = $this->common->getSingleInfoBy('cms_faq','question',$question);
            
             if (sizeof($chkUserInfo) > 0) {
                 $error = "$question  is already added";
             }
            if ($error == '') {

               
                $this->db->insert('cms_faq', $add_in);

                $this->session->set_flashdata('success', 'Information added succssfully!');
                redirect($this->ctrl_name . '/faq');
            } else {
                $this->session->set_flashdata('error', $error);
            }

            
        }  

        $data_info = (isset($_POST)) ? $_POST : '';
        $data['records'] = $data_info;
         
        $this->load->view('cms_faqedit', $data);

        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function delete_faq($id = 0){
        $where_edt = "id = $id";
        $add_in['status'] = 'Delete';
        $update_status = $this->common->updateRecord('cms_faq', $add_in, $where_edt);
        $this->session->set_flashdata('success', 'FAQ deleted succssfully!');
        redirect($this->ctrl_name . "/faq");
    }   
}
