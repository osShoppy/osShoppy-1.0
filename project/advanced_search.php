<?php //$Id: /catalog/advanced_search.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ADVANCED_SEARCH;
  $javascript = $content . '.js.php';
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
