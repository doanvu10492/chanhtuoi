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
				                <label class="col-sm-2 control-label">Mã khóa:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="name" value="<?= isset($page->name) ? $page->name : set_value('name'); ?>" class="form-control">
				                   	<?= form_error('name'); ?>
				                </div>
			            	</div>
			         		<div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Số lượng:</label>
				                <div class="col-sm-10">
				                    <input type="number" name="total_register" class="form-control" value="<?php echo (isset($page->total_register)) ? ($page->total_register) : (set_value('total_register')); ?>" >
				                    <p class="error"><?php echo form_error('total_register'); ?></p>
				                </div>
				            </div>
			            	<div class="form-group">
				                <label class="col-sm-2 control-label">Dự kiến khai giảng:</label>
				                <div class="col-sm-10">
				                    <input type="date" name="start_date" value="<?= isset($page->start_date) ? $page->start_date : set_value('start_date'); ?>" class="form-control">
				                   	<?= form_error('start_date'); ?>
				                </div>
			            	</div>
			            	<div class="form-group">
				                <label class="col-sm-2 control-label">Dự kiến bế giảng:</label>
				                <div class="col-sm-10">
				                    <input type="date" name="end_date" value="<?= isset($page->end_date) ? $page->end_date : set_value('end_date'); ?>" class="form-control">
				                   	<?= form_error('end_date'); ?>
				                </div>
			            	</div>
			            	<div class="form-group">
				                <label class="col-sm-2 control-label">Dự kiến thi:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="exam_date" value="<?= isset($page->exam_date) ? $page->exam_date : set_value('exam_date'); ?>" class="form-control">
				                   	<?= form_error('exam_date'); ?>
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
