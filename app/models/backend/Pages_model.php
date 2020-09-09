<?php
 class Pages_model extends My_Model { 

    var $table = TB_PAGES;
    var $key = 'id';
    /**
     * Constructor 
     *
     */
    function __construct() 
    {
    	$this->table = TB_PAGES;
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
        
    }//Controller End

    // --------------------------------------------------------------------


    function list_pages($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL, $condition = array())
    {
        if ($number !=NULL)
        {
        	  $this->db->limit($number, $offset);
        }

        if ($keywords != NULL)
        {
        	  $this->db->like('name', $keywords);
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
         $this->db->where('type', 'page');
        $this->db->select("{$this->table}.*");
        $result = $this->db->get($this->table);

        return $result;


    }//End of getSiteSettings Function

    function parse_pages_data($data)
    {
    	$count = 0;
    	foreach($data as $row)
    	{
    		$count++;
    		$row->count = $count;
    		$row->image = IMG_PATH_PAGES.$row->image;
    		$row->link_update = admin_url('pages/updated/'.$row->id);
    		$row->link_delete = admin_url('pages/delete/'.$row->id);
    		$row->link_active = admin_url('pages/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_Highlight = ( $row->isHighlight==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_right = ($row->isRight==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_footer = ($row->isFooter==1) ? ("glyphicon-ok") : ("glyphicon-remove");
    	}
    	return $data;
    }
    	
    function parse_pages_row($data)
    {
    	$data->image_path = IMG_PATH_PAGES.$data->image;     
    	return $data;
    }

  // --------------------------------------------------------------------	
}
// End Settings_model Class
   
/* End of file Settings_model.php */ 
/* Location: ./app/models/Settings_model.php */