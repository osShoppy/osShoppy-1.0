<?php //$Id: /catalog/logoff.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

  $breadcrumb->add(NAVBAR_TITLE);

// bof - purchase without account
//delete the temporary account
  $pwa_query = tep_db_query("select guest_account from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $pwa = tep_db_fetch_array($pwa_query);
  if ($pwa['guest_account'] == 1) {
  tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'");
  tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
  tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "'");
  }
  tep_session_unregister('guest_account');
// eof - purchase without account
  tep_session_unregister('customer_id');
  tep_session_unregister('customer_default_address_id');
  tep_session_unregister('customer_first_name');
  tep_session_unregister('sppc_customer_group_id');
  tep_session_unregister('sppc_customer_group_show_tax');
  tep_session_unregister('sppc_customer_group_tax_exempt');
  if (tep_session_is_registered('sppc_customer_specific_taxes_exempt')) { tep_session_unregister('sppc_customer_specific_taxes_exempt');
  }
  tep_session_unregister('customer_country_id');
  tep_session_unregister('customer_zone_id');
  tep_session_unregister('comments');
// bof - credit class gift voucher
  tep_session_unregister('gv_id');
  tep_session_unregister('cot_gv');
  tep_session_unregister('cc_id');
// bof - credit class gift voucher
// bof - points and rewards
  if (tep_session_is_registered('customer_shopping_points')) tep_session_unregister('customer_shopping_points');
  if (tep_session_is_registered('customer_shopping_points_spending')) tep_session_unregister('customer_shopping_points_spending');
  if (tep_session_is_registered('customer_referral')) tep_session_unregister('customer_referral');
// eof - points and rewards
// bof - recently_viewed infobox
  tep_session_unregister('recently_viewed');
// eof - recently_viewed infobox

  $cart->reset();
  $wishList->reset();

  $content = CONTENT_LOGOFF;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
