<!DOCTYPE html>
<html>
<head>
 <title>Site Maintenance</title>
</head>
<body>
<style>
  body { text-align: center; padding: 150px; }
  h1 { font-size: 30px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
  p { font-size: 14px; line-height: 30px; clear: both; margin: 0}
  article h1 img { float: left; width: 100px; }
  article h1 span { padding: 20px 30px; float: left; }
  h2{ text-transform: uppercase; font-size: 15px; color: #007e3f; padding: 20px 0 5px; margin: 0; clear: both; }
</style>
<article>  
    <h1> <img src="<?php echo $this->config->item('logo'); ?>" > <span>Website đang bảo trì !</span></h1>
    <h2><?php echo $this->config->item('site_title');  ?></h2>
    <p>Hotline: <strong><?php echo $this->config->item('hotline'); ?></strong></p>
    <div>
        <p>Xin lỗi vì sự bất tiện này nhưng hiện tại chúng tôi đang thực hiện một số hoạt động bảo trì. Nếu bạn cần bạn  có thể liên hệ với chúng tôi thông qua hotline phía trên, nếu không chúng tôi sẽ quay lại trực tuyến ngay!</p>
        <p style="font-size: 14px">&mdash; Cảm ơn bạn đã viếng thăm website chúng tôi !</p>
    </div>
</article>

</body>
</html>