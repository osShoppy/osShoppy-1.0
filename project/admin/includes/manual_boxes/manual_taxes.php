<?php //$Id: /catalog/admin/includes/manual_boxes/manual_taxes.php 

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_LOCATION_AND_TAXES,
                     'link'  => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'));

	$contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_TAX_COUNTRIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_COUNTRIES . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_TAX_ZONES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_ZONES . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_TAX_GEO_ZONES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_GEO_ZONES . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_TAX_CLASSES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_TAX_CLASSES . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_TAX_RATES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TAXES_TAX_RATES . '</a>'
	);
	
 foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
