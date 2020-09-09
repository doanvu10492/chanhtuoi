<?php
 class Orders_model extends My_Model { 

    var $table = TB_ORDERS;
    var $key = 'id';
    
    /**
     * Constructor 
     *
     */
    public function __construct() 
    {
    	$this->table = TB_ORDERS;
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
        
    }//Controller End

    // --------------------------------------------------------------------


    public function list_orders($number = NULL, $offset = NULL, $keywords = NULL, $id_cate = '', $order_by = NULL, $condition = array())
    {
        if ($number !=NULL)
        {
        	  $this->db->limit($number, $offset);
        }
        if(is_array($condition) && count($condition) > 0){
            $this->db->where($condition);

        } 
        if ($keywords != NULL)
        {
        	  $this->db->like("{$this->table}.order_name", $keywords);
        }
        if ($order_by != NULL)
        {
            $this->db->order_by($order_by);
        }else{
            $this->db->order_by('created_at desc');
        }
        $this->db->select("{$this->table}.*");
        $result = $this->db->get($this->table);

        return $result;
    }

    public function list_orders_detail(){
        $this->db->select('*');
        $this->db->order_by('orderid desc');
        $result = $this->db->get(TB_ORDERS_DETAIL);
        
        return $result;
    }

    public function update_orders_detail( $key = array(), $data = array())
    {
        $this->db->where($key);
        $this->db->update(TB_ORDERS_DETAIL, $data);
    }

    public function parse_orders_data($data)
    {
        $count = 0;
        foreach($data as $row) {
            $count++;
            $row->count = $count;
            
            $row->link_update = admin_url('orders/updated/'.$row->id);
            $row->link_delete = admin_url('orders/delete/'.$row->id);
            $row->link_active = admin_url('orders/updateStatus/'.$row->id);
            $row->link_order = admin_url('orders/output-order/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            
            if ($row->active == 1) {
                $row->text_active = '<span class="label pull-left bg-green">Hoàn thành</span>';
            } else if($row->active == 0) {
                $row->text_active = '<span class="label pull-left bg-blue">Đang chờ</span>';
            } else {
                $row->text_active = '<span class="label pull-left bg-red">Đã hủy</span>';
            }
        }
    
        return $data;
    }

    public function get_orders_detail($condition = array())
    {
        $this->db->where($condition);
        $this->db->select('*');
        $result = $this->db->get(TB_ORDERS_DETAIL)->result_array();
    
        return $result;
    }
}