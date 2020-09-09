<?php
 
class Auth_model extends CI_Model {
       
      var $table_users_groups = TB_USERS_GROUPS;
      var $table_groups = TB_GROUPS;
      var $table = TB_USERS;

      function __construct() 
      {
        parent::__construct();
        
                
      }//Controller End
     
    // --------------------------------------------------------------------
        
    /**
     * Get Users
     *
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
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
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
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
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
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
     
        
    /**
     * clearSession
     *
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
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
     * @access  private
     * @param   array   conditions to fetch data
     * @return  object  object with result set
     */
     function clearUserSession()
     {
        $array_items = array('user_id' => '','logged_in'=>'','role'=>'');
        $this->session->unset_userdata($array_items);
     }//End of clearSession Function



     /**
     * get user list
     *
     * @access  public
     * @param   nil
     * @return  object  object with result set
     */
     function users($condition = array(), $limit = array(),  $order = array())
     {
        if ( is_array($limit) && count($limit) > 0 ) {
            if(count($limit) == 1)
                $this->db->limit($limit[0]);
            else
                $this->db->limit($limit[0], $limit[1]);
        }
        if ( is_array($order) && count($order) ) {
            $this->db->order_by($order);
        } else {
            $this->db->order_by("{$this->table}.id desc");
        }

        if (isset($condition['group_id']) && $condition['group_id']) {
            $this->db->like(TB_USERS_GROUPS . ".group_id", $condition['group_id']);
            
            unset($condition['group_id']);
        }

        if( is_array($condition) && count($condition) > 0) {
            $arrWhere = [];
            foreach ($condition as $key => $value) {
                $arrWhere["{$this->table}.{$key}"] = $value;
            }

            $this->db->where($arrWhere);

            unset($arrWhere);
        }

        $this->db->select("
                {$this->table}.*, 
                {$this->table_groups}.description as group_name
            ")
            ->join(
                TB_USERS_GROUPS, 
                "{$this->table}.id = " . TB_USERS_GROUPS . ".user_id"
            )
            ->join(
                TB_GROUPS, 
                TB_GROUPS . ".id = " . TB_USERS_GROUPS . ".group_id", 
                'left'
            );

        $result = $this->db->get($this->table)->result();
        $count = 0;
        
        foreach ($result as $row) {
            $count++;
            $row->count = $count;
            $row->link_update = admin_url('users/updated/'.$row->id);
            $row->link_delete = admin_url('users/delete/'.$row->id);
            $row->link_active = admin_url('users/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
        }

        return $result;
        
     }

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
     * @access  public
     * @param   string  the type of the flash message
     * @param   string  flash message 
     * @return  string  flash message with proper style
     */
     function add_user( $insertData=array() )
     {
        $this->db->insert($this->table,$insertData);
        return $this->db->insert_id();
     }//End of insert user Function
     
     // --------------------------------------------------------------------
        
    /**
     * Update user
     *
     * @access  private
     * @param   array   an associative array of update values
     * @return  void
     */
     function update_user( $updateKey=array(), $updateData=array() )
     {
        $this->db->update($this->table ,$updateData, $updateKey);
         
     }//End of update user Function 

     /**
     * delete user
     *
     * @access  private
     * @param   condition of where
     * @return  void
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
     * @access  private
     * @param   condition of where
     * @return  void
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
        $this->db->where(array(
            'username' => $username, 
            'password' => md5($password)
        ));

        $this->db->join(
            TB_USERS_GROUPS, 
            "{$this->table}.id = ".TB_USERS_GROUPS.".user_id"
        );

        $this->db->join(
            TB_GROUPS, 
            TB_GROUPS . ".id = ".TB_USERS_GROUPS.".group_id", 
            'left'
        );

        $this->db->select("
            {$this->table}.username, 
            {$this->table}.full_name as name, 
            {$this->table}.id,
            {$this->table}.address_id,
            {$this->table_groups}.name as role_name
        ");
        
        $user = $this->db->get($this->table)->row();

        if (count($user) > 0) {
            $values = [
                'admin_id' => $user->id, 
                'admin_name' => $user->name, 
                'admin_role' => $user->role_name,
                'address_id' => explode(',',  $user->address_id), 
                'login_admin' => true
            ];
            $this->session->set_userdata($values);
            return true;
        }

        return false;
    }

    function login_member($username = '', $password = '', $remenber = 0){
        if ($username == '' || $password =='') {
            return false;
        }
        $this->db->where(array(
        	'username' => $username, 
        	'password' => md5($password)
        ));
        $this->db->select("
        	{$this->table}.username, 
        	{$this->table}.full_name as name, 
        	{$this->table}.id
        ");
        
        $user = $this->db->get($this->table)->row();
        
        if(count($user) > 0){
            $values = array(
            	'member_id' => $user->id, 
            	'member_name' => $user->name, 
            	'member_role' => 'member', 
            	'login_member' => TRUE
            );

            $this->session->set_userdata($values);

            return true;
        }

        return false;
    }

    function logout()
    {
        $values = array(
        	'admin_id'=> '',
        	'login_admin'=> false ,
        	'admin_role'=>''
        );

        $this->session->set_userdata($values);
        return true;
    }
}
// End Auth_model Class
   
/* End of file Auth_model.php */ 
/* Location: ./app/models/Auth_model.php */