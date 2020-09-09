<div class="box">
    <div class="box-header with-border">
  	 	<div class="box-search row">
		    <form action="<?php echo admin_url('products/table_price')?>" method="get" enctype="multipart/form-data">
			    <div class="col-md-4">   
			    </div> 
		        <div class="col-md-3">
		           <input  name="from_time" type="text" placeholder="Từ ngày" value="<?php if(isset($from_time)){echo $from_time; } else {echo '';}  ?>" class="form-control" id="datepicker2" />
		        </div>
		        <div class="col-md-3">
		           <input  name="to_time" type="text" placeholder="Đến ngày" value="<?php if(isset($to_time)){echo $to_time; } else {echo '';}  ?>" class="form-control" id="datepicker" />
		        </div>
		        <div class="col-md-2">   
		            <input type="submit" class="submit blue-btn" value="IN BẢNG GIÁ" />
		        </div>
		    </form>
	    	<div style="clear: both; padding: 20px; text-align: center; font-size: 16px"><?= $error; ?></div>
    	</div>
	</div>
</div>


