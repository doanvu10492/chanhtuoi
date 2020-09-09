<?php
 class Opening_schedule_model extends My_Model { 

    var $table = TB_OPENING_SCHEDULE;
    var $key = 'id';
    var $tableDegree = TB_DEGREE;
    var $tableAddress = TB_ADDRESS;
    var $tableCourse = TB_COURES;
    var $tableSchedule = TB_SCHEDULE;

    function __construct() 
    {
    	$this->primary_key = 'id';
    	$this->timestamps = TRUE;
    	parent::__construct();
    }

    function list($condition = array(), $limit = array(), $order_by = NULL)
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
            $this->db->order_by('id desc');
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
       
        $this->db->select("
            {$this->table}.*, 
            {$this->tableDegree}.name as title_degree,
            {$this->tableCourse}.name as title_course,
            {$this->tableCourse}.total_register,
            {$this->tableAddress}.name as title_address,
            {$this->tableSchedule}.name as title_schedule,
            DATE_FORMAT({$this->tableCourse}.start_date, '%d-%m-%Y') as start_date,
            DATE_FORMAT({$this->tableCourse}.end_date, '%d-%m-%Y') as end_date,
            {$this->tableCourse}.exam_date,
        ");
        $this->db->join(
            "{$this->tableDegree}",
            "{$this->tableDegree}.id = {$this->table}.degree_id", 
            "left"
        );
        $this->db->join(
            "{$this->tableCourse}",
            "{$this->tableCourse}.id = {$this->table}.course_id", 
            "left"
        );
        $this->db->join(
            "{$this->tableAddress}",
            "{$this->tableAddress}.id = {$this->table}.address_id", 
            "left"
        );
        $this->db->join(
            "{$this->tableSchedule}",
            "{$this->tableSchedule}.id = {$this->table}.schedule_id", 
            "left"
        );

        if (adminRoleName() == 'manage_store' && manageStoreAddress()) {
            $this->db->where_in("{$this->table}.address_id", manageStoreAddress());
        }

        $result = $this->db->get($this->table);


        return $result;
    }

    function parseData($data)
    {
    	$count = 0;
    	foreach ($data as $row) {
    		$count++;
    		$row->count = $count;
    		$row->link_update = admin_url('opening_schedule/updated/'.$row->id);
    		$row->link_delete = admin_url('opening_schedule/delete/'.$row->id);
            $row->link_active = admin_url('opening_schedule/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
    	}
    	return $data;
    }
}