<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header', $this->outputData) ?>
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
	<?php $this->load->view('frontend/layout/footer', $this->outputData) ?>
