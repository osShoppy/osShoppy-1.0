<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'viewed_top')) { ?>
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
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_recently_viewed.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
// Show "no products" message if we have no products in the array or there are errors set
  if (count ($recently_viewed_array) == 0 || strlen ($error) > 0) { 
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="addressBook-even">
            <td class="main"><?php echo TEXT_NO_PRODUCTS_VIEWED; ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {

  if ( ($number_of_products > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo sprintf (TEXT_DISPLAY_NUMBER_OF_PRODUCTS, $product_start + 1, $product_start + $product_limit, $number_of_products); ?></td>
            <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . tep_display_links (MAX_DISPLAY_PAGE_LINKS, $current_page_number, $number_of_pages, basename ($PHP_SELF), tep_get_all_get_params (array ('page', 'info', 'x', 'y') ) ); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="2" cellpadding="2">
<?php

  $rows = 0;
  foreach ($products_data as $products) {
    $products_price = $currencies->display_price ($products['products_price'], tep_get_tax_rate($products['products_tax_class_id']));
    if ($products['specials_status'] == 1) {
      $products_price = '<s>' . $products_price . '</s> <span class="productSpecialPrice">' . $currencies->display_price($products['specials_new_products_price'], tep_get_tax_rate($products['products_tax_class_id'])) . '</span>';
    } // if ($products['specials_status']

    // Add the Show More link to the description if set
    $description = $products['products_description'];
    if ($products['show_more'] != '') {
      $description = $products['products_description'] . '...&nbsp;<a href="' . tep_href_link (FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . $products['show_more'] . '</a>';
    }
    
    // Add CSS row classes for highlighting
    $rows++;
    if (($rows/2) == floor($rows/2)) {
      echo '          <tr class="productListing-even">' . "\n";
    } else {
      echo '          <tr class="productListing-odd">' . "\n";
    }
?>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 30; ?>" valign="top" class="main" align="center"><?php echo '<a href="' . tep_href_link (FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $products['products_image'], $products['products_name'], RECENTLY_VIEWED_PAGE_IMAGE_WIDTH, RECENTLY_VIEWED_PAGE_IMAGE_HEIGHT) . '</a>'; ?></td>
            <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '"><b><u>' . $products['products_name'] . '</u></b></a><br><br>' . $description; ?></td>
<?php
    $lc_text  = '<div><form name="buy_now_' . $products['products_id'] . '" method="post" action="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=add_product', 'NONSSL') . '">';
    $lc_text .= '<input type="hidden" name="products_id" value="' . $products['products_id'] . '">' . tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART,'align="absbottom"') . ' '. '<br>'; 
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $products['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) { // product has attributes
      $lc_text .= '</div>' . TEXT_PRICE . ' ' . '<b>' . $products_price .  '</b><br>' .TEXT_PRODUCT_OPTIONS . '<br>';
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $products['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . $products['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($products['products_tax_class_id'])) .') ';
          } //($products_options['options_values_price'] != '0') {
        } //while ($products_options = tep_db_fetch_array($products_options_query)) {

        if (isset($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        } //if (isset($cart->contents
        $lc_text .= ''. $products_options_name['products_options_name'] . ':' .''.
              '' .  tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute) . '<br>';
        $lc_text .= '&nbsp&nbsp&nbsp';
        $lc_text .=  '</a><br>'; 
      }//while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
      $lc_text .= '</form>'; 

      if ($products['manufacturers_name'] != '') {
?>
               <td align="center" valign="middle" class="main"><?php echo TEXT_MANUFACTURER . '<br>' . $products['manufacturers_name'] .  '<br><br>' . $lc_text   . '</form>&nbsp' . '</a>'; ?> 
<?php
      } else { //if($products['manufacturers_name']<>'') {
?>
               <td align="center" valign="middle" class="main"><?php echo  $lc_text  .  '</form>&nbsp' . '</a>'; ?>
<?php
      } //if($products['manufacturers_name']
    } else { // product does not have attributes

      if ($products['manufacturers_name'] != '') {
?>
               <td align="center" valign="middle" class="main" width="20%"><?php echo TEXT_MANUFACTURER . '<br>' . $products['manufacturers_name'] .  '<br><br>' . TEXT_PRICE . ' ' . '<b>' . $products_price .  '</b><br><br>' .  '&nbsp&nbsp' . '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, 'products_id=' . $products['products_id']) . '">' . '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, 'products_id=' . $products['products_id']) . '">' . '</a>'  .  tep_draw_form('buy_now' . $products['products_id'], tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products['products_id']), 'POST')  . '<span align="right" >'  .  tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART,'align="absbottom"') . '</span></form>&nbsp' . '</a>'; ?>
<?php
      } else { //if($products['manufacturers_name']
?>
               <td align="center" valign="middle" class="main" width="20%"><?php echo TEXT_PRICE . ' ' . '<b>' . $products_price .  '</b><br><br><br>' .  '&nbsp&nbsp' . '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, 'products_id=' . $products['products_id']) . '">' . '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, 'products_id=' . $products['products_id']) . '">' . '</a>'  .  tep_draw_form('buy_now' . $products['products_id'], tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products['products_id']), 'POST') . '<span align="right" >'  .   tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART,'align="absbottom"') . '</span></form>&nbsp' . '</a>'; ?>
<?php
      } // if($products['manufacturers_name']<>'') {
    } // if ($products_attributes['total'] > 0) {
?>
          </tr>
<?php
  } // foreach ($products_data

?>
<!-- recently_viewed_eof //-->
        </table></td>
      </tr>
<?php
    if ( ($number_of_products > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo sprintf (TEXT_DISPLAY_NUMBER_OF_PRODUCTS, $product_start + 1, $product_start + $product_limit, $number_of_products); ?></td>
            <td align="right" class="main"><?php echo TEXT_RESULT_PAGE . ' ' . tep_display_links (MAX_DISPLAY_PAGE_LINKS, $current_page_number, $number_of_pages, basename ($PHP_SELF), tep_get_all_get_params (array ('page', 'info', 'x', 'y') ) ); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
    } //if ( ($number_of_rows
  } // if (count ($recently_viewed_array
?>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'viewed_bot')) { ?>
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