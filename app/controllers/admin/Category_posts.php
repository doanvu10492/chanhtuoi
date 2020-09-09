<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_posts extends Admin_Controller 
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
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/category_posts_model');
    }


    function index()
    {
    	$this->outputData = [
			'pageTitle' => 'Danh sách danh mục',
			'currentPage' => 'posts',
			'subPage'=> 'category_posts',
			'list_category' => $this->tableListCategory()
		];

	    $this->render('admin/category_posts/list');
    }

   
    function updated($id)
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
                    $this->category_posts_model->insertData($data);
	    			$message = 'Bạn vừa thêm 1 danh mục mới';
                } else {
                	$key = array('id_cate' => $id);
		    		$this->category_posts_model->updateData($key, $data);
		    		$message = 'Cập nhật danh mục thành công !';
                }

                $this->session->set_flashdata('flash_message', $message);
	           
	    		redirect_admin('category_posts');
	    	}
	    }

	    if ( ! $id) {
	    	$pageTitle = 'Thêm danh mục mới';
	    	$subPage = 'category_posts';
	    	$action = 'Thêm mới';
	    } else {
	    	$pageTitle = 'Chỉnh sửa danh mục bài viết';
	    	$subPage = 'updated_posts';
	    	$action = 'Cập nhật';
	    	$getInfo =  $this->category_posts_model->get_infor(array('id_cate'=>$id));
	    }

	    $module = $id ? $getInfo->module : '';
	    $parentId = $id ? $getInfo->id_parent : '';
	    $selectModule = $this->selectModule($module);
		$option = $this->select_option->dropdown(['table' => TB_CGR_POSTS]);

	    $this->outputData = [
			'pageTitle' => $pageTitle,
			'currentPage' => 'posts',
			'subPage'=> $subPage,
			'id' => $id,
			'page' => $id ? $getInfo : [],
			'action' => $action,
			'selectModule' => $selectModule,
			'option' => $this->select_option->dropdown(
				['table' => TB_CGR_POSTS ],
				'',
				'',
				$parentId
			)
		];
	    
		$this->render('admin/category_posts/update');
    }

    public function delete($id)
    { 
		$this->category_posts_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('category_posts');		
    }

    public function tableListCategory($parentId = 0, $string = '', $i = 0, $root = '')
    {
    	$collection =  $this->category_posts_model->listCategory(['id_parent' => $parentId])->result();
    	$getData = $this->category_posts_model->parseCategoryData($collection);

    	$result = '';

    	if (count($getData) > 0) {
    	 	$string .= $parentId == 0 ? '' : "----";
    	 	foreach ($getData as $row) {
    	 		$link = base_url() . $row->alias; 

    	 		if ($row->id_parent == 0 ) { 
    	 			$root = base_url() . $row->alias . '/'; 
    	 		}
    	 		$count = ++$i;
    	 		$row->count = $count;
    	 		$row->string = $string;
    	 		$row->link = $link;

				$result .= $this->load->view('admin/category_posts/contentTable', ['row' => $row], true);
			   	$result .= $this->tableListCategory($row->id, $string, $i, $root); 
    	 	}
    	}
    	
    	return $result;
    }


	public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->category_posts_model, ['id_cate' => $id]);
    }


    public function delListChoose()
    {
    	$this->delListChooseAdmin($this->category_products_model);
           
        echo json_encode(['result' => admin_url('category_products')]); exit(); 
    }

    protected function selectModule($seletedId = null) 
    {
        return $this->select_option->dropdownSelect(['table' => TB_MODULE], $seletedId, 'Chọn module');
    }

    public function createAliasName()
    {
        return $this->input->post('alias') 
            ? $this->input->post('alias') 
            : url_alias($this->input->post('name'));
    }
}