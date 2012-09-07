<?php //$Id: /catalog/admin/includes/languages/english/create_account.php

define('HEADING_TITLE_CREATE_ACCOUNT', 'Create an new Customer Account');
define('PULL_DOWN_DEFAULT', 'Please select');

define('HEADING_TITLE_CREATE_ACCOUNT_SUCCESS', '<br><br>New Account sucessfully created');

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

require(DIR_WS_LANGUAGES . 'mail_english.php');

//define('EMAIL_PASS_1', 'Your password: ');
//define('EMAIL_PASS_2', "\n" . 'You can change it after login.' . "\n\n");

//define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
//define('EMAIL_GREET_MR', 'Dear Mr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
//define('EMAIL_GREET_MS', 'Dear Ms. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
//define('EMAIL_GREET_NONE', 'Dear ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
//define('EMAIL_WELCOME', 'We welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
//define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
//define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
//define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
?>