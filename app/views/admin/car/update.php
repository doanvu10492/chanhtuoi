<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="box box-default">
<!-- header-->
<div class="box-header with-border">
	<h3 class="box-title"><?= $pageTitle; ?></h3>
	<div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	</div>
</div>

<div class="nav-tabs-custom">
    <form action="<?= $linkSave; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="tab-content">
        	<input type="hidden" name="id" value="<?= $id; ?>">
	        <!-- tab vi-->
	        <div class="tab-pane active" id="vi">
			    <div class="box-body">
				        <div class="row">
				        <div class="col-md-12">
				            <div class="form-group">
				                <label class="col-sm-2 control-label">Xe học:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="name" value="<?= isset($page->name) ? $page->name : set_value('name'); ?>" class="form-control">
				                   	<?= form_error('name'); ?>
				                </div>
			            	</div>
			            	<div class="form-group overload-hidden">
				                <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>
				                <div class="col-sm-10">
									<input type="submit" class="submit blue-btn" value="<?php echo $action; ?>">
								</div>
							</div><!-- /.form-field -->		
				        </div>
				    </div>
			    </div>
	        </div>
        </div>
    </form>
</div>

</div>
