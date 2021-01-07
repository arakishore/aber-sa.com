<?php
error_reporting(E_ALL);
//use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Ramsey\Uuid\Uuid;

class Services extends CI_Model
{

    public function __construct()
    {

    }
    public function getKeyValue($key = '')
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
    public function doRegister($params = array(), $returnType = 'ARRAY')
    {
        $add_in = array();
        $errorData = array();
        $errorMessage = "";

        $add_in['user_type'] = (isset($params['user_type'])) ? $this->common->mysql_safe_string($params['user_type']) : 'Customer';

        $add_in['first_name'] = (isset($params['first_name'])) ? $this->common->mysql_safe_string($params['first_name']) : '';
        $add_in['last_name'] = (isset($params['last_name'])) ? $this->common->mysql_safe_string($params['last_name']) : '';
        $add_in['middle_name'] = (isset($params['middle_name'])) ? $this->common->mysql_safe_string($params['middle_name']) : null;
        $add_in['mobile'] = (isset($params['mobile'])) ? $this->common->mysql_safe_string($params['mobile']) : null;
        $add_in['status_flag'] = 'Inactive';
        $add_in['email'] = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        $add_in['passphrase'] = $passphrase = (isset($params['passphrase'])) ? $this->common->mysql_safe_string($params['passphrase']) : '';
        $add_in['user_language'] = $LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
        $add_in['device_id'] = $device_id = (isset($params['device_id'])) ? $this->common->mysql_safe_string($params['device_id']) : '';
        $add_in['device_type'] = $device_type = (isset($params['device_type'])) ? $this->common->mysql_safe_string($params['device_type']) : '';

        $add_in['country_code'] = (isset($params['country_code'])) ? $this->common->mysql_safe_string($params['country_code']) : '';

        if ($errorMessage == "") {
            $chkUserInfo = $this->common->getSingleInfoBy('user_master_front', 'email', $add_in['email'], 'email');
            if (sizeof($chkUserInfo) > 0) {
                $errorMessage = $add_in['email'] . "  is already registered";
            }
            $chkUserInfo = $this->common->getSingleInfoBy('user_master_front', 'mobile', $add_in['mobile'], 'mobile');
            if (sizeof($chkUserInfo) > 0) {
                $errorMessage = $add_in['mobile'] . "  is already registered";
            }
        }

        if ($errorMessage == "") {
            try {
                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $uuid = $uuid4->toString();
                $add_in['uuid'] = $uuid;
            } catch (UnsatisfiedDependencyException $e) {

            }
            $add_in['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
            $add_in['added_date'] = date("Y-m-d H:i:s");
            $this->common->insertRecord('user_master_front', $add_in);
            $chkUserInfo = $this->common->getSingleInfoBy('user_master_front', 'uuid', $add_in['uuid'], '*');

            try {
                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $uuid_shipping = $uuid4->toString();
                $address_in['uuid'] = $uuid_shipping;
            } catch (UnsatisfiedDependencyException $e) {

            }
            $address_in['address_name'] = 'Home';
            $address_in['address_1'] = (isset($params['address_1'])) ? $this->common->mysql_safe_string($params['address_1']) : '';
            $address_in['state_id'] = (isset($params['state_id'])) ? $this->common->mysql_safe_string($params['state_id']) : '';
            $address_in['city_id'] = (isset($params['city_id'])) ? $this->common->mysql_safe_string($params['city_id']) : '';
            $address_in['postcode'] = (isset($params['postcode'])) ? $this->common->mysql_safe_string($params['postcode']) : '';
            $address_in['user_id'] = $chkUserInfo['user_id'];
            $address_in['firstname'] = $add_in['first_name'];
            $address_in['lastname'] = $add_in['last_name'];
            $address_in['is_default'] = 1;

           // $this->db->insert('customer_shipping_address', $address_in);
           // $userAddressInfo = $this->common->getSingleInfoBy('customer_shipping_address', 'uuid', $address_in['uuid'], '*');

            $userInfo = $this->userProfileData($chkUserInfo);
            $userInfo['ask_for_email'] = 0; 
            $retUserAddressInfo = [];// $this->userAddressData($userAddressInfo);
            $arr['status'] = 1;
            $arr['errorData'] = [];
            $arr['userInfo'] = $userInfo;
            $arr['temp_otp'] = $temp_otp;
            $arr['addressInfo'] = $retUserAddressInfo;
            $arr['call_next_api'] = 'doOTPverification';
            $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box. Please check your mail';

            // $sendotp_data = $this->sendotp($user_info);

            /*  $sql = "select * from  `setting` where `group`='config_site_mail'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        $m_setting = $query->result_array();

        foreach ($m_setting as $key => $val) {
        $config_site_mail[$val['key']] = $val['value'];
        }

        $subject = "Complete your registration!";

        $fileg = file_get_contents("uploads/mail_register.html");
        $full_name = $chkUserInfo['first_name'] . " " . $chkUserInfo['last_name'];
        $pattern = array('/{FULLNAME}/', '/{OTP}/');
        $replacement = array($full_name, $temp_otp);
        $mess_body = preg_replace($pattern, $replacement, $fileg);

        try {
        //Server settings
        $email = $chkUserInfo['email'];
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isMail(); // Send using SMTP

        $mail->Host = $config_site_mail['config_smtp_host']; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $config_site_mail['config_smtp_username']; // SMTP username
        $mail->Password = $config_site_mail['config_smtp_password']; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = $config_site_mail['config_smtp_port']; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $admin_mail_id = $config_site_mail['config_site_mail'];

        $mail->setFrom($admin_mail_id, $config_site_mail['config_site_from_name']);
        // $email = "swamiwebservices@gmail.com";

        $mail->addAddress($email, $full_name); // Add a recipient

        $mail->addReplyTo($admin_mail_id, $config_site_mail['config_site_from_name']);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $mess_body;
        //  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box.Please check your mail';

        // echo 'Message has been sent';
        } catch (Exception $e) {
        //  $error_msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //    $errorData[] = 'Message could not be sent.';
        //   $arr['status'] = 0;
        //  $arr['retData'] = $params;
        //  $arr['errorData'] = $errorData;
        //  $arr['errorMessage'] = 'OTP could not be sent.';
        }

        }   */

        } else {
            $errorData[] = $errorMessage;
            // $arr = array('status' => 0, 'retData' => $params, 'errorData' => $errorData);
            $arr['status'] = 0;
            $arr['retData'] = $params;
            // $arr['errorData'] = $errorData;
            $arr['errorMessage'] = $errorMessage;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
        }

    }

    public function doOTPverification($params = array(), $returnType = 'ARRAY')
    {

        $add_in = array();
        // $add_in['user_id'] = $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '';
        $add_in['email'] = $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        $add_in['temp_otp'] = $temp_otp = (isset($params['temp_otp'])) ? $this->common->mysql_safe_string($params['temp_otp']) : '';
        $errorData = array();

        $sql = "select * from user_master_front where email='" . $email . "' and temp_otp='" . $temp_otp . "'";
        $rs_login_row = $this->db->query($sql);
        if ($rs_login_row->num_rows() > 0) {

            $chkUserInfo = $rs_login_row->row_array();

            $sql_data_array = array(
                'status_flag' => 'Active',
                'is_email_verified' => '1',
                'email_verified_date' => date("Y-m-d H:i:s"),
                'login_time' => date("Y-m-d H:i:s"),
                'is_login' => 1,
                'edit_date' => date("Y-m-d H:i:s"),
            );

            $where = "email = '" . $email . "' and temp_otp='" . $temp_otp . "'";

            $this->common->updateRecord('user_master_front', $sql_data_array, $where);

            $chkUserInfo = $this->common->getSingleInfoBy('user_master_front', 'email', $email, '*');
            $userInfo = $this->userProfileData($chkUserInfo);
            $retUserAddressInfo = $this->getDefaultAddress($chkUserInfo);

            $arr['status'] = 1;
            $arr['userInfo'] = $userInfo;
            $arr['addressInfo'] = $retUserAddressInfo;
            $arr['call_next_api'] = 'RedirectHome';
            $arr['successMessage'] = "Congratulations! OTP Verified";

        } else {
            $errorData[] = 'OTP mismatched';
            $errorMessage = 'OTP mismatched';
            $arr['status'] = 0;
            $arr['retData'] = $params;
            // $arr['errorData'] = $errorData;
            $arr['errorMessage'] = $errorMessage;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function doLogin($params = array(), $returnType = 'ARRAY')
    {
        $add_in = array();
        $add_in['username'] = $username = (isset($params['username'])) ? $this->common->mysql_safe_string($params['username']) : '';
        $add_in['passphrase'] = $passphrase = (isset($params['passphrase'])) ? $this->common->mysql_safe_string($params['passphrase']) : '';

        $add_in['device_id'] = $device_id = (isset($params['device_id'])) ? $this->common->mysql_safe_string($params['device_id']) : '';
        $add_in['device_type'] = $device_type = (isset($params['device_type'])) ? $this->common->mysql_safe_string($params['device_type']) : '';

        $errorData = array();
        // AND status_flag='Active'
        $sql = "select * from user_master_front where ((email='" . $username . "' AND passphrase='" . $passphrase . "' )  || (mobile='" . $username . "' AND passphrase='" . $passphrase . "' ) ) ";
        $rschk = $this->db->query($sql);
        if ($rschk->num_rows() > 0) {
            $chkUserInfo = $rschk->row_array();

            $userInfo = $this->userProfileData($chkUserInfo);
            $retUserAddressInfo = $this->getDefaultAddress($chkUserInfo);

            if ($chkUserInfo['status_flag'] == 'Active') {

                $add_in_uuid['login_time'] = date("Y-m-d H:i:s");
                $add_in_uuid['is_login'] = 1;
                $add_in_uuid['device_id'] = $device_id;
                $add_in_uuid['device_type'] = $device_type;

                $where_edt_user = "user_id = '" . $chkUserInfo['user_id'] . "'";
                $this->common->updateRecord('user_master_front', $add_in_uuid, $where_edt_user);
                $arr['status'] = 1;
                $arr['userInfo'] = $userInfo;
                $arr['addressInfo'] = $retUserAddressInfo;
                $arr['call_next_api'] = 'RedirectHome';
            } else if ($chkUserInfo['is_email_verified'] == 0 && $chkUserInfo['status_flag'] == 'Inactive') {

                $temp_otp = "1234";
                $sql_data_array = array(

                    'temp_otp' => $temp_otp,
                    'device_id' => $device_id,
                    'device_type' => $device_type,
                );

                $where = "user_id = '" . $chkUserInfo['user_id'] . "' and temp_otp='" . $temp_otp . "'";
                $this->common->updateRecord('user_master_front', $sql_data_array, $where);

                $userInfo = $this->userProfileData($chkUserInfo);
                $userInfo['temp_otp'] = $temp_otp;
                //$arr['errorData'] = [];
                $arr['userInfo'] = $userInfo;
                $arr['addressInfo'] = $retUserAddressInfo;
                $arr['call_next_api'] = 'doOTPverification';
                $arr['temp_otp'] = $temp_otp;
                $arr['status'] = 2;
                // $arr['userInfo'] = $userInfo;
                //  $arr['addressInfo'] = $retUserAddressInfo;
                $arr['errorMessage'] = "Success! We have sent the OTP in yor mail box.Please check your mail";
            } else if ($chkUserInfo['status_flag'] == 'Delete') {
                $errorMessage = "Please contact admin. There is some issue in your account";
                $arr['status'] = 0;
                $arr['retData'] = $params;

                $arr['errorMessage'] = $errorMessage;
            } else {
                $errorMessage = "Some thing went wrong. Please contact admin ";
                $arr['status'] = 0;
                $arr['retData'] = $params;

                $arr['errorMessage'] = $errorMessage;
            }

        } else {
            $errorData[] = "Invalid Login detail,Please use correct login credentials";
            $errorMessage = "Invalid Login detail,Please use correct login credentials";

            $arr['status'] = 0;
            $arr['retData'] = $params;
            // $arr['errorData'] = $errorData;
            $arr['errorMessage'] = $errorMessage;

        }
        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }

    public function doForgotPassword($params = array(), $returnType = "json")
    {

        $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
//AND status_flag='Active'
        $where = " email='" . $email . "'  ";
        $user_detail = $this->common->getRecord('user_master_front', $where);

        if (sizeof($user_detail) > 0) {
            //  $passphrase = $this->common->randomWithLength(6);

            $add_in_uuid['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
            $where_edt_user = "email = '" . $email . "'";
            $this->common->updateRecord('user_master_front', $add_in_uuid, $where_edt_user);

            //   $user_info['REG_OTP'] = $temp_otp;

            /*  $sql = "select * from  `setting` where `group`='config_site_mail'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
            $m_setting = $query->result_array();

            foreach ($m_setting as $key => $val) {
            $config_site_mail[$val['key']] = $val['value'];
            }

            $subject = "Forgot password, this is it!!";

            $fileg = file_get_contents("uploads/mail_register.html");
            $full_name = $user_detail['first_name'] . " " . $user_detail['last_name'];
            $pattern = array('/{FULLNAME}/', '/{NEWPASSWORD}/');
            $replacement = array($full_name, $temp_otp);
            $mess_body = preg_replace($pattern, $replacement, $fileg);
            $contact_name = $full_name;

            try {
            //Server settings

            $mail = new PHPMailer(true);

            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isMail(); // Send using SMTP

            $mail->Host = $config_site_mail['config_smtp_host']; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $config_site_mail['config_smtp_username']; // SMTP username
            $mail->Password = $config_site_mail['config_smtp_password']; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = $config_site_mail['config_smtp_port']; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $admin_mail_id = $config_site_mail['config_site_mail'];

            $mail->setFrom($admin_mail_id, $config_site_mail['config_site_from_name']);
            // $email = "swamiwebservices@gmail.com";

            $mail->addAddress($email, $full_name); // Add a recipient

            $mail->addReplyTo($admin_mail_id, $config_site_mail['config_site_from_name']);

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $mess_body;
            //  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Message has been sent';

            $arr['status'] = 1;

            $userInfo['user_id'] = $user_detail['user_id'];

            } catch (Exception $e) {
            //  $error_msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // $arr['status'] = 0;
            // $arr['errorMessage'] = 'Ohh! Some thing went wrong please try again';

            }

            } */
            $arr['status'] = 1;
            $arr['temp_otp'] = $temp_otp;
            $arr['userInfo'] = $user_detail;
            $arr['call_next_api'] = 'doOTPverification';
            $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box.Please check your mail';

        } else {
            $errorMessage = 'Invalid email id, Please try other email id';
            $arr['status'] = 0;
            $arr['retData'] = $params;
            //  $arr['errorData'] = '';
            $arr['errorMessage'] = $errorMessage;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function resendOTP($params = array(), $returnType = "json")
    {
        // $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '';
        $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        // AND user_id='{$user_id}'
        $where = " email='{$email}'    ";
        $chkUserInfo = $this->common->getRecord('user_master_front', $where);

        if (sizeof($chkUserInfo) > 0) {

            $where_edt_user = "email = '" . $email . "'";
            $add_in_uuid['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
            $this->common->updateRecord('user_master_front', $add_in_uuid, $where_edt_user);

            $user_info = $chkUserInfo;

            $arr['status'] = 1;
            $arr['temp_otp'] = $temp_otp;
            $arr['call_next_api'] = 'doOTPverification';
            $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box.Please check your mail';

            /* $sql = "select * from  `setting` where `group`='config_site_mail'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        $m_setting = $query->result_array();

        foreach ($m_setting as $key => $val) {
        $config_site_mail[$val['key']] = $val['value'];
        }

        $subject = "Complete your registration!";

        $fileg = file_get_contents("uploads/mail_register.html");
        $full_name = $chkUserInfo['first_name'] . " " . $chkUserInfo['last_name'];
        $pattern = array('/{FULLNAME}/', '/{OTP}/');
        $replacement = array($full_name, $temp_otp);
        $mess_body = preg_replace($pattern, $replacement, $fileg);

        try {
        //Server settings

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isMail(); // Send using SMTP

        $mail->Host = $config_site_mail['config_smtp_host']; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $config_site_mail['config_smtp_username']; // SMTP username
        $mail->Password = $config_site_mail['config_smtp_password']; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = $config_site_mail['config_smtp_port']; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $admin_mail_id = $config_site_mail['config_site_mail'];

        $mail->setFrom($admin_mail_id, $config_site_mail['config_site_from_name']);
        // $email = "swamiwebservices@gmail.com";

        $mail->addAddress($email, $full_name); // Add a recipient

        $mail->addReplyTo($admin_mail_id, $config_site_mail['config_site_from_name']);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $mess_body;
        //  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box.Please check your mail';

        } catch (Exception $e) {
        //  $error_msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //  $arr['status'] = 0;
        //  $arr['errorMessage'] = 'Ohh! Some thing went wrong please try again';

        }

        }
         */

        } else {
            $errorMessage = 'Invalid email id, Please try other email id';
            $arr['status'] = 0;
            $arr['retData'] = $params;
            //  $arr['errorData'] = '';
            $arr['errorMessage'] = $errorMessage;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function doLogout($params = array(), $returnType = "json")
    {

        $add_in_uuid['logout_time'] = date("Y-m-d H:i:s");
        $add_in_uuid['is_login'] = 0;
        $add_in_uuid['access_token'] = '';
        $where_edt_user = "user_id = '" . $params['user_id'] . "'";
        $this->common->updateRecord('user_master_front', $add_in_uuid, $where_edt_user);
        $arr = array('status' => 1, 'successMessage' => "Success: You have logout from system!");

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function setUserLanguage($params = array(), $returnType = "json")
    {

        $user_language = (isset($params['user_language'])) ? $this->common->mysql_safe_string($params['user_language']) : 'EN';
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';

        $add_in['user_language'] = $user_language;
        $where_edt = "user_id = '" . $user_id . "' and status_flag='Active' ";
        $this->common->updateRecord('user_master_front', $add_in, $where_edt);

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! Information updated successfully';

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function doUpdateProfile($params = array(), $returnType = "json")
    {

        $add_in['first_name'] = (isset($params['first_name'])) ? $this->common->mysql_safe_string($params['first_name']) : '';
        $add_in['middle_name'] = (isset($params['middle_name'])) ? $this->common->mysql_safe_string($params['middle_name']) : '';
        $add_in['last_name'] = (isset($params['last_name'])) ? $this->common->mysql_safe_string($params['last_name']) : '';
        //  $add_in['email'] = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        $add_in['mobile'] = (isset($params['mobile'])) ? $this->common->mysql_safe_string($params['mobile']) : '';
        //    $add_in['passphrase'] = (isset($params['passphrase'])) ? $this->common->mysql_safe_string($params['passphrase']) : '';
        $add_in['edit_date'] = date("Y-m-d h:i:s");
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';

        $where_edt = "user_id = '" . $user_id . "' and status_flag='Active' ";
        $this->common->updateRecord('user_master_front', $add_in, $where_edt);

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! Information updated successfully';

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }

    public function changePassword($params = array(), $returnType = "json")
    {

        $newpassword = (isset($params['newpassword'])) ? $this->common->mysql_safe_string($params['newpassword']) : '';
        $oldpassword = (isset($params['oldpassword'])) ? $this->common->mysql_safe_string($params['oldpassword']) : '';

        $add_in['edit_date'] = date("Y-m-d h:i:s");
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';

        $sql = "select * from user_master_front where user_id = '" . $user_id . "'  ";
        $resultQuery = $this->db->query($sql);
        if ($resultQuery->num_rows() > 0) {
            $add_in['passphrase'] = $newpassword;
            $where_edt = "user_id = '" . $user_id . "' and status_flag='Active' ";
            $this->common->updateRecord('user_master_front', $add_in, $where_edt);
            $arr['status'] = 1;
            $arr['successMessage'] = 'Password change successfully!';
        } else {
            $arr = array('status' => 0, 'errorMessage' => "Invalid password");

        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function doAddAddress($params = array(), $returnType = "json")
    {

        $add_in['user_id'] = $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';
        $add_in['address_name'] = $address_name = (isset($params['address_name'])) ? $this->common->mysql_safe_string($params['address_name']) : 'Home';
        $add_in['firstname'] = $firstname = (isset($params['firstname'])) ? $this->common->mysql_safe_string($params['firstname']) : '';
        $add_in['lastname'] = $lastname = (isset($params['lastname'])) ? $this->common->mysql_safe_string($params['lastname']) : '';
        $add_in['mobile'] = $mobile = (isset($params['mobile'])) ? $this->common->mysql_safe_string($params['mobile']) : '';
        $add_in['address_1'] = $address_1 = (isset($params['address_1'])) ? $this->common->mysql_safe_string($params['address_1']) : '';
        $add_in['state_id'] = $state_id = (isset($params['state_id'])) ? $this->common->mysql_safe_string($params['state_id']) : '0';
        $add_in['district_id'] = 0; //$district_id = (isset($params['district_id'])) ? $this->common->mysql_safe_string($params['district_id']) : '';
        $add_in['city_id'] = $city_id = (isset($params['city_id'])) ? $this->common->mysql_safe_string($params['city_id']) : '';
        $add_in['postcode'] = $postcode = (isset($params['postcode'])) ? $this->common->mysql_safe_string($params['postcode']) : '';
        $add_in['longitude'] = $longitude = (isset($params['longitude'])) ? $this->common->mysql_safe_string($params['longitude']) : '';
        $add_in['latitude'] = $latitude = (isset($params['latitude'])) ? $this->common->mysql_safe_string($params['latitude']) : '';

        $add_in['is_default'] = $is_default = (isset($params['is_default'])) ? $this->common->mysql_safe_string($params['is_default']) : '0';

        $sql = "select um.*   from user_master_front um   where um.status_flag='Active'  and   um.user_id='" . $user_id . "'";
        $userQuery = $this->db->query($sql);
        if ($userQuery->num_rows() > 0) {
            //   $row_customer = $userQuery->row_array();

            try {
                // Generate a version 4 (random) UUID object
                $uuid4 = Uuid::uuid4();
                $uuid_shipping = $uuid4->toString();
                $add_in['uuid'] = $uuid_shipping;
            } catch (UnsatisfiedDependencyException $e) {

            }

            $this->db->insert('customer_shipping_address', $add_in);

            if ($is_default == 1) {
                $update_data['is_default'] = 0;
                $where_edt = "user_id = '" . $user_id . "'";
                $this->common->updateRecord('customer_shipping_address', $update_data, $where_edt);
                $update_data['is_default'] = 1;
                $where_edt = "user_id = '" . $user_id . "' and uuid='" . $add_in['uuid'] . "'";
                $this->common->updateRecord('customer_shipping_address', $update_data, $where_edt);

            }
            $userAddressInfo = $this->common->getSingleInfoBy('customer_shipping_address', 'uuid', $add_in['uuid'], '*');
            $retUserAddressInfo = $this->userAddressData($userAddressInfo);
            /*
            $retUserAddressInfo['address_id'] = $userAddressInfo['address_id'];
            $retUserAddressInfo['address_name'] = $userAddressInfo['address_name'];
            $retUserAddressInfo['firstname'] = $userAddressInfo['firstname'];
            $retUserAddressInfo['lastname'] = $userAddressInfo['lastname'];
            $retUserAddressInfo['address_1'] = $userAddressInfo['address_1'];
            $retUserAddressInfo['state_id'] = $userAddressInfo['state_id'];
            $retUserAddressInfo['district_id'] = $userAddressInfo['district_id'];
            $retUserAddressInfo['postcode'] = $userAddressInfo['postcode'];
            $retUserAddressInfo['is_default'] = $userAddressInfo['is_default'];
            $retUserAddressInfo['longitude'] = $userAddressInfo['longitude'];
            $retUserAddressInfo['latitude'] = $userAddressInfo['latitude'];
            $retUserAddressInfo['mobile'] = $userAddressInfo['mobile'];
            $retUserAddressInfo['state_name'] = '';
            $retUserAddressInfo['district_name'] = ''; */

            $arr['results'] = $retUserAddressInfo;
            $arr['status'] = 1;

        } else {
            $arr = array('status' => 0, 'errorMessage' => "customer does not exist");
        }

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! Information updated successfully';

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function deleteAddress($params = array(), $returnType = "json")
    {

        $address_id = (isset($params['address_id'])) ? $this->common->mysql_safe_string($params['address_id']) : '';
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '';

        $shipping_address_info = $this->getSingleAddress($params, 0, 'ARRAY');

        if ($shipping_address_info['status'] == 1) {
            if ($shipping_address_info['results']['is_default'] == "1") {
                $arr['status'] = 0;
                $arr['errorMessage'] = 'Sorry this is your default address, Please make other address default and than delete this address';
            } else {
                $sql = "delete from customer_shipping_address   where   user_id='" . $user_id . "' and address_id = '" . (int) $address_id . "' ";
                $address_query = $this->db->query($sql);
                $arr['status'] = 1;
                $arr['successMessage'] = 'Address deleted successfully';
            }

        } else {
            $arr = array('status' => 0, 'errorMessage' => "Invalid address id");
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function getSingleAddress($params, $is_default = 0, $returnType = "json")
    {

        $LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
        $language_ext = $this->getLanguageExt($LANGCODE);
        $user_id = $params['user_id'];

        $address_id = $params['address_id'];

        if ($is_default == 1) {
            $sql_sub = " and csa.is_default=1   ";
        } else {
            $sql_sub = "";
        }

        $sql = "select csa.*   from customer_shipping_address  csa

        where     csa.user_id='" . (int) $user_id . "' and   address_id = '" . (int) $address_id . "' " . $sql_sub;
        $address_query = $this->db->query($sql);
        $address_data = [];
        if ($address_query->num_rows() > 0) {
            $address_query_row = $address_query->row_array();
            $address_data = $this->userAddressData($address_query_row);

            $arr['results'] = $address_data;
            $arr['status'] = 1;

        } else {
            $arr = array('status' => 0, 'errorMessage' => "Invalid address id");
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function getDefaultAddress($params)
    {

        // left join master_province mp on csa.state_id = mp.id
        //left join master_district md on csa.district_id = md.id

        $sql = "select csa.*   from customer_shipping_address  csa

        where   csa.is_default=1  and  csa.user_id='" . $params['user_id'] . "'";
        $address_query = $this->db->query($sql);
        $address_data = [];
        if ($address_query->num_rows() > 0) {
            $address_query_row = $address_query->row_array();
            $retUserAddressInfo = $this->userAddressData($address_query_row);

            return $retUserAddressInfo;

        } else {
            return false;
        }
    }
    public function getAddresses($params = array(), $returnType = "json")
    {

        $uuid = (isset($params['uuid'])) ? $this->common->mysql_safe_string($params['uuid']) : '';

        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';

        //   $LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
        //   $language_ext = $this->getLanguageExt($LANGCODE);

        $sql = "select csa.*  from customer_shipping_address  csa

        where   csa.user_id='" . $user_id . "' order by csa.address_id desc";
        $address_query = $this->db->query($sql);
$address_data = [];
        if ($address_query->num_rows() > 0) {
            $address_query_rows = $address_query->result_array();

            foreach ($address_query_rows as $key => $result) {
                $retUserAddressInfo = $this->userAddressData($result);
                $address_data[] = $retUserAddressInfo;

            /*
                $address_data[] = array(
                'address_id' => $result['address_id'],
                'address_name' => $result['address_name'],
                'firstname' => $result['firstname'],
                'lastname' => $result['lastname'],
                'address_1' => $result['address_1'],
                'state_id' => $result['state_id'],
                'postcode' => $result['postcode'],
                'district_id' => $result['district_id'],
                'state_name' => "",
                'district_name' => "",
                'longitude' => $result['longitude'],
                'latitude' => $result['latitude'],
                'mobile' => $result['mobile'],
                'is_default' => $result['is_default'],
                );
             */

            }

        }

        $arr['results'] = $address_data;
        $arr['status'] = 1;

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }

    public function sendotp($user_info = array())
    {

        $sms_description = $this->common->get_sms_data(1);
        $sms_description = $this->common->mysql_safe_string($sms_description);

        //   $pattern = array('/#REG_OTP#/');
        //   $replacement = array($user_info['REG_OTP']);
        //   $sms_description = preg_replace($pattern, $replacement, $sms_description);
        //  $outputtemp = print_r($sms_description,true);
        //file_put_contents('deubg_logs/debug_emp_type.txt', $outputtemp, FILE_APPEND);
        // $this->common->send_sms($user_info['mobile'],$sms_description);

        $add_in_cust = array();
        $add_in_cust['user_id'] = $user_info['user_id'];
        $add_in_cust['sms_nos'] = $user_info['mobile'];
        $add_in_cust['sms_OTP'] = $user_info['REG_OTP'];
        $add_in_cust['sms_sent_count'] = 1;
        $add_in_cust['sms_validity_date'] = date("Y-m-d H:i:s");
        $add_in_cust['sms_validity_time'] = time();
        $add_in_cust['OTP_verification_status'] = 0;
        $add_in_cust['sms_purpose'] = 'OTP';
        $add_in_cust['country_code'] = 91;
        $add_in_cust['email_id'] = $user_info['email'];
        // $this->common->insertRecord('sms_verification_logs', $add_in_cust);
    }

    public function getLanguageExt($LANGCODE = "EN")
    {

        if ($LANGCODE == "EN") {
            return "_en";
        } else {
            return "";

        }

    }
    public function getProfile($params, $returnType = "json")
    {

        //$LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
        //   $language_ext = $this->getLanguageExt($LANGCODE);
        $user_id = $params['user_id'];

        $sql = "select * from user_master_front where user_id='{$user_id}' ";
        $query = $this->db->query($sql);
        $address_data = [];
        if ($query->num_rows() > 0) {
            $chkUserInfo = $query->row_array();
            // $user_photo = back_path . "uploads/noimage.png";

            if ($chkUserInfo['profile_pic'] != '') {
                $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($chkUserInfo['profile_pic']);
            } else {
                $user_photo = back_path . "uploads/noimage.png";
            }

            $userInfo = array("uuid" => $chkUserInfo['uuid'], "user_id" => $chkUserInfo['user_id'], "user_type" => $chkUserInfo['user_type'], "first_name" => $chkUserInfo['first_name'], "middle_name" => $chkUserInfo['middle_name'], "last_name" => $chkUserInfo['last_name'], "email" => $chkUserInfo['email'], "mobile" => $chkUserInfo['mobile'], "enterprise_name" => $chkUserInfo['enterprise_name'], "user_photo" => $user_photo);

            $userInfo['user_language'] = ($chkUserInfo['user_language'] != "") ? $chkUserInfo['user_language'] : 'EN';
            $userInfo['is_otp_verified'] = $chkUserInfo['is_email_verified'];
            $userInfo['country_code'] = $chkUserInfo['country_code'] . "";
            $arr['status'] = 1;

            $arr['userInfo'] = $userInfo;

        } else {
            $arr = array('status' => 0, 'errorMessage' => "Invalid user id");
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function getProfileUUID($params, $returnType = "json")
    {

        //$LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
        //   $language_ext = $this->getLanguageExt($LANGCODE);
        $uuid = $params['uuid'];

        $sql = "select * from user_master_front where uuid='{$uuid}' ";
        $query = $this->db->query($sql);
        $address_data = [];
        if ($query->num_rows() > 0) {
            $chkUserInfo = $query->row_array();
            // $user_photo = back_path . "uploads/noimage.png";

            if ($chkUserInfo['profile_pic'] != '') {
                $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($chkUserInfo['profile_pic']);
            } else {
                $user_photo = back_path . "uploads/noimage.png";
            }

            $userInfo = array("uuid" => $chkUserInfo['uuid'], "user_id" => $chkUserInfo['user_id'], "user_type" => $chkUserInfo['user_type'], "first_name" => $chkUserInfo['first_name'], "middle_name" => $chkUserInfo['middle_name'], "last_name" => $chkUserInfo['last_name'], "email" => $chkUserInfo['email'], "mobile" => $chkUserInfo['mobile'], "enterprise_name" => $chkUserInfo['enterprise_name'], "user_photo" => $user_photo);

            $userInfo['user_language'] = ($chkUserInfo['user_language'] != "") ? $chkUserInfo['user_language'] : 'EN';
            $userInfo['is_otp_verified'] = $chkUserInfo['is_email_verified'];
            $userInfo['country_code'] = $chkUserInfo['country_code'] . "";

            $arr['status'] = 1;

            $arr['userInfo'] = $userInfo;

        } else {
            $arr = array('status' => 0, 'errorMessage' => "Invalid user id");
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }
    public function sendMail()
    {
        /*
    https://app.sendgrid.com/login
    Username: aber.ksa0@gmail.com
    Password: Aber@erm12345678
     */
    }

    public function userProfileData($chkUserInfo = array())
    {

        $user_photo = back_path . "uploads/noimage.png";
        if (isset($chkUserInfo['profile_pic']) && $chkUserInfo['profile_pic'] != '') {
            $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($chkUserInfo['profile_pic']);
        }

        //  $userInfo['push_notification'] = $chkUserInfo['push_notification'];
        $userInfo['user_language'] = (isset($chkUserInfo['user_language'] ) && $chkUserInfo['user_language'] != "") ? $chkUserInfo['user_language'] : 'EN';
        $userInfo['is_otp_verified'] = (int) $chkUserInfo['is_email_verified'];

        $userInfo['uuid'] = $chkUserInfo['uuid'] . "";
        $userInfo['user_id'] = $chkUserInfo['user_id'] . "";
        $userInfo['user_type'] = $chkUserInfo['user_type'] . "";
        $userInfo['first_name'] = $chkUserInfo['first_name'] . "";
        $userInfo['middle_name'] = $chkUserInfo['middle_name'] . "";
        $userInfo['last_name'] = $chkUserInfo['last_name'] . "";
        $userInfo['email'] = $chkUserInfo['email'] . "";
        $userInfo['mobile'] = $chkUserInfo['mobile'] . "";
        $userInfo['enterprise_name'] = $chkUserInfo['country_code'] . "";
        $userInfo['user_photo'] = $user_photo . "";
        $userInfo['country_code'] = $chkUserInfo['country_code'] . "";
        $userInfo['facebook_id'] = $chkUserInfo['facebook_id'] . "";
        $userInfo['google_id'] = $chkUserInfo['google_id'] . "";
        
        
        $userInfo['temp_otp'] = $chkUserInfo['temp_otp'] . "";

        return $userInfo;
    }
    public function userAddressData($userAddressInfo = array())
    {

        $retUserAddressInfo['address_id'] = $userAddressInfo['address_id'];
        $retUserAddressInfo['address_name'] = $userAddressInfo['address_name'];
        $retUserAddressInfo['firstname'] = $userAddressInfo['firstname'];
        $retUserAddressInfo['lastname'] = $userAddressInfo['lastname'];
        $retUserAddressInfo['address_1'] = $userAddressInfo['address_1'] . "";
        $retUserAddressInfo['state_id'] = $userAddressInfo['state_id'];
        $retUserAddressInfo['city_id'] = $userAddressInfo['city_id'];
        $retUserAddressInfo['state_name'] = "";
        $retUserAddressInfo['city_name'] = "";
        $retUserAddressInfo['postcode'] = $userAddressInfo['postcode'] . "";
        $retUserAddressInfo['is_default'] = $userAddressInfo['is_default'] . "";
        $retUserAddressInfo['longitude'] = $userAddressInfo['longitude'] . "";
        $retUserAddressInfo['latitude'] = $userAddressInfo['latitude'] . "";
        $retUserAddressInfo['mobile'] = $userAddressInfo['mobile'] . "";

        return $retUserAddressInfo;
    }

    public function categorySubcategory($params, $returnType = "json")
    {

        $arr = [];
        $category = [];
        $category_id = (isset($params['category_id'])) ? $this->common->mysql_safe_string($params['category_id']) : '0';
        $add_in['user_language'] = $LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
        $language_ext = $this->getLanguageExt($LANGCODE);


        $is_parent_only = (isset($params['is_parent_only'])) ? $this->common->mysql_safe_string($params['is_parent_only']) : '0';

        $sql_cate_join = "";

        $sub_cat_arr = array();
        if ($category_id > 0) {
            $sql_cate_join = "  and  c.parent_id = '" . $category_id . "'  ";
        } else {
            $sql_cate_join = "  and  c.parent_id = '0'  ";
        }
        
        $sort_order_by = "c.name asc";
          $sql = "select c.category_id,c.name,c.description ,c.name_en,c.description_en, c.main_image  from product_category c    where c.status='Active'  " . $sql_cate_join ." order by " . $sort_order_by;
        //$ddd =getRecordsLimit
        $categoryListQuery = $this->db->query($sql);
        if ($categoryListQuery->num_rows() > 0) {

            $categoryRows = $categoryListQuery->result_array();
            foreach ($categoryRows as $categoryVal) {

                if ($categoryVal['main_image'] != '') {
                    $main_image = back_path . "uploads/category/" . $this->common->mysql_safe_string($categoryVal['main_image']);
                } else {
                    $main_image = back_path . "uploads/noimage.png";
                }

                $sub_cat_arr = array();

                if($is_parent_only == 0){
                    $sql_sub = "select c.category_id,c.name,c.description ,c.name_en,c.description_en, c.main_image   from product_category c    where c.status='Active'  and  c.parent_id = '" . $categoryVal['category_id'] . "'  order by " . $sort_order_by;
                    $sub_categoryListQuery = $this->db->query($sql_sub);
                    $subCategoryRows = $sub_categoryListQuery->result_array();
                   
                    foreach ($subCategoryRows as $subCategoryVal) {
                        if ($subCategoryVal['main_image'] != '') {
                            $main_image_sub = back_path . "uploads/category/" . $this->common->mysql_safe_string($subCategoryVal['main_image']);
                        } else {
                            $main_image_sub = back_path . "uploads/noimage.png";
                        }
                        $sub_cat_arr[] = array(
                            'category_id' => $subCategoryVal['category_id'],
                            'name' => $subCategoryVal['name' . $language_ext],
                            'image' => $main_image_sub,
                            'description' => $subCategoryVal['description' . $language_ext],
    
                        );
                    }
                }  
             

                $category[] = array(
                    'category_id' => $categoryVal['category_id'],
                    'name' => $categoryVal['name' . $language_ext],
                    'image' => $main_image,
                    'description' => $categoryVal['description' . $language_ext],
                    'sub_cate_list' => $sub_cat_arr,
                );

            }

            $arr['status'] = 1;
            $arr['result'] = $category;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }

    public function doRequest($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';
        $add_in['user_id'] = $user_id;
        $add_in['request_title'] = (isset($params['request_title'])) ? $this->common->mysql_safe_string($params['request_title']) : '';
        $add_in['request_description'] = (isset($params['request_description'])) ? $this->common->mysql_safe_string($params['request_description']) : '';
        $add_in['pickup_location_id'] = (isset($params['pickup_location_id'])) ? $this->common->mysql_safe_string($params['pickup_location_id']) : '';
        $add_in['destination_location_id'] = (isset($params['destination_location_id'])) ? $this->common->mysql_safe_string($params['destination_location_id']) : '';
        $add_in['pickup_date'] = (isset($params['pickup_date'])) ? $this->common->mysql_safe_string($params['pickup_date']) : '';
        $add_in['drop_destination_date'] = (isset($params['drop_destination_date'])) ? $this->common->mysql_safe_string($params['drop_destination_date']) : '';
        $add_in['latest_pickup_date'] = (isset($params['latest_pickup_date'])) ? $this->common->mysql_safe_string($params['latest_pickup_date']) : '';
        $add_in['latest_drop_destination_date'] = (isset($params['latest_drop_destination_date'])) ? $this->common->mysql_safe_string($params['latest_drop_destination_date']) : '';
        $add_in['distance_mile'] = (isset($params['distance_mile'])) ? $this->common->mysql_safe_string($params['distance_mile']) : '';
        $add_in['expected_travelling_time'] = (isset($params['expected_travelling_time'])) ? $this->common->mysql_safe_string($params['expected_travelling_time']) : '';
        $add_in['category_id'] = (isset($params['category_id'])) ? $this->common->mysql_safe_string($params['category_id']) : '';
        $add_in['subcategory_id'] = (isset($params['subcategory_id'])) ? $this->common->mysql_safe_string($params['subcategory_id']) : '';

        $add_in['category_name'] = (isset($params['category_name'])) ? $this->common->mysql_safe_string($params['category_name']) : '';
        $add_in['subcategory_name'] = (isset($params['subcategory_name'])) ? $this->common->mysql_safe_string($params['subcategory_name']) : '';
        $add_in['consignment_note'] = (isset($params['consignment_note'])) ? $this->common->mysql_safe_string($params['consignment_note']) : '';
        $add_in['budget_amount'] = (isset($params['budget_amount'])) ? (float) $this->common->mysql_safe_string($params['budget_amount']) : '0';
        $add_in['request_status'] = 'Requested';
        $add_in['request_sub_status'] = 'Active';

        try {
            // Generate a version 4 (random) UUID object
            $uuid4 = Uuid::uuid4();
            $uuid = $uuid4->toString();
            $add_in['uuid'] = $uuid;
        } catch (UnsatisfiedDependencyException $e) {

        }
        $user_temp['user_id'] = $user_id;
        $user_temp['address_id'] = $add_in['pickup_location_id'];
        $pickup_address = $this->getSingleAddress($user_temp, 0, 'ARRAY');

        $user_temp['address_id'] = $add_in['destination_location_id'];
        $destination_address = $this->getSingleAddress($user_temp, 0, 'ARRAY');

        if (sizeof($pickup_address) > 0) {
            $add_in['pickup_location'] = $pickup_address['results']['address_1'];
            $add_in['pickup_longitude'] = $pickup_address['results']['longitude'];
            $add_in['pickup_latitude'] = $pickup_address['results']['latitude'];

        }

        if (sizeof($destination_address) > 0) {
            $add_in['destination_location'] = $destination_address['results']['address_1'];
            $add_in['destination_longitude'] = $destination_address['results']['longitude'];
            $add_in['destination_latitude'] = $destination_address['results']['latitude'];

        }

        $add_in['insert_date'] = date("Y-m-d H:i:s");
        $this->common->insertRecord('lt_requests', $add_in);
        $requestsInfo = $this->common->getSingleInfoBy('lt_requests', 'uuid', $add_in['uuid'], '*');

        $consignment_image = (isset($params['consignment_image'])) ? $params['consignment_image'] : [];

        $requests_items = (isset($params['requests_items'])) ? $params['requests_items'] : [];

        if (sizeof($consignment_image) > 0) {
            foreach ($consignment_image as $key => $val) {
                $add_in_image['request_id'] = $requestsInfo['request_id'];
                $add_in_image['user_id'] = $user_id;
                $image_name_exp = explode("consignmentimage_temp/", $val);
                $source_url = "uploads/consignmentimage_temp/" . $image_name_exp[1];
                $destination_url = "uploads/consignmentimage/" . $requestsInfo['request_id'] . "-" . $image_name_exp[1];
                @copy($source_url, $destination_url);
                @unlink($source_url);
                $add_in_image['image_name'] = $requestsInfo['request_id'] . "-" . $image_name_exp[1];
                $this->common->insertRecord('lt_request_consignment_imgs', $add_in_image);
            }

        }
        if (sizeof($requests_items) > 0) {
            foreach ($requests_items as $key => $val) {
                $add_in_items['request_id'] = $requestsInfo['request_id'];
                $add_in_items['user_id'] = $user_id;
                $add_in_items['consignment_qty'] = (isset($val['consignment_qty'])) ? $val['consignment_qty'] : '0';
                $add_in_items['consignment_details'] = (isset($val['consignment_details'])) ? $val['consignment_details'] : '';
                $add_in_items['consignment_width'] = (isset($val['consignment_width'])) ? $val['consignment_width'] : '0';
                $add_in_items['consignment_height'] = (isset($val['consignment_height'])) ? $val['consignment_height'] : '0';
                $add_in_items['consignment_weight'] = (isset($val['consignment_weight'])) ? $val['consignment_weight'] : '0';
                $add_in_items['consignment_length'] = (isset($val['consignment_length'])) ? $val['consignment_length'] : '0';

                $add_in_items['consignment_width_unit'] = (isset($val['consignment_width_unit'])) ? $val['consignment_width_unit'] : 'CM';
                $add_in_items['consignment_height_unit'] = (isset($val['consignment_height_unit'])) ? $val['consignment_height_unit'] : 'CM';
                $add_in_items['consignment_weight_unit'] = (isset($val['consignment_weight_unit'])) ? $val['consignment_weight_unit'] : 'KG';
                $add_in_items['consignment_length_unit'] = (isset($val['consignment_length_unit'])) ? $val['consignment_length_unit'] : 'CM';

                $this->common->insertRecord('lt_requests_items', $add_in_items);
            }
        }
        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! your request placed successfully. ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function allRequest($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? (int) $this->common->mysql_safe_string($params['user_id']) : '0';
        $driver_id = (isset($params['driver_id'])) ? (int) $this->common->mysql_safe_string($params['driver_id']) : '0';
        $driver_status = (isset($params['driver_status'])) ? $this->common->mysql_safe_string($params['driver_status']) : '';

        $sql_cond = "";
        $sql_cond_user = "";
        $sql_cond_dri = "";
        $sql_cond_dri_status = "";
        $sub_cat_arr = array();

        if (strtolower($driver_status) == "ongoing") {
            $sql_cond_dri_status = "  and   r.is_trip_started='1'  and r.is_trip_completed='0'";
        } else if (strtolower($driver_status) == "completed") {
            $sql_cond_dri_status = " and  r.is_trip_started='1'  and    r.is_trip_completed='1' ";
        } else if (strtolower($driver_status) == "assigned") {
            $sql_cond_dri_status = " and  r.is_trip_started='0'  and r.is_trip_completed='0' ";
        }

        if (!isset($params['request_status'])) {
            $sql_cond = " ";
        } else {
            $sql_cond = " and r.request_status='" . $params['request_status'] . "' ";
        }
        if (!isset($params['request_status_multple'])) {
            $sql_cond_multi = " ";
        } else {
            $sql_cond_multi = " and r.request_status in (" . $params['request_status_multple'] . ") ";
        }

        if (!isset($params['status_flag'])) {
            $sql_cond_status = "   r.status_flag='Active'";
        } else {
            $sql_cond_status = "   r.status_flag in (" . $params['status_flag'] . ") ";
        }

        if ($user_id != 0) {
            $sql_cond_user = " and r.user_id='{$user_id}' ";
        } else {
            $sql_cond_user = " ";
        }
        if ($driver_id != 0) {
            $sql_cond_dri = " and r.driver_id='{$driver_id}' ";
        } else {
            $sql_cond_dri = " ";
        }
        $arr['status'] = 1;
        $arr['result'] = [];
        $add_in_image = [];
        $add_in_items = [];
        $requests_items = [];
        $sort_order_by = "c.name asc";
        $sql = "select r.* from lt_requests r    where  " . $sql_cond_status . $sql_cond . $sql_cond_multi . $sql_cond_dri . $sql_cond_user . $sql_cond_dri_status . " order by r.insert_date desc";
        //$ddd =getRecordsLimit
        $requestsQuery = $this->db->query($sql);
        if ($requestsQuery->num_rows() > 0) {

            $requestsRows = $requestsQuery->result_array();

            foreach ($requestsRows as $requests_val) {
                $request_id = $requests_val['request_id'];
                $sql = "select * from lt_requests_items where request_id='{$request_id}' ";
                $request_item_query = $this->db->query($sql)->result_array();
                if ($request_item_query) {
                    foreach ($request_item_query as $request_item_query_val) {
                        $add_in_items['lt_requests_items_id'] = $request_item_query_val['lt_requests_items_id'];
                        $add_in_items['consignment_qty'] = $request_item_query_val['consignment_qty'];
                        $add_in_items['consignment_details'] = $request_item_query_val['consignment_details'];
                        $add_in_items['consignment_width'] = $request_item_query_val['consignment_width'];
                        $add_in_items['consignment_height'] = $request_item_query_val['consignment_height'];
                        $add_in_items['consignment_weight'] = $request_item_query_val['consignment_weight'];
                        $add_in_items['consignment_length'] = $request_item_query_val['consignment_length'];

                        $add_in_items['consignment_width_unit'] = $request_item_query_val['consignment_width_unit'];
                        $add_in_items['consignment_height_unit'] = $request_item_query_val['consignment_height_unit'];
                        $add_in_items['consignment_weight_unit'] = $request_item_query_val['consignment_weight_unit'];
                        $add_in_items['consignment_length_unit'] = $request_item_query_val['consignment_length_unit'];

                        $requests_items[] = $add_in_items;
                    }
                }
                //image

                $consignment_image = $this->get_consignment_image($request_id);
                //  $main_image = back_path . "uploads/category/" . $this->common->mysql_safe_string($categoryVal['main_image']);
                $is_editable = (strtolower($requests_val['request_status']) == 'requested') ? 1 : 0;
                $request_status = $requests_val['request_status'];

                $lt_requests[] = array(
                    'request_id' => $requests_val['request_id'],
                    'uuid' => $requests_val['uuid'],
                    'user_id' => $requests_val['user_id'],
                    'shipment_id' => $requests_val['shipment_id'] . "",
                    'driver_id' => $requests_val['driver_id'],
                    'request_title' => $requests_val['request_title'],
                    'request_description' => $requests_val['request_description'],
                    'pickup_location' => $requests_val['pickup_location'],
                    'pickup_longitude' => $requests_val['pickup_longitude'],
                    'pickup_latitude' => $requests_val['pickup_latitude'],
                    'destination_location' => $requests_val['destination_location'],
                    'destination_longitude' => $requests_val['destination_longitude'],
                    'destination_latitude' => $requests_val['destination_latitude'],
                    'pickup_date' => $requests_val['pickup_date'],
                    'drop_destination_date' => $requests_val['drop_destination_date'],
                    'latest_pickup_date' => $requests_val['latest_pickup_date'],
                    'latest_drop_destination_date' => $requests_val['latest_drop_destination_date'],
                    'distance_mile' => $requests_val['distance_mile'],
                    'expected_travelling_time' => $requests_val['expected_travelling_time'],
                    'category_id' => $requests_val['category_id'],
                    'category_name' => $requests_val['category_name'],
                    'subcategory_id' => $requests_val['subcategory_id'],
                    'subcategory_name' => $requests_val['subcategory_name'],
                    'consignment_note' => $requests_val['consignment_note'],
                    'budget_amount' => $requests_val['budget_amount'],
                    'insert_date' => $requests_val['insert_date'],
                    'request_status' => $request_status,
                    'consignment_image' => $consignment_image,
                    'requests_items' => $requests_items,
                    'is_editable' => $is_editable,

                );

            }

            $arr['status'] = 1;
            $arr['result'] = $lt_requests;
        }
        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function doDeleteConsignmentImage($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';
        $request_id = (isset($params['request_id'])) ? $this->common->mysql_safe_string($params['request_id']) : '0';
        $image_name = (isset($params['image_name'])) ? $this->common->mysql_safe_string($params['image_name']) : '';

        $image_name_exp = explode("consignmentimage/", $image_name);
        $destination_url = "uploads/consignmentimage/" . $image_name_exp[1];
        $image_name_temp = $image_name_exp[1];

        $sql = "delete from lt_request_consignment_imgs where request_id='{$request_id}' and user_id='{$user_id}' and image_name='{$image_name_temp}'";
        $this->db->query($sql);
        if ($this->db->affected_rows()) {
            @unlink($destination_url);
        }

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! image deleted successfully. ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function doRequestUpdate($params, $returnformat = "JSON")
    {

        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';
        $request_id = (isset($params['request_id'])) ? $this->common->mysql_safe_string($params['request_id']) : '0';
        $user_temp['user_id'] = $user_id;

        if (isset($params['request_title'])) {
            $add_in['request_title'] = $this->common->mysql_safe_string($params['request_title']);
        }

        if (isset($params['request_description'])) {
            $add_in['request_description'] = $this->common->mysql_safe_string($params['request_description']);
        }
        if (isset($params['pickup_location_id'])) {
            $add_in['pickup_location_id'] = $this->common->mysql_safe_string($params['pickup_location_id']);
            $user_temp['address_id'] = $add_in['pickup_location_id'];
            $pickup_address = $this->getSingleAddress($user_temp, 0, 'ARRAY');

            if (sizeof($pickup_address) > 0) {
                $add_in['pickup_location'] = $pickup_address['results']['address_1'];
                $add_in['pickup_longitude'] = $pickup_address['results']['longitude'];
                $add_in['pickup_latitude'] = $pickup_address['results']['latitude'];

            }
        }
        if (isset($params['destination_location_id'])) {
            $add_in['destination_location_id'] = $this->common->mysql_safe_string($params['destination_location_id']);

            $user_temp['address_id'] = $add_in['destination_location_id'];
            $destination_address = $this->getSingleAddress($user_temp, 0, 'ARRAY');

            if (sizeof($destination_address) > 0) {
                $add_in['destination_location'] = $destination_address['results']['address_1'];
                $add_in['destination_longitude'] = $destination_address['results']['longitude'];
                $add_in['destination_latitude'] = $destination_address['results']['latitude'];

            }

        }
        if (isset($params['pickup_date'])) {
            $add_in['pickup_date'] = $this->common->mysql_safe_string($params['pickup_date']);
        }
        if (isset($params['drop_destination_date'])) {
            $add_in['drop_destination_date'] = $this->common->mysql_safe_string($params['drop_destination_date']);
        }
        if (isset($params['latest_pickup_date'])) {
            $add_in['latest_pickup_date'] = $this->common->mysql_safe_string($params['latest_pickup_date']);
        }
        if (isset($params['latest_drop_destination_date'])) {
            $add_in['latest_drop_destination_date'] = $this->common->mysql_safe_string($params['latest_drop_destination_date']);
        }
        if (isset($params['distance_mile'])) {
            $add_in['distance_mile'] = $this->common->mysql_safe_string($params['distance_mile']);
        }
        if (isset($params['expected_travelling_time'])) {
            $add_in['expected_travelling_time'] = $this->common->mysql_safe_string($params['expected_travelling_time']);
        }
        if (isset($params['consignment_note'])) {
            $add_in['consignment_note'] = $this->common->mysql_safe_string($params['consignment_note']);
        }

        if (isset($params['budget_amount'])) {
            $add_in['budget_amount'] = $this->common->mysql_safe_string($params['budget_amount']);
        }

        $requests_items = (isset($params['requests_items'])) ? $params['requests_items'] : [];

        $add_in['category_id'] = (isset($params['category_id'])) ? $this->common->mysql_safe_string($params['category_id']) : '';
        $add_in['subcategory_id'] = (isset($params['subcategory_id'])) ? $this->common->mysql_safe_string($params['subcategory_id']) : '';

        $add_in['category_name'] = (isset($params['category_name'])) ? $this->common->mysql_safe_string($params['category_name']) : '';
        $add_in['subcategory_name'] = (isset($params['subcategory_name'])) ? $this->common->mysql_safe_string($params['subcategory_name']) : '';

        $add_in['update_date'] = date("Y-m-d H:i:s");

        $where = "user_id = '{$user_id}' and request_id='{$request_id}' and request_status='Requested'";

        $this->common->updateRecord('lt_requests', $add_in, $where);

        if (sizeof($requests_items) > 0) {
            $sql = "delete from lt_requests_items where request_id='{$request_id}' and user_id='{$user_id}'";
            $this->db->query($sql);
            foreach ($requests_items as $key => $val) {
                $add_in_items['request_id'] = $request_id;
                $add_in_items['user_id'] = $user_id;
                $add_in_items['consignment_qty'] = (isset($val['consignment_qty'])) ? $val['consignment_qty'] : '0';
                $add_in_items['consignment_details'] = (isset($val['consignment_details'])) ? $val['consignment_details'] : '';
                $add_in_items['consignment_width'] = (isset($val['consignment_width'])) ? $val['consignment_width'] : '0';
                $add_in_items['consignment_height'] = (isset($val['consignment_height'])) ? $val['consignment_height'] : '0';
                $add_in_items['consignment_weight'] = (isset($val['consignment_weight'])) ? $val['consignment_weight'] : '0';
                $add_in_items['consignment_length'] = (isset($val['consignment_length'])) ? $val['consignment_length'] : '0';

                $add_in_items['consignment_width_unit'] = (isset($val['consignment_width_unit'])) ? $val['consignment_width_unit'] : 'CM';
                $add_in_items['consignment_height_unit'] = (isset($val['consignment_height_unit'])) ? $val['consignment_height_unit'] : 'CM';
                $add_in_items['consignment_weight_unit'] = (isset($val['consignment_weight_unit'])) ? $val['consignment_weight_unit'] : 'KG';
                $add_in_items['consignment_length_unit'] = (isset($val['consignment_length_unit'])) ? $val['consignment_length_unit'] : 'CM';

                $this->common->insertRecord('lt_requests_items', $add_in_items);
            }
        }

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! your request updated successfully. ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function getRequestDetail($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';

        $driver_id = (isset($params['driver_id'])) ? (int) $this->common->mysql_safe_string($params['driver_id']) : '0';

        $sql_cond = "";
        $sql_cond_user = "";
        $sql_cond_dri = "";

        if ($user_id != 0) {
            $sql_cond_user = " and rq.user_id='{$user_id}' ";
        } else {
            $sql_cond_user = " ";
        }
        if ($driver_id != 0) {
            $sql_cond_dri = " and rq.driver_id='{$driver_id}' ";
        } else {
            $sql_cond_dri = " ";
        }
        if (!isset($params['status_flag'])) {
            $sql_cond_status = "   rq.status_flag='Active'";
        } else {
            $sql_cond_status = "   rq.status_flag in (" . $params['status_flag'] . ") ";
        }

        $request_id = (isset($params['request_id'])) ? $this->common->mysql_safe_string($params['request_id']) : '0';

        $sql_cond = "";

        $arr['status'] = 1;
        $arr['result'] = [];
        $add_in_image = [];
        $add_in_items = [];
        $requests_items = [];
        $bids_list = [];
        $bids_details = [];

        $sql = "select rq.* ,

        uf1.user_id as service_pro_user_id, uf1.first_name as service_pro_first_name ,uf1.middle_name as service_pro_middle_name ,uf1.last_name as service_pro_last_name ,uf1.mobile as service_pro_mobile ,uf1.profile_pic as service_pro_profile_pic ,
        uf2.user_id as dri_user_id, uf2.first_name as dri_first_name ,uf2.middle_name as dri_middle_name ,uf2.last_name as dri_last_name ,uf2.mobile as dri_mobile ,uf2.profile_pic as dri_profile_pic
        from lt_requests rq
          left join user_master_front uf1 on rq.service_provider_id= uf1.user_id
          left join user_master_front uf2 on rq.driver_id= uf2.user_id

        where {$sql_cond_status}  {$sql_cond_user} {$sql_cond_dri} and  rq.request_id='{$request_id}' order by rq.insert_date desc";
        //$ddd =getRecordsLimit
        $requestsQuery = $this->db->query($sql);
        if ($requestsQuery->num_rows() > 0) {

            $requests_val = $requestsQuery->row_array();

            $sql = "select * from lt_requests_items where request_id='{$request_id}' ";
            $request_item_query = $this->db->query($sql)->result_array();
            if ($request_item_query) {
                foreach ($request_item_query as $request_item_query_val) {
                    $add_in_items['lt_requests_items_id'] = $request_item_query_val['lt_requests_items_id'];
                    $add_in_items['consignment_qty'] = $request_item_query_val['consignment_qty'];
                    $add_in_items['consignment_details'] = $request_item_query_val['consignment_details'];
                    $add_in_items['consignment_width'] = $request_item_query_val['consignment_width'];
                    $add_in_items['consignment_height'] = $request_item_query_val['consignment_height'];
                    $add_in_items['consignment_weight'] = $request_item_query_val['consignment_weight'];
                    $add_in_items['consignment_length'] = $request_item_query_val['consignment_length'];

                    $add_in_items['consignment_width_unit'] = $request_item_query_val['consignment_width_unit'];
                    $add_in_items['consignment_height_unit'] = $request_item_query_val['consignment_height_unit'];
                    $add_in_items['consignment_weight_unit'] = $request_item_query_val['consignment_weight_unit'];
                    $add_in_items['consignment_length_unit'] = $request_item_query_val['consignment_length_unit'];

                    $requests_items[] = $add_in_items;
                }
            }
            //image

            $consignment_image = $this->get_consignment_image($request_id);
            $complete_consignment_image = $this->getCompletedConsignmentImage($request_id);
            //bids list
            $customer_info = [];
            $customer_info1 = $this->getProfile($requests_val);
            $customer_info['user_id'] = $customer_info1['userInfo']['user_id'];
            $customer_info['first_name'] = $customer_info1['userInfo']['first_name'];
            $customer_info['middle_name'] = $customer_info1['userInfo']['middle_name'];
            $customer_info['last_name'] = $customer_info1['userInfo']['last_name'];
            $customer_info['email'] = $customer_info1['userInfo']['email'];
            $customer_info['mobile'] = $customer_info1['userInfo']['mobile'];
            $customer_info['enterprise_name'] = $customer_info1['userInfo']['enterprise_name'] . "";
            $customer_info['user_photo'] = $customer_info1['userInfo']['user_photo'] . "";
            $customer_info['country_code'] = $customer_info1['userInfo']['country_code'] . "";

            $bids_list = $this->getBidsQuotes($request_id);
            $is_editable = ($requests_val['request_status'] == 'Requested') ? 1 : 0;
//cust_can_cancel_request =0 , means can not do cancel
// current date -pickupdate = 2 or more than can do cancel
            $date1  = ($requests_val['pickup_date']!="") ? $requests_val['pickup_date'] : date("Y-m-d") ;
            $date2 = date("Y-m-d");
            $days_diff  = $this->common->daysBetweenDate($date2, $date1);

            $cust_can_cancel_request = ($days_diff >=2 && $requests_val['request_status']!="Completed") ? 1:0;
            $lt_requests = array(
                'request_id' => $requests_val['request_id'],
                'uuid' => $requests_val['uuid'],
                'driver_id' => $requests_val['driver_id'],
                'shipment_id' => $requests_val['shipment_id'] . "",
                'insert_date' => $requests_val['insert_date'],
                'service_provider_id' => $requests_val['service_provider_id'],
                'user_id' => $requests_val['user_id'],
                'request_title' => $requests_val['request_title'],
                'request_description' => $requests_val['request_description'],
                "pickup_location_id" => $requests_val['pickup_location_id'],
                "destination_location_id" => $requests_val['destination_location_id'],
                'pickup_location' => $requests_val['pickup_location'],
                'pickup_longitude' => $requests_val['pickup_longitude'],
                'pickup_latitude' => $requests_val['pickup_latitude'],
                'destination_location' => $requests_val['destination_location'],
                'destination_longitude' => $requests_val['destination_longitude'],
                'destination_latitude' => $requests_val['destination_latitude'],
                'pickup_date' => $requests_val['pickup_date'],
                'drop_destination_date' => $requests_val['drop_destination_date'],
                'latest_pickup_date' => $requests_val['latest_pickup_date'],
                'latest_drop_destination_date' => $requests_val['latest_drop_destination_date'],
                'distance_mile' => $requests_val['distance_mile'],
                'expected_travelling_time' => $requests_val['expected_travelling_time'],
                'category_id' => $requests_val['category_id'],
                'category_name' => $requests_val['category_name'],
                'subcategory_id' => $requests_val['subcategory_id'],
                'subcategory_name' => $requests_val['subcategory_name'],
                'consignment_note' => $requests_val['consignment_note'],
                'budget_amount' => $requests_val['budget_amount'],
                'request_status' => $requests_val['request_status'],
                'request_sub_status' => $requests_val['request_sub_status'] . "",
                'is_editable' => $is_editable,
                'consignment_image' => $consignment_image,
                'requests_items' => $requests_items,
                'bids_list' => $bids_list,
                'customer_info' => $customer_info,
                'complete_consignment_image' => $complete_consignment_image,
                'driver_ratings_overall' => $requests_val['driver_ratings_overall'] * 1,
                'driver_ratings' => $requests_val['driver_ratings'] * 1,
                'driver_review' => $requests_val['driver_review'] . "",
                'driver_review_date' => $requests_val['driver_review_date'] . "",
                'service_pro_overall' => $requests_val['service_pro_overall'] * 1,
                'service_pro_ratings' => $requests_val['service_pro_ratings'] * 1,
                'service_pro_review' => $requests_val['service_pro_review'] . "",
                'service_pro_review_date' => $requests_val['service_pro_review_date'] . "",
                'cust_overall' => $requests_val['cust_overall'] * 1,
                'cust_rating' => $requests_val['cust_rating'] * 1,
                'cust_review' => $requests_val['cust_review'] . "",
                'cust_review_date' => $requests_val['cust_review_date'] . "",
                'cust_can_cancel_request' => $cust_can_cancel_request

            );

            //$lt_requests['service_pro_ratings'] = $this->getAverageReview($requests_val['service_pro_user_id'], 'servicepro') + 0;
           // $lt_requests['driver_ratings'] = $this->getAverageReview($requests_val['dri_user_id'], 'dri') + 0;

            if ($requests_val['service_pro_profile_pic'] != '') {
                $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($requests_val['service_pro_profile_pic']);
            } else {
                $user_photo = back_path . "uploads/noimage.png";
            }
            $lt_requests['service_pro_profile_pic'] = $user_photo;

            if ($requests_val['dri_profile_pic'] != '') {
                $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($requests_val['dri_profile_pic']);
            } else {
                $user_photo = back_path . "uploads/noimage.png";
            }
            $lt_requests['dri_profile_pic'] = $user_photo;

            $lt_requests['service_pro_user_id'] = (int) $requests_val['service_pro_user_id'] . "";
            $lt_requests['service_pro_first_name'] = $requests_val['service_pro_first_name'] . "";
            $lt_requests['service_pro_middle_name'] = $requests_val['service_pro_middle_name'] . "";
            $lt_requests['service_pro_last_name'] = $requests_val['service_pro_last_name'] . "";
            $lt_requests['service_pro_mobile'] = $requests_val['service_pro_mobile'] . "";
            $lt_requests['dri_first_name'] = $requests_val['dri_first_name'] . "";
            $lt_requests['dri_middle_name'] = $requests_val['dri_middle_name'] . "";
            $lt_requests['dri_last_name'] = $requests_val['dri_last_name'] . "";
            $lt_requests['dri_user_id'] = (int) $requests_val['dri_user_id'] . "";
            $lt_requests['dri_mobile'] = $requests_val['dri_mobile'] . "";

            $arr['status'] = 1;
            $arr['result'] = $lt_requests;
        }
        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function getBidsQuotes($request_id = 0)
    {
        $VAT_PERCENTAGE = $this->getKeyValue('VAT_PERCENTAGE');
        $ADMIN_FEE_PERCENTAGE = 5;
        $bids_list = [];
        $sql = "select rq.request_quote_id, rq.quote_amount, rq.quote_note ,rq.quote_seeker_approval ,rq.quote_approval_date
        ,rq.is_truck_tracking_activated  ,rq.is_trip_completed    ,rq.pickup_date ,rq.drop_date , rq.insert_date as bid_place_date,

        uf1.user_id as service_pro_user_id, uf1.first_name as service_pro_first_name ,uf1.middle_name as service_pro_middle_name ,uf1.last_name as service_pro_last_name ,uf1.mobile as service_pro_mobile ,uf1.profile_pic as service_pro_profile_pic

        from lt_request_quotes rq
                left join user_master_front uf1 on rq.service_provider_id= uf1.user_id
                left join user_master_front uf2 on rq.driver_id= uf2.user_id
                 where rq.request_id='{$request_id}' and rq.status_flag='Active' order by rq.request_quote_id desc";
        $request_bids = $this->db->query($sql)->result_array();
        if (sizeof($request_bids) > 0) {
            foreach ($request_bids as $request_bids_val) {
                $request_bids_val['service_pro_ratings'] = $this->getAverageReview($request_bids_val['service_pro_user_id'], 'servicepro') + 0;

                if ($request_bids_val['service_pro_profile_pic'] != '') {
                    $user_photo = back_path . "uploads/profile_pics/" . $this->common->mysql_safe_string($request_bids_val['service_pro_profile_pic']);
                } else {
                    $user_photo = back_path . "uploads/noimage.png";
                }
                $request_bids_val['service_pro_profile_pic'] = $user_photo;

                $request_bids_val['request_quote_id'] = $request_bids_val['request_quote_id'] . "";
                $request_bids_val['quote_amount'] = $request_bids_val['quote_amount'] . "";
                $request_bids_val['quote_note'] = $request_bids_val['quote_note'] . "";
                $request_bids_val['quote_seeker_approval'] = $request_bids_val['quote_seeker_approval'] . "";

                $request_bids_val['bid_place_date'] = $request_bids_val['bid_place_date'] . "";

                $request_bids_val['dri_profile_pic'] = $user_photo;
                $request_bids_val['pickup_date'] = $this->common->getDateFormat($request_bids_val['pickup_date'], 'd-M-Y');
                $request_bids_val['drop_date'] = $this->common->getDateFormat($request_bids_val['drop_date'], 'd-M-Y');
                $request_bids_val['bid_place_date'] = $this->common->getDateFormat($request_bids_val['bid_place_date'], 'd-M-Y');
                $request_bids_val['bid_place_date'] = $request_bids_val['bid_place_date'] . "";

                $request_bids_val['service_pro_user_id'] = $request_bids_val['service_pro_user_id'] . "";
                $request_bids_val['service_pro_first_name'] = $request_bids_val['service_pro_first_name'] . "";
                $request_bids_val['service_pro_middle_name'] = $request_bids_val['service_pro_middle_name'] . "";
                $request_bids_val['service_pro_last_name'] = $request_bids_val['service_pro_last_name'] . "";
                $request_bids_val['service_pro_mobile'] = $request_bids_val['service_pro_mobile'] . "";
                $request_bids_val['quote_amount'] = $request_bids_val['quote_amount'] . "";

                $request_bids_val['quote_approval_date'] = $request_bids_val['quote_approval_date'] . "";
                $net_payable_info = [];
                $net_payable_info[] = array('label' => 'Bid Amount', 'amt' => $this->common->tep_round($request_bids_val['quote_amount']) . "");
                $quote_amount = $request_bids_val['quote_amount'];
                $quote_amount_vat = ($quote_amount * $VAT_PERCENTAGE) / 100;
                $quote_amount_admin_fee = ($quote_amount * $ADMIN_FEE_PERCENTAGE) / 100;
                $net_payable_info[] = array('label' => "VAT {$VAT_PERCENTAGE}%", 'amt' => $this->common->tep_round($quote_amount_vat));
                $net_payable_info[] = array('label' => "Admin Fee {$ADMIN_FEE_PERCENTAGE}%", 'amt' => $this->common->tep_round($quote_amount_admin_fee));
                $net_payable_info[] = array('label' => 'Total', 'amt' => $this->common->tep_round($quote_amount + $quote_amount_vat + $quote_amount_admin_fee));
                $request_bids_val['bid_amount_info'] = $net_payable_info;
                $bids_list[] = $request_bids_val;
            }
        }
        return $bids_list;
    }

    public function getAverageReview($user_id = 0, $user_type = 'dri')
    {
        if ($user_type == 'dri') {
            $sql = "select AVG(driver_ratings) as ratings FROM   lt_requests where driver_id='{$user_id}'";
        } else {
            $sql = "select AVG(service_pro_ratings) as ratings FROM   lt_requests where service_provider_id='{$user_id}'";
        }

        $average_reviiew = $this->db->query($sql)->row_array();
        return $average_reviiew['ratings'];
    }
    public function doDeleteConsignmentImageTemp($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';

        $image_name = (isset($params['image_name'])) ? $this->common->mysql_safe_string($params['image_name']) : '';
        /*
        $image_name_exp = explode("consignmentimage_temp/", $image_name);
        $destination_url = "uploads/consignmentimage_temp/" . $image_name_exp[1];
        $image_name_temp = $image_name_exp[1];

        @unlink($destination_url);
         */
        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! image deleted successfully. ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function doRequestAction($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';
        $request_id = (isset($params['request_id'])) ? $this->common->mysql_safe_string($params['request_id']) : '0';
        $action_flag = (isset($params['action_flag'])) ? $this->common->mysql_safe_string($params['action_flag']) : '0';
        $service_provider_id = (isset($params['service_provider_id'])) ? $this->common->mysql_safe_string($params['service_provider_id']) : '0';

        $today = date("Y-m-d H:i:s");
        $arr['status'] = 0;

        $arr['errorMessage'] = "Some thing went wrong. Please try again";

        $sql = "select *
        from lt_request_quotes rq
                 where rq.request_id='{$request_id}' and quote_seeker_approval =1   and rq.status_flag='Active'  ";
        $query = $this->db->query($sql);
        if ($query->num_rows() <= 0) {
            if ($action_flag == 1) {

                $request_status = 'Ongoing'; // oOrder Processed
                $request_sub_status = 'Booked'; // oOrder Processed

                $lt_requests['request_status'] = $request_status;

                $lt_requests['service_provider_id'] = $service_provider_id;
                $lt_requests['request_sub_status'] = $request_sub_status;
                //
                $where_edt = " service_provider_id=0  and   request_id='{$request_id}' and user_id='{$user_id}'";
                $this->common->updateRecord('lt_requests', $lt_requests, $where_edt);
                // add order history

                $lt_request_quotes['quote_seeker_approval'] = 1;
                $lt_request_quotes['quote_approval_date'] = $today;

                //
                $where_edt = " service_provider_id='{$service_provider_id}'  and   request_id='{$request_id}' and request_user_id='{$user_id}'";
                $this->common->updateRecord('lt_request_quotes', $lt_request_quotes, $where_edt);

                $this->db->query("INSERT INTO lt_requests_history SET request_id = '" . (int) $request_id . "' ,request_status = '" . $request_status . "',request_sub_status='{$request_sub_status}', comment='', date_added = '" . $today . "'");

                //  $chkRequestinfo = $this->common->getSingleInfoBy("lt_requests", 'request_id', $request_id);

                /*   $arra['user_id'] = $user_id;
                $arra['order_id'] = $order_id;
                $arra['driver_id'] = $user_id;
                $arra['order_status_id'] = 2;
                $arra['invoice_no'] = $chkRequestinfo['invoice_no'];
                $arra['order_date_added'] = $chkRequestinfo['date_added'];
                $arra['oorder_uid'] = $chkRequestinfo['oorder_uid']; */

                //   $this->sendNotificationToCustomer($arra, $chkRequestinfo['uuid'], '', '');
                // $this->setFirebaserealtimedata("update", $arra, 'Order Accepted by driver ');

            }

            $arr['status'] = $action_flag;
            $arr['successMessage'] = ($action_flag == 1) ? 'Offer accepted successfully' : '';
            $arr['errorMessage'] = ($action_flag == 2) ? 'Offer! Order denied ' : '';

            $update_data['quote_seeker_approval'] = $action_flag;
            $update_data['quote_approval_date'] = $today;
            $where_edt = " quote_seeker_approval=0 and service_provider_id='" . $service_provider_id . "' and request_id='" . $request_id . "' ";
            $this->common->updateRecord('lt_request_quotes', $update_data, $where_edt);
        }

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function doRequestStatusActionByDriver($params, $returnformat = "JSON")
    {
        $driver_id = (isset($params['driver_id'])) ? (int) $this->common->mysql_safe_string($params['driver_id']) : '0';
        $request_id = (isset($params['request_id'])) ? (int) $this->common->mysql_safe_string($params['request_id']) : '0';
        $action_flag = (isset($params['action_flag'])) ? $this->common->mysql_safe_string($params['action_flag']) : '';

        $request_status = "";
        $today = date("Y-m-d H:i:s");
        $arr['status'] = 0;

        $arr['errorMessage'] = "Some thing went wrong. Please try again";
        $request_sub_status = "";
        $sql = "select * from lt_requests rq   where rq.request_id='{$request_id}'   and rq.status_flag='Active'  ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {

            if (strtolower($action_flag) == "dispatched") {
                $request_status = "Scheduled";
                $request_sub_status = "Dispatched";
                $lt_requests['is_trip_started'] = 1;
            }
            if (strtolower($action_flag) == "pickup") {
                $request_status = "Scheduled";
                $request_sub_status = "Pick Up";

            }
            if (strtolower($action_flag) == "delivered") {
                $request_status = "Completed";
                $request_sub_status = "Delivered";
               
                $lt_requests['is_trip_completed'] = 1;
            }
            if ($request_sub_status != "") {
                $lt_requests['request_status'] = $request_status;
                $lt_requests['request_sub_status'] = $request_sub_status;

                //
                $where_edt = "request_id='{$request_id}'  ";
                $this->common->updateRecord('lt_requests', $lt_requests, $where_edt);
                // add order history

                $this->db->query("INSERT INTO lt_requests_history SET request_id = '" . (int) $request_id . "' ,request_status = '" . $request_status . "',request_sub_status='{$request_sub_status}', comment='by driver {$driver_id}', date_added = '" . $today . "'");
            }
            $arr = [];
            $arr['status'] = 1;
            $arr['successMessage'] = 'Request order status changed successfully';

        }

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function doLiveTrackingDrver($params, $returnformat = "JSON")
    {
        $driver_id = (isset($params['driver_id'])) ? (int) $this->common->mysql_safe_string($params['driver_id']) : '0';
        $request_id = (isset($params['request_id'])) ? (int) $this->common->mysql_safe_string($params['request_id']) : '0';
        $longitude = (isset($params['longitude'])) ? $this->common->mysql_safe_string($params['longitude']) : '';
        $latitude = (isset($params['latitude'])) ? $this->common->mysql_safe_string($params['latitude']) : '';

        $today = date("Y-m-d H:i:s");

        $sql = "delete from lt_driver_live_location where  request_id = '" . (int) $request_id . "' and driver_id = '" . $driver_id . "'";
        $this->db->query($sql);

        $this->db->query("INSERT INTO lt_driver_live_location SET request_id = '" . (int) $request_id . "' ,driver_id = '" . $driver_id . "',longitude='{$longitude}',latitude='{$latitude}',  date_added = '" . $today . "'");

        $arr['status'] = 1;
        $arr['successMessage'] = 'Successfully added the location ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function getLiveTrackingDrver($params, $returnformat = "JSON")
    {
        $driver_id = (isset($params['driver_id'])) ? (int) $this->common->mysql_safe_string($params['driver_id']) : '0';
        $request_id = (isset($params['request_id'])) ? (int) $this->common->mysql_safe_string($params['request_id']) : '0';

        $add_in_image = [];
        $sql = "select * from lt_driver_live_location where   driver_id='{$driver_id}' ";
        $request_query = $this->db->query($sql)->row_array();

        $arr['status'] = 1;
        $arr['result'] = $request_query;
        $arr['successMessage'] = '';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function doGetCompletedConsignmentImage($params, $returnformat = "JSON")
    {

        $request_id = (isset($params['request_id'])) ? (int) $this->common->mysql_safe_string($params['request_id']) : '0';

        $add_in_image = $this->getCompletedConsignmentImage($request_id);

        $arr['status'] = 1;
        $arr['complete_cons_image'] = $add_in_image;
        $arr['successMessage'] = 'Successfully added the location ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function getCompletedConsignmentImage($request_id = 0)
    {
        $add_in_image = [];
        $sql = "select * from lt_request_final_complete_images where request_id='{$request_id}'  ";
        $request_imgs_query = $this->db->query($sql)->result_array();
        if (sizeof($request_imgs_query) > 0) {
            foreach ($request_imgs_query as $request_imgs_query_val) {
                $add_in_image[] = back_path . "uploads/consignmentimage/" . $request_imgs_query_val['image_name'];
            }
        }
        return $add_in_image;
    }
    public function get_consignment_image($request_id = 0)
    {
        $add_in_image = [];
        $sql = "select * from lt_request_consignment_imgs where request_id='{$request_id}' ";
        $request_imgs_query = $this->db->query($sql)->result_array();
        if ($request_imgs_query) {
            foreach ($request_imgs_query as $request_imgs_query_val) {
                $add_in_image[] = back_path . "uploads/consignmentimage/" . $request_imgs_query_val['image_name'];
            }
        }
        return $add_in_image;
    }

    public function doAddReview($params, $returnformat = "JSON")
    {

        $request_id = (isset($params['request_id'])) ? (int) $this->common->mysql_safe_string($params['request_id']) : '0';

        //$to_user_id = (isset($params['by_user_id'])) ? (int) $this->common->mysql_safe_string($params['by_user_id']) : '0';
        $rating = (isset($params['rating'])) ? (int) $this->common->mysql_safe_string($params['rating']) : '0';
        $review = (isset($params['review'])) ? $this->common->mysql_safe_string($params['review']) : '';
        $over_all = (isset($params['over_all'])) ? (int) $this->common->mysql_safe_string($params['over_all']) : '0';
        //  $by_user_type = (isset($params['by_user_type'])) ? $this->common->mysql_safe_string($params['by_user_type']) : '';

        $to_user_type = (isset($params['to_user_type'])) ? $this->common->mysql_safe_string($params['to_user_type']) : '';

        if ($to_user_type == "Driver") {
            $add_review = [];
            $add_review['driver_review_date'] = date("Y-m-d H:i:s");
            $add_review['driver_ratings'] = $rating;
            $add_review['driver_review'] = $review;
            $add_review['driver_ratings_overall'] = $over_all;

            $where_edt = "request_id = '" . $request_id . "'";
            $this->common->updateRecord('lt_requests', $add_review, $where_edt);
        }
        if ($to_user_type == "Service Provider") {
            $add_review = [];
            $add_review['service_pro_review_date'] = date("Y-m-d H:i:s");
            $add_review['service_pro_ratings'] = $rating;
            $add_review['service_pro_review'] = $review;
            $add_review['service_pro_overall'] = $over_all;
            $where_edt = "request_id = '" . $request_id . "'";
            $this->common->updateRecord('lt_requests', $add_review, $where_edt);
        }
        if ($to_user_type == "Customer") {
            $add_review = [];
            $add_review['cust_review_date'] = date("Y-m-d H:i:s");
            $add_review['cust_rating'] = $rating;
            $add_review['cust_review'] = $review;
            $add_review['cust_overall'] = $over_all;
            $where_edt = "request_id = '" . $request_id . "'";
            $this->common->updateRecord('lt_requests', $add_review, $where_edt);
        }

        $arr['status'] = 1;

        $arr['successMessage'] = 'Successfully added the review ';

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function getReviewsList($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? (int) $this->common->mysql_safe_string($params['user_id']) : '0';

        $to_user_type = (isset($params['to_user_type'])) ? $this->common->mysql_safe_string($params['to_user_type']) : '';
        //to_user_type : Service Provider , Driver,Customer
        if ($to_user_type == "Service Provider") {
            $sql = "select request_title, service_pro_overall as overall,service_pro_ratings as ratings,service_pro_review as review, service_pro_review_date as review_date from lt_requests where service_provider_id='{$user_id}'  ";
        }
        if ($to_user_type == "Driver") {
            $sql = "select  request_title, driver_ratings_overall as overall,driver_ratings as ratings,driver_review as review, driver_review_date as review_date from lt_requests where driver_id='{$user_id}'  ";
        }
        if ($to_user_type == "Customer") {
            $sql = "select  request_title, cust_overall as overall,cust_rating as ratings,cust_review as review, cust_review_date as review_date  from lt_requests where user_id='{$user_id}'   ";
        }

        $request_query = $this->db->query($sql)->result_array();
        $reviews = [];
        foreach ($request_query as $request_query_val) {

            if ($request_query_val['ratings'] > 0) {
                $request_query_val['request_title'] = $request_query_val['request_title'] . "";
                $request_query_val['overall'] = $request_query_val['overall'] . "";
                $request_query_val['ratings'] = $request_query_val['ratings'] . "";
                $request_query_val['review'] = $request_query_val['review'] . "";
                $request_query_val['review_date'] = $request_query_val['review_date'] . "";
                $reviews[] = $request_query_val;
            }

        }
        $arr['status'] = 1;
        $arr['result'] = $reviews;

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function doRequestCancelAction($params, $returnformat = "JSON")
    {
        $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '0';
        $request_id = (isset($params['request_id'])) ? $this->common->mysql_safe_string($params['request_id']) : '0';
        $cancel_reason = (isset($params['cancel_reason'])) ? $this->common->mysql_safe_string($params['cancel_reason']) : '';

        $today = date("Y-m-d H:i:s");
        $arr['status'] = 0;

        $arr['errorMessage'] = "Some thing went wrong. Please try again";

        $sql = "select *    from lt_requests rq   where rq.request_id='{$request_id}' and rq.status_flag='Active'  ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $query_info  = $query->row_array();
            //and request_status='Requested'  and 
            if($query_info['request_status'] == "Requested"){
                $request_status = 'Cancel'; // oOrder Processed
                $request_sub_status = 'Cancel'; // oOrder Processed
    
                $lt_requests['request_status'] = $request_status;
                $lt_requests['status_flag'] = "Cancel";
                $lt_requests['cancel_date'] = $today;
                $lt_requests['cancel_reason'] = $cancel_reason;
                $lt_requests['request_sub_status'] = $request_sub_status;
                //
                $where_edt = "request_id='{$request_id}' and user_id='{$user_id}'";
                $this->common->updateRecord('lt_requests', $lt_requests, $where_edt);
                // add order history
    
                $this->db->query("INSERT INTO lt_requests_history SET request_id = '" . (int) $request_id . "' ,request_status = '" . $request_status . "',request_sub_status='{$request_sub_status}', comment='{$cancel_reason}', date_added = '" . $today . "'");
    
                //  $chkRequestinfo = $this->common->getSingleInfoBy("lt_requests", 'request_id', $request_id);
    
                /*   $arra['user_id'] = $user_id;
                $arra['order_id'] = $order_id;
                $arra['driver_id'] = $user_id;
                $arra['order_status_id'] = 2;
                $arra['invoice_no'] = $chkRequestinfo['invoice_no'];
                $arra['order_date_added'] = $chkRequestinfo['date_added'];
                $arra['oorder_uid'] = $chkRequestinfo['oorder_uid']; */
    
                //   $this->sendNotificationToCustomer($arra, $chkRequestinfo['uuid'], '', '');
                // $this->setFirebaserealtimedata("update", $arra, 'Order Accepted by driver ');
                $arr['status'] = 1;
                $arr['successMessage'] = 'Request order cancel successfully';
            } else {
                $arr['status'] = 0;
                $arr['errorMessage'] = 'Ohh! Sorry you can not cancel this order. Please contact or support team';
            }
            

        }

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }
    public function get_request_status_history($request_id = 0)
    {
        $request_status = [];
        $sql = "select request_status,request_sub_status from lt_requests_history where request_id='{$request_id}' ";
        $request_imgs_query = $this->db->query($sql)->result_array();
        if ($request_imgs_query) {
            foreach ($request_imgs_query as $request_imgs_query_val) {
                $request_status['request_sub_status'][] = $request_imgs_query_val['request_sub_status'];
                $request_status['request_status'][] = $request_imgs_query_val['request_status'];
            }
        }
        return $request_status;
    }
     
    public function doLoginViaMedia($params, $returnformat = "JSON")
    {
        //$facebook_gmail_by = $facebook_gmail_by = (isset($params['facebook_gmail_by'])) ? $this->common->mysql_safe_string($params['facebook_gmail_by']) : '';
        $add_in['user_type'] = (isset($params['user_type'])) ? $this->common->mysql_safe_string($params['user_type']) : 'Customer';

        $google_id = $google_id = (isset($params['google_id'])) ? $this->common->mysql_safe_string($params['google_id']) : '';
        $facebook_id = $facebook_id = (isset($params['facebook_id'])) ? $this->common->mysql_safe_string($params['facebook_id']) : '';
       // $email = $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        //  $full_name = (isset($params['full_name'])) ? $this->common->mysql_safe_string($params['full_name']) : '';
        $first_name = (isset($params['first_name'])) ? $this->common->mysql_safe_string($params['first_name']) : '';
        $last_name = (isset($params['last_name'])) ? $this->common->mysql_safe_string($params['last_name']) : '';

        $add_in['device_id'] = $device_id = (isset($params['device_id'])) ? $this->common->mysql_safe_string($params['device_id']) : '';
        $add_in['device_type'] = $device_type = (isset($params['device_type'])) ? $this->common->mysql_safe_string($params['device_type']) : '';

        $today = date("Y-m-d H:i:s");
        $arr['status'] = 0;

        $arr['errorMessage'] = "Some thing went wrong. Please try again";

        $errorMessage = "";

        if ($first_name == "") {
            $errorMessage = "Please enter first name";

        }
       
        if ($errorMessage == "") {
            $sql = "";
            if ($facebook_id != "") {
                $sql = "SELECT * FROM user_master_front where facebook_id='" . $facebook_id . "' ";
                $sqldel = "delete from user_master_front_temp where  facebook_id='" . $facebook_id . "'  ";
                $rs_login_row = $this->db->query($sqldel);
            }
            if ($google_id != "") {
                $sql = "SELECT * FROM user_master_front where google_id='" . $google_id . "' ";
                $sqldel = "delete from user_master_front_temp where  google_id='" . $google_id . "'  ";
                $rs_login_row = $this->db->query($sqldel);
    
            }
             
            if($sql!=""){
                $rschk = $this->db->query($sql);

                if ($rschk->num_rows() > 0) {
                    $chkUserInfo = $rschk->row_array();
                    
                    // $user_id = $chkUserInfo['user_id'];
                    $userInfo = $this->userProfileData($chkUserInfo);
                    $userInfo['ask_for_email'] = 0; 
                    $retUserAddressInfo = $this->getDefaultAddress($chkUserInfo);
                   
                    if ($chkUserInfo['status_flag'] == 'Active') {
    
                        $add_in_uuid['login_time'] = date("Y-m-d H:i:s");
                        $add_in_uuid['is_login'] = 1;
                        $add_in_uuid['device_id'] = $device_id;
                        $add_in_uuid['device_type'] = $device_type;
    
                        $where_edt_user = "user_id = '" . $chkUserInfo['user_id'] . "'";
                        $this->common->updateRecord('user_master_front', $add_in_uuid, $where_edt_user);
                        $arr['status'] = 1;
                        $arr['userInfo'] = $userInfo;
                        $arr['addressInfo'] = $retUserAddressInfo;
                        $arr['errorMessage'] = "";
                    } else if ($chkUserInfo['is_email_verified'] == 0 && $chkUserInfo['status_flag'] == 'Inactive') {
    
                        $temp_otp = "1234";
                        $sql_data_array = array(
    
                            'temp_otp' => $temp_otp,
                            'device_id' => $device_id,
                            'device_type' => $device_type,
                        );
    
                        $where = "user_id = '" . $chkUserInfo['user_id'] . "' and temp_otp='" . $temp_otp . "'";
                        $this->common->updateRecord('user_master_front', $sql_data_array, $where);
    
                        $userInfo = $this->userProfileData($chkUserInfo);
                        $userInfo['temp_otp'] = $temp_otp;
                        //$arr['errorData'] = [];
                        $arr['userInfo'] = $userInfo;
                        $arr['addressInfo'] = $retUserAddressInfo;
    
                        $arr['temp_otp'] = $temp_otp;
                        $arr['status'] = 2;
                        // $arr['userInfo'] = $userInfo;
                        //  $arr['addressInfo'] = $retUserAddressInfo;
                        $arr['errorMessage'] = "Success! We have sent the OTP in yor mail box.Please check your mail";
                    } else if ($chkUserInfo['status_flag'] == 'Delete') {
                        $errorMessage = "Please contact admin. There is some issue in your account";
                        $arr['status'] = 0;
                        $arr['retData'] = $params;
    
                        $arr['errorMessage'] = $errorMessage;
                    } else {
                        $errorMessage = "Some thing went wrong. Please contact admin ";
                        $arr['status'] = 0;
                        $arr['retData'] = $params;
    
                        $arr['errorMessage'] = $errorMessage;
                    }
    
                } else {
                    
                    $add_in = array();
                    $errorData = array();
                    $errorMessage = "";
            
                    $add_in['user_type'] = (isset($params['user_type'])) ? $this->common->mysql_safe_string($params['user_type']) : 'Customer';
            
                    $add_in['first_name'] = (isset($params['first_name'])) ? $this->common->mysql_safe_string($params['first_name']) : '';
                    $add_in['last_name'] = (isset($params['last_name'])) ? $this->common->mysql_safe_string($params['last_name']) : '';
                    $add_in['middle_name'] = (isset($params['middle_name'])) ? $this->common->mysql_safe_string($params['middle_name']) : null;
                    $add_in['mobile'] = (isset($params['mobile'])) ? $this->common->mysql_safe_string($params['mobile']) : null;
                  
                    $add_in['email'] = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
                    $add_in['passphrase'] = $passphrase = (isset($params['passphrase'])) ? $this->common->mysql_safe_string($params['passphrase']) : '';
                    $add_in['user_language'] = $LANGCODE = (isset($params['LANGCODE'])) ? $this->common->mysql_safe_string($params['LANGCODE']) : 'EN';
                    $add_in['device_id'] = $device_id = (isset($params['device_id'])) ? $this->common->mysql_safe_string($params['device_id']) : '';
                    $add_in['device_type'] = $device_type = (isset($params['device_type'])) ? $this->common->mysql_safe_string($params['device_type']) : '';

                    $add_in['facebook_id'] = (isset($params['facebook_id'])) ? $this->common->mysql_safe_string($params['facebook_id']) : '';
                    $add_in['google_id'] = (isset($params['google_id'])) ? $this->common->mysql_safe_string($params['google_id']) : '';
                  

                    $add_in['status_flag'] = 'Active';
                    
                    
            
                    if ($errorMessage == "") {
                        try {
                            // Generate a version 4 (random) UUID object
                            $uuid4 = Uuid::uuid4();
                            $uuid = $uuid4->toString();
                            $add_in['uuid'] = $uuid;
                        } catch (UnsatisfiedDependencyException $e) {
            
                        }
                        $add_in['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
                        $add_in['added_date'] = date("Y-m-d H:i:s");
 
                        $this->common->insertRecord('user_master_front_temp', $add_in);
                        $chkUserInfo = $this->common->getSingleInfoBy('user_master_front_temp', 'uuid', $add_in['uuid'], '*');
            
                         
                    
            
                        $userInfo = $this->userProfileData($chkUserInfo);
                      //  $userInfo['is_otp_verified'] = 0;
                        $userInfo['ask_for_email'] =1; 
                        $arr['status'] = 1;
                        $arr['errorData'] = [];
                        $arr['userInfo'] = $userInfo;
                        $arr['temp_otp'] = $temp_otp;
                        $arr['call_next_api'] = 'doAskForEmail';
                        $arr['addressInfo'] = $retUserAddressInfo = [];
                        $arr['errorMessage'] = "";
                        $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box. Please check your mail';
            
                        // $sendotp_data = $this->sendotp($user_info);
            
                         
                    } else {
                        $errorData[] = $errorMessage;
                        // $arr = array('status' => 0, 'retData' => $params, 'errorData' => $errorData);
                        $arr['status'] = 0;
                        $arr['retData'] = $params;
                        // $arr['errorData'] = $errorData;
                        $arr['errorMessage'] = $errorMessage;
                    }
                }
            }else {
                $arr['status'] = 0;
                $arr['retData'] = $params;
                // $arr['errorData'] = $errorData;
                $arr['errorMessage'] = "Missing some param from app";
            }
           

        } else {
            $arr['status'] = 0;
            $arr['retData'] = $params;
            // $arr['errorData'] = $errorData;
            $arr['errorMessage'] = $errorMessage;
        }
        

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    //
    public function doAskForEmail($params, $returnformat = "JSON")
    {
        
       

        $google_id = $google_id = (isset($params['google_id'])) ? $this->common->mysql_safe_string($params['google_id']) : '';
        $facebook_id = $facebook_id = (isset($params['facebook_id'])) ? $this->common->mysql_safe_string($params['facebook_id']) : '';
        $email = $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
         

        $today = date("Y-m-d H:i:s");
        $arr['status'] = 0;

        $arr['errorMessage'] = "Some thing went wrong. Please try again";

        $errorMessage = "";

        if ($google_id == "" && $facebook_id=="") {
            $errorMessage = "Please provide the social link id";

        }
        if ($email == "") {
            $errorMessage = "Please enter email";

        }
        if ($errorMessage == "") {

            $add_in['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
            $sql_data_array['status_flag'] = 'Active';
            $sql_data_array['edit_date'] = date("Y-m-d H:i:s");
            $sql_data_array['email'] = $email;

            if($facebook_id!=""){
                $where = "facebook_id = '" . $facebook_id . "'  ";
                $this->common->updateRecord('user_master_front_temp', $sql_data_array, $where);
            } else {
                $where = "google_id = '" . $google_id . "' ";
                $this->common->updateRecord('user_master_front_temp', $sql_data_array, $where);
            }
         
           

            $arr['status'] = 1;
            $arr['retData'] = $params;
            $arr['temp_otp'] = $temp_otp;
            $arr['call_next_api'] = 'doOTPverificationMedia';
            $arr['errorMessage'] = "";
            $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box. Please check your mail';

             
        
           

        } else {
            $arr['status'] = 0;
            $arr['retData'] = $params;
            // $arr['errorData'] = $errorData;
            $arr['errorMessage'] = $errorMessage;
        }
        

        if ($returnformat == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }
    }

    public function doOTPverificationMedia($params = array(), $returnType = 'ARRAY')
    {

        $add_in = array();
        // $add_in['user_id'] = $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '';
        $add_in['email'] = $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        $add_in['temp_otp'] = $temp_otp = (isset($params['temp_otp'])) ? $this->common->mysql_safe_string($params['temp_otp']) : '';
        $errorData = array();

        $sql = "select * from user_master_front_temp where email='" . $email . "' and temp_otp='" . $temp_otp . "' order by user_id desc ";
        $rs_login_row = $this->db->query($sql);
        if ($rs_login_row->num_rows() > 0) {

            $chkUserInfo = $rs_login_row->row_array();


            

            $chkUserInfo_temp = $this->common->getSingleInfoBy('user_master_front', 'email', $add_in['email'], '*');
            if (sizeof($chkUserInfo_temp) > 0) {
            
                if($chkUserInfo['google_id']!=""){
                    $sql_data_array['google_id'] = $chkUserInfo['google_id'];
                }
                if($chkUserInfo['facebook_id']!=""){
                    $sql_data_array['facebook_id'] = $chkUserInfo['facebook_id'];
                }
                $sql_data_array['status_flag'] = 'Active';
                $sql_data_array['edit_date'] = date("Y-m-d H:i:s");
                $sql_data_array['is_email_verified'] = 1;
                $sql_data_array['is_login'] = 1;
                $sql_data_array['email_verified_date'] = date("Y-m-d H:i:s");
                $sql_data_array['login_time'] = date("Y-m-d H:i:s");

           

            $where = "email = '" . $email . "' and email!=''  ";

            $this->common->updateRecord('user_master_front', $sql_data_array, $where);
            $chkUserInfo = $chkUserInfo_temp;

            } else {
                $add_in = [];
                $add_in['is_email_verified'] = 1;
                $add_in['email_verified_date'] = date("Y-m-d H:i:s");
                $add_in['login_time'] = date("Y-m-d H:i:s");
                $add_in['is_login'] = 1;
                $add_in['status_flag'] = 'Active';
                $add_in['is_login'] = 1;
                $add_in['edit_date'] =  date("Y-m-d H:i:s");
                $add_in['added_date'] =  date("Y-m-d H:i:s");
                $add_in['uuid'] = $chkUserInfo['uuid'] . "";
               // $add_in['user_id'] = $chkUserInfo['user_id'] . "";
                $add_in['user_type'] = $chkUserInfo['user_type'] . "";
                $add_in['first_name'] = $chkUserInfo['first_name'] . "";
                $add_in['middle_name'] = $chkUserInfo['middle_name'] . "";
                $add_in['last_name'] = $chkUserInfo['last_name'] . "";
                $add_in['email'] = $chkUserInfo['email'] . "";
                $add_in['mobile'] = $chkUserInfo['mobile'] . "";
                $add_in['enterprise_name'] = $chkUserInfo['country_code'] . "";
                //$add_in['user_photo'] =  "";
                $add_in['country_code'] = $chkUserInfo['country_code'] . "";
                $add_in['facebook_id'] = $chkUserInfo['facebook_id'] . "";
                $add_in['google_id'] = $chkUserInfo['google_id'] . "";
                $add_in['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
                $add_in['added_date'] = date("Y-m-d H:i:s");
    
                $add_in['user_language'] = $chkUserInfo['user_language'] . "";
                $add_in['device_id'] = $chkUserInfo['device_id'] . "";
                $add_in['device_type'] = $chkUserInfo['device_type'] . "";
        
                $add_in['country_code'] = $chkUserInfo['country_code'] . "";
    
                $this->common->insertRecord('user_master_front', $add_in);
                $chkUserInfo = $this->common->getSingleInfoBy('user_master_front', 'uuid', $chkUserInfo['uuid'], '*');
                 /* 
                try {
                    // Generate a version 4 (random) UUID object
                    $uuid4 = Uuid::uuid4();
                    $uuid_shipping = $uuid4->toString();
                    $address_in['uuid'] = $uuid_shipping;
                } catch (UnsatisfiedDependencyException $e) {
    
                }
               
                $address_in['address_name'] = 'Home';
                $address_in['address_1'] =  '';
                $address_in['state_id'] =  '';
                $address_in['city_id'] =  '';
                $address_in['postcode'] =  '';
                $address_in['user_id'] = $chkUserInfo['user_id'];
                $address_in['firstname'] = $add_in['first_name'];
                $address_in['lastname'] = $add_in['last_name'];
                $address_in['is_default'] = 1;
                $this->db->insert('customer_shipping_address', $address_in); */
                

                //delet from temp table 
               
            }

            $sql = "delete from user_master_front_temp where  email='" . $email . "' and temp_otp='" . $temp_otp . "'";
            $rs_login_row = $this->db->query($sql);
            
            $userInfo = $this->userProfileData($chkUserInfo);
            $userInfo['is_email_verified'] = 0; 
            $userInfo['is_otp_verified'] = 1; 

            $retUserAddressInfo = [];//$this->getDefaultAddress($chkUserInfo);

            $arr['status'] = 1;
            $arr['userInfo'] = $userInfo;
            $arr['addressInfo'] = $retUserAddressInfo;
            $arr['call_next_api'] = 'RedirectHome';
            $arr['errorMessage'] = "";
            $arr['successMessage'] = "Congratulations! OTP Verified";
            

        } else {
            $errorData[] = 'OTP mismatched';
            $errorMessage = 'OTP mismatched';
            $arr['status'] = 0;
            $arr['retData'] = $params;
            // $arr['errorData'] = $errorData;
            $arr['call_next_api'] = 'doOTPverificationMedia';
            $arr['errorMessage'] = $errorMessage;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }

    public function resendOTPforMedia($params = array(), $returnType = "json")
    {
        // $user_id = (isset($params['user_id'])) ? $this->common->mysql_safe_string($params['user_id']) : '';
        $email = (isset($params['email'])) ? $this->common->mysql_safe_string($params['email']) : '';
        // AND user_id='{$user_id}'
        $where = " email='{$email}'    ";
        $chkUserInfo = $this->common->getRecord('user_master_front_temp', $where);

        if (sizeof($chkUserInfo) > 0) {

            $where_edt_user = "email = '" . $email . "'";
            $add_in_uuid['temp_otp'] = $temp_otp = "1234"; //$this->common->RandomNameki(4);
            $this->common->updateRecord('user_master_front_temp', $add_in_uuid, $where_edt_user);

            $user_info = $chkUserInfo;

            $arr['status'] = 1;
            $arr['temp_otp'] = $temp_otp;
            $arr['call_next_api'] = 'doOTPverificationMedia';
            $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box.Please check your mail';

            /* $sql = "select * from  `setting` where `group`='config_site_mail'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        $m_setting = $query->result_array();

        foreach ($m_setting as $key => $val) {
        $config_site_mail[$val['key']] = $val['value'];
        }

        $subject = "Complete your registration!";

        $fileg = file_get_contents("uploads/mail_register.html");
        $full_name = $chkUserInfo['first_name'] . " " . $chkUserInfo['last_name'];
        $pattern = array('/{FULLNAME}/', '/{OTP}/');
        $replacement = array($full_name, $temp_otp);
        $mess_body = preg_replace($pattern, $replacement, $fileg);

        try {
        //Server settings

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isMail(); // Send using SMTP

        $mail->Host = $config_site_mail['config_smtp_host']; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $config_site_mail['config_smtp_username']; // SMTP username
        $mail->Password = $config_site_mail['config_smtp_password']; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = $config_site_mail['config_smtp_port']; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $admin_mail_id = $config_site_mail['config_site_mail'];

        $mail->setFrom($admin_mail_id, $config_site_mail['config_site_from_name']);
        // $email = "swamiwebservices@gmail.com";

        $mail->addAddress($email, $full_name); // Add a recipient

        $mail->addReplyTo($admin_mail_id, $config_site_mail['config_site_from_name']);

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $mess_body;
        //  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';

        $arr['status'] = 1;
        $arr['successMessage'] = 'Success! We have sent the OTP in yor mail box.Please check your mail';

        } catch (Exception $e) {
        //  $error_msg = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //  $arr['status'] = 0;
        //  $arr['errorMessage'] = 'Ohh! Some thing went wrong please try again';

        }

        }
         */

        } else {
            $errorMessage = 'Invalid email id, Please try other email id';
            $arr['status'] = 0;
            $arr['retData'] = $params;
            //  $arr['errorData'] = '';
            $arr['errorMessage'] = $errorMessage;
        }

        if ($returnType == "JSON") {
            return $this->common->jsonencode($arr);
            die();
        } else {
            return $arr;
            die();
        }

    }

    public function profile_pic($form_filename)
    { 
        
        //image_for 1 = profile main
        $this->load->library('Kishoreimagelib');
        
        //photo1
        $session_user_data = $this->session->userdata('user_data');
        $image_name = "";
       $error_msg = "";
       $status = false;
        if ($_FILES[$form_filename]['name'] != '') {
            $image_old_path_only = 'uploads/profile_pics/';
            //  $image_replace_name = $_FILES["main_image"]['name'];
            $filename = "profile" . $session_user_data['user_id'] . "org" . $this->common->gen_key(4);
            $upload = $this->common->UploadImageCheck($form_filename, $filename);
            if ($upload['uploaded'] == 'false') {
                $error_msg = $upload['uploadMsg'];
                $status = false;
                echo base_url() . "assets/images/no-img.jpg";
                //echo '<img src="'.base_url().'images/no-img.jpg">';
                die();
            } else {
                $sql_data_array['profile_pic'] = $upload['imageFile'];
                $this->kishoreimagelib->load($_FILES[$form_filename]['tmp_name'])->set_background_colour("#fff")->resize(300, 300, true)->save($image_old_path_only . $sql_data_array['profile_pic']);
                $status = true;
                $error_msg = "Image is uploadded successfully....";
                //die();
                $where = "user_id = '" . $session_user_data['user_id'] . "'";
                $this->common->updateRecord('user_master_front', $sql_data_array, $where);
                
            }
            return  base_url() . "uploads/profile_pics/" . $sql_data_array['profile_pic'];
            //  echo '<img src="'.$full_path.'">';
            die();
            $arr = array("uploaded" => $status, "uploadMsg" => $error_msg, "imageFile" => $sql_data_array['profile_pic']);
            echo json_encode($arr);
            die();
        }
    }

}
