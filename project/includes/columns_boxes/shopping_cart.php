<?php // shopping_cart_column infobox 

  $boxHeading = BOX_HEADING_SHOPPING_CART;
  $corner_top_left = 'square';
  $corner_top_right = 'rounded';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

  $box_base_name = 'shopping_cart_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '';
  if ($cart->count_contents() > 0) {
    $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $boxContent .= '<tr><td align="right" valign="top" class="infoBoxContents">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

      $boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

      $boxContent .= $products[$i]['name'] . '</span></a></td></tr>';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        tep_session_unregister('new_products_id_in_cart');
      }
    }

    $boxContent .= '</table>';

  } else {
    $boxContent .= BOX_SHOPPING_CART_EMPTY;
  }


  if ($cart->count_contents() > 0) {
    $boxContent .= tep_draw_separator();
    $boxContent .= '<div align="right">' . $currencies->format($cart->show_total()) . '</div>';
  }

include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxLink = '';
?>
