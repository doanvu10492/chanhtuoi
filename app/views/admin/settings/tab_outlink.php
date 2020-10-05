<div class="box-body">
 <div class="row">
    <div class="col-md-12">
    	<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Thông tin header liên kết:</label>
            <div class="col-sm-10">
                <textarea id="header_outlink" class="form-control" cols="100" rows="6" name="header_outlink"><?php if(isset($settings['header_outlink'])) echo $settings['header_outlink']; ?></textarea>
            </div>
        </div>
		<div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Thông tin liên kết:</label>
            <div class="col-sm-10">
                <textarea id="info_outlink" class="form-control" cols="100" rows="6" name="info_outlink"><?php if(isset($settings['info_outlink'])) echo $settings['info_outlink']; ?></textarea>
            </div>
        </div>
    </div>
</div>
</div>
