<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('album/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
  	<div class="box-header with-border">
	  	<div class="box-search row">
		    <form action="<?=admin_url('album')?>" method="get" enctype="multipart/form-data">
			    <div class="col-md-4">   
			    </div> 
		        <div class="col-md-3">   
		           <input  name="keyword" type="text" placeholder="Từ khóa" value="<?= isset($getRequest['keyword']) ?  $getRequest['keyword'] : '' ?>" class="form-control" />
		        </div>
		        <div class="col-md-3">    
		            <div class="form-group">
	                   <select name="id_cate" class="form-control">
	                    	<?=$option; ?>
	                    </select>
	                </div>
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
				<th class="width75">Hình ảnh</th>
	            <th>
	            	<a href="<?= admin_url('session_sort/sort/album/name') ?>">Tiêu đề
					<?=($sort_field == 'name') ? ( $icon_sort) : ("");?></a>
				</th>
	            <th>
	            	<a href="<?= admin_url('session_sort/sort/album/id_cate') ?>">Danh mục
	          		  <?=($sort_field == 'id_cate') ? ( $icon_sort) : ("");?></a>
	           	</th>
	            
	            <th class="width85">
	            	<a href="<?= admin_url('session_sort/sort/album/active') ?>">Trạng thái
	          		  <?=($sort_field == 'active') ? ( $icon_sort) : ("");?></a>
	          	</th>
	            <th class="th-action" style="white-space: nowrap;">Sửa || Xóa</th>
			</tr>
		</thead>

		<tbody>

	    <?php 
	        foreach ($pages as $row):			   
		?>
		<tr>
			<td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
		    <td><?php echo $row->count; ?></td>
			<td class="text-center">
			    <a href="<?php echo $row->image_path; ?>" title="preview" class="html5lightbox">
			          <img src="<?php echo $row->image_thumb; ?>" alt="" class="thumb size48">
			     </a>
			</td>

			<td>  <a class="title-article" href="<?=$row->link_update?>"><?=$row->name?></a> 
				<p class="text-left date-published"><i>Ngày đăng: </i><?php echo date('d-m-Y H:i', strtotime($row->created_at)); ?> </p></td>

            <td> <?=$row->name_cate?> </td>

           
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
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?=admin_url('album/del_list_choose')?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?=$pagination?>
    </div>


</div>
</div>
<!-- 
<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>kích ảnh upload: </strong>Ảnh upload cần có kích thước chiều rông & chiều cao tuần tự với tỉ lệ 300px và 260px<br />
<strong>Ảnh danh mục : </strong>Ảnh hiển thị ngoài trang chủ 5 danh mục	Làm đẹp, giáo dục, xã hội, sức khẻo, ẩm thực sắp xếp theo thời gian giảm dần<br />
<strong>Banner : </strong>Ảnh hiển thị ngoài trang chủ phía dưới menu thời gian sắp xếp theo thời gian giảm dần kích thước ảnh lớn có tỉ lệ chiều rộng và cao là 620 và 470<br />

<strong>Nổi bật : </strong>chick chọn bài viết hiển thị trang chủ <br />
<strong>Tin nhanh :</strong>bài viết hiển thị bên góc phải sidebar của website  <br />

<strong>Trạng thái :</strong>hình thức hiển thị hay không hiển thị  <br />
</div>
 -->
