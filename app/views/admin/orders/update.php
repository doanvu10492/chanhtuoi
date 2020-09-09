<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
	.text-left{ text-align: left !important;  }
</style>
<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Nội dung đơn hàng</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
		</div>
	</div>

<div class="nav-tabs-custom">
    <form action="<?php echo admin_url('orders/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">
             <!-- /.box-header -->
		    <div class="box-body">
		      <div class="row">
		        <div class="col-md-6">
		           	<div class="box box-primary">
			            <div class="box-header with-border">
			            	<h3 class="box-title text-center">THÔNG TIN NGƯỞI GỬI</h3>
			            </div>
			            <div class="box-body">
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Họ tên:</label>
				                <div class="col-sm-9">
				                    <input type="text" name="order_name" class="form-control" value="<?php echo (isset($page->order_name)) ? ($page->order_name) : (set_value('order_name')); ?>">
				                    <?php echo (form_error('order_name')) ? ('<p class="error">'.form_error('order_name').'</p>') : (""); ?>
				                </div>
				            </div>
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Địa chỉ: </label>
				                <div class="col-sm-9">
				                    <input type="text" name="order_address" class="form-control" value="<?php echo (isset($page->order_address)) ? ($page->order_address) : (set_value('order_address')); ?>">
			                    <?php echo (form_error('order_address')) ? ('<p class="error">'.form_error('order_address').'</p>') : (""); ?>
				                </div>
				            </div>
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Email: </label>
				                <div class="col-sm-9">
				                    <input type="text" name="order_email" class="form-control" value="<?php echo (isset($page->order_email)) ? ($page->order_email) : (set_value('order_email')); ?>" >
				                    <?php echo (form_error('order_email')) ? ('<p class="error">'.form_error('order_email').'</p>') : (""); ?>
				                </div>
				            </div>
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Phone: </label>
				                <div class="col-sm-9">
				                    <input type="text" name="order_phone" class="form-control" value="<?php echo (isset($page->order_phone)) ? ($page->order_phone) : (set_value('order_phone')); ?>"  >
				                    <?php echo (form_error('order_phone')) ? ('<p class="error">'.form_error('order_phone').'</p>') : (""); ?>
				                </div>
				            </div>
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Điện thoại dự phòng: </label>
				                <div class="col-sm-9">
				                    <input type="text" name="order_phone2" class="form-control" value="<?php echo (isset($page->order_phone2)) ? ($page->order_phone2) : (set_value('order_phone2')); ?>"  >
				                    <?php echo (form_error('order_phone2')) ? ('<p class="error">'.form_error('order_phone2').'</p>') : (""); ?>
				                </div>
				            </div>
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">HT thanh toán: </label>

				                <div class="col-sm-9">
				                    <?php if( isset($page->typepay) ) {
				                    	echo $page->typepay;
				                    	echo '<input type="hidden" name="typepay" value="'.$page->typepay.'">';
				                    	 }else{?>
				                   	<select name="typepay" class="form-control" aria-invalid="false">
						                <option value="Thanh toán trực tiếp">Thanh toán trực tiếp</option>
						                <option value="Chuyển khoản">Chuyển khoản</option>
						                <option value="Thỏa thuận">Thỏa thuận</option>
						              </select>
				                    <?php } ?>
				                </div>
				            </div>
				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Ghi chú:</label>
				                <div class="col-sm-9">
				                     <textarea  class="form-textarea form-control"  rows="6" name="order_notes"><?php echo (isset($page->order_notes)) ? ($page->order_notes) : (set_value('order_notes')); ?></textarea>
				                     <?php echo (form_error('order_notes')) ? ('<p class="error">'.form_error('order_notes').'</p>') : (""); ?>
				                </div>
				            </div>
							<div class="form-group">
				                <label for="inputEmail3" class="col-sm-3 control-label text-left">Ngày tạo:</label>
				                <div class="col-sm-9">
				                    <input type="text" name="created_at" class="form-control" value="<?php echo (isset($page->created_at)) ? ($page->created_at) : (set_value('created_at')); ?>" >
				                </div>
				            </div>
			            </div>
		         </div>
		    </div>
		    <!--end orderer-->
			<!--receiver -->
		    <div class="col-md-6">
		         <div class="box box-primary">
		            <div class="box-body">
			            <div class="form-group">
			                <div class="col-md-3">
				                <label>Trạng thái </label>
				            </div>
							<div class="col-md-9">
								<div class="radio">
									<label>
									<input type="radio" name="active" id="optionsRadios1" value="1" <?php echo ($page->active == 1) ? ('checked') : ('') ?>>
									Duyệt đơn hàng
									</label>
								</div>
								<div class="radio">
									<label>
									<input type="radio" name="active" id="optionsRadios2" value="2" <?php echo ($page->active == 2) ? ('checked') : ('') ?>>
									Hủy đơn hàng
									</label>
								</div>
								<div class="radio">
									<label>
									<input type="radio" name="active" id="optionsRadios3" value="0"  <?php echo ($page->active == 0) ? ('checked') : ('') ?> >
									Không duyệt
									</label>
								</div>
							</div>
		                </div>
		            </div>
		        </div>
		    </div>
		        <!--end receiver-->
		        <!-- /.col -->
		</div>
		      <!-- /.row -->
	</div>
		        <!-- /.box-body -->
		    <div class="form-group overload-hidden">
                <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
					<input type="submit" class="submit blue-btn" value="Cập nhật" name="update_orders">
				</div>
			</div><!-- /.form-field -->																								
          </div>
        <!-- /.tab-content -->

          <!-- /.form -->
       </form>
<!-- list product of order -->  
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">SẢN PHẨM CỦA ĐƠN HÀNG</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<th style="width: 40px">#</th>
						<th style="width: 100px" class="text-center">Hình ảnh</th>
						<th>Tên sản phẩm</th>
						<th class="text-center">Giá</th>
						<th class="text-center">Số lượng</th>
						<th>Thành tiền</th>
					</tr>
					<?php $i=0; foreach ($order_detail as $row){ 

					$sl=$this->db->query('SELECT * from '.TB_PRODUCTS.' where id='.$row['productid'])->row();
					$img = (isset($sl->image)) ? ( $sl->image) : ('');
					?>
					<tr>
						<td><?=++$i?></td>
						<td class="text-center"><img  src="<?= IMG_PATH_PRODUCT.'thumb/'.$img; ?>" style="width: 45px" class="width50"></td>
						<td>
							<?=$row['name']?>
							<p>Size: <?=$row['size']?></p>
							<p>Màu: <?=$row['color']?></p>
						</td>

						<td class="text-center"><?=number_format($row['price'])?></td>
						<td class="text-center"><?=$row['quantity']?></td>
						<td><?php echo number_format($row['price']*$row['quantity']); ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="5" class="text-right">Tổng tiền: </td>
						<td><?php echo number_format($page->total); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<!--end order -->
</div>
</div>
<script type="text/javascript"  language="javascript">
	CKEDITOR.replace('description');
	CKEDITOR.replace('description_en');
</script> 




