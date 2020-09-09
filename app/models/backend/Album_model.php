<?php
class Album_model extends My_Model 
{ 
    public $table = TB_ALBUM;
    public $key = 'id';

    function __construct() 
    {
        $this->table = TB_ALBUM;
        $this->category = TB_CGR_ALBUM;
        $this->primary_key = 'id';
        $this->timestamps = TRUE;
        parent::__construct();
        
    }

    function listAlbum($condition = array(), $limit = array(), $order_by = NULL)
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

    function parse_album_row($data)
    {
        $data->image_path = IMG_PATH_ALBUM.$data->image;     
        return $data;
    }

    function parseAlbumData($data)
    {
        $count = 0;
        foreach($data as $row)
        {
            $count++;
            $row->count = $count;
            $row->image_path = IMG_PATH_ALBUM.$row->image;
            $row->image_thumb = IMG_PATH_ALBUM.'thumb/'.$row->image;
            $row->link_update = admin_url('album/updated/'.$row->id);
            $row->link_delete = admin_url('album/delete/'.$row->id);
            $row->link_active = admin_url('album/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        }
        return $data;
    }
}
