<?php /* image_in_cart_box infobox template  */ ?>

<?php if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'false') {	?>
		   <tr>
            <td>
              <tr>
                <td class="boxText" align="center"<?php echo $boxContent_attributes; ?>>
<div id="header-basketDiv">

         <div id="header-basketBox">
             <div id="header-basketText">
            <table border="0">
    <tbody>
        <tr>
            <td  rowspan="3">
			<?php if ($cart->count_contents() > 0) {
					echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full.png',SHOPPING_BAG_CART_FULL) .'</a>';
			} else {
				    echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-empty.png',SHOPPING_BAG_CART_EMPTY) .'</a>'; 
			} ?></td>
            <td colspan="2" class="smalltext" align="center"><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><b><?php echo BOX_HEADING_CART; ?></b></a></td>
        </tr>
        <tr>
            <td  class="smalltext" align="right" valign="bottom"><?php echo ITEM_IN_CART; ?></td>
            <td  class="smalltext" align="left" valign="bottom"><?php echo $cart->count_contents(); ?></td>
        </tr>
        <tr>
            <td class="smalltext" align="right" valign="bottom"><?php echo TOTAL_AMOUNT;?></td>
            <td class="smalltext" align="left" valign="bottom"><?php echo $currencies->format($cart->show_total());?></td>
        </tr>
    </tbody>
</table>
<?php 
  if (tep_session_is_registered('gv_id')) {
    $gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon = tep_db_fetch_array($gv_query); ?>
    <tr>
    <td class="smalltext"><?php echo VOUCHER_REDEEMED . $currencies->format($coupon['coupon_amount']); ?>
<?php
  }
if (tep_session_is_registered('cc_id') && $cc_id) {
 $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
 $coupon = tep_db_fetch_array($coupon_query);
 $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_id . "' and language_id = '" . $languages_id . "'");
 $coupon_desc = tep_db_fetch_array($coupon_desc_query);
 $text_coupon_help = sprintf("%s",$coupon_desc['coupon_name']);
?>
   <?php echo CART_COUPON . $text_coupon_help ?></td>
   </tr><?php
   }
?>
             </div>

         </div>
     </div>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
            </td>
          </tr>
<?php } else { ?>
	<?php  if ($cart->count_contents() > 0) { 
?>
          <tr>
            <td>
              <tr>
                <td class="boxText" align="center"<?php echo $boxContent_attributes; ?>>
<div id="header-basketDiv">

         <div id="header-basketBox">
             <div id="header-basketText">
            <table border="0">
    <tbody>
        <tr>
            <td  rowspan="3">
			<?php if ($cart->count_contents() > 0) {
					echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-full.png',SHOPPING_BAG_CART_FULL) .'</a>';
			} else {
				    echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/shopping_cart/shopping-cart-empty.png',SHOPPING_BAG_CART_EMPTY) .'</a>'; 
			} ?></td>
            <td colspan="2" class="smalltext" align="center"><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><b><?php echo BOX_HEADING_CART; ?></b></a></td>
        </tr>
        <tr>
            <td  class="smalltext" align="right" valign="bottom"><?php echo ITEM_IN_CART; ?></td>
            <td  class="smalltext" align="left" valign="bottom"><?php echo $cart->count_contents(); ?></td>
        </tr>
        <tr>
            <td class="smalltext" align="right" valign="bottom"><?php echo TOTAL_AMOUNT;?></td>
            <td class="smalltext" align="left" valign="bottom">xxx<?php echo $currencies->format($cart->show_total());?></td>
        </tr>
    </tbody>
</table>
             </div>

         </div>
     </div>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
            </td>
          </tr>
<?php 
	 }
	}
?>