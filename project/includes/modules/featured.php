<?php // catalog/includes/modules/featured.php (0651)

  $featured_products_category_id =  (isset($new_products_category_id))?$new_products_category_id:'0';
  $cat_name_query = tep_db_query('SELECT `categories_name` FROM ' . TABLE_CATEGORIES_DESCRIPTION . " WHERE `categories_id` = '" . $featured_products_category_id . "' limit 1");
  $cat_name_fetch = tep_db_fetch_array($cat_name_query);
  $cat_name = $cat_name_fetch['categories_name'];
  $info_box_contents = array();

  list($usec, $sec) = explode(' ', microtime());
  srand( (float) $sec + ((float) $usec * 100000) );
  $mtm= rand();
  	
  if ( (!isset($featured_products_category_id)) || ($featured_products_category_id == '0') ) {
  	$info_box_contents[] = array('align' => 'left', 'text' => '<a class="headerNavigation" href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . TABLE_HEADING_FEATURED_PRODUCTS . '</a>');

    // Phocea Optimize featured query
    // Ben: Option to only show featured products on sale
    $query = 'SELECT p.products_id, p.products_image, p.products_tax_class_id, IF (s.status, s.specials_new_products_price, NULL) AS specials_new_products_price, p.products_price, pd.products_name ';

	if ( defined('FEATURED_PRODUCTS_SPECIALS_ONLY') AND FEATURED_PRODUCTS_SPECIALS_ONLY == 'true' ) {
      $query .= 'FROM ' . TABLE_SPECIALS . ' s LEFT JOIN ' . TABLE_PRODUCTS . ' p ON s.products_id = p.products_id ';
	} else {
      $query .= 'FROM ' . TABLE_PRODUCTS . ' p LEFT JOIN ' . TABLE_SPECIALS . ' s ON p.products_id = s.products_id ';
	}

    $query .= 'LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . " pd ON p.products_id = pd.products_id AND pd.language_id = '" . $languages_id . "'
    LEFT JOIN " . TABLE_FEATURED . " f ON p.products_id = f.products_id
    WHERE p.products_status = '1' AND f.status = '1' order by rand($mtm) DESC limit " . MAX_DISPLAY_FEATURED_PRODUCTS;

    $featured_products_query = tep_db_query( $query );	
  } else {
    $info_box_contents[] = array('align' => 'left', 'text' => sprintf(TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY, $cat_name));
    $subcategories_array = array();
    tep_get_subcategories($subcategories_array, $featured_products_category_id);
    $featured_products_category_id_list = tep_array_values_to_string($subcategories_array);
    if ($featured_products_category_id_list == '') {
      $featured_products_category_id_list .= $featured_products_category_id;
    } else {
      $featured_products_category_id_list .= ',' . $featured_products_category_id;
    }

	if ( defined('FEATURED_PRODUCTS_SUB_CATEGORIES') AND FEATURED_PRODUCTS_SUB_CATEGORIES == 'true' ) {
      // current catID as starting value
      $cats[] = $new_products_category_id; 
      // put cat-IDs of all cats nested in current branch into $cats array, 
      // go through all subbranches
      for($i=0; $i<count($cats); $i++) {
        $categorie_query = tep_db_query('SELECT `categories_id` FROM ' . TABLE_CATEGORIES . " WHERE parent_id = '" . (int)$cats[$i] . "'"); 
        while ($categorie = tep_db_fetch_array($categorie_query)) {
          $cats[] = $categorie['categories_id'];
        }
	    // sort out doubles
        $cats = array_unique($cats);
      }
      $catIdSql = implode(', ', $cats);
	} else {
      $catIdSql = $featured_products_category_id_list;
	}

    // Phocea Optimize featured query
	$query = 'SELECT distinct p.products_id, p.products_image, p.products_tax_class_id, IF (s.status, s.specials_new_products_price, NULL) AS specials_new_products_price, p.products_price, pd.products_name
    FROM ' . TABLE_PRODUCTS . ' p LEFT JOIN ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c using(products_id)
    LEFT JOIN ' . TABLE_CATEGORIES . ' c USING (categories_id)
    LEFT JOIN ' . TABLE_FEATURED . ' f ON p.products_id = f.products_id
    LEFT JOIN ' . TABLE_SPECIALS . ' s ON p.products_id = s.products_id
    LEFT JOIN ' . TABLE_PRODUCTS_DESCRIPTION . " pd ON p.products_id = pd.products_id AND pd.language_id = '" . $languages_id . "' 
    where c.categories_id IN(" . $catIdSql . ") AND p.products_status = '1' AND f.status = '1' ";

	if ( defined('FEATURED_PRODUCTS_SPECIALS_ONLY') AND FEATURED_PRODUCTS_SPECIALS_ONLY == 'true' ) {
		$query .= " AND s.status = '1' ";
	}
	$query .= 'ORDER BY rand(' . $mtm . ') DESC LIMIT ' . MAX_DISPLAY_FEATURED_PRODUCTS;

    $featured_products_query = tep_db_query( $query );
}

  $row = 0;
  $col = 0; 
  $num = 0;
  while ($featured_products = tep_db_fetch_array($featured_products_query)) {
    $num ++;
    if ($num == 1) {
  new infoBoxHeading($info_box_contents, false, false);
    }
	// If on special show regular and sale price
  	if (tep_not_null($featured_products['specials_new_products_price'])) {
      $products_price = '<s>' . $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</s><br>';
     	$products_price .= '<span class="productSpecialPrice">' . $currencies->display_price($featured_products['specials_new_products_price'], tep_get_tax_rate($featured_products['products_tax_class_id'])) . '</span>';
    } else {
      $products_price = $currencies->display_price($featured_products['products_price'], tep_get_tax_rate($featured_products['products_tax_class_id']));
    }
    $info_box_contents[$row][$col] = array('align' => 'center',
                                          'params' => 'class="smallText" width="33%" valign="top"',
                                          'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $featured_products['products_image'], $featured_products['products_name'], FEATURED_PRODUCTS_MODULE_IMAGE_WIDTH, FEATURED_PRODUCTS_MODULE_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products['products_id']) . '">' . $featured_products['products_name'] . '</a><br>' . $products_price);
    $col ++;
    if ($col > 2) {
      $col = 0;
      $row ++;
    }
  }
  if($num) {
      
      new contentBox($info_box_contents);
  }
?>
<!-- featured_products_eof //-->
