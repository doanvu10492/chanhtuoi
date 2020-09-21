<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('category_coupon/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $pageTitle; ?></h3>
    </div>
    <div class="box-body" id="list-pro">
		<table class="table table-bordered" role="grid">
			<thead>
			    <tr>
			        <th class="width40"></th>
			        <th class="size_stt">STT</th>
					<th>Tiêu đề</th>
		            <th>Ngày đăng</th>
		            <th class="text-center">Menu left</th>
		            <th class="text-center">Nổi bật</th>
		            <th class="text-center">Trạng thái</th>
		            <th class="th-action">Sửa || Xóa</th>
				</tr>
			</thead>
			<tbody>
		    <?php echo $list_category; ?>
			</tbody>
		</table>
	    <div class="box-pagination clearfix" id="example2_paginate">
		    <?php $this->load->view('admin/block/box_checkall'); ?>
		    <?php echo (isset($pagination)) ? ($pagination) : (""); ?>
	    </div>
	</div>
</div>
