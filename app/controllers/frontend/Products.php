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

		$this->secondSegment = [];
	}

	public function index()
    {
        $urlSegmentOne = $this->uri->segment(1);
        $getRequest = $this->input->get();
        $condition = [];

        if ($urlSegmentOne != 'tim-kiem') {
            $condition['alias_cate'] = $urlSegmentOne;
        } 

        foreach ($getRequest as $key => $value) {
            if ($value && in_array($key, $this->searchKeys)) {
                $condition[$key] = $value;
            }
        }

        $allProducts = $this->getCollection($condition);

        $this->_total = count($allProducts);
        $this->getLimit();

        $_outputData = [
            'pagination' => $this->getPagination(),
            'total_products' => $this->_total,
            'list_products' => $this->getCollection($condition, $this->limit),
            'breadcrumb' =>  __breadcrumb('', $this->secondSegment),
            'option' => $this->select_option->dropdown(
                ['table' => "{$this->tableCategory}"], 
                '', 
                '',
                isset($getRequest['id_cate']) ? $getRequest['id_cate'] : ''
            ), 
            'categories' => $this->category_products_model->get_list_category(),
            'current_page' => $this->currentPage,
            'getRequest' => $getRequest
        ];
        
        $this->outputData = array_merge($this->outputData, $_outputData);
        $menu = $this->menu_model->getDetailData( ['alias' => 'home'] );
        $this->metaSeo($menu);
        
        $this->loadTheme('list');
	}

    /*
    * load products has sample category
    */
	public function category()
    {
		$urlSegmentOne = $this->uri->segment(1);
        $condition = []; 

		$alias = $urlSegmentOne;

        $category = $this->category_products_model->viewDetail(
            ["{$this->tableCategory}.alias" => $urlSegmentOne],
            $this->tableCategory 
        );
		
		if ( ! $category ) { 
            $metaSeo = [
                'title' => 'Không tìm thấy nội dung',
                'keyword' => '',
                'description' => '',
            ];

            $this->outputData['current_page'] = 'notfound';
            $this->render_page('frontend/errors/notfound');
            
            return;
        }

		$listIdCate = $this->category_products_model->get_cate_child($category['id']);
		$this->outputData['idRoot'] = $this->findParentRoot($category['id_parent']);
		$queryString = '';

		$uri = base_url() . $urlSegmentOne;

        $total = count($this->getCollection($condition, '', $listIdCate));

        $data = [
        	'base_url' => $uri . $queryString,
        	'total' => $total
        ];

        $this->getPagination($data);
		
        $this->outputData['list_products'] = $this->getCollection($condition, $limit, $listIdCate, $urlSegmentOne);
       
		$secondSegment = [
			'name' => __translate('products'), 
			'link' => './san-pham.html' 
		];

        $this->outputData['breadcrumb'] = __breadcrumb(
            $this->listCateParent($listIdCate), 
            $this->secondSegment
        );

		$this->outputData['tags_products'] = $this->tags_model->get_list_tags_products();
        $this->outputData['category'] = $category;
        $this->outputData['id_parent'] =  $category['id_parent'] ? $category['id_parent'] : $category['id'];
        $this->metaSeo($category);
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
        $id = getIdFromUrl($this->uri->segment(1), 'd');

        if ( ! $this->products_model->check_exists(['id' => $id]) ) {
        	show_404();
        }

		$detail = $this->products_model->view_product(["{$this->table}.id" => $id] );
		$stringCateIds = $this->category_products_model->get_cate_child($detail['id_cate']);
        
        $this->outputData['breadcrumb'] = __breadcrumb(
            $this->listCateParent($stringCateIds), 
            $this->secondSegment,  
            $detail['name']
        );
		$this->outputData['current_page'] = $this->uri->segment(1);
        $this->outputData['detail'] = $detail;
        $this->outputData['idRoot'] = $this->findParentRoot($detail['id_cate']);
        $this->outputData['tags_products'] = $this->tags_model->get_list_tags_products();
        $this->outputData['other_products'] = $this->products_model->list_products( 
        	[
                "id_cate" => $detail['id_cate'], 
        		"id !="  => $id
            ], 
        	[6]
        );
        
        $this->metaSeo($detail);
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

		$listCategoryParent = $this->category_products_model->list_category_products('', '', '', '', $cateId );

		return $listCategoryParent;
    } 

    /*
    * parse string link url 
    * @param int $url_id
    * @return int $id
    */
    protected function getSegmentId($urlId)
    {
    	$segment = explode('-', $urlId);
		$id = end($segment);
        
		return (int) $id;
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

    protected function getCollection($condition = array(), $limit = array(), $stringCateIds = '')
    {
        $collection = $this->products_model->list_products(
            $condition, 
            $limit, 
            '',  
            $stringCateIds 
        );

        return $collection;
    }
}