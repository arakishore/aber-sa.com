<?php
defined('BASEPATH') or exit('No direct script access allowed');
//use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
//use Ramsey\Uuid\Uuid;

class Home extends CI_Controller
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

    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {

        $session_user_data = $this->session->userdata('user_data');
        if ($session_user_data['logged_in']) {

            redirect('dashboard', 'refresh');
            exit;
        }

        $data['title'] = 'Login';
        $data['error_msg'] = '';
        //$session_user_data = $this->session->userdata('admin_data');

        $error_msg = '';
        if ($this->input->post()) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // $password = md5($password);

            $sql = "select * from user_admin where email='" . $username . "' and user_pass='" . $password . "'";

            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                //  and status='A'
                if ($result['user_status'] == "Active") {
                    $unique_logincode = $this->common->rand_str(5);
                    $time_sent = time();
                    $ip_address = $this->common->get_ip();
                    $login_time = date("Y-m-d H:i:s");

                    /*$array = array(
                        'unique_logincode' => $unique_logincode,
                        'time_sent' => $time_sent,
                        'ip_address' => $ip_address,
                        'login_time' => $login_time,
                    );*/

                    $array = array(
                        'ip_address' => $ip_address,
                    );

                    $this->db->where('email', $username);
                    $this->db->where('user_pass', $password);
                    $this->db->update('user_admin', $array);

                    //$code = base64_encode($unique_logincode."##".$ip_address);
                    //    $this->session->sess_destroy();
                    $this->session->sess_regenerate(true);

                    $this->session->set_userdata(array('user_data' => array()));

                    $ar_session_data['user_data'] = $result;
                    $ar_session_data['user_data']['logged_in'] = true;
                    $ar_session_data['user_data']['passphrase'] = "";
                    $this->session->set_userdata($ar_session_data);

                    redirect(site_url("dashboard"), 'refresh');
                    exit();
                } else {
                    $error_msg = "Please contact admin";

                }

            } else {
                $error_msg = "Incorrect login credentials";
                //    $this->session->set_flashdata('error_msg', $error_msg);
                //redirect($this->config->item('site_url') . 'users/login');

            }
        }

        $data['error_msg'] = $error_msg;
        $this->load->view("home", $data);
    }
}