<?php
 class Contact_model extends My_Model { 

    var $table = TB_CONTACT;
    var $key = 'id';
/**
 * Constructor 
 *
 */
function __construct() 
{
	$this->table = TB_CONTACT;
	$this->primary_key = 'id';
	$this->timestamps = TRUE;
	parent::__construct();
    
}//Controller End

// --------------------------------------------------------------------


function list_contact($limit = array(), $keywords = NULL, $order_by = NULL)
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

    if ($order_by != NULL)
    {
        $this->db->order_by($order_by);
    }else{
        $this->db->order_by("{$this->table}.id desc");
    }

    // $this->db->where("{$this->table}.type");
    
    
    $this->db->select("{$this->table}.*");
    $result = $this->db->get($this->table);

    return $result;


}//End of getSiteSettings Function


function insert_contact($insertData=array())
{
    $this->db->insert('contact', $insertData);
}

function parse_contact_data($data)
{
	$count = 0;
	foreach($data as $row)
	{
		$count++;
		$row->count = $count;
		$row->date = date('d-m-Y H:i', strtotime($row->created_at));
		$row->link_update = admin_url('contact/updated/'.$row->id);
		$row->link_delete = admin_url('contact/delete/'.$row->id);
		$row->link_active = admin_url('contact/updateStatus/'.$row->id);
        $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
       
	}
	return $data;
}


  // --------------------------------------------------------------------	
}
// End Contact_model Class
   
/* End of file Contact_model.php */ 
/* Location: ./app/models/Contact_model.php */