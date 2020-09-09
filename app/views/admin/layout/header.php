<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo (isset($pageTitle)) ? ($pageTitle) : ($this->config->item('site_tile')); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <base href="<?php echo base_url(); ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="./assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./assets/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="./assets/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="./assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="./assets/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="./assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!--screen on site-->
  <link rel="stylesheet" href="./assets/css/admin/screen.css?v=<?= strtotime( date('H:i:s') ); ?>">
  <!-- jQuery 2.2.3 -->
  <script src="./assets/plugins/jQuery/jquery-2.2.3.min.js"></script>

  <script type="text/javascript" src="<?=base_url()?>assets/ckeditor/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/ckeditor/ckfinder/ckfinder.js"></script>
  <script type="text/javascript">
 $(document).ready(function(e) {
      $('.fileBrowse').bind('click', function() {
      
      var finder = new CKFinder();
      var target = $(this).attr('data-target');
      finder.selectActionFunction = function(fileUrl, data)
      {
        document.getElementById(target).value = fileUrl;
      }
      finder.popup();
    });
    
   });
</script>

<script type="text/javascript">
$(document).ready(function() {
  $("#list-pro button.btn-accountant").on('click',function(event) {
      event.preventDefault();
      active = $(this).attr('rel');
      action = $(this).attr('data-action');
      
      ms = $(this);
      $.ajax({
          'type' : 'POST',
          'url'  : ms.attr('href'),
          'data' : {'active' : active, 'action' : action},
          success: function(data){
              result = JSON.parse(data);

              if(result.result) {
                ms.empty().html(result.result);
                // change status and assign value
                ms.attr('rel', result.num);
                if ( result.num) {
                  ms.addClass('success');
                } else {
                  ms.removeClass('success');
                }
              } else {
                alert("Bài viết này không tồn tại !");
              }
          }
      });
  });

   $("#list-pro button.btn-result").on('click',function(event) {
      event.preventDefault();
      active = $(this).attr('rel');
      action = $(this).attr('data-action');
      
      ms = $(this);
      $.ajax({
          'type' : 'POST',
          'url'  : ms.attr('href'),
          'data' : {'active' : active, 'action' : action},
          success: function(data){
              result = JSON.parse(data);

              if(result.result) {
                ms.empty().html(result.message);
                // change status and assign value
                ms.attr('rel', result.result);
                if ( result.result) {
                  ms.addClass('success');
                } else {
                  ms.removeClass('success');
                }
              } else {
                alert("Bài viết này không tồn tại !");
              }
          }
      });
  });

  $('#check_all').on('click', function() {
    var checklist = document.getElementsByName('checklist');

      if ($('#check_all').is(':checked')) {

        for (var i=0; i<checklist.length; i++) {
          checklist[i].checked = true;
        }
      } else {
        for (var i=0; i<checklist.length; i++) {
          checklist[i].checked = false;
        }
      }

  });
     
});
</script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?=admin_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Amin</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <?php /*<li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
             
            </a>
          </li> */?>

          <li class="header"><a href="./" title="Trang chủ"><i class="fa fa-home"></i></a></li>

          <li class="header"><a href="<?=admin_url('users/logout')?>" title="logout" ><i class="fa fa-sign-out"></i></a></li>

        </ul>
      </div>
    </nav>
  </header>