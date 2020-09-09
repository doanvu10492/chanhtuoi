<div class="box-body">
  	<div class="row">
    	<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Meta title:</label>
            <div class="col-sm-10">
                <input type="text" name="meta_title" class="form-control" value="<?php if(isset($settings['meta_title'])) echo $settings['meta_title']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Meta keywords:</label>
            <div class="col-sm-10">
                <textarea id="meta_keywords" class="form-control" cols="100" rows="6" name="meta_keywords"><?php if(isset($settings['meta_keywords'])) echo $settings['meta_keywords']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Meta description:</label>
            <div class="col-sm-10">
                <textarea id="meta_description" class="form-control" cols="100" rows="6" name="meta_description"><?php if(isset($settings['meta_description'])) echo $settings['meta_description']; ?></textarea>
            </div>
        </div>
    </div>
</div>