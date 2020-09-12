<?php
class Slide extends Admin_Controller 
{
    // Global variable  
    public $outputData;	

    function __construct()
    {
        parent::__construct();

        // Check For Admin Logged in
        if(!isAdmin())
            redirect_admin('login');

        // Get Config Details From Db
        $this->config->db_config_fetch();

        // Loading the lang files
        $language_code = $this->config->item('language_code');
        $this->lang->load('admin/validation',$language_code);

        // load model
        $this->load->model('backend/slide_model');
    }

    function index()
    {
    	$this->outputData = array(
    		'pageTitle' => 'Danh sách slide',
    		'currentPage' => 'slide',
    		'subPage'=> 'list_slide',
    		'pages' => $this->slide_model->parse_slide_data($this->slide_model->get_data_list()->result())
    	);

    	$this->render('admin/slide/list');
    }


    function updated($id)
    {
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

        if ($this->input->post('update_slide')) {
    		$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
        	if ($this->form_validation->run()) {
        		$data = array(
        			'name' => $this->input->post('name'),
                    'brief' => $this->input->post('brief'),
                    'link' => $this->input->post('link'),
                    'link2' => $this->input->post('link2'),
                    'link3' => $this->input->post('link3'),
                    'ordering' => $this->input->post('ordering'),
                    'image' => $this->input->post('image'),
                    'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
                    'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s'))
        		);

                if ($id == 0) {
                    //add
                    $this->slide_model->insertData($data);
                    $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 slide mới');
                } else {
                    //update
                    $key = array('id' => $id);
            		$this->slide_model->updateData($key, $data);
            		$this->session->set_flashdata('flash_message','Bạn vừa cập nhật 1 slide mới');
                }

        		redirect_admin('slide');
        	}

        }

        if ($id == 0) {
            //add
            $this->outputData = array(
                'pageTitle' => 'Thêm slide mới',
                'currentPage' => 'slide',
                'subPage'=> 'add_slide',
                'action' => 'Thêm',
                'id' => $id
            );
        } else {
            //update
            $this->outputData = array(
        		'pageTitle' => 'Thêm slide mới',
        		'currentPage' => 'slide',
        		'subPage'=> 'add_slide',
        		'page' => $this->slide_model->get_infor(array('id' => $id)),
                'action' => 'Cập nhật',
                'id' => $id
        	);
        }

    	$this->render('admin/slide/update');
    }

    function delete($id)
    {
    	$this->slide_model->deleteData($id);
    	$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
    	redirect('admin/slide');
    }


    public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->slide_model, $id);
    }

    public function del_list_choose()
    {
        $this->delListChooseAdmin($this->slide_model);
           
        echo json_encode(['result' => admin_url('slide')]); exit(); 
    }
}
