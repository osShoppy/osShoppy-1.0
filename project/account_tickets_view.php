<?php //$Id: /catalog/account_tickets_view.php (1230)

  require('includes/application_top.php');
 if (!tep_session_is_registered('customer_id') && $HTTP_GET_VARS['login']=="yes") {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_TICKETS_VIEW);
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

  $ticket_statuses = array();
  $ticket_status_array = array();
  $ticket_status_query = tep_db_query("select ticket_status_id, ticket_status_name from " . TABLE_TICKET_STATUS . " where ticket_language_id = '" . $languages_id . "'");
  while ($ticket_status = tep_db_fetch_array($ticket_status_query)) {
    $ticket_statuses[] = array('id' => $ticket_status['ticket_status_id'],
                               'text' => $ticket_status['ticket_status_name']);
    $ticket_status_array[$ticket_status['ticket_status_id']] = $ticket_status['ticket_status_name'];
  }
  
  $enquiry = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);
  $status = tep_db_prepare_input($HTTP_POST_VARS['status']);
  $priority = tep_db_prepare_input($HTTP_POST_VARS['priority']);
  $department = tep_db_prepare_input($HTTP_POST_VARS['department']);
  if (isset($HTTP_POST_VARS['tlid'])) $tlid =  tep_db_prepare_input($HTTP_POST_VARS['tlid']);
  if (isset($HTTP_GET_VARS['tlid'])) $tlid =  tep_db_prepare_input($HTTP_GET_VARS['tlid']);
  if (strlen($tlid) < 10) unset($tlid);
// Form was submitted
  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send') && isset($tlid) ) {
  // Check Message length
    if (isset($enquiry) && strlen($enquiry) < TICKET_ENTRIES_MIN_LENGTH ) {
        $error = true;
        $HTTP_GET_VARS['error_message']=TICKET_WARNING_ENQUIRY_TOO_SHORT;
    }
    if ($error == false) {
      $ticket_id_query = tep_db_query("select ticket_id,  ticket_customers_name  from " . TABLE_TICKET_TICKET . " where ticket_link_id = '" . tep_db_input($tlid) . "'");
      $ticket_id = tep_db_fetch_array($ticket_id_query);
      if ($ticket_id['ticket_id']) {
        if (TICKET_ALLOW_CUSTOMER_TO_CHANGE_STATUS == 'false' && TICKET_CUSTOMER_REPLY_STATUS_ID > 0 ) $status = TICKET_CUSTOMER_REPLY_STATUS_ID;
        $sql_data_array = array('ticket_id' => $ticket_id['ticket_id'],
                          'ticket_status_id' => $status,
                          'ticket_priority_id' => $priority,
                          'ticket_department_id' => $department,
                          'ticket_date_modified' => 'now()',
                          'ticket_customer_notified' => '0',
                          'ticket_edited_by' => $ticket_id['ticket_customers_name'],
                          'ticket_comments' => $enquiry);
        tep_db_perform(TABLE_TICKET_STATUS_HISTORY, $sql_data_array);         
        $sql_data_array = array('ticket_status_id' => $status,
                          'ticket_priority_id' => $priority,
                          'ticket_department_id' => $department,
                          'ticket_date_last_modified' => 'now()',
                          'ticket_date_last_customer_modified' => 'now()');       
        tep_db_perform(TABLE_TICKET_TICKET, $sql_data_array, 'update', 'ticket_id = \'' . $ticket_id['ticket_id'] . '\'');        
        $HTTP_GET_VARS['info_message']=TICKET_MESSAGE_UPDATED;
        
      }
    }  
  }
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE));
  ?><head><title><?php echo TITLE; ?></title><?php echo TICKET_STYLESHEET; ?>
</head>
<?php
  $content = CONTENT_ACCOUNT_TICKETS_VIEW;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
