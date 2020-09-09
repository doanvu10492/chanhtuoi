<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sort_field
{
	public function __construct()
	{
		
		$this->CI = & get_instance();
		

	} //Controller End

    /*
    ** Sort in table grid admin
    **
    ** @param string $module
    ** @return array
    */
    public function sort( $module = '') 
    {
    	$field = $this->CI->session->userdata( $module.'_field' );

    	if( $field == NULL) {
    		$field = 'id';
    		$this->CI->session->set_userdata( $module.'_field', $field);
    	}

    	$sort = $this->CI->session->userdata( $module.'_sort');

    	if( $sort == NULL) {
    		$sort = 'desc';
    		$this->CI->session->set_userdata( $module.'_sort');
    	}
    	
    	return array(
    		'field' => $field,
    		'sort' => $sort
    	);
    }
	
} //Class 

