<!-- column_top //-->
<?php if(USE_COLUMN_TOP_ACCOUNT == 'true') { ?>
	<table border="0" width="<?php echo BOX_WIDTH_TOP_ACCOUNT; ?>%" cellspacing="3" cellpadding="3" align="<?php echo ACOUNT_TOP_ALIGNMENT; ?>">
  	  <tr><td>
	  <table border="0" width="<?php echo BOX_WIDTH_TOP_ACCOUNT; ?>" cellspacing="0" cellpadding="2" align="<?php echo ACOUNT_TOP_ALIGNMENT; ?>">
		<tr>
          <td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_1)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_1);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_2)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_2);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_3)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_3);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_4)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_4);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_5)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_TOP_BOX_5);
		 } ?>
          </td>
        </tr></table>
	 </td>
   </tr></table>
<?php } ?>
<!-- column_top_eof //-->
	<table border="0" width="100%" cellspacing="3" cellpadding="3">
  	  <tr>
<!-- column_left //-->
	<?php if(USE_COLUMN_LEFT_ACCOUNT == 'true') { ?>
    	<td width="<?php echo BOX_WIDTH_LEFT_ACCOUNT; ?>" valign="top">
	<table border="0" width="<?php echo BOX_WIDTH_LEFT_ACCOUNT; ?>" cellspacing="0" cellpadding="2" align="<?php echo ACOUNT_LEFT_ALIGNMENT; ?>">
		<tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_1)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_1);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_2)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_2);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_3)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_3);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_4)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_4);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_5)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_LEFT_BOX_5);
		 } ?>
           </tr>
         </table></td>
    <?php } ?>
<!-- column_left eof //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_account.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
     <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_NOTES_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="notesBox">
          <tr class="notesBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
    			<td class="main" align="center"><?php echo $notes['customers_notes_frontend'];?></td>
          	 </tr>
        	</table></td>
          </tr>
        </table></td>
 	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('account') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('account'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }

  if (tep_count_customer_orders() > 0) {
?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo OVERVIEW_TITLE; ?></b></td>
            <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '"><u>' . OVERVIEW_SHOW_ALL_ORDERS . '</u></a>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" align="center" valign="top" width="130"><?php echo '<b>' . OVERVIEW_PREVIOUS_ORDERS . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    $orders_query = tep_db_query("select o.orders_id, o.date_purchased, o.delivery_name, o.delivery_country, o.billing_name, o.billing_country, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id desc limit 3");
    while ($orders = tep_db_fetch_array($orders_query)) {
      if (tep_not_null($orders['delivery_name'])) {
        $order_name = $orders['delivery_name'];
        $order_country = $orders['delivery_country'];
      } else {
        $order_name = $orders['billing_name'];
        $order_country = $orders['billing_country'];
      }
?>
                  <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL'); ?>'">
                    <td class="main" width="80"><?php echo tep_date_short($orders['date_purchased']); ?></td>
                    <td class="main"><?php echo '#' . $orders['orders_id']; ?></td>
                    <td class="main"><?php echo tep_output_string_protected($order_name) . ', ' . $order_country; ?></td>
                    <td class="main"><?php echo $orders['orders_status_name']; ?></td>
                    <td class="main" align="right"><?php echo $orders['order_total']; ?></td>
                    <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '">' . tep_image_button('button_small_view.png', IMAGE_BUTTON_SMALL_VIEW) . '</a>'; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
     <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_ACCOUNT_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_personal.gif'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_GALLERY_USER, '', 'SSL') . '">' . MY_GALLERY . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_ORDERS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_orders.gif'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . MY_ORDERS_VIEW . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . MY_WISHLIST . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_RETURNS_TRACK, '', 'SSL') . '">' . MY_RETURNS . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
    if (USE_ACCOUNT_EMAIL_NOTIFICATION == 'true') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo EMAIL_NOTIFICATIONS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_notifications.gif'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
}
    if (USE_ACCOUNT_CUSTOMER_TICKETS_SYSTEM == 'true') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_SUPPORT_TICKETS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_support_tickets.png'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, '', 'SSL') . '">' . MY_SUPPORT_TICKETS . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE, '', 'SSL') . '">' . MY_SUPPORT_TICKETS_CREATE . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_FAQ, '', 'SSL') . '">' . MY_SUPPORT_TICKETS_FAQ . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
}
    if (USE_ACCOUNT_COUPONS == 'true') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_COUPONS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_coupons.png'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_COUPONS, '', 'SSL') . '">' . MY_COUPONS . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
}
    if (USE_ACCOUNT_CREDIT_CLASS_GIFT_VOUCHER == 'true') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo GIFT_VOUCHER_COUPON; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_credits.png'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
  				  <?php
  				    if (tep_session_is_registered('customer_id')) {
    				  $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    				  $gv_result = tep_db_fetch_array($gv_query);
    				  if ($gv_result['amount'] > 0 ) {
				  ?>
			      <tr>
				    <td class="main" align="center"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrow_round_right9.png') ?> <?php echo CCGV_BALANCE .'' ?><?php echo $currencies->format($gv_result['amount']); ?></td>
			      </tr>
				  <?php
					  }
  				    }
				  ?>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_GV_SEND, '', 'SSL') . '">' . CCGV_SENDVOUCHER . '</a>'; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') ?> <?php echo BUY_COUPON .'' ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php 	
    if (USE_ACCOUNT_POINT_REWARD == 'true') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_POINTS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_points.png'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $has_points = tep_get_shopping_points($customer_id);
  if ($has_points > 0) {
?>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') .'&nbsp;&nbsp;'.  sprintf(MY_POINTS_CURRENT_BALANCE, number_format($has_points,POINTS_DECIMAL_PLACES),$currencies->format(tep_calc_shopping_pvalue($has_points))); ?></td>
                  </tr>
<?php
  }
?>
                  <tr>
                    <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'icons/arrows/arrow_orange.png') . ' <a href="' . tep_href_link(FILENAME_ACCOUNT_POINTS, '', 'SSL') . '">' . MY_POINTS_VIEW . '</a>'; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php 
  }
?>
<?php 	
	}
    if (USE_ACCOUNT_LOYALTY_DISCOUNT == 'true') {
// Display Loyalty discount for customer plus the table and his current place in it.
if ($sppc_customer_group_id == 0) { 
include (DIR_WS_MODULES.'order_total/ot_loyalty_discount.php');
$loyalty = new ot_loyalty_discount;
$cust_tot_order_amount = $loyalty->get_cum_order_total();
$table_cost = split("[:,]" , MODULE_LOYALTY_DISCOUNT_TABLE);
$discount_perc = 0;

for ($i = 0; $i < count($table_cost); $i+=2) {
if ($cust_tot_order_amount >= $table_cost[$i]) {
$discount_perc = $table_cost[$i+1];
}
}

if ($cust_tot_order_amount > 0) {
$order_hist_text = TEXT_ORDER_AMOUNT . MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD . TEXT_TOTALS . $currencies->display_price($cust_tot_order_amount,0) . TEXT_THEREFORE . $discount_perc . TEXT_NEXT_PURCHASE;
} else {
$order_hist_text = TEXT_NO_DISCOUNT;
}

$order_hist_text .= '<br>' . TEXT_TABLES . MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD . ':<br><br>';
$order_hist_text .= '<table>';
$order_hist_text .= '<tr><td align="right" class="main">' . TEXT_AMOUNT . '</td>
<td width="100" align="center">&nbsp</td>
<td class="main">' . TEXT_PERCENTAGE . '</td>
<td align="right" width="10px">&nbsp;</td>
<td align="center" class="main">' . TEXT_TO_GO . '</td>
</tr>';

for ($i = 0; $i < count($table_cost); $i+=2) {
if ($discount_perc >= $table_cost[$i+1]) {
$order_hist_text .= '<tr><td align="right" class="main">' . $currencies->display_price($table_cost[$i]) . '</td>
<td width="100" align="center"><img src="images/icons/arrows/checkmark.gif" alt="' . TEXT_DISCOUNT . '" title="' . TEXT_DISCOUNT . '"></td>
<td class="main">' . $table_cost[$i+1] . '%</td>
<td align="right" width="10px">&nbsp;</td>
<td align="right">&nbsp;</td>
</tr>';
} else {
$order_hist_text .= '<tr><td align="right" class="main">' . $currencies->display_price($table_cost[$i]) . '</td>
<td align="center"><img src="images/icons/arrows/arrow_orange.png" alt="' . TEXT_PO_DISCOUNT . '" title="' . TEXT_PO_DISCOUNT . '"></td>
<td class="main">' . $table_cost[$i+1] . '%</td>
<td align="right" width="10px">&nbsp;</td>
<td align="right" class="main">' . $currencies->display_price($table_cost[$i]-$cust_tot_order_amount) . '</td>
</tr>';
}
}
$order_hist_text .= '</table>';
?>
	 <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MY_DISCOUNTS_TITLE; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td width="60" valign="top"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/account_loyalty.png'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo $order_hist_text; ?></td>
                  </tr>
                </table></td>
                <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
<!-- End display Loyalty discount for customer plus the table and his current place in it. -->
<?php
; }
}
?>
      </tr>
    </table></td>
<!-- column_right //-->
<?php if(USE_COLUMN_RIGHT_ACCOUNT == 'true') { ?>
   <td width="<?php echo BOX_WIDTH_RIGHT_ACCOUNT; ?>" valign="top">
	<table border="0" width="<?php echo BOX_WIDTH_RIGHT_ACCOUNT; ?>" cellspacing="0" cellpadding="2" align="<?php echo ACOUNT_RIGHT_ALIGNMENT; ?>">
		<tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_1)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_1);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_2)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_2);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_3)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_3);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_4)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_4);
		 } ?></tr><tr><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_5)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_RIGHT_BOX_5);
		 } ?>
       </tr>
     </table></td>
<?php } ?>
<!-- column_right eof //-->
    </tr>
  </table>
<!-- column_bot //-->
<?php if(USE_COLUMN_BOT_ACCOUNT == 'true') { ?>
	<table border="0" width="<?php echo BOX_WIDTH_BOT_ACCOUNT; ?>" cellspacing="0" cellpadding="2" align="<?php echo ACOUNT_BOT_ALIGNMENT; ?>">
	 <tr><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_1)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_1);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_2)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_2);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_3)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_3);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_4)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_4);
		 } ?></td><td><?php
		 if (file_exists(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_5)) {
			 include(DIR_WS_COLUMNS_BOXES . ACCOUNT_BOT_BOX_5);
		 } ?>
     </td></tr>
   </table>
    <?php } ?>
<!-- column_bot_eof //-->
