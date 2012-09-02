<?php //$Id: /catalog/return_product.php (1136)

  require('includes/application_top.php');

    if (!tep_session_is_registered('customer_id')) {
     $navigation->set_snapshot();
     tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_CLASSES . 'order.php');
  //check if order ID belongs to current customer!
  $order_and_customer_query = tep_db_query("SELECT * FROM " . TABLE_ORDERS . " where  customers_id = '".$customer_id."' and orders_id = '".$HTTP_GET_VARS['order_id']."' OR orders_id = '".$HTTP_GET_VARS['oID']."'");
   if (tep_db_num_rows($order_and_customer_query)==0) {
        tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
   }
   //eof check
  $order = new order($HTTP_GET_VARS['order_id']);
 // check to find out what thedefault reason for returning a product is
 $default_priority_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_RETURN_REASON'");
 $default_priority = tep_db_fetch_array($default_priority_query);
 $default_refund_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_REFUND_METHOD'");
 $default_refund = tep_db_fetch_array($default_refund_query);


  if (!$HTTP_GET_VARS['action']){
      $HTTP_GET_VARS['action'] = 'new';
  }

  if ($HTTP_GET_VARS['action']) {
    switch ($HTTP_GET_VARS['action']) {
      case 'insert':
      case 'update':
         // carry out a query on all the existing orders tables, to get the required information
         $rma_create = tep_create_rma_value(11);
         $returns_status_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_RETURN_STATUS_ID'");
         $default_return = tep_db_fetch_array($returns_status_query);
         $order_returns_query = tep_db_query("SELECT * FROM " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op where o.orders_id = op.orders_id and o.orders_id = '" . $HTTP_GET_VARS['oID'] . " ' and op.products_id = '" . $HTTP_GET_VARS['products_id'] . "'");
         $orders_return = tep_db_fetch_array($order_returns_query);

         if ($HTTP_POST_VARS['returns_quantity'] > $orders_return['products_quantity']) {
             tep_redirect(tep_href_link(FILENAME_RETURN, 'error=yes&order_id=' . $HTTP_GET_VARS['oID'] . '&products_id=' . $HTTP_GET_VARS['products_id']));
         }

         $customers_id = $orders_return['customers_id'];
         $rma_value = tep_db_prepare_input($rma_create);
         $order_id = $HTTP_GET_VARS['oID'];
         $customers_name = $orders_return['customers_name'];
         $customers_acct = $orders_return['customers_acct'];
         $customers_company = $orders_return['customers_company'];
         $customers_street_address = $orders_return['customers_street_address'];
         $customers_suburb = $orders_return['customers_suburb'];
         $customers_city = $orders_return['customers_city'];
         $customers_postcode = $orders_return['customers_postcode'];
         $customers_state = $orders_return['customers_state'];
         $customers_country = $orders_return['customers_country'];
         $customers_telephone = $orders_return['customers_telephone'];
         $customers_fax = $orders_return['customers_fax'];
         $customers_email = $HTTP_POST_VARS['support_user_email'];
         $customers_address_format_id = $orders_return['customers_address_format_id'];
         $delivery_name = $orders_return['delivery_name'];
         $delivery_company = $orders_return['delivery_company'];
         $delivery_street_address = $orders_return['delivery_street_address'];
         $delivery_suburb = $orders_return['delivery_suburb'];
         $delivery_city = $orders_return['delivery_city'];
         $delivery_postcode = $orders_return['delivery_postcode'];
         $delivery_state = $orders_return['delivery_state'];
         $delivery_country = $orders_return['delivery_country'];
         $delivery_address_format_id = $orders_return['delivery_address_format_id'];
         $billing_name = $orders_return['billing_name'];
         $billing_acct = $orders_return['billing_acct'];
         $billing_company = $orders_return['billing_company'];
         $billing_street_address = $orders_return['billing_street_address'];
         $billing_suburb = $orders_return['billing_suburb'];
         $billing_city = $orders_return['billing_city'];
         $billing_postcode = $orders_return['billing_postcode'];
         $billing_state = $orders_return['billing_state'];
         $billing_country = $orders_return['billing_country'];
         $billing_address_format_id = $orders_return['billing_address_format_id'];
         $comments = tep_db_prepare_input($HTTP_POST_VARS['support_text']);
         $returns_status =  $default_return['configuration_value'];
         $returns_reason = tep_db_prepare_input($HTTP_POST_VARS['support_priority']);
         $products_model = $orders_return['products_model'];
         $products_name = $orders_return['products_name'];
         $products_price = $orders_return['products_price'];
         $products_tax = $orders_return['products_tax'];
         $discount_made = $orders_return['products_discount_made'];

         // work out price with tax
         $price_inc_tax = $products_price + tep_calculate_tax($products_price, $products_tax);
         $price_inc_quantity = $price_inc_tax * $HTTP_POST_VARS['returns_quantity'];
         $final_price =  $price_inc_quantity;
         $products_quantity = $HTTP_POST_VARS['returns_quantity'];// $orders_return['products_quantity'];
         $serial_number = $orders_return['products_serial_number'];
         $currency = $orders_return['currency'];
         $currency_value = $orders_return['currency_value'];
         $refund_method = $HTTP_POST_VARS['refund_method'];
         $support_error = false;
 // error checking goes in here
 // not present at moment
   $support_error = false;

   if (!$support_error) {
          $sql_data_array = array('customers_id' => $customers_id,
                                  'rma_value' => $rma_value,
                                  'order_id' => $order_id,
                                  'customers_name' => $customers_name,
                                  'customers_acct' => $customers_acct,
                                  'customers_company' => $customers_company,
                                  'customers_street_address' => $customers_street_address,
                                  'customers_suburb' => $customers_suburb,
                                  'customers_city' => $customers_city,
                                  'customers_postcode' => $customers_postcode,
                                  'customers_state' => $customers_state,
                                  'customers_country' => $customers_country,
                                  'customers_telephone' => $customers_telephone,
                                  'customers_fax' => $customers_fax,
                                  'customers_email_address' => $customers_email,
                                  'customers_address_format_id' => $customers_address_format_id,
                                  'delivery_name' => $delivery_name,
                                  'delivery_company' => $delivery_company,
                                  'delivery_street_address' => $delivery_street_address,
                                  'delivery_suburb' => $delivery_suburb,
                                  'delivery_city' => $delivery_city,
                                  'delivery_postcode' => $delivery_postcode,
                                  'delivery_state' => $delivery_state,
                                  'delivery_country' => $delivery_country,
                                  'delivery_address_format_id' => $delivery_address_format_id,
                                  'billing_name' => $billing_name,
                                  'billing_acct' => $billing_acct,
                                  'billing_company' => $billing_company,
                                  'billing_street_address' => $billing_street_address,
                                  'billing_suburb' => $billing_suburb,
                                  'billing_city' => $billing_city,
                                  'billing_postcode' => $billing_postcode,
                                  'billing_state' => $billing_state,
                                  'billing_country' => $billing_country,
                                  'billing_address_format_id' => $billing_address_format_id,
                                  'comments' => $comments,
                                  'returns_status' => $returns_status,
                                  'returns_reason' => $returns_reason,
                                  'currency' => $currency,
                                  'currency_value' =>$currency_value,
                                 );
          if ($HTTP_GET_VARS['action'] == 'insert') {
            $insert_sql_data = array('date_purchased' => 'now()',
                                     );

            // returns information table updated,
            tep_db_perform(TABLE_RETURNS, $sql_data_array);
            $ticket_id = tep_db_insert_id();

           // tep_db_query("insert into " . TABLE_RETURN_PAYMENTS . " values ('', '" . $ticket_id . "', '', '', '', '', '0.00')");

            tep_db_perform(TABLE_RETURNS, $insert_sql_data, 'update', 'returns_id = \'' . $ticket_id . '\'');
              // now update returns products, and history tables
             $data_insert_sql = array('returns_id' => $ticket_id,
                                      'order_id' => $order_id,
                                      'products_id' => $HTTP_GET_VARS['products_id'],
                                      'products_model' =>$products_model,
                                      'products_name' => $products_name,
                                      'products_price' => $products_price,
                                      'products_discount_made' => $discount_made,
                                      'final_price' => $final_price,
                                      'products_tax' => $products_tax,
                                      'products_quantity' => $products_quantity,
                                      'products_serial_number' => $serial_number,
                                      );
          $returns_payment_sql = array('returns_id' => $ticket_id,
                                       'refund_payment_name' => $refund_method,
                                       'refund_payment_value' => $final_price,
                                       );

            tep_db_perform(TABLE_RETURN_PAYMENTS, $returns_payment_sql);
            tep_db_perform(TABLE_RETURNS_PRODUCTS_DATA, $data_insert_sql);
            tep_db_query("UPDATE " . TABLE_ORDERS_PRODUCTS . " set products_returned = 1 where orders_id = '" . $HTTP_GET_VARS['oID'] . "' and products_id = '" . $HTTP_GET_VARS['products_id'] . "'");

          }

		  // Add returns status to returns status history table added 12-22-05
		  tep_db_query("insert into " . TABLE_RETURNS_STATUS_HISTORY . " (returns_id , returns_status, date_added, customer_notified, comments) values ('" . $ticket_id . "','" .   $returns_status . "', now(), 1,'" . tep_db_input($comments) . "')");

          // now send email to customer

           require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_RETURN_EMAILS);
           $email_text = EMAIL_TEXT_TICKET_OPEN;
           $email_text .= EMAIL_THANKS_OPEN . EMAIL_TEXT_OPEN . EMAIL_CONTACT_OPEN . EMAIL_WARNING_OPEN;
           tep_mail($support_user_name, $support_user_email, EMAIL_SUBJECT_OPEN . ' #' . $rma_value, nl2br($email_text), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          // send email to alternate address
           if (strlen($support_alternate_email) > 0) {
                $email_text = EMAIL_TEXT_TICKET_OPEN;
                $email_text .= EMAIL_THANKS_OPEN . EMAIL_TEXT_OPEN . EMAIL_CONTACT_OPEN . EMAIL_WARNING_OPEN;
                tep_mail($support_user_name, $support_alternate_email, EMAIL_SUBJECT_OPEN . ' #' . $rma_value, nl2br($email_text), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
             }

          // now send an email to the default administrator to let them know of new ticket
           //  $default_admin_email = tep_db_query("SELECT admin_id FROM " . TABLE_SUPPORT_TICKETS . " where ticket_id = '" . $HTTP_GET_VARS['ticket_id'] . "' and customers_id = '" . $customer_id . "'");
           //  $default_email = tep_db_fetch_array($default_admin_email);
          //   $admin_email_query = tep_db_query("SELECT support_assign_email, support_assign_name FROM " . TABLE_SUPPORT_ASSIGN . " where support_assign_id = '" . $default_email['admin_id'] . "' and language_id = '" . $languages_id . "'");
          //   $admin_email = tep_db_fetch_array($admin_email_query);
             $email_text_admin = EMAIL_TEXT_TICKET_ADMIN;
             $email_text_admin .= EMAIL_THANKS_ADMIN . EMAIL_TEXT_ADMIN . EMAIL_CONTACT_ADMIN . EMAIL_WARNING_ADMIN;
             tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS , EMAIL_SUBJECT_ADMIN .' #' . $rma_value, nl2br($email_text), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

          // redirect to confirmation
            tep_redirect(tep_href_link(FILENAME_RETURN . '?action=sent&rma_value='. $rma_value . '&return_id=' . $ticket_id . '&order_id=' . $order_id));
        } else {
          $HTTP_GET_VARS['action'] = 'new';
        }
        break;
       case 'default':
       tep_redirect(tep_href_link(FILENAME_DEFAULT));
       break;
    }
  }
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_RETURN);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_RETURN, '', 'NONSSL'));
?>
<head>
<title><?php echo TITLE; ?></title>
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">

<script language="javascript"><!--
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=280,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
<script>
 var submitDone = false;

 function submitForm(myForm, button) {

      if (!submitDone) {
         submitDone = true;
         button.value = 'Please Wait';
         button.disabled = true;
         myForm.submit();
      }
      else {
        alert ("Already submitted, please wait!");
      }
   return true;
 }
</script>
</head>
<?php
  $content = CONTENT_RETURN_PRODUCT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
