<table border="0" width="100%" cellspacing="2" cellpadding="2" class="indexBody">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top">
	
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="531" height="280" valign="middle"><table width="515"  border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="2"></td>
            </tr>
<?php
  $my_account_query = tep_db_query ("select a.admin_id, a.admin_firstname, a.admin_lastname, a.admin_email_address, a.admin_created, a.admin_modified, a.admin_logdate, a.admin_lognum, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id= " . $login_id . " and g.admin_groups_id= " . $login_groups_id . "");
  $myAccount = tep_db_fetch_array($my_account_query);
// onliners
if(DISPLAY_MOST_ONLINE_INDEX_PAGE == 'true') {
$oSql = 'SELECT count(id) FROM online;' ;
$onliners = tep_db_query($oSql);

$nowonline = mysql_result($onliners, 0);

$oSql = 'SELECT * FROM mostonline WHERE id=1;';
$monliners = tep_db_query($oSql);
if (!$monliners ){
 $oldMost='';}
else{
 $record=tep_db_fetch_array($monliners);
 $oldMost = $record['mostonline'];
 $sinds = $record['sinds'];
 $total= $record['totalonline'];}

if ($oldMost==''){
	$oSql='INSERT INTO mostonline (id,sinds, mostonline, totalonline) VALUES (1,"'.date('d-m-Y').'",'.$nowonline.',1);';

	$succes = tep_db_query($oSql);
	$mostonline = '1';
	$sinds = date('d-m-Y') ;}
else{
	if ($nowonline > $oldMost) {
	$oSql='UPDATE mostonline SET mostonline='.$nowonline.' WHERE id=1;';
	$succes = tep_db_query($oSql);
	$mostonline = $nowonline;}
	else $mostonline = $oldMost;}

if ($addOne=='1'){
	$oSql='UPDATE mostonline SET totalonline='.($total+1).' WHERE id=1;';
	$succes = tep_db_query($oSql);
	$totalonline = $total+1;}
else 	$totalonline = $total;

  $counter_query = tep_db_query("select startdate, counter from " . TABLE_COUNTER);

  if (!tep_db_num_rows($counter_query)) {
    $date_now = date('Ymd');
    tep_db_query("insert into " . TABLE_COUNTER . " (startdate, counter) values ('" . $date_now . "', '1')");
    $counter_startdate = $date_now;
    $counter_now = 1;
  } else {
    $counter = tep_db_fetch_array($counter_query);
    $counter_startdate = $counter['startdate'];
    $counter_now = ($counter['counter'] + 1);
    tep_db_query("update " . TABLE_COUNTER . " set counter = '" . $counter_now . "'");
  }

  $counter_startdate_formatted = strftime(DATE_FORMAT_LONG, mktime(0, 0, 0, substr($counter_startdate, 4, 2), substr($counter_startdate, -2), substr($counter_startdate, 0, 4)));
// onliners_eof
} ?>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
<?php if(DISPLAY_OSSHOPPY_LOGO_INDEX_PAGE == 'true') { ?>
              <td align="center" valign="top"><img src="templates/<?php echo ADMIN_TEMPLATE?>/images/adm_pic.png" alt="Admin" width="100" height="100" hspace="10"></td>
<?php } ?>
              <td rowspan="5"><span class="headerInfo"><?php echo WELCOME_BACK; ?> <?php echo $myAccount['admin_firstname'] . ' ' . $myAccount['admin_lastname']; ?></span><br>
                <span class="login"><?php echo TEXT_INFO_LOGDATE; ?><?php echo $myAccount['admin_logdate']; ?></span><br>
                <span class="login"><?php echo TEXT_INFO_GROUP; ?><?php echo $myAccount['admin_groups_name']; ?></span>
                <div class="text2"  style="padding:15px;">
                  <?php
			
  $customers_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS);
  $customers = tep_db_fetch_array($customers_query);
  
  $products_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS . " where products_status = '1'");
  $products = tep_db_fetch_array($products_query);
  
  $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS);
  $reviews = tep_db_fetch_array($reviews_query);

if(DISPLAY_SHOP_STATS_INDEX_PAGE == 'true') {
  echo  TEXT5 . ' ' . $customers['count'] . ' ' . TEXT6 . ' ' . $products['count'] . ' ' . TEXT7 . ' ' . $reviews['count']. ' ' . TEXT8;
  ?><hr style="color:#E3E3E3" size="1"><?php
}

  if ($HTTP_GET_VARS['page'] > 1) $rows = $HTTP_GET_VARS['page'] * 20 - 20;
  $products_query_raw = "select p.products_id, p.products_quantity, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . $languages_id. "' and p.products_quantity <= " . STOCK_REORDER_LEVEL . " group by pd.products_id order by pd.products_name ASC";
 
  $products_query = tep_db_query($products_query_raw);
  while ($products = tep_db_fetch_array($products_query)) {
    $rows++;
	}
	?>
                  <?php

// order summary
if(DISPLAY_ORDERS_SUMMARY_INDEX_PAGE == 'true') {
  $orders_contents = ''; 
  $orders_status_query = tep_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_query = tep_db_query("select count(*) as qty from " . TABLE_ORDERS . " where orders_status = '" . (int)$orders_status['orders_status_id'] . "'");
    $orders_row = tep_db_fetch_array($orders_query);
    $orders_contents .= '<a class="text2" href="' . tep_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . (int)$orders_status['orders_status_id']) . '">' . tep_db_prepare_input($orders_status['orders_status_name']) . '</a>: ' . number_format($orders_row['qty']) . ',<br>';
  }
  $orders_contents = substr($orders_contents, 0, -2);
  $query_new = tep_db_query("select count(*) as qty from " . TABLE_ORDERS . " where to_days(date_purchased) = to_days(now()) "); $line_new = tep_db_fetch_array($query_new);
  echo '' . sprintf(TEXT_SUMMARY_INFO_ORDERS, $orders_contents, number_format($line_new['qty'])) . '<br><hr  style="color:#E3E3E3" size="1">';
}
// order total summary
if(DISPLAY_ORDERS_TOTAL_SUMMARY_INDEX_PAGE == 'true') {
  $orders_contents_total = '';
  if(!is_object($currencies)){include_once(DIR_WS_CLASSES . 'currencies.php'); $currencies = new currencies();}
  $orders_status_query = tep_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    unset($oTot, $temp);
    $orders_query = tep_db_query("select o.currency, sum(ot.value) as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id) where o.orders_status = '" . (int)$orders_status['orders_status_id'] . "' and ot.class = 'ot_total' group by 1 order by 1");
    while($row = tep_db_fetch_array($orders_query)){$oTot[$row['currency']] += $row['order_total'];}
    if(is_array($oTot)){
      foreach($oTot as $key => $value){$temp .= $currencies->format($value, false, $key) . ',';}
      $temp = '' . substr($temp, 0, -1) . '';
    }else{
      $temp = '' . $currencies->format(0, false) . '';
    }
    $orders_contents_total .= '<a class="text2" href="' . tep_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . (int)$orders_status['orders_status_id']) . '">' . tep_db_prepare_input($orders_status['orders_status_name']) . '</a>: ' . $temp . ',<br>';
  }
  $orders_contents_total = substr($orders_contents_total, 0, -2);
  
  $orders_query = tep_db_query("select o.currency, sum(ot.value) as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id) where to_days(o.date_purchased) = to_days(now()) and ot.class = 'ot_total' group by 1 order by 1");
  unset($oTot, $temp); while($row = tep_db_fetch_array($orders_query)){$oTot[$row['currency']] += $row['order_total'];}
  if(is_array($oTot)){
    foreach($oTot as $key => $value){$temp .= $currencies->format($value, false, $key) . ',';}
    $temp = '' . substr($temp, 0, -1) . '';
  }else{
    $temp = '' . $currencies->format(0, false) . '';
  }
  echo '' . sprintf(TEXT_SUMMARY_INFO_ORDERS_TOTAL, $orders_contents_total, $temp) . '<br><hr  style="color:#E3E3E3" size="1">';
}
?>
                  <?php if(DISPLAY_STOCK_WARNING_INDEX_PAGE == 'true') {
   if ($rows != 0){?>
                  <?php echo STOCK_TEXT_WARNING1 ?><?php echo $rows; ?> <?php echo STOCK_TEXT_WARNING2 ?> "<a class="text2" href="<?php echo tep_href_link(FILENAME_STATS_LOW_STOCK, 'selected_box=reports')?>"><?php echo BOX_REPORTS_STOCK_LOW_STOCK ?></a>" <?php echo STOCK_TEXT_WARNING3 ?>
                  <?php  } ?>
                  <?php
 if ($rows == 0){?>
                  <?php echo STOCK_TEXT_OK1 ?> "<a class="text2" href="<?php echo tep_href_link(FILENAME_STATS_LOW_STOCK, 'selected_box=reports')?>"><?php echo BOX_REPORTS_STOCK_LOW_STOCK ?></a>" <?php echo STOCK_TEXT_OK2 ?>
                  <?php  } ?>
                  <?php } ?>
                  <br>
                </div></td>
            </tr>
            <tr>
<?php if(DISPLAY_MOST_ONLINE_INDEX_PAGE == 'true') { ?>
              <td width="197" class="login" valign="top" align="center"><b><?php echo TITLE_ONLINE ?></b><?php echo GUEST_ONLINE.' <b>'.$nowonline.'</b>' ?><br><?php echo MOST_ONLINE.' <b>'.$mostonline.'</b>' ?><br><?php echo '<b>'.$totalonline.'</b> '.VISITS_SINCE.' <b>'.$sinds.'</b>' ?><br><?php echo PAGEVIEWS. ' <b>'.$counter_now. '</b>' ?><br><br><br></td>
<?php } ?>
              </tr>
            <tr>
              <td class="login" valign="top" align="center">
<?php if(DISPLAY_SUPPORT_TICKETS_INDEX_PAGE == 'true') {
              $ticket_contents = '';
  $ticket_status_query = tep_db_query("select ticket_status_name, ticket_status_id from " . TABLE_TICKET_STATUS . " where ticket_language_id = '" . $languages_id . "'");
  while ($ticket_status = tep_db_fetch_array($ticket_status_query)) {
    $ticket_ticket_query = tep_db_query("select count(*) as count from " . TABLE_TICKET_TICKET . " where ticket_status_id = '" . $ticket_status['ticket_status_id'] . "'");
    $ticket_ticket = tep_db_fetch_array($ticket_ticket_query);
      $ticket_contents .= '<a href="' . tep_href_link(FILENAME_TICKET_VIEW, 'selected_box=ticket&status=' . $ticket_status['ticket_status_id']) . '">' . $ticket_status['ticket_status_name'] . '</a>: ' . $ticket_ticket['count'] . '<br>';
    }
    $ticket_contents = substr($ticket_contents, 0, -4);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_TITLE_TICKET);
                     
  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => $ticket_contents);
$box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';
}?>
			   </td>
            </tr>
            <tr>
              <td class="login" valign="top" align="center">&nbsp;</td>
            </tr>
          </table></td>
          <td width="446"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php if(DISPLAY_BEST_VIEWED_PRODUCTS_INDEX_PAGE == 'true') { ?>
            <tr>
              <td valign="top"><table width="428" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="headerViewed"><table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td class="headerViewedText"><?php echo HEADING_TITLE2; ?></td>
                      <td width="100" align="center"class="headerViewedText"><?php echo TABLE_HEADING_VIEWED2; ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="contentViewed"><table width="90%" border="0" align="center" cellpadding="4" cellspacing="0" class="text">
                    <?php
  if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $rows = 0;
  $products_query_raw = "select p.products_id, pd.products_name, pd.products_viewed, l.name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_LANGUAGES . " l where p.products_id = pd.products_id and l.languages_id = pd.language_id order by pd.products_viewed DESC";
  $products_split = new splitPageResults($HTTP_GET_VARS['page'], 10, $products_query_raw, $products_query_numrows);
  $products_query = tep_db_query($products_query_raw);
  while ($products = tep_db_fetch_array($products_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
?>
                    <tr onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL'); ?>'">
                      <td style="border-bottom:solid 1px; border-color:#e3e3e3;"  class="dataTableContent"><?php echo $rows; ?>.</td>
                      <td style="border-bottom:solid 1px; border-color: #e3e3e3;"  class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL') . '">' . $products['products_name'] . '</a> (' . $products['name'] . ')'; ?></td>
                      <td style="border-bottom:solid 1px; border-color:#e3e3e3;" class="dataTableContent" align="center"><?php echo $products['products_viewed']; ?>&nbsp;</td>
                    </tr>
                    <?php
  }
?>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <hr style="color:#E3E3E3" width="428" align="left" size="1">
<?php } ?>
<?php
$qtpro_sick_count = qtpro_sick_product_count();
if($qtpro_sick_count != 0){
?>
<table border="0" width="428">
	<tr>
      <td width="428" align="center" class="messageStackWarning">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/warning.gif', ICON_WARNING) ?>&nbsp;<?php echo TEXT_QTPRO_FIRST . $qtpro_sick_count . TEXT_QTPRO_SECOND . ' <a href="' . tep_href_link(FILENAME_QTPRODOCTOR) . '">' . TEXT_CLICK .'</a>.'; ?></td>
    </tr>
</table>
          <hr style="color:#E3E3E3" width="428" align="left" size="1">
<?php
}
?>
<table width="428" border="0">
	  <td width="428" align="center" valign="bottom"><?php
// BOF-A: Admin Notes ---//Step-1(1)\\---
	$admin_notes_query = tep_db_query("select last_update from " . TABLE_ADMIN_LOW_NOTES);
	$admin_notes = tep_db_num_rows($admin_notes_query);
    while ($admin_notes = tep_db_fetch_array($admin_notes_query)) {

	  $today_time = time();
	  $notes_time = ($today_time - strtotime($admin_notes['last_update']) );

      if (($admin_notes['last_update'] > 0) && ($notes_time > 1)) {
        $messageStack->add(WARNING_ADMIN_LOW_NOTES_TIME, 'warning');
      }
    }
	$admin_notes_query = tep_db_query("select last_update from " . TABLE_ADMIN_MID_NOTES);
	$admin_notes = tep_db_num_rows($admin_notes_query);
    while ($admin_notes = tep_db_fetch_array($admin_notes_query)) {

	  $today_time = time();
	  $notes_time = ($today_time - strtotime($admin_notes['last_update']) );

      if (($admin_notes['last_update'] > 0) && ($notes_time > 1)) {
        $messageStack->add(WARNING_ADMIN_MID_NOTES_TIME, 'warning');
      }
    }
	$admin_notes_query = tep_db_query("select last_update from " . TABLE_ADMIN_TOP_NOTES);
	$admin_notes = tep_db_num_rows($admin_notes_query);
    while ($admin_notes = tep_db_fetch_array($admin_notes_query)) {

	  $today_time = time();
	  $notes_time = ($today_time - strtotime($admin_notes['last_update']) );

      if (($admin_notes['last_update'] > 0) && ($notes_time > 1)) {
        $messageStack->add(WARNING_ADMIN_TOP_NOTES_TIME, 'warning');
      }
    }
// EOF-A: Admin Notes ---//Step-1(1)\\---

if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
?>
		 </td>
      </table>
<?php if(DISPLAY_QUICK_CATALOG_LINKS_INDEX_PAGE == 'true') { ?>
          <hr style="color:#E3E3E3" width="428" align="left" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CATEGORIES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_PRODUCT_ATTRIBUTES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_GET_1_FREE) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_GET_1_FREE) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_2GETHER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_2GETHER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_GIFT_ADD) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_GIFT_ADD) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_OPTIONAL_RELATED_PRODUCTS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_OPTIONAL_RELATED_PRODUCTS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_SPECIALS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_FEATURED) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_FEATURED) . '</a>'; ?></td> 
            </table>
<?php }
		if(DISPLAY_QUICK_CUSTOMERS_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="left" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CUSTOMERS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CREATE_ACCOUNT) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_ORDERS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ORDER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CREATE_ORDER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_QUOTES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_QUOTES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;'; ?></td> 
            </table>
<?php }
		if(DISPLAY_QUICK_TEMPLATE_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="left" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=30', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_HEADER_FOOTER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=34', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_INDEX_DEFAULT) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=33', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_PRODUCT_INFO) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=37', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_INFOBOX_GENERAL) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_INFOBOX_ON_OFF) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=39', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_EDIT_IMAGES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_BANNER_MANAGER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_BANNER_MANAGER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
            </table>
<?php }
		if(DISPLAY_QUICK_MODULE_MANAGER_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="left" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_HEADER_TAGS_SEO) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_headertags.png', INDEX_ICON_HEAD_TAGS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ARTICLES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_newsflash.png', INDEX_ICON_ARTICLES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_POLLS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_polls.png', INDEX_ICON_ENQUETES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_testimonial.png', INDEX_ICON_TESTIMONIALS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_GALLERY) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_gallery.png', INDEX_ICON_GALLERY) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_links.png', INDEX_ICON_LINKS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_DOCUMENTS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_DOCUMENTS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_FAQ_MANAGER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_FAQ_MANAGER) . '</a>'; ?></td> 
            </table>
<?php }
		if(DISPLAY_QUICK_STOCK_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="left" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_STOCK_ACTIVE) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_inventaireactif.png', INDEX_ICON_ACTIF) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_STOCK_INACTIVE) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_inventaireinactif.png', INDEX_ICON_INACTIF) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_lowstockattrib.png', INDEX_ICON_LOWSTOCK) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK_ATTRIB) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_lowstockattrib.png', INDEX_ICON_LOWSTOCK_ATTRIB) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_QTPRODOCTOR) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_QTPRODOC) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_productupdates.png', INDEX_ICON_PRODUCT_UPD) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_PRODUCT_MULTI) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
            </table>
<?php } ?>
		 </td>
        </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
	</table>
</table>