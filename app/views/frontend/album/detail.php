<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
 <div id="inspiration-page">
    <section id="head-breadcrumb" >
        <div class="container">
            <div class="row">
                <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-image">
                    <div class="header">
                        <h2 class="title"><?= $cate_detail['name'] ?></h2>

                        <p class="subtext"><?= $cate_detail['brief'] ?></p>
                    </div>

                    <img style="width: 100%" src="<?= $cate_detail['image'] ?>" class="img-responsive">
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="description">
                    
                </div>
            </div>
        </div>

                    <div class="row">

            <?php
              if(count($list_album) > 0){
                $i = 0;
                foreach($list_album as $row):
              ?>  
                                    <div class="col-sm-4 col-md-3 col-xs-6">
                        <div class="inspiration-image">
                            <a href="<?= $row['img'] ?>" rel="gallery" class="fancybox" >
                                <!-- <img src="./assets/img/layout/cross.png" class="cross"> -->
                                                                    <img src="<?= $row['img'] ?>" class="img-responsive">
                                                            </a>
                        </div>
                    </div>
             <?php endforeach; ?>
             <div id="pagination-pro"><?php echo $pagination ?></div>  
            <?php
              }else{
                echo '<p class="not-found-data">Không tìm thấy bài viết nào</p>';
              }
            ?>
                            
                            </div>
            </div>
</div>