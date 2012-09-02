<?php //$Id: /catalog/cookie_usage.php (osC)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_COOKIE_USAGE);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_COOKIE_USAGE));
?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_COOKIE_USAGE;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
