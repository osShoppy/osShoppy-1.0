<?php //$Id: /catalog/affiliate_newsletter.php (0158)

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_NEWSLETTER);

  $newsletter_query = tep_db_query("select affiliate_newsletter from " . TABLE_AFFILIATE . " where affiliate_id = '" . (int)$affiliate_id . "'");
  $newsletter = tep_db_fetch_array($newsletter_query);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    if (isset($HTTP_POST_VARS['newsletter_affiliate']) && is_numeric($HTTP_POST_VARS['newsletter_affiliate'])) {
      $newsletter_affiliate = tep_db_prepare_input($HTTP_POST_VARS['newsletter_affiliate']);
    } else {
      $newsletter_affiliate = '0';
    }

    if ($newsletter_affiliate != $newsletter['affiliate_newsletter']) {
      $newsletter_affiliate = (($newsletter['affiliate_newsletter'] == '1') ? '0' : '1');

      tep_db_query("update " . TABLE_AFFILIATE . " set affiliate_newsletter = '" . (int)$newsletter_affiliate . "' where affiliate_id = '" . (int)$affiliate_id . "'");
    }

    $messageStack->add_session('account', SUCCESS_NEWSLETTER_UPDATED, 'success');

    tep_redirect(tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL'));
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_AFFILIATE_NEWSLETTER, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title></head>
  <script language="javascript"><!--
  function rowOverEffect(object) {
    if (object.className == 'moduleRow') object.className = 'moduleRowOver';
  }

  function rowOutEffect(object) {
    if (object.className == 'moduleRowOver') object.className = 'moduleRow';
  }
  function checkBox(object) {
    document.account_newsletter.elements[object].checked = !document.account_newsletter.elements[object].checked;
  }
  //--></script>
  <?php

  $content = CONTENT_AFFILIATE_NEWSLETTER;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
