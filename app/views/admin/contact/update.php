<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">

<div class="box-header with-border">

  <h3 class="box-title"><?=$pageTitle?></h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>

<div class="nav-tabs-custom">
<form action="<?=admin_url('contact/updated/'.$id)?>" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="tab-content">

    <div class="tab-pane active" id="vi">
         <!-- /.box-header -->
	    
	    <div class="box-body">
	      <div class="row">
	        <div class="col-md-12">
	             
	             <div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Họ tên:</label>
	                <div class="col-sm-10">
	                    <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>">
	                </div>
	            </div>

	            <div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>
	                <div class="col-sm-10">
	                    <input type="email" name="email" class="form-control" value="<?php echo (isset($page->email)) ? ($page->email) : (set_value('email')); ?>">
	                    <input type="hidden" name="id" value="<?php echo ($id > 0) ? ($id) : (0); ?>">
	                    <p class="error"><?=form_error('email')?></p>

	                </div>
	            </div>

	            <?php if (isset($page->degree) && $page->degree) : ?>
		            <div class="form-group">
		                <label for="inputEmail3" class="col-sm-2 control-label">Hạng đăng ký:</label>
		                <div class="col-sm-10">
		                    <input type="text" name="degree" class="form-control" value="<?php echo (isset($page->degree)) ? ($page->degree) : (set_value('degree')); ?>">
		                </div>
		            </div>
		            
		        <?php endif; ?>

		        <div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại:</label>
	                <div class="col-sm-10">
	                    <input type="text" name="phone" class="form-control" value="<?php echo (isset($page->phone)) ? ($page->phone) : (set_value('phone')); ?>">
	                </div>
	            </div>

				<?php if( $id > 0): ?>
	            <div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
	                <div class="col-sm-10">
	                    <input type="text" name="objects" class="form-control" value="<?php echo (isset($page->objects)) ? ($page->objects) : (set_value('objects')); ?>">
	                </div>
	            </div>
				
				<div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Ngày nhận:</label>
	                <div class="col-sm-10">
	                    <input type="text" name="updated_at" class="form-control" value="<?php echo (isset($page->updated_at)) ? ($page->updated_at) : (set_value('updated_at')); ?>">
	                </div>
	            </div>	            
	            <div class="form-group">
	                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung:</label>
	                <div class="col-sm-10">
	                    <textarea id="answer" class="form-textarea" cols="100" rows="6" name="answer">
	                     	<?php echo (isset($page->answer)) ? (strip_tags($page->answer)) : (set_value('answer')); ?>	
	                    </textarea>
	                </div>
	            </div>
	       		<?php endif; ?>

	          <!-- /.form-group -->
	        </div> 
	        <!-- /.col -->
	      </div>
	      <!-- /.row -->
	    </div>
        <!-- /.box-body -->
	</div>       

    <div class="form-group overload-hidden" style="display: none">
        <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
			<input type="submit" class="submit blue-btn" value="<?=$action?>" name="update_contact">
		</div>
	</div><!-- /.form-field -->																								
     </div>
    <!-- /.tab-content -->
    <!-- /.form -->
</form> 

</div>
</div>


