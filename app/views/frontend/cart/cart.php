<script>
function clear_cart() {
	var result = confirm('Bạn có muốn hủy đơn hàng này không?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	} else {
		return false; 
	}
}
</script>

<section id="head-breadcrumb">
		<!--breadcrumb-->
		<ul class="container breadcrumb">
			<li><a href="/" title="Trang chủ">Trang chủ</a></li>
			<li><a href="./xem-gio-hang">Giỏ hàng</a></li>
		</ul>            
</section>

<div class="container">
	<div class="cart-infor" >
		<div class="title-h1">
			<h1>Giỏ hàng</h1>  
		</div> 
		<?php 
			if ($cart = $this->cart->contents()) { 
		?>
		<div style="padding-bottom:10px">
			<input type="button" value="Tiếp tục mua hàng" onclick="window.location='./'" />
		</div>
		<div style="color:#F00"><?php echo $message?></div>
		<div class="table-responsive">
		<table border="0" cellpadding="5px" cellspacing="1px" class="table table-hover">
			<tr bgcolor="#f6f6f6" style="font-weight:bold; height: 45px;">
				<td style="width: 50px;">STT</td>
				<td>Hinh ảnh</td>
				<td>Sản phẩm</td>
				
				<td>Đơn giá</td>
				<td class="text-center">Số lượng</td>
				<td class="text-center">Thành tiền</td>
				<td class="text-center">Thao tác</td>
			</tr>

			<?php
				echo form_open('cart/update_cart');
				$grand_total = 0; $i = 1;
			
				foreach ($cart as $item) :
					$sl=$this->db->query('SELECT * from dv_products where id='.$item['product_id'])->row_array();
					echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
					echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
					echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
					echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
					echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
			?>
			<tr bgcolor="#FFFFFF">
				<td>
					<?php echo $i++; ?>
				</td>
				<td><img src="<?= IMG_PATH_PRODUCT.'thumb/'.$sl['image']; ?>" class="size50"></td>
				<td>
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
				<td class="text-center">
					<?php echo anchor('cart/remove/'.$item['rowid'],'<i class="fa fa-trash-o" aria-hidden="true"></i>'); ?>
				</td>
			</tr>

			<?php endforeach; ?>

			<tr>
				<td colspan="8" class="text-right" style="text-align: right"><b>Tổng cộng: <?php echo number_format($grand_total); ?></b></td>
			</tr>
			<tr>
				<td colspan="8" align="right" class="text-right" style="text-align: right">
				<input type="button" value="Xóa đơn hàng" onclick="clear_cart()">
				<input type="submit" value="Cập nhật">
						<?php echo form_close(); ?>
				<input type="button" value="Tiến hành đặt hàng" onclick="window.location='thanh-toan-don-hang'"></td>
			</tr>
			
		</table>
		</div>
	<?php 
		} else { //end count cart
	?>
		<div id="layout-page-empty" class="col-md-12">
			<p class="text-center message">Không có sản phẩm nào trong giỏ hàng!</p>
			<p class="text-center"><a href="<?= base_url() ?>" class="btn btn-primary">
				<i class="fa fa-reply"></i> Tiếp tục mua hàng</a>
			</p>
		</div>
	<?php } ?>
	</div>
</div>
