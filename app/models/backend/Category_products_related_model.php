<?php
class Category_products_related_model extends My_Model 
{ 
    var $table = TB_CGR_PRODUCTS_RELATED;
    var $key = 'id';

    public function __construct() 
    {
    	$this->primary_key = $this->key;
    	$this->timestamps = TRUE;
    	
        parent::__construct();
    }
}
