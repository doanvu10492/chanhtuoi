<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Public_Controller 
{
    public $outputData;		
	public $loggedInUser;

	public function __construct()
	{
		parent::__construct();
		$this->config->db_config_fetch();

		// Manage site Status 
		if($this->config->item('site_status') == UN_ACTIVE)
		    redirect('offline');
	
		$this->load->model(array( 
			'frontend/page_model', 
			'frontend/category_products_model', 
			'frontend/products_model'
		));
		$this->output->cache(1);
	}
	
	/**
	 * Loads Home page of the site.
	 *
	 * @access	public
	 * @return	void
	 */	
	public function index()
	{
		$this->generateFormKey();
		$this->getCateOfHotProducts();
		$this->getAds();
        $this->_metaSeo();
        $this->output->cache(5);
        $this->getAdsHome();
        $this->getHighlightPostCategories();
        $this->getCateCoupons();
        $this->loadTheme('home');
       
	} 

	protected function getAds()
	{
		$model = $this->page_model->viewCategoryAlbum(['type' => 'round-img']); 

		if ($model) {
			$this->outputData['listAds'] = $this->page_model->listAlbum([TB_ALBUM.'.id_cate' => $model['id']], array(2));
		}
	}

	/**
	* Meta seo for homepage
	**/
	public function _metaSeo()
	{
		$menu = $this->menu_model->getDetailData( array('current_page' => 'trang-chu') );
		$this->outputData['current_page'] = 'trang-chu';
		$this->outputData['page_title'] = $this->config->item('meta_title');
		$this->outputData['meta_keywords'] = $this->config->item('meta_keywords');
		$this->outputData['meta_description'] = $this->config->item('meta_description');
	}

	protected function get_segment_id($url_id)
	{
		$id = explode($url_id);
		$id = end($id);

		return $id;
	}

	protected function loadTheme($theme = '')
	{
		$this->render_page('frontend/layout/' . $theme);
	}

	protected function setlang()
	{
		$get_lang = $this->uri->segment(2);
		$lang = ($get_lang == 'vi') ? ('vietnam') : ('english');
		$this->session->set_userdata('site_lang', $lang);
		
		redirect($_SERVER['HTTP_REFERER']);
	}

	protected function getAdsHome()
	{
		$cateAdsHome = $this->page_model->viewDetail(['type' => 'ads'], TB_CGR_ALBUM); 

        if ($cateAdsHome) {
            $this->outputData['adsHome'] = $this->page_model->listAlbum([TB_ALBUM.'.id_cate' => $cateAdsHome['id_cate']], [2]);
        }
	}

	public function getCateOfHotProducts() 
	{
		$productCategories = $this->getHighlightProductCategories();
		$arrCateIds = [];

		foreach ($productCategories as $cate) {
			$arrCateIds = $cate['id'];
		}

		$highlightProductCategories = $this->products_model->listProducts(
			['isHighlight' => 1, 'type' => 'product'], 
			array(40), 
			'', 
			'',
			$arrCateIds 
		);

		$this->outputData['cateOfHotProducts'] = [
			'cates' => $productCategories,
			'products' => $highlightProductCategories
		]; 
	}

	protected function getHighlightProductCategories()
	{
		$cates = $this->category_products_model->listCategoryProducts([
			'isHighlight' => 1,
			'type' => TYPE_PRODUCT
		], array(6));

		return $cates;
	}


	public function getHighlightPostCategories() 
	{
		$postCategories = $this->page_model->listCategoryPosts(
			['isHighlight' => 1 , 'type' => TYPE_PRODUCT ], 
			array(6)
		);

		$arrCateIds = [];

		foreach ($postCategories as $cate) {
			$arrCateIds = $cate['id'];
		}

		$highlightPostCategories = $this->page_model->listPosts(
			[TB_POSTS . '.isHighlight' => 1], 
			array(4), 
			'', 
			'',
			$arrCateIds 
		);

		$this->outputData['highlightPostCategories'] = [
			'cates' => $postCategories,
			'posts' => $highlightPostCategories
		]; 
	}


	public function getCateCoupons() 
	{
		$categories = $this->category_products_model->listCategoryProducts([
			'isHighlight' => 1,
			'type' => TYPE_COUPON
		], array(6));

		$this->outputData['cateCoupons'] = $categories; 
	}
}