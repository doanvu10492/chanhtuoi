<?php $this->load->view('header'); ?>

<section class="wapper">
	
<div class="container">
<div class="row">
<div class="col-md-12  ">
<h3 class="notify-sucess-name">Thông báo liên hệ thành công</h3>

<?php
    $msg = $this->session->flashdata('flash_message');
    //$msg =1;
    if($msg = 2) { 
?>
    <p class="thongbao_lienhe">Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi đã nhận được thư liên hệ của bạn và sẽ trả lời bạn trong thời gian sớm nhất</p>

    <address>
    <p><?php echo $this->config->item('site_title') ?></p>
    <p><?php echo $this->config->item('diachi') ?></p>

    <p>Điện thoại: <?php echo $this->config->item('cskh') ?></p>

    <p>Email: <a style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size: 16px; font-weight:normal" href="mailto:<?php echo $this->config->item('site_admin_mail') ?>"><?php echo $this->config->item('site_admin_mail') ?></a></p>
    </address>

<?php 
    } 
?>

</div>

</div>

</div>

</section>
<?php $this->load->view('footer'); ?>
