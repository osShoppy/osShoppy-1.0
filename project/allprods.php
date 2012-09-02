<?php //$Id: /catalog/allprods.php (1501)

  require('includes/application_top.php'); 
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ALLPRODS); 

  $firstletter=$HTTP_GET_VARS['fl'];
  $where="where pd.products_name like '$firstletter%' AND p.products_status='1' ";

  $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_ALLPRODS, '', 'NONSSL')); 
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ALLPRODS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
