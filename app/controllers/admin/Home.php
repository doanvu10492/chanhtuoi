<?php 
class Home extends CI_Controller 
{
	public $outputData;
	public $loggedInUser;

	public function __construct()
	{
		parent::__construct();
		
		// Check For Admin Logged in
		if(!isAdmin())
			redirect_admin('login');
		
		// Get Config Details From Db
		$this->config->db_config_fetch();
			
		// Load the language file
		$this->lang->load('admin/common', $this->config->item('language_code'));	
		$this->lang->load('admin/login', $this->config->item('language_code'));
		$this->lang->load('admin/validation',$this->config->item('language_code'));	
		
		// load models required
		$this->load->model('common_model');
		$this->load->model('auth_model');
		$this->load->model('skills_model');
		$this->load->model('admin_model');
	} 
	
	public function index()
	{
		if(!isAdmin())
			redirect_admin2('login');
		else
		    $this->outputData['adminlogin'] = '1';
		
		$this->outputData['current_page'] = 'admin_home';
		$this->outputData['sub_page'] = 'admin_home';
		
		$this->load->view('admin/layout/home',$this->outputData);
	}
}
