<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'allprods_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_top_eof //-->
   <table border="0" width="100%" cellspacing="0" cellpadding="0">
     <tr>
       <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
         <tr>
           <td class="main"><?php echo HEADING_SUB_TEXT; ?></td>
         </tr>           
         <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td align="center" class="smallText"><?php $firstletter_nav=
        '<a href="' . tep_href_link("allprods.php",  'fl=A', 'NONSSL') . '">' . tep_image_button('button_tab_a.png', IMAGE_BUTTON_A) . '</a>&nbsp;' . 
        '<a href="' . tep_href_link("allprods.php",  'fl=B', 'NONSSL') . '">' . tep_image_button('button_tab_b.png', IMAGE_BUTTON_B) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=C', 'NONSSL') . '">' . tep_image_button('button_tab_c.png', IMAGE_BUTTON_C) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=D', 'NONSSL') . '">' . tep_image_button('button_tab_d.png', IMAGE_BUTTON_D) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=E', 'NONSSL') . '">' . tep_image_button('button_tab_e.png', IMAGE_BUTTON_E) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=F', 'NONSSL') . '">' . tep_image_button('button_tab_f.png', IMAGE_BUTTON_F) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=G', 'NONSSL') . '">' . tep_image_button('button_tab_g.png', IMAGE_BUTTON_G) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=H', 'NONSSL') . '">' . tep_image_button('button_tab_h.png', IMAGE_BUTTON_H) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=I', 'NONSSL') . '">' . tep_image_button('button_tab_i.png', IMAGE_BUTTON_I) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=J', 'NONSSL') . '">' . tep_image_button('button_tab_j.png', IMAGE_BUTTON_J) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=K', 'NONSSL') . '">' . tep_image_button('button_tab_k.png', IMAGE_BUTTON_K) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=L', 'NONSSL') . '">' . tep_image_button('button_tab_l.png', IMAGE_BUTTON_L) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=M', 'NONSSL') . '">' . tep_image_button('button_tab_m.png', IMAGE_BUTTON_M) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=N', 'NONSSL') . '">' . tep_image_button('button_tab_n.png', IMAGE_BUTTON_N) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=O', 'NONSSL') . '">' . tep_image_button('button_tab_o.png', IMAGE_BUTTON_O) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=P', 'NONSSL') . '">' . tep_image_button('button_tab_p.png', IMAGE_BUTTON_P) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=Q', 'NONSSL') . '">' . tep_image_button('button_tab_q.png', IMAGE_BUTTON_Q) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=R', 'NONSSL') . '">' . tep_image_button('button_tab_r.png', IMAGE_BUTTON_R) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=S', 'NONSSL') . '">' . tep_image_button('button_tab_s.png', IMAGE_BUTTON_S) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=T', 'NONSSL') . '">' . tep_image_button('button_tab_t.png', IMAGE_BUTTON_T) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=U', 'NONSSL') . '">' . tep_image_button('button_tab_u.png', IMAGE_BUTTON_U) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=V', 'NONSSL') . '">' . tep_image_button('button_tab_v.png', IMAGE_BUTTON_V) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=W', 'NONSSL') . '">' . tep_image_button('button_tab_w.png', IMAGE_BUTTON_W) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=X', 'NONSSL') . '">' . tep_image_button('button_tab_x.png', IMAGE_BUTTON_X) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=Y', 'NONSSL') . '">' . tep_image_button('button_tab_y.png', IMAGE_BUTTON_Y) . '</a>&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  'fl=Z', 'NONSSL') . '">' . tep_image_button('button_tab_z.png', IMAGE_BUTTON_Z) . '</a>&nbsp;&nbsp;&nbsp;' .
        '<a href="' . tep_href_link("allprods.php",  '',     'NONSSL') . '">' . tep_image_button('button_tab_all_products.png', IMAGE_BUTTON_ALL_PRODUCTS) . '</a>';
        
        echo $firstletter_nav; ?></td>
     </tr>
    <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>
     <tr>
       <td>
<?php
 // create column list
 $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                      'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                      'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER, 
                      'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                      'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                      'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                      'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
                      'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW);
 asort($define_list);

 $column_list = array();
 reset($define_list);
 while (list($column, $value) = each($define_list)) {
   if ($value) $column_list[] = $column; 
 }

 $select_column_list = '';

 for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
   if ( ($column_list[$col] == 'PRODUCT_LIST_BUY_NOW') || ($column_list[$col] == 'PRODUCT_LIST_NAME') || ($column_list[$col] == 'PRODUCT_LIST_PRICE') ) {
     continue;
   }
 }
 
// listing all products
$listing_sql = "select p.products_id, products_weight, p.products_quantity, p.products_model, pd.products_name, pd.products_description, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id  $where";

    if ( (!isset($HTTP_GET_VARS['sort'])) || (!ereg('^[1-8][ad]$', $HTTP_GET_VARS['sort'])) || (substr($HTTP_GET_VARS['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
          $HTTP_GET_VARS['sort'] = $i+1 . 'a';
          $listing_sql .= " order by pd.products_name";
          break;
        }
      }
    } else {
      $sort_col = substr($HTTP_GET_VARS['sort'], 0 , 1);
      $sort_order = substr($HTTP_GET_VARS['sort'], 1);

      switch ($column_list[$sort_col-1]) {
        case 'PRODUCT_LIST_MODEL':
          $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_NAME':
          $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $listing_sql .= " order by m.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_IMAGE':
          $listing_sql .= " order by pd.products_name";
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_PRICE':
          $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
      }
    }

if (ALL_PRODUCTS_DISPLAY_MODE == 'true')
 include(DIR_WS_MODULES . 'product_listing.php'); //display in standard format
else
 include(DIR_WS_MODULES . FILENAME_ALLPRODS);
?>
       </td>
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
   </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'allprods_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_bot_eof //-->
