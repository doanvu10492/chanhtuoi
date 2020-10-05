<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="head-breadcrumb">
  <div class="container">
    <div class="row">
      <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
    </div>
</div>
</section>
<section id="main-article">
<div class="container">
  <div class="row">
  <div class="col-md-12" id="blog-list-page">
    
    <div class="content article-item" style="position: relative;" >
      <div class="content-main">
        <article class="box-article-detail box-article-blog">
          <div class="title-h1">
            <h1><?=$detail['name']?></h1> 
          </div>

          <?php if ($detail['brief'] != ' '): ?>  
          <div class="brief">
            <?=$detail['brief']?>
          </div>
          <?php endif; ?>
          
          <div class="art-des"> 
           <?=$detail['description']?>
          </div>
        </article>
      </div>
    <!--end content detail -->
    </div>

    <?php if ($other_posts) { ?>
      <div id="related-posts">
        <!-- <h2>Các bài viết liên quan: </h2> -->
        <ul class="related-posts list-block">
          <?php foreach ($other_posts as $post) { ?>
          <li><a href="<?= $post['link'] ?>"><?= $post['name'] ?> <img src="./assets/img/layout/new.gif"></a></li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div>
</div>
</div>
</section>