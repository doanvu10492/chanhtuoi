<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>  
<div class="pro-detail" id="prd-content" style="padding-top: 0; ">
<style type="text/css">
    #prd-content table {
    max-width: 100%;
    border: 1px solid #cacaca;
}

#prd-content table td, #prd-content table th {
    border: 1px solid #ddd;
    padding: 6px;
}
</style> 
<section id="head-breadcrumb">
    <div class="container">
        <div class="row">
            <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
    </div>
</section>
<div class="container">
<link rel="stylesheet" href="./assets/css/smoothproducts.css" />
<script src="./assets/js/smoothproducts.js"></script>

<div class="row">
  <div>
    <div>
      <div class="col-sm-5 col-xs-12">
        <div class="img-product-detail img-product">
        <?php 
          if( count($detail['products_img_detail']) > 0 ) {
        ?>
          <div class="sp-wrap">
            <?php foreach( $detail['products_img_detail'] as $row) : ?>
                <a href="<?=$row['img']?>" >
                  <img src="<?=$row['img']?>" alt="<?=$detail['name']?>" />
                   <i class="fa fa-search-plus" aria-hidden="true"></i>
                </a>
              <?php endforeach; ?>
          </div>
    
        <?php
          } else {
        ?>
        <div class="full-width">
          <div class="sp-wrap">
            <a href="<?=$detail['img']?>"  >
              <img src="<?=$detail['img']?>" alt="<?=$detail['name']?>" />
               <i class="fa fa-search-plus" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <?php  } ?>
    </div>
  </div>

  <div class="col-md-4 col-sm-4 clearfix clearfix-responsive " >
    <div class="product-brief" >
      <h3>MÔ TẢ SẢN PHẨM</h3>
      <?=$detail['description'] ?>
    </div>
  </div>

  <div class="col-sm-3 clear-both">
     <div class="infor-prod">
          <h1><?=$detail['name'] ?></h1>
          
          <p>Mã sản phẩm: <?=$detail['code'] ?></p>
          <div class="pd-price">
              
              <p class=""><span>Giá: </span>
                  <?php if ($detail['price'] > 0) { ?>
                  <?php if ($detail['price_old']): ?>
                      <span class="price-old"><?= number_format($detail['price_old']) ?>đ</span>
                  <?php endif; ?>
                              <strong><?= number_format($detail['price']) ?></strong>đ
                  <?php } else { ?>
                      Giá liên hệ
                  <?php } ?>
              </p>
          </div>
          <div class="product-tw">
            <?= $this->config->item('product_text') ?>
          </div>
          <?php if ($detail['price'] > 0) { ?>
          <form class="form-inline" method="POST" action="./gio-hang" id="cart-submit-detail">
            <input type="hidden" name="name" value="<?= $detail['name'] ?>">
            <input type="hidden" name="price" value="<?= $detail['price'] ?>">
            <input type="hidden" name="id" value="<?= $detail['id'] ?>">
            <input type="hidden" name="checkout">
            <?php if ($listColor = explode(',', $detail['color'])) { ?>
              <input type="hidden" name="choose_color" value="1">
              <p>CHỌN MÀU: </p>
              <div class="product-option-color list-inline">
                <?php foreach($listColor as $color) : ?>
                <label class="lb_size_gs" title="XS">
                    <input name="color" class="input-color" value="<?= $color ?>" type="radio" title="<?= $color ?>" >
                    <span class="product-color">
                      <?= $color ?>
                    </span>
                </label>
              <?php endforeach; ?>
                <p class="color-error error">
                </p>
              </div>
            <?php } ?>

            <?php $listSize = explode(',', $detail['size']); ?>  
            <?php if ($detail['size'] && count($listSize)) { ?> 
              <input type="hidden" name="choose_size" value="1">
            <div id="chooose-size">
              <p>CHỌN SIZE:</p>
              <ul class="clearfix list-inline product-option-size">
                <li name="content_id2">
               
                  <?php foreach($listSize as $size) { ?> 
                  <label class="lb_size_gs" title="<?= $size ?>">
                      <input name="size" class="input-size" value="<?= $size ?>" type="radio" title="<?= $size ?>">
                      <span class="product-size">
                          <?= $size ?>
                      </span>
                  </label>
                   <?php } ?>
                </li>
                </ul>
                <p class="size-error error">
                </p>
              </div>
              
                <?php } ?>

              <div class="product-number-input">
                <p>SỐ LƯỢNG:</p>

                <div class="input-group bootstrap-touchspin">
                  <span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button">-</button></span>
                  <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>

                  <input id="qty" type="number" name="qty" value="1" min="1" class="form-control" style="display: block;">

                  <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button">+</button>
                  </span>
                </div>
              </div>

              <a href="#" id="add_to_cart" class="add_to_cart hidden-btn-add">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>Thêm Vào Giỏ hàng 
              </a>

            <a href="cart.html" class="add_cart btn buy-now"  data-name="<?= $detail['name']; ?>" data-id="<?= $detail['id']; ?>" data-price="<?= $detail['price']; ?>" data-qty="1" >
              <span class="fs_medium">Mua ngay</span>
            </a>
          <?php } else { ?>
              <a href="lien-he.html" style="display: inline-block; margin-top: 10px" class=" btn btn-contact"   >
             <span class="fs_medium">Liên hệ</span>
          </a>
          <?php } ?>
          </form>
     </div>
  </div>
</div>

    <div id="tab-product-detail" style="clear: both;">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Mô tả sản phẩm</a></li>
                <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false">Thông tin chi tiết</a></li>
            </ul> 
        </div>
         <div class="tab-content">
             <div class="tab-pane active" id="tab1">
                <?= $detail['info_detail']; ?>
             </div>
             <div class="tab-pane" id="tab2">
                 <?= $detail['download']; ?>
             </div>
        </div>
    </div>

<?php
/*
** OTHER PRODUCTS
*/
if(count($other_products) > 0){
?>
<section id="other-product" class="row">
<div id="samples-page"  class="box-other-product list-products-t1 list-products list-normal-product">
    <h3><?= __translate('Sản phẩm liên quan'); ?></h3>
    
    <div class="other-product">
                          
        <div class="other-product-slider line-boder-slider ">
            
        <div class="navslider">
            <a class="prev fa" href="#"></a> 
            <a class="next fa" href="#"></a>
        </div>
        <div class="noo-blog-slider inner owl-carousel owl-theme" id="list-other-product" >
        
          <?php 
            if (isset($other_products) && count($other_products) > 0)
            {
                $i = 0;
                foreach($other_products as $item)
                {
            ?>
                <div class="product-item">
                    <figure>
                        <a href="<?= $item['link']; ?>"><img class="lazy" data-src="<?= $item['img_thumb']; ?>" atl="<?= $item['name']; ?>">
                        <?php if ($item['percent_promo']) { ?>
                          <i class="percent-promo">
                            -<?= $item['percent_promo']; ?>%
                          </i>
                        <?php } ?></a>
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
        <?php } 
        
            }
        ?>
    </div>

    </div>
    </div>

    <script type="text/javascript">
        $("#list-other-product").owlCarousel({
            items:7,
            nav:true,
            loop: true,
            autoPlay : 5000,
            itemsCustom:[ 
            [0, 1], 
            [480, 2], 
            [768, 3], 
            [992, 4], 
            [1200, 4] 
            ],
            pagination: false,
            slideSpeed : 800,
            addClassActive: true,  
            afterAction: function (e) {
            if(this.$owlItems.length > this.options.items){
            $('.other-product-slider .navslider').show();
            }else{
            $('.other-product-slider .navslider').hide();
            }
            }            
            });
            $('.other-product-slider .navslider .prev').on('click', function(e){
            e.preventDefault();
            $('.other-product-slider .inner').trigger('owl.prev');
            });

            $('.other-product-slider .navslider .next').on('click', function(e){
            e.preventDefault();
            $('.other-product-slider .inner').trigger('owl.next');
        });
    </script>
</div>
</section>
<?php     
    } //count row products 
?>


  </div>




    </div>

</div>
</div>

<script type="text/javascript">
    /* wait for images to load */
    $(window).load( function() {
        $('.sp-wrap').smoothproducts();
    });
</script>