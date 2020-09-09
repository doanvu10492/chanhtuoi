<?php
 class Translate_model extends My_Model { 

    var $table = TB_TRANSLATE;
    var $key = 'id';
/**
 * Constructor 
 *
 */
function __construct() 
{
    $this->table = TB_TRANSLATE;
  
    $this->primary_key = 'id';
    $this->timestamps = TRUE;
    parent::__construct();
    
}//Controller End

// --------------------------------------------------------------------


function list_translate($limit = array(), $condition = array(), $keywords = NULL, $order_by = NULL)
{
    if (is_array($limit) && count($limit) > 0)
    {
        if(count($limit) == 1)
        {
            $this->db->limit($limit[0]);
        }
        else{
            $this->db->limit($limit[0], $limit[1]);
        }
    } 
    if ($keywords != NULL)
    {
          $this->db->like("{$this->table}.name", $keywords);
    }
    if(is_array($condition) && count($condition) > 0){
        $this->db->where($condition);

    } 
    if ($order_by != NULL)
    {
        $this->db->order_by($order_by);
    }else{
        $this->db->order_by("{$this->table}.id desc");
    }
   
   
    
 
    $this->db->select("{$this->table}.*");
    $result = $this->db->get($this->table);

    return $result;


}//End of getSiteSettings Function

function parse_translate_row($data)
{
    return $data;
}

function parse_translate_data($data)
{
    $count = 0;
    foreach($data as $row)
    {
        $count++;
        $row->count = $count;
        $row->link_update = admin_url('translate/updated/'.$row->id);
        $row->link_delete = admin_url('translate/delete/'.$row->id);
        
    }
    return $data;
}



function get_translate($lang = null, $condition = array()){

    if(is_array($condition) && count($condition) > 0)
    {
        $this->db->where($condition);
    }
     
    $this->db->select("
        {$this->table}.name{$lang} as name,
       ");

    $result = $this->db->get("{$this->table}");

    $result = $result->row_array();
   
    return count($result) > 0 ? $result['name'] : ('');
}

  // --------------------------------------------------------------------   
}
