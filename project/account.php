<?php //$Id: /catalog/account.php (osC)

  require('includes/application_top.php');

// redirect costomer to login page if not logged in
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// customer personal notes
  $notes_query = tep_db_query("select customers_id, customers_notes_frontend from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $notes = tep_db_fetch_array($notes_query);

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ACCOUNT;
  $javascript = $content . '.js';
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
