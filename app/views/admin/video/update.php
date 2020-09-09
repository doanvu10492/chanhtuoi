<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Sửa bài viết</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse">
    	<i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove">
    	<i class="fa fa-remove"></i>
    </button>
  </div>
</div>

<div class="nav-tabs-custom">

<form action="<?=admin_url('video/updated/'.$id)?>" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="tab-content">

<div class="tab-pane active" id="vi">
<!-- /.box-header -->
<div class="box-body">
  <div class="row">
    <div class="col-md-12">
           
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>">
                <p class="error"><?=form_error('name')?></p>
            </div>
            
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Mã youtube: </label>
            <div class="col-sm-10">
                <input type="text" name="code" class="form-control" value="<?php echo (isset($page->code)) ? ($page->code) : (set_value('code')); ?>">
            <p class="error"><?=form_error('code')?></p>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Sắp xếp: </label>
            <div class="col-sm-10">
                <input type="text" name="ordering" class="form-control" value="<?php echo (isset($page->ordering)) ? ($page->ordering) : (set_value('ordering')); ?>"  >
            </div>
        </div>
        
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Ngày cập nhât:</label>
            <div class="col-sm-10">
                <input type="text" name="updated_at" class="form-control" value="<?php echo (isset($page->updated_at)) ? ($page->updated_at) : (set_value('updated_at')); ?>" >
            </div>
        </div>

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
			<input type="submit" class="submit blue-btn" value="Cập nhật" name="update_video">
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
</script> 




