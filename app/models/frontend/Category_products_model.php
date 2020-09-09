<?php 
class Category_products_model extends My_Model 
{ 
    var $table = TB_CGR_PRODUCTS;
    var $key = 'id_cate';
    var $category = TB_CGR_PRODUCTS;
    /**
     * Constructor 
     *
     */
    public function __construct() 
    {
    	$this->table = TB_CGR_PRODUCTS;
    	$this->primary_key = 'id_cate';
    	$this->timestamps = TRUE;
    	parent::__construct();
        
    }//Controller End

    // --------------------------------------------------------------------


    public function list_category_products($lang, $limit = array(), $condition = array(), $keywords = NULL, $order_by = NULL, $where_in = '' )
    {
        if(is_array($limit))      
        {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
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
        if ($where_in != NULL)
        {
            $where_in = explode(',', $where_in);

            $this->db->where_in("{$this->table}.id_cate", $where_in);
        }
        
        $this->db->select("{$this->table}.name{$lang} as name,
            {$this->table}.alias{$lang} as alias,
            {$this->table}.brief{$lang} as brief,
            
            {$this->table}.meta_title{$lang} as meta_title,
            {$this->table}.meta_keywords{$lang} as meta_keywords,
            {$this->table}.meta_description{$lang} as meta_description,
            {$this->table}.image,
            {$this->table}.id_cate as id,
            {$this->table}.created_at
            ");
        $result = $this->db->get($this->table)->result_array();
        $data = array();
        $count = 0;
        foreach($result as $row)
        {
            $count++;
            $row['count'] = $count;
            $row['link'] = './san-pham/'.$row['alias'].'-c'.$row['id'].'.html';
            
            $data[] = $row;
        }

        return $data;


    }//End of getSiteSettings Function



    public function list_category_products_search( $type = 1)
    {
        $this->db->where( array('type' => $type, 'id_parent' => 0) );
        $this->db->select("{$this->table}.name, {$this->table}.brief, {$this->table}.alias, {$this->table}.id_cate as id, {$this->table}.active, {$this->table}.created_at");
        $result = $this->db->get($this->table)->result_array();

        $count = 0;
        $data = array();

        foreach($result as $row) {
            $this->db->where( array('type' => $type, 'id_parent' => $row['id']) );
            $this->db->select("{$this->table}.name, {$this->table}.brief, {$this->table}.alias, {$this->table}.id_cate as id, {$this->table}.active, {$this->table}.created_at");
            $result_child = $this->db->get($this->table)->result_array();
             $row['link'] = './san-pham/'.$row['alias'].'-c'.$row['id'].'.html';
            $data []= $row;
        }

        return $data;
    }//End of getSiteSettings Function



    public function get_cate_child($id_cate)
    {
        $data = array();
        $this->db->select("{$this->table}.name, {$this->table}.id_cate as id, {$this->table}.active,  {$this->table}.created_at");
        $this->db->where('id_parent',$id_cate);

        //Check For Limit   
        $query = $this->db->get($this->table);

        if($query->num_rows()>0) {
            foreach($query->result_array() as $row) {
                $data[]=$row;
            }
        }
        
        $string_id = $id_cate;
        
        if(!empty($data)) {
            foreach($data as $row_id_cate)  {
                if($string_id=='') {
                    $string_id .= $row_id_cate['id'];  
                } else {
                    $string_id .=','.$row_id_cate['id'];   
                }
            }
        } else {
            $string_id = $id_cate;
        }

        return $string_id;
    }
      // --------------------------------------------------------------------	

    public function get_list_category($lang = '', $condition = array())
    {
        //$this->db->where('id_parent', 0);
        $this->db->order_by('ordering asc');

        if( count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("
            {$this->table}.name{$lang} as name,
                {$this->table}.alias{$lang} as alias,
                {$this->table}.brief{$lang} as brief,
              
                {$this->table}.meta_title{$lang} as meta_title,
                {$this->table}.meta_keywords{$lang} as meta_keywords,
                {$this->table}.meta_description{$lang} as meta_description,
                {$this->table}.image,
                {$this->table}.id_cate as id,
                {$this->table}.created_at
            ");
        
        $result = $this->db->get($this->table)->result_array();
        $data = array();

        if(count($result) > 0) {
            foreach ($result as $row) {
                $data_child = array();
                $this->db->where('id_parent', $row['id']);
                $this->db->order_by('ordering asc');
                $this->db->select("
                    {$this->table}.name{$lang} as name,
                    {$this->table}.alias{$lang} as alias,
                    {$this->table}.brief{$lang} as brief,
                   
                    {$this->table}.meta_title{$lang} as meta_title,
                    {$this->table}.meta_keywords{$lang} as meta_keywords,
                    {$this->table}.meta_description{$lang} as meta_description,
                    {$this->table}.image,
                    {$this->table}.id_cate as id,
                    {$this->table}.created_at
                ");
                $cate_child = $this->db->get($this->table)->result_array();

                if(count($cate_child) > 0) {
                    foreach($cate_child as $item) {
                       
                        $item['link'] = './san-pham/'.$item['alias'].'-c'.$item['id'].'.html';
                         $data_child[] = $item;
                    }
                }

                $row['link'] = './san-pham/'.$row['alias'].'-c'.$row['id'].'.html';
                $row['cate_child'] = $data_child;
                $data[] = $row;
            }
        }

        return $data;
    }

    public function view_category($lang, $condition = array())
    {
        if(is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("
            {$this->table}.name{$lang} as name,
            {$this->table}.alias{$lang} as alias,
            {$this->table}.brief{$lang} as brief,
            {$this->table}.id_parent,
            {$this->table}.meta_title{$lang} as meta_title,
            {$this->table}.meta_keywords{$lang} as meta_keywords,
            {$this->table}.meta_description{$lang} as meta_description,
            {$this->table}.image,
            {$this->table}.id_cate as id,
            {$this->table}.created_at,
            {$this->table}.id_parent,

            ");
        $result = $this->db->get("{$this->table}");
        $result = $result->row_array();
        
        return $result;
    }
}