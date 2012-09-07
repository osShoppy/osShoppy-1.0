<?php // wishlist infobox 

  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST);


  $boxHeading = BOX_HEADING_WISHLIST;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_WISHLIST) . '"><img src="images/infobox/arrow_right_1.gif" border="0" alt="more" title="more" width="12" height="10"></a>';
  $box_base_name = 'wishlist_column';

    $info_box_contents = array();

	if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
	reset($wishList->wishID);

	if (count($wishList->wishID) < MAX_DISPLAY_WISHLIST_BOX) {

		$wishlist_box = '<table>';
		$counter = 1;

/*******************************************************************
*** LOOP THROUGH EACH PRODUCT ID TO DISPLAY IN THE WISHLIST BOX ****
*******************************************************************/

	    while (list($wishlist_id, ) = each($wishList->wishID)) {
		$wishlist_id = tep_get_prid($wishlist_id);

    	$products_query = tep_db_query("select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd ) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.products_id = '" . $wishlist_id . "' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name");
		$products = tep_db_fetch_array($products_query);

		$wishlist_box .= '<tr><td class="infoBoxContents" valign="top">0' . $counter . '.</td>';
		$wishlist_box .= '<td class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'], 'NONSSL') . '">' . $products['products_name'] . '</a></td></tr>';
		
		$counter++;
		}

	$wishlist_box .= '</table>';

	} else {

	$wishlist_box = '<div class="infoBoxContents">' . sprintf(TEXT_WISHLIST_COUNT, count($wishList->wishID)) . '</div>';

	}

  } else {

	$wishlist_box = '<div class="infoBoxContents">' . BOX_WISHLIST_EMPTY . '</div>';

  }

  $box_id = $box_base_name . 'Box';
  $boxContent = $wishlist_box;
  include (bts_select('boxes', $box_base_name));
  //$boxContent_attributes = '';
  //$boxLink = '';
?>