<!-- shopping cart tooltip //-->
<?php  if (USE_PRODUCT_INFO_CART_TOOLTIP == 'true') { ?>
<div id="popCart_overlay" onclick="document.getElementById('popCart').style.display='none'; document.getElementById('popCart_overlay').style.display='none'; return false;">
</div>
<div id="popCart">
<?php
if (tep_session_is_registered('new_products_id_in_cart')) {
?>
<h4><?php echo PRODUCT_ADDED; ?></h4>
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<ul class="popcartList">
<?php
  $cart_contents_string = '';
  if ($cart->count_contents() > 0) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
    $cart_contents_string .= '<li>';
    $cart_contents_string .= $products[$i]['quantity'] . ' x <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';
    $cart_contents_string .= $products[$i]['name'] . '</a></li>';
    }
  }
echo $cart_contents_string;
echo tep_draw_separator('pixel_black.gif', '100%', '1');
echo '<li><b>Total: ' . $currencies->format($cart->show_total()) . '</b></li>';
?>
</ul>
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<ul class="popcartList"><li class="popcartButton"> <?php echo '<a href="javascript:void(0);" onclick="document.getElementById(\'popCart\').style.display=\'none\'; document.getElementById(\'popCart_overlay\').style.display=\'none\'; return false;">' . tep_image_button('button_continue_shopping.png', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a></li><li class="popcartButton"><a href="' . tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . tep_image_button('button_show_cart.png', IMAGE_BUTTON_SHOW_CART) . '</a></li><li class="popcartButton"><a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image_button('button_checkout.png', IMAGE_BUTTON_CHECKOUT) . '</a>' ?></li></ul>
<script type="text/javascript">
var item=document.getElementById("popCart");
function pop(el){
    if(el.style.display=="block"){
        el.style.display="none";
        }else{
            el.style.display="block";
            }
    }
pop(item);
</script>
<script type="text/javascript">
var item=document.getElementById("popCart_overlay");
function overlay(el){
    if(el.style.display=="block"){
        el.style.display="none";
        }else{
            el.style.display="block";
            }
    }
overlay(item);
</script>


<?php
tep_session_unregister('new_products_id_in_cart');
}
}
?>
</div>
<!-- shopping cart tooltip_eof //-->
<!-- product styles //-->
<link rel="stylesheet" href="includes/css/lightbox.css" type="text/css" media="screen" />
<script src="includes/javascript/prototype.js" type="text/javascript"></script>
<script src="includes/javascript/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="includes/javascript/lightbox.js" type="text/javascript"></script>
<script language="javascript">
window.onload=function(){
 initTabs();
 }
</script>
<?php // BOF: Additional Images ?>
<script language="javascript"><!--
function showImage(img,width,height,reptext) {
  if (document.getElementById("mainimage")) {
    document.getElementById("mainimage").src = img;
    document.getElementById("mainimage").height = height;
    document.getElementById("mainimage").width = width;
    document.getElementById("mainimage").title = reptext;
    document.getElementById("mainimage").alt = reptext;
    document.getElementById("mainimagedesc").innerHTML = reptext;
  }
}
//--></script>
<?php // EOF: Additional Images ?>
<!-- product styles_eof //-->
<a name="<?php echo $header_tags_array['title']; ?>"></a>
<!-- no product found //-->
    <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
// quotes
  if ($invalidCust == 'true') {
?>
       <tr>
        <td><h1><?php echo HEADING_INVALID_CUSTOMER; ?></h1></td>
			</tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo TEXT_INVALID_CUSTOMER; ?></td>
			</tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
} else {
// quotes_eof
  if ($product_check['total'] < 1) {
?>
      <tr>
        <td><h1><?php new infoBox(array(array('text' => TEXT_PRODUCT_NOT_FOUND))); ?></h1></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<!-- no product found_eof //-->
<!-- product script //-->
<?php
  } else {
// Product Tabs 2.0 added queries Start-2
    $product_info_query = tep_db_query("select p.products_carrot, p.products_id, pd.products_name, p.quotes_email_address, pd.products_description, pd.products_spec, pd.products_musthave, pd.products_extraimage, pd.products_manual, pd.products_extra1, pd.products_moreinfo, p.products_model, p.products_quantity, p.products_image, p.products_image_med, p.products_image_pop, p.products_image_description, p.products_image_lrg, p.products_image_sm_1, p.products_image_xl_1, p.products_image_sm_2, p.products_image_xl_2, p.products_image_sm_3, p.products_image_xl_3, p.products_image_sm_4, p.products_image_xl_4, p.products_image_sm_5, p.products_image_xl_5, p.products_image_sm_6, p.products_image_xl_6, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

// BOF QPBPP for SPPC
    $pf->loadProduct((int)$_GET['products_id'], (int)$languages_id);
    $products_price = $pf->getPriceString();
// EOF QPBPP for SPPC

    if (tep_not_null($product_info['products_model'])) {
      $products_name = $product_info['products_name'] . '<br><span class="smallText">[' . $product_info['products_model'] . ']</span>';
    } else {
      $products_name = $product_info['products_name'];
    }
// BOF QPBPP for SPPC
  $min_order_qty = $pf->getMinOrderQty();
    if ($min_order_qty > 1) {
      $products_name .= '<br><span class="smallText">' . MINIMUM_ORDER_TEXT . $min_order_qty . '</span>';
    }
// EOF QPBPP for SPPC

// BOF: Additional Images
	$additional_images = new displayimages ( $product_info['products_id'] );
// EOF: Additional Images
//DISPLAY PRODUCT WAS ADDED TO WISHLIST IF WISHLIST REDIRECT IS ENABLED
	if(tep_session_is_registered('wishlist_id')) {
?>
	  <tr>
		<td class="messageStackSuccess">&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'icons/success.gif') ?>&nbsp;<?php echo PRODUCT_ADDED_TO_WISHLIST; ?></td>
	  </tr>
<?php
		tep_session_unregister('wishlist_id');
	}
//DISPLAY PRODUCT WAS ADDED TO WISHLIST IF WISHLIST REDIRECT IS ENABLED
?>
<!-- product script_eof //-->
<!-- product heading //-->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" valign="top"><?php echo $products_name; ?></td>
			<td class="pageHeading" align="right" valign="top"><?php
				if ($gift['products_carrot'] == 0) {
					echo $products_price;
				} elseif ($gift['products_carrot'] == 1 && $product_info['products_price'] == 0) {
					echo TEXT_FREE_GIFT;
				} elseif ($gift['products_carrot'] == 1 && $product_info['products_price'] > 0){
					echo TEXT_DISCOUNT_GIFT;
				} ?>
		   </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<!-- product heading_eof //-->
<!-- product image //-->
      <tr>
        <td class="main">
<?php
// BOF: Additional Images    ADDED to if statement:  && ADDIMAGES_GROUP_WITH_PARENT == 'false'
    if (tep_not_null($product_info['products_image']) && ADDIMAGES_GROUP_WITH_PARENT == 'false') {
// EOF: Additional Images	
?>
          <table border="0" cellspacing="0" cellpadding="2" align="<?php echo ((ADDIMAGES_MENU_LOCATION=='product_info')?ADDIMAGES_TABLE_ALIGNMENT:ADDIMAGES_PARENT_IMAGE_ALIGNMENT); ?>"<?php if (ADDIMAGES_MENU_LOCATION == 'product_info') { echo ' width="'.($imagemenu->maximagewidth+$extra_window_width).'" height="'.($imagemenu->maximageheight+$extra_window_height).'"'; } ?> style="position: relative;">
<?php  if (ENABLE_ADDITIONAL_IMAGES == 'true') { ?>
<!-- additional images //-->
            <tr>
              <td align="center" class="smallText">
<?php 
// BOF: Additional Images
if (ADDIMAGES_MENU_LOCATION == 'product_info') { 

	if (ADDIMAGES_POPUP_TABLE_LOCATION=='above' && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
	  echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td valign="middle" align="center" class="pageHeading">' . TEXT_MENU_TITLE . '</td></tr><tr><td valign="middle" align="center">' . $imagemenu->altgroupoutput() . '</td></tr></table>';
	}

	echo '<table border="0" cellspacing="0" cellpadding="0"><tr>';
	if (ADDIMAGES_POPUP_TABLE_LOCATION=='sides' && (ADDIMAGES_POPUP_TABLE_ALIGNMENT=='left' || ADDIMAGES_POPUP_TABLE_ALIGNMENT=='center') && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
	  echo '<td valign="middle" align="center" class="pageHeading">' . (TEXT_MENU_TITLE != ''?TEXT_MENU_TITLE . '<br>':'') . $imagemenu->groupoutput() . '</td>';
	}

	echo '<td valign="middle" align="center" width="' . $imagemenu->maximagewidth . '" height="' . $imagemenu->maximageheight . '">';
    if (!empty($_GET['imagesID'])) {
      if (ADDIMAGES_MENU_LOCATION == 'product_info' && ENABLE_LIGHTBOX == 'true') { // doing on page rollovers and the lightbox.
	    echo tep_image(DIR_WS_IMAGES . (!empty($selected_image['medium_images'])?$selected_image['medium_images']:(!empty($selected_image['popup_images'])?$selected_image['popup_images']:'')), $selected_image['images_description'], (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?DISPLAY_IMAGE_WIDTH:''), (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?DISPLAY_IMAGE_HEIGHT:''), 'id="mainimage"') . '<br />' . (!empty($selected_image['images_description'])?'<span id="mainimagedesc">'.$selected_image['images_description'].'</span>':'');
	  } else { // normal
	    echo tep_image(DIR_WS_IMAGES . (!empty($selected_image['popup_images'])?$selected_image['popup_images']:(!empty($selected_image['medium_images'])?$selected_image['medium_images']:(!empty($selected_image['thumb_images'])?$selected_image['thumb_images']:''))), $selected_image['images_description'], (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_WIDTH:''), (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_HEIGHT:''), 'id="mainimage"') . '<br />' . (!empty($selected_image['images_description'])?'<span id="mainimagedesc">'.$selected_image['images_description'].'</span>':'');
	  }
	} elseif (!empty($_GET['pID'])) {
      if (ADDIMAGES_MENU_LOCATION == 'product_info' && ENABLE_LIGHTBOX == 'true') { // doing on page rollovers and the lightbox.
	    echo tep_image(DIR_WS_IMAGES . (!empty($selected_image['products_image_med'])?$selected_image['products_image_med']:(!empty($selected_image['products_image_pop'])?$selected_image['products_image_pop']:'')), $selected_image['images_description'], (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?DISPLAY_IMAGE_WIDTH:''), (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?DISPLAY_IMAGE_HEIGHT:''), 'id="mainimage"') . '<br />' . (!empty($selected_image['images_description'])?'<span id="mainimagedesc">'.$selected_image['images_description'].'</span>':'');
	  } else { // normal
	    echo tep_image(DIR_WS_IMAGES . (!empty($selected_image['products_image_pop'])?$selected_image['products_image_pop']:(!empty($selected_image['products_image_med'])?$selected_image['products_image_med']:(!empty($selected_image['products_image'])?$selected_image['products_image']:''))), $selected_image['products_image_description'], (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_WIDTH:''), (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_HEIGHT:''), 'id="mainimage"'). '<br />' . (!empty($selected_image['products_image_description'])?'<span id="mainimagedesc">'.$selected_image['products_image_description'].'</span>':'');
	  }
	}
	echo '</td>';

	if (ADDIMAGES_POPUP_TABLE_LOCATION=='sides' && ADDIMAGES_POPUP_TABLE_ALIGNMENT=='right' && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
	  echo '<td valign="middle" align="center" class="pageHeading">' . (TEXT_MENU_TITLE != ''?TEXT_MENU_TITLE . '<br>':'') . $imagemenu->groupoutput() . '</td>';
	}
	if (!empty($imagemenu->maximagewidth) && !empty($imagemenu->maximageheight)) { echo '<td>' . tep_draw_separator('pixel_trans.gif', '4', $imagemenu->maximageheight) . '</td>'; }
	echo '</tr></table>';

	if (ADDIMAGES_POPUP_TABLE_LOCATION=='below' && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
	  echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td valign="middle" align="center" class="pageHeading">' . TEXT_MENU_TITLE . '</td></tr><tr><td valign="middle" align="center">' . $imagemenu->altgroupoutput() . '</td></tr></table>';
	}

} else {
if (ENABLE_LIGHTBOX == 'true') {
// lightbox addon
?><script language="javascript"><!--
document.write('<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $product_info['products_image_pop']) . '"target="_blank" rel="lightbox[group]"  title="'. $product_info['products_name'].'" >' . tep_image(DIR_WS_IMAGES . (!empty($product_info['products_image_med'])?$product_info['products_image_med']:(!empty($product_info['products_image_pop'])?$product_info['products_image_pop']:(!empty($product_info['products_image'])?$product_info['products_image']:''))), addslashes($product_info['products_name']), (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_WIDTH:''), (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_HEIGHT:''), 'hspace="5" vspace="5"') . '<br>' . (!empty($product_info['products_image_description'])?$product_info['products_image_description']:TEXT_CLICK_TO_ENLARGE) . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . (!empty($product_info['products_image_pop'])?$product_info['products_image_pop']:$product_info['products_image'])) . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'">' . tep_image(DIR_WS_IMAGES . (!empty($product_info['products_image_med'])?$product_info['products_image_med']:(!empty($product_info['products_image_pop'])?$product_info['products_image_pop']:(!empty($product_info['products_image'])?$product_info['products_image']:''))), $product_info['products_name'], (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_WIDTH:''), (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_HEIGHT:''), 'hspace="5" vspace="5"') . '<br>' . (!empty($product_info['products_image_description'])?$product_info['products_image_description']:TEXT_CLICK_TO_ENLARGE) . '</a>'; ?>
</noscript><?php
} else {
// non-lightbox
?><script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_ADD_IMAGE, 'pID=' . $product_info['products_id']) . '\\\')">' . tep_image(DIR_WS_IMAGES . (!empty($product_info['products_image_med'])?$product_info['products_image_med']:(!empty($product_info['products_image_pop'])?$product_info['products_image_pop']:(!empty($product_info['products_image'])?$product_info['products_image']:''))), addslashes($product_info['products_name']), (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_WIDTH:''), (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_HEIGHT:''), 'hspace="5" vspace="5"') . '<br>' . (!empty($product_info['products_image_description'])?$product_info['products_image_description']:TEXT_CLICK_TO_ENLARGE) . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . (!empty($product_info['products_image_pop'])?$product_info['products_image_pop']:$product_info['products_image'])) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . (!empty($product_info['products_image_med'])?$product_info['products_image_med']:(!empty($product_info['products_image_pop'])?$product_info['products_image_pop']:(!empty($product_info['products_image'])?$product_info['products_image']:''))), $product_info['products_name'], (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_WIDTH:''), (ADDIMAGES_RESTRICT_PARENT=='true'?DISPLAY_IMAGE_HEIGHT:''), 'hspace="5" vspace="5"') . '<br>' . (!empty($product_info['products_image_description'])?$product_info['products_image_description']:TEXT_CLICK_TO_ENLARGE) . '</a>'; ?>
</noscript><?php
}
}
?>
              </td>
            </tr>
      		<tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      		</tr>
<!-- additional images_eof //-->
<?php } else { ?>
<!-- product main image //-->
            <tr>
              <td align="center" class="smallText">
<?php  if (USE_PRODUCT_INFO_LIGHTBOX == 'true') { ?>
<script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="images/' . $product_info['products_image'] . '" rel="lightbox" title="' . $product_info['products_name'] . '">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_INFO_IMAGE_WIDTH, PRODUCT_INFO_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<?php } else { ?>
<script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id']) . '\\\')">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_INFO_IMAGE_WIDTH, PRODUCT_INFO_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<?php } ?>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $product_info['products_image']) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], $product_info['products_name'], PRODUCT_INFO_IMAGE_WIDTH, PRODUCT_INFO_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>
<?php } ?>
<br><br>
  <?php
//affiliate build a link begin
		if (tep_session_is_registered('affiliate_id')) {
			?>
	     <?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD, 'individual_banner_id=' . $product_info['products_id']) .'" target="_self">' . tep_image_button('button_affiliate_build_a_link.png', IMAGE_BUTTON_AFFILIATE_BUILD_A_LINK) . ' </a>'; ?><?php
		}
//affiliate build a link begin
	     ?>
              </td>
            </tr>
      		<tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      		</tr>
<!-- product main image_eof //-->
<?php } ?>
<!-- product image stock //-->
<?php  if (USE_PRODUCT_INFO_VIEW_STOCK == 'true') { ?>
            <tr>
              <td align="center" class="stocktext"><?php 
  $prod_quantity = tep_get_products_stock($products_id); 
   switch ($prod_quantity) { 
	case 0: print '<img src="images/stock/stock_soldout.png" border="0" title="' . TEXT_SOLDOUT . '" alt="' . TEXT_SOLDOUT . '"><br>' . TEXT_SOLDOUT_1 .' </font>'; break; 
	case 1:	print '<img src="images/stock/stock_1.png" border="0" title="' . TEXT_STOCK_1 . '" alt=""><br>' . TEXT_INSTOCK_1 . ' </font>'; break; 
	case 2:	print '<img src="images/stock/stock_2.png" border="0" title="' . TEXT_STOCK_2 . '" alt=""><br>' . TEXT_INSTOCK_2 . ' </font>'; break; 
	case 3:	print '<img src="images/stock/stock_3.png" border="0" title="' . TEXT_STOCK_3 . '" alt=""><br>' . TEXT_INSTOCK_3 . ' </font>'; break; 
	case 4:	print '<img src="images/stock/stock_4.png" border="0" title="' . TEXT_STOCK_4 . '" alt=""><br>' . TEXT_INSTOCK_4 . ' </font>'; break; 
	case 5:	print '<img src="images/stock/stock_5.png" border="0" title="' . TEXT_STOCK_5 . '" alt=""><br>' . TEXT_INSTOCK_5 . ' </font>'; break; 
	case 6:	print '<img src="images/stock/stock_6.png" border="0" title="' . TEXT_STOCK_6 . '" alt=""><br>' . TEXT_INSTOCK_6 . ' </font>'; break; 
	case 7: print '<img src="images/stock/stock_7.png" border="0" title="' . TEXT_STOCK_7 . '" alt=""><br>' . TEXT_INSTOCK_7 . ' </font>'; break; 
	case 8: print '<img src="images/stock/stock_8.png" border="0" title="' . TEXT_STOCK_8 . '" alt=""><br>' . TEXT_INSTOCK_8 . ' </font>'; break; 
	case 9: print '<img src="images/stock/stock_9.png" border="0" title="' . TEXT_STOCK_9 . '" alt=""><br>' . TEXT_INSTOCK_9 . ' </font>'; break; 
	case 10: print '<img src="images/stock/stock_10.png" border="0" title="' . TEXT_STOCK_10 . '" alt=""><br>' . TEXT_INSTOCK_10 . ' </font>'; break; 
	case 11: print '<img src="images/stock/stock_11.png" border="0" title="' . TEXT_STOCK_11 . '" alt=""><br>' . TEXT_INSTOCK_11 . ' </font>'; break; 
	case 12: print '<img src="images/stock/stock_12.png" border="0" title="' . TEXT_STOCK_12 . '" alt=""><br>' . TEXT_INSTOCK_12 . ' </font>'; break; 
	case 13: print '<img src="images/stock/stock_13.png" border="0" title="' . TEXT_STOCK_13 . '" alt=""><br>' . TEXT_INSTOCK_13 . ' </font>'; break; 
	case 14: print '<img src="images/stock/stock_14.png" border="0" title="' . TEXT_STOCK_14 . '" alt=""><br>' . TEXT_INSTOCK_14 . ' </font>'; break; 
	case 15: print '<img src="images/stock/stock_15.png" border="0" title="' . TEXT_STOCK_15. '" alt=""><br>' . TEXT_INSTOCK_15 . ' </font>'; break; 
	case 16: print '<img src="images/stock/stock_16.png" border="0" title="' . TEXT_STOCK_16 . '" alt=""><br>' . TEXT_INSTOCK_16 . ' </font>'; break; 
	case 17: print '<img src="images/stock/stock_17.png" border="0" title="' . TEXT_STOCK_17 . '" alt=""><br>' . TEXT_INSTOCK_17 . ' </font>'; break; 
	case 18: print '<img src="images/stock/stock_18.png" border="0" title="' . TEXT_STOCK_18 . '" alt=""><br>' . TEXT_INSTOCK_18 . ' </font>'; break; 
	case 19: print '<img src="images/stock/stock_19.png" border="0" title="' . TEXT_STOCK_19 . '" alt=""><br>' . TEXT_INSTOCK_19 . ' </font>'; break; 
	case 20: print '<img src="images/stock/stock_20.png" border="0" title="' . TEXT_STOCK_20 . '" alt=""><br>' . TEXT_INSTOCK_20 . ' </font>'; break; 
	case 21: print '<img src="images/stock/stock_21.png" border="0" title="' . TEXT_STOCK_21 . '" alt=""><br>' . TEXT_INSTOCK_21 . ' </font>'; break; 
	case 22: print '<img src="images/stock/stock_22.png" border="0" title="' . TEXT_STOCK_22 . '" alt=""><br>' . TEXT_INSTOCK_22 . ' </font>'; break; 
	case 23: print '<img src="images/stock/stock_23.png" border="0" title="' . TEXT_STOCK_23 . '" alt=""><br>' . TEXT_INSTOCK_23 . ' </font>'; break; 
	case 24: print '<img src="images/stock/stock_24.png" border="0" title="' . TEXT_STOCK_24 . '" alt=""><br>' . TEXT_INSTOCK_24 . ' </font>'; break; 
	case 25: print '<img src="images/stock/stock_25.png" border="0" title="' . TEXT_STOCK_25 . '" alt=""><br>' . TEXT_INSTOCK_25 . ' </font>'; break; 
	default: print '<img src="images/stock/stock_instock.png" border="0" title="' . TEXT_STOCK_0 . '" alt=""><br>' . TEXT_INSTOCK_0 . ' </font>'; 
   }
?>            </td>
            </tr>
      		<tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      		</tr>
<?php } ?>
<!-- product image stock_eof //-->
          </table>
<?php } ?>
<!-- product image //-->
<?php
// BOF: Additional Images
	if (ADDIMAGES_TABLE_LOCATION=='above' && ADDIMAGES_SHOW_ON_PRODUCT_INFO=='true' && ADDIMAGES_MENU_LOCATION == 'popup') {
	  echo $additional_images->altgroupoutput();
	} else if (ADDIMAGES_TABLE_LOCATION=='sides' && ADDIMAGES_SHOW_ON_PRODUCT_INFO=='true' && ADDIMAGES_MENU_LOCATION == 'popup') {
	  echo $additional_images->groupoutput();
	}
// EOF: Additional Images
?>
<!-- product image_eof //-->
<!-- product tabs //-->
		<table cellpadding="5" cellspacing="0" width="<?php echo PRODUCT_TABS_WIDTH ?>" style="border: 0px solid #000000;background: #FFFFFF;">
		  <tr>
			<td>
				<?php
			       include(DIR_WS_MODULES . 'product_tabs.php');
				?>
		    </td>
		  </tr>
		</table>
<!-- product tabs_eof //-->
<?php // BOF: Additional Images
if (ADDIMAGES_TABLE_LOCATION=='below' && ADDIMAGES_SHOW_ON_PRODUCT_INFO=='true' && ADDIMAGES_MENU_LOCATION == 'popup') { ?>
    	<table border="0" width="98%" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><?php echo $additional_images->altgroupoutput(); ?></td>
      </tr>
    	</table>
<?php } 
// EOF: Additional Images ?>
<?php if (USE_BUTTON_BACK_PRODUCT_INFO == 'true') { ?>
    	<table border="0" width="98%" cellspacing="0" cellpadding="0" align="center">
      <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
    	</table>
<?php } ?>
<?php
// start Get 1 Free
    // If this product qualifies for free product(s) display promotional text
    $get_1_free_query = tep_db_query("select pd.products_name,
                                             g1f.products_free_quantity,
                                             g1f.products_qualify_quantity
                                      from " . TABLE_GET_1_FREE . " g1f,
                                           " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                      where g1f.products_id = '" . (int)$product_info['products_id'] . "'
                                        and pd.products_id = g1f. products_free_id
                                        and pd.language_id = '" . (int)$languages_id . "'
                                        and status = '1'"
                                    );
    if (tep_db_num_rows($get_1_free_query) > 0) {
      $free_product = tep_db_fetch_array($get_1_free_query);
      echo '<p class=get1free>' . sprintf (TEXT_GET_1_FREE_PROMOTION, $free_product['products_qualify_quantity'], $product_info['products_name'], $free_product['products_free_quantity'], $free_product['products_name']) . '</p>';
    }
// end Get 1 Free
?>
<!-- product options //-->
<?php
//++++ QT Pro: Begin Changed code
    if (tep_not_null($product_info['products_image'])) {
?>
              <?php
}
//++++ QT Pro: End Changed Code
// BOF SPPC Hide attributes from customer groups
//  $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' and find_in_set('".$customer_group_id."', attributes_hide_from_groups) = 0 ");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
//++++ QT Pro: Begin Changed code
      $products_id=(preg_match("/^\d{1,10}(\{\d{1,10}\}\d{1,10})*$/",$HTTP_GET_VARS['products_id']) ? $HTTP_GET_VARS['products_id'] : (int)$HTTP_GET_VARS['products_id']); 
      require(DIR_WS_CLASSES . 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN . '.php');
      $class = 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN;
      $pad = new $class($products_id);
      echo $pad->draw();
    }

//Display a table with which attributecombinations is on stock to the customer?
if(PRODINFO_ATTRIBUTE_DISPLAY_STOCK_LIST == 'True'): require(DIR_WS_MODULES . "qtpro_stock_table.php"); endif;

//++++ QT Pro: End Changed Code
?>
  </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<!-- product options_eof //-->
<!-- 2 gether discount //-->
<?php 
if (MODULE_2GETHER_DISCOUNT_STATUS) { 
  echo '<tr><td>';
  include(DIR_WS_MODULES . '2gether.php');
  echo '</td></tr>';
} 
?>
<!-- 2 gether discount_eof //-->
<!-- document_manager //-->
<?php
// Document Manager
    if (DOCUMENTS_SHOW_PRODUCT_INFO == 'True') {
      include_once (DIR_WS_MODULES . FILENAME_DOCUMENTS);
    }
?>
<!-- document_manager_eof //-->
<!-- additional product information //-->
<?php
// Points/Rewards system V2.1rc2a BOF
    if ((USE_POINTS_SYSTEM == 'true') && (DISPLAY_POINTS_INFO == 'true')) {
	    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
		    $products_price_points = tep_display_points($new_price, tep_get_tax_rate($product_info['products_tax_class_id']));
	    } else {
		    $products_price_points = tep_display_points($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
	    }
	    $products_points = tep_calc_products_price_points($products_price_points);
	    $products_points_value = tep_calc_price_pvalue($products_points);
	    if ((USE_POINTS_FOR_SPECIALS == 'true') || $new_price == false) { 
		?>
      <tr>
        <td class="main"><?php echo '' . sprintf(TEXT_PRODUCT_POINTS , number_format($products_points,POINTS_DECIMAL_PLACES), $currencies->format($products_points_value)) . '</p>'; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      </tr>
        <?php
	    }
    }
// Points/Rewards system V2.1rc2a EOF
// quotes
if (! tep_not_null($customers['customers_email_address'])) {
  if (USE_PRODUCT_INFO_CURRENT_REVIEWS == 'true') { 
    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where approved = 1 and products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'");
    $reviews = tep_db_fetch_array($reviews_query);
    if ($reviews['count'] > 0) {
?>
      <tr>
        <td class="main"><?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      </tr>
<?php } 
    }
  if (USE_PRODUCT_INFO_MORE_INFORMATION == 'true') {
    if (tep_not_null($product_info['products_url'])) { ?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      </tr>
<?php } 
    }
} // quotes_eof
?>
      <tr>
        <td class="main">
<?php
  if (USE_PRODUCT_INFO_NOTIFICATIONS == 'true') {
    if (tep_session_is_registered('customer_id'))
    {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] <= 0)
      {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      if($check['count'] > 0)
        echo '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'files/product_info/checked.gif', IMAGE_BUTTON_REMOVE_NOTIFICATIONS) . '</a>&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, tep_get_products_name($HTTP_GET_VARS['products_id'])) .'</a>';
      else
        echo '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif', IMAGE_BUTTON_NOTIFICATIONS) . '</a>&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, tep_get_products_name($HTTP_GET_VARS['products_id'])) .'</a>';
      }
    }
    else
    {
      echo '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif', IMAGE_BUTTON_NOTIFICATIONS) . '</a>&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, tep_get_products_name($HTTP_GET_VARS['products_id'])) .'</a>';
    }
?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      </tr>
<?php }
// quotes
if (! tep_not_null($customers['customers_email_address'])) {
  if (USE_PRODUCT_INFO_DATE_AVAILABLE == 'true') {
    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) { ?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?></td>
      </tr>
<?php } 
  	 }
  if (USE_PRODUCT_INFO_DATE_ADDED == 'true') { ?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($product_info['products_date_added'])); ?></td>
      </tr>
<?php }
 } // quotes_eof
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      </tr>
<?php  if (USE_PRODUCT_INFO_HEADER_TAGS == 'true') { ?>
      <tr>
       <td class="main"><?php echo TEXT_VIEWING; ?>&nbsp;
       <?php echo '<a title="' . $header_tags_array['title'] . '" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_info['products_id'], 'NONSSL') . '"/# ' . $header_tags_array['title'] . '">' . $header_tags_array['title']; ?></a></td>
      </tr>
<?php } ?>
      <tr>
       <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<!-- additional product information_eof //-->
<!-- button //-->
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main">
                <?php
                // quotes
                 if (! tep_not_null($customers['customers_email_address'])) {
                	  if ($reviews['count'] > 0) {
    					echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()) . '">' . tep_image_button('button_reviews.png', IMAGE_BUTTON_REVIEWS) . '</a>';
  					  } else {
    					echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params()) . '">' . tep_image_button('button_write_review.png', IMAGE_BUTTON_WRITE_REVIEW) . '</a>';
  					  }
                 } // quotes_eof
				?></td>
				<td align="center"><?php echo tep_image_submit('button_wishlist.png', IMAGE_BUTTON_WISHLIST, 'name="wishlist" value="wishlist"'); ?></td>
<?php  if (USE_PRODUCT_INFO_QUANTITY == 'dropdown') { ?>
                <td class="main" align="right"><?php 
				if ($gift['products_carrot'] == 0) {
				$product_quantity = tep_get_products_stock($_GET['products_id']);
				if ($product_quantity > MAX_QTY_IN_CART) { $product_quantity = MAX_QTY_IN_CART ; } ;
				$products_quantity_array = array();
				for ($i=1; $i<=$product_quantity; $i++) {
				$products_quantity_array[]=array('id' => $i, 'text' => $i); };
				echo tep_draw_hidden_field('products_id', $product_info['products_id']) . TEXT_QUANTITY . tep_draw_pull_down_menu('cart_quantity',$products_quantity_array,1) . '&nbsp;&nbsp;' . tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART);
				}?></td>
<?php } 
	if (USE_PRODUCT_INFO_QUANTITY == 'input') { ?>
                <td class="main" align="right"><?php 
				if ($gift['products_carrot'] == 0) {
				$product_quantity = tep_get_products_stock($_GET['products_id']);
				if ($product_quantity > MAX_QTY_IN_CART) { $product_quantity = MAX_QTY_IN_CART ; } ;
				$products_quantity_array = array();
				for ($i=1; $i<=$product_quantity; $i++) {
				$products_quantity_array[]=array('id' => $i, 'text' => $i); };
				echo tep_draw_hidden_field('products_id', $product_info['products_id']) . TEXT_QUANTITY . tep_draw_input_field('cart_quantity', '', 'size="5"') . '&nbsp;&nbsp;' . tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART);
				}?></td>
<?php } 
	if (USE_PRODUCT_INFO_QUANTITY == 'updown') { ?>
<?php } 
	if (USE_PRODUCT_INFO_QUANTITY == 'none') { ?>
				<td class="main" align="right"><?php
				if ($gift['products_carrot'] == 0) {
				echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.png', IMAGE_BUTTON_IN_CART);
				} ?></td>
<?php } ?>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td></form>
      </tr>
<!-- button_eof //-->
<!-- social_bookmarks //-->
      <tr>
            <td><table border="0" width="40%" cellspacing="0" cellpadding="2" align="right">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS_PRODUCTS == 'true') 
           									include(DIR_WS_MODULES . 'header_tags_social_bookmarks.php'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
<!-- social_bookmarks_eof //-->
<!-- product_info modulus //-->
<?php
// also purchased
  if (USE_PRODUCT_INFO_ALSO_PURCHASED == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
      <tr>
        <td>
	<?php if ((USE_CACHE == 'true') && empty($SID)) {
      echo tep_cache_also_purchased(3600);
    } else {
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
   } ?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
<?php
  }
// related products
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
	  <tr>
        <td>
		 <?php include(DIR_WS_MODULES . FILENAME_RELATED_PRODUCTS); ?>
		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
<?php
// related articles
  if (USE_PRODUCT_INFO_ARTICLE_RELATED == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
      <tr>
        <td>
	 <?php include(DIR_WS_MODULES . FILENAME_ARTICLES_PXSELL); ?>
		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
     <?php
    }
// recently_viewed
  if (RECENTLY_VIEWED_PRODUCT_INFO_BOTTOM_BOX == 'True') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
      <tr>
        <td>
    	  <?php include_once (DIR_WS_MODULES . FILENAME_RECENTLY_VIEWED); ?>
		</td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
<!-- product_info modulus_eof //-->
   </table>

