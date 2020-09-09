<?php /* ?>
<?php $this->load->view('header'); ?>
<?php $this->load->view('banner_top'); ?>
<?php //$this->load->view('chungnhan'); ?>
<?php $this->load->view('hotro_right'); ?>
<?php
$CI =& get_instance();    //do this only once in this file
$site_lang = $CI->session->userdata('site_lang');
$this->lang->load('admin/common', $site_lang);
$this->lang->line('added_success');
if($site_lang=='vietnam'){
	$lang='';
}else{
	$lang='_en';
}
?>
<?php */ ?>
<style>
/* form styles */
.main_content1_right {
  float: left;
  width: 100%;
}
.map_main {
    float: left;
    height: 80%;
    width: 100%;
}
.box-map {
    float: left;
    width: 100%;
	height:100%;
}
  .product_2{
		width:100%;  
  }
  .title_content_main {
    background-size: 100% 100%;
}
#googleMap{
  width: 100%;
    height: 100%;
	float:left;
    position: relative;
    overflow: hidden;
    transform: translateZ(0px);
    background-color: rgb(229, 227, 223);
   
    padding: 0px;
    border: 1px solid #ebebeb;
	transition:1s;
}
.map-footer:hover .gm-style
{	
	transform:scale(1);
	width:99% !important;
}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&language=vi&libraries=visualization"></script>



<script type="text/javascript">
var gmap = new google.maps.LatLng(<?php echo $this->config->item('toadogoogle') ?>);
var marker;
function initialize()
{
    var mapProp = {
         center:new google.maps.LatLng(<?php echo $this->config->item('toadogoogle') ?>),
         zoom:16,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
 
    var map=new google.maps.Map(document.getElementById("googleMap")
    ,mapProp);
 
  var styles = [
    {
      featureType: 'road.arterial',
      elementType: 'all',
      stylers: [
        { hue: '#fff' },
        { saturation: 100 },
        { lightness: -48 },
        { visibility: 'on' }
      ]
    },{
      featureType: 'road',
      elementType: 'all',
      stylers: [
 
      ]
    },
    {
        featureType: 'water',
        elementType: 'geometry.fill',
        stylers: [
            { color: '#adc9b8' }
        ]
    },{
        featureType: 'landscape.natural',
        elementType: 'all',
        stylers: [
            { hue: '#809f80' },
            { lightness: -35 }
        ]
    }
  ];
 
  var styledMapType = new google.maps.StyledMapType(styles);
  map.mapTypes.set('Styled', styledMapType);
 
  marker = new google.maps.Marker({
    map:map,
    draggable:true,
    animation: google.maps.Animation.DROP,
    position: gmap
  });
  google.maps.event.addListener(marker, 'click', toggleBounce);
}
 
function toggleBounce() {
 
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
 
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div class="row" style="height:100%">
<div class="col-md-12 map-footer clearfix" style="height:100%">
  <div id="googleMap">Google Map</div>
</div>
</div>
<!--END OF MAIN-->

