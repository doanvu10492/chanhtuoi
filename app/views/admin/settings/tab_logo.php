<div class="box-body">
<div class="row">
<div class="col-md-12">
	<div class="form-group overload-hidden">
		<label for="inputEmail3" class="col-sm-2 control-label">Logo:</label>
		<div class="col-sm-10">
		    <a href="<?php echo $settings['logo']; ?>" class="fancybox">
		    	<img src="<?php echo (isset($settings['logo'])) ? ( $settings['logo']) : (''); ?>" alt="" class="thumb width85" >
            </a>
            <input  type="text" name="logo" id="image" readonly="true" value="<?php echo (isset($settings['logo'])) ? ( $settings['logo']) : (''); ?>" />
            <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image' name="hinhanh">
		</div>
	</div>

	<div class="form-group overload-hidden">
		<label for="inputEmail3" class="col-sm-2 control-label">Background 3:</label>
		<div class="col-sm-10">
		    <a href="<?php echo $settings['bg_link']; ?>" class="fancybox">
		    	<img src="<?php echo (isset($settings['bg_link'])) ? ( $settings['bg_link']) : (''); ?>" alt="" class="thumb width85" >
            </a>
            <input  type="text" name="bg_link" id="image_bg_link" readonly="true" value="<?php echo (isset($settings['bg_link'])) ? ( $settings['bg_link']) : (''); ?>" />
            <input type="button" id="file3" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image_bg_link' name="hinhanh">
		</div>
	</div>

	<div class="form-group overload-hidden">
		<label for="inputEmail3" class="col-sm-2 control-label">Background đối tác:</label>
		<div class="col-sm-10">
		    <a href="<?php echo $settings['bg_partner']; ?>" class="fancybox">
		    	<img src="<?php echo (isset($settings['bg_partner'])) ? ( $settings['bg_partner']) : (''); ?>" alt="" class="thumb width85" >
            </a>
            <input  type="text" name="bg_partner" id="image_bg_partner" readonly="true" value="<?php echo (isset($settings['bg_partner'])) ? ( $settings['bg_partner']) : (''); ?>" />
            <input type="button" id="file3" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image_bg_partner' name="hinhanh">
		</div>
	</div>

	<div class="form-group overload-hidden">
		<label for="inputEmail3" class="col-sm-2 control-label">Đóng dấu ảnh nhỏ:</label>
		<div class="col-sm-10">
		    <a href="<?php echo $settings['bg_guide']; ?>" class="fancybox">
		    	<img src="<?php echo (isset($settings['bg_guide'])) ? ( $settings['bg_guide']) : (''); ?>" alt="" class="thumb width85" >
            </a>
            <input  type="text" name="bg_guide" id="image_bg_guide" readonly="true" value="<?php echo (isset($settings['bg_guide'])) ? ( $settings['bg_guide']) : (''); ?>" />
            <input type="button" id="file4" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image_bg_guide' name="hinhanh">
		</div>
	</div>

    <div class="form-group overload-hidden">
		<label for="inputEmail3" class="col-sm-2 control-label">Đóng dấu ảnh lớn:</label>
		<div class="col-sm-10">
		    <img src="<?php echo (isset($settings['logo_en'])) ? ( $settings['logo_en']) : (''); ?>" alt="" class="thumb width85" >
            
            <input  type="text" name="logo_en" id="image_en" readonly="true" value="<?php echo (isset($settings['logo_en'])) ? ( $settings['logo_en']) : (''); ?>"	 />
            <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image_en' name="hinhanh">
		</div>
	</div>

	<div class="form-group overload-hidden">
		<label for="inputEmail3" class="col-sm-2 control-label">Giấy chứng nhận:</label>
		<div class="col-sm-10">
		    <img src="<?php echo (isset($settings['certify'])) ? ( $settings['certify']) : (''); ?>" alt="" class="thumb width85" >
            
            <input  type="text" name="certify" id="certify" readonly="true" value="<?php echo (isset($settings['certify'])) ? ( $settings['certify']) : (''); ?>"	 />
            <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='certify' name="hinhanh">
		</div>
	</div>
</div>
</div>
</div>