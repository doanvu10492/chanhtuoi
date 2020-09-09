<?php if ($current_page != 'search_student') { 
  $listDegree = $this->page_model->listDegree();
?>
<div id="register-learn-form" class="form-custom-page">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Đăng ký học</h4>
          </div>
          <div class="modal-body">
              <div class="well">
                  <form id="registerLearnForm" method="POST" action="./register-learn" novalidate="novalidate">
                      <input type="hidden" name="form_key" value="<?= $this->session->userdata('FORM_KEY') ?>">
                      <input type="hidden" name="register_learn" value="register learn">
                      <div class="form-group">
                          <input type="text" class="form-control" id="name" name="name" value="" required="" title="Please enter you full name" placeholder="Họ tên">
                          <span class="help-block"></span>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter you email" placeholder="Email">
                          <span class="help-block"></span>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" id="phone" name="phone" value="" required="" title="Please enter you email" placeholder="Số điện thoại">
                          <span class="help-block"></span>
                      </div>
                      <div class="form-group">
                          <select name="degree" class="form-control">
                            <option value="">Hạng đăng ký</option>
                            <?php foreach ($listDegree as $degree) { ?>
                            <option value="<?= $degree['name'] ?>"><?= $degree['name'] ?></option>
                            <?php } ?>
                          </select>
                          <span class="help-block"></span>
                      </div>
                      <div class="form-group" style="display: block; width: inherit;">
                          <textarea type="text" class="form-control" id="phone" name="message" value="" required="" placeholder="Ghi chú"></textarea>
                          <span class="help-block"></span>
                      </div>
                      <div class="messages-register"></div>
                      <button type="submit" class="btn btn-success">Đăng ký</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
<?php } ?>

<?php if ($current_page != 'register_learn') { ?>
  <div id="search-result" class="form-custom-page">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Tra cứu kết quả</h4>
          </div>
          <div class="modal-body">
              <div class="well">
                  <form id="searchResultForm" method="GET" action="./tra-cuu-ket-qua" novalidate="novalidate">
                      <div class="form-group" style="overflow: hidden;" >
                      	<div class="row" style="margin: 0 -10px;">
	                      	<div class="col-md-6" style="padding-right: 5px;">
			                    <input type="text" class="form-control" id="code" name="code" 
			                      value="<?= $current_page == 'search_student' && isset($_GET['code'])  ? $_GET['code'] : '' ?>" required="" title="Please enter you full name" placeholder="Mã học viên">
			                    <span class="help-block"></span>
			                </div>
			                <div class="col-md-6" style="padding-left: 5px;">
						        <input id="login-cmnd" type="text" class="form-control" name="cmnd"
						            value="<?= $current_page == 'search_student' && isset($_GET['cmnd']) ? $_GET['cmnd'] : ''; ?>" placeholder="CMND">
			                </div>
			            </div>
                      </div>
                      <button type="submit" class="btn btn-success">Tra cứu</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
<?php } ?>