<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends Admin_Controller 
{
	public $outputData;

    public function __construct()
    {
    	parent::__construct();
        
        if (!isAdmin())
			redirect_admin('login');

    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/menu_model');
    }

    public function index()
    {
    	$this->outputData = array(
			'pageTitle' => 'Danh sách menu',
			'currentPage' => 'menu',
			'subPage'=> 'list_menu',
			'list_category' => $this->tableListMenu(),
            'delAll' => admin_url('menu/delListChoose'),
            'addNew' => admin_url('menu/updated/0')
		);

	    $this->render('admin/menu/list');
    }
   
    public function updated($id)
    {	
        $menu =  $this->menu_model->getDetailData(['id'=>$id]);

	    if ($id) {
            $pageTitle = 'Chỉnh sửa danh mục bài viết';
            $parentId = $menu->id_parent;
            $option = $this->select_option->dropdown_pages(['table' => TB_MENU], '', '',$parentId);
            $action = 'Cập nhật';
	    } else {
            $pageTitle = 'Thêm danh mục mới';
            $option = $this->select_option->dropdown_pages(['table' => TB_MENU]);
            $action = 'Thêm mới';
	    }

        $this->outputData = [
            'pageTitle' => $pageTitle,
            'currentPage' => 'menu',
            'page' => $menu,
            'id' => $id,
            'subPage' => '',
            'action' => $action,
            'option' => $option,
            'linkSave' => admin_url('menu/save')
        ];
	    
		$this->render('admin/menu/update');
    }

    public function save()
    {
        $id = $this->input->post('id');

    	$this->form_validation->set_error_delimiters(
            $this->config->item('field_error_start_tag'), 
            $this->config->item('field_error_end_tag')
        )->set_rules(
            'name',
            'lang:site_title_validation', 
            'trim|required|xss_clean'
        );
       
    	if ( ! $this->form_validation->run()) {
            $this->updated($id);
            return true;
        }

		$data = $this->input->post();
        $data['updated_user_id'] = $this->session->userdata('admin_id');
        $data['updated_at'] = date('Y-m-d H:i:s');
       
        if ($id) {
            $key = array('id' => $id);
            $this->menu_model->updateData($key, $data);
            $this->session->set_flashdata('flash_message','Cập nhật danh mục thành công !');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_user_id'] = $this->session->userdata('admin_id');
            $data['active'] = 1;
        	$this->menu_model->insertData($data);
            $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 danh mục mới');
        }
       
		redirect_admin('menu');   
    }

    public function delete($id)
    { 
		$this->menu_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('menu');		
    }

    public function updateStatus()
    {
        $id = $this->uri->segment(4);
        $this->updateStatusAdmin($this->menu_model, $id);
    }

    public function delListChoose()
    {
    	$this->delListChooseAdmin($this->menu_model);
           
        echo json_encode(['result' => admin_url('menu')]); exit(); 
    }

    public function tableListMenu($parentId = 0, $string = '', $i = 0)
    {
        $collection =  $this->menu_model->list_menu(['id_parent' => $parentId]);
        $result = '';

        if ($collection) {
            $string .= $string;
            foreach ($collection as $row) {
                $i++;
                $row->string = $string;
                $row->count = $i;
                $data['row'] = $row;
                $result .= $this->load->view('admin/menu/bodyMenu', $data, true);
                $result .= $this->tableListMenu($row->id, '---', $i); 
            }
            
        }
        
        return $result;
    }
}