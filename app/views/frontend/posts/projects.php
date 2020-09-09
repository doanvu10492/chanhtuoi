<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="projects-list-page">   
    <section id="header-catalog" class="breadcrumb-product" style="background: url(<?= $cate_detail['image']?>)" >
    <h1 class="title"><?= $cate_detail['name']?></h1>
    <?php// echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
    </section>
    <div class="container">  
        <div class="row">
        <?php 
            if (isset($cateProjects)) { 
               foreach ($cateProjects as $cate) {
                echo '<div class="cate-project">';
                echo '<h3><a href="'.$cate['link'].'">'.$cate['name'].'</a></h3>';
                    foreach ($cate['projects'] as $row){ 
        ?>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="project-item">
                    <div class="project-img">
                        <a href="<?= $row['link'] ?>">
                            <img src="<?= $row['img_thumb'] ?>" alt="<?= $row['name'] ?>" class="img-responsive">
                        </a>
                    </div>
                    <div class="project-name">
                        <a href="<?= $row['link'] ?>"><?= $row['name'] ?></a>
                    </div>
                </div>
            </div>
        <?php 
                  }

                  echo '<div class="text-center"><a href="'.$cate['link'].'"  class="view-more-product btn btn-default">'.__translate("viewmore").'</a></div>';

                  echo '</div>';
               }

               
            } else {
                foreach ($list_posts as $row){ 
        ?>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="project-item">
                    <div class="project-img">
                        <a href="<?= $row['link'] ?>">
                            <img src="<?= $row['img_thumb'] ?>" alt="<?= $row['name'] ?>" class="img-responsive">
                        </a>
                    </div>
                    <div class="project-name">
                        <a href="<?= $row['link'] ?>"><?= $row['name'] ?></a>
                    </div>
                </div>
            </div>

        <?php
                }//end foreach
            }
        ?>  
    </div>

</div>
</div>


</div>
</div>
</div>



