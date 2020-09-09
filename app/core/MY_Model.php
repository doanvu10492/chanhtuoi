<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model 
{
	// Name table
	public $table = '';

	// Key of table
    public $key = '';

    // Order mac dinh (VD: $order = array('id', 'desc))
	public $order = '';
	
	// Cac field select mac dinh khi get_list (VD: $select = 'id, name')
	public $select = '';

	/**
	 * add new row
	 * $data : du lieu ma ta can them
	 */
	public function insertData( $data = array() )
	{
        if($this->db->insert($this->table, $data))
        	return TRUE;
        else
        	return FALSE;
	}

	/**
	 * add new row
	 * result : return id of new row.
	 */

	public function insertDataId( $data = array())
	{
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}
   
    /**
	 * update new row
	 * $data : du lieu ma ta can them
	 */
    public function updateData( $conditions = array(), $data = array(), $id = 0 )
    {
        
    	if (is_array($conditions) && count($conditions) > 0)
    		$this->db->where($conditions);
    	else
    		$this->db->where($this->key, $id);

    	$this->db->update($this->table, $data);
    	return TRUE;
    }


    /**
	 * delete 1 row or many rows
	 * $params : id number or string 
	 */
    public function deleteData($id)
    {
    	if(!$id) return FALSE;

    	if (is_numeric($id)) {
    		$this->db->where($this->key, $id);
    	} else {
    		$this->db->where_in($this->key, $id);
    	}

    	$this->db->delete($this->table);
    	
    	return TRUE;
    }


    /**
	 * get infor a feild of date
	 * @params  
	 */
    public function get_infor($where = array(), $feild = "")
    {
    	if ($feild != NULL)
    		$this->db->select($feild);
    	else
    		$this->db->select($this->select);
  
    	if (is_array($where) && count($where) > 0)
    	{
    		$this->db->where($where);
    	}
    	$query = $this->db->get($this->table);

    	if ($query->num_rows())
    	{
    		return $query->row();
    	}

    	return FALSE;
    }

    /**
	 * check exist
	 */
	public function check_exists($where = array(), $table = "" )
	{
		$this->db->where($where);
		$query = $this->db->get( $table != null ? $table : $this->table );

		return $query->num_rows() > 0 ? true : false;
	}

    /**
    * get infor Table
    */
    public function get_data_list($conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array(),$order = array(),$conditions1=array())
	 {
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		
		//Check For Conditions
	 	if(is_array($conditions1) and count($conditions1)>0)		
	 		$this->db->or_where($conditions1);	
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		
		if(is_array($like1) and count($like1)>0)

			$this->db->or_like($like1);	
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		
		
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
			$this->db->order_by('id', 'desc');
			
		//Check for Order by
		if(is_array($order) and count($order)>0)
			$this->db->order_by($order[0], $order[1]);	
			
		$this->db->from($this->table);
		
		//Check For Fields	 
		if($fields!='')
		 
				$this->db->select($fields);
		
		else 		
	 		$this->db->select($this->select);
			
		$result = $this->db->get();
		
	//pr($result->result());
		return $result;
		
	 }	 

	public function list($condition = array(), $limit = array(), $order_by = NULL)
    {
        if (is_array($limit) && count($limit) > 0) {
            if(count($limit) == 1) {
                $this->db->limit($limit[0]);
            } else {
                $this->db->limit($limit[0], $limit[1]);
            }
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by('id asc');
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
       
        $this->db->select("*");
        $result = $this->db->get($this->table);

        return $result;
    }

    public function getDetailData($condition = array()) 
    {
        if(is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
        $this->db->select("{$this->table}.*");
        $result = $this->db->get("{$this->table}");
        $result = $result->row();
        return $result;
    }
}