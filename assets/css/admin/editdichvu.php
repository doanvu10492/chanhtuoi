<?php $this->load->view('admin/header'); ?>
<script type="text/javascript" src="<?php echo base_url() ?>app/css/ckeditor/ckeditor.js"></script>
<div class="clear">
<?php $this->load->view('admin/sidebar'); ?>	
<div class="main"> <!-- *** mainkhuyenmai layout *** -->
	<div class="main-wrap">
		<div class="header clear">
			<ul class="links clear">
			<li><strong>Chào Admin :</strong></li>
			<li><a href="#"><img src="<?php echo base_url() ?>app/css/images/ico_enelope_24.png" alt="" class="icon" /> <span class="text">5 email</span></a></li>
			<li><a href="<?php echo base_url();?>" target="_blank"><img src="<?php echo base_url() ?>app/css/images/ico_view_24.png" alt="" class="icon" /> <span class="text">Xem trang</span></a></li>
			<li><a href="<?php echo admin_url('logout');?>"><img src="<?php echo base_url() ?>app/css/images/ico_logout_24.png" alt="" class="icon" /> <span class="text">Thoát</span></a></li>
			</ul>
		</div>
		<!-- Start of dichvu -->
         <?php
			//Show Flash Message
			if($msg = $this->session->flashdata('flash_message'))
			{
		?>
		
        <div class="notification note-success">
				<a href="#" class="close" title="Close notification"><span>close</span></a>
				<span class="icon"></span>
				<p><strong>Thông báo thành công:</strong> <?php echo $msg;?></p>
			</div>
        <?php 		
			}
	  	?>
        <?php 
							   if(isset($loi_img)){?>
                                <div class="notification note-error">
				<a href="#" class="close" title="Close notification"><span>close</span></a>
				<span class="icon"></span>
				<p><strong>Lỗi Upload hình ảnh:</strong> <?php echo $loi_img;?></p>
			</div>
								   
							<?php } 
							?>
		<div class="page clear">			
            <div class="content-box">
				<div class="box-header clear">
					<h2>Sửa trang</h2>
				</div>
				
				<div class="box-body clear">
					<!-- Custom Forms -->
					<div id="forms" style="display: block;">
						 <form action="<?php echo admin_url('quanlydichvu/editdichvu/'.$id_service); ?>" method="post" enctype="multipart/form-data">
                         <?php
	  	//Content of a group
		if(isset($dichvu) and $dichvu->num_rows()>0)
		{
			$dichvu = $dichvu->row();
	  ?>
                           <div class="form-field clear">
                            <label for="textfield" class="form-label2 fl-space2">Kích hoạt: </label>
                           <input type="checkbox"  name="trang_thai_page" value="1" <?php if(isset($dichvu->active)&& $dichvu->active == 1) echo 'checked="checked"'?>/>
          															
				           </div>
                         	<div class="form-field clear">
								<label for="textfield" class="form-label2 fl-space2">Tiêu đề: <span class="required">*</span></label>
                                <input class="text2 fl" type="text" name="name_service" value="<?php if(isset($dichvu->name_service)) echo $dichvu->name_service?>">
                                <font style="color:#B90004;"><?php echo form_error('name_service'); ?></font>
          					</div>
                            <div class="form-field clear">
								<label for="file" class="form-label2 fl-space2">Hình ảnh: <span class="required">*</span></label>
                                <?php if(isset($hinhanh_an)) {?>
                                <img src="<?php echo base_url().'app/css/images/dichvu/'.$hinhanh_an;?>" alt="" class="thumb size48" style="float:left">
                                <?php } else if(isset($dichvu->hinhanhdaidien)){?>
                                <img src="<?php echo base_url().'app/css/images/dichvu/'.$dichvu->hinhanhdaidien;?>" alt="" class="thumb size48" style="float:left">
								<input type="hidden" name="hinhanh_cu" value="<?php echo $dichvu->hinhanhdaidien?>"/>
								<?php }?>
								<input type="file" id="file" class="form-file fl" name="hinhanhdaidien">
                                <input type="hidden" name="hinhanh_an" value="<?php if(isset($hinhanh_an)) echo $hinhanh_an?>"/>
                               <font style="color:#B90004;"> <?php echo form_error('hinhanhdaidien'); ?></font>
							</div>
                            
                             <div class="form-field clear">
								<label for="textfield" class="form-label2 fl-space2">Danh mục : <span class="required">*</span></label>
                                <select name="id_cate_service">
                                	<option value="" >Chọn nhóm danh mục</option>
                                	<?php 
										$category_service = $this->db->query("SELECT * FROM category_service  WHERE active = 1 ");
										$list_cate = $category_service->result();
										$string ='';
										foreach($list_cate as $cate){
											if($cate->id_cate_service == $dichvu->id_cate_service){
												echo '<option selected="selected" value="'.$cate->id_cate_service.'">'.$cate->name_cate.'</option>';
											}else{
												echo '<option value="'.$cate->id_cate_service.'">'.$cate->name_cate.'</option>';
											}
											
										}
									?>
                                    
                                </select>
                                 <?php echo form_error('id_cate_service'); ?>
          							</div>
                            <div class="form-field clear">
								<label for="textarea" class="form-label2 fl-space2">Nội dung ngắn:<span class="required">*</span></label>
								<textarea id="textarea" class="form-textarea" cols="100" rows="6" name="noidung_tomtat"><?php  if(isset($dichvu->noidung_tomtat)) echo $dichvu->noidung_tomtat?></textarea><font style="color:#B90004;"><?php echo form_error('noidung_tomtat'); ?></font>
                                							</div>
                            
                            <div class="form-field clear">
								<label for="textarea" class="form-label2 fl-space2">Nội dung chính:<span class="required">*</span></label>
								<textarea id="noidungchinh" class="form-textarea" cols="100" rows="6" name="noidungchinh"><?php if(isset($dichvu->noidungchinh)) echo $dichvu->noidungchinh?></textarea>
                                 <script type="text/javascript"  language="javascript">
														var editor = CKEDITOR.replace('noidungchinh',{
															uiColor : '#9AB8F3',
															language:'vi',
															skin:'v2',
															filebrowserImageBrowseUrl : '<?php echo base_url() ?>app/css/ckfinder/ckfinder.html?Type=Images',
															filebrowserFlashBrowseUrl : '<?php echo base_url() ?>app/css/ckfinder/ckfinder.html?Type=Flash',
															filebrowserImageUploadUrl : '<?php echo base_url() ?>app/css/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
															filebrowserFlashUploadUrl : '<?php echo base_url() ?>app/css/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
																			
															toolbar:[
															['Source','-','Save','NewPage','Preview','-','Templates'],
															['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
															['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
															['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
															['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
															['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
															['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
															['Link','Unlink','Anchor'],
															['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
															['Styles','Format','Font','FontSize'],
															['TextColor','BGColor'],
															['Maximize', 'ShowBlocks','-','About']
															]
														});		
								</script> <font style="color:#B90004;"><?php echo form_error('noidungchinh'); ?></font>
                                							</div>
                           
                           
                          
                            <!-- /.form-field -->
                         <?php // end for edit tin 
		}
						 ?>
                         <div class="form-field clear">
								<label for="textarea" class="form-label2 fl-space2">Meta Keywords:<span class="required">*</span></label>
								<textarea id="textarea" class="form-textarea" cols="100" rows="6" name="meta_keywords"><?php  if(isset($dichvu->meta_keywords)) echo $dichvu->meta_keywords?></textarea><font style="color:#B90004;"><?php echo form_error('meta_keywords'); ?></font>
                                							</div>
                            <div class="form-field clear">
								<label for="textarea" class="form-label2 fl-space2">Meta Description:<span class="required">*</span></label>
								<textarea id="textarea" class="form-textarea" cols="100" rows="6" name="meta_description"><?php if(isset($dichvu->meta_description)) echo $dichvu->meta_description?></textarea><font style="color:#B90004;"><?php echo form_error('meta_description'); ?></font>
                                							</div>
							<div class="form-field clear">
                            <label for="textfield" class="form-label2 fl-space2">&nbsp;</label><br/>
								<input type="submit" class="submit fl" value="Sửa" name="editdichvu">
							</div><!-- /.form-field -->																								
						</form>
					</div><!-- /#forms -->
				</div> <!-- end of box-body -->
			</div>
		</div>
        <!-- end of khuyenmai -->
		
<?php $this->load->view('admin/footer'); ?>	
