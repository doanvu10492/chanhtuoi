<?php foreach ($categories as $cate) { ?>
    <div class="col-md-3 col-xs-6 cate-coupons">
        <div >
            <figure>
                <a href="<?= $cate['link'] ?>"><img data-src="<?= $cate['image'] ?>" class="img-responsive lazy"></a>
            </figure>
            <div class="cate-coupons-info">
                <a href="<?= $cate['link'] ?>"><?= $cate['name'] ?></a>
                <p class="short-content">
                    <?= $cate['brief']; ?>
                </p>
            </div>
        </div>       
    </div>
<?php } ?>