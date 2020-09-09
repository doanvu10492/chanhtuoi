<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="st-banner-register" class="bg-group-one">
    <div class="container">
        <div class="row">
             <div class="col-md-9 col-sm-8 col-xs-12">
                <?php $this->load->view('frontend/block/banner_top'); ?>
            </div>
            <div class="col-md-3 col-sm-2 col-xs-12">
                <?php $this->load->view('frontend/block/register_form'); ?>
            </div>
        </div>
    </div>
</section>
<?php if ($eightRoundInRegister) :  ?>
<section id="eight-round" class="bg-group-one">
    <div class="container">
        <div class="row">
            <div class="eight-round-header">
                <h2><?= $eightRoundInRegister['name'] ?></h2>
                <p><?= $eightRoundInRegister['brief'] ?></p>
            </div>
            <div class="eight-roud-content">
                <ul class="list-inline">
                    <?php foreach ($eightRoundInRegister['posts'] as $post) : ?>
                    <li><a href="<?= $post['link'] ?>"><?= $post['name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($trainingTypes) : ?>
<section id="traning-types" class="bg-group-one">
     <div class="container">
        <div class="row">
            <div class="traning-types-header">
                <h2><?= $trainingTypes['name'] ?></h2>
            </div>
            <?php foreach ($trainingTypes['posts'] as $train) : ?>
                <div class="col-md-3 col-xs-6">
                    <div class="train">
                        <figure><a href="<?= $train['link']; ?>">
                        <img class="lazy" data-src="<?= $train['img_thumb']; ?>" atl="<?= $train['name']; ?>"></a></figure>
                        <a href="<?= $train['link'] ?>"><?= $train['name'] ?></a>
                        <div class="train-bottom">
                            <a href="<?= $train['link']; ?>">Chi tiết</a>
                            <a href="<?= $train['file'] ? $train['file'] : '#'; ?>" <?= $train['file'] ? 'download' : ''; ?>>File download đơn đăng ký học</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section id="study-register" class="bg-group-two">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <?php $this->load->view('frontend/block/study_register') ?>
            </div>
            <div class="col-md-8 col-sm-8">
                <div class="training-ads">
                    <p>Lịch khai giảng các khóa học <br> tại các cơ sở của trung tâm</p>
                    <h4>Thành công</h4>
                    <span class="line text-center">
                        <img src="<?= base_url() ?>assets/img/layout/line.PNG">
                    </span>
                    <a class="btn-a" href="./xem-lich-khai-giang">Xem ngay <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ($fourCategories) : ?>
<section id="four-cat" class="bg-group-two">
     <div class="container">
        <div class="row">
        <?php foreach ($fourCategories as $catePost) { ?>
            <div class="col-md-3  col-sm-6 col-xs-12">
                <div class="four-cat-header">
                    <h3><a href="<?= $catePost['link']; ?>"><?= $catePost['name'] ?></a></h3>
                </div>
                <?php 
                    $i = 0;
                        foreach ($catePost['posts'] as $post) :
                            if ($i==0) {
                                $i++;
                    ?>
                    <div class="cat-post">
                        <figure><a href="<?= $post['link']; ?>">
                        <img class="lazy" data-src="<?= $post['img_thumb']; ?>" atl="<?= $post['name']; ?>"></a></figure>
                        <a href="<?= $post['link'] ?>"><?= $post['name'] ?></a>
                    </div>
                <?php
                        } else {
                ?>
                            <a href="<?= $post['link'] ?>" class="post-link-hl"> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
 <?= $post['name'] ?></a>
                <?php
                        } 
                    endforeach; 
                ?>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (count($partner)) : ?>
<section id="partner" class="bg-group-two">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-h2">
                    <h2>Đối tác</h2> 
                </div> 
                <div class="slider-partner">
                    <div class="navslider">
                        <a class="prev fa" href="#"></a> 
                        <a class="next fa" href="#"></a>
                    </div>
                    <div class="noo-blog-slider inner owl-carousel owl-theme" id="list-partner" >
                    <?php 
                        $i=0; 
                        foreach($partner as $row):
                    ?> 
                        <div class="partner-item">
                            <a href="javascript:void(0)">
                                <img class="lazy" data-src="<?= $row['img_thumb']; ?>" atl="<?= $row['name']; ?>">
                            </a>
                        </div>
                    <?php 
                        endforeach; 
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>