<?php

$CI =& get_instance();

$site_lang = $CI->session->userdata('site_lang');

$this->lang->load('admin/common', $site_lang);

$this->lang->line('added_success');

$sslog = $this->session->userdata('CI_login');

if ($site_lang == 'english')
{
	$aboutAlias = 'about';
	$lang = '_en';
}
else
{
	$aboutAlias = 'gioi-thieu';
	$lang = '';
}
$calculate1 = 'tinh-gia-xay-nha-pho';
$calculate2 = 'tinh-gia-xay-biet-thu';
$calculate3 = 'tinh-gia-xay-nha-xuong';
?>
<?php if(count($aboutHome) > 0){ ?>
<section id="about-block" class="widget about-slogan">
    <div class="about-block-main">
	     <div class="container-fluid">
		    <div class="row">
			    <div class="col-md-7 col-sm-7">
				    <div class="img-about-blur">
					    <img src="./publics/images/layout/about-blur.png">
					</div>
				    <div class="about-content-h">
						<h1><a href="<?php echo './'.$aboutAlias.'/'.$aboutHome['alias'.$lang].'.html'; ?>" title="<?php echo $aboutHome['name'.$lang]; ?>">
						<?php echo $aboutHome['name'.$lang]; ?>
                          </a>
						</h1>
						<p><?php echo $aboutHome['brief'.$lang]; ?></p>

						<?php /*<a class="viewmore-about" href='./gioi-thieu'><?php echo $this->menu_model->translateWords('viewmore'); ?></a> */?>
					</div>
					 <div class="box-list-counter" id="box-list-counter-desktop">
							<ul class="list-inline list-counter-h">
									<li class="col-md-3 col-sm-3 col-xs-6">
								<figure><a href="<?php echo './'.$calculate1; ?>"><image src="./publics/images/layout/tinh-gia-nha-pho.png"></a>
								<figcaption>
									<a href="<?php echo './'.$calculate1; ?>"><p>Tính giá xây</p><p>nhà phố</p></a>
								</figcaption>
								</figure>
								</li>
								<li class="col-md-3 col-sm-3 col-xs-6">
									 <figure><a href="<?php echo './'.$calculate2; ?>"><image src="./publics/images/layout/tinh-gia-biet-thu.png"></a>
									 <figcaption><a href="<?php echo './'.$calculate2; ?>"><p>Tính giá xây</p><p>biệt thự</p></a> </figcaption>
									 </figure>
								</li>
								<li class="col-md-3 col-sm-3 col-xs-6">
								     <figure><a href="<?php echo './'.$calculate3; ?>"><image src="./publics/images/layout/tinh-gia-nha-xuong.png"></a>
								      <figcaption><a href="<?php echo './'.$calculate3; ?>"><p>Tính giá xây</p><p>nhà xưởng</p></a> </figcaption></figure>
							    </li>
								<li class="col-md-3 col-sm-3 col-xs-6">
								    <figure><a href="javascript:void(0)"><image src="./publics/images/layout/bang-gia-xay-dung.png"></a>
								    <figcaption><a href="http://bachtanphat.vn/bang-gia/bang-gia-thiet-ke-thi-cong-nha-pho"><p>Bảng giá</p><p>xây dựng</p></a></figcaption></figure>
								 </li>
							</ul>
					</div> 
					
			    </div>
				<div class="col-md-5 col-sm-5">
				    <figure class="img-about-h">
					    <a href="<?php echo './'.$aboutAlias.'/'.$aboutHome['alias'.$lang].'.html'; ?>" title="<?php echo $aboutHome['name'.$lang]; ?>"><img src="<?php  echo './app/css/images/news/'.$aboutHome['image']; ?>" alt="<?php echo $aboutHome['name'.$lang]; ?>"></a>
					</figure>
				</div>
			</div>
			<div class="row">
			     <div class="box-list-counter" id="box-list-counter-mobile">
							<ul class="list-inline list-counter-h">
									<li class="col-md-3 col-sm-3 col-xs-6">
								<figure><a href="<?php echo './'.$calculate1; ?>"><image src="./publics/images/layout/tinh-gia-nha-pho.png"></a>
								<figcaption>
									<a href="<?php echo './'.$calculate2; ?>"><p>Tính giá xây</p><p>nhà phố</p></a>
								</figcaption>
								</figure>
								</li>
								<li class="col-md-3 col-sm-3 col-xs-6">
									 <figure><a href="<?php echo './'.$calculate2; ?>"><image src="./publics/images/layout/tinh-gia-biet-thu.png"></a>
									 <figcaption><a href="<?php echo './'.$calculate2; ?>"><p>Tính giá xây</p><p>biệt thự</p></a> </figcaption>
									 </figure>
								</li>
								<li class="col-md-3 col-sm-3 col-xs-6">
								     <figure><a href="<?php echo './'.$calculate3; ?>"><image src="./publics/images/layout/tinh-gia-nha-xuong.png"></a>
								      <figcaption><a href="<?php echo './'.$calculate3; ?>"><p>Tính giá xây</p><p>nhà xưởng</p></a> </figcaption></figure>
							    </li>
								<li class="col-md-3 col-sm-3 col-xs-6">
								    <figure><a href="javascript:void(0)"><image src="./publics/images/layout/bang-gia-xay-dung.png"></a>
								    <figcaption><a href="http://bachtanphat.vn/bang-gia/bang-gia-thiet-ke-thi-cong-nha-pho"><p>Bảng giá</p><p>xây dựng</p></a></figcaption></figure>
								 </li>
							</ul>
					</div> 
			</div>
		 </div>
	</div>
</section>
<?php } ?>