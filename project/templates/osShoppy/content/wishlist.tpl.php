<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'wishlist_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_top_eof //-->
    <?php echo tep_draw_form('wishlist_form', tep_href_link(FILENAME_WISHLIST)); ?>
	  <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		  <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
			<?php } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			<?php } ?>
          </tr>
          </table>
		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

<?php
  if ($messageStack->size('wishlist') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('wishlist'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }


if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
	reset($wishList->wishID);

?>
	  <tr>
		<td>
		<table border="0" width="100%" cellspacing="0" cellpadding="3" class="productListing">
		  <tr>
				<td class="productListing-heading"><?php echo BOX_TEXT_IMAGE; ?></td>
				<td class="productListing-heading"><?php echo BOX_TEXT_PRODUCT; ?></td>
				<td class="productListing-heading"><?php echo BOX_TEXT_PRICE; ?></td>
				<td class="productListing-heading" align="center"><?php echo BOX_TEXT_SELECT; ?></td>
		  </tr>

<?php
		$i = 0;
		while (list($wishlist_id, ) = each($wishList->wishID)) {

			$product_id = tep_get_prid($wishlist_id);
		
		    $products_query = tep_db_query("select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_status, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from ( " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd ) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.products_id = '" . $product_id . "' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name");
			$products = tep_db_fetch_array($products_query);

		      if (($i/2) == floor($i/2)) {
		        $class = "productListing-even";
		      } else {
		        $class = "productListing-odd";
		      }

?>
				  <tr class="<?php echo $class; ?>">
					<td valign="top" class="productListing-data" align="left"><?php if($products['products_status'] == 0) {
				   			 echo tep_image(DIR_WS_IMAGES . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); 
				   			}
                            else
                            {
							?>
				   <a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $wishlist_id, 'NONSSL'); ?>"><?php echo tep_image(DIR_WS_IMAGES . $products['products_image'], $products['products_name'], WISHLIST_PAGE_IMAGE_WIDTH, WISHLIST_PAGE_IMAGE_HEIGHT); ?></a>
                   <?php } ?>

					<td valign="top" class="productListing-data" align="left" class="main"><b><?php if($products['products_status'] == 0) {
					echo $products['products_name']; 
					}
					else {
					?>
                    <a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $wishlist_id, 'NONSSL'); ?>"><?php echo $products['products_name']; ?></a>
                    <?php } ?></b>
					<input type="hidden" name="prod_link[]" value="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $wishlist_id, 'NONSSL'); ?>" />
					<input type="hidden" name="prod_name[]" value="<?php echo $products['products_name']; ?>" />
<?php



/*******************************************************************
******** THIS IS THE WISHLIST CODE FOR PRODUCT ATTRIBUTES  *********
*******************************************************************/

                  $attributes_addon_price = 0;

                  // Now get and populate product attributes
					$att_name = "";
					if (isset($wishList->wishID[$wishlist_id]['attributes'])) {
						while (list($option, $value) = each($wishList->wishID[$wishlist_id]['attributes'])) {
                      		echo tep_draw_hidden_field('id[' . $wishlist_id . '][' . $option . ']', $value);

         					$attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . $wishlist_id . "'
                                       and pa.options_id = '" . $option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . $value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . $languages_id . "'
                                       and poval.language_id = '" . $languages_id . "'");
							$attributes_values = tep_db_fetch_array($attributes);

                       		if ($attributes_values['price_prefix'] == '+') {
								$attributes_addon_price += $attributes_values['options_values_price'];
                       		} else if($attributes_values['price_prefix'] == '-') {
                         		$attributes_addon_price -= $attributes_values['options_values_price'];
							}
							$att_name .= " (" . $attributes_values['products_options_name'] . ": " . $attributes_values['products_options_values_name'] . ") ";
                       		echo '<br /><small><i> ' . $attributes_values['products_options_name'] . ': ' . $attributes_values['products_options_values_name'] . '</i></small>';
                    	} // end while attributes for product

					}

					echo '<input type="hidden" name="prod_att[]" value="' . $att_name . '" />';

                   	if (tep_not_null($products['specials_new_products_price'])) {
                   		$products_price = '<s>' . $currencies->display_price($products['products_price']+$attributes_addon_price, tep_get_tax_rate($products['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($products['specials_new_products_price']+$attributes_addon_price, tep_get_tax_rate($products['products_tax_class_id'])) . '</span>';
                   	} else {
                       	$products_price = $currencies->display_price($products['products_price']+$attributes_addon_price, tep_get_tax_rate($products['products_tax_class_id']));
                    }

/*******************************************************************
******* CHECK TO SEE IF PRODUCT HAS BEEN ADDED TO THEIR CART *******
*******************************************************************/

			if($cart->in_cart($wishlist_id)) {
				echo '<br /><font color="#FF0000"><b>' . TEXT_ITEM_IN_CART . '</b></font>';
			}

/*******************************************************************
********** CHECK TO SEE IF PRODUCT IS NO LONGER AVAILABLE **********
*******************************************************************/

   			if($products['products_status'] == 0) {
   				echo '<br /><font color="#FF0000"><b>' . TEXT_ITEM_NOT_AVAILABLE . '</b></font>';
  			}
	
			$i++;
?>
			</td>
			<td valign="top" class="productListing-data"><?php echo $products_price; ?></td>
			<td valign="top" class="productListing-data" align="center">
<?php

/*******************************************************************
* PREVENT THE ITEM FROM BEING ADDED TO CART IF NO LONGER AVAILABLE *
*******************************************************************/

			if($products['products_status'] != 0) {
				echo tep_draw_checkbox_field('add_wishprod[]',$wishlist_id);
			}
?>
			</td>
		  </tr>

<?php
		}
?>
		</table>
		</td>
	  </tr>
	  <tr>
		<td align="right"><br /><?php echo tep_image_submit('button_delete.png', IMAGE_BUTTON_DELETE_WISHLIST, 'name="delete_prod" value="delete_prod"') . " " . tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART, 'name="add_prod" value="add_prod"'); ?></td>
 	  </tr>
	</table>
<?php

/*******************************************************************
*********** CODE TO SPECIFY HOW MANY EMAILS TO DISPLAY *************
*******************************************************************/


	if(!tep_session_is_registered('customer_id')) {

?>
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
		<td class="main"><?php echo WISHLIST_EMAIL_TEXT_GUEST; ?></td>
	  </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
        <td align="center">
			<table border="0" width="400px" cellspacing="0" cellpadding="2" class="wishlist">
			  <tr>
				<td class="main" colspan="2"><table cellpadding="2" cellspacing="0">
				  <tr>
					<td colspan="2"><?php echo $guest_errors; ?></td>
				  </tr>
				  <tr>
					<td class="main"><?php echo TEXT_YOUR_NAME; ?></td>
					<td class="main"><?php echo tep_draw_input_field('your_name', $your_name); ?></td>
			  	  </tr>
			  	  <tr>
					<td class="main"><?php echo TEXT_YOUR_EMAIL; ?></td>
					<td class="main"><?php echo tep_draw_input_field('your_email', $your_email); ?></td>
			  	  </tr>
				</table></td>
			  </tr>
		      <tr>
		        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
		      </tr>
		      <tr>
		        <td colspan="2"><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
		      </tr>
		      <tr>
		        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
		      </tr>
<?php 

	} else {

?>

	<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
		<td class="main"><?php echo WISHLIST_EMAIL_TEXT; ?></td>
	  </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
        <td align="center">
			<table border="0" width="400px" cellspacing="0" cellpadding="2" class="wishlist">

<?php

	}

?>
			  <tr>
				<td colspan="2"><?php echo $email_errors; ?></td>
			  </tr>
<?php

	$email_counter = 0;
	while($email_counter < DISPLAY_WISHLIST_EMAILS) {
?>
			  <tr>
				<td class="main"><?php echo TEXT_NAME; ?>&nbsp;&nbsp;<?php echo tep_draw_input_field('friend[]', $friend[$email_counter]); ?></td>
				<td class="main"><?php echo TEXT_EMAIL; ?>&nbsp;&nbsp;<?php echo tep_draw_input_field('email[]', $email[$email_counter]); ?></td>
			  </tr>
<?php
	$email_counter++;
	}
?>
			  <tr>
				<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td colspan="2"><?php echo $message_error; ?></td>
			  </tr>
			  <tr>
				<td colspan="2" class="main"><?php echo TEXT_MESSAGE .  tep_draw_textarea_field('message', 'soft', 45, 5); ?></td>
			  </tr>
			  <tr>
				<td colspan="2" align="right"><?php echo tep_image_submit('button_send.png', IMAGE_BUTTON_SEND, 'name="email_prod" value="email_prod"'); ?></td>

			  </tr>
			</table>
		</td></form>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		        <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
	  </tr>
	</table>
	
<?php

} else { // Nothing in the customers wishlist

?>
  <tr>
	<td>
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <tr>
		<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
		  <tr>
			<td class="main"><?php echo BOX_TEXT_NO_ITEMS;?></td>
		  </tr>
		</table>
		</td>
	  </tr>
	</table></form>
	</td>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		        <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
  </tr>
</table>
<?php } ?>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'wishlist_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_bot_eof //-->
