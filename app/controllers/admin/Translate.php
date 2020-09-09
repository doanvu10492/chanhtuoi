<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Translate extends Admin_Controller 
{
    public $outputData;
    public $table = TB_TRANSLATE;

    function __construct()
    {
        parent::__construct();

        if(!isAdmin())
            redirect_admin('login');

        $this->config->db_config_fetch();
        $this->lang->load('admin/validation',$this->config->item('language_code'));
        $this->load->library('select_option');
        $this->load->model('backend/translate_model');
    }


    function index()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $queryString ='';
        $keyword = '';
        $id_cate = '';
        $condition = [];
        $sort = $this->sort_field->sort('translate');
      
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $this->outputData['keyword'] = $keyword;
            $queryString .='?keyword='.$keyword;
        }

        // pagination
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
            $config['uri_segment'] = $_GET['per_page'];
        } else {
            $config['uri_segment'] = $this->uri->segment(4);
        }

        $limit = array();
        $limit[0] = 15;
        $limit[1] = ( isset($config['uri_segment']) ) ? ( $config['uri_segment'] ) : (0);
         
        $listTranslate = $this->translate_model->list_translate('', $condition, $keyword, "{$this->table}.".$sort['field'].' '.$sort['sort']  )->result();

        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
        $config['base_url'] = './admin/translate'.$queryString;
        $config['total_rows'] = count($listTranslate);
        $config['per_page'] = $limit[0];
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        // get product list
        $listTranslate = $this->translate_model->list_translate($limit, $condition, $keyword, "{$this->table}.".$sort['field'].' '.$sort['sort'] )->result();

        // parse data
        $listTranslate = $this->translate_model->parse_translate_data($listTranslate);
    
        // assign queryString to backfor edit action
        $this->my_session->_session_back_link($queryString);

        $iconSort = ($this->session->userdata('translate_sort') == 'desc') ? ('<i class="fa fa-sort-up" aria-hidden="true"></i>') : ('<i class="fa fa-sort-desc" aria-hidden="true"></i>');

        $this->outputData =[
            'pageTitle' => 'Danh sách bài viết',
            'currentPage' => 'translate',
            'subPage'=> 'translate',
            'pages' => $listTranslate,
            'pagination' => $pagination,
            'keyword' => $keyword,
            'sort_field' => $this->session->userdata('translate_field'),
            'icon_sort' => $iconSort
        ];

        $this->render('admin/translate/list');
    }

    function updated($id)
    {
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
        $this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
        
        if ($this->form_validation->run()) {
            $data = $this->input->post();
            if ($id == 0) {
                $this->translate_model->insertData($data);
                $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 ảnh mới');
            } else {
                $key = ['id' => $id];
                $this->translate_model->updateData($key, $data);
            }
            
            redirect_admin('translate'.$this->session->userdata('query_href_back'));
        }

        if ($id == 0) {
            $this->outputData = [
                'pageTitle' => 'Thêm bài viết mới',
                'currentPage' => 'translate',
                'subPage'=> 'add_translate',
                'id' => $id,
                'action' => 'Thêm mới',
            ];
        } else {
            $getInfor =  $this->translate_model->get_infor(array('id'=>$id));
            $getInfor = $this->translate_model->parse_translate_row($getInfor);
            $this->outputData = [
                'pageTitle' => 'Chỉnh sửa bài viết',
                'currentPage' => 'translate',
                'subPage'=> 'updated_translate',
                'page' => $getInfor,
                'id' => $id,
                'action' => 'Thêm mới',
            ];
        }
        
        $this->render('admin/translate/update');
    }

    function delete($id)
    { 
        $this->translate_model->deleteData($id);
        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
        
        redirect_admin('translate');      
    }


    function updateStatus()
    {
        $id = $this->uri->segment(4);
        $action = trim($_POST['action']);

        if ($this->translate_model->check_exists(['id' => $id])) {
            if ($_POST['active'] == 1) {
                $this->translate_model->updateData(['id' => $id], [$action => 0]);
                echo json_encode(['result' => 'glyphicon-remove', 'num' => 0]); exit();
            } else {
                $this->translate_model->updateData(['id' => $id], [$action => 1]);
                echo json_encode(['result' => 'glyphicon-ok', 'num' => 1]); exit();
            }
        } else {
            echo json_encode(['error' => 'Ảnh này không tồn tại']); exit();
        }
    }


    function del_list_choose()
    {
        $listId = explode(',', $_POST['list_id']);
        
        if (count($listId) == 1) {
            $this->translate_model->deleteData($listId);
        } else {
            foreach ($listId as $id) {
                if ($this->translate_model->check_exists(['id' => $id])) {
                    $this->translate_model->deleteData($id);
                } else {
                    echo json_encode(['error' => 'Bạn là hacker ah !']); exit();
                }
                
            }
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các ảnh được chọn');   
        echo json_encode(array('result' => admin_url('translate'))); exit(); 
    }
}