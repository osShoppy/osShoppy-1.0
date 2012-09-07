<?php

require(DIR_WS_LANGUAGES . $language . '/modules/html_mail/basic/tell_a_friend.php');
$ArrayLNTargets = array("\r\n", "\n\r", "\n", "\r", "\t"); //This will be used for taking away linefeeds with str_replace() throughout the mail. Tabs is invisible so we take them away to

$html_email = '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body><img src="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/pixel_trans.gif" />

<table width="600" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/tell_a_friend/background_top.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="right"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" style="text-decoration:none; color:black;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_GO_TO_STORE.'</font></a></td>
</tr></table>

<table width="600" height="34" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/tell_a_friend/background_link_5.png" cellpadding="0" cellspacing="0"><tr valign="middle">
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=1" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'specials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_SPECIALS.'</span></font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'products_new.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_NEW_PRODUCTS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'testimonials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_TESTIMONIALS.'</font></a></td>
<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'create_account.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_REGISTER.'</font></a></td>
</tr> </table>

<table width="600" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/tell_a_friend/background_mid.png" cellpadding="0" cellspacing="0"><tr valign="middle">
		<td width="20" align="center">&nbsp;</td>

		<td>
			<table width="100%" border="0" align="center">
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size: 24px;">'. sprintf(UHE_GREET, $to_name) .'</span></span></font><p>'. sprintf(UHE_INTRO, $from_name, $product_info['products_name'], STORE_NAME).'</p></td>
		  		</tr>
		  		<tr>
		    		<td><font face="Times New Roman, Times, serif"><span style="font-size:14px;">';

				if (tep_not_null($message)) {// Add the comments If the exists.
					$html_email .= '<strong>'.sprintf(UHE_TEXT_COMMENTS, $from_name).'</strong><br />
					<font face="Courier New, Courier, monospace" size="-1">'. str_replace($ArrayLNTargets, '<br />
					', $message) .'</font><br />
					<br />
					';
				}

				$html_email.= UHE_LINK . '<br />
				<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL', false) . '">' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id'], 'NONSSL', false) . '</a><br />
				<br />
				' . sprintf(UHE_SIGNATURE, STORE_NAME, HTTP_SERVER . DIR_WS_CATALOG).' </span></font></td>
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