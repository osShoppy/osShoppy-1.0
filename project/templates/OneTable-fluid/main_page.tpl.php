<?php require(DIR_WS_INCLUDES . 'counter.php'); ?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" >
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print">
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
</head>
<body>
<!--
"One main layout Table" template for osC created by Paul Mathot
2003/11/12
-->
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
?>
<div id="pageWrapper">
<table id="mainLayoutLT" cellspacing="0" summary="site layout table">
  <tr>
    <td id="pageHeaderLT" colspan="3">
      <div class="logoLT"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.png', 'osCommerce') . '</a>'; ?></div>
      <div id="imageNavLT"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_account.gif', HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'header_cart.gif', HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_checkout.gif', HEADER_TITLE_CHECKOUT) . '</a>'; ?></div>
    </td>
  </tr>
  <tr>
    <td id="navBarTopLT" colspan="3"><div class="navLeftLT"><?php echo $breadcrumb->trail(' &raquo; '); ?></div><div class="navRightLT"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a></div></td>
  </tr>
  <tr>
    <td class="columnLT" id="columnLeftLT"><?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?></td>
    <td id="contentLT"><?php
        require (bts_select ('content')); // BTSv1.5
?></td>
    <td class="columnLT" id="columnRightLT"><?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?></td>
  </tr>
  <tr>
    <td id="navBarBottomLT" colspan="3"><div class="navLeftLT"><?php echo strftime(DATE_FORMAT_LONG); ?></div><div class="navRightLT"><?php echo $counter_now . ' ' . FOOTER_TEXT_REQUESTS_SINCE . ' ' . $counter_startdate_formatted; ?></div></td>
  </tr>
  <tr>
    <td colspan="3" class="footerLT"><div id="copyRightLT"><?php
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
<div><?php echo tep_display_banner('static', $banner); ?></div>
<?php } ?>
    </td>
  </tr>
</table>
</div>
</body>
</html>
