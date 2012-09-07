<?php // catalog/includes/modules/new_products_scroller.php (7938)

if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
  $new_products_query = tep_db_query("select p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
} else {
  $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
}
$no_of_new_products = tep_db_num_rows($new_products_query);

$pblock_html = '';
while ($new_products = tep_db_fetch_array($new_products_query)) {
  $pblock_html .= '<div class="scrollblock"><div><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a></div>'.
                  '<div class="scrollblock_img"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], NEW_PRODUCTS_MODULE_IMAGE_WIDTH, NEW_PRODUCTS_MODULE_IMAGE_HEIGHT) . '</a></div>'.
                  '<div class="scrollblock_price">'. $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</div></div>';
}
?>
<table class="scroller" border="0" width="100%" cellspacing="0" cellpadding="0">
   <tr><td><?php
     $info_box_contents = array();
     $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));
     new infoBoxHeading($info_box_contents, true, true, tep_href_link(FILENAME_PRODUCTS_NEW));
  ?></td></tr>
   <tr><td width="100%" class="scrollerHeader" align="right">
     <span class="scrollcnter"><?php echo TEXT_PAGE ?><span class="txt_pn">1</span><?php echo TEXT_PAGE_OF ?><span class="txt_maxpn"><?php echo ceil($no_of_new_products/5); ?></span>
     <a href="#" onclick="return false;" class="scrollrestart"><?php echo TEXT_PAGE_START ?></a></span>
   </td></tr>
   <tr><td width="100%">
     <table class="scrollerContent"><tr>
       <td width="5%" align="right"><img src="images/icons/new_products_scroller/button_left.png" class="gol"></td>
       <td width="90%" class="smallText">
         <span class="scrollcontainer"><span class="scrollbox">
         <?php echo $pblock_html; ?>
         </span></span>
       </td>
       <td width="5%" align="left"><img src="images/icons/new_products_scroller/button_right.png" class="gor"></td>
     </tr></table>
   </td></tr>
</table>
