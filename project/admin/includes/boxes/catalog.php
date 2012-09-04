<?php //$Id: /catalog/admin/includes/boxes/catalog.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CATALOG,
                     'link'  => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'));

    $contents[] = array('text'  =>
						
				$catalogSub1= '<a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_CATALOG.'</a>
					<ul>
		  						    <li><a href="' . tep_href_link(FILENAME_CATEGORIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS . '</a></li>
                                    <li><a href="' . tep_href_link(FILENAME_ADDITIONAL_IMAGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_IMAGES_PRODUCTS . '</a></li>
    								<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=50', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_CONFIG . '</a></li>
    				</ul>
    		</li>' .  
                                   '<li><a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES . '</a>' .
                                   '<li><a href="' . tep_href_link(FILENAME_MANUFACTURERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MANUFACTURERS . '</a>' .
                                   '<li><a href="' . tep_href_link(FILENAME_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_REVIEWS . '</a>' . 
		    	
				$catalogSub2= '<li><a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_STOCK.'</a>
					<ul>
    								<li><a href="' . tep_href_link(FILENAME_STATS_STOCK_ACTIVE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_PRODUCTS_ACTIVE . '</a></li>
    								<li><a href="' . tep_href_link(FILENAME_STATS_STOCK_INACTIVE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_PRODUCTS_INACTIVE . '</a></li>
    								<li><a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_LOW_STOCK . '</a></li>
    								<li><a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK_ATTRIB, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_STATS_LOW_STOCK_ATTRIB . '</a></li>
    								<li><a href="' . tep_href_link(FILENAME_QTPRODOCTOR, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_QTPRO_DOCTOR . '</a></li>
									<li><a href="' . tep_href_link(FILENAME_STATS_STOCK_EXCELL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_PRODUCTS_EXCEL . '</a></li>
            						<li><a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_PRODUCTS_UPDATE . '</a></li>
            						<li><a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_STOCK_PRODUCTS_MULTI . '</a></li>
    				</ul>
    		</li>' .  

		    	$catalogSub3= '<li><a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_MODULES.'</a>
					<ul>
            						<li><a href="' . tep_href_link(FILENAME_GET_1_FREE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_GET_1_FREE . '</a></li>' .
					
									$catalogSub3= '<li><a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_MODULES_DISCOUNT_CATEGORIES.'</a>
										<ul>
							        		<li><a href="' . tep_href_link(FILENAME_DISCOUNT_CATEGORIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_CREATE_DISCOUNT_CATEGORIES . '</a></li>
    										<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=75', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_DISCOUNT_CATEGORIES_CONFIG . '</a></li>
										</ul>
    									</li>' . 
									$catalogSub3= '<li><a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_MODULES_2GETHER.'</a>
										<ul>
							        		<li><a href="' . tep_href_link(FILENAME_2GETHER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_2GETHER . '</a></li>
    										<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=68', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_2GETHER_CONFIG . '</a></li>
										</ul>
    									</li>' . 
									$catalogSub4= '<li><a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_MODULES_CARROT.'</a>
										<ul>
							        		<li><a href="' . tep_href_link(FILENAME_GIFT_ADD, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_CARROT . '</a></li>
    										<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=67', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_CARROT_CONFIG . '</a></li>
										</ul>
    									</li>' . 
									$catalogSub5= '<li><a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_MODULES_RELATED_PRODUCTS.'</a>
										<ul>
							        		<li><a href="' . tep_href_link(FILENAME_RELATED_PRODUCTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_RELATED_PRODUCTS . '</a></li>
    										<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=63', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_RELATED_PRODUCTS_CONFIG . '</a></li>
										</ul>
    									</li> 
            						<li><a href="' . tep_href_link(FILENAME_SPECIALS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_SPECIALS . '</a></li>
                                    <li><a href="' . tep_href_link(FILENAME_FEATURED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MODULES_FEATURED_PRODUCTS . '</a></li>
				   </ul>
    			</li>' .  
            						'<li><a href="' . tep_href_link(FILENAME_PRODUCTS_EXPECTED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_PRODUCTS_EXPECTED . '</a></li>'
			);
	
  foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
