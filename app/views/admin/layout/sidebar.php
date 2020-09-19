<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="name-website">
            <?=$this->config->item('site_title')?>
        </div>
        <!-- search form -->
        <form action="<?=admin_url('posts/index')?>" method="get" enctype="multipart/form-data" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm bài viết...">
                <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
            </div>
        </form>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="treeview <?php echo ($currentPage == 'site_settings') ? ('active') : (''); ?>">
                <?php if (adminRoleName() != 'manage_store' && adminRoleName() != 'accountant') { ?>
                <a href="<?=admin_url('siteSettings')?>">
      <i class="fa fa-share"></i> <span>Cấu hình</span>
    </a>
            </li>
            <li class="<?php echo ($currentPage == 'users') ? ('active') : (''); ?>">
                <a href="<?=admin_url('users')?>">
      <i class="fa fa-th"></i> <span>Quản trị - Thành viên</span>
      
    </a>
            </li>
            <li class="treeview <?php echo ($currentPage == 'posts') ? ('active') : (''); ?>">
                <a href="#">
      <i class="fa fa-share"></i> <span>Bài viết</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($subPage == 'posts') ? ('active') : (''); ?>"><a href="<?=admin_url('posts')?>"><i class="fa fa-circle-o"></i>Danh sách bài viết</a></li>
                    <li class="<?php echo ($subPage == 'category_posts') ? ('active') : (''); ?>">
                        <a href="<?=admin_url('category_posts')?>"><i class="fa fa-circle-o"></i>  Danh sách danh mục
        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php echo ($currentPage == 'list_products') ? ('active') : (''); ?>">
                <a href="#">
        <i class="fa fa-share"></i> <span>Sản phẩm</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo admin_url('products/list_products');?>"><i class="fa fa-circle-o"></i>Danh sách sản phẩm</a></li>
                    <li class="<?php echo ($subPage == 'cate1') ? ('active') : (''); ?>">
                        <a href="<?php echo admin_url('category_products');?>"><i class="fa fa-circle-o"></i>  Danh mục sản phẩm
          </a>
                    </li>
                </ul>
            </li>

            <li class="treeview <?php echo ($currentPage == 'list_products') ? ('active') : (''); ?>">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Mã sản phẩm</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo admin_url('coupon/list_products');?>"><i class="fa fa-circle-o"></i>Danh sách mã sản phẩm</a></li>
                    <li class="<?php echo ($subPage == 'cate1') ? ('active') : (''); ?>">
                        <a href="<?php echo admin_url('category_coupon');?>"><i class="fa fa-circle-o"></i>  Danh mục mã sản phẩm
          </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($currentPage == 'list_pages') ? ('active') : (''); ?>" style="display: none">
                <a href="<?=admin_url('pages')?>">
      <i class="fa fa-th"></i> <span>Bài viết đơn</span>
    </a>
            </li>

            <li class="treeview <?php echo ($currentPage == 'album') ? ('active') : (''); ?>">
                <a href="#">
            <i class="fa fa-share"></i> <span>Thư viện ảnh </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($subPage == 'album') ? ('active') : (''); ?>"><a href="<?=admin_url('album')?>"><i class="fa fa-circle-o"></i>Danh sách bài viết</a></li>
                    <li class="<?php echo ($subPage == 'category_album') ? ('active') : (''); ?>">
                        <a href="<?=admin_url('category_album')?>"><i class="fa fa-circle-o"></i>  Danh sách danh mục
              </a>
                    </li>
                </ul>
            </li>
            <li class="treeview <?php echo ($currentPage == 'member') ? ('active') : (''); ?>">
                <a href="#">
    <i class="fa fa-share"></i> <span>Thông tin giáo viên</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo admin_url('member');?>">
          <i class="fa fa-circle-o"></i>Danh sách
      </a>
                    </li>
                </ul>
            </li>
            <?php /*
  <li class="<?php echo ($currentPage == 'contact') ? ('active') : (''); ?>">
            <a href="<?=admin_url('contact')?>">
      <i class="fa fa-th"></i> <span>Email</span>
      <span class="pull-right-container">
        <small class="label pull-right bg-green"></small>
      </span>
    </a>
            </li>
            */?>
            <li class="<?php echo ($currentPage == 'slide') ? ('active') : (''); ?>">
                <a href="<?=admin_url('slide')?>">
        <i class="fa fa-th"></i> <span>Slider</span>
      
      </a>
            </li>
            <?php } ?>
            <li class="<?= ($currentPage == 'student') ? ('active') : (''); ?>">
                <a href="<?= admin_url('student')?>">
        <i class="fa fa-th"></i> <span>Quản lý học viên</span>
      </a>
            </li>
            <?php if (adminRoleName() != 'manage_store' && adminRoleName() != 'accountant') { ?>
            <li class="<?= ($currentPage == 'opening_schedule') ? ('active') : (''); ?>">
                <a href="<?= admin_url('opening_schedule')?>">
        <i class="fa fa-th"></i> <span>Quản lý lịch khai giảng</span>
      </a>
            </li>
            <li class="treeview <?php echo ($currentPage == 'categories') ? ('active') : (''); ?>">
                <a href="#">
        <i class="fa fa-share"></i> <span>Quản lý danh mục</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
                <ul class="treeview-menu">
                    <li class="<?php echo ($subPage == 'degree') ? ('active') : (''); ?>"><a href="<?=admin_url('degree')?>"><i class="fa fa-circle-o"></i>Hạng xe</a></li>
                    <li class="<?php echo ($subPage == 'address') ? ('active') : (''); ?>">
                        <a href="<?=admin_url('address')?>"><i class="fa fa-circle-o"></i> Địa chỉ</a>
                    </li>
                    <li class="<?php echo ($subPage == 'course') ? ('active') : (''); ?>">
                        <a href="<?=admin_url('course')?>"><i class="fa fa-circle-o"></i> Mã khóa</a>
                    </li>
                    <li class="<?php echo ($subPage == 'schedule') ? ('active') : (''); ?>">
                        <a href="<?=admin_url('schedule')?>"><i class="fa fa-circle-o"></i>Khai giảng </a>
                    </li>
                    <li class="<?php echo ($subPage == 'car') ? ('active') : (''); ?>">
                        <a href="<?=admin_url('car')?>"><i class="fa fa-circle-o"></i> Xe học </a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($currentPage == 'menu') ? ('active') : (''); ?>">
                <a href="<?php echo admin_url('menu'); ?>">
            <i class="fa fa-th"></i> <span>Menu website</span>
            
          </a>
            </li>
            <?php } ?>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>