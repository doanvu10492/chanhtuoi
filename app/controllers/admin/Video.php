<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends Admin_Controller 
{
	public $outputData;

	function __construct()
	{
		parent::__construct();

	    // Check login admin
	    if(!isAdmin())
			redirect_admin('login');

		$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->model('backend/video_model');
	}


	function index()
	{
		// to use $_GET();
		parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
	    // variable for href
	    $queryString ='';
	    $keyword = '';
	    $id_cate = '';
	    
	    // get $_GET of the varible
		if (isset($_GET['keyword']) && ($_GET['keyword'] !=' ')) {
			$keyword = $_GET['keyword'];
			$this->outputData['keyword'] =$keyword;
			$queryString .='?keyword='.$keyword;
		}

	    // pagination
	    if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
	    	$config['uri_segment'] = $_GET['per_page'];
	        
	    } else {
	     	$config['uri_segment'] = $this->uri->segment(4);
	    }
	    
	    $list_video = $this->video_model->list_video('', '', $keyword )->result();
	    $this->load->library('pagination');
	    $config['page_query_string'] = TRUE;
		$config['base_url'] = './admin/video/index.html'.$queryString;
		$config['total_rows'] = count($list_video);
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
	    
		// get video list
	    $list_video = $this->video_model->list_video($config['per_page'], $config['uri_segment'], $keyword, $id_cate)->result();

	    $list_video = $this->video_model->parse_video_data($list_video);

	    // assign queryString to backfor edit action
	    $this->my_session->_session_back_link($queryString);


		$this->outputData = array(
			'pageTitle' => 'Danh sách video',
			'currentPage' => 'video',
			'subPage'=> 'list_video',
			'pages' => $list_video,
			'keyword' => $keyword,
			'pagination' => $pagination
			
		);

	    $this->render('admin/video/list');
	}

	function updated($id)
	{
	    $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	    if ($this->input->post('update_video')) {
			$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
			$this->form_validation->set_rules('code','lang:site_title_validation', 'trim|required|xss_clean');

	    	if ($this->form_validation->run()) {

	            $active = ($this->input->post('active') > 0 ) ? ('1') : ('0');  
	    		$data = array(
	    			'name' => $this->input->post('name'),
	    			'alias' => url_alias( $this->input->post('name') ),
	    			
	    			'code' => $this->input->post('code'),
	                'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
	                'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
	               
	    		);

	    		if($id == 0) {
					//add
	                $this->video_model->insertData($data);
	    			$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 video mới');
				} else {
					//update
		            $key = array('id' => $id);
		    		$this->video_model->updateData($key, $data);
		    		$this->session->set_flashdata('flash_message','Cập nhật video thành công !');
		    	}

	    		redirect_admin('video');
	    	}
	    }

	    if($id == 0) {
			//add
			$this->outputData = array(
				'pageTitle' => 'Thêm video mới',
				'currentPage' => 'video',
				'subPage'=> 'video',
				'id' => $id
			);
		} else {
			//update
		    $get_infor =  $this->video_model->get_infor(array('id'=>$id));
		    $this->outputData = array(
				'pageTitle' => 'Chỉnh sửa video',
				'currentPage' => 'video',
				'subPage'=> 'video',
				'page' => $get_infor,
				'id' => $id
			);
		}

		$this->render('admin/video/update');
	}

	function delete($id)
	{ 
		$this->video_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một video');

		redirect_admin('video/index');		
	}

	function updateStatus() {
    	$id = $this->uri->segment(4);

    	// action is attribute such as : active, highlight...
    	$action = trim($_POST['action']);

    	// check product exist
    	if ($this->video_model->check_exists(array('id' => $id))) {
    		// click ok status
	    	if ($_POST['active'] == 1) {
	    		$this->video_model->updateData(array('id' => $id), array($action => 0));
	    		echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
	    	} else {
	    		$this->video_model->updateData(array('id' => $id), array($action => 1));
	    		echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
	    	}
    	} else {
    		echo json_encode(array('error' => 'Bài viết này không tồn tại')); exit();
    	}
    }


    function del_list_choose()
    {
    	$list_id = explode(',', $_POST['list_id']);
    	
    	if (count($list_id) == 1)
    	{
    		$this->video_model->deleteData($list_id);
    	} else {
	    	foreach ($list_id as $id) {
	    		if ($this->video_model->check_exists(array('id' => $id))) {
	    			$this->video_model->deleteData($id);
	    		} else {
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
			    
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục sản phẩm');   
        echo json_encode(array('result' => admin_url('video'))); exit(); 
    }
}