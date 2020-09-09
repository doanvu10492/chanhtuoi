<?php $this->load->view('admin/layout/header'); ?> 
  <!-- Left side column. contains the logo and sidebar -->
 <?php $this->load->view('admin/layout/sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo (isset($page_title) && $page_title != NULL) ? ($page_title) : ("Dashboard"); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	    <!-- notify error or success -->

		<?php //show error
			if($msg = $this->session->flashdata('error_message')):
    ?>
	    <div class="alert alert-danger alert-dismissible">
  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  			<p><i class="icon fa fa-ban"></i> Cảnh báo: <?=$msg?></p>
      </div>
	  <?php 
      endif;
      if($msg = $this->session->flashdata('flash_message')):
		?>
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<p><i class="icon fa fa-check"></i> Thông báo: <?=$msg?></p>
	  </div>
		<?php endif; ?>
    
    <?=$view_content?>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('admin/layout/footer');?>