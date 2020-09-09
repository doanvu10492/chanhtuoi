<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header', $this->outputData) ?>

<div class="wrapper" id="posting-bds">

<div class="container">
    <div class="row">
       
      
        <div class="col-md-12">
    <div class="content">
        <div class="" id="register-member" style="max-width: 600px; margin: 0 auto; margin-top: 20px; margin-bottom: 20px">

        

        <h1 class="name-register">Đăng ký thành viên </h1>

        <div class="form-register-member">
                    <!--san pham moi-->
        <div class="login-social-network">
        
        </div>



        <form id="form-register" action="./dang-ky" method="post" enctype="multipart/form-data">
        
              
                            
                    <div class="form-group" id="input-username">
                        <label>Tên đăng nhập</label>
                        <input class="form-control form-type-1" type="hidden" name="register-memeber">
                        <input class="form-control form-type-1" type="text" name="username" value=""  >
                    </div>

                     <div class="form-group" id="input-name">
                        <label>Họ và tên</label>
                        <input class="form-control form-type-1" type="text" name="name" value="" >
                       
                    </div>

                     <div class="form-group" id="input-email">
                        <label>Email</label>
                        <input class="form-control form-type-1" type="email" name="email" value="" >
                    </div>

                    <div class="form-group" id="input-password">
                        <label>Mật khẩu</label>
                        <input class="form-control form-type-1" type="password" name="password" value="" >
                    </div>

                    <div class="form-group" id="input-repassword">
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control form-type-1" type="password" name="re_password" value="">
                    </div>

                   
                    <div class="form-group" id="input-phone">
                      <label>Điện thoại</label>
                      <input class="form-control form-type-1" type="text" name="phone" value="" >
                    </div>
                   
                   
                    <div class="form-group" id="input-address">
                        <label>Địa chỉ</label>
                        <input class="form-control form-type-1" type="text" name="address" value="" >
                        
                    </div>

                    <div class="form-group">
                        <label>Giới thiệu sơ lược</label>
                        <textarea class="form-control form-type-1" name="notes" placeholder=""> </textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="lb-register-member"></label>
                        <div class="lb8"><input class="btn bt-reset" id="register" type="submit" name="register" value="Đăng ký"> <input class="btn  bt-reset" type="reset" name="reset" value="Hủy"></div>
                    </div>
                    
              </form>
              <p class="notes-member"><strong>Lưu ý: </strong>tài khoản sau khi đăng ký sẽ được quản trị của website xem xét và duyệt thông tin đăng ký mới được sử dụng.</p>
              </div>
            
        </div>
      
    </div>
    </div>

     
</div>
</div>
</div>

<script type="text/javascript">
    $('#register').click(function(event){
        event.preventDefault();
       
        $.ajax({
            'type' : 'POST',
            'url' : './dang-ky',
            'data' : $('#form-register').serialize(),
            'success' : function(data){
                result = JSON.parse(data);
                if (result.result)
                {
                    $('#register-member').empty().append('<h3>'+result.result+'</h3><div class="back-infor"><a href="./">Trang chủ</a><a href="./xem-thong-tin">Xem thông tin</a></div>');
                }else{
                    $('.form-group p').empty();
                    $('#input-username').append('<p class="error">'+result.error_username+'</p>');
                    $('#input-password').append('<p class="error">'+result.error_password+'</p>');
                    $('#input-repassword').append('<p class="error">'+result.error_repassword+'</p>');
                    $('#input-phone').append('<p class="error">'+result.error_phone+'</p>');
                    $('#input-email').append('<p class="error">'+result.error_email+'</p>');
                    $('#input-name').append('<p class="error">'+result.error_name+'</p>');
                }
            }
        });
    });
</script>
<?php $this->load->view('frontend/layout/footer') ?>