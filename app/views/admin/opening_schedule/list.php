<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('opening_schedule/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">

  	<div class="box-search row">
	    <form action="<?php echo admin_url('opening_schedule')?>" method="get" enctype="multipart/form-data">
	    	<div class="col-md-3">    
	            <div class="form-group">
                   <select name="courseId" class="form-control">
                    	<?php echo $selectCourses; ?>
                    </select>
                </div>
	        </div> 
	        <div class="col-md-3">    
	            <div class="form-group">
                   <select name="degreeId" class="form-control">
                    	<?php echo $selectDegree; ?>
                    </select>
                </div>
	        </div> 
	        <div class="col-md-3">    
	            <div class="form-group">
                   <select name="addressId" class="form-control">
                    	<?php echo $selectAddress; ?>
                    </select>
                </div>
	        </div> 
	        <div class="col-md-3">    
	            <div class="form-group">
                   <select name="scheduleId" class="form-control">
                    	<?php echo $selectSchedule; ?>
                    </select>
                </div>
	        </div> 
	        <div class="col-md-3">   
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
		        <th>Khóa</th>
				<th class="width75">Hạng xe</th>
	            <th>Phòng ghi danh</th>
	            <th style="max-width: 150px;">Dự kiến khai giảng</th>
	            <th>Dự kiến bế giảng</th>
	            <th>Dự kiến thi</th>
	            <th>Lưu lượng</th>
	            <th>Trạng thái</th>
	            <th class="th-action" style="white-space: nowrap;">Sửa || Xóa</th>
			</tr>
		</thead>

		<tbody>

	    <?php 
	        foreach ($list as $row):			   
		?>
		<tr>
			<td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
		    <td><?= $row->count; ?></td>
		    <td><?= $row->title_course; ?></td>
			<td class="text-left"><?= $row->title_degree; ?></td>
			<td class="text-left" style="max-width: 150px;"><?= $row->title_address; ?></td>
			<td ><?= date('d-m-Y', strtotime($row->start_date)); ?></td>
			<td ><?= date('d-m-Y', strtotime($row->end_date)); ?></td>
			<td ><?= $row->exam_date; ?></td>
			<td><?= $row->total_register; ?></td>
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
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?=admin_url('student/del_list_choose')?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?=$pagination?>
    </div>


</div>
</div>

