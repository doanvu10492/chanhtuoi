<div id="store-shop">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-12 col-store-left">
				<div class="main-store-shop">
					<div class="store-shop-left">
					<?php if (count($storeDefault) > 0) : ?>
						<div class="store-shop-detail">
							<h2><?= $storeDefault['name'] ?></h2>
							<div class="box-shop-info">
								<figure><img src="<?= $storeDefault['image'] ?>"></figure>

								<div class="desciption">
									<?= $storeDefault['description'] ?>
								</div>
							</div>
						</div>

						<div class="store-shop-map">
							<p class="suggest">Tham khảo nếu chưa biết đường đi:</p>
							<p class="address"><?= $storeDefault['address'] ?></p>
							<div class="map">
								<?= $storeDefault['map'] ?>
							</div>
						</div>
					 <?php endif; ?>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12 col-store-right">
				<div class="option-store form-group">

					<div class="option-area-store">
						<label>Khu vực</label>
						<select name="area" class="form-controll">
							<?php foreach ($stores as $store) : ?>
							<option value="<?= $store['id_cate'] ?>"><?= $store['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="list-store">
						<ul class="list-block">
							<?php foreach ($subStore as $item) : ?>
							<li data-parent="<?= $item['id_parent'] ?>" 
								style="<?= $item['id_parent'] == $storeDefault['id_parent'] ? ("display: block") : ("display: none"); ?>" >
								<a href="#" data-id="<?= $item['id_cate'] ?>">
								<strong><?= $item['distrist'] ?>: </strong><?= $item['address'] ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>