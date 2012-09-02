<?php //$Id: /catalog/admin/stats_referrals_sources.php (2159)

  require('includes/application_top.php');
  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  if ($action == 'display_other') {
  	$referrals_query_raw = "select count(ci.customers_info_source_id) as no_referrals, so.customers_id, ci.customers_info_date_account_created, so.sources_other_name as sources_name from " . TABLE_CUSTOMERS_INFO . " ci, " . TABLE_SOURCES_OTHER . " so where ci.customers_info_source_id = '9999' and so.customers_id = ci.customers_info_id group by so.sources_other_name order by no_referrals DESC";
  } else {
    $referrals_query_raw = "select count(ci.customers_info_source_id) as no_referrals, s.sources_name, s.sources_id from " . TABLE_CUSTOMERS_INFO . " ci LEFT JOIN " . TABLE_SOURCES . " s ON s.sources_id = ci.customers_info_source_id group by s.sources_id order by ci.customers_info_source_id DESC";
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_REFERRALS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_VIEWED; ?>&nbsp;</td>
              </tr>
<?php
  if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * '30' - '30';
  $rows = 0;
  $presplit_query = tep_db_query($referrals_query_raw);
  $presplit_query_numrows = tep_db_num_rows($presplit_query);
  $referrals_split = new splitPageResults($HTTP_GET_VARS['page'], '30', $referrals_query_raw, $referrals_query_numrows);
  $referrals_query_numrows = $presplit_query_numrows;
  $referrals_query = tep_db_query($referrals_query_raw);
  while ($referrals = tep_db_fetch_array($referrals_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
    if ( tep_not_null($referrals['sources_name']) ) {
?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
<?php
    } else {
?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_STATS_REFERRAL_SOURCES, 'action=display_other'); ?>'">
<?php
    }
      if ($action == 'display_other') {
    	$referrals_data_query_raw = "select ci.customers_info_id, ci.customers_info_date_account_created from " . TABLE_CUSTOMERS_INFO . " ci, " . TABLE_SOURCES_OTHER . " so where so.customers_id = ci.customers_info_id and so.sources_other_name  = '" . $referrals['sources_name'] . "' order by ci.customers_info_id DESC";
    	$referrals_data_query = tep_db_query($referrals_data_query_raw);
  	    if (tep_not_null($referrals['sources_name'])) {
                echo '<td class="dataTableContent"><b>' . $referrals['sources_name'] . '</b>&nbsp';
                    $rowcount ='0';
                    echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                    while ($referrals_data = tep_db_fetch_array($referrals_data_query)) {
                    	if ($rowcount > 10) {
					        echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					        $rowcount ='0';
						}
						$rowcount++;
						echo substr($referrals_data['customers_info_date_account_created'], 0, 10) . '&nbsp;&nbsp;';
					}
					?>
				</td>
                <td class="dataTableContent" align="top"><?php echo $referrals['no_referrals']; ?>&nbsp;</td>
              </tr>

<?php
	    }
	  } else {
?>
	                  <td class="dataTableContent"><?php echo (tep_not_null($referrals['sources_name']) ? $referrals['sources_name'] : TEXT_OTHER );?>&nbsp;</td>
	                  <td class="dataTableContent" align="center"><?php echo $referrals['no_referrals']; ?>&nbsp;</td>
              </tr>
<?php
	  }
  	}
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $referrals_split->display_count($referrals_query_numrows, '30', $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_REFERRALS); ?></td>
                <td class="smallText" align="right"><?php echo $referrals_split->display_links($referrals_query_numrows, '30', MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page')) ); ?></td>
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
