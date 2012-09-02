<?php
/*
  $Id: ticket_admin.php,v 1.5 2003/07/13 20:22:02 hook Exp $

  OSC-SupportTicketSystem
  Copyright (c) 2003 Henri Schmidhuber IN-Solution
  
  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  switch ($HTTP_GET_VARS['action']) {
    case 'insert':
    case 'save':
      $ticket_admin_id = tep_db_prepare_input($HTTP_GET_VARS['oID']);

      $languages = tep_get_languages();
      $ticket_admin_name_array = $HTTP_POST_VARS['ticket_admin_name'];
      for ($i = 0; $i < sizeof($languages); $i++) {
        $ticket_language_id = $languages[$i]['id'];
        $sql_data_array = array('ticket_admin_name' => tep_db_prepare_input($ticket_admin_name_array[$ticket_language_id]));

        if ($HTTP_GET_VARS['action'] == 'insert') {
          if (!tep_not_null($ticket_admin_id)) {
            $next_id_query = tep_db_query("select max(ticket_admin_id) as ticket_admin_id from " . TABLE_TICKET_ADMIN . "");
            $next_id = tep_db_fetch_array($next_id_query);
            $ticket_admin_id = $next_id['ticket_admin_id'] + 1;
          }

          $insert_sql_data = array('ticket_admin_id' => $ticket_admin_id,
                                   'ticket_language_id' => $ticket_language_id);
          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
          tep_db_perform(TABLE_TICKET_ADMIN, $sql_data_array);
        } elseif ($HTTP_GET_VARS['action'] == 'save') {
          tep_db_perform(TABLE_TICKET_ADMIN, $sql_data_array, 'update', "ticket_admin_id = '" . tep_db_input($ticket_admin_id) . "' and ticket_language_id = '" . $ticket_language_id . "'");
        }
      }

      if ($HTTP_POST_VARS['default'] == 'on') {
        tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($ticket_admin_id) . "' where configuration_key = 'TICKET_DEFAULT_ADMIN_ID'");
      }

      tep_redirect(tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $ticket_admin_id));
      break;
    case 'deleteconfirm':
      $oID = tep_db_prepare_input($HTTP_GET_VARS['oID']);

      $ticket_admin_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'TICKET_DEFAULT_ADMIN_ID'");
      $ticket_admin = tep_db_fetch_array($ticket_admin_query);
      if ($ticket_admin['configuration_value'] == $oID) {
        tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '' where configuration_key = 'TICKET_DEFAULT_ADMIN_ID'");
      }

      tep_db_query("delete from " . TABLE_TICKET_ADMIN . " where ticket_admin_id = '" . tep_db_input($oID) . "'");

      tep_redirect(tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page']));
      break;
    case 'delete':
      $oID = tep_db_prepare_input($HTTP_GET_VARS['oID']);
      $remove_admin = true;
      if ($oID == TICKET_DEFAULT_ADMIN_ID) {
        $remove_admin = false;
        $messageStack->add(ERROR_REMOVE_DEFAULT_TEXT_ADMIN, 'error');
      } 
      break;
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
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
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TEXT_ADMIN; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $ticket_admin_query_raw = "select ticket_admin_id, ticket_admin_name from " . TABLE_TICKET_ADMIN . " where ticket_language_id = '" . $languages_id . "' order by ticket_admin_id";
  $ticket_admin_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $ticket_admin_query_raw, $ticket_admin_query_numrows);
  $ticket_admin_query = tep_db_query($ticket_admin_query_raw);
  while ($ticket_admin = tep_db_fetch_array($ticket_admin_query)) {
    if (((!$HTTP_GET_VARS['oID']) || ($HTTP_GET_VARS['oID'] == $ticket_admin['ticket_admin_id'])) && (!$oInfo) && (substr($HTTP_GET_VARS['action'], 0, 3) != 'new')) {
      $oInfo = new objectInfo($ticket_admin);
    }

    if ( (is_object($oInfo)) && ($ticket_admin['ticket_admin_id'] == $oInfo->ticket_admin_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $ticket_admin['ticket_admin_id']) . '\'">' . "\n";
    }

    if (TICKET_DEFAULT_ADMIN_ID == $ticket_admin['ticket_admin_id']) {
      echo '                <td class="dataTableContent"><b>' . $ticket_admin['ticket_admin_name'] . ' (' . TEXT_DEFAULT . ')</b></td>' . "\n";
    } else {
      echo '                <td class="dataTableContent">' . $ticket_admin['ticket_admin_name'] . '</td>' . "\n";
    }
?>
                <td class="dataTableContent" align="right"><?php if ( (is_object($oInfo)) && ($ticket_admin['ticket_admin_id'] == $oInfo->ticket_admin_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $ticket_admin['ticket_admin_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $ticket_admin_split->display_count($ticket_admin_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_TEXT_ADMIN); ?></td>
                    <td class="smallText" align="right"><?php echo $ticket_admin_split->display_links($ticket_admin_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
<?php
  if (substr($HTTP_GET_VARS['action'], 0, 3) != 'new') {
?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($HTTP_GET_VARS['action']) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_TEXT_ADMIN . '</b>');

      $contents = array('form' => tep_draw_form('admin', FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);

      $ticket_admin_inputs_string = '';
      $languages = tep_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $ticket_admin_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('ticket_admin_name[' . $languages[$i]['id'] . ']');
      }

      $contents[] = array('text' => '<br>' . TEXT_INFO_TEXT_ADMIN_NAME . $ticket_admin_inputs_string);
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . ' <a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_TEXT_ADMIN . '</b>');

      $contents = array('form' => tep_draw_form('admin', FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id  . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);

      $ticket_admin_inputs_string = '';
      $languages = tep_get_languages();
      for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $ticket_admin_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('ticket_admin_name[' . $languages[$i]['id'] . ']', tep_get_ticket_admin_name($oInfo->ticket_admin_id, $languages[$i]['id']));
      }

      $contents[] = array('text' => '<br>' . TEXT_INFO_TEXT_ADMIN_NAME . $ticket_admin_inputs_string);
      if (TICKET_DEFAULT_ADMIN_ID != $oInfo->ticket_admin_id) $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('default') . ' ' . TEXT_SET_DEFAULT);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_TEXT_ADMIN . '</b>');

      $contents = array('form' => tep_draw_form('admin', FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id  . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $oInfo->ticket_admin_name . '</b>');
      if ($remove_admin) $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($oInfo)) {
        $heading[] = array('text' => '<b>' . $oInfo->ticket_admin_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_TICKET_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&oID=' . $oInfo->ticket_admin_id . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');

        $ticket_admin_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $ticket_admin_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_get_ticket_admin_name($oInfo->ticket_admin_id, $languages[$i]['id']);
        }

        $contents[] = array('text' => $ticket_admin_inputs_string);
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
