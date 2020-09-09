<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('script/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Danh mục bài viết</h3>
    </div>

    <div class="box-body" id="list-pro">
	<table class="table table-bordered table-hover" role="grid">
		<thead>
		    <tr>
		        <th class="width40"></th>
		        <th class="size_stt">STT</th>
				<th>Tiêu đề</th>
	            <th>Ngày đăng</th>
	          
	            
	            <th class="text-center width55">Header (Yes) | Body (No)</th>
	            <th class="text-center width55">Trạng thái</th>
	            <th class="th-action">Sửa || Xóa</th>
			</tr>
		</thead>

		<tbody>

	    <?php echo $list_category; ?>
		</tbody>
	</table>

	<div class="box-pagination clearfix" id="example2_paginate">
	    <div class="action-table-quick pull-left">
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('script/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?php echo (isset($pagination)) ? ($pagination) : ('');  ?>
    </div>


</div>
</div>
