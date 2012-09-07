<?php // whats_new infobox 

// activate inactivate category /Step-1(1)\
//  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
if(EXCLUDE_GIFT_PRODUCTS_NEW == 'true') {
  if (!empty($hiddencats)) {
    $new_query_raw = "select p.products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where products_carrot = '0' and products_status = '1' and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) group by p.products_id order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW;
  } else {
    $new_query_raw = "select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_carrot = '0' and products_status = '1' and quotes_email_address NOT LIKE '%@%' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW;
  }
} else {
  if (!empty($hiddencats)) {
    $new_query_raw = "select p.products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where products_status = '1' and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) group by p.products_id order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW;
  } else {
    $new_query_raw = "select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' and quotes_email_address NOT LIKE '%@%' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW;
  }
}
  if ($random_product = tep_random_select($new_query_raw)) {

  $boxHeading = BOX_HEADING_WHATS_NEW;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';

  $boxLink = '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

  $box_base_name = 'whats_new';

  $box_id = $box_base_name . 'Box';

    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);

    if (tep_not_null($random_product['specials_new_products_price'])) {
      $whats_new_price = '<s>' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br>';
      $whats_new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {
      $whats_new_price = $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
    }

  $boxContent = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], NEW_PRODUCTS_INFOBOX_IMAGE_WIDTH, NEW_PRODUCTS_INFOBOX_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $whats_new_price;

  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
  $boxContent_attributes = '';
  }
?>