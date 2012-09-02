<?php //$Id: /catalog/faq.php (1948)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_FAQ);

  $breadcrumb->add(FAQ_NAVBAR_TITLE, tep_href_link(FILENAME_FAQ, '', 'NONSSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_FAQ;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
