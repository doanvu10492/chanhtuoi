<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="blog-list-page">   
    <section id="head-breadcrumb" >
        <div class="container">
            <div class="row">
                <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
            </div>
        </div>
    </section>
    <?php if ($cate_detail['description']) { ?>
    <div class="container" style="margin-bottom: 10px; margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <?= $cate_detail['description'] ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (count($list_posts)) : ?>
        <section id="box-guide">
            <div class="container">
                <div class="row">
                    <div class="col-cd-12">
                        <div class="title-h2 line-red">     
                            <h1><?= $cate_detail['name'] ?></h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php 
                    foreach ($list_posts as $row) :
                ?>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="guide-item">
                            <figure><a href="<?= $row['link']; ?>"><img src="<?= $row['img_thumb']; ?>"></a></figure>
                            <a href="<?= $row['link']; ?>">
                                <?= $row['name']; ?>
                            </a>
                            <p class="date"><?= $row['date']; ?></p>
                            <span></span>
                            <p class="brief"><?= $row['brief']; ?></p>
                        </div>
                    </div>
                <?php 
                    endforeach;
                ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </div>


</div>
</div>
</div>



