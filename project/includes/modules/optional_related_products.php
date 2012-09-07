<?php // catalog/includes/modules/optional_related_products.php (2293)

  $orderBy = 'ORDER BY ';
  $orderBy .= (RELATED_PRODUCTS_RANDOMIZE)?'rand()':'pop_order_id, pop_id';
  $orderBy .= (RELATED_PRODUCTS_MAX_DISP)?' limit ' . RELATED_PRODUCTS_MAX_DISP:'';
  $attributes = "
         SELECT
         pop_products_id_slave,
         products_name,
         products_model,
         products_price,
         products_quantity,
         products_tax_class_id,
         products_image
         FROM " .
         TABLE_PRODUCTS_RELATED_PRODUCTS . ", " .
         TABLE_PRODUCTS_DESCRIPTION . " pa, ".
         TABLE_PRODUCTS . " pb
         WHERE pop_products_id_slave = pa.products_id
         AND pa.products_id = pb.products_id
         AND language_id = '" . (int)$languages_id . "'
         AND pop_products_id_master = '".$HTTP_GET_VARS['products_id']."'
         AND products_status='1' " . $orderBy;
  $attribute_query = tep_db_query($attributes);

  if (mysql_num_rows($attribute_query)>0) {
  $count = 0;

  $boxHeading = BOX_HEADING_RELATED_PRODUCTS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeading"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
               </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
              <tr>
<?php
    while ($attributes_values = tep_db_fetch_array($attribute_query)) {
      $products_name_slave = ($attributes_values['products_name']);
      $products_model_slave = ($attributes_values['products_model']);
      $products_qty_slave = ($attributes_values['products_quantity']);
      $products_id_slave = ($attributes_values['pop_products_id_slave']);
      if ($new_price = tep_get_products_special_price($products_id_slave)) {
        $products_price_slave = $currencies->display_price($new_price, tep_get_tax_rate($attributes_values['products_tax_class_id']));
      } else {
        $products_price_slave = $currencies->display_price($attributes_values['products_price'], tep_get_tax_rate($attributes_values['products_tax_class_id']));
      }
      echo '<td class="productListing-data" align="center">' . "\n";
      // show thumb image if Enabled
      if (RELATED_PRODUCTS_SHOW_THUMBS == 'True') {
        echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id_slave) . '">' . "\n"
             . tep_image(DIR_WS_IMAGES . $attributes_values['products_image'], $attributes_values['products_name'], RELATED_PRODUCTS_MODULE_IMAGE_WIDTH, RELATED_PRODUCTS_MODULE_IMAGE_HEIGHT, 'hspace="5" vspace="5"').'</a><br>' . "\n";
      }
      $caption = '';
      if (RELATED_PRODUCTS_SHOW_NAME == 'True') {
        $caption .= '<p>' . $products_name_slave;
        if (RELATED_PRODUCTS_SHOW_MODEL == 'True') {
          $caption .= sprintf(RELATED_PRODUCTS_MODEL_COMBO, $products_model_slave);
        }
        $caption .= '</p>' . "\n";
      } elseif (RELATED_PRODUCTS_SHOW_MODEL == 'True') {
        $caption .=  '<p>' . $products_model_slave . '</p>' . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_PRICE == 'True') {
        $caption .= '<p>' . sprintf(RELATED_PRODUCTS_PRICE_TEXT, $products_price_slave) . '</p>' . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_QUANTITY == 'True') {
        $caption .= '<p>' . sprintf(RELATED_PRODUCTS_QUANTITY_TEXT, $products_qty_slave) . '</p>' . "\n";
      }
      echo '<a href="'
						. tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id_slave) . '">'
						. $caption . '</a>' . "\n";
      if (RELATED_PRODUCTS_SHOW_BUY_NOW== 'True') {
        echo '<a href="'
						. tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))
						. 'action=rp_buy_now&rp_products_id=' . $products_id_slave) . '">'
						. tep_image_button('button_buy_also.png', IMAGE_BUTTON_BUY_ALSO) . '</a>';
      }
      echo '</td>' . "\n";
      $count++;
      if ((RELATED_PRODUCTS_USE_ROWS == 'True') && ($count%RELATED_PRODUCTS_PER_ROW == 0)) {
        echo '</tr><tr>' . "\n";
      }
    }
?>
                </tr>
               </table>
              </td>
             </tr>
            </table>
           </td>
          </tr>
<?php
}
?>
