<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller 
{
    protected $outputData = array();

    function __construct() 
    {
        parent::__construct();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $this->load->helper('url');
    }

    protected function render($the_view = NULL, $template = 'main') 
    {
        if($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->outputData);
        } elseif(is_null($template)) {
            $this->load->view($the_view,$this->outputData);
        } else {
            $this->outputData['view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->outputData, TRUE);
            $this->load->view('admin/layout/' . $template, $this->outputData);
        }
    }

    protected function render_page($the_view = NULL, $template = 'master') 
    {
        if($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->outputData);
        } elseif(is_null($template)) {
            $this->load->view($the_view,$this->outputData);
        } else {
            $this->outputData['view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->outputData, TRUE);
            $this->load->view('frontend/layout/' . $template, $this->outputData);
        }
    }

    public function getRequestUrlPagination()
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $parsed = parse_url($requestUrl);
        $query = isset($parsed['query']) ? $parsed['query'] : '';
        parse_str($query, $params);
        unset($params['per_page']);        
        $string = http_build_query($params);

        $fullQueryString = $parsed['path'];
        $fullQueryString .= $string ? '?' . $string : '';

        return base_url() . $fullQueryString;
    }

    public function getRequestUrl()
    {
        return base_url() . $_SERVER['REQUEST_URI'];
    }

    public function getPagination()
    {
        $this->load->library('pagination');
        $limit = $this->limit;
        $perPage = $limit[0];
        $url = $this->getRequestUrlPagination();

        $config = [
            'page_query_string' => true,
            'base_url' => $url,
            'total_rows' => $this->_total,
            'per_page' => $perPage
        ];

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links(true);
        
        return $pagination;     
    }
}

// Admin controller to manage the website
class Admin_Controller extends MY_Controller 
{
    function __construct() 
    {
        parent::__construct();
    }

    protected function render($the_view = NULL, $template = 'main') 
    {
        parent::render($the_view, $template);
    }

    public function updateStatusAdmin($model, $id)
    {
        $response = [
            'success' => false,
            'messages' => 'Bài viết này không tồn tại',
            'data' => [],
        ];

        $action = trim($_POST['action']);
        $active = (int) $_POST['active'];
        $condition = is_array($id) ? $id : ['id' => $id];

        if ($model->check_exists($condition) === true) {
            $num = $active ? 0 : 1;
            $classIcon = $num ? 'glyphicon-ok' : 'glyphicon-remove';
            
            $model->updateData($condition, [$action => $num]);

            $response = [
                'success' => true,
                'messages' => 'Cập nhật thành công',
                'data' => [
                    'class_icon' => $classIcon,
                    'num' => $num
                ],
            ];
        } 

        echo json_encode($response);
    }

    public function delListChooseAdmin($model)
    {
        $listIds = explode(',', $_POST['list_id']);

        if (count($listIds) == 1) {
            $model->deleteData($listIds);
        } else {
            foreach ($listIds as $id) {
                if ($model->check_exists(array('id' => $id))) {
                    $model->deleteData($id);
                } else {
                    echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
                }
            }
        }

        $this->session->set_flashdata('flash_message','Xóa thành công');
           
        echo json_encode(['result' => admin_url('menu')]); exit(); 
    }
}

// Public controller for end user interface
class Public_Controller extends MY_Controller 
{
    //languages
    public $lang_code = '';

    //load logo
    public $logo = '';

    function __construct() 
    {
        parent::__construct();
       
        //using config core
        $this->config->db_config_fetch();

        $this->load->library('select_option');

        //languages
        $this->lang_code = ($this->session->userdata('site_lang') == "english") ? ('_en') : ('');
        $this->outputData['lang'] = $this->lang_code;

        $this->load->model(array(
            'backend/settings_model', 
            'frontend/page_model', 
            'frontend/sidebar_model', 
            'backend/menu_model' ,
            'frontend/category_products_model', 
            'frontend/products_model', 
            'frontend/album_model', 
            'backend/script_model'
        ));

         //logo
        $this->outputData['logo'] = $this->config->item('logo'.$this->lang_code);

        //menu
        $this->outputData['menu_top'] = $this->sidebar_model->menu_top('', $this->lang_code);

        //menu
        $this->outputData['menu_footer'] = $this->sidebar_model->menu_footer('', $this->lang_code);

        $this->outputData['slider'] = $this->sidebar_model->slider();

        $this->outputData['productNewSidebar'] = $this->products_model->list_products(array('isNew' => 1), (8));

        /*
        ** HEADER WEBSITE
        */
        $this->outputData['posts_cate'] = $this->page_model->listPosts(array(TB_POSTS.'.id_cate' => 30), array(6));

        $this->outputData['page_top'] = $this->page_model->listPages(array(TB_POSTS.'.isRight' => 1), array(6));

        $this->outputData['page_footer'] = $this->page_model->listPages(array(TB_POSTS.'.isFooter' => 1));

        $this->outputData['cateRoot'] = $this->category_products_model->list_category_products('', '',  array(TB_CGR_PRODUCTS.'.id_parent' => 0));

        //print_r( $this->outputData['posts_cate']); exit();

        $this->outputData['postsHighlight'] = $this->page_model->listPosts(array(TB_POSTS.'.isHighlight' => 1, TB_POSTS.'.type' => 'posts', TB_CGR_POSTS.'.module' => ''), array(6));
        $this->output->cache(5);
        $this->outputData['support_online'] = $this->sidebar_model->support_online($this->lang_code);

        $this->outputData['pageFooter'] = $this->page_model->listPages('', [4]);
    }
   
    
    /*
    * Render view
    * @param string $the_view
    * @param string $main
    */
    protected function render_page($the_view = NULL, $template = 'main') 
    {
        parent::render_page($the_view, $template);
    }

    /*
    * Set meta seo for page 
    *
    * @param array $meta
    */
    public function metaSeo($meta = array())
    {
        $this->outputData['page_title'] = $meta['title'];
        $this->outputData['meta_keywords'] = $meta['keyword'];
        $this->outputData['meta_description'] = $meta['description'];
    }

    /*
    * Get per_page in Pagination 
    */
    public function get_per_page()
    {
        return isset($_GET['per_page']) ? $_GET['per_page'] : 0;
    }

    function generateFormKey()
    {
        $key = bin2hex($this->encryption->create_key(16));
        $this->session->set_userdata('FORM_KEY', $key);
    }
}