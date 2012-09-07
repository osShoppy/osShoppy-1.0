<?php // shopping_cart infobox 

  $boxHeading = BOX_HEADING_SHOPPING_CART;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';

  $box_base_name = 'shopping_cart';

  $box_id = $box_base_name . 'Box';

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

	//$boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';
 	if ($products[$i]['carrot'] == "1")
	{
	$boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents">';
	} else {
	$boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';
	}

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

	//$boxContent .= $products[$i]['name'] . '</span></a></td></tr>';
	if ($products[$i]['carrot'] == "1")
	{    
	$boxContent .= $products[$i]['name'] . '</span></td></tr>';
	} else {
	$boxContent .= $products[$i]['name'] . '</span></a></td></tr>';
	}

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

// Start - CREDIT CLASS Gift Voucher Contribution
  if (tep_session_is_registered('customer_id')) {
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
    if ($gv_result['amount'] > 0 ) {
      $boxContent .= '<br><br>' . tep_draw_separator();
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . VOUCHER_BALANCE . '</td><td class="smalltext" align="right" valign="bottom">' . $currencies->format($gv_result['amount']) . '</td></tr></table>';
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext"><a href="'. tep_href_link(FILENAME_GV_SEND) . '">' . BOX_SEND_TO_FRIEND . '</a></td></tr></table><br>';
    }
  }
  if (tep_session_is_registered('gv_id')) {
    $gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon = tep_db_fetch_array($gv_query);
      $boxContent .= tep_draw_separator();
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="smalltext">' . VOUCHER_REDEEMED . '</td><td class="smalltext" align="right" valign="bottom">' . $currencies->format($coupon['coupon_amount']) . '</td></tr></table>';

  }
if (tep_session_is_registered('cc_id') && $cc_id) {
 $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
 $coupon = tep_db_fetch_array($coupon_query);
 $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_id . "' and language_id = '" . $languages_id . "'");
 $coupon_desc = tep_db_fetch_array($coupon_desc_query);
 $text_coupon_help = sprintf("%s",$coupon_desc['coupon_name']);
      $boxContent .= tep_draw_separator();
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td class="infoBoxContents">' . CART_COUPON . '<font color="green"><b>' . $text_coupon_help . '</font></b><br>' . '</td></tr></table>';
   }  
// End - CREDIT CLASS Gift Voucher Contribution
#### Points/Rewards Module V2.1rc2a BOF ####
  if (USE_REDEEM_SYSTEM == 'true') {
	  $has_points = tep_get_shopping_points($customer_id);
	  if ($has_points > 0) {
      $boxContent .= tep_draw_separator();
      $boxContent .= '<table cellpadding="0" width="100%" cellspacing="0" border="0"><tr><td align="center" class="smalltext"><b><a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">'. TEXT_POINTS_BALANCE . '</a></b></tr></td><tr><td class="smalltext" align="right" valign="bottom">' . TEXT_POINTS .'&nbsp;'. number_format($has_points,POINTS_DECIMAL_PLACES) .'</tr></td><tr><td class="smalltext" align="right" valign="bottom">' .  TEXT_VALUE . $currencies->format(tep_calc_shopping_pvalue($has_points)) . '</td></tr></table>';
	  }
  }
#### Points/Rewards Module V2.1rc2a EOF ####

  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
?>