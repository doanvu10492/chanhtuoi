<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Sửa</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>

<div class="nav-tabs-custom">
    
    
    <form action="<?php echo admin_url('tags/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">

	        <div class="tab-pane active" id="vi">
	             <!-- /.box-header -->
			    
				    <div class="box-body">
				      <div class="row">
				        <div class="col-md-12">
				               
				           <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="name_tags" class="form-control" value="<?php echo (isset($page->name_tags)) ? ($page->name_tags) : (set_value('name_tags')); ?>"  placeholder="Tên website">
				                    <p class="error"><?php echo (form_error('name_tags') != null) ? ('Nhập tiêu đề không được trùng với những tiêu đề khác') : (''); ?></p>
				                </div>
			            	</div>

				           
							<div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Meta title:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="meta_title" class="form-control" value="<?php echo (isset($page->meta_title)) ? ($page->meta_title) : (set_value('meta_title')); ?>">
				                </div>
				            </div>

				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Meta keywords:</label>
				                <div class="col-sm-10">
				                     <textarea  class="form-textarea" cols="100" rows="6" name="meta_keywords"><?php echo (isset($page->meta_keywords)) ? ($page->meta_keywords) : (set_value('meta_keywords')); ?></textarea>
				                </div>
				            </div>

				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Meta description:</label>
				                <div class="col-sm-10">
				                     <textarea  class="form-textarea" cols="100" rows="6" name="meta_description"><?php echo (isset($page->meta_description)) ? ($page->meta_description) : (set_value('meta_description')); ?></textarea>
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
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" name="update_tags">
				</div>
			</div><!-- /.form-field -->																								
          </div>
        <!-- /.tab-content -->

          <!-- /.form -->
       </form>
         
   
</div>
</div>




