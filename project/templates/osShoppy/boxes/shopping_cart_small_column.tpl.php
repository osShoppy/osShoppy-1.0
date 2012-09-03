<?php /* image_in_cart_box_column infobox template  */ ?>

<?php if (USE_HIDE_SHOPPING_CART_IF_EMPTY == 'false') {	?>
		   <tr>
            <td>
              <tr>
                <td class="boxText" align="center"<?php echo $boxContent_attributes; ?>>
<div id="header-basketColumnDiv">

         <div id="header-basketColumnBox">
             <div id="header-basketColumnText">
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
<div id="header-basketColumnDiv">

         <div id="header-basketColumnBox">
             <div id="header-basketColumnText">
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