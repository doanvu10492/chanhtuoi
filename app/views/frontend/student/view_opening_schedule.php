<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="page-view-opening-schedule"> 
    <div class="container">  
        <div class="view-opening-schedule">
        	<div class="panel panel-default">
	        	<div class="panel-heading"><h2>Tìm kiếm khóa học</h2></div>
	        	<div class="panel-body">
	        		<form method="GET" action="./xem-lich-khai-giang">
		        		<div  class="input-group list-block">
				        	<div class="col-md-4"><strong>Hạng xe</strong></div>
				        	<div class="col-md-8">
				        		<?php foreach($listDegree as $degree) { ?>
				        			<label class="radio-inline"><input type="radio" name="degree" 
				        				value="<?= $degree['id'] ?>" <?= $degree['id'] == $degreeId ? "checked" : '';?>><?= $degree['name'] ?></label>
				        		<?php } ?>
				        	</div>
				        </div>
				        <div class="input-group list-block">
				        	<div class="col-md-4"><strong>Phòng ghi danh</strong></div>
				        	<div class="col-md-8">
				        		<select  class="form-control" name="address">
				        			<?= $selectAddress ?>
				        		</select>
	                          <span class="help-block"></span>
				        	</div>
				       	</div>
				       	<div class="input-group list-block">
				        	<div class="col-md-4"><strong>Khai giảng</strong></div>
				        	<div class="col-md-8">
				        		<select  class="form-control" name="schedule">
				        			<?= $selectSchedule ?>
				        		</select>
	                          <span class="help-block"></span>
				        	</div>
				        </div>
				        <div class="input-group list-block">
				        	<div class="col-md-12">
				        		<button type="submit">Tìm</button>
				        	</div>
				        </div>
				    </form>
		        </div>
		    </div>
        </div>

        <?php if (isset($listAddress) && $listAddress) { ?>
	       	<?php foreach($listAddress as $address) { ?>
	        <div class="row content-open-schedule">
	        	<a href="javascript:void(0)"><strong>Địa chỉ: </strong><?= $address['name'] ?></a>

	        	<table class="table table-bordered">
				    <thead>
				      <tr>
				        <th>STT</th>
				        <th>Mã khóa</th>
				        <th>Hạng</th>
				        <!-- <th>Số giờ</th> -->
				        <th>Dự kiến khai giảng</th>
				        <th>Dự kiến bế giảng</th>
				        <th>Dự kiến thi</th>
				        <th>Lưu lượng</th>
				        <th>Đăng ký</th>
				        <th>Còn chỗ	</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php
				    		$i = 0; 
				    		foreach($address['open_schedule'] as $openSchedule ) { 
				    			$i++;
				    	?>
					      <tr>
					        <td><?= $i ?></td>
					        <td><?= $openSchedule['title_course'] ?></td>
					        <td><?= $openSchedule['title_degree'] ?></td>
					       <?php /* <td><?= $openSchedule['hours'].'h' ?></td> */?>
					        <td><?= $openSchedule['start_date'] ?></td>
					        <td><?= $openSchedule['end_date'] ?></td>
					        <td><?= $openSchedule['exam_date'] ?></td>
					        <td><span style="font-weight: bold; color: red"><?= $openSchedule['total_register'] ?></span></td>
					        <td><span style="color: #428bca; font-weight: bold;"><?= $openSchedule['total_registered'] ?></span></td>
					        <td><span style="font-weight: bold; color: red"><?= $openSchedule['total_not_register'] ?></span></td>
					      </tr>
					  <?php } ?>
				    </tbody>
				  </table>
	        </div>
	    	<?php } ?>
    	<?php } else { ?>
    		<p class="not-found">Không tìm thấy lịch khai giảng</p>
    	<?php } ?>
    </div>
</div>	