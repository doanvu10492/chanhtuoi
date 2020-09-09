<?php
 class Posts_model extends My_Model { 

    var $table = TB_POSTS;
    var $key = 'id';
    var $category = TB_CGR_POSTS;

    function __construct() 
    {
    	$this->table = TB_POSTS;
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
        
    }

    function list_posts($condition = array(), $limit = array(), $order_by = NULL)
    {
        if (is_array($limit) && count($limit) > 0) {
            if(count($limit) == 1) {
                $this->db->limit($limit[0]);
            } else {
                $this->db->limit($limit[0], $limit[1]);
            }
        } 

        if (isset($condition['keyword']) && $condition['keyword']) {
            $this->db->like("{$this->table}.name", $condition['keyword']);
            unset($condition['keyword']);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by('id desc');
        }
        
        if( is_array($condition) && count($condition) > 0) {
            $arrWhere = [];
            foreach ($condition as $key => $value) {
                $arrWhere["{$this->table}.{$key}"] = $value;
            }

            $this->db->where($arrWhere);

            unset($arrWhere);
        }

        $this->db->join(
            "{$this->category}",
            "{$this->category}.id_cate = {$this->table}.id_cate", 
            "left"
        );

        $this->db->select("
            {$this->table}.*, 
            {$this->category}.name as name_cate, 
            {$this->category}.alias as alias_cate, 
            {$this->category}.id_cate
        ");

        $result = $this->db->get($this->table);

        return $result;
    }


    function insert_posts($insertData=array())
    {
        $this->db->insert('posts', $insertData);
    }

    function parse_posts_data($data)
    {
    	$count = 0;
    	foreach($data as $row)
    	{
    		$count++;
    		$row->count = $count;
    		$row->image_path = IMG_PATH_POSTS.$row->image;
            $row->image_thumb = IMG_PATH_POSTS.'thumb/'.$row->image;
    		$row->link_update = admin_url('posts/updated/'.$row->id);
    		$row->link_delete = admin_url('posts/delete/'.$row->id);
    		$row->link_active = admin_url('posts/updateStatus/'.$row->id);
            $row->icon_Highlight = ( $row->isHighlight==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_Big = ( $row->isBig==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_Banner = ( $row->isBanner==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_right = ($row->isRight==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_footer = ($row->isFooter==1) ? ("glyphicon-ok") : ("glyphicon-remove");
    	}
    	return $data;
    }
    	
    function parse_posts_row($data)
    {
    	$data->image_path = IMG_PATH_POSTS.$data->image;   
    	$data->image_thumb = IMG_PATH_POSTS.'thumb/'.$data->image;     
    	return $data;
    }

  // --------------------------------------------------------------------	
}
// End Settings_model Class
   
/* End of file Settings_model.php */ 
/* Location: ./app/models/Settings_model.php */