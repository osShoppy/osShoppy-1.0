<?php require(DIR_WS_INCLUDES . 'counter.php'); ?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php /* echo HTML_PARAMS; */ ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" >
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','main_layout.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print">
<style type="text/css">
<!--
<?php
if(isset($css_page_width))
{
echo 'div#pageFrame { width: ' . $css_page_width . 'px;}';
}
?>
#informationBox br {
display: none;
}
#informationBox a {
display: block;
}
#informationBox a:hover {
background: #eee;
}

-->
</style>
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
</head>
<body>

<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<!--
"Fluid CSS Layout" template for PandA.nl, Copyright: Paul Mathot Haarlem, Netherlands 2004/02/15
-->
<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
?>
<!-- begin pageFrame -->
<div id="pageFrame">

<div id="logoFrame">
  <img id="logo" src="<?php echo (bts_select('images','logo.gif')); // BTSv1.5 ?>" alt="Logo">
  <div id="imageNav"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_account.gif', HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'header_cart.gif', HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_checkout.gif', HEADER_TITLE_CHECKOUT) . '</a>'; ?></div>
</div>

<div class="navBarFrame" id="navTopFrame">
<div class="navBarContent"><div class="breadCrumb"><?php echo $breadcrumb->trail(' &raquo; '); ?></div><div class="navAcc"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a></div></div>
</div>


  <div id="middleFrame">
  
    <div id="middleContent"><?php
        require (bts_select ('content')); // BTSv1.5
  ?></div>
    <!-- end middleContent -->

    <div class="navBarFrame" id="navBottomFrame">
      <div class="navBarContent">
        <div class="date"><?php echo strftime(DATE_FORMAT_SHORT); ?></div><div class="navAcc"><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a></div>
      </div>
    </div>

<!-- begin bannerFrame -->
<div id="bannerFrame">
  <div id="copyRight"><?php
/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscommerce.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/

//  echo FOOTER_TEXT_BODY
?>A <a href="http://www.panda.nl" target="_blank">PandA.nl</a> creation 2003<br>Powered by <a href="http://www.oscommerce.com" target="_blank">osCommerce</a></div>
<?php
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
  <div id="banner"><!-- <?php echo tep_display_banner('static', $banner); ?> --></div>
<?php } ?>
  </div>
<!-- end bannerFrame -->

  </div>
  <!-- end middleFrame -->

  <!-- begin boxes1Frame -->
  <div class="boxesFrame" id="boxes1Frame">
<?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
  </div>
  <!-- end boxes1Frame -->

  <!-- begin boxes2Frame -->
  <div class="boxesFrame" id="boxes2Frame">
<?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
  </div>
  <!-- end boxes2Frame -->

</div>
<!-- end pageFrame -->

</body>
</html>
