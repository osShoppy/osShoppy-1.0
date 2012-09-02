<?php //$Id: /catalog/best_sellers.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_BEST_SELLERS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_BEST_SELLERS));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_BEST_SELLERS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
