<?php //$Id: /catalog/affiliate_contact.php (0158)

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_CONTACT);

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
    if (tep_validate_email(trim($HTTP_POST_VARS['email']))) {
      tep_mail(STORE_OWNER, AFFILIATE_EMAIL_ADDRESS, EMAIL_SUBJECT, $HTTP_POST_VARS['enquiry'], $HTTP_POST_VARS['name'], $HTTP_POST_VARS['email']);
      tep_redirect(tep_href_link(FILENAME_AFFILIATE_CONTACT, 'action=success'));
    } else {
      $error = true;
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_CONTACT));

  $affiliate_values = tep_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");
  $affiliate = tep_db_fetch_array($affiliate_values);
  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  </head><?php

  $content = CONTENT_AFFILIATE_CONTACT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
