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
         //   $session_user_data = $this->common->check_user_session('login');
          //  print_r($session_user_data);
           /*  if (isset($session_user_data['user_type']) && $session_user_data['user_type'] != "Customer") {
               // redirect("login");
               // exit;
            }  */ 
    }
	
	public function category(){
        
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
        $data['l_s_act'] = 4;
       
        $data['categorySubcategory'] = [];
        $params['category_id'] = 0;
        $params['is_parent_only'] = 1;
       
        $categorySubcategory= $this->services->categorySubcategory($params,'ARRAY');
        if(isset($categorySubcategory['status']) && $categorySubcategory['status'] == 1){
            $data['categorySubcategory']= $categorySubcategory['result'];
        }
        $this->load->view("category_view", $data);
    }
    public function subcategory($categoryid=0){
        
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
	 
       
        $data['categorySubcategory'] = [];
        $params['category_id'] = (int)$categoryid;
        $data['category_id'] = (int)$categoryid;
        $categorySubcategory= $this->services->categorySubcategory($params,'ARRAY');
        if(isset($categorySubcategory['status']) && $categorySubcategory['status'] == 1){
            $data['categorySubcategory']= $categorySubcategory['result'];
        }
       

        $this->load->view("subcategory_view", $data);
    }
    public function step1($category_id=0,$subcategory_id=0){
        
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
	 
       
        $data['categorySubcategory'] = [];
        $data['subcategory_id'] = (int)$subcategory_id;
        $data['category_id'] = (int)$category_id; 

        $data['postdata'] = []; 
       
        if(sizeof($_POST)>0){
           $this->session->set_userdata(array('req_data_post1' => $_POST));
          // $data['postdata'] =  $_POST;
           redirect("request/step2");
        } else {
           $session_req_data_post = $this->session->userdata('req_data_post1');
         //  print_r($session_req_data_post);
           if(isset($session_req_data_post) && sizeof($session_req_data_post)>0){
               $data['postdata'] =  $session_req_data_post;
               $data['postdata']['category_id'] = $category_id;
               $data['postdata']['subcategory_id'] = $subcategory_id;
               
               $paramtemp['category_id'] = $category_id;
               $category_name1 = $this->services->getCategoryName($paramtemp);
               $paramtemp['category_id'] = $subcategory_id;
               $category_name2 = $this->services->getCategoryName($paramtemp);

               $data['postdata']['category_name'] = $category_name1['name'];
               $data['postdata']['subcategory_name'] = $category_name2['name'];

           }
        } 
        
       // $data['postdata']['category_id']  = $category_id;
       // $data['postdata']['subcategory_id']  = $subcategory_id;

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
         $data['consignmentimage_temp'] = [];

         if(sizeof($_POST)>0){
             $postdata_temp = $_POST;
             //requests_items
            //$postdata_temp['requests_items'] = $_POST['consignment_qty'];
            foreach($_POST['consignment_qty'] as $key => $value){
                $temp_array = array('consignment_qty'=>$_POST['consignment_qty'][$key],'consignment_width'=>$_POST['consignment_width'][$key],'consignment_height'=>$_POST['consignment_height'][$key],'consignment_weight'=>$_POST['consignment_weight'][$key],'consignment_length'=>$_POST['consignment_length'][$key],'consignment_details'=>$_POST['consignment_details'][$key]);
                $postdata_temp['requests_items'][] = $temp_array;
            }

            $this->session->set_userdata(array('req_data_post2' => $postdata_temp));
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
            $session_req_data_post = $this->session->userdata('req_data_post2');
          //  print_r($session_req_data_post);

             $data['consignmentimage_temp'] = isset($session_req_data_post['lt_request_consignment_imgs']) ? $session_req_data_post['lt_request_consignment_imgs'] : [];
         }
         
        $this->load->view("step2", $data);
    }
    public function step3(){
    
      //  print_r($this->session->userdata('req_uuid'));
        $session_user_data = $this->session->userdata('user_data');
       
        $user_id = $session_user_data['user_id'];
     
        $data['postdata'] = []; 
        $data['postdata1'] = []; 
        $data['postdata2'] = []; 
        $data['postdata3'] = []; 
       
         if(sizeof($_POST)>0){
            $data_json['user_id'] = $user_id;
           // $this->session->set_userdata(array('req_data_post3' => $_POST));
            $data['postdata3'] =  $_POST;
            $session_req_data_post2 = $this->session->userdata('req_data_post2');
            if(isset($session_req_data_post2) && sizeof($session_req_data_post2)>0){
                $data['postdata2'] =  $session_req_data_post2;
            }
            $session_req_data_post1 = $this->session->userdata('req_data_post1');
            if(isset($session_req_data_post1) && sizeof($session_req_data_post1)>0){
                $data['postdata1'] =  $session_req_data_post1;
            }

            foreach($data['postdata3'] as $key3 => $postValue3){
                $data_json[$key3] = $postValue3;
            } 
            foreach($data['postdata2'] as $key2 => $postValue2){
                $data_json[$key2] = $postValue2;
            } 
            foreach($data['postdata1'] as $key1 => $postValue1){
                $data_json[$key1] = $postValue1;
            } 
            $sql = "select * from consignmentimage_temp where   user_id='{$user_id}' ";
            $request_query = $this->db->query($sql) ;
            if($request_query->num_rows()>0){
               $consignmentimage_temp = $request_query->result_array();
               foreach($consignmentimage_temp as $imgkey => $imagValue){
                $data_json['consignment_image'][] = back_path . "uploads/consignmentimage_temp/" . $imagValue['image_name'];
            }

            } else {
                $data_json['consignment_image'] = [];

            }
            $data_json['request_via']= 'web';
            $req_uuid =  $this->session->userdata('req_uuid');
            if($req_uuid==""){
                 $returnData = $this->services->doRequest($data_json, 'ARRAY');
            } else {
                
                 $returnData = $this->services->doRequestUpdate($data_json, 'ARRAY');
            }
            
            if($returnData['status']==1){

                $this->session->unset_userdata('req_data_post3');
                $this->session->unset_userdata('req_data_post2');
                $this->session->unset_userdata('req_data_post1');
                $this->session->unset_userdata('req_uuid');
        
            redirect("customer");
            } else {
                print_r($returnData);
            }
            
         }  else {
            $data['postdata3'] = $this->session->userdata('req_data_post3');

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

 