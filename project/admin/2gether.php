<?php //$Id: /catalog/admin/2gether.php (3929)

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'setflag':
        tep_set_together_status($HTTP_GET_VARS['tid'], $HTTP_GET_VARS['flag']);
        tep_redirect(tep_href_link(FILENAME_2GETHER, (isset($HTTP_GET_VARS['page']) ? 'page=' . $HTTP_GET_VARS['page'] . '&' : '') . 'tID=' . $HTTP_GET_VARS['tid'], 'NONSSL'));
        break;
      case 'insert':
        $product1_id = tep_db_prepare_input($HTTP_POST_VARS['product1_id']);
        $product2_id = tep_db_prepare_input($HTTP_POST_VARS['product2_id']);
        if ($product1_id != $product2_id) {
          $discount = tep_db_prepare_input($HTTP_POST_VARS['discount']);
          if ($discount == '') $discount = 0;
          $type = tep_db_prepare_input($HTTP_POST_VARS['type']);
          tep_db_query("insert into " . TABLE_2GETHER . " (product_1_id, product_2_id, discount, type, status) values ('" . (int)$product1_id . "', '" . (int)$product2_id . "', $discount, '" . $type . "', '0')");
        }
        tep_redirect(tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page']));
        break;
      case 'update':
        $tid = tep_db_prepare_input($HTTP_POST_VARS['tid']);
        $discount = tep_db_prepare_input($HTTP_POST_VARS['discount']);
        $type = tep_db_prepare_input($HTTP_POST_VARS['type']);
        tep_db_query("update " . TABLE_2GETHER . " set discount = '" . tep_db_input($discount) . "', type = '" . tep_db_input($type) . "' where tid = '" . (int)$tid . "'");
        tep_redirect(tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tid));
        break;
      case 'deleteconfirm':
        $tid = tep_db_prepare_input($HTTP_GET_VARS['tID']);
        tep_db_query("delete from " . TABLE_2GETHER . " where tid = '" . (int)$tid . "'");
        tep_redirect(tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page']));
        break;
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
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/calendar.css">
<script language="JavaScript" src="includes/javascript/calendarcode.js"></script>
<?php
  }
?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<div id="popupcalendar" class="text"></div>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
    </table></td>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
    $form_action = 'insert';
    if ( ($action == 'edit') && isset($HTTP_GET_VARS['tID']) ) {
      $form_action = 'update';
      $together_query = tep_db_query("select tid,
                                product_1_id as product1_id, 
                                product_2_id as product2_id, 
                                discount, 
                                type, 
                                status 
                         from " . TABLE_2GETHER . "
                         where tid = '" . (int)$HTTP_GET_VARS['tID'] . "'");

      $together = tep_db_fetch_array($together_query);

      $tInfo = new objectInfo($together);
    } else {
      $tInfo = new objectInfo(array());

      $excludes_array1 = array();
      $exclude_query1 = tep_db_query("select product_1_id from " . TABLE_2GETHER);
      while ($excludes1 = tep_db_fetch_array($exclude_query1)) {
        $excludes_array1[] = $excludes1['product_1_id'];
      }
      $excludes_array2 = array();
      $exclude_query2 = tep_db_query("select product_2_id from " . TABLE_2GETHER);
      while ($excludes2 = tep_db_fetch_array($exclude_query2)) {
        $excludes_array2[] = $excludes2['product_2_id'];
      }

      $excludes_array = array_merge($excludes_array1,$excludes_array2);
    }
?>
      <tr>
        <form name="new_together" <?php echo 'action="' . tep_href_link(FILENAME_2GETHER, tep_get_all_get_params(array('action', 'info', 'tID')) . 'action=' . $form_action, 'NONSSL') . '"'; ?> method="post"><?php if ($form_action == 'update') echo tep_draw_hidden_field('tid', $HTTP_GET_VARS['tID']); ?>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo (isset($tInfo->product1_id)) ? $tInfo->product1_id : tep_draw_products_pull_down('product1_id', 'style="font-size:10px"' /*, $excludes_array*/); ?></td>
            <td class="main"><?php echo (isset($tInfo->product2_id)) ? $tInfo->product2_id : tep_draw_products_pull_down('product2_id', 'style="font-size:10px"'/*, $excludes_array*/); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo (isset($tInfo->product1_id)) ? tep_get_products_name($tInfo->product1_id) : ''; ?></td>
            <td class="main"><?php echo (isset($tInfo->product2_id)) ? tep_get_products_name($tInfo->product2_id) : ''; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo (isset($tInfo->product1_id)) ? tep_info_image(tep_get_products_image($tInfo->product1_id)) : ''; ?></td>
            <td class="main"><?php echo (isset($tInfo->product2_id)) ? tep_info_image(tep_get_products_image($tInfo->product2_id)) : ''; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo 'Discount: '; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_input_field('discount', (isset($tInfo->discount) ? $tInfo->discount : '')); ?></td>
          </tr>
<?php
$type_array[] = array('id'=>'p','text'=>'Percentage');
$type_array[] = array('id'=>'m','text'=>'Money');
?>
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo 'Type: '; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_pull_down_menu('type', $type_array, $tInfo->type); ?></td>
          </tr>
<?php
if ($form_action == 'update') {
  $price1 =  tep_get_products_price($tInfo->product1_id);
  $price2 =  tep_get_products_price($tInfo->product2_id);

  if ($tInfo->type == 'p') {
    $saving = ($price1+$price2)*($tInfo->discount/100);
    $together_price = ($price1+$price2)-$saving;
  } else {
    $saving = $tInfo->discount;
    $together_price = $price1+$price2-$saving;
  }
?>
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo 'Together:'; ?>&nbsp;</td>
            <td class="main"><?php echo $currencies->format($together_price); ?>&nbsp;</td>
          </tr>
          <tr>
            <td class="main"><?php echo ''; ?>&nbsp;</td>
            <td class="main"><?php echo 'You Save:'; ?>&nbsp;</td>
            <td class="main"><?php echo $currencies->format($saving); ?>&nbsp;</td>
          </tr>
<?php 
}
?>
        </table></td>
      </tr>
      <tr>
        <td>
         <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="right" valign="top"><br><?php echo (($form_action == 'insert') ? tep_image_submit('button_insert.png', IMAGE_INSERT) : tep_image_submit('button_update.png', IMAGE_UPDATE)). '&nbsp;&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . (isset($HTTP_GET_VARS['tID']) ? '&tID=' . $HTTP_GET_VARS['tID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table>
        </td>
      </form>
     </tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo 'Product 1'; ?></td>
                <td class="dataTableHeadingContent"><?php echo 'Product 2'; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo 'Discount'; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo 'Type'; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $together_query_raw = "select tid,
                                  product_1_id as product1_id, 
                                  product_2_id as product2_id, 
                                  discount, 
                                  type, 
                                  status 
                           from " . TABLE_2GETHER;
    $together_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $together_query_raw, $together_query_numrows);
    $together_query = tep_db_query($together_query_raw);
    while ($together = tep_db_fetch_array($together_query)) {
      if ((!isset($HTTP_GET_VARS['tID']) || (isset($HTTP_GET_VARS['tID']) && ($HTTP_GET_VARS['tID'] == $together['tid']))) && !isset($tInfo)) {
        $tInfo = new objectInfo($together);
      }

      if (isset($tInfo) && is_object($tInfo) && ($together['tid'] == $tInfo->tid)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->tid . '&action=edit') . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $together['tid']) . '\'">' . "\n";
      }
?>
                <td  class="dataTableContent"><?php echo $together['product1_id'].'-'.tep_get_products_name($together['product1_id']); ?></td>
                <td  class="dataTableContent"><?php echo $together['product2_id'].'-'.tep_get_products_name($together['product2_id']); ?></td>
<?php if ($together['type'] == 'p') { ?>
                <td  class="dataTableContent" align="right"><?php echo $together['discount'].'%'; ?></td>
<?php } else { ?>
                <td  class="dataTableContent" align="right"><?php echo $currencies->format($together['discount']); ?></td>
<?php } ?>
                <td  class="dataTableContent" align="right"><?php echo $together['type']; ?></td>
                <td  class="dataTableContent" align="right">
<?php
      if ($together['status'] == '1') {
        echo tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_2GETHER, 'action=setflag&flag=0&tid=' . $together['tid'].'&page=' . $HTTP_GET_VARS['page'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_2GETHER, 'action=setflag&flag=1&tid=' . $together['tid'].'&page=' . $HTTP_GET_VARS['page'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
                <td class="dataTableContent" align="right"><?php if (isset($tInfo) && is_object($tInfo) && ($together['tid'] == $tInfo->tid)) { echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $together['tid']) . '">' . tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
      </tr>
<?php
    }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $together_split->display_count($together_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
                    <td class="smallText" align="right"><?php echo $together_split->display_links($together_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="6" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&action=new') . '">' . tep_image_button('button_new_product.png', IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
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

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SPECIALS . '</b>');

      $contents = array('form' => tep_draw_form('together', FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->tid . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $tInfo->products1_id . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.png', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->tid) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($tInfo)) {
        $price1 =  tep_get_products_price($tInfo->product1_id);
        $price2 =  tep_get_products_price($tInfo->product2_id);

        $heading[] = array('text' => '<b>' . $tInfo->product1_id . '</b>');
        $contents[] = array('text' => '' . tep_info_image(tep_get_products_image($tInfo->product1_id)));
        $contents[] = array('text' => tep_get_products_name($tInfo->product1_id));
        $contents[] = array('text' => $currencies->format($price1));

        $contents[] = array('text' => '' . tep_info_image(tep_get_products_image($tInfo->product2_id)));
        $contents[] = array('text' => tep_get_products_name($tInfo->product2_id));
        $contents[] = array('text' => $currencies->format($price2));

        if ($tInfo->type == 'p') {
          $saving = ($price1+$price2)*($tInfo->discount/100);
          $together_price = ($price1+$price2)-$saving;
          $contents[] = array('text' => 'Discount: <b>' . $tInfo->discount . '%</b>');
          $contents[] = array('text' => 'Type: <b>Percentage</b>');
        } else {
          $saving = $tInfo->discount;
          $together_price = $price1+$price2-$saving;
          $contents[] = array('text' => 'Discount: <b>' . $currencies->format($tInfo->discount) . '%</b>');
          $contents[] = array('text' => 'Type: <b>Money</b>');
        }
        if ($tInfo->status == 1) {
          $contents[] = array('text' => 'Status: <b>Active</b>');
        } else {
          $contents[] = array('text' => 'Status: <b>InActive</b>');
        }
        $contents[] = array('text' => 'Together: ' .$currencies->format($together_price));
        $contents[] = array('text' => 'You Save: ' .$currencies->format($saving));



        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->tid . '&action=edit') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_2GETHER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->tid . '&action=delete') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>');
      }
      break;
  }
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
}
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
