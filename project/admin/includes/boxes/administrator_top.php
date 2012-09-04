<?php //$Id: /catalog/admin/includes/boxes/administrator_top.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMINISTRATOR_TOP,
                     'link'  => tep_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator_top'));

    $contents[] = array('text'  =>
								'<a href="' . tep_href_link(FILENAME_ADMIN_TOP_NOTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_NOTES . '</a>' .
								'<a href="' . tep_href_link(FILENAME_ADMIN_MEMBERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MEMBERS . '</a>' .
								'<a href="' . tep_href_link(FILENAME_ADMIN_FILES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_BOXES . '</a>' .
								
		   		$adminSub1= '<li><a class="menuBoxContentLink" href="#">'.BOX_ADMIN_TOP_HEADING_ADMIN_CONFIG.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=46', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_ADMIN_INDEX . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=47', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MIN_VALUES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=48', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MAX_VALUES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=40', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_WYSIWYG_CONFIG . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=49', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_OTHER_CONFIG . '</a></li>
    	</ul>
    </li>' .
	
		   		$adminSub2= '<li><a class="menuBoxContentLink" href="#">'.BOX_ADMIN_TOP_HEADING_BASE_CONFIG.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MY_STORE . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=17', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_STORE_MODE . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=5', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CUSTOMER . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=19', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_ANTI_ROBOT . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=16', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CONTACT_US . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=18', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MATC . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=2', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MIN_VALUES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=3', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MAX_VALUES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=61', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_THUMBS . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=71', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_SEO_URLS . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=6', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_MODULES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=9', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_STOCK . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=10', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_LOGGING . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=11', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CACHE . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=12', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_EMAIL . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=13', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_DOWNLOAD . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=14', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_GZIP . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=15', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_SESSIONS . '</a></li>
    	</ul>
    </li>' .
								'<li><a href="' . tep_href_link(FILENAME_STATS_CONFIGURATION_CHANGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CONFIGURATION_CHANGES . '</a></li>' .
								'<li><a href="' . tep_href_link(FILENAME_CONTRIBUTION_TRACKER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ADMIN_TOP_CONTRIBUTION_TRACKER . '</a></li>' 
	);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
