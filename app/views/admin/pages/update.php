<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Sửa bài viết</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng việt</a></li>
        <li class=""><a href="#en" data-toggle="tab" aria-expanded="false">English</a></li>
    </ul> 
    
    <form action="<?php echo admin_url('pages/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
			                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
			                <div class="col-sm-10">
			                    <select name="id_cate">
			                    	<?php echo $option; ?>
			                    </select>
			                    <p class="error"><?php echo form_error('id_cate'); ?></p>
			                </div>
			            </div>
						

		          <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Liên kết:</label>
                <div class="col-sm-10">
                    <input type="text" name="link_web" class="form-control" value="<?php echo (isset($page->link_web)) ? ($page->link_web) : (set_value('alias')); ?>"  placeholder="">
                    <p class="error"><?=form_error('link_web')?></p>
                </div>

              </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Vị trí:</label>
                <div class="col-sm-10">
                    <input type="number" name="ordering" class="form-control" value="<?php echo (isset($page->ordering)) ? ($page->ordering) : (set_value('ordering')); ?>" >
                    <p class="error"><?=form_error('ordering')?></p>
                </div>

            </div>


			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Ngày cập nhật:</label>
                <div class="col-sm-10">
                    <input type="text" name="updated_at" class="form-control" value="<?php echo (isset($page->updated_at)) ? ($page->updated_at) : (set_value('updated_at')); ?>"  placeholder="Vị trí ảnh">
                </div>
            </div>

            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">File upload: <span class="required">*</span></label>
                 <div class="col-sm-10">
				 <a class="fancybox img" href="<?php echo (isset($page->image)) ? ($page->image_path) : (''); ?>"><img src="<?php echo (isset($page->image)) ? ($page->image_path) : (IMG_PATH_PAGES.set_value('image')); ?>" alt="" class="thumb size48" ></a>

                 <input  type="hidden" name="images_old" value="<?php echo isset($page->image) ? ($page->image) : (''); ?>" />
                 <input type="file" name="images"  >
                 <p class="error"><?php echo form_error('image'); ?></p>
               </div>
            </div>


            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
                <div class="col-sm-10">
                     <textarea id="brief" class="form-textarea" cols="100" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
                </div>
            </div>
           
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung chính:</label>
                <div class="col-sm-10">
                     <textarea id="description" class="form-textarea" cols="100" rows="6" name="description"><?php echo (isset($page->description)) ? ($page->description) : (set_value('description')); ?></textarea>
                </div>
            </div>

             <?php /*

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Meta title:</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_title" class="form-control" value="<?php echo (isset($page->meta_title)) ? ($page->meta_title) : (set_value('meta_title')); ?>"  placeholder="Tên website">
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

            */?>


          <!-- /.form-group -->
        </div>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->


	</div>


        <div class="tab-pane" id="en">
             <!-- /.box-header -->
		    
			    <div class="box-body">
			      <div class="row">
			        <div class="col-md-12">
			               
			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
			                <div class="col-sm-10">
			                    <input type="text" name="name_en" class="form-control" value="<?php echo (isset($page->name_en)) ? ($page->name_en) : (set_value('name_en')); ?>"  placeholder="Tiêu đề">
			                </div>
			            </div>

			            
			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
			                <div class="col-sm-10">
			                     <textarea id="brief_en" class="form-textarea" cols="100" rows="6" name="brief_en"><?php echo (isset($page->brief_en)) ? ($page->brief_en) : (set_value('brief_en')); ?></textarea>
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung chính:</label>
			                <div class="col-sm-10">
			                     <textarea id="description_en" class="form-textarea" cols="100" rows="6" name="description_en"><?php echo (isset($page->description_en)) ? ($page->description_en) : (set_value('description_en')); ?></textarea>
			                </div>
			            </div>


			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Meta title:</label>
			                <div class="col-sm-10">
			                    <input type="text" name="meta_title_en" class="form-control" value="<?php echo (isset($page->meta_title_en)) ? ($page->meta_title_en) : (set_value('meta_title_en')); ?>"  placeholder="Tên website">
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Meta keywords:</label>
			                <div class="col-sm-10">
			                     <textarea  class="form-textarea" cols="100" rows="6" name="meta_keywords_en"><?php echo (isset($page->meta_keywords_en)) ? ($page->meta_keywords_en) : (set_value('meta_keywords_en')); ?></textarea>
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Meta description:</label>
			                <div class="col-sm-10">
			                     <textarea  class="form-textarea" cols="100" rows="6" name="meta_description_en"><?php echo (isset($page->meta_description_en)) ? ($page->meta_description_en) : (set_value('meta_description_en')); ?></textarea>
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
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" name="update_pages">
				</div>
			</div><!-- /.form-field -->																								
          </div>
        <!-- /.tab-content -->
        <!-- /.tab-content -->

          <!-- /.form -->
       </form>
         
   
</div>
</div>
<script type="text/javascript"  language="javascript">
	CKEDITOR.replace('description');
	CKEDITOR.replace('description_en');
</script> 




