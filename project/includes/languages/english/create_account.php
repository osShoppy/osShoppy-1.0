<?php
//$Id: /catalog/includes/languages/english/create_account.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Create an Account');
define('NAVBAR_TITLE_PWA', 'Enter Billing & Shipping Information');
define('HEADING_TITLE_PWA', 'Billing & Shipping Information');
define('HEADING_TITLE', 'My Account Information');
define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOTE:</b></font></small> If you already have an account with us, please login at the <a href="%s"><u>login page</u></a>.');

// text also in modules/html_mail/
define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
define('EMAIL_WELCOME_POINTS', '<li><strong>Reward Point Program</strong> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" .
                                        ' Below are details of the Discount Coupon created just for you' . "\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase');
define('EMAIL_TEXT_ACTIVATION','<b>Please click the following link to activate your account</b>' . "\n\n");
define('TEXT_ACTIVATION_CODE','Your activation code is: ');
// text also in modules/html_mail/

// notify store owner when new account is created
define('EMAIL_SUBJECT_OWNER', 'New Customer Account: ' . STORE_NAME);
define('EMAIL_NEW_CLIENT_GREETING', '<b>Hello Admin,</b>' . "\n\n" . 'a new account is created on ' . STORE_NAME . '!' . "\n\n" . 'See below for customer details:');
define('EMAIL_NEW_CLIENT_ID', 'customer ID:');
define('EMAIL_NEW_CLIENT_NAME', 'Name:'); 
define('EMAIL_NEW_CLIENT_COMPANY', 'Company:'); 
define('EMAIL_NEW_CLIENT_MAIL', 'E-Mail:'); 
define('EMAIL_NEW_CLIENT_NEWSLETTER', 'Newsletter:');
define('EMAIL_NEW_CLIENT_PHONE', 'Phone:');
define('EMAIL_NEW_CLIENT_FAX', 'Fax:'); 
define('EMAIL_NEW_CLIENT_ADDRESS', 'Address:'); 
define('EMAIL_NEW_CLIENT_CITY', 'City:'); 
define('EMAIL_NEW_CLIENT_SUBURB', 'Suburb:'); 
define('EMAIL_NEW_CLIENT_STATE', 'State:');
define('EMAIL_NEW_CLIENT_ZIP', 'Postcode:');
define('EMAIL_NEW_CLIENT_COUNTRY', 'Country:'); 
?>