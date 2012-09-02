<?php //$Id: /catalog/free_downloads.php (7051)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_FREE_DOWNLOADS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_FREE_DOWNLOADS));
  ?><head>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  <title><?php echo TITLE; ?></title>
  </head><?php

  $content = CONTENT_FREE_DOWNLOADS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
