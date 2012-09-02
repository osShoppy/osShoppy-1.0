<?php //$Id: /catalog/popup_search_help.php (osC)

  require('includes/application_top.php');

  $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $content = CONTENT_POPUP_SEARCH_HELP;
  $body_attributes = ' marginwidth="10" marginheight="10" topmargin="10" bottommargin="10" leftmargin="10" rightmargin="10"';
  include(bts_select('popup', $content_template));
  require('includes/application_bottom.php');
?>
