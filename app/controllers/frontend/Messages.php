<?php
class Messages extends CI_Controller 
{
    public $outputData;
	public $loggedInUser;
	function __construct()
	{
		parent::__construct();
		
		$this->config->db_config_fetch();
	   
		if($this->config->item('site_status') == 1)
		redirect('offline');
		$this->load->model('settings_model');
		/// get thong tin lien he
		$this->outputData['settings']	 = 	$this->settings_model->getSiteSettings();
	}
	
	function checkMessages()
	{
		$this->load->model('messages_client');
		
		if($this->input->post('email_nhantin')!=''){
			$condition = array('email_nhantin.email_nhantin'=>$this->input->post('email_nhantin'));
			$check_email = $this->messages_client->check_email($condition)->result();
			if($this->input->post('dangkynhantin') && count($check_email)<=0)
			{
				$email_nhantin = $this->input->post('email_nhantin');
				$editData['email_nhantin']  	= $email_nhantin;
				//$editData['name_company']  	=  $this->input->post('name_company');
				//$editData['phone']  	=  $this->input->post('phone');
				//$editData['address']  	=  $this->input->post('address');
				$this->messages_client->addemail($editData);
				$this->load->model('settings_model');
				
				
				$settings	 = 	$this->settings_model->getSiteSettings();
				$this->outputData['current_page'] = 'messages';
				$this->outputData['page_title'] = "Tin nhắn".$settings['SITE_TITLE'];
				$this->outputData['meta_keywords'] =  $settings['METAKEYWORDS'];
				$this->outputData['meta_description'] = $settings['METADES'];
				$this->outputData['des_thongbao'] = 'Cảm ơn bạn đã đăng ký dịch vụ nhận email của chúng tôi. Chúng tôi sẽ gửi mail cho bạn khi có những dịch vụ mới.<br /> Chân thành cảm ơn';
				$this->load->view('messages/messages',$this->outputData);
			}else{
				$settings	 = 	$this->settings_model->getSiteSettings();
				$this->outputData['current_page'] = 'messages';
				$this->outputData['page_title'] = "Tin nhắn".$settings['SITE_TITLE'];
				$this->outputData['meta_keywords'] =  $settings['METAKEYWORDS'];
				$this->outputData['meta_description'] = $settings['METADES'];
				$this->outputData['des_thongbao'] = 'Email của bạn đã có người đăng ký rồi. Xin vui lòng đăng ký email khác...';
				$this->load->view('messages/messages',$this->outputData);
			}
		}else{
			$settings	 = 	$this->settings_model->getSiteSettings();
			$this->outputData['current_page'] = 'messages';
			$this->outputData['page_title'] = "Tin nhắn".$settings['SITE_TITLE'];
			$this->outputData['meta_keywords'] =  $settings['METAKEYWORDS'];
			$this->outputData['meta_description'] = $settings['METADES'];
			$this->outputData['des_thongbao'] = 'Bạn chưa nhập email của bạn. Vui lòng nhập email và gửi lại cho chúng tôi. Chân thành cảm ơn';
			$this->load->view('messages/messages',$this->outputData);
		}
	}
}

?>
