<?php //$Id: /catalog/create_account.php (osC)

  require('includes/application_top.php');

// bof - purchase without account
  if (isset($HTTP_GET_VARS['guest']) && $cart->count_contents() < 1) tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
// eof - purchase without account

// bof - anti robot registration
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_CREATE_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// bof - anti robot registration

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

// bof - account activation
      function random_string($length) {
	  $thestring = "";
	  // define possible characters
	  $possible = "0123456789bcdfghjkmnpqrstvwxyz";   
	  // add random characters to $password until $length is reached
	  $i = 0;
	  while ($i < $length) { 
	    // pick a random character from the possible ones
	    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
	    // we don't want this character if it's already in the password
	    if (!strstr($thestring, $char)) { 
	      $thestring .= $char;
	      $i++;
	    }
	  }
	  return $thestring;
      }
// eof - account activation

$process = false;
  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') {
      if (isset($HTTP_POST_VARS['gender'])) {
        $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
      } else {
        $gender = false;
      }
    }
    $firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
    $insertion = tep_db_prepare_input($HTTP_POST_VARS['insertion']);
    $lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($HTTP_POST_VARS['dob']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
    $confirm_email_address = tep_db_prepare_input($HTTP_POST_VARS['confirm_email_address']);              
// bof - separate pricing per customer, added: field for tax id number
// original    if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($HTTP_POST_VARS['company']);
    if (ACCOUNT_COMPANY == 'true') {
    $company = tep_db_prepare_input($_POST['company']);
    $company_tax_id = tep_db_prepare_input($_POST['company_tax_id']);
    }
// eof - separate pricing per customer, added: field for tax id number
    $street_address = tep_db_prepare_input($HTTP_POST_VARS['street_address']);
	$street_no = tep_db_prepare_input($HTTP_POST_VARS['street_no']);
	$street_no_add = tep_db_prepare_input($HTTP_POST_VARS['street_no_add']);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($HTTP_POST_VARS['suburb']);
    $postcode = tep_db_prepare_input($HTTP_POST_VARS['postcode']);
    $city = tep_db_prepare_input($HTTP_POST_VARS['city']);
    if (ACCOUNT_STATE == 'true') {
      $state = tep_db_prepare_input($HTTP_POST_VARS['state']);
      if (isset($HTTP_POST_VARS['zone_id'])) {
        $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
      } else {
        $zone_id = false;
      }
    }
    $country = tep_db_prepare_input($HTTP_POST_VARS['country']);
    $telephone = tep_db_prepare_input($HTTP_POST_VARS['telephone']);
    $fax = tep_db_prepare_input($HTTP_POST_VARS['fax']);
    if (isset($HTTP_POST_VARS['newsletter'])) {
      $newsletter = tep_db_prepare_input($HTTP_POST_VARS['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = tep_db_prepare_input($HTTP_POST_VARS['password']);
    $confirmation = tep_db_prepare_input($HTTP_POST_VARS['confirmation']);
// bof - rmh referral
    $source = tep_db_prepare_input($HTTP_POST_VARS['source']);
    if (isset($HTTP_POST_VARS['source_other'])) $source_other = tep_db_prepare_input($HTTP_POST_VARS['source_other']);
// eof - rmh referral
// bof - anti robot registration
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_CREATE_VALIDATION == 'true') {
    $antirobotreg = tep_db_prepare_input($HTTP_POST_VARS['antirobotreg']);
    }
// eof - anti robot registration
// start errors
    $error = false;

	if (tep_db_prepare_input($HTTP_POST_VARS['TermsAgree']) != 'true' and MATC_AT_REGISTER != 'false') {
        $error = true;
        $messageStack->add('create_account', MATC_ERROR);
    }

	if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;
        $messageStack->add('create_account', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false) {
        $error = true;
        $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;
      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
// bof - purchase without account
// original      $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
      $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and guest_account != '1'");
// eof - purchase without account
      $check_email = tep_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;
        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }
	
	if ($email_address != $confirm_email_address)
	{
		$error = true; 
		$messageStack->add('create_account', ENTRY_CONFIRM_EMAIL_ADDRESS_CHECK_ERROR);
	}

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

	if (strlen($street_no) < ENTRY_STREET_NO_MIN_LENGTH) {
	  $error = true;
	  $messageStack->add('create_account', ENTRY_STREET_NO_ERROR);
	}
	
    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
      $error = true;
      $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
        if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;
          $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;
          $messageStack->add('create_account', ENTRY_STATE_ERROR);
        }
      }
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

// bof - anti robot registration
     $validated = $_POST['validated'];
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_CREATE_VALIDATION == 'true') {
      include(DIR_WS_MODULES . FILENAME_CHECK_VALIDATION);
      if ($entry_antirobotreg_error == true) $messageStack->add('create_account', $text_antirobotreg_error);
    }
// eof - anti robot registration

// bof - purchase without account
    if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])) {
// eof - purchase without account

// bof - rmh referral
    if ((REFERRAL_REQUIRED == 'true') && (is_numeric($source) == false)) {
        $error = true;

        $messageStack->add('create_account', ENTRY_SOURCE_ERROR);
    }

    if ((REFERRAL_REQUIRED == 'true') && (DISPLAY_REFERRAL_OTHER == 'true') && ($source == '9999') && (!tep_not_null($source_other)) ) {
        $error = true;

        $messageStack->add('create_account', ENTRY_SOURCE_OTHER_ERROR);
    }
// eof - rmh referral

	if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;
      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;
      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }

// bof - purchase without account
} 
// eof - purchase without account

    if ($error == false) {
// bof - purchase without account
		if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest']))
		{
			$dbPass = tep_encrypt_password($password);
			$guestaccount = '0';
		}else{
			$dbPass = 'null';
			$guestaccount = '1';
		}
// eof - purchase without account

      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_insertion' => $insertion,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
// bof - purchase without account
                              // original'customers_password' => tep_encrypt_password($password));
                              'customers_password' => $dbPass,
                              'guest_account' => $guestaccount);
// eof - purchase without account

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);
// bof - separate pricing per customer
   // if you would like to have an alert in the admin section when either a company name has been entered in
   // the appropriate field or a tax id number, or both then uncomment the next line and comment the default
   // setting: only alert when a tax_id number has been given
   //    if ( (ACCOUNT_COMPANY == 'true' && tep_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && tep_not_null($company_tax_id) ) ) {
	  if ( ACCOUNT_COMPANY == 'true' && tep_not_null($company_tax_id)  ) {
      $sql_data_array['customers_group_ra'] = '1';
// entry_company_tax_id moved from table address_book to table customers in version 4.2.0
      $sql_data_array['entry_company_tax_id'] = $company_tax_id; 
    }
// eof - separate pricing per customer

// bof - account activation
	if (ACTIVATION_CODE == 'false') {
	  $sql_data_array['customers_activation_code'] = '';
	  $sql_data_array['customers_active_status'] = '1';
	} else {
	  $activation_code = random_string(12);
	  $sql_data_array['customers_activation_code'] = $activation_code;
	  $sql_data_array['customers_active_status'] = '0';
	}
// eof - account activation

	  tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_insertion' => $insertion,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
							  'entry_street_no' => $street_no,
							  'entry_street_no_add' => $street_no_add,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

// bof - purchase without account
     if (isset($HTTP_GET_VARS['guest']) or isset($HTTP_POST_VARS['guest']))
       tep_session_register('customer_is_guest');
// eof - purchase without account

	  tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

// bof - rmh referral
//    tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");
      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created, customers_info_source_id) values ('" . (int)$customer_id . "', '0', now(), '". (int)$source . "')");

      if ($source == '9999') {
        tep_db_perform(TABLE_SOURCES_OTHER, array('customers_id' => (int)$customer_id, 'sources_other_name' => tep_db_input($source_other)));
      }
// eof - rmh referral

      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }

// bof - separate pricing per customer
// register SPPC session variables for the new customer
// if there is code above that puts new customers directly into another customer group (default is retail)
// then the below code need not be changed, it uses the newly inserted customer group
      $check_customer_group_info = tep_db_query("select c.customers_group_id, cg.customers_group_show_tax, cg.customers_group_tax_exempt, cg.group_specific_taxes_exempt from " . TABLE_CUSTOMERS . " c left join " . TABLE_CUSTOMERS_GROUPS . " cg using(customers_group_id) where c.customers_id = '" . $customer_id . "'");
      $customer_group_info = tep_db_fetch_array($check_customer_group_info);
      $sppc_customer_group_id = $customer_group_info['customers_group_id'];
      $sppc_customer_group_show_tax = (int)$customer_group_info['customers_group_show_tax'];
      $sppc_customer_group_tax_exempt = (int)$customer_group_info['customers_group_tax_exempt'];
      $sppc_customer_specific_taxes_exempt = '';
      if (tep_not_null($customer_group_info['group_specific_taxes_exempt'])) {
        $sppc_customer_specific_taxes_exempt = $customer_group_info['group_specific_taxes_exempt'];
      }
// eof - separate pricing per customer

// bof - account activation
      if (ACTIVATION_CODE == 'false') {
// eof - account activation
      $customer_first_name = $firstname;
      $customer_default_address_id = $address_id;
      $customer_country_id = $country;
      $customer_zone_id = $zone_id;
      tep_session_register('customer_id');
      tep_session_register('customer_first_name');
      tep_session_register('customer_default_address_id');
      tep_session_register('customer_country_id');
      tep_session_register('customer_zone_id');
// bof - separate pricing per customer
      tep_session_register('sppc_customer_group_id');
      tep_session_register('sppc_customer_group_show_tax');
      tep_session_register('sppc_customer_group_tax_exempt');
      tep_session_register('sppc_customer_specific_taxes_exempt');
// eof - separate pricing per customer
      tep_session_unregister('referral_id'); //rmh referral
// bof - purchase without account
      if (isset($HTTP_GET_VARS['guest']) or isset($HTTP_POST_VARS['guest'])) tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING));
// eof - purchase without account
      }  //Account Activation end

// restore cart contents
      $cart->restore_contents();

// restore wishlist to sesssion
      $wishList->restore_wishlist();

// bof - account activation
if (ACTIVATION_CODE == 'false') {
	// build the message content
// bof - ultmate html email
	if (EMAIL_USE_HTML == 'true') {
		require(DIR_WS_MODULES . 'html_mail/'. HTML_EMAIL_LAYOUT .'/create_account.php');
		$email_text = $html_email;
		}else{
// eof - ultmate html email
      $name = $firstname . ' ' . $insertion . ' ' . $lastname;
      $formname = $insertion . ' ' . $lastname;

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $formname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $formname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }
        $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;

// bof - credit class gift voucher
  if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
    $coupon_code = create_coupon_code();
    $insert_query = tep_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
    $insert_id = tep_db_insert_id();
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

    $email_text .= sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) . "\n\n" .
                   sprintf(EMAIL_GV_REDEEM, $coupon_code) . "\n\n" .
                   EMAIL_GV_LINK . tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code,'NONSSL', false) .
                   "\n\n";
  }
  if (NEW_SIGNUP_DISCOUNT_COUPON != '') {
		$coupon_code = NEW_SIGNUP_DISCOUNT_COUPON;
    $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_code = '" . $coupon_code . "'");
    $coupon = tep_db_fetch_array($coupon_query);
		$coupon_id = $coupon['coupon_id'];		
    $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . (int)$languages_id . "'");
    $coupon_desc = tep_db_fetch_array($coupon_desc_query);
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");
    $email_text .= EMAIL_COUPON_INCENTIVE_HEADER .  "\n" .
                   sprintf("%s", $coupon_desc['coupon_description']) ."\n\n" .
                   sprintf(EMAIL_COUPON_REDEEM, $coupon['coupon_code']) . "\n\n" .
                   "\n\n";
  }
// eof - credit class gift voucher

// bof - points and rewards
      if ((USE_POINTS_SYSTEM == 'true') && (NEW_SIGNUP_POINT_AMOUNT > 0)) {
	      tep_add_welcome_points($customer_id);
	      
	      $points_account = '<a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '"><b><u>' . EMAIL_POINTS_ACCOUNT . '</u></b></a>.';
	      $points_faq = '<a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '"><b><u>' . EMAIL_POINTS_FAQ . '</u></b></a>.';
	      $text_points = sprintf(EMAIL_WELCOME_POINTS , $points_account, number_format(NEW_SIGNUP_POINT_AMOUNT,POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(NEW_SIGNUP_POINT_AMOUNT)), $points_faq) ."\n\n";
	      
	      $email_text .= EMAIL_WELCOME . EMAIL_TEXT . $text_points . EMAIL_CONTACT . EMAIL_WARNING;
      } else {
	      $email_text .= EMAIL_WELCOME . EMAIL_TEXT .EMAIL_CONTACT . EMAIL_WARNING;
      }
// eof - points and rewards

// bof - ultmate html email
	}
	if(HTML_EMAIL_DEVELOPMENT_MODE === 'true'){
		//Save the contents of the generated html email to the harddrive in .htm file. This can be practical when developing a new layout.
		$TheFileName = 'Last_mail_from_create_account.php.htm';
		$TheFileHandle = fopen($TheFileName, 'w') or die("can't open error log file");
		fwrite($TheFileHandle, $email_text);
		fclose($TheFileHandle);
		}
// eof - ultmate html email

        tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

// bof - separate pricing per customer: alert shop owner of account created by a company
// if you would like to have an email when either a company name has been entered in
// the appropriate field or a tax id number, or both then uncomment the next line and comment the default
// setting: only email when a tax_id number has been given
//    if ( (ACCOUNT_COMPANY == 'true' && tep_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && tep_not_null($company_tax_id) ) ) {
      if ( ACCOUNT_COMPANY == 'true' && tep_not_null($company_tax_id) ) {
      $alert_email_text = "Please note that " . $firstname . " " . $lastname . " of the company: " . $company . " has created an account.";
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'Company account created', $alert_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      }
// eof - separate pricing per customer: alert shop owner of account created by a company

// bof - notify store owner when new account is created
if(USE_ADMIN_NOTIFY_NEW_ACCOUNT == 'true') {
	$country_name = tep_get_country_name($country);
	  if ($newsletter > 0){
	  	$newsletter_preference = ENTRY_NEWSLETTER_YES;
	  } else {
	  	$newsletter_preference = ENTRY_NEWSLETTER_NO;
	  }
	  
      if (EMAIL_USE_HTML == 'false' ) {
	  $email_text_owner = 
	    str_pad( EMAIL_NEW_CLIENT_GREETING, 20). "\n\n" .
	    str_pad( EMAIL_NEW_CLIENT_ID, 20)      . $customer_id . "\n" .
	    str_pad( EMAIL_NEW_CLIENT_NAME, 20)    . $firstname . ' ' . $insertion . ' ' . $lastname . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_COMPANY, 20)    . $company . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_MAIL, 20)    . $email_address . "\n" . 
			str_pad( EMAIL_NEW_CLIENT_NEWSLETTER, 20) . $newsletter_preference . "\n" .
            str_pad( EMAIL_NEW_CLIENT_PHONE, 20)   . $telephone . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_FAX, 20)     . $fax . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_ADDRESS, 20) . $street_address . ' ' . $street_no . ' ' . $street_no_add . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_SUBURB, 20)  . $suburb . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_ZIP, 20)     . $postcode . "\n" .
            str_pad( EMAIL_NEW_CLIENT_CITY, 20)    . $city . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_STATE, 20)   . $state . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_COUNTRY, 20) . $country_name . "\n";
      } else {
	  $email_text_owner = 
	    '<table border="0" width="600" id="table1">' .
		  '<tr>' .
		    '<td colspan="2">' . EMAIL_NEW_CLIENT_GREETING   . '<br>&nbsp;</td>' . 
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_ID      . '</b></td><td width="520">' . $customer_id     . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_NAME    . '</b></td><td width="520">' . $firstname . ' ' . $insertion . ' ' . $lastname . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_COMPANY    . '</b></td><td width="520">' . $company	 . "</td>" .
		  '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_MAIL    . '</b></td><td width="520"><A href="mailto:' . $email_address . '">' . $email_address . "</A></td>" .

	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_NEWSLETTER . '</b></td><td width="520">' . $newsletter_preference . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_PHONE   . '</b></td><td width="520">' . $telephone       . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_FAX     . '</b></td><td width="520">' . $fax             . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_ADDRESS . '</b></td><td width="520">' . $street_address  . ' ' . $street_no . ' ' . $street_no_add . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_SUBURB  . '</b></td><td width="520">' . $suburb          . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_ZIP     . '</b></td><td width="520">' . $postcode        . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_CITY    . '</b></td><td width="520">' . $city            . "</td>" .
	      '</tr><tr>' .
		'<td width="80"><b>' . EMAIL_NEW_CLIENT_STATE   . '</b></td><td width="520">' . $state           . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_COUNTRY . '</b></td><td width="520">' . $country_name    . "</td>" .
	      '</tr>' .
	    '</table>';
      }
      tep_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT_OWNER, $email_text_owner, STORE_OWNER, $email_address); 
	}
// eof - notify store owner when new account is created
      tep_redirect(tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
	  
} else { // account activation
		  
	    $activation_id = md5($email_address);
		$verification_href = tep_href_link(FILENAME_ACCOUNT_ACTIVATE, 'activation_id=' . $activation_id, 'SSL');
        $verification_mail = tep_href_link(FILENAME_ACCOUNT_ACTIVATE, 'activation_id=' . $activation_id . '&submit=true&activation_code=' . $activation_code, 'SSL');
		$verification_link = '<a href="' . $verification_mail . '">' . $verification_mail . '</a>' ."\n\n";
// bof - ultmate html email
	if (EMAIL_USE_HTML == 'true') {
		require(DIR_WS_MODULES . 'html_mail/'. HTML_EMAIL_LAYOUT .'/create_account.php');
		$email_text = $html_email;
		}else{
// eof - ultmate html email
	
	    $email_text .= EMAIL_WELCOME . EMAIL_TEXT . TEXT_ACTIVATION_CODE . $activation_code . "\n\n" . EMAIL_TEXT_ACTIVATION . $verification_link . EMAIL_CONTACT . EMAIL_WARNING;

// bof - credit class gift voucher
  if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
    $coupon_code = create_coupon_code();
    $insert_query = tep_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
    $insert_id = tep_db_insert_id();
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

    $email_text .= sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) . "\n\n" .
                   sprintf(EMAIL_GV_REDEEM, $coupon_code) . "\n\n" .
                   EMAIL_GV_LINK . tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code,'NONSSL', false) .
                   "\n\n";
  }
  if (NEW_SIGNUP_DISCOUNT_COUPON != '') {
		$coupon_code = NEW_SIGNUP_DISCOUNT_COUPON;
    $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_code = '" . $coupon_code . "'");
    $coupon = tep_db_fetch_array($coupon_query);
		$coupon_id = $coupon['coupon_id'];		
    $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . (int)$languages_id . "'");
    $coupon_desc = tep_db_fetch_array($coupon_desc_query);
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");
    $email_text .= EMAIL_COUPON_INCENTIVE_HEADER .  "\n" .
                   sprintf("%s", $coupon_desc['coupon_description']) ."\n\n" .
                   sprintf(EMAIL_COUPON_REDEEM, $coupon['coupon_code']) . "\n\n" .
                   "\n\n";
  }
// eof - credit class gift voucher

// bof - points and rewards
      if ((USE_POINTS_SYSTEM == 'true') && (NEW_SIGNUP_POINT_AMOUNT > 0)) {
	      tep_add_welcome_points($customer_id);
	      
	      $points_account = '<a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '"><b><u>' . EMAIL_POINTS_ACCOUNT . '</u></b></a>.';
	      $points_faq = '<a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '"><b><u>' . EMAIL_POINTS_FAQ . '</u></b></a>.';
	      $text_points = sprintf(EMAIL_WELCOME_POINTS , $points_account, number_format(NEW_SIGNUP_POINT_AMOUNT,POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(NEW_SIGNUP_POINT_AMOUNT)), $points_faq) ."\n\n";
	      
	      $email_text .= EMAIL_WELCOME . EMAIL_TEXT . $text_points . EMAIL_CONTACT . EMAIL_WARNING;
      } else {
	      $email_text .= EMAIL_WELCOME . EMAIL_TEXT .EMAIL_CONTACT . EMAIL_WARNING;
      }
// eof - points and rewards

// bof - ultmate html email
	}
	if(HTML_EMAIL_DEVELOPMENT_MODE === 'true'){
		//Save the contents of the generated html email to the harddrive in .htm file. This can be practical when developing a new layout.
		$TheFileName = 'Last_mail_from_create_account.php.htm';
		$TheFileHandle = fopen($TheFileName, 'w') or die("can't open error log file");
		fwrite($TheFileHandle, $email_text);
		fclose($TheFileHandle);
		}
// eof - ultmate html email

		tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

// bof - separate pricing per customer: alert shop owner of account created by a company
// if you would like to have an email when either a company name has been entered in
// the appropriate field or a tax id number, or both then uncomment the next line and comment the default
// setting: only email when a tax_id number has been given
//    if ( (ACCOUNT_COMPANY == 'true' && tep_not_null($company) ) || (ACCOUNT_COMPANY == 'true' && tep_not_null($company_tax_id) ) ) {
      if ( ACCOUNT_COMPANY == 'true' && tep_not_null($company_tax_id) ) {
      $alert_email_text = "Please note that " . $firstname . " " . $lastname . " of the company: " . $company . " has created an account.";
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'Company account created', $alert_email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      }
// eof - separate pricing per customer: alert shop owner of account created by a company

// bof - notify store owner when new account is created
if(USE_ADMIN_NOTIFY_NEW_ACCOUNT == 'true') {
	$country_name = tep_get_country_name($country);
	  if ($newsletter > 0){
	  	$newsletter_preference = ENTRY_NEWSLETTER_YES;
	  } else {
	  	$newsletter_preference = ENTRY_NEWSLETTER_NO;
	  }
	  if (EMAIL_USE_HTML == 'false' ) {
	  $email_text_owner = 
	    str_pad( EMAIL_NEW_CLIENT_GREETING, 20). "\n\n" .
	    str_pad( EMAIL_NEW_CLIENT_ID, 20)      . $customer_id . "\n" .
	    str_pad( EMAIL_NEW_CLIENT_NAME, 20)    . $firstname . ' ' . $insertion . ' ' . $lastname . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_COMPANY, 20)    . $company . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_MAIL, 20)    . $email_address . "\n" . 
			str_pad( EMAIL_NEW_CLIENT_NEWSLETTER, 20) . $newsletter_preference . "\n" .
            str_pad( EMAIL_NEW_CLIENT_PHONE, 20)   . $telephone . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_FAX, 20)     . $fax . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_ADDRESS, 20) . $street_address . ' ' . $street_no . ' ' . $street_no_add . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_SUBURB, 20)  . $suburb . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_ZIP, 20)     . $postcode . "\n" .
            str_pad( EMAIL_NEW_CLIENT_CITY, 20)    . $city . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_STATE, 20)   . $state . "\n" . 
            str_pad( EMAIL_NEW_CLIENT_COUNTRY, 20) . $country_name . "\n";
      }
      else {
	  $email_text_owner = 
	    '<table border="0" width="600" id="table1">' .
		  '<tr>' .
		    '<td colspan="2">' . EMAIL_NEW_CLIENT_GREETING   . '<br>&nbsp;</td>' . 
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_ID      . '</b></td><td width="520">' . $customer_id     . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_NAME    . '</b></td><td width="520">' . $firstname . ' ' . $insertion . ' ' . $lastname . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_COMPANY    . '</b></td><td width="520">' . $company	 . "</td>" .
		  '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_MAIL    . '</b></td><td width="520"><A href="mailto:' . $email_address . '">' . $email_address . "</A></td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_NEWSLETTER . '</b></td><td width="520">' . $newsletter_preference . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_PHONE   . '</b></td><td width="520">' . $telephone       . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_FAX     . '</b></td><td width="520">' . $fax             . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_ADDRESS . '</b></td><td width="520">' . $street_address  . ' ' . $street_no . ' ' . $street_no_add . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_SUBURB  . '</b></td><td width="520">' . $suburb          . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_ZIP     . '</b></td><td width="520">' . $postcode        . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_CITY    . '</b></td><td width="520">' . $city            . "</td>" .
	      '</tr><tr>' .
		'<td width="80"><b>' . EMAIL_NEW_CLIENT_STATE   . '</b></td><td width="520">' . $state           . "</td>" .
	      '</tr><tr>' .
	        '<td width="80"><b>' . EMAIL_NEW_CLIENT_COUNTRY . '</b></td><td width="520">' . $country_name    . "</td>" .
	      '</tr>' .
	    '</table>';
      		}
        tep_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT_OWNER, $email_text_owner, STORE_OWNER, $email_address); 
		 }
// eof - notify store owner when new account is created
        tep_redirect($verification_href);
	  }
  	}
// eof - account activation
} 

// bof - purchase without account
 if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])){
   $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
 }else{
   $breadcrumb->add(NAVBAR_TITLE_PWA, tep_href_link(FILENAME_CREATE_ACCOUNT, 'guest=guest', 'SSL'));
 }
// eof - purchase without account

// anti robot registration
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  	header("cache-Control: no-cache");
	header("cache-control: no-store");
  	header("pragma: no-cache");
	
?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_CREATE_ACCOUNT;
  $javascript = 'form_check.js.php';
  include (bts_select('main', $content_template));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
