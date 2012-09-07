<?php
//$Id: /catalog/includes/languages/english/login.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', CUSTOMERS_GROUP_EMAIL_CHECK);
define('TEXT_CHOOSE_CUSTOMER_GROUP', '<b>Choose a Customer Group.</b> ');
// NOTE: The above support@hilvy.nl entry should be replaced with the site Admin's email address. 
// This enables him to log-in as a member of each group for testing purposes. Frontend Account Needed 

define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Welcome, Please Sign In');
define('HEADING_NEW_CUSTOMER', 'New Customer');
define('TEXT_NEW_CUSTOMER', 'I am a new customer.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'By creating an account at ' . STORE_NAME . ' you can use all our webshop services we have to offer. With an account
	   									  it wil be quicker and faster to make an order.<br>
	   									  You\'ll be able to look back at your orders or to look at the status of your most previous order.<br><br>
										  <font color="#ff0000"><b>Note:</b></font> Your data will only be used for shipping and payment for orders on ' . STORE_NAME . ' and wil not be provided to others.										  
										  ');
define('HEADING_RETURNING_CUSTOMER', 'Returning Customer');
define('TEXT_RETURNING_CUSTOMER', 'I am a returning customer.');
define('TEXT_PASSWORD_FORGOTTEN', 'Password forgotten? Click here.');
define('TEXT_LOGIN_ERROR_ACTIVATION', 'It\'s also possible that you stil have to activate your account. Activate your Account <a href="account_activate.php">here</a>');
define('TEXT_LOGIN_ERROR', 'Error: No match for E-Mail Address and/or Password.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Note:</b></font> Your &quot;Visitors Cart&quot; contents will be merged with your &quot;Members Cart&quot; contents once you have logged on. <a href="javascript:session_win();">[More Info]</a>');
define('TEXT_GUEST_INTRODUCTION', '<b>Do you want to go straight to the checkout process?</b><br><br>Would like like to check out without creating a customer account? Please note that all of our services will not be available to customers that do not wish to create an account. Also, you cannot view the status of your order, and each time you shop with us you will have to re-enter all of your data.<br><br>Creating an account is free. If you still wish to continue to checkout please click the checkout button to your right.');
?>