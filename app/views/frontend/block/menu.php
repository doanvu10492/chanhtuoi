<nav id="nav-top" class="menu-main margin0">
<div class="logo logo-mobile" style="display: none;" >
    <a href="./">
        <img src="<?= $this->config->item('logo') ?>" alt="<?php $this->config->item('site_title'); ?>" class="fadeInUp wow  animated" data-wow-delay="0.2s" data-wow-duration="2s">
    </a>
</div>
<div class="menu-button">
    <a class="toggleMenu" href="#">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
</div>
<ul data-breakpoint="989" class="flexnav">                  
    <?php 
        if(count($menu_top) > 0) : 
            foreach($menu_top as $menu) :
            $active = ($current_page == $menu['alias']) ? ('active') : ("");
    ?>
        <li class="<?= $active ?>">
            <a class="" href="<?=$menu['link']?>">
                <?=$menu['name']?>
            </a>
            <?php 
                if(isset($menu['child']) && count($menu['child'] > 0)) {
                    echo create_menu($menu['child'], $current_page);
                } 
            ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
</ul>

<!--search mobile-->

<div class="search-mobile" style="display: none">         
     <span class="search">
<a class="fa fa-search" id="search-fast" href="javascript:void(0)"></a>
</span>   
           <!---search-->           

<div class="header-search-wrap">
<div class="dropdown header-search">
<div class="td-drop-down-search" aria-labelledby="td-header-search-button">
    <?php $this->load->view('frontend/block/search'); ?>
    <div id="td-aj-search"></div>
</div>
</div>
</div>      
      
          
  </div>

</nav>