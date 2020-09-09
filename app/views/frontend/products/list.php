<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="s-product-list" >
    <section id="head-breadcrumb" >
        <div class="container">
            <div class="row">
                <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
            </div>
        </div>
    </section>
    <section id="result-search">
        <div class="container">
            <?php 
                if(isset($keyword)) { 
            ?>
                <div class="result-search">
                    <p><strong>Kết quả tìm kiếm: </strong>tìm thấy 
                        <b><?php echo $total_products ?></b> kết quả phù hợp với từ khóa <b>"<?php echo $keyword; ?>"</b> 
                    </p>
                    
                </div>
            <?php 
                } else {
                    if( isset($cate_child) && count ($cate_child) > 0) {
            ?>
                <ul class="list-inline list-cate-child">
                    <?php foreach( $cate_child[0]['cate_child'] as $cate): ?>
                    <li><a href="<?= $cate['link'] ?>"><?= $cate['name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php        
                    }     
                } 
            ?>
        </div>
    </section>
<div class="container">

  <div class="row">

<div id="box-list-product">


<div class="list-products products-overview row clearfix">
    <div class="container">
    <div class="list-product">
        <div class="row block-filter">
            <div class="col-xs-12">
                <div class="filter-products">
                    <ul class="list-inline">
                        <li><label>Sắp xếp theo :</label></li>
                        <li><a href="tim-kiem?order_price=">Mới nhất</a></li>
                        <li><a href="tim-kiem?order_price=desc">Giá giảm dần</a></li>
                        <li><a href="tim-kiem?order_price=asc">Giá tăng dần</a></li>
                        <li><a href="tim-kiem?isSale=1">Khuyến mãi</a></li>
                         <li><a href="tim-kiem?isHighlight=1">Bán chạy</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if(isset($category) && count($category) > 0 ) { ?> 
            <h1 style="display: none"><?php echo $category['name']; ?></h1>
        <?php } ?>

        <?php 
            if (count($list_products) > 0) {
                foreach ( $list_products as $item ): 
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12 col-product">
            <div class="product-item">
                <figure>
                    <a href="<?= $item['link']; ?>"><img class="lazy" data-src="<?= $item['img_thumb']; ?>" atl="<?= $item['name']; ?>">
                    <?php if ($item['percent_promo']) { ?>
                            <i class="percent-promo">
                                -<?= $item['percent_promo']; ?>%
                            </i>
                        <?php } ?>
                    </a>
                    <div class="block-info">
                        <a href="#" 
                            class="fa fa-shopping-cart add-to-cart" 
                            data-id="<?= $item['id']; ?>" 
                            data-active = "1"
                            data-name = "<?= $item['name']; ?>"
                            data-qty = "1"
                            data-price = "<?= $item['price']; ?>">
                        </a>
                        <a class="fa fa-eye" href="<?= $item['link']; ?>"></a>
                    </div>
                </figure>
                <div class="pd-info">
                    <a href="<?= $item['link']; ?>" class="title">
                        <?= $item['name']; ?>
                    </a>
                     <p>
                        <span class="price"><?= number_format($item['price']); ?>đ</span>
                        <?php if ($item['price_old']) : ?>
                            <span class="price-old"><?= number_format($item['price_old']); ?>đ</span>
                        <?php endif; ?> 
                    </p>
                </div>
            </div>
        </div>
            
        <?php 
                endforeach; 
            } else {
                echo '<div class="not-found"> Không tìm thấy bài viết nào ! </div>';
            }
        ?>
      <div class="pagination-link"><?php echo $pagination; ?></div>
  </div>

</div>
</div>
</div>

</div>
</div>
<script type="text/javascript">
    
$(document).ready(function(){
    $('#action-list a').click(function(e){
        $("#action-list a").removeClass('active');
        $(this).addClass('active');
        if($(this).find('i').hasClass('fa-list-ul')){
            $(this).closest('.list-product').addClass("list-product-row");
        }else{
            $(this).closest('.list-product').removeClass("list-product-row");
        }
    });
});

</script>
</section>
