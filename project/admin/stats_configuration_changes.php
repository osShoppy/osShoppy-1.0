<?php //$Id: /catalog/admin/stats_configuration_changes.php (6865)

  require('includes/application_top.php');

//
 // Delete button updated by apopular.com.br from Brazil 
  if ($_GET['action'] == DEFINE_BUTTON_DELETE) {
	tep_db_query("delete from configuration_changes");
} // delete db
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="20%"><?php echo TABLE_HEADING_TITLE; ?></td>
                <td class="dataTableHeadingContent" width="25%"><?php echo TABLE_HEADING_DESCRIPTION; ?></td>
                <td class="dataTableHeadingContent" width="15%"><?php echo TABLE_HEADING_DATE_CHANGE; ?></td>
                <td class="dataTableHeadingContent" width="20%"><?php echo TABLE_HEADING_PREVIOUS_SETTING; ?></td>
                <td class="dataTableHeadingContent" width="20%"><?php echo TABLE_HEADING_NEW_SETTING; ?></td>
              </tr>
<?php
  if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $rows = 0;
  $changes_query_raw = "select previous_setting, new_setting, change_date, change_title, change_description from " . TABLE_CONFIGURATION_CHANGES . " order by change_id desc";
  $changes_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $changes_query_raw, $changes_query_numrows);
  $changes_query = tep_db_query($changes_query_raw);
  while ($changes = tep_db_fetch_array($changes_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                <td class="dataTableContent" valign="top"><?php echo $changes['change_title']; ?></td>
                <td class="dataTableContent" valign="top"><?php echo $changes['change_description']; ?></td>
                <td class="dataTableContent" valign="top"><?php echo $changes['change_date']; ?></td>
                <td class="dataTableContent" valign="top"><?php echo $changes['previous_setting']; ?></td>
                <td class="dataTableContent" valign="top"><?php echo $changes['new_setting']; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
		</tr>
	</table> 
<?php 
//
// delete button by marcelo_73 www.apopular.com.br Brazil
// 
echo tep_draw_form('delete', 'stats_configuration_changes.php', '', 'get'); ?>
<?php
    $heading = array();
    $contents = array();

    $heading[]  = array('text'  => '<b>'. DEFINE_CONTROL_PANEL  .'</b>');

    $contents[] = array('text'  => '<br>' . DEFINE_DELETE_ALL_INFORMATIONS);
    $contents[] = array('text'  => '<input type="submit" value="'. DEFINE_BUTTON_DELETE . '" name="action">');
    $contents[] = array('text'  =>  tep_draw_separator());
    
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {

    $box = new box;
    echo $box->infoBox($heading, $contents);
  } ?>    
</form>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $changes_split->display_count($changes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                <td class="smallText" align="right"><?php echo $changes_split->display_links($changes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
              </tr>
            </table></td>
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
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>