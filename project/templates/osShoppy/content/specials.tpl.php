<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'specials_top')) { ?>
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
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_specials.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
/*  if (!empty($hiddencats)) {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and p.products_id = p2c.products_id and (not p2c.categories_id in (" . implode(',', $hiddencats) . ")) and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' group by p.products_id order by s.specials_date_added DESC";
  } else {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC";
  }
*/
if(EXCLUDE_GIFT_SPECIALS == 'true') {
// BOF Separate Pricing Per Customer
//  global variable (session): $sppc_customers_group_id -> local variable $customer_group_id
  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }
  $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_carrot = '0' and p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id = '" . (int)$customer_group_id . "' order by s.specials_date_added DESC";
// EOF Separate Pricing Per Customer
} else {
// BOF Separate Pricing Per Customer
//  global variable (session): $sppc_customers_group_id -> local variable $customer_group_id
  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }
  $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id = '" . (int)$customer_group_id . "' order by s.specials_date_added DESC";
// EOF Separate Pricing Per Customer
}
	
	$specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);

  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
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
<?php
// BOF Separate Pricing Per Customer

    $row = 0;
    $specials_query = tep_db_query($specials_split->sql_query);

    $no_of_specials = tep_db_num_rows($specials_query);
// get all product prices from the table products_groups in one query
// traverse specials_query for products_id's, store the query result in a numbered array
   while ($_specials = tep_db_fetch_array($specials_query)) {
     $specials[] = $_specials;
     $list_of_prdct_ids[] = $_specials['products_id'];
   } // end while ($_specials = tep_db_fetch_array($specials_query))
// a line needed for the selection of the products_id's
  $pg_list_of_prdct_ids = "products_id = '".$list_of_prdct_ids[0]."' ";
  if ($no_of_specials > 1) {
    for ($n = 1 ; $n < count($list_of_prdct_ids) ; $n++) {
      $pg_list_of_prdct_ids .= "or products_id = '".$list_of_prdct_ids[$n]."' ";
    }
  }
// now get all the customers_group_price's
$pg_query = tep_db_query("select products_id, customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where (".$pg_list_of_prdct_ids.") and customers_group_id =  '" . $customer_group_id . "' and customers_group_price != null");
// put all the info in an array called new_prices
    while ($pg_array = tep_db_fetch_array($pg_query)) {
      $new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['customers_group_price']);
	}
// we already got the results from the query and put them into an array, can't use while now
//    while ($specials = tep_db_fetch_array($specials_query)) {
	for ($x = 0; $x < $no_of_specials; $x++) {
      $row++;
// replace products prices with those from customers_group table
      if (!empty($new_prices)) {
        for ($i = 0; $i < count($new_prices); $i++) {
          if ($specials[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
            $specials[$x]['products_price'] = $new_prices[$i]['products_price'];
          }
        }
      } // end if (!empty($new_prices)

      echo '            <td align="center" width="33%" class="smallText"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $specials[$x]['products_image'], $specials[$x]['products_name'], SPECIALS_PAGE_IMAGE_WIDTH, SPECIALS_PAGE_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials[$x]['products_id']) . '">' . $specials[$x]['products_name'] . '</a><br><s>' . $currencies->display_price($specials[$x]['products_price'], tep_get_tax_rate($specials[$x]['products_tax_class_id'])) . '</s><br><span class="productSpecialPrice">' . $currencies->display_price($specials[$x]['specials_new_products_price'], tep_get_tax_rate($specials[$x]['products_tax_class_id'])) . '</span></td>' . "\n";
 // EOF Separate Pricing per Customer, specials code

      if ((($row / 3) == floor($row / 3))) {
?>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
<?php
      }
    }
?>
          </tr>
        </table></td>
      </tr>
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'specials_bot')) { ?>
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

