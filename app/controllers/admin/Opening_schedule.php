<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Opening_schedule extends Admin_Controller 
{
    public $limit = array();
    /*
    * String after link
    */
    public $queryString = null;

    /*
    * per_page
    */
    public $perPage;

	public $outputData;

    public $numberPage = 20;

    function __construct()
    {
    	parent::__construct();
        // to use $_GET
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

        if(!isAdmin())
			redirect_admin('login');
    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/opening_schedule_model');
    }

    function index()
    {
        $courseId = $scheduleId = $degreeId = $addressId = 0;
        $code = '';
        $condition = [];

        if (isset($_GET['courseId']) && $_GET['courseId'] ) {
            $courseId = $_GET['courseId'];
            $this->queryString .= '&courseId=' . $courseId;
            $condition[TB_OPENING_SCHEDULE.'.course_id'] = $courseId;
        }
        if (isset($_GET['degreeId']) && $_GET['degreeId']) {
            $degreeId = $_GET['degreeId'];
            $this->queryString .= '&degreeId=' . $degreeId;
            $condition[TB_OPENING_SCHEDULE . '.degree_id'] = $degreeId;
        }

        if (isset($_GET['addressId']) && $_GET['addressId']) {
            $addressId = $_GET['addressId'];
            $this->queryString .= '&addressId=' . $addressId;
            $condition[TB_OPENING_SCHEDULE . '.address_id'] = $addressId;
        }

        if (isset($_GET['scheduleId']) && $_GET['scheduleId']) {
            $scheduleId = $_GET['scheduleId'];
            $this->queryString .= '&scheduleId=' . $scheduleId;
            $condition[TB_OPENING_SCHEDULE . '.schedule_id'] = $scheduleId;
        }

        $selectDegree = $this->selectDegree($degreeId);
        $selectSchedule = $this->selectSchedule($scheduleId);
        $selectAddress = $this->selectAddress($addressId);

        $this->getLimit();
        $this->_total = count($this->opening_schedule_model->list()->result());
        $collection = $this->opening_schedule_model->list($condition, $this->limit)->result();
        $collectionData = $this->opening_schedule_model->parseData($collection);
        $pagination = $this->getPagination();

    	$this->outputData = [
			'pageTitle' => 'Danh sách học viên',
			'currentPage' => 'opening_schedule',
			'subPage'=> 'listopening_schedule',
			'list' => $collectionData,
            'delAll' => admin_url('opening_schedule/delListChoose'),
            'addNew' => admin_url('opening_schedule/updated/0'),
            'pagination' => $pagination,
            'selectDegree' => $selectDegree,
            'selectSchedule' => $selectSchedule,
            'selectAddress' => $selectAddress,
            'selectCourses' => $this->selectCourses($courseId)
		];

	    $this->render('admin/opening_schedule/list');
    }
   
    function updated($id)	
    {	
        $openingSchedule =  $this->opening_schedule_model->getDetailData(['id' => $id]);
        $courseOptionDefault = 'Chọn mã khóa học';
        $addressOptionDefault = 'Chọn địa điểm';
        $carOptionDefault = 'Chọn địa xe học';
        $scheduleOptionDefault = 'Chọn lịch khai giảng';
	   
	    if ($id) {
            $pageTitle = 'Chỉnh lịch khai giảng';
            $action = 'Cập nhật';
	    } else {
            $pageTitle = 'Thêm lịch khai giảng';
            $action = 'Thêm mới';
	    }

        $courseId = $id ? $openingSchedule->course_id : null;
        $degreeId = $id ? $openingSchedule->degree_id : null;
        $addressId = $id ? $openingSchedule->address_id : null;
        $scheduleId = $id ? $openingSchedule->schedule_id : null;

        $selectCourses = $this->selectCourses($courseId, true);
        $selectDegree = $this->selectDegree($degreeId, true);
        $selectAddress = $this->selectAddress($addressId, true);

        $this->outputData = [
            'pageTitle' => $pageTitle,
            'currentPage' => 'menu',
            'page' => $openingSchedule,
            'id' => $id,
            'seleteDegree' => $selectDegree,
            'seleteCourses' => $selectCourses,
            'seleteAddress' => $selectAddress,
            'subPage' => '',
            'action' => $action,
            'option' => [],
            'linkSave' => admin_url('opening_schedule/save')
        ];
	    
		$this->render('admin/opening_schedule/update');
    }

    public function save()
    {
        $id = $this->input->post('id');

    	$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		// $this->form_validation->set_rules('degree_id','lang:site_title_validation', 'trim|required|xss_clean');
       
  //   	if ( ! $this->form_validation->run()) {
  //           $this->updated($id);
  //           return true;
  //       }

		$data = $this->input->post();
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($id) {
            $key = array('id' => $id);
            $this->opening_schedule_model->updateData($key, $data);
            $this->session->set_flashdata('flash_message','Cập nhật học viên thành công !');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
        	$this->opening_schedule_model->insertData($data);
            $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 học viên mới');
        }

		redirect_admin('opening_schedule');   
    }

    function delete($id)
    { 
		$this->opening_schedule_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('opening_schedule');		
    }

    function updateStatus()
    {
        $resp = [
            'error' => '',
            'result' => '',
        ];

    	$id = $this->uri->segment(4);
    	$action = trim($_POST['action']);
    	//check product exist
    	if ($this->opening_schedule_model->check_exists(array('id' => $id))) {
    		// click ok status
	    	if ($_POST['active'] == 1) {
	    		$this->opening_schedule_model->updateData(array('id' => $id), array($action => 0));
                $resp = ['result' => 'glyphicon-remove', 'num' => 0];
	    	} else {
	    		$this->opening_schedule_model->updateData(array('id' => $id), array($action => 1));
                $resp = ['result' => 'glyphicon-ok', 'num' => 1];
	    	}
    	} else {
    		$resp['error'] = 'Bài viết này không tồn tại'; 
    	}

        echo json_encode($resp);
    }


    function delListChoose()
    {
    	$list_id = explode(',', $_POST['list_id']);

    	if (count($list_id) == 1) {
    		$this->opening_schedule_model->deleteData($list_id);
    	} else {
	    	foreach ($list_id as $id) {
	    		if ($this->opening_schedule_model->check_exists(array('id' => $id))) {
	    			$this->opening_schedule_model->deleteData($id);
	    		} else {
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
			    
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục sản phẩm');
           
        echo json_encode(array('result' => admin_url('menu'))); exit(); 
    }


    function getPagination()
    {
        $this->load->library('pagination');
        $limit = $this->limit;
        $perPage = $limit[0];
        $url = './admin/opening_schedule'.$this->queryString;
        $config['page_query_string'] = TRUE;
        $config['base_url'] = $url;
        $config['total_rows'] = $this->_total;
        $config['per_page'] = $perPage;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        return $pagination;     
    } 

    function getLimit() 
    {
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
            $this->perPage = $_GET['per_page'];
        }

        $this->limit = array($this->numberPage, $this->perPage);
    }

    protected function selectCourses($seletedId = null, $checkActive = false) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_COURES], $seletedId, 'Chọn mã khóa học', $checkActive);
    }

    protected function selectDegree($seletedId = null, $checkActive = false) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_DEGREE], $seletedId, 'Chọn hạng xe', $checkActive);
    }

    protected function selectCar($seletedId, $checkActive = false) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_CARS], $seletedId, 'Chọn xe học', $checkActive);
    }

    protected function selectAddress($seletedId, $checkActive = false) 
    {
        $condition = ['table' => TB_ADDRESS];
        if (adminRoleName() == 'manage_store' && manageStoreAddress()) {
            $arrIds = array_map('intval', manageStoreAddress());
            $listIds = implode("','", $arrIds);
            $condition['where'] =  "id in ({$listIds})";
        } 

        return $this->select_option->dropdownSelect($condition, $seletedId , 'Chọn địa điểm', $checkActive);
    }

    protected function selectSchedule($seletedId) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_SCHEDULE], $seletedId, 'Chọn lịch khai giảng');
    }
}