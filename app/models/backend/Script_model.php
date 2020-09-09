<?php
 class Script_model extends My_Model { 

    var $table = TB_SCRIPT;
    var $key = 'id';
    var $category = TB_SCRIPT;
    /**
     * Constructor 
     *
     */
    function __construct() 
    {
    	$this->table = TB_SCRIPT;
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
        
    }//Controller End

    // --------------------------------------------------------------------


    function list_script($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL, $condition = array())
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
            $this->db->order_by('id desc');
        }

        if (is_array($condition) && count($condition) > 0)
        {
            $this->db->where($condition);
        }
       
        $this->db->select("*");
        $result = $this->db->get($this->table);

        return $result;


    }//End of getSiteSettings Function


    function parse_script_data($data)
    {
    	$count = 0;
    	foreach($data as $row)
    	{
    		$count++;
    		$row->count = $count;
    		$row->link_update = admin_url('script/updated/'.$row->id);
    		$row->link_delete = admin_url('script/delete/'.$row->id);
            $row->link_active = admin_url('script/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_top = ($row->isTop==1) ? ("glyphicon-ok") : ("glyphicon-remove");
    	}
    	return $data;
    }



    function get_script_infor($condition = array()){

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