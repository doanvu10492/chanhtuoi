<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends Public_Controller 
{
    public $outputData;
	public $loggedInUser;

	function __construct()
	{
		parent::__construct();
		$this->config->db_config_fetch();

	    // check status of page
		if($this->config->item('site_status') == 0)
			redirect('offline');

        // load model	
        $this->load->model(['frontend/tags_model', 'frontend/page_model']);
        $this->load->library('select_option');
	}

  function registerLearn()
  {
    $this->outputData['current_page'] = 'register_learn';
    //OUTPUT OF SEO
    $this->outputData['page_title'] = 'Đăng ký học';
    $this->outputData['meta_keywords'] = 'register_learn';
    $this->outputData['meta_description'] = 'register_learn';

    $this->render_page('frontend/student/register_learn');
  }

  function searchStudent()
  {
     $condition = [];
    if (isset($_GET['code'])) {
      $condition[TB_STUDENT.'.code'] = $_GET['code'];
      $condition[TB_STUDENT.'.cmnd'] = $_GET['cmnd'];
    }

    if ($condition) {
      $this->outputData['student'] = $this->page_model->searchStudent($condition);
    } else {
      $this->outputData['student'] = [];
    }
    $this->outputData['current_page'] = 'search_student';
    //OUTPUT OF SEO
    $this->outputData['page_title'] = 'Tra cứu kết quả';
    $this->outputData['meta_keywords'] = 'Tra cứu kết quả';
    $this->outputData['meta_description'] = 'Tra cứu kết quả';
    $this->outputData['examResult'] = $this->examResult();

    $this->render_page('frontend/student/search_student');
  }

  public function searchStudentRegister()
  {
    if (isset($_GET['code'])) {

      $condition = [];

      if (isset($_GET)) {
         $condition[TB_STUDENT.'.code'] = $_GET['code'];
         $condition[TB_STUDENT.'.cmnd'] = $_GET['cmnd'];
      }

      if ($condition) {
        $this->outputData['student'] = $this->page_model->searchStudent($condition);
      } else {
        $this->outputData['student'] = [];
      }
    }
    $this->outputData['current_page'] = 'search_student_register';
    //OUTPUT OF SEO
    $this->outputData['page_title'] = 'Tra cứu kết quả đăng ký';
    $this->outputData['meta_keywords'] = 'Tra cứu kết quả đăng ký';
    $this->outputData['meta_description'] = 'Tra cứu kết quả đăng ký';

    $this->render_page('frontend/student/search_student_register');
  }

  public function viewOpeningSchedule()
  {
    $addressId = $scheduleId = $degreeId = 0;
    $condition = [];
    if (isset($_GET['address']) && $_GET['address']) {
      $addressId = $_GET['address'];
      $condition['address'] = $addressId;
    }

    if (isset($_GET['schedule']) && $_GET['schedule']) {
      $scheduleId = $_GET['schedule'];
      $this->load->model('backend/schedule_model');
      $schedule = $this->schedule_model->getDetailData(['id' => $scheduleId]);
      $date = str_replace('/', '-', trim($schedule->name));
      $condition['schedule'] = $date;
    }

    if (isset($_GET['degree']) && $_GET['degree']) {
      $degreeId = $_GET['degree'];
      $condition['degree'] = $degreeId;
    }

    if ($condition) {
      $this->outputData['listAddress'] = $this->page_model->listOpeningScheduleAddress($condition);
    } 


    $addressOptionDefault = 'Chọn địa điểm';
    $scheduleOptionDefault = 'Chọn lịch khai giảng';

    $listDegree = $this->page_model->listDegree();
    $this->outputData['listDegree'] = $listDegree;
     $this->outputData['degreeId'] = $degreeId;

    $selectAddress = $this->select_option->dropdownSelect(['table' => TB_ADDRESS, 'where' => 'active = 1'], $addressId , $addressOptionDefault);
    $this->outputData['selectAddress'] = $selectAddress;

    $selectSchedule = $this->select_option->dropdownSelect(['table' => TB_SCHEDULE, 'where' => 'active = 1'], $scheduleId , $scheduleOptionDefault);

    $this->outputData['selectSchedule'] = $selectSchedule;


    $this->outputData['current_page'] = 'search_student_register';
    //OUTPUT OF SEO
    $this->outputData['page_title'] = 'Tra cứu kết quả đăng ký';
    $this->outputData['meta_keywords'] = 'Tra cứu kết quả đăng ký';
    $this->outputData['meta_description'] = 'Tra cứu kết quả đăng ký';

    $this->render_page('frontend/student/view_opening_schedule');
  }

  function examResult() {
      return [
          'processing' => 'Chưa thi',
          'pass' => 'Thi đậu',
          'fail' => 'Thi không đạt'
      ];
  }

}