<?php //$Id: /catalog/popup_image.php (osC)

  require('includes/application_top.php');

  $navigation->remove_current_page();

//Product Tabs added queries 2.0 Start
  $products_query = tep_db_query("select pd.products_name, p.products_image, p.products_image_lrg, p.products_image_xl_1, p.products_image_xl_2, p.products_image_xl_3, p.products_image_xl_4, p.products_image_xl_5, p.products_image_xl_6 from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['pID'] . "' and pd.language_id = '" . (int)$languages_id . "'");
  $products = tep_db_fetch_array($products_query);

  $content = CONTENT_POPUP_IMAGE;
  $javascript = $content . '.js';
  $body_attributes = ' onload="resize();"';
  include(bts_select('popup', $content_template));
  require('includes/application_bottom.php');
?>