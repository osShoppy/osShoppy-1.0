<?php //$Id: /catalog/account_activate_succes.php (5241)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_ACTIVATE);

  $breadcrumb->add(NAVBAR_TITLE_1_ACTIVATION);
  $breadcrumb->add(NAVBAR_TITLE_2_ACTIVATION);

  if (sizeof($navigation->snapshot) > 0) {
    $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
    $navigation->clear_snapshot();
  } else {
    $origin_href = tep_href_link(FILENAME_DEFAULT);
  }
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ACCOUNT_ACTIVATE_SUCCESS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
