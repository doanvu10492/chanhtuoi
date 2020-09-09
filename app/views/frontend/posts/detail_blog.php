<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div id="blog-list-page">
<section id="head-product" class="breadcrumb-product" >
    <div class="container">
        <div class="row">
            <h1 class="title">
                <?= $cate_detail['name']?>
            </h1>
            <?php echo ( isset($breadcrumb)) ? ($breadcrumb) : ('') ?>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <?php $this->load->view('frontend/layout/sidebar_product') ?>
        </div>
        <div class="col-sm-9">
            <div class="newsdetail">
                    <div class="issuuembed" data-configid="28702401/54234135" style="width:100%; height:708px;">
    &nbsp;</div>
<script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
