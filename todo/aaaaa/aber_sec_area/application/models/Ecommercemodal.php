<?php
error_reporting(E_ALL);
//use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class Ecommercemodal extends CI_Model
{
    public function __construct()
    {
    }

    public function getCategory($cond = '', $from = "WEB", $returnformat = "json")
    {
        if ($cond != "") {
            $search_qry = $cond;
        } else {
            $search_qry = '';
        }
        $where_cond = " WHERE   delete_status=0  " . $search_qry . " ORDER BY name asc";
        $cat_data = $this->common->getAllRow('product_category	', $where_cond);
        if ($returnformat == "json") {
            return $this->common->jsonencode($cat_data);
            die();
        } else {
            return $cat_data;
            die();
        }
    }
    //ecom  market place section

    public function product_add($params = array(), $from = "WEB", $returnformat = "json")
    {
        $add_in = array();
        $add_in['model'] = $first_name = (isset($params['model'])) ? $this->common->mysql_safe_string($params['model']) : '';
        $add_in['name'] = $name = (isset($params['name'])) ? $this->common->mysql_safe_string($params['name']) : '';
        $add_in['description'] = $description = (isset($params['description'])) ? $this->common->mysql_safe_string($params['description']) : '';
        $add_in['quantity'] = $quantity = (isset($params['quantity'])) ? $this->common->mysql_safe_string($params['quantity']) : '';
        $add_in['price'] = $price = (isset($params['price'])) ? $this->common->mysql_safe_string($params['price']) : '';
        $add_in['category_id'] = $category_id = (isset($params['category_id'])) ? $this->common->mysql_safe_string($params['category_id']) : '';
        $add_in['status'] = $status = (isset($params['status'])) ? $this->common->mysql_safe_string($params['status']) : '0';
        $errorData = array();
        if ($category_id == '') {
            $errorData[] = "Please select  category<br>";
        }
        if ($name == '') {
            $errorData[] = "Please enter  name<br>";
        }
        if ($description == '') {
            $errorData[] = "Please enter description<br>";
        }
        if ($quantity == '') {
            $errorData[] = "Please enter quantity<br>";
        }
        if ($price == '') {
            $errorData[] = "Please enter price<br>";
        }
        if (sizeof($errorData) <= 0) {
            $category_Info = $this->common->getSingleInfoBy("product_category", 'category_id', $category_id);

            $uuid = "";
            try {
                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $product_uuid = $uuid4->toString();
            } catch (UnsatisfiedDependencyException $e) {
                //  echo 'Caught exception: ' . $e->getMessage() . "\n";
            }
            $add_in['addedby_userid'] = $params['addedby_userid'];
            $add_in['product_uuid'] = $product_uuid;
            $add_in['date_added'] = date("Y-m-d");
            $add_in['category_id_parent'] = $category_id;
            $add_in['igst'] = $category_Info['igst'];
            $add_in['sgst'] = $category_Info['sgst'];
            $add_in['gst'] = $category_Info['gst'];
            $add_in['admin_commsion'] = $this->services->getSetting('config_commsion');
            $this->common->insertRecord('product_master', $add_in);
            $chkUserInfo = $this->common->getSingleInfoBy("product_master", 'product_uuid', $product_uuid);
            if (sizeof($chkUserInfo) > 0) {
                $sql_data_prod_category_array['product_id'] = $chkUserInfo['product_id'];
                $sql_data_prod_category_array['category_id'] = $chkUserInfo['category_id'];
                $insert_id_pc = $this->common->insertRecord('product_to_category', $sql_data_prod_category_array);
                $arr = array('status' => 1, 'retData' => $chkUserInfo, 'errorData' => array());
                if ($returnformat == "json") {
                    return $this->common->jsonencode($arr);
                    die();
                } else {
                    return $arr;
                    die();
                }
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
    public function product_edit($params = array(), $from = "WEB", $returnformat = "json")
    {
        $add_in = array();
        $add_in['model'] = $first_name = (isset($params['model'])) ? $this->common->mysql_safe_string($params['model']) : '';
        $add_in['name'] = $name = (isset($params['name'])) ? $this->common->mysql_safe_string($params['name']) : '';
        $add_in['description'] = $description = (isset($params['description'])) ? $this->common->mysql_safe_string($params['description']) : '';
        $add_in['quantity'] = $quantity = (isset($params['quantity'])) ? $this->common->mysql_safe_string($params['quantity']) : '';
        $add_in['price'] = $price = (isset($params['price'])) ? $this->common->mysql_safe_string($params['price']) : '';
        $add_in['category_id'] = $category_id = (isset($params['category_id'])) ? $this->common->mysql_safe_string($params['category_id']) : '';
        $add_in['status'] = $status = (isset($params['status'])) ? $this->common->mysql_safe_string($params['status']) : '0';
        $errorData = array();
        if ($category_id == '') {
            $errorData[] = "Please select  category<br>";
        }
        if ($name == '') {
            $errorData[] = "Please enter  name<br>";
        }
        if ($description == '') {
            $errorData[] = "Please enter description<br>";
        }
        if ($quantity == '') {
            $errorData[] = "Please enter quantity<br>";
        }
        if ($price == '') {
            $errorData[] = "Please enter price<br>";
        }
        if (sizeof($errorData) <= 0) {
            $category_Info = $this->common->getSingleInfoBy("product_category", 'category_id', $category_id);

            $add_in['igst'] = $category_Info['igst'];
            $add_in['sgst'] = $category_Info['sgst'];
            $add_in['gst'] = $category_Info['gst'];
            $add_in['date_modified'] = date("Y-m-d");
            $add_in['category_id_parent'] = $category_id;
            $this->common->updateRecord('product_master', $add_in, "product_uuid='" . $params['product_uuid'] . "' and addedby_userid='" . $params['user_id'] . "' ");
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
    public function getProductInfo($uuid = '', $from = "WEB", $returnformat = "json")
    {
        $product_master_info = $this->common->getSingleInfoBy("product_master", 'product_uuid', $uuid);
        if ($returnformat == "json") {
            return $this->common->jsonencode($product_master_info);
            die();
        } else {
            return $product_master_info;
            die();
        }
    }
    public function getProductImages($product_id = 0, $from = "WEB", $returnformat = "json")
    {
        $where_cond = " WHERE  product_id='" . $product_id . "' ORDER BY sort_order asc";
        $product_image = $this->common->getAllRow('product_image	', $where_cond);
        $product_image_new = array();
        foreach ($product_image as $key => $value) {
            $product_image_new[$value['sort_order']] = $value;
        }
        if ($returnformat == "json") {
            return $this->common->jsonencode($product_image_new);
            die();
        } else {
            return $product_image_new;
            die();
        }
    }

    public function getSlugName($name = '')
    {
        return $this->common->tep_short_name_list($name);
    }

    public function getOrder($store_order_uuid, $from = "WEB", $returnformat = "json")
    {

        $order_query = $this->db->query("SELECT *  FROM `order_master` o WHERE o.oorder_uid = '" . $store_order_uuid . "'");
        if ($order_query->num_rows() > 0) {
            $order_query_row = $order_query->row_array();
            return $order_query_row;
        } else {
            return false;
        }
    }

    public function getCountryState($country_id = 99, $from = "WEB", $returnformat = "json")
    {

        $json = array();

        $country_info = $this->getCountryNew($country_id, $from, 'array');
        if ($country_info) {
            $json = array(
                'country_id' => $country_info['country_id'],
                'name' => $country_info['name'],
                'iso_code_2' => $country_info['iso_code_2'],
                'iso_code_3' => $country_info['iso_code_3'],
                'address_format' => $country_info['address_format'],
                'postcode_required' => $country_info['postcode_required'],
                'zone' => $this->getZonesByCountryId($country_id, $from, 'array'),
                'status' => $country_info['status'],
            );
        }
        //$this->response->addHeader('Content-Type: application/json');
        //$this->response->setOutput(json_encode($json));
        if ($returnformat == "json") {
            return $this->common->jsonencode($json);
            die();
        } else {
            return $json;
            die();
        }

    }
    public function getZonesByCountryId($country_id, $from = "WEB", $returnformat = "json")
    {
        $query = $this->db->query("SELECT * FROM  zone WHERE country_id = '" . (int) $country_id . "' AND status = '1' ORDER BY name");
        $zone_data = $query->result_array();
        if ($returnformat == "json") {
            return $this->common->jsonencode($zone_data);
            die();
        } else {
            return $zone_data;
            die();
        }
    }
    public function getZone($zone_id, $from = "WEB", $returnformat = "json")
    {
        $query = $this->db->query("SELECT * FROM zone WHERE zone_id = '" . (int) $zone_id . "' AND status = '1'");
        $data = $query->row_array();
        if ($returnformat == "json") {
            return $this->common->jsonencode($data);
            die();
        } else {
            return $data;
            die();
        }
    }
    public function getCountryNew($country_id, $from = "WEB", $returnformat = "json")
    {
        $query = $this->db->query("SELECT * FROM country WHERE country_id = '" . (int) $country_id . "' AND status = '1'");
        $data = $query->row_array();
        if ($returnformat == "json") {
            return $this->common->jsonencode($data);
            die();
        } else {
            return $data;
            die();
        }
    }
    public function getCountries($from = "WEB", $returnformat = "json")
    {
        $query = $this->db->query("SELECT * FROM country WHERE status = '1' ORDER BY name ASC");
        $country_data = $query->result_array();
        if ($returnformat == "json") {
            return $this->common->jsonencode($country_data);
            die();
        } else {
            return $country_data;
            die();
        }

    }
    public function getTotalOrderProductsByOrderId($order_id = 0, $from = "WEB", $returnformat = "json")
    {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM order_product WHERE order_id = '" . (int) $order_id . "'");

        $row = $query->row_array();

        return $row['total'];

    }
    public function getOrderProducts($order_id)
    {
        $query = $this->db->query("SELECT op.*, p.main_image, p.kg_bag,p.unit,p.unit_bag, p.name_en , p.driver_bonus ,p.carry_boy_bonus FROM order_product op
								left join 	product_master p on op.product_id = p.product_id
							 WHERE order_id = '" . (int) $order_id . "'");

        return $query->result_array();
    }
/*     public function getOrderProducts_vendor($order_id=0) {

$sSql = "SELECT distinct op.*,p.main_image, p.product_uuid  from order_product  op
inner join product_master p on op.product_id = p.product_id

WHERE op.order_id = '" . (int)$order_id . "'
ORDER BY op.order_product_id DESC";

$query = $this->db->query($sSql);

return $query->result_array() ;
} */
    public function getOrderTotals($order_id)
    {
        $query = $this->db->query("SELECT * FROM order_total WHERE order_id = '" . (int) $order_id . "' ORDER BY sort_order");

        return $query->result_array();
    }
    public function getOrderStatus($order_status_id)
    {
        $query = $this->db->query("SELECT * FROM master_order_status WHERE order_status_id = '" . (int) $order_status_id . "'   ");
        $row = $query->row_array();
        return $row;
    }
    public function getOrderHistories($order_id)
    {
        $query = $this->db->query("SELECT date_added, os.name AS status, oh.comment, oh.notify FROM order_history oh LEFT JOIN master_order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int) $order_id . "'   ORDER BY oh.date_added");

        return $query->result_array();
    }

    public function getOderlist($order_status = 1, $start = 0, $maxm = 25, $result = "rows")
    {
        $limit_qry = "";
        if ($maxm > 0) {
            $limit_qry = "LIMIT " . $start . "," . $maxm;
        }
        $other_para = "?v=l";
        $search_qry = " WHERE o.order_id!=0    and o.order_status_id in ($order_status) ";
// inner join user_master_front um on o.customer_id = um.user_id
        $sSql = "SELECT o.order_id, o.oorder_uid,o.invoice_no,o.customer_id, o.email,o.telephone,o.payment_company, o.shipping_company, o.payment_firstname,o.payment_lastname,o.payment_address_1,o.payment_postcode,o.payment_state_name,o.payment_district_name,o.payment_state_id,o.payment_district_id,o.payment_method,o.shipping_firstname,o.shipping_lastname,o.shipping_address_1,o.shipping_postcode,o.shipping_state_name,o.shipping_state_id,o.shipping_district_id,o.shipping_district_name ,o.comment ,o.total ,o.order_status_id,o.order_status_id as order_satus_code ,o.date_added,o.credit_pay_date, o.delivery_time ,o.order_delivery_date_expected ,o.shipping_longitude ,o.shipping_latitude , os.name as order_satus_name,o.complete_date, IFNULL(ro.rating, 0) as rating 
        FROM `order_master` o  inner join master_order_status os on o.order_status_id = os.order_status_id left join review_order ro on o.order_id = ro.order_id
        $search_qry
        ORDER BY o.order_id DESC";

        $query = $sSql . " " . $limit_qry;

        $query = $this->db->query($query);
        if ($result == "numrows") {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }

    }
    public function getOderlist_custom($order_status = 1, $start = 0, $maxm = 25, $result = "rows",$condtion="")
    {
        $limit_qry = "";
        if ($maxm > 0) {
            $limit_qry = "LIMIT " . $start . "," . $maxm;
        }
        $other_para = "?v=l";
        $search_qry = " WHERE o.order_id!=0    and o.order_status_id in ($order_status) ".$condtion;
// inner join user_master_front um on o.customer_id = um.user_id
         $sSql = "SELECT o.order_id, o.oorder_uid,o.invoice_no,o.customer_id, o.email,o.telephone,o.payment_company, o.shipping_company, o.payment_firstname,o.payment_lastname,o.payment_address_1,o.payment_postcode,o.payment_state_name,o.payment_district_name,o.payment_state_id,o.payment_district_id,o.payment_method,o.shipping_firstname,o.shipping_lastname,o.shipping_address_1,o.shipping_postcode,o.shipping_state_name,o.shipping_state_id,o.shipping_district_id,o.shipping_district_name ,o.comment ,o.total ,o.order_status_id,o.order_status_id as order_satus_code ,o.date_added,o.credit_pay_date, o.delivery_time ,o.order_delivery_date_expected ,o.shipping_longitude ,o.shipping_latitude , os.name as order_satus_name,o.complete_date, IFNULL(ro.rating, 0) as rating 
        FROM `order_master` o  inner join master_order_status os on o.order_status_id = os.order_status_id 
        left join review_order ro on o.order_id = ro.order_id
        $search_qry
        ORDER BY o.order_id DESC";

        $query = $sSql . " " . $limit_qry;

        $query = $this->db->query($query);
        if ($result == "numrows") {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }

    }
    public function getOderlistReviewPending( $start = 0, $maxm = 25, $result = "rows")
    {
        $limit_qry = "";
        if ($maxm > 0) {
            $limit_qry = "LIMIT " . $start . "," . $maxm;
        }
        $other_para = "?v=l";
        $search_qry = " WHERE o.order_status_id=4  and  ro.order_id  IS NULL    ";
// inner join user_master_front um on o.customer_id = um.user_id
        $sSql = "SELECT  o.order_id, o.oorder_uid,o.invoice_no,o.customer_id, o.email,o.telephone,o.payment_company, o.shipping_company, o.payment_firstname,o.payment_lastname,o.payment_address_1,o.payment_postcode,o.payment_state_name,o.payment_district_name,o.payment_state_id,o.payment_district_id,o.payment_method,o.shipping_firstname,o.shipping_lastname,o.shipping_address_1,o.shipping_postcode,o.shipping_state_name,o.shipping_state_id,o.shipping_district_id,o.shipping_district_name ,o.comment ,o.total ,o.order_status_id,o.order_status_id as order_satus_code ,o.date_added,o.credit_pay_date, o.delivery_time ,o.order_delivery_date_expected ,o.shipping_longitude ,o.shipping_latitude , os.name as order_satus_name,o.complete_date, IFNULL(ro.rating, 0) as rating   FROM `order_master` o
        inner join master_order_status os on o.order_status_id = os.order_status_id
        left join review_order ro on o.order_id = ro.order_id  
        $search_qry
        ORDER BY o.order_id DESC";

        $query = $sSql . " " . $limit_qry;

        $query = $this->db->query($query);
        if ($result == "numrows") {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }

    }
    public function getOderlistReviewDone( $start = 0, $maxm = 25, $result = "rows")
    {
        $limit_qry = "";
        if ($maxm > 0) {
            $limit_qry = "LIMIT " . $start . "," . $maxm;
        }
        $other_para = "?v=l";
        $search_qry = " WHERE o.order_status_id=4       ";
// inner join user_master_front um on o.customer_id = um.user_id
        $sSql = "SELECT o.order_id, o.oorder_uid,o.invoice_no,o.customer_id, o.email,o.telephone,o.payment_company, o.shipping_company, o.payment_firstname,o.payment_lastname,o.payment_address_1,o.payment_postcode,o.payment_state_name,o.payment_district_name,o.payment_state_id,o.payment_district_id,o.payment_method,o.shipping_firstname,o.shipping_lastname,o.shipping_address_1,o.shipping_postcode,o.shipping_state_name,o.shipping_state_id,o.shipping_district_id,o.shipping_district_name ,o.comment ,o.total ,o.order_status_id,o.order_status_id as order_satus_code ,o.date_added,o.credit_pay_date, o.delivery_time ,o.order_delivery_date_expected ,o.shipping_longitude ,o.shipping_latitude , os.name as order_satus_name,o.complete_date, IFNULL(ro.rating, 0) as rating ,ro.review_text  FROM `order_master` o
        inner join master_order_status os on o.order_status_id = os.order_status_id
        inner join review_order ro on o.order_id = ro.order_id  
        $search_qry
        ORDER BY o.order_id DESC";

        $query = $sSql . " " . $limit_qry;

        $query = $this->db->query($query);
        if ($result == "numrows") {
            return $query->num_rows();
        } else {
            return $query->result_array();
        }

    }
    public function getOrderStatuses($data = array())
    {
        if ($data) {
            $sql = "SELECT * FROM master_order_status  ORDER BY sort_order asc  ";

            $query = $this->db->query($sql);

            return $query->result_array();
        } else {

            $sql = "SELECT order_status_id, name FROM master_order_status   ORDER BY sort_order asc ";
            $query = $this->db->query($sql);

            $order_status_data = $query->result_array();

            return $order_status_data;
        }
    }
    public function getOrderStatusesForOrder($data = array())
    {
         

        $sql = "SELECT order_status_id, name FROM master_order_status  where status='Active'  ORDER BY sort_order asc ";
        $query = $this->db->query($sql);

        $order_status_data = $query->result_array();

        return $order_status_data;
    
    }
    public function get_ddriver_list()
    {
        $result_array = array();
        $sql = "select user_id, uuid, first_name,middle_name,last_name,email,mobile,gender,profile_pic,address_1,district_id,postcode,state_id,added_date   from user_master_front
     WHERE user_type='DRI' and  status in ('Active','Inactive')   order by first_name asc ,state_id asc, district_id asc ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
        die();
    }

    public function get_coolbox_list($user_id=0)
    {
        $result_array = array();
        $sql = "SELECT * FROM coolbox_cust_master WHERE status in ('Active','Inactive') AND cust_id=".$user_id." order by id desc   ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
        die();
    }
    //end of ecom  market place section'
    public function driver_order_recieved_list($order_id=0){
        $result_array = array();
          $sql = "SELECT od.*, um.user_id, um.uuid, um.first_name, um.last_name, profile_pic, mobile, email FROM `order_driver_assigned`  od 
                inner join user_master_front um  on od.driver_user_id = um.user_id  where    od.order_id='" . $order_id . "' order by status desc";
        $query = $this->db->query($sql);
      
        if ($query->num_rows() > 0) {
            $result_array = $query->result_array();
        }
        return $result_array;
        die();
    }

    public function sendNotificationToCustomer($order_info = array(), $token = '')
    {

        //  $url = FIREBASE_NOTIFICATION_URL;

        //   $token = $token;

        $serverKey = FIREBASE_API_KEY;
        $order_detail_url = FIREBASE_NOTIFICATION_ADMIN_ORDER_DETAIL_URL . $order_info['oorder_uid'] . "?l_s_act=1&page=0";
        //   $title = "Title";
        //   $body = "Body of the message";
        //   $notification = array('title' => $title, 'text' => $body, 'sound' => 'default', 'badge' => '1');
        $body_message = "Your order is under  process";
        $notification = [
            'title' => 'Order confirmed ('.$order_info['invoice_no'].') ',
            'body'  =>  $body_message,
            'sound' => FIREBASE_NOTIFICATION_MP3,
            'vibrate' => true,
            'click_action' => $order_detail_url,
            'icon'  =>  FIREBASE_NOTIFICATION_ICON,
            'image' => FIREBASE_NOTIFICATION_IMAGE,
        ];
        $data = [
            'order_id' => $order_info['order_id'],
        ];

        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high', 'data' => $data);
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, FIREBASE_NOTIFICATION_URL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Send the request
        $response = curl_exec($ch);
//Close request

        curl_close($ch);
       // return '';

    }
    public function setFirebaserealtimedata($recordtype = "insert", $orderinfo = array(), $status = "New Order")
    {

        $todaydate = date("Ymd");

        $serverKey = FIREBASE_API_KEY;
      

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, FIREBASE_DATABASE_PATH . '/orderlist/' . $todaydate . "/" . $orderinfo['order_id'] . ".json");

      
        if ($recordtype == "insert") {
            $arrayToSend = [
                'oorder_uid' => $orderinfo['oorder_uid'],
                'customer_id' => $orderinfo['customer_id'],
                'customername' => $orderinfo['payment_firstname'] . " " . $orderinfo['payment_lastname'],
                'telephone' => $orderinfo['telephone'],
                'invoice_no' => $orderinfo['invoice_no'],
                'shipping_address_1' => $orderinfo['shipping_address_1'],
                'shipping_state_name' => $orderinfo['shipping_state_name'],
                'delivery_time' => $orderinfo['delivery_time'],
                'payment_method' => $orderinfo['payment_method'],
                'total' => $this->common->tep_round($orderinfo['total']),
                'driver_id' => 0,
                'status_id' => $orderinfo['order_status_id'],
                'status' => $status,
            ];
            $json = json_encode($arrayToSend);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        }
        if ($recordtype == "update") {
            $arrayToSend = [
              
                'driver_id' => $orderinfo['driver_id'],
                'status_id' => $orderinfo['order_status_id'],
                'status' => $status,
            ];
            $json = json_encode($arrayToSend);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        }
        if ($recordtype == "delete") {
         //   curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
          //  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //Send the request
        $response = curl_exec($ch);
        //Close request
        curl_close($ch);
        //   echo $response . "\n";

    }
    public function getCarryBoyList($user_id = 0, $daily_date = "")
    {
        if ($daily_date == "") {
            $daily_date = date("Y-m-d");
        }
        $arr = [];

        $sql = "SELECT
            um.user_id,
            um.uuid,
            um.first_name,
            um.last_name,
            profile_pic,
            mobile,
            email,
            IF(cb.driver_id = $user_id, '1', '0') as favflag
        FROM
            user_master_front um
            inner join carryboy_dailylogs cbd on um.user_id = cbd.carryBoy_id  and  daily_date='" . $daily_date . "'   
            left join driver_fav_carryboy cb on um.user_id = cb.carryboy_id and cb.driver_id='".$user_id."'
           
        WHERE
              um.user_type = 'CMAN'
            AND um.status = 'Active' and cbd.driver_id='".$user_id."'
        order by
            first_name";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {

            $carryBoyList = $query->result_array();
            foreach ($carryBoyList as $users) {
                if ($users['profile_pic'] != '') {
                    $profile_pic = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($users['profile_pic']);
                } else {
                    $profile_pic = back_path . "uploads/noimage.png";
                }

                $usersinfo[] = array(
                    'carryboy_id' => $users['user_id'],
                    'uuid' => $users['uuid'],
                    'first_name' => $users['first_name'],
                    'last_name' => $users['last_name'],
                    'mobile' => $users['mobile'],
                    'email' => $users['email'],
                    'favflag' => $users['favflag'],
                    'profile_pic' => $profile_pic,
                );

            }

            $arr = $usersinfo;

        }
        return $arr;
    }
    public function getCustomerInfoById_inorder_confirm_temponly($user_id = '')
    {
        $customer_master_info = array();
        // $customer_master_info = $this->common->getSingleInfoBy("user_master_front", 'user_id', $user_id,'user_id,uuid,first_name,middle_name,last_name,email,mobile,gender,profile_pic,address_1,state_id,postcode,district_id');

        $sql = "select user_id,uuid    from user_master_front  um
        where     um.user_id='" . $user_id . "' ";
        $user_query = $this->db->query($sql);
        if ($user_query->num_rows() > 0) {
            $customer_master_info = $user_query->row_array();
        }
        return $customer_master_info;
    }
}
