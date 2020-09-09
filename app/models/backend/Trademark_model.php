<?php
 class Trademark_model extends My_Model { 

    var $table = TB_TRADEMARK;
    var $key = 'id';
    var $category = TB_TRADEMARK;
/**
 * Constructor 
 *
 */
function __construct() 
{
	$this->table = TB_TRADEMARK;
	$this->primary_key = 'id';
	$this->timestamps = TRUE;
	parent::__construct();
    
}//Controller End

// --------------------------------------------------------------------


function list_trademark($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL, $condition = array())
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
   
    $this->db->select("{$this->table}.name, {$this->table}.isTrademark, {$this->table}.isTop,{$this->table}.isFooter, {$this->table}.id, {$this->table}.active, {$this->table}.created_at");
    $result = $this->db->get($this->table);

    return $result;


}//End of getSiteSettings Function


function parse_trademark_data($data)
{
	$count = 0;
	foreach($data as $row)
	{
		$count++;
		$row->count = $count;
		$row->link_update = admin_url('trademark/updated/'.$row->id);
		$row->link_delete = admin_url('trademark/delete/'.$row->id);
        $row->link_active = admin_url('trademark/updateStatus/'.$row->id);
        $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_trademark = ($row->isTrademark==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_footer = ($row->isFooter==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_top = ($row->isTop==1) ? ("glyphicon-ok") : ("glyphicon-remove");
	}
	return $data;
}



function get_trademark_infor($condition = array()){

    if(is_array($condition) && count($condition) > 0)
    {
        $this->db->where($condition);
    }
    $this->db->select("{$this->table}.*");
    $result = $this->db->get("{$this->table}");
    $result = $result->row_array();
    return $result;
}

 
  // --------------------------------------------------------------------	
}
// End Settings_model Class
   
/* End of file Settings_model.php */ 
/* Location: ./app/models/Settings_model.php */