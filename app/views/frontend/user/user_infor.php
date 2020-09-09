<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('frontend/layout/header') ?>
<div id="page-member">
    <?= $infor_user->description; ?>
</div>
<?php $this->load->view('frontend/layout/footer') ?>