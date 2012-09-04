<?php //$Id: /catalog/admin/includes/boxes/customers.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CUSTOMERS,
                     'link'  => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'));

    $contents[] = array('text'  => 
		    $customersSub1= '<a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_CUSTOMERS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_CUSTOMERS . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_ALL_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ALL_CUSTOMERS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_CREATE_ACCOUNT . '</a></li>
    	</ul>
    </li>' .

		    $customersSub2= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_ORDERS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_ORDERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ORDERS . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CREATE_ORDER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_CREATE_ORDER . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=45', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ORDER_CONFIGURATION . '</a></li>
    	</ul>
    </li>' .

		    $customersSub3= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_RETURNS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_RETURNS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_RETURNS_MAIN . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_RETURNS_REASONS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_RETURNS_REASONS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_REFUND_METHODS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_REFUNDS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_RETURNS_STATUS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_RETURNS_STATUS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_RETURNS_TEXT) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_RETURNS_TEXT . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=70', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_RETURN_CONFIGURATION . '</a></li>
    	</ul>
    </li>' .

		    $customersSub4= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_POINTS.'</a>
		<ul>
            <li><a href="' . tep_href_link(FILENAME_CUSTOMERS_POINTS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_POINTS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_CUSTOMERS_POINTS_PENDING, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_POINTS_PENDING . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_CUSTOMERS_POINTS_REFERRAL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_POINTS_REFERRAL . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=77', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_POINTS_CONFIGURATION . '</a></li>
    	</ul>
    </li>' .

		    $customersSub5= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_GV_ADMIN.'</a>
		<ul>
 			<li><a href="' . tep_href_link(FILENAME_COUPON_ADMIN, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_COUPON_ADMIN . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_GV_QUEUE, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_GV_ADMIN_QUEUE . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_STATS_CREDITS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_STATS_CREDITS . '</a></li> 
            <li><a href="' . tep_href_link(FILENAME_GV_MAIL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_GV_ADMIN_MAIL . '</a></li> 
            <li><a href="' . tep_href_link(FILENAME_GV_SENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_GV_ADMIN_SENT . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=76', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_COUPON_CONFIGURATION . '</a></li>
    	</ul>
    </li>' .
		
		    $customersSub6= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_REPORTS.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_PRODUCTS_VIEWED . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_PRODUCTS_PURCHASED . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_WHOS_ONLINE) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_WHOS_ONLINE . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_SUPERTRACKER, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_SUPERTRACKER . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_STATS_REFERRAL_SOURCES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_REFERRAL_SOURCES . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ORDERS_TOTAL . '</a></li>
		</ul>
    </li>' .

		    $customersSub7= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_CONFIG_EMAIL.'</a>
		<ul>
            <li><a href="' . tep_href_link(FILENAME_MAIL) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_MAIL . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_NEWSLETTERS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_NEWSLETTER_MANAGER . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_NEWSLETTERS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_PRODUCTS_NOTIFICATIONS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_NOTIFICATIONS) . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_STATS_PRODUCTS_NOTIFICATIONS . '</a></li>
    	</ul>
    </li>' . 

			$customersSub8= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_TICKETS.'</a>
		<ul>
    		<li><a href="' . tep_href_link(FILENAME_TICKET_VIEW, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_VIEW . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_TICKET_REPLY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_REPLY . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_TICKET_ADMIN, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_ADMIN . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_TICKET_DEPARTMENT, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_DEPARTMENT . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_TICKET_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_STATUS . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_TICKET_PRIORITY, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_PRIORITY . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=80', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_TICKETS_CONFIG . '</a></li>
    	</ul>
    </li>' . 

			$customersSub9= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_QUOTES.'</a>
		<ul>
            <li><a href="' . tep_href_link(FILENAME_QUOTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_QUOTES . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=72', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_QUOTES_CONFIG . '</a></li>
    	</ul>
    </li>' .

			$customersSub10= '<li><a class="menuBoxContentLink" href="#">'.BOX_CUSTOMERS_HEADING_CONFIG_CUSTOMER.'</a>
		<ul>
			<li><a href="' . tep_href_link('customers_groups.php', '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_GROUPS . '</a></li>
            <li><a href="' . tep_href_link('_banned.php', '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_BAN_IP_ADDRESS . '</a></li> 
            <li><a href="' . tep_href_link(FILENAME_REFERRALS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_REFERRALS . '</a></li>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=69', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_WISHLIST . '</a></li>
    	</ul>
    </li>' 
			
		     );
	
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
