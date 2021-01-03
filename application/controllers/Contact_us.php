<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Contact_us extends CI_Controller
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
    public $controller = "contact_us";
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
        $data['page_header'] = "home";
		$data['act_id'] = 2;
		
		$data['cms_data_6'] = $this->common->get_site_cms_master(6);
        $this->load->view("contact_us", $data);
    }
    
}