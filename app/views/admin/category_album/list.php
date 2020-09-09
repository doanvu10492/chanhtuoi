<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('category_album/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-body table-responsive" id="list-pro">
	<table class="table table-bordered" role="grid">
		<thead>
		    <tr>
		    	<th class="width40"></th>
		        <th class="size_stt">STT</th>
				<th>Tiêu đề</th>
	            <th>Ngày đăng</th>
	            <th class="text-center width100">Hiện trang chủ</th>
	            <th class="text-center width75">Nổi bật</th>
	            <th class="text-center width85">Trạng thái</th>
	            <th class="th-action" style="white-space: nowrap;">Sửa || Xóa</th>
			</tr>
		</thead>

		<tbody>

	    <?php echo $list_category; ?>
		</tbody>
	</table>

	<div class="box-pagination clearfix" id="example2_paginate">
	    <div class="action-table-quick pull-left">
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('category_album/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?php echo (isset($pagination)) ? ($pagination) : (""); ?>
    </div>


</div>
</div>
<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>Hiển thị trang chủ : </strong>5 danh mục hiển thị ngoài trang chủ <br />
<strong>Nổi bật : </strong>Những danh mục hiển thị ngoài trang chủ phía dưới video nội dung bên trái cùng danh mục bài viết kèm theo<br />
<strong>Menu  : </strong>Những danh mục hiển thị trên thanh menu website <br />
<strong>Footer  : </strong>Những danh mục hiển thị phía dưới footer website <br />
<strong>Trạng thái : </strong>hiển thị hay không hiển thị <br />
</div>

