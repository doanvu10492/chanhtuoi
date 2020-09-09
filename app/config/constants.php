<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
define('EXT', '.php');
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

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



// uploads images
define('IMG_PATH_PRODUCT', './uploads/products/');
define('IMG_PATH_POSTS', './uploads/posts/');
define('IMG_PATH_PAGES', './uploads/posts/');
define('IMG_PATH_PRODUCT_DETAIL', './uploads/products/');
define('IMG_PATH_ADS', './uploads/ads/');
define('IMG_PATH_ALBUM', './uploads/album/');
define('IMG_PATH_ALBUM_THUMB', './uploads/album/thumb/');

//table 

define('TB_PRODUCTS', 'dv_products');
define('TB_CGR_PRODUCTS', 'dv_category_products');
define('TB_POSTS', 'dv_posts');
define('TB_CGR_POSTS', 'dv_category_posts');
define('TB_CGR_ALBUM', 'dv_category_album');
define('TB_SLIDE', 'dv_slide');
define('TB_VIDEO', 'dv_video');
define('TB_PAGES', 'dv_posts');
define('TB_ALBUM', 'dv_album');
define('TB_LINKS', 'dv_links');
define('TB_CONFIG', 'dv_settings');
define('TB_MENU', 'dv_menu');
define('TB_TRADEMARK', 'dv_trademark');
define('TB_CONTACT', 'dv_contact');
define('TB_TAGS', 'dv_tags');
define('TB_TAGS_PRODUCT', 'dv_tags_pr');
define('TB_IMG_PRODUCT', 'dv_image_products');
define('TB_ORDERS', 'dv_order');
define('TB_ORDERS_DETAIL', 'dv_order_detail');
define('TB_USERS', 'dv_users');
define('TB_TRANSLATE', 'dv_translate');
define('TB_GROUPS', 'dv_groups');
define('TB_USERS_GROUPS', 'dv_users_groups');
define('TB_SUPPORT_ONLINE', 'dv_support_online');
define('TB_SCRIPT', 'dv_scripts');
define('TB_MEMBER', 'dv_member');
define('TB_SYSTEM_BRANCH', 'dv_system_branch');
define('TB_STUDENT', 'dv_student');
define('TB_DEGREE', 'dv_degree');
define('TB_COURES', 'dv_course');
define('TB_ADDRESS', 'dv_address');
define('TB_CARS', 'dv_cars');
define('TB_OPENING_SCHEDULE', 'dv_opening_schedule');
define('TB_SCHEDULE', 'dv_schedule');
define('TB_MODULE', 'dv_module');
define('TB_EXAM_RESULT', 'dv_exam_result');


//vairable

define('IS_HIGHLIGHT', 1);
define('UN_HIGHLIGHT', 0);
define('UN_STATUS', 0);
define('IS_STATUS', 1);
define('IS_ACTIVE', 1);
define('UN_ACTIVE', 0);