<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<aside>
<div id="sidebar-left">



<h2 class="fw_light color_dark m_bottom_23" data-toggle="collapse" href="#collapse-categories" role="button" aria-expanded="false" aria-controls="categories-product"><?= __translate('Category products') ?></h2>
<?php $categories = $this->category_products_model->get_list_category($lang, array(TB_CGR_PRODUCTS.'.isLeft' => 1 ));   
 if($categories):
?>

<div class="filter-main collapse" id="collapse-categories">

<div class="box-cate-left show"> 
<ul class="list-block">
<?php foreach($categories as $row): 
if ($row['cate_child']){
   $show = (isset($idRoot) && $idRoot == $row['id']) ? ("block") : ("none");
?>

<li><a href="<?= $row['link'] ?>"><?=$row['name'] ?> </a> <i class="fa fa-sort-desc" aria-hidden="true"></i>
<ul class="list-block ul-child " style="display: <?= $show ?>">


<?php foreach($row['cate_child'] as $item){ ?>
    <li>
        <a href="<?=$item['link'] ?>"   ><?=$item['name'] ?></a><i class="fa fa-sort-desc" aria-hidden="true"></i>
    </li>
<?php }  ?>
</li>
</ul>

<?php 
}
endforeach; ?>
</ul>
</div>
</div>

<?php endif; 

?>
<?php if(count($support_online) > 0){ ?>
<div class="box-cate-left box-left">
<h2><?= __translate('Support online') ?></h2>
<ul class="list-block">
<?php foreach($support_online as $support): ?>
	<div class="support">
		<p><?= $support['name'] ?></p>
	    <a href="tel:<?= $support['hotline'] ?>"><img src="./assets/img/layout/skype.png" style="margin-right: 10px;"> <?= $support['hotline'] ?></a>
	</div>
<?php endforeach; ?>
</ul>
</div>
<?php } ?>

<div class="box-cate-left box-left box-news-left">
<h2><?= __translate('news') ?></h2>
<ul class="list-block">
<?php foreach($postsHighlight as $post): ?>


    <li>
    	<figure><img src="<?= $post['img_thumb']; ?>"></figure>
        <a href="<?= $post['link']?>" class="toggle-group"><?=$post['name'] ?></a>
    </li>

<?php endforeach; ?>
</ul>
</div>


</div>

</aside>

