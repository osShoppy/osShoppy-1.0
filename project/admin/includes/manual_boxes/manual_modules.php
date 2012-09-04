<?php //$Id: /catalog/admin/includes/manual_boxes/manual_modules.php (osS)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_MODULES,
                     'link'  => tep_href_link(FILENAME_MODULES, 'set=payment&selected_box=modules'));

	$contents[] = array('text'  => 
            '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_AFFILIATE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_HEADING_AFFILIATE . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_HEADER_TAGS_SEO) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_HEADER_TAGS_SEO . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_POLLS) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_POLLS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_LINKS) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_LINKS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_ARTICLES) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_ARTICLES . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_FAQ) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_FAQ_ONE_PAGE . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_FAQS) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_FAQ . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_GENERAL_INFORMATION) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_INFO . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_TEXT_MANAGER) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_LANGUAGE . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_LATEST_NEWS) . '" class="menuBoxContentLink">' . BOX_MODULES_PAGE_MANAGER . '</a>' . 
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_TESTIMONIALS) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_TESTIMONIALS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_REFERENCES) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_REFERENCES . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_DOCUMENTS) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_DOCUMENTS . '</a>' .
			'<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_GALLERY) . '" class="menuBoxContentLink">' . BOX_MODULES_HEADING_GALLERY . '</a>'
	
);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
