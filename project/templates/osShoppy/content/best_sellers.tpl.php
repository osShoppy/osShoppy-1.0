<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'bestsellers_top')) { ?>
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
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_best_sellers.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  $best_sellers_array = array();

  $best_sellers_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered DESC, pd.products_name";
  $best_sellers_split = new splitPageResults($best_sellers_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($best_sellers_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $best_sellers_split->display_count(TEXT_DISPLAY_NUMBER_OF_BEST_SELLERS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $best_sellers_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
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
<?php
  if ($best_sellers_split->number_of_rows > 0) {
    $best_sellers_query = tep_db_query($best_sellers_split->sql_query);
    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      if ($new_price = tep_get_products_special_price($best_sellers['products_id'])) {
        $products_price = '<s>' . $currencies->display_price($best_sellers['products_price'], tep_get_tax_rate($best_sellers['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($best_sellers['products_tax_class_id'])) . '</span>';
      } else {
        $products_price = $currencies->display_price($best_sellers['products_price'], tep_get_tax_rate($best_sellers['products_tax_class_id']));
      }
?>
          <tr>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $best_sellers['products_image'], $best_sellers['products_name'], BESTSELLERS_PAGE_IMAGE_WIDTH, BESTSELLERS_PAGE_IMAGE_HEIGHT) . '</a>'; ?></td>
            <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '"><b><u>' . $best_sellers['products_name'] . '</u></b></a><br>' . TEXT_DATE_ADDED . ' ' . tep_date_long($best_sellers['products_date_added']) . '<br>' . TEXT_MANUFACTURER . ' ' . $best_sellers['manufacturers_name'] . '<br><br>' . TEXT_PRICE . ' ' . $products_price; ?></td>
            <td align="right" valign="middle" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $best_sellers['products_id']) . '">' . tep_image_button('button_in_cart.png', IMAGE_BUTTON_IN_CART) . '</a>'; ?></td>
          </tr>
          <tr>
            <td colsp�an="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr>
            <td class="main"><?php echo TEXT_NO_NEW_PRODUCTS; ?></td>
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
  if (($best_sellers_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $best_sellers_split->display_count(TEXT_DISPLAY_NUMBER_OF_BEST_SELLERS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $best_sellers_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'bestsellers_bot')) { ?>
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
</td>