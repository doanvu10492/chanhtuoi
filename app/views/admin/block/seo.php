<div class="tab-pane" id="seo">
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label  class="col-sm-2 control-label">Meta title:</label>
                <div class="col-sm-10">
                    <input type="text" name="meta_title" class="form-control" value="<?= isset($page->meta_title) ? $page->meta_title : set_value('meta_title'); ?>">
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Meta keywords:</label>
                <div class="col-sm-10">
                    <textarea  class="form-textarea form-control" rows="6" name="meta_keywords"><?php echo (isset($page->meta_keywords)) ? ($page->meta_keywords) : (set_value('meta_keywords')); ?>
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-2 control-label">Meta description:</label>
                <div class="col-sm-10">
                     <textarea  class="form-textarea form-control"  rows="6" name="meta_description"><?php echo (isset($page->meta_description)) ? ($page->meta_description) : (set_value('meta_description')); ?></textarea>
                </div>
            </div>
        </div>
     	 </div>
    </div>
</div>