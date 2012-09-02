<?php //$Id: /catalog/admin/gallery_superuser.php (6181)

  require('includes/application_top.php');
  
  // #### Get Available Customers
  $query = tep_db_query("select a.customers_id, a.customers_firstname, a.customers_lastname, b.entry_city, c.zone_code 
                         from " . TABLE_CUSTOMERS . " AS a, " . 
                         TABLE_ADDRESS_BOOK . " AS b 
                         LEFT JOIN " . TABLE_ZONES . " as c 
                         ON (b.entry_zone_id = c.zone_id) 
                         WHERE a.customers_default_address_id = b.address_book_id  
                         ORDER BY entry_company,customers_lastname");
  $result = $query;

  if (tep_db_num_rows($result) > 0){
    // Query Successful
    $SelectCustomerBox = "<select name='add_superuser'><option value=''>" . TEXT_SELECT_CUST . "</option>\n";
    while($db_Row = tep_db_fetch_array($result)){ 
      $SelectCustomerBox .= "<option value='" . $db_Row['customers_id'] . "'";
      if(isSet($HTTP_GET_VARS['add_superuser']) and $db_Row['customers_id']==$HTTP_GET_VARS['add_superuser']){
        $SelectCustomerBox .= " SELECTED ";
        $SelectCustomerBox .= ">" . $db_Row['customers_lastname'] . " , " . $db_Row['customers_firstname'] . " - " . $db_Row['entry_city'] . "</option>\n";
      }else{
        $SelectCustomerBox .= ">" . $db_Row['customers_lastname'] . " , " . $db_Row['customers_firstname'] . " - " . $db_Row['entry_city'] . "</option>\n";
      }
    }
    $SelectCustomerBox .= "</select>\n";
  } 
  // #### Get Available Customers

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  $error = false;
	if (isset($HTTP_GET_VARS['add_superuser']) && tep_not_null($HTTP_GET_VARS['add_superuser'])) {
		$customers_id = tep_db_prepare_input($HTTP_GET_VARS['add_superuser']);
		$allowed= tep_db_prepare_input($HTTP_GET_VARS['allowed']);
		if (!$customers_id) $error=true;
		
		$check_query = tep_db_query("select count(*) as total from " . TABLE_GALLERY_SUPERUSERS . " where cID = '" . (int)$customers_id . "'");
		$check_value = tep_db_fetch_array($check_query);
		if ($error == false && $check_value['total']< 1) {
			$gallery_query = "insert into " . TABLE_GALLERY_SUPERUSERS . " (id, cID, allowed) values ('','" . (int)$customers_id . "','" . $allowed . "')";
		}
		
		//if ($check_value['total']= 1){
			//$messageStack->add_session(MESSAGE_ADD_EXISTS, 'success');
		if(tep_db_query($gallery_query)){
			$messageStack->add_session(MESSAGE_ADD_SUCCESS, 'success');
		}else{
			$messageStack->add_session(MESSAGE_ADD_ERROR, 'error');
		} 

		tep_redirect(tep_href_link(FILENAME_GALLERY_SUPERUSERS,'','NONSSL'));
	}

  if (tep_not_null($action)) {
    switch ($action) {
      case 'remove':
        $customers_id = tep_db_prepare_input($HTTP_GET_VARS['cID']);
        tep_db_query("delete from " . TABLE_GALLERY_SUPERUSERS . " where cID = '" . (int)$customers_id . "'");
				tep_redirect(tep_href_link(FILENAME_GALLERY_SUPERUSERS,'','NONSSL'));
        break;
        
      default:
        //$customers_query = tep_db_query("select c.customers_id, c.customers_firstname, c.customers_lastname, g.cID, g.allowed 
                                         //from " . TABLE_CUSTOMERS . " c left join " . TABLE_GALLERY_SUPERUSERS . " g 
                                         //on g.cID = c.customers_id ");
        //$customers = tep_db_fetch_array($customers_query);
        //$cInfo = new objectInfo($customers);
    }
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
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
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
            <?php echo tep_draw_form('add_superuser', FILENAME_GALLERY_SUPERUSERS, '', 'get'); ?>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right"><?php echo HEADING_TITLE_ADD . ' ' . $SelectCustomerBox. ' <input type="submit" value="' . BUTTON_SUBMIT . '">'. tep_draw_hidden_field('allowed', 'unlimited'); ?></td>
            <?php echo tep_hide_session_id(); ?></form>
          </tr>
          <tr>
           <td class="smallText" align="left"><?php echo TEXT_INFORMATION; ?> </td>
         </tr>
        </table></td>
      </tr>
      <tr>
				<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
					<tr class="dataTableHeadingRow">
						<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LASTNAME; ?></td>
						<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FIRSTNAME; ?></td>
						<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_ALLOWED; ?></td>
						<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
					</tr>
<?php
    $gallery_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, g.cID, g.allowed from " . TABLE_CUSTOMERS . " c 
                            left join " . TABLE_GALLERY_SUPERUSERS . " g 
                            on c.customers_id = g.cID 
                            where c.customers_id = g.cID
                            order by c.customers_lastname, c.customers_firstname 
                            ";
                            
    $gallery_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $gallery_query_raw, $gallery_query_numrows);
    $gallery_query = tep_db_query($gallery_query_raw);
    while ($gallery = tep_db_fetch_array($gallery_query)) {
      if ($gallery['customers_id']) {
        echo '          <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_GALLERY_SUPERUSERS, 'cID=' . $cInfo->customers_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_GALLERY_SUPERUSERS, 'cID=' . $customers['customers_id']) . '\'">' . "\n";
      }
?>

                <td class="dataTableContent"><?php echo $gallery['customers_lastname']; ?></td>
                <td class="dataTableContent"><?php echo $gallery['customers_firstname']; ?></td>
                <td class="dataTableContent"><?php echo $gallery['allowed']; ?></td>
                <td class="dataTableContent" align="right"><?php 
                  echo '<a href="' . tep_href_link(FILENAME_GALLERY_SUPERUSERS,'cID=' . $gallery['customers_id']. '&action=remove') . '">' . tep_image(DIR_WS_ICONS . 'file_icons/delete.gif', IMAGE_ICON_DELETE) . '</a>'; 
                ?>&nbsp;</td>




              </tr>
<?php
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $gallery_split->display_count($gallery_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $gallery_split->display_links($gallery_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            
            
            
          </tr>
        </table></td>
      </tr>
      
      
      
<?php
  //}
?>
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