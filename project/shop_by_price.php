<?php //$Id: /catalog/shop_by_price.php (1276)

  require('includes/application_top.php');

  // I suppose next line is to work with STS, no need for the others, you can leave it or remove it.
  $sbprice = true;

  // Initialize the varaible '$range' from param here because it's used in FILENAME_SHOP_BY_PRICE
  $range = 0;
  if (isset($HTTP_GET_VARS['range'])) {
    $range = $HTTP_GET_VARS['range'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOP_BY_PRICE);

  $pfrom = isset($price_min[$range]) ? $price_min[$range] : 0;
  $pto   = isset($price_max[$range]) ? $price_max[$range] : 0;

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SHOP_BY_PRICE, tep_get_all_get_params(), 'NONSSL', true, false));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_SHOP_BY_PRICE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
