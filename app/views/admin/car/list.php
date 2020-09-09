<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('car/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">

  	<div class="box-search row" style="display: none">
	    <form action="<?=admin_url('album')?>" method="get" enctype="multipart/form-data">
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
		        <th class="size_stt" style="width: 100px; text-align: center;">STT</th>
	            <th>Xe học</th>
	            <th>Trạng thái</th>
	            <th class="th-action" style="white-space: nowrap;">Sửa || Xóa</th>
			</tr>
		</thead>

		<tbody>

	    <?php 
	        foreach ($list as $row):			   
		?>
		<tr>
			<td style="width:30px"><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
		    <td style="width: 100px" class="text-center"><?= $row->count; ?></td>
			<td ><?= $row->name; ?></td>
			<td style="width: 100px">
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
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?=admin_url('address/del_list_choose')?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?=$pagination?>
    </div>


</div>
</div>

