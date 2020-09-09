<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('resource_url') ) {
	function resource_url( $url = "")
	{
        return base_url('publics/'.$url);
	}
}

if ( ! function_exists('pre')) {
	function pre( $data , $exit = true)
	{
		echo "pre";
		print_r($data);
		
		if ($exit) {
			die();
		}
	}
}

