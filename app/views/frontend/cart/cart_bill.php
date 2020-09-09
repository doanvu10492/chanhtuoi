<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header'); ?>
<section id="head-breadcrumb">
  <div class="container">
    <div class="row">
      <ul class="breadcrumb">
        <li><a href="/" title="Trang chủ">Trang chủ</a></li>
        <li><a href="#">Thanh toán đơn hàng</a></li>
      </ul>
    </div>            
  </div>
</section>

<?php
if(isMember()):
  $CI = & get_instance();
  $login = $this->session->userdata('CI_login');
endif;
 ?>

<?php
$grand_total = 0;

if ($cart = $this->cart->contents()):
	foreach ($cart as $item):
     $product = $this->db->query('SELECT * from '.TB_PRODUCTS.' where id='.$item['product_id'])->row_array();
		$grand_total = $grand_total + $item['subtotal'];
	endforeach;
endif;
?>
<div class="wrapper">
<div class=" container">
  <div class="title-h1">
    <h1>Thanh toán đơn hàng</h1>  
  </div>  
  <div class="row">
    
    <div class="col-md-9 col-sm-9 col-xs-12 cart-payment-left">

    <div  id="error_payment"></div>
    <div  id="success_payment"></div>
    
    <form id="payment-cart" class="form-group form-pay" name="billing" method="post" action="<?php echo base_url().'cart_bill' ?>" >
         
    
	
    <div class="col-md-12"> <p class="tit-p3">Thông tin người thanh toán</p></div>
                  
                
      <input type="hidden" name="id_customer" value="" />
      <input type="hidden" name="total" value="<?php echo $grand_total  ?>" />
      <input type="hidden" name="command" />
      <input type="hidden" name="id_customer" value="" />
        
                              
        <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label class="lb-payment-1">Họ và tên</label>
            </div>
             
            <div class=" col-md-8 col-sm-8 col-xs-12">
                <input class="form-control" id="name" type="text" name="order_name" value="<?= (isset($login['member_name'])) ? ($login['member_name']) : (''); ?>"  required /><?php echo form_error('name'); ?>
            </div>
        </div>

        <div class="form-group">
           <div class="col-md-4 col-sm-4 col-xs-12 ">
             <label class="lb-payment-1">Địa chỉ giao nhận</label>
           </div>

           
           <div class="col-md-8 col-sm-8 col-xs-12">
           <input class="form-control" type="text" id="address" name="order_address" required  /><?php echo form_error('address'); ?>
           </div>
        </div>

        <div class="form-group">
           <div class="col-md-4 col-sm-4 col-xs-12">
             <label class="lb-payment-1">Hình thức thanh toán</label>
           </div>

           
           <div class="col-md-8 col-sm-8 col-xs-12">
              <select name="typepay" class="form-control" aria-invalid="false">
                <option value="Thanh toán trực tiếp">Thanh toán trực tiếp</option>
                <option value="Chuyển khoản">Chuyển khoản</option>
                <option value="Thỏa thuận">Thỏa thuận</option>
              </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="lb-payment-1">Email</label>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-12">
              <input id="email"  class="form-control" type="email" name="order_email" 
              value="<?= (isset($login['member_email'])) ? ($login['member_email']) : (''); ?>"   required />
              <?php echo form_error('email'); ?>
          </div>
        </div>

       <div class="form-group">
           <div class="col-md-4 col-sm-4 col-xs-12">
              <label class="lb-payment-1">Số điện thoại</label>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input id="phone"  class="form-control" type="number" name="order_phone" value="member_phone" required /><?php echo form_error('order_phone'); ?>
            </div>
        </div>

        <div class="form-group">
           <div class="col-md-4 col-sm-4 col-xs-12">
              <label class="lb-payment-1">Điện thoại dự phòng</label>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <input id="phone"  class="form-control" type="number" name="order_phone2" required /><?php echo form_error('order_phone2'); ?>
            </div>
        </div>

        
                          
        <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-12"><label class="lb-payment-1">Ghi chú </label></div>
                <div class="col-md-8 col-sm-8 col-xs-12" >
                     <textarea class="text-note-oreder" name="shipping_note"></textarea>
                </div>
         </div>

          <!-- <div class="form-group">
           <div class="col-md-4 col-xs-4">
              
            </div>
            <div class="col-md-8 col-xs-8 form-check-code">
                <label class="lb-payment-1"><strong>Mã khuyến mãi mua hàng</strong></label>
                <input class="code-sale" type="text" name="code_sale" required /><a href="javascript:void(0)" id="check_code" onclick="checkCode()">Kiểm tra</a>
                <div class="nt"></div>

                <?php echo form_error('code_sale'); ?>
            </div>
        </div> -->
                                     
            <input type="hidden" name="payment" value="payment" />  
            <div class="form-group clearfix">
            <div class="text-right col-md-12">
                <input name="hoantatmuahang" onclick="paymentCart()" class="btn-complete btn" type="button" value="GỬI ĐƠN HÀNG" /></div>
            </div>      
      </form> 

  </div>
  <div class="col-sm-3 col-total-cart-bill">
    <div id="cart-total-bill">
    <?php $total = $this->cart->total_items(); ?>
    <h3>Thông tin đơn hàng</h3>
    <p>Số lượng sản phẩm <span><?= $total ?> SP</span></p>
    <div class="number-row">
      <p>TỔNG CỘNG <span><?= number_format( $grand_total ); ?>đ</span></p>
      <p>THÀNH TIỀN<span><?= number_format( $grand_total ); ?>đ</span></p>
    </div>
    
    <a href="./" class="btn btn-continue">Tiếp tục mua hàng</a>
    
    <?php /*<a href="./xuat-file" class="out-exel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Xuất file exel</a> */?>
  </div>    
        
		 
         
         </div>
         
         
         <div class="col-md-12" style="margin-top:30px; clear: both;"><p class="tit-p3">Đơn hàng của bạn</p></div>
         <div class="col-md-12" >
           <div class="table-responsive cart_info">
             <table class="table table-hover" cellpadding="5px" cellspacing="1px">
                        <?php if ($carts = $this->cart->contents()): ?>
                       <thead>
                        <tr bgcolor="#eee" style="font-weight:bold">
                           
                            <td style="padding: 5px 0;text-align: center;width: 50px;">STT</td>
                            <td style="padding: 5px 0;text-align: center;width: 50px;">Hình ảnh</td>    
                            <td style="padding: 5px 0;text-align: center;width: 450px;">Sản phẩm</td>
                            
                            <td style="padding: 5px 0;text-align: center;width: 200px;">Giá</td>
                            <td style="padding: 5px 0;text-align: center;width: 150px;">Số lượng</td>
                            <td style="padding: 5px 0;text-align: center;width: 240px;">Thành tiền</td>
                          
                        </tr>
                      </thead>
                      <tbody>
                      
                        <?php
                        $grand_total = 0; $i = 1;
                        foreach ($cart as $item):
						
        						   $sl=$this->db->query('SELECT * from '.TB_PRODUCTS.' where id='.$item['product_id'])->row_array();

						   
                        ?>
                            
                       
                        <tr bgcolor="#FFFFFF">
                            <td>
                              <?php echo $i++; ?>
                            </td>
                            <td><img src="<?= IMG_PATH_PRODUCT.'thumb/'.$sl['image']; ?>" class="size50"></td>
                            <td style="text-align: left !important; ">
                              <?php echo $item['name']; ?>
                              <p>Size: <?php echo $item['size']; ?></p>
                              <p>Màu sắc: <?php echo $item['color']; ?></p>
                            </td>
                            
                            <td>
                              <?php echo number_format($item['price']); ?>
                            </td>
                            <td class="text-center">
                              <?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: center"'); ?>
                            </td>
                            <?php $grand_total +=  $item['subtotal']; ?>
                            <td class="text-center">
                               <?php echo number_format($item['subtotal']); ?>
                            </td>
                            
                            <?php endforeach; ?>
                          </tr>


                          <tr id="tr-grand-total">
                            <td colspan="8" class="text-right"><b>Tổng cộng: <?php echo number_format($grand_total); ?></b>

                            </td>
                           
                          </tr>
                           <input type="hidden" id="input-grand-total" value="<?= $grand_total; ?>">
                        
                        <?php endif; ?>
                         </tbody>
                        </table>
                    </div>	
                     </div>	
            </div>
            </div>
        
</div>

<script>

/*
function sameInfo()
{
	$('#shipping_name').val($('#name').val());
	$('#shipping_address').val($('#address').val());
	$('#shipping_email').val($('#email').val());
	$('#shipping_phone').val($('#phone').val());
	$('#shipping_city').val($('#city').val());
	
	
}
*/

function paymentCart()
{    
	var dataString = $('#payment-cart').serialize();

  $.ajax({
  	type:'POST',
  	url:"<?php echo base_url() ?>cart_bill",
  	data:dataString,
  	success: function(data) {
  		var result=JSON.parse(data);

  		if (result.error) {
  			$('#error_payment').empty().append('<p>'+result.error+'<span onclick="closeErrorPayment()" id="closeErrorPayment">x<span></p>').fadeIn(500);
  			$('body,html').animate({
  								scrollTop: 0
  							}, 800);
  		} else {
  		  $('#error_payment').empty(); 
  	      $('#success_payment').append('<p>'+result.success+'</p>');
  		  $('body,html').animate({
  							scrollTop: 0
  						}, 800).delay(4000);
  	      
  		  window.location="<?php echo base_url() ?>thong-bao-dat-hang";
  		}
    }
	
	});
}

function checkCode() 
{
  var code = $('.form-check-code .code-sale').val();
  if(code == null) {
    $('.form-check-code .nt').empty().append('<p class="error">Vui lòng điền mã khuyến mãi</p>');
  } else {
      
      $.ajax({
          type : 'POST',
          url  : "./xac-nhan-ma-khuyen-mai.html",
          data : "code_sale="+code,
          success : function(data) {
            result = JSON.parse(data);

            if(result.text_sale) {
             var grandTotalBefore = $("#input-grand-total").val();
             var grandTotal = $("#input-grand-total").val();
                 grandTotal = grandTotal - ((parseInt(result.number_sale) * grandTotal) / 100);

                  $('#cart-total-bill .number-row').empty().append('<p>TỔNG CỘNG <span>'+grandTotalBefore.toLocaleString()+'đ</span></p>'
                    +'<p>KHUYẾN MÃI <span>'+result.number_sale+'%</span></p>'
                    +'<p>THÀNH TIỀN <span>'+grandTotal.toLocaleString()+'đ</span></p>');
              $('.form-check-code .nt').empty().append('<p class="success">'+result.text_sale+'</p>');
            } else {
              $('.form-check-code .nt').empty().append('<p class="error">'+result.error+'</p>');
            }
          }
        })
  }
}

function closeErrorPayment()
{
	$('#error_payment').empty();
}
</script>

<?php $this->load->view('frontend/layout/footer'); ?>
