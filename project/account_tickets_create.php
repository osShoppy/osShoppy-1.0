<?php //$Id: /catalog/account_tickets_create.php (1230)

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id') && $HTTP_GET_VARS['login']=="yes") {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }


  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_TICKETS_CREATE);
  $ticket_departments = array();
  $ticket_department_array = array();
  $ticket_department_query = tep_db_query("select ticket_department_id, ticket_department_name from " . TABLE_TICKET_DEPARTMENT . " where ticket_language_id = '" . $languages_id . "'");
  while ($ticket_department = tep_db_fetch_array($ticket_department_query)) {
    $ticket_departments[] = array('id' => $ticket_department['ticket_department_id'],
                               'text' => $ticket_department['ticket_department_name']);
    $ticket_department_array[$ticket_department['ticket_department_id']] = $ticket_department['ticket_department_name'];
  }
  $ticket_prioritys = array();
  $ticket_priority_array = array();
  $ticket_priority_query = tep_db_query("select ticket_priority_id, ticket_priority_name from " . TABLE_TICKET_PRIORITY . " where ticket_language_id = '" . $languages_id . "'");
  while ($ticket_priority = tep_db_fetch_array($ticket_priority_query)) {
    $ticket_prioritys[] = array('id' => $ticket_priority['ticket_priority_id'],
                               'text' => $ticket_priority['ticket_priority_name']);
    $ticket_priority_array[$ticket_priority['ticket_priority_id']] = $ticket_priority['ticket_priority_name'];
  }
 
  $email = tep_db_prepare_input(trim($HTTP_POST_VARS['email']));
  $name = tep_db_prepare_input($HTTP_POST_VARS['name']);
  $subject = tep_db_prepare_input($HTTP_POST_VARS['subject']);
  $enquiry = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);
  $department = tep_db_prepare_input($HTTP_POST_VARS['department']);
  $priority = tep_db_prepare_input($HTTP_POST_VARS['priority']);
  $ticket_customers_orders_id = tep_db_prepare_input($HTTP_POST_VARS['ticket_customers_orders_id']);
  
  
// Customer is logged in:  
  if (tep_session_is_registered('customer_id')) {
    $customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
    $customer = tep_db_fetch_array($customer_query);
  }

// Form was submitted
  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
  // Check Name length
    if (!tep_session_is_registered('customer_id') && isset($name) && strlen($name) < TICKET_ENTRIES_MIN_LENGTH ) {
        $error = true;
        $error_name = true;
      }
    
 // Check Subject length
    if (isset($subject) && strlen($subject) < TICKET_ENTRIES_MIN_LENGTH ) {
        $error = true;
        $error_subject = true;
      }
  // Check Message length
    if (isset($enquiry) && strlen($enquiry) < TICKET_ENTRIES_MIN_LENGTH ) {
        $error = true;
        $error_enquiry = true;
      }
  // Check Email for non logged in Customers
    if (!tep_session_is_registered('customer_id') && !tep_validate_email($email)) {
      $error = true;
      $error_email = true;
    } 
    
    if ($error == false) {
      $ticket_customers_id = '';
    // Get the customers_id
      if (tep_session_is_registered('customer_id')) {
        $ticket_customers_id = $customer_id;
      } else {
        $customerid_query = tep_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_email_address='" . tep_db_input($email) . "'");
        if ($customerid = tep_db_fetch_array($customerid_query)) $ticket_customers_id = $customerid['customers_id'] ;
      }
      // generate LInkID
      $time = mktime();
      $ticket_link_id = '';
      for ($x=3;$x<10;$x++) {
        $ticket_link_id .= substr($time,$x,1) . tep_create_random_value(1, $type = 'chars');
      }
      
      $sql_data_array = array('ticket_link_id' => $ticket_link_id,
                          'ticket_customers_id' => $ticket_customers_id,
                          'ticket_customers_orders_id' => $ticket_customers_orders_id,
                          'ticket_customers_email' => $email,
                          'ticket_customers_name' => $name,
                          'ticket_subject' => $subject,
                          'ticket_status_id' => TICKET_DEFAULT_STATUS_ID,
                          'ticket_department_id' => $department,
                          'ticket_priority_id' => $priority,
                          'ticket_login_required' => TICKET_CUSTOMER_LOGIN_REQUIREMENT_DEFAULT,
                          'ticket_date_last_modified' => 'now()',
                          'ticket_date_last_customer_modified' => 'now()',
                          'ticket_date_created' => 'now()');
      tep_db_perform(TABLE_TICKET_TICKET, $sql_data_array);
      $insert_id = tep_db_insert_id();
      
      $sql_data_array = array('ticket_id' => $insert_id,
                          'ticket_status_id' => TICKET_DEFAULT_STATUS_ID,
                          'ticket_priority_id' => $priority,
                          'ticket_department_id' => $department,
                          'ticket_date_modified' => 'now()',
                          'ticket_customer_notified' => '1',
                          'ticket_edited_by' => $name,
                          'ticket_comments' => $enquiry);
      tep_db_perform(TABLE_TICKET_STATUS_HISTORY, $sql_data_array); 
    // Email  Customer doesn't get the Message cause he should use the web
      $ticket_email_subject = TICKET_EMAIL_SUBJECT . $subject;
      $ticket_email_message = TICKET_EMAIL_MESAGE_HEADER . "\n\n" . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'tlid=' . $ticket_link_id, 'NONSSL',false,false) . "\n\n" . TICKET_EMAIL_TICKET_NR . " " . $ticket_link_id . "\n" . TICKET_EMAIL_MESAGE_FOOTER;
      tep_mail($name, $email, $ticket_email_subject, nl2br($ticket_email_message), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    // send emails to other people
      if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
       $ticket_email_message = TICKET_EMAIL_MESAGE_HEADER . "\n\n" . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'tlid=' . $ticket_link_id) . "\n\n" . $enquiry . TICKET_EMAIL_MESAGE_FOOTER . "\n\n" . $enquiry;
       tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, $ticket_email_subject,nl2br($ticket_email_message), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      }
      tep_redirect(tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE, 'action=success&tlid=' . $ticket_link_id ));
    }
  }


  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE));

  ?><head><title><?php echo TITLE; ?></title></head>
<?php
  $content = CONTENT_ACCOUNT_TICKETS_CREATE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
