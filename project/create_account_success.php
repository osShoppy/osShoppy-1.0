<?php //$Id: /catalog/create_account_succes.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT_SUCCESS);

  $breadcrumb->add(NAVBAR_TITLE_1);
  $breadcrumb->add(NAVBAR_TITLE_2);
// BOF Control Login
    // start Logoff after successful account creation
  if(CONTROL_LOGIN == 'true') {
    tep_session_unregister('customer_id');
    tep_session_unregister('customer_default_address_id');
    tep_session_unregister('customer_first_name');
    tep_session_unregister('customer_country_id');
    tep_session_unregister('customer_zone_id');

    $cart->reset();
  }
    // end Logoff after successful account creation
// EOF Control Login

  if (sizeof($navigation->snapshot) > 0) {
    $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
    $navigation->clear_snapshot();
  } else {
    $origin_href = tep_href_link(FILENAME_DEFAULT);
  }

  $content = CONTENT_CREATE_ACCOUNT_SUCCESS;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
