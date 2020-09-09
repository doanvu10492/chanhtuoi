<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 
<div class="action-list-admin">
  <ul class="list-inline ">
  <li><a href="<?=site_url('admin/users/updated/0')?>"><i class="fa fa-plus" aria-hidden="true"></i>Thêm</a></li>
</ul>
</div>
<div class="box box-default">
  <div class="box-header with-border">
     <div class="box-search row">
      <form action="<?php echo admin_url('users')?>" method="get" enctype="multipart/form-data">
      <div class="col-md-3">
        <select name="group_id" class="form-control">
          <option value="">---Chọn vai trò---</option>
          <?php 
            foreach($groups as $group):
              $selected = isset($getRequest['group_id']) && $getRequest['group_id'] == $group->id ? 'selected' : ''; 
          ?>
            <option value="<?= $group->id ?>" <?= $selected ?> ><?= $group->description ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-3">   
        <input  name="username" type="text" placeholder="Nhập username" value="<?= isset($getRequest['username']) ?  $getRequest['username'] : '' ?>" class="form-control" />
      </div>
      <div class="col-md-3">   
        <input  name="email" type="text" placeholder="Nhập email" value="<?= isset($getRequest['email']) ?  $getRequest['email'] : '' ?>" class="form-control" />
      </div>
      <div class="col-md-2">   
          <input type="submit" class="submit blue-btn" value="Tìm kiếm" />
      </div>
      </form>
    </div>
    </div>

  <div class="box-header with-border">
  <h3 class="box-title">Sửa bài viết</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
 <div class="box-body table-responsive" id="list-pro">
  <div class="row">
    <div class="col-lg-12">
    <table class="table table-bordered table-hover" role="grid">
    <thead>
        <tr>
          <th></th>
          <th class="size_stt">STT</th>
          <th>Username</th>
          <th>Họ tên</th>
          <th>Vai trò</th>
          <th>Email</th>
          <th class="text-center nowrap">Trạng thái</th>
          <th class="th-action nowrap">Sửa || Xóa</th>
      </tr>
    </thead>

    <tbody>

      <?php 
        foreach ($users as $row) {
      ?>
    <tr>
      <td><input type="checkbox" name="checklist"  value="<?php echo $row->id ?>"></td>
      <td><?php echo $row->count; ?></td>
      <td><a class="title-article" href="<?=$row->link_update?>"> <?php echo $row->username; ?> </a></td>
       <td> <?php echo $row->full_name; ?> </td>
      <td> <?php echo $row->group_name; ?> </td>
      <td> <?php echo $row->email; ?> </td>
      <td>
        <a href="<?php echo $row->link_active; ?>" data-action='active' rel="<?php echo $row->active; ?>" class="btn-status glyphicon <?php echo $row->icon_active; ?>"> </a>
      </td>
      <td class="text-center">
              <a href="<?php echo $row->link_update; ?>" class="btn-action glyphicon glyphicon-pencil"> </a>
              <a href="<?php echo $row->link_delete; ?>" class="btn-action btn-del glyphicon glyphicon-trash"></a>
          </td>
    </tr>
    <?php } ?>
    </tbody>
  </table>

   <div class="box-pagination clearfix" id="example2_paginate">
      <?= (isset($pagination)) ? ($pagination) : (''); ?>
    </div>

    </div>
  </div>
</div>
</div> <!--end box body-->
