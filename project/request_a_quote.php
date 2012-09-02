<?php //$Id: /catalog/request-a-quote.php (6675)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_REQUEST_A_QUOTE);
  require(DIR_WS_FUNCTIONS . FILENAME_QUOTES);
  
  $message = '';
  
  if (isset($_POST['action']) && $_POST['action'] == 'process_quote')
  {
     $name = tep_db_prepare_input($_POST['name']);
     $email_address = tep_db_prepare_input($_POST['email']);
     $message = $_POST['message'];
      
     $error = false;      
     if (! tep_not_null($name))
     {
       $error = true;
       $messageStack->add('request_quote', ENTRY_NAME_CHECK_ERROR);
     }
     
     if (!tep_validate_email($email_address)) 
     {
       $error = true;
       $messageStack->add('request_quote', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
     }     

     if (! tep_not_null($message))
     {
       $error = true;
       $messageStack->add('request_quote', ENTRY_MESSAGE_CHECK_ERROR);
     }

     if (! $error)
     {     
       $quote_id = tep_db_insert_id();
       tep_db_query("insert into " . TABLE_QUOTES . " (quote_id, quote_email_address, customers_name, quote_request, date_submitted) values ('" . (int)$quote_id . "', '" . $email_address . "', '" . $name . "', '" . $message . "', now())");
      
       $body = sprintf(TEXT_QUOTE_EMAIL_BODY, $name, "\n\n", stripslashes($message));
       tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, TEXT_QUOTE_EMAIL_SUBJECT, $body, $name, $email_address);
       tep_redirect(tep_href_link(FILENAME_REQUEST_A_QUOTE, 'action=success'));
     }
  }
  
  $custArray = array();
  if (tep_session_is_registered('customer_id'))
  {
    $customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "' LIMIT 1");
    $customer = tep_db_fetch_array($customer_query);
    $custArray['name'] = $customer['customers_firstname'] . ' ' . $customer['customers_lastname'];
    $custArray['email'] = $customer['customers_email_address'];
  }    
 
 
  // create javascript script code to pass cart contents
  $inCartArray = $cart->get_products();  
                
  $script = '<script type="text/javascript"> '. "\nfunction LoadCartContents(){";
  $script .= "\n" .' var ckbox_status = document.getElementById("loadcart").checked;'; 
  $script .= "\n" .' if (ckbox_status == true) {' . "\n" . ' var lcValues = ';

  if (count($inCartArray) > 0)
  {
    for ($i = 0; $i < count($inCartArray); ++$i)
    {
       $products_query = tep_db_query("select count(*) as quote from " . TABLE_PRODUCTS . " where products_id = '" . (int)$inCartArray[$i]['id'] . "' and quotes_id = 1 LIMIT 1");
       $products = tep_db_fetch_array($products_query);
       if ($products['quote'])  //skip quotes that might be in the cart
         continue;

       $script .= '"\n\n" + ';
       $script .= '"Product: " + "' . $inCartArray[$i]['name'] . '" + "' .  ' - ID: " + "' . $inCartArray[$i]['id'] . '" + " ( ' . GetAttributeText($inCartArray[$i]['attributes'], $languages_id) . ' )"' ;
       $script .= ' + " - Price: " + "' .  $inCartArray[$i]['final_price'] . '"' ;

       if ($i < count($inCartArray) - 1)
        $script .= ' + ';
    }
  }
  else
    $script .= '""';

  $script .= ';' . "\n" . 'var prev_contents = document.getElementById("44").value;';
  
  $script .= ';' . "\n" . ' document.getElementById("44").value = (prev_contents + lcValues);' . "\n" . '}' . "\n" . ' else document.getElementById("44").value = ""; }';
  $script .= "\n" . '</script>' . "\n";
  
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_REQUEST_A_QUOTE));
  ?><head>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  <title><?php echo TITLE; ?></title>
  </head><?php

  $content = CONTENT_REQUEST_A_QUOTE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
