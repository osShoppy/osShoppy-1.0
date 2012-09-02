<?php //$Id: /catalog/customer_testimonials_write.php (5477)

  require('includes/application_top.php');

/*** Begin Customer Testimonials v6 ***/
// Redirect user to login page if any of the following are true:
// 1) Admin has disabled Customer Testimonials mod; or 
// 2) only registered users permitted to write testimonials and user is not logged in
  if ((TESTIMONIAL_ACTIVE != 'Yes') || (TESTIMONIAL_REGISTERED_WRITE == "Disabled") || ((TESTIMONIAL_REGISTERED_WRITE == "Registered Users Only") && (!tep_session_is_registered('customer_id')))) 
  {
  	    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
/*** End Customer Testimonials v6 ***/ 

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CUSTOMER_TESTIMONIALS);

/*** Begin Customer Testimonials v6 ***/
  if (TESTIMONIAL_CAPTCHA == 'Yes') {
// start modification for reCaptcha
  require_once('includes/classes/recaptchalib.php');
// end modification for reCaptcha
	}
/*** End Customer Testimonials v6 ***/

    $testimonials_error = false;
    if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'insert')) {
        $testimonials_id = tep_db_prepare_input($HTTP_POST_VARS['testimonials_id']);
        $testimonials_title = tep_db_prepare_input($HTTP_POST_VARS['testimonials_title']);
        $testimonials_name = tep_db_prepare_input($HTTP_POST_VARS['testimonials_name']);
        $testimonials_email = tep_db_prepare_input($HTTP_POST_VARS['testimonials_email']);
        $testimonials_location = tep_db_prepare_input($HTTP_POST_VARS['testimonials_location']);
        $html_text = tep_db_prepare_input($HTTP_POST_VARS['html_text']);

// make sure testimonials directory exists
		if(!is_dir(DIR_WS_IMAGES . 'uploads_testimonial_manager'))mkdir(DIR_WS_IMAGES . 'uploads_testimonial_manager', '777');

		$testimonial_image = new upload('testimonial_image');
        $testimonial_image->set_destination(DIR_WS_IMAGES . 'uploads_testimonial_manager/');
        $imagefiletypes = array('jpg','jpeg','gif','png','bmp');
        $testimonial_image->set_extensions($imagefiletypes);

        if ($testimonial_image->parse() && $testimonial_image->save()) {
          $testimonial_image_name = $testimonial_image->filename;
        }

        if (empty($testimonials_title)) {
          $testimonials_error = true;
          $messageStack->add('testimonials', ERROR_TESTIMONIALS_TITLE_REQUIRED);
        }
        if (empty($testimonials_name)) {
          $testimonials_error = true;
          $messageStack->add('testimonials', ERROR_TESTIMONIALS_NAME_REQUIRED);
        }
		 if (empty($testimonials_email)) {
          $testimonials_error = true;
          $messageStack->add('testimonials', ERROR_TESTIMONIALS_EMAIL_REQUIRED);
        }
	    if (!tep_validate_email($testimonials_email)) {
          $testimonials_error = true;
          $messageStack->add('testimonials', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
	    }
        if (empty($html_text)) {
          $testimonials_error = true;
          $messageStack->add('testimonials', ERROR_TESTIMONIALS_DESCRIPTION_REQUIRED);
        }

/*** Begin Customer Testimonials v6 ***/
  if (TESTIMONIAL_CAPTCHA == 'Yes') {
// start modification for reCaptcha
        // the response from reCAPTCHA
        $resp = null;

        // was there a reCAPTCHA response?
        $resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);

		if (!$resp->is_valid) {
		  $testimonials_error = true;
          $messageStack->add('testimonials', ENTRY_SECURITY_CHECK_ERROR . " (reCAPTCHA output: " . $resp->error . ")");
	}
// end modification for reCaptcha
  }
/*** End Customer Testimonials v6 ***/
  
        if (!$testimonials_error) {
          $sql_data_array = array('testimonials_title' => $testimonials_title,
								  'testimonials_location' => $testimonials_location,
                                  'testimonials_name' => $testimonials_name,
								  'testimonials_email' => $testimonials_email,
                                  'testimonials_html_text' => $html_text,
								  'testimonial_image' => $testimonial_image_name);

		  if ($HTTP_GET_VARS['action'] == 'insert') {
            $insert_sql_data = array('date_added' => 'now()',
                                     'status' => '0');
            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            tep_db_perform(TABLE_CUSTOMER_TESTIMONIALS, $sql_data_array);
            $testimonials_id = tep_db_insert_id();
            // email notification added by maestro
            $email_text = TESTIMONIAL_NOTIFICATION_TEXT . $testimonials_name . TESTIMONIAL_CONJ . $testimonials_location . '.' . "\n\n" .
                          TESTIMONIAL_NOTIFICATION_TITLE . $testimonials_title . "\n\n" .
                          TESTIMONIAL_NOTIFICATION_HTML_TEXT . $html_text . "\n\n" .
                          TESTIMONIAL_NOTIFICATION_APPROVE;
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, TESTIMONIAL_NOTIFICATION_SUBJECT, $email_text, $testimonials_name, $testimonials_email);
          }
          $testimonials_id = '';
          $testimonials_title = '';
		  $testimonials_location = '';
          $testimonials_name = '';
		  $testimonials_email = '';
          $html_text = '';
          tep_redirect(tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS_WRITE, 'action=success'));
        } else {
          $testimonials_id = tep_db_prepare_input($HTTP_POST_VARS['testimonials_id']);
          $testimonials_title = tep_db_prepare_input($HTTP_POST_VARS['testimonials_title']);
		  $testimonials_location = tep_db_prepare_input($HTTP_POST_VARS['testimonials_location']);
          $testimonials_name = tep_db_prepare_input($HTTP_POST_VARS['testimonials_name']);
		  $testimonials_email = tep_db_prepare_input($HTTP_POST_VARS['testimonials_email']);
          $html_text = tep_db_prepare_input($HTTP_POST_VARS['html_text']);
        }
    }

  $breadcrumb->add(NAVBAR_TITLE2, tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS_WRITE));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_CUSTOMER_TESTIMONIALS_WRITE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
