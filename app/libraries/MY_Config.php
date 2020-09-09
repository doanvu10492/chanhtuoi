<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Config extends CI_Config
{

	public function __construct()
	{
		parent::__construct();
	} //Controller End
	
	//Config extends to database
	
	public function db_config_fetch()
    {
		//Create Codeigniter object
        $CI =& get_instance();
		
		//Condition - Get System Related Variables
		$CI->db->where('setting_type', 'S');		
		$CI->db->select('code,value_type,int_value,string_value,text_value');		
		$query = $CI->db->get(TBL_CONFIG);
		
        foreach ($query->result() as $row) {
		// Conditions based on value type field
		    if($row->value_type =='I' )
		    {
		         $this->set_item(strtolower($row->code),$row->int_value);
		    }//if End
		    if($row->value_type =='T' )
		    {
		         $this->set_item(strtolower($row->code),$row->text_value);
		    }//if End
		    if($row->value_type =='S' )
		    {
		         $this->set_item(strtolower($row->code),$row->string_value);
		    } //if End 
        }// Foreach End

    } //Function end db_config_fetch
} //Class 
