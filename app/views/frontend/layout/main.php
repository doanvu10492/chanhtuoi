<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header'); ?>
<main class="wrapper">
	<?php echo $view_content; ?>
</main>
<?php $this->load->view('frontend/layout/footer'); ?>