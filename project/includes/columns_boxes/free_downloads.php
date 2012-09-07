<?php // free_downloads infobox

  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' and products_price = '0' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
 
    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);

  $boxHeading = BOX_HEADING_FREE_DOWNLOADS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_FREE_DOWNLOADS) . '"><img src="images/infobox/arrow_right_3.gif" border="0" alt="more" title="more" width="12" height="10"></a>';

    if (tep_not_null($random_product['specials_new_products_price'])) {
      $free_downloads_price = '<s>' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br>';
      $free_downloads_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {
      $free_downloads_price = $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
    }
$sql = 'SELECT `products_description` FROM `products_description` WHERE products_id ='.$random_product['products_id'].' && language_id='.(int)$languages_id;
	$description_query = tep_db_query($sql);
	$description = mysql_fetch_array($description_query, MYSQL_ASSOC);        
	$description['products_description'] = substr($description['products_description'], 0, 80);
	$desc_len = strlen($description['products_description']);
$description['products_description'][$desc_len-1] = '.';
	$description['products_description'][$desc_len-2] = '.';
	$description['products_description'][$desc_len-3] = '.';
    $info_box_contents = array();
    $free_downloads = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], FREE_DOWNLOADS_INFOBOX_IMAGE_WIDTH, FREE_DOWNLOADS_INFOBOX_IMAGE_HEIGHT) . '</a><br><strong><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a></strong><br><br><a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $random_product['products_id']) . '">' . tep_image_button('button_in_cart.png', IMAGE_BUTTON_IN_CART) . '</a>&nbsp;' . $free_downloads_price . '<br>' . strip_tags($description['products_description']) . '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']). '">...' . TEXT_READ_MORE . '</a>';

  $box_base_name = 'free_downloads_column';
  $box_id = $box_base_name . 'Box';
  $boxContent = $free_downloads;
  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
  }
?>