<?php
class Album_model extends My_Model 
{ 
    public function __construct()
    {
        parent::__construct();
        //ALBUM
        $this->table_album = TB_ALBUM;
        $this->category_album = TB_CGR_ALBUM;
       
    }

    /*
    ** ALBUM
    */
    public function listAlbum($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL)
    {
        if (is_array($limit)) {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }
        if ($keywords != NULL) {
              $this->db->like("{$this->table_album}.name{$lang}", $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by("{$this->table_album}.created_at desc");
        }
      
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->where("{$this->table_album}.active", 1);
        $this->db->join(
            "{$this->category_album}",
            "{$this->category_album}.id_cate = {$this->table_album}.id_cate", 
            "left"
        );
        
        $this->db->select("
            {$this->table_album}.name,
            {$this->table_album}.image,
            {$this->table_album}.id,
            {$this->table_album}.created_at,
            {$this->category_album}.name as name_cate, 
            {$this->category_album}.id_cate, 
            {$this->category_album}.alias as alias_cate, 
            {$this->category_album}.brief as brief_cate
        ");

        $result = $this->db->get($this->table_album)->result_array();
        $count = 0;
        $data = array();
         
        foreach ($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['img'] = IMG_PATH_ALBUM.$row['image'];
            $row['img_thumb'] = IMG_PATH_ALBUM.'thumb/'.$row['image'];
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }

        return $data;
    }


    public function list_category($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL)
    {
        if (is_array($limit)) {
            if (count($limit)==1)
                $this->db->limit($limit[0]);
            else if (count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }
        if ($keywords != NULL) {
              $this->db->like("{$this->category_album}.name", $keywords);
        }
        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by("{$this->category_album}.created_at desc");
        }
      
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
        
        $this->db->where("{$this->category_album}.active", 1);
        
        $this->db->select("
            {$this->category_album}.name,
            {$this->category_album}.image,
            {$this->category_album}.brief,
            {$this->category_album}.created_at,
            {$this->category_album}.id_cate, 
            {$this->category_album}.alias as alias_cate
        ");
        $result = $this->db->get($this->category_album)->result_array();
        $count = 0;
        $data = array();
         

        foreach($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['link'] = './album/'.$row['alias_cate'].'-a-'.$row['id_cate'].'.html';
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }

        return $data;
    }

    public function view_category_album($condition = array())
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("
            {$this->category_album}.name,
            {$this->category_album}.id_cate as id,
            {$this->category_album}.alias as alias,
            {$this->category_album}.image,
            {$this->category_album}.brief,
            {$this->category_album}.id_parent,
            {$this->category_album}.meta_title,
            {$this->category_album}.meta_keywords,
            {$this->category_album}.meta_description
        ");

        $result = $this->db->get("{$this->category_album}");
        $result = $result->row_array();

        if( count($result) > 0 ) {
            $result['link'] = './'.$result['alias'];
        }

        return $result;
    }

} //end class
