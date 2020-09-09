<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>  
 <div id="collections-page">
    <div class="container">
        <div class="row">

        <?php 
            if(count($list) > 0) :
                foreach($list as $row) :
        ?>
            <div class="col-xs-12 col-sm-6 range">
                <a href="<?= $row['link'] ?>">
                    <img src="<?= $row['image'] ?>" alt="" class="img-responsive">
                    <div class="range-footer ">
                        <h3><?= $row['name'] ?></h3>
                        <p><?= $row['brief'] ?><i></i></p>
                    </div>
                </a>
            </div>
        <?php 
                endforeach;
            endif;
        ?>
        
        </div>
    </div>
</div>
 