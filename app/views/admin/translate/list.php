<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?=admin_url('translate/updated/0')?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>
<div class="box">
    <div class="box-header with-border">
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
	        <!-- <th></th> -->
	        <th>
            	<a href="#">Code
	            </a>
           	</th>
            <th>
            	<a href="#">Tiếng Việt
	            </a>
           	</th>
            <th>
            	<a href="#">Tiếng Anh</a>
	        </th>
            <th class="th-action width85">Send <!-- || Xóa --></th>
		</tr>
	</thead>
	<tbody>
    <?php 
        foreach ($pages as $row)
  			{   
	?>
	<tr>
		<!-- <td ><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td> -->
	    <td><?=$row->code?></td>
	    <td> <?=$row->name?> </td>
		<td> <?=$row->name_en?> </td>
		<td class="text-center">
            <a href="<?=$row->link_update?>" class="btn-action glyphicon glyphicon-pencil"> </a>
            <!-- <a href="<?=$row->link_delete?>" class="btn-action glyphicon glyphicon-trash"></a> -->
        </td>
	</tr>

	<?php } ?>

	</tbody>

</table>
	<div class="box-pagination clearfix" id="example2_paginate">
	    <?=$pagination?>
    </div>
</div>
</div>

