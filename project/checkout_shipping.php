<?php //$Id: /catalog/checkout_shipping.php (osC)

  require('includes/application_top.php');
  require('includes/classes/http_client.php');

//// store mode
// if we do not want to allow checkout, send them back to cart page
  if (STORE_MODE == 'Closed') {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('sendto')) {
    tep_session_register('sendto');
    $sendto = $customer_default_address_id;
  } else {
// verify the selected shipping address
    if ( (is_array($sendto) && empty($sendto)) || is_numeric($sendto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $sendto = $customer_default_address_id;
        if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');
      }
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
// bof - credit class gift voucher
//  if ($order->content_type == 'virtual') {
  if (($order->content_type == 'virtual') || ($order->content_type == 'virtual_weight') ) {
// eof - credit class gift voucher
    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $shipping = false;
    $sendto = false;
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load giftwrap module
	require(DIR_WS_CLASSES . 'gift.php');
	$giftwrap_modules = new gift;

	// process the selected giftwrap method
	if ( isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process') ) {
    	if (!tep_session_is_registered('giftwrap_info')) tep_session_register('giftwrap_info');
		if (tep_count_giftwrap_modules() > 0) { //at least 1 giftwrap module is loaded
    		//see if a giftwrap method was selected
      		if ( (isset($HTTP_POST_VARS['giftwrap'])) && (strpos($HTTP_POST_VARS['giftwrap'], '_')) ) {
        		$giftwrap_infoA = $HTTP_POST_VARS['giftwrap'];
        		list($module, $method) = explode('_', $giftwrap_infoA);
       			if (is_object($$module)) {
          			$quote1 = $giftwrap_modules->quote1($method, $module);
					if (isset($quote1['error'])) {
			       		tep_session_unregister('giftwrap');
			     	} else {
            			if ( (isset($quote1[0]['methods'][0]['title'])) && (isset($quote1[0]['methods'][0]['cost'])) ) {
              					$giftwrap_info = array('id' => $giftwrap_infoA,
                                	                   'title' => $quote1[0]['module'] . ' (' . $quote1[0]['methods'][0]['title'] . ')',
                                	                   'cost' => $quote1[0]['methods'][0]['cost']);
              					$giftwrap_info = array('id' => $giftwrap_infoA,
                                	                   'title' => $quote1[0]['module'] .  $quote1[0]['methods'][0]['title'],
                                	                   'cost' => $quote1[0]['methods'][0]['cost']);
            			}
          			}
          			
        		} else {
          			tep_session_unregister('giftwrap_info');
        		}
      		}else{
      			tep_session_unregister('giftwrap_info');
      		}
      		
      		// add gift message
      		// add gift message
    		if (tep_not_null($HTTP_POST_VARS['giftMessage']) && tep_session_is_registered('giftwrap_info') && isset($HTTP_POST_VARS['giftwrap_card'])) {
    			if (!tep_session_is_registered('giftwrap_message')) tep_session_register('giftwrap_message');
      			$giftwrap_message = tep_db_prepare_input($HTTP_POST_VARS['giftMessage']);
    		}else{
    		    tep_session_unregister('giftwrap_message');
    		}
    	} else { // no Giftwrap modules enabled/installed
      		$giftwrap_info = false;
    	}    
  	}
  	
	// get all available giftwrap quotes
  	$quotes1 = $giftwrap_modules->quote1();

// load all enabled shipping modules
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
    $pass = false;

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }

    $free_shipping = false;
    if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
      $free_shipping = true;

      include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }

// process the selected shipping method
  if ( isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process') ) {
    if (!tep_session_is_registered('comments')) tep_session_register('comments');
    if (tep_not_null($HTTP_POST_VARS['comments'])) {
      $comments = tep_db_prepare_input($HTTP_POST_VARS['comments']);
    }

    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');

    if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {
      if ( (isset($HTTP_POST_VARS['shipping'])) && (strpos($HTTP_POST_VARS['shipping'], '_')) ) {
        $shipping = $HTTP_POST_VARS['shipping'];

        list($module, $method) = explode('_', $shipping);
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              $shipping = array('id' => $shipping,
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']);

              tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
    } else {
      $shipping = false;
                
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }    
  }

// get all available shipping quotes
  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled
  if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ) $shipping = $shipping_modules->cheapest();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));

  $content = CONTENT_CHECKOUT_SHIPPING;
  $javascript = $content . '.js';
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
