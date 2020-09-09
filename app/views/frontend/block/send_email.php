<div class="receive-email-ft">
  <form class="form-group" name="form-messages" id="form-messages" action="./receive_messages" method="POST">
    <div class="messages-register">
    </div>
    <div class="input-group">
	    <input type="email" name="email" class=" form-control" required="" placeholder="Nhập email của bạn...">
	    <span class="input-group-addon">
	    	<button type="submit" id="receive-messages" class="fs_medium button_type_2 color_purple transparent r_corners tr_all"><?= __translate('Gửi') ?></button>
	    </span>
	</div>
  </form>
</div>