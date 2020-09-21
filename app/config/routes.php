<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include('config.php');

$route['account/login|admin/users/login|admin/login'] = 'admin/users/login';
$route['admin/logout|admin/users/logout'] = 'admin/users/logout';
$route['admin/groups'] = 'admin/groups/index';
$route['admin']  = 'admin/dashboard';

$route['default_controller'] = "frontend/home";
$route['lang/en']				 			= "frontend/home/setlang/$1";
$route['lang/vi']				 			= "frontend/home/setlang/$1";
$route['lang/vi']				 			= "frontend/home/setlang/$1";

$route['tim-kiem|tim-kiem/(:num)'] = "frontend/products/index/$1";
$route['dang-ky'] = 'frontend/users/register';
$route['dang-nhap|login|login-google|login-facebook'] = 'frontend/users/login';
$route['dang-xuat|logout'] = 'frontend/users/logout';
$route['doi-mat-khau|xem-thong-tin'] = 'frontend/users/update_infor';
$route['forget-pass'] = 'frontend/users/update_infor';


//contact

$route['getStoreBranch'] = "frontend/contact/getStoreBranch";
$route['lien-he'] = "frontend/contact/index";
$route['cua-hang'] = "frontend/contact/store";
$route['receive_messages'] = "frontend/contact/add_email";
$route['gui-so-dien-thoai'] = "frontend/contact/send_phone";
$route['register-learn'] = "frontend/contact/registerLearn";
$route['dang-ky-hoc'] = "frontend/student/registerLearn";
$route['tra-cuu-ket-qua'] = "frontend/student/searchStudent";
$route['tra-cuu-dang-ky'] = "frontend/student/searchStudentRegister";
$route['xem-lich-khai-giang'] = "frontend/student/viewOpeningSchedule";

$route['checkCustomerOrder'] = "frontend/cart/checkCustomerOrder";
$route['thanh-toan-don-hang'] = "frontend/cart/cart_payment";
$route['xuat-file'] = "frontend/cart/export_exel";
$route['kiem-tra-don-hang'] = "frontend/cart/checkCustomerOrder";

$route['product-add-cart/(:num)'] = "frontend/products/add_to_cart/$1";

// maintance of website
$route['offline'] = 'frontend/offline';
//video

$route['video'] = "frontend/video/index";
$route['video/(:num)'] = "frontend/video/index/$1";
$route['video/(:any)'] = "frontend/video/view/$1";

//tags
$route['tags/(:any)/(:num)|tags/(:any)'] = "frontend/products/list_tags";
$route['tim-kiem|tim-kiem/(:num)'] = "frontend/products/index";
//receive email promotion
$route['add_email'] = "frontend/contact/add_email";
$route['gio-hang|payment-now'] = "frontend/cart/add";
$route['cart/remove/(:any)'] = "frontend/cart/remove/$1";
$route['cart/remove-ajax/(:any)'] = "frontend/cart/remove/$1";
$route['cart/update_cart'] = "frontend/cart/update_cart";
$route['xem-gio-hang'] = "frontend/cart/index";
$route['cart_bill|thong-bao-dat-hang'] = "frontend/cart/cart_payment";
$route['product-add-cart/(:num)'] = "frontend/products/add_to_cart/$1";

$route['404_override'] = '';
$route['xac-nhan-ma-khuyen-mai'] = "frontend/products/comfirm_code";

/*
**Products admin
*/
$route['admin/products/table_price'] = 'admin/products/table_price';
$route['admin/products'] = 'admin/products';
$route['admin/products/list_products'] = 'admin/products/index';
$route['admin/products/updateStatus/(:num)'] = 'admin/products/updateStatus/$1';
$route['admin/products/updated/(:num)'] = 'admin/products/updated/$1';
$route['admin/products/delListChoose'] = 'admin/products/delListChoose';
$route['admin/products/delete/(:num)'] = 'admin/products/delete/$1';
$route['admin/products/delele_img_detail/(:num)'] = 'admin/products/delele_img_detail/$1';


$route['admin/coupon/table_price'] = 'admin/products/table_price';
$route['admin/coupon'] = 'admin/products';
$route['admin/coupon/list_products'] = 'admin/products/index';
$route['admin/coupon/updateStatus/(:num)'] = 'admin/products/updateStatus/$1';
$route['admin/coupon/updated/(:num)'] = 'admin/products/updated/$1';
$route['admin/coupon/delListChoose'] = 'admin/products/delListChoose';
$route['admin/coupon/delete/(:num)'] = 'admin/products/delete/$1';
$route['admin/coupon/delele_img_detail/(:num)'] = 'admin/products/delele_img_detail/$1';

$route['admin/category_coupon'] = 'admin/category_products';
$route['admin/category_coupon/delete/(:num)'] = 'admin/category_products/delete/$1';
$route['admin/category_coupon'] = 'admin/category_products';
$route['admin/category_coupon/updated/(:num)'] = 'admin/category_products/updated/$1';
$route['admin/category_coupon/updateStatus/(:num)'] = 'admin/category_products/updateStatus/$1';
$route['admin/category_coupon/delete/(:num)'] = 'admin/category_products/delete/$1';
$route['admin/category_coupon/delListChoose'] = 'admin/category_products/delListChoose';


$route['admin/coupon_source'] = 'admin/category_products';
$route['admin/coupon_source/delete/(:num)'] = 'admin/category_products/delete/$1';
$route['admin/coupon_source'] = 'admin/category_products';
$route['admin/coupon_source/updated/(:num)'] = 'admin/category_products/updated/$1';
$route['admin/coupon_source/updateStatus/(:num)'] = 'admin/category_products/updateStatus/$1';
$route['admin/coupon_source/delete/(:num)'] = 'admin/category_products/delete/$1';
$route['admin/coupon_source/delListChoose'] = 'admin/category_products/delListChoose';


$route['admin/category_products'] = 'admin/category_products';
$route['admin/category_products/delete/(:num)'] = 'admin/category_products/delete/$1';
$route['admin/category_products'] = 'admin/category_products';
$route['admin/category_products/updated/(:num)'] = 'admin/category_products/updated/$1';
$route['admin/category_products/updateStatus/(:num)'] = 'admin/category_products/updateStatus/$1';
$route['admin/category_products/delete/(:num)'] = 'admin/category_products/delete/$1';
$route['admin/category_products/delListChoose'] = 'admin/category_products/delListChoose';
/*
** Admin
*/

//setting
$route['admin/siteSettings'] = 'admin/siteSettings';

$route['admin/siteSettings/changeLogo'] = 'admin/siteSettings/changeLogo';

$route['admin/session_sort/sort/(:any)/(:any)'] = 'admin/session_sort/sort/$1/$2';

//pages
//posts

$route['admin/pages/updateStatus/(:num)'] = 'admin/pages/updateStatus/$1';
$route['admin/pages/updated/(:num)'] = 'admin/pages/updated/$1';
$route['admin/pages/delete/(:num)'] = 'admin/pages/delete/$1';
$route['admin/pages/delListChoose'] = 'admin/pages/delListChoose';
$route['admin/pages|admin/posts/index'] = 'admin/pages';
//links
$route['admin/links'] = 'admin/links';

//posts

$route['admin/posts/updateStatus/(:num)'] = 'admin/posts/updateStatus/$1';
$route['admin/posts/updated/(:num)'] = 'admin/posts/updated/$1';
$route['admin/posts/delete/(:num)'] = 'admin/posts/delete/$1';
$route['admin/posts/delListChoose'] = 'admin/posts/delListChoose';
$route['admin/posts|admin/posts/index'] = 'admin/posts';
//place
$route['admin/place'] = 'admin/place';

//album

$route['admin/album/updateStatus/(:num)'] = 'admin/album/updateStatus/$1';
$route['admin/album/updated/(:num)'] = 'admin/album/updated/$1';
$route['admin/album/delete/(:num)'] = 'admin/album/delete/$1';
$route['admin/album/delListChoose'] = 'admin/album/delListChoose';
$route['admin/album|admin/posts/index'] = 'admin/album';

$route['admin/degree/updateStatus/(:num)'] = 'admin/degree/updateStatus/$1';
$route['admin/degree/save'] = 'admin/degree/save';
$route['admin/degree/updated/(:num)'] = 'admin/degree/updated/$1';
$route['admin/degree/delete/(:num)'] = 'admin/degree/delete/$1';
$route['admin/degree/delListChoose'] = 'admin/degree/delListChoose';
$route['admin/degree|admin/posts/index'] = 'admin/degree';

$route['admin/address/updateStatus/(:num)'] = 'admin/address/updateStatus/$1';
$route['admin/address/save'] = 'admin/address/save';
$route['admin/address/updated/(:num)'] = 'admin/address/updated/$1';
$route['admin/address/delete/(:num)'] = 'admin/address/delete/$1';
$route['admin/address/delListChoose'] = 'admin/address/delListChoose';
$route['admin/address|admin/posts/index'] = 'admin/address';

$route['admin/course/updateStatus/(:num)'] = 'admin/course/updateStatus/$1';
$route['admin/course/save'] = 'admin/course/save';
$route['admin/course/updated/(:num)'] = 'admin/course/updated/$1';
$route['admin/course/delete/(:num)'] = 'admin/course/delete/$1';
$route['admin/course/delListChoose'] = 'admin/course/delListChoose';
$route['admin/course|admin/posts/index'] = 'admin/course';

$route['admin/schedule/updateStatus/(:num)'] = 'admin/schedule/updateStatus/$1';
$route['admin/schedule/save'] = 'admin/schedule/save';
$route['admin/schedule/updated/(:num)'] = 'admin/schedule/updated/$1';
$route['admin/schedule/delete/(:num)'] = 'admin/schedule/delete/$1';
$route['admin/schedule/delListChoose'] = 'admin/schedule/delListChoose';
$route['admin/schedule|admin/posts/index'] = 'admin/schedule';

$route['admin/car/updateStatus/(:num)'] = 'admin/car/updateStatus/$1';
$route['admin/car/save'] = 'admin/car/save';
$route['admin/car/updated/(:num)'] = 'admin/car/updated/$1';
$route['admin/car/delete/(:num)'] = 'admin/car/delete/$1';
$route['admin/car/delListChoose'] = 'admin/car/delListChoose';
$route['admin/car|admin/posts/index'] = 'admin/car';

//album
$route['admin/widget'] = 'admin/widget';

//users
$route['admin/users'] = 'admin/users';
$route['admin/users/updated/(:num)'] = 'admin/users/updated/$1';
$route['admin/users/updateStatus/(:num)|admin/users/updateStatus/(:any)'] = 'admin/users/updateStatus/$1';

$route['admin/users/delete/(:num)'] = 'admin/users/delete/$1';





//support_online

$route['admin/support_online/updated/(:num)'] = 'admin/support_online/updated/$1';
$route['admin/support_online/delete/(:num)'] = 'admin/support_online/delete/$1';
$route['admin/support_online/updateStatus/(:num)'] = 'admin/support_online/updateStatus/$1';
$route['admin/support_online/delListChoose'] = 'admin/support_online/delListChoose';
$route['admin/support_online|admin/support_online/index'] = 'admin/support_online';

// links
$route['admin/links/updated/(:num)'] = 'admin/links/updated/$1';
$route['admin/links/updateStatus/(:num)'] = 'admin/links/updateStatus/$1';
$route['admin/links/delete/(:num)'] = 'admin/links/delete/$1';
$route['admin/links/delListChoose'] = 'admin/links/delListChoose';
$route['admin/links|admin/links/index'] = 'admin/links';

// tags
$route['admin/tags/updated/(:num)'] = 'admin/tags/updated/$1';
$route['admin/tags/updateStatus/(:num)'] = 'admin/tags/updateStatus/$1';
$route['admin/tags/delete/(:num)'] = 'admin/tags/delete/$1';
$route['admin/tags/delListChoose'] = 'admin/tags/delListChoose';
$route['admin/tags|admin/tags/index'] = 'admin/tags';

$route['admin/member'] = 'admin/member';
$route['admin/member/updated/(:num)'] = 'admin/member/updated/$1';
$route['admin/member/delete/(:num)'] = 'admin/member/delete/$1';

// contact
$route['admin/contact/updated/(:num)'] = 'admin/contact/updated/$1';
$route['admin/contact/updateStatus/(:num)'] = 'admin/contact/updateStatus/$1';
$route['admin/contact/delete/(:num)'] = 'admin/contact/delete/$1';
$route['admin/contact/delListChoose'] = 'admin/contact/delListChoose';
$route['admin/contact|admin/contact/index'] = 'admin/contact';




// video
$route['admin/video/updated/(:num)'] = 'admin/video/updated/$1';
$route['admin/video/updateStatus/(:num)'] = 'admin/video/updateStatus/$1';
$route['admin/video/delete/(:num)'] = 'admin/video/delete/$1';
$route['admin/video/delListChoose'] = 'admin/video/delListChoose';
$route['admin/video|admin/video/index'] = 'admin/video';

// slide
$route['admin/slide/updated/(:num)'] = 'admin/slide/updated/$1';
$route['admin/slide/updateStatus/(:num)'] = 'admin/slide/updateStatus/$1';
$route['admin/slide/delete/(:num)'] = 'admin/slide/delete/$1';
$route['admin/slide/delListChoose'] = 'admin/slide/delListChoose';
$route['admin/slide|admin/slide/index'] = 'admin/slide';


$route['admin/orders/updated/(:num)'] = 'admin/orders/updated/$1';
$route['admin/orders/updateStatus/(:num)'] = 'admin/orders/updateStatus/$1';
$route['admin/orders/delete/(:num)'] = 'admin/orders/delete/$1';
$route['admin/orders/delListChoose'] = 'admin/orders/delListChoose';
$route['admin/orders|admin/slide/index'] = 'admin/orders';
$route['admin/orders/output-order/(:num)'] = 'admin/orders/file_order/$1';

// slide
$route['admin/menu/updated/(:num)'] = 'admin/menu/updated/$1';
$route['admin/menu/save'] = 'admin/menu/save';
$route['admin/menu/updateStatus/(:num)'] = 'admin/menu/updateStatus/$1';
$route['admin/menu/delete/(:num)'] = 'admin/menu/delete/$1';
$route['admin/menu/delListChoose'] = 'admin/menu/delListChoose';
$route['admin/menu|admin/slide/index'] = 'admin/menu';

$route['admin/student/updated/(:num)'] = 'admin/student/updated/$1';
$route['admin/student/save'] = 'admin/student/save';
$route['admin/student/updateStatus/(:num)'] = 'admin/student/updateStatus/$1';
$route['admin/student/delete/(:num)'] = 'admin/student/delete/$1';
$route['admin/student/del_list_choose'] = 'admin/student/delListChoose';
$route['admin/student/exportCSV'] = 'admin/student/exportCSV';
$route['admin/student/checkIsPaid/(:num)'] = 'admin/student/checkIsPaid/(:num)';
$route['admin/student/checkResult/(:num)'] = 'admin/student/checkResult/(:num)';
$route['admin/student|admin/slide/index'] = 'admin/student';

$route['admin/opening_schedule/updated/(:num)'] = 'admin/opening_schedule/updated/$1';
$route['admin/opening_schedule/save'] = 'admin/opening_schedule/save';
$route['admin/opening_schedule/updateStatus/(:num)'] = 'admin/opening_schedule/updateStatus/$1';
$route['admin/opening_schedule/delete/(:num)'] = 'admin/opening_schedule/delete/$1';
$route['admin/opening_schedule/delListChoose'] = 'admin/opening_schedule/delListChoose';
$route['admin/opening_schedule|admin/opening_schedule/index'] = 'admin/opening_schedule';


$route['admin/trademark/updated/(:num)'] = 'admin/trademark/updated/$1';
$route['admin/trademark/updateStatus/(:num)'] = 'admin/trademark/updateStatus/$1';
$route['admin/trademark/delete/(:num)'] = 'admin/trademark/delete/$1';
$route['admin/trademark/delListChoose'] = 'admin/trademark/delListChoose';
$route['admin/trademark|admin/slide/index'] = 'admin/trademark';


$route['admin/script/updated/(:num)'] = 'admin/script/updated/$1';
$route['admin/script/updateStatus/(:num)'] = 'admin/script/updateStatus/$1';
$route['admin/script/delete/(:num)'] = 'admin/script/delete/$1';
$route['admin/script/delListChoose'] = 'admin/script/delListChoose';
$route['admin/script|admin/slide/index'] = 'admin/script';


$route['admin/translate/updated/(:num)'] = 'admin/translate/updated/$1';
$route['admin/translate/updateStatus/(:num)'] = 'admin/translate/updateStatus/$1';
$route['admin/translate/delete/(:num)'] = 'admin/translate/delete/$1';
$route['admin/translate/delListChoose'] = 'admin/translate/delListChoose';
$route['admin/translate|admin/slide/index'] = 'admin/translate';


$route['admin/translate'] = 'admin/translate';


$route['admin/siteSettings/dbBackup'] = 'admin/siteSettings/dbBackup';
$route['admin/slide'] = 'admin/slide';

$route['admin/menu'] = 'admin/menu';


$route['admin/category_posts'] = 'admin/category_posts';
$route['admin/category_posts/updated/(:num)'] = 'admin/category_posts/updated/$1';
$route['admin/category_posts/updateStatus/(:num)'] = 'admin/category_posts/updateStatus/$1';
$route['admin/category_posts/delete/(:num)'] = 'admin/category_posts/delete/$1';
$route['admin/posts/delListChoose'] = 'admin/posts/delListChoose';
$route['admin/category_posts/delListChoose'] = 'admin/category_posts/delListChoose';

$route['admin/system_branch'] = 'admin/system_branch';
$route['admin/system_branch/updated/(:num)'] = 'admin/system_branch/updated/$1';
$route['admin/system_branch/updateStatus/(:num)'] = 'admin/system_branch/updateStatus/$1';
$route['admin/system_branch/delete/(:num)'] = 'admin/system_branch/delete/$1';
$route['admin/posts/delListChoose'] = 'admin/posts/delListChoose';
$route['admin/system_branch/delListChoose'] = 'admin/system_branch/delListChoose';

$route['admin/category_album'] = 'admin/category_album';
$route['admin/category_album/updated/(:num)'] = 'admin/category_album/updated/$1';
$route['admin/category_album/updateStatus/(:num)'] = 'admin/category_album/updateStatus/$1';
$route['admin/category_album/delete/(:num)'] = 'admin/category_album/delete/$1';
$route['admin/category_album/delListChoose'] = 'admin/category_album/delListChoose';

//end
$route['album/(:any)-a-(:num)|album/(:any)-a-(:num)/(:num)'] = "frontend/album/index/$1";
$route['album/(:any)|album/(:any)/(:num)'] = "frontend/album/category/$1";

$route['thu-vien-anh|(thu-vien-anh|photo)/(:num)'] = "frontend/album/index/$1";



$route['collection-2018'] = "frontend/products/list_category/$1";
$route['(:any)-d(:num)'] = "frontend/products/view/$1";
$route['tim-kiem|tim-kiem/(:num)'] = "frontend/products/index";
$route['san-pham/(:any)|products/(:any)'] = "frontend/products/category/$1";
$route['san-pham/(:any)-c(:num)'] = "frontend/products/category/$1";
$route['san-pham|san-pham/(:num)'] = "frontend/products/index/$1";

$route['gioi-thieu/(:any)'] = "frontend/posts/view/$1";
$route['(:any)-p(:num)'] = "frontend/posts/view/$1";
$route['(:any)-(:num)|(:any)/(:any)-(:num)'] = "frontend/posts/view/$1";
$route['blog/(:any)'] = "frontend/posts/category/$1";
$route['(:any)'] = "frontend/products/category/$1";