<?php
/*
  $Id: ticket_view.php,v 1.6 2003/07/13 20:22:02 hook Exp $

  OSC-SupportTicketSystem
  Copyright (c) 2003 Henri Schmidhuber IN-Solution
  
  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  $ticket_admins = array();
  $ticket_admin_array = array();
  $ticket_admin_query = tep_db_query("select ticket_admin_id, ticket_admin_name from " . TABLE_TICKET_ADMIN . " where ticket_language_id = '" . $languages_id . "'");
  while ($ticket_admin = tep_db_fetch_array($ticket_admin_query)) {
    $ticket_admins[] = array('id' => $ticket_admin['ticket_admin_id'],
                               'text' => $ticket_admin['ticket_admin_name']);
    $ticket_admin_array[$ticket_admin['ticket_admin_id']] = $ticket_admin['ticket_admin_name'];
  }


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

  switch ($HTTP_GET_VARS['action']) {
    case 'update_ticket':
      $error = false;
      $tID = tep_db_prepare_input($HTTP_GET_VARS['tID']);
      $enquiry = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);
      $admin = tep_db_prepare_input($HTTP_POST_VARS['admin']);
      $status = tep_db_prepare_input($HTTP_POST_VARS['status']);
      $priority = tep_db_prepare_input($HTTP_POST_VARS['priority']);
      $department = tep_db_prepare_input($HTTP_POST_VARS['department']);
      $ticket_login_required = tep_db_prepare_input($HTTP_POST_VARS['ticket_login_required']);
    // Check Message length
      if (strlen($enquiry) < TICKET_ENTRIES_MIN_LENGTH ) {
        $error = true;
        $messageStack->add_session(WARNING_ENTRY_TO_SHORT,  'warning');
      }
    // Check if Ticket exists
      $ticket_update_query = tep_db_query("select ticket_customers_email, ticket_customers_name, ticket_link_id  from " . TABLE_TICKET_TICKET . " where ticket_id = '" . $tID . "'");
      $ticket_update = tep_db_fetch_array($ticket_update_query);
      if (!$ticket_update['ticket_customers_email']) {
        $error = true;
        $messageStack->add_session(WARNING_TICKET_NOT_UPDATED ."AA", 'warning');
      }
      if ($error == false) {
       $sql_data_array = array('ticket_id' => $tID,
                          'ticket_status_id' => $status,
                          'ticket_priority_id' => $priority,
                          'ticket_department_id' => $department,
                          'ticket_date_modified' => 'now()',
                          'ticket_customer_notified' => '0',
                          'ticket_edited_by' => $ticket_admin_array[$admin],
                          'ticket_comments' => $enquiry);
        tep_db_perform(TABLE_TICKET_STATUS_HISTORY, $sql_data_array);         
        $sql_data_array = array('ticket_date_last_modified' => 'now()',
                          'ticket_status_id' => $status,
                          'ticket_priority_id' => $priority,
                          'ticket_department_id' => $department,
                          'ticket_login_required' => $ticket_login_required);
        tep_db_perform(TABLE_TICKET_TICKET, $sql_data_array,'update','ticket_id=\'' . $tID . '\'');  
      // Email  Customer doesn't get the Message cause he should use the web
        $ticket_email_subject = TICKET_EMAIL_SUBJECT . $subject;
        $ticket_email_message = TICKET_EMAIL_MESAGE_HEADER . "\n\n" . tep_catalog_href_link(FILENAME_TICKET_VIEW, 'tlid=' . $ticket_update['ticket_link_id'],'NONSSL',false,false) . "\n\n" . TICKET_EMAIL_MESAGE_FOOTER;
        tep_mail($ticket_update['ticket_customers_name'], $ticket_update['ticket_customers_email'], $ticket_email_subject, nl2br($ticket_email_message), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

        $ticket_updated = true;
      }
      if ($ticket_updated) {
       $messageStack->add_session(SUCCESS_TICKET_UPDATED, 'success');
      } else {
        $messageStack->add_session(WARNING_TICKET_NOT_UPDATED, 'warning');
      }

      tep_redirect(tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('action')) . 'action=edit'));
      break;
    case 'deleteconfirm':
      $tID = tep_db_prepare_input($HTTP_GET_VARS['tID']);
      tep_db_query ("delete from " . TABLE_TICKET_TICKET . " where ticket_id='" . $tID . "'");
      tep_redirect(tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action'))));
      break;
  }

if ( ($HTTP_GET_VARS['action'] == 'edit') && ($HTTP_GET_VARS['tID']) ) {
    $tID = tep_db_prepare_input($HTTP_GET_VARS['tID']);

    $ticket_query = tep_db_query("select * from " . TABLE_TICKET_TICKET . " where ticket_id = '" . tep_db_input($tID) . "'");
    $ticket_exists = true;
    if (!tep_db_num_rows($ticket_query)) {
      $ticket_exists = false;
      $messageStack->add(sprintf(ERROR_TICKET_DOES_NOT_EXIST, $tID), 'error');
    }
  }
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<?php echo TICKET_STYLESHEET; ?>
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php

  if ( ($HTTP_GET_VARS['action'] == 'edit') && ($ticket_exists) ) {
    $ticket = tep_db_fetch_array($ticket_query);
    $ticket_status_query = tep_db_query("select * from " . TABLE_TICKET_STATUS_HISTORY . " where ticket_id = '". tep_db_input($ticket['ticket_id']) . "'");
?>
      <tr>
        <td><table class="ticket" width="100%" border="1" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan=2 class="ticketInfoBoxHeading" align="left"><b><?php echo $ticket['ticket_subject']; ?></b></td>
          </tr> 
          <tr>
            <td class="ticketSmallText" colspan=2 align="left">
<?php 
      echo TEXT_OPENED . ' ' .tep_datetime_short($ticket['ticket_date_created']) . ' ' . TEXT_TICKET_BY . ' ' . $ticket['ticket_customers_name'] . "<br>";
      echo TEXT_CUSTOMERS_EMAIL . ' ' . $ticket['ticket_customers_email'] . "<br>";
      echo TEXT_TICKET_NR . '&nbsp;' . $ticket['ticket_link_id'];
      if ($ticket['ticket_customers_orders_id'] > 0 && TICKET_USE_ORDER_IDS=='true') echo '<br>' . TEXT_CUSTOMERS_ORDERS_ID . '&nbsp;' . $ticket['ticket_customers_orders_id'];
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
                  echo TEXT_DATE . '&nbsp;' .  tep_datetime_short($ticket_status['ticket_date_modified']) . '<br>';
                  if (TICKET_USE_STATUS=='true') echo TEXT_STATUS . '&nbsp;' .  $ticket_status_array[$ticket_status['ticket_status_id']] . '<br>';
                  if (TICKET_USE_DEPARTMENT=='true') echo TEXT_DEPARTMENT . '&nbsp;' .  $ticket_department_array[$ticket_status['ticket_department_id']] . '<br>';
                  if (TICKET_USE_PRIORITY=='true') echo TEXT_PRIORITY . '&nbsp;' .  $ticket_priority_array[$ticket_status['ticket_priority_id']] . '<br>';  
                  $ticket_last_used_status = $ticket_status['ticket_status_id'];
                  $ticket_last_used_department = $ticket_status['ticket_department_id'];
                  $ticket_last_used_priority = $ticket_status['ticket_priority_id'];
?>
            </td>
            <td align=left class="ticketSmallText"><?php echo nl2br($ticket_status['ticket_comments']); ?></td>
          </tr>  

<?php
      }
      echo tep_draw_form('status', FILENAME_TICKET_VIEW, tep_get_all_get_params(array('action')) . 'action=update_ticket');
?>
          <tr>
            <td class="ticketSmallText" valign="top">
<?php 
      echo '            ' . TEXT_COMMENT . '<br><br><br>';
      echo '            ' . TEXT_ADMIN . '&nbsp;' . tep_draw_pull_down_menu('admin', $ticket_admins, ($ticket_last_used_admin ? $ticket_last_used_admins : TICKET_DEFAULT_ADMIN_ID) ) . "<br><br>";
      if (TICKET_USE_STATUS=='true') echo '            ' . TEXT_STATUS . '&nbsp;' . tep_draw_pull_down_menu('status', $ticket_statuses, ($ticket_last_used_status ? $ticket_last_used_status : TICKET_DEFAULT_STATUS_ID) ) . "<br><br>";
      if (TICKET_USE_DEPARTMENT=='true') echo '            ' . TEXT_DEPARTMENT . '&nbsp;' . tep_draw_pull_down_menu('department', $ticket_departments, ($ticket_last_used_department ? $ticket_last_used_department : TICKET_DEFAULT_DEPARTMENT_ID) ) . "<br><br>";
      if (TICKET_USE_PRIORITY=='true') echo '            ' . TEXT_PRIORITY . '&nbsp;' . tep_draw_pull_down_menu('priority', $ticket_prioritys, ($ticket_last_used_priority ? $ticket_last_used_priority : TICKET_DEFAULT_PRIORITY_ID) ) . "<br><br>";
      echo '            ' . TEXT_REPLY . '&nbsp;' ;
      $reply_query = tep_db_query("select ticket_reply_id, ticket_reply_name, ticket_reply_text from " . TABLE_TICKET_REPLY . " where ticket_language_id = '" . $languages_id . "'");
      echo ' <select name="dummy" size="1">';
      while ($reply = tep_db_fetch_array($reply_query)) {
        echo '            <option value="' . $reply['ticket_reply_text'] . '"';
        if (TICKET_DEFAULT_REPLY_ID == $reply['ticket_reply_id']) echo ' selected';
        echo '>';
        echo $reply['ticket_reply_name'] . '</option>' . "\n";  

      }
      echo '             </select>';
      echo '             <input type="button" name="insert" value="' . TEXT_INSERT . '" onclick="document.status.enquiry.value = document.status.enquiry.value + document.status.dummy.value">';
?>
            </td>
            <td  class="ticketSmallText" ><?php echo tep_draw_textarea_field('enquiry', 'soft', 50, 15,'','class="ticket"'); ?></td>
          </tr>
<?php
      if ($ticket['ticket_customers_id'] > 0) { 
?>
          <tr>
            <td colspan=2 class="main" align="left">
<?php 

        $ticket_change_login = array();
        $ticket_change_login_array = array();
        $ticket_change_login[] = array('id' => '0', 'text' => TEXT_CUSTOMER_LOGIN_NO);
        $ticket_change_login_array['0'] = TEXT_CUSTOMER_LOGIN_NO;
        $ticket_change_login[] = array('id' => '1', 'text' => TEXT_CUSTOMER_LOGIN_YES);
        $ticket_change_login_array['1'] = TEXT_CUSTOMER_LOGIN_YES;      
        
        if (TICKET_CHANGE_CUSTOMER_LOGIN_REQUIREMENT=='true') {
          echo tep_draw_pull_down_menu('ticket_login_required', $ticket_change_login, $ticket['ticket_login_required']);
        }
        else {
          echo $ticket_change_login_array[$ticket['ticket_login_required']];
        }
?>
            </td>
          </tr>
<?php
      }
?>
          <tr>
            <td colspan=2 class="main" align="center"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>' ?></td>
          </tr>
          </form>
        </table></td>
      </tr>
<?php    
  } else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo tep_draw_form('status', FILENAME_TICKET_VIEW, '', 'get'); ?>
                <td class="smallText" align="right">
<?php 
    if (TICKET_USE_STATUS=='true') echo HEADING_TITLE_STATUS . ' ' . tep_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_TICKETS)), $ticket_statuses), '', 'onChange="this.form.submit();"') . "<br>\n";
    if (TICKET_USE_DEPARTMENT=='true') echo HEADING_TITLE_DEPARTMENT . ' ' . tep_draw_pull_down_menu('department', array_merge(array(array('id' => '', 'text' => TEXT_ALL_DEPARTMENTS)), $ticket_departments), '', 'onChange="this.form.submit();"') . "<br>\n"; 
    if (TICKET_USE_PRIORITY=='true') echo HEADING_TITLE_PRIORITY . ' ' . tep_draw_pull_down_menu('priority', array_merge(array(array('id' => '', 'text' => TEXT_ALL_PRIORITYS)), $ticket_prioritys), '', 'onChange="this.form.submit();"') . "<br>\n"; 

?>
                </td>
              </form></tr>
              <tr><?php echo tep_draw_form('search', FILENAME_TICKET_VIEW, '', 'get'); ?>
                <td class="smallText" align="right">
                <?php  echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?> 
                </td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NAME; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_CUSTOMER_ID; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DATE; ?></td>
<?php
    if (TICKET_USE_SUBJECT=='true') echo '                <td class="dataTableHeadingContent" align="left">' .  TABLE_HEADING_TICKET_SUBJECT . '</td>';
    if (TICKET_USE_ORDER_IDS=='true') echo '                <td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_ORDER_ID . '</td>';
    if (TICKET_USE_STATUS=='true') echo '                <td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_STATUS . '</td>';
    if (TICKET_USE_PRIORITY=='true') echo '                <td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_PRIORITY . '</td>';
    if (TICKET_USE_DEPARTMENT=='true') echo '                <td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_DEPARTMENT . '&nbsp;</td>';
?>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $ticket_query_raw  = "select * from " . TABLE_TICKET_TICKET . " ";
    if ($HTTP_GET_VARS['status'] || $HTTP_GET_VARS['department'] || $HTTP_GET_VARS['priority'] ) {
      $sql_and = 'false';
      $ticket_query_raw .= "where ";
      if ($HTTP_GET_VARS['status']) {
        $ticket_query_raw .= " ticket_status_id = '" . $HTTP_GET_VARS['status'] . "' ";
        $sql_and = 'true';
      }
      if ($HTTP_GET_VARS['department']) {
        if ($sql_and == 'true') $ticket_query_raw .= " and ";
        $ticket_query_raw .= " ticket_department_id = '" . $HTTP_GET_VARS['department'] . "' ";
        $sql_and = 'true';
      }      
      if ($HTTP_GET_VARS['priority']) {
        if ($sql_and == 'true') $ticket_query_raw .= " and ";
        $ticket_query_raw .= " ticket_priority_id = '" . $HTTP_GET_VARS['priority'] . "' ";
        $sql_and = 'true';
      }
    } else if ($HTTP_GET_VARS['search']) {
      $keywords = tep_db_input(tep_db_prepare_input($HTTP_GET_VARS['search']));
      $ticket_query_raw .= " where ticket_id like '%" . $keywords . "%' or ticket_link_id like '%" . $keywords . "%' or ticket_customers_email  like '%" . $keywords . "%' or ticket_customers_name  like '%" . $keywords . "%' or ticket_subject  like '%" . $keywords . "%' ";
    }
    $ticket_query_raw .= "order by ticket_date_last_customer_modified DESC";
    
    $ticket_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $ticket_query_raw, $ticket_query_numrows);
    $ticket_query = tep_db_query($ticket_query_raw);
    while ($ticket = tep_db_fetch_array($ticket_query)) {
      if (((!$HTTP_GET_VARS['tID']) || ($HTTP_GET_VARS['tID'] == $ticket['ticket_id'])) && (!$tInfo)) {
        $tInfo = new objectInfo($ticket);
      }
      if ( (is_object($tInfo)) && ($ticket['ticket_id'] == $tInfo->ticket_id) ) {
        echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action')) . 'tID=' . $tInfo->ticket_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID')) . 'tID=' . $ticket['ticket_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action')) . 'tID=' . $ticket['ticket_id'] . '&action=edit') . '">' . tep_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $ticket['ticket_customers_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo ($ticket['ticket_customers_id']>0) ? ('<a href="' . tep_href_link(FILENAME_CUSTOMERS,"cID=" . $ticket['ticket_customers_id'] ."&action=edit") . '" target="' . TICKET_LINK_TARGET . '">' . $ticket['ticket_customers_id'] . "</a>")  : '--'; ?>&nbsp;</td>
                <td class="dataTableContent" align="right"><?php echo tep_datetime_short($ticket['ticket_date_last_modified']); ?></td>
<?php
      if (TICKET_USE_SUBJECT=='true') echo '                <td class="dataTableContent" align="left">' . strip_tags($ticket['ticket_subject']) . '&nbsp;</td>';
      if (TICKET_USE_ORDER_IDS=='true') echo '                <td class="dataTableContent" align="center">' . (($ticket['ticket_customers_orders_id'] > 0) ? ('<a href="' . tep_href_link(FILENAME_ORDERS,"oID=" . $ticket['ticket_customers_orders_id'] ."&action=edit") . '" target="' . TICKET_LINK_TARGET . '">' . $ticket['ticket_customers_orders_id'] . "</a>") : '--') . '&nbsp;</td>';
      if (TICKET_USE_STATUS=='true') echo '                <td class="dataTableContent" align="center">' . $ticket_status_array[$ticket['ticket_status_id']] . '&nbsp;</td>';
      if (TICKET_USE_PRIORITY=='true') echo '                <td class="dataTableContent" align="center">' . $ticket_priority_array[$ticket['ticket_priority_id']] . '</td>';
      if (TICKET_USE_DEPARTMENT=='true') echo '                <td class="dataTableContent" align="center">' . $ticket_department_array[$ticket['ticket_department_id']] . '</td>';
?>
                <td class="dataTableContent" align="right"><?php if ( (is_object($tInfo)) && ($ticket['ticket_id'] == $tInfo->ticket_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID')) . 'tID=' . $ticket['ticket_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>    
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $ticket_split->display_count($ticket_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_TICKET); ?></td>
                    <td class="smallText" align="right"><?php echo $ticket_split->display_links($ticket_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'tID', 'action'))); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($HTTP_GET_VARS['action']) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_TICKET . '</b>');

      $contents = array('form' => tep_draw_form('orders', FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action')) . 'tID=' . $tInfo->ticket_id . '&action=deleteconfirm'));
      $contents[] = array('align' => 'left', 'text' => $tInfo->ticket_subject);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action')) . 'tID=' . $tInfo->ticket_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      $contents[] = array('form' => '</form>');
      break;
    default:
      if (is_object($tInfo)) {

        $heading[] = array('text' => '<b>[' . $tInfo->ticket_id . ']&nbsp;&nbsp;' . $tInfo->ticket_subject . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action')) . 'tID=' . $tInfo->ticket_id . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_TICKET_VIEW, tep_get_all_get_params(array('tID', 'action')) . 'tID=' . $tInfo->ticket_id . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_TICKET_CREATED . ' ' . tep_datetime_short($tInfo->ticket_date_created));
        if (tep_not_null($tInfo->ticket_date_last_modified)) $contents[] = array('text' => TEXT_DATE_TICKET_LAST_MODIFIED . ' ' . tep_datetime_short($tInfo->ticket_date_last_modified));
        if (tep_not_null($tInfo->ticket_date_last_customer_modified)) $contents[] = array('text' => TEXT_DATE_TICKET_LAST_CUSTOMER_MODIFIED . ' ' . tep_datetime_short($tInfo->ticket_date_last_customer_modified));
        if (TICKET_USE_STATUS=='true') $contents[] = array('text' => '<br>' . TEXT_STATUS . ' ' . $ticket_status_array[$tInfo->ticket_status_id]);
        if (TICKET_USE_PRIORITY=='true') $contents[] = array('text' => '<br>' . TEXT_PRIORITY . ' ' . $ticket_priority_array[$tInfo->ticket_priority_id]);
        if (TICKET_USE_DEPARTMENT=='true') $contents[] = array('text' => '<br>' . TEXT_DEPARTMENT . ' ' . $ticket_department_array[$tInfo->ticket_department_id]);  
        $contents[] = array('text' => '<br>' . TEXT_TICKET_NR . ' ' . $tInfo->ticket_link_id);  
        $contents[] = array('text' => '<br>' . TEXT_CUSTOMERS_NAME . ' ' . $tInfo->ticket_customers_name); 
        $contents[] = array('text' => '<br>' . TEXT_CUSTOMERS_EMAIL . ' ' . $tInfo->ticket_customers_email);
        if ($tInfo->ticket_customers_id > 0) $contents[] = array('text' => TEXT_CUSTOMERS_ID . ' ' . '<a href="' . tep_href_link(FILENAME_CUSTOMERS,"cID=" . $tInfo->ticket_customers_id ."&action=edit") . '" target="' . TICKET_LINK_TARGET . '">' . $tInfo->ticket_customers_id . '</a>');  
        if (TICKET_USE_ORDER_IDS=='true') $contents[] = array('text' => '<br>' . TEXT_CUSTOMERS_ORDERS_ID . ' ' . '<a href="' . tep_href_link(FILENAME_ORDERS,"oID=" . $tInfo->ticket_customers_orders_id ."&action=edit") . '" target="' . TICKET_LINK_TARGET . '">' . $tInfo->ticket_customers_orders_id . '</a>');  
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>

      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
