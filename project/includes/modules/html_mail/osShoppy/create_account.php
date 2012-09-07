<?php
require(DIR_WS_LANGUAGES . $language . '/modules/html_mail/basic/create_account.php');
$ArrayLNTargets = array("\r\n", "\n\r", "\n", "\r", "\t"); //This will be used for taking away linefeeds with str_replace() throughout the mail. Tabs is invisible so we take them away to

$ActivationCodeControlLoginContent = str_replace($ArrayLNTargets, '<br />', UHE_WELCOME . UHE_ACCOUNT_CONTROL_LOGIN  . "\n\n" . UHE_TEXT_ACTIVATION . "\n" . '<center>' .  UHE_TEXT_ACTIVATION_CODE . '<b>' . $activation_code . '</b></center>' . "\n" . UHE_TEXT . "\n" . UHE_USERNAME_TEXT . "\n" . UHE_USERNAME . "\n" . UHE_PASSWORD . "\n\n" . UHE_CONTACT . UHE_WARNING);
$ActivationCodeContent = str_replace($ArrayLNTargets, '<br />', UHE_WELCOME . UHE_TEXT_ACTIVATION . "\n" . '<center>' .  UHE_TEXT_ACTIVATION_CODE . '<b>' . $activation_code . '</b></center>' . "\n" . UHE_TEXT . "\n" . UHE_USERNAME_TEXT . "\n" . UHE_USERNAME . "\n" . UHE_PASSWORD . "\n\n" . UHE_CONTACT . UHE_WARNING);
$ActivationCodeLink = str_replace($ArrayLNTargets, '<br />', "\n" . $verification_link);
$ControlLoginContent = str_replace($ArrayLNTargets, '<br />', UHE_WELCOME . UHE_ACCOUNT_CONTROL_LOGIN . UHE_TEXT . "\n" . UHE_USERNAME_TEXT . "\n" . UHE_USERNAME . "\n" . UHE_PASSWORD . "\n\n" . UHE_CONTACT . UHE_WARNING);
$HTMLMailMainContent = str_replace($ArrayLNTargets, '<br />', UHE_WELCOME . UHE_TEXT . "\n" . UHE_USERNAME_TEXT . "\n" . UHE_USERNAME . "\n" . UHE_PASSWORD . "\n\n" . UHE_CONTACT . UHE_WARNING);
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

<table width="600" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account/background_top.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="right"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" style="text-decoration:none; color:black;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_GO_TO_STORE.'</font></a></td>
</tr></table>

<table width="600" height="34" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account/background_link_5.png" cellpadding="0" cellspacing="0"><tr valign="middle">
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=1" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'specials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_SPECIALS.'</span></font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'products_new.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_NEW_PRODUCTS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'testimonials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_TESTIMONIALS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'reviews.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_REVIEWS.'</font></a></td>
</tr> </table>

<table width="600" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account/background_mid.png" cellpadding="0" cellspacing="0">
		<td width="20" align="center">&nbsp;</td>

		<td>';
		if (ACTIVATION_CODE == 'true') { 
				$html_email .='
			<table width="100%" border="0" align="center">';
			if(CONTROL_LOGIN == 'true') { 
				$html_email .='
				<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'.$HTMLGreet.'</span></span></font></td>
		  		</tr>
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times">'. $ActivationCodeControlLoginContent .' </font></td>
		  		</tr>';
			} else { 
				$html_email .='
				<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'.$HTMLGreet.'</span></span></font></td>
		  		</tr>
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times">'. $ActivationCodeContent .' </font></td>
		  		</tr>';
			}
				$html_email .='
			</table>';
		} else {
				$html_email .='
			<table width="100%" border="0" align="center">';
			if(CONTROL_LOGIN == 'true') { 
				$html_email .='
				<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'.$HTMLGreet.'</span></span></font></td>
		  		</tr>
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times">'. $ControlLoginContent .' </font></td>
		  		</tr>';
			} else { 
				$html_email .='
				<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'.$HTMLGreet.'</span></span></font></td>
		  		</tr>
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times">'. $HTMLMailMainContent.' </font></td>
		  		</tr>';
			}
				$html_email .='
			</table>';
		}
		$html_email .='
		</td>

		<td width="20" align="center">&nbsp;</td>
</tr></table>

<table width="600" height="10" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account/background_line.png" cellpadding="0" cellspacing="0"><tr valign="middle">
<td></td>
</tr></table>

<table width="600" height="90" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/checkout_process/background_footer.png" cellpadding="0" cellspacing="0"><tr valign="top">
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

<table width="600" height="31" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account/background_bot.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="center"><font face="Tahoma, Times New Roman, Times"><span style="font-size: 9px;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_COPYRIGHT.'</span></font></td>
</tr></table>';

if (ACTIVATION_CODE == 'true') { 
		$html_email .='
<table width="600" height="25" border="0" align="center" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td>&nbsp;</td>
</tr></table>

	<table width="800" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/create_account/background_activation_link1.png" cellpadding="0" cellspacing="0"><tr valign="middle">
		<td width="20" align="center">&nbsp;</td>
		<td width="760" align="center"><font face="Tahoma, Times New Roman, Times">'. $ActivationCodeLink .' </font></td>
		<td width="20" align="center">&nbsp;</td>
	</tr></table>';
}
		$html_email .='
</body>
</html>';

$html_email = str_replace($ArrayLNTargets, '', $html_email);
?>