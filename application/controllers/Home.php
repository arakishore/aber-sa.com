<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
    public $controller = "home";
    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
            $this->load->model('common');
            $this->load->model('services');
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
        
		$data['act_id'] = 1;
		$data['page_header'] = "home";
        $param_page = $this->uri->segment(1); // n=1 for controller, n=2 for method, etc
        
        if($param_page=="" ){
            $param_page = "home";
        }

        $data['cms_data_1'] = $this->common->get_site_cms_master(2);
		$data['cms_data_3'] = $this->common->get_site_cms_master(3);

       // $session_user_data = $this->session->userdata('user_data');
       
       
        $data['categorySubcategory'] = [];
        $params['is_parent_only'] = 1;
        $categorySubcategory= $this->services->categorySubcategory($params,'ARRAY');
        if($categorySubcategory['status'] == 1){
            $data['categorySubcategory']= $categorySubcategory['result'];
        }
       
        $this->load->view("home", $data);

    }
    
}