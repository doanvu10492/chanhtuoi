<?php
 class Video_model extends My_Model { 

    var $table = TB_VIDEO;
    var $key = 'id';
    var $category = TB_VIDEO;
/**
 * Constructor 
 *
 */
function __construct() 
{
	$this->table = TB_VIDEO;
	$this->primary_key = 'id';
	$this->timestamps = TRUE;
	parent::__construct();
    
}//Controller End

// --------------------------------------------------------------------


function list_video($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL, $condition = array())
{
    if ($number !=NULL)
    {
    	  $this->db->limit($number, $offset);
    }

    if ($keywords != NULL)
    {
    	  $this->db->like("{$this->table}.name", $keywords);
    }
    if ($order_by != NULL)
    {
        $this->db->order_by($order_by);
    }else{
        $this->db->order_by("{$this->table}.id desc");
    }

    if (is_array($condition) && count($condition) > 0)
    {
        $this->db->where($condition);
    }
    
    $this->db->select("{$this->table}.name, {$this->table}.id, {$this->table}.isHome, {$this->table}.code, {$this->table}.active, {$this->table}.created_at");
    $result = $this->db->get($this->table);

    return $result;


}//End of getSiteSettings Function

function parse_video_data($data)
{
	$count = 0;
	foreach($data as $row)
	{
		$count++;
		$row->count = $count;
		$row->link_update = admin_url('video/updated/'.$row->id);
		$row->link_delete = admin_url('video/delete/'.$row->id);
		 $row->link_active = admin_url('video/updateStatus/'.$row->id);
        $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_is_home = ($row->isHome==1) ? ("glyphicon-ok") : ("glyphicon-remove");
	}
	return $data;
}
  // --------------------------------------------------------------------	
}
