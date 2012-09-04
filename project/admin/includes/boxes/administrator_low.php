<?php //$Id: /catalog/admin/includes/boxes/administrator_low.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMIN_LOW,
                     'link'  => tep_href_link(FILENAME_INDEX, 'set=payment&selected_box=administrator'));

    $contents[] = array('text'  =>
								'<a href="' . tep_href_link(FILENAME_ADMIN_LOW_NOTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_LOW_NOTES . '</a>'
	);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
