    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_account_tickets.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td rowspan=4 class="main"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE, '0', '0', 'align="left"') ?></td>
            <td class="main"><?php echo TEXT_SUCCESS; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_YOUR_TICKET_ID . ' ' . $HTTP_GET_VARS['tlid']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_CHECK_YOUR_TICKET . '<br><a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'tlid=' . $HTTP_GET_VARS['tlid'], 'NONSSL',false,false) . '">' . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'tlid=' . $HTTP_GET_VARS['tlid'], 'NONSSL',false,false) . '</a>'; ?></td>
          </tr>
          <tr>
            <td valign ="bottom" align="right"><br><a href="<?php echo tep_href_link(FILENAME_DEFAULT); ?>"><?php echo tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE); ?></a></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><?php echo tep_draw_form('contact_us', tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE, 'action=send')); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td width="150" class="main"><?php echo ENTRY_NAME; ?>&nbsp;</td>
            <td class="main">
<?php
    if (tep_session_is_registered('customer_id')) {
      echo tep_draw_hidden_field('name',$customer['customers_firstname'] . ' ' . $customer['customers_lastname']) . $customer['customers_firstname'] . ' ' . $customer['customers_lastname']; 
    } else {
      echo tep_draw_input_field('name', ($error ? $name : $first_name)); if ($error_name) echo ENTRY_ERROR_NO_NAME;
    }
?>
            </td>
            <td class="main" align="left" width="100%" valign="top" rowspan="2">
<?php
   if (!tep_session_is_registered('customer_id')) {
     echo  sprintf(TEXT_LOGIN, tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE, 'login=yes', 'SSL'), tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL')); 
   }
?>
            &nbsp;</td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_EMAIL; ?>&nbsp;</td>
            <td class="main">
<?php
    if (tep_session_is_registered('customer_id')) {
      echo tep_draw_hidden_field('email',$customer['customers_email_address']) . $customer['customers_email_address']; 
    } else {
      echo tep_draw_input_field('email', ($error ? $email : $email_address)); if ($error_email) echo ENTRY_EMAIL_ADDRESS_CHECK_ERROR; 
    }
?>
            </td>
          </tr>
<?php
    if (TICKET_SHOW_CUSTOMERS_SUBJECT == 'true') {   
?>
          <tr>
            <td class="main"><?php echo ENTRY_SUBJECT; ?>&nbsp;</td>
            <td class="main"><?php  echo tep_draw_input_field('subject', ($error ? $subject : $subject)); if ($error_subject) echo ENTRY_ERROR_NO_SUBJECT; ?></td>
            <td>&nbsp;</td>
          </tr>
<?php
    }
    if (TICKET_SHOW_CUSTOMERS_ORDER_IDS == 'true' && tep_session_is_registered('customer_id')) {     
      $customers_orders_query = tep_db_query("select orders_id, date_purchased from " . TABLE_ORDERS . " where customers_id = '" . tep_db_input($customer_id) . "'");
      if (isset($HTTP_GET_VARS['ticket_order_id'])) $ticket_preselected_order_id = $HTTP_GET_VARS['ticket_order_id'];
      $orders_array[] = array('id' => '', 'text' => ' -- ' );
      while ($customers_orders = tep_db_fetch_array($customers_orders_query)) {
        $orders_array[] = array('id' => $customers_orders['orders_id'], 'text' => $customers_orders['orders_id'] . "  (" . tep_date_short($customers_orders['date_purchased']) . ")" );
      }

?>
          <tr>
            <td class="main"><?php echo ENTRY_ORDER; ?>&nbsp;</td>
            <td class="main"><?php echo  tep_draw_pull_down_menu('ticket_customers_orders_id', $orders_array,$ticket_preselected_order_id); ?></td>
            <td>&nbsp;</td>
          </tr>

<?php
    }
    if (TICKET_CATALOG_USE_DEPARTMENT == 'true') {     
?>
          <tr>
            <td class="main"><?php echo ENTRY_DEPARTMENT; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_pull_down_menu('department', $ticket_departments, ($department ? $department : TICKET_DEFAULT_DEPARTMENT_ID) ); ?></td>
            <td>&nbsp;</td>
          </tr>
<?php
    } else {
      echo tep_draw_hidden_field('department', TICKET_DEFAULT_DEPARTMENT_ID);
    }
    if (TICKET_CATALOG_USE_PRIORITY == 'true') {   
?>
          <tr>
            <td class="main"><?php echo ENTRY_PRIORITY; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_pull_down_menu('priority', $ticket_prioritys, ($priority ? $priority : TICKET_DEFAULT_PRIORITY_ID) ); ?></td>
            <td>&nbsp;</td>
          </tr>
<?php
    } else {
      echo tep_draw_hidden_field('priority', TICKET_DEFAULT_PRIORITY_ID);
    }
?>
          <tr>
            <td colspan=3 class="main"><?php echo ENTRY_ENQUIRY; ?></td>
          </tr>
          <tr>
            <td colspan=3><?php echo tep_draw_textarea_field('enquiry', 'soft', 50, 15, $enquiry); ?><br><?php if ($error_enquiry) echo ENTRY_ERROR_NO_ENQUIRY; ?></td>
          </tr>
          <tr>
            <td colspan=3 class="main" align="right"><br><?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE); ?></td>
          </tr>
        </table></form></td>
      </tr>
<?php
  }
?>
    </table>
    