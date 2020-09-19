<?php foreach ($products as $product) { ?>
    <div class="col-md-2 col-xs-6 product-item">
        <div >
            <figure>
                <a href="<?= $product['link'] ?>"><img data-src="<?= $product['img'] ?>" class="img-responsive lazy"></a>
            </figure>
            <div class="product-info">
                <a href="<?= $product['link'] ?>"><?= $product['name'] ?></a>
                <p class="price"><?= number_format($product['price'], 0, '', '.')?> <span>₫</span></p>
                <p class="short-content">
                    <?= $product['brief']; ?>
                </p>
            </div>
        </div>       
    </div>
<?php } ?>