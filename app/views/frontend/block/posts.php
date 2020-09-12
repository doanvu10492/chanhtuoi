<?php foreach ($posts as $post) { ?>
    <div class="col-md-3 col-xs-6">
        <div class="post-item">
            <figure>
                <a href="<?= $post['link'] ?>"><img data-src="<?= $post['img'] ?>" class="img-responsive lazy"></a>
            </figure>
            <div class="post-info">
                <p class="date">Ngày đăng: <?= $post['date'] ?></p>
                <a href="<?= $post['link'] ?>"><?= $post['name'] ?></a>
                <p><?= $post['brief'] ?></p>
            </div>
        </div>       
    </div>
<?php } ?>