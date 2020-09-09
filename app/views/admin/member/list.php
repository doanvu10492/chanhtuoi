<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<div class="action-list-admin">
     <ul class="list-inline ">
          <li><a href="<?=site_url('admin/member/updated/0')?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
     </ul>
</div>
<div class="box box-default">
    <div class="box-header with-border">
     <div class="box-search row">
      <form action="<?php echo admin_url('member')?>" method="get" enctype="multipart/form-data">
        <div class="col-md-3">   
          <input  name="username" type="text" placeholder="Nhập username" value="<?php if(isset($username)){echo $username; } else {echo '';}  ?>" class="form-control" />
        </div> 
        <div class="col-md-3">   
           <input  name="keyword" type="text" placeholder="Từ khóa" value="<?php if(isset($keyword)){echo $keyword; } else {echo '';}  ?>" class="form-control" />
        </div>
        <div class="col-md-2">   
            <input type="submit" class="submit blue-btn" value="Tìm kiếm" />
        </div>
      </form>
    </div>

   <?php //end box search ?>

    </div>

  <div class="box-header with-border">
    <h3 class="box-title">Sửa bài viết</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
 <div class="box-body" id="list-pro">
  <div class="row">
    <div class="col-lg-12">
    <table class="table table-bordered" role="grid">
    <thead>
        <tr>
          <th></th>
          <th class="size_stt">STT</th>
          <th>Username</th>
          <th>Họ tên</th>
          <th>Email</th>
          <!-- <th class="text-center">Trạng thái</th> -->
          <th class="th-action">Sửa || Xóa</th>
      </tr>
    </thead>

    <tbody>

      <?php 
          foreach ($users as $row)
        {
         
    ?>
    <tr>
      <td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
        <td><?php echo $row->count; ?></td>

      <td> <?php echo $row->username; ?> </td>

            <td> <?php echo $row->full_name; ?> </td>
      <td> <?php echo $row->email; ?> </td>
      <?php /*
      <td>
           <a href="<?php echo $row->link_active; ?>" data-action='active' rel="<?php echo $row->active; ?>" class="btn-status glyphicon <?php echo $row->icon_active; ?>"> </a>
      
      </td> */?>
      <td class="text-center">
              <a href="<?php echo $row->link_update; ?>" class="btn-action glyphicon glyphicon-pencil"> </a>
              <a href="<?php echo $row->link_delete; ?>" class="btn-action btn-del glyphicon glyphicon-trash"></a>
          </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>

   <div class="box-pagination clearfix" id="example2_paginate">
      <div class="action-table-quick pull-left">
           <input type="checkbox" name="checklist_box" id="check_all"> Check All | <a id="del-all" href="<?php echo admin_url('posts/del_list_choose'); ?>"><i class="fa fa-close"></i> Delete </a>
      </div>
      <?php echo(isset($pagination)) ? ($pagination) : (''); ?>
    </div>

    </div>
  </div>
</div>
</div> <!--end box body-->

