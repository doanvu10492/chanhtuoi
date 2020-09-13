<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="blog-list-page">   
    <section id="head-breadcrumb" >
        <div class="container">
            <div class="row">
                <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
            </div>
        </div>
    </section>
    <?php if ($category['description']) { ?>
    <div class="container" style="margin-bottom: 10px; margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <?= $category['description'] ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (count($listPosts)) : ?>
        <section id="list-article">
            <div class="container">
                <div class="row">
                    <div class="col-cd-12">
                        <div class="title">     
                            <h1><?= $category['name'] ?></h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php 
                    foreach ($listPosts as $row) :
                ?>
                    <div class="post-item">
                        <figure><a href="<?= $row['link']; ?>"><img src="<?= $row['img_thumb']; ?>"></a></figure>
                        <a href="<?= $row['link']; ?>">
                            <?= $row['name']; ?>
                        </a>
                        <p class="date"><?= $row['date']; ?></p>
                        <span></span>
                        <p class="brief"><?= $row['brief']; ?></p>
                    </div>
                <?php 
                    endforeach;
                ?>
                </div>
                 <div class="pagination-link"><?php echo $pagination; ?></div>
            </div>
        </section>

        <?php endif; ?>
    </div>


</div>
</div>
</div>



