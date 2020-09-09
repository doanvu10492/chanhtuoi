<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Admin_Controller 
{
    public $outputData;

    function __construct()
    {
        parent::__construct();

        // Check login admin
        if(!isAdmin())
            redirect_admin('login');
        $this->config->db_config_fetch();
        $this->lang->load('admin/validation',$this->config->item('language_code'));
        $this->load->library('select_option');
        $this->load->library('Upload_library');
        $this->load->model('backend/pages_model');
    }


   function index()
    {
        //to use $_GET();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        //variable for href
        $queryString ='';
        $keyword = '';
        $id_cate = '';
        
        //get $_GET of the varible
        if (isset($_GET['keyword']) && ($_GET['keyword'] !=' '))
        {
            $keyword = $_GET['keyword'];           
            $this->outputData['keyword'] =$keyword;
            $queryString .='?keyword='.$keyword;
        }
    
        //pagination
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL)
        {
            $config['uri_segment'] = $_GET['per_page'];
            //check to get & or ? assign into queryString
            $queryString = ($queryString = '') ? ('&per_page='.$_GET['per_page']) : ('?per_page='.$_GET['per_page']);
        }
        else{
            $config['uri_segment'] = $this->uri->segment(4);
        }
        
        $list_pages = $this->pages_model->list_pages('', '', $keyword)->result();

        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
        $config['base_url'] = './admin/pages/index.html'.$queryString;
        $config['total_rows'] = count($list_pages);
        $config['per_page'] = 100;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        //GET PRODUCTS LIST
        $list_pages = $this->pages_model->list_pages($config['per_page'], $config['uri_segment'], $keyword)->result();
        //parse data
        $list_pages = $this->pages_model->parse_pages_data($list_pages);
    
        //assign queryString to back for edit action
        $this->session->set_userdata('query_href_back', $queryString);


        $this->outputData = array(
            'pageTitle' => 'Pages',
            'currentPage' => 'list_pages',
            'subPage'=> 'pages',
            'keyword' => $keyword,
            'pagination' => $pagination,
            'list_pages' => $this->table_list_pages() 
        );

        $this->render('admin/pages/list');

    }

    function updated($id)
    {
        
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

        if ($this->input->post('update_pages'))
        {
            
            $this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
           
            $this->form_validation->set_rules('images','Images', 'callback_upload');
            if ($this->form_validation->run())
            {
                
                $images = ($_FILES['images']['name'] != NULL) ? ( $_SESSION['images']) : ($this->input->post('images_old'));

                $active = ($this->input->post('active') > 0 ) ? ('1') : ('0');  
                $data = array(
                    'name' => $this->input->post('name'),
                    'id_parent' => ($this->input->post('id_parent') != 0) ? ($this->input->post('id_parent')) : (0),
                    'alias' => url_alias($this->input->post('name')),
                    'active' =>1,
                    'link_web' => $this->input->post('link_web'),
                    'brief' => $this->input->post('brief'),
                    'description' => $this->input->post('description'),
                    'image' => $images,                 
                    'meta_title' => $this->input->post('meta_title') 
                                    ?  $this->input->post('meta_title') 
                                    :  $this->input->post('name'),
                    'meta_description' => $this->input->post('meta_description'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
                    'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
                    //English
                    'brief_en' => $this->input->post('brief_en'),
                    'description_en' => $this->input->post('description_en'),
                    'name_en' => $this->input->post('name_en'),
                    'alias_en' => url_alias($this->input->post('name_en')),
                    'meta_title_en' => $this->input->post('meta_title_en'),
                    'meta_description_en' => $this->input->post('meta_description_en'),
                    'meta_keywords_en' => $this->input->post('meta_keywords_en'), 
                    'ordering' => $this->input->post('ordering'),
                    'isRight' => 1,
                    'type' => 'page'
                );
                if($id == 0)
                {
                    //cancel session
                    $this->pages_model->insertData($data);
                    if($this->session->userdata('images')){
                        $this->session->unset_userdata('images');
                    }
                    $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 bài viết');
                }
                else{ 
                    //cancel session
                    $key = array('id' => $id);
                    $this->pages_model->updateData($key, $data);
                    if($this->session->userdata('images')){
                        $this->session->unset_userdata('images');
                    }
                   $this->session->set_flashdata('flash_message','Bạn vừa cập nhật 1 bài viết');

                }                
                redirect_admin('pages');
            }

        }

        if($id == 0)
        {
            //add
             $this->outputData = array(
                'pageTitle' => 'Thêm bài viết mới',
                'currentPage' => 'pages',
                'subPage'=> 'add_pages',
                'id' => $id,
                'action' => "Thêm",
                'option' => $this->select_option->dropdown_pages(array(
                    'table' => TB_PAGES, 
                    'where' => array('type' => 'pages')
                ))
            );

        }else{

            //update
            $get_infor =  $this->pages_model->get_infor(array('id'=>$id));
            //parse data
            $get_infor = $this->pages_model->parse_pages_row($get_infor);
            $id_parent = (count($get_infor)>0 && $get_infor->id_parent > 0) ? ($get_infor->id_parent) : (''); 
            $this->outputData = array(
                'pageTitle' => 'Chỉnh sửa bài viết',
                'currentPage' => 'pages',
                'subPage'=> 'updated_pages',
                'page' => $get_infor,
                'id' => $id,
                'action' => 'Cập nhật',
                'option' => $this->select_option->dropdown_pages(array('table' => TB_PAGES, 'type' => 'pages'), '', '',$id_parent )
            );
        }
        $this->render('admin/pages/update');

    }

    function delete($id)
    { 
        $pages = $this->pages_model->get_infor(array('id'=> $id));
        $pages = $this->pages_model->parse_pages_row($pages);
        //delete img avatar of pages
        if (realpath($pages->image_path))
        {
            unlink(realpath($pages->image_path));
        }
        $this->pages_model->deleteData($id);
        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
        redirect_admin('pages/index');      

    }

    function upload()
    {
        if($_FILES['images']['name'] != "")
            {
                $upload_path = IMG_PATH_PAGES;
                $file_upload = $this->upload_library->do_upload_file($upload_path, 'images');

                if ($this->input->post('images_old') != "")
                {
                    $link_unlink = realpath(APPPATH.IMG_PATH_PAGES).'/'.$this->input->post('images_old');
                }
                if (is_array($file_upload) && count($file_upload) > 0)
                {
                    $_SESSION['images'] =  $file_upload['file_name'];
                    return true;
                }
                else
                {
                    $this->session->set_flashdata('error_message', $file_upload);
                    return false;
                    
                }
            }
        return true;
    }


    function table_list_pages($id_parent = 0, $string = '', $i = 0)
    {
         $get_infor =  $this->pages_model->list_pages('','','','',array('id_parent' => $id_parent))->result();
         $get_infor = $this->pages_model->parse_pages_data($get_infor);

         $result = '';

         if(count($get_infor) > 0)
         {
            $string .= ($id_parent == 0) ? ('') : ("---");
            $i = ($i > 0  ) ? (' ') : ($i);
            foreach ($get_infor as $row)
            {
                $i++;
                $result .='<tr>';
                $result .='<td><input type="checkbox" name="checklist"  value="'.$row->id.'"></td>';
                $result .=  '<td>'.$i.'</td>';
                    
                $result .=  '<td>'.$string.' '.$row->name.'</td>';
                        
                $result .=  '<td>'.$row->updated_at.'</td>';


                 $result .=  '<td>'.$row->ordering.'</td>';

                $result .=   '<td>';
                $result .= '<a href="';
                $result .= $row->link_active;
                 $result .= '" data-action="isRight" rel="'.$row->isRight.'" class="btn-status glyphicon ';
               
                $result .= $row->icon_right;

                $result .='">';

                $result .= '</a>';
                $result .= '</td>';


                $result .=   '<td>';
                $result .= '<a href="';
                $result .= $row->link_active;
                 $result .= '" data-action="isHighlight" rel="'.$row->isHighlight.'" class="btn-status glyphicon ';
               
                $result .= $row->icon_Highlight;

                $result .='">';

                $result .= '</a>';
                $result .= '</td>';


                $result .=   '<td>';
                $result .= '<a href="';
                $result .= $row->link_active;
                 $result .= '" data-action="isFooter" rel="'.$row->isFooter.'" class="btn-status glyphicon ';
               
                $result .= $row->icon_footer;

                $result .='">';

                $result .= '</a>';
                $result .= '</td>';




                        
                $result .=   '<td>';
                $result .= '<a href="';
                $result .= $row->link_active;
                 $result .= '" data-action="active" rel="'.$row->active.'" class="btn-status glyphicon ';
               
                $result .= $row->icon_active;

                $result .='">';

                $result .= '</a>';
                $result .= '</td>';


              /*  $result .=   '<td>';
                $result .= '<a href="';
                $result .= $row->link_active;
                 $result .= '" data-action="isFooter" rel="'.$row->isFooter.'" class="btn-status glyphicon ';
               
                $result .= $row->icon_footer;

                $result .='">';

                $result .= '</a>';
                $result .= '</td>'; */

                $result .= '<td class="text-center">';
                $result .= '<a href="'.$row->link_update.'" class="btn-action glyphicon glyphicon-pencil"> </a>';

               
                $result .= '<a href="'.$row->link_delete.'" class="btn-action glyphicon glyphicon-trash"></a>
                        </td>
                    </tr>';
                
               $result .= $this->table_list_pages($row->id, $string, $i); 

            }
            
         }
        
        return $result;
    }


    function updateStatus()
    {
        $id = $this->uri->segment(4);
        // action is attribute such as : active, highlight...
        $action = trim($_POST['action']);
        //check pages exist
        if ($this->pages_model->check_exists(array('id' => $id))){
            // click ok status
            if ($_POST['active'] == 1)
            {
                $this->pages_model->updateData(array('id' => $id), array($action => 0));
                echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
            }
            else{
                $this->pages_model->updateData(array('id' => $id), array($action => 1));
                echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
            }
        }else{
            echo json_encode(array('error' => 'Bài viết này không tồn tại')); exit();
        }
    }


    function del_list_choose()
    {
        
        $list_id = explode(',', $_POST['list_id']);
        if (count($list_id) == 1)
        {
            if($list_id < 186 || $list_id > 191){
                $this->pages_model->deleteData($list_id);
            }

        }else{
            foreach ($list_id as $id) {

                if ($this->pages_model->check_exists(array('id' => $id))){
                    if($id < 186 || $id > 191){
                        $this->pages_model->deleteData($id);
                    }
                }
                else{
                    echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
                }
                
            }
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công bài viết');   
        echo json_encode(array('result' => admin_url('pages'))); exit(); 
    }

}