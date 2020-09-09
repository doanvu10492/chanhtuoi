<?php
class Category_album_model extends My_Model 
{ 
    public $table = TB_CGR_ALBUM;
    public $key = 'id_cate';
    public $category = TB_CGR_ALBUM;

    public function __construct() 
    {
    	$this->table = TB_CGR_ALBUM;
    	$this->primary_key = 'id_cate';
    	$this->timestamps = TRUE;
    	parent::__construct();
    }

    public function listCategory($condition = array(), $limit = array(), $order_by = NULL)
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
        
        if ( is_array($condition) && count($condition) > 0) {
            $arrWhere = [];
            foreach ($condition as $key => $value) {
                $arrWhere["{$this->table}.{$key}"] = $value;
            }

            $this->db->where($arrWhere);

            unset($arrWhere);
        }

        $this->db->select("
            {$this->table}.name, 
            {$this->table}.id_parent, 
            {$this->table}.alias, 
            {$this->table}.id_cate as id, 
            {$this->table}.active, 
            {$this->table}.isFooter, 
            {$this->table}.isMenu, 
            {$this->table}.isHighlight, 
            {$this->table}.created_at, 
            {$this->table}.isHome,
        ");

        $result = $this->db->get($this->table);

        return $result;
    }


    public function parseCategoryData($data)
    {
    	$count = 0;
    	
        foreach ($data as $row) {
    		$count++;
    		$row->count = $count;
    		$row->link_update = admin_url('category_album/updated/'.$row->id);
    		$row->link_delete = admin_url('category_album/delete/'.$row->id);
    		$row->link_active = admin_url('category_album/updateStatus/'.$row->id);
            $row->link_footer = admin_url('category_album/updateStatus/'.$row->id);
            $row->link_menu = admin_url('category_album/updateStatus/'.$row->id);
            $row->icon_active = ( $row->active ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_menu = ( $row->isMenu ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_footer = ( $row->isFooter ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_highlight = ( $row->isHighlight ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_home = ( $row->isHome ==1 ) ? ("glyphicon-ok") : ("glyphicon-remove");
    	}

    	return $data;
    }
}
