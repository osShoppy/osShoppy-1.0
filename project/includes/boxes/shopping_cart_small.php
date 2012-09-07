<?php // image_in_cart_box infobox //shopping cart in column left or right

  if ((!strstr($_SERVER['PHP_SELF'],EX_SCSM_1))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_2))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_3))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_4))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_5))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_6))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_7))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_8))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_9))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_10))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_11))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_12))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_13))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_14))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_15))
  and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_16))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_17))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_18))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_19))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_20))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_21))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_22))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_23))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_24))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_25))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_26))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_27))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_28))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_29))and(!strstr($_SERVER['PHP_SELF'],EX_SCSM_30))
  ){

    $any_out_of_stock = 0;
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        while (list($option, $value) = each($products[$i]['attributes'])) {
          echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . $products[$i]['id'] . "'
                                       and pa.options_id = '" . $option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . $value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . $languages_id . "'
                                       and poval.language_id = '" . $languages_id . "'");
          $attributes_values = tep_db_fetch_array($attributes);

          $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
          $products[$i][$option]['options_values_id'] = $value;
          $products[$i][$option]['products_options_values_name'] = $attributes_values['products_options_values_name'];
          $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
          $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
        }
      }
    }

  for ($i=0, $n=sizeof($products); $i<$n; $i++) {


    $my_products_id= $products[$i]['id'];
     }

  $boxHeading = BOX_HEADING_SHOPPING_CART;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'shopping_cart_small';

  $box_id = $box_base_name . 'Box';
  $boxContent = '<center>';
  include (bts_select('boxes', $box_base_name));
}
?>