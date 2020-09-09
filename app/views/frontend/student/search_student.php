<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="page-register-learn"> 
    <div class="container">  
        <div class="row page-search-student" >
            <div style="display: inline-block; width: 100%; margin: 50px 0 20px; float: none; ">
                <?php $this->load->view('frontend/block/register_form') ?>
            </div>
        </div>
        <div class="result-register-learn" >
        <?php if (isset($student) && $student) { ?>
        	<div class="panel panel-default">
	        	<div class="panel-heading"><h2>Thông tin học viên đăng ký</h2></div>
	        	<div class="panel-body">
	        		<div class="row">
			        	<div class="col-md-4"><strong>Họ tên</strong></div>
			        	<div class="col-md-8"><p><?= $student['fullname'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Mã khóa</strong></div>
			        	<div class="col-md-8"><p><?= $student['title_course'] ?></p></div>
			       	</div>
			       	<div class="row">
			        	<div class="col-md-4"><strong>Hạng xe</strong></div>
			        	<div class="col-md-8"><p><?= $student['title_degree'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Dự kiến khai giảng</strong></div>
			        	<div class="col-md-8"><p><?= $student['start_date'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Dự kiến bế giảng</strong></div>
			        	<div class="col-md-8"><p><?= $student['end_date'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Dự kiến thi</strong></div>
			        	<div class="col-md-8"><p><?= $student['exam_date'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Địa điểm thi</strong></div>
			        	<div class="col-md-8"><p><?= $student['title_address'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Xe học</strong></div>
			        	<div class="col-md-8"><p><?= $student['title_car'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-4"><strong>Mã đăng ký</strong></div>
			        	<div class="col-md-8"><p><?= $student['code'] ?></p></div>
			        </div>
			        <div class="row">
			   
			        	<div class="col-md-4"><strong>Kết quả thi</strong></div>
			        	<div class="col-md-8" style="font-size: 18px"><?= $examResult[$student['result']] ?></div>
			        </div>

		        </div>
		    </div>
        <?php } else { ?>
        	<p>Không tìm thấy học viên nào</p>
        <?php } ?>
        </div>
    </div>
</div>	