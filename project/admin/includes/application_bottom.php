<?php //$Id: /catalog/admin/includes/application_bottom.php (osC)

// close session (store variables)
  tep_session_close();

  if (STORE_PAGE_PARSE_TIME == 'true') {
    if (!is_object($logger)) $logger = new logger;
    echo $logger->timer_stop(DISPLAY_PAGE_PARSE_TIME);
  }
?>