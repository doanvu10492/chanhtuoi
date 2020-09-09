<?php
class User_model extends CI_Model {
	
	//table
	$table = '';

    //key
	$key = '';
	 
	public function __construct() 
	{
		parent::__construct();
		$this->table = TB_USERS;
				
    }//Controller End
	  
	 /**
	 * get user list
	 *
	 * @access	public
	 * @param	nil
	 * @return	object	object with result set
	 */
	public  function get_user($conditions=array(), $limit = array(), $order = array(), $keyword = null)
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
        	$this->db->order_by("{this->table}.created_at desc");
        }
        
        if($keyword != null){
        	$this->db->like("{this->table}.username", $keyword)
        }
	 	$this->db->select("*");
		 
		$result = $this->db->get($this->table);
		return $result;
		
	 }//End 
	 
	 // --------------------------------------------------------------------
	 

	public  function get_user_edit( $condition = array() )
	{
	 	if(!is_array($condition) || count($condition) <=0)
	 	{
	 		return false;
	 	}
	 	$this->db->where($condition);
	 	$this->db->select("*");
	 	return $this->db->get($this->table)->row_array();
	 }
	 
	 
	/**
	 * insert users
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	public function add_user(	$insertData=array() )
	 {
	 	$this->db->insert($this->table,$insertData);
	 }//End of insert user Function
	 
	 // --------------------------------------------------------------------
		
	/**
	 * Update user
	 *
	 * @access	private
	 * @param	array	an associative array of update values
	 * @return	void
	 */
	public function update_user( $updateKey=array(), $updateData=array() )
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

	public function delete_user( $condition=array() )
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

	public function check_exists($condition = array())
	 {
	 	if(!is_array($condition) || count($condition) <= 0){
	 		return false;
	 	}
	 	$this->db->where($condition);
	 	$this->db->select('*');
	 	$result = $this->db->get($this->table)->row_array();
	 	if(count($result) > 0)
	 		return true;
	 	else
	 		return false;

	 }
}//end model