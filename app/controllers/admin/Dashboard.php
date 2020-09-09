<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends Admin_Controller 
{
    public function __construct() 
    {
        parent::__construct();
		
		if(!isAdmin())
			redirect('admin/login');
	
		$this->load->model('backend/auth_model');
    }

    public function index() 
    {
		$this->outputData = [
		     'adminlogin' => '1',
			 'currentPage' => 'admin_home',
			 'subPage' => 'admin_home',
			 'pageTitle' => 'Quản trị'
		];
		
        $this->render('admin/layout/dashboard');
    }
}