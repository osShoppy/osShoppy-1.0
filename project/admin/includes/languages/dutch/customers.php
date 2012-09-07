<?php //$Id: /catalog/admin/includes/languages/dutch/customers.php

define('HEADING_TITLE', 'Klanten');
define('HEADING_TITLE_SEARCH', 'Zoeken:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_FIRSTNAME', 'Voornaam');
define('TABLE_HEADING_INSERTION', 'tussenvoegsel');
define('TABLE_HEADING_LASTNAME', 'Achternaam');
define('TABLE_HEADING_ACCOUNT_CREATED', 'DOB');
define('TABLE_HEADING_REFERRED_BY', 'Gevonden');
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actie');

define('ENTRY_CUSTOMER_NOTES_BACKEND','Klant Opmerkingen:<br><small>(alleen zichtbaar in admin)</small>');
define('ENTRY_CUSTOMER_NOTES_FRONTEND','Klant Opmerkingen:<br><small>(ook zichtbaar op klant account pagina)</small>');
define('ENTRY_CUSTOMER_NOTES_ALERT', 'Waarschuwing in klant account box?'); 
define('ENTRY_CUSTOMER_NOTES_EXAMPLES', '<small>
	   									 < font color=grey>Er zijn geen nieuwe berichten.< /font>< br><br>
	   									 < font color=green>Er staat een nieuw bericht op uw account pagina!< /font>< br><br>
	   									 < font color=green>U heeft een nieuw bericht van ' . STORE_NAME . '.< /font>< br><br>
										 < font color=green>Er is een persoonlijk bericht van ' . STORE_NAME . ' voor u!< /font>< br><br>
										 < a href=account.php>klik hier</a>
										 </small>');
define('TEXT_INFO_CUSTOMER_NOTES_BACKEND','<b>Klant Opmerkingen:</b><br><small>(alleen zichtbaar in admin)</small>');
define('TEXT_INFO_CUSTOMER_NOTES_FRONTEND','<b>Klant Opmerkingen:</b><br><small>(ook zichtbaar op klant account pagina)</small>');
define('TEXT_INFO_CUSTOMER_NOTES_ALERT', '<b>Waarschuwing in klant account box?</b>'); 
define('ENTRY_NOTES_YES', 'Ja'); 
define('ENTRY_NOTES_NO', 'Nee'); 
define('TEXT_DATE_ACCOUNT_CREATED', 'Account gemaakt:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Laatst gewijzigd:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Laatste login:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Aantal logins:');
define('TEXT_INFO_COUNTRY', 'Land:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Recensies geschreven:');
define('TEXT_DELETE_INTRO', 'Weet u zeker dat u deze klant wil verwijderen?');
define('TEXT_DELETE_REVIEWS', 'Verwijder %s recensie(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Verwijder klant');
define('TYPE_BELOW', 'Typ hieronder');
define('PLEASE_SELECT', 'Selecteer');

define('ENTRY_CUSTOMERS_EMAIL_VALIDATED','E-mail Activering:');
define('ENTRY_EMAILVALIDATE_YES', 'account geactiveerd');
define('ENTRY_EMAILVALIDATE_NO', 'account niet geactiveerd');
define('TEXT_EMAIL_VALIDATE_FEATURE','E-mail activatie bij account registratie is uitgeschakeld.');

define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Groep');
define('TABLE_HEADING_REQUEST_AUTHENTICATION', 'RA');
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Set payment modules for the customer');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'If you choose <b><i>Set payment modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Set shipping modules for the customer');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'If you choose <b><i>Set shipping modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_ORDER_TOTAL_SET', 'Set order total modules for the customer');
define('ENTRY_CUSTOMERS_ORDER_TOTAL_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_ORDER_TOTAL_SET_EXPLAIN', 'If you choose <b><i>Set order total modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');

define('HEADING_TITLE_CUSTOMERS_TAX_RATES_EXEMPT', 'Exempt Customer from Specific Tax Rates');
define('ENTRY_CUSTOMERS_TAX_RATES_EXEMPT', 'Exempt tax rates from the customer');
define('ENTRY_CUSTOMERS_TAX_RATES_DEFAULT', 'Use settings from Group or Configuration (zone based)');
define('ENTRY_CUSTOMERS_TAX_RATES_EXEMPT_EXPLAIN', 'If you choose <b><i>Exempt tax rates from the customer</i></b> but do not check any of the boxes, default settings (Group or zone based Configuration settings) will still be used.<br />If this customer is in a group that is "Tax Exempt", none of these settings will have any effect.');
define('SORT_BY_COMPANYNAME', 'Sort by Company Name --> A-B-C From Top ');
define('SORT_BY_COMPANYNAME_DESC', 'Sort by Company Name --> Z-X-Y From Top ');
define('SORT_BY_FIRSTNAME', 'Sort by First Name ascending --> A-B-C From Top ');
define('SORT_BY_FIRSTNAME_DESC', 'Sort by First Name descending --> Z-X-Y From Top ');
define('SORT_BY_LASTNAME', 'Sort by Last Name ascending --> A-B-C From Top ');
define('SORT_BY_LASTNAME_DESC', 'Sort by Last Name descending --> Z-Y-X From Top ');
define('SORT_BY_CUSTOMER_GROUP', 'Sort by Customer Group ascending --> A-B-C From Top ');
define('SORT_BY_CUSTOMER_GROUP_DESC', 'Sort by Customer Group descending --> Z-X-Y From Top ');
define('SORT_BY_ACCOUNT_CREATED', 'Sort by Account Created ascending  --> 1-2-3 From Top ');
define('SORT_BY_ACCOUNT_CREATED_DESC', 'Sort by Account Created descending  --> 3-2-1 From Top ');
define('SORT_BY_RA', 'Sort by Request Authorization --> RA first (to Top) ');
define('SORT_BY_RA_DESC', 'Sort by Request Authorization --> RA last (to Bottom) ');

require(DIR_WS_LANGUAGES . 'mail_dutch.php');
?>