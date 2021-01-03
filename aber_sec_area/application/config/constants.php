<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

//define('dev_where', ' delete_status=0');
define('dev_where', " status in ('Active','Inactive') ");
define('currency_code', 'LAK');

//define('back_path', 'http://127.0.0.1/doice/');
//define('back_path', 'http://ice.shreewebs.com/');

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');
defined('DATE_FORMAT_PHP')       OR define('DATE_FORMAT_PHP', 'd-m-Y');
defined('DATE_FORMAT_PHP_SHORT')       OR define('DATE_FORMAT_PHP_SHORT', 'd-mm-Y');


/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('setting', 1);
if(setting==1){
    define('back_path', 'http://127.0.0.1/aber-sa.com/');
    define('FIREBASE_CREDENTIALS_PATH', 'firebase/bo-ice-2f1ce71da14c_local.json');
    define('FIREBASE_DATABASE_PATH', 'https://bo-ice.firebaseio.com');
    
    define('FIREBASE_NOTIFICATION_ADMIN_ORDER_DETAIL_URL', 'https://ice.shreewebs.com/secu_doice/index.php/orders/orderdetail/');
    define('FIREBASE_NOTIFICATION_MP3', 'http://ice.shreewebs.com/firebase/for-sure.mp3');
    define('FIREBASE_NOTIFICATION_ICON', 'http://ice.shreewebs.com/firebase/logoforfirebase.png');
    define('FIREBASE_NOTIFICATION_IMAGE', 'http://ice.shreewebs.com/firebase/logoforfirebase.png');
    define('FIREBASE_NOTIFICATION_URL', 'https://fcm.googleapis.com/fcm/send');
    define('FIREBASE_API_KEY', 'AAAAmsGc2gA:APA91bHN6lQ043APOLrh5RpMXBE84Cmm6lU0t1gCIE4Qwys1WSydPfsZIaoCuuwPEowIJPBCHMpKkVNCHPHhB6DV2i7BCUXXDHowL568DhlwyRcnyLunOqP-e5gFlof7yysIVGHr76SO');
    define('FIREBASE_PUBLIC_KEY', 'BFrn5UCHWPbDkKb3uAZo5PAyO02aMKfpMhKR9WGDq1mm4yKV73E_bEmzaSVuvcW1NTamPmzFa8HMeT5RLMv1CTM');
    
} else {
	
    define('back_path', 'http://aber-sa.com/');
    define('FIREBASE_CREDENTIALS_PATH', 'firebase/bo-ice-2f1ce71da14c.json');
    define('FIREBASE_DATABASE_PATH', 'https://bo-ice.firebaseio.com');
    
    define('FIREBASE_NOTIFICATION_ADMIN_ORDER_DETAIL_URL', 'https://ice.shreewebs.com/secu_doice/index.php/orders/orderdetail/');
    define('FIREBASE_NOTIFICATION_MP3', 'http://ice.shreewebs.com/firebase/for-sure.mp3');
    define('FIREBASE_NOTIFICATION_ICON', 'http://ice.shreewebs.com/firebase/logoforfirebase.png');
    define('FIREBASE_NOTIFICATION_IMAGE', 'http://ice.shreewebs.com/firebase/logoforfirebase.png');
    define('FIREBASE_NOTIFICATION_URL', 'https://fcm.googleapis.com/fcm/send');
    define('FIREBASE_API_KEY', 'AAAArAMsTHc:APA91bGjgPzwM-bvZShuFU3U_UFZoVVOQHVhwRle9ziP89mhsCqbUy7-OjGTl5urSy6FjNPvW_lQOUZpLsO3YCDHZ9ZNhVg8Y5DLLZZz_t-yxUTDfJuQKPGokXrOBGhE-vdmBLnZgrUS');
    define('FIREBASE_PUBLIC_KEY', 'BH8YIMkS9obyt3g0OmInFtgdniay2yD4Ogx8_T93MV-46INHkoK_gZsazhswj2pEqUUE4xZa49haDhk10kAwLrA');
    
    
}
