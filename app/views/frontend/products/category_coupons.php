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
                    <?php foreach ($categoryCoupons as $cate) : ?>
                    <li><a href="#" 
                        class="<?= isset($getRequest['id_cate']) && $getRequest['id_cate'] === $cate['id'] ? 'active' : '' ?>" 
                        data-name = "id_cate" 
                        data-value="<?= $cate['id'] ?>" ><?= $cate['name_cate'] . ' (' . (int) $cate['count'] . ')' ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="filter-products filter-data">
                <ul class="list-inline">
                    <li><label>Sắp xếp:</label></li>
                    <li><a href="#" data-name = "order_price" data-value="desc" class="btn btn-default <?= isset($getRequest['order_price']) ? 'active' : '' ?> ">Mới nhất</a></li>
                     <li><a href="#" data-name = "isHighlight" data-value="1" class="btn btn-default <?= isset($getRequest['isHighlight']) ? 'active' : '' ?>">Hot nhất</a></li>
                </ul>
            </div>
            <div class="list-coupons">
                <?php if (count($coupons) > 0) { ?>
                <?php $this->load->view('frontend/block/coupons', ['coupons' => $coupons]); ?>
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