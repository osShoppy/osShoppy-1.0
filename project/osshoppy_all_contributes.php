<?php //$Id: /catalog/osshopyy_all_contributes.php (osS)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_OSSHOPPY_ALL_CONTRIBUTES);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_OSSHOPPY_ALL_CONTRIBUTES));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_OSSHOPPY_ALL_CONTRIBUTES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
