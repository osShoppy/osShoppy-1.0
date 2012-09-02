<?php //$Id: /catalog/account_edit.php (osC)

  require('includes/application_top.php');

// anti robot registration-start
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_EDIT_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// anti robot registration-end

// redirect costomer to login page if not logged in
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_EDIT);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
    $firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
    $insertion = tep_db_prepare_input($HTTP_POST_VARS['insertion']);
    $lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($HTTP_POST_VARS['dob']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
	$confirm_email_address = tep_db_prepare_input($HTTP_POST_VARS['confirm_email_address']);
    $telephone = tep_db_prepare_input($HTTP_POST_VARS['telephone']);
    $fax = tep_db_prepare_input($HTTP_POST_VARS['fax']);

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (!checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4))) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR);
    }
	
	if ($email_address != $confirm_email_address)
	{
		$error = true; 
		$messageStack->add('account_edit', ENTRY_CONFIRM_EMAIL_ADDRESS_CHECK_ERROR);
	}

    if (!tep_validate_email($email_address)) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }

    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . (int)$customer_id . "'");
    $check_email = tep_db_fetch_array($check_email_query);
    if ($check_email['total'] > 0) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

// anti robot registration-start
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_EDIT_VALIDATION == 'true') {
      include(DIR_WS_MODULES . FILENAME_CHECK_VALIDATION);
    if ($entry_antirobotreg_error == true) $messageStack->add('account_edit', $text_antirobotreg_error);
    }
// anti robot registration-end

	  if ($error == false) {
// BOF Separate Pricing Per Customer
// don't rely on the input field for company_tax_id being there and filled in, the customer might have edited
// his local copy of the page to include that, so we will check for an entry ourselves
    $check_entry_company_tax_id_query = tep_db_query("select entry_company_tax_id from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $check_entry_company_tax_id = tep_db_fetch_array($check_entry_company_tax_id_query);
// EOF Separate Pricing Per Customer

      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_insertion' => $insertion,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

// BOF Separate Pricing Per Customer
    if (ACCOUNT_COMPANY == 'true') {
      if (isset($_POST['company_tax_id']) && tep_not_null($_POST['company_tax_id']) && !tep_not_null($check_entry_company_tax_id['entry_company_tax_id'])) {
        $sql_data_array['entry_company_tax_id'] = tep_db_prepare_input($_POST['company_tax_id']);
      }
    }
// EOF Separate Pricing Per Customer

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");

      tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customer_id . "'");

      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_insertion' => $insertion,
                              'entry_lastname' => $lastname);

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$customer_default_address_id . "'");

// reset the session variables
      $customer_first_name = $firstname;

      $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

      tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
    }
  }

  $account_query = tep_db_query("select customers_gender, customers_firstname, customers_insertion, customers_lastname, customers_dob, customers_email_address, customers_telephone, customers_fax, entry_company_tax_id from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $account = tep_db_fetch_array($account_query);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ACCOUNT_EDIT;
  $javascript = 'form_check.js.php';
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
