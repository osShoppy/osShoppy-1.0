<?php //$Id: /catalog/admin/stats_products_notifications.php (osC)

  require('includes/application_top.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
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
    <td width="100%" valign="top">		

<?php
// show customers for a product
if ($_GET['action'] == 'show_customers' && (int)$_GET['pID']) {
  $products_id = (int)$_GET['pID'];
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
	<tr>
          <td class="dataTableContent"><?php echo TEXT_DESCRIPTION_TO; ?><b>"<?php echo tep_get_products_name($products_id); ?>"</b>.</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_EMAIL; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DATE; ?></td>
              </tr>
<?php
  if ($HTTP_GET_VARS['cpage'] > 1) $rows = $HTTP_GET_VARS['cpage'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;

    $customers_query_raw = "select c.customers_firstname, c.customers_lastname, c.customers_email_address, pn.date_added
                            from " . TABLE_CUSTOMERS . " c, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn 
                            where c.customers_id = pn.customers_id and pn.products_id = '" . $products_id . "' 
                            order by c.customers_firstname, c.customers_lastname";

    $customers_split = new splitPageResults($HTTP_GET_VARS['cpage'], MAX_DISPLAY_SEARCH_RESULTS, $customers_query_raw, $customers_query_numrows);
    $customers_query = tep_db_query($customers_query_raw);
	
    while ($customers = tep_db_fetch_array($customers_query)) {
      $rows++;

      if (strlen($rows) < 2) {
        $rows = '0' . $rows;
      }
?>
              <tr class="dataTableRow" onMouseOver="this.className='dataTableRowOver';this.style.cursor='hand'" onMouseOut="this.className='dataTableRow'">
                <td width="30" nowrap class="dataTableContent"><?php echo $rows; ?>.</td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'search=' . $customers['customers_lastname'], 'NONSSL') . '">' . $customers['customers_firstname'] . ' ' . $customers['customers_lastname'] . '</a>'; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_MAIL, 'selected_box=tools&customer=' . $customers['customers_email_address'], 'NONSSL') . '">' . $customers['customers_email_address'] . '</a>'; ?>&nbsp;</td>
                <td class="dataTableContent"><?php echo tep_date_long($customers['date_added']); ?>&nbsp;</td>
              </tr>
<?php
    }
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['cpage'], 'Displaying <b>%s</b> to <b>%s</b> (of <b>%s</b> customers)' , '', 'cpage'); ?></td>
                <td class="smallText" align="right"><?php echo $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['cpage'], tep_get_all_get_params(array('cpage')), 'cpage'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="5"></td>
        </tr>
        <tr> 
          <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_NOTIFICATIONS, tep_get_all_get_params(array('action', 'pID', 'cpage'))) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
        </tr>
      </table>
<?php
// default
} else {

?>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="dataTableContent"><?php echo TEXT_DESCRIPTION; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MODEL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_COUNT; ?>&nbsp;</td>
              </tr>
<?php
  if ($HTTP_GET_VARS['page'] > 1) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;

    $products_notifications_query_raw = "select count(pn.products_id) as count_notifications, pn.products_id, pd.products_name, p.products_model 
	                                 from " . TABLE_PRODUCTS_NOTIFICATIONS . " pn, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p, " . TABLE_CUSTOMERS . " c
                                         where pn.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' 
                                         and pn.customers_id = c.customers_id 
                                         and pn.products_id = p.products_id
                                         group by pn.products_id order by count_notifications desc, 
                                         pn.products_id";
    // fix numrows
    $products_count_query = tep_db_query($products_notifications_query_raw);

    $products_notifications_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_notifications_query_raw,     $products_notifications_query_numrows);			
    $products_notifications_query = tep_db_query($products_notifications_query_raw);
    $products_notifications_query_numrows = tep_db_num_rows($products_count_query);
	
    while ($products = tep_db_fetch_array($products_notifications_query)) {
      $rows++;

      if (strlen($rows) < 2) {
        $rows = '0' . $rows;
      }
?>
              <tr class="dataTableRow" onMouseOver="this.className='dataTableRowOver';this.style.cursor='hand'" onMouseOut="this.className='dataTableRow'" onClick="document.location.href='<?php echo tep_href_link(FILENAME_STATS_PRODUCTS_NOTIFICATIONS, 'action=show_customers&pID=' . $products['products_id'] . '&page=' . $page, 'NONSSL'); ?>'">
                <td width="30" nowrap class="dataTableContent"><?php echo $rows; ?>.</td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_NOTIFICATIONS, 'action=show_customers&pID=' . $products['products_id'] . '&page=' . $page, 'NONSSL') . '">' . $products['products_name'] . '</a>'; ?></td>
                <td class="dataTableContent" align="center"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'pID=' . $products['products_id'] . '&action=new_product') . '">' . $products['products_model'] . '</a>'; ?>&nbsp;</td>
                <td class="dataTableContent" align="center"><?php echo $products['count_notifications']; ?>&nbsp;</td>
              </tr>
<?php
  }
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $products_notifications_split->display_count($products_notifications_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                <td class="smallText" align="right"><?php echo $products_notifications_split->display_links($products_notifications_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php
} // end else
?>
		</td>
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
