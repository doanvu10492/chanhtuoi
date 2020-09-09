
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng nhập quản trị</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <base href="<?php echo base_url(); ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style type="text/css">
.input-group .input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px 0 0 4px;
    border-right: 0;
}
.login-box-body { box-shadow: 0px 0px 1px #000; border-radius: 2px; }
.icheck>label{ padding-left: 20px; }
.text-left { text-align: left !important; }
.login-logo{ margin-bottom: 15px; }
</style>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Đăng nhập </b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"> <?php echo ($this->session->flashdata('message')) ? ($this->session->flashdata('message')) : ("Vui lòng điền đầy đủ thông tin để đăng nhập")  ?></p>

<?php echo form_open('',array('class'=>'form-horizontal'));?>      
<div class="main-login main-center">
  <form class="form-horizontal" method="post" action="#">
   
    <div class="form-group">
      <label for="email" class="col-md-12 control-label text-left">Tài khoản</label>
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
          <input type="username" name="username" class="form-control" placeholder="Username">
        </div>
        <?php echo (form_error('username')) ? ("<p class='error'>".form_error('username')."</p>") : (''); ?>
      </div>
    </div>
    
    <div class="form-group">
      <label for="password" class="col-md-12 control-label text-left">Mật khẩu</label>
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
          <input type="password" name="password" class="form-control" placeholder="Password"> 
        </div>
        <?php echo (form_error('password')) ? ("<p class='error'>".form_error('password')."</p>") : (''); ?>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
           
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</div>
<?=form_close()?>
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="./assests/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>







