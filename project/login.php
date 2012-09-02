<?php //$Id: /catalog/login.php (osC)

  require('includes/application_top.php');

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
    $password = tep_db_prepare_input($HTTP_POST_VARS['password']);

// Check if email exists
	// account activation code added customers_active_statur
// beof separate pricing per customer added: customers_group_id
// beof purchase without account added: , guest_account and and guest_account='0'
	$check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_group_id, customers_password, customers_email_address, customers_default_address_id, customers_active_status, customers_status, guest_account from " . TABLE_CUSTOMERS . " where customers_status = '1' and customers_email_address = '" . tep_db_input($email_address) . "' and guest_account='0'");
// EOF Separate Pricing Per Customer
    if (!tep_db_num_rows($check_customer_query)) {
      $error = true;
// account activation
      $error_activation = false;
    } else {
      $check_customer = tep_db_fetch_array($check_customer_query);
// Check that password is good
      if (!tep_validate_password($password, $check_customer['customers_password'])) {
        $error = true;
      } else {
// account activation
	if(ACTIVATION_CODE == 'true') {
		if($check_customer['customers_active_status'] <> '1') {
		  $error = true;
		  $error_activation = true;
		  $activation_id = md5($email_address);
		  $verification_href = tep_href_link(FILENAME_ACCOUNT_ACTIVATE, 'activation_id=' . $activation_id, 'SSL');
		  $message_activation = sprintf(TEXT_LOGIN_ERROR_ACTIVATION, $verification_href);
		  $messageStack->add('login', $message_activation);
		}
	}

	if (SESSION_RECREATE == 'True') {
          tep_session_recreate();
        }
// BOF Separate Pricing Per Customer: choice for logging in under any customer_group_id
// note that tax rates depend on your registered address!
if ($_POST['skip'] != 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD ) {
   $existing_customers_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");
echo '<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">';
print ("\n<html ");
echo HTML_PARAMS;
print (">\n<head>\n<title>Choose a Customer Group</title>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=");
echo CHARSET;
print ("\"\n<base href=\"");
echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;
print ("\">\n<link rel=\"stylesheet\" type=\"text/css\" href=\"stylesheet.css\">\n");
echo '<body bgcolor="#ffffff" style="margin:0">';
print ("\n<table border=\"0\" width=\"100%\" height=\"100%\">\n<tr>\n<td style=\"vertical-align: middle\" align=\"middle\">\n");
echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'));
print ("\n<table border=\"0\" bgcolor=\"#cccccc\" cellspacing=\"10\" style=\"border: 1px solid #ff9900;\">\n<tr>\n<td class=\"main\">\n");
  $index = 0;
  while ($existing_customers =  tep_db_fetch_array($existing_customers_query)) {
 $existing_customers_array[] = array("id" => $existing_customers['customers_group_id'], "text" => "&#160;".$existing_customers['customers_group_name']."&#160;");
    ++$index;
  }
print ("<h2>".TEXT_CHOOSE_CUSTOMER_GROUP."</h2>\n</td>\n</tr>\n<tr>\n<td align=\"center\">\n");
echo tep_draw_pull_down_menu('new_customers_group_id', $existing_customers_array, $check_customer['customers_group_id']);
print ("\n<tr>\n<td class=\"main\">&#160;<br />\n&#160;");
print ("<input type=\"hidden\" name=\"email_address\" value=\"".$_POST['email_address']."\">");
print ("<input type=\"hidden\" name=\"skip\" value=\"true\">");
print ("<input type=\"hidden\" name=\"password\" value=\"".$_POST['password']."\">\n</td>\n</tr>\n<tr>\n<td align=\"right\">\n");
echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE);
print ("</td>\n</tr>\n</table>\n</form>\n</td>\n</tr>\n</table>\n</body>\n</html>\n");
exit;
}
// EOF Separate Pricing Per Customer: choice for logging in under any customer_group_id
// account activation
	if($error==false) {

        $check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
        $check_country = tep_db_fetch_array($check_country_query);

        $customer_id = $check_customer['customers_id'];
        $customer_default_address_id = $check_customer['customers_default_address_id'];
        $customer_first_name = $check_customer['customers_firstname'];
// BOF Separate Pricing Per Customer
	      $customers_specific_taxes_exempt = $check_customer['customers_specific_taxes_exempt'];
	if ($_POST['skip'] == 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD && isset($_POST['new_customers_group_id']))  {
	  $sppc_customer_group_id = $_POST['new_customers_group_id'] ;
	  $check_customer_group_tax = tep_db_query("select customers_group_show_tax, customers_group_tax_exempt, group_specific_taxes_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$_POST['new_customers_group_id'] . "'");
	} else {
	  $sppc_customer_group_id = $check_customer['customers_group_id'];
	  $check_customer_group_tax = tep_db_query("select customers_group_show_tax, customers_group_tax_exempt, group_specific_taxes_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$check_customer['customers_group_id'] . "'");
	}
	$customer_group_tax = tep_db_fetch_array($check_customer_group_tax);
	$sppc_customer_group_show_tax = (int)$customer_group_tax['customers_group_show_tax'];
	$sppc_customer_group_tax_exempt = (int)$customer_group_tax['customers_group_tax_exempt'];
	$group_specific_taxes_exempt = $customer_group_tax['group_specific_taxes_exempt'];
	if (tep_not_null($customers_specific_taxes_exempt)) {
		$sppc_customer_specific_taxes_exempt = $customers_specific_taxes_exempt;
	} elseif (tep_not_null($group_specific_taxes_exempt)) {
		$sppc_customer_specific_taxes_exempt = $group_specific_taxes_exempt;
	} else {
		$sppc_customer_specific_taxes_exempt = '';
	}
	// EOF Separate Pricing Per Customer
        $customer_country_id = $check_country['entry_country_id'];
        $customer_zone_id = $check_country['entry_zone_id'];
        tep_session_register('customer_id');
        tep_session_register('customer_default_address_id');
        tep_session_register('customer_first_name');
// BOF Separate Pricing per Customer
	tep_session_register('sppc_customer_group_id');
	tep_session_register('sppc_customer_group_show_tax');
	tep_session_register('sppc_customer_group_tax_exempt');
	if (tep_not_null($sppc_customer_specific_taxes_exempt)) {
		tep_session_register('sppc_customer_specific_taxes_exempt');
	}
// PriceFormatterStore is already instantiated with the retail customer group id
    if ($sppc_customer_group_id != 0) {
      unset($pfs);
      $pfs = new PriceFormatterStore;
    }
// EOF Separate Pricing per Customer
        tep_session_register('customer_country_id');
        tep_session_register('customer_zone_id');
        tep_session_unregister('referral_id'); //rmh referral

        tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");

// restore cart contents
        $cart->restore_contents();
// restore wishlist to sesssion
        $wishList->restore_wishlist();

        if (sizeof($navigation->snapshot) > 0) {
          $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
          $navigation->clear_snapshot();
          tep_redirect($origin_href);
        } else {
          tep_redirect(tep_href_link(FILENAME_DEFAULT));
        }
       } // account activation
      }
     }
    }

  if ($error == true) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
// account activation
	if(ACTIVATION_CODE == 'true') {
  if ($error_activation == false) $messageStack->add('login', TEXT_LOGIN_ERROR_ACTIVATION);
	}
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_LOGIN;
  $javascript = $content . '.js';
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
