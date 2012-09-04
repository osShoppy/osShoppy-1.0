<?php //$Id: /catalog/admin/includes/boxes/administrator_mid.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMIN_MID,
                     'link'  => tep_href_link(FILENAME_INDEX, 'selected_box=administrator_mid'));

    $contents[] = array('text'  =>
								'<a href="' . tep_href_link(FILENAME_ADMIN_MID_NOTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_MID_NOTES . '</a>'
	);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
