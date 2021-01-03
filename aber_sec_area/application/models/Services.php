<?php
error_reporting(E_ALL);
//use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
//use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
//use Ramsey\Uuid\Uuid;

class Services extends CI_Model
{

    public function __construct()
    {
    }

    public function getTableData($mytable, $where = "", $returnformat = "json")
    {
        //SHOW VARIABLES WHERE Variable_name LIKE  '%max_allowed_packet%'
        $params = $this->common->getRecord($mytable, $where);

        if ($returnformat == "json") {
            return $this->common->jsonencode($params);
            die();
        } else {
            return $params;
            die();
        }
    }
    public function getRecord($mytable, $where = "", $returnformat = "json")
    {
        //SHOW VARIABLES WHERE Variable_name LIKE  '%max_allowed_packet%'
        $params = $this->common->getRecord($mytable, $where);

        if ($returnformat == "json") {
            return $this->common->jsonencode($params);
            die();
        } else {
            return $params;
            die();
        }
    }

    public function getSetting($key='') {
		 
		$value= "";
		$query = $this->db->query("SELECT * FROM `setting` where `key`='".$key."' ");
		
		if($query->num_rows() > 0){
			$row = $query->row_array();
			if($row['serialized']){
				$value= json_decode($this->common->getDbValue($row['value']));
				
			} else {
				$value= $this->common->getDbValue($row['value']);
			}
			
		} 
		return $value;

    }
    
 
   
    public function update_password($params = array(), $from = "WEB", $returnformat = "json")
    {
        $add_in = array();
        $add_in['login_password'] = $new_password = (isset($params['new_password'])) ? $this->common->mysql_safe_string($params['new_password']) : '';

        $new_password2 = (isset($params['new_password2'])) ? $this->common->mysql_safe_string($params['new_password2']) : '';
        $errorData = array();
        if ($new_password == '') {
            $errorData[] = "Please enter new password<br>";
        }

        if ($new_password2 == '') {
            $errorData[] = "Please enter confirm password<br>";
        }
        if (sizeof($errorData) <= 0) {
            $add_in['modified'] = date("Y-m-d");

            $this->common->updateRecord('customer_master', $add_in, "uuid='" . $params['uuid'] . "'");

            $arr = array('status' => 1, 'retData' => $params, 'errorData' => array());
            if ($returnformat == "json") {
                return $this->common->jsonencode($arr);
                die();
            } else {
                return $arr;
                die();
            }
        } else {
             // print_r($errorData);
             $arr = array('status' => 0, 'retData' => $params, 'errorData' => $errorData);
             if ($returnformat == "json") {
                 return $this->common->jsonencode($arr);
                 die();
             } else {
                 return $arr;
                 die();
             }
        }
    }
     

    public function sendOrderMail($order_id = 0, $order_data, $mail_id = 0, $sms_id = 0, $order_for = 'membership')
    {

       
    }
     
    //ecom  market place section 
 
    //end of ecom  market place section 


  
}
