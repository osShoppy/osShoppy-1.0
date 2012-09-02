<?php //$Id: /catalog/about_us.php (osS)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ABOUT_US);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ABOUT_US));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ABOUT_US;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
