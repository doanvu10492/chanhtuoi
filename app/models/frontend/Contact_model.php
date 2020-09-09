<?php
 class Contact_model extends My_Model 
 { 
    var $table = TB_CONTACT;
    var $key = 'id';
	/**
	 * Constructor 
	 *
	 */
	public function __construct() 
	{
		$this->table = TB_CONTACT;
		$this->primary_key = 'id';
		$this->timestamps = TRUE;
		parent::__construct();
	    
	}//Controller End

	// --------------------------------------------------------------------

}
// End Contact_model Class
   
/* End of file Contact_model.php */ 
/* Location: ./app/models/frontend/Contact_model.php */