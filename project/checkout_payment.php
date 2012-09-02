<?php //$Id: /catalog/checkout_payment.php (osC)

  require('includes/application_top.php');

// bof - store mode
// if we do not want to allow checkout, send them back to cart page
  if (STORE_MODE == 'Closed') {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }
// eof - store mode

// bof - credit class gift voucher 1
  if (tep_session_is_registered('cot_gv')) tep_session_unregister('cot_gv');
// eof - credit class gift voucher

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// bof - credit class gift voucher 2
  if(tep_session_is_registered('credit_covers')) tep_session_unregister('credit_covers');
  if(tep_session_is_registered('cot_gv')) tep_session_unregister('cot_gv');
// eof - credit class gift voucher

// Stock Check
/*if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
        break;
      }
    }
  }
*/
// Stock Check
// bof - qtpro
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $cart->get_products();
    $any_out_of_stock = 0;
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
     if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
       $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity'], $products[$i]['attributes']);
     }
     else{
       $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
     }
     if ($stock_check) $any_out_of_stock = 1;
  	}
    if ($any_out_of_stock == 1) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
      break;
    }
 	}
// eof - qtpro

// bof - credit class gift voucher 3
// #################### THIS MOD IS OPTIONAL! ######################
// load the selected shipping module
 require(DIR_WS_CLASSES . 'shipping.php');
 $shipping_modules = new shipping($shipping);
// #################### THIS MOD WAS OPTIONAL! ######################
// eof - credit class gift voucher

// if no billing destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('billto')) {
    tep_session_register('billto');
    $billto = $customer_default_address_id;
  } else {
// verify the selected billing address
    if ( (is_array($billto) && empty($billto)) || is_numeric($billto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $billto = $customer_default_address_id;
        if (tep_session_is_registered('payment')) tep_session_unregister('payment');
      }
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// bof - credit class gift voucher 4
  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;
  $order_total_modules->clear_posts();
// eof - credit class gift voucher

  if (!tep_session_is_registered('comments')) tep_session_register('comments');

  if (isset($HTTP_POST_VARS['comments']) && tep_not_null($HTTP_POST_VARS['comments'])) {
    $comments = tep_db_prepare_input($HTTP_POST_VARS['comments']);
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// bof - credit class gift voucher 5
  $total_count = $cart->count_contents_virtual();
// eof - credit class gift voucher

// load all enabled payment modules
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

  $content = CONTENT_CHECKOUT_PAYMENT;
  $javascript = $content . '.js.php';

  include (bts_select('main', $content_template));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
