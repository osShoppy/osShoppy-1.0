<?php //$Id: /catalog/affiliate_terms.php (0158)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_TERMS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_TERMS));
  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  </head><?php

  $content = CONTENT_AFFILIATE_TERMS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
