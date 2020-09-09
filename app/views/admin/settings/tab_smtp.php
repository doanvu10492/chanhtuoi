<div class="box-body">
    <div class="row">
        <div class="col-md-12">
        	<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Smtp host:</label>
                <div class="col-sm-10">
                    <input type="text" name="smtp_host" class="form-control" value="<?php if(isset($settings['smtp_host'])) echo $settings['smtp_host']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Smtp username:</label>
                <div class="col-sm-10">
                    <input type="text" name="smtp_username" class="form-control" value="<?php if(isset($settings['smtp_username'])) echo $settings['smtp_username']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Smtp password:</label>
                <div class="col-sm-10">
                    <input type="text" name="smtp_password" class="form-control" value="<?php if(isset($settings['smtp_password'])) echo $settings['smtp_password']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Smtp email:</label>
                <div class="col-sm-10">
                    <input type="text" name="smtp_email" class="form-control" value="<?php if(isset($settings['smtp_email'])) echo $settings['smtp_email']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">To email:</label>
                <div class="col-sm-10">
                    <input type="text" name="smtp_to_email" class="form-control" value="<?php if(isset($settings['smtp_to_email'])) echo $settings['smtp_to_email']; ?>" >
                </div>
            </div>
        </div>
    </div>
</div>
