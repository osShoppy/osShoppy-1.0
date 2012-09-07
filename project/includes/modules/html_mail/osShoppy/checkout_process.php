<?php

require(DIR_WS_LANGUAGES . $language . '/modules/html_mail/basic/checkout_process.php');
$ArrayLNTargets = array("\r\n", "\n\r", "\n", "\r", "\t"); //This will be used for taking away linefeeds with str_replace() throughout the mail. Tabs is invisible so we take them away to

for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {//walk through the order totals and create a string containing them
	//The title sometimes ends with ':' and somtimes not and sometimes there is a space. Take it all away =)
	$temp_title = trim(strip_tags($order_totals[$i]['title']));
	if(substr($temp_title, -1) == ':'): $temp_title = substr($temp_title, 0, -1); endif;
	
	$HTMLEmailOrderTotals .= '<em>'. $temp_title .': </em><strong>' . strip_tags($order_totals[$i]['text']) . "</strong>\n";
}

//Now we chall create an array with the attribute info for every product.
$HTML_Email_product_attributes = array();

for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
	if (isset($order->products[$i]['attributes'])) {//This product has attributes
		$HTML_Email_product_attributes[$i] ='';//make sure the array position is a string
		for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
			if (DOWNLOAD_ENABLED == 'true') {
			  $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
								   from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
								   left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
									on pa.products_attributes_id=pad.products_attributes_id
								   where pa.products_id = '" . $order->products[$i]['id'] . "' 
									and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
									and pa.options_id = popt.products_options_id 
									and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
									and pa.options_values_id = poval.products_options_values_id 
									and popt.language_id = '" . $languages_id . "' 
									and poval.language_id = '" . $languages_id . "'";
			  $attributes = tep_db_query($attributes_query);
			} else {
			  $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
			}
			$attributes_values = tep_db_fetch_array($attributes);
			
			$HTML_Email_product_attributes[$i] .= '<br /><em style="font-size:12px;">&nbsp;&nbsp;&nbsp;-'. $attributes_values['products_options_name'] . ':&nbsp;' . $attributes_values['products_options_values_name'] .'</em>';
		}
	}else{ //This product does not have attributes
		$HTML_Email_product_attributes[$i] ='';
	}
}




$html_email = '<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body><img src="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/pixel_trans.gif" />

<table width="600" height="80" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/checkout_process/background_top.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="right"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" style="text-decoration:none; color:black;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_GO_TO_STORE.'</font></a></td>
</tr></table>

<table width="600" height="34" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/checkout_process/background_link_5.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'index.php?cPath=1" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_CATEGORIES.'</font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'specials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_SPECIALS.'</span></font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'products_new.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_NEW_PRODUCTS.'</font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'testimonials.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_TESTIMONIALS.'</font></a></td>
	<td width="120" align="center"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'reviews.php" style="text-decoration:none; color:black;"><span style="font-size: 12px;"><color="black" style="margin-left:0.3em; text-decoration:none; color:black;">'.LINK_REVIEWS.'</font></a></td>
</tr> </table>

	<table width="600" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/checkout_process/background_mid.png" cellpadding="0" cellspacing="0">
		<td width="20" align="center">&nbsp;</td>

		<td>
			<table width="100%" border="0" align="center">
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size:14px;"><span style="font-size: 24px;">'.UHE_TEXT_DEAR . ' ' . $order->customer['firstname'] . ' ' . $order->customer['insertion'] . ' ' . $order->customer['lastname'].',</span><br/>'.UHE_MESSAGE_GREETING.'</span></font></td>
		  		</tr>
			</table>
			<table width="100%" border="0" align="center">
		    	<td width="200"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;"><strong>'.UHE_TEXT_ORDER_NUMBER.'</strong></font></td>
                <td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">&nbsp;'.$insert_id.'</font></td>
			</table>
			<table width="100%" border="0" align="center">
		    	<td width="200"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;"><strong>'.UHE_TEXT_INVOICE_URL.'</strong></font></td>
                <td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">&nbsp;<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) .'">' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) .'</a></font></td>
			</table>
			<table width="100%" border="0" align="center">
		    	<td width="200"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;"><strong>'.UHE_TEXT_DATE_ORDERED.'</strong></font></td>
                <td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">&nbsp;'.strftime(DATE_FORMAT_LONG).'</font></td>
			</table>
			<table width="100%" border="0" align="center">
		  		<tr>
		    		<td><font face="Tahoma, Times New Roman, Times"><span style="font-size:14px;">';
					if ($order->info['comments']) {// Add the customers order comments If the exists.
		    		$html_email .= '<strong>'.UHE_TEXT_COMMENTS.'</strong><br />
		    		<font face="Courier New, Courier, monospace" size="-1">'. str_replace($ArrayLNTargets, '<br />
		    		', tep_db_output($order->info['comments'])) .'</font><br />
		    		';
		  		}
		
					//Now we will add a table containing the products of the order.
					$html_email .=' <br />
			        <strong>'.UHE_TEXT_ORDER_CONTENTS.'</strong><br />
                    </span></font></td>
		  		</tr>
            </table>
			<table width="100%" border="0" align="center">
			<tr style="background-color:#666666; color:#FFFFFF; font-weight:bold;"> 
				<td align="left" width="210"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.UHE_TEXT_PRODUCTS_ARTICLE.'</font></td>
				<td align="left" width="150"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.UHE_TEXT_PRODUCTS_MODEL.'</font></td>
				<td align="center" width="100"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.UHE_TEXT_PRODUCTS_PRICE.'</font></td>
				<td align="center" width="40"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.UHE_TEXT_PRODUCTS_QTY.'</font></td>
				<td align="right" width="100"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.UHE_TEXT_PRODUCTS_TOTAL.'</font></td>
			</tr>';
			for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {//Add one row for each product. The array $order exists already in checkout_process.php; to which we will include this file.
			$html_email .='
			<tr style="background-color:#DDDDDD;"> 
				<td valign="top" align="left"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.$order->products[$i]['name'] . $HTML_Email_product_attributes[$i].'</font></td>
				<td valign="top" align="left"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.$order->products[$i]['model'].'</font></td>
				<td valign="top" align="center"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.$currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], 1).'</font></td>
				<td valign="top" align="center"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.$order->products[$i]['qty'].'</font></td>
				<td valign="top" align="right"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'.$currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']).'</font></td>
			</tr>';
			}
		$html_email .='
			</table>
			<table width="100%" border="0" align="center">
		  		<tr>
		<br />
		'.str_replace($ArrayLNTargets, '<br />', $HTMLEmailOrderTotals).'
		<br />';
		
		if (is_object($$payment)) {
			$html_email .= '<strong>'.UHE_TEXT_PAYMENT_METHOD . ': </strong>'. $order->info['payment_method'] . '<br />';
    		$payment_class = $$payment;
			if ($payment_class->email_footer) { 
      			$html_email .=str_replace($ArrayLNTargets, '<br />', $payment_class->email_footer).'<br />';
    		}else{
				$html_email .= '<br />';
			}
  		}$html_email .=		  		'</tr>
            </table>
		<table style="font-size:14px; font-family:\'Tahoma, Times New Roman, Times\';" border="0" cellpadding="3" cellspacing="2">
			<tr style="background-color:#666666; color:#FFFFFF; font-weight:bold;">';
				if ($order->content_type != 'virtual') {
					$html_email .= '<td width="160"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'. UHE_TEXT_DELIVERY_ADDRESS .'</font></td>';
				}
				$html_email .= '<td width="160"><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'. UHE_TEXT_BILLING_ADDRESS .'</font></td>
			</tr>
			<tr style="background-color:#DDDDDD;">';
				if ($order->content_type != 'virtual') {
					$html_email .= '<td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'. tep_address_label($customer_id, $sendto, 0, '', '<br />') .'</font></td>';
				}
				$html_email .= '<td><font face="Tahoma, Times New Roman, Times" style="font-size:14px;">'. tep_address_label($customer_id, $billto, 0, '', '<br />') .'</font></td>
			</tr>
		</table>
		';

$html_email .= '

		</td>

		<td width="20" align="center">&nbsp;</td>
</tr></table>

<table width="600" height="10" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/checkout_process/background_line.png" cellpadding="0" cellspacing="0"><tr valign="middle">
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

<table width="600" height="31" border="0" align="center" background="'. HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_MODULES .'html_mail/'.HTML_EMAIL_LAYOUT.'/images/checkout_process/background_bot.png" cellpadding="0" cellspacing="0"><tr valign="middle">
	<td align="center"><font face="Tahoma, Times New Roman, Times"><span style="font-size: 9px;"><color="black" style="margin-right:0.3em; text-decoration:none; color:black;">'.LINK_COPYRIGHT.'</span></font></td>
</tr></table>

</body>
</html>';

//This erases the newlines =) if this is not done the mail sent will have adittional <br /> in it. 
//Why? Hint: look at the function tep_convert_linefeeds and where it is used.

$html_email = str_replace($ArrayLNTargets, '', $html_email);
?>