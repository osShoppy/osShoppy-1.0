<?php //$Id: /catalog/admin/includes/boxes/support.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_SUPPORT,
                     'link'  => tep_href_link(FILENAME_INDEX, 'set=payment&selected_box=support'));
    $contents[] = array('text'  =>
								  '<a href="' . tep_href_link(FILENAME_OSSHOPPY_INFO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SUPPORT_OSSHOPPY_INFO . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_OSSHOPPY_MODULES) . '" class="menuBoxContentLink">' . BOX_SUPPORT_OSSHOPPY_MODULES . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_OSSHOPPY_UPDATES) . '" class="menuBoxContentLink">' . BOX_SUPPORT_OSSHOPPY_UPDATES . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_OSSHOPPY_EXTRA) . '" class="menuBoxContentLink">' . BOX_SUPPORT_OSSHOPPY_EXTRA . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_INDEX, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SUPPORT_OSSHOPPY_MANUAL . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_SERVER_INFO) . '" class="menuBoxContentLink">' . BOX_SUPPORT_OSSHOPPY_SERVER_INFO . '</a>' .
								  '<a href="http://hilvy.nl" class="menuBoxContentLink" target="_blank">Hilvy Hosting</a>'
	);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
