<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Privacy_policy extends CI_Controller
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
    public $controller = "privacy_policy";
    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
			$this->load->model('common');
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
			//if session not exist
		 
          //  $data['config_maintenance'] = $config_maintenance = (int)$this->common->get('config_maintenance');
	
		/* 	if($config_maintenance){
				 redirect("maintenance");
				  exit;
			} */

    }
	
    public function index(){        
        $data['page_header'] = "privacy_policy";
		$data['act_id'] = 1;
		$data['cms_data_11'] = $this->common->get_site_cms_master(11);
        $this->load->view("privacy_policy", $data);
    }
    
}