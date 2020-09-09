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
				                <label class="col-sm-2 control-label">Họ tên:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="fullname" value="<?= isset($page->fullname) ? $page->fullname : set_value('fullname'); ?>" class="form-control">
				                   	<?= form_error('fullname'); ?>
				                </div>
			            	</div>
			            	<div class="form-group">
				                <label class="col-sm-2 control-label">Số CMND:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="cmnd" value="<?= isset($page->cmnd) ? $page->cmnd : set_value('cmnd'); ?>" class="form-control">
				                   	<?= form_error('cmnd'); ?>
				                </div>
			            	</div>
			            	<div class="form-group">
				                <label class="col-sm-2 control-label">Ngày sinh:</label>
				                <div class="col-sm-10">
				                    <input type="date" name="birthday" value="<?= isset($page->birthday) ? $page->birthday : set_value('birthday'); ?>" class="form-control">
				                   	<?= form_error('birthday'); ?>
				                </div>
			            	</div>
			            	<div class="form-group">
				                <label class="col-sm-2 control-label">Nơi ở thường trú:</label>
				                <div class="col-sm-10">
				                    <input type="text" name="place" value="<?= isset($page->place) ? $page->place : set_value('place'); ?>" class="form-control">
				                   	<?= form_error('place'); ?>
				                </div>
			            	</div>
			            	<div class="form-group">
				                <label  class="col-sm-2 control-label">Số tiền:</label>
				                 <div class="col-sm-10">
				                    <input type="number" name="total_paid" value="<?= isset($page->total_paid) ? $page->total_paid : set_value('total_paid'); ?>" class="form-control">
				                   	<?= form_error('total_paid'); ?>
				                </div>
				            </div>	
			            	<div class="form-group">
				                <label  class="col-sm-2 control-label">Mã khóa:</label>
				                <div class="col-sm-10">
				                    <select name="course_code" class="form-control">
				                    	<?= $seleteCourses; ?>
				                    </select>
				                    <?= form_error('course_code'); ?>
				                </div>
				            </div>	
			            	
			            	<div class="form-group">
				                <label  class="col-sm-2 control-label">Hạng xe:</label>
				                <div class="col-sm-10">
				                    <select name="degree" class="form-control">
				                    	<?= $seleteDegree; ?>
				                    </select>
				                    <?= form_error('degree'); ?>
				                </div>
				            </div>
			            	
			            	<div class="form-group">
				                <label  class="col-sm-2 control-label">Địa chỉ:</label>
				                <div class="col-sm-10">
				                    <select name="address" class="form-control">
				                    	<?= $seleteAddress; ?>
				                    </select>
				                    <?= form_error('address'); ?>
				                </div>
				            </div>	
			            	<div class="form-group">
				                <label  class="col-sm-2 control-label">Xe học:</label>
				                <div class="col-sm-10">
				                    <select name="car" class="form-control">
				                    	<?= $seleteCars; ?>
				                    </select>
				                </div>
				            </div>	

				            <div class="form-group">
				                <label  class="col-sm-2 control-label">Kết quả thi:</label>
				                <div class="col-sm-10">
				                    <select name="result" class="form-control" style="max-width: 200px;">
				                    	<option value>--- Chọn kết quả thi ---</option>
				                    	<?php foreach($examResult as $key => $value) { ?>
				                    		<option value="<?= $key ?>" <?= isset($page->result) && $key == $page->result ? 'selected = selected' : ''; ?>><?= $value ?></option>
				                    	<?php } ?>		
				                    </select>
				                </div>
				            </div>	

				            <div class="form-group">
				                <label for="inputEmail3" class="col-sm-2 control-label">Ghi chú:</label>
				                <div class="col-sm-10">
				                     <textarea id="brief" class="form-textarea" cols="100" rows="6" name="notes"><?php echo (isset($page->notes)) ? ($page->notes) : (set_value('notes')); ?></textarea>
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




