<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posts extends Admin_Controller 
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
	* Current page posts
	*/
	public $currentPage = 'posts';

    /**
    * Search keys prepare 
    */
    public $searchKeys = ['id_cate', 'keyword'];


    public function __construct()
    {
    	parent::__construct();

        if(!isAdmin())
			redirect_admin('login');

    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model(array('backend/tags_model', 'backend/posts_model'));
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
        $this->_total = count($this->posts_model->list_posts($condition)->result());
		$pagination = $this->getPagination();
        $collection = $this->posts_model->list_posts($condition, $this->limit)->result();
        $listPostData = $this->posts_model->parse_posts_data($collection);
	    
    	$this->outputData = [
			'pageTitle' => 'Danh sách bài viết',
			'currentPage' => 'posts',
			'subPage'=> 'posts',
			'pages' => $listPostData,
			'option' => $this->select_option->dropdown(
				['table' => TB_CGR_POSTS], 
				'', 
				'', 
				isset($getRequest['id_cate']) ? $getRequest['id_cate'] : ''
			),
			'pagination' => $pagination,
			'sort_field' => $this->session->userdata('posts_field'),
            'icon_sort' => ($this->session->userdata('posts_sort') == 'desc') ? ('<i class="fa fa-sort-up" aria-hidden="true"></i>') : ('<i class="fa fa-sort-desc" aria-hidden="true"></i>'),
            'getRequest' => $getRequest
		];

	    $this->render('admin/posts/list');
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
				$images = $_FILES['images']['name'] != NULL
							? ( $_SESSION['images']) 
							: ($this->input->post('images_old'));
                
                $tags = $this->input->post('tags');
                $data['image'] = $images;
                $data['alias'] = $this->createAliasName();

                unset($data['tags'], $data['images_old']);
                $data['updated_at'] = date('Y-m-d H:i:s');

                if ($id == 0) {
                	$data['created_at'] = date('Y-m-d H:i:s');
                	$postId = $this->posts_model->insertDataId($data);
		    		$this->session->unset_userdata('images');
		    		$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 bài viết mới');
                } else {
                	$postId  = $id;
	                $key = array('id' => $id);
		    		$this->posts_model->updateData($key, $data);
		    		unset($_SESSION['images']);
		    		$this->session->set_flashdata('flash_message','Cập nhật bài viết thành công !');
                }	

                if ($id) {
                	$this->tags_model->delete_tags_product(['id_posts' => $postId]);
                }

	    		if ($tags) {
	    			$this->saveTags($postId);
	            } 
            
	    		redirect_admin('posts' . $this->session->userdata('query_href_back'));
	    	}

	    }

		if ($id == 0) {
	    	$pageTitle = 'Thêm bài viết mới';
	    	$subPage = 'add_posts';
	    	$action = 'Thêm mới';
	    } else {
	    	$pageTitle = 'Chỉnh sửa bài viết';
	    	$subPage = 'posts';
	    	$action = 'Cập nhật';
	    	$getDetail =  $this->posts_model->get_infor(array('id'=>$id));
	        $getDetail = $this->posts_model->parse_posts_row($getDetail);
	        $getDetail->tags = $this->tags_model->get_list_tags_posts($id);
	    }

		$this->outputData = [
			'pageTitle' => 'Chỉnh sửa bài viết',
			'currentPage' => $this->currentPage,
			'subPage'=> 'posts',
			'page' => $id ? $getDetail : '',
			'action' => 'Cập nhật',
			'id' => $id,
		    'option' => $this->select_option->dropdown(
		    	['table' => TB_CGR_POSTS], 
		    	'', 
		    	'',
		    	$id ? $getDetail->id_cate : ''
		    )
		];

		$this->render('admin/posts/update');
    }

    public function delete($id)
    { 
 		$posts = $this->posts_model->get_infor(['id'=> $id]);
    	$posts = $this->posts_model->parse_posts_row($posts);

		//delete img avatar of posts
    	if (realpath($posts->image_path)) {
    		unlink(realpath($posts->image_path));
    	}

    	$this->posts_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
		unset($posts);

		redirect_admin('posts');		
    }

    public function upload()
    {
    	if ($_FILES['images']['name'] != "") {
            $path = IMG_PATH_POSTS;
            $width = $this->config->item('posts_width');
            $height = $this->config->item('posts_height');
    	    $file = $this->upload_library->do_upload_file($path, 'images', [$width, $height] );

    	    if ($this->input->post('images_old')) {
    	        $link_unlink = realpath(IMG_PATH_POSTS).$this->input->post('images_old');
    	    }

    	    if (is_array($file) && count($file) > 0) {
    	    	$_SESSION['images'] =  $file['file_name'];
    	    	return true;
    	    } else {
    	    	$this->session->set_flashdata('error_message', $file);
    	    	return false;
    	    	
    	    }
    	}

	    return true;
    }

     public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->posts_model, $id);
    }

    public function del_list_choose()
    {
        $this->delListChooseAdmin($this->posts_model);
           
        echo json_encode(['result' => admin_url('posts')]); exit(); 
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
        return $this->input->post('alias') 
            ? $this->input->post('alias') 
            : url_alias($this->input->post('name'));
    }  

    protected function saveTags($postId) 
    {
    	$tags = explode(",", $this->input->post('tags'));

    	for ($i = 0; $i < count($tags); $i++) {
    		$tag_item = trim(url_alias($tags[$i]));

    		if (!$this->tags_model->check_exists([TB_TAGS . '.alias'=> $tag_item])) {
    			$id_tag = $this->tags_model->insertDataId(['alias' => $tag_item, 'name_tags'=> $tags[$i]]);
                //id of posts update or add news, 
    			$this->tags_model->insert_tags_posts(['id_posts' => $postId, 'id_tags' => $id_tag]);
    		} else {
    			$tag_infor = $this->tags_model->get_infor(array(TB_TAGS.'.alias' => $tag_item));

    			if(!$this->tags_model->check_tag_posts_exist(array('id_tags' => $tag_infor->id_tags, 'id_posts' => $postId ))) {
    				//add tags posts new
                     $this->tags_model->insert_tags_posts(array('id_posts' => $postId, 'id_tags' => $tag_infor->id_tags));
    			}

    		}
    	}
    }
}