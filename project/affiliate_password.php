<?php //$Id: /catalog/affiliate_password.php (0158)

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_PASSWORD);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    $password_current = tep_db_prepare_input($HTTP_POST_VARS['password_current']);
    $password_new = tep_db_prepare_input($HTTP_POST_VARS['password_new']);
    $password_confirmation = tep_db_prepare_input($HTTP_POST_VARS['password_confirmation']);

    $error = false;

    if (strlen($password_current) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('a_password', ENTRY_PASSWORD_CURRENT_ERROR);
    } elseif (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('a_password', ENTRY_PASSWORD_NEW_ERROR);
    } elseif ($password_new != $password_confirmation) {
      $error = true;

      $messageStack->add('a_password', ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $check_affiliate_query = tep_db_query("select affiliate_password from " . TABLE_AFFILIATE . " where affiliate_id = '" . (int)$affiliate_id . "'");
      $check_affiliate = tep_db_fetch_array($check_affiliate_query);

      if (tep_validate_password($password_current, $check_affiliate['affiliate_password'])) {
        tep_db_query("update " . TABLE_AFFILIATE . " set affiliate_password = '" . tep_encrypt_password($password_new) . "' where affiliate_id = '" . (int)$affiliate_id . "'");

        $messageStack->add_session('account', SUCCESS_PASSWORD_UPDATED, 'success');

        tep_redirect(tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL'));
      } else {
        $error = true;

        $messageStack->add('a_password', ERROR_CURRENT_PASSWORD_NOT_MATCHING);
      }
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_AFFILIATE_PASSWORD, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  <?php require('includes/form_check.js.php'); ?>
  </head><?php

  $content = CONTENT_AFFILIATE_PASSWORD;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
