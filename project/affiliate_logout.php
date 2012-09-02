<?php //$Id: /catalog/affiliate_logout.php (0158)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_LOGOUT);

  $breadcrumb->add(NAVBAR_TITLE);
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_AFFILIATE_LOGOUT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
