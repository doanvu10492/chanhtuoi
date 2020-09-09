<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="page-register-learn"> 
    <div class="container">  
        <div class="row" style="text-align: left;">
            <div style="display: block; max-width: 700px; margin: 50px auto 20px; float: none; ">
                <?php $this->load->view('frontend/block/study_register') ?>
            </div>
        </div>
        <div class="result-register-learn">
        <?php if ($student) { ?>
        	<div class="panel panel-default">
	        	<div class="panel-heading"><h2>Thông tin học viên đăng ký</h2></div>
	        	<div class="panel-body">
	        		<div class="row">
			        	<div class="col-md-5"><strong>Họ tên</strong></div>
			        	<div class="col-md-7"><p><?= $student['fullname'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Mã khóa</strong></div>
			        	<div class="col-md-7"><p><?= $student['title_course'] ?></p></div>
			       	</div>
			       	<div class="row">
			        	<div class="col-md-5"><strong>Hạng xe</strong></div>
			        	<div class="col-md-7"><p><?= $student['title_degree'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Dự kiến khai giảng</strong></div>
			        	<div class="col-md-7"><p><?= $student['start_date'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Dự kiến bế giảng</strong></div>
			        	<div class="col-md-7"><p><?= $student['end_date'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Dự kiến thi</strong></div>
			        	<div class="col-md-7"><p><?= $student['exam_date'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Địa điểm thi</strong></div>
			        	<div class="col-md-7"><p><?= $student['title_address'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Xe học</strong></div>
			        	<div class="col-md-7"><p><?= $student['title_car'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Mã đăng ký</strong></div>
			        	<div class="col-md-7"><p><?= $student['code'] ?></p></div>
			        </div>
			        <div class="row">
			        	<div class="col-md-5"><strong>Kết đăng ký</strong></div>
			        	<div class="col-md-7"><p style="font-size: 18px; color: green"><?= 
			        	$student['active'] 
			        	? '<p style="font-weight: bold; color: green">Đăng ký thành công</p>' 
			        	: '<p style="font-weight: bold; ">Đang chờ xem xét</p>' ?></div>
			        </div>

		        </div>
		    </div>
        <?php } else { ?>
        	<p>Không tìm thấy học viên nào</p>
        <?php } ?>
        </div>
    </div>
</div>	