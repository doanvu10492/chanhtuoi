<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Sửa slider</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>

<div class="nav-tabs-custom">
    <!-- <ul class="nav nav-tabs">
        <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng việt</a></li>
        <li class=""><a href="#en" data-toggle="tab" aria-expanded="false">English</a></li>
    </ul>
     -->
    <form action="<?php echo admin_url('slide/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
			                <label for="inputEmail3" class="col-sm-2 control-label">Link 1:</label>
			                <div class="col-sm-10">
			                    <input type="text" name="link" class="form-control" value="<?php echo (isset($page->link)) ? ($page->link) : (set_value('link')); ?>"  placeholder="">
			                </div>
			            </div>
<!-- 
			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Link 2:</label>
			                <div class="col-sm-10">
			                    <input type="text" name="link2" class="form-control" value="<?php echo (isset($page->link2)) ? ($page->link2) : (set_value('link2')); ?>"  placeholder="">
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Link 3:</label>
			                <div class="col-sm-10">
			                    <input type="text" name="link3" class="form-control" value="<?php echo (isset($page->link3)) ? ($page->link3) : (set_value('link3')); ?>"  placeholder="">
			                </div>
			            </div>
			            -->

						<div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Vị trí</label>
			                <div class="col-sm-10">
			                    <input type="text" name="ordering" class="form-control" value="<?php echo (isset($page->ordering)) ? ($page->ordering) : (set_value('ordering')); ?>" >
			                </div>
			            </div>

			            <!-- 
			             <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
			                <div class="col-sm-10">
			                     <textarea id="brief" class="form-textarea form-control" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
			                </div>
			            </div>
			       -->

			            <div class="form-group">
			                <label for="file" class="col-sm-2 control-label">File upload: <span class="required">*</span></label>
			                 <div class="col-sm-10">
							 <a class="fancybox img" href="<?php echo (isset($page->image)) ? ($page->image) : (set_value('image')); ?>"><img src="<?php echo (isset($page->image)) ? ($page->image) : (set_value('image')); ?>" alt="" class="thumb size48" ></a>

			                 <input  type="text" name="image" id="image" readonly="true" value="<?php echo (isset($page->image)) ? ($page->image) : (''); ?>" />
			                 <input type="button" id="file" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image' >
			               <p class="error"><?php echo form_error('image'); ?></p>
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
			                <label for="inputEmail3" class="col-sm-2 control-label">Link :</label>
			                <div class="col-sm-10">
			                    <input type="text" name="link_en" class="form-control" value="<?php echo (isset($page->link_en)) ? ($page->link_en) : (set_value('link_en')); ?>"  placeholder="">
			                </div>
			            </div>

			           

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
			                <div class="col-sm-10">
			                     <textarea id="brief_en" class="form-textarea form-control" rows="6" name="brief_en"><?php echo (isset($page->brief_en)) ? ($page->brief_en) : (set_value('brief_en')); ?></textarea>
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
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" name="update_slide">
				</div>
			</div><!-- /.form-field -->																								
          </div>
        <!-- /.tab-content -->

          <!-- /.form -->
       </form>
         
   
</div>





<div class="box-footer">
    @copyright 2018
</div>
</div>





