<?php //$Id: /catalog/extra_info_pages.php (2021)

  require('includes/application_top.php');

  $infopageid = (int)$HTTP_GET_VARS['pages_id'];

  $page_query = tep_db_query("select p.pages_id, p.status, s.pages_title, s.pages_html_text from " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where s.language_id = '" . (int)$languages_id . "' and p.pages_id = $infopageid");

  $page_check = tep_db_fetch_array($page_query);
  $breadcrumb->add($page_check[pages_title], tep_href_link('info_pages.php?pages_id=' . $infopageid));

  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_PAGES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
