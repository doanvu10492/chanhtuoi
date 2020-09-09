<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends Admin_Controller
{
  function __construct()
  {
    parent::__construct();
 
    if(!isAdmin()) {
      $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
    }

    $this->load->model('backend/member_model');
  }
   
  public function index($group_id = NULL)
  { 
    $this->outputData['currentPage'] = 'member';
    $this->outputData['subPage'] = 'list_member';
    $this->outputData['page_title'] = 'Mebmer';
    $this->outputData['users'] = $this->member_model->users();

    $this->render('admin/member/list');
  }

  public function updated($id)
  {
    $this->load->library('form_validation');
    $this->load->helper('form');    
    //set_rules of feilds
    $this->form_validation->set_rules('company','Company','trim');
    $this->form_validation->set_rules('phone','Phone','trim');
    $this->form_validation->set_rules('full_name','Full name','trim');

    if($id == 0) {
      $this->form_validation->set_rules('username','Username','trim|required|callback_check_username');
    }

    if($this->input->post('password') != null || $id == 0) {
      $this->form_validation->set_rules('password','Password','required');
      $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
    }

    //$this->form_validation->set_rules('groups[]','Groups','required');
    //print_r($this->input->post('groups')); exit();
    if ($this->form_validation->run()) {
        $insert_data = array(
          'username' => ($this->input->post('username_hd') != NULL) ? ($this->input->post('username_hd')) : ($this->input->post('username')),
          'email' => $this->input->post('email'),
          'password' => ($this->input->post('password') != NULL) ? (md5($this->input->post('password'))) : ($this->input->post('password_hd')),
          'phone' => $this->input->post('phone'),
          'full_name' => $this->input->post('full_name'),
          'description' => $this->input->post('description'),
          'created' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
        );  

        if($id == 0) {
          $id = $this->member_model->add_user($insert_data);
          $this->session->set_flashdata('flash_message',"Bạn vừa thêm vào 1 tài khoản quản trị website");
          
          redirect_admin('member');
        } else {
           
          $this->member_model->update_user(array('id' => $id), $insert_data);
          $this->session->set_flashdata('flash_message',"Bạn vừa cập nhật 1 tài khoản quản trị website");
          redirect_admin('member');
        }
      }
      
      if($id == 0) {
        $this->outputData['page_title'] = 'Thêm khách hàng';
        $this->outputData['currentPage'] = 'member';
        $this->outputData['subPage'] = 'add_member';
        $this->outputData['button'] = 'Thêm';
        $this->outputData['groups'] = $this->member_model->groups();
        $this->outputData['id'] = $id;
      } else {
        $this->outputData['page_title'] = 'Cập nhật user';
        $this->outputData['currentPage'] = 'member';
        $this->outputData['subPage'] = 'add_member';
        $this->outputData['button'] = 'Cập nhật';
        $this->outputData['page'] = $this->member_model->get_user_edit(array('id'=>$id))->row();
        //list groups
        $this->outputData['groups'] = $this->member_model->groups();
        //list users groups of id
        $this->outputData['users_groups'] = $this->member_model->users_groups(array('user_id' => $id));
        $this->outputData['id'] = $id;
      }

      $this->render('admin/member/create');
  }
  
 
  public function delete($user_id = NULL)
  {
    if( ! $this->member_model->check_exists(array('id '=> $user_id, 'username !='=> 'admin' )) ) {
        $this->session->set_flashdata('error_message', 'Bạn không thể xóa tài khoản này');
        
        redirect('admin/member','refresh');
    }

    if(is_null($user_id)) {
      $this->session->set_flashdata('flash_message','There\'s no user to delete');
    } else {
      $this->member_model->delete_users_groups($user_id);
      $this->member_model->delete_user( array('id'=>$user_id) );
      $this->session->set_flashdata('flash_message', 'Bạn vừa xóa thành công 1 user');
    }

    redirect('admin/member','refresh');
  }


  // check username exists
  function check_username() 
  {
    if($this->member_model->check_exists(array('username'=> $this->input->post('username')))) {
      return false;
    }

    return true;
  }

  function updateStatus()
  {
    $id = $this->uri->segment(4);
    // action is attribute such as : active, highlight...
    $action = trim($_POST['action']);

    // check product exist
    if ($this->member_model->check_exists(array('id' => $id))) {
      // click ok status
      if ($_POST['active'] == 1) {
        $this->member_model->update_user(array('id' => $id), array($action => 0));
        echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
      } else {
        $this->member_model->update_user(array('id' => $id), array($action => 1));
        echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
      }
    } else {
      echo json_encode(array('error' => 'Bài viết này không tồn tại')); exit();
    }
  }
    
  function del_list_choose()
  {
    $list_id = explode(',', $_POST['list_id']);

    if (count($list_id) == 1) {
      $this->member_model->deleteData($list_id);
    } else {
      foreach ($list_id as $id) {
        if ($this->member_model->check_exists(array('id' => $id))) {
          $this->member_model->$this->member_model->delete_users_groups($id);
          $this->member_model->$this->member_model->delete_users($id);
        } else {
          echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
        }
      }
    }

    $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công 1 tài khoản'); 

    echo json_encode(array('result' => admin_url('member'))); exit(); 
  }

}