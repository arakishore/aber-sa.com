<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Request extends CI_Controller
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
    public $controller = "request";
    public function __construct()
    {
            parent::__construct();
			$this->load->library('session');
            $this->load->model('common');
            $this->load->model('services');
			$this->load->helper('security');
			$this->load->library('email');
			$this->load->helper('url_helper');
            $session_user_data = $this->common->check_user_session('login');
          //  print_r($session_user_data);
            if (isset($session_user_data['user_type']) && $session_user_data['user_type'] != "Customer") {
               // redirect("login");
               // exit;
            }  
    }
	
	
    public function subcategory($categoryid=0){
        
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
	 
       
        $data['categorySubcategory'] = [];
        $params['category_id'] = (int)$categoryid;
        $data['category_id'] = (int)$categoryid;
        $categorySubcategory= $this->services->categorySubcategory($params,'ARRAY');
        if($categorySubcategory['status'] == 1){
            $data['categorySubcategory']= $categorySubcategory['result'];
        }
       

        $this->load->view("subcategory_view", $data);
    }
    public function step1($category_id=0,$sub_categoryid=0){
        
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
	 
       
        $data['categorySubcategory'] = [];
        $data['sub_categoryid'] = (int)$sub_categoryid;
        $data['category_id'] = (int)$category_id; 

        $data['postdata'] = []; 
       
        if(sizeof($_POST)>0){
           $this->session->set_userdata(array('req_data_post1' => $_POST));
          // $data['postdata'] =  $_POST;
           redirect("request/step2");
        } else {
           $session_req_data_post = $this->session->userdata('req_data_post1');
           if(isset($session_req_data_post) && sizeof($session_req_data_post)>0){
               $data['postdata'] =  $session_req_data_post;
           }
        } 
        
       // $data['postdata']['category_id']  = $category_id;
       // $data['postdata']['sub_categoryid']  = $sub_categoryid;

        $this->load->view("step1", $data);
    }
    public function step2(){
        
        $session_user_data = $this->session->userdata('user_data');
       
    
        $user_id = $session_user_data['user_id'];
	 
   /*  print_r($_REQUEST);
       print_r($_FILES);
      
      foreach($_FILES['file']['tmp_name'] as $key => $value) {
     echo   $tempFile = $_FILES['file']['tmp_name'][$key];
       // $targetFile =  $storeFolder. $_FILES['file']['name'][$key];
        
    }
         die();  */     
         $data['postdata'] = []; 
         $data['postdata1'] = []; 
       
         if(sizeof($_POST)>0){
            $this->session->set_userdata(array('req_data_post2' => $_POST));
          //  $data['postdata2'] =  $_POST;
            redirect("request/step3");
         } else {
            $session_req_data_post = $this->session->userdata('req_data_post2');
            if(isset($session_req_data_post) && sizeof($session_req_data_post)>0){
                $data['postdata'] =  $session_req_data_post;
            }
            $session_req_data_post1 = $this->session->userdata('req_data_post1');
            if(isset($session_req_data_post1) && sizeof($session_req_data_post1)>0){
                $data['postdata1'] =  $session_req_data_post1;
            }
         } 
          
           $sql = "select * from consignmentimage_temp where   user_id='{$user_id}' ";
         $request_query = $this->db->query($sql) ;
         if($request_query->num_rows()>0){
            $data['consignmentimage_temp'] = $request_query->result_array();
         } else {
             $data['consignmentimage_temp'] = [];
         }
         
        $this->load->view("step2", $data);
    }
    public function step3(){
    
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
     
        $data['postdata'] = []; 
       
         if(sizeof($_POST)>0){
           // $this->session->set_userdata(array('req_data_post3' => $_POST));
           // $data['postdata'] =  $_POST;
            
         } else {
            $session_req_data_post2 = $this->session->userdata('req_data_post2');
            if(isset($session_req_data_post2) && sizeof($session_req_data_post2)>0){
                $data['postdata2'] =  $session_req_data_post2;
            }
            $session_req_data_post1 = $this->session->userdata('req_data_post1');
            if(isset($session_req_data_post1) && sizeof($session_req_data_post1)>0){
                $data['postdata1'] =  $session_req_data_post1;
            }
            
         } 
    
        $this->load->view("step3", $data);
    }

    function save_base64_image($base64_image_string, $output_file_without_extension, $path_with_end_slash="" ) {
        //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }      
        //
        //data is like:    data:image/png;base64,asdfasdfasdf
        $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
        $mime=$splited[0];
        $data=$splited[1];
    
        $mime_split_without_base64=explode(';', $mime,2);
        $mime_split=explode('/', $mime_split_without_base64[0],2);
        if(count($mime_split)==2)
        {
            $extension=$mime_split[1];
            if($extension=='jpeg')$extension='jpg';
            //if($extension=='javascript')$extension='js';
            //if($extension=='text')$extension='txt';
            $output_file_with_extension=$output_file_without_extension.'.'.$extension;
        }
        file_put_contents( $path_with_end_slash . $output_file_with_extension, base64_decode($data) );
        return $output_file_with_extension;
    }
    function doAddimage() {
       // print_r($_POST);
       $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
  
       
        $img_src = $_POST['img_src'];
        $img_id = $_POST['img_id'];
        $image_name_temp = $user_id."-".$img_id;
         $image_name = $this->save_base64_image($img_src,$image_name_temp,'uploads/consignmentimage_temp/');
         $sql_add['image_name'] = $image_name;
         $sql_add['session_id'] = session_id();
         $sql_add['date_added'] = date("Y-m-d H:i:s");
         $sql_add['user_id'] = $user_id;
         $sql_add['img_id'] = $img_id;
         $this->common->insertRecord('consignmentimage_temp', $sql_add);



    }
    function doDeletImage() {
        // print_r($_POST);
        
        
        $img_id = $_POST['img_id'];

      
       
        $sql = "select * from consignmentimage_temp where   img_id='{$img_id}' ";
        $request_query = $this->db->query($sql)->row_array();
        @unlink("uploads/consignmentimage_temp/".$request_query['image_name']);
        $sql = "delete from consignmentimage_temp where  img_id = '" . $img_id . "' ";
        $this->db->query($sql);
     }
}

 