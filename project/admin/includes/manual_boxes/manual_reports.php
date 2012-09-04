<?php //$Id: /catalog/admin/includes/manual_boxes/manual_reports.php (osS)

$heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_REPORTS,
                     'link'  => tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'));

	$contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_REPORTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_VIEWED . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_REPORTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_PURCHASED . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_REPORTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_ORDERS_TOTAL . '</a>' . 
								   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_REPORTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_STOCK_LEVEL . '</a>'
	);
	
 foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>

