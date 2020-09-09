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
	 * @param	nil
	 * @return	void
	 */	
	function index()
	{
		$this->generateFormKey();
		$this->postsGuide();	
		$this->productBest();
		$this->productSales();
		$this->productNew();
		$this->partner();
		$this->getAds();
        $this->_metaSeo();
        $this->getEightRoundInRegister();
        $this->getTrainingTypes();
        $this->output->cache(5);
        $this->getAdsHome();
        $this->pageHighlight();	
        $this->listFourCategories();
        $this->loadTheme('home');
       
	} 

	protected function pageHighlight()
	{
		$this->outputData['pageHighlight'] = $this->page_model->listPages('', array(4), '', '', TB_PAGES.'.ordering asc');
	}

	protected function partner()
	{
		$cateImgPartner = $this->page_model->view_category_album('', array(TB_CGR_ALBUM.'.type' => 'partner')); 

		if ($cateImgPartner) {
			$this->outputData['partner'] = $this->page_model->listAlbum([TB_ALBUM.'.id_cate' => $cateImgPartner['id']]);
		}
	}

	protected function getAds()
	{
		$cateImgPartner = $this->page_model->view_category_album('', array(TB_CGR_ALBUM.'.type' => 'round-img')); 

		if($cateImgPartner) {
			$this->outputData['listAds'] = $this->page_model->list_album('', array(2), array(TB_ALBUM.'.id_cate' => $cateImgPartner['id']));
		}
	}

	protected function productBest()
	{
		$data = $this->products_model->list_products(array('isHighlight' => IS_HIGHLIGHT), array(8));

		$this->outputData['productBest'] = $data; 
	}
	protected function productNew()
	{
		$data = $this->products_model->list_products(array('isNew' => IS_HIGHLIGHT), array(8));

		$this->outputData['productNew'] = $data; 
	}
	protected function productSales()
	{
		$data = $this->products_model->list_products(array('isSale' => IS_HIGHLIGHT), array(8));

		$this->outputData['productSales'] = $data; 
	}

	protected function postsGuide()
	{
		$data = $this->page_model->listPosts(array(TB_POSTS.'.isHighlight' => IS_HIGHLIGHT, TB_POSTS.'.type' => 'posts'), array(3));	
		$this->outputData['postsGuide'] = $data;
	}

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
		$this->render_page('frontend/layout/'.$theme);
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
		$cateAdsHome = $this->page_model->view_category_album(['type' => 'ads']); 

        if ($cateAdsHome) {
            $this->outputData['adsHome'] = $this->page_model->listAlbum([TB_ALBUM.'.id_cate' => $threeCateBanner['id']], [2]);
        }
	}

	protected function getEightRoundInRegister()
	{
		$category = $this->page_model->view_category_posts('', array(
			TB_CGR_POSTS.'.module' => 4,
			TB_CGR_POSTS.'.active' => 1,
			TB_CGR_POSTS.'.isHome' => 1
		));
		
		if ($category) {
			$category['posts'] =  $this->page_model->listPosts(array(
				TB_POSTS.'.isHighlight' => IS_HIGHLIGHT, 
				TB_POSTS.'.type' => 'posts',
				TB_POSTS.'.id_cate' => $category['id']
			), array(8));
		}

		$this->outputData['eightRoundInRegister'] = $category;
	}

	protected function getTrainingTypes() {
		$category = $this->page_model->view_category_posts('', array(
			TB_CGR_POSTS.'.module' => 3,
			TB_CGR_POSTS.'.active' => 1,
			TB_CGR_POSTS.'.isHome' => 1

		));
		
		if ($category) {
			$category['posts'] =  $this->page_model->listPosts('', array(4), array(
				TB_POSTS.'.isHighlight' => IS_HIGHLIGHT, 
				TB_POSTS.'.type' => 'posts',
				TB_POSTS.'.id_cate' => $category['id']
			), 
			'',
			TB_POSTS.'.number asc');
		}

		$this->outputData['trainingTypes'] = $category;
	}

	protected function listFourCategories() {
		$categories = $this->page_model->list_category_posts('', '', '', '', array(
			TB_CGR_POSTS.'.module' => 2,
			TB_CGR_POSTS.'.active' => 1,
			TB_CGR_POSTS.'.isHome' => 1
		));
		$data = [];
		foreach ($categories as $cate) {
			$cate['posts'] =  $this->page_model->listPosts(array(
				TB_POSTS.'.isHighlight' => IS_HIGHLIGHT, 
				TB_POSTS.'.type' => 'posts',
				TB_POSTS.'.id_cate' => $cate['id']
			), array(4));

			$data[] = $cate;
		}

		$this->outputData['fourCategories'] = $data;
	}

}

//End Buyer Class
//------------------------------------------------------------------------------
/* End of file welcome.php */
/* Location: ./system/app/controllers/Home.php */