<?php //$Id: /catalog/admin/includes/manual_boxes/manual_checkout.php (osS)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CHECKOUT,
                     'link'  => tep_href_link(FILENAME_CHECKOUT, 'set=payment&selected_box=checkout'));

    $contents[] = array('text'  =>
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CHECKOUT_PAYMENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_PAYMENT . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CHECKOUT_SHIPPING, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_SHIPPING . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CHECKOUT_ORDER_TOTAL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_ORDER_TOTAL . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CHECKOUT_ORDER_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_ORDER_STATUS . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CHECKOUT_CONFIGURATION, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_HEADING_CONFIGURATION . '</a>'
	);
	
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
