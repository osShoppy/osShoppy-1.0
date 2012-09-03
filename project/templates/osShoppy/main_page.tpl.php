<?php //$Id: /catalog/templates/osshoppy/main_page.tpl.php 

// rss feed
	  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
	    include_once(DIR_WS_CLASSES . 'language.php');
	    $lng = new language;
	  }

	  reset($lng->catalog_languages);
	  while (list($key, $value) = each($lng->catalog_languages)) {
	?>
         <link rel="alternate" type="application/rss+xml" title="<?php echo STORE_NAME . ' - ' . BOX_INFORMATION_RSS; ?>" href="<?php echo FILENAME_RSS, '?language=' . $key.((isset($_GET['cPath']))?'&amp;cPath='.$_GET['cPath']:'').((isset($_GET['manufacturers_id']))?'&amp;manufacturers_id='.$_GET['manufacturers_id']:''); ?>">
          <?php
          }
          ?>
<?php require(DIR_WS_FUNCTIONS . 'random_image.php'); 
// BOF: Store Mode
// give the visitors a message that the website will be offline
  if ( (OFFLINE_WARNING == 'true') && (STORE_MODE == 'Open') ) {
       $messageStack->add('header', OFFLINE_MESSAGE_1 . OFFLINE_DATE_TIME . OFFLINE_MESSAGE_2 . ONLINE_DATE_TIME, 'warning');
  }
// this will remind the admin that the website is offline
  if ( (STORE_MODE == 'Maintenance') && (OFFLINE_IP_ADDRESS == getenv('REMOTE_ADDR')) ) {
       $messageStack->add('header', ADMIN_OFFLINE_MESSAGE . ONLINE_DATE_TIME . '.', 'warning');
  }
// EOF: Store Mode
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<script type="text/javascript">

/***********************************************

* JavaScript Image Clock- by JavaScript Kit (www.javascriptkit.com)
* This notice must stay intact for usage
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and 100s more

***********************************************/

var imageclock=new Object()
	//Enter path to clock digit images here, in order of 0-9, then "am/pm", then colon image:
	imageclock.digits=["images/clockimages/c0.gif", "images/clockimages/c1.gif", "images/clockimages/c2.gif", "images/clockimages/c3.gif", "images/clockimages/c4.gif", "images/clockimages/c5.gif", "images/clockimages/c6.gif", "images/clockimages/c7.gif", "images/clockimages/c8.gif", "images/clockimages/c9.gif", "images/clockimages/cam.gif", "images/clockimages/cpm.gif", "images/clockimages/colon.gif"]
	imageclock.instances=0
	var preloadimages=[]
	for (var i=0; i<imageclock.digits.length; i++){ //preload images
		preloadimages[i]=new Image()
		preloadimages[i].src=imageclock.digits[i]
	}

	imageclock.imageHTML=function(timestring){ //return timestring (ie: 1:56:38) into string of images instead
		var sections=timestring.split(":")
		if (sections[0]=="0") //If hour field is 0 (aka 12 AM)
			sections[0]="24"
		else if (sections[0]>=25)
			sections[0]=sections[0]-12+""
		for (var i=0; i<sections.length; i++){
			if (sections[i].length==1)
				sections[i]='<img src="'+imageclock.digits[0]+'" />'+'<img src="'+imageclock.digits[parseInt(sections[i])]+'" />'
			else
				sections[i]='<img src="'+imageclock.digits[parseInt(sections[i].charAt(0))]+'" />'+'<img src="'+imageclock.digits[parseInt(sections[i].charAt(1))]+'" />'
		}
		return sections[0]+'<img src="'+imageclock.digits[12]+'" />'+sections[1]+'<img src="'+imageclock.digits[12]+'" />'+sections[2]
	}

	imageclock.display=function(){
		var clockinstance=this
		this.spanid="clockspan"+(imageclock.instances++)
		document.write('<span id="'+this.spanid+'"></span>')
		this.update()
		setInterval(function(){clockinstance.update()}, 1000)
	}

	imageclock.display.prototype.update=function(){
		var dateobj=new Date()
		var currenttime=dateobj.getHours()+":"+dateobj.getMinutes()+":"+dateobj.getSeconds() //create time string
		var currenttimeHTML=imageclock.imageHTML(currenttime)+'<img src="'+((dateobj.getHours()>=12)? imageclock.digits[11] : imageclock.digits[10])+'" />'
		document.getElementById(this.spanid).innerHTML=currenttimeHTML

	}


</script>
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<!-- headertags //-->
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
<title><?php echo TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>">
<?php
}
?>
<!-- headertags_eof //-->
<!-- define javascript //-->
<script type="text/javascript" src="highslide/highslide.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="includes/javascript/javascript_scroller.js"></script>
<!-- define javascript_eof //-->
<!-- define css styles //-->
<?php include (DIR_WS_INCLUDES . 'page-header-inc.htc'); ?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="shortcut icon" href="<?php echo (bts_select('stylesheet','css/favicon.ico')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/base.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/common.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/layout.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/modules.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/infoboxes.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/infoboxes_column.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/slideshow.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/superfish.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','css/print.css')); ?>" media="print">
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
<link href="../../stylesheet.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="includes/css/stylesheet_scroller.css">
<link rel="stylesheet" type="text/css" href="includes/css/scr.css">
<!-- define css styles_eof //-->
</head>
<body>
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<?php if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); ?>
<!-- container //-->
<tr>
<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'main_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
		  <?php } ?>
<!-- banner_top_eof //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <td class="maincontainer">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  	  <td class="container">
<!-- header //-->
<?php if (HEADER_OFF == 'false') { ?>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
  		  <td class="header">
<!-- random_header //-->
<?php if (USE_RANDOM_HEADER_IMAGE_IN_HEADER == 'true') { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  		  	  <tr class="header">
			    <td valign="middle" class="randomheader" align="center"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image( random_image() , (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
              </tr>
            </table>
              </tr>
            </table>
<?php } else { ?> 
<!-- random_header_eof //-->
<!-- store_logo //-->
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  		  	  <tr class="header">
<?php if (SWITCH_STORE_LOGO == 'standard') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/standard.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
  	  if (SWITCH_STORE_LOGO == 'spring') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/spring.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'summer') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/summer.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'autumn') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/autumn.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'winter') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/winter.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'oldyear') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/oldyear.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
  	  if (SWITCH_STORE_LOGO == 'newyear') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/newyear.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'valentine') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/valentine.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'easter') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/easter.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'pentecost') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/pentecost.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
  	  if (SWITCH_STORE_LOGO == 'sint-nicolas') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/sint-nicolas.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'christmas') { ?>
			    <td valign="middle" class="headerimage" height="100px"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo_static/christmas.png', (tep_not_null($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></td>
<?php } 
	  if (SWITCH_STORE_LOGO == 'random') { ?>
			    <td valign="middle" class="randomheader" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image( random_image() , STORE_NAME ) . '</a>'; ?></td>
<?php } ?> 
<!-- store_logo_eof //-->
<?php if (USE_SHOPPING_CART_IN_HEADER == 'true') { ?>
<?php if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	?>
				<?php if ($cart->count_contents() > 0) { ?><td width="10%" align="center" class="header-basketBox"><?php require(DIR_WS_BOXES . 'image_in_cart.php'); ?><?php } ?></td>
<?php } else { ?>
				<td width="10%" align="center" class="header-basketBox"><?php require(DIR_WS_BOXES . 'image_in_cart.php'); ?></td>
<?php } } ?>
				<td align="center" class="headerText">
<?php if (USE_DATE_TIME_IN_HEADER == 'true') { ?>
		&nbsp;|&nbsp;<?php echo strftime(DATE_TIME_FORMAT_LONG); ?>&nbsp;|&nbsp;
<?php } ?>
<?php
if (USE_FLAGS_IN_HEADER == 'true') {
		if (!isset($lng) || (isset($lng) && !is_object($lng))) {
		include(DIR_WS_CLASSES . 'language.php');
		$lng = new language;
		}

		$languages_string = '';
		reset($lng->catalog_languages);
		while (list($key, $value) = each($lng->catalog_languages)) {
		$languages_string .= ' <a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_LANGUAGES . $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a> ';
		}
		echo $languages_string;
} ?>
<?php if (USE_SEARCH_IN_HEADER == 'true') {
		if ( (!strstr($_SERVER['PHP_SELF'],'checkout.php')) and (!strstr($_SERVER['PHP_SELF'],'create_account.php')) and (!strstr($_SERVER['PHP_SELF'],'shopping_cart.php')) and (!strstr($_SERVER['PHP_SELF'],'advanced_search.php')) )  { ?>
			<table border="0" width="35%" height="30" cellspacing="0" cellpadding="0" class="smallText">
				<td valign="middle" colspan="0">
	  			<?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get"') ?>
				<td valign="middle" colspan="2"><?php echo tep_draw_hidden_field('search_in_description','1') . tep_draw_input_field('keywords', '', 'size="10" maxlength="30" style="width: ' . (INPUT_SEARCH) . 'px"')  ?></td>
				<td valign="middle" colspan="2">&nbsp;</td>
				<td valign="middle" colspan="2"><center><?php echo tep_image_submit('button_search.png', '&nbsp;' . BOX_SEARCH_ADVANCED_SEARCH); ?></center></td>
				</form>
				</table><?php 
		}
	}
?> 			   </tr>
	  		  </table>
  			 </td>
		    </table>
<!-- random_header //-->
<?php } ?> 
<!-- random_header_eof //-->
<?php } ?> 
<!-- header_eof //-->
<!-- banner_header_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'main_header_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
		  <?php } ?>
<!-- banner_header_top_eof //-->
<!-- header_navigation //-->
	<table border="0" width="100%" cellspacing="0" cellpadding="1">
  	  <tr class="headerNavigation">
<?php if (USE_BREADCRUMB_IN_HEADER_NAVIGATION == 'true') { ?>
      <td class="headerNavigation">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></td>
<?php } ?>
<?php if (USE_ACCOUNT_LINKS_IN_HEADER_NAVIGATION == 'true') { ?>
<?php if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	?>
	  <td align="right" class="headerNavigation"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
		<?php if (USE_FORUM_LINK_IN_HEADER_NAVIGATION == 'true') { ?>&nbsp;|&nbsp;
			<a href="<?php echo FORUM_URL; ?>" class="headerNavigation"><?php echo HEADER_TITLE_FORUM; ?></a>	  
		<?php } ?>
	    <?php if ($cart->count_contents() > 0) { ?> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?><?php } ?></a> &nbsp;&nbsp;</td>
<?php } else { ?>
	  <td align="right" class="headerNavigation"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
		<?php if (USE_FORUM_LINK_IN_HEADER_NAVIGATION == 'true') { ?>&nbsp;|&nbsp;
			<a href="<?php echo FORUM_URL; ?>" class="headerNavigation"><?php echo HEADER_TITLE_FORUM; ?></a>	  
		<?php } ?>
        &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a> &nbsp;&nbsp;</td>
<?php } } ?>
<?php if (USE_DATE_TIME_IN_HEADER_NAVIGATION == 'true') { ?>
	  <td align="right" class="dateTime">&nbsp;|&nbsp;<?php echo strftime(DATE_TIME_FORMAT_LONG); ?>&nbsp;|&nbsp;</td>
<?php } ?>
<?php if (USE_SHOPPING_CART_IN_HEADER_NAVIGATION == 'true') { ?>
<?php if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	?>
	  <?php if ($cart->count_contents() > 0) { ?><td align="right" class="header-basketBox"><?php require(DIR_WS_BOXES . 'image_in_cart_small.php'); ?><?php } ?></td>
<?php } else { ?>
	  <td align="right" class="header-basketBox"><?php require(DIR_WS_BOXES . 'image_in_cart_small.php'); ?></td>
<?php } } ?>
<?php if (USE_DIGITAL_CLOCK_IN_HEADER_NAVIGATION == 'true') {	?>
<td align="right" class="headerNavigation">
<script type="text/javascript">
new imageclock.display()
</script></td>
<?php } ?>
  	 </tr>
	</table>
<!-- header_navigation_eof //-->
<!--start navigation bar -->
<?php if (USE_CATEGORIES_DROPDOWN_IN_HEADER_NAVIGATION == 'true') { ?>
<?php 
if ( file_exists(DIR_WS_INCLUDES.'cat_navbar.php') ) {
require(DIR_WS_INCLUDES.'cat_navbar.php');
  }
 } ?>
<!-- end navigation bar --> 
<!-- banner_header_bottom //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'main_header_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
		  <?php } ?>
<!-- banner_header__bottom //-->
<!-- body //-->
	<table border="0" width="100%" cellspacing="3" cellpadding="3">
  	  <tr>
<!-- banner_left //-->
    	<td width="<?php echo BANNER_WIDTH_MAIN_LEFT; ?>" valign="<?php echo BANNER_VALIGN_MAIN_LEFT; ?>">
          <?php if ($banner = tep_banner_exists('dynamic', 'main_left')) { ?>
			<table border="0" width="<?php echo BANNER_WIDTH_MAIN_LEFT; ?>" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
		  <?php } ?>
		</td>
<!-- banner_left_eof //-->
<!-- column_left //-->
<?php if (COLUMN_LEFT_OFF == 'false') { ?>
	<?php if(USE_COLUMN_LEFT == 'true') { ?>
    	<td width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top">
    	  <table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
									<?php require(bts_select('column', 'column_left.php')); ?>
    	  </table></td>
    <?php } ?>
<!-- column_left eof //-->
<!-- column_main_left //-->
	<?php if(USE_COLUMN_MAIN_LEFT == 'true') { ?>
    	<td width="<?php echo BOX_WIDTH_MAIN_LEFT; ?>" valign="top">
    	  <table border="0" width="<?php echo BOX_WIDTH_MAIN_LEFT; ?>" cellspacing="0" cellpadding="2">
									<?php require(bts_select('column', 'column_main_left.php')); ?>
    	  </table></td>
    <?php }
		} ?>
<!-- column_main_left eof //-->
<!-- content //-->
    <td width="100%" valign="top"><?php require (bts_select ('content')); ?></td>    
<!-- content_eof //-->
<!-- column_main_right //-->
<?php if (COLUMN_RIGHT_OFF == 'false') { ?>
	<?php if(USE_COLUMN_MAIN_RIGHT == 'true') { ?>
    	<td width="<?php echo BOX_WIDTH_MAIN_RIGHT; ?>" valign="top">
    	  <table border="0" width="<?php echo BOX_WIDTH_MAIN_RIGHT; ?>" cellspacing="0" cellpadding="2">
									<?php require(bts_select('column', 'column_main_right.php')); ?>
      	  </table></td>
    <?php } ?>
<!-- column_main_right eof //-->
<!-- column_right //-->
	<?php if(USE_COLUMN_RIGHT == 'true') { ?>
    	<td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top">
    	  <table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
									<?php require(bts_select('column', 'column_right.php')); ?>
      	  </table></td>
    <?php }
		} ?>
<!-- column_right eof //-->
<!-- banner_right //-->
    	<td width="<?php echo BANNER_WIDTH_MAIN_RIGHT; ?>" valign="<?php echo BANNER_VALIGN_MAIN_RIGHT; ?>">
          <?php if ($banner = tep_banner_exists('dynamic', 'main_right')) { ?>
			<table border="0" width="<?php echo BANNER_WIDTH_MAIN_RIGHT; ?>" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
		  <?php } ?>
		</td>
<!-- banner_right_eof //-->
  	 </tr>
	</table>
<!-- banner_footer_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'main_foot_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
			</table>
		  <?php } ?>
<!-- banner_footer_top_eof //-->
<!-- body_eof //-->
<!-- footer_navigation //-->
<?php require_once(DIR_WS_INCLUDES . 'counter.php'); ?>
	<table border="0" width="100%" cellspacing="0" cellpadding="1">
	  <tr>
	    <td class="footerNavigation">
        	<table border="0" width="300px" cellspacing="0" cellpadding="0" align="center">
<?php if (USE_DATE_TIME_IN_FOOTER_NAVIGATION == 'true') { ?>
	  <td align="left" class="dateTime"><?php echo strftime(DATE_TIME_FORMAT_LONG); ?></td>
<?php } ?>
		</table></td>
  		<td class="footerNavigation">
			<table border="0" width="400px" cellspacing="0" cellpadding="0" align="center">
<?php if (USE_INFO_LINKS_IN_FOOTER_NAVIGATION == 'true') { ?>
	    <td align="center" class="footerNavigation">
		<a href="<?php echo tep_href_link(FILENAME_FAQ, '', 'SSL'); ?>" class="footerNavigation"><?php echo FOOTER_INFORMATION_FAQ; ?></a> &nbsp;|&nbsp; 
		<a href="<?PHP echo tep_href_link(FILENAME_DYNAMIC_SITEMAP, '','SSL'); ?>" class="footerNavigation"><?php echo FOOTER_INFORMATION_DYNAMIC_SITEMAP; ?></a> &nbsp;|&nbsp;
		<?php if (USE_FORUM_LINK_IN_FOOTER_NAVIGATION == 'true') { ?><a href="<?php echo FORUM_URL; ?>" class="footerNavigation"><?php echo HEADER_TITLE_FORUM; ?></a> &nbsp;|&nbsp; <?php } ?>
		<a href="<?php echo tep_href_link(FILENAME_GENERAL_INFORMATION, '', 'SSL'); ?>" class="footerNavigation"><?php echo FOOTER_INFORMATION_GENERAL_INFORMATION; ?></a> &nbsp;|&nbsp;
		<a href="<?php echo tep_href_link(FILENAME_CONTACT_US, '', 'SSL'); ?>" class="footerNavigation"><?php echo FOOTER_INFORMATION_CONTACT; ?></a>
		</td>
<?php } ?>
		</table></td>
  		<td class="footerNavigation">
			<table border="0" width="300px" cellspacing="0" cellpadding="0" align="center">
<?php if (USE_COUNTER_IN_FOOTER_NAVIGATION == 'true') {?>
      <td align="right" class="dateTime">&nbsp;|&nbsp;<?php echo $counter_now . ' ' . FOOTER_TEXT_REQUESTS_SINCE . ' ' . $counter_startdate_formatted; ?>&nbsp;|&nbsp;</td>
<?php } ?>
		</table></td>
	  </tr>
	</table>
<!-- footer_navigation_eof //-->
<!-- footer //-->
<?php if (FOOTER_OFF == 'false') { ?>
	<table border="0" width="100%" cellspacing="0" cellpadding="1">
	  <tr>
	    <td class="footer">
<!-- footer left //-->
        	<table border="0" width="300px" cellspacing="0" cellpadding="0" align="center">
      			<tr>
        		  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
<?php if (USE_FLAGS_IN_FOOTER == 'true') { ?>
	  			<tr>
				  <td align="center" class="footerText">
         <?php
		if (!isset($lng) || (isset($lng) && !is_object($lng))) {
		include(DIR_WS_CLASSES . 'language.php');
		$lng = new language;
		}

		$languages_string = '';
		reset($lng->catalog_languages);
		while (list($key, $value) = each($lng->catalog_languages)) {
		$languages_string .= ' <a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_LANGUAGES . $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a> ';
		}
		echo $languages_string;
		?>
				</td>
	    	  </tr>
<?php } ?>
      			<tr>
        		  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
				<tr>
    				<td><table width="300px" border="0">
      				<tr>
        				<td align="center" class="footerText">
                        <?php if (USE_IDEAL_IN_FOOTER == 'true') {
							echo tep_image(DIR_WS_IMAGES . 'manufacturers/ideallogo.jpg'); ?>
						</td><?php } ?>
						<td align="center" class="footerText">
                        <?php if (USE_TNT_IN_FOOTER == 'true') {
							echo tep_image(DIR_WS_IMAGES . 'manufacturers/tntlogo.jpg'); ?>
						</td><?php } ?>
        				<td align="center" class="footerText">
                        <?php if (USE_PAYPAL_IN_FOOTER == 'true') {	
							echo tep_image(DIR_WS_IMAGES . 'manufacturers/paypallogo.jpg'); ?>
						</td><?php } ?>
						<td align="center" class="footerText">
                        <?php if (USE_DPD_IN_FOOTER == 'true') {
							echo tep_image(DIR_WS_IMAGES . 'manufacturers/dpdlogo.jpg'); ?>
						</td><?php } ?>
        				<td align="center" class="footerText">
                        <?php if (USE_CREDITCARD_IN_FOOTER == 'true') {
							echo tep_image(DIR_WS_IMAGES . 'manufacturers/creditcardlogo.jpg'); ?>
						</td><?php } ?>
      				</tr>
    			   </table></td>
  				  </tr>
				 </table></td>
<!-- footer left_eof //-->
<!-- footer center //-->
  		<td class="footer">
			<table border="0" width="300px" cellspacing="0" cellpadding="0" align="center">
      			<tr>
        		  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
<?php if (USE_FOOTER_TEXT_IN_FOOTER == 'true') { ?>
	  			<tr>
				  <td align="center" class="footerText"><?php echo FOOTER_TEXT_BODY ?></td>
	    		</tr>
<?php } ?>
      			<tr>
        	  	  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
			</table>
			<table border="0" width="300px" cellspacing="0" cellpadding="0" align="center">
<!-- banner_bottom_footer //-->
<?php if (USE_BANNER_IN_FOOTER == 'true') {
  if ($banner = tep_banner_exists('dynamic', 'main_foot_bot')) { ?>
	  			<tr>
	    	  	  <td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
	  			</tr>
<?php } ?>
      			<tr>
        	  	  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
<?php } ?>
<!-- banner_bottom_footer_eof //-->
			</table></td>
<!-- footer center-eof //-->
<!-- footer right //-->
	    <td class="footer">
        	<table border="0" width="300px" cellspacing="0" cellpadding="0" align="center">
				<tr>
        		  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
<?php 
if (USE_COUNTER_IN_FOOTER == 'true') {

require_once(DIR_WS_FUNCTIONS . 'onliners.php');
require_once(DIR_WS_INCLUDES . 'counter.php');
require_once(DIR_WS_INCLUDES . 'counts.php');
  	// Recover the code (en, fr, etc) of the current language
  	$lang_query = tep_db_query("select languages_id, code from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$languages_id . "'");

	// Recover the code (fr, en, etc) and the id (1, 2, etc) of the current language
	if (tep_db_num_rows($lang_query)) {
	   $lang_a = tep_db_fetch_array($lang_query);
	   $lang_code = $lang_a['code'];
	}
?>
	  			<tr>
					<td align="center" class="footerText"><?php echo GUESTSONLINE_FIELD.' <b>'.$nowonline.'</b><br />'.
                                          TOTAL_ONLINE.' <b>'.$productsonline.'</b><br />'.
										  MOSTEVER_FIELD.' <b>'.$mostonline.'</b><br />'.
										  '<center><b>'.$totalonline.'</b> '.ONLINESINDS_FIELD.' <b><br>'.$sinds.'</b><br /><br />'.
										  PAGEVIEWS_FIELD. '<b>'.$counter_now. '</b><br />' ?></td>
		   		</tr>
                 <tr>
        		  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
	  			<tr>
			      <td align="center" class="footerText"><a href="<?php echo FILENAME_RSS, '?language=' . $lang_code; ?>" title="<?php echo BOX_INFORMATION_RSS; ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES .  "rss/rss_icon.jpg" , STORE_NAME . " - " . BOX_INFORMATION_RSS); ?></a></td>
		   		</tr>
                 <tr>
        		  <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      			</tr>
<?php } ?>
		 </table></td>
<!-- footer right_eof //-->
	    </tr>
  	   </table></td>
<?php } ?>
<!-- footer_eof //-->
	  </table></td>
	 </tr>
	</table></td>
<!-- container_eof //-->
<!-- banner_bottom //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'main_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_bottom_eof //-->
</body>
</html>
<?php
// Output the footer for Dynamenu for osCommerce
    echo $GLOBALS['dmfooter'];
 ?>
