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


<div class="products-overview row clearfix">
    <div class="container">
        <div class="block-filter">
            <div class="col-xs-12">
                <div class="filter-products">
                    <ul class="list-inline">
                        <li><label>Sắp xếp:</label></li>
                        <li><a href="tim-kiem?order_price=" class="btn btn-default <?= isset($getRequest['order_price']) ? 'active' : ''; ?>">Mới nhất</a></li>
                        <li><a href="tim-kiem?price=desc" class="btn btn-default <?= isset($getRequest['price']) && $getRequest['price'] === 'desc' ? 'active' : ''; ?>">Giá giảm dần</a></li>
                        <li><a href="tim-kiem?price=asc" class="btn btn-default <?= isset($getRequest['price']) && $getRequest['price'] === 'asc' ? 'active' : ''; ?>">Giá tăng dần</a></li>
                        <li><a href="tim-kiem?isSale=1" class="btn btn-default <?= isset($getRequest['isSale']) ? 'active' : ''; ?>">Khuyến mãi</a></li>
                         <li><a href="tim-kiem?isHighlight=1" class="btn btn-default <?= isset($getRequest['isHighlight']) ? 'active' : ''; ?>">Bán chạy</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="list-products">
        <?php if(isset($category) && count($category) > 0 ) { ?> 
            <h1 style="display: none"><?php echo $category['name']; ?></h1>
        <?php } ?>

        <?php if (count($list_products) > 0) { ?>

        <?php $this->load->view('frontend/block/products', ['products' => $list_products]); ?>
    
        <?php } else {
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
