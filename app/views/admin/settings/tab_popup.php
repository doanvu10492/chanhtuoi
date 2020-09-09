<div class="box-body">
 <div class="row">
    <div class="col-md-12">
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Mã khuyến mãi:</label>
            <div class="col-sm-10">
                <input type="text" name="code_sale" class="form-control" value="<?php if(isset($settings['code_sale'])) echo $settings['code_sale']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">% khuyến mãi:</label>
            <div class="col-sm-10">
                <input type="text" name="number_sale" class="form-control" value="<?php if(isset($settings['number_sale'])) echo $settings['number_sale']; ?>" >
            </div>
        </div>
        <div class="form-group overload-hidden">
			<label for="inputEmail3" class="col-sm-2 control-label">background popup:</label>
			<div class="col-sm-10">
			    <a href="<?php echo $settings['bg_popup']; ?>" class="fancybox">
			    	<img src="<?php echo (isset($settings['bg_popup'])) ? ( $settings['bg_popup']) : (''); ?>" alt="" class="thumb width85" >
                </a>
                <input  type="text" name="bg_popup" id="image" readonly="true" value="<?php echo (isset($settings['bg_popup'])) ? ( $settings['bg_popup']) : (''); ?>" />
                <input type="button" id="file2" class="form-file fl fileBrowse" value="Chọn tệp" data-target='image' name="hinhanh">
			</div>
		</div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Popup:</label>
            <div class="col-sm-10">
                 <textarea id="popup" class="form-textarea" cols="100" rows="6" name="popup"><?php if(isset($settings['popup'])) echo $settings['popup']; ?></textarea>
            </div>
        </div>
    </div>
</div>
</div>
