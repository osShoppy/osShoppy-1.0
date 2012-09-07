<?php

require(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $language . '/modules/html_mail/basic/orders.php');
$ArrayLNTargets = array("\r\n", "\n\r", "\n", "\r", "\t"); //This will be used for taking away linefeeds with str_replace() throughout the mail. Tabs is invisible so we take them away to

$html_email = '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body><img src="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/pixel_trans.gif" />

<table width="600" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/orders/background_top.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="right"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" style="text-decoration:none; color:black;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_GO_TO_STORE.'</font></a></td>
</tr></table>

<table width="600" height="34" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/orders/background_link_5.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=1" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'specials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_SPECIALS.'</span></font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'products_new.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_NEW_PRODUCTS.'</font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'testimonials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_TESTIMONIALS.'</font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'reviews.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_REVIEWS.'</font></a></td>
</tr> </table>

<table width="600" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/orders/background_mid.png" cellpadding="0" cellspacing="0">
		<td width="20" align="center">&nbsp;</td>

		<td>
			<table width="100%" border="0" align="center">
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size:14px;"><span style="font-size: 24px;">'. UHE_TEXT_DEAR .' '. $check_status['customers_name'] .',</span><br/>
		    		  '. UHE_MESSAGE_GREETING .'<br/>
		    		  <br/>
                      <strong>'.UHE_TEXT_STATUS.'</strong> '. $orders_status_array[$status] .'<br />
                      <br />
                      ';
		
		if ($comments != '') {// Add the customers order comments If the exists.
    		$html_email .= '<strong>'.UHE_TEXT_COMMENTS.'</strong><br />
    		<font face="Courier New, Courier, monospace" size="-1">'. str_replace($ArrayLNTargets, '<br />
    		', $comments) .'</font><br />
    		<br />
    		';
  		}
		
		$html_email .='</span></font></td>
		  		</tr>
			</table>
			<table width="100%" border="0" align="center">
		    		  <td width="200"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;"><strong>'.UHE_TEXT_ORDER_NUMBER.'</strong></font></td>
                    <td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">&nbsp;'.$oID.'</font></td>
		  		</tr>
			</table>
			<table width="100%" border="0" align="center">
		    		  <td width="200"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;"><strong>'.UHE_TEXT_DATE_ORDERED.'</strong></font></td>
                    <td><font face="Times New Roman, Times, serif" style="font-size:14px;">&nbsp;'.tep_date_long($check_status['date_purchased']).'</font></td>
		  		</tr>
			</table>
			<table width="100%" border="0" align="center">
		    		  <td width="200"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;"><strong>'.UHE_TEXT_INVOICE_URL.'</strong></font></td>
                    <td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">&nbsp;<a href="' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') .'">' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') .'</a></font></td>
		  		</tr>
			</table>
		</td>

		<td width="20" align="center">&nbsp;</td>
</tr></table>

<table width="600" height="10" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/orders/background_line.png" cellpadding="0" cellspacing="0"><tr valign="middle">
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

<table width="600" height="31" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/orders/background_bot.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="center"><font face="Tahoma, Times New Roman, Times"><span style="font-size: 9px;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_COPYRIGHT.'</span></font></td>
</tr></table>

</body>
</html>';

$html_email = str_replace($ArrayLNTargets, '', $html_email);
?>
