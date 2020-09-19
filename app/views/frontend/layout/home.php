<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="st-banner-register" class="bg-group-one">
    <div class="container">
        <div class="row">
             <div class="col-md-8 col-sm-8 col-xs-12">
                <?php $this->load->view('frontend/block/banner_top'); ?>
            </div>
            <div class="col-md-4 col-sm-2 col-xs-12">
                <div class="ads-home-page">
                <?php foreach ($adsHome as $ad) { ?>
                    <a href="<?= $ad['link_website'] ?>"><img data-src="<?= $ad['img'] ?>" class="img-responsive lazy"></a>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="hot-promo" class="cate-products-home">
    <div class="container">
        <div class="row">
            <div class="tab-categories">
                    <div class="cate-child list-inline">
                        <div class="left">
                            <a href="">Khuyến mãi hot</a>
                        </div>
                        <?php foreach ($cateOfHotProducts['cates'] as $cate) { ?>
                           <a href="<?= $cate['link'] ?>" class="btn btn-default btn-sm"><?= $cate['name'] ?></a>
                        <?php } ?>
                    </div>
                <a href="#" class="pull-right view-more">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="product-cate list-products">
            <?php $this->load->view('frontend/block/products', ['products' => $cateOfHotProducts['products']]); ?>
            </div>
        </div>
    </div>
</section>

<section id="best-seller" class="cate-products-home">
    <div class="container">
        <div class="row">
            <div class="tab-categories">
                <div class="cate-child list-inline">
                    <div class="left">
                        <a href="">Khuyến mãi hot</a>
                    </div>
                    <?php foreach ($cateOfHotProducts['cates'] as $cate) { ?>
                       <a href="<?= $cate['link'] ?>" class="btn btn-default btn-sm"><?= $cate['name'] ?></a>
                    <?php } ?>
                </div>
                <a href="#" class="pull-right view-more">Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="product-cate list-products">
                <?php $this->load->view('frontend/block/products', ['products' => $cateOfHotProducts['products']]); ?>
            </div>
        </div>
    </div>
</section>

<section id="latest-posts" class="cate-latest-posts">
    <div class="container">
        <div class="row">
            <div class="tab-categories">
                    <?php foreach ($highlightPostCategories['cates'] as $cate) { ?>
                         <li><a href="<?= $cate['link'] ?>"><?= $cate['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="post-cate list-posts">
            <div class="row">
                <?php $this->load->view('frontend/block/posts', ['posts' => $highlightPostCategories['posts']]) ?>
            </div>
        </div>
    </div>
</section>