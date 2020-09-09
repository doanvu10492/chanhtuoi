<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<ul class="hr_list social_icons">
<?php if( $this->config->item('facebook') != null ): ?> 
<li >
	<a href="<?= $this->config->item('facebook') ?>" >
	<i class="icon-facebook fs_small  fa fa-facebook"></i>
	</a>
</li>
<?php endif; ?>

<?php if( $this->config->item('twitter') != null ): ?>
<li>
	<a href="<?= $this->config->item('twitter') ?>" >
	<i class="icon-twitter fs_small  fa fa-twitter"></i>
	</a>
</li>
<?php endif; ?>

<?php /* if(  $this->config->item('google') != null ): ?> 
<li >
	<a href="<?= $this->config->item('google') ?>" >
	<i class="icon-gplus-1 fs_small  fa fa-google"></i>
	</a>
</li>
<?php endif; */?>

<?php if( $this->config->item('youtube') != null ): ?> 
<li >
	<a href="<?= $this->config->item('youtube') ?>" >
	<i class="icon-youtube-play fs_small  fa fa-youtube"></i>
	</a>
</li>
<?php endif; ?>

<?php if( $this->config->item('instagram') != null ): ?> 
<li>
	<a href="<?= $this->config->item('instagram') ?>" >
	<i class="icon-instagramm fs_small  fa fa-instagram"></i>
	</a>
</li>
<?php endif; ?>
</ul>