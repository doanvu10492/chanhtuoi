<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-default">
     <ul class="tabs clear list-inline" style="margin-bottom:10px; text-align: right;">
     	<li><a class="btn-backup" href="<?php echo admin_url('siteSettings/flushCache')?>"><i class="fa fa-folder-open"></i>Xóa cache</a></li>
		<li><a class="btn-backup" href="<?php echo admin_url('siteSettings/dbBackup')?>"><i class="fa fa-database"></i>Backup database</a></li>
	</ul>

    <div class="box-header with-border">
      <h3 class="box-title">Cấu hình website</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
	        <li class="active"><a href="#vi" data-toggle="tab" aria-expanded="true">Nội dung</a></li>
	        <li><a href="#logo" data-toggle="tab" aria-expanded="true">Logo - Banner</a></li>
	        <li style="display: none"><a href="#en" data-toggle="tab" aria-expanded="true">English</a></li>
	        <li class=""><a href="#social-network" data-toggle="tab" aria-expanded="false">Mạng xã hội</a></li>
	        <li class=""><a href="#smtp" data-toggle="tab" aria-expanded="false">Smtp</a></li>
	        <li class="" style="display: none"><a href="#popuptab" data-toggle="tab" aria-expanded="false">Popup và mã khuyến mãi</a></li>
	        <li><a href="#seoweb" data-toggle="tab" aria-expanded="false">Seo</a></li>
        </ul>
        <form action="<?php echo admin_url('siteSettings'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="tab-content">
	            <div class="tab-pane active" id="vi">
	            	<?php $this->load->view('admin/settings/tab_content') ?>
	            </div>
	            <div class="tab-pane" id="logo">
	            	<?php $this->load->view('admin/settings/tab_logo') ?>
	            </div>
	            <div class="tab-pane" id="smtp">
	            	<?php $this->load->view('admin/settings/tab_smtp') ?>
	            </div>
            	<div class="tab-pane" id="social-network">
           			<?php $this->load->view('admin/settings/tab_social_network') ?>
           		</div>
        		<div class="tab-pane" id="seoweb">
           			<?php $this->load->view('admin/settings/tab_seoweb') ?>
           		</div>
           	</div>
            <div class="form-group" style="margin-bottom: 20px">
                <label for="textfield" class="col-sm-2 control-label">&nbsp;</label>		
                <div class="col-sm-10">
					<input type="submit" class="submit blue-btn" value="Cập nhật thông tin website" name="siteSettings">
				</div>
			</div>
        </form>
    </div>
</div>
  
<script type="text/javascript"  language="javascript">
	CKEDITOR.replace('footer');
	CKEDITOR.replace('about');
	CKEDITOR.replace('product_text');
	CKEDITOR.replace('footer_en');
	CKEDITOR.replace('popup');
</script> 