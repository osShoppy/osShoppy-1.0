<?php // featured_column infobox 

  if ($random_product = tep_random_select("select p.products_id, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, pd.products_name
  from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'
  left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
  left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
  where p.products_status = '1' and f.status = '1' order by rand() DESC limit " . MAX_DISPLAY_FEATURED_PRODUCTS)) {
                                         
?>
<!-- featured_products //-->
<?php
  $boxHeading = BOX_HEADING_FEATURED;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'featured_column'; // for easy unique box template setup (added BTSv1.2)
  $boxLink = '<a href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    if (tep_not_null($random_product['specials_new_products_price'])) {
      $new_price = '<s>' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</s><br>';
      $new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {
      $new_price = $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
    }

  $boxContent = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], FEATURED_PRODUCTS_INFOBOX_IMAGE_WIDTH, FEATURED_PRODUCTS_INFOBOX_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $new_price;

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxLink = '';
  $boxContent_attributes = '';
?>
<!-- featured_products_eof //-->
<?php
  }
?>
