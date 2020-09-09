<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posts extends Public_Controller 
{
    public $outputData;
	public $loggedInUser;

	function __construct()
	{
		parent::__construct();
		$this->config->db_config_fetch();

	    // check status of page
		if($this->config->item('site_status') == 0)
			redirect('offline');

        // load model	
        $this->load->model('frontend/tags_model');
	}

	function index()
	{
		$lang = $this->lang_code;
		// to use $_GET();
		parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        // variable for href
        $queryString ='';
        $keyword = '';
        $condition = array();

        // get $_GET of the varible
		if (isset($_GET['keyword']) && ($_GET['keyword'] !=' ')){
			$keyword = $_GET['keyword'];
			$this->outputData['keyword'] =$keyword;
			$queryString .='?keyword='.$keyword;
		}
 
        // Pagination
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
        	$config['per_page'] = $_GET['per_page'];
        } else {
        	$config['per_page'] = $this->uri->segment(4);
        }

	    $start = $this->uri->segment(2);
	    $limit = array();
	    $limit[0] = 15;
	    $limit[1] = $this->uri->segment(2);

	    // check type of posts
  	    // pagination
  	    $this->load->library('pagination');
	    $config['per_page'] = $limit[0];
	    $config['uri_segment'] = 2;
		$config['total_rows']= count($this->page_model->list_posts($lang, '', '', (isset($keyword)) ? ($keyword) : ('') ));
		$config['base_url'] = './tim-kiem/';
		$config['per_page'] = $limit[0]; 
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, './tim-kiem/');
        unset($config);

        $this->outputData['list_posts'] = $this->page_model->list_posts($lang, $limit, '', (isset($keyword)) ? ($keyword) : ('') );


        $this->outputData['number_item'] = ($limit[0] > count($this->page_model->list_posts($lang, '', '', (isset($keyword)) ? ($keyword) : ('') ))) ? (count($this->page_model->list_posts($lang, '', '', (isset($keyword)) ? ($keyword) : ('') ))) : ( $limit[0] ) ;

        $breadcrumb = '<ul class="breadcrumb">';
        $breadcrumb .= '<li><a href="/" title="Trang chủ">'.__translate('Home').'</a></li>';
        $breadcrumb .= '<li><a href="javascript:void(0)">Tìm kiếm</a></li>';
        $breadcrumb .= '<li>'.$keyword.'</li>';
    	$breadcrumb .= '</ul>';

    	$this->outputData['breadcrumb'] = $breadcrumb;
       	
       	$this->outputData['number_posts'] = count($this->page_model->list_posts($lang, '', '', (isset($_POST['keyword'])) ? ($_POST['keyword']) : ('') ));
        $this->outputData['current_page'] = $this->uri->segment(1);
        $this->outputData['keyword'] = (isset($keyword)) ? ($keyword) : ('');
        
        // output of seo
        $this->outputData['page_title'] = 'Tìm kiếm';
        $this->outputData['meta_keywords'] = 'Tìm kiếm';
        $this->outputData['meta_description'] = 'Tìm kiếm';

        $this->render_page('frontend/posts/list');
	}


	function category()
	{
		$lang = $this->lang_code;
		//segment of alias
	    $url = $this->uri->segment(1);
	    //segment of pagination
	    $start = $this->uri->segment(2);

	    // if( $start && (int)$start <=0 ) {
	    // 	$cate_detail = $this->page_model->view_category_posts(
     //      '', 
     //      [TB_CGR_POSTS.'.alias' => $start]
     //    );
	    // } else {
	    // 	$cate_detail = $this->page_model->view_category_posts(
     //      $lang, 
     //      array(TB_CGR_POSTS.'.alias' => $this->uri->segment(2))
     //    );
	    // }

      $cate_detail = $this->page_model->view_category_posts(
          '', 
          [TB_CGR_POSTS.'.alias' => $url]
        );

	    count($cate_detail) == 0 ? show_404() : '';
	    $id_cate = $cate_detail['id'];

	    //list id child
	    $list_id_child = $this->__child_cate($cate_detail['id']);
	    $list_id_child = explode(',', $list_id_child); 
	    $posts = $this->page_model->list_posts($lang, '', '', '', '', $list_id_child);

	    //pagination
	    $limit = array();
	    $limit[0] = 10;
	    $limit[1] = ($this->uri->segment(3) !=null) ? ($this->uri->segment(3)) : ($this->uri->segment(2));
  	    $this->load->library('pagination');
	    $config['per_page'] = $limit[0];
	    $config['uri_segment'] = 2;
		$config['total_rows']= count($this->page_model->list_posts($lang, '', '', '', '',  $list_id_child ));
		$config['base_url'] = './'.$url;
		$config['per_page'] = $limit[0]; 
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, './tin-tuc/');
        unset($config);

        $this->outputData['list_posts'] = $this->page_model->list_posts($lang, $limit, '', '', '', $list_id_child, $url );
        //breadcrumb text_helper
		    $list_id_parent = $this->__parent_cate($cate_detail['id']);
        $this->outputData['breadcrumb'] = __breadcrumb($this->listCateParent($list_id_parent));
        $this->outputData['current_page'] = $this->uri->segment(1);
        //OUTPUT OF SEO
        $this->outputData['page_title'] = ($cate_detail['meta_title']) ? ($cate_detail['meta_title']) : ($cate_detail['name']);
        $this->outputData['meta_keywords'] = $cate_detail['meta_keywords'];
        $this->outputData['meta_description'] = $cate_detail['meta_description'];
        $this->outputData['categories'] = $list_category = $this->page_model->list_category_posts($lang, '', '', '',array(TB_CGR_POSTS.'.isMenu' => 1));

        if ($cate_detail['id_parent'] > 0) {
        	$list_category = $this->page_model->list_category_posts($lang, '', '', '',array(TB_CGR_POSTS.'.id_parent' => $cate_detail['id_parent']));
    	} else {
    		$list_category = $this->page_model->list_category_posts($lang, '', '', '',array(TB_CGR_POSTS.'.id_parent' => $cate_detail['id']));
    	}

        if( $list_category ) {
        	$data = array();

        	foreach ($list_category as $row ) {
        		$row['link'] = './'.$this->uri->segment(1).'/'.$row['alias'].'/';
        		$data[] = $row;
        	}

			$this->outputData['other_posts'] = $data;
			$this->outputData['name_cate'] = $cate_detail['name'];
        }

        $this->outputData['postHighlight'] = $this->page_model->list_posts($lang, (8), array(TB_POSTS.'.isHighlight' => 1, TB_POSTS.'.type' => 'posts'));	
        $this->outputData['postNew'] = $this->page_model->list_posts($lang, (8), array( TB_POSTS.'.type' => 'posts'));	
        // cate child and product
        $list_child_category = $this->page_model->list_category_posts($lang, '', '', '',array(TB_CGR_POSTS.'.id_parent' => $cate_detail['id']));
        $data = array();
        if( $list_child_category ) {

        	foreach ($list_child_category as $row ) {
        		$row['link'] = './'.$this->uri->segment(1).'/'.$row['alias'].'/';
        		$row['posts'] = $this->page_model->list_posts($lang, '', array(TB_POSTS.'.id_cate' => $row['id']) );
        		$data[] = $row;
        	}
        }

       	$cate_detail['child'] = $data;
       	$this->outputData['cate_detail'] = $cate_detail;
        //send contact
       		if ($cate_detail['id_parent'] == 0 && $cate_detail['child']) {
       			$cateProjects = $this->page_model->list_category_posts('', '', '', '', array(TB_CGR_POSTS.'.id_parent' => $cate_detail['id']));

       			$arrCateProjects = [];
       			foreach ($cateProjects as $cateItem) {
       				$cateItem['projects'] = $this->page_model->list_posts('', 
   						array(4), 
   						array(TB_POSTS.'.id_cate' => $cateItem['id']
       				));

       				$arrCateProjects[] = $cateItem;
       			}

       			$this->outputData['cateProjects'] = $arrCateProjects;
       		} 
       		$this->render_page('frontend/posts/list');
	}



	function list_tags()
	{
		$id_tags = explode('-', $this->uri->segment(2));
		$id_tags = end($id_tags);
	    //pagination
	    $limit = array();
	    $limit[0] = 15;
	    $limit[1] = $this->uri->segment(3);
  	    $this->load->library('pagination');
	    $config['per_page'] = $limit[0];
	    $config['uri_segment'] = 3;
		$config['total_rows']= count($this->tags_model->list_posts_tags($id_tags));
		$config['base_url'] = './'.$this->uri->segment(1).'/'.$this->uri->segment(2);
		$config['per_page'] = $limit[0]; 
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, './tin-tuc/');
        unset($config);
        $this->outputData['list_posts'] = $this->tags_model->list_posts_tags($id_tags, $limit);
        $this->outputData['current_page'] = 'posts';
        $tags = $this->tags_model->get_infor( array(TB_TAGS.'.id_tags' => $id_tags ));
        $this->outputData['tags_detail'] = $tags;
      	$this->outputData['tags_posts'] = $this->tags_model->get_list_tags_posts();
        //OUTPUT OF SEO
        $this->outputData['page_title'] = ( $tags->meta_title != null) ? ( $tags->meta_title) : ( $tags->name_tags) ;
        $this->outputData['meta_keywords'] = ( $tags->meta_keywords != null) ? ( $tags->meta_keywords) : ( $tags->name_tags);
        $this->outputData['meta_description'] =  ( $tags->meta_description != null) ? ( $tags->meta_description) : ( $tags->name_tags);
        
        $this->render_page('frontend/posts/list');
	}

	function view( $id = '' )
	{
		$lang = $this->lang_code;

		$segment2 = $this->uri->segment(2);
        $arrSegment2 = explode('-', $segment2);
        $id = end($arrSegment2);
		
		if( $id > 0) {
			$condition = array(TB_POSTS.'.id'=>$id);
		} else {
			$condition = array(TB_POSTS.'.alias'=>$this->uri->segment(1));
		}
		
 		//$condition = ($alias_segment_2[0] > 0) ? (TB_POSTS.'.id'=>$alias)
        if(!$this->page_model->check_exists($condition, TB_POSTS)) {
        	show_404();
        }

		$detail = $this->page_model->view_posts($lang ,$condition);
		//breadcrumd
        $cate_detail = $this->page_model->view_category_posts($lang, array('alias' => $this->uri->segment(1)));
        //breadcrumb text_helper
		$list_id_parent = $this->__parent_cate($cate_detail['id']);
        $this->outputData['breadcrumb'] = __breadcrumb($this->listCateParent($list_id_parent), '', $detail['name']);
        //OUTPUT OF SEO
        $this->outputData['page_title'] = ($detail['meta_title']) ? ($detail['meta_title']) : ($detail['name']);
        $this->outputData['meta_keywords'] = $detail['meta_keywords'];
        $this->outputData['meta_description'] = $detail['meta_description'];
		$this->outputData['current_page'] = $this->uri->segment(1);
        $this->outputData['detail'] = $detail;
        $this->outputData['tags_posts'] = $this->tags_model->get_list_tags_posts();
        //orther posts
        $this->outputData['categories'] = $list_category = $this->page_model->list_category_posts($lang, '', '', '',array(TB_CGR_POSTS.'.isMenu' => 1));
		//category root
        $cate_detail = $this->page_model->view_category_posts($lang, array(TB_CGR_POSTS.'.alias'.$lang => $this->uri->segment(1)));
        //find list cate child
        $list_category = $this->page_model->list_category_posts($lang, '', '', '',array(TB_CGR_POSTS.'.id_parent' => $cate_detail['id']));

        if( $list_category ) {
        	$data = array();

        	foreach ($list_category as $row ) {
        		$row['link'] = './'.$this->uri->segment(1).'/'.$row['alias'].'/';
        		$data[] = $row;
        	}

			$this->outputData['other_posts'] = $data;
			$this->outputData['name_cate'] = $cate_detail['name'];
        } else {
        	$this->outputData['other_posts'] = $this->page_model->list_posts($lang, array('0'=> 15), array(TB_POSTS.'.id_cate' => $detail['id_cate']), '', '','', $this->uri->segment(1));
        }

        $this->outputData['postHighlight'] = $this->page_model->list_posts($lang, (8), array(TB_POSTS.'.isHighlight' => 1, TB_POSTS.'.type' => 'posts'));	

        $this->outputData['postNew'] = $this->page_model->list_posts($lang, (8), array( TB_POSTS.'.type' => 'posts'));	

        $this->render_page('frontend/posts/detail');
	}

	function __child_cate($id_cate)
	{
		$lang = $this->lang_code;
		$id_cate_child = $this->page_model->list_category_posts($lang, '', '', '',  array('id_parent' => $id_cate));

	    if(	count($id_cate_child) > 0 ) :

		    foreach( $id_cate_child as $row ) :
		    	$n = $this->page_model->list_category_posts($lang,'', '', '',  array('id_parent' => $row['id']));

		    	if( count($n) > 0 ) {
		    		$id_cate .= ','.$this->__child_cate($row['id']);
		    	} else {
		    		$id_cate .= ','.$row['id'];
		    	}

		    endforeach;

	    endif;

	    return $id_cate;
	}

	function __parent_cate($id_cate , $list_id = '')
	{
		$lang = $this->lang_code;
		$cate = $this->page_model->view_category_posts($lang,  array('id_cate' => $id_cate));

	    if(	count($cate) > 0 ) {  
	    	$list_id .= ($list_id != '') ? (','.$cate['id']) : ($cate['id']);

	        if($cate['id_parent'] > 0) {	
		    	$list_id .= ','.$this->__parent_cate($cate['id_parent']);
		    }
	    }

	    return $list_id;
	}
    
    

    function listCateParent( $cateId = '' )
    {
     	if($cateId <= 0) 
     		return null;
     	
		$listCategoryParent = $this->page_model->list_category_posts($this->lang_code, '', '', '', '', $cateId );

		return $listCategoryParent;
    } 

}