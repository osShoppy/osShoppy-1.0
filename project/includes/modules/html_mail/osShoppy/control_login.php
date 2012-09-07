<?php
require(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $language . '/modules/html_mail/basic/control_login.php');
$ArrayLNTargets = array("\r\n", "\n\r", "\n", "\r", "\t"); //This will be used for taking away linefeeds with str_replace() throughout the mail. Tabs is invisible so we take them away to

$HTMLMailMainContent = str_replace($ArrayLNTargets, '<br />', UHE_ACTIVATE_GREETING. ' ' .$firstname. ",\n\n".UHE_ACTIVATE_MESSAGE."\n\n".STORE_OWNER_EMAIL_ADDRESS."\n\n".STORE_NAME_ADDRESS."\n\n".UHE_ACTIVATE_SIGNOFF."\n\n".STORE_OWNER.", ".STORE_NAME);
//	$message = EMAIL_ACTIVATE_GREETING. ' ' .$firstname. ",\n\n".EMAIL_ACTIVATE_MESSAGE."\n\n".STORE_OWNER_EMAIL_ADDRESS."\n\n".STORE_NAME_ADDRESS."\n\n".EMAIL_ACTIVATE_SIGNOFF."\n\n".STORE_OWNER.", ".STORE_NAME;

$formname = $insertion . ' ' . $lastname;

	if(ACCOUNT_GENDER == 'true'){
		if($gender == 'm'){
			$HTMLGreet = sprintf(trim(UHE_GREET_MR), $formname);
		}elseif($gender == 'f'){
			$HTMLGreet = sprintf(trim(UHE_GREET_MS), $formname);
		}else{
			$HTMLGreet = sprintf(trim(UHE_GREET_NONE), $firstname.' '.$formname);
		}
	} else {
		$HTMLGreet = sprintf(trim(UHE_GREET_NONE), $firstname.' '.$formname);
	}
	
$html_email = '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body><img src="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/pixel_trans.gif" />

<table width="600" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account_admin/background_top.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="right"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" style="text-decoration:none; color:black;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_GO_TO_STORE.'</font></a></td>
</tr></table>

<table width="600" height="34" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account_admin/background_link_5.png" cellpadding="0" cellspacing="0"><tr valign="middle">
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=1" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'specials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_SPECIALS.'</span></font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'products_new.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_NEW_PRODUCTS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'testimonials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_TESTIMONIALS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'reviews.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_REVIEWS.'</font></a></td>
</tr> </table>

<table width="600" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account_admin/background_mid.png" cellpadding="0" cellspacing="0">
		<td width="20" align="center">&nbsp;</td>

		<td>
			<table width="100%" border="0" align="center">
				<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'.$HTMLGreet.'</span></span></font></td>
		  		</tr>
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times">'. $HTMLMailMainContent.' </font></td>
		  		</tr>
			</table>
		</td>

		<td width="20" align="center">&nbsp;</td>
</tr></table>

<table width="600" height="10" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account_admin/background_line.png" cellpadding="0" cellspacing="0"><tr valign="middle">
<td></td>
</tr></table>

<table width="600" height="90" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account_admin/background_footer.png" cellpadding="0" cellspacing="0"><tr valign="top">
		<td width="80" align="center">&nbsp;</td>
		<td width="130" align="center">
			<table width="100%" border="0" align="center">
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account_edit.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_EDIT.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'address_book.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_ADRESS_BOOK.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account_history.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_ORDERS.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'account_notifications.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_ACCOUNT_NOTIFICATIONS.'</font></a></td></tr>
			</table>
		</td>
		<td width="130" align="center">
			<table width="100%" border="0" align="center">
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'conditions.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CONDITIONS.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'privacy.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_PRIVACY.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'shipping.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_SHIPPING.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'shipping.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_PAYMENT.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'contact_us.php" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CONTACT_US.'</font></a></td></tr>
			</table>
		</td>
		<td width="130" align="center">
			<table width="100%" border="0" align="center">
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=1" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=2" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=3" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=4" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td></tr>
        <tr><td height="11px"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=5" style="text-decoration:none; color:black;"><span style="font-size: 10px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td></tr>
			</table>
		</td>
		<td width="130" align="center">&nbsp;</td>
</tr></table>

<table width="600" height="31" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account_admin/background_bot.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="center"><font face="Tahoma, Times New Roman, Times"><span style="font-size: 9px;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_COPYRIGHT.'</span></font></td>
</tr></table>

</body>
</html>';

$html_email = str_replace($ArrayLNTargets, '', $html_email);
?>