<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); //No Direct Access

/*
|--------------------------------------------------------------------------
| Variables needed for pagination -- affects the whole site
|--------------------------------------------------------------------------
|
*/
$config['per_page'] 		= 10;
$config['uri_segment'] 		= 3;
$config['num_links'] 		= 5;
$config['full_tag_open'] 	= '<ul class="pagination pagination-sm no-margin">';
$config['full_tag_close'] 	= '</ul>';
$config['cur_tag_open'] 	= '<li><a class="page active">';
$config['cur_tag_close'] 	= '</a></li>';
$config['num_tag_open']		= '<li>';
$config['num_tag_close'] 	= '</li>';
$config['first_tag_open'] 	= '';
$config['first_tag_close'] 	= '';
$config['first_link'] 	  	= 'Trang đầu';
$config['prev_link']	 	= '&lt;';
$config['last_tag_open'] 	= '';
$config['last_tag_close'] 	= '';
$config['last_link'] 		= 'Trang cuối';
$config['next_link'] 		= '&gt;';
$config['next_tag_open'] 	= '<li>';
$config['next_tag_close'] 	= '</li>';
$config['prev_tag_open'] 	= '<li>';
$config['prev_tag_close'] 	= '</li>';