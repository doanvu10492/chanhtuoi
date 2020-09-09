<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_session
{
	function __construct()
	{
		
		$this->CI = & get_instance();
		

	} //Controller End
    
    // function assign queryString to back for edit action
    function _session_back_link( $queryString = ''){

        $url_back = '';
        if( isset($_GET['per_page']) && $queryString == null ){
            $url_back ='?per_page='.$_GET['per_page'];
        }elseif(isset($_GET['per_page']) && $queryString != null){
            $url_back = $queryString.'&per_page='.$_GET['per_page'];
        }else{
            $url_back = $queryString;
        }
        $this->CI->session->set_userdata('query_href_back', $url_back);
    	
    }
	
	
} //Class 
