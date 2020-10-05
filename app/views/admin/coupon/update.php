<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script language="javascript">
	function add(num) {
		num = num + 1;
        $('a.add-'+(num-1)).remove();
		$('#list_img').append('<div class="img_item'+num+' img_item"><input type="file" name="img_detail[]" id="tr'+num+'" />	<a href="javascript:void(0)" onclick="add('+num+')" class="btn btn-default add-'+num+'">   <i class="fa fa-plus"></i>	</a><a href="javascript:void(0)" onclick="del('+num+')" class="btn btn-default"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>');
	}
	function del(num) {
	    $('.img_item'+num).remove();
	}
</script>
<div class="box box-default">
 

<?php $this->load->view('admin/block/box_header'); ?>

<div class="nav-tabs-custom">
    <?php $this->load->view('admin/block/tab'); ?>
    
    <form action="<?php echo admin_url('coupon/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">
        	<div class="tab-pane active" id="vi">
             <!-- /.box-header -->
			    <div class="box-body">
			      <div class="row">
			        <div class="col-md-12">
			               
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label required">Tiêu đề:</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>"  placeholder="Tên website">
                    <p class="error"><?php echo form_error('name'); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label required">Tên coupon:</label>
                <div class="col-sm-10">
                    <input type="text" name="shortname" class="form-control" value="<?php echo (isset($page->shortname)) ? ($page->shortname) : (set_value('shortname')); ?>"  placeholder="Tên website">
                    <p class="error"><?php echo form_error('shortname'); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Link liên kết tiếp thị</label>
                <div class="col-sm-10">
                    <textarea  class="form-textarea form-control" rows="6" name="outlink"><?= isset($page->outlink) ? $page->outlink : set_value('outlink'); ?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Đường dẫn bài viết:</label>
                <div class="col-sm-10">
                    <input type="text" name="alias" class="form-control required" value="<?php echo (isset($page->alias)) ? ($page->alias) : (set_value('alias')); ?>"  placeholder="VD: san-pham, lam-dep">
                    <p class="error"><?=form_error('alias')?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Mã sản phẩm:</label>
                <div class="col-sm-5">
                    <input type="text" name="code" class="form-control" value="<?php echo (isset($page->code)) ? ($page->code) : (set_value('code')); ?>"  >
                    <p class="error"><?php echo form_error('code'); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nguồn giảm giá:</label>
                <div class="col-sm-10">

                    <select name="id_cate_coupon" class="form-control">
                        <?php echo $optionCouponSources; ?>
                    </select>
                    <p class="error"><?php echo form_error('id_cate_coupon'); ?></p>
                </div>
            </div>
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                <div class="col-sm-10">

                    <select name="id_cate" class="form-control" id="category_products">
                    	<?php echo $option; ?>
                    </select>
                    <p class="error"><?php echo form_error('id_cate'); ?></p>
                </div>
            </div>

		    <div class="form-group">
		        <label for="inputEmail3" class="col-sm-2 control-label">Mô tả ngắn:</label>
		        <div class="col-sm-10">
		             <textarea id="brief" class="form-textarea form-control" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
		        </div>
		    </div>
        </div>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->


</div>
		<?php $this->load->view('admin/block/seo'); ?>
			   
	        <!-- /.box-body -->
        </div>
        <!--product many -->
                         
                
        <!--end product many -->
		    <div class="form-group overload-hidden">
                <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
                <div class="col-sm-10">
					<input type="submit" class="submit blue-btn" value="Cập nhật" >
				</div>
			</div><!-- /.form-field -->																								
          </div>
       </form>
</div>
</div>
<script type="text/javascript"  language="javascript">
    CKEDITOR.replace('brief');
</script> 




