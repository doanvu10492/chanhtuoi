<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends Admin_Controller 
{

public $outputData;

function __construct()
{
    parent::__construct();

    // Check login admin
    if(!isAdmin())
        redirect_admin('login');
    $this->config->db_config_fetch();
    $this->lang->load('admin/validation',$this->config->item('language_code'));
    $this->load->model('backend/orders_model');
    $this->load->model('frontend/products_model');
}


function index()
{
    //to use $_GET();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        //variable for href
        $queryString ='';
        $keyword = '';
        $id_cate = '';
        $email = '';
        $active = '';
        $condition = array();
        //get $_GET of the varible
        if (isset($_GET['keyword']) && ($_GET['keyword'] !=' '))
        {
            $keyword = $_GET['keyword'];
            
            $this->outputData['keyword'] =$keyword;
            $queryString .='?keyword='.$keyword;
        }
    
        //get $_GET of the varible
        if (isset($_GET['email']) && ($_GET['email'] != null))
        {
            $email = $_GET['email'];
            $queryString .='?email='.$email;
            $condition['order_email'] = $email;

        }

        //get $_GET of the varible
        if (isset($_GET['active']) && ($_GET['active'] != null))
        {
            $active = $_GET['active'];
            $queryString .='?active='.$active;
            $condition['active'] = $active;

        }

        //pagination
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL)
        {
            $config['uri_segment'] = $_GET['per_page'];
            //check to get & or ? assign into queryString
            
        }
        else{
            $config['uri_segment'] = $this->uri->segment(4);
        }
        
        $list_orders = $this->orders_model->list_orders('', '', $keyword, '', '', $condition )->result();

        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
        $config['base_url'] = './admin/orders/index.html'.$queryString;
        $config['total_rows'] = count($list_orders);
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        
        //GET Orders LIST
        $list_orders = $this->orders_model->list_orders($config['per_page'], $config['uri_segment'], $keyword, $id_cate, '', $condition)->result();
        //parse data
        $list_orders = $this->orders_model->parse_orders_data($list_orders);
    
        //assign queryString to back for edit action
        $this->session->set_userdata('query_href_back', $queryString);

        /* handle updated cart
        $list_orders2 = $this->orders_model->list_orders()->result();
        foreach( $list_orders2 as $item){
            if($item->profile != ''){
                $n = json_decode($item->profile, true);

                $value = array(
                    'order_name' => $n['name'],
                    'order_phone' => $n['phone1'],
                    'order_phone2' => $n['phone2'],
                    'order_email' => $n['email'],
                    'order_address' => $n['address']
                    );
                $this->orders_model->updateData(array('id' => $item->id), $value);

            }
        }

        print_r("expression"); exit();
      */



         /* handle products cart          
        $this->load->model('products_model');
        $list_orders_detail = $this->orders_model->list_orders_detail()->result();
        foreach( $list_orders_detail as $item){
            
                
                $product = $this->products_model->get_infor(array(TB_PRODUCTS.'.id' => $item->productid));
                
                if(count ($product) > 0 && isset($product->name)){
                    $value = array(
                        'name' => $product->name
                        );
                    $this->orders_model->update_orders_detail(array('orderid' => $item->orderid), $value);
                }
        
        }

        print_r("expression"); exit();*/

     


    $this->outputData = array(
        'page_title' => 'Danh sách đơn hàng',
        'currentPage' => 'orders',
        'subPage'=> 'list_orders',
        'pages' => $list_orders,
        'email' => $email,
        'active' => $active,
        'keyword' => $keyword,
        'pagination' => $pagination
        
    );
    unset($list_orders, $email, $active, $keyword, $pagination, $config);
    $this->render('admin/orders/list');

}

function updated($id)
{
    
    $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

    if ($this->input->post('update_orders'))
    {
        
        $this->form_validation->set_rules('order_name','lang:site_title_validation', 'trim|required|xss_clean');
        $this->form_validation->set_rules('order_address','lang:site_title_validation', 'trim|required|xss_clean');
        if ($this->form_validation->run())
        {

            $active = ($this->input->post('active') > 0 ) ? ('1') : ('0');  
            $data = array(
                'order_name' => $this->input->post('order_name'),
                'active' => $this->input->post('active'),
                'order_address' => $this->input->post('order_address'),
                'order_phone' => $this->input->post('order_phone'),
                'order_phone2' => $this->input->post('order_phone2'),
                'order_email' => $this->input->post('order_email'),
                'order_notes' => $this->input->post('order_notes'),
                'typepay' => $this->input->post('typepay'),

                /*'shipping_name' => $this->input->post('shipping_name'),
                'shipping_address' => $this->input->post('shipping_address'),
                'shipping_phone' => $this->input->post('shipping_phone'),
                'shipping_email' => $this->input->post('shipping_email'),*/ 
                
                
                
                'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
                'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s'))
            );

            if($id == 0)
            {
                //add
                $this->orders_model->insertData($data);
                $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 đơn hàng mới');
            }else{
                //update
                $key = array('id' => $id);
                $this->orders_model->updateData($key, $data);
                $this->session->set_flashdata('flash_message','Cập nhật đơn hàng thành công !');
            }
            redirect_admin('orders');
        }

    }
    if($id == 0)
    {
        //add
        $this->outputData = array(
            'page_title' => 'Thêm đơn hàng mới',
            'currentPage' => 'orders',
            'subPage'=> 'orders',
            'id' => $id
        );
    }
    else{
        //update
        $get_infor =  $this->orders_model->get_infor(array('id'=>$id));
       
        $this->outputData = array(
            'page_title' => 'Đơn hàng',
            'currentPage' => 'orders',
            'subPage'=> 'orders',
            'order_detail' => $this->orders_model->get_orders_detail(array('orderid' => $id)),
            'page' => $get_infor,
            'id' => $id
        );
    }


    $this->render('admin/orders/update');

}


function file_order( $id ){ die;
    $output = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="ProgId" content="Excel.Sheet" />
                <style type="text/css">
                
                table
                {
                    border-style: ridge;
                    border-width: 0;
                   
                        border-color: #d2d6de;
                    font-family: arial, tahoma, sans-serif;
                    font-size: 12px;
                }
                
                table thead th
                {
                    
                    text-align: center;
                }
                
                table tbody td
                {
                   
                }
                
                table thead th,
                table tbody td
                {
                    height: 28px;
                    vertical-align: middle;
                    padding: 8px;
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
                <table border="0"  cellpadding="1" cellspacing="1" style="width:800px">
                <tbody>
                <tr><td border="0" colspan="5" class="name_company" style="text-transform: uppercase !important; ">'.$this->config->item('site_title').'</td></tr>
                <tr><td colspan="5" >Ngày đặt hàng: '.date('d-m-Y H:i').'</td></tr>
                ';


                $item =  $this->orders_model->get_infor(array('id'=>$id));

                $output .= '<tr border="0"><td colspan="5" style="text-align: center; font-weight: bold; border: none; font-size: 17px">ĐƠN ĐẶT HÀNG</td></tr>';
                
                $output .= '<tr border="0"><td colspan="5">Họ và tên: '.$item->order_name.'</td></tr>
                ';
                $output .= '<tr><td colspan="5">Địa chỉ giao hàng: '.$item->order_address.'</td></tr>
                ';

                $output .= '<tr><td colspan="5">Hình thức thanh toán: '.$item->typepay.'</td></tr>
                ';

                $output .= '<tr><td colspan="5">Email: '.$item->order_email.'</td></tr>
                ';
                $output .= '<tr><td colspan="5">Số điện thoại: '.$item->order_phone.'</td></tr>
                ';
                $output .= '<tr><td colspan="5">Số điện thoại dự phòng: '.$item->order_phone2.'</td></tr>
                ';
                      // $output .='<tr>'; 
                      // $output .='<td colspan="3">';
                      // $output .='Họ tên: '.$item->order_name.'</td>';
                      // $output .='<td colspan="2">Email: '. $item->order_email.'</td>';
                      // // $output .='<td>Điện thoại: '.$item->order_phone.'-'.$item->order_phone2.'</td>';
                      
                      // $output .='</tr>'; 
                      $output.='
                        <tr class="bg-green">
                            <td style="border: 1px solid #333">STT</td>
                            
                            <td style="border: 1px solid #333">Sản phẩm</td>
                            
                            <td style="border: 1px solid #333">Đơn giá</td>
                            <td style="border: 1px solid #333">Số lượng</td>
                            <td style="border: 1px solid #333">Thành tiền</td>
                        </tr>';
            
            
            $i=1;
            $total = 0;
            $cart = $this->orders_model->get_orders_detail(array('orderid' => $id));

            foreach($cart as $row)
            {   

              $product = $this->products_model->view_product('',array(TB_PRODUCTS.'.id' => $row['productid']));

              $total += $row['price']*$row['quantity'];
              $output .='<tr  >'; 
              $output .='<td style="border: 1px solid #333">'.$i.'</td>';
              // $output .='<td  style="height: 105px !important;width: 105px !important; text-align: center !important;"><img src="'.base_url().$product['img_thumb'].'" height="100" width="100" ></td>';
              $output .='<td style="border: 1px solid #333">'.$row['name'].'</td>';
              
              $output .='<td style="border: 1px solid #333">'. number_format($row['price']).'</td>';
              $output .='<td style="border: 1px solid #333">'.$row['quantity'].'</td>';
              $output .='<td style="border: 1px solid #333">'. number_format($row['price']*$row['quantity']).'</td>';
              $output .='</tr>'; 
              $i++; 
            }
            
             $output.='</tr >
                    <td  colspan="3" style="text-align: right; font-weight: bold; border: 1px solid #333">Tổng tiền: </td><td style="border: 1px solid #333" colspan="2">'.number_format($total).'</td></tr> 
                    </tbody>
                </table>
            
                </body>
                </html>';
                
            
                $filename = "Order" . date('Ymd') . ".xls";
                
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Content-Type: application/vnd.ms-excel");
                print_r($output); exit(); 
}



function delete($id)
{ 
    $this->orders_model->deleteData($id);
    $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một đơn hàng');
    redirect_admin('orders');       

}

function updateStatus()
    {
        $id = $this->uri->segment(4);
        // action is attribute such as : active, highlight...
        $action = trim($_POST['action']);
        //check product exist
        if ($this->orders_model->check_exists(array('id' => $id))){
            // click ok status
            if ($_POST['active'] == 1)
            {
                $this->orders_model->updateData(array('id' => $id), array($action => 0));
                echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
            }
            else{
                $this->orders_model->updateData(array('id' => $id), array($action => 1));
                echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
            }
        }else{
            echo json_encode(array('error' => 'Bài viết này không tồn tại')); exit();
        }
    }


    function del_list_choose()
    {
        
        $list_id = explode(',', $_POST['list_id']);
        if (count($list_id) == 1)
        {
            $this->orders_model->deleteData($list_id);
        }else{
            foreach ($list_id as $id) {
                if ($this->orders_model->check_exists(array('id' => $id))){
                    $this->orders_model->deleteData($id);
                }
                else{
                    echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
                }
                
            }
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục sản phẩm');   
        echo json_encode(array('result' => admin_url('orders'))); exit(); 
    }


   

}