<?php //$Id: /catalog/confirmattion.php (osC)

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($HTTP_POST_VARS['payment'])) $payment = $HTTP_POST_VARS['payment'];

  if (!tep_session_is_registered('comments')) tep_session_register('comments');
  if (tep_not_null($HTTP_POST_VARS['comments'])) {
    $comments = tep_db_prepare_input($HTTP_POST_VARS['comments']);
  }

// gratuity module
  if (!tep_session_is_registered('gratuity')) tep_session_register('gratuity');
  if (tep_not_null($HTTP_POST_VARS['gratuity'])) {
    $gratuity = tep_db_prepare_input($HTTP_POST_VARS['gratuity']);
  }

// load the selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
// bof - credit class gift voucher
  if ($credit_covers) $payment='credit_covers'; 
  require(DIR_WS_CLASSES . 'order_total.php');
// eof - credit class gift voucher
  $payment_modules = new payment($payment);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $payment_modules->update_status();

// bof - credit class gift voucher
/* original
  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  } */
  $order_total_modules = new order_total;
  $order_total_modules->collect_posts();
  $order_total_modules->pre_confirmation_check();
// >>> FOR ERROR gv_redeem_code NULL 
  if (isset($_POST['gv_redeem_code']) && ($_POST['gv_redeem_code'] == null)) {tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));} 
// eof - credit class gift voucher

// bof - points and rewards
  if ((USE_POINTS_SYSTEM == 'true') && (USE_REDEEM_SYSTEM == 'true')) {
	  if (isset($_POST['customer_shopping_points_spending']) && is_numeric($_POST['customer_shopping_points_spending']) && ($_POST['customer_shopping_points_spending'] > 0)) {
		  $customer_shopping_points_spending = false;
		  if (tep_calc_shopping_pvalue($_POST['customer_shopping_points_spending']) < $order->info['total'] && !is_object($$payment)) {
			  $customer_shopping_points_spending = false;
			  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REDEEM_SYSTEM_ERROR_POINTS_NOT), 'SSL'));
		  } else {
			  $customer_shopping_points_spending = $_POST['customer_shopping_points_spending'];
			  if (!tep_session_is_registered('customer_shopping_points_spending')) tep_session_register('customer_shopping_points_spending');
		  }
	  }
	  
	  if (tep_not_null(USE_REFERRAL_SYSTEM)) {
		  if (isset($_POST['customer_referred']) && tep_not_null($_POST['customer_referred'])) {
			  $customer_referral = false;
			  $check_mail = trim($_POST['customer_referred']);
			  if (tep_validate_email($check_mail) == false) {
				  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REFERRAL_ERROR_NOT_VALID), 'SSL'));
			  } else {
				  $valid_referral_query = tep_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . $check_mail . "' limit 1");
				  $valid_referral = tep_db_fetch_array($valid_referral_query);
				  if (!tep_db_num_rows($valid_referral_query)) {
					  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REFERRAL_ERROR_NOT_FOUND), 'SSL'));
				  }
				  
				  if ($check_mail == $order->customer['email_address']) {
					  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REFERRAL_ERROR_SELF), 'SSL'));
				  } else {
					  $customer_referral = $valid_referral['customers_id'];
					  if (!tep_session_is_registered('customer_referral')) tep_session_register('customer_referral');
				  }
			  }
		  }
	  }
  }
// bof - points and rewards

// beof - credit class gift voucher 
// beof - points and rewards added;  && (!$customer_shopping_points_spending)
//  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    if ( (is_array($payment_modules->modules)) && (sizeof($payment_modules->modules) > 1) && (!is_object($$payment)) && (!$credit_covers) && (!$customer_shopping_points_spending) ) {

    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }

  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

// bof - credit class gift voucher
//  require(DIR_WS_CLASSES . 'order_total.php');
//  $order_total_modules = new order_total;
// eof - credit class gift voucher

  $order_total_modules->process();

// load the selected giftwrap module  
  //require(DIR_WS_CLASSES . "gift.php");
  //$giftwrap_modules = new gift($giftwrap);

// stock check
/* original ->
$any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
*/
// stock check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
// qt pro
    $check_stock='';
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (isset($order->products[$i]['attributes']) && is_array($order->products[$i]['attributes'])) {
        $attributes=array();
        foreach ($order->products[$i]['attributes'] as $attribute) {
          $attributes[$attribute['option_id']]=$attribute['value_id'];
        }
        $check_stock[$i] = tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'], $attributes);
      } else {
        $check_stock[$i] = tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
      }
      if ($check_stock[$i]) {
        $any_out_of_stock = true;
      }
// qt pro_eof
    }
	// out of stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

    // return customer to checkout_payment for agreement terms and conditions
	if (tep_db_prepare_input($HTTP_POST_VARS['TermsAgree']) != 'true' and MATC_AT_CHECKOUT != 'false') {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'matcerror=true', 'SSL'));
    }

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2);

  $content = CONTENT_CHECKOUT_CONFIRMATION;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
