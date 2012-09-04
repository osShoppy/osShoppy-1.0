<?php //$Id: /catalog/admin/includes/boxes/reports.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_REPORTS,
                     'link'  => tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'));

	$contents[] = array('text'  =>
								'<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_VIEWED . '</a>' .
                                '<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_PURCHASED . '</a>' .
                                '<a href="' . tep_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_ORDERS_TOTAL . '</a>' . 
								'<a href="' . tep_href_link(FILENAME_STATS_STOCK_ACTIVE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_STOCK_PRODUCTS_ACTIVE . '</a>' .
								'<a href="' . tep_href_link(FILENAME_STATS_STOCK_INACTIVE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_STOCK_PRODUCTS_INACTIVE . '</a>' .
								'<a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_STOCK_LOW_STOCK . '</a>' .
								'<a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK_ATTRIB, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_STOCK_STATS_LOW_STOCK_ATTRIB . '</a>' .
								'<a href="' . tep_href_link(FILENAME_STATS_WISHLISTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_WISHLIST . '</a>' .
								'<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_NOTIFICATIONS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_STATS_PRODUCTS_NOTIFICATIONS . '</a>' .
								'<a href="' . tep_href_link(FILENAME_SUPERTRACKER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_SUPERTRACKER . '</a>' .
					            '<a href="' . tep_href_link(FILENAME_STATS_REFERRAL_SOURCES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_REFERRAL_SOURCES . '</a>'
	);
	
 foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
