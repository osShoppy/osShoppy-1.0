<?php //$Id: /catalog/admin/includes/boxes/modules.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_MODULES,
                     'link'  => tep_href_link(FILENAME_MODULES, 'set=payment&selected_box=modules'));

	$contents[] = array('text'  => 
				$modulesSub1= '<a class="menuBoxContentLink" href="#">'.BOX_CATALOG_HEADING_AFFILIATE.'</a>
		 <ul>
			 <li><a href="' . tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_SUMMARY . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_PAYMENT . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_SALES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_SALES . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_CLICKS . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_BANNER_MANAGER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_BANNERS . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_NEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_NEWS . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_NEWSLETTERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_NEWSLETTER_MANAGER . '</a></li>
             <li><a href="' . tep_href_link(FILENAME_AFFILIATE_CONTACT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_AFFILIATE_CONTACT . '</a></li>
    		 <li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=60', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_AFFILIATE_CONFIG . '</a></li>
		</ul>
    </li>' .

				$modulesSub2= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_HEADER_TAGS_SEO.'</a>
		<ul>
    		<li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_SEO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_HEADER_TAGS_ADD_A_PAGE . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_FILL_TAGS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_HEADER_TAGS_FILL_TAGS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_SILO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_SILO . '</a></li>
   		    <li><a href="' . tep_href_link(FILENAME_HEADER_TAGS_TEST, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_HEADER_TAGS_TEST . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=85', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_HEADER_TAGS_CONFIG . '</a></li>
    	</ul>
    </li>' .
		    
				$modulesSub3= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_POLLS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_POLLS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_POLLS . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_POLLS, 'action=config', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_POLLS_CONFIG . '</a></li>
		</ul>
    </li>' .
		    
				$modulesSub4= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_LINKS.'</a>
		<ul>
 			<li><a href="' . tep_href_link(FILENAME_LINKS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_LINK_CATEGORIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS_CATEGORIES . '</a></li> 
            <li><a href="' . tep_href_link(FILENAME_LINKS_CONTACT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS_CONTACT . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_LINKS_EXCHANGE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS_EXCHANGE . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_LINKS_FEATURED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS_FEATURED . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_LINKS_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS_STATUS . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=66', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_LINKS_CONFIG . '</a></li>
        </ul>
    </li>' .

		   		$modulesSub5= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_ARTICLES.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_ARTICLES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_TOPICS_ARTICLES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_ARTICLE_MANAGER_BLOG_COMMENTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_BLOGS_ARTICLES . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_AUTHORS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ARTICLES_AUTHORS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_ARTICLE_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ARTICLES_REVIEWS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_ARTICLES_XSELL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ARTICLES_XSELL . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=95', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_ARTICLES_CONFIG . '</a></li>
    	</ul>
    </li>' .

		   		$modulesSub6= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_FAQ_ONE_PAGE.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_FAQ_MANAGER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_MANAGER . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_FAQ_VIEW, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_VIEW . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_FAQ_VIEW_ALL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_VIEW_ALL . '</a></li>
    	</ul>
    </li>' .

				$modulesSub7= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_FAQ.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_FAQS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_TOPICS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_FAQS_AUTHORS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_AUTHORS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_FAQS_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_REVIEWS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_FAQS_XSELL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_XSELL . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=96', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_FAQ_CONFIG . '</a></li>
    	</ul>
    </li>' .

		   		$modulesSub8= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_INFO.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_GENERAL_INFORMATION, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_INFO_TOPICS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_GENERAL_INFORMATION_AUTHORS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_INFO_AUTHORS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_GENERAL_INFORMATION_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_INFO_REVIEWS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_GENERAL_INFORMATION_XSELL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_INFO_XSELL . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=97', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_INFO_CONFIG . '</a></li>
    	</ul>
    </li>' .

				$modulesSub9= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_LANGUAGE.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_DEFINE_MAINPAGE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_MAINPAGE . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_DEFINE_CONDITIONS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_CONDITIONS . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_DEFINE_PRIVACY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_PRIVACY . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_DEFINE_SHIPPING, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_SHIPPING . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_DEFINE_PAYMENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_PAYMENT . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_DEFINE_ABOUT_US, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_ABOUT_US . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_DEFINE_LANGUAGE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DEFINE_LANGUAGE . '</a></li>
    	</ul>
	</li>' .  

			'<li><a href="' . tep_href_link(FILENAME_PAGE_MANAGER) . '" class="menuBoxContentLink">' . BOX_MODULES_PAGE_MANAGER . '</a></li>' .

				$modulesSub10= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_TESTIMONIALS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_TESTIMONIALS_MANAGER . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=62', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_TESTIMONIALS_CONFIG . '</a></li>
    	</ul>
	</li>' .  
					
				$modulesSub11= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_REFERENCES.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_REFERENCES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_REFERENCE_MANAGER . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=64', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_REFERENCE_CONFIG . '</a></li>
    	</ul>
	</li>' .  

				$modulesSub12= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_DOCUMENTS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_DOCUMENTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DOCUMENTS . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=65', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_DOCUMENTS_CONFIG . '</a></li>
    	</ul>
	</li>' .  

		    	$modulesSub13= '<li><a class="menuBoxContentLink" href="#">'.BOX_MODULES_HEADING_GALLERY.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_GALLERY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_GALLERY . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_GALLERY_UPLOAD, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_GALLERY_UPLOAD . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_GALLERY_SUPERUSERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_GALLERY_SUPERUSERS . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=98', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_MODULES_GALLERY_CONFIG . '</a></li>
    	</ul>
    </li>'
	);
		  
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
