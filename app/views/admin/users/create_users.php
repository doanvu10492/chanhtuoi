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

    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Họ tên:</label>
        <div class="col-sm-4">
            <input type="text" name="full_name" class="form-control" value="<?php echo (isset($page->full_name)) ? ($page->full_name) : (set_value('full_name')); ?>" >
            <?php echo (form_error('full_name')) ? ('<p class="error">'.form_error('full_name').'</p>') : (''); ?>
        </div>
    </div>

    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Công ty:</label>
        <div class="col-sm-4">
            <input type="text" name="company" class="form-control" value="<?php echo (isset($page->company)) ? ($page->company) : (set_value('company')); ?>" >
            <?php echo (form_error('company')) ? ('<p class="error">'.form_error('company').'</p>') : (''); ?>
        </div>
    </div>

    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Điện thoại:</label>
        <div class="col-sm-4">
            <input type="text" name="phone" class="form-control" value="<?php echo (isset($page->phone)) ? ($page->phone) : (set_value('phone')); ?>" >
            <?php echo (form_error('phone')) ? ('<p class="error">'.form_error('phone').'</p>') : (''); ?>
        </div>
    </div>
    <div class="form-group">
       <label for="inputEmail3" class="col-sm-2 control-label">Username:</label>
        <div class="col-sm-4">
            <input type="text" name="username" class="form-control" value="<?php echo (isset($page->username)) ? ($page->username) : (set_value('username')); ?>" >
            <?php echo (form_error('username')) ? ('<p class="error">'.form_error('username').'</p>') : (''); ?>
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
      <label for="inputEmail3" class="col-sm-2 control-label">Group:</label>
      <div class="col-sm-4">
        <?php
        if(isset($groups))
        {
         
          foreach($groups as $group)
          {
            echo '<div class="checkbox">';
            echo '<label>';
            echo form_radio('groups', $group->id,  ( isset($users_groups) ) ? (in_array($group->id, $users_groups) ? (TRUE) : (FALSE)  ) : (FALSE) );
            echo ' '.$group->description;
            echo '</label>';
            echo '</div>';
          }
        }
         echo form_error('groups');
        ?>

      </div>
    </div>
    <div class="form-group" id="store" class="show">
      <label for="inputEmail3" class="col-sm-2 control-label">Chi nhánh:</label>
      <div class="col-sm-4">
        <select id="address" name="address_id" multiple style="min-width: 200px" >
        <?php foreach ($selectAddress as $address): 
          $arrAddress = explode(',', $page->address_id); 
          $selected = in_array($address['id'], $arrAddress) ? 'selected=selected' : '';
          ?>
          <option value="<?= $address['id'] ?>" <?= $selected ?>><?= $address['name'] ?></option>
        <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
       <?php echo form_submit('submit', $pageTitle, 'class="submit blue-btn"');?>
      </div>
    </div>
      <?php echo form_close();?>
    
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function () {
    loadStore();
    $('input[name="groups"]').on('click', function() {
      loadStore();
    });
  });

  function loadStore() {
    console.log($('input[name="groups"]:checked').val());
    if ($('input[name="groups"]:checked').val() == 2) {
      $('#store').removeClass('hidden').addClass('show');
    } else {
      $('#store').removeClass('show').addClass('hidden');
    }
  }
</script>