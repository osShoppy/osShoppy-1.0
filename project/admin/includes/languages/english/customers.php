<?php //$Id: /catalog/admin/includes/languages/english/customers.php

define('HEADING_TITLE', 'Customers');
define('HEADING_TITLE_SEARCH', 'Search:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_FIRSTNAME', 'First Name');
define('TABLE_HEADING_INSERTION', 'insertion');
define('TABLE_HEADING_LASTNAME', 'Last Name');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Created');
define('TABLE_HEADING_REFERRED_BY', 'Referred By');
define('TABLE_HEADING_CUSTOMERS_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('ENTRY_CUSTOMER_NOTES_BACKEND','Customer Notes:<br><small>(only visible in admin panel)</small>');
define('ENTRY_CUSTOMER_NOTES_FRONTEND','Customer Notes:<br><small>(also visible on customer account page)</small>');
define('ENTRY_CUSTOMER_NOTES_ALERT', 'Warning in Customer account box?'); 
define('ENTRY_CUSTOMER_NOTES_EXAMPLES', '<small>
	   									 < font color=grey>There are no new messages.< /font>< br><br>
	   									 < font color=green>There is an new message on your account page!< /font>< br><br>
	   									 < font color=green>You have an new message from ' . STORE_NAME . '.< /font>< br><br>
										 < font color=green>There is a personal message from ' . STORE_NAME . ' for you!< /font>< br><br>
										 < a href=account.php>click here</a>
										 </small>');
define('TEXT_INFO_CUSTOMER_NOTES_BACKEND','Customer Notes:<br><small>(only visible in admin panel)</small>');
define('TEXT_INFO_CUSTOMER_NOTES_FRONTEND','Opmerkingen:<br><small>(also visible on customer account page)</small>');
define('TEXT_INFO_CUSTOMER_NOTES_ALERT', '<b>Warning in Customer account box?</b>'); 
define('ENTRY_NOTES_YES', 'Yes'); 
define('ENTRY_NOTES_NO', 'No'); 
define('TEXT_DATE_ACCOUNT_CREATED', 'Account Created:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Last Logon:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Number of Logons:');
define('TEXT_INFO_COUNTRY', 'Country:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Number of Reviews:');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this customer?');
define('TEXT_DELETE_REVIEWS', 'Delete %s review(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Delete Customer');
define('TYPE_BELOW', 'Type below');
define('PLEASE_SELECT', 'Select One');

define('ENTRY_CUSTOMERS_EMAIL_VALIDATED','Email Validated:');
define('ENTRY_EMAILVALIDATE_YES', 'Validated');
define('ENTRY_EMAILVALIDATE_NO', 'Unvalidated');
define('TEXT_EMAIL_VALIDATE_FEATURE','Require E-mail confirmation on account creation is set off.');

define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Customer&#160;Group');
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

require(DIR_WS_LANGUAGES . 'mail_english.php');
?>