<?php //$Id: /catalog/admin/includes/manual_boxes/manual_tools.php (osS)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(FILENAME_BACKUP, 'selected_box=tools'));
	 
    $contents[] = array('text'  =>
								   '<li><a href="' . tep_href_link(FILENAME_MANUAL_CAT_TEMPLATE) . '" class="menuBoxContentLink">' . BOX_TOOLS_HEADING_TEMPLATE . '</a></li>' .
								   '<li><a href="' . tep_href_link(FILENAME_MANUAL_CAT_TOOLS_BACKUP) . '" class="menuBoxContentLink">' . BOX_TOOLS_BACKUP . '</a></li>' .
                                   '<li><a href="' . tep_href_link(FILENAME_MANUAL_CAT_TOOLS_CACHE) . '" class="menuBoxContentLink">' . BOX_TOOLS_CACHE . '</a></li>' .
                                   '<li><a href="' . tep_href_link(FILENAME_MANUAL_CAT_TOOLS_FILE_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_FILE_MANAGER . '</a></li>'
	);
		  
 foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
<!-- tools_eof //-->
