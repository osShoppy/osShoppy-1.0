<?php // bestsellers infobox 

  $quotes = (defined('QUOTES_CATEGORY_NAME')) ? " and p.quotes_email_address = '' " : '';

  if (isset($current_category_id) && ($current_category_id > 0)) {

    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) " . $quotes . " order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);

// activate inactivate category /Step-1(1)\
  } elseif (!empty($hiddencats)) {
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'" . $quotes . "  and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  } else {
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'" . $quotes . " order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  }

  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
  $boxHeading = BOX_HEADING_BESTSELLERS;
  $corner_top_left = 'rounded_3';
  $corner_top_right = 'rounded_3';
  $corner_bot_left = 'rounded_3';
  $corner_bot_right = 'rounded_3';
  $boxLink = '<a href="' . tep_href_link(FILENAME_BEST_SELLERS) . '"><img src="images/infobox/arrow_right_3.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';
  $box_base_name = 'best_sellers';

  $box_id = $box_base_name . 'Box'; 

  $rows = 0;
  $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';

  while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
    $rows++;
    $boxContent .= '<tr><td class="infoBoxContents" valign="top">' . tep_row_number_format($rows) . '.</td><td class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '">' . $best_sellers['products_name'] . '</a></td></tr>';
  }

  $boxContent .= '</table>';
  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
  }
?>