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
// Show spezific Ticket  
  if (!isset($tlid)) {
?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <?php echo tep_draw_form('ticket_view', tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'action=send'), 'get') . "\n"; ?>
          <tr>
            <td class="main" align="left"><?php echo TEXT_VIEW_TICKET_NR; ?>&nbsp;</td>
            <td class="main" align="left"><?php echo tep_draw_input_field('tlid'); ?></td>
            <td><?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE);  ?></td>
          </tr></form>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
    if (tep_session_is_registered('customer_id')) {
      $customers_tickets_raw = "select * from " . TABLE_TICKET_TICKET . " where ticket_customers_id = '" . tep_db_prepare_input($customer_id) . "' order by ticket_date_last_modified desc";
      $customers_tickets_split = new splitPageResults($customers_tickets_raw, MAX_DISPLAY_SEARCH_RESULTS);
      if ($customers_tickets_split->number_of_rows > 0 ) {
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td class="infoBoxHeading" align="left"><?php echo TABLE_HEADING_NR; ?></td>
<?php 
      if (TICKET_SHOW_CUSTOMERS_SUBJECT == 'true') { echo '            <td class="infoBoxHeading" align="left"><' . TABLE_HEADING_SUBJECT . '></td>'; }
      if (TICKET_CATALOG_USE_STATUS == 'true') {     echo '            <td class="infoBoxHeading">' . TABLE_HEADING_STATUS . '</td>'; }
      if (TICKET_CATALOG_USE_DEPARTMENT == 'true') { echo '            <td class="infoBoxHeading">' . TABLE_HEADING_DEPARTMENT . '</td>'; }
      if (TICKET_CATALOG_USE_PRIORITY == 'true') {   echo '            <td class="infoBoxHeading">' . TABLE_HEADING_PRIORITY . '</td>'; }
?>
           <td class="infoBoxHeading" align="right"><?php echo TABLE_HEADING_CREATED; ?></td>
            <td class="infoBoxHeading" align="right"><?php echo TABLE_HEADING_LAST_MODIFIED; ?></td>
          </tr>              
<?php
        $customers_tickets_query = tep_db_query ($customers_tickets_split->sql_query);
        $number_of_tickets = 0;
        while ($customers_tickets = tep_db_fetch_array($customers_tickets_query)) {
          $number_of_tickets++;
          if (($number_of_tickets / 2) == floor($number_of_tickets / 2)) {
            echo '         <tr class="productListing-even">' . "\n";
          } else {
           echo '          <tr class="productListing-odd">' . "\n";
          }
?>
            <td class="smallText" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'tlid=' . $customers_tickets['ticket_link_id']) . '">' . $customers_tickets['ticket_link_id'] . '</a>'; ?></td>
<?php
          if (TICKET_SHOW_CUSTOMERS_SUBJECT == 'true') { echo '            <td class="smallText" align="left"><a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'tlid=' . $customers_tickets['ticket_link_id']) . '">' . $customers_tickets['ticket_subject'] . '</a></td>'; }
          if (TICKET_CATALOG_USE_STATUS == 'true') {     echo '            <td class="smallText">' . $ticket_status_array[$customers_tickets['ticket_status_id']] . '</td>'; }
          if (TICKET_CATALOG_USE_DEPARTMENT == 'true') { echo '            <td class="smallText">' . $ticket_department_array[$customers_tickets['ticket_department_id']] . '</td>'; }
          if (TICKET_CATALOG_USE_PRIORITY == 'true') {   echo '            <td class="smallText">' . $ticket_priority_array[$customers_tickets['ticket_priority_id']] . '</td>'; }

?>
            <td class="smallText" align="right"><?php echo tep_date_short($customers_tickets['ticket_date_created']); ?></td>
            <td class="smallText" align="right"><?php echo tep_date_short($customers_tickets['ticket_date_last_modified']); ?></td>
          </tr>
<?php
        }
?>
<?php 
  if ($customers_tickets_split->number_of_rows > 0) {
?>
          <tr>
            <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText"><?php echo $customers_tickets_split->display_count(TEXT_DISPLAY_NUMBER_OF_TICKETS); ?></td>
                <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $customers_tickets_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
<?php
  }
?>
        </table></td>
      </tr>
<?php
      }
    }
  }
  if (isset($tlid)) {
      $ticket_query = tep_db_query("select * from " . TABLE_TICKET_TICKET . " where ticket_link_id = '" . tep_db_input($tlid) . "'");
      $ticket = tep_db_fetch_array($ticket_query);
    // Check if Customer is allowed to view ticket:
      if ($ticket['ticket_customers_id'] > 1 && $ticket['ticket_login_required']=='1' && !tep_session_is_registered('customer_id') ) {
          // Customer must be logged in to view ticket:
?>
      <tr>
        <td align="center"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo sprintf(TEXT_VIEW_TICKET_LOGIN, tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'login=yes&tlid=' . $tlid, 'SSL'), tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL')); ?></td>
          </tr>
        </table></td>
      </tr>      
<?php  
      } else {
      // Customer is allowed to view ticket
        $ticket_status_query = tep_db_query("select * from " . TABLE_TICKET_STATUS_HISTORY . " where ticket_id = '". tep_db_input($ticket['ticket_id']) . "'");
      
?>
      <tr>
        <td><table class="ticket" width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan=2 class="ticketInfoBoxHeading" align="left"><b><?php echo $ticket['ticket_subject']; ?></b></td>
          </tr> 
          <tr>
            <td class="ticketSmallText" colspan=2 align="left">
<?php 
        echo TEXT_OPENED . ' ' . tep_date_short($ticket['ticket_date_created']) . ' ' . TEXT_TICKET_BY . ' ' . $ticket['ticket_customers_name'] . "<br>";
        echo TEXT_TICKET_NR . '&nbsp;' . $ticket['ticket_link_id'];
        if ($ticket['ticket_customers_orders_id'] > 0) echo '<br>' . TEXT_CUSTOMERS_ORDERS_ID . '&nbsp;' . $ticket['ticket_customers_orders_id'];
?>
            </td>
          </tr>  
<?php     
        while ($ticket_status = tep_db_fetch_array($ticket_status_query)) {
?>
          <tr >
            <td class="ticketSmallText" width="15%">
<?php
          echo '<b>' . $ticket_status['ticket_edited_by'] . '</b><br></br>';
          echo TEXT_DATE . '&nbsp;' .  tep_date_short($ticket_status['ticket_date_modified']) . '<br>';
          if (TICKET_CATALOG_USE_STATUS == 'true') {      echo TEXT_STATUS . '&nbsp;' .  $ticket_status_array[$ticket_status['ticket_status_id']] . '<br>'; }
          if (TICKET_CATALOG_USE_DEPARTMENT == 'true') {  echo TEXT_DEPARTMENT . '&nbsp;' .  $ticket_department_array[$ticket_status['ticket_department_id']] . '<br>'; }
          if (TICKET_CATALOG_USE_PRIORITY == 'true') {    echo TEXT_PRIORITY . '&nbsp;' .  $ticket_priority_array[$ticket_status['ticket_priority_id']] . '<br>'; }
          $ticket_last_used_status = $ticket_status['ticket_status_id'];
          $ticket_last_used_department = $ticket_status['ticket_department_id'];
          $ticket_last_used_priority = $ticket_status['ticket_priority_id'];
?>
            </td>
            <td align=left class="ticketSmallText"><?php echo nl2br($ticket_status['ticket_comments']); ?></td>
          </tr>  

<?php
        }
        echo tep_draw_form('ticket_view', tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, 'action=send')); 
        echo tep_draw_hidden_field('tlid',$tlid);
?>
          <tr>
            <td class="ticketSmallText" valign="top">
<?php 
        echo TEXT_COMMENT . '<br><br><br>';
        if (TICKET_CATALOG_USE_STATUS == 'true' && TICKET_ALLOW_CUSTOMER_TO_CHANGE_STATUS == 'true') {
          echo TEXT_STATUS . '&nbsp;<br>' . tep_draw_pull_down_menu('status', $ticket_statuses, ($ticket_last_used_status ? $ticket_last_used_status : TICKET_DEFAULT_STATUS_ID) ) . "<br><br>";
        } else {
           echo tep_draw_hidden_field('status', ($ticket_last_used_status ? $ticket_last_used_status : TICKET_DEFAULT_STATUS_ID) );
        }
        if (TICKET_CATALOG_USE_DEPARTMENT == 'true' && TICKET_ALLOW_CUSTOMER_TO_CHANGE_DEPARTMENT == 'true') {
          echo TEXT_DEPARTMENT . '&nbsp;<br>' . tep_draw_pull_down_menu('department', $ticket_departments, ($ticket_last_used_department ? $ticket_last_used_department : TICKET_DEFAULT_DEPARTMENT_ID) ) . "<br><br>";
        } else {
           echo tep_draw_hidden_field('department', ($ticket_last_used_department ? $ticket_last_used_department : TICKET_DEFAULT_DEPARTMENT_ID) );
        }
        if (TICKET_CATALOG_USE_PRIORITY == 'true' && TICKET_ALLOW_CUSTOMER_TO_CHANGE_PRIORITY == 'true') {
          echo TEXT_PRIORITY . '&nbsp;<br>' . tep_draw_pull_down_menu('priority', $ticket_prioritys, ($ticket_last_used_priority ? $ticket_last_used_priority : TICKET_DEFAULT_PRIORITY_ID) ) . "<br><br>";
        } else {
          echo tep_draw_hidden_field('priority', ($ticket_last_used_priority ? $ticket_last_used_priority : TICKET_DEFAULT_PRIORITY_ID) );
        }
?>
            </td>
            <td  class="ticketSmallText" ><?php echo tep_draw_textarea_field('enquiry', 'soft', 50, 15,'','',false); ?></td>
          </tr>
          <tr>
            <td colspan=2 class="main" align="center"><?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE); ?></td>
          </tr>
          </form>
        </table></td>
      </tr> 
<?php
    }
  }
?>      
 
    </table>
