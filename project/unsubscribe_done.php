<?php //$Id: /catalog/unsubscribe_done.php (0913)

require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_UNSUBSCRIBE);
    if (isset($HTTP_GET_VARS['email'])) {
      $email_to_unsubscribe = ereg_replace('[^0-9A-Za-z@._-]', '', $HTTP_GET_VARS['email']); 
    } else {
      $email_to_unsubscribe = '';
    }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_UNSUBSCRIBE, '', 'NONSSL'));

  // Check and see if the email exists in the database, and is subscribed to the newsletter.
  $cus_subscribe_raw = "select 1 from " . TABLE_CUSTOMERS . " where customers_newsletter = '1' and customers_email_address = '" . $email_to_unsubscribe . "'";
  $cus_subscribe_query = tep_db_query($cus_subscribe_raw);
  
  $cus_subscribe = tep_db_fetch_array($cus_subscribe_query);
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_UNSUBSCRIBE_DONE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
