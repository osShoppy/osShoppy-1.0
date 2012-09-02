<?php //$Id: /catalog/specials.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SPECIALS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SPECIALS));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_SPECIALS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
