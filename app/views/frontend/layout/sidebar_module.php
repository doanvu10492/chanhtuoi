<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<aside>
<div id="sidebar-left">

<?php //endif; 

if($other_posts):  
?>

<div class="box-cate-left">

<h2><?= (isset($name_cate) ? ($name_cate) : ('')) ?></h2>
<ul class="list-block">
<?php foreach($other_posts as $row): ?>


    <li>
        <a href="<?= $row['link']?>" class="toggle-group"><?=$row['name'] ?></a>
    </li>

<?php endforeach; ?>
</ul>
</div>

<?php endif; ?>

</div>

</aside>

