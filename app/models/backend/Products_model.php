<?php
class Products_model extends My_Model 
{ 
    /*
    * Table name 
    */
    public $table = TB_PRODUCTS;

    /*
    * Primary key id
    */
    public $key = 'id';

    /*
    * Cate parent table
    */
    public $category = TB_CGR_PRODUCTS;

    /**
     * Constructor 
     *
     */
    public function __construct() 
    {
    	$this->timestamps = TRUE;

    	parent::__construct();    
    }


    public function listProducts($condition = array(), $limit = array(), $order_by = null)
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
            {$this->category}.id_cate
        ");

        $result = $this->db->get($this->table);
       
        return $result;
    }

    public function parseProductsData($data)
    {
        $count = 0;

        foreach($data as $row) {
            $count++;
            $row->count = $count;
            $row->image_path = IMG_PATH_PRODUCT.$row->image;
            $row->image_path2 = IMG_PATH_PRODUCT.$row->image_2;
            $row->image_thumb = IMG_PATH_PRODUCT.'thumb/'.$row->image;
            $row->image_thumb2 = IMG_PATH_PRODUCT.'thumb/'.$row->image_2;
            $row->link_update = admin_url('products/updated/'.$row->id);
            $row->link_delete = admin_url('products/delete/'.$row->id);
            $row->link_vip = admin_url('products/updateStatus/'.$row->id);
            $row->link_active = admin_url('products/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_new = ($row->isNew==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_left = ($row->isLeft==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_sale = ($row->isSale==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->icon_highlight = ($row->isHighlight==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        }

        return $data;
    }
        
    public function parseProductRow($data)
    {
        $data->image_path = IMG_PATH_PRODUCT.$data->image; 
        $data->image_path2 = IMG_PATH_PRODUCT.$data->image_2; 

        return $data;
    }

    public function insertProductImages($data = array())
    {
        $this->db->insert(TB_IMG_PRODUCT, $data);

        return true;
    }

    public function getImgDetail($condition = array())
    {
        $this->db->where($condition);
        $this->db->select('image, id_image');
        $result = $this->db->get(TB_IMG_PRODUCT)->result_array();
        $data = array();

        foreach($result as $row) {
            $row['image'] = IMG_PATH_PRODUCT_DETAIL.$row['image'];
            $data[] = $row;
        }

        return $data;
    }

    public function deleleImgDetail($condition = array())
    {
        $this->db->where($condition);
        $this->db->delete(TB_IMG_PRODUCT);
    }

    public function getListColor()
    {
        $this->db->select('*');
        $result = $this->db->get('dv_color')->result();
        
        return $result;
    }
}
