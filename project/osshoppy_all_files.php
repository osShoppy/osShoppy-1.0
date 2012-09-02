<?php //$Id: /catalog/osshopy_all_files.php (osS)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_OSSHOPPY_ALL_FILES);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_OSSHOPPY_ALL_FILES));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_OSSHOPPY_ALL_FILES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
