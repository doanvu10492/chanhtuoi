<div class="tab-pane active" id="vi">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tên website:</label>
                <div class="col-sm-10">
                    <input type="text" name="site_title" class="form-control" value="<?php if(isset($settings['site_title'])) echo $settings['site_title']; ?>"  placeholder="Tên website">
                </div>
            </div>
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">link bài viết chính sách:</label>
                <div class="col-sm-10">
                    <input type="text" name="slogan" class="form-control" value="<?php if(isset($settings['slogan'])) echo $settings['slogan']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Hotline:</label>
                <div class="col-sm-10">
                    <input type="text" name="hotline" class="form-control" value="<?php if(isset($settings['hotline'])) echo $settings['hotline']; ?>"  placeholder="Hotline">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Điện thoại:</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" value="<?php if(isset($settings['phone'])) echo $settings['phone']; ?>"  placeholder="Điện thoại">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Address:</label>
                <div class="col-sm-10">
                    <input type="text" name="address" class="form-control" value="<?php if(isset($settings['address'])) echo $settings['address']; ?>"  placeholder="Địa chỉ">
                </div>
            </div>
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Số fax:</label>
                <div class="col-sm-10">
                    <input type="text" name="number_fax" class="form-control" value="<?php if(isset($settings['number_fax'])) echo $settings['number_fax']; ?>"  placeholder="Địa chỉ">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" name="site_admin_email" class="form-control" value="<?php if(isset($settings['site_admin_email'])) echo $settings['site_admin_email']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email dùng gửi email:</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" value="<?php if(isset($settings['email'])) echo $settings['email']; ?>"  >
                </div>
            </div>
				<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Copyright:</label>
                <div class="col-sm-10">
                    <input type="text" name="copyright" class="form-control" value="<?php if(isset($settings['copyright'])) echo $settings['copyright']; ?>"  >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Thông tin liên hệ:</label>
                <div class="col-sm-10">
                     <textarea id="textarea_footer" class="form-textarea" cols="100" rows="6" name="footer"><?php if(isset($settings['footer'])) echo $settings['footer']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Link liên kết 1:</label>
                <div class="col-sm-10">
                    <textarea id="about" class="form-control" cols="100" rows="6" name="about"><?php if(isset($settings['about'])) echo $settings['about']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Link liên kết 2:</label>
                <div class="col-sm-10">
                    <textarea id="product_text" class="form-control" cols="100" rows="6" name="product_text"><?php if(isset($settings['product_text'])) echo $settings['product_text']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Bản đồ:</label>
                <div class="col-sm-10">
                    <textarea id="map" class="form-control" cols="100" rows="6" name="map"><?php echo (isset($settings['map'])) ? ($settings['map']) : ('') ; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Google script:</label>
                <div class="col-sm-10">
                    <textarea id="google_script" class="form-control" cols="100" rows="6" name="google_script"><?php if(isset($settings['google_script'])) echo $settings['google_script']; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Custom Style css:</label>
                <div class="col-sm-10">
                    <textarea id="style" class="form-control" cols="100" rows="6" name="style"><?php if(isset($settings['style'])) echo $settings['style']; ?></textarea>
                </div>
            </div>

            
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái:</label>
                <div class="col-sm-10">
                    <input type="radio"  class="clsRadioBut" name="site_status"  value="0"  <?php if(isset($settings['site_status']) and $settings['site_status']==0)  echo 'checked="checked"'; ?>/>
		             Đang bảo trì
		            <input type="radio" name="site_status" class="clsRadioBut" value="1"<?php if(isset($settings['site_status']) and $settings['site_status']==1)  echo 'checked="checked"'; ?>/>
		            Hoạt động bình thường	
                </div>
            </div>
          <!-- /.form-group -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box-body -->
</div>