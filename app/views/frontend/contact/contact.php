<div class="content-main" >
  <section id="contact">                 
    <div class="contact-main">
      <div class="contact-infor">
        <div class="contact-info box-contact-form" >
          <div class="contact-map">
            <div class="bando_cavas  wow fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1000ms">
              <div id="mapCanvas"><?php echo $this->config->item('map'); ?></div>
            </div>
          </div>
        </div> 
      </div>
    </div>

    <div class="container">
      <div class="row">
       <div class="box-contact-form">
    <?php //show error
      if($msg = $this->session->flashdata('error_message')) {
    ?>
   
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Cảnh báo!</h4>
        <?php echo $msg;  ?>
      </div>
    <?php 
      }

      if($msg = $this->session->flashdata('flash_message')) {
    ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        <?php echo $msg; ?>
      </div>
    
    <?php 
      } 
    ?>   
    </div>      
      <div class="col-md-12">
        <address class="contact-info">
          <div class="title-h1">
            <h1><?php echo $this->config->item('site_title'); ?></h1>
          </div>
          <p>Hotline: <?= $this->config->item('hotline')  ?></p>
          <p>Điện thoại: <?= $this->config->item('phone')  ?></p>
          <p>Email: <?= $this->config->item('email')  ?></p>
          <p>Địa chỉ: <?= $this->config->item('address')  ?></p>
        </address>
      </div>
    </div>

    <div class="row">
      <form id="contactform" name="contact" method="post" action="./lien-he.html"  enctype="multipart/form-data">

      <div class="col-md-6">
       <div class="form-contact ">
        <div class="contact-form box-contact-form  " >
        <h3 class="title-8"><?php echo $this->lang->line('contact_form'); ?></h3>
        <div class="status alert alert-success" style="display: none"></div>
          
          <div class="form-group col-md-6">
            <input type="text" name="name" id="name" placeholder="Họ tên" value="<?php if(isset($name)) echo set_value('name'); ?>" class="textfiled form-control">
              <p class="p-error"> <?php if (form_error('name')) {echo $this->lang->line('error_name');} ?></p>
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="email" id="email"  placeholder="email" value="<?php if(isset($email)) echo set_value('email'); ?>" class="textfiled form-control fr">
            <p class="p-error"> <?php if (form_error('email')) {echo $this->lang->line('error_email');} ?></p>
          </div>
          <div class="form-group col-md-6">
            <input type="text" name="phone" class="form-control" required="required" value="<?php if(isset($address)) echo set_value('phone'); ?>" placeholder="Điện thoại">
            <p class="p-error"> <?php if (form_error('phone')) {echo $this->lang->line('error_phone');} ?></p>

          </div>
          <div class="form-group col-md-6">
            <input type="text" name="address" class="form-control fr" required="required" value="<?php if(isset($address)) echo set_value('address'); ?>" placeholder="Địa chỉ">
            <p class="p-error"> <?php if (form_error('address')) {echo $this->lang->line('error_address');} ?></p>
          </div>
          <div class="form-group col-md-12">
            <input type="text" name="objects"   class="form-control" required="required" value="<?php if(isset($objects)) echo set_value('objects'); ?>" placeholder="Tiêu đề">
            <p class="p-error"> <?php if (form_error('objects')) {echo $this->lang->line('error_objects');} ?></p>
          </div>
          
        </div>
      </div>
    </div>
      <div class="col-md-6">
          <div class="form-group col-md-12">
            <textarea name="message" placeholder="Nội dung"  id="content" class="textarea form-control" rows="4"><?php if(isset($email)) echo set_value('message'); ?></textarea>
            <p class="p-error"> <?php if (form_error('message')) {echo $this->lang->line('error_message');} ?></p>
          </div> 
      </div>

      <div class="col-md-12">
        <div class="form-group col-md-12">
            <input type="submit" name="send"  placeholder="<?php $this->lang->line('content') ?>"  class="btn bt-submit pull-left " value="Gửi"><input class="btn pull-left bt-reset" type="reset" value="Hủy">
          </div>
      </div>
       </form>
    </div>
    </div>
</section>          
</div>


