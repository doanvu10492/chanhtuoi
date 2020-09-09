<?php
  if(count($other_products) > 0) {
?>
<div class="list-product" id="rv-orther">
<div class="container">
<div class="row">
<h3><?= __translate('Sản phẩm liên quan'); ?></h3>
<div class="list-view clearfix">
    <div class="noo-blog-slider  owl-carousel owl-theme" id="product-hot" >
    <?php 
        $deplay = 0.1;
        foreach ($other_products as $item)
        {
    ?>
        <div class="product-item">
            <figure>
                <a href=""><img src="<?= $item['img_thumb']; ?>"></a>
                <div class="block-info">
                    <a href="<?= $item['link']; ?>" class="fa fa-shopping-cart" data-id="<?= $item['id']; ?>" data-active = "1" class="add_cart"></a>
                    <a class="fa fa-eye quick-view" href="./product-add-cart/<?= $item['id']?>"></a>
                </div>
            </figure>
            <div class="pd-info">
                <a href="<?= $item['link']; ?>" class="title">
                    <?= $item['name']; ?>
                </a>
                <p><span class="price"><?= $item['price']; ?>đ</span><span class="price-old">750,000đ</span> </p>
            </div>
        </div>
    <?php 
        } 
    ?>

    </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    $("#product-hot").owlCarousel({
    items:4,
    nav:true,
    loop: true,
    dots: false,
    navClass: ['btn btn-default owl-carousel-left disabled','btn btn-default owl-carousel-right'],
    navText: ['<i class="glyphicon glyphicon-chevron-left""></i>', '<i class="glyphicon glyphicon-chevron-right"></i>'],
    responsive: {0: {items: 1 }, 600: {items: 3 }, 1000: {items: 4 } },
    });  
</script> 

<?php     
    } //count row products 
?>