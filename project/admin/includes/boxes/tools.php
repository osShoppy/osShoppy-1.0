<?php //$Id: /catalog/admin/includes/boxes/tools.php (6440) 

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(FILENAME_BACKUP, 'selected_box=tools'));
	 
    $contents[] = array('text'  =>
			$toolsSub1= '<a class="menuBoxContentLink" href="#">'.BOX_TOOLS_HEADING_TEMPLATE.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=30', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_HEADER_CONFIG . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=31', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_TITLE_CONFIG . '</a></li>' .
			
			$toolsSub2= '<li><a class="menuBoxContentLink" href="#">'.BOX_TOOLS_HEADING_INDEX_PAGES_CONFIG.'</a>
					<ul>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=34', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_INDEX_DEFAULT_CONFIG . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=35', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_INDEX_NESTED_CONFIG . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=36', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_INDEX_PRODUCT_CONFIG . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=33', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_PRODUCT_CONFIG . '</a></li>
    				</ul>
    					</li>' .
			$toolsSub3= '<li><a class="menuBoxContentLink" href="#">'.BOX_TOOLS_HEADING_OTHER_PAGES_CONFIG.'</a>
					<ul>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=260', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_CUSTOMER_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=261', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_SHIPPING_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=262', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_PRIVACY_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=263', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_CONDITIONS_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=264', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_PAYMENT_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=265', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_SHOPPING_CART_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=266', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_ALL_PRODS_CONFIG . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=267', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_PRODUCT_REVIEWS . '</a></li>
    				</ul>
    					</li>' .
			'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=37', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_INFO_BOXES_CONFIG . '</a></li>' .
				
					$toolsSub4= '<li><a class="menuBoxContentLink" href="#">'.BOX_TOOLS_HEADING_INFOBOX_EXCLUDE.'</a>
					<ul>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=116', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_FEATURED . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=166', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SPECIALS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=100', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AFFILIATE . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=102', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ARTICLES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=104', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_AUTHORS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=180', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_INFO_ARTICLES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=182', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_INFO_AUTHORS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=136', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ORDER_HISTORY . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=138', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_PAYMENT_INFO . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=108', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATEGORIES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=110', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATEGORIES_DROPDOWN . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=113', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATEGORIES_DYNAMENU . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=111', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATEGORIES_FLYOUT . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=112', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATEGORIES_IMAGES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=196', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_DOCUMENTS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=194', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_POLLS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=130', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MANUFACTURERS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=132', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MANUFACTURER_INFO . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=176', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_FAQ_ARTICLES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=178', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_FAQ_AUTHORS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=188', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_GALLERY_PLAIN . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=190', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_GALLERY_SLIDESHOW . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=204', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_FREE_DOWNLOADS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=120', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=122', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_SEO . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=124', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_INFORMATION . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=202', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_GIFTS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=206', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERGROUP . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=128', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOGINBOX . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=184', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LIVE_SUPPORT . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=186', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LATEST_NEWS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=134', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ONLINERS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=106', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_BEST_SELLERS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=133', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MY_ACCOUNT . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=170', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_WHATS_NEW . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=142', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_RECENTLY_VIEWED . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=140', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_PRODUCT_NOTIFICATIONS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=208', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_QRCODE . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=144', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REVIEWS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=200', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REFERENCES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=146', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SCR_BEST_SELLERS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=148', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SCR_SPECIALS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=150', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SCR_WHATS_NEW . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=126', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LANGUAGES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=192', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TESTIMONIALS . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=114', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CURRENCIES . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=168', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TELL_FRIEND . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=156', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SHIPPING_INFO . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=118', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_FOLLOW_US . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=158', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SHOP_BY_PRICE_DROP . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=160', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SHOP_BY_PRICE_TEXT . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=162', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SHOPPING_CART . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=164', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SHOPPING_CART_SMALL . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=172', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_WISHLIST . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=174', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_YOUTUBE . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=152', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SEARCH . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=154', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_SEARCH_TAGCLOUD . '</a></li>
    				</ul>
    							</li> 
			<li><a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_BOXES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=38', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_INPUT_CONFIG . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=39', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_IMAGES_CONFIG . '</a></li>' .
			
			$toolsSu4= '<li><a class="menuBoxContentLink" href="#">'.BOX_TOOLS_HEADING_BANNER_MANAGER.'</a>
					<ul>
						<li><a href="' . tep_href_link(FILENAME_BANNER_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_BANNER_MANAGER . '</a></li>
						<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=73', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_BANNER_MANAGER_CONFIG . '</a></li>
    				</ul>
    					</li>' .
             '<li><a href="' . tep_href_link(FILENAME_SITEMAP) . '" class="menuBoxContentLink">' . BOX_TOOLS_SITEMAP . '</a></li>
		</ul>' .  

		'<li><a href="' . tep_href_link(FILENAME_BACKUP) . '" class="menuBoxContentLink">' . BOX_TOOLS_BACKUP . '</a></li>' .
        '<li><a href="' . tep_href_link(FILENAME_CACHE) . '" class="menuBoxContentLink">' . BOX_TOOLS_CACHE . '</a></li>' .
        '<li><a href="' . tep_href_link(FILENAME_FILE_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_FILE_MANAGER . '</a></li>'
	);
		  
 foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
