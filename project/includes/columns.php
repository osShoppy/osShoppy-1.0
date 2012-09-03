<?php //$Id: /catalog/includes/columns.php (1175)

$column_query = tep_db_query('select configuration_column AS cfgcol, configuration_title AS cfgtitle, configuration_value AS cfgvalue, configuration_key AS cfgkey, box_heading from ' . TABLE_THEME_CONFIGURATION . ' WHERE configuration_value = \'yes\' AND configuration_column = \'' . $myColumn  . '\' ORDER BY location');
while ($column = tep_db_fetch_array($column_query)) {
  $column['cfgtitle'] = str_replace(' ', '_', $column['cfgtitle']);
  $column['cfgtitle'] = str_replace("'", '', $column['cfgtitle']);

  define($column['cfgkey'],$column['box_heading']);

  if ( file_exists(DIR_WS_BOXES . $column['cfgtitle'] . '.php') ) {
    switch ($column['cfgtitle']) {
    	case "categories":
    	  if ((USE_CACHE == 'true') && empty($SID)) {
    	  	echo tep_cache_ . $column['cfgtitle'] . _box();
    	  } else {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
    	  }
   	  	//echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  break;
    	case "manufacturers":
    	  if ((USE_CACHE == 'true') && empty($SID)) {
    	  	echo tep_cache_ . $column['cfgtitle'] . _box();
    	  } else {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
    	  }
   	  	//echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  break;
    	case "manufacturer_info":
    	  if (isset($HTTP_GET_VARS['products_id'])) {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  }
    	  break;
    	case "tell_a_friend":
    	  if (isset($HTTP_GET_VARS['products_id'])) {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  }
    	  break;
    	case "qr_code":
	if(USE_QR_ALL_PAGES == 'true') {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
	} else {
    	  if (isset($HTTP_GET_VARS['products_id'])) {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  }
	}
    	  break;
    	case "whats_new":
    	  if (!isset($HTTP_GET_VARS['products_id'])) {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  }
    	  break;
    	case "specials":
    	  if (!isset($HTTP_GET_VARS['products_id'])) {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  }
    	  break;
    	case "featured":
    	  if (!isset($HTTP_GET_VARS['products_id'])) {
    	  	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	  }
    	  break;  	   
    	 case "order_history":
  		   if (tep_session_is_registered('customer_id') && (! tep_session_is_registered('customer_is_guest')) ){
    	   	require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
          //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    	   }
    	   break; 	    	  
  	  default:
  	    require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
        //echo '<tr><td>' . tep_draw_separator('pixel_trans.gif', '100%', '4') . '</td></tr>';
    }
  }
}
?>