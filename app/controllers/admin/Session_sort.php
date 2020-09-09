<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Session_sort extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		if(!isAdmin())
			redirect_admin('login');
		
		$this->CI = & get_instance();

	} //Controller End

	function sort( $module = "", $field = "")
	{
		
		$module_field = $this->session->userdata($module.'_field');

		if( $module == NULL) {
			$this->session->set_userdata($module.'_field', 'id');
			$this->session->set_userdata($module.'_sort', 'desc');
		} else {

			if($module_field == $field) {
				if($this->session->userdata($module.'_sort') == 'desc') {
				$this->session->set_userdata($module.'_sort', 'asc');
				} else {
					$this->session->set_userdata($module.'_sort', 'desc');
				}
			} else {

				$this->session->set_userdata($module.'_field', $field);
				$this->session->set_userdata($module.'_sort', 'desc');
			}
			
		}
		
	} 
}