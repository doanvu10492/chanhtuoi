<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * List menu
 */
if ( ! function_exists('create_menu'))
{
	function create_menu($data = array(), $active = array(), $class = '')
	{
		$result = '';
		if($data){
			$result .= '<ul>';
			foreach($data as $menu) {
				$active = "";

				if(is_numeric($active)) {
					$active  = (  $menu['id'] == $active ) ? ("acitve") : ("");
				} else {
					$active  = (  $menu['alias'] != NULL && $menu['alias'] == $active ) ? ("acitve") : ("");
				}

				$result .= '<li class="'.$class.' '.$active.'">';
				$result .= '<a href="'.$menu['link'].'">';
				$result .= $menu['name'];
				$result .= '</a>';

				if(isset($menu['child']) && $menu['child']) {
					$result .= create_menu($menu['child'], $active, $class);
				}

				$result .= '</li>';
			}
			$result .= '</ul>';
		}

		return $result;
	}
}

/**
 * Translate text
 */
if ( ! function_exists('__translate'))
{
 	function  __translate($code)
    {
        $CI     =& get_instance();
        $lang =  ($CI->session->userdata('site_lang') == "english") ? ('_en') : ('');
        $CI->load->model('backend/translate_model');
        $condition = array(TB_TRANSLATE.'.code'=>$code);
        $translate= $CI->translate_model->get_translate($lang, $condition);

        return $translate ? $translate : $code;
    }
}

/**
 * Breadcrumb
 */
if ( ! function_exists('__breadcrumb'))
{
	function __breadcrumb($category = array(), $secondSegment = array(), $lastSegment = ''){
		$breadcrumb = '';
		$breadcrumb = '<ul class="breadcrumb">';
	    $breadcrumb .= '<li><a href="/" title="Trang chủ">'.__translate('Home').'</a></li>';

	    if($secondSegment) {
	    	$breadcrumb .= '<li><a href="'.$secondSegment['link'].'" title="'.$secondSegment['name'].'">'.$secondSegment['name'].'</a></li>';
	    }
	    if($category) {
	    	foreach($category as $cate) {
	    		$breadcrumb .= '<li><a href="'.$cate['link'].'">'.$cate['name'].'</a></li>';
	    	}
	    }
	    if($lastSegment) {
	    	$breadcrumb .= '<li><a href="#">'.$lastSegment.'</a></li>';
	    }
	   
	    $breadcrumb .= '</ul>';

	    return $breadcrumb;
	}
}