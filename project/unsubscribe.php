<?php //$Id: /catalog/unsubscribe.php (0913)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_UNSUBSCRIBE);
  
  if (isset($HTTP_GET_VARS['email'])) {
    $email_to_unsubscribe = ereg_replace('[^0-9A-Za-z@._-]', '', $HTTP_GET_VARS['email']); 
  } else {
    $email_to_unsubscribe = '';
  }
  
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_UNSUBSCRIBE, '', 'NONSSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_UNSUBSCRIBE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
