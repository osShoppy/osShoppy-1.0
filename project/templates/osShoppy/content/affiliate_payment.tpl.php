    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
            <td class="main" colspan="4"><?php echo TEXT_AFFILIATE_HEADER . ' <b>' . tep_db_num_rows(tep_db_query($affiliate_payment_raw)); ?></b></td>
          </tr>
          <tr>
            <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading" align="right"><?php echo TABLE_HEADING_PAYMENT_ID; ?><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_AFFILIATE_HELP_19) . '\')"> ' . TEXT_PAYMENT_HELP . '</a>'; ?></td>
            <td class="infoBoxHeading" align="center"><?php echo TABLE_HEADING_DATE; ?><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_AFFILIATE_HELP_20) . '\')"> ' . TEXT_PAYMENT_HELP . '</a>'; ?></td>
            <td class="infoBoxHeading" align="right"><?php echo TABLE_HEADING_PAYMENT; ?><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_AFFILIATE_HELP_21) . '\')"> ' . TEXT_PAYMENT_HELP . '</a>'; ?></td>
            <td class="infoBoxHeading" align="right"><?php echo TABLE_HEADING_STATUS; ?><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_AFFILIATE_HELP_22) . '\')"> ' . TEXT_PAYMENT_HELP . '</a>'; ?></td>
          </tr>
<?php
  if ($affiliate_payment_split->number_of_rows > 0) {
    $affiliate_payment_values = tep_db_query($affiliate_payment_split->sql_query);
    $number_of_payment = 0;
    while ($affiliate_payment = tep_db_fetch_array($affiliate_payment_values)) {
      $number_of_payment++;

      if (($number_of_payment / 2) == floor($number_of_payment / 2)) {
        echo '          <tr class="productListing-even">';
      } else {
        echo '          <tr class="productListing-odd">';
      }
?>
            <td class="smallText" align="right"><?php echo $affiliate_payment['affiliate_payment_id']; ?></td>
            <td class="smallText" align="center"><?php echo tep_date_short($affiliate_payment['affiliate_payment_date']); ?></td>
            <td class="smallText" align="right"><?php echo $currencies->display_price($affiliate_payment['affiliate_payment_total'], ''); ?></td>
            <td class="smallText" align="right"><?php echo $affiliate_payment['affiliate_payment_status_name']; ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr class="productListing-odd">
            <td colspan="4" class="main"><?php echo TEXT_NO_PAYMENTS; ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td colspan="4"><?php echo tep_draw_separator(); ?></td>
          </tr>
<?php 
  if ($affiliate_payment_split->number_of_rows > 0) {
?>    
          <tr>
            <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText"><?php echo $affiliate_payment_split->display_count(TEXT_DISPLAY_NUMBER_OF_PAYMENTS); ?></td>
                <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $affiliate_payment_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
          </tr>
<?php
  }
  $affiliate_payment_values = tep_db_query("select sum(affiliate_payment_total) as total from " . TABLE_AFFILIATE_PAYMENT . " where affiliate_id = '" . $affiliate_id . "'");
  $affiliate_payment = tep_db_fetch_array($affiliate_payment_values);
?>
          <tr>
            <td class="main" colspan="4"><br><?php echo TEXT_INFORMATION_PAYMENT_TOTAL . ' <b>' . $currencies->display_price($affiliate_payment['total'], ''); ?></b></td>
          </tr>
                <tr>
                  <td colspan="4"><?php echo tep_draw_separator(); ?></td>
                </tr>
                 <tr>
                  <td align="center" class="boxtext" colspan="4"><b><?php echo TEXT_PAYMENT; ?><b></td>
                </tr>
                <tr>
                  <td colspan="4"><?php echo tep_draw_separator(); ?></td>
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
                <td><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_REPORTS, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_SUMMARY) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
