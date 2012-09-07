<?php

require(DIR_WS_LANGUAGES . $language . '/modules/html_mail/basic/password_forgotten.php');
$ArrayLNTargets = array("\r\n", "\n\r", "\n", "\r", "\t"); //This will be used for taking away linefeeds with str_replace() throughout the mail. Tabs is invisible so we take them away to

$check_customer_query_uhtml = tep_db_query("select customers_gender from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
$check_customer_uhtml = tep_db_fetch_array($check_customer_query_uhtml);
$gender = $check_customer_uhtml['customers_gender'];

	if (ACCOUNT_GENDER == 'true'){
		if($gender == 'm'){
			$HTMLGreet = sprintf(trim(UHE_GREET_MR), $check_customer['customers_insertion'].' '.$check_customer['customers_lastname']);
		}elseif($gender == 'f'){
			$HTMLGreet = sprintf(trim(UHE_GREET_MS), $check_customer['customers_insertion'].' '.$check_customer['customers_lastname']);
		}else{
			$HTMLGreet = sprintf(trim(UHE_GREET_NONE), $check_customer['customers_firstname'].' '.$check_customer['customers_insertion'].' '.$check_customer['customers_lastname']);
		}
	} else {
		$HTMLGreet = sprintf(trim(UHE_GREET_NONE), $check_customer['customers_firstname'].' '.$check_customer['customers_insertion'].' '.$check_customer['customers_lastname']);
	}
	
$html_email = '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body><img src="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/pixel_trans.gif" />

<table width="600" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/password_forgotten/background_top.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="right"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" style="text-decoration:none; color:black;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_GO_TO_STORE.'</font></a></td>
</tr></table>

<table width="600" height="34" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/password_forgotten/background_link_5.png" cellpadding="0" cellspacing="0"><tr valign="middle">
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account_edit.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_EDIT.'</span></font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'address_book.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_ADRESS_BOOK.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account_history.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_ORDERS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account_notifications.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_NOTIFICATIONS.'</font></a></td>
</tr> </table>

<table width="600" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/password_forgotten/background_mid.png" cellpadding="0" cellspacing="0">
		<td width="20" align="center">&nbsp;</td>

		<td>
			<table width="100%" border="0" align="center">
  				<tr>
    				<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'.$HTMLGreet.'</span></span></font></td>
  				</tr>
  				<tr>
    				<td><font face="Tahoma, Times New Roman, Times"><span style="font-size:14px;">'. UHE_TEXT_TOP .' </span></font></td>
  				</tr>
			</table>

			<table width="100%" height="40"border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/password_forgotten/background_box.png" cellpadding="0" cellspacing="0"><tr valign="middle">
  				<tr>
    				<td align="center"><font face="Tahoma, Times New Roman, Times"><span style="font-size:16px;">'. sprintf(UHE_TEXT_PASSWORD, $new_password) .' </span></font></td>
  				</tr>
			</table>

			<table width="100%" border="0" align="center">
  				<tr>
    				<td><font face="Tahoma, Times New Roman, Times"><span style="font-size:14px;">'. UHE_TEXT_BOT .' </span></font></td>
  				</tr>
			</table>

			<table width="100%" border="0" align="center">
  				<tr>
    				<td><font face="Tahoma, Times New Roman, Times"><span style="font-size:14px;">'. sprintf(UHE_SIGNATURE, STORE_NAME, HTTP_SERVER . DIR_WS_CATALOG) .' </span></font></td>
  				</tr>
			</table>
		</td>

		<td width="20" align="center">&nbsp;</td>
</tr></table>

<table width="600" height="31" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/tell_a_friend/background_bot.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="center"><font face="Tahoma, Times New Roman, Times"><span style="font-size: 9px;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_COPYRIGHT.'</span></font></td>
</tr></table>
</body>
</html>';

$html_email = str_replace($ArrayLNTargets, '', $html_email);
?>
