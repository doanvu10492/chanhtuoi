<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('student/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">

  	<div class="box-search">
	    <form action="<?php echo admin_url('student')?>" method="get" enctype="multipart/form-data">
	    	<div class="row">
		        <div class="col-md-3">  
		        	<label>Từ ngày: </label> 
		        	<div class="form-group">
			           <input name="from" type="date" placeholder="Từ ngày" value="<?= isset($from) ? $from : ''; ?>" class="form-control" />
			       </div>
		        </div>
		        <div class="col-md-3"> 
		        	<label>Đến ngày: </label> 
		        	<div class="form-group">  
		           		<input name="to" type="date" placeholder="Đến ngày" value="<?= isset($to) ? $to : ''; ?>" class="form-control" />
		           	</div>
		        </div>
		        <div class="col-md-3">    
		        	<label>Chọn địa điểm: </label> 
		            <div class="form-group">
	                   <select name="addressId" class="form-control">
	                    	<?php echo $selectAddress; ?>
	                    </select>
	                </div>
		        </div> 
				<div class="col-md-3">   
					<label>Họ tên: </label> 
		        	<div class="form-group">  
		           		<input name="fullname" type="text" placeholder="Họ tên" value="<?= isset($fullname) ? $fullname : ''; ?>" class="form-control" />
		       		</div>
		        </div>
		    </div>
	        <div class="row">
	        	<div class="col-md-3">   
		        	<div class="form-group">  
		           		<input name="code" type="text" placeholder="Mã đăng ký" value="<?= isset($code) ? $code : ''; ?>" class="form-control" />
		       		</div>
		        </div>
		        <div class="col-md-3">   
		           <input name="cmnd" type="text" placeholder="CMND" value="<?= isset($cmnd) ? $cmnd : ''; ?>" class="form-control" />
		        </div>
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
	                   <select name="carId" class="form-control">
	                    	<?php echo $selectCar; ?>
	                    </select>
	                </div>
		        </div> 
		        <div class="col-md-3">    
		            <div class="form-group">
	                   <select name="result" class="form-control">
	                    	<option value="">--- Chọn kết quả thi ---</option>
	                    	<?php foreach($examResult as $key => $value) { ?>
	                    		<option value="<?= $key ?>" <?= $key == $selectedResultExam ? 'selected = selected' : ''; ?>>
	                    			<?= $value ?>
	                    		</option>
	                    	<?php } ?>		
	                    </select>
	                </div>
		        </div> 
		        <div class="col-md-3">    
		            <div class="form-group">
	                   <select name="active" class="form-control">
	                    	<option value="">--- Chọn kết quả đăng ký ---</option>
	                    	<option value="0" <?= $resultRegister == 0 && $resultRegister != ''  ? 'selected = selected' : ''; ?>>Đang Xử lý</option>
	                    	<option value="1" <?= $resultRegister ? 'selected = selected' : ''; ?>>Đã đăng ký </option>
	                    </select>
	                </div>
		        </div> 
		        <div class="col-md-3">   
		            <input type="submit" class="submit blue-btn" value="Tìm kiếm" />
		            <?php if (adminRoleName() != 'manage_store') { ?>
		            <a href="<?= $linkExportCsv ?>" class=" blue-btn">Xuất file csv</a>
		        	<?php } ?>
		        </div>
		    </div>
	    </form>
    </div>

</div>

<div class="box-body table-responsive" id="list-pro" style="overflow-x: scroll;">
<?php if (adminRoleName() != 'accountant' && adminRoleName() != 'manage_store') { ?>
	<div class="action-table-quick pull-left">
		<a id="del-all" href="<?=admin_url('student/del_list_choose')?>" style="padding: 5px 10px; display: inline-block; background: #f00; color: #fff;">Xóa chọn</a>
	</div>
<?php } ?>
	<table class="table table-bordered table-hover" role="grid" style="min-width: <?= (adminRoleName() != 'accountant' && adminRoleName() != 'manage_store') ? '1500px' : '1800px' ?>">
		<thead>
		    <tr>
		        <th></th>
		        <th class="size_stt">STT</th>
		        <?php if (adminRoleName() != 'accountant' && adminRoleName() != 'manage_store') { ?>
	            <th class="th-action" style="white-space: nowrap;">Sửa || Xóa</th>
	        	<?php } ?>
				<th style="width: 150px" >Họ tên</th>
				<th>Ngày sinh</th>
				
				<?php if ( adminRoleName() == 'manage_store') { ?>
				<th>CMND</th>
				<th>Địa chỉ</th>
				<?php } ?>
	            <th>Mã khóa</th>
	            <?php if ( adminRoleName() == 'manage_store') { ?>
	            <th>Mã học viên</th>
	        	<?php } ?>
	<!--             <th>Xe học</th>
	            <th>Mã đăng ký</th> -->
	            <th style="width: 120px">Kết quả đăng ký</th>
	            <th style="width: 120px">Kết quả thi</th>
	            <th style="width: 120px">Số tiền</th>
	            <th style="width: 100px">Thu tiền</th>
	            <th>Người tạo</th>
	            <th>Ngày cập nhật</th>
			</tr>
		</thead>

		<tbody>

	    <?php 
	        foreach ($list as $row):			   
		?>
		<tr>
			<td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
		    <td><?= $row->count; ?></td>
		    <?php if (adminRoleName() != 'accountant' && adminRoleName() != 'manage_store') { ?>
			<td class="text-center">
	            <a href="<?=$row->link_update?>" class="btn-action glyphicon glyphicon-pencil"> </a>
	            <a href="<?=$row->link_delete?>" class="btn-action glyphicon glyphicon-trash"></a>
	        </td>
	    	<?php } ?>
			<td class="text-left"><?= $row->fullname; ?></td>
			<td class="text-center"><?= $row->birthday ? date('d-m-Y', strtotime($row->birthday)) : ''; ?></td>
			<?php if ( adminRoleName() == 'manage_store') { ?>
			<td class="text-left"><?= $row->cmnd; ?></td>
			<td class="text-left"><?= $row->title_address; ?></td>
			<?php } ?>
			<td class="text-center"><?= $row->title_course; ?></td>
			<?php if ( adminRoleName() == 'manage_store') { ?>
			<td class="text-left"><?= $row->code; ?></td>
			<?php } ?>
			<?php /*<td class="text-center"><?= $row->title_degree; ?></td> */?>	
			<?php /*
			<td class="text-center"><?= $row->title_car; ?></td>
			<td class="text-center"><?= $row->code; ?></td> */?>
			<td>
			     <a href="<?=$row->link_active?>" data-action='active' rel="<?=$row->active?>" class="btn-status glyphicon <?=$row->icon_active?>"> </a>
			</td>
			<td>
				<button href="<?= adminRoleName() != 'accountant' ? $row->linkResult: 'javascript:void(0)' ?>" data-action='result' rel="<?=$row->result?>" class="btn-status btn-result <?= $row->result ?>"> <?= $row->title_exam_result; ?> </button>
			</td>
			<td class="text-center"><?= number_format($row->total_paid) .' đ'; ?></td>
			<td>
			     <button href="<?= adminRoleName() == 'accountant' ? $row->linkPaid : 'javascript:void(0)' ?>" data-action='isPaid' rel="<?=$row->isPaid?>" class="btn-status btn-accountant <?= $row->isPaid ? 'success' : ''; ?>"> <?= $row->title_paid; ?> </button>
			</td>
			<td class="text-left"><?= $row->create_user; ?></td>
			<td class="text-left"><?= date('d-m-Y H:i:s', strtotime($row->updated_at)); ?></td> 
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>


</div>

	<div class="box-pagination clearfix" id="example2_paginate">
	    
	    <?=$pagination?>
    </div>

</div>

