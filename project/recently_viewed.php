<?php //$Id: /catalog/recently_viewed.php (5520)

  require_once ('includes/application_top.php');

  require_once (DIR_WS_LANGUAGES . $language . '/' . FILENAME_RECENTLY_VIEWED);

  $error = '';

// Check that the customer has viewed some products
  if (tep_session_is_registered ('recently_viewed') && strlen ($_SESSION['recently_viewed']) > 0) { 
    $recently_viewed_string = $_SESSION['recently_viewed'];

// Deal with sessions created by the previous version
    if (substr_count ($recently_viewed_string, ';') > 0) {
      $_SESSION['recently_viewed'] = '';
      $recently_viewed_string = '';
    }

    // Turn the string of product IDs into an array in the correct order
    $recently_viewed_string = strtr ($recently_viewed_string, ',,', ','); // Remove blank values
    $recently_viewed_array = explode (',', $recently_viewed_string); // Array is in order newest first
    
    if (RECENTLY_VIEWED_DISPLAY_ORDER == 'Oldest') { // Reverse the order if set in Admin
      $recently_viewed_array = array_reverse ($recently_viewed_array);
    }

// Get the information to set up the products for the current page
    $number_of_products = count ($recently_viewed_array); // Total number of products viewed
    $current_page_number = 1;
    if (isset ($_GET['page']) && $_GET['page'] > 1) {
      $current_page_number = (int) $_GET['page'];
    }
    $number_of_pages = ceil ($number_of_products / MAX_DISPLAY_RECENTLY_VIEWED_PAGE_PRODUCTS);
    if ($current_page_number > $number_of_pages) {
      $current_page_number = $number_of_pages;
    }
    $product_start = ($current_page_number - 1) * MAX_DISPLAY_RECENTLY_VIEWED_PAGE_PRODUCTS;
    $product_limit = $current_page_number * MAX_DISPLAY_RECENTLY_VIEWED_PAGE_PRODUCTS;
    if ($number_of_products - $product_start < $product_limit) {
      $product_limit = $number_of_products - $product_start;
    }

    // Limit the recently viewed array to the products we want to show on this page
    $recently_viewed_array = array_slice ($recently_viewed_array, $product_start, $product_limit);

// Retrieve the data on the products in the recently viewed list and load into an array in the correct order
    $products_data = array();
    foreach ($recently_viewed_array as $products_id) {
      $products_query = tep_db_query ("select m.manufacturers_name,
                                              p.products_id, 
                                              pd.products_name, 
                                              p.products_image, 
                                              p.products_tax_class_id, 
                                              p.products_date_added,
                                              pd.products_description,
                                              s.status, 
                                              s.specials_new_products_price, 
                                              p.products_price
                                      from " . TABLE_PRODUCTS_DESCRIPTION . " pd, 
                                           " . TABLE_PRODUCTS . " p
                                        left join " . TABLE_MANUFACTURERS . " m 
                                          on m.manufacturers_id = p.manufacturers_id
                                        left join " . TABLE_SPECIALS . " s 
                                          on s.products_id = p.products_id
                                      where p.products_id in (" . $recently_viewed_string . ") 
                                        and p.products_status = '1' 
                                        and p.products_id = pd.products_id 
                                        and pd.language_id = '" . (int) $languages_id . "'
                                        and p.products_id =  '" . (int) $products_id . "'
                                   ");
      $products = tep_db_fetch_array ($products_query);
      
      // Truncate the description and add More Information link if set in Admin
      $show_more = '';
      $description = $products['products_description'];
      if (MAX_RECENTLY_VIEWED_PAGE_DESCRIPTION_LENGTH > 0) {
        $description_length = strlen ($description);
        if ($description_length > MAX_RECENTLY_VIEWED_PAGE_DESCRIPTION_LENGTH) {
          $description = tep_limit_text ($description, MAX_RECENTLY_VIEWED_PAGE_DESCRIPTION_LENGTH, MAX_WORD_LENGTH);
          if (RECENTLY_VIEWED_PAGE_SHOW_MORE == 'Shorter') {
            $show_more = TEXT_SHOW_MORE;
          } // if (RECENTLY_VIEWED_PAGE_SHOW_MORE
        } // if ($description_length
      } // if (MAX_DISPLAY_RECENTLY_VIEWED_PAGE_DESCRIPTION_LENGTH
      
      if (RECENTLY_VIEWED_PAGE_SHOW_MORE == 'All') {
        $show_more = TEXT_SHOW_MORE;
      } // if (RECENTLY_VIEWED_PAGE_SHOW_MORE
      
      $products_data[$products_id] = array ('products_id' => $products_id,
                                            'manufacturers_name' => $products['manufacturers_name'],
                                            'products_name' => $products['products_name'],
                                            'products_image' => $products['products_image'],
                                            'products_tax_class_id' => $products['products_tax_class_id'],
                                            'products_date_added' => $products['products_date_added'],
                                            'products_description' => $description,
                                            'show_more' => $show_more,
                                            'specials_status' => $products['status'],
                                            'specials_new_products_price' => $products['specials_new_products_price'],
                                            'products_price' => $products['products_price']
                                           );
    } // foreach ($recently_viewed_array

    if (count ($products_data) == 0) { // Show message if we don't have any products in the array
      $error = ERROR_NO_PRODUCTS_VIEWED;
    }

  } else {  // Show message if we don't have a session or variable is empty
    $error = ERROR_NO_PRODUCTS_VIEWED;
  }
  
  $breadcrumb->add (NAVBAR_TITLE, tep_href_link (FILENAME_RECENTLY_VIEWED));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_RECENTLY_VIEWED;
  //  $content_template = TEMPLATENAME_STATIC;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
