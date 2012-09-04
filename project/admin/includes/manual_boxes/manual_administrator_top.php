<?php //$Id: /catalog/admin/includes/manual_boxes/manual_administrator_top.php (osS)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMINISTRATOR_TOP,
                     'link'  => tep_href_link(FILENAME_ADMIN_MEMBERS, 'set=payment&selected_box=administrator_top'));

    $contents[] = array('text'  =>'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_MEMBERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MEMBERS . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_FILES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_BOXES . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_ADMIN_CONTROL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_HEADING_ADMIN_CONFIG . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_BASE_CONTROL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_HEADING_BASE_CONFIG . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_NOTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_NOTES . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_STATS_CONFIGURATION_CHANGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CONFIGURATION_CHANGES . '</a>' .
								  '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_CONTRIBUTION_TRACKER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CONTRIBUTION_TRACKER . '</a>'
	);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
