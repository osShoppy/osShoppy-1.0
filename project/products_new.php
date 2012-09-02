<?php //$Id: /catalog/products_new.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_NEW);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCTS_NEW));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_PRODUCTS_NEW;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
