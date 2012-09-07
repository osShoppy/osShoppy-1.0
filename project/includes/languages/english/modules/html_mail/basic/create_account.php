<?php
define('UHE_SUBJECT', 'Welcome to ' . STORE_NAME);
define('UHE_GREET_MR', 'Dear Mr. %s,' . "\n\n");
define('UHE_GREET_MS', 'Dear Ms. %s,.' . "\n\n");
define('UHE_GREET_NONE', 'Dear %s,' . "\n\n");
define('UHE_USERNAME_TEXT', 'Your Login Details.');
define('UHE_USERNAME', 'Your username is: <b>' . stripslashes($HTTP_POST_VARS['email_address']) . '</b>' . "\n\n");
define('UHE_PASSWORD', 'Your password is: <b>' . stripslashes($HTTP_POST_VARS['password']) . '</b>' . "\n\n");
define('UHE_WELCOME', 'we welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
define('UHE_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('UHE_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('UHE_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('UHE_TEXT_ACTIVATION','<b>Please click the following link to activate your account</b>' . "\n\n");
define('UHE_TEXT_ACTIVATION_CODE','Your activation code is: ');

define('EMAIL_WELCOME_POINTS', '<li><strong>Reward Point Program</strong> - As part of our Welcome to new customers, we have credited your %s with a total of %s Shopping Points worth %s .' . "\n" . 'Please refer to the %s as conditions may apply.');
define('EMAIL_POINTS_ACCOUNT', 'Shopping Points Accout');
define('EMAIL_POINTS_FAQ', 'Reward Point Program FAQ');

define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" .
                                        ' Below are details of the Discount Coupon created just for you' . "\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase');

define('LINK_ACCOUNT', 'My Account');
define('LINK_ACCOUNT_ADRESS_BOOK', 'My Addressbook');
define('LINK_ACCOUNT_EDIT', 'My Details');
define('LINK_ACCOUNT_ORDERS', 'My Orders');
define('LINK_ACCOUNT_NOTIFICATIONS', 'My Notifications');
define('LINK_CATEGORIES', 'Categories');
define('LINK_CONDITIONS', 'Conditions');
define('LINK_CONTACT_US', 'Contact Us');
define('LINK_COPYRIGHT', 'Copyright &copy; ' . date('Y') . ' <a href="http://' . STORE_URL . '" target="_blank">' . STORE_NAME . '</a> :: Hosted by <a href="http://www.hilvy.nl" target="_blank">HILVY</a>');
define('LINK_EMPTY', '');
define('LINK_GO_TO_STORE', 'Go To Store&nbsp;&nbsp;&nbsp;&nbsp;');
define('LINK_NEWSLETTER', '<u>Unsubscribe Newsletter? Log in in your account.</u>');
define('LINK_NEW_PRODUCTS', 'New');
define('LINK_PRIVACY', 'Privacy Policy');
define('LINK_REGISTER', 'Registrate');
define('LINK_REVIEWS', 'View Reviews');
define('LINK_SPECIALS', 'Specials');
define('LINK_SHIPPING', 'Shipping');
define('LINK_PAYMENT', 'Payments');
define('LINK_TESTIMONIALS', 'Testimonials');
define('LINK_WEBBROWSER', 'Problems watching this e-mail?');
define('LINK_WEBBROWSER_CLICK', '<u>Click Here</u>');
?>
