<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends Public_Controller 
{
    public $outputData;
	public $loggedInUser;
	protected $secondSegment = null;
	
	public function __construct()
	{
		parent::__construct();
		$this->config->db_config_fetch();

		if ( ! $this->config->item('site_status'))
			redirect('offline');

		$this->secondSegment = [
			'name' => 'Liên hệ', 
			'link' => base_url() . 'lien-he.html' 
		];

		$this->load->model('frontend/contact_model');
	}

	public function index()
	{
        $this->load->library('form_validation');
		$this->load->helper('form');
        $this->form_validation->set_error_delimiters(
        	$this->config->item('field_error_start_tag'), 
        	$this->config->item('field_error_end_tag')
        );

	   if ($this->input->post('send')) {
			$this->form_validation->set_rules(
				'name',
				'lang:page_title_validation',
				'required|trim|xss_clean'
			);
			$this->form_validation->set_rules(
				'phone',
				'lang:page_title_validation',
				'required|min_length[10]|trim|xss_clean'
			);
			$this->form_validation->set_rules(
				'message',
				'lang:page_title_validation',
				'required|trim|xss_clean'
			);
			$this->form_validation->set_rules(
				'email',
				'lang:page_title_validation',
				'required|trim|xss_clean'
			);
			
			if ($this->form_validation->run()) {
				$insertData  = [
					'name' => $this->input->post('name'),
					'address'=> $this->input->post('address'),
					'phone' => $this->input->post('phone'),
					'email'=> $this->input->post('email'),
					'objects' => $this->input->post('objects'),
					'message' => $this->input->post('message'),
					'updated_at' => $this->getDateCurrent(),
	                'created_at' => $this->getDateCurrent(),
	                'type' => 'contact'
				];
				
				// if ($this->contact_model->insertData($insertData)) {		
				if ($insertData) {	
					$message = '<p>Email: '.$this->input->post('email') . '</p>';
					$message .= '<p><p>Họ tên: '.$this->input->post('name') . '</p>';
					$message .= '<p>SĐT: '.$this->input->post('phone') . "\n";
					$message .= '<p>Địa chỉ: '.$this->input->post('address') . '</p>';
					$message .= '<p>Tiêu đề: '.$this->input->post('objects') . '</p>';
					$message .= '<p>Nội dung: '.$this->input->post('message') . '</p>';

					require("class.phpmailer.php");
					$mail = new PHPMailer();

					$SMTP_Port = 465;
					$SMTP_UserName = $this->config->item('smtp_username');
					$SMTP_Password = $this->config->item('smtp_password');
					$from = $this->input->post('email');
					$fromName = "Gửi từ website" . $this->config->item('site_title');
					$to = $this->config->item('smtp_to_email');

					$mail->IsSMTP();
					$mail->Host     = "ssl://smtp.gmail.com";
					$mail->SMTPAuth = true;

					$mail->Username = $SMTP_UserName;
					$mail->Password = $SMTP_Password;
					$mail->Port 	= $SMTP_Port;
					$mail->From     = $from;
					$mail->FromName = $fromName;
					$mail->AddAddress($to);
					$mail->AddReplyTo($from, $fromName);

					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					$mail->CharSet = 'utf-8';

					$mail->Subject  =  "Email liên hệ từ khách hàng";
					$mail->Body     = $message;
					$mail->AltBody  =  "";

					if ( ! $mail->Send()) {
						print_r($this->email->print_debugger()); die;
						$this->session->set_flashdata('flash_message','Có lỗi trong quá trình gửi liên hệ');
						redirect('./lien-he');
					} 

					$this->session->set_flashdata('flash_message','Bạn vừa gởi email thành công');

					redirect('./lien-he');
				}

				$this->session->set_flashdata('flash_message','Có lỗi trong quá trình gửi liên hệ');

				redirect('./lien-he');
			}
		}

        $menu = $this->menu_model->getDetailData(['current_page' => 'contact']);
		$this->metaSeo($menu);

		$this->outputData['current_page'] = $this->uri->segment(1);
        $this->outputData['breadcrumb'] = __breadcrumb('', $this->secondSegment);

        $this->render_page('frontend/contact/contact');
	}

    /*
    * Add email from customer
    *
    * @return json
    */
	public function addEmail()
	{
		$arrRes = [
			'message' => 'Vui lòng nhập email !',
			'success' => false
		];
		if ($_POST['email'])	{
			if ( ! $this->contact_model->check_exists(array('email'=>$_POST['email']))) {
				if ( ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$arrRes['message'] = 'Email không đúng định dạng VD: example@gmail.com';
				}
         
                $this->contact_model->insertData(array('email' => $_POST['email'], 'type' => 'email', 'created_at' => date('Y-m-d H:i:s')));
                $arrRes = [
					'message' => 'Cảm ơn bạn đã gửi email nhận khuyến mãi cho chúng tôi !',
					'success' => true
				];
			} else {
				$arrRes['message'] = 'Email này hiện tại đã tồn tại vui lòng chọn email khác !';
			}
		}

		echo json_encode($arrRes); exit();
	}


	public function sendPhone()
	{
		$arrRes = [
			'message' => 'Vui lòng nhập email !',
			'success' => false
		];
		if($_POST['phone'])	{
			if(preg_match('/^\d{10,14}$/',$_POST['phone'])) {	
				$message = '';
				$message .= 'Số điện thoại được gửi từ website: '.base_url().'';
				$message .= '- SĐT: '.$_POST['phone'];
			    $toName = "Email số điện thoại";
				$toEmail = $this->config->item('site_admin_email');	 
				$mailFrom = $this->config->item('email');	
			   
			    $this->load->library('email');
				$config = $this->configSendEmail();
				$this->load->library('email', $config);
				$this->email->from($mailFrom , $this->config->item('site_title'));
				$this->email->to($toEmail);
				$this->email->subject($toName);
				$this->email->message($message);

				if ( ! $this->email->send()) {
					$arrRes['message'] = 'Có lỗi trong quá trình gửi số điện thoại !';
				} else {
					$arrRes = [
						'message' => 'Cảm ơn bạn đã gủi số điện thoại liên hệ cho chúng tôi !',
						'success' => true
					];
				}
			}
			$arrRes['message'] = 'Số điện thoại không hợp lệ !';
		}

		echo json_encode($arrRes); exit();
	}

	public function store()
	{
		$this->outputData['storeDefault'] = $this->page_model->viewSystemBranchs(['isHighlight' => 1 ]);
		$this->outputData['stores'] = $this->page_model->listSystemBranchs(['id_parent' => 0 ]);

		$this->outputData['subStore'] = $this->page_model->listSystemBranchs(['id_parent >' => 0 ]);
		
		$menu = $this->menu_model->getDetailData( array('current_page' => 'contact') );
		$settings	 = 	$this->settings_model->getSiteSettings();
		$this->outputData['current_page'] = $this->uri->segment(1);
        $this->outputData['page_title'] = ( $menu['meta_title'] != null) ? ( $menu['meta_title']) : ( $settings['meta_title']);
        $this->outputData['meta_keywords'] = ( $menu['meta_keywords'] != null) ? ( $menu['meta_keywords']) : ( $settings['meta_keywords']);;
        $this->outputData['meta_description'] = ( $menu['meta_description'] != null) ? ( $menu['meta_description']) : ( $settings['meta_description']);
        
		$this->render_page('frontend/contact/store');
	}

	public function getStoreBranch()
	{
		$arrRes = [
			'data' => '', 
			'error' => true
		]; 
		
		if (! $_GET['id']) {
			$arrRes['data'] = 'Bài viết không tồn tại !';
		} else {
			$storeDefault = $this->page_model->viewSystemBranchs(['id_cate' => $_GET['id'] ]);

			$result = '<div class="store-shop-left">';
			if ( count($storeDefault) > 0 ) { 
				$result .= '<div class="store-shop-detail">';
				$result .= '<h2>'.$storeDefault['name'].'</h2>';
				$result .= '<div class="box-shop-info">';
				$result .= '<figure><img src="'.$storeDefault['image'].'"></figure>';

				$result .= '<div class="desciption">';
				$result .=  $storeDefault['description'];
				$result .= '</div>';
				$result .= '</div>';
				$result .= '</div>';

				$result .= '<div class="store-shop-map">';
				$result .= '<p class="suggest">Tham khảo nếu chưa biết đường đi:</p>';
				$result .= '<p class="address">'.$storeDefault['address'].'</p>';
				$result .= '<div class="map">';
				$result .= $storeDefault['map'];
				$result .= '</div>';
				$result .= '</div>';
			}
			$result .= '</div>';

			$arrRes = [
				'data' => $result, 
				'error' => false
			]; 
		}

		echo json_encode($arrRes); exit();
	}

	/**
	* @param array $config
	* @return array
	*/
	public function configSendEmail($config = array())
	{	
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => $this->config->item('smtp_host'),
			'smtp_port' => 465,
			'smtp_user' => $this->config->item('smtp_username'),
			'smtp_pass' => $this->config->item('smtp_password'), 
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
		    'mailtype' => 'html', //plaintext 'text' mails or 'html'
		    'wordwrap' => TRUE
		];  
		return $config;
	}

	public function getDateCurrent()
	{
		return date('Y-m-d H:i:s');
	}

	public function registerLearn()
	{
		$resp = [
			'success' => false,
			'message' => 'Có lỗi xảy ra'
		];

		$this->load->library('form_validation');
		$this->form_validation->set_rules(
			'name',
			'lang:page_title_validation',
			'required|trim|xss_clean'
		);
		$this->form_validation->set_rules(
			'phone',
			'lang:page_title_validation',
			'required|min_length[10]|trim|xss_clean'
		);
		$this->form_validation->set_rules(
			'message',
			'lang:page_title_validation',
			'required|trim|xss_clean'
		);
		$this->form_validation->set_rules(
			'email',
			'lang:page_title_validation',
			'required|trim|xss_clean'
		);

		if ($this->form_validation->run()) {
			
		   	if( $_POST['register_learn']) {
		   		$formKey = $this->session->userdata('FORM_KEY');
		   		if ($_POST['form_key'] != $formKey) {
		   			$resp['message'] = 'Bạn thể truy cập !';
		   			echo json_encode($resp); 

		   			return false;
		   		}

				$message = '<p>Email: ' . $_POST['email'] . "</p>";
				$message .= '<p>Họ tên: ' . $_POST['name'] . "</p>";
				$message .= '<p>SĐT: '. $_POST['phone'] . "</p>";
				$message .= '<p>Hạng đăng ký: '. $_POST['degree'] . "</p>";
				$message .= '<p>Nội dung: '. $_POST['message'] . "</p>"; 

				$insertData  = [
					'name' => $this->input->post('name'),
					'phone' => $this->input->post('phone'),
					'email'=> $this->input->post('email'),
					'degree' => $this->input->post('degree'),
					'message' => $this->input->post('message'),
					'updated_at' => $this->getDateCurrent(),
	                'created_at' => $this->getDateCurrent(),
	                'type' => 'contact'
				];
				
				require("class.phpmailer.php");
				$mail = new PHPMailer();

				$SMTP_Port = 465;
				$SMTP_UserName = $this->config->item('smtp_username');
				$SMTP_Password = $this->config->item('smtp_password');
				$from = $this->input->post('email');
				$fromName = "Gửi từ website" . $this->config->item('site_title');
				$to = $this->config->item('smtp_to_email');
				
				$mail->IsSMTP();
				$mail->Host     = "ssl://smtp.gmail.com";
				$mail->SMTPAuth = true;

				$mail->Username = $SMTP_UserName;
				$mail->Password = $SMTP_Password;
				$mail->Port 	= $SMTP_Port;
				$mail->From     = $from;
				$mail->FromName = $fromName;
				$mail->AddAddress($to);
				$mail->AddCC('doanvu10492@gmail.com');
				$mail->AddReplyTo($from, $fromName);

				$mail->WordWrap = 50;
				$mail->IsHTML(true);
				$mail->CharSet = 'utf-8';

				$mail->Subject  =  "Email liên hệ từ khách hàng";
				$mail->Body     = $message;
				$mail->AltBody  =  "";


				if ( $mail->Send()) {
					$this->generateFormKey();
					$resp = [
						'success' => true,
						'message' => 'Cảm ơn bạn đã thông tin đăng ký học. Chúng tôi sẽ liên lạc bạn sớm nhất',
						'form_key' => $this->session->userdata('FORM_KEY')
					];

					
				} 
			}
		}

		echo json_encode($resp); die;
	}
}