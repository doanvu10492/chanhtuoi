<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Public_Controller
{
  public $outputData;
 
  function __construct()
  {
    parent::__construct();

    if(!isAdmin()) {
      $this->session->set_flashdata('message','You are not allowed to visit the Groups page');
      //redirect('admin','refresh');
    }

    $this->load->model('frontend/member_model');
      
    // Load facebook library
    $this->load->library('facebook');


    //Load user model
    $this->load->model('frontend/user');
    parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

  
  }
   
  public function index($group_id = NULL)
  { 
    $this->outputData['current_page'] = 'member';
    $this->outputData['sub_page'] = 'list_users';
    $this->outputData['page_title'] = 'Users';
    $this->outputData['users'] = $this->member_model->users();

    $this->render('admin/users/list_users');
  }


  public function login()
  {
    $userData = array();
    parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

    // if(isset($_GET['code']) && $this->facebook->is_authenticated()) {  
    //     // Get user facebook profile details
    //     $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture, photos');
    //     // Preparing data for database insertion
    //     $userData['oauth_provider'] = 'facebook';
    //     $userData['oauth_uid'] = $userProfile['id'];
    //     $userData['first_name'] = $userProfile['first_name'];
    //     $userData['last_name'] = $userProfile['last_name'];
    //     $userData['email'] = $userProfile['email'];
    //     $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
    //     $userData['picture_url'] = "http://graph.facebook.com/".$userProfile['id']."/picture?type=square";

    //       // Insert or update user data
    //     $userID = $this->user->checkUser($userData);
      

    //     // Check user data insert or update status
    //     if(!empty($userID)) {
    //       $data['userData'] = $userData;
    //       $this->session->set_userdata('userData',$userData);

    //       $values = array('member_id' => $userData['oauth_uid'], 'member_name' => $userData['last_name'], 'member_role' => 'member', 'login_member' => TRUE, 'member_phone' => "", 'member_email' => $userData['email'], 'member_address' => $userData['locale'], 'username' => '');
    //       $this->session->set_userdata(array('CI_login' => $values));

    //       redirect('');

    //     } else {
    //        $data['userData'] = array();
    //     }

    //     // Get logout URL
    //     $data['logoutUrl'] = $this->facebook->logout_url();

    // } elseif( isset($_GET['code']) ) {
    //         $this->google->getAuthenticate();
    //         //get user info from google
    //         $gpInfo = $this->google->getUserInfo();
    //         //preparing data for database insertion
    //         $userData['oauth_provider'] = 'google';
    //         $userData['oauth_uid']      = $gpInfo['id'];
    //         $userData['first_name']     = $gpInfo['given_name'];
    //         $userData['last_name']      = $gpInfo['family_name'];
    //         $userData['full_name']      = $gpInfo['given_name'].' '.$gpInfo['family_name'];
    //         $userData['email']          = $gpInfo['email'];
    //         $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
    //         $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
    //         $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
    //         $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
    //          //insert or update user data to the database
    //         $userID = $this->user->checkUser($userData);
            
    //         if( ! empty($userID) ) {
    //           $data['userData'] = $userData;
    //           $this->session->set_userdata('userData',$userData);

    //           $values = array('member_id' => $userData['oauth_uid'], 'member_name' => $userData['last_name'], 'member_role' => 'member', 'login_member' => TRUE, 'member_phone' => "", 'member_email' => $userData['email'], 'member_address' => $userData['locale'], 'username' => '');
    //           $this->session->set_userdata(array('CI_login' => $values));
    //         }

    //         redirect();
    //         //store status & user info in session
    //         $this->session->set_userdata('loggedIn', true);
    //         $this->session->set_userdata('userData', $userData);    
    //         redirect('/');
    //     } 

    // $this->outputData['auth_facebook'] =  $this->facebook->login_url();
    // // Get login facebook URL
    // $this->outputData['auth_google'] =  $this->google->loginURL();
    $this->outputData['error'] = "";

    if($this->input->post('username')) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');
      //$this->form_validation->set_rules('remember','Remember me','integer');

      if($this->form_validation->run()===TRUE) {
        //print_r("expression"); exit();
        $remember = (bool) $this->input->post('remember');

        if ($this->member_model->login($this->input->post('username'), $this->input->post('password'), $remember)) {
          redirect('./xem-thong-tin', 'refresh');
        } else {
          $this->outputData['error'] = "Vui lòng nhập chính xác tài khoản đăng nhập"; 
          $this->session->set_flashdata('flash_message', 'Vui lòng nhập chính xác tài khoản đăng nhập');
        }
      }
    }
    $this->load->helper('form');
    $this->outputData['page_title'] = "Đăng nhập vào website";
    $this->outputData['current_page'] = "member";

    $this->load->view('frontend/user/login',$this->outputData);
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
    //$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[dv_users.email]');

    if($this->input->post('password') && $id != 0) {
      $this->form_validation->set_rules('password','Password','required');
      $this->form_validation->set_rules('password_confirm','Password confirmation','required|matches[password]');
    }

    $this->form_validation->set_rules('groups[]','Groups','required');
    //print_r($this->input->post('groups')); exit();

    if($this->form_validation->run()) {
        $insert_data = array(
          'username' => ($this->input->post('username_hd') != NULL) ? ($this->input->post('username_hd')) : ($this->input->post('username')),
          'email' => $this->input->post('email'),
          'password' => ($this->input->post('password') != NULL) ? (md5($this->input->post('password'))) : ($this->input->post('password_hd')),
          'first_name' => $this->input->post('first_name'),
          'last_name' => $this->input->post('last_name'),
          'company' => $this->input->post('company'),
          'phone' => $this->input->post('phone'),
          'full_name' => $this->input->post('full_name'),
          'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
        ); 

        if($id == 0) {
          $id = $this->member_model->add_user($insert_data);
          //add user into groups
          $this->member_model->insert_users_groups($id, $this->input->post('groups'));
          $this->session->set_flashdata('flash_message',"Bạn vừa thêm vào 1 tài khoản quản trị website");
          redirect_admin('users');
        } else {
           
          $this->member_model->update_user(array('id' => $id), $insert_data);

          //delete id_users_groups old to save new id_users_group
          if($this->member_model->delete_users_groups($id)) {
             // add new users groups
             $this->member_model->insert_users_groups($id, $this->input->post('groups'));
          }

          $this->session->set_flashdata('flash_message',"Bạn vừa cập nhật 1 tài khoản quản trị website");

          redirect_admin('users');
        }
      }
      
      if($id == 0) {
        $this->outputData['page_title'] = 'Create user';
        $this->outputData['current_page'] = 'member';
        $this->outputData['sub_page'] = 'add_user';
        $this->outputData['groups'] = $this->member_model->groups();
        $this->outputData['id'] = $id;
      } else {
        $this->outputData['page_title'] = 'Cập nhật user';
        $this->outputData['current_page'] = 'users';
        $this->outputData['sub_page'] = 'update_user';
        $this->outputData['page'] = $this->member_model->get_user_edit(array('id'=>$id))->row();
        //list groups
        $this->outputData['groups'] = $this->member_model->groups();
        //list users groups of id
        $this->outputData['users_groups'] = $this->member_model->users_groups(array('user_id' => $id));
       
        $this->outputData['id'] = $id;
      }

      $this->render('admin/users/create_users');
    }
  
 
  public function delete($user_id = NULL)
  {
    if( ! $this->member_model->check_exists(array('id '=> $user_id, 'username !='=> 'admin' )) ) {
        $this->session->set_flashdata('error_message', 'Bạn không thể xóa tài khoản này');
         redirect('admin/users','refresh');
    }

    if(is_null($user_id)) {
      $this->session->set_flashdata('flash_message','There\'s no user to delete');
    } else {
      $this->member_model->delete_users_groups($user_id);
      $this->member_model->delete_user( array('id'=>$user_id) );
      $this->session->set_flashdata('flash_message', 'Bạn vừa xóa thành công 1 user');
    }

    redirect('admin/users','refresh');
  }


  // check username exists
  function check_username() 
  {
    if($this->member_model->check_exists(array('username'=> $this->input->post('username')))) {
      //$this->session->set_flashdata('error', "Tài khoản này đã tồn tại vui lòng nhập tài khoảng khác");
      return false;
    }

    return true;
  }

  function change_password() 
  {
    $this->load->view('frontend/user/change_password', $this->outputData);
  }

  function infor_user() 
  {
    $this->load->view('frontend/user/user_infor', $this->outputData);
  }

  function register() 
  {
    $this->load->model('member_model');
    $this->load->library('form_validation');    
    //Load Form Helper
    $this->load->helper('form');
    //Intialize values for library and helpers  
    $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
 
    ////Get Form Details
    if(isset($_POST['register-memeber'])) {
        $error_username = '';
        $error_password = '';
        $error_email = '';
        $error_phone = '';
        $error_name = ''; 
        $error_repassword = ''; 

      if ( $_POST['username'] == '') {
        $error_username = "Tên tài khoản không được bỏ trống !";
      } else if (strlen($_POST['username']) < 4 && strlen($_POST['username']) >= 16) {
        $error_username = "username phải lớn 4 ký tự và nhỏ hơn hoặc bằng 16 ký tự !";
      } else if(!$this->check_username($_POST['username'])) {
        $error_username = "Tài khoản '".$_POST['username']."' này đã tồn tại";
      }

      if ($_POST['password'] == '') {
        $error_password = "Mật khẩu không được bỏ trống !";
      } else if (strlen($_POST['password']) <= 6) {
        $error_password = "Mật khẩu phải lớn hơn 6 ký tự !";
      }
      
      if ($_POST['re_password'] != $_POST['password']) {
        $error_repassword = "Mật khẩu không đúng !";
      }

      if ($_POST['email'] == '') {
        $error_email = 'Email không được bỏ trống';
      } else if(count($this->member_model->check_exists( array(TB_MEMBER.'.email' => $_POST['email']))) > 0 ) {
        $error_email = "Email : '".$_POST['email']."' này đã được đăng ký, vui lòng nhập email khác";
      } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error_email = 'Email không đúng định dạng VD: example@gmail.com';
      }

      if ($_POST['name'] == '') {
        $error_name = 'Họ tên không được bỏ trống';
      }

      if ($_POST['phone'] == '') {
        $error_phone = 'Số điện thoại không được bỏ trống';
      }
      else if(!preg_match('/^\d{10,14}$/',$_POST['phone'])) {
        $error_phone =  'Số điện thoại phải là số ít nhất 10 số VD: 0978345768';
       
      }

      if ($error_username != '' || $error_password != ''  || $error_phone != '' || $error_email != '' || $error_name != '' || $error_repassword != '') {
                
        echo json_encode(array('error_username' => $error_username, 'error_password' => $error_password, 'error_email' => $error_email, 'error_phone' => $error_phone, 'error_name' => $error_name, 'error_repassword' => $error_repassword, 'error_name' => $error_name )); exit();
      } else {
        $insertdata = array(
          'username' => $_POST['username'],
          'password' => md5($_POST['password']),
          'email' => $_POST['email'],
          'full_name' => $_POST['name'],
          'phone' => $_POST['phone'],
          //'type_account' => $_POST['type_account'],
          'notes' => $_POST['notes'],
          'address' => $_POST['address'],
          //'area' => $_POST['area'],
          'active' => 1
        );    
              
        $this->member_model->add_user($insertdata);
        $data = $this->member_model->login($_POST['username'], $_POST['password']);
        
        if (count($data) > 0) {
            echo json_encode(array('result' => "Chúc mừng bạn đã đăng ký thành công")); exit();
        } 

        echo json_encode(array('result' => "Chúc mừng bạn đã đăng ký thành công")); exit();

      }

      redirect('./dang-ky');
    } //If - Form Submission End
    
    
    
    $this->outputData['current_page'] = "member";
    $this->outputData['page_title'] = "Đăng ký thành viên";
    $this->outputData['meta_keywords'] = "Đăng ký thành viên";
    $this->outputData['meta_description'] = "Đăng ký thành viên";

    $this->load->view('frontend/user/register',$this->outputData);
  
  }


  function logout()
  {
    $this->session->sess_destroy();
    // $this->member_model->logout();
    $this->session->set_flashdata('message', "Bạn vừa đăng xuất thành công");

    redirect($_SERVER['HTTP_REFERER']);
  }


  public function update_infor()
  {
    if ($this->session->userdata('CI_login')) {
      $login = $this->session->userdata('CI_login');  
      $this->load->model('member_model');
      $this->load->library('form_validation');    
      
      //Load Form Helper
      $this->load->helper('form');
      
      //Intialize values for library and helpers  
      $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
      $data = array();

      if($login) {

        if($login['username'] != null) {
           $data = $this->member_model->get_user_edit(array('username' => $login['username']))->row();
        } else {
          $data = $this->member_model->get_user_edit(array('oauth_uid' => $login['member_id']))->row();
        }
      }           
      ////action update info

      if(isset($_POST['update_memeber'])) {
          $error_email = '';
          $error_phone = '';
          $error_name = ''; 
      
      if ($_POST['email'] == '') {
        $error_email = 'Email không được bỏ trống';
      } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Email không đúng định dạng VD: example@gmail.com';
      } else if(count($this->member_model->check_exists( array(TB_MEMBER.'.username !=' => $login['username'], TB_MEMBER.'.email' => $_POST['email'] ))) > 0) {
          $error_email = "Email : ".$_POST['email']." này đã được đăng ký, vui lòng nhập email khác";
        }

        if ($_POST['name'] == '') {
          $error_name = 'Họ tên không được bỏ trống';
        }

        if ($_POST['phone'] == '') {
          $error_phone = 'Số điện thoại không được bỏ trống';
        } else if(!preg_match('/^\d{10,14}$/',$_POST['phone'])) {
          $error_phone =  'Số điện thoại phải là số ít nhất 10 số VD: 0978345768';
        }
        
        //echo json_encode(array('error' => '4444')); exit();
        if ( $error_phone != '' || $error_email != '' || $error_name != '' ) {
                  
          echo json_encode(array('error_email' => $error_email, 'error_phone' => $error_phone, 'error_name' => $error_name )); exit();
        }
        else{     
            // insertdata         
          $updateData = array(                  
              'email' => $_POST['email'],
              'full_name' => $_POST['name'],
              'birthday' => $_POST['birthday'],
              'gender' => $_POST['gender'],
              'phone' => $_POST['phone'],
              'skype' => $_POST['skype'],
              'notes' => $_POST['notes'],
              'type_account' => $_POST['type_account'],
              'address' => $_POST['address']                
            
          );
                  $this->member_model->update_user(array('id' => $login['member_id']),$updateData);
          echo json_encode(array('result' => "Cập nhật thành công")); exit();
        }  
      } //If - Form Submission End
           

      //Action change password
      $change_pass = '';
           
      if ($this->uri->segment(1) == 'doi-mat-khau') {
          $change_pass = "change_pass"; 

          if (isset($_POST['change_pass'])) {
              $error_password = '';
              $error_repassword = ''; 

          if ($_POST['password'] == '') {
            $error_password = "Mật khẩu không được bỏ trống !";
          } else if (strlen($_POST['password']) <= 6) {
            $error_password = "Mật khẩu phải lớn hơn 6 ký tự !";
          }
  
          if ($_POST['re_password'] != $_POST['password']) {
            $error_repassword = "Mật khẩu không đúng !";
          }

          if ( $error_repassword != '' || $error_password != '') {
            echo json_encode(array('error_repassword' => $error_repassword, 'error_password' => $error_password )); exit();
          }

          $updateData = array(                  
            'password' => md5($_POST['password']),
          );

          $this->member_model->update_user(array('id' => $login['member_id']),$updateData);
          echo json_encode(array('result' => "Đổi mật khẩu thành công")); exit();
        } 
      }

      $settings  =  $this->settings_model->getSiteSettings();

      if( $this->uri->segment(1) == "doi-mat-khau") {
        $this->outputData['current_page'] = 'member';
        $this->outputData['page_title'] = 'Thay đổi mật khẩu';
        $this->outputData['change_pass'] = $change_pass;
        $this->outputData['meta_keywords'] = 'Thay đổi mật khẩu';
        $this->outputData['meta_description'] = 'Thay đổi mật khẩu';
        $this->load->view('frontend/user/change_password',$this->outputData);
      } else {
        $this->outputData['current_page'] = 'member';
        $this->outputData['page_title'] = 'Cập nhật thông tin';
        $this->outputData['infor_user'] = $data;
        $this->outputData['meta_keywords'] = 'Cập nhật thông tin';
        $this->outputData['meta_description'] = 'Cập nhật thông tin';
        $this->load->view('frontend/user/user_infor',$this->outputData);
      }    
      
    } else {
      redirect('./dang-nhap');
    }
    
  }
  

 
}