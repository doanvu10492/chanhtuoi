<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Video extends Public_Controller {
    public $outputData;
	public $loggedInUser;
	
	function __construct()
	{
		
		parent::__construct();
		
		$this->config->db_config_fetch();
	    //check status of page
		if($this->config->item('site_status') == 1)
			redirect('offline');
        //load model
		$this->load->model(array('frontend/video_model'));		
	}

	function index()
	{
        $start = $this->uri->segment(2);
	    $limit = array();
	    $limit[0] = 15;
	    $limit[1] = ($start > 0) ? (($start - 1) * $limit[0]) : (0);
  	    $this->load->library('pagination');
	    $config['per_page'] = $limit[0];
	    $config['uri_segment'] = 2;
		$config['total_rows']= count($this->video_model->list_video());
		$config['base_url'] = './video/';
		$config['per_page'] = $limit[0]; 
		$this->pagination->initialize($config);
		$this->outputData['pagination'] = $this->pagination->create_links(true, './video/');
        unset($config);
        $this->outputData['list_video'] = $this->video_model->list_video($limit);
        $this->outputData['current_page'] = 'video';
        //OUTPUT OF SEO
        $this->outputData['page_title'] = 'video';
        $this->outputData['meta_keywords'] = 'video';
        $this->outputData['meta_description'] = 'video';

        $this->render_page('frontend/video/list');
	}

	function view( $id = '' )
	{
		$id = explode('-', $this->uri->segment(2));
		$id = end($id);
 		
        if(!$this->video_model->check_exists(array('id'=> $id))) {
        	show_404();
        }

		$detail = $this->video_model->view_video(array(TB_VIDEO.'.id'=>$id));
        $this->outputData['page_title'] = ($detail['meta_title']) ? ($detail['meta_title']) : ($detail['name']);
        $this->outputData['meta_keywords'] = $detail['meta_keywords'];
        $this->outputData['meta_description'] = $detail['meta_description'];

		$this->outputData['current_page'] = 'video';
        $this->outputData['detail'] = $detail;
        //orther video
        $this->outputData['other_video'] = $this->video_model->list_video( array('0' => 12), '' ,'',array('id !=' => $id ));
        
        $this->render_page('frontend/video/detail');
	}

}