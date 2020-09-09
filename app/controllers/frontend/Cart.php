<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends Public_Controller 
{

    public $outputData;
	public $loggedInUser;

	function __construct()
	{
		parent::__construct();
		$this->config->db_config_fetch();
	   
		if ( ! $this->config->item('site_status'))
			redirect('offline');

		$this->load->model('frontend/cart_model');
		$this->load->model('frontend/products_model');
	}

	function index()
	{	
		if ( ! $this->cart->contents()) {
			$this->outputData['message'] = '<p>Your cart is empty!</p>';
		} else {
			$this->outputData['message'] = $this->session->flashdata('message');
		}

		$this->outputData['page_title'] = 'Giỏ hàng';
		$this->outputData['current_page'] = "cart";
		$this->outputData['meta_keywords'] = "Cart";
		$this->outputData['meta_description'] = "Cart";

		$this->render_page('frontend/cart/cart');
	}

    /*
    * Add to cart
    */
	//add product in cart
	function add()
	{
		if ($this->input->post('qty') < 1) {
			echo json_encode(array('error' => 'Vui lòng nhập số lượng lớn hơn 1')); exit();
		}
		
		$insert_room = array(
			'id' => date('His'),
			'product_id' => $this->input->post('id'),
			// 'name' => clean_special_character($this->input->post('name')),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'qty' => $this->input->post('qty'),
			'color' => $this->input->post('color'),
			'size' => $this->input->post('size')
		);		


		if (!$this->cart->insert($insert_room)) {
			echo json_encode(array('error' => $this->cart->insert($insert_room))); exit();
		}

		if ($this->uri->segment(1) == "payment-now") {
			echo json_encode(array('result' => './thanh-toan-don-hang')); exit();
		}

		//cart buy now
		if (isset($_POST['buy_now'])) {
			echo json_encode(array('result' => './xem-gio-hang')); exit();
		}

		//checkout cart
		if (isset($_POST['checkout'])) {
			$total = $this->cart->total_items();

			
			$minicart = '';
			if($cart = $this->cart->contents()){
			$minicart .='<div class="dropdown_2">';
    		$minicart .='<div class="title-txt">';
    		$minicart .='Sản phẩm vừa được thêm vào!';
    		$minicart .='</div>';
    		$minicart .='<div class="cart-hover-body">';
        	$minicart .='<ul id="list-cart-hover">';
            $grand_total =0;
            $this->load->model('frontend/products_model');
            $grand_total = 0; $i = 1;

            foreach ($cart as $item):

            $product =$this->products_model->view_product(
            	array(TB_PRODUCTS.'.id' => $item['product_id'])
            );

            $grand_total +=  $item['subtotal'];
            $minicart .='<li>';
            $minicart .='<figure><img src="'.$product['img_thumb'].'"></figure>';
            $minicart .='<div class="cart-info">';
            $minicart .='<a href="'.$product['link'].'">'.$product['name'].'</a>';
                    if($product['code']): 
                    $minicart .='<p>Mã sản phẩm: '.$product['code'] .'</p>';
                    endif;
                     if($item['size']): 
                    $minicart .='<p>Size: '.$item['size'] .'</p>';
                    endif;
                    if($item['color']): 
                    $minicart .='<p>Màu: '.$item['color'] .'</p>';
                    endif;                    
            $minicart .='</div>';
            $minicart .='<div class="price">'.$item['qty'].'x'.number_format($product['price']).'đ</div>';
            $minicart .='<div class="action-cart">';
            $minicart .='<a href="./cart/remove-ajax/'.$item['rowid'].'">';
            $minicart .='<i class="fa fa-close"></i>';
            $minicart .='</a>';
            $minicart .='</div>';
            $minicart .='</li>';
        endforeach;
        	$minicart .='</ul>';
        	$minicart .='<div class="total-price">';
            $minicart .='<ul>';
            $minicart .='<li class="color_dark">Tổng: <span id="grand-total">'.number_format($grand_total).'</span>đ</li>';
               
            $minicart .='<li class="color_dark"><span>Tổng cộng:</span> <span id="grand-total-all">';
            $minicart .=number_format($grand_total).'đ</span></li>';
            $minicart .='</ul>';
        	$minicart .='</div>
    </div>
    <div class="cart-link-option">
        <a href="./xem-gio-hang.html">Xem chi tiết</a>
        <a href="./thanh-toan-don-hang.html">Thanh toán</a>
    </div>
</div>';
         } 


		echo json_encode(array('result' => 'Thêm giỏ hàng thành công', 'total' => $total, 'minicart' => $minicart)); exit();
		}	
		redirect('cart');
	}
	
	/*
	* remove a product in cart
	*/
	function remove($id) 
	{
		if ($id=="all" || $this->uri->segment(3) == 'all') {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid'   => $id,
				'qty'     => 0
			);

			$this->cart->update($data);
		}

		$cart = $this->cart->contents();

		if($this->uri->segment(2) == 'remove-ajax' ) {
			$grand_total = 0;

            foreach ($cart as $item) {
            	$grand_total += $item['subtotal'];
            }

            $total = $this->cart->total_items();
            
			echo json_encode(array(
				'result' => 'Xóa giỏ hàng thành công', 
				'grand_total' => $grand_total,
				'total' => $total
			)); exit();
		}

		redirect();
	}	

    /*
    * Update cart
    */
	function update_cart()
	{
 		foreach($_POST['cart'] as $id => $cart) {			
			$price = $cart['price'];
			$amount = $price * $cart['qty'];

			if($cart['qty'] > 0) {
				$this->cart_model->update_cart($cart['rowid'], $cart['qty'], $price, $amount);
			}	
		}
		
		redirect('xem-gio-hang');
	}	

	public function cart_payment()
	{	
		if(isset($_POST['payment'])) {

			if (empty($_POST['order_name'])) {
				echo json_encode(array('error'=>'Vui lòng nhập đầy đủ họ tên !')); exit();
			}
			
			if (empty($_POST['order_address'])) {
				echo json_encode(array('error'=>'Vui lòng nhập địa chỉ !')); exit();
			}
			
			if (empty($_POST['order_email'])) {
				echo json_encode(array('error'=>'Vui lòng nhập email !')); exit();
			}
			
			if (!filter_var($_POST['order_email'], FILTER_VALIDATE_EMAIL)) {
			   echo json_encode(array('error'=>'Email không đúng định dạng VD: example@gmail.com')); exit();
			}
			
			if (empty($_POST['order_phone'])) {
				echo json_encode(array('error'=>'Vui lòng nhập số điện thoại !')); exit();
			}
			
			if(!preg_match('/^\d{10,14}$/',$_POST['order_phone'])) {
			 	echo json_encode(array('error'=>'Số điện thoại không đúng VD: 0978345768')); exit();
			 
			}
		
		   	$customer_id = ($this->session->userdata('user_id') != null) ? ($this->session->userdata('user_id')) : (0);
			
			$order = array(
				'created_at' 			=> date('Y-m-d H:i:s'),
				//'customer_id' 	=> $customer_id,	
				'order_name' 		=> $this->input->post('order_name'),
				'order_email' 	=> $this->input->post('order_email'),
				'order_address' 	=> $this->input->post('order_address'),
				'order_phone' 	=> $this->input->post('order_phone'),
				'typepay' => $this->input->post('typepay'),
				'order_phone2' => $this->input->post('order_phone2'),
				'order_notes' 	=> $this->input->post('shipping_note'),
				'total' 	=> $this->input->post('total'),
			);		

			$ord_id = $this->cart_model->insert_order($order);
				
			if ($cart = $this->cart->contents()):

				foreach ($cart as $item):
					$order_detail = array(
						'orderid' 		=> $ord_id,
						'productid' 	=> $item['product_id'],
						'name' 	=> $item['name'],
						'quantity' 		=> $item['qty'],
						'price' 		=> $item['price'],
						'color' 		=> $item['color'],
						'size' 		=> $item['size']
					);		
	
					$cust_id = $this->cart_model->insert_order_detail($order_detail);
				endforeach;
			endif;

				$message = '';
				$message .= '<p><strong>ĐƠN HÀNG</strong></p>';
				$message .= '<p>Được gửi từ website: '.$this->config->item('site_title').'</p>';
				$message .= '<p>Họ tên : '.$this->input->post('order_name').'</p>';
				$message .= '<p>Email : '.strip_tags($this->input->post('order_email')).'</p>';
				$message .= '<p>Điện thoại : '.$this->input->post('order_phone').'</p>';
				$message .= '<p>Điện thoại dự phòng : '.$this->input->post('order_phone2').'</p>';
				$message .= '<p>Hình thức thanh toán : '.$this->input->post('typepay').'</p>';
				$message .= '<p>Đơn hàng : '.$this->input->post('order_notes').'</p>';

				$message .= '<table border="1" bordercolor="#009933" cellpadding="1" cellspacing="0" style="width:800px">
			<tbody>
			<tr><td colspan="6" class="name_company" style="text-transform: uppercase !important; ">'.$this->config->item('site_title').'</td></tr>
			<tr><td colspan="6">Ngày xuất đơn hàng: '.date('d-m-Y H:i').'</td></tr>
			';

		 
	   			  $message.='
				    <tr class="bg-green">
						<td>STT</td>
						<td>Sản phẩm</td>
						
						<td>Đơn giá</td>
						<td>Số lượng</td>
						<td>Thành tiền</td>
					</tr>';
			
			
			$i=1;
			$total = 0;
			$cart = $this->cart->contents();
				/*
			foreach($cart as $row)
			{  

				$product = $this->products_model->view_product(array(TB_PRODUCTS.'.id' => $row['id']));

				$total += $row['subtotal'];
				$message .='<tr>'; 
				$message .='<td>'.$i.'</td>';
				
				$message .='<td>'.$row['name'].'</td>';
				
				$message .='<td>'. number_format($row['price']).'</td>';
				$message .='<td>'.$row['qty'].'</td>';
				$message .='<td>'. number_format($row['subtotal'] ).'</td>';
				$message .='</tr>'; 
				$i++; 
			}
				*/

			
			$message.='</tr>
			<td colspan="5" style="text-align: right; font-weight: bold">Tổng tiền: </td><td colspan="2">'.number_format($total).'</td></tr> 
			</tbody>
			</table>';
				
			$message .= '<br/>'; 
		    $toName = $this->input->post('name');
			$toEmail = $this->config->item('site_admin_mail');	 
			$mailFrom = $this->input->post('order_email'); 
		    $this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;  
			$this->email->initialize($config);
			$this->email->from($this->config->item('email') , $this->config->item('site_title'));
			$this->email->to($toEmail);
			$this->email->cc($mailFrom);
			$this->email->subject($toName);
			$this->email->message($message);

			/*if ( ! $this->email->send())
			{
				echo json_encode(array('error'=>'Có lỗi trong quá trình thanh toán đơn hàng. Vui lòng điền đúng email và những thông tin liên quan')); exit();
				//echo $this->email->print_debugger();
			}
			
			else 
			{
				$this->cart->destroy();
				echo json_encode(array('success'=>'Thanh toán đơn hàng thành công ')); exit();
				redirect(base_url().'thong-bao-dat-hang');
			}*/

			//not email

			$this->cart->destroy();
			echo json_encode(array('success'=>'Thanh toán đơn hàng thành công ')); exit();
			redirect(base_url().'thong-bao-dat-hang');	

		}

		$this->outputData['page_title'] = 'Thông tin thanh toán';
		

		if ($this->uri->segment(1) == 'thong-bao-dat-hang') {
			$this->outputData['current_page'] = 'cart_bill';
			$this->load->view('frontend/cart/cart_notify', $this->outputData);
		} else {
			$this->outputData['current_page'] = 'cart_bill';
			$this->load->view('frontend/cart/cart_bill', $this->outputData);
		}
	}

	/*
	* Save order
	*/
	public function save_order()
	{
		$this->load->model('cart_model');
		$this->load->library('form_validation');		
		// Load Form Helper
		$this->load->helper('form');
		// Intialize values for library and helpers	
		$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		// Get Form Details
		
		if($this->input->post('hoantatmuahang')) {	
			$this->form_validation->set_rules('name','Họ tên khách hàng','required|trim|xss_clean');
			$this->form_validation->set_rules('email','Email khách hàng','required|trim|xss_clean');
			$this->form_validation->set_rules('phone','Số điện thoại','required|trim|xss_clean');
			$this->form_validation->set_rules('address','Địa chỉ khách hàng','required|trim|xss_clean');
			
			if($this->form_validation->run()) {
				$customer = array(
					'name' 		=> $this->input->post('name'),
					'email' 	=> $this->input->post('email'),
					'address' 	=> $this->input->post('address'),
					'phone' 	=> $this->input->post('phonedienthoai'),
					'tinhthanh' 	=> $this->input->post('tinhthanh')
				);		
		
				$cust_id = $this->cart_model->insert_customer($customer);
		
				$order = array(
					'date' 			=> date('Y-m-d'),
					'customerid' 	=> $cust_id
				);		
		
				$ord_id = $this->cart_model->insert_order($order);
				
				if ($cart = $this->cart->contents()):
					foreach ($cart as $item):
						$order_detail = array(
							'orderid' 		=> $ord_id,
							'productid' 	=> $item['product_id'],
							'quantity' 		=> $item['qty'],
							'price' 		=> $item['price'],
							'color' 		=> $item['color'],
							'size' 			=> $item['size']
						);		
		
						$cust_id = $this->cart_model->insert_order_detail($order_detail);
					endforeach;
				endif;
				
				$this->outputData['message'] =  "Thank You! your order has been placed!<br /><a href=".base_url()."sanpham>Trở về trang sản phẩm</a>";
				$this->outputData['page_title'] = 'Đặt hàng thành công';
				$this->outputData['current_page'] = 'save_order';

				$this->load->view('frontend/product/save_order', $this->outputData);
			}
		} else {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function delete_cart($id_cart_key)
	{
		unset($_SESSION['cart'][$id_cart_key]);

		redirect($_SERVER['HTTP_REFERER']);
	}

	function export_exel()
	{
		$output = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="ProgId" content="Excel.Sheet" />
			<style type="text/css">
			
			table
			{
				border-style: ridge;
				border-width: 1;
				border-collapse: collapse;
				font-family: arial, tahoma, sans-serif;
				font-size: 12px;
			}
			
			table thead th
			{
				background-color: #FC0;
				border: 1px solid #CCC;
				text-align: center;
			}
			
			table tbody td
			{
				border: 1px solid #CCC;
			}
			
			table thead th,
			table tbody td
			{
				height: 28px;
				vertical-align: middle;
			}
			
			.text-left
			{
				text-align: left;
			}
			
			.text-right
			{
				text-align: right;
			}
			
			.text-center
			{
				text-align: center;
			}
			.bg-green  td
			{
			    background-color: #8ec700;
				font-weight: bold;
			}
			.name_company
			{
				
				
				font-size: 16px;
				font-weight: bold;
			}
			
			
			</style>
			</head>
			<body>
			<table border="1" bordercolor="#009933" cellpadding="1" cellspacing="1" style="width:800px">
			<tbody>
			<tr><td colspan="6" class="name_company" style="text-transform: uppercase !important; ">'.$this->config->item('site_title').'</td></tr>
			<tr><td colspan="6">Ngày xuất đơn hàng: '.date('d-m-Y H:i').'</td></tr>
			';

		  /* $item = $dataOrder->row();
		  
			      $output .='<tr>'; 
			      $output .='<td colspan="2">';
				  $output .='Họ tên: '.$item->order_name.'</td>';
				  $output .='<td colspan="2">Email: '. $item->order_email.'</td>';
				  $output .='<td>Điện thoại: '.$item->order_phone.'</td>';
				
				  $output .='</tr>'; */
	   			  $output.='
				    <tr class="bg-green">
						<td>STT</td>
						<td >Hình ảnh</td>
						<td>Sản phẩm</td>
						
						<td>Đơn giá</td>
						<td>Số lượng</td>
						<td>Thành tiền</td>
					</tr>';
		
		
		$i=1;
		$total = 0;
		$cart = $this->cart->contents();

		foreach($cart as $row) {  
			$product = $this->products_model->view_product(array(TB_PRODUCTS.'.id' => $row['id']));
			$total += $row['subtotal'];
			$output .='<tr>'; 
			$output .='<td>'.$i.'</td>';
			$output .='<td  style="height: 105px !important;width: 105px !important; text-align: center !important;"><img src="'.base_url().$product['img_thumb'].'" height="100" width="100" ></td>';
			$output .='<td>'.$row['name'].'</td>';

			$output .='<td>'. number_format($row['price']).'</td>';
			$output .='<td>'.$row['qty'].'</td>';
			$output .='<td>'. number_format($row['subtotal'] ).'</td>';
			$output .='</tr>'; 
			$i++; 
		}
	    
	    $output.='</tr>
		        <td colspan="5" style="text-align: right; font-weight: bold">Tổng tiền: </td><td colspan="2">'.number_format($total).'</td></tr> 
				</tbody>
			</table>
		
			</body>
			</html>';
			
		
        $filename = "Order" . date('Ymd') . ".xls";
		
		header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
	}

	public function checkCustomerOrder()
	{ 
		if (isset($_GET['order_phone'])) {
			$arrRes = [
				'data' => 'Không tìm thấy đơn hàng nào', 
				'error' => true
			];

			$this->load->model('backend/orders_model');
			$orderPhone = $_GET['order_phone'];
			
			$listOrders = $this->orders_model->list_orders( 
				'', '', '', '', '', ['order_phone' => $orderPhone])->result_array();
			$result = '';
			if (count($listOrders)) {
				foreach ($listOrders as $order) {
					$orderItems = $this->orders_model->get_orders_detail(array('orderid' => $order['id']));

					$result .= '<div class ="row" style="padding: 5px;">';
					$result .= '<div class="col-md-4">';
					$result .= 'Mã đơn hàng #0000'.$order['id'];
					$result .= '</div>';
					$result .= '<div class="col-md-8">';
					$result .= 'Ngày đặt hàng: '.date('d/m/Y', strtotime($order['created_at']));
					$result .= '</div>';
					$result .= '</div>';

					$result .= '<table class="table table-bordered">';
					$result .= '<tbody>';
					
					$result .= '<tr>';
					$result .= '<th style="width: 40px">STT</th>';
					$result .= '<th>Tên sản phẩm</th>';
					$result .= '<th class="text-center">Giá</th>';
					$result .= '<th class="text-center">Số lượng</th>';
					$result .= '<th>Thành tiền</th>';
					$result .= '</tr>';
						$i=0; 
						foreach ($orderItems as $row) { 
							$result .= '<tr>';
							$result .= '<td>'.++$i.'</td>';
							$result .= '<td>'.$row['name'].'</td>';

							$result .= '<td class="text-center">'.number_format($row['price']).'</td>';
							$result .= '<td class="text-center">'.$row['quantity'].'</td>';
							$result .= '<td>'.number_format($row['price']*$row['quantity']).'</td>';
							$result .= '</tr>';
					 	} 
					$result .= '<tr>';
					$result .= '<td colspan="4" class="text-right">Tổng tiền: </td>';
					$result .= '<td>'.number_format($order['total']).'</td>';
					$result .= '</tr></tbody></table>';
				}

				$arrRes = [
					'data' => $result, 
					'error' => false
				];
			}

			echo json_encode($arrRes); exit();
		}

		$this->outputData['page_title'] = 'Kiểm tra thông tin đơn hàng';
		$this->outputData['current_page'] = 'check_order';
		$this->render_page('frontend/cart/check_order');
	}
}