<?php $this->load->view('frontend/layout/header'); ?>
<section id="head-product">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="/" title="Trang chủ">Trang chủ</a></li><li><a href="./xem-gio-hang">Thông báo đặt hàng</a></li>
		</ul>            
		<h1>Thông báo đặt hàng</h1>    
	</div>
</section>

<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear all bookings?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	} else {
		return false; // cancel button
	}
}
</script>
<div class="wrapper">
	<div class="container">
		<div class="content-right">
			<div class="cart-notify-success" style="padding: 80px 0 150px" >
				<h1>Đặt hàng thành công</h1>
				<div class="thank-order">Cảm ơn bạn đã đặt hàng tại website của chúng tôi</div>
				 <a href="./" class="btn btn-continue">Tiếp tục mua hàng <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('frontend/layout/footer'); ?>