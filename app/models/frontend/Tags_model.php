<?php class Tags_model extends My_Model { 

    var $table = TB_TAGS;
    var $key = 'id';
    var $posts = TB_POSTS;
    var $products = TB_PRODUCTS;
    var $tag_products = TB_TAGS_PRODUCT;
    var $category = TB_CGR_POSTS;
    var $category_products = TB_CGR_PRODUCTS;

    /**
     * Constructor 
     *
     */
    public function __construct() 
    {
        $this->table = TB_TAGS;
        $this->primary_key = 'id_tags';
        $this->timestamps = TRUE;
        parent::__construct();
        
    }//Controller End


    /*
    ** tags posts
    */
    public function insert_tags_posts($data = array())
    {
        $this->db->insert(TB_TAGS_PRODUCT, $data);
        return TRUE;
    }

    public function check_tag_posts_exist($condition = array()){
        $this->db->where($condition);
        $this->db->select('*');
        $query = $this->db->get(TB_TAGS_PRODUCT);
            if ($query->num_rows() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }

      // --------------------------------------------------------------------   
    }

    public function get_list_tags_posts($id = 0)
    {
        if($id){
             $this->db->where(TB_TAGS_PRODUCT.'.id_posts', $id);
        }else{
            $this->db->where(TB_TAGS_PRODUCT.'.id_posts >', 0);
        }
        $this->db->select(TB_TAGS_PRODUCT.".*, {$this->table}.*");
        $this->db->join(TB_TAGS_PRODUCT, TB_TAGS_PRODUCT.".id_tags = {$this->table}.id_tags", 'left' );
        $result = $this->db->get($this->table)->result_array();
        
        return $result;
    }


    public function get_list_tags_products($id = 0)
    {
        if($id){
             $this->db->where(TB_TAGS_PRODUCT.'.id_product', $id);
        }else{
            $this->db->where(TB_TAGS_PRODUCT.'.id_product >', 0);
        }
        $this->db->select(TB_TAGS_PRODUCT.".*, {$this->table}.*");
        $this->db->join(TB_TAGS_PRODUCT, TB_TAGS_PRODUCT.".id_tags = {$this->table}.id_tags", 'left' );
        $result = $this->db->get($this->table)->result_array();
        
        return $result;
    }


    public function list_posts_tags($id = 0, $limit = array())
    {

         if(is_array($limit))        
        {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }
        if($id > 0){
             $this->db->where(TB_TAGS_PRODUCT.'.id_tags', $id);
        }
       
        $this->db->where(TB_TAGS_PRODUCT.'.id_posts >', 0);
        
        $this->db->select("{$this->tag_products}.*, {$this->posts}.*, {$this->category}.name as name_cate, {$this->category}.id_cate, {$this->category}.alias as alias_cate");
       
        $this->db->join(TB_POSTS, TB_TAGS_PRODUCT.".id_posts = ".TB_POSTS.".id", 'left' );
        $this->db->join("{$this->category}","{$this->category}.id_cate = {$this->posts}.id_cate", "left");
        $result = $this->db->get("{$this->tag_products}")->result_array();
        
        $count = 0;
        $data = array();
         

        foreach($result as $row)
        {
            $count++;
            $row['count'] = $count;
            $row['img'] = IMG_PATH_POSTS.$row['image'];
            $row['img_thumb'] = IMG_PATH_POSTS.'thumb/'.$row['image'];
            $row['link'] = './blog/'.$row['alias'].'-'.$row['id'].'.html';
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }
        return $data;
        
        
    }

    public function list_products_tags($id = 0, $limit = array())
    {

         if(is_array($limit))        
        {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }
        if($id > 0){
             $this->db->where(TB_TAGS_PRODUCT.'.id_tags', $id);
        }
       
        $this->db->where(TB_TAGS_PRODUCT.'.id_product >', 0);
        
        $this->db->select("{$this->tag_products}.*, {$this->products}.*, {$this->category_products}.name as name_cate, {$this->category_products}.id_cate, {$this->category_products}.alias as alias_cate");
       
        $this->db->join(TB_PRODUCTS, TB_TAGS_PRODUCT.".id_product = ".TB_PRODUCTS.".id", 'left' );
        $this->db->join("{$this->category_products}","{$this->category_products}.id_cate = {$this->products}.id_cate", "left");
        $result = $this->db->get("{$this->tag_products}")->result_array();
        
        $count = 0;
        $data = array();
         

        foreach($result as $row)
        {
            $count++;
            $row['count'] = $count;
            $row['img'] = TB_TAGS_PRODUCT.$row['image'];
            $row['img_thumb'] = TB_TAGS_PRODUCT.'thumb/'.$row['image'];
            $row['link'] = './san-pham/'.$row['alias'].'-'.$row['id'].'.html';
            $row['img_thumb2'] = ($row['image_2'] != null) ? (IMG_PATH_PRODUCT.'thumb/'.$row['image_2']) : ('./assets/img/images/logo-product.png');
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }
        return $data;
        
        
    }
}