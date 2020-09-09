<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?php echo admin_url('orders/updated/0');  ?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>

<div class="box">
    <div class="box-header with-border">
       <?php //box-search ?>

  	 <div class="box-search row">
	    <form action="<?php echo admin_url('orders/index')?>" method="get" enctype="multipart/form-data">
	    <div class="col-md-4">
	    	<input  name="email" type="text" placeholder="Email" value="<?= ( isset($email) ) ? ($email) : ('');  ?>" class="form-control" />   
	    </div> 

        <div class="col-md-3">   
           <input  name="keyword" type="text" placeholder="Tên khách hàng" value="<?= ( isset($keyword) ) ? ($keyword) : ('');  ?>" class="form-control" />


        </div>

        <div class="col-md-3">   
           <select name="active" class="form-control" aria-invalid="false">
            <option>Trạng thái đơn hàng</option>
            <option value="1" <?php echo (isset($active) && $active == 1) ? ('seleted') : (''); ?>>Hoàn thành</option>
            <option value="0" <?php echo (isset($active) && $active == 0) ? ('seleted') : (''); ?>>Đang chờ</option>
            <option value="2" <?php echo (isset($active) && $active == 2) ? ('seleted') : (''); ?>>Hủy</option>
          </select>
        </div>

        <div class="col-md-2">   
            <input type="submit" class="submit blue-btn" value="Tìm kiếm" />
        </div>
	    </form>



    </div>

   <?php //end box search ?>

    </div>

    <div class="box-body" id="list-pro">
	<table class="table table-bordered" role="grid">
		<thead>
		    <tr>
		        <th class="width40"></th>
		        <th class="size_stt">STT</th>
	            <th>Khách hàng</th>
	            
	            
	            <th>Email</th>
	            <th>Tổng giá trị</th>
	            <th>Hình thức thanh toán</th>
	            <th >Trạng thái</th>
	            <!-- <th>Xuất file</th> -->
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
			
			<td> <?php echo $row->order_name; ?> <p class="date">Ngày tạo:  <?php echo $row->created_at; ?> </p></td>

            
			
			<td> <?php echo $row->order_email; ?> </td>

			<td> <?php echo ($row->total > 100) ? (number_format($row->total).' VNĐ') : ('Liên hệ'); ?> </td>
			<td> <?php echo $row->typepay; ?> </td>
			<td> <?php echo $row->text_active; ?>			
			</td>
			<!-- <td class="text-center"><a href="<?= $row->link_order; ?>"><i class="fa fa-file-excel-o" style="font-size: 22px" aria-hidden="true"></i></a></td> -->

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
	    	   <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('orders/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
	    </div>
	    <?php echo (isset($pagination)) ? ($pagination) : (""); ?>
    </div>


</div>
</div>

<div class="notification note-attention">
<p><strong>Lưu ý&nbsp;:&nbsp;</strong>Upload hình ảnh đại diện cho dự án</p>
<strong>Chú ý: </strong>./ Ảnh upload cần có kích thước chiều dài & chiều rộng tuần tự với tỉ lệ 365px và 240px
</div>


<script type="text/javascript">
	$(document).ready(function(){
		//action status product
		$("#list-pro a.btn-status").on('click',function(event){
			event.preventDefault();
			active = $(this).attr('rel');
			// for actions of attribute: active, hightlight 
			action = $(this).attr('data-action');
			ms = $(this);
			$.ajax({
			    'type' : 'POST',
			    'url'  : ms.attr('href'),
			    'data' : {'active' : active, 'action' : action},
			    success: function(data){
			        result = JSON.parse(data);
			        if(result.result){
			        	if (ms.hasClass('glyphicon-ok'))
			        	{
			        		ms.removeClass('glyphicon-ok');
			        	}
			        	else
			        	{		        		
			        		ms.removeClass('glyphicon-remove');
			        	}
			        	// change status and assign value
			        	ms.addClass(result.result).attr('rel', result.num);
			        	ms.attr('rel', result.num);
			        }else{
			        	alert("Bài viết này không tồn tại !");
			        }
			    }
			});
		});

        //action delete product
		$("#list-pro").on('click','.btn-del',function(){
	        check_del = confirm('Bạn muốn xóa dòng này');
	        if (check_del == true)
	        {
	        	window.location.href = $(this).attr(href);
	        }
	        else
	        {
                return false;
	        }
		});

		$('#check_all').on('click', function(){
			var checklist = document.getElementsByName('checklist');
		  	if ($('#check_all').is(':checked')){

		  		for (var i=0; i<checklist.length; i++) {
		    		checklist[i].checked = true;
		   		}
		  	}
		  	else
		  	{
		  		for (var i=0; i<checklist.length; i++) {
		  			checklist[i].checked = false;
		  		}
		  	}

		});

		
       
        $('#del-all').on('click', function(event){
        	event.preventDefault();
        	
			var checklist = document.getElementsByName('checklist');
			  // loop over them all
			  var list_id = '';
			  var del_all = $(this);
			  for (var i=0; i<checklist.length; i++) {
			       if (checklist[i].checked == true)
			       {
                       list_id = list_id + ((list_id == '') ? (checklist[i].value) : (','+checklist[i].value));
			       }
			  }
			  	
			if (list_id == '')
			{
				alert('Vui lòng chọn những bài viết cần xóa');
			}else{ 
                 check_del = confirm('Bạn muốn xóa dòng này');
		        if (check_del == true)
		        {
				    $.ajax({
				    	type : 'POST',
				    	url  : del_all.attr('href'),
				    	data : {'list_id' : list_id},
				    	success: function(data){
				    		result = JSON.parse(data);
				    		if (result.result)
				    		{
				    			window.location.href = result.result;
				    		}
				    		else
				    		{
				    			alert(result.error);
				    		}
				    	}
				    });
				}
				else{
					return false;
				}
			}


		});



	});
</script>


