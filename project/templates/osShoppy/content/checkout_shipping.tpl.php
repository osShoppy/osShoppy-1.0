<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'chshipping_top')) { ?>
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
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <?php echo tep_draw_form('checkout_address', tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_checkout_shipping.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
                <td class="main" width="50%" valign="top"><?php echo (((! tep_session_is_registered('customer_is_guest')) || (defined('PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING') && PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING=='yes') )? '' . TEXT_CHOOSE_SHIPPING_DESTINATION . '<br><br> <a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_change_address.png', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>':''); ?></td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center" valign="top"><?php echo '<b>' . TITLE_SHIPPING_ADDRESS . '</b><br>' . tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_down_right.png'); ?></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
                    <td class="main" valign="top"><?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br>'); ?></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<!--BOF osc_Giftwrap -->
<?php
if (tep_count_giftwrap_modules() > 0) {
?>
	<tr>
		<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
			<tr>
            	<td class="main"><b><?php echo TABLE_HEADING_GIFTWRAP_METHOD; ?></b></td>
          	</tr>
        </table></td>
  	</tr>
	<tr>
    	<td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          	<tr class="infoBoxContents">
            	<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
	$quotes1_size = sizeof($quotes1); //number of GW modules loaded
	/* if ($quotes1_size > 1) { */
    if ($quotes1_size > 0) { //at least one gw module is loaded
?>
		<tr>
        	<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
           	<td span class="main" width="50%" valign="top"><?php echo TEXT_CHOOSE_GIFTWRAP_METHOD; ?></td>
 			<td class="main" width="50%" valign="top" align="right"><?php //echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_east_south.png'); ?></td>
  			<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		</tr>
<?php 
	} 
?>

<?php
	$radio_buttons = 0;
    for ($i=0; $i<$quotes1_size; $i++) {
?>
		<tr>
        	<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
        	<td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
		if (isset($quotes1[$i]['error'])) {
?>
			<tr>
            	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              	<td class="main" colspan="3"><?php echo $quotes1[$i]['error']; ?></td>
            	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
          	</tr>
<?php
		} else {
			$size = sizeof($quotes1[$i]['methods']);
        	for ($j=0, $n2=$size; $j<$n2; $j++) {
				// set the radio button to be checked if it is the method chosen
          		if($quotes1[$i]['id'] . '_' . $quotes1[$i]['methods'][$j]['id'] == $giftwrap_info['id']){
          			$checked = (true);
          		}else{
          			$checked = (false);
          		}
          		
          		if ( ($quotes1[$i]['id'] . '_' . $quotes1[$i]['methods'][$j]['id'] == $giftwrap_info['id']) || (tep_count_giftwrap_modules() == (int)1) ) {
           			echo '<tr id="defaultSelectedGift" class="moduleRowSelected" onmouseover="rowOverEffectGift(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectGift(this, ' . $radio_buttons . ')">' . "\n";
         		} else {
           			echo '<tr class="moduleRow" onmouseover="rowOverEffectGift(this)" onmouseout="rowOutEffectGift(this)" onclick="selectRowEffectGift(this, ' . $radio_buttons . ')">' . "\n";
         		}
?>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main" width="200px"><?php echo $quotes1[$i]['methods'][$j]['title']; ?></td>
<?php
				if ( ($quotes1_size > 0) || ($n2 > 0) ) {
					if (DISPLAY_PRICE_WITH_TAX == 'true') {
  						$gift_tax_rate_tmp = tep_get_tax_rate(MODULE_ORDER_TOTAL_GIFTWRAP_TAX_CLASS);
  						$gift_tax_amt_tmp = $quotes1[$i]['methods'][$j]['cost'];
  						$gift_tax_amt_tmp += tep_calculate_tax($quotes1[$i]['methods'][$j]['cost'], $gift_tax_rate_tmp);
?>
						<td class="main" align="right"><?php echo $currencies->format($gift_tax_amt_tmp); ?></td>
<?php
					} else {  // display price without tax
?>
						<td class="main"><?php echo $currencies->format($quotes1[$i]['methods'][$j]['cost']); ?></td>
<?php
					}
?>
					<td class="main" align="right"><?php echo tep_draw_checkbox_field('giftwrap', $quotes1[$i]['id'] . '_' . $quotes1[$i]['methods'][$j]['id'], $checked); ?></td>
<?php
				}
?>
       			<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
    			</tr>
    			
    			<!-- Add giftcard radio buttons -->
    			<?php
    			//should card button be checked?
    			if (tep_session_is_registered('giftwrap_message') && tep_not_null('giftwrap_message')) {
					$giftCard_checked=(true);
				}else{
					$giftCard_checked=(false);
				}
				?>

					<tr id="giftwrapcard_heading">
			           	<td span class="main" width="50%" valign="top" id="giftwrap_card_title"><?php echo TEXT_CHOOSE_GIFTWRAP_CARD; ?></td>
					</tr>
					
					<?php //echo '<tr id="giftwrapcard_box" class="moduleRowSelected" onmouseover="rowOverEffectGift(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectGift(this, 0)">' . "\n"; ?>
					<tr id="giftwrapcard_box" class="moduleRowSelected">
	        			<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td class="main"><?php echo TEXT_GIFTWRAP_CARD; ?></td>
						<td class="main"><?php '' ?></td>
						<td class="main" align="right">
							<?php echo tep_draw_checkbox_field('giftwrap_card', '', $checked_card, 'id="giftwrap_card_checkbox"'); ?>
						</td>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					</tr>

    			<!--add message field-->
					<tr>
	            		<td colspan="5" class="main" id="giftwrap_message_title"><b><?php echo GIFT_CARD_MESSAGE; ?></b>&nbsp;<?php echo MAX_CHARACTERS; ?></td>
	          		</tr>
		         	<tr>
		                <td colspan="5" id="giftwrap_message_field"><?php echo tep_draw_textarea_field('giftMessage', 'soft', '60', '1', $giftwrap_message); ?></td>
		         	</tr>
<?php
          		$radio_buttons++;
   			}
 		}
?>
		</table></td>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
		</tr>
<?php
	}
?>
          </table></td>
        </tr>
        </table></td>
      </tr>
<?php
}
?>
<!--EOF osc_Giftwrap-->
<?php
  if (tep_count_shipping_modules() > 0) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="50%" valign="top"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></td>
                <td class="main" width="50%" valign="top" align="right"><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_right_down.png') . '&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
<?php
    } elseif ($free_shipping == false) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
<?php
    }

    if ($free_shipping == true) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, 0)">
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" width="100%"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free'); ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
              </tr>
<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="3"><b><?php echo $quotes[$i]['module']; ?></b>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
<?php
        if (isset($quotes[$i]['error'])) {
?>
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" colspan="3"><?php echo $quotes[$i]['error']; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
<?php
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            } else {
              echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            }
?>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" width="75%"><?php echo $quotes[$i]['methods'][$j]['title']; ?></td>
<?php
            if ( ($n > 1) || ($n2 > 1) ) {
?>
                    <td class="main"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></td>
                    <td class="main" align="right"><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?></td>
<?php
            } else {
?>
                    <td class="main" align="right" colspan="2"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></td>
<?php
            }
?>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
<?php
            $radio_buttons++;
          }
        }
?>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
              </tr>
<?php
      }
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo tep_draw_textarea_field('comments', 'soft', '60', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main"><?php echo '<b>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
                <td class="main" align="right"><?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'icons/checkout_bullet/checkout_bullet_1.png'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
            <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
          </tr>
        </table></td>
      </tr>
    </table></form>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'chshipping_bot')) { ?>
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
