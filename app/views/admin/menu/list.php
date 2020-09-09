<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?= $addNew; ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $pageTitle; ?></h3>
    </div>
    <div class="box-body" id="list-pro">
		<table class="table table-bordered table-hover" role="grid">
			<thead>
			    <tr>
			        <th class="width40"></th>
			        <th class="size_stt">STT</th>
					<th>Tiêu đề</th>
					<th>Liên kết</th>
		            <!-- <th>Ngày đăng</th> -->
		            <th class="text-center nowrap">isMenu</th>
		            <!-- <th class="text-center width55">isFoter</th>
		            <th class="text-center width55">Top Bar</th> -->
		            <th class="text-center width55 nowrap">Trạng thái</th>
		            <th class="th-action nowrap">Sửa || Xóa</th>
				</tr>
			</thead>
			<tbody>
		    <?php echo $list_category; ?>
			</tbody>
		</table>
		<div class="box-pagination clearfix" id="example2_paginate">
		    <div class="action-table-quick pull-left">
		    	   <input type="checkbox" name="checklist_box" id="check_all"> Chọn tất cả | <a id="del-all" href="<?= $delAll; ?>"><i class="fa fa-close"></i> Xóa </a>
		    </div>
		    <?php echo (isset($pagination)) ? ($pagination) : ('');  ?>
	    </div>
	</div>
</div>
