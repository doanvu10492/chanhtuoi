<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Album extends Admin_Controller 
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
    * Current page album
    */
    public $currentPage = 'album';

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
        $this->load->model(array('backend/tags_model', 'backend/album_model'));
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
        $this->_total = count($this->album_model->listAlbum($condition)->result());
        $pagination = $this->getPagination();
        $collection = $this->album_model->listAlbum($condition, $this->limit)->result();
        $listPostData = $this->album_model->parseAlbumData($collection);
        
        $this->outputData = [
            'pageTitle' => 'Danh sách bài viết',
            'currentPage' => 'album',
            'subPage'=> 'album',
            'pages' => $listPostData,
            'option' => $this->select_option->dropdown(
                ['table' => TB_CGR_ALBUM], 
                '', 
                '', 
                isset($getRequest['id_cate']) ? $getRequest['id_cate'] : ''
            ),
            'pagination' => $pagination,
            'sort_field' => $this->session->userdata('album_field'),
            'icon_sort' => ($this->session->userdata('album_sort') == 'desc') ? ('<i class="fa fa-sort-up" aria-hidden="true"></i>') : ('<i class="fa fa-sort-desc" aria-hidden="true"></i>'),
            'getRequest' => $getRequest
        ];

        $this->render('admin/album/list');
    }
    
    public function updated($id)
    {
        $this->form_validation->set_error_delimiters(
            $this->config->item('field_error_start_tag'), 
            $this->config->item('field_error_end_tag')
        );

        if ($data = $this->input->post()) {
            $this->form_validation->set_rules(
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

                unset($data['tags'], $data['images_old']);
                $data['updated_at'] = date('Y-m-d H:i:s');

                if ($id == 0) {
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $postId = $this->album_model->insertDataId($data);
                    $this->session->unset_userdata('images');
                    $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 bài viết mới');
                } else {
                    $postId  = $id;
                    $key = array('id' => $id);
                    $this->album_model->updateData($key, $data);
                    unset($_SESSION['images']);
                    $this->session->set_flashdata('flash_message','Cập nhật bài viết thành công !');
                }   

            
                redirect_admin('album' . $this->session->userdata('query_href_back'));
            }

        }

        if ($id == 0) {
            $pageTitle = 'Thêm bài viết mới';
            $subPage = 'add_album';
            $action = 'Thêm mới';
        } else {
            $pageTitle = 'Chỉnh sửa bài viết';
            $subPage = 'album';
            $action = 'Cập nhật';
            $getDetail =  $this->album_model->get_infor(array('id'=>$id));
            $getDetail = $this->album_model->parse_album_row($getDetail);
        }

        $this->outputData = [
            'pageTitle' => 'Chỉnh sửa bài viết',
            'currentPage' => $this->currentPage,
            'subPage'=> 'album',
            'page' => $id ? $getDetail : '',
            'action' => 'Cập nhật',
            'id' => $id,
            'option' => $this->select_option->dropdown(
                ['table' => TB_CGR_ALBUM], 
                '', 
                '',
                $id ? $getDetail->id_cate : ''
            )
        ];

        $this->render('admin/album/update');
    }

    public function delete($id)
    { 
        $album = $this->album_model->get_infor(['id'=> $id]);
        $album = $this->album_model->parse_album_row($album);

        //delete img avatar of album
        if (realpath($album->image_path)) {
            unlink(realpath($album->image_path));
        }

        $this->album_model->deleteData($id);
        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
        unset($album);

        redirect_admin('album');        
    }

    public function upload()
    {
        if ($_FILES['images']['name'] != "") {
            $path = IMG_PATH_ALBUM;
            $width = $this->config->item('album_width');
            $height = $this->config->item('album_height');
            $file = $this->upload_library->do_upload_file($path, 'images', [$width, $height] );

            if ($this->input->post('images_old')) {
                $link_unlink = realpath(IMG_PATH_ALBUM).$this->input->post('images_old');
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
        $this->updateStatusAdmin($this->album_model, $id);
    }

    public function del_list_choose()
    {
        $this->delListChooseAdmin($this->album_model);
           
        echo json_encode(['result' => admin_url('album')]); exit(); 
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
}