<?php class SiteSettings extends Admin_Controller 
{  
    public $outputData;		
	  
	function __construct()
	{
	    parent::__construct();
	   
		if(!isAdmin())
			redirect_admin('login');

		$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->model('backend/settings_model');
	} 
	
	function index()
	{	
		//Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
 				
		if($this->input->post('siteSettings')) {	
			$this->form_validation->set_rules('site_title','lang:site_title2_validation','required|trim|xss_clean');
		
			if($this->form_validation->run()) {
			    $updateData = $this->input->post();
			    $this->settings_model->updateSettings($updateData);
			    $this->session->set_flashdata('flash_message','Bạn vừa cập nhật cấu hình website thành công');

			    redirect('admin/siteSettings');
		 	} 
		} 
       
	   $this->outputData = [
            'currentPage' => 'site_settings',
            'pageTitle' => 'Cấu hình website',
            'subPage' => 'config',
            'settings' => $this->settings_model->getSiteSettings()
	   	];
	   
	    $this->render('admin/settings/siteSettings');   
	}
	
    function dbBackup()
    {
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/path/to/mybackup.gz', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');

		force_download('mybackup.gz', $backup);
    }

    function flushCache()
    {
    	$dirApp = APPPATH . 'cache/*';

    	$this->removeFileDir($dirApp);

    	closedir($dirApp);
    	$this->output->delete_cache();
    	$this->session->set_flashdata('flash_message','Xóa cache thành công');

    	redirect($_SERVER['HTTP_REFERER']);
    }

    function removeFileDir($dir = '') 
    {
    	$files = glob($dir);
    	foreach ($files as $file) {
		    if (is_file($file)) {
		        unlink($file);
		    }
		    if (is_dir($file)) {
		    	$this->removeFileDir($file.'/*');
		    }
		}
    }
}	