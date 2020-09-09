<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coming Soon</title>
<link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon" />
<link href="<?php echo base_url() ?>app/css/tools/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>app/css/tools/960.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url() ?>app/css/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>app/css/js/Clarendon_LT_Std_700.font.js"></script>
<script type="text/javascript">
	Cufon.replace('h1,h3', {fontFamily: 'Clarendon LT Std', hover:true})
</script>
</head>
<body>
<?php
$CI =& get_instance();    //do this only once in this file
$site_lang = $CI->session->userdata('site_lang');
$this->lang->load('admin/common', $site_lang);
$this->lang->line('added_success');
if($site_lang=='vietnam'){
	$lang='';
}else{
	$lang='_en';
}
?>
<div id="shim"></div>
<div id="content">
	<div class="logo_box"><h1>HMALAYA</h1></div>          
	<div class="main_box">
		<h2><?php echo $this->lang->line('offline_baoduong'); ?></h2>
		
		<ul class="info">
			<li>
				<h3><?php echo $this->lang->line('dienthoai'); ?></h3>
				<p><?php echo $settings['CSKH'] ?></p>
			</li>
            <li>
				<h3><?php echo $this->lang->line('email'); ?></h3>
				<p><?php echo $settings['EMAILCSKH'] ?></p>
			</li>
			<li>
				<h3><?php echo $this->lang->line('diachi'); ?></h3>
				<p><?php echo $settings['DIACHI'] ?></p>
			</li>
			<!--<li>
				<h3>Social network</h3>
				<p class="social">
					<a href="#" class="tw"></a>
					<a href="#" class="fb"></a>				
				</p>
			</li>-->
		</ul>
	</div>
</div>

</body>
</html>
