<?php
 class Student_model extends My_Model { 

    var $table = TB_STUDENT;
    var $key = 'id';
    var $tableDegree = TB_DEGREE;
    var $tableAddress = TB_ADDRESS;
    var $tableCars = TB_CARS;
    var $tableCourse = TB_COURES;
    var $tableExamResult = TB_EXAM_RESULT;
    var $tableOpeningSchedule = TB_OPENING_SCHEDULE;
    var $tableUser = TB_USERS;
    var $tableUserCreated = TB_USERS;

    function __construct() 
    {
    	$this->table = TB_STUDENT;
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

		if (isset($condition["{$this->table}.fullname"])) {
			$this->db->like("{$this->table}.fullname", $condition["{$this->table}.fullname"]);
            unset($condition["{$this->table}.fullname"]);
        }
		
        if (isset($condition["{$this->table}.to"])) {
            $toDate = $condition["{$this->table}.to"];
            $this->db->where("{$this->table}.created_at <= '$toDate'");
            unset($condition["{$this->table}.to"]);
        }

        if (isset($condition["{$this->table}.from"])) {
            $fromDate = $condition["{$this->table}.from"];
            $this->db->where("{$this->table}.created_at >= '$fromDate'");
            unset($condition["{$this->table}.from"]);
        }
        if ($condition && is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        if (adminRoleName() == 'manage_store' && manageStoreAddress()) {
            $this->db->where_in("{$this->table}.address", manageStoreAddress());
        }

        $this->db->select("
            {$this->table}.*, 
            {$this->tableDegree}.name as title_degree,
            {$this->tableCars}.name as title_car,
            {$this->tableCourse}.name as title_course,
            DATE_FORMAT({$this->tableCourse}.start_date, '%d-%m-%Y') as start_date,
            DATE_FORMAT({$this->tableCourse}.end_date, '%d-%m-%Y') as end_date,
            DATE_FORMAT({$this->tableCourse}.exam_date, '%d-%m-%Y') as exam_date,
            {$this->tableAddress}.name as title_address,
            {$this->tableExamResult}.label as title_exam_result,
            IF({$this->table}.isPaid, 'Đã đóng', 'Chưa đóng') as title_paid,
            IF({$this->table}.active, 'Đã đăng ký', 'Đang xem xét') as title_active,
            tableCreateUser.username as create_user,
            {$this->tableUser}.username as update_user  
        ");
        $this->db->join(
            "{$this->tableDegree}",
            "{$this->tableDegree}.id = {$this->table}.degree", 
            "left"
        );
        $this->db->join(
            "{$this->tableCars}",
            "{$this->tableCars}.id = {$this->table}.car", 
            "left"
        );
        $this->db->join(
            "{$this->tableCourse}",
            "{$this->tableCourse}.id = {$this->table}.course_code", 
            "left"
        );
        $this->db->join(
            "{$this->tableAddress}",
            "{$this->tableAddress}.id = {$this->table}.address", 
            "left"
        );
        $this->db->join(
            "{$this->tableExamResult}",
            "{$this->tableExamResult}.id = {$this->table}.result", 
            "left"
        );
        $this->db->join(
            "{$this->tableUserCreated} as tableCreateUser",
            "tableCreateUser.id = {$this->table}.user_id", 
            "left"
        );
        $this->db->join(
            "{$this->tableUser}",
            "{$this->tableUser}.id = {$this->table}.update_user_id", 
            "left"
        );

        $result = $this->db->get($this->table);

        return $result;
    }

    function parseData($data)
    {
    	$count = 0;
    	foreach ($data as $row) {
    		$count++;
    		$row->count = $count;
    		$row->link_update = admin_url('student/updated/'.$row->id);
    		$row->link_delete = admin_url('student/delete/'.$row->id);
            $row->link_active = admin_url('student/updateStatus/'.$row->id);
            $row->icon_active = ($row->active==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->link_result = admin_url('student/updateStatus/'.$row->id);
            $row->icon_result = ($row->result==1) ? ("glyphicon-ok") : ("glyphicon-remove");
            $row->linkPaid = admin_url('student/checkIsPaid/'.$row->id);
            $row->linkResult = admin_url('student/checkResult/'.$row->id);
    	}
    	return $data;
    }

    function getLastStudent() {
        return $this->db->select('*')->from($this->table)->limit(1)->order_by('id', 'DESC')->get()->row();
    }

    function examResult() {
        return [
            'processing' => 'Chưa thi',
            'pass' => 'Thi đậu',
            'fail' => 'Không đạt'
        ];
    }

    function countStudentRegister($condition = array())
    {
        if ($condition) {
            $this->db->where($condition);
        }
        $this->db->select("{$this->table}.*");

        $result = $this->db->get($this->table);


        return count($result->result_array());
    }

    function totalStudentOfCourse($condition = array()) 
    {
        if ($condition) {
            $this->db->where($condition);
        }
        $this->db->select("{$this->tableCourse}.*");

        $result = $this->db->get($this->tableCourse)->row_array();

        return (int) $result['total_register'];
    }
         
}