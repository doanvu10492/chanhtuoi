<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section id="head-breadcrumb" >
    <div class="container">
        <div class="row">
            <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
        </div>
    </div>
</section>
<section id="header-coupons">
    <div class="container">
        <div class="discription">
            <?= $category['description']; ?>
        </div>
        <?php if (isset($category) && count($category) > 0 ) : ?> 
            <h1><?= $category['name']; ?></h1>
        <?php endif; ?>
    </div>
</section>
<section id="coupons-content">
    <div class="container">
        <div class="block-filter">
            <div class="col-xs-12">
                <div class="filter-coupons list-inline">
                    <a href="">Tất cả</a>
                    <?php foreach ($categoryCoupons as $cate) : ?>
                        <a href="javascript:void(0)" data-cate_id = "<?= $cate['id'] ?>"><?= $cate['name_cate'] . '(' . (int) $cate['count'] . ')' ?></a>
                    <?php endforeach; ?> 
                </div>
            </div>
        </div>
        <div class="list-coupons">
            <?php if (count($list_products) > 0) { ?>
            <?php $this->load->view('frontend/block/coupons', ['products' => $list_products]); ?>
            <?php } else { ?>
                <div class="not-found"> Không tìm thấy bài viết nào ! </div>
            <?php } ?>
          <div class="pagination-link"><?= $pagination; ?></div>
        </div>
    </div>
</section>
