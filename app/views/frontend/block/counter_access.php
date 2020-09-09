<?php
ob_start();

$PHP_SELF = $_SERVER['PHP_SELF'];
$REMOTE_ADDR= $_SERVER['REMOTE_ADDR'];


$time_now_session = time();
$session_time=sha1(md5($time_now_session));
if(!isset($_SESSION["favcolor"]) || $_SESSION["favcolor"]==''){
  $_SESSION["favcolor"] = $session_time;
}
$time_stamp = $_SESSION["favcolor"]; 

$time_now = time();    // lưu thời gian hiện tại
$time_out = 120; // khoảng thời gian chờ để tính một kết nối mới (tính bằng giây)
$ip_address = $_SERVER['REMOTE_ADDR'];    // lưu lại IP của kết nối
//$ip = $_REQUEST['REMOTE_ADDR']; // the IP address to query
//$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip_address));
//print_r($query);
//if($query && $query['status'] == 'success') {
//  echo 'Hello visitor from '.$query['country'].', '.$query['city'].'!';
//} else {
//  echo 'Unable to get location';
//}
// kiểm tra xem thời gian hiện tại so với lần truy cập cuối có lớn hơn khoảng thời gian chờ không
    //- nếu không thì thôi
    //- nếu có thì thêm vào như là một kết nối mới
if (!count($this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE UNIX_TIMESTAMP(`last_visit`) + $time_out > $time_now AND `ip_address` = '$ip_address' AND `time_stamp` = '$time_stamp'")->result()))
    $this->db->query("INSERT INTO `dv_counter` VALUES ('$ip_address', NOW(),'$time_stamp')");


// đếm số người đang online
$online = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE UNIX_TIMESTAMP(`last_visit`) + $time_out > $time_now")->result();
//echo "SELECT `ip_address` FROM `counter` WHERE UNIX_TIMESTAMP(`last_visit`) + $time_out > $time_now";
//$result = mysql_query("SELECT `ip_address` FROM `counter` WHERE DAYOFYEAR(`last_visit`) = " . (date('z') + 1) . " AND YEAR(`last_visit`) = " . date('Y'));


//echo "aaaa$num_rows Rows\n";
// đếm số người ghé thăm trong ngày (từ 0h ngày hôm đó đến thời điểm hiện tại)
$day = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE DAYOFYEAR(`last_visit`) = " . (date('z') + 1) . " AND YEAR(`last_visit`) = " . date('Y'))->result();

// đếm số người ghé thăm ngay hôm qua 
$yesterday = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE DAYOFYEAR(`last_visit`) = " . (date('z') + 0) . " AND YEAR(`last_visit`) = " . date('Y'))->result();

// đếm số người ghé thăm trong tuần (từ 0h ngày thứ 2 đến thời điểm hiện tại)
$week = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE WEEKOFYEAR(`last_visit`) = " . date('W') . " AND YEAR(`last_visit`) = " . date('Y'))->result();

// đếm số người ghé thăm tuần trước
$lastweek = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE WEEKOFYEAR(`last_visit`) = " . (date('W') - 1). " AND YEAR(`last_visit`) = " . date('Y'))->result();

// đếm số người ghé thăm trong tháng
$month = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE MONTH(`last_visit`) = " . date('n') . " AND YEAR(`last_visit`) = " . date('Y'))->result();

// đếm số người ghé thăm trong năm
$year = $this->db->query("SELECT `ip_address` FROM `dv_counter` WHERE YEAR(`last_visit`) = " . date('Y'))->result();

// đếm tổng số người đã ghé thăm
$visit = $this->db->query("SELECT `ip_address` FROM `dv_counter`")->result();
?>
<div class="box-sidebar counter-access ">
  <h3>Thống kê truy cập</h3>
  <p><span> <img src="./assets/img/layout/mvcvisit.png" alt="thống kê hôm nay">Hôm nay</span> <span>: <?php echo count($day); ?></span> </p>
  <p><span><img src="./assets/img/layout/mvcyesterday.png" alt="thống kê hôm qua">Hôm qua</span> <span>: <?php echo count($yesterday); ?></span> </p>
  <p> <span><img src="./assets/img/layout/mvcmonth.png" alt="thống kê tháng này">Tháng này</span><span>: <?php echo count($month); ?></span> </p>
  <p> <span><img src="./assets/img/layout/mvctotal.png" alt="Tổng truy cập">Tổng cộng</span> <span>: <?php echo count($visit); ?></span></p>
  <p><span><img src="./assets/img/layout/mvconline.png" alt="Trực tuyến">Trực tuyến</span> <span>: <?php echo count($online); ?></span> </p>
</div>