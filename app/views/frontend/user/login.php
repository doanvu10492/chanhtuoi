<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header', $this->outputData) ?>
<?php /*
<div class="container">
	<div class="bd-member">
		<div class="content">
	      <div class="content-login">
		  <div class="login">

				<div class="form-login-center">

					<div class="title-login">
						<h1>Đăng nhập</h1>
					</div>
					<form method="post" class="signin" action="./dang-nhap">

						<?php if($error != '') : ?>
						<p class="error" style="text-align: center;"> <?php echo $error; ?> </p>
						<?php endif; ?>

						<?php if (form_error('username')) : ?>
						<p class="error" style="text-align: center;">Tên đăng nhập không được bỏ trống</p>
						<?php endif; ?>

						<?php if (form_error('password')) : ?>
						<p class="error" style="text-align: center;"> <?php echo (form_error('password') != NULL) ? ("Mật khẩu không được bỏ trống") : (""); ?> </p>
						<?php endif; ?>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input id="username" class="form-control" name="username" value="" type="text" autocomplete="on" placeholder="Tên đăng nhập">
								</div>

								<div class="form-group">
									<input class="form-control" id="password" name="password" value="" type="password" placeholder="Mật khẩu">
								</div>

								<div class="form-group form-group-btn">
									<a href="./forget-pass.html" class="forget-pass">
									<input class="btn btn-big" type="submit" value="Đăng nhập" name="login">
									</a>
								</div>   

							</div>
						</div>
					</form>
				</div>
				</div>
		    </div>
		</div>
	</div>
	</div>

*/?>
<div class="login-form" style="max-width: 400px; margin: 0 auto">
    <form action="/examples/actions/confirmation.php" method="post">
        <div class="title-login text-center">
			<h1>Đăng nhập</h1>
		</div>  
        <div class="form-group">
        	<div class="input-group">
                <div class="input-group-addon">
                    <span class="input-group-text">
                        <span class="fa fa-user"></span>
                    </span>                    
                </div>
                <input type="text" class="form-control" name="username" placeholder="Tên đăng nhập" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                    </span>                    
                </div>
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="required">				
            </div>
        </div>        
        <div class="form-group">
            <button type="submit" class="btn btn-primary login-btn btn-block">Sign in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>
		<div class="or-seperator"><i>or</i></div>
        <p class="text-center">Login with your social media account</p>
        <div class="text-center social-btn">
            <a href="#" class="btn btn-info"><i class="fa fa-facebook"></i>&nbsp; Facebook</a>
            <a href="#" class="btn btn-info"><i class="fa fa-twitter"></i>&nbsp; Twitter</a>
			<a href="#" class="btn btn-danger"><i class="fa fa-google"></i>&nbsp; Google</a>
        </div>
    </form>
    <p class="text-center text-muted small">Don't have an account? <a href="#">Sign up here!</a></p>
</div>


	<?php $this->load->view('frontend/layout/footer', $this->outputData) ?>

