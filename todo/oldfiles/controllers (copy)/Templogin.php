<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templogin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function index($id=7)
    {

        $error_msg = '';

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // $password = md5($password);

            $sql = "select * from user_master_front where user_id='" . $id . "' ";

            $query = $this->db->query($sql);

            if ($query->num_rows() > 0) {
	                $result = $query->row_array();

                    /*$array = array(
                        'ip_address' => $ip_address,
                    );

                    $this->db->where('email', $username);
                    $this->db->where('user_pass', $password);
                    $this->db->update('user_admin', $array);*/

                    //$code = base64_encode($unique_logincode."##".$ip_address);
                    //    $this->session->sess_destroy();
                    $this->session->sess_regenerate(true);

                    $this->session->set_userdata(array('user_data' => array()));

                    $ar_session_data['user_data'] = $result;
                    $ar_session_data['user_data']['logged_in'] = true;
                    $ar_session_data['user_data']['passphrase'] = "";
                    $this->session->set_userdata($ar_session_data);

                    redirect(site_url("serviceprovider"), 'refresh');
                    exit();


            } else {
                $error_msg = "Incorrect login credentials";
            }

    }

}
