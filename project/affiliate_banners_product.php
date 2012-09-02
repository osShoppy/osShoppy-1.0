<?php //$Id: /catalog/affiliate_banners_product.php (0158)

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_BANNERS_PRODUCT);

  $location = ' &raquo; <a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_PRODUCT, '', 'NONSSL') . '" class="headerNavigation">' . NAVBAR_TITLE . '</a>';

// $affiliate_values = tep_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");

  $affiliate_banners_values = tep_db_query("select * from " . TABLE_AFFILIATE_BANNERS . " where affiliate_products_id >'0' order by affiliate_banners_title");
  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  </head><?php

  $content = CONTENT_AFFILIATE_BANNERS_PRODUCT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
