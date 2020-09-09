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

	<ul class="nav nav-tabs">
        <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng việt</a></li>

         <li style="display: none"><a href="#en" data-toggle="tab" aria-expanded="true">Tiếng anh</a></li>
      
    </ul>

    <form action="<?php echo admin_url('system_branch/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
				                <label for="inputEmail3" class="col-sm-2 control-label">Quận/Huyện:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="distrist" class="form-control" value="<?php echo (isset($page->distrist)) ? ($page->distrist) : (set_value('distrist')); ?>"  placeholder="">
				                    <p class="error"><?php echo form_error('distrist'); ?></p>
				                </div>
			            	</div>

							<div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="address" class="form-control" value="<?php echo (isset($page->address)) ? ($page->address) : (set_value('address')); ?>">
				                    <p class="error"><?=form_error('address')?></p>
				                </div>

				            </div>


			            	<div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Sắp xếp:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="ordering" class="form-control" value="<?php echo (isset($page->ordering)) ? ($page->ordering) : (set_value('ordering')); ?>"  placeholder="Tên website">
				                    <p class="error"><?php echo form_error('ordering'); ?></p>
				                </div>

				            </div>

				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
				                <div class="col-sm-10">
				                    <select name="id_parent">
				                    	<?php echo $option; ?>
				                    </select>
				                </div>
				            </div>

				            <div class="form-group overload-hidden">
								<label for="inputEmail3" class="col-sm-2 control-label">Banner:</label>
								<div class="col-sm-10">
								    <img src="<?php echo (isset($page->image)) ? ( $page->image) : (''); ?>" alt="" class="thumb width85" >
					                
					                <input  type="text" name="image" id="image_en" readonly="true" value="<?php echo (isset($page->image)) ? ($page->image) : (''); ?>"	 />
					                <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image_en' name="hinhanh">
								</div>
							</div>

				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">iframe bản đồ:</label>
				                <div class="col-sm-10">
				                     <textarea id="map" class="form-textarea" cols="100" rows="6" name="map"><?php echo (isset($page->map)) ? ($page->map) : (set_value('map')); ?></textarea>
				                </div>
				            </div>

				           

				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung:</label>
				                <div class="col-sm-10">
				                     <textarea id="description" class="form-textarea" cols="100" rows="6" name="description"><?php echo (isset($page->description)) ? ($page->description) : (set_value('description')); ?></textarea>
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
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" name="update_posts">
				</div>
			</div><!-- /.form-field -->																								
          </div>
        <!-- /.tab-content -->

          <!-- /.form -->
       </form>
         
   
</div>
</div>
<script type="text/javascript"  language="javascript">
	CKEDITOR.replace('description');
</script> 




