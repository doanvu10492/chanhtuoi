<?php
class Page_model extends My_Model 
{
    public $tableDegree = TB_DEGREE;
    public $tableAddress = TB_ADDRESS;
    public $tableCars = TB_CARS;
    public $tableCourse = TB_COURES; 
    public $tableStudent = TB_STUDENT;
    public $tableSchedule = TB_SCHEDULE;
    public $tableOpeningSchedule = TB_OPENING_SCHEDULE;

    public function __construct()
    {
        parent::__construct();
        $this->table_album = TB_ALBUM;
        $this->category_album = TB_CGR_ALBUM;
        $this->table_video = TB_VIDEO;
        $this->table_links = TB_LINKS;
        $this->table_posts= TB_POSTS;
        $this->category_posts = TB_CGR_POSTS;
        $this->system_branchs = TB_SYSTEM_BRANCH;
    }

    public function list_video($limit = array(), $keywords = NULL, $order_by = NULL, $condition = array())
    {
        if (is_array($limit) && $limit !=NULL) { 
            if( is_array($limit) && count($limit) > 1 )
                $this->db->limit($limit[0], $limit[1]);  
        
        }

        if ($keywords != NULL) {
              $this->db->like("{$this->table_video}.name", $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by("{$this->table_video}.id desc");
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->where('active', 1);
        $this->db->select("{$this->table_video}.name, {$this->table_video}.alias, {$this->table_video}.id, {$this->table_video}.isHome, {$this->table_video}.code, {$this->table_video}.active, {$this->table_video}.created_at");
        $result = $this->db->get($this->table_video)->result_array();
        $data = array();
        $count = 0;

        if( count($result) > 0 ) {
            foreach($result as $row) {
                $row['count'] = ++$count;
                $row['img'] = '<img class="img_video" src="http://img.youtube.com/vi/'.$row['code'].'/0.jpg" alt="'.$row['name'].'">';
                $row['date'] = date( 'd/m/Y', strtotime( $row['created_at']) );
                $row['link'] = './video/'.$row['alias'].'-'.$row['id'].'.html';
                $data[] = $row;
            }
        }

        return $data;
    }

    function view_video($condition = array()) 
    {
        if(is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->where("{$this->table_video}.active", 1);
        $this->db->select("{$this->table_video}.*");
        $result = $this->db->get("{$this->table_video}");
        $result = $result->row_array();
        $result['link'] = './video/'.$result['alias'].'-'.$result['id'].'.html';
        $result['img'] = '<img class="img_video" src="http://img.youtube.com/vi/'.$result['code'].'/0.jpg" alt="'.$result['name'].'">';
        $result['date'] = date( 'd/m/Y', strtotime( $result['created_at']) );
        
        return $result;
    }
    // ----------------------

    /*
    ** ALBUM
    */
    public function listAlbum($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL)
    {
        if (is_array($limit)) {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }
        if ($keywords != NULL) {
              $this->db->like("{$this->table_album}.name{$lang}", $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by("{$this->table_album}.created_at desc");
        }
      
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->where("{$this->table_album}.active", 1);
        $this->db->join(
            "{$this->category_album}",
            "{$this->category_album}.id_cate = {$this->table_album}.id_cate", 
            "left"
        );
        
        $this->db->select("
            {$this->table_album}.*,
            {$this->category_album}.name as name_cate, 
            {$this->category_album}.id_cate, 
            {$this->category_album}.alias as alias_cate, 
            {$this->category_album}.brief as brief_cate
        ");

        $result = $this->db->get($this->table_album)->result_array();
        $count = 0;
        $data = array();
         
        foreach ($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['img'] = IMG_PATH_ALBUM.$row['image'];
            $row['img_thumb'] = IMG_PATH_ALBUM.'thumb/'.$row['image'];
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }

        return $data;
    }

    /*
    ** Category album
    */
    public function view_category_album($condition = array())
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("
            {$this->category_album}.name as name,
            {$this->category_album}.id_cate as id,
            {$this->category_album}.alias as alias,
            {$this->category_album}.image,
            {$this->category_album}.brief,
            {$this->category_album}.id_parent,
            {$this->category_album}.meta_title,
            {$this->category_album}.meta_keywords,
            {$this->category_album}.meta_description
        ");

        $result = $this->db->get("{$this->category_album}");
        $result = $result->row_array();

        if ( count($result) > 0 ) {
            $result['link'] = './'.$result['alias'];
        }

        return $result;
    }

    
    public function listPosts($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL, $where_in = array())
    { 
        if (is_array($limit)) {
            if (count($limit)==1)
                $this->db->limit($limit[0]);
            else if (count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }

        if ($keywords != NULL) {
              $this->db->like("{$this->table_posts}.name", $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by("{$this->table_posts}.created_at desc");
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        if (is_array($where_in) && count($where_in) > 0) {
            $this->db->where_in("{$this->table_posts}.id_cate", $where_in);
        }
        
        $this->db->where("{$this->table_posts}.active", 1);
        $this->db->join(
            "{$this->category_posts}",
            "{$this->category_posts}.id_cate = {$this->table_posts}.id_cate", 
            "left"
        );

        $this->db->select("
            {$this->table_posts}.*,
            {$this->category_posts}.name as name_cate,
            {$this->category_posts}.id_cate,
            {$this->category_posts}.alias as alias_cate
        ");

        $result = $this->db->get($this->table_posts)->result_array();
        $count = 0;
        $data = [];

        foreach ($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['img'] = IMG_PATH_POSTS.$row['image'];
            $row['img_thumb'] = IMG_PATH_POSTS.'thumb/'.$row['image'];
           
            $row['link'] = base_url() . $row['alias_cate'] . '/' . $row['alias'].'-p' . $row['id'].'.html';
            $row['link_cate'] = base_url() . $row['alias_cate'];
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }

        return $data;
    }

    public function support_online() 
    {
        $this->db->where('active', 1);
        $this->db->order_by('ordering asc');
        $this->db->select('name, hotline, skype, email');
        $result = $this->db->get(TB_SUPPORT_ONLINE)->result_array();
        return $result;
    }

    function listPages($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL, $where_in = array(), $alias_cate = '')
    {
        $lang = '';

        if (is_array($limit)) {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit[0],$limit[1]);
        }
        
        if ($keywords != NULL) {
              $this->db->like("{$this->table_posts}.name", $keywords);
        }
        
        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by("{$this->table_posts}.ordering asc");
        }
        
        $this->db->where("{$this->table_posts}.type", 'page');

        if (is_array($condition) && count($condition) > 0)
        {
            $this->db->where($condition);
        }

        $this->db->where("{$this->table_posts}.active", 1);
        $this->db->select("{$this->table_posts}.name{$lang} as name,
            {$this->table_posts}.alias{$lang} as alias,
            {$this->table_posts}.brief{$lang} as brief,
            {$this->table_posts}.description{$lang} as description,
            {$this->table_posts}.meta_title{$lang} as meta_title,
            {$this->table_posts}.meta_keywords{$lang} as meta_keywords,
            {$this->table_posts}.meta_description{$lang} as meta_description,
            {$this->table_posts}.image,
            {$this->table_posts}.link_web,
            {$this->table_posts}.id,
            {$this->table_posts}.created_at");
        $result = $this->db->get($this->table_posts)->result_array();
        $count = 0;
        $data = array();
         

        foreach($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['img'] = IMG_PATH_POSTS.$row['image'];
            $row['img_thumb'] = IMG_PATH_POSTS.'thumb/'.$row['image'];
           
            $row['link'] = 'tin-tuc/'.$row['alias'].'-'.$row['id'].'.html';
            $row['date'] = date('d/m/Y H:i', strtotime($row['created_at']));
            $data[] = $row;
        }

        return $data;
    }

    public function view_posts($condition = array()) 
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
        
        $this->db->join("
            {$this->category_posts}",
            "{$this->category_posts}.id_cate = {$this->table_posts}.id_cate", 
            "left"
        );

        $this->db->select("
            {$this->table_posts}.alias,
            {$this->table_posts}.brief,
            {$this->table_posts}.name,
            {$this->table_posts}.description,
            {$this->table_posts}.meta_title,
            {$this->table_posts}.meta_keywords,
            {$this->table_posts}.meta_description,
            {$this->table_posts}.image,
            {$this->table_posts}.id,
            {$this->table_posts}.file,
            {$this->table_posts}.id_cate,
            {$this->table_posts}.created_at,
            {$this->category_posts}.alias as alias_cate
        ");

        $result = $this->db->get("{$this->table_posts}");
        $result = $result->row_array();
        $result['img_thumb'] = base_url() . 'uploads/posts/thumb/' . $result['image'];
        $result['img'] = base_url() . 'uploads/posts/' . $result['image'];
        $result['link'] = base_url() . $result['alias'] . '-p' . $result['id'] . 'html';
        $result['date'] = date('d/m/Y H:i', strtotime($result['created_at']));

        return $result;
    }


    function list_category_posts($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL, $where_in = NULL)
    {
        if(is_array($limit)) {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit);
        }

        if ($keywords != NULL) {
              $this->db->like('name', $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by('ordering asc');
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);

        }
        if ($where_in != NULL) {
            $where_in = explode(',', $where_in);

            $this->db->where_in("{$this->category_posts}.id_cate", $where_in);
        }
        
        $this->db->where('type', 'posts');
        $this->db->where('active', 1);
        
        $this->db->select("
            {$this->category_posts}.brief,
            {$this->category_posts}.name,
            {$this->category_posts}.alias,
            {$this->category_posts}.description,
            {$this->category_posts}.meta_title,
            {$this->category_posts}.meta_keywords,
            {$this->category_posts}.meta_description,
            {$this->category_posts}.id_cate as id,
            {$this->category_posts}.created_at,
            {$this->category_posts}.module,
            {$this->category_posts}.id_parent,
            {$this->category_posts}.image,

        ");
        $result = $this->db->get($this->category_posts)->result_array();
      
        $count = 0;
        $data = array();

        foreach($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['link'] = './'.$row['alias'].'.html';
            $data []= $row;
        }

        return $data;
    }


    function view_category_posts($condition = array())
    {
        if(is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("
            {$this->category_posts}.brief,
            {$this->category_posts}.name,
            {$this->category_posts}.id_cate as id,
            {$this->category_posts}.alias as alias,
            {$this->category_posts}.module,
            {$this->category_posts}.image,
            {$this->category_posts}.type,
            {$this->category_posts}.id_parent,
            {$this->category_posts}.description,
            {$this->category_posts}.meta_title,
            {$this->category_posts}.meta_keywords,
            {$this->category_posts}.meta_description
        ");
        $result = $this->db->get("{$this->category_posts}");
        $result = $result->row_array();

        if( count($result) > 0 ) {
            $result['link'] = './'.$result['alias'];
        }

        return $result;
    }


    /*
    * list system branch
    */
    function listSystemBranchs($condition = array(), $limit = array(), $keywords = NULL, $order_by = NULL, $where_in = NULL)
    {
        if(is_array($limit)) {
            if(count($limit)==1)
                $this->db->limit($limit[0]);
            else if(count($limit)==2)
                $this->db->limit($limit);
        }

        if ($keywords != NULL) {
              $this->db->like('name', $keywords);
        }

        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        } else {
            $this->db->order_by('ordering asc');
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);

        }
        if ($where_in != NULL) {
            $where_in = explode(',', $where_in);
            $this->db->where_in("{$this->system_branchs}.id_cate", $where_in);
        }
        
        $this->db->where('active', 1);
        $this->db->select("*");
        $result = $this->db->get($this->system_branchs)->result_array();
        $count = 0;
        $data = array();

        foreach($result as $row) {
            $count++;
            $row['count'] = $count;
            $row['link'] = './'.$row['alias'].'.html';
            $data []= $row;
        }

        return $data;
    }


    public function viewSystemBranchs($condition = array())
    {
        if(is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("*");
        $result = $this->db->get("{$this->system_branchs}");
        $result = $result->row_array();

        return $result;
    }


    function searchStudent($condition = array())
    {
        $this->db->where($condition);
       
        $this->db->select("
            {$this->tableStudent}.*, 
            {$this->tableDegree}.name as title_degree,
            {$this->tableCars}.name as title_car,
            {$this->tableCourse}.name as title_course,
            {$this->tableAddress}.name as title_address,
            DATE_FORMAT({$this->tableCourse}.start_date, '%d-%m-%Y') as start_date,
            DATE_FORMAT({$this->tableCourse}.end_date, '%d-%m-%Y') as end_date,
            {$this->tableCourse}.exam_date,

        ");
        $this->db->join(
            "{$this->tableDegree}",
            "{$this->tableDegree}.id = {$this->tableStudent}.degree", 
            "left"
        );
        $this->db->join(
            "{$this->tableCars}",
            "{$this->tableCars}.id = {$this->tableStudent}.car", 
            "left"
        );
        $this->db->join(
            "{$this->tableCourse}",
            "{$this->tableCourse}.id = {$this->tableStudent}.course_code", 
            "left"
        );
        $this->db->join(
            "{$this->tableAddress}",
            "{$this->tableAddress}.id = {$this->tableStudent}.address", 
            "left"
        );

        $this->db->where("{$this->tableStudent}.active = 1");

        $result = $this->db->get($this->tableStudent);


        return $result->row_array();
    }

    function listDegree()
    {
        $this->db->select("{$this->tableDegree}.*");
        $this->db->where("{$this->tableDegree}.active = 1");
        $result = $this->db->get($this->tableDegree);

        return $result->result_array();
    }

    function listAddress($condition = array())
    {
        if ($condition) {
            $this->db->where($condition);
        }
        $this->db->select("{$this->tableAddress}.*");
        $this->db->where("{$this->tableAddress}.active = 1");

        $result = $this->db->get($this->tableAddress);


        return $result->result_array();
    }

    function listOpeningScheduleAddress($condition = array())
    {
        $addressId = $degreeId = $scheduleId = 0;
        $conditionOS = array();

        if (isset($condition['address'])) {
            $addressId = $condition['address'];
            
        }
        if (isset($condition['degree']) && $condition['degree']) {
            $degreeId = $condition['degree'];
            $conditionOS[TB_DEGREE.'.id'] = $degreeId;
        }
        if (isset($condition['schedule']) && $condition['schedule']) {
            $scheduleId = $condition['schedule'];
            $conditionOS['schedule'] = $condition['schedule'];
        }

        $listAddress = $addressId 
                    ? $this->listAddress(array('id' => $addressId))
                    : $this->listAddress();

        
        $data = array();
        foreach ($listAddress as $address) {
            $conditionOS[TB_ADDRESS.'.id'] = $address['id'];

            $address['open_schedule'] = $this->listOpeningSchedule($conditionOS);
            if ($address['open_schedule']) {
                $data[] = $address;
            }
        }

        return $data;
    }


    function listOpeningSchedule($condition = array(), $orderBy = null)
    {
        if ($orderBy != NULL) {
            $this->db->order_by($orderBy);
        } else {
            $this->db->order_by('id desc');
        }

        if (isset($condition['schedule'])) {
            $this->db->where(" DATE_FORMAT({$this->tableCourse}.start_date, '%m-%Y') = '". $condition['schedule'] . "'");
            unset($condition['schedule']);
        }

        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
        
         $this->db->where("{$this->tableOpeningSchedule}.active = 1");
         
        $this->db->select("
            {$this->tableOpeningSchedule}.*, 
            {$this->tableDegree}.name as title_degree,
            {$this->tableCourse}.name as title_course,
            {$this->tableCourse}.total_register,
            {$this->tableAddress}.name as title_address,
            DATE_FORMAT({$this->tableCourse}.start_date, '%d-%m-%Y') as title_schedule,
            DATE_FORMAT({$this->tableCourse}.start_date, '%d-%m-%Y') as start_date,
            DATE_FORMAT({$this->tableCourse}.end_date, '%d-%m-%Y') as end_date,
            {$this->tableCourse}.exam_date,
        ");
        $this->db->join(
            "{$this->tableDegree}",
            "{$this->tableDegree}.id = {$this->tableOpeningSchedule}.degree_id", 
            "left"
        );
        $this->db->join(
            "{$this->tableCourse}",
            "{$this->tableCourse}.id = {$this->tableOpeningSchedule}.course_id", 
            "left"
        );
        $this->db->join(
            "{$this->tableAddress}",
            "{$this->tableAddress}.id = {$this->tableOpeningSchedule}.address_id", 
            "left"
        );


        $result = $this->db->get($this->tableOpeningSchedule);
        $arrOpeningSchedule = $result->result_array();
        $data = [];

        foreach ($arrOpeningSchedule as $openingSchedule ) {
            $condition = [
                'active' => 1,
                'course_code' => $openingSchedule['course_id']
            ];
            $registeredNumber = $this->countStudentRegister($condition);
            $openingSchedule['total_registered'] = $registeredNumber;
            $totalNotRegister = (int) $openingSchedule['total_register'] - $registeredNumber;
            $openingSchedule['total_not_register'] = $totalNotRegister > 0 ? $totalNotRegister : 0;

            $data[] = $openingSchedule;
        }
        return $data;
    }


    function countStudentRegister($condition = array())
    {
        if ($condition) {
            $this->db->where($condition);
        }
        $this->db->select("{$this->tableStudent}.*");
        $this->db->where("{$this->tableStudent}.active = 1");

        $result = $this->db->get($this->tableStudent);


        return count($result->result_array());
    }


    public function getCateChild($id_cate, $table = '')
    {
        $data = [];

        $this->db->select("
            {$table}.name, 
            {$table}.id_cate as id, 
            {$table}.active,  
            {$table}.created_at
        ");

        $this->db->where('id_parent', $id_cate);
  
        $query = $this->db->get($table);

        if($query->num_rows()>0) {
            foreach($query->result_array() as $row) {
                $data[]=$row;
            }
        }
        
        $string_id = $id_cate;
        
        if(!empty($data)) {
            foreach($data as $row_id_cate)  {
                if($string_id=='') {
                    $string_id .= $row_id_cate['id'];  
                } else {
                    $string_id .=','.$row_id_cate['id'];   
                }
            }
        } else {
            $string_id = $id_cate;
        }

        return $string_id;
    }

    public function viewDetail($condition = array(), $table = '')
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }

        $this->db->select("*");
        $result = $this->db->get($table)->row_array();

        return $result;
    }
} 




