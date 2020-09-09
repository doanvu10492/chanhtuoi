<form class="form-inline" method="POST" action="./gio-hang" id="cart-submit-detail">
  <input type="hidden" name="name" value="<?= $detail['name'] ?>">
  <input type="hidden" name="price" value="<?= $detail['price'] ?>">
  <input type="hidden" name="id" value="<?= $detail['id'] ?>">
  <input type="hidden" name="checkout">
  <span>Số lượng: <input type="number" name="qty" value="1" class="form-controll"></span>
  <a href="#" id="add_to_cart" class="add_to_cart hidden-btn-add">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>Thêm Vào Giỏ hàng 
  </a>
</form>
<a href="cart.html" class="add_cart btn buy-now"  data-name="<?= $detail['name']; ?>" data-id="<?= $detail['id']; ?>" data-price="<?= $detail['price']; ?>" data-qty="1" >
   <span class="fs_medium">Mua ngay</span>
</a>