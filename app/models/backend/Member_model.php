<?php
 
class Member_model extends CI_Model {
	   
      var $table_users_groups = TB_USERS_GROUPS;
      var $table_groups = TB_GROUPS;
      var $table = TB_MEMBER;

	  function __construct() 
	  {
		parent::__construct();
		
				
      }//Controller End
	
	 function users($conditions=array(), $limit = array(), $order = array(), $keyword = null)
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);

		if( is_array($limit) && count($limit) > 0 ){
			if(count($limit) == 1)
				$this->db->limit($limit[0]);
			else
				$this->db->limit($limit[0], $limit[1]);
		}
        if( is_array($order) && count($order) ){
        	$this->db->order_by($order);
        }else{
        	$this->db->order_by("{$this->table}.created desc");
        }
        
        if($keyword != null){
        	$this->db->like("{$this->table}.username", $keyword);
        }
	 	$this->db->select("*");
		 
		$result = $this->db->get($this->table)->result();
        $count = 0;
		foreach($result as $row)
		{
			$count++;
			$row->count = $count;
			$row->link_update = admin_url('member/updated/'.$row->id);
			$row->link_delete = admin_url('member/delete/'.$row->id);
			$row->link_active = admin_url('member/updateStatus/'.$row->id);
	        $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
		}
		return $result;
		
	 }//End 
	 
	 // --------------------------------------------------------------------
	 

	 function get_user_edit( $condition = array() ){
	 	if(!is_array($condition) || count($condition) <=0)
	 	{
	 		return false;
	 	}
	 	$this->db->where($condition);
	 	$this->db->select("*");
	 	return $this->db->get($this->table);
	 }
	 
	 
	/**
	 * insert users
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function add_user(	$insertData=array() )
	 {
	 	$this->db->insert($this->table,$insertData);
	 	return $this->db->insert_id();
	 }//End of insert user Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Update user
	 *
	 * @access	private
	 * @param	array	an associative array of update values
	 * @return	void
	 */
	 function update_user( $updateKey=array(), $updateData=array() )
	 {
	    $this->db->update($this->table ,$updateData, $updateKey);
		 
	 }//End of update user Function 

	 /**
	 * delete user
	 *
	 * @access	private
	 * @param	condition of where
	 * @return	void
	 */

	 function delete_user( $condition=array() )
	 {
	 	if(is_array($condition) && count($condition) > 0)
	 		$this->db->where($condition);
	    $this->db->delete($this->table);
		 
	 }//End of update user Function

	 /**
	 * check  user exists
	 *
	 * @access	private
	 * @param	condition of where
	 * @return	void
	 */

	 function check_exists($condition = array()){
	 	if(!is_array($condition) || count($condition) <= 0){
	 		return false;
	 	}
	 	$this->db->where($condition);
	 	$this->db->select('*');
	 	$result = $this->db->get($this->table)->row_array();
	 	return $result;

	 }

	 //GROUP USER
	function groups($conditions=array(), $limit = array(), $order = array(), $keyword = null){

		if(count($conditions)>0)		
	 		$this->db->where($conditions);

		if( is_array($limit) && count($limit) > 0 ){
			if(count($limit) == 1)
				$this->db->limit($limit[0]);
			else
				$this->db->limit($limit[0], $limit[1]);
		}
        if( is_array($order) && count($order) ){
        	$this->db->order_by($order);
        }
        
        if($keyword != null){
        	$this->db->like("{$this->table_groups}.username", $keyword);
        }
	 	$this->db->select("*");
		 
		$result = $this->db->get($this->table_groups)->result();
		return $result;
	}



	 //USERs groups 
	/* get users groups to check checkbox checked */
	function users_groups($conditions=array()){

		if(count($conditions)>0)		
	 		$this->db->where($conditions);

	 	$this->db->select("group_id");
		 
		$result = $this->db->get($this->table_users_groups)->result_array();
		$data = array();
        foreach ($result as $row) {
        	$data [] = $row['group_id'];
        }
		return $data;
		
	}

	// ADD GROUPS USER

	function insert_users_groups($id, $groups = array() ){
		if(!$id || !is_array($groups) || count($groups) <= 0){
			return false;
		}
		$count = count($groups);
		for($i = 0; $i < $count; $i++){

			$this->db->insert($this->table_users_groups, array('user_id' => $id, 'group_id' => $groups[$i]));
		}
		return true;
	}

	//DELETE USER GROUPS

	function delete_users_groups($id){
		if(!$id){
			return false;
		}
		$this->db->where('user_id', $id);
		$this->db->delete($this->table_users_groups);
		return true;
	}

	
}
// End Auth_model Class
   
/* End of file Auth_model.php */ 
/* Location: ./app/models/Auth_model.php */