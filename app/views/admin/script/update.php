<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Sửa danh mục</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>

<div class="nav-tabs-custom">
    <?php /*<ul class="nav nav-tabs">
        <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng việt</a></li>
        <li class=""><a href="#en" data-toggle="tab" aria-expanded="false">English</a></li>
    </ul> */?>
    
    <form action="<?php echo admin_url('script/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">

	        <div class="tab-pane active" id="vi">
	             <!-- /.box-header -->
			    
				    <div class="box-body">
				      <div class="row">
				        <div class="col-md-12">
				               
				           <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>"  placeholder="Tên website">
				                    <p class="error"><?php echo form_error('name'); ?></p>
				                </div>
			            	</div>
							
							<div class="form-group">
						        <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
						        <div class="col-sm-10">
						             <textarea id="script" class="form-textarea form-control" rows="6" name="script"><?php echo (isset($page->script)) ? ($page->script) : (set_value('script')); ?></textarea>
						        </div>
						    </div>

				          
				          <!-- /.form-group -->
				        </div>
				        
				        <!-- /.col -->
				      </div>
				      <!-- /.row -->
				    </div>
			        <!-- /.box-body -->
			   

	        </div>


	        
		    <div class="form-group overload-hidden">
                <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" name="update_script">
				</div>
			</div><!-- /.form-field -->																								
          </div>
        <!-- /.tab-content -->

          <!-- /.form -->
       </form>
         
   
</div>
</div>




