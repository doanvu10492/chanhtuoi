<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('coupon/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
	    <!-- box search -->
	  	<div class="box-search row">
		    <form action="<?php echo admin_url('coupon')?>" method="get" enctype="multipart/form-data">
		        <div class="col-md-3">   
		           <input  name="keyword" type="text" placeholder="Tiêu đề coupon" value="<?= isset($getRequest['keyword']) ? $getRequest['keyword'] : ''; ?>" class="form-control" />
		        </div>
		        <div class="col-md-3">    
		            <div class="form-group">
	                   <select name="id_cate" class="form-control">
	                    	<?php echo $option; ?>
	                    </select>
	                </div>
		        </div>  
		        <div class="col-md-3">   
		            <input type="submit" class="submit blue-btn" value="Tìm kiếm" />
		        </div>
		    </form>
	    </div>
	   <!-- end box search -->
	</div>

	<div class="box-body" id="list-pro">
		<table class="table table-bordered table-hover" role="grid">
			<thead>
			    <tr>
			        <th></th>
			        <th class="size_stt">STT</th>
					<th>Tiêu đề</th>
		            <th>Tên coupon</th>
		            <th>Danh mục</th>
					<th class="width85 text-center">Nổi bật</th>
		            <th class="width85">Trạng thái</th>
		            <th class="th-action">Sửa || Xóa</th>
				</tr>
			</thead>

			<tbody>
		    <?php 
		        $i=0;
		        foreach ($pages as $row) {
				    $i++;
			?>
			<tr>
			    <td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
			    <td><?php echo $i.'.'; ?></td>
				<td>
				    <?php echo $row->name; ?> 
				</td>
				<td> <?= $row->shortname; ?>
				</td>
	            <td> <?php echo $row->name_cate; ?> </td>
				<td>
				     <a href="<?php echo $row->link_active; ?>" data-action='isHighlight' rel="<?php echo $row->icon_highlight; ?>" class="btn-status glyphicon <?php echo $row->icon_highlight; ?>"> </a>
				
				</td>
				<td>
				     <a href="<?php echo $row->link_active; ?>" data-action='active' rel="<?php echo $row->active; ?>" class="btn-status glyphicon <?php echo $row->icon_active; ?>"></a>
				</td>
				<td class="text-center">
		            <a href="<?php echo $row->link_update; ?>" class="btn-action glyphicon glyphicon-pencil"> </a>
		            <a href="<?php echo $row->link_delete; ?>" class="btn-action btn-del glyphicon glyphicon-trash"></a>
		        </td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	    <div class="box-pagination clearfix" id="example2_paginate">
		    <div class="action-table-quick pull-left">
		    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('products/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
		    </div>
		    <?php echo $pagination; ?>
	    </div>
	</div>
</div>



