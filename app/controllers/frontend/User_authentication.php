<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();

        // Load facebook library
        $this->load->library('facebook');

        //load google login library
        $this->load->library('google');

        //Load user model
        $this->load->model('user');
    }

    public function index()
    {
        $userData = array();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            $userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];

            // Insert or update user data
            $userID = $this->user->checkUser($userData);

            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }

            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        }else{
            $fbuser = '';
            
            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }
        
        // Load login & profile view
        $this->load->view('user_authentication/index',$data);
    }

    public function logout() 
    {
        // Remove local Facebook session
        $this->facebook->destroy_session();

        // Remove user data from session
        $this->session->unset_userdata('userData');

        // Redirect to login page
        redirect('/user_authentication');
    }

    //google
    public function index_google()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        //redirect to profile page if user already logged in
        if($this->session->userdata('loggedIn') == true){
            redirect('user_authentication_google/profile/');
        }
        
        if(isset($_GET['code'])){
            
            //authenticate user
            $this->google->getAuthenticate();
            
            //get user info from google
            $gpInfo = $this->google->getUserInfo();
            
            //preparing data for database insertion
            $userData['oauth_provider'] = 'google';
            $userData['oauth_uid']      = $gpInfo['id'];
            $userData['first_name']     = $gpInfo['given_name'];
            $userData['last_name']      = $gpInfo['family_name'];
            $userData['email']          = $gpInfo['email'];
            $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
            $userData['locale']         = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
            $userData['profile_url']    = !empty($gpInfo['link'])?$gpInfo['link']:'';
            $userData['picture_url']    = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
            
            //insert or update user data to the database
            $userID = $this->user->checkUser($userData);
            
            //store status & user info in session
            $this->session->set_userdata('loggedIn', true);
            $this->session->set_userdata('userData', $userData);
            
            //redirect to profile page
            redirect('user_authentication_google/profile/');
        } 

        //google login url
        $data['loginURL'] = $this->google->loginURL();
        
        //load google login view
        $this->load->view('user_authentication/profile',$data);
    }
    
    public function profile()
    {
        //redirect to login page if user not logged in
        if(!$this->session->userdata('loggedIn')){
            redirect('/user_authentication_google/');
        }
        
        //get user info from session
        $data['userData'] = $this->session->userdata('userData');
        
        //load user profile view
        $this->load->view('user_authentication/profile',$data);
    }
    
    public function logout_google()
    {
        //delete login status & user info from session
        $this->session->unset_userdata('loggedIn');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        
        //redirect to login page
        redirect('/user_authentication/index_google');
    }
}