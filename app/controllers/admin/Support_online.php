<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support_online extends Admin_Controller 
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
		$this->load->model('backend/support_online_model');
        $this->load->library('Upload_library');
    }

    function index()
    {
        $list = $this->support_online_model->list_support_online()->result();
        //parse data
        $list = $this->support_online_model->parse_support_online_data($list);
    	$this->outputData = array(
			'pageTitle' => 'Hỗ trợ trực tuyến',
			'currentPage' => 'support_online',
			'subPage'=> 'support_online',
			'pages' => $list
			
		);

	    $this->render('admin/support_online/list');

    }

    

    function updated($id)
    {
        
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	  
		$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
       
    	if ($this->form_validation->run()) {
    		$this->save($id);
	    }
	    
        if ($id == 0) {
	    	//add link
             $this->outputData = array(
				'pageTitle' => 'Thêm mới',
				'currentPage' => 'support_online',
				'subPage'=> 'support_online',
				'id' => $id,
				'action' => 'Thêm'
			); 
	    }else{
	    	//update link
		    $get_infor =  $this->support_online_model->get_infor(array('id'=>$id));
		  
		    $this->outputData = array(
				'pageTitle' => 'Cập nhật',
				'currentPage' => 'support_online_model',
				'subPage'=> 'support_online_model',
				'page' => $get_infor,
				'id' => $id,
				'action' => "Cập nhật"
				
			);
		}
		$this->render('admin/support_online/update');

    }

    function save($id)
    {
        $data = $this->input->post();

        if ($id == 0) {
            $this->support_online_model->insertData($data);
            $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 danh mục mới');
            redirect_admin('support_online');
        } else {
            $key = array('id' => $id);
            $this->support_online_model->updateData($key, $data);
             
            $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 links mới');
        }

        redirect_admin('support_online');
    }

    

    function delete($id)
    { 
		$this->support_online_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một links');
		redirect_admin('support_online/index');		

    }
    
    function updateStatus()
    {
        $id = $this->uri->segment(4);
        // action is attribute such as : active, highlight...
        $action = trim($_POST['action']);
        //check album exist
        if ($this->support_online_model->check_exists(array('id' => $id))){
            // click ok status
            if ($_POST['active'] == 1)
            {
                $this->support_online_model->updateData(array('id' => $id), array($action => 0));
                echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
            }
            else{
                $this->support_online_model->updateData(array('id' => $id), array($action => 1));
                echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
            }
        }else{
            echo json_encode(array('error' => 'Ảnh này không tồn tại')); exit();
        }
    }


    function del_list_choose()
    {
        
        $list_id = explode(',', $_POST['list_id']);
        if (count($list_id) == 1)
        {
            $this->support_online_model->deleteData($list_id);
        }else{
            foreach ($list_id as $id) {
                if ($this->support_online_model->check_exists(array('id' => $id))){
                    $this->support_online_model->deleteData($id);
                }
                else{
                    echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
                }
                
            }
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các ảnh được chọn');   
        echo json_encode(array('result' => admin_url('support_online'))); exit(); 
    }
   

}