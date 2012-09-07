<?php // catalog/includes/modules/2gether.php (3929)

if (!$together_id) $together_id = $_GET['products_id'];
if ($together_id) {
include(DIR_WS_LANGUAGES . $language . '/2gether.php');
$show_money_savings = true; // show money savings
$show_percentage_savings = true; // show percentage savings
$show_original_prices = true; // show origibal prices of the products
?>
<tr>
<td>
<div id="gether">
<?php
$together_query = tep_db_query("select distinct product_1_id, product_2_id, discount, type from ". TABLE_2GETHER ."  where (product_1_id = '" . $together_id . "' or product_2_id = '" . $together_id . "') and status = 1");
$num_together = tep_db_num_rows($together_query);
if ($num_together > 0) {
  $record = tep_db_fetch_array($together_query);
  $discount = $record['discount'];
  $discount_type = $record['type'];
  if ($record['product_1_id'] == $together_id) {
    $aq ="select p.products_id, p.products_image, p.products_price,  p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd  where p.products_id='". $record['product_1_id'] ."' and p.products_id = pd.products_id and products_status = '1' and pd.language_id ='". $languages_id ."'";
    $bq ="select p.products_id, p.products_image, p.products_price,  p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd  where p.products_id='". $record['product_2_id'] ."' and p.products_id = pd.products_id and products_status = '1' and pd.language_id ='". $languages_id ."'";
  } else {
     $aq ="select p.products_id, p.products_image, p.products_price,  p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd  where p.products_id='". $record['product_2_id'] ."' and p.products_id = pd.products_id and products_status = '1' and pd.language_id ='". $languages_id ."'";
     $bq ="select p.products_id, p.products_image, p.products_price,  p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd  where p.products_id='". $record['product_1_id'] ."' and p.products_id = pd.products_id and products_status = '1' and pd.language_id ='". $languages_id ."'";
  }

  $product_a_query = tep_db_query($aq);
  $product_a = tep_db_fetch_array($product_a_query);
  $product_b_query = tep_db_query($bq);
  $product_b = tep_db_fetch_array($product_b_query);
  $product_a_price = $product_a['products_price'];
  $product_b_price = $product_b['products_price'];

  if (DISPLAY_PRICE_WITH_TAX) {
    $product_a_price =  tep_add_tax($product_a_price,tep_get_tax_rate($product_a['products_tax_class_id']));
    $product_b_price =  tep_add_tax($product_b_price,tep_get_tax_rate($product_b['products_tax_class_id']));
  }

  if ($discount > 0) {

    $together_image = '<img src=' . DIR_WS_IMAGES . 'icons/2_gether_discount/save-icon_blink.gif alt="&euro;" title="&euro;">';
    $together_text = TOGETHER_HEADING_TEXT_SPECIAL_OFFER . '<br>';
   if (($show_money_savings) or ($show_percentage_savings)) {
    $together_savings_string = TOGETHER_TEXT_YOU_SAVE;
   } else {
    $together_savings_string = '';
   }
    if ($discount_type == 'p') {
      $together_price = tep_round(($product_a_price + $product_b_price) * (1-($discount/100)), 1);
      if ($show_money_savings) {
           $together_savings = $product_a_price + $product_b_price - $together_price;
           $together_savings_string .= $currencies->format($together_savings);
      }
      if ($show_percentage_savings) {
           $together_savings_string .= ' ' . $discount . '%';
      }
    } else {
       $together_price = tep_round($product_a_price + $product_b_price - $discount,1);
       if ($show_money_savings) {
         $together_savings = $product_a_price + $product_b_price - $together_price;
         $together_savings_string .= $currencies->format($together_savings);
       }
       if ($show_percentage_savings) {
         $together_percentage = ($discount /($product_a_price + $product_b_price))*100;
         $together_savings_string .= ' ' . $together_percentage . '%';
       }
      }
  } else {
      $together_price = tep_round(($product_a_price + $product_b_price), 1);
      $together_savings_string = '';
      $together_image = '<img src=' . DIR_WS_IMAGES . 'icons/2_gether_discount/info_blue_small.jpg alt="i" title="i">';
      $together_text = '<font color="orange"><span class="getslogan">'.TOGETHER_HEADING_TEXT_SUGGESTION . '</span></font><br>';
    }
$together_string = $currencies->format($together_price);
echo '<table width="99%" class="gether" cellpadding="2" align="center">' .
'<tr>
  <td valign="middle" width="1px" align="left"></td>' . 
 '<td colspan="5" class="gettitolo">' . $together_text . TOGETHER_TEXT_BUY . ' <a href="' . tep_href_link('product_info.php', 'products_id=' . $product_a['products_id']) . '">' . str_replace('\'','`',$product_a['products_name']) . ' ' . tep_image('images/icons/2_gether_discount/ico_arrow.gif', ICON_ARROW_RIGHT) . '</a> ' . TOGETHER_TEXT_AND . ' <a href="' . tep_href_link('product_info.php', 'products_id=' . $product_b['products_id']) . '">' . str_replace('\'','`',$product_b['products_name']) . ' ' . tep_image('images/icons/2_gether_discount/ico_arrow.gif', ICON_ARROW_RIGHT) . '</a></td>' . 
'</tr>
 <tr>
  <td></td>' . 
'<td width="80px" align="center">' ;?>
<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_a['products_id']) . '&image=0\\\')">' . tep_image(DIR_WS_IMAGES . $product_a['products_image'], str_replace('\'','`',$product_a['products_name']), GETHER_DISCOUNT_IMAGE_WIDTH, GETHER_DISCOUNT_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $product_a['products_image']) . '">' . tep_image(DIR_WS_IMAGES . $product_a['products_image'], str_replace('\'','`',$product_a['products_name']), GETHER_DISCOUNT_IMAGE_WIDTH, GETHER_DISCOUNT_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '</a>'; ?>
</noscript> 
<?php 

echo tep_draw_form('together', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'));

if ($show_original_prices) echo '<br><span class="prezzo">'.$currencies->format($product_a_price);

//Jader
	
	
	$products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$product_a['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$product_a['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (isset($cart->contents[$product_a['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$product_a['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
            <?php echo '<br>' . $products_options_name['products_options_name'] . ':'; ?><br>
              <?php echo tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute); ?><br>
<?php
      }
 


//-Jader

echo '</span></td><td align="center" width="100px"><img src="images/icons/2_gether_discount/icon_plus.gif" border="0" style="vertical-align: middle"></td>' .
 '<td width="80px" align="center">' ;?>
<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_b['products_id']) . '&image=0\\\')">' . tep_image(DIR_WS_IMAGES . $product_b['products_image'], str_replace('\'','`',$product_b['products_name']), GETHER_DISCOUNT_IMAGE_WIDTH, GETHER_DISCOUNT_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $product_b['products_image']) . '">' . tep_image(DIR_WS_IMAGES . $product_b['products_image'], str_replace('\'','`',$product_b['products_name']), GETHER_DISCOUNT_IMAGE_WIDTH, GETHER_DISCOUNT_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '</a>'; ?>
</noscript>
<?php
if ($show_original_prices) echo '<br><span class="prezzo">'.$currencies->format($product_b_price);


//Jader
	
	
	$products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$product_b['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$product_b['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (isset($cart->contents[$product_b['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$product_b['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
            <?php echo '<br>' . $products_options_name['products_options_name'] . ':'; ?><br>
              <?php echo tep_draw_pull_down_menu('id_b[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute); ?><br>
<?php
      }
 


//-Jader

echo '</span></td><td width="2%"></td>'.
'<td align="middle" nowrap valign="middle" class="getprezzo">' . TOGETHER_TEXT_TOGETHER . ' ' . '<br><font color=#00><b>'.$together_string . '</b></font><br><br>'; 
//echo tep_draw_form('together', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'));

echo tep_draw_hidden_field('products_id', $product_a['products_id']) . tep_draw_hidden_field('quantity',1) . tep_draw_hidden_field('buy_tinn_add', $product_b['products_id']) . tep_image_submit('button_buy_now.png', IMAGE_BUTTON_BUY_NOW);
echo '</form>';
echo '<table>';
if ($discount > 0) echo '<tr><td class="getrisparmio" nowrap align="center"><br><font color="red">' . $together_savings_string . '</font></td></tr><tr><td class="vsmalltext" nowrap align="center">('. TOGETHER_TEXT_RECEIVE_CHECKOUT . ')</td></tr>';
echo '</table>';
echo '</td></tr>';
echo '</table>';

echo '</div></td></tr><tr><td class="spazio"></td></tr>';

}
}
?>