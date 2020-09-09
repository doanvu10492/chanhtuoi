<div id="loginbox"  class="mainbox">                    
<div class="panel panel-info" >
<div class="panel-heading">
    <div class="panel-title">Học viên đã đăng ký</div>
</div>     

<div style="padding-top:30px" class="panel-body" >

    <p class="error" style="color: #f00; font-weight: bold; text-align: center; font-size: 13px;">
        <?php 
            if (isset($_GET) ) {
                if (isset($_GET['code']) && ! $_GET['code']) {
                    echo "Vui lòng nhập mã học viên";
                } elseif (isset($_GET['cmnd']) && ! $_GET['cmnd']) {
                    echo "Vui lòng nhập cmnd";
                } else {
                    echo "";    
                }
            }
         ?>
    </p>
        
    <form id="loginform" method="GET" action="./tra-cuu-dang-ky" class="form-horizontal" role="form">
                
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-code" type="text" class="form-control" name="code" 
            value="<?= $current_page == 'search_student_register' && isset($_GET['code']) ? $_GET['code'] : ''; ?>" placeholder="Mã học viên">                                        
        </div>
        <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
            <input id="login-cmnd" type="text" class="form-control" name="cmnd"
            value="<?= $current_page == 'search_student_register' && isset($_GET['cmnd']) ? $_GET['cmnd'] : ''; ?>" placeholder="CMND">
        </div>
           
        <div style="margin-top:10px" class="form-group">
            <div class="col-sm-12 controls">
              <button id="btn-login" type="submit" class="btn btn-success">Tra cứu  <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
            </div>
        </div> 
    </form>     



    </div>                     
</div>  
</div>
