
<div class="box-body">
  <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Facebook:</label>
            <div class="col-sm-10">
                <input type="text" name="facebook" class="form-control" value="<?php if(isset($settings['facebook'])) echo $settings['facebook']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Twitter:</label>
            <div class="col-sm-10">
                <input type="text" name="twitter" class="form-control" value="<?php if(isset($settings['twitter'])) echo $settings['twitter']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Youtube:</label>
            <div class="col-sm-10">
                <input type="text" name="youtube" class="form-control" value="<?php if(isset($settings['youtube'])) echo $settings['youtube']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Google+:</label>
            <div class="col-sm-10">
                <input type="text" name="google" class="form-control" value="<?php if(isset($settings['google'])) echo $settings['google']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Instagram:</label>
            <div class="col-sm-10">
                <input type="text" name="instagram" class="form-control" value="<?php if(isset($settings['instagram'])) echo $settings['instagram']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pinterest:</label>
            <div class="col-sm-10">
                <input type="text" name="pinterest" class="form-control" value="<?php if(isset($settings['pinterest'])) echo $settings['pinterest']; ?>" >
            </div>
         </div>
         <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Zalo:</label>
            <div class="col-sm-10">
                <input type="text" name="zalo" class="form-control" value="<?php if(isset($settings['zalo'])) echo $settings['zalo']; ?>" >
            </div>
         </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Link fanpage footer:</label>
            <div class="col-sm-10">
                <input type="text" name="link_fanpage" class="form-control" value="<?php if(isset($settings['link_fanpage'])) echo $settings['link_fanpage']; ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Fanpage:</label>
            <div class="col-sm-10">
                 <textarea id="textarea_footer_en" class="form-textarea" cols="100" rows="6" name="fanpage"><?php if(isset($settings['fanpage'])) echo $settings['fanpage']; ?></textarea>
            </div>
        </div>
      <!-- /.form-group -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>