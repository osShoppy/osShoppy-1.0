<?php // header_tags_column infobox ?>
<!-- header_tags.php //-->
<?php
  $product_info_query = tep_db_query("select pd.products_name, pd.products_description from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_info = tep_db_fetch_array($product_info_query);
  
  $header_tags_array['product'] = strip_tags($header_tags_array['product']);
  $parts = explode(" ", $header_tags_array['product']);
  $header = $parts[0];
  $i = 1;
  while (strlen($header) < 12)
  {
    $header .= ' ' . $parts[$i++];
  }

  $boxHeading = $header;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'header_tags_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $boxContent = strip_tags(substr($product_info['products_description'], 0, 100)).'<a style="color: red;" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . (int)$_GET['products_id']).'"  >  (...' . TEXT_SEE_MORE . ')</a>';
                  
include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- header_tags.php_eof //-->
