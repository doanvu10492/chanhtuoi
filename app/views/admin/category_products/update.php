<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
 

<div class="box-header with-border">
  <h3 class="box-title">Sửa danh mục</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>

<div class="nav-tabs-custom">

<ul class="nav nav-tabs">
    <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Tiếng việt</a></li>
     <li ><a href="#seo" data-toggle="tab" aria-expanded="true">Seo</a></li>
</ul>
  
<form action="<?php echo admin_url('category_products/updated/'.$id); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="tab-content">
<div class="tab-pane active" id="vi">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="<?php echo (isset($page->name)) ? ($page->name) : (set_value('name')); ?>"  placeholder="Tên website">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <p class="error"><?php echo form_error('name'); ?></p>

                </div>
        	</div>
        	<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Đường dẫn:</label>
                <div class="col-sm-10">
                    <input type="text" name="alias" class="form-control" value="<?php echo (isset($page->alias)) ? ($page->alias) : (set_value('alias')); ?>">
                </div>
            </div>
	        <div class="form-group overload-hidden">
				<label for="inputEmail3" class="col-sm-2 control-label">Hình ảnh:</label>
				<div class="col-sm-10">
				    <img src="<?php echo (isset($page->image)) ? ( $page->image) : (''); ?>" alt="" class="thumb width85" >
	                
	                <input  type="text" name="image" id="image_en" readonly="true" value="<?php echo (isset($page->image)) ? ($page->image) : (''); ?>"	 />
	                <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image_en' name="hinhanh">
				</div>
			</div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Danh mục:</label>
                <div class="col-sm-10" >
                    <select name="id_parent" id="category_products">
                    	<?php echo $option; ?>
                    </select>
                </div>
            </div>
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Sắp xếp:</label>
                <div class="col-sm-10">
                    <input type="text" name="ordering" class="form-control" value="<?php echo (isset($page->ordering)) ? ($page->ordering) : (set_value('ordering')); ?>">
                </div>
            </div>
	        <div class="form-group">
		        <label for="inputEmail3" class="col-sm-2 control-label">Nội dung ngắn:</label>
		        <div class="col-sm-10">
		             <textarea id="brief" class="form-textarea form-control" rows="6" name="brief"><?php echo (isset($page->brief)) ? ($page->brief) : (set_value('brief')); ?></textarea>
		        </div>
		    </div>
    	</div>
	</div>
</div>
</div>

<?php $this->load->view('admin/block/seo') ?>

<div class="form-group overload-hidden">
    <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
		<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" >
	</div>
</div><!-- /.form-field -->																								
</div>
<!-- /.tab-content -->

<!-- /.form -->
</form>
         
   
</div>
</div>
<script type="text/javascript"  language="javascript">

$(function(){
	$('#dv_type').on('change', function(){
		dv_type = $(this).val();		
		$.ajax({
			type : 'POST',
			url  : '<?=admin_url('products/get_category')?>',
			data : 'dv_type='+dv_type,
			success : function(data){
				result = JSON.parse(data);
				
				if(result.result){
					$('#category_products').empty().html( result.result );

				}
			} 
		});
	});
});

	CKEDITOR.replace('description');
	CKEDITOR.replace('description_en');
</script> 




