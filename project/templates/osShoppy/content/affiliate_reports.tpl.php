<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'afreports_top')) { ?>
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
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
			<?php } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
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
            <td class="main"><?php echo TEXT_INFORMATION; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

      <tr>
        <td colspan="4"><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td>
      </tr>
      <tr>
        <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'). '">' . TEXT_AFFILIATE_CLICKS . '</a>';?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="4"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
                <td width="60"><img src="images/affiliate/affiliate_clicks.gif" border="0" alt="" width="60" height="60"></td>
                <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><img src="images/icons/arrows/arrow_orange.png" border="0" alt="" width="12" height="10">&nbsp;<?php echo TEXT_INFORMATION_CLICKS ;?></td>
                    <td width="200" class="main" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL') . '">' . tep_image_button('button_affiliate_clickthroughs.png', IMAGE_CLICKS) . '</a>';?></td>
                  </tr>
                  </table></td>
               <td width="10" align="right"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
             </tr>
           </table></td>
         </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="4"><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td>
      </tr>
      <tr>
        <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'). '">' . TEXT_AFFILIATE_SALES . '</a>';?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="4"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
                <td width="60"><img src="images/affiliate/affiliate_sales.gif" border="0" alt="" width="60" height="60"></td>
                <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><img src="images/icons/arrows/arrow_orange.png" border="0" alt="" width="12" height="10">&nbsp;<?php echo TEXT_INFORMATION_SALES ;?></td>
                    <td width="200" class="main" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL') . '">' . tep_image_button('button_affiliate_sales.png', IMAGE_SALES) . '</a>';?></td>
                  </tr>
                  </table></td>
               <td width="10" align="right"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
             </tr>
           </table></td>
         </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="4"><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="10"></td>
      </tr>
      <tr>
        <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'). '">' . TEXT_AFFILIATE_PAYMENT . '</a>';?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="4"><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
                <td width="60"><img src="images/affiliate/affiliate_payment.gif" border="0" alt="" width="60" height="60"></td>
                <td width="10"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><img src="images/icons/arrows/arrow_orange.png" border="0" alt="" width="12" height="10">&nbsp;<?php echo TEXT_INFORMATION_PAYMENT ;?></td>
                    <td width="200" class="main" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL') . '">' . tep_image_button('button_affiliate_payment.png', IMAGE_PAYMENT) . '</a>';?></td>
                  </tr>
                  </table></td>
               <td width="10" align="right"><img src="images/pixel_trans.gif" border="0" alt="" width="10" height="1"></td>
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
                <td><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'afreports_bot')) { ?>
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
