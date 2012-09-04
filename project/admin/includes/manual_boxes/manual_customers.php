<?php //$Id: /catalog/admin/includes/manual_boxes/manual_customers.php (osS)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CUSTOMERS,
                     'link'  => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'));

    $contents[] = array('text'  => 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_NEWSLETTERS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_NEWSLETTER_MANAGER . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_ORDERS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_ORDERS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_RETURNS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_RETURNS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_POINTS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_POINTS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_COUPONS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_GV_ADMIN . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_REPORTS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_REPORTS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_CONFIG) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_CONFIG_CUSTOMER . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_MAIL) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_CONFIG_EMAIL . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CUSTOMERS_QUOTES) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_HEADING_QUOTES . '</a>' 
		     );
	
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
