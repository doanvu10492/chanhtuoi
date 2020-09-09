<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Album extends Public_Controller 
{
    public $outputData;
	public $loggedInUser;
	
	function __construct()
	{	
		parent::__construct();

		$this->config->db_config_fetch();
	    //check status of page
		if( ! $this->config->item('site_status'))
			redirect('offline');
        //load model
		$this->load->model('frontend/album_model');	
			
	}

	function index()
	{
	    $start = $this->uri->segment(3);
	    $limit = array();
	    $limit[0] = 32;
	    $limit[1] = ($start > 0) ? (($start - 1) * $limit[0]) : (0);
	    // $id = explode('-', $this->uri->segment(2));
	   	// $id = end($id);
	   	$alias = $this->uri->segment(2);
	    $condition = array();
	    $cate_detail = $this->album_model->view_category_album('', array(TB_CGR_ALBUM.'.alias' => $alias));
	    $condition[TB_ALBUM.'.id_cate'] = $cate_detail['id'];
    
  	    //pagination
  	    $this->load->library('pagination');
	    $config['per_page'] = $limit[0];
	    $config['uri_segment'] = 2;
		$config['total_rows']= count($this->album_model->list_album('','' , $condition));
		$config['base_url'] = '/' . $this->uri->segment(1) . '/' . $this->uri->segment(2);
		$config['per_page'] = $limit[0]; 
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, './album/');
        unset($config);
        $this->outputData['list_album'] = $this->album_model->list_album('' ,$limit, $condition);
        $this->outputData['current_page'] = 'album';
        //OUTPUT OF SEO
	    $this->outputData['page_title'] = $cate_detail['name'];
        $this->outputData['meta_keywords'] = $cate_detail['meta_keywords'];
        $this->outputData['meta_description'] = $cate_detail['meta_description'];
        $this->outputData['cate_detail'] = $cate_detail;
        
        $this->render_page('frontend/album/detail');
	}

	function category( $id )
	{
	    $start = $this->uri->segment(2);
	    $limit = array();
	    $limit[0] = 21;
	    $limit[1] = ($start > 0) ? (($start - 1) * $limit[0]) : (0);

	    $cate_detail = $this->album_model->view_category_album('', array(TB_CGR_ALBUM.'.alias' => $this->uri->segment(2)));
	    $condition = array();
	    $condition[TB_CGR_ALBUM.'.id_parent'] = $cate_detail['id'];
  	    //pagination
  	    $this->load->library('pagination');
	    $config['per_page'] = $limit[0];
	    $config['uri_segment'] = 2;
		$config['total_rows']= count($this->album_model->list_category('','' , $condition));
		$config['base_url'] = $this->uri->segment(2);
		$config['per_page'] = $limit[0]; 
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, $this->uri->segment(2));
        unset($config);
        $this->outputData['list_album'] = $this->album_model->list_category('' ,$limit, $condition);
        $this->outputData['current_page'] = 'album';
        //OUTPUT OF SEO
	   	$this->outputData['page_title'] = $cate_detail['name'];
        $this->outputData['meta_keywords'] = $cate_detail['meta_keywords'];
        $this->outputData['meta_description'] = $cate_detail['meta_description'];

        $this->render_page('frontend/album/list');
	}

	function view( $id = '' )
	{
		$alias =  $this->uri->segment(2);
		  
        if( ! $this->album_model->check_exists(array('alias' => $alias))) {
        	show_404();
        }

		$detail = $this->album_model->view_album(array(TB_ALBUM.'.alias'=>$alias));

        //OUTPUT OF SEO
        $this->outputData['page_title'] = $detail['meta_title'];
        $this->outputData['meta_keywords'] = $detail['meta_keywords'];
        $this->outputData['meta_description'] = $detail['meta_description'];

		$this->outputData['current_page'] = 'album';
        $this->outputData['detail'] = $detail;
        //orther album
        $this->outputData['other_album'] = $this->album_model->list_album('',array('0'=> 10), array(TB_ALBUM.'.id_cate' => $detail['id_cate']));

        $this->render_page('frontend/album/detail');
	}


    function get_segment_id($url_id)
    {
    	$id = explode($url_id);
		$id = end($id);

		return $id;
    }

    function load_theme($theme = '')
    {
    	$this->render_page('frontend/products/'.$theme);
    }


    function get_per_page()
    {
    	return ( isset($config['per_page']) ) ? ( $config['per_page'] ) : (0);
    }


    function get_pagination($data = array())
    {
    	$this->load->library('pagination');

    	$limit = array(
    		$this->limit,
    		$this->get_per_page()
    	);

        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
		$config['base_url'] = $data['base_url'];
		$config['total_rows'] = $data['total'];
		$config['per_page'] = $limit[0];
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, $data['base_url']);

		unset($config);
    }


}