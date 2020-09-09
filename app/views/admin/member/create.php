<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="box box-default">

<div class="box-header with-border">
  <h3 class="box-title">Sửa bài viết</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div>
</div>
 <div class="box-body">

    <div class="col-lg-12 ">
    <?php echo form_open('',array('class'=>'form-horizontal'));?>

  <?php if($id == 0) { ?>
    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Tài khoản đăng nhâp:</label>
        <div class="col-sm-4">
            <input type="text" name="username" class="form-control" value="<?php echo (isset($page->username)) ? ($page->username) : (set_value('username')); ?>" >
            <?php echo (form_error('username')) ? ('<p class="error">'.form_error('username').'</p>') : (''); ?>
        </div>
    </div>
  <?php } else { ?>

    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Tài khoản đăng nhâp:</label>
        <div class="col-sm-4">
            <p style="margin-top: 5px"><?= $page->username ?></p>
        </div>
    </div>
  <?php } ?>

    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Họ & tên:</label>
        <div class="col-sm-4">
            <input type="text" name="full_name" class="form-control" value="<?php echo (isset($page->full_name)) ? ($page->full_name) : (set_value('full_name')); ?>" >
            <?php echo (form_error('full_name')) ? ('<p class="error">'.form_error('full_name').'</p>') : (''); ?>
        </div>
    </div>


    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Điện thoại:</label>
        <div class="col-sm-4">
            <input type="text" name="phone" class="form-control" value="<?php echo (isset($page->phone)) ? ($page->phone) : (set_value('phone')); ?>" >
            <?php echo (form_error('phone')) ? ('<p class="error">'.form_error('phone').'</p>') : (''); ?>
        </div>
    </div>
 
    
  <input type="hidden" name="username_hd" value="<?php echo (isset($page)) ? ( $page->username ) : (''); ?>">
   <input type="hidden" name="password_hd" value="<?php echo (isset($page)) ? ( $page->password ) : (''); ?>">
    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Password:</label>
        <div class="col-sm-4">
            <input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>" >
            <?php echo (form_error('password')) ? ('<p class="error">'.form_error('password').'</p>') : (''); ?>
        </div>
    </div>

    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Nhập lại mật khẩu:</label>
        <div class="col-sm-4">
            <input type="password" name="password_confirm" class="form-control" value="<?php echo set_value('password_confirm'); ?>" >
            <?php echo (form_error('password_confirm')) ? ('<p class="error">'.form_error('password_confirm').'</p>') : (''); ?>
        </div>
    </div>
    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>
        <div class="col-sm-4">
            <input type="text" name="email" class="form-control" value="<?php echo (isset($page->email)) ? ($page->email) : (set_value('email')); ?>" >
            <?php echo (form_error('email')) ? ('<p class="error">'.form_error('email').'</p>') : (''); ?>
        </div>
    </div>

    <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Nội dung chính:</label>
          <div class="col-sm-10">
               <textarea id="description" class="form-textarea" cols="100" rows="6" name="description"><?php echo (isset($page->description)) ? ($page->description) : (set_value('description')); ?></textarea>
          </div>
      </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
       <?php echo form_submit('submit', $button, 'class="submit blue-btn"');?>
      </div>
    </div>
      <?php echo form_close();?>
    
</div>
</div>
</div>
<script type="text/javascript"  language="javascript">
  CKEDITOR.replace('description');
</script> 
