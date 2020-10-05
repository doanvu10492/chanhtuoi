<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $this->config->item('site_title') ?></title>
	<meta name="description" content="<?= $this->config->item('meta_description') ?>"/>
	<meta name="robots" content="noindex,nofollow"/>
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/outlink.min.css">
	<script>
		var count = 5;
		var redirect = "<?= $link ?>";
		function countDown() {
	        var timer = document.getElementById("timer");
	        if (count > 0) {
	            count--;
	            timer.innerHTML = "Bạn đang được chuyển tới trang đích trong <b>" + count + "</b> giây nữa";
	            setTimeout("countDown()", 1000);
	        } else {
	            window.location.href = redirect;
	        }
	    }

	    countDown();
	</script>
</head>
<body>
	<div class="outlink">
		<div class="container">
			<div class="outlink-wrap">
				<?= $this->config->item('header_outlink') ?>
		        <p class="outlink-timer" id="timer">
		        	<script type="text/javascript">countDown();</script>
		        </p>
		        <div class="outlink-load">
		            <img src="<?= base_url() ?>/assets/img/layout/loading-post.gif" alt="Vui lòng chờ trong giây lát" />
		        </div>
		        <div class="outlink-now">
		        	<a rel="nofollow" href="<?= $link; ?>">Chuyển nhanh tới trang &raquo;</a>
		        </div>
		        <div class="outlink-banner">
		        	<?= $this->config->item('info_outlink') ?>
		        </div>
			</div>
		</div>
	</div>
</body>
</html>