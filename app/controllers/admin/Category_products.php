<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Spipu\Html2Pdf\Html2Pdf;

class Category_products extends Admin_Controller 
{
	public $outputData;
    protected $_type = 'product';
    
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
        $this->load->model('backend/category_products_related_model');

        $this->_type = $this->uri->segment(2) === 'category_coupon' ? 'coupon' : 'product';

        switch ($this->uri->segment(2)) {
            case 'category_coupon':
                $this->_type = TYPE_COUPON;
                break;

            case 'coupon_source':
                $this->_type = TYPE_SOURCE;
                break;
            
            default:
                $this->_type = TYPE_PRODUCT;
                break;
        }
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

	    $this->loadTheme('list');
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

                $arrParentIds = $this->input->post('parent_id');
                unset($data['parent_id']);

                $data['alias'] = $this->createAliasName();
                $data['type'] = $this->_type;

             	if ($id == 0) {
             		$data['created_at'] = date('Y-m-d H:i:s');
             		$id = $this->category_products_model->insertDataId($data);
		    		$message = 'Bạn vừa thêm 1 danh mục mới';
		    		
		    	} else {
		    		$key = array('id_cate' => $id);
		    		$this->category_products_model->updateData($key, $data);
		    		$message = 'Cập nhập danh mục thành công !';
		    	}

                // $this->category_products_related_model->deleteData(['id_cate' => $id]);

                // if (is_array($arrParentIds) && $arrParentIds) {
                //     foreach ($arrParentIds as $key => $value) {
                //         $this->category_products_related_model->insertData([
                //             'id_cate' => $id, 
                //             'parent_id' => $value 
                //         ]);
                //     }
                // } else {
                //     $this->category_products_related_model->insertData([
                //         'id_cate' => $id, 
                //         'parent_id' => 0 
                //     ]);
                // }

		    	$this->session->set_flashdata('flash_message', $message);		    	
	    		
	    		redirect_admin($this->uri->segment(2));
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
				['table' => TB_CGR_PRODUCTS, 'where' => ['type' => $this->_type]], 
				'', 
				'',  
				$id ? $getDetail->id_parent : '' 
			),
			'action' => $action,
		];
	    
		$this->loadTheme('update');
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
		
		redirect_admin($this->uri->segment(2));
    }

    public function tableListCategory($parentId = 0, $string = '', $i = 0, $type = 1, $root = '')
    {
    	$getInfor =  $this->category_products_model->list_category_products([
            'id_parent' => $parentId,
            'type' => $this->_type
        ])->result();

    	$getInfor = $this->category_products_model->parse_category_data($getInfor);
    	$result = '';

    	if (count($getInfor) > 0) {
    	 	$string .= $parentId ? '------' : '';
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

                $linkContentTable = 'admin/' . $this->uri->segment(2) . '/contentTable';
				$result .= $this->load->view($linkContentTable, ['row' => $row], true);
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

    public function loadTheme($theme = '')
    {
        $this->render('admin/' . $this->uri->segment(2) . '/' . $theme);
    }
}