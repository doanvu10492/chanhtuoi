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
    
    <form action="<?php echo admin_url('products/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                <label for="inputEmail3" class="col-sm-2 control-label">Url bài viết:</label>
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
                <label for="inputEmail3" class="col-sm-2 control-label">Giá:</label>
                <div class="col-sm-10">
                    <input type="number" name="price" class="form-control required" value="<?php echo (isset($page->price)) ? ($page->price) : (set_value('price')); ?>" >
                    <p class="error"><?php echo form_error('price'); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Giá Khuyến mãi:</label>
                <div class="col-sm-10">
                    <input type="number" name="promotion" class="form-control" value="<?php echo (isset($page->promotion)) ? ($page->promotion) : (set_value('promotion')); ?>" >
                    <p class="error"><?php echo form_error('promotion'); ?></p>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Màu:</label>
                <div class="col-sm-10">
                    <input type="text" name="color" class="form-control" value="<?php echo (isset($page->color)) ? ($page->color) : (set_value('color')); ?>" placeholder="VD: Trắng,Xanh,Vàng">
                    <p class="error"><?php echo form_error('color'); ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Size:</label>
                <div class="col-sm-10">
                    <input type="text" name="size" class="form-control" value="<?php echo (isset($page->size)) ? ($page->size) : (set_value('size')); ?>" placeholder="VD: XL,L,M">
                    <p class="error"><?php echo form_error('size'); ?></p>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Giá Khuyến mãi:</label>
                <div class="col-sm-10">
                    <input type="number" name="percent_promo" class="form-control" value="<?php echo (isset($page->percent_promo)) ? ($page->percent_promo) : (set_value('percent_promo')); ?>" >
                    <p class="error"><?php echo form_error('percent_promo'); ?></p>
                </div>
            </div>
            <div class="form-group" >
                <label for="inputEmail3" class="col-sm-2 control-label">Bảo hàng :</label>
                <div class="col-sm-10">
                    <input type="text" name="guarantee" class="form-control" value="<?php echo (isset($page->guarantee)) ? ($page->guarantee) : (set_value('guarantee')); ?>">
                    <p class="error"><?php echo form_error('guarantee'); ?></p>
                </div>
            </div>
			
	        <div class="form-group">
	            <label for="file" class="col-sm-2 control-label">File upload: <span class="required">*</span></label>
	             <div class="col-sm-10">
				 <a class="fancybox img" href="<?php echo (isset($page->image)) ? ($page->image_path) : (''); ?>"><img src="<?php echo (isset($page->image)) ? ($page->image_path) : (IMG_PATH_PRODUCT.set_value('image')); ?>" alt="" class="thumb size48" ></a>

	             <input  type="hidden" name="images_old" value="<?php echo isset($page->image) ? ($page->image) : (''); ?>" />
	             <input type="file" name="images"  >
	             <p class="error"><?php echo form_error('image'); ?></p>
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
		    <div class="form-group" >
                <label for="inputEmail3" class="col-sm-2 control-label">Tags:</label>
                <div class="col-sm-10">
                    <input type="text" name="tags" class="form-control" value="<?php echo (isset($page->tags)) ? ($page->tags) : (set_value('tags')); ?>">
                    <p class="error"><?php echo form_error('tags'); ?></p>
                </div>

            </div>
		    <div class="form-group" style="display: none">
		        <label for="inputEmail3" class="col-sm-2 control-label">Mô tả sản phẩm:</label>
		        <div class="col-sm-10">
		             <textarea id="brief" class="form-textarea form-control" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
		        </div>
		    </div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Mô tả sản phẩm:</label>
			    <div class="col-sm-10">
			         <textarea id="description" class="form-textarea form-control"  rows="6" name="description"><?php echo (isset($page->description)) ? ($page->description) : (set_value('description')); ?></textarea>
			    </div>
			</div>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Thông tin chi tiết:</label>
			    <div class="col-sm-10">
			         <textarea id="info_detail" class="form-textarea form-control"  rows="6" name="info_detail"><?php echo (isset($page->info_detail)) ? ($page->info_detail) : (set_value('info_detail')); ?></textarea>
			    </div>
			</div>

			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Chính sách:</label>
			    <div class="col-sm-10">
			         <textarea id="download" class="form-textarea form-control"  rows="6" name="download"><?php echo (isset($page->download)) ? ($page->download) : (set_value('download')); ?></textarea>
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
               

        <div class="form-group">
            <label for="file" class="col-sm-2 control-label">Hình chi tiết: </label>
            <div class="col-sm-10" id="list_img_detail">
            <?php
                if (isset($imgDetail) && $imgDetail) {
              	  	foreach($imgDetail as $image) {
            ?>
                <span style="float:left;">
                    <a href="<?=$image['image']?>"><img src="<?=$image['image']?>" alt="" class="thumb size48" style="float:left"></a>
                    <a class="del-img-item" href="<?php echo admin_url('products/delele_img_detail/'.$image['id_image'])?>" onclick="return confirm('Bạn muốn xóa hình này?');"><i class="fa fa-remove"></i></a>
                </span>
            <?php
                }
            }
            ?>
           </div>
        </div>
              
              

        <div class="form-group">
            <label for="file" class="col-sm-2 control-label">Thêm: </label>
            <div class="col-sm-10" id="list_img">
                <div class="img_item1 img_item">
				 	<input type="file" name="img_detail[]" id="tr1" /> 
				 	<a href="javascript:void(0)" onclick="add(1)" class="btn btn-default add-1">
				 	     <i class="fa fa-plus"></i>
				 	</a>
				 	<a href="javascript:void(0)" onclick="del(1)" class="btn btn-default">
				 	     <i class="fa fa-trash-o" aria-hidden="true"></i>
				 	</a>
			 	</div>
           </div>
        </div>
                 
                
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
	$(function() {
	  $('.selectpicker').selectpicker();
	});
	CKEDITOR.replace('description');
	CKEDITOR.replace('download');
	CKEDITOR.replace('info_detail');
	CKEDITOR.replace('description_en');
	CKEDITOR.replace('info_detail_en');
</script> 




