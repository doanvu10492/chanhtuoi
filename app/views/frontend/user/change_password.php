<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header') ?>
<div class="container margin-20" >
  <div class="row">
<div class="col-md-3">
  <?php $this->load->view('frontend/user/sidebar_account') ?>
</div>
<div class="col-md-9">
  <div class="bd-member">
  <h1>Đổi mật khẩu</h1>
  <div id="register-member" class="update_infor_user">
    <div class="status-update"></div>
       <div class="form-register-member"> 
        <form id="form-change-pass" action="./doi-mat-khau" method="post" enctype="multipart/form-data">
        <div class="col-md-10">  
            <div class="form-group" id="input-password">
              <label class="lb-register-member">Mật khẩu mới: <span class="star-red"> *</span></label>
                <div class="lb8 input-rs"><input class="form-control form-type-1" type="password" name="password" value=""></div>
               <input class="form-control form-type-1" type="hidden" name="change_pass" value="change_pass">
            </div>

            <div class="form-group" id="input-repassword">
              <label class="lb-register-member">Nhập lại mật khẩu: <span class="star-red"> *</span></label>
                <div class="lb8 input-rs"><input class="form-control form-type-1" type="password" name="re_password" value=""></div>
              
            </div>
            <div class="form-group">
                <label class="lb-register-member"></label>
                <div class="lb8"><input class="btn bt-reset" id="change_pass" type="submit" name="register" value="Cập nhật"> </div>
            </div>
        </div>
        </form>
      </div>
    </div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
  $(function(){
    $('#change_pass').click(function(event){
        event.preventDefault();
       
        $.ajax({
            'type' : 'POST',
            'url' : './doi-mat-khau',
            'data' : $('#form-change-pass').serialize(),
            'success' : function(data){
                result = JSON.parse(data);

                if (result.result) {
                  $('.form-group p').empty();
                  $('.form-group .input-rs input').attr('value', '');
                  $('.update_infor_user .status-update').empty().append('<p>'+result.result+'</p>');
                  $('html, body').animate({'scrollTop': '0'}, 300);

                } else {
                  $('.form-group p').empty();
                  $('.update_infor_user .status-update').empty();
                  $('#input-password').append('<p class="error">'+result.error_password+'</p>');
                  $('#input-repassword').append('<p class="error">'+result.error_repassword+'</p>');
                }
            }
        });
    });
})
</script>

<?php $this->load->view('frontend/layout/footer') ?>