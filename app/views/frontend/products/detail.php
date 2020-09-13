<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>  
<link rel="stylesheet" href="./assets/css/smoothproducts.css" />
<script src="./assets/js/smoothproducts.js"></script>
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
  <div class="box-product-detail" style="background: #fff; padding: 10px;"> 
    <div class="row">
      <div class="col-sm-5 col-xs-12">
        <div class="img-product-detail img-product">
          <?php if( count($detail['products_img_detail']) > 0 ) { ?>
            <div class="sp-wrap">
              <?php foreach( $detail['products_img_detail'] as $row) : ?>
                  <a href="<?=$row['img']?>" >
                    <img src="<?=$row['img']?>" alt="<?=$detail['name']?>" />
                     <i class="fa fa-search-plus" aria-hidden="true"></i>
                  </a>
                <?php endforeach; ?>
            </div>
      
          <?php } else { ?>
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

      <div class="col-sm-7">
        <div class="infor-prod">
          <h1><?=$detail['name'] ?></h1>
          <p>Mã sản phẩm: <?=$detail['code'] ?></p>
        </div>
      </div>
    </div>

    <div class="product-content">
      <?= $detail['description'] ?>
    </div>
  </div>
  <?php if (count($other_products)) { ?>
  <section id="other-product">
  <div id="samples-page"  class="box-other-product list-products-t1 list-products list-normal-product">
      <h2>SẢN PHẨM THƯỜNG ĐƯỢC XEM CÙNG</h2>
      <div class="other-product">
                            
          <div class="other-product-slider line-boder-slider ">
              
          <div class="navslider">
              <a class="prev fa" href="#"></a> 
              <a class="next fa" href="#"></a>
          </div>
          <div class="noo-blog-slider inner owl-carousel owl-theme" id="list-other-product" >
          
            <?php 
              if (isset($other_products)) {
                  $i = 0;
                  foreach ($other_products as $product) {
            ?>
                <div class="product-item">
                  <figure>
                      <a href="<?= $product['link'] ?>"><img data-src="<?= $product['img'] ?>" class="img-responsive lazy"></a>
                  </figure>
                  <div class="product-info">
                      <a href="<?= $product['link'] ?>"><?= $product['name'] ?></a>
                      <p class="price"><?= number_format($product['price'], 0, '', '.')?> <span>đ</span></p>
                      <p class="short-content">
                          <?= $product['brief']; ?>
                      </p>
                  </div>
                </div>

          <?php }  }  ?>
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
              [1200, 5] 
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
  <?php  } ?>
  </div>
</div>

<script type="text/javascript">
    $(window).load( function() {
        $('.sp-wrap').smoothproducts();
    });
</script>