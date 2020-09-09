<?php
 class Slide_model extends My_Model { 

	var $table = TB_SLIDE;
    var $key = 'id';
    

function __construct() 
{
	$this->table = TB_SLIDE;
	$this->primary_key = 'id';
	$this->timestamps = TRUE;
	parent::__construct();
}//Controller End

// --------------------------------------------------------------------


function list_slide($number = NULL, $offset = NULL, $keywords = NULL)
{
    if ($number !=NULL)
    {
    	  $this->db->limit($number, $offset);
    }
    if ($keywords != NULL)
    {
    	  $this->where('name', $keywords);
    }
    $this->db->order_by('id desc');
    $result = $this->get_all();
    return $result;
}//End of getSiteSettings Function


 // --------------------------------------------------------------------
/**
* Get Slide information.
*
* @access   private
* @param    array   update information related to site
* @return   void
*/
function get_slide($condition=array())
{
     return $this->get($condition);
}//End of updateSiteSettings Function
 

function parse_slide_data($data)
{
    $count = 0;
    foreach($data as $row)
    {
        $count++;
        $row->count = $count;
       
        $row->link_update = admin_url('slide/updated/'.$row->id);
        $row->link_delete = admin_url('slide/delete/'.$row->id);
        $row->link_active = admin_url('slide/updateStatus/'.$row->id);
        $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");

       
    }
    return $data;
}
  // --------------------------------------------------------------------	
}



// End Settings_model Class
   
/* End of file Settings_model.php */ 
/* Location: ./app/models/Settings_model.php */