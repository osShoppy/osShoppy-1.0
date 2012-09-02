<?php //$Id: /catalog/returns_track.php (1136)

  require('includes/application_top.php');
      if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  if (!$HTTP_GET_VARS['action']){
      $HTTP_GET_VARS['action'] = 'returns_track';
  }
  if ($HTTP_GET_VARS['action']) {
    switch ($HTTP_GET_VARS['action']) {
    case 'returns_show':

       // first carry out a query on the database to see if there are any matching tickets
       $database_returns_query = tep_db_query("SELECT returns_id, returns_status FROM " . TABLE_RETURNS . " where customers_id = '" . $customer_id . "' and rma_value = '" . $HTTP_POST_VARS['rma'] . "' or rma_value = '" . $HTTP_GET_VARS['rma'] . "'");
       if (!tep_db_num_rows($database_returns_query)) {
           tep_redirect(tep_href_link('returns_track.php?error=yes'));
       } else {
          $returns_query = tep_db_fetch_array($database_returns_query);
          $returns_id = $returns_query['returns_id'];
          $returns_status_id = $returns_query['returns_status'];
          $returns_status_query = tep_db_query("SELECT returns_status_name FROM " . TABLE_RETURNS_STATUS . " where returns_status_id = " . $returns_status_id . " and language_id = '" . (int)$languages_id . "'");
          $returns_status_array = tep_db_fetch_array($returns_status_query);
          $returns_status = $returns_status_array['returns_status_name'];
          $returned_products_query = tep_db_query("SELECT * FROM " . TABLE_RETURNS_PRODUCTS_DATA . " op, " . TABLE_RETURNS . " o where o.returns_id = op.returns_id and op.returns_id = '" . $returns_id . "'");
          $returned_products = tep_db_fetch_array($returned_products_query);

              require(DIR_WS_CLASSES . 'order.php');
           $order = new order($returned_products['order_id']);

       }

    break;

}
}

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_RETURNS_TRACK);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_RETURNS_TRACK, '', 'NONSSL'));
  ?><head>
  <title><?php echo TITLE; ?></title>
  <base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  </head><?php

  $content = CONTENT_RETURNS_TRACK;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
