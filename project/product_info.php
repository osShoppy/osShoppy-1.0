<?php //$Id: /catalog/product_info.php (osC)

  require('includes/application_top.php');

// dangling_carrot
	$check_gift = tep_db_query("select p.products_tax_class_id, p.products_carrot, p.products_price from " . TABLE_PRODUCTS . " p where p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' ");
	$gift = tep_db_fetch_array($check_gift);
  
	if ($gift['products_carrot'] == 1) {
	$product_gifts_query = tep_db_query("select g.gift_id, g.threshold, g.products_id from " . TABLE_CARROT . " g where g.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'");
	$product_gift = tep_db_fetch_array($product_gifts_query);
	}
// dangling_carrot

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

// additional images
  if (empty($_GET['pID'])) { $_GET['pID'] = $_GET['products_id']; }

if (ADDIMAGES_MENU_LOCATION == 'product_info') { 
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_POPUP_ADD_IMAGE);

 // $navigation->remove_current_page();

  if (!empty($_GET['imagesID'])) {
    $products_query = tep_db_query( "SELECT ai.products_id, ai.images_description, ai.thumb_images, ai.medium_images, ai.popup_images, p.products_image, p.products_image_med, p.products_image_pop, p.products_image_description FROM " . TABLE_ADDITIONAL_IMAGES . " ai, " . TABLE_PRODUCTS . " p WHERE ai.products_id=p.products_id and ai.additional_images_id = '".(int)$_GET['imagesID']."'");
    $selected_image = tep_db_fetch_array($products_query);
  } elseif (!empty($_GET['pID'])) {
    $products_query = tep_db_query( "SELECT products_id, products_image, products_image_med, products_image_pop, products_image_description FROM " . TABLE_PRODUCTS . " WHERE products_id = '".(int)$_GET['pID']."'");
    $selected_image = tep_db_fetch_array($products_query);
  }

  $imagemenu = new displayonpageimagemenu ( $selected_image['products_id'] );

  // calculate menu size in pixels
  $extra_window_width = 24;  // space for web browser
  $extra_window_height = 86;  // space for web browser

  if (ADDIMAGES_POPUP_SHOW_ON_POPUP == 'true' && ($imagemenu->addimages_count > 1)) {
    list ($menu_width, $menu_height) = $imagemenu->boxsize();
    if (ADDIMAGES_POPUP_TABLE_LOCATION == 'sides') { 
	  $extra_window_width += $menu_width; 
	  if ($imagemenu->maximageheight < $menu_height) { $imagemenu->maximageheight = $menu_height; }
	}
    if (ADDIMAGES_POPUP_TABLE_LOCATION == 'above' || ADDIMAGES_POPUP_TABLE_LOCATION == 'below') { 
	  $extra_window_height += $menu_height; 
	  if ($imagemenu->maximagewidth < $menu_width) { $imagemenu->maximagewidth = $menu_width; }
	}
  }
  if(!empty($selected_image['products_image_description'])) { 
    $imagemenu->maximageheight += 22; // add space for large image description text height
  }
}

// activate inactivate category
 // $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  if (!empty($hiddencats)) {
    $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.quotes_expire < now() and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) and pd.language_id = '" . (int)$languages_id . "'");
    $product_check = tep_db_fetch_array($product_check_query);
// BOF Separate Pricing per Customer
  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
    } else {
    $customer_group_id = '0';
    }
// EOF Separate Pricing per Customer
  } else {
    $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.quotes_expire < now() and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_check = tep_db_fetch_array($product_check_query);
// BOF Separate Pricing per Customer
  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
    } else {
    $customer_group_id = '0';
    }
// EOF Separate Pricing per Customer
  }

// quotes
  $customer_query = tep_db_query("select customers_id, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
  $customer = tep_db_fetch_array($customer_query);

  $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);

  $cust_id_query = tep_db_query("select quotes_email_address, products_id from " . TABLE_PRODUCTS . " where products_id = " . (int)$_GET['products_id'] );
  $cust_id = tep_db_fetch_array($cust_id_query);
  $invalidCust = false;

  if (empty($cust_id['quotes_email_address'])) {
    $invalidCust = 'false';
  }
  else if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
    if (strtolower($cust_id['quotes_email_address']) == strtolower($customer['customers_email_address']) || $customer['customers_email_address'] == STORE_OWNER_EMAIL_ADDRESS)
      $invalidCust = 'false';
    else
	  $invalidCust = 'true';
  } else {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
// quotes_eof

// begin recently_viewed
// creates/updates a session variable -- a string of products IDs separated by commas
//    IDs are in order newest -> oldest
  $recently_viewed_string = '';
  if ($product_check['total'] > 0) { //We don't want to add products that don't exist/are not available

    if (!tep_session_is_registered('recently_viewed')) {
      tep_session_register('recently_viewed');
    } else {
      $recently_viewed_string = $_SESSION['recently_viewed'];
    }

// Deal with sessions created by the previous version
    if (substr_count ($recently_viewed_string, ';') > 0) {
      $_SESSION['recently_viewed'] = '';
      $recently_viewed_string = '';
    }
  
// We only want a product to display once, so check that the product is not already in the session variable
    $products_id = (int) $_GET['products_id'];
    if ($recently_viewed_string == '') { // No other products
      $recently_viewed_string = (string) $products_id; // So set the variable to the current products ID
    } else {
      $recently_viewed_array = explode (',', $recently_viewed_string);
      if (!in_array ($products_id, $recently_viewed_array) ) {
        $recently_viewed_string = $products_id . ',' . $recently_viewed_string; //Add the products ID to the beginning of the variable
      }
    }

    $_SESSION['recently_viewed'] = $recently_viewed_string;
    
  } //if ($product_check['total']
// recently_viewed_eof

  $content = CONTENT_PRODUCT_INFO;
  $javascript = 'popup_window.js';
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
