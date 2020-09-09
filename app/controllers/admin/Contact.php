<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends Admin_Controller 
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
		$this->load->model('backend/contact_model');
    }

    function index()
    {
    	//to use $_GET();
		parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        //variable for href
        $queryString ='';
        $keyword = '';
        $id_cate = '';
        
        //sort
        $sort = $this->sort_field->sort('contact');

        //get $_GET of the varible
		if (isset($_GET['keyword']) && ($_GET['keyword'] !=' ')) {
			$keyword = $_GET['keyword'];
			
			$this->outputData['keyword'] =$keyword;
			$queryString .='?keyword='.$keyword;
		}

        //PRODUCTS PAGINATION 
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
        	$config['uri_segment'] = $_GET['per_page'];
            
        } else {
        	$config['uri_segment'] = $this->uri->segment(4);
        }

        $limit = array();
        $limit[0] = 20;
        $limit[1] = ( isset($config['uri_segment']) ) ? ( $config['uri_segment'] ) : (0);
        
        $list_contact = $this->contact_model->list_contact('', $keyword, TB_CONTACT.'.'.$sort['field'].' '.$sort['sort'] )->result();

        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
		$config['base_url'] = './admin/contact/index.html'.$queryString;
		$config['total_rows'] = count($list_contact);
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
        
		//GET PRODUCTS LIST
        $list_contact = $this->contact_model->list_contact($limit, $keyword, TB_CONTACT.'.'.$sort['field'].' '.$sort['sort'])->result();
        //parse data
        $list_contact = $this->contact_model->parse_contact_data($list_contact);
	
	    //assign queryString to backfor edit action
	    $this->my_session->_session_back_link($queryString);


    	$this->outputData = array(
			'pageTitle' => 'Danh sách bài viết',
			'currentPage' => 'contact',
			'subPage'=> 'list_contact',
			'pages' => $list_contact,
			'pagination' => $pagination,
			'keyword' => $keyword,
			'sort_field' => $this->session->userdata('contact_field'),
            'icon_sort' => ($this->session->userdata('contact_sort') == 'desc') ? ('<i class="fa fa-sort-up" aria-hidden="true"></i>') : ('<i class="fa fa-sort-desc" aria-hidden="true"></i>')
		);

	    $this->render('admin/contact/list');
    }
    
    function updated($id)
    {
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	    if ($this->input->post('update_contact')) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists');
			
	    	if ($this->form_validation->run()) {
	            $active = ($this->input->post('active') > 0 ) ? ('1') : ('0');  
	    		$data = array(
	    			'name' => ($this->input->post('name') != NULL) ? ($this->input->post('name')) : ('1'),
	    			'email' => $this->input->post('email') ,
	                'active' => ($id > 0) ? (1) : ('0'),
	                'type' => 'email',
	                'answer' => nl2br(($this->input->post('answer') != NULL) ? ($this->input->post('answer')) : ('1')),
	                'updated_at' => date('Y-m-d H:i:s'),
	                'created_at' => date('Y-m-d H:i:s')
	    		);
                
                if ($id == 0){
                	//add
                	$this->contact_model->insertData($data);
		    	
		    		$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 bài viết mới');
                }else{
                    //updat
                	$message = '';
                	$message .= '<p>Tiêu đề:'.$this->input->post('name').'</p>';
                    $message .= '<p>Nội dung:'.$this->input->post('answer').'</p>';		
			
					$this->config->item('site_admin_mail');	  
				    $toName = $this->input->post('name');
					$toEmail = $this->input->post('email');	 
					$mailFrom = $this->config->item('site_admin_mail');//$this->config->item('site_admin_mail');	 
		            
				    $this->load->library('email');
		            
					$config['protocol'] = 'sendmail';
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$config['wordwrap'] = TRUE;  
					$this->email->initialize($config);
					 
					
					$this->email->from($mailFrom , $this->config->item('site_title'));
				
					$this->email->to($toEmail);
					$this->email->cc($mailFrom);
					
					$this->email->subject($toName);
					$this->email->message($message);
					
					if ( ! $this->email->send())
					{
						echo $this->email->print_debugger();
					}

		    		$this->contact_model->updateData(array('id' => $id) , $data);
		    		$this->session->set_flashdata('flash_message','Gửi email thành công !');
                }	            
	    		redirect_admin('contact/index'.$this->session->userdata('query_href_back'));
	    	}

	    }

	    if ($id==0){

		    $this->outputData = array(
				'pageTitle' => 'Thêm liên hệ mới',
				'currentPage' => 'contact',
				'subPage'=> 'add_contact',
				'action' => 'Thêm',
				'id' => $id
				
			);
		}else{
			$get_infor =  $this->contact_model->get_infor(array('id'=>$id));
		   
		    
		    $this->outputData = array(
				'pageTitle' => 'Chỉnh sửa',
				'currentPage' => 'contact',
				'subPage'=> 'updated_contact',
				'page' => $get_infor,
				'action' => 'Cập nhật',
				'id' => $id
			    
			);

		}

		$this->render('admin/contact/update');
    }

    /*
    /** check email exits
    */
    function check_email_exists()
    {
    	if( $this->input->post('id') == 0 && $this->contact_model->check_exists( array('email' => $this->input->post('email')) )){

    			$this->session->set_flashdata('error_message','Email này đã tồn tại vui lòng chọn email khác');

    		return FALSE;
    	}

    	return TRUE;
    }

    function delete($id)
    { 
 		$contact = $this->contact_model->get_infor(array('id'=> $id));
    	
    	$this->contact_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một email');
		unset($contact);
		
		redirect_admin('contact/index');		
    }

    

   function updateStatus()
    {
    	$id = $this->uri->segment(4);
    	// action is attribute such as : active, highlight...
    	$action = trim($_POST['action']);
    	//check product exist
    	if ($this->contact_model->check_exists(array('id' => $id))){
    		// click ok status
	    	if ($_POST['active'] == 1)
	    	{
	    		$this->contact_model->updateData(array('id' => $id), array($action => 0));
	    		echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
	    	}
	    	else{
	    		$this->contact_model->updateData(array('id' => $id), array($action => 1));
	    		echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
	    	}
    	}else{
    		echo json_encode(array('error' => 'Bài viết này không tồn tại')); exit();
    	}
    }
    
    function del_list_choose()
    {
    	$list_id = explode(',', $_POST['list_id']);
    	if (count($list_id) == 1)
    	{
    		$this->contact_model->deleteData($list_id);
    	}else{
	    	foreach ($list_id as $id) {
	    		if ($this->contact_model->check_exists(array('id' => $id))){
	    			$this->contact_model->deleteData($id);
	    		}
	    		else{
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các email');   
        echo json_encode(array('result' => admin_url('contact/index'))); exit(); 
    }
}