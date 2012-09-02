<?php //$Id: /catalog/checkout_process.php (osC)

  include('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping') || !tep_session_is_registered('sendto')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if ( (tep_not_null(MODULE_PAYMENT_INSTALLED)) && (!tep_session_is_registered('payment')) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
 }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);

// load selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
// bof - credit class gift voucher
  if ($credit_covers) $payment='';
// eof - credit class gift voucher
  $payment_modules = new payment($payment);

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

  $payment_modules->update_status();

// bof - points and rewards added:  && (!$customer_shopping_points_spending)
// bof - credit class gift voucher CREDIT COVERS FIX
/* original
  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  } */
  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) && (!$credit_covers) && (!$customer_shopping_points_spending) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }
// eof - credit class gift voucher 

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();

// load the before_process function from the payment modules
  $payment_modules->before_process();

  $sql_data_array = array('customers_id' => $customer_id,
                          'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['insertion'] . ' ' . $order->customer['lastname'],
                          'customers_company' => $order->customer['company'],
                          'customers_street_address' => $order->customer['street_address'],
                          'customers_street_no' => $order->customer['street_no'], 
                          'customers_street_no_add' => $order->customer['street_no_add'], 						  
                          'customers_suburb' => $order->customer['suburb'],
                          'customers_city' => $order->customer['city'],
                          'customers_postcode' => $order->customer['postcode'], 
                          'customers_state' => $order->customer['state'], 
                          'customers_country' => $order->customer['country']['title'], 
                          'customers_telephone' => $order->customer['telephone'], 
                          'customers_email_address' => $order->customer['email_address'],
                          'customers_address_format_id' => $order->customer['format_id'], 
                          'customers_dummy_account' => $order->customer['is_dummy_account'], 
                          'delivery_name' => trim($order->delivery['firstname'] . ' ' . $order->delivery['insertion'] . ' ' . $order->delivery['lastname']),
                          'delivery_company' => $order->delivery['company'],
                          'delivery_street_address' => $order->delivery['street_address'], 
                          'delivery_street_no' => $order->delivery['street_no'], 
                          'delivery_street_no_add' => $order->delivery['street_no_add'], 						  
                          'delivery_suburb' => $order->delivery['suburb'], 
                          'delivery_city' => $order->delivery['city'], 
                          'delivery_postcode' => $order->delivery['postcode'], 
                          'delivery_state' => $order->delivery['state'], 
                          'delivery_country' => $order->delivery['country']['title'], 
                          'delivery_address_format_id' => $order->delivery['format_id'], 
                          'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['insertion'] . ' ' . $order->billing['lastname'], 
                          'billing_company' => $order->billing['company'],
                          'billing_street_address' => $order->billing['street_address'], 
                          'billing_street_no' => $order->billing['street_no'], 
                          'billing_street_no_add' => $order->billing['street_no_add'], 						  
         				  'billing_suburb' => $order->billing['suburb'], 
                          'billing_city' => $order->billing['city'], 
                          'billing_postcode' => $order->billing['postcode'], 
                          'billing_state' => $order->billing['state'], 
                          'billing_country' => $order->billing['country']['title'], 
                          'billing_address_format_id' => $order->billing['format_id'], 
                          'payment_method' => $order->info['payment_method'],
						  'shipping_module' => $shipping['id'],
                          'cc_type' => $order->info['cc_type'], 
                          'cc_owner' => $order->info['cc_owner'], 
                          'cc_number' => $order->info['cc_number'], 
                          'cc_expires' => $order->info['cc_expires'], 
                          'giftMessage' => $giftwrap_message,
                          'date_purchased' => 'now()', 
                          'last_modified' => 'now()',
                          'orders_status' => $order->info['order_status'], 
                          'currency' => $order->info['currency'], 
                          'currency_value' => $order->info['currency_value']);
  tep_db_perform(TABLE_ORDERS, $sql_data_array);
  $insert_id = tep_db_insert_id();
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $sql_data_array = array('orders_id' => $insert_id,
                            'title' => $order_totals[$i]['title'],
                            'text' => $order_totals[$i]['text'],
                            'value' => $order_totals[$i]['value'], 
                            'class' => $order_totals[$i]['code'], 
                            'sort_order' => $order_totals[$i]['sort_order']);
    tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
  }

// bof - points and rewards
  if ((USE_POINTS_SYSTEM == 'true') && (USE_REDEEM_SYSTEM == 'true')) {
// customer pending points added 
      if ($order->info['total'] > 0) {
	      $points_toadd = get_points_toadd($order);
	      $points_comment = 'TEXT_DEFAULT_COMMENT';
	      $points_type = 'SP';
	      if ((get_redemption_awards($customer_shopping_points_spending) == true) && ($points_toadd >0)) {
		      tep_add_pending_points($customer_id, $insert_id, $points_toadd, $points_comment, $points_type);
	      }
      }
// customer referral points added 
      if ((tep_session_is_registered('customer_referral')) && (tep_not_null(USE_REFERRAL_SYSTEM))) {
	      $referral_twice_query = tep_db_query("select unique_id from " . TABLE_CUSTOMERS_POINTS_PENDING . " where orders_id = '". (int)$insert_id ."' and points_type = 'RF' limit 1");
	      if (!tep_db_num_rows($referral_twice_query)) {
		      $points_toadd = USE_REFERRAL_SYSTEM;
		      $points_comment = 'TEXT_DEFAULT_REFERRAL';
		      $points_type = 'RF';
		      tep_add_pending_points($customer_referral, $insert_id, $points_toadd, $points_comment, $points_type);
	      }
      }
// customer shoppping points account balanced 
      if ($customer_shopping_points_spending) {
	      tep_redeemed_points($customer_id, $insert_id, $customer_shopping_points_spending);
      }
  }
// eof - points and rewards
  
  $customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
  $sql_data_array = array('orders_id' => $insert_id, 
                          'orders_status_id' => $order->info['order_status'], 
                          'date_added' => 'now()', 
                          'customer_notified' => $customer_notification,
                          'comments' => $order->info['comments']);
  tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

// initialized for the email confirmation
  $products_ordered = '';
  $subtotal = 0;
  $total_tax = 0;

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
// bof - qtpro		
// Stock Update - Joao Correia
/*    if (STOCK_LIMITED == 'true') {
      if (DOWNLOAD_ENABLED == 'true') { */
    $products_stock_attributes=null;
    if (STOCK_LIMITED == 'true') {
        $products_attributes = $order->products[$i]['attributes'];
//      if (DOWNLOAD_ENABLED == 'true') {
// eof - qtpro		
$stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename 
                            FROM " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                             ON p.products_id=pa.products_id
                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                             ON pa.products_attributes_id=pad.products_attributes_id
                            WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
// Will work with only one option for downloadable products
// otherwise, we have to build the query dynamically with a loop
// bof - qtpro		
//      $products_attributes = $order->products[$i]['attributes'];
// eof - qtpro		
		if (is_array($products_attributes)) {
          $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
        }
        $stock_query = tep_db_query($stock_query_raw);
      } else {
        $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
      }
      if (tep_db_num_rows($stock_query) > 0) {
        $stock_values = tep_db_fetch_array($stock_query);
// do not decrement quantities if products_attributes_filename exists
/*      if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
          $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
        } else {
          $stock_left = $stock_values['products_quantity'];
        }
        tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
*/
        $actual_stock_bought = $order->products[$i]['qty'];
        $download_selected = false;
        if ((DOWNLOAD_ENABLED == 'true') && isset($stock_values['products_attributes_filename']) && tep_not_null($stock_values['products_attributes_filename'])) {
          $download_selected = true;
          $products_stock_attributes='$$DOWNLOAD$$';
        }
// If not downloadable and attributes present, adjust attribute stock
        if (!$download_selected && is_array($products_attributes)) {
          $all_nonstocked = true;
          $products_stock_attributes_array = array();
          foreach ($products_attributes as $attribute) {
            if ($attribute['track_stock'] == 1) {
              $products_stock_attributes_array[] = $attribute['option_id'] . "-" . $attribute['value_id'];
              $all_nonstocked = false;
            }
          } 
          if ($all_nonstocked) {
            $actual_stock_bought = $order->products[$i]['qty'];
          }  else {
            asort($products_stock_attributes_array, SORT_NUMERIC);
            $products_stock_attributes = implode(",", $products_stock_attributes_array);
            $attributes_stock_query = tep_db_query("select products_stock_quantity from " . TABLE_PRODUCTS_STOCK . " where products_stock_attributes = '$products_stock_attributes' AND products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
            if (tep_db_num_rows($attributes_stock_query) > 0) {
              $attributes_stock_values = tep_db_fetch_array($attributes_stock_query);
              $attributes_stock_left = $attributes_stock_values['products_stock_quantity'] - $order->products[$i]['qty'];
              tep_db_query("update " . TABLE_PRODUCTS_STOCK . " set products_stock_quantity = '" . $attributes_stock_left . "' where products_stock_attributes = '$products_stock_attributes' AND products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
              $actual_stock_bought = ($attributes_stock_left < 1) ? $attributes_stock_values['products_stock_quantity'] : $order->products[$i]['qty'];
            } else {
              $attributes_stock_left = 0 - $order->products[$i]['qty'];
              tep_db_query("insert into " . TABLE_PRODUCTS_STOCK . " (products_id, products_stock_attributes, products_stock_quantity) values ('" . tep_get_prid($order->products[$i]['id']) . "', '" . $products_stock_attributes . "', '" . $attributes_stock_left . "')");
              $actual_stock_bought = 0;
            }
          }
        }
//        $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//      }
//      if (tep_db_num_rows($stock_query) > 0) {
//        $stock_values = tep_db_fetch_array($stock_query);
// do not decrement quantities if products_attributes_filename exists
        if (!$download_selected) {
          $stock_left = $stock_values['products_quantity'] - $actual_stock_bought;
          tep_db_query("UPDATE " . TABLE_PRODUCTS . " 
                        SET products_quantity = products_quantity - '" . $actual_stock_bought . "' 
                        WHERE products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
// eof - qtpro		
		if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
          tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
        }
      }
    }

// Update products_ordered (for bestsellers list)
    tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");

    if (!isset($products_stock_attributes)) $products_stock_attributes=null;
    $sql_data_array = array('orders_id' => $insert_id, 
                            'products_id' => tep_get_prid($order->products[$i]['id']), 
                            'products_model' => $order->products[$i]['model'], 
                            'products_name' => $order->products[$i]['name'], 
                            'products_price' => $order->products[$i]['price'], 
                            'final_price' => $order->products[$i]['final_price'], 
                            'products_tax' => $order->products[$i]['tax'], 
                            'products_quantity' => $order->products[$i]['qty'],
// bof - qtpro
                            'products_stock_attributes' => $products_stock_attributes);
// eof - qtpro
	
	tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);
    $order_products_id = tep_db_insert_id();

// bof - credit class gift voucher
// CCGV 5.19 Fix for GV Queue with Paypal IPN
  $order_total_modules->update_credit_account($i,$insert_id);
// eof - credit class gift voucher

//print order receipt//
tep_session_register('last_order');
  $last_order = $insert_id;
  $oID = $last_order;

//------insert customer choosen option to order--------
    $attributes_exist = '0';
    $products_ordered_attributes = '';
    if (isset($order->products[$i]['attributes'])) {
      $attributes_exist = '1';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        if (DOWNLOAD_ENABLED == 'true') {
          $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
                               from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
                               left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                on pa.products_attributes_id=pad.products_attributes_id
                               where pa.products_id = '" . $order->products[$i]['id'] . "' 
                                and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
                                and pa.options_id = popt.products_options_id 
                                and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
                                and pa.options_values_id = poval.products_options_values_id 
                                and popt.language_id = '" . $languages_id . "' 
                                and poval.language_id = '" . $languages_id . "'";
          $attributes = tep_db_query($attributes_query);
        } else {
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
        }
        $attributes_values = tep_db_fetch_array($attributes);
// bof - seperate pricing per customer
  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
	   $attributes_group_query = tep_db_query("select pag.options_values_price, pag.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_ATTRIBUTES_GROUPS . " pag using(products_attributes_id) where pa.products_id = '" . tep_get_prid($order->products[$i]['id']) . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pag.customers_group_id = '" . (int)$_SESSION['sppc_customer_group_id'] . "'");
		 if ($attributes_group = tep_db_fetch_array($attributes_group_query)) {
			 $attributes_values['options_values_price'] = $attributes_group['options_values_price'];
			 $attributes_values['price_prefix'] = $attributes_group['price_prefix'];
		 }
  }
// eof - seperate pricing per customer

        $sql_data_array = array('orders_id' => $insert_id, 
                                'orders_products_id' => $order_products_id, 
                                'products_options' => $attributes_values['products_options_name'],
                                'products_options_values' => $attributes_values['products_options_values_name'], 
                                'options_values_price' => $attributes_values['options_values_price'], 
                                'price_prefix' => $attributes_values['price_prefix']);
        tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

        if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {

// bof - super download
/* original     $sql_data_array = array('orders_id' => $insert_id, 
                                  'orders_products_id' => $order_products_id, 
                                  'orders_products_filename' => $attributes_values['products_attributes_filename'], 
                                  'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
                                  'download_count' => $attributes_values['products_attributes_maxcount']);
          tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
*/
          if (DOWNLOADS_CONTROLLER_FILEGROUP_STATUS != 'Yes' || !strstr($attributes_values['products_attributes_filename'], 'Group_Files-')) {
            $sql_data_array = array('orders_id' => $insert_id, 
                                    'orders_products_id' => $order_products_id, 
                                    'orders_products_filename' => $attributes_values['products_attributes_filename'], 
                                    'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
                                    'download_count' => $attributes_values['products_attributes_maxcount']);
            tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
          } else {
            $filegroup_array = explode('Group_Files-', $attributes_values['products_attributes_filename']);
            $filegroup_id = $filegroup_array[1];
            $groupfiles_query = tep_db_query("select download_group_filename
                                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . "
                                              where download_group_id = '" . (int)$filegroup_id . "'");
            while ($groupfile_array = tep_db_fetch_array($groupfiles_query)) {
              $sql_data_array = array('orders_id' => $insert_id, 
                                      'orders_products_id' => $order_products_id, 
                                      'orders_products_filename' => $groupfile_array['download_group_filename'], 
                                      'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
                                      'download_count' => $attributes_values['products_attributes_maxcount']);
              tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
            }
          }
// eof - super download
		}
        $products_ordered_attributes .= "\n\t" . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'];
      }
    }
//------insert customer choosen option eof ----
    $total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
    $total_tax += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
    $total_cost += $total_products_price;

    $products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' (' . $order->products[$i]['model'] . ') = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";

// bof - get 1 free
    // If this product qualifies for free product(s) add the free products
    if (is_array ($free_product = $cart->get1free ($products_id))) {
      // Update products_ordered (for bestsellers list)
      //   Comment out the next line if you don't want free products in the bestseller list
      tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $free_product['quantity']) . " where products_id = '" . tep_get_prid($free_product['id']) . "'");

      $sql_data_array = array('orders_id' => $insert_id,
                              'products_id' => $free_product['id'],
                              'products_model' => $free_product['model'],
                              'products_name' => $free_product['name'],
                              'products_price' => 0,
                              'final_price' => 0,
                              'products_tax' => '',
                              'products_quantity' => $free_product['quantity']
                             );
      tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);

      $total_weight += ($free_product['quantity'] * $free_product['weight']);
    }
// eof - get 1 free
	}

// bof - credit class gift voucher
  $order_total_modules->apply_credit();
// eof - credit class gift voucher

// lets start with the email confirmation
// bof - ultimate html email
if (EMAIL_USE_HTML == 'true') {
	require(DIR_WS_MODULES . 'html_mail/'. HTML_EMAIL_LAYOUT .'/checkout_process.php');
	$email_order = $html_email;
}else{//Send text email
// eof - ultimate html email

  $email_order = STORE_NAME . "\n" . 
                 EMAIL_SEPARATOR . "\n" . 
                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n" .
                 EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n" .
                 EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";

// bof - purchase without account
  if ($order->customer['is_dummy_account']) {
    $email_order .= EMAIL_WARNING . "\n\n";
  }
// eof - purchase without account
  if ($order->info['comments']) {
    $email_order .= tep_db_output($order->info['comments']) . "\n\n";
  }
  	if (tep_session_is_registered('giftwrap_message') && tep_not_null($giftwrap_message)){
    	$email_order .= 'Gift Message: '.tep_db_output($giftwrap_message) . "\n".
    	EMAIL_SEPARATOR . "\n\n";
  	}
  $email_order .= EMAIL_TEXT_PRODUCTS . "\n" . 
                  EMAIL_SEPARATOR . "\n" . 
                  $products_ordered . 
                  EMAIL_SEPARATOR . "\n";

  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
  }

  if ($order->content_type != 'virtual') {
    $email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" . 
                    EMAIL_SEPARATOR . "\n" .
                    tep_address_label($customer_id, $sendto, 0, '', "\n") . "\n";
  }

  $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
                  EMAIL_SEPARATOR . "\n" .
                  tep_address_label($customer_id, $billto, 0, '', "\n") . "\n\n";
  if (is_object($$payment)) {
    $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" . 
                    EMAIL_SEPARATOR . "\n";
    $payment_class = $$payment;
    $email_order .= $order->info['payment_method'] . "\n\n";
    if ($payment_class->email_footer) { 
      $email_order .= $payment_class->email_footer . "\n\n";
    }
  }
// bof - ultimate html email
}
if(HTML_EMAIL_DEVELOPMENT_MODE === 'true'){
	//Save the contents of the generated html email to the harddrive in .htm file. This can be practical when developing a new layout.
	$TheFileName = 'Last_mail_from_checkout_process.php.htm';
	$TheFileHandle = fopen($TheFileName, 'w') or die("can't open error log file");
	fwrite($TheFileHandle, $email_order);
	fclose($TheFileHandle);
}
// eof - ultimate html email

  tep_mail($order->customer['firstname'] . ' ' . $order->customer['insertion'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

// send emails to other people
  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }

// include affiliate
  require(DIR_WS_INCLUDES . 'affiliate_checkout_process.php');

// load the after_process function from the payment modules
  $payment_modules->after_process();

// remove items from wishlist if customer purchased them
  $wishList->clear();

  $cart->reset(true);

// unregister session variables used during checkout
  tep_session_unregister('sendto');
  tep_session_unregister('billto');
  tep_session_unregister('shipping');
  tep_session_unregister('payment');
  tep_session_unregister('comments');
// bof - points and rewards
  if (tep_session_is_registered('customer_shopping_points')) tep_session_unregister('customer_shopping_points');
  if (tep_session_is_registered('customer_shopping_points_spending')) tep_session_unregister('customer_shopping_points_spending');
  if (tep_session_is_registered('customer_referral')) tep_session_unregister('customer_referral');
// eof - points and rewards
  tep_session_unregister('giftwrap_message');
// bof - credit class gift voucher
  if(tep_session_is_registered('credit_covers')) tep_session_unregister('credit_covers');
  $order_total_modules->clear_posts();
// eof - credit class gift voucher

  tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
