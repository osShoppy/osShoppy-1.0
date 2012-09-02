<?php //$Id: /catalog/quoates.php (6675)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_QUOTES);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_QUOTES));

  if (tep_session_is_registered('customer_id'))
  {
    $customer_query = tep_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "' LIMIT 1");
    $customer = tep_db_fetch_array($customer_query);
    $registered = ($customer['customers_email_address'] == STORE_OWNER_EMAIL_ADDRESS) ? '' : " and p.quotes_email_address = '" . $customer['customers_email_address'] . "'";
  }  
  else
    $registered = ' and p.quotes_email_address IS NULL ';

  $product_check_query = tep_db_query("select p.products_id, p.quotes_email_address, p.quotes_status, p.quotes_expire, p.products_date_added, pd.products_name, pd.products_description, p.products_quantity as qty from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id where p.products_status = '1' " . $registered . " and pd.language_id = '" . (int)$languages_id . "'");
  ?><head>
  <META NAME="ROBOTS" CONTENT="INDEX,NOFOLLOW">
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  <title><?php echo TITLE; ?></title>
  </head><?php

  $content = CONTENT_QUOTES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
