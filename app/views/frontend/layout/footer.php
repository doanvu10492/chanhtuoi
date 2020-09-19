<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<footer id="footer">
  <div class="footer-top">
    <div class="container">

      <div class="footer-line-contact-social">
        <p class="footer-line-contact-social-text">Tìm chúng tôi trên:</p>
                  <ul class="footer-line-contact-social-list">
                          <li><a href="https://www.facebook.com/chanhtuoicom/" target="_blank" rel="nofollow">
                <i class="fa fa-facebook"></i>
              </a></li>
                          <li><a href="https://www.youtube.com/channel/UCwLeVIbBtTff39PfgbbK0RA" target="_blank" rel="nofollow">
                <i class="fa fa-youtube-play"></i>
              </a></li>
                          <li><a href="https://chanhtuoi.com/rss/" target="_blank" rel="nofollow">
                <i class="fa fa-rss"></i>
              </a></li>
                        <li><a href="https://zalo.me/1178192780778137156"><img src="https://chanhtuoi.com/assets/img/icon/zalo-icon.png" alt="zalo-icon"></a></li>
          </ul>
              </div>

      <div class="footer-line-contact-email">
        <?php $this->load->view('frontend/block/send_email') ?>
      </div>

              <div class="footer-line-contact-short-link"><a href="#" rel="nofollow">
          <p class="footer-line-contact-short-link__text">Nhận mã giảm giá, ưu đãi độc quyền qua Email của bạn mỗi ngày.</p>
        </a></div>
      
    </div>
  </div>

  <div class="footer-link">
      <div class="container">
        <ul class="list-inline">
          <li><a href="/ma-giam-gia-lazada-c25.html">Mã giảm giá Lazada</a></li>
          <li><a href="/ma-giam-gia-shopee-c23.html">Mã giảm giá Shopee</a></li>
          <li><a href="/ma-giam-gia-tiki-c22.html">Mã giảm giá Tiki</a></li>
          <li><a href="/ma-giam-gia-sendo-c52.html">Mã giảm giá Sendo</a></li>
          <li><a href="https://chanhtuoi.com/may-lam-da-vien-p1797.html">Máy làm đá viên</a></li>
      </ul>
      </div>
    </div>

  <div class="footer-middle">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 left-footer-address">
          <?= $this->config->item('footer') ?>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <?= $this->config->item('about') ?>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
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
        <div class="copyright">
          <p><?= $this->config->item('copyright') ?></p>
        </div>
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