<?php /*

      <div class="content ">
        <div class="title-article-1">
          <h1><?=$page_title?></h1>
        </div>
<?php
	$count=count($list_album);
	if($count >0){  
?>           
<ul class="gallery-com">

  <?php
    $i = 0;
    foreach($list_album as $row):
  ?>  
    <li>
      <a href="<?php echo $row['img'];?>" title="<?php echo $row['name']; ?>" class="fancybox" rel="gallery">
      <img alt="<?php echo $row['name']; ?>" src="<?php echo $row['img_thumb'];?>">
      <span class="name"><?php echo $row['name']; ?></span>
      </a>
    </li>                     
  <?php 
    endforeach; 
  ?>
</ul>
  <div id="pagination-pro"><?php echo $pagination ?></div>  
<?php
  }else{
    echo '<p class="not-found-data">'.$this->menu_model->translateWords('updating', $lang).'</p>';
  }
?>
         </div>
 

  */?>
<div class="container">
    <div class="row">
                    
              <?php
              if(count($list_album) > 0){
                $i = 0;
                foreach($list_album as $row):
              ?>  
                    <div class="col-md-6">
                        
                        <a href="<?= $row['link']; ?>" class="hero" style="background-image: url('<?= $row['image']; ?>')">
                            <div class="header">
                                
                                <h4><?= $row['name']; ?></h4>

                                <p><?= $row['brief']; ?></p>
                            </div>
                        </a>

                    </div>
            <?php endforeach; ?>
             <div id="pagination-pro"><?php echo $pagination ?></div>  
            <?php
              }else{
                echo '<p class="not-found-data">'.$this->menu_model->translateWords('updating', $lang).'</p>';
              }
            ?>
    </div>
</div>