<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tags extends Admin_Controller 
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
		$this->load->model('backend/tags_model');
     
    }

    function index()
    {
        $list_tags = $this->tags_model->list_tags()->result();
        //parse data
        $list_tags = $this->tags_model->parse_tags_data($list_tags);
    	$this->outputData = array(
			'pageTitle' => 'Danh sách tags',
			'currentPage' => 'tags',
			'subPage'=> 'list_tags',
			'pages' => $list_tags
			
		);

	    $this->render('admin/tags/list');
    }

    function updated($id)
    {
        
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	    if ($this->input->post('update_tags'))
	    {
           
            if( $id > 0) {
                $this->form_validation->set_rules('name_tags','lang:site_title_validation', 'trim|required|xss_clean');
            } else {
			    $this->form_validation->set_rules('name_tags','lang:site_title_validation', 'trim|required|xss_clean|callback_check_tags_exist');
            }
	    	if ($this->form_validation->run()) {
	    		$data = array(
	    			'name_tags' => $this->input->post('name_tags'),
	                'alias' => url_alias($this->input->post('name_tags')),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'meta_title' => $this->input->post('meta_title'),
	    		);

                if($id == 0) {
                	$this->tags_model->insertData($data);
		    		$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 danh mục mới');
		    		redirect_admin('tags');
                } else {
		            $key = array('id_tags' => $id);
		    		$this->tags_model->updateData($key, $data);
		    		$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 tags mới');
		    	}
	    		redirect_admin('tags');
	    	}

	    }

	    if ($id == 0) {
	    	//add link
             $this->outputData = array(
				'pageTitle' => 'Thêm tags mới',
				'currentPage' => 'tags',
				'subPage'=> 'tags',
				'id' => $id,
				'action' => 'Thêm'
			); 
	    } else {
	    	//update link
		    $get_infor =  $this->tags_model->get_infor(array('id_tags'=>$id));
		   // $get_infor = $this->tags_model->parse_tags_row($get_infor);
		    $this->outputData = array(
				'pageTitle' => 'Chỉnh sửa tags',
				'currentPage' => 'tags',
				'subPage'=> 'tags',
				'page' => $get_infor,
				'id' => $id,
				'action' => "Cập nhật"
				
			);
		}

		$this->render('admin/tags/update');
    }


    function check_tags_exist() {
        if($this->tags_model->check_exists( array('alias' => url_alias( $this->input->post('name_tags')) ))) {
            return false;
        }

        return true;
    }
   

    function delete($id)
    { 
		$this->tags_model->delete_tags(array('id_tags' => $id));
        $this->tags_model->delete_tags_pr(array('id_tags' => $id));
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một tags');
		redirect_admin('tags');		
    }
    
    

    function del_list_choose()
    {
        $list_id = explode(',', $_POST['list_id']);
        
        if (count($list_id) == 1) {
            $this->tags_model->deleteData($list_id);
        } else {
            foreach ($list_id as $id) {
                if ($this->tags_model->check_exists(array('id_tags' => $id))) {
                    $this->tags_model->delete_tags(array('id_tags' => $id));
                    $this->tags_model->delete_tags_pr( array('id_tags' => $id) );
                } else {
                    echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
                }
                
            }
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các ảnh được chọn');   
        echo json_encode(array('result' => admin_url('tags'))); exit(); 
    }

}