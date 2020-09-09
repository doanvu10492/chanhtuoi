<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Products extends Public_Controller 
{
    public $outputData;
	public $loggedInUser;
	public $limit = array();
    public $id;
    public $table = TB_PRODUCTS;
    public $tableCategory = TB_CGR_PRODUCTS;
    public $currentPage = 'products';
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
    public $numberPage = 20;

	public function __construct()
	{
		parent::__construct();

	    // check status of page
		if($this->config->item('site_status') == 0) {
			redirect('offline');
        }

        // load model
		$this->load->model([
			'frontend/products_model',
			'backend/trademark_model', 
			'frontend/category_products_model', 
			'menu_model', 
			'frontend/tags_model'
		]);

		$this->load->library('select_option');

		$this->secondSegment = array(
			'name' => __translate('products'), 
			'link' => './san-pham.html' 
		);
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

        $allProducts = $this->products_model->list_products($condition);

        $this->_total = count($allProducts);
        $this->getLimit();
        $this->outputData['pagination'] = $this->getPagination();

        $this->outputData['total_products'] = $this->_total;
        $this->outputData['list_products'] = $this->products_model->list_products($condition, $this->limit);
        $this->outputData['breadcrumb'] = __breadcrumb('', $this->secondSegment);
        $this->outputData['option'] = $this->select_option->dropdown(
            ['table' => "{$this->tableCategory}"], 
            '', 
            '',
            isset($getRequest['id_cate']) ? $getRequest['id_cate'] : ''
        );
    	$this->outputData['categories'] = $this->category_products_model->get_list_category();
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
    * load products has sample category
    */
	public function category()
    {
		$urlSegmentOne = $this->uri->segment(1);
        $condition = []; 
        $limit = [];
		// to use $_GET();
		$alias = $urlSegmentOne;

        $category = $this->category_products_model->view_category(
            $this->lang_code, 
            array("{$this->tableCategory}.alias" => $urlSegmentOne) 
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

		$listIdCate = $this->category_products_model->get_cate_child($category['id']);
		$this->outputData['idRoot'] = $this->findParentRoot($category['id_parent']);
		$queryString ='';
		$uri = base_url().$urlSegmentOne;

		// load pagination
        $totalCategory = count( $this->products_model->list_products($this->lang_code, $condition, '', '', '', $listIdCate, $urlSegmentOne ) );
        $total = count($totalCategory);

        $data = [
        	'base_url' => $uri.$queryString,
        	'total' => $total
        ];

        $this->getPagination($data);
		
		// load page        
        $this->outputData['list_products'] = $this->products_model->list_products(
            $this->lang_code, 
            '', 
            $limit, 
            '', 
            '', 
            $listIdCate, 
            $urlSegmentOne 
        );
       
		// breadcrumb text_helper
		$secondSegment = [
			'name' => __translate('products'), 
			'link' => './san-pham.html' 
		];

        $this->outputData['breadcrumb'] = __breadcrumb($this->listCateParent($listIdCate), $this->secondSegment);
        $this->outputData['trademark'] = $this->trademark_model->list_trademark()->result();
		$this->outputData['tags_products'] = $this->tags_model->get_list_tags_products();

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
        // load theme
        $this->loadTheme('list');
	}

    /*
    * View product detail
    *
    * @param int id 
    */
	public function view()
    {
		$segment2 = $this->getSegmentId($this->uri->segment(2));
        $arrSegment2 = explode('-', $segment2);
        $id = end($arrSegment2);
        if ( ! $this->products_model->check_exists(['id'=>$id]) ) {
        	show_404();
        }

		$detail = $this->products_model->view_product(["{$this->table}.id" => $id] );
		$string_cate = $this->category_products_model->get_cate_child($detail['id_cate']);
        $this->outputData['breadcrumb'] = __breadcrumb($this->listCateParent($string_cate), $this->secondSegment,  $detail['name']);

        // output seo
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
        $this->outputData['tags_products'] = $this->tags_model->get_list_tags_products();
        
        // sample products
        $this->outputData['other_products'] = $this->products_model->list_products(
        	'', 
        	   ["{$this->table}.id_cate" => $detail['id_cate'], 
        		"{$this->table}.id !="  => $id], 
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
        $listTags = $this->tags_model->list_products_tags($id_tags);
        $total = count($listTags);

        $data = array(
        	'base_url' => $uri.$queryString,
        	'total' => $total
        );

        $this->getPagination($data);
	   
	    // Out put list products
        $this->outputData['list_products'] = $this->tags_model->list_products_tags($id_tags, $limit);

        $this->outputData['current_page'] = 'products';
        $tags = $this->tags_model->get_infor( array(TB_TAGS.'.id_tags' => $id_tags ));
        $this->outputData['tags_detail'] = $tags;
      	$this->outputData['tags_products'] = $this->tags_model->get_list_tags_products();

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

    	if(!$this->products_model->check_exists(array('id'=>$id))) {
        	show_404();
        }

    	$detail = $this->products_model->view_product('', ["{$this->table}.id"=>$id]);
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
    	$cate = $this->category_products_model->view_category( '', array("{$this->tableCategory}.id_cate" => $id_cate) );
    	$id_parent = $id_cate;

    	if(count($cate) > 0 && $cate['id_parent'] > 0) {
			$id_parent = $cate['id_parent'];
			$cate_child = $this->category_products_model->view_category( '', array("{$this->tableCategory}.id_cate" => $id_parent) );
            
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

		$listCategoryParent = $this->category_products_model->list_category_products($this->lang_code, '', '', '', '', $cateId );

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
    	$this->render_page('frontend/products/'.$theme);
    }

    public function getLimit()
    {
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
            $this->perPage = $_GET['per_page'];
        }

        $this->limit = array($this->numberPage, $this->perPage);
    } 
}