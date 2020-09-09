<?php
 class Support_online_model extends My_Model { 

    var $table = TB_SUPPORT_ONLINE;
    var $key = 'id';
/**
 * Constructor 
 *
 */
function __construct() 
{
	//$this->table = TB_SUPPORT;
	$this->primary_key = 'id';
	$this->timestamps = TRUE;
	parent::__construct();
    
}//Controller End

// --------------------------------------------------------------------


function list_support_online($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL, $condition = array())
{
    if ($number !=NULL)
    {
    	  $this->db->limit($number, $offset);
    }

    if ($keywords != NULL)
    {
    	  $this->where('name', $keywords);
    }
    if ($order_by != NULL)
    {
        $this->db->order_by($order_by);
    }else{
        $this->db->order_by('ordering asc');
    }

    if (is_array($condition) && count($condition) > 0)
    {
        $this->db->where($condition);
    }
    
    $this->db->select("{$this->table}.name, {$this->table}.image, {$this->table}.id, {$this->table}.email, {$this->table}.hotline, {$this->table}.skype, {$this->table}.active, {$this->table}.updated_at, {$this->table}.ordering");
    $result = $this->db->get($this->table);

    return $result;


}//End of getSiteSettings Function

function parse_support_online_data($data)
{
	$count = 0;
	foreach($data as $row)
	{
		$count++;
		$row->count = $count;
		$row->link_update = admin_url('support_online/updated/'.$row->id);
		$row->link_delete = admin_url('support_online/delete/'.$row->id);
       
		$row->link_active = admin_url('support_online/updateStatus/'.$row->id);
        $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        
	}
	return $data;
}
  // --------------------------------------------------------------------	

}
