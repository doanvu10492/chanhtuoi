<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;
// use Spipu\Html2Pdf\Exception\Html2PdfException;
// use Spipu\Html2Pdf\Exception\ExceptionFormatter;


class Category_products extends Admin_Controller 
{
	public $outputData;

    public function __construct()
    {
    	parent::__construct();

        if (!isAdmin())
			redirect_admin('login');

    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/category_products_model');
    }


    public function index()
    {
    	$this->outputData = [
			'pageTitle' => 'Danh sách danh mục',
			'currentPage' => 'list_products',
			'subPage'=> 'cate1',
			'list_category' => $this->tableListCategory(),
            'urlDeleteAll' => admin_url('category_products/del_list_choose')
		];

	    $this->render('admin/category_products/list');
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

	    	if ($this->form_validation->run()) {
	    		$data = $this->input->post();
	    		$data['updated_at'] = date('Y-m-d H:i:s');
	    		unset($data['id']);

             	if ($id == 0) {
             		$data['created_at'] = date('Y-m-d H:i:s');
             		$this->category_products_model->insertData($data);
		    		$message = 'Bạn vừa thêm 1 danh mục mới';
		    		
		    	} else {
		    		$key = array('id_cate' => $id);
		    		$this->category_products_model->updateData($key, $data);
		    		$message = 'Cập nhập danh mục thành công !';
		    	}

		    	$this->session->set_flashdata('flash_message', $message);		    	
	    		
	    		redirect_admin('category_products');
	    	}

	    }

	    if ($id == 0) {
	    	$pageTitle = 'Thêm mới danh mục';
	    	$subPage = 'add_category_products';
	    	$action = 'Thêm mới';
	    } else {
	    	$pageTitle = 'Cập nhật danh mục';
	    	$subPage = 'updated_products';
	    	$action = 'Cập nhập';
		    $getDetail =  $this->category_products_model->get_infor(['id_cate' => $id]);
	    }

	    $this->outputData = [
			'pageTitle' => $pageTitle,
			'currentPage' => 'list_products',
			'subPage'=> $subPage,
			'page' => $id ? $getDetail : 0,
			'id' => $id,
			'option' => $this->select_option->dropdown(
				['table' => TB_CGR_PRODUCTS], 
				'', 
				'',  
				$id ? $getDetail->id_parent : '' 
			),
			'action' => $action,
		];
	    
		$this->render('admin/category_products/update');
    }

    /**
    * Check parent
    */
    public function check_parent() 
    {
        if ($this->input->post('id') > 0 ) {
            if ( $this->input->post('id') == $this->input->post('id_parent')) {
                $this->session->set_flashdata('error_message','Bài viết không xác định được danh mục');
                return FALSE;
            }
            return TRUE;
        }
        return TRUE;
    }

    public function delete($id)
    { 
    	$get_infor = $this->category_products_model->get_infor(['id_cate' => $id]);
		$this->category_products_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
		
		redirect_admin('category_products');
    }

    public function tableListCategory($parentId = 0, $string = '', $i = 0, $type = 1, $root = '')
    {
    	$getInfor =  $this->category_products_model->list_category_products(['id_parent' => $parentId] )->result();

    	$getInfor = $this->category_products_model->parse_category_data($getInfor);
    	$result = '';

    	if (count($getInfor) > 0) {
    	 	$string .= $parentId == 0 ? '' : "---";
    	 	foreach ($getInfor as $row) {
    	 		$link = base_url().$row->alias; 

    	 		if ($row->id_parent == 0 ) { 
    	 			$root = base_url() . $row->alias . '/'; 
    	 		}

    	 		$i++;
    	 		$count = $i;
    	 		$row->count = $count;
    	 		$row->string = $string;
    	 		$row->link = $link;

				$result .= $this->load->view('admin/category_products/contentTable', ['row' => $row], true);
			   	$result .= $this->tableListCategory($row->id, $string, $i, $type, $root); 
    	 	}
    	 }
    	
    	return $result;
    }

    public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->category_products_model, ['id_cate' => $id]);
    }

    public function delListChoose()
    {
    	$this->delListChooseAdmin($this->category_products_model);
           
        echo json_encode(['result' => admin_url('category_products')]); exit(); 
    }
}