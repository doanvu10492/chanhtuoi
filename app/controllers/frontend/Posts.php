<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posts extends Public_Controller 
{
    public $outputData;
	public $loggedInUser;
	public $limit = array();
    public $id;
    public $table = TB_POSTS;
    public $tableCategory = TB_CGR_POSTS;
    public $currentPage = 'posts';
    public $searchKeys = ['id_cate', 'keyword', 'isHighlight', 'isSale'];
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
    public $numberPage = 15;

	public function __construct()
	{
		parent::__construct();

	    // check status of page
		if($this->config->item('site_status') == 0) {
			redirect('offline');
        }

        // load model
		$this->load->model([
			'frontend/page_model', 
			'menu_model', 
			'frontend/tags_model'
		]);

		$this->load->library('select_option');

		$this->secondSegment = [];
	}

	public function index()
    {
        $urlSegmentOne = $this->uri->segment(1);
        $condition = [];
        $getRequest = $this->input->get();

        if ($urlSegmentOne != 'tim-kiem') {
            $condition['alias_cate'] = $urlSegmentOne;
        } 

        foreach ($getRequest as $key => $value) {
            if ($value && in_array($key, $this->searchKeys)) {
                $condition[$key] = $value;
            }
        }

        $allProducts = $this->page_model->listPosts($condition);

        $this->_total = count($allProducts);
        $this->getLimit();
        $this->outputData['pagination'] = $this->getPagination();

        $this->outputData['total_posts'] = $this->_total;
        $this->outputData['listPosts'] = $this->page_model->listPosts($condition, $this->limit);
        $this->outputData['breadcrumb'] = __breadcrumb('', $this->secondSegment);
        $this->outputData['option'] = $this->select_option->dropdown(
            ['table' => "{$this->tableCategory}"], 
            '', 
            '',
            isset($getRequest['id_cate']) ? $getRequest['id_cate'] : ''
        );
    	$this->outputData['categories'] = $this->page_model->list_category_posts();
        $this->outputData['current_page'] = $this->currentPage;
        $this->outputData['getRequest'] = $getRequest; 

        $menu = $this->menu_model->getDetailData( ['alias' => 'home'] );
        $metaSeo = [
        	'title' => $menu['meta_title'],
        	'keyword' => $menu['meta_keywords'],
        	'description' => $menu['meta_keywords'],
        ];
        $this->metaSeo($metaSeo);

        //load theme
        $this->loadTheme('list');
	}

    /*
    * load posts has sample category
    */
	public function category()
    {
		$urlSegmentOne = $this->uri->segment(1);
        $condition = []; 

		$alias = $urlSegmentOne;

        $category = $this->page_model->view_category_posts(
            ["{$this->tableCategory}.alias" => $urlSegmentOne] 
        );
		
		if( ! $category ) { 
            $metaSeo = array(
                'title' => 'Không tìm thấy nội dung',
                'keyword' => '',
                'description' => '',
            );

            $this->outputData['current_page'] = 'notfound';
            $this->render_page('frontend/errors/notfound');
            return;
        }

		$listIdCate = $this->page_model->getCateChild($category['id'], TB_CGR_POSTS);
		$this->outputData['idRoot'] = $this->findParentRoot($category['id_parent']);
		$queryString = '';
		$uri = base_url() . $urlSegmentOne;

        $this->_total = count( $this->page_model->listPosts(
            $condition, 
            '', 
            '', 
            '', 
            $listIdCate, 
            $urlSegmentOne 
        ));

        $this->getLimit();
        $this->outputData['pagination'] = $this->getPagination();

        $data = [
        	'base_url' => $uri . $queryString,
        	'total' => $this->_total
        ];

        $this->getPagination($data);
		
        $this->outputData['listPosts'] = $this->page_model->listPosts(
            $condition, 
            $this->limit, 
            '', 
            '', 
            $listIdCate, 
            $urlSegmentOne 
        );
       
		$secondSegment = [
			'name' => __translate('posts'), 
			'link' => './san-pham.html' 
		];

        $this->outputData['breadcrumb'] = __breadcrumb($this->listCateParent($listIdCate), $this->secondSegment);
		$this->outputData['tags_posts'] = $this->tags_model->get_list_tags_posts();

        $this->outputData['category'] = $category;
        $this->outputData['id_parent'] =  $category['id_parent'] > 0 ? $category['id_parent'] : $category['id'];
        
        // output seo
        $metaSeo = array(
        	'title' => $category['meta_title'],
        	'keyword' => $category['meta_keywords'],
        	'description' => $category['meta_description'],
        );

        $this->metaSeo($metaSeo);
        $this->outputData['current_page'] = $this->currentPage;
        $this->loadTheme('list');
	}

    /*
    * View product detail
    *
    * @param int id 
    */
	public function view()
    {
		$segmentOne = $this->getSegmentId($this->uri->segment(1));
        $stringNumber = explode('-', $segmentOne);
        $id = (int) str_replace('p', '', end($stringNumber));

        if ( ! $this->page_model->check_exists(['id'=>$id], TB_POSTS) ) {
        	show_404();
        }

		$detail = $this->page_model->view_posts(["{$this->table}.id" => $id]);
		$string_cate = $this->page_model->getCateChild($detail['id_cate'], TB_CGR_POSTS);
        $this->outputData['breadcrumb'] = __breadcrumb($this->listCateParent($string_cate), $this->secondSegment,  $detail['name']);

        $metaSeo = [
        	'title' => $detail['meta_title'],
        	'keyword' => $detail['meta_keywords'],
        	'description' => $detail['meta_keywords'],
        ];

        $this->metaSeo($metaSeo);
		$this->outputData['current_page'] = $this->uri->segment(1);

		// get big image slider
        $this->outputData['detail'] = $detail;
        $this->outputData['idRoot'] = $this->findParentRoot($detail['id_cate']);
        $this->outputData['tags_posts'] = $this->tags_model->get_list_tags_posts();
        
        // sample posts
        $this->outputData['other_posts'] = $this->page_model->listPosts( 
        	[
                TB_POSTS . '.id_cate' => $detail['id_cate'], 
        		TB_POSTS . '.id !='  => $id
            ], 
        	[6]
        );
        
        $this->loadTheme('detail');
	}

    /*
    * Load all product in sample tag
    */
	protected function listTags()
    {
		$id_tags = explode('-', $this->uri->segment(2));
		$id_tags = end($id_tags);

        // Load pagination
	    $queryString = './'.$this->uri->segment(1).'/'.$this->uri->segment(2);
        $listTags = $this->tags_model->listPosts_tags($id_tags);
        $total = count($listTags);

        $data = array(
        	'base_url' => $uri.$queryString,
        	'total' => $total
        );

        $this->getPagination($data);
	   
	    // Out put list posts
        $this->outputData['listPosts'] = $this->tags_model->listPosts_tags($id_tags, $limit);

        $this->outputData['current_page'] = 'posts';
        $tags = $this->tags_model->get_infor( array(TB_TAGS.'.id_tags' => $id_tags ));
        $this->outputData['tags_detail'] = $tags;
      	$this->outputData['tags_posts'] = $this->tags_model->get_list_tags_posts();

        // output seo
        $metaSeo = array(
        	'title' => $tags->meta_title,
        	'keyword' => $tags->meta_keywords,
        	'description' => $tags->meta_description,
        );
        $this->metaSeo($metaSeo);
        
        // load theme
        $this->loadTheme('list');
	}

    /*
    * Comfirm code from input 
    *
    * @return json string
    */
    protected function comfirmCode()
     {
     	if($_POST['code_sale']) {
     		if($_POST['code_sale'] == $this->config->item('code_sale')) {
     			echo json_encode(array('text_sale' => "Mã khuyến mãi (".$_POST['code_sale'].") đã được xác nhận được khuyến mãi ".$this->config->item('number_sale')."%", 'number_sale' => $this->config->item('number_sale') )); exit();
     		}
     		echo json_encode(["error" => "Mã khuyến mãi này không đúng !"]); exit();
     	}

     	echo json_encode(["error" => "Vui lòng nhập Mã khuyến mãi !"]); exit();
     }


	protected function addToCart($id)
    {
    	$id = $this->uri->segment(2);

    	if(!$this->page_model->check_exists(array('id'=>$id))) {
        	show_404();
        }

    	$detail = $this->page_model->view_posts('', ["{$this->table}.id"=>$id]);
    	$this->outputData['detail'] = $detail;
    	$this->load->view('frontend/cart/cart_popup', $detail);

		exit();
    }

    /*
    * Find parent id from id_cate  
    * @param string $id_cate
    *
    * @return string
    */
    protected function findParentRoot($id_cate = '')
    {
    	$cate = $this->page_model->view_category_posts( '', array("{$this->tableCategory}.id_cate" => $id_cate) );
    	$id_parent = $id_cate;

    	if(count($cate) > 0 && $cate['id_parent'] > 0) {
			$id_parent = $cate['id_parent'];
			$cate_child = $this->page_model->view_category_posts( '', array("{$this->tableCategory}.id_cate" => $id_parent) );
            
			if(count($cate_child) > 0 && $cate_child['id'] > 0) {
				$id_parent = $this->findParentRoot( $cate_child['id']);
			}
    	}

    	return $id_parent;
    }

    /*
    * Get list category 
    * 
    * @param string $cateId
    * @return string $listCategoryParent
    */
    protected function listCateParent( $cateId = '' )
    {
        if ( ! $cateId) {
            return;
        }

		$listCategoryParent = $this->page_model->list_category_posts('', '', '', '', $cateId );

		return $listCategoryParent;
    } 

    /*
    * parse string link url 
    * @param int $url_id
    * @return int $id
    */
    protected function getSegmentId($url_id)
    {
    	$segment = explode('-', $url_id);
		$id = end($segment);
        
		return $id;
    }

    /*
    * load theme 
    * @param string $theme
    */
    protected function loadTheme($theme = '')
    {
    	$this->render_page('frontend/posts/'.$theme);
    }

    public function getLimit()
    {
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
            $this->perPage = $_GET['per_page'];
        }

        $this->limit = array($this->numberPage, $this->perPage);
    } 
}