<?php //$Id: /catalog/admin/gallery_upload.php (6181)

require('includes/application_top.php');
    
if (isset($_POST['fotouploaden']) && $_POST['fotouploaden']='Upload') {	
	foreach ($_FILES["uploadedfile"]["error"] as $key => $error) {
		if ($error == UPLOAD_ERR_OK) {
      // check how many pictures that customer has already uploaded
      $customer_id = $_POST['add_superuser'];
      if ($customer_id==""){
					$messageStack->add_session(UPLOAD_ERROR_THREE.' '. UPLOAD_ERROR_TWO,'error');
      }else{
				$sql = mysql_query("SELECT * FROM gallery WHERE cID=".$customer_id);
				$i = mysql_num_rows($sql);
	
				$allowed_extensions = array('jpg','JPG');
				$file = $_FILES['uploadedfile'];
				
				//DEAL with some errors
				if (! preg_match('#\.(.+)$#', $file['name'][$key], $matches)) {
					$messageStack->add_session(UPLOAD_ERROR_FIVE,'error');
					break;
				}
				if (! in_array($matches[1], $allowed_extensions)) {
				  $messageStack->add_session(UPLOAD_ERROR_SIXA.'{'.$matches[1].'}'.UPLOAD_ERROR_SIXB,'error');
					break;
				}
				if ($file['size'][$key]>100000) {
					$messageStack->add_session(UPLOAD_ERROR_FOUR,'error');
					break;
				}
				if (!$file['type'][$key] == 'image/jpg') {
					$messageStack->add_session(UPLOAD_ERROR_SEVEN,'error');
					break;
				}
				if (!is_uploaded_file($file['tmp_name'][$key])) {
					$messageStack->add_session(UPLOAD_ERROR_EIGHT,'error');
					break;
				}
				if (!getimagesize($file['tmp_name'][$key])) {
					$messageStack->add_session(UPLOAD_ERROR_NINE,'error');
					break;
				}
				
				$size=getimagesize($file['tmp_name'][$key]);
				$width=$size[0];
				$height=$size[1];
				if ($width>800){
					$messageStack->add_session(UPLOAD_ERROR_TEN,'error');
					break;
				}
				if ($height>600){
					$messageStack->add_session(UPLOAD_ERROR_ELEVEN,'error');
					break;
				}
				
				$target_path = DIR_FS_CATALOG."gallery/";						
				
				//bepalen welke de eerste vrije fotonummer is voor deze klant
				//identify the first free photo number for this customer
				$gebruikte_nummers = array();
				while($fotos = mysql_fetch_array($sql)){
						$gebruikte_nummers[] = $fotos['pID'];
				}
					
				$n = 1;
				while ($n <= $i ) {
					if (!in_array($n,$gebruikte_nummers)) {
						break;
					}
					$n ++;
				}
					
				$target_path = $target_path . $customer_id."_".$n.".jpg";			
				if(copy($file['tmp_name'][$key], $target_path)) {
					$messageStack->add_session(UPLOAD_SUCCESS_ONE. ' '. basename($file['name'][$key]). ' '.UPLOAD_SUCCESS_TWO,'success');
					mysql_query("INSERT INTO gallery (cID,pID) VALUES (".$customer_id.",".$n.")");
				} else{
					$messageStack->add_session(UPLOAD_ERROR_ONE.' '. basename($file['name'][$key]). UPLOAD_ERROR_TWO,'error');
				}
			} //end if cust_id=""
		}//if
	}//foreach
	  tep_redirect(tep_href_link(FILENAME_GALLERY_UPLOAD, '', 'NONSSL'));
}//if
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
          <tr>
            <td class="smallText" align="left"><?php echo TEXT_INFORMATION; ?> </td>
          </tr>
        </table></td>
      </tr>
      <tr>
				<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>          
						<?php       
						// #### Get Available Customers
						$query = tep_db_query("select a.customers_id, a.customers_firstname, a.customers_lastname, b.entry_city, c.zone_code 
																	 from " . TABLE_CUSTOMERS . " AS a, " . 
																	 TABLE_ADDRESS_BOOK . " AS b 
																	 LEFT JOIN " . TABLE_ZONES . " as c 
																	 ON (b.entry_zone_id = c.zone_id) 
																	 WHERE a.customers_default_address_id = b.address_book_id  
																	 ORDER BY entry_company,customers_lastname");
						$result = $query;
					
						if (tep_db_num_rows($result) > 0){
							// Query Successful
							//$SelectCustomerBox = "<select name='add_superuser'><option value=''>" . TEXT_SELECT_CUST . "</option>\n";
							while($db_Row = tep_db_fetch_array($result)){ 
								$SelectCustomerBox .= "<option value='" . $db_Row['customers_id'] . "'";
								if(isSet($HTTP_GET_VARS['add_superuser']) and $db_Row['customers_id']==$HTTP_GET_VARS['add_superuser']){
									$SelectCustomerBox .= " SELECTED ";
									$SelectCustomerBox .= ">" . $db_Row['customers_lastname'] . " , " . $db_Row['customers_firstname'] . " - " . $db_Row['entry_city'] . "</option>\n";
								}else{
									$SelectCustomerBox .= ">" . $db_Row['customers_lastname'] . " , " . $db_Row['customers_firstname'] . " - " . $db_Row['entry_city'] . "</option>\n";
								}
							}
							$SelectCustomerBox .= "</select>\n";
						// #### Get Available Customers
						} 
						?>
						
						<form enctype="multipart/form-data" action="gallery_upload.php" method="POST">
				      <?php
				        //$i=1;
				        echo CHOOSE_FILE.': <br>';
				        //while ($i < 6) {
				          $i ++;
							    $SelectCustomerBox_actual = "<select name='add_superuser'><option value=''>" . TEXT_SELECT_CUST . "</option>\n";
				          echo '<input type="file" name="uploadedfile[]" />';
				          $SelectCustomerBox_actual.=$SelectCustomerBox;
				          echo $SelectCustomerBox_actual . '<br>';
				        //}
				      ?>
              <input type="submit" name="fotouploaden" value="Upload" />
						</form>
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