<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

 <div id="tab-product-detail" class="post-right">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">Mới nhất</a></li>
           
        </ul> 
    </div>
     <div class="tab-content">
         <div class="tab-pane active" id="tab1">
            <ul class="list-block">

            <?php 
                if(isset($postHighlight)): 
                    foreach($postHighlight as $row):
            ?>
                <li>
                    <figure>
                    <img src="<?= $row['img_thumb'] ?>" atl="<?= $row['name'] ?>">
                </figure><a href="<?= $row['link'] ?>" ><?= $row['name'] ?></a></li>
            <?php
                    endforeach; 
                endif; 
            ?>

            </ul>
        </div>
</div>
</div>
