<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends Admin_Controller 
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

    public $numberPage = 10;

    public $hide = false;

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
		$this->load->model('backend/student_model');
    }

    function index()
    {
        $courseId = $degreeId = $carId = $courseId = $addressId = 0;
        $code = $result = $cmnd =  $active = $from = $to = $fullname =  '';
        $condition = [];
        if (isset($_GET['courseId']) && $_GET['courseId'] ) {
            $courseId = $_GET['courseId'];
            $this->queryString .= '&courseId=' . $courseId;
            $condition[TB_STUDENT.'.course_code'] = $courseId;
        }

        if (isset($_GET['code']) && $_GET['code'] ) {
            $code = $_GET['code'];
            $this->queryString .= '&code=' . $code;
            $condition[TB_STUDENT.'.code'] = $code;
        }

        if (isset($_GET['cmnd']) && $_GET['cmnd'] ) {
            $cmnd = $_GET['cmnd'];
            $this->queryString .= '&cmnd=' . $cmnd;
            $condition[TB_STUDENT.'.cmnd'] = $cmnd;
        }

        if (isset($_GET['degreeId']) && $_GET['degreeId']) {
            $degreeId = $_GET['degreeId'];
            $this->queryString .= '&degreeId=' . $degreeId;
            $condition[TB_STUDENT.'.degree'] = $degreeId;
        }

        if (isset($_GET['carId']) && $_GET['carId']) {
            $carId = $_GET['carId'];
            $this->queryString .= '&carId=' . $carId;
            $condition[TB_STUDENT.'.car'] = $carId;
        }

         if (isset($_GET['result']) && $_GET['result']) {
            $result = $_GET['result'];
            $this->queryString .= '&result=' . $result;
            $condition[TB_STUDENT.'.result'] = $result;
        }

        if (isset($_GET['active']) && $_GET['active'] != '' ) {
            $active = $_GET['active'];
            $this->queryString .= '&active=' . $active;
            $condition[TB_STUDENT.'.active'] = $active;
        }

        if (isset($_GET['from']) && $_GET['from'] ) {
            $from = $_GET['from'];
            $this->queryString .= '&from=' . $from;
            $condition[TB_STUDENT.'.from'] = $from;
        }

        if (isset($_GET['to']) && $_GET['to'] ) {
            $to = $_GET['to'];
            $this->queryString .= '&to=' . $to;
            $condition[TB_STUDENT.'.to'] = $to;
        }

        if (isset($_GET['addressId']) && $_GET['addressId']) {
            $addressId = $_GET['addressId'];
            $this->queryString .= '&addressId=' . $addressId;
            $condition[TB_STUDENT.'.address'] = $addressId;
        }
		
		if (isset($_GET['fullname']) && $_GET['fullname']) {
            $fullname = $_GET['fullname'];
            $this->queryString .= '&fullname=' . $fullname;
            $condition[TB_STUDENT.'.fullname'] = $fullname;
        }

        $this->getLimit();
        $this->_total = count($this->student_model->list()->result());
        $collection = $this->student_model->list($condition, $this->limit)->result();

        $collectionData = $this->student_model->parseData($collection);
        $pagination = $this->getPagination();

        $selectCourses = $this->selectCourses($courseId);
        $selectDegree = $this->selectDegree($degreeId);
        $selectCar = $this->selectCar($carId);
        $selectAddress = $this->selectAddress($addressId);

    	$this->outputData = [
			'pageTitle' => 'Danh sách học viên',
			'currentPage' => 'student',
			'subPage'=> 'list_student',
			'list' => $collectionData,
            'delAll' => admin_url('student/delListChoose'),
            'addNew' => admin_url('student/updated/0'),
            'pagination' => $pagination,
            'selectCourses' => $selectCourses,
            'selectCar' => $selectCar,
            'selectDegree' => $selectDegree,
            'selectAddress' => $selectAddress,
            'code' => $code,
            'cmnd' => $cmnd,
            'from' => $from,
			'fullname' => $fullname,
            'to' => $to,
            'linkExportCsv' => admin_url('student/exportCSV') .  preg_replace("/^&/", '?', $this->queryString),
            'resultRegister' => $active,
            'selectedResultExam' => $result,
            'examResult' => $this->student_model->examResult()
		];

	    $this->render('admin/student/list');
    }
   
    function updated($id)
    {	
        $student =  $this->student_model->getDetailData(['id' => $id]);
        $courseOptionDefault = 'Chọn mã khóa học';
        $addressOptionDefault = 'Chọn địa điểm thi';
        $carOptionDefault = 'Chọn địa xe học';
	    if ($id) {
            $pageTitle = 'Chỉnh học viên';
            $action = 'Cập nhật';
	    } else {
            $pageTitle = 'Thêm học viên mới';
            $action = 'Thêm mới';
            $this->hide = true;
	    }


        $courseId = $id ? $student->course_code : null;
        $degreeId = $id ? $student->degree : null;
        $carId = $id ? $student->car : null;
        $addressId = $id ? $student->address : null;

        $selectCourses = $this->selectCourses($courseId, true);
        $selectDegree = $this->selectDegree($degreeId, true);
        $selectCars = $this->selectCar($carId, true);
        $selectAddress = $this->selectAddress($addressId, true);

        $this->outputData = [
            'pageTitle' => $pageTitle,
            'currentPage' => 'student',
            'page' => $student,
            'id' => $id,
            'seleteDegree' => $selectDegree,
            'seleteCourses' => $selectCourses,
            'seleteAddress' => $selectAddress,
            'seleteCars' => $selectCars,
            'subPage' => '',
            'action' => $action,
            'option' => [],
            'linkSave' => admin_url('student/save'),
            'examResult' => $this->student_model->examResult()
        ];
	    
		$this->render('admin/student/update');
    }

    public function save()
    {
        // print_r($this->checkNumberRegister()); die;
        $id = $this->input->post('id');

    	$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		$this->form_validation->set_rules('fullname','Họ tên', 'required|xss_clean');
        $this->form_validation->set_rules('course_code','Mã khóa học', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cmnd','CMND', 'trim|required|xss_clean');
        $this->form_validation->set_rules(
            'course_code',
            'Mã khóa học', 
            'trim|required|xss_clean'
        );

        $this->form_validation->set_rules(
            'degree',
            'Hạng xe', 
            'trim|required|xss_clean'
        );

        $this->form_validation->set_rules(
            'address',
            'Địa chỉ', 
            'trim|required|xss_clean'
        );

        if ( ! $id) {
        	if ( ! $this->form_validation->run() || ! $this->checkNumberRegister()) {
                $this->updated($id);
                return true;
            }
        }
        
		$data = $this->input->post();
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['result'] = $data['result'] ? $data['result'] : 'processing';
        
        $data['update_user_id'] = $this->session->userdata('admin_id');
        if ($id) {
            $this->load->model('backend/degree_model');
            $key = array('id' => $id);
            $this->student_model->updateData($key, $data);
            $this->session->set_flashdata('flash_message','Cập nhật học viên thành công !');
        } else {
            $data['user_id'] = $this->session->userdata('admin_id');
            $data['code'] = $this->generateCodeStudent();
            $data['created_at'] = date('Y-m-d H:i:s');
        	$this->student_model->insertData($data);
            $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 học viên mới');
        }

		redirect_admin('student');   
    }

    function delete($id)
    { 
		$this->student_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('student');		
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
    	if ($this->student_model->check_exists(array('id' => $id))) {
    		// click ok status
	    	if ($_POST['active'] == 1) {
	    		$this->student_model->updateData(array('id' => $id), array($action => 0));
                $resp = ['result' => 'glyphicon-remove', 'num' => 0];
	    	} else {
	    		$this->student_model->updateData(array('id' => $id), array($action => 1));
                $resp = ['result' => 'glyphicon-ok', 'num' => 1];
	    	}
    	} else {
    		$resp['error'] = 'Bài viết này không tồn tại'; 
    	}

        echo json_encode($resp);
    }

    function checkIsPaid()
    {
        $resp = [
            'error' => '',
            'result' => '',
        ];

        $id = $this->uri->segment(4);
        $action = trim($_POST['action']);
        //check product exist
        if ($this->student_model->check_exists(array('id' => $id))) {
            // click ok status
            if ($_POST['active'] == 1) {
                $this->student_model->updateData(array('id' => $id), array($action => 0));
                $resp = ['result' => 'Chưa đóng', 'num' => 0];
            } else {
                $this->student_model->updateData(array('id' => $id), array($action => 1));
                $resp = ['result' => 'Đã đóng', 'num' => 1];
            }
        } else {
            $resp['error'] = 'Bài viết này không tồn tại'; 
        }

        echo json_encode($resp);
    }


    function checkResult()
    {
        $resp = [
            'error' => '',
            'result' => '',
        ];

        $id = $this->uri->segment(4);
        $action = trim($_POST['action']);
        //check product exist
        if ($this->student_model->check_exists(array('id' => $id))) {
            // click ok status
            if ($_POST['active'] != 'pass') {
                $this->student_model->updateData(array('id' => $id), array($action => 'pass'));
                $resp = ['message' => 'Thi đậu', 'result' => 'pass'];
            } else {
                $this->student_model->updateData(array('id' => $id), array($action => 'fail'));
                $resp = ['message' => 'Không đạt', 'result' => 'fail'];
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
    		$this->student_model->deleteData($list_id);
    	} else {
	    	foreach ($list_id as $id) {
	    		if ($this->student_model->check_exists(array('id' => $id))) {
	    			$this->student_model->deleteData($id);
	    		} else {
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
			    
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công');
           
        echo json_encode(array('result' => admin_url('student'))); exit(); 
    }

    

    function getPagination()
    {
        $this->load->library('pagination');
        $limit = $this->limit;
        $perPage = $limit[0];
        $url = './admin/student' . preg_replace("/^&/", '?', $this->queryString);
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

    protected function generateCodeStudent()
    {
        $charFirst = $this->getCharFirstInDegree();
        $lastCode = $this->getLastCode();

        $numberCode = (int) substr($lastCode, 1, 9) + 1000000001;
        $registerCode = $charFirst . ''. (string) substr( $numberCode, 2, 9);
        return $registerCode;
    }

    protected function getLastCode()
    {
        $row = $this->student_model->getLastStudent();

        return $row->code;
    }

    protected function getCharFirstInDegree() 
    {
        $this->load->model('backend/degree_model');
        $degreeId = $this->input->post('degree');
        $degreeModel = $this->degree_model->getDetailData(['id' => $degreeId]);
        $degreeCode = $degreeModel->name;
        $firstDegreeCode = substr($degreeCode, 0, 1);

        return $firstDegreeCode;
    }

    protected function selectCourses($seletedId = null, $checkActive = false) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_COURES], $seletedId, 'Chọn mã khóa học', $checkActive, $this->hide);
    }

    protected function selectDegree($seletedId = null, $checkActive = false) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_DEGREE], $seletedId, 'Chọn hạng xe', $checkActive, $this->hide);
    }

    protected function selectCar($seletedId, $checkActive = false) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_CARS], $seletedId, 'Chọn xe học', $checkActive, $this->hide);
    }

    protected function selectAddress($seletedId, $checkActive = false) 
    {
        $condition = ['table' => TB_ADDRESS];
        if (adminRoleName() == 'manage_store' && manageStoreAddress()) {
            $arrIds = array_map('intval', manageStoreAddress());
            $listIds = implode("','", $arrIds);
            $condition['where'] =  "id in ({$listIds})";
        } 

        return $this->select_option->dropdownSelect($condition, $seletedId , 'Chọn địa điểm', $checkActive, $this->hide);
    }

    public function exportCSV()
    {
        $collection = $this->_getCollection();
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"students".".csv\"");
        header("Content-Transfer-Encoding: UTF-8");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "\xEF\xBB\xBF";

        $handle = fopen('php://output', 'w');

        $header = [
            'Ngày tạo',
            'Họ tên',
            'CMND',
            'Nơi ở thường trú',
            'Ngày sinh',
            'Hạng xe',
            'Mã khóa học',
            'Xe học',
            'Mã đăng ký',
            'Dự kiến khai giảng',
            'Dự kiến bế giảng',
            'Dự kiến thi',
            'Kết quả đăng ký',
            'Kết quả thi',
            'Số tiền',
            'Thu tiền',
            'Người tạo',
            'Địa chỉ',
            'Ghi chú'
        ];

        if ( adminRoleName() != 'manage_store')  {
            array_push($header, 'Người cập nhật lần cuối');
        }

        fputcsv($handle, $header);

        foreach ($collection as $data) {
            $csvRow = [
                'created_at' => date('d-m-Y H:i:s', strtotime($data['created_at'])),
                'fullname' => $data['fullname'],
                'cmnd' => $data['cmnd'],
                'place' => $data['place'],
                'birthday' => $data['birthday'],
                'title_degree' => $data['title_degree'],
                'title_course' => $data['title_course'],
                'title_car' => $data['title_car'],
                'code' => $data['code'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'exam_date' => $data['exam_date'],
                'title_active' => $data['title_active'],
                'title_exam_result' => $data['title_exam_result'],
                'total_paid' => $data['total_paid'],
                'title_paid' => $data['title_paid'],
                'create_user' => $data['create_user'],
                'title_address' => $data['title_address'],
                'notes' => $data['notes'],
                ];

            if ( adminRoleName() != 'manage_store')  {
                $csvRow['update_user'] = $data['update_user'];
            }
            
            fputcsv($handle, $csvRow);
        }
            fclose($handle);
        exit;
    }

    public function _getCollection()
    {
       $courseId = $degreeId = $carId = $courseId = $addressId = 0;
        $code = $result = $cmnd =  $active = $from = $to = $fullname =  '';
        $condition = [];
        if (isset($_GET['courseId']) && $_GET['courseId'] ) {
            $courseId = $_GET['courseId'];
            $this->queryString .= '&courseId=' . $courseId;
            $condition[TB_STUDENT.'.course_code'] = $courseId;
        }

        if (isset($_GET['code']) && $_GET['code'] ) {
            $code = $_GET['code'];
            $this->queryString .= '&code=' . $code;
            $condition[TB_STUDENT.'.code'] = $code;
        }

        if (isset($_GET['cmnd']) && $_GET['cmnd'] ) {
            $cmnd = $_GET['cmnd'];
            $this->queryString .= '&cmnd=' . $cmnd;
            $condition[TB_STUDENT.'.cmnd'] = $cmnd;
        }

        if (isset($_GET['degreeId']) && $_GET['degreeId']) {
            $degreeId = $_GET['degreeId'];
            $this->queryString .= '&degreeId=' . $degreeId;
            $condition[TB_STUDENT.'.degree'] = $degreeId;
        }

        if (isset($_GET['carId']) && $_GET['carId']) {
            $carId = $_GET['carId'];
            $this->queryString .= '&carId=' . $carId;
            $condition[TB_STUDENT.'.car'] = $carId;
        }

         if (isset($_GET['result']) && $_GET['result']) {
            $result = $_GET['result'];
            $this->queryString .= '&result=' . $result;
            $condition[TB_STUDENT.'.result'] = $result;
        }

        if (isset($_GET['active']) && $_GET['active'] != '' ) {
            $active = $_GET['active'];
            $this->queryString .= '&active=' . $active;
            $condition[TB_STUDENT.'.active'] = $active;
        }

        if (isset($_GET['from']) && $_GET['from'] ) {
            $from = $_GET['from'];
            $this->queryString .= '&from=' . $from;
            $condition[TB_STUDENT.'.from'] = $from;
        }

        if (isset($_GET['to']) && $_GET['to'] ) {
            $to = $_GET['to'];
            $this->queryString .= '&to=' . $to;
            $condition[TB_STUDENT.'.to'] = $to;
        }

        if (isset($_GET['addressId']) && $_GET['addressId']) {
            $addressId = $_GET['addressId'];
            $this->queryString .= '&addressId=' . $addressId;
            $condition[TB_STUDENT.'.address'] = $addressId;
        }
        
        if (isset($_GET['fullname']) && $_GET['fullname']) {
            $fullname = $_GET['fullname'];
            $this->queryString .= '&fullname=' . $fullname;
            $condition[TB_STUDENT.'.fullname'] = $fullname;
        }

        $collection = $this->student_model->list($condition, $this->limit)->result_array();

        return $collection;
    }


    protected function checkNumberRegister()
    {
        $condition = [
            'course_code' => $this->input->post('course_code')
        ];

        $registeredNumber = $this->student_model->countStudentRegister($condition);

        $conditionStudent = [
            'id' => $this->input->post('course_code')
        ];
        $studentNumber = $this->student_model->totalStudentOfCourse($conditionStudent);

        if ($studentNumber && ($registeredNumber >= $studentNumber)) {
            $this->session->set_flashdata('error_message','Khóa học này đã đủ số lượng đăng ký, Vui lòng chọn khóa học khác !');
            return false;
        }

        return true;
    }
}