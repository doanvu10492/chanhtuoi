<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="box box-default">
<?php $this->load->view('admin/block/box_header'); ?>
<div class="nav-tabs-custom">
    <?php $this->load->view('admin/block/tab'); ?> 
    <form action="<?= $linkSave; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">
        	<input type="hidden" name="id" value="<?= $id; ?>">
	        <!-- tab vi-->
	        <div class="tab-pane active" id="vi">
			    <div class="box-body">
				        <div class="row">
				        <div class="col-md-12">
				            <div class="form-group">
				                <label class="col-sm-2 control-label">Tiêu đề:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="name" value="<?= isset($page->name) ? $page->name : set_value('name'); ?>" class="form-control">
				                   	<?= form_error('name'); ?>
				                </div>
			            	</div>
				            <div class="form-group">
				                <label  class="col-sm-2 control-label">Danh mục:</label>
				                <div class="col-sm-10">
				                    <select name="id_parent" class="form-control">
				                    	<?= $option; ?>
				                    </select>
				                </div>
				            </div>
				            <div class="form-group">
				                <label  class="col-sm-2 control-label">Liên kết:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="link" class="form-control" value="<?= isset($page->link) ? $page->link : set_value('link'); ?>" >
				                    <?= form_error('link'); ?>
				                </div>
			            	</div>
			            	<div class="form-group overload-hidden" style="display: none">
					            <label for="inputEmail3" class="col-sm-2 control-label">Icon hiển thị:</label>
					            <div class="col-sm-10">
					                <a href="<?php echo (isset($page->icon)) ? ($page->icon) : (set_value('icon')); ?>" class="fancybox">
					                    <img src="<?php echo (isset($page->icon)) ? ( $page->icon ) : (''); ?>" alt="" class="thumb width85" >
					                </a>
					                <input  type="text" name="icon" id="image" readonly="true" value="<?php echo (isset( $page->icon )) ? ( $page->icon ) : (''); ?>" />
					                <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image' name="hinhanh">
					            </div>
					        </div>
					        <div class="form-group overload-hidden" style="display: none">
					            <label for="inputEmail3" class="col-sm-2 control-label">Icon hover:</label>
					            <div class="col-sm-10">
					                <a href="<?php echo (isset($page->icon_hover)) ? ($page->icon_hover) : (set_value('icon_hover')); ?>" class="fancybox">
					                    <img src="<?php echo (isset($page->icon_hover)) ? ( $page->icon_hover ) : (''); ?>" alt="" class="thumb width85" >
					                </a>
					                <input  type="text" name="icon_hover" id="image2" readonly="true" value="<?php echo (isset( $page->icon_hover )) ? ( $page->icon_hover ) : (''); ?>" />
					                <input type="button" id="file3" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image2' name="hinhanh">
					            </div>
					        </div>
					        <div class="form-group">
				                <label  class="col-sm-2 control-label">Current page:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="alias" class="form-control" value="<?= isset($page->alias) ? $page->alias : set_value('alias'); ?>" >
				                    <?= form_error('alias'); ?>
				                </div>
			            	</div>
				            <div class="form-group">
				                <label  class="col-sm-2 control-label">Sắp xếp:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="ordering" class="form-control" value="<?= isset($page->ordering) ? $page->ordering : set_value('ordering'); ?>">
				                    <?= form_error('ordering'); ?>
				                </div>
			            	</div>
							
				        </div>
				    </div>
			    </div>
	        </div>
	        <?php $this->load->view('admin/block/seo'); ?>
	        <div class="form-group overload-hidden box-body">
			    <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
			    <div class="col-sm-10">
					<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>" >
				</div>
			</div>
	    </div>
    </form>
</div>
</div>




