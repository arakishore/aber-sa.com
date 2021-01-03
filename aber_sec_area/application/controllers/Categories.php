<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class Categories extends CI_Controller
{
    public $db;
    public $ctrl_name = 'categories';
    public $tbl_name = 'product_category';
    public $pg_title = 'Categories';
    public $m_act = 5;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('common');
        $this->load->helper('security');
        $this->load->library('email');
        //$this->load->model('currencymodal');

        $this->load->helper('url_helper');
        $this->db = $this->load->database('default', true);
        $this->common->check_user_session();
    }

    public function index()
    {
        $this->categorylistall();
    }


    //category
    public function categorylistall()
    {
        $data['msg'] = '';
        $error = '';
        $data['l_s_act'] = 3;
        $data['sub_heading'] = 'Category List';

        $where_cond = " WHERE  status!='Delete' AND parent_id=0 ORDER BY sort_order";
        $data['results'] = $results = $this->common->getAllRow('product_category', $where_cond);

        $this->load->view('categorylistall', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');
    }

    public function add_category()
    {
        $data['msg'] = '';
        $error = '';
        $data['l_s_act'] = 3;
        $data['sub_heading'] = 'Add category';
        $error = '';

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
            $add_in['description'] = $description = (isset($_POST['description'])) ? $this->common->mysql_safe_string($_POST['description']) : '';

            $add_in['name_en'] = $name_en = (isset($_POST['name_en'])) ? $this->common->mysql_safe_string($_POST['name_en']) : '';
            $add_in['description_en'] = $description_en = (isset($_POST['description_en'])) ? $this->common->mysql_safe_string($_POST['description_en']) : '';

            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : '';
            $add_in['sort_order'] = $sort_order = (isset($_POST['sort_order'])) ? $this->common->mysql_safe_string($_POST['sort_order']) : '';
            $add_in['date_added'] = date('Y-m-d h:i:s');
			$add_in['parent_id'] = $parent_id = (isset($_POST['parent_id'])) ? $this->common->mysql_safe_string($_POST['parent_id']) : '';

            //die();
            if (isset($_FILES['main_image'])) {
                if ($_FILES['main_image']['name'] != "") {
                    $pusti = $this->common->gen_key(10);
                    $extension = strstr($_FILES['main_image']['name'], ".");
                    $thumbpath = $_FILES['main_image']['name'];
                    $thumbpath = preg_replace("/[^a-zA-Z0-9.]/", "", $thumbpath);
                    copy($_FILES['main_image']['tmp_name'], "../uploads/category/" . $pusti . $thumbpath);
                    $add_in['main_image'] = $pusti . $thumbpath;
                }
            }

            $chkUserInfo = $this->common->getSingleInfoBy('product_category', 'name', $name);
            if (sizeof($chkUserInfo) > 0) {
                $error = $name . "   is already added";
            }

            if ($error == '') {

                $this->common->insertRecord('product_category', $add_in);
                $this->session->set_flashdata('success', 'Information added succssfully!');
                redirect($this->ctrl_name . "/categorylistall");
            } else {
                $this->session->set_flashdata('error', $error);
            }
        }

        $this->load->view('add_category', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');

    }

    public function delete_category($id = 0){
        $where_edt = "category_id = $id";
        $add_in['status'] = 'Delete';
        $update_status = $this->common->updateRecord('product_category', $add_in, $where_edt);
        $this->session->set_flashdata('success', 'Product deleted succssfully!');
        redirect($this->ctrl_name . "/categorylistall");
    }

    public function edit_category($id = 1)
    {
        $data['msg'] = '';
        $data['id'] = $id;
        $data['l_s_act'] = 3;
        $data['sub_heading'] = 'Edit category';
        $error = '';

        $where_edt = "category_id = $id";
        $where_fetch = "WHERE category_id=" . $id;

        if (isset($_POST['mode']) && $_POST['mode'] == "submitform") {

            $add_in['name'] = $name = (isset($_POST['name'])) ? $this->common->mysql_safe_string($_POST['name']) : '';
            $add_in['description'] = $description = (isset($_POST['description'])) ? $this->common->mysql_safe_string($_POST['description']) : '';

            $add_in['name_en'] = $name_en = (isset($_POST['name_en'])) ? $this->common->mysql_safe_string($_POST['name_en']) : '';
            $add_in['description_en'] = $description_en = (isset($_POST['description_en'])) ? $this->common->mysql_safe_string($_POST['description_en']) : '';

            $add_in['status'] = $status = (isset($_POST['status'])) ? $this->common->mysql_safe_string($_POST['status']) : '';
            $add_in['sort_order'] = $sort_order = (isset($_POST['sort_order'])) ? $this->common->mysql_safe_string($_POST['sort_order']) : '';
			
			$add_in['parent_id'] = $parent_id = (isset($_POST['parent_id'])) ? $this->common->mysql_safe_string($_POST['parent_id']) : '';

            //die();
            if (isset($_FILES['main_image'])) {
                if ($_FILES['main_image']['name'] != "") {
                    $pusti = $this->common->gen_key(10);
                    $extension = strstr($_FILES['main_image']['name'], ".");
                    $thumbpath = $_FILES['main_image']['name'];
                    $thumbpath = preg_replace("/[^a-zA-Z0-9.]/", "", $thumbpath);
                    copy($_FILES['main_image']['tmp_name'], "../uploads/category/" . $pusti . $thumbpath);
                    $add_in['main_image'] = $pusti . $thumbpath;
                }
            }

            if ($error == '') {
                $update_status = $this->common->updateRecord('product_category', $add_in, $where_edt);
                $this->session->set_flashdata('success', 'Information updated succssfully!');

                redirect($this->ctrl_name . "/categorylistall");

            } else {
                $data['msg'] = $error;
            }
        }

        $where_cond = "where category_id='" . $id . "'";
        $data['records'] = $records = $this->common->getOneRow('product_category', $where_cond);

        $this->load->view('edit_category', $data);
        $this->session->unset_userdata('success');
        $this->session->unset_userdata('warning');
        $this->session->unset_userdata('error');

    }
    //end of category
}
