<?php
 class Schedule_model extends My_Model { 

    var $table = TB_SCHEDULE;
    var $key = 'id';

    function __construct() 
    {
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
    }

    function parseData($data)
    {
    	$count = 0;
    	foreach ($data as $row) {
    		$count++;
    		$row->count = $count;
    		$row->link_update = admin_url('schedule/updated/'.$row->id);
    		$row->link_delete = admin_url('schedule/delete/'.$row->id);
            $row->link_active = admin_url('schedule/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
    	}
    	return $data;
    }    
}