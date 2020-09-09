<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends Admin_Controller 
{
	public $outputData;

	public $limit = array();
	/*
	* String after link
	*/
	public $queryString = null;

	/*
	* per_page
	*/
	public $perPage;

	/*
	* id_cate
	*/
	public $cateId;

	/*
	* numberPage
 	*/
 	public $numberPage = 20;

	/*
	* keyword to search
	*/
	public $keyword;
	/*
	* Condition to search
	*/
	public $condition = array();

	/*
	* Current page products
	*/
	public $currentPage = 'products';

    /**
    * Search keys prepare 
    */
    public $searchKeys = ['id_cate', 'keyword'];

	/*
	* Total product in table
	*/
	public $_total = 0;

    public function __construct()
    {
    	parent::__construct();

        if(!isAdmin())
			redirect_admin('login');

    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation', $this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model( 'backend/products_model');
		$this->load->model('backend/tags_model');
    }

    public function index()
    {  
        $condition = []; 
        $getRequest = $this->input->get();

        foreach ($getRequest as $key => $value) {
            if ($value && in_array($key, $this->searchKeys)) {
                $condition[$key] = $value;
            }
        }

    	$this->getLimit();
        $this->_total = count($this->products_model->list_products($condition)->result());
        
		$pagination = $this->getPagination();

        $collection = $this->products_model->list_products($condition, $this->limit)->result();
        $listProducts = $this->products_model->parse_products_data($collection);

        $optionCategoryProduct = $this->select_option->dropdown(['table' => TB_CGR_PRODUCTS], '', '', $this->cateId);

        // $this->session->set_userdata('query_href_back', $this->queryString);

    	$this->outputData = [
			'pageTitle' => 'Danh sách sản phẩm',
			'currentPage' => $this->currentPage,
			'subPage'=> 'list_products',
			'pages' => $listProducts,
			'pagination' => $pagination,
			'keyword' => $this->keyword,
			'option' => $optionCategoryProduct,
            'getRequest' => $getRequest
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
            )
            ->set_rules(
                'id_cate',
                'Danh mục', 
                'trim|required|xss_clean'
            )
			->set_rules(
                'images',
                'Images', 
                'callback_upload'
            );
			
	    	if ($this->form_validation->run()) {
                if ($_FILES['images']['name'] != NULL) {
                    $images = $_SESSION['images'];
                } else {
                    $images = $this->input->post('images_old');
                }

	            $alias = $this->createAliasName();

                $tags = $this->input->post('tags');
                unset($data['images_old'], $data['tags']);

                $data['image'] = $images;
                $data['alias'] = $alias;
                $data['updated_at'] = date('Y-m-d H:i:s');
	    		
	    	    $productId = 0;

                if ( ! $id) {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['active'] = 1;
                	$productId = $this->products_model->insertDataId($data);
		    		$this->session->unset_userdata('images');
		    		$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 slide mới');
                } else {
                	$productId = $id;
		            $key = array('id' => $id);
		    		$this->products_model->updateData($key, $data);
		    		
                    unset($_SESSION['images']);

		    		$this->session->set_flashdata('flash_message','Bạn vừa cập nhật 1 sản phẩm');
		    	}

		    	if ($tags) {
	    			$this->saveTags($tags, $productId);
	    		}

                $this->uploadMultipleImg($productId);

	    		redirect_admin('products' . $this->session->userdata('query_href_back'));
	    	}
	    }

	    if ( ! $id ) {
	    	$pageTitle = 'Thêm sản phẩm mới';
            $subPage = 'add_products';
	    } else {
		    $productDetail =  $this->products_model->get_infor(['id' => $id]);
	        $product = $this->products_model->parse_products_row($productDetail);
	        $product->tags = $this->tags_model->get_list_tags($id);
		    $cateId = count($product) > 0 && $product->id_cate > 0 ? $product->id_cate : '';
           
            $pageTitle = 'Chỉnh sửa bài viết';
		    $imgDetail = $this->products_model->get_img_detail(['id_product' => $id]);
            $subPage = 'updated_products';
		}

        $optionCategories = $this->select_option->dropdown(
            ['table' => TB_CGR_PRODUCTS], 
            '', 
            '', 
            $id ? $product->id_cate : '', 
            $id ? $product->type : ''
        );

        $this->outputData = [
            'pageTitle' => $pageTitle,
            'currentPage' => $this->currentPage,
            'subPage'=> 'add_products',
            'id' => $id,
            'page' => $id ? $product : '',
            'option' => $this->select_option->dropdown(['table' => TB_CGR_PRODUCTS], '', '', '' ,1),
            'listColor' => $this->products_model->getListColor(),
            'imgDetail' => $id ? $imgDetail : '',
        ];

		$this->loadTheme('update');
    }

    /**
    * save tags
    *
    * @param string $tags
    * @param int $productId
    * @return void
    */
    public function saveTags($tags = '', $productId) 
    {
    	$arrTags = explode(',', $tags);

    	foreach ($arrTags as $tag) {
    		$tagItem = trim(url_alias($tag));

    		// check tags exist
    		if ( ! $this->tags_model->check_exists(array(TB_TAGS.'.alias'=> $tagItem))) {
    			$tagId = $this->tags_model->insertDataId(['alias' => $tagItem, 'name_tags'=> $tag ]);
    			$this->tags_model->insert_tags_product(['id_product' => $productId, 'id_tags' => $tagId]);
    		} else {
    			$tagInfor = $this->tags_model->get_infor([TB_TAGS.'.alias' => $tagItem]);
    			
    			// check tags products exist
    			if( ! $this->tags_model->check_tag_product_exist(array('id_tags' => $tagInfor->id_tags, 'id_product' => $productId )))
    			{
                    $this->tags_model->insert_tags_product(array('id_product' => $productId, 'id_tags' => $tagInfor->id_tags));
    			}

    		}
    	}
    }

    public function delete($id)
    { 
    	$product = $this->products_model->get_infor(array('id'=> $id));
    	$product = $this->products_model->parse_products_row($product);
        
        // delete img avatar of product
    	if (realpath($product->image_path))	{
    		unlink(realpath($product->image_path));

    		if(realpath($product->image_path2)) {
    			unlink(realpath($product->image_path2));
    		}
    		
    	}

        // delete detail images of product
        $listImgDetail = $this->products_model->get_img_detail(array('id_product' => $id));

        if (count($listImgDetail) > 0) {
        	foreach ($listImgDetail as $row) {
        		unlink(realpath($row['image']));
        		// delete image in database
        		$this->products_model->delete_img_detail(array('id_image' => $row['id_image']));
        	}
        }

        // delete products in database
		$this->products_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('products/list_products');
    }

    public function upload()
    {
    	if ($_FILES['images']['name'] != "") {
            $uploadPath = IMG_PATH_PRODUCT;
            $width = $this->config->item('products_width');
            $height = $this->config->item('products_height');
    	    $fileUpload = $this->upload_library->do_upload_file($uploadPath, 'images', [$width, $height] );

    	    if ($this->input->post('images_old') != NULL) {
    	        $link_unlink = realpath(IMG_PATH_PRODUCT) . $this->input->post('images_old');
    	    }

    	    if (is_array($fileUpload) && count($fileUpload) > 0) {
    	    	$_SESSION['images'] =  $fileUpload['file_name'];

    	    	return true;
    	    } else {
    	    	$this->session->set_flashdata('error_message', $fileUpload);

    	    	return false;
    	    }
    	}

	    return true;
    }  


    public function uploadMultipleImg($productId)
    {
        if (isset($_FILES['img_detail']) && $_FILES['img_detail'] != null) {
            $uploadPath = IMG_PATH_PRODUCT_DETAIL;
            $fileUpload = $this->upload_library->multiple_upload($uploadPath, 'img_detail');

            for ($i=0; $i < count($fileUpload); $i++) {
                $this->products_model->insert_images_product([
                    'id_product' => $productId, 
                    'image' => $fileUpload[$i]
                ]);
            }
        }
    }


    public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->products_model, $id);
    }

    public function del_list_choose()
    {
        $this->delListChooseAdmin($this->products_model);
           
        echo json_encode(['result' => admin_url('products')]); exit(); 
    }

    public function delele_img_detail($idImage)
    {
    	$img = $this->products_model->get_img_detail( ['id_image' => $idImage] );
    
    	if (count($img) <= 0) {
    		redirect($_SERVER['HTTP_REFERER']);
    	}
    	
    	$unlink = realpath($img[0]['image']);

    	if($unlink) { 
    		unlink($unlink); 
    	}

        $this->products_model->delete_img_detail(['id_image' => $idImage]);
        $this->session->set_flashdata('flash_message','Bạn vừa xóa 1 ảnh của sản phẩm');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function loadTheme($theme = '')
    {
    	$this->render('admin/products/'.$theme);
    }

    public function getLimit()
    {
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
            $this->perPage = $_GET['per_page'];
        }

    	$this->limit = array($this->numberPage, $this->perPage);
    }    

    public function createAliasName()
    {
        return $this->input->post('alias') ?? url_alias($this->input->post('name'));
    }
}