<?php // gifts info infobox 
 
  // retreive the gifts  
  $gift_list_query = tep_db_query("SELECT p.products_id, p.products_image, p.products_status, p.products_carrot, pd.products_id, pd.products_name FROM products p, products_description pd WHERE pd.language_id = '".$languages_id."'
			AND p.products_id = pd.products_id AND p.products_status = '1' AND p.products_carrot = '1' ORDER BY pd.products_name ASC");
    
  if (tep_db_num_rows($gift_list_query)) {

  $boxHeading = BOX_HEADING_GIFTS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'gifts';

      $gifts_string = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
      while ($gift_list = tep_db_fetch_array($gift_list_query)) { 
        $gifts_string .= '  <tr>' .
                         ' <td class="infoBoxContents" align=center>' .
                         '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $gift_list['products_id']) . '">' .
                         tep_image(DIR_WS_IMAGES . $gift_list['products_image'],GIFT_INFOBOX_IMAGE_WIDTH, GIFT_INFOBOX_IMAGE_HEIGHT) . '</a><br>' . 
                         '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $gift_list['products_id']) . '">' . $gift_list['products_name'] . '</a></td>' .
                         //'    <td class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $gift_list['products_id']) . '">' . $gift_list['products_name'] . '</a></td>' .
                         '    <td class="infoBoxContents" align="right" valign="top"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=cust_order&pid=' . $gift_list['products_id']) . '">'  . '</a></td>' .
                         '  </tr><tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '10') .'</td></tr>';
      }
      $gifts_string .= '</table>';

  $box_id = $box_base_name . 'Box';
  $boxContent = $gifts_string;
  include (bts_select('boxes', $box_base_name));
  }   
?>