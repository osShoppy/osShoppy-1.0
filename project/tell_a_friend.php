<?php //$Id: /catalog/tell_a_friend.php (osC)

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id') && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
/**** BEGIN ARTICLE MANAGER ****/
/* original
  $valid_product = false;
  if (isset($HTTP_GET_VARS['products_id'])) {
    $product_info_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($product_info_query)) {
      $valid_product = true;

      $product_info = tep_db_fetch_array($product_info_query);
    }
  }

  if ($valid_product == false) {
    tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id']));
  }
*/

  $valid_product = false;
  if (isset($HTTP_GET_VARS['products_id'])) {
    $product_info_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($product_info_query)) {
      $valid_product = true;

      $product_info = tep_db_fetch_array($product_info_query);
    } else {
      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id']));
    }
  }

  $valid_article = false;
  if (isset($HTTP_GET_VARS['articles_id'])) {
    $article_info_query = tep_db_query("select pd.articles_name from " . TABLE_ARTICLES . " p, " . TABLE_ARTICLES_DESCRIPTION . " pd where p.articles_status = '1' and p.articles_id = '" . (int)$HTTP_GET_VARS['articles_id'] . "' and p.articles_id = pd.articles_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($article_info_query)) {
      $valid_article = true;

      $article_info = tep_db_fetch_array($article_info_query);
    } else {
      tep_redirect(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $HTTP_GET_VARS['articles_id']));
    }
  }
/**** END ARTICLE MANAGER ****/
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TELL_A_FRIEND);

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $error = false;

    $to_email_address = tep_db_prepare_input($HTTP_POST_VARS['to_email_address']);
    $to_name = tep_db_prepare_input($HTTP_POST_VARS['to_name']);
    $from_email_address = tep_db_prepare_input($HTTP_POST_VARS['from_email_address']);
    $from_name = tep_db_prepare_input($HTTP_POST_VARS['from_name']);
    $message = tep_db_prepare_input($HTTP_POST_VARS['message']);

    if (empty($from_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_NAME);
    }

    if (!tep_validate_email($from_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }

    if (empty($to_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_NAME);
    }

    if (!tep_validate_email($to_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }

    if ($error == false) {
      if ($valid_product) {
//---  Beginning of addition: Ultimate HTML Emails  ---//
if (EMAIL_USE_HTML == 'true') {
	require(DIR_WS_MODULES . 'html_mail/'. HTML_EMAIL_LAYOUT .'/tell_a_friend.php');
	$email_body = $html_email;
}else{//Send text email
//---  End of addition: Ultimate HTML Emails  ---//
      $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $product_info['products_name'], STORE_NAME) . "\n\n";

      if (tep_not_null($message)) {
        $email_body .= $message . "\n\n";
      }

      $email_body .= sprintf(TEXT_EMAIL_LINK, tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL', false)) . "\n\n" .
                     sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

//---  Beginning of addition: Ultimate HTML Emails  ---//
}

if(HTML_EMAIL_DEVELOPMENT_MODE === 'true'){
	//Save the contents of the generated html email to the harddrive in .htm file. This can be practical when developing a new layout.
	$TheFileName = 'Last_mail_from_tell_a_friend.htm';
	$TheFileHandle = fopen($TheFileName, 'w') or die("can't open error log file");
	fwrite($TheFileHandle, $email_body);
	fclose($TheFileHandle);
}
//---  End of addition: Ultimate HTML Emails  ---//
	if (EMAIL_USE_HTML == 'true') {
		tep_mail($to_name, $to_email_address, UHE_SUBJECT, $email_body, $from_name, $from_email_address);
	} else {
		tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);
	}
	
        $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], tep_output_string_protected($to_name)), 'success');

        tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id']));

        /**** BEGIN ARTICLE MANAGER ****/
        } else if ($valid_article) {
//---  Beginning of addition: Ultimate HTML Emails  ---//
if (EMAIL_USE_HTML == 'true') {
	require(DIR_WS_MODULES . 'html_mail/'. HTML_EMAIL_LAYOUT .'/tell_a_friend_article.php');
	$email_body = $html_email;
}else{//Send text email
//---  End of addition: Ultimate HTML Emails  ---//
          $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
          $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $article_info['articles_name'], STORE_NAME) . "\n\n";

          if (tep_not_null($message)) {
            $email_body .= $message . "\n\n";
          }

          $email_body .= sprintf(TEXT_EMAIL_LINK_ARTICLE, tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $HTTP_GET_VARS['articles_id'])) . "\n\n" .
                         sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

//---  Beginning of addition: Ultimate HTML Emails  ---//
}

if(HTML_EMAIL_DEVELOPMENT_MODE === 'true'){
	//Save the contents of the generated html email to the harddrive in .htm file. This can be practical when developing a new layout.
	$TheFileName = 'Last_mail_from_tell_a_friend_article.htm';
	$TheFileHandle = fopen($TheFileName, 'w') or die("can't open error log file");
	fwrite($TheFileHandle, $email_body);
	fclose($TheFileHandle);
}
//---  End of addition: Ultimate HTML Emails  ---//
	if (EMAIL_USE_HTML == 'true') {
		tep_mail($to_name, $to_email_address, UHE_SUBJECT, $email_body, $from_name, $from_email_address);
	} else {
		tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);
	}

          $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $article_info['articles_name'], tep_output_string_protected($to_name)), 'success');

          tep_redirect(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $HTTP_GET_VARS['articles_id']));
          }
          /**** END ARTICLE MANAGER ****/
    }
  } elseif (tep_session_is_registered('customer_id')) {
    $account_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

  /**** BEGIN ARTICLE MANAGER ****/
  if ($valid_product) {
    $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $HTTP_GET_VARS['products_id']));
    } else if ($valid_article) {
      $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'articles_id=' . $HTTP_GET_VARS['articles_id']));
      }
  /**** END ARTICLE MANAGER ****/
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_TELL_A_FRIEND;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
