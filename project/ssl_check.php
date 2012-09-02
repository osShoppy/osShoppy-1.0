<?php //$Id: /catalog/ssl_check.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SSL_CHECK);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SSL_CHECK));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_SSL_CHECK;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
