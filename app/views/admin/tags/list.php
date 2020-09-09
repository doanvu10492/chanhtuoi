<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('tags/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tags</h3>
    </div>

    <div class="box-body table-responsive" id="list-pro">
	<table class="table table-bordered table-hover" role="grid">
		<thead>
		    <tr>
		        <th class="width40"></th>
		        <th class="size_stt">STT</th>
	            <th>Tiêu đề</th>
	            
	           
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
		    <td><input type="checkbox" name="checklist"  value="<?php echo $row->id_tags ?>"></td>
		    <td><?php echo $i; ?></td>
			
			<td> <a class="title-article" href="<?=$row->link_update?>"><?php echo $row->name_tags; ?></a> </td>
			
			

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
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('tags/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?php echo (isset($pagination)) ? ($pagination) : ('');  ?>
    </div>


</div>
</div>

<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>Chú ý: </strong>./ Ảnh upload cần có kích thước chiều dài & chiều rộng tuần tự với tỉ lệ 365px và 240px
</div>
