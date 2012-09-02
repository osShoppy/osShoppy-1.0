<?php //$Id: /catalog/product_updates.php (2415)


  define('FIELD_SIZE', 9);  
  define('FIELD_SIZE_MODEL', 15);
  define('DB_TABLE_MPU',			'multi_product_update' );
  define('TD_OPEN', 				'<td class="dataTableContent" width=1%>');
  define('TD_CLOSE', 				'</td>');
  define('TD_OPEN_H', 				'<td class="dataTableHeadingContent" align="center" width=1%>');

#######################################################################
  #									#
  #  SET FILENAME_PRODUCT_UPDATES HERE RATHER THAN IN FILENAMES.PHP	#
  #									#
  #######################################################################

  $here = basename($_SERVER['PHP_SELF']);
  define('FILENAME_PRODUCT_UPDATES', $here);

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_UPDATES);

  $currencies = new currencies();

  #######################################################################
  #									#
  #  Process the URL GET array query string				#
  #									#
  #######################################################################

  $action 	= ((isset($_GET['action']) 	&& (tep_not_null($_GET['action']	))) ? $_GET['action'] 	: '');
  $page 	= ((isset($_GET['page']) 	&& (tep_not_null($_GET['page']		))) ? $_GET['page'] 	: '');
  $search 	= ((isset($_GET['search']) 	&& (tep_not_null($_GET['search']	))) ? $_GET['search'] 	: '');
  $listing 	= ((isset($_GET['listing']) 	&& (tep_not_null($_GET['listing']	))) ? $_GET['listing'] 	: '');

  if($page){ 	$parm_page 	= 'page=' 	. $page		.'&'; }
  if($search){ 	$parm_search	= 'search=' 	. $search	.'&'; }
  if(listing){ 	$parm_listing	= 'listing='	. $listing 	.'&'; }

//  $query_string_parameters = tep_get_all_get_params();

  $query_string_parameters =  $parm_page . $parm_search . $parm_listing;


#################################################
#						#
#   SHOW/HIDE MULTI_PRODUCT_UPDATE COLUMNS	#
#						#
#################################################


// Sets the status of a product
  function set_mpu_col_status($col_id, $col_status) {
    if ($col_status == '1') {
      return tep_db_query("update " . DB_TABLE_MPU . " set mpu_col_status = '1' where mpu_col_id = '" . (int)$col_id . "'");
    } elseif ($col_status == '0') {
      return tep_db_query("update " . DB_TABLE_MPU . " set mpu_col_status = '0' where mpu_col_id = '" . (int)$col_id . "'");
    } else {
      return -1;
    }
  }


  if (isset($_GET['action']) && ($_GET['action'] == 'COL')) {
	set_mpu_col_status($_GET['ID'], $_GET['ST']);
  }


#################################################
#						#
#	MPU COLUMN STATUS ICON			#
#						#
#################################################

  function COL_status_icons($id = '', $status = '', $parameters = ''){

	if ($status == '1') {
		echo  '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, 	'action=COL&ST=0&ID=' . $id .'&'. $parameters, 'NONSSL') . '">' 
		. tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', 'Deactivate', 10, 10) . '</a>' . '&nbsp;&nbsp;&nbsp;';
	} else {
		echo '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, 	'action=COL&ST=1&ID=' . $id .'&'. $parameters, 'NONSSL') . '">' 
		. tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', 'Activate', 10, 10) . '</a>' . '&nbsp;&nbsp;&nbsp;';
	}
  }



	$sql_coloumns 	= "SELECT * FROM multi_product_update";
	$col_result	= tep_db_query($sql_coloumns);
	$show_col 	= tep_db_fetch_array($col_result);

	$column_detials = array();

    do {

	$col_id			= $show_col['mpu_col_id'];
	$col_name		= $show_col['mpu_col_name'];
	$col_display_name	= $show_col['mpu_col_display_name'];
	$col_status		= $show_col['mpu_col_status'];

	$column_details[$col_name]['id'] 	= $col_id;
	$column_details[$col_name]['name'] 	= $col_name;
	$column_details[$col_name]['disname'] 	= $col_display_name;
	$column_details[$col_name]['status'] 	= $col_status;

	$show_col = tep_db_fetch_array($col_result);

    }while($show_col);

  #######################################################################
  #									#
  #  Function to create the sort order arrow links			#
  #									#
  #######################################################################

  function sort_arrows($column_name = '', $listing_prefix = ''){

    echo
	'<td class="dataTableHeadingContent" align="left">'
	. $column_name . '&nbsp;'
	. '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, 'listing=' . $listing_prefix . '">')
	. tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_up.png', TABLE_HEADING_SORT . $column_name . ' A-B-C')
	. '</a>' . '&nbsp;'
	. '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, 'listing=' . $listing_prefix . '-desc' . '">')
	. tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_down.png', TABLE_HEADING_SORT . $column_name . ' Z-X-Y')
	. '</a>'
	. '</td>'
    ;
  }

// need if (listing_prefix){ echo 'listing=',} therefore echo above needs to be broken down.

  ###############
  #		#
  #   UPDATE	#
  #		#
  ###############

  if ($action == 'update') {

    #####################################################################
    #									#
    #	Imagine if a rss channel showing products 			#
    #	with time & date values before they arrive?			#
    #									#
    #	This line prevents the time stored in products_last_modified	#
    #	being earlier than the real one, and helps you to maintain	#
    #	a LIFO (last in - first out) ordered list of products		#
    #									#
    #####################################################################

    $date_in_seconds = (time() - MAX_DISPLAY_SEARCH_RESULTS);
  
    foreach ($_POST['event_record'] as $id => $row) {

//	echo '################################################################## <BR>
//		ROW ' . $id .' 
//	<BR>  ################################################################## <pre>';
//	print_r($row);
//	echo '</pre><BR>';

	// converting date_in_seconds into mysql date
	$seconds_in_date = date("Y-m-d H:i:s", $date_in_seconds); 

	#################################################################
	#								#
	#	Get all products first to make sure we are		#
	#	not updating products that did not change		#
	#								#
	#################################################################

	$products_query = tep_db_query("SELECT * from " . TABLE_PRODUCTS);
	$products = array();

	while($product = tep_db_fetch_array($products_query)){

		$products[$product['products_id']] = array(

			'products_id' 		=> 		 $product['products_id'],
			'products_price' 	=> number_format($product['products_price'], 2, '.', ''),
			'products_weight' 	=> number_format($product['products_weight'], 2, '.', ''),
			'products_quantity' 	=> number_format($product['products_quantity'], 0,'.', ''),
			'products_model' 	=> 		 $product['products_model'],
			'products_image' 	=> 		 $product['products_image'],
			'products_status' 	=> 		 $product['products_status'],
//			'products_ship_price' 	=> 		 $product['products_ship_price']
		);

	} // END WHILE

//	echo '################################################################## <BR>
//		PRODUCTS[PRODUCT[ID]] ' . $id .' 
//	<BR>  ################################################################## <pre>';
//	print_r($products[$id]);
//	echo '</pre><br>';

	#########################################################################
	#									#
	#	strcasecmp — Binary safe case-insensitive string comparison	#
	#									#
	#	str1 - The first string						#
	#	str2 - The second string					#
	#									#
	#	Returns								#
	#		< 0 if str1 is less than str2				#
	#		> 0 if str1 is greater than str2			#
	#		and 0 if they are equal.				#
	#									#
	#	NOTE:	|| = OR							#
	#	E.G.	if( A != 0 OR B != 0 OR c != 0) then do { UPDATE }.	#
	#									#
	#########################################################################

	if( 
		(( $column_details['price']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_price']		,$row['products_price']) 	!= 0)) || 
		(( $column_details['model']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_model']		,$row['products_model']) 	!= 0)) || 
		(( $column_details['weight']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_weight']		,$row['products_weight']) 	!= 0)) || 
		(( $column_details['qty']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_quantity']	,$row['products_quantity']) 	!= 0)) ||
		(( $column_details['image']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_image']		,$row['products_image']) 	!= 0)) ||
		(( $column_details['status']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_status']		,$row['products_status']) 	!= 0)) 
//|| 
//		(( $column_details['idvshp']['status'] 	== 1) && (strcasecmp($products[$row['products_id']]['products_ship_price']	,$row['products_ship_price'])	!= 0))
	) {

	#################################################
	#						#
	#	UPDATE QUERY				#
	#						#
	#################################################

	$sql_do_update =  "UPDATE " . TABLE_PRODUCTS . " SET ";

	if( $column_details['price']['status'] 	== 1){	$sql_do_update .=  "products_price = '" 	. $row['products_price'] 	. "', "; }
	if( $column_details['model']['status'] 	== 1){	$sql_do_update .=  "products_model = '" 	. $row['products_model'] 	. "', "; }
	if( $column_details['weight']['status'] == 1){	$sql_do_update .=  "products_weight = '" 	. $row['products_weight'] 	. "', "; }
	if( $column_details['qty']['status'] 	== 1){	$sql_do_update .=  "products_quantity = '" 	. $row['products_quantity'] 	. "', "; }

	if( $column_details['image']['status'] 	== 1){	$sql_do_update .=  "products_image = '" 	. $row['products_image'] 	. "', "; }
	if( $column_details['status']['status'] == 1){	$sql_do_update .=  "products_status = '" 	. $row['products_status'] 	. "', "; }
//	if( $column_details['idvshp']['status'] == 1){	$sql_do_update .=  "products_ship_price = '" 	. $row['products_ship_price'] 	. "', "; }

	$sql_do_update .=  "products_last_modified = '".$seconds_in_date."' where products_id = '".$row['products_id']."'";

//	echo $sql_do_update;

	tep_db_query($sql_do_update);

// ################################################################################################
//
//	tep_db_query(	
//
//		"UPDATE " 
//		. TABLE_PRODUCTS 
//		. " SET "
//		. "products_price = '" 		. $row['products_price'] 	. "', " 
//		. "products_model = '" 		. $row['products_model'] 	. "', " 
//		. "products_weight = '" 	. $row['products_weight'] 	. "', " 
//		. "products_quantity = '" 	. $row['products_quantity'] 	. "', " 
//		. "products_image = '" 		. $row['products_image'] 	. "', " 
//		. "products_status = '" 	. $row['products_status'] 	. "', "
//	//	. "products_ship_price = '" 	. $row['products_ship_price'] 	. "', "
//		. "products_last_modified = '" 	. $seconds_in_date 		. "'  " 
//		. "where " 
//		. "products_id = '" 		. $row['products_id'] 		. "'"
//
//	); // END UPDATE QUERY
//
// ################################################################################################
		
	$products_updated = true;

	} // END IF strcasecmp

	$date_in_seconds++;


    } // END FOREACH POST EVENT RECORD


    #############################################
    #						#
    #	WARNING / SUCESS MESSAGES		#
    #						#
    #############################################

    if ($products_updated == true) {
    	$messageStack->add_session(SUCCESS_PRODUCTS_UPDATED, 'success');
    } else {
    	$messageStack->add_session(WARNING_PRODUCTS_NOT_UPDATED, 'warning');
    }


    #############################################################################################################
    #														#
    #	REDIRECT												#
    #														#
    #	Redirections modified for to preserve last page 							#
    #	viewed or changed, and sort order of products 								#
    #	(if they have been previously sorted).									#
    #														#
    #	NOTE[1]: 	function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL').		#
    #														#
    #	NOTE[2]: 	SHORTHAND CONDITIONAL STATEMENT: // like if { }else{ }.					#
    #			condition ? value if true : value if false;						#
    #														#
    #############################################################################################################

    tep_redirect(tep_href_link(FILENAME_PRODUCT_UPDATES, $query_string_parameters));


  } // END IF GET KEY IS UPDATE


#################################################
#						#
#   PRODUCT STATUS activate/deactivate		#
#						#
#################################################

  if (isset($_GET['action']) && ($_GET['action'] == 'setflag')) {
	tep_set_product_status($_GET['pID'], $_GET['flag']);
  }

#################################################
#						#
#	ACTIVATE/DEAVTIVATE STATUS		#
#	GREEN & RED SINGLE ITEM CHANGE		#
#	+ MULTI STATUS UPDATE FOR MANY ITEMS	#
#						#
#################################################

  function output_status_icons_and_textbox($pid = '', $pstatus = '', $parameters = ''){

	echo 	TD_OPEN
		. '<table border=0><tr><td>';

	if ($pstatus == '1') {
		echo tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) 
		. '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, 'action=setflag&flag=0&pID=' . $pid .'&'. $parameters, 'NONSSL') . '">' 
		. tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
	} else {
		echo '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES, 'action=setflag&flag=1&pID=' . $pid .'&'. $parameters, 'NONSSL') . '">' 
		. tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp' 
		. tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
	}

	echo 	'</td><td>&nbsp;</td><td>'
		. tep_draw_input_field('event_record[' . $pid . '][products_status]', $pstatus, 'size="1"')
		. '</td></tr></table>'
		. TD_CLOSE;
  }



#################################################
#						#
#   EXPORT TO CSV FILE				#
#						#
#################################################

  if ($_GET['action'] == 'export') {

		$csv_query  =

			tep_db_query(	

				"select * from " 
				. TABLE_PRODUCTS 		. " p, " 
				. TABLE_PRODUCTS_DESCRIPTION 	. " pd, " 
				. TABLE_MANUFACTURERS 		. " m "
				. "where "
				. "p.products_id 	= pd.products_id "
				. "and "
				. "p.manufacturers_id 	= m.manufacturers_id "
				. "group by "
				. "pd.products_name "
				. "order by "
				. "pd.products_name ASC"
			)

		; // END csv_query

		$csv_output = 

			TABLE_HEADING_PRODUCT_ID 	. ","
			. TABLE_HEADING_PMAN 		. ","
			. TABLE_HEADING_PNAME 		. ","
			. TABLE_HEADING_PMODEL 		. ","
			. TABLE_HEADING_PPRICE 		. ","
			. TABLE_HEADING_PWEIGHT 	. ","
			. TABLE_HEADING_PQTY		. "\n"
		;

		while ($csv = tep_db_fetch_array($csv_query)) {

			$csv_output .= 

				$csv['products_id'] 				. "," . 
				$csv['manufacturers_name'] 			. "," . 
				$csv['products_name'] 				. "," . 
				$csv['products_model'] 				. "," . 
				$currencies->format($csv['products_price']) 	. "," . 
				$csv['products_weight'] 			. "," . 
				$csv['products_quantity'] 			. "," . 
//				$csv['products_ship_price'] 			. "," . 
				$csv['products_status'] 			. "\n"

			; // END csv_output

		} // END WHILE

		$saveas = 'product_stock-price_report_' . strftime("%m-%d-%Y");
		header("Content-Disposition: attachment; filename=$saveas.csv");
		print $csv_output;
		exit;

  } // END EXPORT

############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################
############################################################################################################################################################

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">

<title><?php echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">

<?PHP
	#################################################################
	#								#
	#	JavaScript						#
	#								#
	#	Alert Box - need english translation.			#
	#								#
	#################################################################
?>
<script type="text/javascript" language="javascript" src="includes/general.js"></script>

<script language="javascript"><!--
function reemplaza(txt)
	{
	txt.value = txt.value.replace(',', '.');
	}
function validarSiNumero(numero){
	// sea decimal o no
	if (!/^\d+\.?\d*$/.test(numero))
	alert("The value " + numero + " is not valid");
}
function validarSiEntero(numero){
	if (!/^([0-9])*$/.test(numero))
	alert("The value " + numero + " is not whole");
}
//--></script>
</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">

      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
      <!-- left_navigation //-->
      <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
      <!-- left_navigation_eof //-->
      </table>

    </td>



<!-- body_text //-->
    <td width="100%" valign="top">


    <table border="0" width="100%" cellspacing="0" cellpadding="2">


      <tr>
        <td>
	  <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><td class="pageHeading"><?php echo HEADING_TITLE; ?></td></tr>
          </table>
	</td>
      </tr>

      <tr>
	<td class="smallText" align="left">
<?php
		echo tep_draw_form('search', FILENAME_PRODUCT_UPDATES, '', 'get');
		echo IMAGE_SEARCH . ': ' . tep_draw_input_field('search');
		echo '</form>';
?>
	</td>
      </tr>



<tr>
<td>
<?PHP
	foreach($column_details as $key => $value){
 		echo $column_details[$key]['disname'].'&nbsp;';
		COL_status_icons($column_details[$key]['id'], $column_details[$key]['status'], $query_string_parameters);
	}
?>
<br>
<?php // echo 'COLUMN DETAILS<PRE>'; print_r($column_details); echo '</PRE>'; ?>
<?php // echo 'POST <PRE>'; print_r($_POST); echo '</PRE>'; ?>
<?php // echo 'GET<PRE>'; print_r($_GET); echo '</PRE>'; ?>
</td>
</tr>



      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">


	<table border="1" width="100%" cellspacing="0" cellpadding="2">

<?php
	#################################################################################################################
	#														#
	#	NOTE: function tep_draw_form($name, $action, $parameters = '', $method = 'post', $params = '')		#
	#														#
	#################################################################################################################

	echo tep_draw_form('stockprice', FILENAME_PRODUCT_UPDATES, $query_string_parameters . '&action=update', 'post');

	echo '<tr class="dataTableHeadingRow">';

	switch ($listing) {
	case "prod": 
	$order = "p.products_id"; 
	break;
	case "prod-desc": 
	$order = "p.products_id DESC"; 
	break;
	case "manu": 
	$order = "m.manufacturers_name";
	break;
	case "manu-desc": 
	$order = "m.manufacturers_name DESC";
	break;
	case "name": 
	$order = "pd.products_name";
	break;
	case "name-desc": 
	$order = "pd.products_name DESC";
	break;
	case "model":
	$order = "p.products_model";
	break;
	case "model-desc":
	$order = "p.products_model DESC"; 
	break;
	case "quantity":
	$order = "p.products_quantity";
	break;
	case "quantity-desc":
	$order = "p.products_quantity DESC";
	break;
	case "weight": 
	$order = "p.products_weight";
	break;
	case "weight-desc":
	$order = "p.products_weight DESC";
	break;
	case "price":
 	$order = "p.products_price"; 
	break;
	case "price-desc":
 	$order = "p.products_price DESC";
	break;
	case "datetime":
 	$order = "p.products_last_modified";
	break;
	case "datetime-desc":
	$order = "p.products_last_modified DESC";

	case "status":
	$order = "p.products_status";
	break;
	case "status-desc":
	$order = "p.products_status DESC";
	break;
	case "image":
	$order = "p.products_image";
	break;
	case "image-desc":
	$order = "p.products_imge DESC";
	break;
//	case "idvshp":
//	$order = "p.products_ship_price";
//	break;
//	case "idvshp-desc":
//	$order = "p.products_ship_price DESC";

	default:
	//$order = "p.products_model ASC";
	//$order = "p.products_quantity";
	$order = "pd.products_name";
	}

	#########################################################################################################
	#													#
	#    Check if 'search' query is present > do not show the sort arrows					#
	#    If arrows are clicked while showing search results the page is reset and results are lost.		#
	#													#
	#########################################################################################################

	if ($search) {

	    if( $column_details['id']['status']		== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PRODUCT_ID 	. TD_CLOSE; }
	    if( $column_details['manuf']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PMAN 		. TD_CLOSE; }
	    if( $column_details['name']['status']	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PNAME 		. TD_CLOSE; }
	    if( $column_details['status']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_STATUS 		. TD_CLOSE; }
	    if( $column_details['image']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PFILENAME 		. TD_CLOSE; }
	    if( $column_details['model']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PMODEL 		. TD_CLOSE; }
	    if( $column_details['weight']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PWEIGHT 		. TD_CLOSE; }
	    if( $column_details['price']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PPRICE 		. TD_CLOSE; }
	    if( $column_details['qty']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PQTY 		. TD_CLOSE; }
//	    if( $column_details['idvshp']['status'] 	== 1){ 	echo TD_OPEN_H . '£ INDVSHP' 			. TD_CLOSE; }
	    if( $column_details['modif']['status'] 	== 1){ 	echo TD_OPEN_H . TABLE_HEADING_PDATE 		. TD_CLOSE; }
	    							echo '<td>&nbsp;</td>';

	}else{
	    if( $column_details['id']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PRODUCT_ID, 	'prod', 	$query_string_parameters); }
	    if( $column_details['manuf']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PMAN, 	'manu', 	$query_string_parameters); }
	    if( $column_details['name']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PNAME, 	'name', 	$query_string_parameters); }
	    if( $column_details['status']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_STATUS, 			'status', 	$query_string_parameters); }
	    if( $column_details['image']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PFILENAME, 	'image', 	$query_string_parameters); }
	    if( $column_details['model']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PMODEL, 	'model', 	$query_string_parameters); }
	    if( $column_details['weight']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PWEIGHT, 	'weight', 	$query_string_parameters); }
	    if( $column_details['price']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PPRICE, 	'price', 	$query_string_parameters); }
	    if( $column_details['qty']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PQTY, 	'quantity', 	$query_string_parameters); }
//	    if( $column_details['idvshp']['status'] 	== 1){ 	sort_arrows('£_IDVSHP', 		'idvshp', 	$query_string_parameters); }
	    if( $column_details['modif']['status'] 	== 1){ 	sort_arrows(TABLE_HEADING_PDATE, 	'datetime', 	$query_string_parameters); }
	    						echo '<td>&nbsp;</td>';
	}

	echo '</tr>';

// Check if performing a search 
// Then make request to database

    $updates_raw = '';
    $keywords = '';

    if ($search) {

	$keywords = tep_db_input(tep_db_prepare_input($search));

	$updates_raw = 	"select * from "
			. TABLE_PRODUCTS_DESCRIPTION . " pd, " 
			. TABLE_PRODUCTS 
			. " p LEFT JOIN " 
			. TABLE_MANUFACTURERS . " m "
			. "ON "
			. "( p.manufacturers_id = m.manufacturers_id ) "
			. "where "
			. "p.products_id = pd.products_id "
			. "and "
			. "( pd.products_name like '%" . $keywords . "%' "
			. "or "
			. "p.products_model like '%" . $keywords . "%' "
			. "or "
			. "m.manufacturers_name like '%" . $keywords . "%' ) "
			. "and "
			. "pd.language_id = $languages_id "
			. "order by "
			. "pd.products_name"

	; // END updates_raw

    }else{

	$updates_raw = 	"select * from " 
			. TABLE_PRODUCTS_DESCRIPTION . " pd, " 
			. TABLE_PRODUCTS 
			. " p LEFT JOIN " 
			. TABLE_MANUFACTURERS . " m "
			. "ON "
			. "( p.manufacturers_id = m.manufacturers_id ) "
			. "where "
			. "p.products_id = pd.products_id "
			. "and "
			. "pd.language_id = $languages_id "
			. "order by "
			. "$order"

	; // END updates_raw

    } // END IF SEARCH

  $updates_raw_query	= tep_db_query($updates_raw);




  $countrows 		= tep_db_num_rows($updates_raw_query);
  $updates_split 	= new splitPageResults($page, MAX_DISPLAY_SEARCH_RESULTS, $updates_raw, $countrows);




  $updates 		= tep_db_query($updates_raw);

    while ($row = tep_db_fetch_array($updates)) {

	$id 			= 		$row['products_id'];
	$updates_man 		= 		$row['manufacturers_name'];
	$updates_name 		= 		$row['products_name'];
	$updates_model 		= 		$row['products_model'];
	$updates_weight 	= number_format($row['products_weight'], 2, '.', '');
	$updates_price 		= number_format($row['products_price'], 2, '.', '');
	$updates_pqty 		= number_format($row['products_quantity'], 0,'.', '');
	$updates_date 		= 		$row['products_last_modified'];

	$updates_pimg 		= 		$row['products_image'];
	$updates_pstatus	= 		$row['products_status'];
//	$updates_pshpprice	= 		$row['products_ship_price'];


        						echo '<tr class="dataTableRow">';
	if( $column_details['id']['status'] 		== 1){ 	echo TD_OPEN . '<a href="'	. tep_href_link(FILENAME_CATEGORIES, 'pID=' . $id . '&action=new_product') . '">' . $id . "</a><input type='hidden' name='event_record[" . $id . "][products_id]' value='".$id."'>" 	. TD_CLOSE; }
	if( $column_details['manuf']['status'] 		== 1){ 	echo TD_OPEN . $updates_man	. TD_CLOSE; }
	if( $column_details['name']['status'] 		== 1){ 	echo TD_OPEN . '<a href="'	. tep_catalog_href_link('product_info.php', 'products_id=' . $id) . '">' . $updates_name . '</a>' . TD_CLOSE; }
	if( $column_details['status']['status'] 	== 1){	output_status_icons_and_textbox($id, $updates_pstatus, $query_string_parameters); }
	if( $column_details['image']['status'] 		== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_image]', 		$updates_pimg, 		'size="30"'	)										. TD_CLOSE; }
	if( $column_details['model']['status'] 		== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_model]', 		$updates_model, 	'size="' . FIELD_SIZE_MODEL 	. '" readonly')							. TD_CLOSE; }
	if( $column_details['weight']['status'] 	== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_weight]', 		$updates_weight, 	'size="' . FIELD_SIZE 		. '" onBlur="reemplaza(this);validarSiNumero(this.value);"')	. TD_CLOSE; }
	if( $column_details['price']['status'] 		== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_price]', 		$updates_price, 	'size="' . FIELD_SIZE 		. '" onBlur="reemplaza(this);validarSiNumero(this.value);"')	. TD_CLOSE; }
	if( $column_details['qty']['status'] 		== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_quantity]', 		$updates_pqty, 		'size="' . FIELD_SIZE 		. '" onBlur="validarSiEntero(this.value);"')			. TD_CLOSE; }
//	if( $column_details['idvshp']['status'] 	== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_ship_price]', 		$updates_pshpprice, 	'size="6"'	)										. TD_CLOSE; }
	if( $column_details['modif']['status'] 		== 1){	echo TD_OPEN . tep_draw_input_field('event_record[' . $id . '][products_last_modified]', 	$updates_date, 		'size="23" readonly')										. TD_CLOSE; }
							echo '<td>&nbsp;</td>';
        						echo '</tr>';
    } // END WHILE
?>

<TR><TD colspan=12><TABLE border=0 width=100%>
              <tr>
                <td colspan="11"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
		<td colspan="9" align="right"  valign="center"><?php echo PRODUCT_UPDATE ?></td>
                <td colspan="1" align="center" valign="center"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE); ?></form></td>
		<td colspan="1">&nbsp;</td>
              </tr>
              <tr>
		<td colspan="9" align="right"  valign="center"><?php echo PRODUCT_SAVE ?></td>
                <td colspan="1" align="center" valign="center"><?php echo tep_draw_form('stockprice_report', FILENAME_PRODUCT_UPDATES, 'action=export', 'post'); ?><?php echo tep_image_submit('button_save.png', IMAGE_SAVECSV); ?></form></td>
		<td colspan="1">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="11"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText" align="left" 	colspan="6"><?php echo $updates_split->display_count($countrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                <td class="smallText" align="center" 	colspan="5"><?php echo $updates_split->display_links($countrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], tep_get_all_get_params(array('page', 'x', 'y', 'products_id'))); ?>&nbsp;</td>
              </tr>
</TABLE></TD></TR>

            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
