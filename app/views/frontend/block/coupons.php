<?php foreach ($coupons as $coupon) { ?>
    <div class="col-md-3 col-xs-6">
        <div class="coupon-item">
            <div class="shortname">
                <a href="<?= $coupon['outlink'] ?>"><?= $coupon['shortname'] ?></a>
            </div>
            <div class="coupon-info">
                <a href="<?= $coupon['outlink'] ?>"><?= $coupon['name'] ?></a>
                <div class="short-content">
                    <?= $coupon['brief']; ?>
                </div>
                <div class="get-coupon-code">
                    <a href="<?= $coupon['outlink'] ?>">
                        <p class="code-text">Lấy mã giảm giá</p>
                        <p class="code-icon"><i class="fa fa-cut"></i></p>
                    </a>
                </div>
            </div>
        </div>       
    </div>
<?php } ?>