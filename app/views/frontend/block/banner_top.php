<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
  $slider = $this->sidebar_model->slider();
  if ($slider) { 
?>
<div id="home-page-slider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php  
        $i = 0;
        foreach ($slider as $row) {
    ?>
        <li data-target="#home-page-slider" data-slide-to="<?= $i ?>" <?=  !$i ? 'class="active"' : ''; ?>></li>
    <?php $i++; } ?>
    </ol>
        <div class="carousel-inner">
        <?php  
            $i = 0;
            foreach ($slider as $row) {
        ?>
            <div class="item <?= ($i==0) ? ('active') : ("") ?> " >
                <div class="<?= ($i%2==0) ? ('left') : ('right') ?> ">
                    <img src="<?= $row['image']; ?>" alt="" class="img-responsive header-image">
                </div>
                <a href="<?= $row['link'] ?>" class="transition-1">Xem chi tiết</a>
            </div>
    <?php $i++; } ?>
</div>
 <!-- <a class="left carousel-control" href="#home-page-slider" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#home-page-slider" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>  -->
    </div>
<?php } ?>
<div class="container help">
</div>