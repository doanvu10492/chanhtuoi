<?php
if(isMember()):
  $CI = & get_instance();
  $login = $this->session->userdata('CI_login');
 ?>
<div class="box-infor-user margin-r">
  <h3>Thông tin tài khoản</h3>
    <div class="infor-user-main">
        <div class="username-img">
            <img src="<?= (isset($login['img']) && $login['img']) ? ($login['img']) : ('./assets/img/layout/avatar.png'); ?>" align="user">
             <p>Xin chào : <?php echo $login['member_name']; ?></p>
             <a href="./dang-xuat.html">Đăng xuất</a><a href="./xem-thong-tin.html">Sửa</a>
             <p>
             <a href="./doi-mat-khau.html">Đổi mật khẩu</a>
            <!--  <a href="./don-dat-hang.html">Đơn hàng</a> -->
             </p>
        </div>
       
        <p>- Họ và tên : <?php echo $login['member_name']; ?></p>
        <p>- Điện thoại : <?php echo $login['member_phone']; ?></p>
        <p>- Địa chỉ : <?php echo $login['member_address']; ?></p>
        
    </div>
</div>

<?php endif; ?>



