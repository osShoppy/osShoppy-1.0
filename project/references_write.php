<?php //$Id: /catalog/customer_testimonials_write.php (5477)

  require('includes/application_top.php');

/*** Begin Customer Testimonials v6 ***/
// Redirect user to login page if any of the following are true:
// 1) Admin has disabled Customer Testimonials mod; or 
// 2) only registered users permitted to write testimonials and user is not logged in
  if ((REFERENCES_ACTIVE != 'Yes') || (REFERENCES_REGISTERED_WRITE == "Disabled") || ((REFERENCES_REGISTERED_WRITE == "Registered Users Only") && (!tep_session_is_registered('customer_id')))) 
  {
  	    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
/*** End Customer Testimonials v6 ***/ 

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_REFERENCES);

/*** Begin Customer Testimonials v6 ***/
  if (REFERENCES_CAPTCHA == 'Yes') {
// start modification for reCaptcha
  require_once('includes/classes/recaptchalib.php');
// end modification for reCaptcha
	}
/*** End Customer Testimonials v6 ***/

    $references_error = false;
    if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'insert')) {
        $references_id = tep_db_prepare_input($HTTP_POST_VARS['references_id']);
        $references_title = tep_db_prepare_input($HTTP_POST_VARS['references_title']);
        $references_name = tep_db_prepare_input($HTTP_POST_VARS['references_name']);
        $references_email = tep_db_prepare_input($HTTP_POST_VARS['references_email']);
        $references_location = tep_db_prepare_input($HTTP_POST_VARS['references_location']);
        $html_text = tep_db_prepare_input($HTTP_POST_VARS['html_text']);

// make sure testimonials directory exists
		if(!is_dir(DIR_WS_IMAGES . 'uploads_reference_manager'))mkdir(DIR_WS_IMAGES . 'uploads_reference_manager', '777');

		$references_image = new upload('references_image');
        $references_image->set_destination(DIR_WS_IMAGES . 'uploads_reference_manager/');
        $imagefiletypes = array('jpg','jpeg','gif','png','bmp');
        $references_image->set_extensions($imagefiletypes);

        if ($references_image->parse() && $references_image->save()) {
          $references_image_name = $references_image->filename;
        }

        if (empty($references_title)) {
          $references_error = true;
          $messageStack->add('references', ERROR_REFERENCES_TITLE_REQUIRED);
        }
        if (empty($references_name)) {
          $references_error = true;
          $messageStack->add('references', ERROR_REFERENCES_NAME_REQUIRED);
        }
		 if (empty($references_email)) {
          $references_error = true;
          $messageStack->add('references', ERROR_REFERENCES_EMAIL_REQUIRED);
        }
	    if (!tep_validate_email($references_email)) {
          $references_error = true;
          $messageStack->add('references', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
	    }
        if (empty($html_text)) {
          $references_error = true;
          $messageStack->add('references', ERROR_REFERENCES_DESCRIPTION_REQUIRED);
        }

/*** Begin Customer Testimonials v6 ***/
  if (REFERENCES_CAPTCHA == 'Yes') {
// start modification for reCaptcha
        // the response from reCAPTCHA
        $resp = null;

        // was there a reCAPTCHA response?
        $resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

		if (!$resp->is_valid) {
		  $references_error = true;
          $messageStack->add('references', ENTRY_SECURITY_CHECK_ERROR . " (reCAPTCHA output: " . $resp->error . ")");
	}
// end modification for reCaptcha
  }
/*** End Customer Testimonials v6 ***/
  
        if (!$references_error) {
          $sql_data_array = array('references_title' => $references_title,
								  'references_location' => $references_location,
                                  'references_name' => $references_name,
								  'references_email' => $references_email,
                                  'references_html_text' => $html_text,
								  'references_image' => $references_image_name);

		  if ($HTTP_GET_VARS['action'] == 'insert') {
            $insert_sql_data = array('date_added' => 'now()',
                                     'status' => '0');
            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            tep_db_perform(TABLE_SHOP_REFERENCES, $sql_data_array);
            $references_id = tep_db_insert_id();
            // email notification added by maestro
            $email_text = REFERENCES_NOTIFICATION_TEXT . $references_name . REFERENCES_CONJ . $references_location . '.' . "\n\n" .
                          REFERENCES_NOTIFICATION_TITLE . $references_title . "\n\n" .
                          REFERENCES_NOTIFICATION_HTML_TEXT . $html_text . "\n\n" .
                          REFERENCES_NOTIFICATION_APPROVE;
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, REFERENCES_NOTIFICATION_SUBJECT, $email_text, $references_name, $references_email);
          }
          $references_id = '';
          $references_title = '';
		  $references_location = '';
          $references_name = '';
		  $references_email = '';
          $html_text = '';
          tep_redirect(tep_href_link(FILENAME_REFERENCES_WRITE, 'action=success'));
        } else {
          $references_id = tep_db_prepare_input($HTTP_POST_VARS['references_id']);
          $references_title = tep_db_prepare_input($HTTP_POST_VARS['references_title']);
		  $references_location = tep_db_prepare_input($HTTP_POST_VARS['references_location']);
          $references_name = tep_db_prepare_input($HTTP_POST_VARS['references_name']);
		  $references_email = tep_db_prepare_input($HTTP_POST_VARS['references_email']);
          $html_text = tep_db_prepare_input($HTTP_POST_VARS['html_text']);
        }
    }

  $breadcrumb->add(NAVBAR_TITLE2, tep_href_link(FILENAME_REFERENCES_WRITE));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_REFERENCES_WRITE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
