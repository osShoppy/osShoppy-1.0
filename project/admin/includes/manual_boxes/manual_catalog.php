<?php //$Id: /catalog/admin/includes/manual_boxes/manual_catalog.php (osS) 

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CATALOG,
                     'link'  => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'));

    $contents[] = array('text'  => 
						
								   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_CATEGORIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_MANUFACTURERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MANUFACTURERS . '</a>' .
                                   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_REVIEWS . '</a>' . 
		    			    	   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_STOCK, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_HEADING_STOCK . '</a>' . 
		    			    	   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_MODULES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_HEADING_MODULES . '</a>' . 
            					   '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_CATALOG_PRODUCTS_EXPECTED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_PRODUCTS_EXPECTED . '</a>'
			);
	
  foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
