<div class="row">
<div class="col-xs-4">
<img src="'.$detail['img_thumb'].'">
</div>
<div class="col-xs-8">
<h4>'.strip_tags($detail['name']).'</h4>
<p><span>Giá</span>: '.$detail['price'].'</p>

<form class="form-inline" method="POST" action="./gio-hang" id="cart-submit">
<input type="hidden" name="checkout" value="0">

<input type="hidden" name="name" value="'.$detail['name'].'">
<input type="hidden" name="price" value="'.(($detail['price'] > 0) ? ($detail['price']) : (1)).'">
<input type="hidden" name="id" value="'.$detail['id'].'">
<div class="form-group">

<label>Số lượng</label>
: <input type="number" min="1" name="qty" class="form-control" id="" placeholder="1" value="1" >

</div>
</form>
</div>
</div>