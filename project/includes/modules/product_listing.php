<?php // catalog/includes/modules/product_listing.php (osC)

  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }

  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $lc_align = 'center';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
        $lc_text = TABLE_HEADING_BUY_NOW;
        $lc_align = 'center';
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($HTTP_GET_VARS['sort'], $col+1, $lc_text);
    }

    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="productListing-heading"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

/*  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
      $rows++;
*/
 if ($listing_split->number_of_rows > 0) {

    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
// BOF Separate Pricing per Customer
    $no_of_listings = tep_db_num_rows($listing_query);
// global variable (session) $sppc_customer_group_id -> local variable customer_group_id

  if(isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
  $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
   $customer_group_id = '0';
  }

    while ($_listing = tep_db_fetch_array($listing_query)) {
// BOF QPBPP for SPPC
     $_listing['discount_categories_id'] = NULL;
     $listing[] = $_listing;
     $list_of_prdct_ids[] = $_listing['products_id'];
    }
    $list_of_prdct_ids = array_unique($list_of_prdct_ids);
// EOF QPBPP for SPPC
// next part is a debug feature, when uncommented it will print the info that this module receives
 /*
   echo '<pre>';
   print_r($listing);
   echo '</pre>';
 */

// get all product prices for products with the particular customer_group_id
// however not necessary for customer_group_id = 0
if ($customer_group_id != '0') {
// BOF QPBPP for SPPC
  $pg_query = tep_db_query("select pg.products_id, customers_group_price as price from " . TABLE_PRODUCTS_GROUPS . " pg where products_id in (" . implode(',', $list_of_prdct_ids) . ") and pg.customers_group_id = '" . $customer_group_id . "' and customers_group_price != null");
// EOF QPBPP for SPPC
 //   $no_of_pg_products = tep_db_num_rows($pg_query) ;
	while ($pg_array = tep_db_fetch_array($pg_query)) {
	$new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['price'], 'specials_new_products_price' => '', 'final_price' => $pg_array['price']);
	}
    for ($x = 0; $x < $no_of_listings; $x++) {
// replace products prices with those from customers_group table
      if(!empty($new_prices)) {
        for ($i = 0; $i < count($new_prices); $i++) {
	        if( $listing[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
		        $listing[$x]['products_price'] = $new_prices[$i]['products_price'];
		        $listing[$x]['final_price'] = $new_prices[$i]['final_price'];
		      }
	      }
	    } // end if(!empty($new_prices)
	$listing[$x]['specials_new_products_price'] = ''; // makes sure that a retail specials price doesn't carry over to another customer group
	$listing[$x]['final_price'] = $listing[$x]['products_price']; // final price should not be the retail special price
   } // end for ($x = 0; $x < $no_of_listings; $x++)
} // end if ($customer_group_id != '0')

// an extra query is needed for all the specials

	$specials_query = tep_db_query("select products_id, specials_new_products_price from " . TABLE_SPECIALS . " where products_id in (" . implode(',', $list_of_prdct_ids) . ") and status = '1' and customers_group_id = '" . $customer_group_id . "'");
	while ($specials_array = tep_db_fetch_array($specials_query)) {
	$new_s_prices[] = array ('products_id' => $specials_array['products_id'], 'products_price' => '', 'specials_new_products_price' => $specials_array['specials_new_products_price'] , 'final_price' => $specials_array['specials_new_products_price']);
	}

// add the correct specials_new_products_price and replace final_price
	for ($x = 0; $x < $no_of_listings; $x++) {
    if(!empty($new_s_prices)) {
	    for ($i = 0; $i < count($new_s_prices); $i++) {
		    if( $listing[$x]['products_id'] == $new_s_prices[$i]['products_id'] ) {
		    $listing[$x]['specials_new_products_price'] = $new_s_prices[$i]['specials_new_products_price'];
		    $listing[$x]['final_price'] = $new_s_prices[$i]['final_price'];
		    }
	    }
	  } // end if(!empty($new_s_prices)
	} // end for ($x = 0; $x < $no_of_listings; $x++)

// BOF QPBPP for SPPC
    $price_breaks_query = tep_db_query("select products_id, products_price, products_qty from  " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id in (" . implode(',', $list_of_prdct_ids) . ") and customers_group_id = '" . $customer_group_id . "' order by products_id, products_qty");
    while ($price_break = tep_db_fetch_array($price_breaks_query)) {
          $price_breaks_array[$price_break['products_id']][] = array('products_price' => $price_break['products_price'], 'products_qty' => $price_break['products_qty']);
    }
// get discount category plus quantity blocks and minimum order quantity for retail
    $discount_category_query = tep_db_query("select p.products_id, p.products_qty_blocks as qtyBlocks, p.products_min_order_qty, p.products_quantity, p.manufacturers_id, p.products_weight, discount_categories_id from " . TABLE_PRODUCTS ." p left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id in (" . implode(',', $list_of_prdct_ids) . ") and customers_group_id = '" . $customer_group_id . "') as ptdc on p.products_id = ptdc.products_id where p.products_id in (" . implode(',', $list_of_prdct_ids) . ")");
      while ($dc_array = tep_db_fetch_array($discount_category_query)) {
        $discount_categories[] = array ('products_id' => $dc_array['products_id'], 'qtyBlocks' => ($customer_group_id == '0' ? $dc_array['qtyBlocks']: '1'), 'products_min_order_qty' => ($customer_group_id == '0' ? $dc_array['products_min_order_qty']: '1'), 'products_quantity' => $dc_array['products_quantity'], 'products_weight' => $dc_array['products_weight'], 'discount_categories_id' => $dc_array['discount_categories_id']);
      }
      if(!empty($discount_categories)) {
        $no_of_discount_cats = count($discount_categories);
      for ($x = 0; $x < $no_of_listings; $x++) {
// add discount categories to the listing array 
        for ($i = 0; $i < $no_of_discount_cats; $i++) {
            if ($listing[$x]['products_id'] == $discount_categories[$i]['products_id'] ) {
                $listing[$x]['discount_categories_id'] = $discount_categories[$i]['discount_categories_id'];
                $listing[$x]['qtyBlocks'] = $discount_categories[$i]['qtyBlocks'];
                $listing[$x]['products_min_order_qty'] = $discount_categories[$i]['products_min_order_qty'];
                $listing[$x]['products_quantity'] = $discount_categories[$i]['products_quantity'];
                $listing[$x]['products_weight'] = $discount_categories[$i]['products_weight'];
              }
          } // end for ($i = 0; $i < $no_of_discount_cats; $i++) {
        }
    } // end if(!empty($discount_categories)

// if customer group id is not retail we will have to do another query to get the 
// quantity blocks and minimum order quantity
  if ($customer_group_id != '0') {
    $pg_qb_moq_query = tep_db_query("select pg.products_id, pg.products_qty_blocks as qtyBlocks, pg.products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " pg where products_id in (" . implode(',', $list_of_prdct_ids) . ") and pg.customers_group_id = '" . $customer_group_id . "'");

      while ($pg_qb_moq_array = tep_db_fetch_array($pg_qb_moq_query)) {
       $new_qb_moq[] = array ('products_id' => $pg_qb_moq_array['products_id'], 'qtyBlocks' => $pg_qb_moq_array['qtyBlocks'], 'products_min_order_qty' => $pg_qb_moq_array['products_min_order_qty']);
      }
      if (!empty($new_qb_moq)) {
        $no_of_pg_qb_moq = count($new_qb_moq);
      for ($x = 0; $x < $no_of_listings; $x++) {
        for  ($i = 0; $i < $no_of_pg_qb_moq; $i++) {
          if ($listing[$x]['products_id'] == $new_qb_moq[$i]['products_id'] ) {
                $listing[$x]['qtyBlocks'] = $new_qb_moq[$i]['qtyBlocks'];
                $listing[$x]['products_min_order_qty'] = $new_qb_moq[$i]['products_min_order_qty'];
          }
        }
      }
    } // end if (!empty($new_qb_moq))
  } // end if ($customer_group_id != '0')
// EOF QPBPP for SPPC

//    while ($listing = tep_db_fetch_array($listing_query)) { (was original code)
	for ($x = 0; $x < $no_of_listings; $x++) {
      $rows++;
      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_align = '';
/*            $lc_text = '&nbsp;' . $listing['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            $lc_align = '';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . $listing['products_name'] . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
            if (tep_not_null($listing['specials_new_products_price'])) {
              $lc_text = '&nbsp;<s>' .  $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>&nbsp;';
            } else {
              $lc_text = '&nbsp;' . $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing['products_quantity'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing['products_weight'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], PRODUCT_LIST_IMAGE_WIDTH, PRODUCT_LIST_IMAGE_HEIGHT) . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing['products_image'], $listing['products_name'], PRODUCT_LIST_IMAGE_WIDTH, PRODUCT_LIST_IMAGE_HEIGHT) . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
              $lc_align = 'center';
//// Ultimate SEO url's 5 PRO
// original ->$lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;';
              $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'products_id')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;';
*/
            $lc_text = '&nbsp;' . $listing[$x]['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            $lc_align = '';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing[$x]['products_id']) . '">' . $listing[$x]['products_name'] . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing[$x]['products_id']) . '">' . $listing[$x]['products_name'] . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing[$x]['manufacturers_id']) . '">' . $listing[$x]['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
// BOF QPBPP for SPPC
            $price_breaks_from_listing = array();
            if (isset($price_breaks_array[$listing[$x]['products_id']])) {
              $price_breaks_from_listing = $price_breaks_array[$listing[$x]['products_id']];
            }
            $pf->loadProduct($listing[$x]['products_id'], $languages_id, $listing[$x], $price_breaks_from_listing);
            $lc_text = $pf->getPriceStringShort();
// EOF QPBPP for SPPC
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing[$x]['products_quantity'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
            $lc_text = '&nbsp;' . $listing[$x]['products_weight'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            if (isset($HTTP_GET_VARS['manufacturers_id'])) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing[$x]['products_image'], $listing[$x]['products_name'], PRODUCT_LIST_IMAGE_WIDTH, PRODUCT_LIST_IMAGE_HEIGHTT) . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $listing[$x]['products_image'], $listing[$x]['products_name'], PRODUCT_LIST_IMAGE_WIDTH, PRODUCT_LIST_IMAGE_HEIGHT) . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_align = 'center';
            $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing[$x]['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;'; // EOF Separate Pricing per Customer
		break;
        }

        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="productListing-data"',
                                               'text'  => $lc_text);
      }
    }

//BOF: Search Tag Cloud v2.4 by darkamex
    if (($_GET['keywords'] != '')) {
    $search_count = tep_db_query("select search, freq from customers_searches where search = '". $_GET['keywords'] . "' and language_id='". $languages_id . "'");
      if (!tep_db_num_rows($search_count)) {
      tep_db_query("insert into customers_searches (search, freq, language_id) values ('". tep_db_input($_GET['keywords']) ."',1," .$languages_id." )");
       } else {
      $search_val = tep_db_fetch_array($search_count);
      tep_db_query("update customers_searches set freq = " . ($search_val['freq']+1) . " where search = '". tep_db_input($_GET['keywords']) . "' and language_id='". $languages_id . "'");
      }
    }
//EOF: Search Tag Cloud v2.3 by faaliyet

new productListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                   'text' => TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }
?>
