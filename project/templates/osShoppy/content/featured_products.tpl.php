<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'featured_top')) { ?>
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
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_featured_products.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
///// To random featured products
//  list($usec, $sec) = explode(' ', microtime());
//  srand( (float) $sec + ((float) $usec * 100000) );
//  $mtm= rand();
//////  
   $featured_products_array = array();
   $featured_products_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name
   from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id
   left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'
   left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
   left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
   where p.products_status = '1' and f.status = '1' order by p.products_date_added DESC, pd.products_name";
// to random//  $featured_products_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id left join " . TABLE_FEATURED . " f on p.products_id = f.products_id where p.products_status = '1' and f.status = '1' order by rand($mtm)";
   $featured_products_split = new splitPageResults($featured_products_query_raw, MAX_DISPLAY_FEATURED_PRODUCTS);

  if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_FEATURED_PRODUCTS); ?> </td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
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
        <td> <!-- Featured Products Main Page Box -->
		 <table bgcolor="ffffff" border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($featured_products_split->number_of_rows > 0) {
    $featured_products_query = tep_db_query($featured_products_split->sql_query);
    while ($featured_products = tep_db_fetch_array($featured_products_query)) {
    	if (tep_not_null($featured_products['specials_new_products_price'])) {
        $products_price = '<s>' . $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</s><br>';
       	$products_price .= '<span class="productSpecialPrice">' . $currencies->display_price($featured_products['specials_new_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>';
      } else {
        $products_price = $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id']));
      }
?>
          <tr>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], FEATURED_PRODUCTS_PAGE_IMAGE_WIDTH, FEATURED_PRODUCTS_PAGE_IMAGE_HEIGHT) . '</a>'; ?></td>
            <td valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '"><b><u>' . $featured_products['products_name'] . '</u></b></a><br>' . TEXT_DATE_ADDED . ' ' . tep_date_long($featured_products['products_date_added']) . '<br>' . TEXT_MANUFACTURER . ' ' . $featured_products['manufacturers_name'] . '<br><br>' . TEXT_PRICE . ' ' . $products_price; ?></td>
            <td align="right" valign="middle" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $featured_products['products_id']) . '">' . tep_image_button('button_in_cart.png', IMAGE_BUTTON_IN_CART) . '</a>'; ?></td>
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
        </table>
		</td>
      </tr>
<?php
  if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td>
		  <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_FEATURED_PRODUCTS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_products_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>
	   </td>
      </tr>
<?php
  }
?>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'featured_bot')) { ?>
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