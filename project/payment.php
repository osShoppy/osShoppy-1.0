<?php //$Id: /catalog/shipping.php (osS)

  require('includes/application_top.php');

  // extra info pages
  $page_query = tep_db_query("select p.pages_id, p.sort_order, p.status, s.pages_title, s.pages_html_text from " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where p.status = 1 and s.language_id = '" . (int)$languages_id . "' and p.page_type = 6");
  $page_check = tep_db_fetch_array($page_query);
  $pagetext=stripslashes($page_check[pages_html_text]);
  // extra info pages_eof

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PAYMENT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PAYMETN));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_PAYMENT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
