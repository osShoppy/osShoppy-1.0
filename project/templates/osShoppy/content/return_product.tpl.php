    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
			<?php } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">

	<tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '15', '15'); ?></td>
	</tr>
<?php
if ($HTTP_GET_VARS['action'] == 'sent'){
           $text_query = tep_db_query("SELECT * FROM " . TABLE_RETURNS_TEXT . " where return_text_id = '1' and language_id = '" . $languages_id . "'");
           $text = tep_db_fetch_array($text_query);

        //   tep_db_query("INSERT into " . TABLE_RETURN_PAYMENTS . " values ('', '" . $HTTP_GET_VARS['id'] . "', '', '', '', '', '')");
             ?>
          <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php new infoBox(array(array('text' => '<center><font color=cc0000 size=3px><b>' . TEXT_YOUR_RMA_NUMBER . $HTTP_GET_VARS['rma_value'] . '</b></font></center>'))); ?></td>
          </tr>
           <tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '20', '20'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php new infoBox(array(array('text' => nl2br($text['return_text_one'])))); ?></td>
          </tr>

         <tr>
            <td align="right" vlaign=bottom><br><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
         </tr>
        </table></td>
      </tr>


          <?
} else// if ($HTTP_GET_VARS['action'] == 'new')
{
         $account_query = tep_db_query("SELECT customers_firstname, customers_lastname, customers_email_address FROM " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
         $account = tep_db_fetch_array($account_query);
         // query the order table, to get all the product details
         $returned_products_query = tep_db_query("SELECT * FROM " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_ORDERS . " o where o.orders_id = op.orders_id and op.orders_id = '" . $HTTP_GET_VARS['order_id'] . "' and products_id = '" . $HTTP_GET_VARS['products_id'] . "'");
         $returned_products = tep_db_fetch_array($returned_products_query);
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><form name="longsubmit" action="return_product.php?action=insert&oID=<? echo $HTTP_GET_VARS['order_id'] . '&products_id=' . $HTTP_GET_VARS['products_id']; ?>" method=post>
        <td><table border="0" cellspacing="0" cellpadding="2" width=100%>
             <?
                  if (isset($error)=='yes') {
                   ?> <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><? echo TEXT_ERROR; ?></b></td>
              </tr>

           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
         <?
    echo '              <tr>' . "\n" .
         '                <td class="main" align="left" width="100%">'. TEXT_ERROR_QUANTITY .'</td>' . "\n" .

         '              </tr>' . "\n";

           ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
          </tr>
              <?
              }
            ?>

            <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" colspan="2"><b><?php echo TEXT_SUPPORT_RETURN_HEADING; ?></small></b></td>
          </tr>

        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="30%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TEXT_SUPPORT_PRODUCT_RETURN; ?></b><BR></td>
              </tr>



            </table></td>
            <td width="70%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
                  <tr>
                    <td class="main" colspan="2"><b>Qty</b></td>

                    <td class="smallText" align="right"><b><?php echo HEADING_PRODUCTS; ?></b></td>
                    <td class="smallText" align="right"><b><?php echo HEADING_TOTAL; ?></b></td>
                  </tr>
<?php
  } else {
?>
                  <tr>
                    <td class="main">&nbsp;</td>
                    <td class="main" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo HEADING_PRODUCTS; ?></b></td>
                  </tr>
<?php
  }

//  $ordered_product_query = tep_db_query("SELECT * FROM " . TABLE_ORDERS_PRODUCTS . " where order_id = '" . $HTTP_GET_VARS


    echo '          <tr>' . "\n" .
         '            <td class="main" align="right" valign="top" width="30">' . tep_draw_input_field('returns_quantity', $returned_products['products_quantity'], 'size=5') . '</td>' . "\n" .
         '            <td class="main" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;' . $returned_products['products_name'];


echo '</td>' . "\n";
echo '            <td class="main" align="right" valign="top">' . $currencies->format(($returned_products['products_price'] + (tep_calculate_tax(($returned_products['products_price']),($returned_products['products_tax'])))) * ($returned_products['products_quantity'])) . '</td>' . "\n" .
         '          </tr>' . "\n";

?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>


        <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
          </tr>
              <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TEXT_SUPPORT_BILLING_ADDRESS; ?></b></td>
              </tr>
              <tr>
                <td class="main">&nbsp;</td>
              </tr>
           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
         <?
    echo '              <tr>' . "\n" .
         '                <td class="main" align="left" width="5%">&nbsp;</td>' . "\n" .
         '                <td class="main" align="left" width=95%>' . tep_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>') . '</td>' . "\n" .
         '              </tr>' . "\n";
           ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TEXT_SUPPORT_DELIVERY_ADDRESS; ?></b></td>
              </tr>
              <tr>
                <td class="main">&nbsp;</td>
              </tr>
           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
         <?
    echo '              <tr>' . "\n" .
         '                <td class="main" align="left" width="5%">&nbsp;</td>' . "\n" .
         '                <td class="main" align="left" width=95%>' . tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>') . '</td>' . "\n" .
         '              </tr>' . "\n";
           ?>
            </table></td>
          </tr>
        </table></td>
      </tr>

      <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TEXT_SUPPORT_USER_EMAIL; ?></b></td>
              </tr>

           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
         <?
    echo '              <tr>' . "\n" .
         '                <td class="main" align="left" width="5%">&nbsp;</td>' . "\n" .
         '                <td class="main" align="left" width=95%>' . $account['customers_email_address'] . tep_draw_hidden_field('support_user_email', $account['customers_email_address']) . '</td>' . "\n" .
         '              </tr>' . "\n";

           ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TEXT_WHY_RETURN; ?></b></td>
              </tr>
           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
            <td class=main width=5%>&nbsp;</td>
            <td class="main" width=95%><?php //echo tep_draw_input_field('link_url'); ?>
          <?
            $priority_query = tep_db_query("select return_reason_id, return_reason_name from ". TABLE_RETURN_REASONS . " where language_id = '" . $languages_id . "' order by return_reason_id desc");
            $select_box = '<select name="support_priority"  size="' . MAX_MANUFACTURERS_LIST . '">';
             if (MAX_MANUFACTURERS_LIST < 2) {
                     }
               while ($priority_values = tep_db_fetch_array($priority_query)) {
                 $select_box .= '<option value="' . $priority_values['return_reason_id'] . '"';
                 if ($default_priority['configuration_value'] ==  $priority_values['return_reason_id']) $select_box .= ' SELECTED';
                 $select_box .= '>' . substr($priority_values['return_reason_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '</option>';
              }
             $select_box .= "</select>";
             $select_box .= tep_hide_session_id();
             echo $select_box;
          ?>
            </td>
          </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<!-- Begin refund method selection -->
      <tr>
                <td class="main">&nbsp;</td>
              </tr>
       <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><? echo TEXT_PREF_REFUND_METHOD; ?></b></td>
              </tr>
              <tr>
                <td class="main">&nbsp;</td>
              </tr>
           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
            <td class=main width=5%>&nbsp;</td>
            <td class="main" width=95%><?php //echo tep_draw_input_field('link_url'); ?>
          <?
            $refund_query = tep_db_query("select refund_method_id, refund_method_name from ". TABLE_REFUND_METHOD . " where language_id = '" . $languages_id . "' order by refund_method_id asc");
            $select_box = '<select name="refund_method"  size="' . MAX_MANUFACTURERS_LIST . '">';
             if (MAX_MANUFACTURERS_LIST < 2) {
                     }
               while ($refund_values = tep_db_fetch_array($refund_query)) {
                 $select_box .= '<option value="' . $refund_values['refund_method_name'] . '"';
                 if ($default_refund['configuration_value'] ==  $refund_values['refund_method_id']) $select_box .= ' SELECTED';
                 $select_box .= '>' . substr($refund_values['refund_method_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '</option>';
              }
             $select_box .= "</select>";
             $select_box .= tep_hide_session_id();
             echo $select_box;
          ?>
          <br><br>
          <?
         $charge_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " where configuration_key = 'DEFAULT_RESTOCK_VALUE'");
         $charge = tep_db_fetch_array($charge_query);
// Don't show re-stocking info if it's set to zero in Admin > Configuration > Stock
          if ($charge['configuration_value'] != 0) {
            echo TEXT_SUPPORT_SURCHARGE . $charge['configuration_value'] .'%' . TEXT_SUPPORT_SURCHARGE_TWO;
            } ?>
            </td>
          </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<!-- End refund method selection -->
                <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
       <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td width="40%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php echo TEXT_SUPPORT_TEXT; ?></b></td>
              </tr>
              <tr>
                <td class="main">&nbsp;</td>
              </tr>
           </table></td>
            <td width="60%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
         <?
    echo '              <tr>' . "\n" .
         '                <td class="main" align="left" width="5%">&nbsp;</td>' . "\n" .
         '                <td class="main" align="left" width=95%>' . tep_draw_textarea_field('support_text', 'soft', '40', '7') . '</td>' . "\n" .
         '              </tr>' . "\n";

           ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
                <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>

       </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2" class="main" valign="top" nowrap align="center">



            <input type=submit value="Submit" onClick="return submitForm(document.longsubmit, this)"></td>
          </tr>
        </table></td>
      </form></tr>
<?php
}
?>




             <!--

             -->

            </td>
          </tr>
        </table></td>
      </tr>

    </table>
