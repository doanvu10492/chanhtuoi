<?php
 
class Member_model extends CI_Model {
	   
      var $table_users_groups = TB_USERS_GROUPS;
      var $table_groups = TB_GROUPS;
      var $table = TB_MEMBER;

	  function __construct() 
	  {
		parent::__construct();
		
				
      }//Controller End
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function loginAsAdmin($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('admins.id');
		$result = $this->db->get('admins');
		if($result->num_rows()>0)
			return true;
		else 
			return false;	
	 }//End of loginAsAdmin Function
	 
 	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function setAdminSession($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
			 
	 	$this->db->select('admins.id,admins.admin_name');
		$result = $this->db->get('admins');
		if($result->num_rows()>0)
		{
			$row = $result->row();
			$values = array ('admin_id'=>$row->id,'logged_in'=>TRUE,'admin_role'=>'admin'); 
			$this->session->set_userdata($values);
		}
		
	 }//End of setAdminSession Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get Users
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function setUserSession($row=NULL)
	 {
	 	switch($row->role_name)
		{
			case 'buyer':
			  
				$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'role'=>'buyer');
				$this->session->set_userdata($values);
				break;
				
			case 'programmer':
			
				$values = array('user_id'=>$row->id,'logged_in'=>TRUE,'role'=>'programmer');
				$this->session->set_userdata($values);
				break;	
		}
	 	
	 }//End of setUserSession Function
	 
	 
	 
	 // Puhal Changes Start Function added for the Remenber me option  (Sep 17 Issue 3)	
	 
	  function setUserCookie($name='',$value ='',$expire = '',$domain='',$path = '/',$prefix ='')
	 {
	 		 $cookie = array(
                   'name'   =>$name,
                   'value'  => $value,
                   'expire' => $expire,
                   'domain' => $domain,
                   'path'   => $path,
                   'prefix' => $prefix,
               );
			  set_cookie($cookie); 
	 }//End of setUserCookie Function	

		
		
	 function getUserCookie($name='')
	 {
		 $val=get_cookie($name,TRUE); 
		return $val;
	 }//End of getUserCookie Function		
	 
 
	  function clearUserCookie($name=array())
	 {
	 	foreach($name as $val)
		{
			delete_cookie($val);
		}	
	 }//End of clearSession Function*/
	 
// Puhal Changes End Function added for the Remenber me option  (Sep 17 Issue 3)		 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	// --------------------------------------------------------------------
		
	/**
	 * clearSession
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function clearAdminSession()
	 {
	 
	 	$array_items = array ('admin_id' => '','logged_in_admin'=>'','admin_role'=>'');
	    $this->session->unset_userdata($array_items);
		
	 }//End of clearSession Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * clearUserSession
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function clearUserSession()
	 {
	 	$array_items = array('user_id' => '','logged_in'=>'','role'=>'');
		$this->session->unset_userdata($array_items);
	 }//End of clearSession Function



	 /**
	 * get user list
	 *
	 * @access	public
	 * @param	nil
	 * @return	object	object with result set
	 */
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
        	$this->db->order_by("{$this->table}.created_at desc");
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
			$row->link_update = admin_url('users/updated/'.$row->id);
			$row->link_delete = admin_url('users/delete/'.$row->id);
			$row->link_active = admin_url('users/updateStatus/'.$row->id);
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

	


	// login

	function login($username = '', $password = '', $remenber = 0){
		if($username == '' || $password ==''){
			return false;
		}
		$this->db->where(array('username' => $username, 'password' => md5($password)));
		$this->db->select("{$this->table}.username, {$this->table}.description,  {$this->table}.picture_url as img, {$this->table}.last_name, {$this->table}.phone, {$this->table}.address, {$this->table}.email, {$this->table}.last_name as name, {$this->table}.id");
		$user = $this->db->get($this->table)->row();

		
		if(count($user) > 0){
			$values = array('member_id' => $user->id, 'member_name' => $user->last_name, 'member_role' => 'member', 'login_member' => TRUE, 'member_phone' => $user->phone, 'member_email' => $user->email, 'member_address' => $user->address, 'username' => $user->username, 'img' => $user->img, 'description' => $user->description);
			$this->session->set_userdata(array('CI_login' => $values));
			/*if ($remenber ==1)
			{
				$this->cookie->setcookie('auth', )
			}*/
			return true;
		}
		return false;
	}

	function login_social($oauth_uid = 0, $oauth_provider = ''){

		if(!$oauth_uid && $oauth_provider == null) return false;

		$this->db->where(array('oauth_uid' => $oauth_uid, 'oauth_provider' => $oauth_provider));
		$this->db->select("{$this->table}.username, {$this->table}.picture_url as img, {$this->table}.full_name, {$this->table}.phone, {$this->table}.address, {$this->table}.email, {$this->table}.last_name as name, {$this->table}.id");
		$user = $this->db->get($this->table)->row();

		
		if(count($user) > 0){
			$values = array('member_id' => $user->id, 'member_name' => $user->full_name, 'member_role' => 'member', 'login_member' => TRUE, 'member_phone' => $user->phone, 'member_email' => $user->email, 'member_address' => $user->address, 'username' => $user->username,  'img' => $user->img);
			$this->session->set_userdata(array('CI_login' => $values));

			
			/*if ($remenber ==1)
			{
				$this->cookie->setcookie('auth', )
			}*/
			return true;
		}
		return false;
	}


	function logout(){
		$values = array ('member_id'=> '','login_member'=> false ,'member_role'=>'');
		$this->session->set_userdata( array('CI_login' => ''));
		return true;
	}
	 
}
// End Auth_model Class
   
/* End of file Auth_model.php */ 
/* Location: ./app/models/Auth_model.php */