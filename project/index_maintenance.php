<?php //$Id: /catalog/index_maintenance.php (6332)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . MAINTENANCE_FILENAME);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
    $name = tep_db_prepare_input($HTTP_POST_VARS['name']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email']);
    $order_id = tep_db_prepare_input($HTTP_POST_VARS['order_id']);
    $subject = tep_db_prepare_input($HTTP_POST_VARS['subject']);
    $phone_number = tep_db_prepare_input($HTTP_POST_VARS['phone_number']);
	$emailsubject = tep_db_prepare_input($HTTP_POST_VARS['reason']);


	$enquiry = ENTRY_NAME . $name . "\n" . ENTRY_ORDER_ID . $order_id . "\n" . ENTRY_SUBJECT . $emailsubject . $subject . "\n" . ENTRY_EMAIL . $email_address . "\n"  . ENTRY_PHONE_NUMBER . $phone_number . "\n\n" . ENTRY_ENQUIRY . "\n\n" . tep_db_prepare_input($HTTP_POST_VARS['enquiry']);

    if (tep_validate_email($email_address)) { if(USE_MAINTENANCE_SUBJECT_DROPDOWN_FIELD == 'true') {
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT . ' ' . $emailsubject, $enquiry, $name, $email_address);
	if ($send_copy_customer == true) {
      	tep_mail($name, $email_address, EXTRA_SUBJECT_CUSTOMER . ' ' . $emailsubject, $enquiry, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      	}
	} else {
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT . ' ' . $subject, $enquiry, $name, $email_address);
	if ($send_copy_customer == true) {
      	tep_mail($name, $email_address, EXTRA_SUBJECT_CUSTOMER . ' ' . $subject, $enquiry, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      	}
	}

      tep_redirect(tep_href_link(FILENAME_INDEX_MAINTENANCE, 'action=success'));
	  } else {
      $error = true;

      $messageStack->add('maintenance', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(MAINTENANCE_FILENAME));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_INDEX_MAINTENANCE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
