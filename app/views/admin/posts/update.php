<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
    <?php $this->load->view('admin/block/box_header'); ?>
<div class="nav-tabs-custom">

    <?php $this->load->view('admin/block/tab'); ?>

<form action="<?=admin_url('posts/updated/'.$id)?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                    <p class="error"><?=form_error('name')?></p>
                </div>
            </div>
            <div class="form-group" style="display: none">
                <label for="inputEmail3" class="col-sm-2 control-label">Number:</label>
                <div class="col-sm-10">
                    <input type="text" name="number" class="form-control" value="<?php echo (isset($page->number)) ? ($page->number) : (set_value('number')); ?>"  placeholder="Tên website">
                    <p class="error"><?=form_error('number')?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Url bài viết:</label>
                <div class="col-sm-10">
                    <input type="text" name="alias" class="form-control" value="<?php echo (isset($page->alias)) ? ($page->alias) : (set_value('alias')); ?>"  placeholder="VD: san-pham, lam-dep">
                    <p class="error"><?=form_error('alias')?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tags:</label>
                <div class="col-sm-10">
                    <input type="text" name="tags" class="form-control" value="<?php echo (isset($page->tags)) ? ($page->tags) : (set_value('tags')); ?>">
                    <p class="error"><?php echo form_error('tags'); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                <div class="col-sm-10">
                    <select name="id_cate">
                    	<?=$option?>
                    </select>
                    <p class="error"><?=form_error('id_cate')?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">File upload: <span class="required">*</span></label>
                 <div class="col-sm-10">
				 <a class="fancybox img" href="<?php echo (isset($page->image)) ? ($page->image_path) : (''); ?>"><img src="<?php echo (isset($page->image)) ? ($page->image_path) : (IMG_PATH_PAGES.set_value('image')); ?>" alt="" class="thumb size48" ></a>

                 <input  type="hidden" name="images_old" value="<?php echo isset($page->image) ? ($page->image) : (''); ?>" />
                 <input type="file" name="images"  >
                 <p class="error"><?=form_error('image')?></p>
               </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
                <div class="col-sm-10">
                     <textarea id="brief" class="form-textarea form-control" cols="100" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung chính:</label>
                <div class="col-sm-10">
                     <textarea id="description" class="form-textarea" cols="100" rows="6" name="description"><?php echo (isset($page->description)) ? ($page->description) : (set_value('description')); ?></textarea>
                </div>
            </div>
        <div class="panel-group">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" href="#collapse1">Upload file Pdf</a>
                </h4>
              </div>
              <div id="collapse1" class="panel-collapse collapse in">
                <div class="panel-body">
                    
                    

                <div class="form-group" style="display: none">
                    <label for="inputEmail3" class="col-sm-2 control-label">Kích thước size:</label>
                    <div class="col-sm-10">
                        <input type="text" name="size" class="form-control" value="<?php echo (isset($page->size)) ? ($page->size) : (set_value('size')); ?>"  placeholder="Kích thước file">
                        <p class="error"><?=form_error('size')?></p>
                    </div>

                </div>

            <div class="form-group overload-hidden">
                <label for="inputEmail3" class="col-sm-2 control-label">file:</label>
                <div class="col-sm-10">
                    <a href="<?php echo (isset($page->file)) ? ($page->file) : (set_value('file')); ?>" class="fancybox">
                        <img src="<?php echo (isset($page->file)) ? ( $page->file ) : (''); ?>" alt="" class="thumb width85" >
                    </a>
                    <input  type="text" name="file" id="image" readonly="true" value="<?php echo (isset( $page->file )) ? ( $page->file ) : (''); ?>" />
                    <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image' name="hinhanh">
                </div>
            </div>
                </div>
                <div class="panel-footer">Upload file Pdf</div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<?php $this->load->view('admin/block/seo'); ?>

<div class="form-group overload-hidden">
    <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
		<input type="submit" class="submit blue-btn" value="<?=$action?>" >
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




