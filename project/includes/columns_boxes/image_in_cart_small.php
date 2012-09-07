<?php // image_in_cart_small infobox // shopping cart in header navigation

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
?>
            <table border="0">
			<td>
			<?php if ($cart->count_contents() > 0) {
					echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full-small.png',SHOPPING_BAG_CART_FULL) .'</a>';
			} else {
				    echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-empty-small.png',SHOPPING_BAG_CART_EMPTY) .'</a>'; 
			} ?></td>
            <td class="shoppingNavigation"><?php echo ITEM_IN_CART; ?>&nbsp;<?php echo $cart->count_contents(); ?>&nbsp;::&nbsp;<?php echo TOTAL_AMOUNT;?>&nbsp;<?php echo $currencies->format($cart->show_total());?>&nbsp;&nbsp;</td>
			</td></table>
