<?php //$Id: /catalog/gallery.php (6181)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/gallery.php');

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link('gallery.php'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<script type="text/javascript" src="<?php echo HTTP_SERVER ?>/highslide/highslide.js"></script>
<script type="text/javascript">   

<?php if (isset($_GET['autoload'])) {?>
hs.addEventListener(window, "load", function() { 
   // click the element virtually: 
   document.getElementById("autoload<?php echo $_GET['autoload'];?>").onclick(); 
}); 
<?php } ?>
hs.registerOverlay({
	overlayId: 'closebutton',
	position: 'top right',
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});

hs.graphicsDir = '/highslide/graphics/';
//hs.padToMinWidth = true;
//hs.minWidth = 400;
</script>

<style type="text/css">
.highslide-wrapper div { font-family: Verdana, Helvetica;}
.highslide {cursor: url(highslide/graphics/zoomin.cur), pointer;outline: none;text-decoration: none;}
.highslide-active-anchor img {visibility: hidden;}
.highslide img {/*border: 2px solid gray;*/}
.highslide:hover img {border-color: silver;}
.highslide-wrapper, .drop-shadow {background: white;}
.highslide-image {border: 10px solid white;}
.highslide-image-blur {}
.highslide-heading{ text-align:center; font-weight:bold; font-size:12px; background-color:#FFFFFF;}
.highslide-caption {
    display: none;
    border: 0px solid #745224;
    font-family: Verdana, Helvetica;
	padding:10px;
	padding-top:0px;
	background: white;
	text-align:left;
	color:#666666;
	font-size:10px;
	text-align:justify;
}
.highslide-loading {
    display: block;
	color: black;
	font-size: 8pt;
	font-family: sans-serif;
	font-weight: bold;
    text-decoration: none;
	padding: 2px;
	border: 1px solid black;
    background-color: white;
    padding-left: 22px;
    background-image: url(<?php echo HTTP_SERVER ?>/highslide/graphics/loader.white.gif);
    background-repeat: no-repeat;
    background-position: 3px 1px;
}

a.highslide-credits,a.highslide-credits i {
    padding: 2px;
    color: silver;
    text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,a.highslide-credits:hover i {
    color: white;
    background-color: gray;
}
a.highslide-full-expand {
	background: url(<?php echo HTTP_SERVER ?>/highslide/graphics/fullexpand.gif) no-repeat;
	display: block;
	margin: 0 10px 10px 0;
	width: 34px;
	height: 34px;
}
.highslide-overlay {display: none;}

/* Mac-style close button */
.closebutton {
	position: relative;
	top: -20px;
	left: 20px;
	width: 30px;
	height: 30px;
	cursor: hand; /* ie */
	cursor: pointer; /* w3c */
	background: url(<?php echo HTTP_SERVER ?>/highslide/graphics/close.png);
	/* For IE6, remove background and add filter */
	_background: none;
	_filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo HTTP_SERVER ?>/highslide/graphics/close.png', sizingMethod='scale');
}

</style>

  <title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_GALLERY;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
