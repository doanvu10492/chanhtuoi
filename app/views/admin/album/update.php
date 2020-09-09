<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="box box-default">
<?php $this->load->view('admin/block/box_header'); ?>
<div class="nav-tabs-custom">
    <form action="<?php echo admin_url('album/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">
	        <div class="tab-pane active" id="vi">
				    <div class="box-body">
				       	<div class="row">
					        <div class="col-md-12">
					            <div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
					                <div class="col-sm-10">
					                    <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>"  placeholder="Tên website">
					                </div>
					            </div>
								<div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Ngày cập nhât:</label>
					                <div class="col-sm-10">
					                    <input type="text" name="updated_at" class="form-control" value="<?php echo (isset($page->updated_at)) ? ($page->updated_at) : (set_value('updated_at')); ?>" >
					                </div>
					            </div>
					            <div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Link website:</label>
					                <div class="col-sm-10">
					                    <input type="text" name="link_website" class="form-control" value="<?php echo (isset($page->link_website)) ? ($page->link_website) : (set_value('link_website')); ?>" >
					                </div>
					            </div>
					            <div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Button:</label>
					                <div class="col-sm-10">
					                    <input type="text" name="button" class="form-control" value="<?php echo (isset($page->button)) ? ($page->button) : (set_value('button')); ?>"  placeholder="">
					                </div>
					            </div>
					            <div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
					                <div class="col-sm-10">
					                    <select name="id_cate" class="form-control">
					                    	<?=$option?>
					                    </select>
					                    <p class="error"><?=form_error('id_cate')?></p>
					                </div>
					            </div>
								<div class="form-group">
					                <label for="file" class="col-sm-2 control-label">File upload: <span class="required">*</span></label>
					                 <div class="col-sm-10">
									 <a class="fancybox img" href="<?php echo (isset($page->image)) ? ($page->image_path) : (''); ?>"><img src="<?php echo (isset($page->image)) ? ($page->image_path) : (IMG_PATH_ALBUM.set_value('image')); ?>" alt="" class="thumb size48" ></a>

					                 <input  type="hidden" name="images_old" value="<?php echo isset($page->image) ? ($page->image) : (''); ?>" />
					                 <input type="file" name="images"  >
					                 <p class="error"><?=form_error('image')?></p>
					               </div>
					            </div>
					            <div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Vị trí hình ảnh:</label>
					                <div class="col-sm-10">
					                    <input type="text" id="textfield" class="text fl" name="position" value="<?php echo (isset($page->image)) ? ($page->position) : (set_value('position')); ?>">
					                </div>
					            </div>
					            <div class="form-group">
					                <label for="inputEmail3" class="col-sm-2 control-label">Nội dung :</label>
					                <div class="col-sm-10">
					                     <textarea id="brief" class="form-textarea form-control" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
					                </div>
					            </div>
				        	</div>
				        </div>
				    </div>
	        </div>
		    <div class="form-group overload-hidden">
                <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
					<input type="submit" class="submit blue-btn" value="<?php echo $action ?>">
				</div>
          	</div>
       	</form>
	</div>
</div>


