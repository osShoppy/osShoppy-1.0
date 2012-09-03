<?php /* payment_info_column infobox template  */ ?>
            <td valign="top">
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxColumnHeadingPayment"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxColumnHeadingPayment"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxColumnHeadingPayment" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxColumnPayment">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxColumnContentsPayment">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"<?php echo $boxContent_attributes; ?>>
                		<tr><td align="center">
							<?php if (USE_ABN_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/ideal_abnamro.jpg'); ?><?php } ?>
                        	<?php if (USE_FOR_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/ideal_fortis.jpg'); ?><?php } ?>
                        	<?php if (USE_ING_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/ideal_ing.jpg'); ?><?php } ?>
                        	<?php if (USE_POS_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/ideal_postbank.jpg'); ?><?php } ?>
                        	<?php if (USE_RAB_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/ideal_rabobank.jpg'); ?><?php } ?>
                        	<?php if (USE_SNS_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/ideal_sns.jpg'); ?><?php } ?></td>
						</tr>
                        <tr><td align="center" class="footerText">
                        	<?php if (USE_IDEAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/idealinfo.jpg'); ?>
						</td></tr><?php	} ?>
        				<tr><td align="center" class="footerText">
                        	<?php if (USE_PAYPAL_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/paypalinfo.jpg'); ?>
						<?php } ?>						
						<?php if (USE_PAYPAL_VERIFIED_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/paypalverified.jpg'); ?>
						</td></tr><?php	} ?>
        				<tr><td align="center" class="footerText">
                        <?php if (USE_CREDITCARD_IN_PAYMENT_INFO == 'true') { ?><?php echo tep_image(DIR_WS_IMAGES . 'infobox/payment_info/creditcardinfo.jpg'); ?>
						</td></tr><?php	} ?>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
            </table>
            </td>
              </tr>
            </table>
            </td>
