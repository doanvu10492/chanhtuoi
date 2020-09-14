<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();

        $this->load->library('facebook');
        $this->load->library('google');
        $this->load->model('user');
    }

    public function index()
    {
        $userData = array();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

        if ($this->facebook->is_authenticated()) {
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            $userdata = [
                'oauth_provider' => 'facebook',
                'oauth_uid' =>  $userProfile['id'],
                'first_name' => $userProfile['first_name'],
                'last_name' => $userProfile['last_name'],
                'email' => $userProfile['email'],
                'gneder' => $userProfile['gender'],
                'locale' => $userProfile['locale'],
                'profile_url' => 'https://www.facebook.com/' . $userProfile['id'],
                'picture_url' => $userProfile['picture']['data']['url']
            ];

            $userID = $this->user->checkUser($userData);

            if (!empty($userID)) {
                $data['userData'] = $userData;
                $this->session->set_userdata('userData', $userData);
            } else {
               $data['userData'] = array();
            }

            $data['logoutUrl'] = $this->facebook->logout_url();
        } else {
            $data['authUrl'] =  $this->facebook->login_url();
        }
        
        $this->load->view('user_authentication/index',$data);
    }

    public function logout() 
    {
        $this->facebook->destroy_session();
        $this->session->unset_userdata('userData');
        redirect('/user_authentication');
    }

    public function index_google()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

        if ($this->session->userdata('loggedIn') == true){
            redirect('user_authentication_google/profile/');
        }
        
        if (isset($_GET['code'])) {
            $this->google->getAuthenticate();
            $gpInfo = $this->google->getUserInfo();

            $userdata = [
                'oauth_provider' => 'google',
                'oauth_uid' =>  $gpInfo['id'],
                'first_name' => $gpInfo['given_name'],
                'last_name' => $gpInfo['family_name'],
                'email' => $gpInfo['email'],
                'gneder' => !empty($gpInfo['gender'])?$gpInfo['gender']:'',
                'locale' => !empty($gpInfo['locale'])?$gpInfo['locale']:'',
                'profile_url' => !empty($gpInfo['link'])?$gpInfo['link']:'',
                'picture_url' => !empty($gpInfo['picture']) ? $gpInfo['picture'] : ''
            ]
            
            $userID = $this->user->checkUser($userData);
            $this->session->set_userdata('loggedIn', true);
            $this->session->set_userdata('userData', $userData);
            
            redirect('user_authentication_google/profile/');
        } 

        $data['loginURL'] = $this->google->loginURL();
        $this->load->view('user_authentication/profile',$data);
    }
    
    public function profile()
    {
        if (!$this->session->userdata('loggedIn')) {
            redirect('/user_authentication_google/');
        }
        
        $data['userData'] = $this->session->userdata('userData');
        $this->load->view('user_authentication/profile',$data);
    }
    
    public function logoutGoogle()
    {
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        
        redirect('/user_authentication/index_google');
    }
}