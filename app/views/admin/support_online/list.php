<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('support_online/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
  

    <div class="box-body table-responsive" id="list-pro">
	<table class="table table-bordered" role="grid">
		<thead>
		    <tr>
		        <th class="width40"></th>
		        <th class="size_stt">STT</th>
		        
	            <th>Họ tên</th>
	            <th class="">Hình ảnh</th>
	            <th>hotline</th>
	            <th>Email</th>
	            <th>Sắp xếp</th>
	            <th class="text-center width55">Trạng thái</th>
	            <th class="th-action">Sửa || Xóa</th>
			</tr>
		</thead>

		<tbody>

	    <?php 
	        $i=0;
	        foreach ($pages as $row)
	  		{
			   $i++;
		?>
		<tr>
		    <td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
		    <td><?php echo $row->count.'.'; ?></td>
			
			<td> <?php echo $row->name; ?> </td>
			<td>
			    <a href="<?php echo $row->image; ?>" title="preview">
			          <img src="<?php echo $row->image; ?>" alt="" class="thumb size255_92">
			     </a>
			</td>
			<td> <?php echo $row->hotline; ?> </td>
            <td> <?php echo $row->email; ?> </td>
			<td> <?php echo $row->ordering; ?> </td>
			<td>
			     <a href="<?php echo $row->link_active; ?>" data-action='active' rel="<?php echo $row->active; ?>" class="btn-status glyphicon <?php echo $row->icon_active; ?>"> </a>
			
			</td>

			<td class="text-center">
	            <a href="<?php echo $row->link_update; ?>" class="btn-action glyphicon glyphicon-pencil"> </a>
	            <a href="<?php echo $row->link_delete; ?>" class="btn-action glyphicon glyphicon-trash"></a>
	        </td>
		</tr>
		<?php } ?>
		</tbody>
	</table>

	<div class="box-pagination clearfix" id="example2_paginate">
	    <div class="action-table-quick pull-left">
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('support_online/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?php echo (isset($pagination)) ? ($pagination) : ('');  ?>
    </div>


</div>
</div>

<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>Chú ý: </strong>./ Ảnh upload cần có kích thước chiều dài & chiều rộng tuần tự với tỉ lệ 365px và 240px
</div>
