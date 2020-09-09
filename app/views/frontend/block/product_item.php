<div class="product-item">
    <figure>
        <a href="<?= $item['link']; ?>"><img src="<?= $item['img_thumb']; ?>"></a>
        <div class="block-info">
            <a href="#" 
                class="fa fa-shopping-cart add-to-cart" 
                data-id="<?= $item['id']; ?>" 
                data-active = "1"
                data-name = "<?= $item['name']; ?>"
                data-qty = "1"
                data-price = "<?= $item['price']; ?>">
            </a>
            <a class="fa fa-eye quick-view" href="<?= $item['link']; ?>"></a>
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