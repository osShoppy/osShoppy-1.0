<?php // specials_column infobox 

// activate inactivate category /Step-1(1)\
// if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {
if(EXCLUDE_GIFT_SPECIALS == 'true') {
  if (!empty($hiddencats)) {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_carrot = '0' and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' group by p.products_id order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS;
  } else {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_carrot = '0' and p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS;
  }
} else {
  if (!empty($hiddencats)) {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' group by p.products_id order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS;
  } else {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS;
  }
}

if ($random_product = tep_random_select($specials_query_raw)) {

  $boxHeading = BOX_HEADING_SPECIALS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';

  $boxLink = '<a href="' . tep_href_link(FILENAME_SPECIALS) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

  $box_base_name = 'specials_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SPECIALS_INFOBOX_IMAGE_WIDTH, SPECIALS_INFOBOX_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br><s>' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxLink = '';
  $boxContent_attributes = '';

  }
?>

