<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('pages/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
      
    <?php //box-search ?>
  	<div class="box-search row">
	    <form action="<?php echo admin_url('pages/index')?>" method="get" enctype="multipart/form-data">
	    <div class="col-md-4">   
	    </div> 
	        <div class="col-md-3">   
	           <input  name="keyword" type="text" placeholder="Từ khóa" value="<?php if(isset($keyword)){echo $keyword; } else {echo '';}  ?>" class="form-control" />
	        </div>
	        <div class="col-md-2">   
	            <input type="submit" class="submit blue-btn" value="Tìm kiếm" />
	        </div>
	    </form>
    </div>
   <?php //end box search ?>

    </div>

    <div class="box-body table-responsive" id="list-pro">
	<table class="table table-bordered" role="grid">
		<thead>
		    <tr>
		        <th class="width40"></th>
		        <th class="size_stt">STT</th>
				<th>Tiêu đề</th>
	            <th>Ngày đăng</th>
	            <th>Vị trí</th>
	            <th class="text-center">Chi nhánh</th>
	            <th class="text-center">Page trang chủ</th>
	            <th class="text-center">Footer</th>
	            <th class="text-center">Trạng thái</th>
	            <th class="th-action" style="white-space: nowrap;">Sửa || Xóa</th>
			</tr>
		</thead>
		<tbody>
	    	<?php echo $list_pages; ?>
		</tbody>
	</table>
	<div class="box-pagination clearfix" id="example2_paginate">
	    <div class="action-table-quick pull-left">
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('pages/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?php echo (isset($pagination)) ? ($pagination) : (""); ?>
    </div>
</div>
</div>
