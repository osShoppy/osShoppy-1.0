<?php //$Id: /catalog/admin/includes/boxes/checkout.php (6440)

  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CHECKOUT,
                     'link'  => tep_href_link(FILENAME_CHECKOUT, 'set=payment&selected_box=checkout'));

    $contents[] = array('text'  =>
								'<a href="' . tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_PAYMENT . '</a>' .
                                '<a href="' . tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_SHIPPING . '</a>' .
                                '<a href="' . tep_href_link(FILENAME_MODULES, 'set=giftwrap', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_ORDER_GIFTWRAP . '</a>' .
                                '<a href="' . tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_ORDER_TOTAL . '</a>' .
                                '<a href="' . tep_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_ORDER_STATUS . '</a>' .
								
		    	$modulesSub8= '<li><a class="menuBoxContentLink" href="#">'.BOX_CHECKOUT_HEADING_CONFIGURATION.'</a>
		<ul>
			<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=41', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_CONFIGURATION_PAYMENT . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=42', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_CONFIGURATION_SHIPPING . '</a></li>
            <li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=43', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_CONFIGURATION_ORDER_TOTAL . '</a></li>
    		<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=44', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CHECKOUT_CONFIGURATION_ORDER_STATUS . '</a></li>
    	</ul>
    </li>'
	);
	
   foreach($contents as $value) {	  
   echo '<li>'.$value['text'].'</li>';
}
?>
