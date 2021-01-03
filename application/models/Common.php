<?php
class Common extends CI_Model
{
    public function __construct()
    {
    }
    //old style
    public function getOneRow($table, $where)
    {
        $query = $this->db->query("select * from $table $where");
        return $query->row_array();
    }
    public function getAllRow($table, $where)
    {
        $query = $this->db->query("select * from $table $where");
        return $query->result_array();
    }
    public function numRow($table, $where)
    {
        //echo "select * from $table $where";
        $query = $this->db->query("select * from $table $where");
        return $query->num_rows();
    }
    public function getOneRecField($id, $table, $where)
    {
        $query = $this->db->query("select $id from $table $where limit 0,1");
        return $query->row_array();
    }
    public function getAllRec($select, $table, $where)
    {
        //echo "select $select from $table $where";
        $query = $this->db->query("select $select from $table $where");
        return $query->result_array();
    }
    public function insertRecord($table, $data)
    {
        $insert_id = $this->db->insert($table, $data);
        //$insert_id=mysql_insert_id();
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    //updateRecord
    public function updateRecord($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
    public function deleteRecord($table, $where)
    {
        $this->db->delete($table, $where);
    }
    //end of old style
    public function row_array($id = 0)
    {
        $id = isset($id) ? filter_var($id, FILTER_SANITIZE_NUMBER_INT) : '';
        $query = $this->db->query("SELECT * FROM  m_employee i  where i.emp_id = '" . (int) $id . "'   ");
        return $query->row_array();
    }
    public function result_array($id = 0)
    {
        $id = isset($id) ? filter_var($id, FILTER_SANITIZE_NUMBER_INT) : '';
        $sub_sql = "";
        if ($id > 0) {
            $sub_sql = " and store_id='" . $id . "'";
        }
        $query = $this->db->query("SELECT * FROM  m_employee i  where del_status=0 and is_active=1 " . $sub_sql . " ORDER BY   LCASE(i.emp_code)");
        return $query->result_array();
    }
    public function jsonencode($params)
    {
        $result = json_encode($params);
        return $result;
    }
    public function jsondecode($params)
    {
        // decode the JSON data
        $result = json_decode($params, true);
        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }
        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            return $error;
        }
        // everything is OK
        return $result;
    }
    public function get_asset_types()
    {
        $result_array = array();
        $query = $this->db->query("SELECT  auto_id, name_title FROM  assets_type_master  WHERE  delete_status=0 ORDER BY name_title ");
        $result_array = $query->result_array();
        return $result_array;
    }
    public function getSingleInfoBy($table = '', $field = '', $value = '', $columns = '*')
    {
        $result_array = array();
        try {
            $query = $this->db->query("SELECT $columns FROM  $table    where   $field = '" . $value . "'");
            if ($query->num_rows() > 0) {
                $result_array = $query->row_array();
            }
        } catch (Exception $e) {
            //exception handling code goes here
        }
        return $result_array;
    }
    public function getRecord($table = '', $search_qry = '', $columns = '*')
    {
        $result_array = array();
        try {
            $query = $this->db->query("SELECT  $columns FROM   $table  where   $search_qry" . "  limit 0,1");
            if ($query->num_rows() > 0) {
                $result_array = $query->row_array();
            }
        } catch (Exception $e) {
            //exception handling code goes here
        }
        return $result_array;
    }
    public function getRecordsLimit($table = '', $search_qry = "", $start = 0, $maxm = 0)
    {
        $limit_qry = "LIMIT " . $start . "," . $maxm;
        $resultdata = array();
        if ($maxm == 0) {
            $where_cond = $search_qry;
        } else {
            $where_cond = $search_qry . " " . $limit_qry;
        }
        try {
            $sql = "select  * from  $table um   " . $where_cond;
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $resultdata = $query->result_array();
            }
        } catch (Exception $e) {
            //exception handling code goes here
        }
        return $resultdata;
    }
    public function getRecordsCount($table = '', $search_qry = "")
    {
        try {
            $query = $this->db->query("select  count('') as total from  $table um   " . $search_qry);
            if ($query->num_rows() > 0) {
                $resultdata = $query->row_array();
                return $resultdata['total'];
            }
        } catch (Exception $e) {
            //exception handling code goes here
        }
        return 0;
    }
    public function getUniqueSlug($table = '', $field = '', $value = '', $columns = '*')
    {
        $value = isset($slug_name) ? filter_var($value, FILTER_SANITIZE_STRING) : '';
        // $data_info = array();
        $query = $this->db->query("select $columns from $table where $field like '" . $value . "%'");
        if ($query->num_rows() > 0) {
            //->row_array()
            // $data_info = $query->result_array();
            $value = $value . "-" . $query->num_rows();
        }
        return $value;
    }
    public function getSessionValue()
    {
        return $this->session->userdata('user_data');
    }
    public function dateDiff($date)
    {
        $minutes = (time() - $date) / 60;
        return $minutes;
    }
    public function dateCompare($date1)
    {
        //date = "Y-m-d H:i" format hona chahiye
        $date1 = trim(str_replace("uur", "", $date1));
        if ($date1 != "") {
            $date1 = new DateTime($date1);
            $date2 = new DateTime(date("Y-m-d H:i"));
            // Compare the dates
            if ($date1 > $date2) {
                return true;
            }
        }
        return false;
    }
    public function getStandardDateTime($date1)
    {
        //date = "Y-m-d H:i" format hona chahiye
        $date1 = trim(str_replace("uur", "", $date1));
        return $date1;
    }
    public function getUserInfo($id = 0)
    {
        $id = isset($id) ? filter_var($id, FILTER_SANITIZE_STRING) : '0';
        $result_array = array();
        $query = $this->db->query("SELECT * FROM  user_master p  where   uuid='" . $id . "'");
        if ($query->num_rows() > 0) {
            $result_array = $query->row_array();
        }
        return $result_array;
    }
    public function getUserInfoBy($table = "", $field = '', $value = "")
    {
        $field = isset($field) ? filter_var($field, FILTER_SANITIZE_STRING) : '';
        $value = isset($value) ? filter_var($value, FILTER_SANITIZE_STRING) : '';
        $result_array = array();
        try {
            $query = $this->db->query("SELECT * FROM  $table    where   $field = '" . $value . "'");
            if ($query->num_rows() > 0) {
                $result_array = $query->row_array();
            }
        } catch (Exception $e) {
            //exception handling code goes here
        }
        return $result_array;
    }
    public function geTableDatas($table = "", $field = "delete_status", $value = "0")
    {
        $resultdata = array();
        try {
            if ($this->db->table_exists($table)) {
                $this->db->where($field, $value);
                $query = $this->db->get($table);
                $resultdata = $query->result_array();
            }
        } catch (Exception $e) {
        }
        return $resultdata;
    }
    public function field_data($table = "")
    {
        if ($this->db->table_exists($table)) {
            return $this->db->field_data($table);
        }
    }
    public function list_fields($table = "")
    {
        if ($this->db->table_exists($table)) {
            return $this->db->list_fields($table);
        }
    }
    public function pbkdf2($p, $s, $c, $kl, $a = 'sha256')
    {
        $hl = strlen(hash($a, null, true));
        $kb = ceil($kl / $hl);
        $dk = '';
        for ($block = 1; $block <= $kb; $block++) {
            $ib = $b = hash_hmac($a, $s . pack('N', $block), $p, true);
            for ($i = 1; $i < $c; $i++) {
                $ib ^= ($b = hash_hmac($a, $b, $p, true));
            }
            $dk .= $ib;
        }
        return substr($dk, 0, $kl);
    }
    public function extract_emails_from($string)
    {
        preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
        return $matches[0];
    }
    public function mysql_safe_detail($value)
    {
        $value = isset($value) ? $value : '';
        $value = trim($value);
        $value = encode_php_tags($value);
        $value = htmlspecialchars($value);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        //$value=mysql_real_escape_string($value);
        return $value;
    }
    /* -------------------------------------------------------------------------- */
    public function mysql_safe_string($value)
    {
        /*error_reporting(E_ALL);
        if (function_exists('mysql_real_escape_string')) {
        echo "Function is available.<br />\n";
        } else {
        echo "Function is not available.<br />\n";
        }    */
        //$value=$this->input->xss_clean($value);
        $value = isset($value) ? $value : '';
        $value = trim($value);
        $value = strip_image_tags($value);
        $value = encode_php_tags($value);
        //$value  =    htmlspecialchars($value);
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        //$value=mysql_real_escape_string($value);
        return $value;
    }
    public function mysql_safe_string_descriptive($value)
    {
        $value = strip_image_tags($value);
        $value = encode_php_tags($value);
        $value = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
        return $value;
    }
    public function versioning($file)
    {
        $curl = curl_init($file);
        //don't fetch the actual page, you only want headers
        curl_setopt($curl, CURLOPT_NOBODY, true);
        //stop it from outputting stuff to stdout
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // attempt to retrieve the modification date
        curl_setopt($curl, CURLOPT_FILETIME, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        /*if ($result === false) {
        die (curl_error($curl));
        }*/
        //echo curl_error($curl);
        $timestamp = curl_getinfo($curl, CURLINFO_FILETIME);
        if ($timestamp != -1) {
            return $file . '?' . $timestamp;
        } else {
            return $file . '?1234567890';
        }
    }
    public function genRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmn0pqrstuvwxyz';
        $string = '';
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters))];
        }
        return $string;
    }
    public function randomWithLength($length)
    {
        $number = '';
        for ($i = 0; $i < $length; $i++) {
            $number .= rand(0, 9);
        }
        return (int) $number;
    }
    public function EmailValidation($email)
    {
        $email = htmlspecialchars(stripslashes(strip_tags($email))); //parse unnecessary characters to prevent exploits
        if (preg_match('[a-z||0-9]@[a-z||0-9].[a-z]', $email)) { //checks to make sure the email address is in a valid format
            $domain = explode("@", $email); //get the domain name
            if (@fsockopen($domain[1], 80, $errno, $errstr, 3)) {
                //if the connection can be established, the email address is probabley valid
                return true;
                /*
            GENERATE A VERIFICATION EMAIL
             */
            } else {
                return false; //if a connection cannot be established return false
                return 0;
            }
        } else {
            return 1;
        }
    }
    //--------------------------------------------------------------------------------------------
    public function format_numberIDR($n = '')
    {
        if ($n == '') {
            return '';
        }
        // Remove anything that isn't a number or decimal point.
        $n = trim(preg_replace('/([^0-9\.])/i', '', $n));
        return number_format($n, 0, '', '.');
        //return number_format($n, 2, ',', '.');
        //return substr(number_format($n, 2, ',', '.'),0,-3);
    }
    public function numberformat($number = '', $decimal = 2)
    {
        if ($number == '') {
            return '';
        }
        // Remove anything that isn't a number or decimal point.
        $number = $number * 1;
        return $number;
      //  return number_format($number, $decimal, '.', '');
    }
    function tep_round($number, $precision=2) {
        if (strpos($number, '.') && (strlen(substr($number, strpos($number, '.')+1)) > $precision)) {
          $number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);
    
          if (substr($number, -1) >= 5) {
            if ($precision > 1) {
              $number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision-1) . '1');
            } elseif ($precision == 1) {
              $number = substr($number, 0, -1) + 0.1;
            } else {
              $number = substr($number, 0, -1) + 1;
            }
          } else {
            $number = substr($number, 0, -1);
          }
        }
        $string = number_format($number, (int)$precision, '.', ',');

        return $string ;
      }
    
    public function GenerateKey($length = 15)
    {
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= chr(mt_rand(33, 126));
        }
        return $key;
    }
    public function clean_ads_title($str)
    {
        $str = str_replace(" ", "SPACE", $str);
        $str = preg_replace("/[^a-zA-Z0-9]+/", "", $str);
        $str = str_replace("SPACE", "-", $str);
        $str = str_replace("&", "and", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("?", "", $str);
        $str = str_replace(",", "", $str);
        $str = strtolower($str);
        return $str;
    }
    public function clean_str($str)
    {
        $str = str_replace("&", "and", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("?", "", $str);
        $str = str_replace(" ", "-", $str);
        $str = str_replace(",", "", $str);
        $str = strtolower($str);
        return $str;
    }
    public function un_clean_str($str)
    {
        $str = str_replace("and", "&", $str);
        $str = str_replace("-", " ", $str);
        return $str;
    }
    public function PasswordStrength($password)
    {
        if (strlen($password) == 0) {
            return 'Zwak';
        }
        $strength = 0;
        /*** get the length of the password ***/
        $length = strlen($password);
        /*** check if password is not all lower case ***/
        if (strtolower($password) != $password) {
            $strength += 1;
        }
        /*** check if password is not all upper case ***/
        if (strtoupper($password) == $password) {
            $strength += 1;
        }
        /*** check string length is 8 -15 chars ***/
        if ($length >= 8 && $length <= 15) {
            $strength += 1;
        }
        /*** check if lenth is 16 - 35 chars ***/
        if ($length >= 16 && $length <= 35) {
            $strength += 2;
        }
        /*** check if length greater than 35 chars ***/
        if ($length > 35) {
            $strength += 3;
        }
        /*** get the numbers in the password ***/
        preg_match_all('/[0-9]/', $password, $numbers);
        $strength += count($numbers[0]);
        /*** check for special chars ***/
        preg_match_all('/[|!@#$%&*\/=?,;.:\-_+~^\\\]/', $password, $specialchars);
        $strength += sizeof($specialchars[0]);
        /*** get the number of unique chars ***/
        $chars = str_split($password);
        $num_unique_chars = sizeof(array_unique($chars));
        $strength += $num_unique_chars * 2;
        //$password = '@412!23~+:[^???';
        /*** strength is a number 1-10; ***/
        $strength = $strength > 99 ? 99 : $strength;
        $strength = floor($strength / 10 + 1);
        if (($strength >= 1) && ($strength < 2)) {
            return 'Zwak';
        }
        if (($strength >= 2) && ($strength < 3)) {
            return 'Normaal';
        }
        if (($strength >= 3) && ($strength < 4)) {
            return 'Goed';
        }
        if (($strength >= 4) && ($strength <= 10)) {
            return 'Uitstekend';
        }
        return $strength;
    }
    public function encryptIt($q)
    {
        $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }
    public function rand_str($length)
    {
        $chars = "0123456789./qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
        //only allowed chars in the blowfish salt.
        $size = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        // strings can be used as char arrays
        // Yes, I am aware this salt isn't generated using the OS source.
        // use mycrypt_create_iv or /dev/urandom/
        return $str;
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
    public function addhttp($url)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }
    public function gen_key($length = 8)
    {
        $r = 0;
        $bad_chars = array(58, 59, 60, 61, 62, 63, 64, 91, 92, 93, 94, 95, 96);
        mt_srand(time());
        while (strlen($r) < $length) {
            $tmp = mt_rand(48, 122);
            if (in_array($tmp, $bad_chars)) {
                continue;
            }
            $r .= chr($tmp);
        }
        return $r;
    }
    public function get_age($usr_b = '')
    {
        $usr_b = str_replace("/", "-", $usr_b);
        $to_date = date('Y-m-d');
        $date1 = strtotime($to_date);
        $date2 = strtotime($usr_b);
        $time_difference = $date1 - $date2;
        $seconds_per_year = 60 * 60 * 24 * 365;
        $years = round($time_difference / $seconds_per_year);
        //print_r($years);
        return $years;
    }
    public function format_phone($phone)
    {
        $ret_phone = '';
        $phone = preg_replace("/[^0-9]/", "", $phone);
        $len = strlen($phone);
        if ($len >= 11) {
            $phone = substr($phone, 1);
        }
        if ($phone != '') {
            $ret_phone .= "(" . substr($phone, 0, 3) . ") ";
            $ret_phone .= substr($phone, 3, 3);
            $ret_phone .= "-" . substr($phone, 6, 10);
        }
        return $ret_phone;
    }
    public function getDbValue($str)
    {
        $str = str_replace('$', '&#36;', $str);
        return stripslashes(htmlspecialchars_decode($str));
        //return stripslashes($str);
    }
    public function getDateFormat($date, $format = "d-M-Y")
    {
        $date = new DateTime($date);
        $newDateString = $date->format($format);
        return $newDateString;
    }
//FILE  FUNCTIONS
#function for uploading and resizing image
#$fileField    : file filed name
#$path            : path where file is to be uploaded e.g. images/hotel
#$isResize     : flag whether to resize image
#$height_thumb : Thumnail Height
#$width_thumb  : Thumnail Width
#$image_name   : image to remamed to e.g. tajhotel (do not include extesion)
#$tempDir      : temparary folder whare image to be uploaded while resizing
    public function UploadImage($fileField, $path, $image_name = '')
    {
        $errors = 0;
        if (!is_dir($path)) {
            return array("uploaded" => "false", "uploadMsg" => "Destination Directory Does Not Found", "imageFile" => "");
        }
        $filename = $_FILES[$fileField]['name'];
        if ($filename != '') {
            $extension = $this->getExtension($filename);
            $extension = strtolower($extension);
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                $errors = 1;
                $returnArray = array("uploaded" => "false", "uploadMsg" => "Invalid File Extension!", "imageFile" => "");
            } else {
                if ($image_name == '') {
                    $image_name = time() . '.' . $extension;
                } else {
                    $image_name .= '.' . $extension;
                }
                $newname = $path . '/' . $image_name;
                $copied = copy($_FILES[$fileField]['tmp_name'], $newname);
                if (!$copied && $errors == 1) {
                    $errors = 1;
                    $returnArray = array("uploaded" => "false", "uploadMsg" => "Copy Unsuccessfull!", "imageFile" => "");
                }
            } //else
        } else {
            $returnArray = array("uploaded" => "false", "uploadMsg" => "Image is Required", "imageFile" => "");
            return $returnArray;
        }
        if ($errors != 1) {
            $returnArray = array("uploaded" => "true", "uploadMsg" => "Image is uploadded successfully....", "imageFile" => $image_name);
        }
        return $returnArray;
    }
    public function UploadFiles($fileField, $path, $image_name = '', $file_allowed = array('csv', 'xls', 'xlsx', 'doc', 'docx', 'pdf', 'zip'))
    {
        $errors = 0;
        if (!is_dir($path)) {
            return array("uploaded" => "false", "uploadMsg" => "Destination Directory Does Not Found", "imageFile" => "");
        }
        $filename = $_FILES[$fileField]['name'];
        if ($filename != '') {
            $extension = $this->getExtension($filename);
            $extension = strtolower($extension);
            //print_r($file_allowed);
            if (!in_array($extension, $file_allowed)) {
                $errors = 1;
                $returnArray = array("uploaded" => "false", "uploadMsg" => "Invalid File Extension! " . $extension, "imageFile" => "");
            } else {
                if ($image_name == '') {
                    $image_name = time() . '.' . $extension;
                } else {
                    $image_name .= '.' . $extension;
                }
                $newname = $path . '/' . $image_name;
                $copied = copy($_FILES[$fileField]['tmp_name'], $newname);
                if (!$copied && $errors == 1) {
                    $errors = 1;
                    $returnArray = array("uploaded" => "false", "uploadMsg" => "Copy Unsuccessfull!", "imageFile" => "");
                }
            } //else
        } else {
            $returnArray = array("uploaded" => "false", "uploadMsg" => "File is Required", "imageFile" => "");
            return $returnArray;
        }
        if ($errors != 1) {
            $returnArray = array("uploaded" => "true", "uploadMsg" => "File is uploadded successfully....", "imageFile" => $image_name);
        }
        return $returnArray;
    }
    public function UploadFileAny($fileField, $path, $image_name = '', $file_not_allowed = array('php', 'exe', 'ini'))
    {
        $errors = 0;
        if (!is_dir($path)) {
            return array("uploaded" => "false", "uploadMsg" => "Destination Directory Does Not Found", "imageFile" => "");
        }
        $filename = $_FILES[$fileField]['name'];
        if ($filename != '') {
            $extension = $this->getExtension($filename);
            $extension = strtolower($extension);
            //print_r($file_allowed);
            if (in_array($extension, $file_not_allowed)) {
                $errors = 1;
                $returnArray = array("uploaded" => "false", "uploadMsg" => "Invalid File Extension! " . $extension, "imageFile" => "");
            } else {
                if ($image_name == '') {
                    $image_name = time() . '.' . $extension;
                } else {
                    $image_name .= '.' . $extension;
                }
                $newname = $path . '/' . $image_name;
                $copied = copy($_FILES[$fileField]['tmp_name'], $newname);
                if (!$copied && $errors == 1) {
                    $errors = 1;
                    $returnArray = array("uploaded" => "false", "uploadMsg" => "Copy Unsuccessfull!", "imageFile" => "");
                }
            } //else
        } else {
            $returnArray = array("uploaded" => "false", "uploadMsg" => "File is Required", "imageFile" => "");
            return $returnArray;
        }
        if ($errors != 1) {
            $returnArray = array("uploaded" => "true", "uploadMsg" => "File is uploadded successfully....", "imageFile" => $image_name);
        }
        return $returnArray;
    }
    public function getExtension($str)
    {
        $i = strrpos($str, ".");
        if (!$i) {return "";}
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
    public function GenerateNumber($min = 4, $max = 10)
    {
        // Create the meta-password
        $sMetaPassword = "";
        global $CONFIG;
        $ahPasswordGenerator = array(
            "C" => array('characters' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 'minimum' => $min, 'maximum' => $max),
            //"S" => array('characters' => "!@()-_=+?*^&", 'minimum' => 2, 'maximum' => 2),
            "N" => array('characters' => '1234567890', 'minimum' => $min, 'maximum' => $max),
        );
        foreach ($ahPasswordGenerator as $cToken => $ahPasswordSeed) {
            $sMetaPassword .= str_repeat($cToken, rand($ahPasswordSeed['minimum'], $ahPasswordSeed['maximum']));
        }
        $sMetaPassword = str_shuffle($sMetaPassword);
        // Create the real password
        $arBuffer = array();
        for ($i = 0; $i < strlen($sMetaPassword); $i++) {
            $arBuffer[] = $ahPasswordGenerator[(string) $sMetaPassword[$i]]['characters'][rand(0, strlen($ahPasswordGenerator[$sMetaPassword[$i]]['characters']) - 1)];
        }
        return implode("", $arBuffer);
    }
    public function tep_short_name_list($string, $options = array())
    {
        $string = str_replace(" ", "-", $string);
        $pattern = "/[^a-z0-9- ]/i";
        $string = preg_replace('/((&#39))/', '-', strtolower($string)); //remove apostrophe - not caught by above
        $anchor = preg_replace($pattern, '', strtolower($string));
        $pattern = "([[:space:]]|[[:blank:]])";
        $string = preg_replace($pattern, '', $anchor);
        $string = str_replace("--", "-", $string);
        return $string;
    }
    public function daysDifference($endDate, $beginDate)
    {
        $date_parts1 = explode("-", $beginDate);
        $date_parts2 = explode("-", $endDate);
        $start_date = gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
        $end_date = gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
        $diff = $end_date - $start_date;
        echo $diff;
        $years = floor($diff / (365.25 * 60 * 60 * 24));
        return $years;
    }
    public function get_ip()
    {
        //Just get the headers if we can or else use the SERVER global.
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }
        //Get the forwarded IP if it exists.
        if (array_key_exists('X-Forwarded-For', $headers) && filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $the_ip = $headers['X-Forwarded-For'];
        } elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) && filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
        } else {
            $the_ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        }
        return $the_ip;
    }
    public function session_name()
    {
        $session_user_data = $this->session->userdata('user_data');
        return $session_user_data['first_name'] . " " . $session_user_data['last_name'];
    }
    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
    public function get($key = '')
    {
        $value = "";
        $query = $this->db->query("SELECT * FROM `setting` where `key`='" . $key . "' ");
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            if ($row['serialized']) {
                $value = json_decode($this->common->getDbValue($row['value']));
            } else {
                $value = $this->common->getDbValue($row['value']);
            }
        }
        return $value;
    }
    public function check_user_session($current_site_url = '')
    {
        $current_site_url = $current_site_url;
        $session_user_data = $this->session->userdata('user_data');
        if (!isset($session_user_data['user_id'])) {
            //redirect( $this->config->item('site_url'));
            redirect(site_url());
        }
    }
    /////////////////////////////
    public function getUniqueUserSlug($slug_name)
    {
        $slug_name = isset($slug_name) ? filter_var($slug_name, FILTER_SANITIZE_STRING) : '';
        $data_info = array();
        $query = $this->db->query("select * from user_master where `slug_name` like '" . $slug_name . "%'");
        if ($query->num_rows() > 0) {
            //->row_array()
            $data_info = $query->result_array();
            $slug_name = $slug_name . "-" . $query->num_rows();
        }
        return $slug_name;
    }
    public function stafflist($start = 0, $maxm = 100, $search_qry = "", $order_by = "")
    {
        $limit_qry = "LIMIT " . $start . "," . $maxm;
        $resultdata = array();
        if ($maxm == 0) {
            $where_cond = " $search_qry  " . $order_by;
        } else {
            $where_cond = " $search_qry " . $order_by . $limit_qry;
        }
        $sql = "select  * from  user_master um   " . $where_cond;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $resultdata = $query->result_array();
        }
        return $resultdata;
    }
    public function stafflist_count($search_qry = "", $order_by = "")
    {
        $sql = "select  count('') as total from  user_master um   " . $search_qry . $order_by;
        $query = $this->db->query($sql);
        $resultdata = $query->row_array();
        return $resultdata['total'];
    }
    public function doctorlist($start = 0, $maxm = 100, $search_qry = "", $order_by = "")
    {
        $limit_qry = "LIMIT " . $start . "," . $maxm;
        $resultdata = array();
        if ($maxm == 0) {
            $where_cond = " $search_qry  " . $order_by;
        } else {
            $where_cond = " $search_qry " . $order_by . $limit_qry;
        }
        $sql = "select  * from  doctors_master um   " . $where_cond;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $resultdata = $query->result_array();
        }
        return $resultdata;
    }
    public function doctorlist_count($search_qry = "", $order_by = "")
    {
        $sql = "select  count('') as total from  doctors_master um   " . $search_qry . $order_by;
        $query = $this->db->query($sql);
        $resultdata = $query->row_array();
        return $resultdata['total'];
    }
//
    public function getCity($id = 1, $zonearea_id = 0)
    {
        $where = "where delete_status=0 and status='Active' order by name asc";
        $results = $this->getAllRow('master_city', $where);
        $combo .= "<option value='' >Select City</option>";
        foreach ($results as $key => $value) {
            if ($id == $value['id']) {
                $combo .= "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
            } else {
                $combo .= "<option value='" . $value['id'] . "' >" . $value['name'] . "</option>";
            }
        }
        return $combo;
    }
    public function get_zone_area($city_id = 1, $zonearea_id = 0)
    {
        $city_id = $this->common->mysql_safe_string($city_id);
        $zonearea_id = $this->common->mysql_safe_string($zonearea_id);
        $sql = "select * from master_zone where city_id='" . $city_id . "' and delete_status=0 and status='Active' order by name asc   ";
        $query_result = $this->db->query($sql);
        $results = $query_result->result_array();
        $combo = "<option value='' >Select Zone area</option>";
        foreach ($results as $key => $value) {
            if ($value['id'] == $zonearea_id) {
                $combo .= "<option value='" . $value['id'] . "' selected>" . $value['name'] . "</option>";
            } else {
                $combo .= "<option value='" . $value['id'] . "' >" . $value['name'] . "</option>";
            }
        }
        echo $combo;
    }
    public function get_mobiledevice($mobile_device_id = 0)
    {
        $mobile_device_id = $this->common->mysql_safe_string($mobile_device_id);
        $sql = "select * from master_mobile_phones where  delete_status=0 and status='Active' order by name asc   ";
        $query_result = $this->db->query($sql);
        $results = $query_result->result_array();
        $combo = "<option value='' >Select Device</option>";
        foreach ($results as $key => $value) {
            if ($value['id'] == $mobile_device_id) {
                $combo .= "<option value='" . $value['id'] . "' selected>" . $value['name'] . ' (' . $value['mobile_number1'] . ')' . "</option>";
            } else {
                $combo .= "<option value='" . $value['id'] . "' >" . $value['name'] . ' (' . $value['mobile_number1'] . ')' . "</option>";
            }
        }
        echo $combo;
    }
    public function showImage($path = '', $img = '')
    {
        if ($img == "") {
            return base_url() . "assets/images/noimageproduct.png";
        }
        if (file_exists($path . $img)) {
            return base_url() . $path . $img;
        } else {
            return base_url() . "image/" . $img;
            // return "uploads/grey-no-image.jpg";
        }
    }
    public function check_access_token($access_token = '', $user_id = '')
    {
        $sql = "select '' from user_master_front  where  access_token='".$access_token."' ";
        $query_result = $this->db->query($sql);
        if($query_result->num_rows()>0){
            return 1;
        } 
        return 0;
    }
    public function get_sms_data($id = 0)
    {
        if($id==1){
            return "Dear User, your OTP for Aber registration is #REG_OTP#. Use this OTP for user verification";
        }
        
	}
}
