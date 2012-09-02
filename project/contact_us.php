<?php //$Id: /catalog/contact_us.php

  require('includes/application_top.php');

// extra info pages
$page_query = tep_db_query("select 
                               p.pages_id, 
                               p.sort_order, 
                               p.status, 
                               s.pages_title, 
                               s.pages_html_text
                            from 
                               " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id 
                            where 
                               p.status = 1
                            and
                               s.language_id = '" . (int)$languages_id . "'
                            and 
                               p.page_type = 2");


$page_check = tep_db_fetch_array($page_query);

$pagetext=stripslashes($page_check[pages_html_text]);
// extra info pages_eof

// BOF Anti Robot Registration v3.0
  if (ACCOUNT_VALIDATION == 'true' && CONTACT_US_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// EOF Anti Robot Registration v3.0

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
// BOF Anti Robotic Registration v3.0
    if (ACCOUNT_VALIDATION == 'true' && CONTACT_US_VALIDATION == 'true') {
      include(DIR_WS_MODULES . FILENAME_CHECK_VALIDATION);
      if ($entry_antirobotreg_error == true) $messageStack->add('contact', $text_antirobotreg_error);
    }
// EOF Anti Robotic Registration v3.0
	$name = tep_db_prepare_input($HTTP_POST_VARS['name']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email']);
    $order_id = tep_db_prepare_input($HTTP_POST_VARS['order_id']);
    $subject = tep_db_prepare_input($HTTP_POST_VARS['subject']);
    $phone_number = tep_db_prepare_input($HTTP_POST_VARS['phone_number']);
	$emailsubject = tep_db_prepare_input($HTTP_POST_VARS['reason']);

	$enquiry = ENTRY_NAME . $name . "\n" . ENTRY_ORDER_ID . $order_id . "\n" . ENTRY_SUBJECT . $emailsubject . $subject . "\n" . ENTRY_EMAIL . $email_address . "\n"  . ENTRY_PHONE_NUMBER . $phone_number . "\n\n" . ENTRY_ENQUIRY . "\n\n" . tep_db_prepare_input($HTTP_POST_VARS['enquiry']);

  if (!$entry_antirobotreg_error) {
	if (tep_validate_email($email_address)) { 
      if(USE_SUBJECT_DROPDOWN_FIELD == 'true') {
		tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EXTRA_SUBJECT_STOREOWNER . ' ' . $emailsubject, $enquiry, $name, $email_address);
			if ($send_copy_customer == true) {
	      	  tep_mail($name, $email_address, EXTRA_SUBJECT_CUSTOMER . ' ' . $emailsubject, $enquiry, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      		}
	  } else {
      	tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EXTRA_SUBJECT_STOREOWNER . ' ' . $subject, $enquiry, $name, $email_address);
			if ($send_copy_customer == true) {
      		  tep_mail($name, $email_address, EXTRA_SUBJECT_CUSTOMER . ' ' . $subject, $enquiry, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      		}
	  }

      	tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
	  } else {
      	$error = true;

      	$messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
	  }
    }
  }
  
    header('cache-control: no-store, no-cache, must-revalidate');
    header("Pragma: no-cache");
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));
?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_CONTACT_US;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
