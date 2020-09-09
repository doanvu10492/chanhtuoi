<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Liên kết</h3>

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
  
    <form action="<?php echo admin_url('support_online/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">

        <div class="tab-pane active" id="vi">
             <!-- /.box-header -->
		    
			    <div class="box-body">
			      <div class="row">
			        <div class="col-md-12">
			               
			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
			                <div class="col-sm-10">
			                    <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>" >
			                </div>
			            </div>

			            <div class="form-group" style="display: none">
			                <label for="inputEmail3" class="col-sm-2 control-label">skype : </label>
			                <div class="col-sm-10">
			                    <input type="text" name="skype" class="form-control" value="<?php echo (isset($page->skype)) ? ($page->skype) : (set_value('skype')); ?>">
			                </div>
			            </div>
			            <div class="form-group" style="display: hidden">
			                <label for="inputEmail3" class="col-sm-2 control-label">Email : </label>
			                <div class="col-sm-10">
			                    <input type="text" name="email" class="form-control" value="<?php echo (isset($page->email)) ? ($page->email) : (set_value('email')); ?>">
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">hotline : </label>
			                <div class="col-sm-10">
			                    <input type="text" name="hotline" class="form-control" value="<?php echo (isset($page->hotline)) ? ($page->hotline) : (set_value('hotline')); ?>">
			                </div>
			            </div>

			            <div class="form-group">
			                <label for="file" class="col-sm-2 control-label">File upload: <span class="required">*</span></label>
			                 <div class="col-sm-10">
							 <a class="fancybox img" href="<?php echo (isset($page->image)) ? ($page->image) : (set_value('image')); ?>"><img src="<?php echo (isset($page->image)) ? ($page->image) : (set_value('image')); ?>" alt="" class="thumb size48" ></a>

			                 <input  type="text" name="image" id="image" readonly="true" value="<?php echo (isset($page->image)) ? ($page->image) : (''); ?>" />
			                 <input type="button" id="file" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image' >
			               <p class="error"><?php echo form_error('image'); ?></p>
			               </div>
			            </div>

			            
			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Sắp xếp: </label>
			                <div class="col-sm-10">
			                    <input type="number" name="ordering" class="form-control" value="<?php echo (isset($page->ordering)) ? ($page->ordering) : (set_value('ordering')); ?>"  placeholder="Tên website">
			                </div>
			            </div>
			            
						<div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Ngày cập nhât:</label>
			                <div class="col-sm-10">
			                    <input type="text" id="datepicker" name="created_at" class="form-control" value="<?php echo (isset($page->created_at)) ? ($page->created_at) : (set_value('created_at')); ?>"  placeholder="Vị trí ảnh">
			                </div>
			            </div>

			            

			            <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái: </label>
			                <div class="col-sm-10">
			                    <input type="checkbox" name="active"  value="1" <?php echo (isset($page->active) && ($page->active == 1)) ? ("checked") : ('');  ?>>
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
			                    <input type="text" name="name_en" class="form-control" value="<?php echo (isset($page->name_en)) ? ($page->name_en) : (set_value('name_en')); ?>" >
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
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>">
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
	CKEDITOR.replace('description_en');
	//Date picke
</script> 




