<?php // loginbox infobox 

if ((!strstr($_SERVER['PHP_SELF'],EX_LO_1))and(!strstr($_SERVER['PHP_SELF'],EX_LO_2))and(!strstr($_SERVER['PHP_SELF'],EX_LO_3))and(!strstr($_SERVER['PHP_SELF'],EX_LO_4))and(!strstr($_SERVER['PHP_SELF'],EX_LO_5))and(!strstr($_SERVER['PHP_SELF'],EX_LO_6))and(!strstr($_SERVER['PHP_SELF'],EX_LO_7))and(!strstr($_SERVER['PHP_SELF'],EX_LO_8))and(!strstr($_SERVER['PHP_SELF'],EX_LO_9))and(!strstr($_SERVER['PHP_SELF'],EX_LO_10))and(!strstr($_SERVER['PHP_SELF'],EX_LO_11))and(!strstr($_SERVER['PHP_SELF'],EX_LO_12))and(!strstr($_SERVER['PHP_SELF'],EX_LO_13))and(!strstr($_SERVER['PHP_SELF'],EX_LO_14))and(!strstr($_SERVER['PHP_SELF'],EX_LO_15))
and(!strstr($_SERVER['PHP_SELF'],EX_LO_16))and(!strstr($_SERVER['PHP_SELF'],EX_LO_17))and(!strstr($_SERVER['PHP_SELF'],EX_LO_18))and(!strstr($_SERVER['PHP_SELF'],EX_LO_19))and(!strstr($_SERVER['PHP_SELF'],EX_LO_20))and(!strstr($_SERVER['PHP_SELF'],EX_LO_21))and(!strstr($_SERVER['PHP_SELF'],EX_LO_22))and(!strstr($_SERVER['PHP_SELF'],EX_LO_23))and(!strstr($_SERVER['PHP_SELF'],EX_LO_24))and(!strstr($_SERVER['PHP_SELF'],EX_LO_25))and(!strstr($_SERVER['PHP_SELF'],EX_LO_26))and(!strstr($_SERVER['PHP_SELF'],EX_LO_27))and(!strstr($_SERVER['PHP_SELF'],EX_LO_28))and(!strstr($_SERVER['PHP_SELF'],EX_LO_29))and(!strstr($_SERVER['PHP_SELF'],EX_LO_30))
and
	(!tep_session_is_registered('customer_id')))
 {

  if (!tep_session_is_registered('customer_id')) {

?>
<!-- loginbox //-->
<?php
  $boxHeading = BOX_HEADING_LOGIN_BOX;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'loginbox';

  $box_id = $box_base_name . 'Box';
 	
  $loginboxcontent = tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'))
 								 . BOX_LOGINBOX_EMAIL . '<center>' . tep_draw_input_field('email_address', '', 'size="10" maxlength="100" style="width: ' . (BOX_WIDTH-30) . 'px"')
								 .'<br><br>'
								 . BOX_LOGINBOX_PASSWORD . tep_draw_password_field('password', '', 'size="10" maxlength="40" style="width: ' . (BOX_WIDTH-30) . 'px"')
								 .'<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . BOX_LOGINBOX_FORGOT_PASSWORD . '</a>'
								 . tep_image_submit('button_login.png', IMAGE_BUTTON_LOGIN, 'SSL') . '</form><br><br>'
								 . BOX_LOGINBOX_TEXT_NEW . '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . BOX_LOGINBOX_NEW . '</a>'
								 ;								 
  $boxContent = $loginboxcontent;       
  include (bts_select('boxes', $box_base_name));

} else {
  // If you want to display anything when the user IS logged in, put it
  // in here...  Possibly a "You are logged in as :" box or something.
  }
?>
<!-- loginbox_eof //-->
<?php
} else {
  if (tep_session_is_registered('customer_id')) {
// customer personal notes alert
	$notes_alert_query = tep_db_query("select customers_id, customers_notes_alert from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
	$notes_alert = tep_db_fetch_array($notes_alert_query);

  $accountArray = array();
  $info_box_contents = array();
?>
<!-- my_account_info //-->
<?php
  $boxHeading = BOX_HEADING_LOGIN_BOX_MY_ACCOUNT;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'my_account';

  $info_box_contents = array();

    /********************* 1 BUILD CUSTOMER GREETING ********************/  
  if (USE_CUSTOMER_GREET == 'true') {   
      $accountArray['customer_greet']['string'] = tep_customer_greeting_box(). '<br>';
	  }
    /********************* 2 BUILD MY ACCOUNT LINK ********************/  
  if (USE_LOGIN_ACCOUNT_LINK == 'true') {
      $accountArray['account_link']['sort_order'] = ACCOUNT_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ACCOUNT);
      $accountArray['account_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_MY_ACCOUNT . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 3 BUILD ACCOUNT EDIT LINK ********************/
  if (USE_LOGIN_ACCOUNT_EDIT_LINK == 'true') {    
      $accountArray['account_edit']['sort_order'] = ACCOUNT_EDIT_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ACCOUNT_EDIT);
      $accountArray['account_edit']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_ACCOUNT_EDIT . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 4 BUILD ACCOUNT NOTIFICATIONS LINK ********************/
  if (USE_LOGIN_ACCOUNT_NOTIFICATIONS_LINK == 'true') {    
      $accountArray['account_notifications']['sort_order'] = ACCOUNT_NOTIFICATIONS_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ACCOUNT_NOTIFICATIONS);
      $accountArray['account_notifications']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_ACCOUNT_NOTIFICATIONS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 5 BUILD ACCOUNT HISTORY LINK ********************/
  if (USE_LOGIN_ACCOUNT_HISTORY_LINK == 'true') {    
      $accountArray['account_history']['sort_order'] = ACCOUNT_HISTORY_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ACCOUNT_HISTORY);
      $accountArray['account_history']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_ACCOUNT_HISTORY . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 6 BUILD ADDRES BOOK LINK ********************/
  if (USE_LOGIN_ADDRESS_BOOK_LINK == 'true') {    
      $accountArray['address_book']['sort_order'] = ADDRESS_BOOK_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ADDRESS_BOOK);
      $accountArray['address_book']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_ADDRESS_BOOK . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 7 BUILD SHOPPING CART LINK ********************/
  if (USE_LOGIN_SHOPPING_CART_LINK == 'true') { if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	if ($cart->count_contents() > 0) { 
      $accountArray['shopping_cart_link']['sort_order'] = SHOPPING_CART_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHOPPING_CART);
      $accountArray['shopping_cart_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_SHOPPING_CART . $boldTags['stop'] . '</a><br>'; 
  }
	} else { 
 	if ($cart->count_contents() > 0) {   
      $accountArray['shopping_cart_link']['sort_order'] = SHOPPING_CART_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHOPPING_CART);
      $accountArray['shopping_cart_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_SHOPPING_CART . $boldTags['stop'] . '</a><br>'; 
		} else { 
      $accountArray['shopping_cart_link']['sort_order'] = SHOPPING_CART_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHOPPING_CART);
      $accountArray['shopping_cart_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_SHOPPING_CART . $boldTags['stop'] . '</a><br>'; 
			}
		}
	}	
    /********************* 8 BUILD CHECKOUT SHIPPING LINK ********************/
  if (USE_LOGIN_CHECKOUT_SHIPPING_LINK == 'true') { if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	if ($cart->count_contents() > 0) { 
      $accountArray['checkout_shipping']['sort_order'] = CHECKOUT_SHIPPING_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_CHECKOUT_SHIPPING);
      $accountArray['checkout_shipping']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_CHECKOUT_SHIPPING . $boldTags['stop'] . '</a><br>'; 
  }
	} else { 
 	if ($cart->count_contents() > 0) {   
      $accountArray['checkout_shipping']['sort_order'] = CHECKOUT_SHIPPING_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_CHECKOUT_SHIPPING);
      $accountArray['checkout_shipping']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_CHECKOUT_SHIPPING . $boldTags['stop'] . '</a><br>'; 
		} else { 
      $accountArray['checkout_shipping']['sort_order'] = CHECKOUT_SHIPPING_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_CHECKOUT_SHIPPING);
      $accountArray['checkout_shipping']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_CHECKOUT_SHIPPING . $boldTags['stop'] . '</a><br>'; 
			}
		}
	}	
    /********************* 9 BUILD AFFILIATE LINK ********************/
  if (USE_LOGIN_AFFILIATE_LINK == 'true') {    
      $accountArray['affiliate']['sort_order'] = AFFILIATE_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_AFFILIATE);
      $accountArray['affiliate']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_AFFILIATE, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_AFFILIATE . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 10 BUILD SUBMIT ARTICLE LINK ********************/
  if (USE_LOGIN_SUBMIT_ARTICLE_LINK == 'true') {    
      $accountArray['submit_article']['sort_order'] = SUBMIT_ARTICLE_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ARTICLE_SUBMIT);
      $accountArray['submit_article']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ARTICLE_SUBMIT, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_ARTICLE_SUBMIT . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 11 BUILD SUBMIT ARTICLE LINK ********************/
  if (USE_LOGIN_SUBMIT_FAQ_ARTICLE_LINK == 'true') {    
      $accountArray['submit_faq_article']['sort_order'] = SUBMIT_FAQ_ARTICLE_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FAQS_SUBMIT);
      $accountArray['submit_faq_article']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_FAQS_SUBMIT, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_FAQ_ARTICLE_SUBMIT . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 12 BUILD SUBMIT ARTICLE LINK ********************/
  if (USE_LOGIN_SUBMIT_INFO_ARTICLE_LINK == 'true') {    
      $accountArray['submit_info_article']['sort_order'] = SUBMIT_INFO_ARTICLE_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_GENERAL_INFORMATION_SUBMIT);
      $accountArray['submit_info_article']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_GENERAL_INFORMATION_SUBMIT, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_INFO_ARTICLE_SUBMIT . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 13 BUILD RECENTLY VIEWED LINK ********************/
  if (USE_LOGIN_RECENTLY_VIEWED_LINK == 'true') {    
      $accountArray['recently_viewed']['sort_order'] = RECENTLY_VIEWED_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_RECENTLY_VIEWED);
      $accountArray['recently_viewed']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_RECENTLY_VIEWED, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_RECENTLY_VIEWED . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 14 BUILD WISHLIST LINK ********************/
  if (USE_LOGIN_WISHLIST_LINK == 'true') {    
      $accountArray['wishlist']['sort_order'] = WISHLIST_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_WISHLIST);
      $accountArray['wishlist']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'NONSSL') . '">' . $boldTags['start'] . LOGIN_BOX_WISHLIST . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* 15 BUILD SHOPPING CART ********************/
  if (USE_LOGIN_SHOPPING_CART == 'true') { if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	if ($cart->count_contents() > 0) { 
      $accountArray['shopping_cart']['sort_order'] = SHOPPING_CART_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHOPPING_CART);
      $accountArray['shopping_cart']['string'] = '<table border="0"><td><a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full-small.png',SHOPPING_BAG_CART_FULL) .'</a></td><td class="shoppingNavigation">'. ITEM_IN_CART .'&nbsp;'. $cart->count_contents()  .'<br>'. TOTAL_AMOUNT .'&nbsp;'. $currencies->format($cart->show_total()) . '</td></table>'; 
  }
	} else { 
 	if ($cart->count_contents() > 0) {   
      $accountArray['shopping_cart']['sort_order'] = SHOPPING_CART_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHOPPING_CART);
      $accountArray['shopping_cart']['string'] = '<table border="0"><td><a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full-small.png',SHOPPING_BAG_CART_FULL) .'</a></td><td class="shoppingNavigation">'. ITEM_IN_CART .'&nbsp;'. $cart->count_contents()  .'<br>'. TOTAL_AMOUNT .'&nbsp;'. $currencies->format($cart->show_total()) . '</td></table>'; 
		} else { 
      $accountArray['shopping_cart']['sort_order'] = SHOPPING_CART_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHOPPING_CART);
      $accountArray['shopping_cart']['string'] = '<table border="0"><td><a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-empty-small.png',SHOPPING_BAG_CART_FULL) .'</a></td><td class="shoppingNavigation">'. ITEM_IN_CART .'&nbsp;'. $cart->count_contents()  .'<br>'. TOTAL_AMOUNT .'&nbsp;'. $currencies->format($cart->show_total()) . '</td></table>'; 
			}
		}
	}	
    /********************* 16 BUILD BUTTON LOGOFF ********************/
  if (USE_LOGIN_BUTTON_LOGOFF == 'true') {   
      $accountArray['button_logoff']['sort_order'] = BUTTON_LOGOFF_SORT_ORDER;
	  $accountArray['button_logoff']['string'] = '<br><center><a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . tep_image_button('button_logoff.png', IMAGE_BUTTON_LOGOFF) . '</a></center><br>';
  }
    /********************* 17 BUILD CUSTOMER NOTES ALERT ********************/  
  if (USE_LOGIN_NOTES_ALERT == 'true') {   
      $accountArray['customer_notes_alert']['sort_order'] = NOTES_ALERT_SORT_ORDER;
      $accountArray['customer_notes_alert']['string'] = '<center>'. $notes_alert['customers_notes_alert'] . '</center>';
	  }

    /********************* 18 BUILD CUSTOMER GROUP NOTICE ********************/  
  if (USE_LOGIN_CUSTOMER_GROUP == 'true') {   
   if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
    if ($customer_group_id == '0' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_RETAIL .'<br><br>';
	}
    if ($customer_group_id == '1' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_1 .'<br><br>';
	}
    if ($customer_group_id == '2' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_2 .'<br><br>';
	}
    if ($customer_group_id == '3' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_3 .'<br><br>';
	}
    if ($customer_group_id == '4' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_4 .'<br><br>';
	}
    if ($customer_group_id == '5' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_5 .'<br><br>';
	}
    if ($customer_group_id == '6' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_6 .'<br><br>';
	}
    if ($customer_group_id == '7' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_7 .'<br><br>';
	}
    if ($customer_group_id == '8' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_8 .'<br><br>';
	}
    if ($customer_group_id == '9' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_9 .'<br><br>';
	}
    if ($customer_group_id == '10' ) {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = '<br>' . TEXT_SPPC_COMPANY_10 .'<br><br>';
	}

   } else {
      $accountArray['customer_group']['sort_order'] = CUSTOMER_GROUP_SORT_ORDER;
      $accountArray['customer_group']['string'] = TEXT_SPPC_LOGGED_OFF;
   }
  }

    /********************* 19 BUILD CREDIT CLASS GIFT VOUCHER ********************/  
  if (USE_LOGIN_COUPON == 'true') {   
    if (tep_session_is_registered('gv_id')) {
      $gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
      $coupon = tep_db_fetch_array($gv_query);
      $accountArray['coupon']['sort_order'] = COUPON_SORT_ORDER;
      $accountArray['coupon']['string'] = VOUCHER_REDEEMED . '' . $currencies->format($coupon['coupon_amount']);
    }
    if (tep_session_is_registered('cc_id') && $cc_id) {
      $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
      $coupon = tep_db_fetch_array($coupon_query);
      $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_id . "' and language_id = '" . $languages_id . "'");
      $coupon_desc = tep_db_fetch_array($coupon_desc_query);
      $text_coupon_help = sprintf("%s",$coupon_desc['coupon_name']);
      $accountArray['coupon']['sort_order'] = COUPON_SORT_ORDER;
      $accountArray['coupon']['string'] = CART_COUPON . '<font color="green"><b>' . $text_coupon_help . '</font></b><br>';
    } 
  }

usort($accountArray, "SortBySetting"); 
    
  /********************* DISPLAY IT ALL ********************/  
  
  $final = '';
  foreach ($accountArray as $item)
  {
     $final .= $item['string'] .'';
  }
  $final = substr($final, 0, -4);

  $boxContent = $final;
  $box_id = $box_base_name . 'Box';
  include (bts_select('boxes', $box_base_name));
?>
<!-- my_account_info_eof //-->
<?php 
  }   
} 
?>