<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<aside>
<div id="sidebar-left">
<?php /* $categories = $this->category_products_model->get_list_category();   
 if($categories):
?>

<?php foreach($categories as $row): ?>
<div class="box-cate-left">
<h2><?=$row['name'] ?></h2>
<ul class="list-block">


<?php foreach($row['cate_child'] as $item){ ?>
    <li>
        <a href="<?=$item['link'] ?>" 	><?=$item['name'] ?></a>
    </li>
<?php }  ?>

</ul>
</div>
<?php endforeach; */?>



<?php //endif; 

$news = $this->page_model->list_posts('', [10]);
if($news):  
?>

<div class="box-cate-left">

<h2>Tin tức</h2>
<ul class="list-block">
<?php foreach($news as $row): ?>


    <li>
        <a href="<?= $row['link']?>" class="toggle-group"><?=$row['name'] ?></a>
    </li>

<?php endforeach; ?>
</ul>
</div>

<?php endif; ?>

</div>

</aside>

