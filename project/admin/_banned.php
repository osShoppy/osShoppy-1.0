<?php //$Id: /catalog/admin/_banned.php (1561)

  require('includes/application_top.php');

  $banip_query = tep_db_query("select * from banned_ip");

//Routine to update the IP addresses
if ($HTTP_POST_VARS['ip_update']) {
    $count = 0;

  while (list($key, $value) = each($ip_update)) {
    $sql = "UPDATE banned_ip SET bannedip = '" . $value . "' WHERE id_banned = $key";
    $update = tep_db_query($sql);

    $count_i++;
 }
    echo header('Refresh:1;');
    $messageStack->add("Changes done, refreshing page.", 'success');
 }
 
//Routine to add an IP address
if ($HTTP_POST_VARS['ip_add']) {
   $new_ip = mysql_real_escape_string($_POST['ip_add']);
   
   $sql = "INSERT into banned_ip (id_banned, bannedip) VALUES ('','$new_ip')";
   $update = tep_db_query($sql);
   
   echo header('Refresh:1;');
   $messageStack->add("Changes done, refreshing page.", 'success');
 }
//Routine to remove an IP address
if ($HTTP_POST_VARS['ip_remove']) {
   $ip = mysql_real_escape_string($_POST['ip_remove']);
   
   $sql = "DELETE from banned_ip WHERE bannedip = '$ip'";
   $update = tep_db_query($sql);
   
   echo header('Refresh:1;');
 }
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
<!-- body_text //-->
  		<td valign="top">
		  <table border="0" width="100%" cellspacing="0" cellpadding="0">
      		<tr>
        	  <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '30'); ?></td>
      		</tr>
			<tr>					
			  <td class="pageHeading" width="80"><?php echo HEADING_TITLE_BANNED ?></td>
            </tr>
      		<tr>
        	  <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '30'); ?></td>
      		</tr>
            <tr>
					<td class="smallText" align="center" width="100"><?php echo TEXT_ADD_IP ?>
					<form method="POST" action="_banned.php">
					<?php echo '<input type="text" size="50" name="ip_add">'; ?>
					<input type="submit" name="submit1" value="Add"> 
					</form>
					</td>
            </tr>
			<tr>
					<td valign="top" colspan="2">
						<table border="0" width="100%" cellspacing="0" cellpadding="2">
							<tr class="dataTableHeadingRow">
								<td class="dataTableHeadingContent" width="50%"><?php echo TEXT_IP_ADDRESS ?></td>
							</tr>
							<form method="POST" action="_banned.php">
							<?php
							while($banip = tep_db_fetch_array($banip_query))
							{
						     ?>
							<tr valign="top">
                                          <?php echo '<td class="dataTableContent"><input type="text" size="50" name="ip_update[' . $banip['id_banned'] . ']" value="' . $banip['bannedip'] . '">'; ?>
                                          <?php echo '<input type="checkbox" name="ip_remove" value="' . $banip['bannedip'] . '">'; ?><?php echo TEXT_REMOVE_IP ?>
							</tr>
							<?php
							}
							?>
                                          <br>
                                          <br>
                                          <input type="submit" name="submit" value="Update"> 
							</form>
						</table></td>
				    </tr>
				  </table></td>
			  </tr>
			</table>
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