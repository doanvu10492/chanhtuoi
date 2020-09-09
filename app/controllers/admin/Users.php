<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Admin_Controller
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
  * Current page posts
  */
  public $currentPage = 'users';

  /**
  * Search keys prepare 
  */
  public $searchKeys = ['email', 'group_id'];
  
    function __construct()
    {
        parent::__construct();

        if (!isAdmin()) {
          $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
        }

        $this->load->model('backend/auth_model');
        $this->load->model('backend/address_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
   
  public function index($group_id = NULL)
  {
    $condition = []; 
    $getRequest = $this->input->get();

    foreach ($getRequest as $key => $value) {
        if ($value && in_array($key, $this->searchKeys)) {
            $condition[$key] = $value;
        }
    }

    $this->getLimit();
    $this->_total = count($this->auth_model->users($condition));
    $pagination = $this->getPagination();
    $collection = $this->auth_model->users($condition, $this->limit);

    $this->outputData = [
      'pageTitle' => 'Danh sách tài khoản',
      'currentPage' => 'posts',
      'subPage'=> 'list_users',
      'users' => $collection,
      'pagination' => $pagination,
      'sort_field' => $this->session->userdata('posts_field'),
            'icon_sort' => ($this->session->userdata('posts_sort') == 'desc') ? ('<i class="fa fa-sort-up" aria-hidden="true"></i>') : ('<i class="fa fa-sort-desc" aria-hidden="true"></i>'),
      'getRequest' => $getRequest,
      'groups' => $this->auth_model->groups()
    ]; 

    $this->render('admin/users/list_users');
  }


  public function login()
  { 
    if (isAdmin()) {
      redirect('admin','refresh');
    }

    if ($this->input->post('username')) {
      
      $this->form_validation->set_rules(
        'username', 
        'Username', 
        'required'
      )->set_rules(
        'password', 
        'Password', 
        'required'
      );
      
      if ($this->form_validation->run()) {
        $remember = (bool) $this->input->post('remember');
        if ($this->auth_model->login(
          $this->input->post('username'), 
          $this->input->post('password'), 
          $remember)) {

          redirect('admin', 'refresh');
        } else {
          $this->session->set_flashdata('flash_message', 'Vui lòng nhập chính xác tài khoản quản trị');
          redirect_admin('users/login', 'refresh');
        }
      }
    }
    
    $this->outputData = [
      'pageTitle' => 'Login',
      'currentPage' => 'Login',
      'subPage' => 'Login'
    ];
    
    $this->load->view('admin/layout/login','master');
  }
   
  public function logout()
  {
    $this->auth_model->logout();
    $this->session->set_flashdata('message', "Bạn vừa đăng xuất khỏi hệ thống quản trị");
    
    redirect_admin('users/login');
  }
  
  public function updated($id)
  {
    $this->form_validation->set_rules(
      'company',
      'Company',
      'trim'
    )->set_rules(
      'phone',
      'Phone',
      'trim'
    )->set_rules(
      'full_name',
      'Full name',
      'trim'
    )->set_rules(
      'groups',
      'Groups',
      'required'
    );

    if ($id == 0) {
      $this->form_validation->set_rules(
        'username',
        'Username',
        'trim|required|callback_check_username'
      );
    }

    if($this->input->post('password') && $id != 0){
      $this->form_validation->set_rules(
        'password',
        'Password',
        'required'
      )->set_rules(
        'password_confirm',
        'Password confirmation',
        'required|matches[password]'
      );
    }

    if ($this->form_validation->run()) {
        $insert_data = [
          'username' => $this->input->post('username'),
          'email' => $this->input->post('email'),
          'password' => ($this->input->post('password') != NULL) ? (md5($this->input->post('password'))) : ($this->input->post('password_hd')),
          'first_name' => $this->input->post('first_name'),
          'last_name' => $this->input->post('last_name'),
          'company' => $this->input->post('company'),
          'address_id' => $this->input->post('address_id'),
          'phone' => $this->input->post('phone'),
          'active' => 1,
          'full_name' => $this->input->post('full_name'),
          'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
        ];  
        
        if ($id == 0) {
          $id = $this->auth_model->add_user($insert_data);

          $this->auth_model->insert_users_groups($id, array($this->input->post('groups')));
          $this->session->set_flashdata('flash_message',"Bạn vừa thêm vào 1 tài khoản quản trị website");
        } else {
          $this->auth_model->update_user(array('id' => $id), $insert_data);
          if ($this->auth_model->delete_users_groups($id)){
             $this->auth_model->insert_users_groups($id, array($this->input->post('groups')));
          }
          
          $this->session->set_flashdata('flash_message',"Bạn vừa cập nhật 1 tài khoản quản trị website");
        }
        
        redirect_admin('users'.$this->session->userdata('query_href_back'));
      }
      
      if ($id == 0) {
        $this->outputData['pageTitle'] = 'Tạo tài khoản';
        $this->outputData['currentPage'] = 'users';
        $this->outputData['subPage'] = 'add_user';
        $this->outputData['groups'] = $this->auth_model->groups();
        $this->outputData['id'] = $id;
      } else {
        $this->outputData['pageTitle'] = 'Cập nhật';
        $this->outputData['currentPage'] = 'users';
        $this->outputData['subPage'] = 'update_user';
        $this->outputData['page'] = $this->auth_model->get_user_edit(array('id'=>$id))->row();
        //list groups
        $this->outputData['groups'] = $this->auth_model->groups();
        //list users groups of id
        $this->outputData['users_groups'] = $this->auth_model->users_groups(array('user_id' => $id));
       
        $this->outputData['id'] = $id;
      }

      $this->outputData['selectAddress'] = $this->address_model->list()->result_array();
      $this->render('admin/users/create_users');
    }
  
 
  public function delete($user_id = NULL)
  {
    if ( ! $this->auth_model->check_exists(array('id '=> $user_id, 'username !='=> 'admin' )) ) {
        $this->session->set_flashdata('error_message', 'Bạn không thể xóa tài khoản này');
         redirect('admin/users','refresh');
    }

    if (is_null($user_id)) {
      $this->session->set_flashdata('flash_message','There\'s no user to delete');
    } else {
      $this->auth_model->delete_users_groups($user_id);
      $this->auth_model->delete_user( array('id'=>$user_id) );
      $this->session->set_flashdata('flash_message', 'Bạn vừa xóa thành công 1 user');
    }
    redirect('admin/users','refresh');
  }

  function check_username()
  {
   
    if($this->auth_model->check_exists(array('username'=> $this->input->post('username')))){
      return false;
    }
    return true;

  }

  function updateStatus() 
  {
    $this->updateStatusAdmin($this->auth_model, $this->uri->segment(4));    
  }
    
    function del_list_choose()
    {
      
      $list_id = explode(',', $_POST['list_id']);
      if (count($list_id) == 1)
      {
        $this->auth_model->deleteData($list_id);
      }else{
        foreach ($list_id as $id) {
            if ($this->auth_model->check_exists(array('id' => $id))){
              $this->auth_model->$this->auth_model->delete_users_groups($id);
              $this->auth_model->$this->auth_model->delete_users($id);
            }
            else{
                    echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
            }
          }
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công 1 tài khoản');   
        echo json_encode(array('result' => admin_url('posts/index'))); exit(); 
    }

  public function getLimit()
  {
    if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
        $this->perPage = $_GET['per_page'];
    }

    $this->limit = array($this->numberPage, $this->perPage);
  }

}
  