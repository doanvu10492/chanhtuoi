<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header') ?>
<div id="page-member">

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('frontend/user/sidebar_account') ?>
    </div>
    <div class="col-md-9">
<div class="content-right">
          <div class="h1-member">
              <h1 style="font-size: 25px; text-transform: uppercase;"></h1>Chỉnh sửa thông tin</h1>
          </div>
        <div id="register-member" class="update_infor_user">
            <div class="status-update"></div>


       
        <div class="form-register-member">
       
            <!--san pham moi-->
        <form id='form-register' action="<?php echo base_url() ?>xem-thong-tin" method="post" enctype="multipart/form-data">
            <div class="col-md-6">   
              
                          
                  <div class="form-group" id="input-username">
                      <label class="lb-register-member">Tài khoản: <span class="star-red"> *</span></label>
                        <input class="form-control form-type-1" type="hidden" name="update_memeber" />

                        <input  class="form-control form-type-1" type="text" readonly="true"  value="<?php if(isset($infor_user->username)) echo $infor_user->username; ?>" />
                        
                    </div>

                    <div class="form-group" id="input-email">
                      <label class="lb-register-member" >Email: <span class="star-red"> *</span></label>
                        <div class="lb8"><input class="form-control form-type-1" type="email" name="email"  value="<?php if(isset($infor_user->email)) echo $infor_user->email; ?>" /></div>
                        <?php echo form_error('email'); ?>
                    </div>

                    <div class="form-group" id="input-name">
                      <label class="lb-register-member" >Họ tên: <span class="star-red"> *</span></label>
                        <div class="lb8"><input class="form-control form-type-1" type="text" name="name"  value="<?php if(isset($infor_user->full_name)) echo $infor_user->full_name; ?>" /></div>
                        <?php echo form_error('full_name'); ?>
                    </div>

                    <div class="form-group" >
                        <label class="lb-register-member" >Skype: <span class="star-red"> </span></label>
                        <div class="lb8"><input class="form-control form-type-1" type="text" name="skype"  value="<?php if(isset($infor_user->skype)) echo $infor_user->skype; ?>" /></div>
                        <?php echo form_error('skype'); ?>
                    </div>

              

                    <div class="form-group" id="input-birthday">
                      <label class="lb-register-member" >Ngày sinh: </label>
                        <div class="lb8"><input id="ngaysinh" type="text" name="birthday"  value="<?php if(isset($infor_user->birthday)) echo $infor_user->birthday; ?>" /></div>
                       
                            <?php echo form_error('ngaysinh'); ?>
                        </div>

                        <div class="form-group" id="input-gender">
                          <label class="lb-register-member">Giới tính</label>
                            <div class="lb8"> 
                              <label> <input type="radio" <?php if(($infor_user->gender == 0)) echo "checked"; ?> name="gender" value="0"> Nam</label>  
                                <label> <input type="radio" name="gender" value="1" <?php if(($infor_user->gender == 1)) echo "checked"; ?>   /> Nữ</label>
                            </div>
                            <?php echo form_error('gender'); ?>
                        </div>
                                
                            
                        
                </div>

                    <div  class="col-md-6 ">
                        <div class="form-group" id="input-phone">
                          <label class="lb-register-member">Điện thoại <span class="star-red"> *</span></label>
                            <div class="lb8"><input class="form-control form-type-1" type="text" name="phone"  value="<?php if(isset($infor_user->phone)) echo $infor_user->phone; ?>" /></div>
                            <?php echo form_error('phone'); ?>
                        </div>
                       
                       
                        <div class="form-group" id="input-address">
                          <label class="lb-register-member">Địa chỉ <span class="star-red"> *</span></label>
                            <div class="lb8"><input class="form-control form-type-1" type="text" name="address"  value="<?php if(isset($infor_user->address)) echo $infor_user->address; ?>" /></div>
                            <?php echo form_error('address'); ?>
                        </div>
                      
                        
                        <div class="form-group" id="input-type-account">
                          <label class="lb-register-member">Loại tài khoản</label>
                            <div class="lb8">
                                <label>
                               <input type="radio" name="type_account" value="0" <?php if(($infor_user->type_account == 0)) echo "checked"; ?>   /> Cá Nhân
                                 </label> 
                                 <label>
                                <input type="radio" name="type_account" value="1" <?php if(($infor_user->type_account == 1)) echo "checked"; ?>  /> Doanh nghiệp  </label>
                            </div>
                            <?php echo form_error('type_account'); ?>
                        </div>
                        
                        <div class="form-group">
                          <label class="lb-register-member">Giới thiệu sơ lượt</label>
                            <div class="lb8"><textarea class="form-control form-type-1" name="notes"> <?php if(isset($infor_user->notes)) echo $infor_user->notes; ?></textarea></div>
                            
                        </div>
                        
                        <div class="form-group">
                          <label class="lb-register-member"></label>
                            <div class="lb8"><input class="btn bt-reset" id="register" type="submit" name="register" value="Cập nhật" /> </div>
                        </div>
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
  $(function(){
    $('#register').click(function(event){
        event.preventDefault();
       
        $.ajax({
            'type' : 'POST',
            'url' : './xem-thong-tin',
            'data' : $('#form-register').serialize(),
            'success' : function(data){
                result = JSON.parse(data);
                if (result.result)
                {
                   $('.form-group p').empty();
                    $('.update_infor_user .status-update').empty().append('<p>'+result.result+'</p>');
                    $('html, body').animate({'scrollTop': '0'}, 300);

                }else{
                    $('.form-group p').empty();
                    $('#input-phone').append('<p class="error">'+result.error_phone+'</p>');
                    $('#input-email').append('<p class="error">'+result.error_email+'</p>');
                    $('#input-name').append('<p class="error">'+result.error_name+'</p>');
                }
            }
        });
    });
  });
</script>
<?php $this->load->view('frontend/layout/footer') ?>