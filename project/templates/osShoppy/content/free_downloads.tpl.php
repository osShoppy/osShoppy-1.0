<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'freedown_top')) { ?>
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
<?php
  $free_downloads_array = array();

  $free_downloads_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and products_price = '0' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC, pd.products_name";
  $free_downloads_split = new splitPageResults($free_downloads_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($free_downloads_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="0%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $free_downloads_split->display_count(TEXT_DISPLAY_NUMBER_OF_FREE_DOWNLOADS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $free_downloads_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
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
        <td><table border="0" width="90%" cellspacing="0" cellpadding="2" align="center">
<?php
  if ($free_downloads_split->number_of_rows > 0) {
    $free_downloads_query = tep_db_query($free_downloads_split->sql_query);
    while ($free_downloads = tep_db_fetch_array($free_downloads_query)) {
      if ($new_price = tep_get_products_special_price($free_downloads['products_id'])) {
        $products_price = '<s>' . $currencies->display_price($free_downloads['products_price'], tep_get_tax_rate($free_downloads['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($free_downloads['products_tax_class_id'])) . '</span>';
      } else {
        $products_price = $currencies->display_price($free_downloads['products_price'], tep_get_tax_rate($free_downloads['products_tax_class_id']));
      }
?>
          <tr>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" rowspan="2" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $free_downloads['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $free_downloads['products_image'], $free_downloads['products_name'], FREE_DOWNLOADS_PAGE_IMAGE_WIDTH, FREE_DOWNLOADS_PAGE_IMAGE_HEIGHT) . '</a>'; ?></td>
            <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $free_downloads['products_id']) . '"><b><u>' . $free_downloads['products_name'] . '</u></b></a><br>' . TEXT_DATE_ADDED . ' ' . tep_date_long($free_downloads['products_date_added']) . '<br>' . TEXT_MANUFACTURER . ' ' . $free_downloads['manufacturers_name'] . '<br><br>' . TEXT_PRICE . ' ' . $products_price; ?></td>
            <td align="right" valign="middle" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_FREE_DOWNLOADS, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $free_downloads['products_id']) . '">' . tep_image_button('button_in_cart.png', IMAGE_BUTTON_IN_CART) . '</a>'; ?></td>
          </tr>
          <tr>
            <td colsp�an="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr>
            <td class="main"><?php echo TEXT_NO_FREE_DOWNLOADS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
<?php
  if (($free_downloads_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $free_downloads_split->display_count(TEXT_DISPLAY_NUMBER_OF_FREE_DOWNLOADS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $free_downloads_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		        <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'freedown_bot')) { ?>
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
