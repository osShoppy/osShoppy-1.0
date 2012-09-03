<?php /* Myaccount infobox template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_MY_1))and(!strstr($_SERVER['PHP_SELF'],EX_MY_2))and(!strstr($_SERVER['PHP_SELF'],EX_MY_3))and(!strstr($_SERVER['PHP_SELF'],EX_MY_4))and(!strstr($_SERVER['PHP_SELF'],EX_MY_5))and(!strstr($_SERVER['PHP_SELF'],EX_MY_6))and(!strstr($_SERVER['PHP_SELF'],EX_MY_7))and(!strstr($_SERVER['PHP_SELF'],EX_MY_8))and(!strstr($_SERVER['PHP_SELF'],EX_MY_9))and(!strstr($_SERVER['PHP_SELF'],EX_MY_10))and(!strstr($_SERVER['PHP_SELF'],EX_MY_11))and(!strstr($_SERVER['PHP_SELF'],EX_MY_12))and(!strstr($_SERVER['PHP_SELF'],EX_MY_13))and(!strstr($_SERVER['PHP_SELF'],EX_MY_14))and(!strstr($_SERVER['PHP_SELF'],EX_MY_15))
and(!strstr($_SERVER['PHP_SELF'],EX_MY_16))and(!strstr($_SERVER['PHP_SELF'],EX_MY_17))and(!strstr($_SERVER['PHP_SELF'],EX_MY_18))and(!strstr($_SERVER['PHP_SELF'],EX_MY_19))and(!strstr($_SERVER['PHP_SELF'],EX_MY_20))and(!strstr($_SERVER['PHP_SELF'],EX_MY_21))and(!strstr($_SERVER['PHP_SELF'],EX_MY_22))and(!strstr($_SERVER['PHP_SELF'],EX_MY_23))and(!strstr($_SERVER['PHP_SELF'],EX_MY_24))and(!strstr($_SERVER['PHP_SELF'],EX_MY_25))and(!strstr($_SERVER['PHP_SELF'],EX_MY_26))and(!strstr($_SERVER['PHP_SELF'],EX_MY_27))and(!strstr($_SERVER['PHP_SELF'],EX_MY_28))and(!strstr($_SERVER['PHP_SELF'],EX_MY_29))and(!strstr($_SERVER['PHP_SELF'],EX_MY_30))
){
?>
<tr>
 <td>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
         <td height="14" class="infoBoxHeadingMyaccount"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
         <td width="100%" height="14" class="infoBoxHeadingMyaccount"><?php echo $boxHeading; ?></td>
         <td height="14" class="infoBoxHeadingMyaccount" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
        </tr>
    </table>
		<table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxMyaccount">
         <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsMyaccount">
           <tr>
            <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
           </tr>

            <?php if (USE_CUSTOMER_GREET == 'true') { ?>
              <tr>
                <td class="boxText"<?php echo $boxContent_attributes; ?>><?php echo tep_customer_greeting_box() ?></td>
              </tr>
    		<?php } ?>
                		<tr><td align="left">
                        <?php
						if (USE_LOGIN_ACCOUNT_LINK == 'true') { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . LOGIN_BOX_MY_ACCOUNT . '</a><br>';
        						} 
						if (USE_LOGIN_ACCOUNT_EDIT_LINK == 'true') { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_EDIT . '</a><br>';
        						}
                        if (USE_LOGIN_ACCOUNT_NOTIFICATIONS_LINK == 'true') { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_NOTIFICATIONS . '</a><br>';
        						}
                        if (USE_LOGIN_ACCOUNT_HISTORY_LINK == 'true') { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_HISTORY . '</a><br>';
        						}
                        if (USE_LOGIN_ADDRESS_BOOK_LINK == 'true') { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . LOGIN_BOX_ADDRESS_BOOK . '</a><br>';
        						}
                        if (USE_LOGIN_SHOPPING_CART_LINK == 'true') { if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	if ($cart->count_contents() > 0) { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . LOGIN_BOX_SHOPPING_CART . '</a><br>'; 
								} 
							} else { 
								if ($cart->count_contents() > 0) { echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . LOGIN_BOX_SHOPPING_CART . '</a><br>';
									} else { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . LOGIN_BOX_SHOPPING_CART . '</a><br>';
										}
									}
								}
						if (USE_LOGIN_CHECKOUT_SHIPPING_LINK == 'true') { if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	if ($cart->count_contents() > 0) { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . LOGIN_BOX_CHECKOUT_SHIPPING . '</a><br>'; 
									}
							} else { 
								if ($cart->count_contents() > 0) { echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow_green.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . LOGIN_BOX_CHECKOUT_SHIPPING . '</a><br>';
									} else { 
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . LOGIN_BOX_CHECKOUT_SHIPPING . '</a><br>';
										}
									}
								}
						if (USE_LOGIN_AFFILIATE_LINK == 'true') {
						echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_AFFILIATE, '', 'SSL') . '">' . LOGIN_BOX_AFFILIATE . '</a><br>';
        				}
                        if (USE_LOGIN_SUBMIT_ARTICLE_LINK == 'true') {
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ARTICLE_SUBMIT, '', 'SSL') . '">' . LOGIN_BOX_ARTICLE_SUBMIT . '</a><br>';
        						}
                        if (USE_LOGIN_RECENTLY_VIEWED_LINK == 'true') {
								echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_RECENTLY_VIEWED, '', 'SSL') . '">' . LOGIN_BOX_RECENTLY_VIEWED . '</a><br>';
        						}
                        if (USE_LOGIN_SHOPPING_CART == 'true') { if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'true') {	if ($cart->count_contents() > 0) {
						?>
			            <table border="0">
						<td><?php echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full-small.png',SHOPPING_BAG_CART_FULL) .'</a>'; ?></td>
			            <td class="shoppingNavigation"><?php echo ITEM_IN_CART; ?>&nbsp;<?php echo $cart->count_contents(); ?><br /><?php echo TOTAL_AMOUNT;?>&nbsp;<?php echo $currencies->format($cart->show_total());?>&nbsp;&nbsp;</td>
						</td></table>
						<?php 	}
							} else { 
							if ($cart->count_contents() > 0) { ?>
			            <table border="0">
						<td><?php echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full-small.png',SHOPPING_BAG_CART_FULL) .'</a>'; ?></td>
			            <td class="shoppingNavigation"><?php echo ITEM_IN_CART; ?>&nbsp;<?php echo $cart->count_contents(); ?><br /><?php echo TOTAL_AMOUNT;?>&nbsp;<?php echo $currencies->format($cart->show_total());?>&nbsp;&nbsp;</td>
						</td></table>
						<?php } else { ?>
			            <table border="0">
						<td><?php echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-empty-small.png',SHOPPING_BAG_CART_FULL) .'</a>'; ?></td>
			            <td class="shoppingNavigation"><?php echo ITEM_IN_CART; ?>&nbsp;<?php echo $cart->count_contents(); ?><br /><?php echo TOTAL_AMOUNT;?>&nbsp;<?php echo $currencies->format($cart->show_total());?>&nbsp;&nbsp;</td>
						</td></table>
						<?php			}
									}
								}
						?>
						</td></tr>
                		<tr><td>
						<?php echo '<center><a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . tep_image_button('button_logoff.png', IMAGE_BUTTON_LOGOFF) . '</a></center>'; ?>
						</td></tr>

            <tr>
              <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
            </tr>

            </table>
           </td>
          </tr>
         </table>
 </td>
</tr>
<?php } ?>