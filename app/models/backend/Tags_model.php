<?php
 class Tags_model extends My_Model 
 { 
    var $table = TB_TAGS;
    var $key = 'id';

    public function __construct() 
    {
        $this->table = TB_TAGS;
        $this->primary_key = 'id_tags';
        $this->timestamps = TRUE;
        parent::__construct();
    }

    public function list_tags($number = NULL, $offset = NULL, $keywords = NULL, $order_by = NULL)
    {
        if ($number !=NULL) {
              $this->db->limit($number, $offset);
        }

        if ($keywords != NULL) {
              $this->db->like('name', $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by('id_tags desc');
        }
        
        $this->db->select("{$this->table}.*");
        $result = $this->db->get($this->table);

        return $result;
    }

    public function insertProductTags($data = array())
    {
        $this->db->insert(TB_TAGS_PRODUCT, $data);
        return TRUE;
    }


    public function parse_tags_data($data)
    {
        $count = 0;
        foreach($data as $row)
        {
            $count++;
            $row->count = $count;
            $row->link_update = admin_url('tags/updated/'.$row->id_tags);
            $row->link_delete = admin_url('tags/delete/'.$row->id_tags);
            
        }
        return $data;
    }

    public function delete_tags_pr( $condition = array())
    {
        $this->db->where( $condition);
        $this->db->delete(TB_TAGS_PRODUCT);
    }

    public function delete_tags( $condition = array())
    {
        $this->db->where( $condition);
        $this->db->delete(TB_TAGS);
    }


    public function checkProductTagExist($condition = array())
    {
        $this->db->where($condition);
        $this->db->select('*');
        $query = $this->db->get(TB_TAGS_PRODUCT);

        return $query->num_rows() ? true : false;
    }

    public function getListTags($id_product)
    {
        $this->db->where(TB_TAGS_PRODUCT.'.id_product', $id_product);
        $this->db->select(TB_TAGS_PRODUCT.".*, {$this->table}.*");
        $this->db->join(TB_TAGS_PRODUCT, TB_TAGS_PRODUCT.".id_tags = {$this->table}.id_tags", 'left' );
        $result = $this->db->get($this->table)->result_array();
        $tags = '';

        foreach ($result as $row) {
            $tags .= ($tags == '') ? ($row['name_tags']) : (', '.$row['name_tags']);
        }
       
        return $tags;
    }

    public function insert_tags_posts($data = array())
    {
        $this->db->insert(TB_TAGS_PRODUCT, $data);

        return true;
    }

    public function check_tag_posts_exist($condition = array())
    {
        $this->db->where($condition);
        $this->db->select('*');
        $query = $this->db->get(TB_TAGS_PRODUCT);

        return $query->num_rows() ? true : false;
    }

    public function get_list_tags_posts($id)
    {
        $this->db->select(TB_TAGS_PRODUCT . ".*, {$this->table}.*")
                ->where(TB_TAGS_PRODUCT . '.id_posts', $id)
                ->join(TB_TAGS_PRODUCT, TB_TAGS_PRODUCT . ".id_tags = {$this->table}.id_tags", 'left');

        $result = $this->db->get($this->table)->result_array();
        $tags = '';
        
        foreach ($result as $row) {
            $tags .= ($tags == '') ? ($row['name_tags']) : (', ' . $row['name_tags']);
        }

        return $tags;
    }

    public function delete_tags_product( $condition =array ())
    {
        $this->db->where( $condition );
        $this->db->delete( TB_TAGS_PRODUCT);
    }
}