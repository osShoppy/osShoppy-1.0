<?php //$Id: /catalog/password_forgotten.php (osC)

  require('includes/application_top.php');

// BOF Anti Robot Registration v3.0
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_PASSWORD_FORGOTTEN_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
    $antirobotreg = tep_db_prepare_input($HTTP_POST_VARS['antirobotreg']);
    }
// EOF Anti Robot Registration v3.0

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PASSWORD_FORGOTTEN);

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
// BOF Anti Robotic Registration v3.0
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_PASSWORD_FORGOTTEN_VALIDATION == 'true') {
      include(DIR_WS_MODULES . FILENAME_CHECK_VALIDATION);
      if ($entry_antirobotreg_error == true) $messageStack->add('password_forgotten', $text_antirobotreg_error);
    }
	
	if (!$entry_antirobotreg_error) {
// EOF Anti Robotic Registration v3.0		

	$email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);

    $check_customer_query = tep_db_query("select customers_firstname, customers_insertion, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
    if (tep_db_num_rows($check_customer_query)) {
      $check_customer = tep_db_fetch_array($check_customer_query);

      $new_password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
      $crypted_password = tep_encrypt_password($new_password);

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");

//---  Beginning of addition: Ultimate HTML Emails  ---//
if (EMAIL_USE_HTML == 'true') {
	require(DIR_WS_MODULES . 'html_mail/'. HTML_EMAIL_LAYOUT .'/password_forgotten.php');
	$email_text = $html_email;
	tep_mail($check_customer['customers_firstname'] . ' ' . $check_customer['customers_insertion'] . ' ' . $check_customer['customers_lastname'], $email_address, EMAIL_PASSWORD_REMINDER_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
}else{
//---  End of addition: Ultimate HTML Emails  ---//

      tep_mail($check_customer['customers_firstname'] . ' ' . $check_customer['customers_insertion'] . ' ' . $check_customer['customers_lastname'], $email_address, EMAIL_PASSWORD_REMINDER_SUBJECT, sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

//---  Beginning of addition: Ultimate HTML Emails  ---//
}

if(HTML_EMAIL_DEVELOPMENT_MODE === 'true'){
	//Save the contents of the generated html email to the harddrive in .htm file. This can be practical when developing a new layout.
	$TheFileName = 'Last_mail_from_password_forgotten.php.htm';
	$TheFileHandle = fopen($TheFileName, 'w') or die("can't open error log file");
	fwrite($TheFileHandle, $email_text);
	fclose($TheFileHandle);
}
//---  End of addition: Ultimate HTML Emails  ---//

	$messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');

      tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
    } else {
      $messageStack->add('password_forgotten', TEXT_NO_EMAIL_ADDRESS_FOUND);
    }
  }
// BOF Anti Robotic Registration v3.0	
}
	header('cache-control: no-store, no-cache, must-revalidate');
    header("Pragma: no-cache");
// EOF Anti Robotic Registration v3.0	
  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_PASSWORD_FORGOTTEN;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
