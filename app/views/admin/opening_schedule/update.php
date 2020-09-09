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
				                <label  class="col-sm-2 control-label">Hạng xe:</label>
				                <div class="col-sm-10">
				                    <select name="degree_id" class="form-control">
				                    	<?= $seleteDegree; ?>
				                    </select>
				                </div>
				            </div>
				            <div class="form-group">
				                <label  class="col-sm-2 control-label">Phòng ghi danh: </label>
				                <div class="col-sm-10">
				                    <select name="address_id" class="form-control">
				                    	<?= $seleteAddress; ?>
				                    </select>
				                </div>
				            </div>	
				            
			            	<div class="form-group">
				                <label  class="col-sm-2 control-label">Mã khóa:</label>
				                <div class="col-sm-10">
				                    <select name="course_id" class="form-control">
				                    	<?= $seleteCourses; ?>
				                    </select>
				                </div>
				            </div>

				            <div class="form-group" style="display: none;">
				                <label for="inputEmail3" class="col-sm-2 control-label">Số giờ:</label>
				                <div class="col-sm-10">
				                    <input type="number" name="hours" class="form-control" value="<?php echo (isset($page->hours)) ? ($page->hours) : (set_value('hours')); ?>">
				                    <p class="error"><?php echo form_error('hours'); ?></p>
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




