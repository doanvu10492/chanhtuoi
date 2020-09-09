<?php
class Cart_model extends CI_Model 
{
	/**
	* Constructor 
	*
	*/
	public function __construct() 
	{
		parent::__construct();
	}//Controller End
	 
	// --------------------------------------------------------------------
	public function update_cart($rowid, $qty, $price, $amount) 
	{
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount
		);

		$this->cart->update($data);
	}

	public function insert_customer($data)
	{
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		
		return (isset($id)) ? $id : FALSE;		
	}
	
	public function insert_order($data = array())
	{
		$this->db->insert(TB_ORDERS, $data);
	
		return $this->db->insert_id();
	}
	
	public function insert_order_detail($data)
	{
		$this->db->insert(TB_ORDERS_DETAIL, $data);
	}
}
// End Page_model Class
   
/* End of file Page_model.php */ 
/* Location: ./app/models/Page_model.php *///Controller End
