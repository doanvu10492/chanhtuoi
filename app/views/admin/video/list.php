<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?=admin_url('video/updated/0')?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">

<div class="box-header with-border">

<div class="box-search row">
    <form action="<?=admin_url('video/index')?>" method="get" enctype="multipart/form-data">
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
</div>

<div class="box-body table-responsive" id="list-pro">
<table class="table table-bordered table-hover" role="grid">
	<thead>
	    <tr>
	        <th class="width40"></th>
	        <th class="size_stt">STT</th>
	        <th>Hình ảnh</th>
            <th>Tiêu đề</th>
            <th>Mã youtube</th>
            <th>Ngày đăng</th>
            <th class="width85 text-center">Nổi bật</th>
            <th class="width85">Trạng thái</th>
            <th class="th-action">Sửa || Xóa</th>
		</tr>
	</thead>

	<tbody>

    <?php 
        foreach ($pages as $row):
	?>
	<tr>
		<td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>

	    <td><?=$row->count.'.'?></td>

		<td class="text-center"><img class="img_video width85" src="http://img.youtube.com/vi/<?php echo $row->code; ?>/0.jpg"></td>

		<td> <a class="title-article" href="<?=$row->link_update?>"><?=$row->name?> </a></td>

        <td> <?=$row->code?> </td>
        
		<td> <?=$row->created_at?> </td>
		<td> 
		     <a href="<?=$row->link_active?>" data-action='isHome' rel="<?=$row->isHome?>" class="btn-status glyphicon <?=$row->icon_is_home?>"> </a>
		</td>

		<td> 
		    <a href="<?=$row->link_active?>" data-action='active' rel="<?=$row->active?>" class="btn-status glyphicon <?=$row->icon_active?>"> </a>
		</td>

		<td class="text-center">
            <a href="<?=$row->link_update?>" class="btn-action glyphicon glyphicon-pencil"> </a>
            <a href="<?=$row->link_delete?>" class="btn-action glyphicon glyphicon-trash"></a>
        </td>

	</tr>

	<?php endforeach; ?>

	</tbody>
</table>

<div class="box-pagination clearfix" id="example2_paginate">
    <div class="action-table-quick pull-left">
    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?=admin_url('video/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
    </div>
    <?php echo (isset($pagination)) ? ($pagination) : (""); ?>
</div>


</div>
</div>

<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>Chú ý: </strong>./ Ảnh upload cần có kích thước chiều dài & chiều rộng tuần tự với tỉ lệ 365px và 240px

<strong>Nổi bật : </strong>Những video hiển thị ngoài trang chủ và sidebar right của website <br />
<strong>Code  : </strong>Mã code đường dẫn website sao v= VD: https://www.youtube.com/watch?v=79k04TqI7wQ => code = 79k04TqI7wQ <br />
<strong>Trạng thái : </strong>hiển thị hay không hiển thị <br />
</div>
