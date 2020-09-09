
<div id="nav-top" class="menu-main navbar" >
	<div class="logo">
		<a href="./"><img src="<?= $this->config->item('logo') ?>" class="<?= $this->config->item('site_title') ?>"></a>
	</div>

	<div class="left-chk"><a href="./xem-gio-hang"><img src="./assets/img/layout/icon-cart.png"><span><?php $total_cart= $this->cart->total_items(); echo $total_cart; ?></span></a></div>
	
<div class="container" data-clone="sticky">
		<div class="row">
			<div class="col-sm-12 clearfix">

				
				<div class="right-side clearfix">
					<div class="search-container">
						<form action="search" class="search-form">
							<input type="hidden" name="type" value="product">
							<input type="search" name="q" class="s" placeholder="Tìm kiếm">
							<a href="#" title="Close Search" class="search-close-btn visible-xs"></a> 
							<input type="submit" value="Submit" class="search-submit-btn">
						</form>
					</div>
					<a href="#" class="header-search-btn visible-xs" title="Search"></a>
					
					<nav id="main-nav" role="navigation">

<div id="responsive-nav">
	<a id="responsive-btn" href="#">
		
		<span class="responsive-btn-icon"><span class="responsive-btn-block"></span> <span class="responsive-btn-block"></span> <span class="responsive-btn-block last"></span></span>
		<span class="responsive-btn-text">Menu</span>
	</a>
	<div id="responsive-menu-container" >
		
     
        <ul class="responsive-menu">

        <?php 
		    if(count($menu_top) > 0): 
		    foreach($menu_top as $menu):

		?>  
				<li class="has-child">
					<span class="menu-btn-wrapper"><span class="menu-btn"><i class="fa fa-angle-down" aria-hidden="true"></i></span></span>
					<a href="<?= $menu['link']?>">
						<?= $menu['name']?>

					</a>
					<?php if(isset($menu['child']) && count($menu['child']) > 0){ 
						echo '<ul class="level1 ins_menu_child" role="menu">';
						foreach($menu['child'] as $menu_child){
					?>
						<li class="has-child">
							
							<a href="<?= $menu_child['link']?>">
								<?= $menu_child['name']?>

							</a>

						</li>
					<?php 
						}
					    echo "</ul>";
					} 
					?>
				</li>
		<?php
			endforeach; 
			endif;

		 ?>
</ul>
        
      <?php //end menu mobile ?> 
	</div>
</div>


<ul class="menu clearfix">
    <li><a href="./"><i class="fa fa-home"></i> </a></li>              
<?php 
    if(count($menu_top) > 0): 
    foreach($menu_top as $menu):

?>   

<li class="megamenu-container has-child ">                    
<a href="<?= $menu['link'] ?>" class="parent  current "><?= $menu['name']?></a>

<?php if(isset($menu['child']) && count($menu['child']) > 0){ ?>                            
<div class="megamenu">
<div class="container">

<ul>
<?php
$i = 0;
foreach($menu['child'] as $child){
 echo (($i%4) == 0) ? ('<div class="row">') : ('');
?>

<li class="col-md-3">


<a class="tit-cate-menu" href="<?= $child['link'] ?>"><?= $child['name']; ?></a>

<?php 
    
    if (isset($child['child']) && count($child['child']) > 0)
    {
        echo "<ul>";
?>

<?php 
        foreach ($child['child'] as $item)
        {
           
        ?>
            <li >


                <a  href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a>
            </li>
        <?php

       
        }
         echo "</ul>";
    }
 ?>
</li>
<?php
    $i++;
	echo ($i%4 == 0 || $i == count($menu['child'])) ? ('</div>') : ('');
}
?>


</ul>

</div>
</div>
 

<?php } //endif menuchild 
?>

</li>

<?php
endforeach;
endif;
?>                            
								
								
                  
                  
							
						</ul>
                        
                        
                        
                        
					</nav>
					
				</div>
			</div>
		</div>
	</div>

</div>
<!----end containter-->
 