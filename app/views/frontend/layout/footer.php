<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<footer id="footer">
    <div class="footer-top">
    <div class="container">

        <div class="footer-line-contact-social">
            <p class="footer-line-contact-social-text">Tìm chúng tôi trên:</p>
            <?php $this->load->view('frontend/block/social_network') ?>
        </div>
        <div class="footer-line-contact-email">
            <?php $this->load->view('frontend/block/send_email') ?>
        </div>
        <div class="footer-line-contact-short-link"><a href="#" rel="nofollow">
            <p class="footer-line-contact-short-link__text">Nhận mã giảm giá, ưu đãi độc quyền qua Email của bạn mỗi ngày.</p>
            </a>
        </div>
    </div>
  </div>

  <div class="footer-link">
      <div class="container">
        <ul class="list-inline">
            <?php foreach ($couponSourceInFooter as $row) : ?>
                <li><a href="<?= $row['link'] ?>"><?= $row['name'] ?></a></li>
            <?php endforeach; ?>
      </ul>
      </div>
    </div>

  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12 left-footer-address">
          <?= $this->config->item('footer') ?>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="ul-link-ft">
              <?= $this->config->item('about') ?>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="ul-link-ft">
              <?= $this->config->item('product_text') ?>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="box-fanpage-map">
            <div class="title-hd">
              <h3>Fanpage</h3>
            </div>
            <?php $this->load->view('frontend/block/fanpage') ?>
          </div>
        </div>
      </div>
      
    </div>   
    </div>
    <div class="footer-bottom">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright"><p><?= $this->config->item('copyright') ?></p></div>
            </div>
        </div>
    </div>
    <!-- back to top -->
    <!-- <span class="gotop" id="back-top"><a href="#top"><p><i class="fa fa-angle-up" aria-hidden="true"></i></p></a></span> -->

</footer>
<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/fancybox/jquery.fancybox.js"></script>
<script src="./assets/flexnav/jquery.flexnav.js" type="text/javascript"></script>
<script src="./assets/gallery3d/js/modernizr.custom.53451.js"></script>
<script src="./assets/gallery3d/js/jquery.gallery.js"></script>
<script src="./assets/js/main.js?v=<?php echo strtotime(date('d-m-Y H:i:s')); ?>"></script>
<div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v4.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
<!--youtube-->
<script src="https://apis.google.com/js/platform.js"></script>
<?=$this->config->item('google_script')?>
</body>
</html>