<?php //$Id: /catalog/admin/includes/manual_boxes/manual_localization.php (osS)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_LOCALIZATION,
                     'link'  => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization'));

	$contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_LOCALIZATION_CURRENCIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_CURRENCIES . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_LOCALIZATION_LANGUAGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_LANGUAGES . '</a>'
	);
  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
