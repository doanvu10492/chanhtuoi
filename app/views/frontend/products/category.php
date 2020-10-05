<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<section id="head-breadcrumb" >
    <div class="container">
        <div class="row">
            <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
        </div>
    </div>
</section>
<div class="container coupons-container">
    <div class="head-content">
        <?= $category['head_content']; ?>
    </div>
    <section id="header-coupons">
            
            <?php if (isset($category) && count($category) > 0 ) : ?> 
                <h1><?= $category['name']; ?></h1>
            <?php endif; ?>
    </section>
    <section id="coupons-content">
        
            <div class="block-filter-coupons filter-data">
                <ul class="list-inline">
                    <li><a href="#" class="<?= isset($getRequest['id_cate']) ? '' : 'active' ?>"  data-name = "id_cate" data-value="">Tất cả</a></li>
                </ul>
            </div>
            <div class="list-coupons">
                <?php if (count($categoryCoupons) > 0) { ?>
                    <?php $this->load->view('frontend/block/cate_coupons', ['categories' => $categoryCoupons]); ?>
                <?php } else { ?>
                    <div class="not-found"> Không tìm thấy mã coupon nào ! </div>
                <?php } ?>
            </div>
            <div class="pagination-link"><?= $pagination; ?></div>
            <div class="discription">
                <?= $category['description']; ?>
            </div>
    </section>
</div>