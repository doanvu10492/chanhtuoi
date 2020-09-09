<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?=admin_url('contact/updated/0')?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
    <?php //box-search ?>

  	 <div class="box-search row">
	    <form action="<?=admin_url('contact/index')?>" method="get" enctype="multipart/form-data">
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
	        <th></th>
	        <th class="size_stt">STT</th>
            <th>
            	<a href="<?= admin_url('session_sort/sort/contact/email') ?>">Email
	            <?=($sort_field == 'email') ? ( $icon_sort) : ("");?></a>
           	</th>
            <th>
            	<a href="<?= admin_url('session_sort/sort/contact/created_at') ?>">Ngày nhận
	            <?=($sort_field == 'created_at') ? ( $icon_sort) : ("");?></a>
	        </th>
            <th class="width85">
            	<a href="<?= admin_url('session_sort/sort/contact/active') ?>">Trạng thái
	            <?=($sort_field == 'active') ? ( $icon_sort) : ("");?></a>
            </th>
            <th class="th-action width85">Send || Xóa</th>
		</tr>
	</thead>

	<tbody>

    <?php 
        foreach ($pages as $row)
  			{   
	?>
	<tr>
		<td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>

	    <td><?=$row->count?></td>

		<td> <?=$row->email?> </td>

		<td>
			<p class="text-left date-published"><?=$row->date?> </p>
		</td>

		<td>
		     <a href="<?=$row->link_active?>" data-action='active' rel="<?=$row->active?>" class="btn-status glyphicon <?=$row->icon_active?>"> </a>
		</td>

		<td class="text-center">
            <a href="<?=$row->link_update?>" class="btn-action fa fa-paper-plane"> </a>
            <a href="<?=$row->link_delete?>" class="btn-action glyphicon glyphicon-trash btn-del"></a>
        </td>

	</tr>

	<?php } ?>

	</tbody>

</table>

	<div class="box-pagination clearfix" id="example2_paginate">
	    <div class="action-table-quick pull-left">
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?=admin_url('contact/del_list_choose')?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?=$pagination?>
    </div>


</div>
</div>

<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>Chú ý: </strong>./ Ảnh upload cần có kích thước chiều dài & chiều rộng tuần tự với tỉ lệ 365px và 240px
</div>
