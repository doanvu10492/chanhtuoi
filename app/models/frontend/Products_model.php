<?php  defined('BASEPATH') OR exit('No direct script access allowed');
 class Products_model extends My_Model { 

    var $table = TB_PRODUCTS;
    var $key = 'id';
    var $category = TB_CGR_PRODUCTS;
  
    /**
     * Constructor 
     *
     */
    public function __construct() 
    {
    	$this->table = TB_PRODUCTS;
        $this->trademark = TB_TRADEMARK;
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
        
    }//Controller End

    // --------------------------------------------------------------------


    public function list_products($condition = array(), $limit = array(), $order_by = NULL, $where_in = NULL)
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

        if (isset($condition['alias_cate']) && $condition['alias_cate']) {
            $this->db->like("{$this->category}.alias", $condition['alias_cate']);
            unset($condition['alias_cate']);
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
       
        $this->db->where("{$this->table}.active", IS_ACTIVE)
            ->order_by("{$this->table}.updated_at desc")
            ->join(
                "{$this->category}",
                "{$this->category}.id_cate = {$this->table}.id_cate", 
                "left"
            );
         
        $this->db->select("
            {$this->table}.name as name,
            {$this->table}.alias as alias,
            {$this->table}.brief as brief,
            {$this->table}.description as description,
            {$this->table}.meta_title as meta_title,
            {$this->table}.meta_keywords as meta_keywords,
            {$this->table}.meta_description as meta_description,
            {$this->table}.image,
            {$this->table}.price,
            {$this->table}.price_old,
            {$this->table}.active,
            {$this->table}.id,
            {$this->table}.info_detail as info_detail,
            {$this->table}.image_2,
            {$this->table}.code, 
            {$this->table}.price,
            {$this->table}.promotion, 
            {$this->table}.percent_promo, 
            {$this->table}.isNew, 
            {$this->table}.color, 
            {$this->table}.size, 
            {$this->table}.created_at,
            {$this->category}.name as name_cate, 
            {$this->category}.id_cate,  
            {$this->category}.alias as alias_cate
        ");

        $result = $this->db->get($this->table);

        $result = $result->result_array();
        
        $count = 0;
        $data = array();
        foreach($result as $item) {
            $count++;
            $item['count'] = $count;
            $item['price_old'] =  $item['promotion'] ? $item['price'] : (0);
            $item['price'] =  $item['promotion'] ? $item['promotion'] : ($item['price']);
            $item['date'] = $this->format_date($item['created_at']);
            $item['img'] = $this->parse_image_data($item['image']);
            $item['img2'] = $this->parse_image_data($item['image_2']);
            $item['img_thumb'] = $this->parse_image_data($item['image'], true);
            $item['img_thumb2'] = $this->parse_image_data($item['image_2'], true);
            $item['link'] = $this->parse_link_product($item);
            $item['link_cart'] = $this->parse_link_cart($item['id']);
            $data[] = $item;
        }

        return $data;
    }

    public function view_product($condition = array(), $lang = null)
    {
        if(is_array($condition) && count($condition) > 0)
        {
            $this->db->where($condition);
        }
        $this->db->join("{$this->category}","{$this->category}.id_cate = {$this->table}.id_cate", "left");
        $this->db->join("{$this->trademark}","{$this->trademark}.id = {$this->table}.trademark", "left");

            
        $this->db->select("
            {$this->table}.name as name,
            {$this->table}.alias as alias,
            {$this->table}.brief as brief,
            {$this->table}.description as description,
            {$this->table}.meta_title as meta_title,
            {$this->table}.meta_keywords as meta_keywords,
            {$this->table}.meta_description as meta_description,
            {$this->table}.image,
            {$this->table}.active,
            {$this->table}.price,
            {$this->table}.id,
            {$this->table}.image2,
            {$this->table}.created_at,
            {$this->table}.img_slider,
            {$this->table}.info_detail as info_detail,
            {$this->table}.code, 
            {$this->table}.warranty,
            {$this->table}.performance,
            {$this->table}.width,
            {$this->table}.guarantee,
            {$this->table}.download,
            {$this->table}.promotion,
            {$this->table}.color, 
            {$this->table}.size, 
            {$this->trademark}.name as trademark,
            {$this->table}.price_old,
            
            {$this->category}.name as name_cate, {$this->category}.id_cate,  {$this->category}.alias as alias_cate  ");
        
        $query = $this->db->get("{$this->table}");
        $product = $query->row_array();

        if(count($product)) {
            $product['link'] = $this->parse_link_product($product);
            $product['link_cart'] = $this->parse_link_cart($product['id']);
            $product['img_thumb'] = $this->parse_image_data($product['image'], true);
            $product['img'] = $this->parse_image_data($product['image']);
            $product['price_old'] =  $product['promotion'] ? $product['price'] : (0);
            $product['price'] = $product['promotion'] ? $product['promotion'] : ($product['price']);
            $product['date'] = $this->format_date($product);
            $product['products_img_detail'] = $this->get_image_detail($product['id']);
        }

        return $product;
    }

    public function get_image_detail( $id ) 
    {
        $this->db->where('id_product', $id);
        $this->db->select('image, id_image as id, id_product');
        $result = $this->db->get( TB_IMG_PRODUCT )->result_array();
        $data = array();
        $count = 0;

        if( count($result) > 0){
            foreach( $result as $row ){
                $row['count'] = ++$count;
                $row['img'] = IMG_PATH_PRODUCT.$row['image'];
                $data [] = $row;
            }
        }

        return $data;
    }

    public function parse_image_data($img = '', $thumb = false) 
    {
        $link_img = ($thumb) ? (IMG_PATH_PRODUCT.'thumb') : (IMG_PATH_PRODUCT);

        return $link_img.'/'.$img;
    }

    public function parse_link_cart($id = 0) 
    {
        return './product-add-cart/'.$id.'.html';
    }

    public function format_date($date = '') 
    {
        if( ! $date) {
            return ;
        }

        // $date = date('d/m/Y', strtotime($date));

        // return ($date == strtotime(date('d/m/Y'))) ? ('Hôm nay') : ($date);
        return $date;
    }

    public function parse_link_product($product) 
    {
        return base_url().$product['alias_cate'].'/'.$product['alias'].'-'.$product['id'].'.html';
    }

    function getListColor($whereIn)
    {
        if ($whereIn != NULL) {
            $whereIn = explode(',', $whereIn);
            $this->db->where_in("dv_color.name", $whereIn);
        }
        $this->db->select('*');
        $result = $this->db->get('dv_color')->result_array();
        
        return $result;
    }

    
}