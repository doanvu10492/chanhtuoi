<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no" /> 
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="content-language" content="vi" />
<title><?php if(isset($page_title)) echo $page_title; ?></title>
<meta name="keywords" content="<?php if(isset($meta_keywords)) echo $meta_keywords; ?>" />
<meta name="description" content="<?php if(isset($meta_description)) echo $meta_description; ?>" />
<meta name="DC.title" content="<?php echo $this->config->item('site_title'); ?>" />
<?php if(isset($detail) && isset($detail['img_thumb'])): ?>
<meta itemprop="image" content="<?=$detail['img_thumb']?>" />
<meta property="og:url" itemprop="url" content="<?=$detail['link']?>" />	
<meta property="og:title" content="<?=$detail['name']?>" />
<meta property="og:type" content="article" />
<meta property="og:description" content="<?=strip_tags($detail['brief'])?>" />
<meta property="og:image" content="<?=$detail['img_thumb']?>" />
<?php endif; ?>
<base href="<?php echo base_url(); ?>" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Ho Chi Minh City" />
<meta name="geo.position" content="10.845618, 106.652461" />
<meta name="ICBM" content="10.845618, 106.652461" />
<link rel="canonical" href="<?php echo base_url(); ?>" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="./assets/css/font-awesome/css/font-awesome.min.css" type="text/css"/>
<link rel="stylesheet"  href="./assets/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet"  href="./assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="./assets/css/animate.css" type="text/css" />
<link rel="stylesheet" href="./assets/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="./assets/gallery3d/css/demo.css">
<link rel="stylesheet" href="./assets/gallery3d/css/gallery3d.css">
<link rel="stylesheet" href="./assets/css/swiper.min.css">
<link href='//fonts.googleapis.com/css?family=Raleway:400,300|Lato:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet"  href="./assets/flexnav/flexnav.css?v=<?=strtotime(date('Y-m-d H:i:s'))?>">
<link rel="stylesheet" href="./assets/css/mystyle.css?v=<?php echo strtotime(date('d-m-Y H:i:s')); ?>" type="text/css" />
<link rel="stylesheet" href="./assets/fancybox/jquery.fancybox.css" />
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;469;500;600;700&display=swap" rel="stylesheet">
<?php echo ( $current_page == 'album' ) ? ('<link rel="stylesheet" href="./assets/css/gallery.css" />') : (''); ?>
<script src="./assets/js/jquery.js"></script>
<script src="./assets/owl-carousel/owl.carousel.js"></script>
<script src="./assets/js/jquery.lazy.min.js"></script>
<script src="./assets/js/wow.js"></script>
<script type="text/javascript">
	if ($(window).width() > 990) {
	 	new WOW().init(); 
	}
</script>
<style type="text/css">
	<?= $this->config->item('style') ?>
</style>
</head>
<body>
<header id="header">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="header-logo">
						<div class="logo">
							<a href="./"><img src="<?= $this->config->item('logo') ?>" class="<?= $this->config->item('site_title') ?>"></a>
						</div>
						<div class="header-banner-search">
							<div class="header-search">
								<?php $this->load->view('frontend/block/search'); ?>
							</div>
							<div class="right-banner">
								<span class="email"><a href="mail:<?= $this->config->item('email') ?>">Email: <?= $this->config->item('email') ?></a></span>
								 <span class="line"> </span> 
								<span class="phone"> Điện thoại: <a href="tel:<?= $this->config->item('hotline') ?>"><?= $this->config->item('hotline') ?></a></span>
								<?php $this->load->view('frontend/block/social_network') ?>
								
								<?php if ( ! $this->session->userdata('CI_login')) { ?> 
				               		<span class="user-btn" style="margin-left: 5px; margin-right: 5px; "><a href="./login" style="font-size: 13px"><i class="fa fa-user" aria-hidden="true" style="margin-right: 5px;"></i> <b>Đăng nhập</b></a></span>
				                <?php } else { ?>
				                	<span class="user-btn" style="margin-right: 5px; margin-right: 5px; ">
				                    <a href="./dang-xuat.html" style="font-size: 13px"> <i class="fa fa-sign-out"></i></span><b>Đăng xuất</b></a>
				                <?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-top-menu">
		<div class="container">
			<div class="row">
				<?php $this->load->view('frontend/block/menu'); ?>
			</div>
		</div>
	</div>
</div>
</div>

</header>
<!-- END HEADER -->