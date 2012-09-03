    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="250px" align="center"><?php echo tep_image(DIR_WS_IMAGES . 'files/checkout/order_sent_success.png', HEADING_TITLE); ?></td>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="pageHeading" align="center"><h1><?php echo HEADING_TITLE; ?></h1></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
<?php if(CONTROL_LOGIN == 'true') { ?>
              <tr>
                <td class="main" width=""><?php echo TEXT_ACCOUNT_CONTROL_LOGIN; ?></td>
              </tr>
<?php } else { ?>
              <tr>
                <td class="main" width=""><?php echo TEXT_ACCOUNT_CREATED; ?></td>
              </tr>
<?php } ?>
<?php 
   if ((USE_POINTS_SYSTEM == 'true') && (NEW_SIGNUP_POINT_AMOUNT > 0)) {
?>
              <tr>
                <td class="main"><?php echo sprintf(TEXT_WELCOME_POINTS_TITLE, '<a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '" title="' . TEXT_POINTS_BALANCE . '">' . TEXT_POINTS_BALANCE . '</a>', number_format(NEW_SIGNUP_POINT_AMOUNT,POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(NEW_SIGNUP_POINT_AMOUNT))); ?>.</td>
              </tr>
              <tr>
                <td class="main"><?php echo sprintf(TEXT_WELCOME_POINTS_LINK, '<a href="' . tep_href_link(FILENAME_MY_POINTS_HELP,'faq_item=13', 'NONSSL') . '" title="' . BOX_INFORMATION_MY_POINTS_HELP . '">' . BOX_INFORMATION_MY_POINTS_HELP . '</a>'); ?></td>
              </tr>
<?php
   }
?>               
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
                <td align="right"><?php echo '<a href="' . $origin_href . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>

