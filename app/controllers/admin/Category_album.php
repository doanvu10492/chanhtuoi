<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_album extends Admin_Controller 
{
	public $outputData;

    public function __construct()
    {
    	parent::__construct();

        if(!isAdmin())
			redirect_admin('login');
    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/category_album_model');
    }

    public function index()
    {
    	$this->outputData = array(
			'pageTitle' => 'Danh sách danh mục',
			'currentPage' => 'album',
			'subPage'=> 'category_album',
			'list_category' => $this->tableListCategory()
			
		);

	    $this->render('admin/category_album/list');
    }

    public function updated($id)
    {
        $this->form_validation->set_error_delimiters(
        	$this->config->item('field_error_start_tag'), 
        	$this->config->item('field_error_end_tag')
        );

	    if ($data = $this->input->post()) {
			$this->form_validation->set_rules(
				'name',
				'lang:site_title_validation', 
				'trim|required|xss_clean'
			);

			$data['alias'] = url_alias($this->input->post('name'));

	    	if ($this->form_validation->run()) {
	    		$data['updated_at'] = date('Y-m-d H:i:s');
                
                if ($id == 0) {
                	$data['created_at'] = date('Y-m-d H:i:s');
                    $this->category_album_model->insertData($data);
	    			$message = 'Bạn vừa thêm 1 danh mục mới';
                } else {
                	$key = array('id_cate' => $id);
		    		$this->category_album_model->updateData($key, $data);
		    		$message = 'Cập nhật danh mục thành công !';
                }

                $this->session->set_flashdata('flash_message', $message);
	           
	    		redirect_admin('category_album');
	    	}
	    }

	    if ( ! $id) {
	    	$pageTitle = 'Thêm danh mục mới';
	    	$subPage = 'category_album';
	    	$action = 'Thêm mới';
	    } else {
	    	$pageTitle = 'Chỉnh sửa danh mục bài viết';
	    	$subPage = 'updated_posts';
	    	$action = 'Cập nhật';
	    	$getInfo =  $this->category_album_model->get_infor(array('id_cate'=>$id));
	    }

	    $parentId = $id ? $getInfo->id_parent : '';
		$option = $this->select_option->dropdown(['table' => TB_CGR_ALBUM]);

	    $this->outputData = [
			'pageTitle' => $pageTitle,
			'currentPage' => 'category_album',
			'subPage'=> $subPage,
			'id' => $id,
			'page' => $id ? $getInfo : [],
			'action' => $action,
			'option' => $this->select_option->dropdown(
				['table' => TB_CGR_ALBUM ],
				'',
				'',
				$parentId
			)
		];
	    
		$this->render('admin/category_album/update');
    }
  
    public function delete($id)
    { 
		$this->category_album_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
		redirect_admin('category_album');		

    }

    public function tableListCategory($parentId = 0, $string = '', $i = 0)
    {
    	$collection =  $this->category_album_model->listCategory()->result();
    	$getData = $this->category_album_model->parseCategoryData($collection);

    	$result = '';

    	if (count($getData) > 0) {
    	 	$string .= $parentId == 0 ? '' : "----";
    	 	foreach ($getData as $row) {
    	 		$link = base_url() . $row->alias; 

    	 		if ($row->id_parent == 0 ) { 
    	 			$root = base_url() . 'thu-vien-anh/' . $row->alias . '/'; 
    	 		}

    	 		$count = ++$i;
    	 		$row->count = $count;
    	 		$row->string = $string;
    	 		$row->link = $link;

				$result .= $this->load->view('admin/category_album/contentTable', ['row' => $row], true);
    	 	}
    	 	
    	}
    	
    	return $result;
    }


	public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->category_album_model, ['id_cate' => $id]);
    }

    public function delListChoose()
    {
    	$this->delListChooseAdmin($this->category_album_model);
           
        echo json_encode(['result' => admin_url('category_album')]); exit(); 
    }
}