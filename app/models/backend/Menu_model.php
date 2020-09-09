<?php
 class Menu_model extends My_Model 
 { 
    var $table = TB_MENU;
    var $key = 'id';
    var $category = TB_MENU;

    public function __construct() 
    {
    	$this->table = TB_MENU;
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;

    	parent::__construct();
    }

    public function list_menu($condition = array())
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
       
        $this->db->select("{$this->table}.*")
                ->order_by('ordering asc');

        $result = $this->db->get($this->table)->result();

        return $this->parseData($result);
    }

    public function parseData($data)
    {
    	$count = 0;
    	foreach ($data as $row) {
            $classOk = 'glyphicon-ok';
            $classRemove = 'glyphicon-remove';
    		$count++;

    		$row->count = $count;
    		$row->link_update = admin_url('menu/updated/' . $row->id);
    		$row->link_delete = admin_url('menu/delete/' . $row->id);
            $row->link_active = admin_url('menu/updateStatus/' . $row->id);
            $row->icon_active = $row->active ? $classOk : $classRemove;
            $row->icon_menu = $row->isMenu ? $classOk : $classRemove;
            $row->icon_footer = $row->isFooter ? $classOk : $classRemove;
            $row->icon_top = $row->isTop ? $classOk : $classRemove;
    	}

    	return $data;
    }

    public function getDetailData($condition = array())
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("{$this->table}.*");
        $result = $this->db->get("{$this->table}")->row();
        
        return $result;
    }
}