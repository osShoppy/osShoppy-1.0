<?php //$Id: /catalog/affiliate_signup_ok.php (0158)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SIGNUP_OK);

  $breadcrumb->add(NAVBAR_TITLE);
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_AFFILIATE_SIGNUP_OK;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
