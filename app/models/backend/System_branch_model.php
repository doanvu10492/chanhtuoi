<?php
 class System_branch_model extends My_Model { 

    var $table = TB_SYSTEM_BRANCH;
    var $key = 'id_cate';
    var $category = TB_SYSTEM_BRANCH;
/**
 * Constructor 
 *
 */
function __construct() 
{
	$this->table = TB_SYSTEM_BRANCH;
	$this->primary_key = 'id_cate';
	$this->timestamps = TRUE;
	parent::__construct();
    
}//Controller End

// --------------------------------------------------------------------


function list_system_branch($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL, $condition = array())
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
        $this->db->order_by('id_cate desc');
    }

    if (is_array($condition) && count($condition) > 0)
    {
        $this->db->where($condition);
    }
    $this->db->where('type', 'posts');
    
    $this->db->select("{$this->table}.name, {$this->table}.id_parent, {$this->table}.alias, {$this->table}.id_cate as id, {$this->table}.active, {$this->table}.isFooter, {$this->table}.isMenu, {$this->table}.isHighlight, {$this->table}.created_at, {$this->table}.isHome");
    $result = $this->db->get($this->table);

    return $result;


}//End of getSiteSettings Function


function parse_category_data($data)
{
	$count = 0;
	foreach($data as $row)
	{
		$count++;
		$row->count = $count;
		$row->link_update = admin_url('system_branch/updated/'.$row->id);
		$row->link_delete = admin_url('system_branch/delete/'.$row->id);
		$row->link_active = admin_url('system_branch/updateStatus/'.$row->id);
        $row->link_footer = admin_url('system_branch/updateStatus/'.$row->id);
        $row->link_menu = admin_url('system_branch/updateStatus/'.$row->id);
        $row->icon_active = ( $row->active ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_menu = ( $row->isMenu ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_footer = ( $row->isFooter ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_highlight = ( $row->isHighlight ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
        $row->icon_home = ( $row->isHome ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
	}
	return $data;
}


 
  // --------------------------------------------------------------------	
}
// End Settings_model Class
   
/* End of file Settings_model.php */ 
/* Location: ./app/models/Settings_model.php */