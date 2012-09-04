<?php //$Id: /catalog/admin/includes/languages/email_english.php (osS)

//require(DIR_WS_LANGUAGES . 'mail_english.php');

// admin_acces_levels_account from files admin_account.php and admin_members.php
define('ADMIN_EMAIL_SUBJECT', 'Admin account edited on %s for user: %s %s');
define('ADMIN_EMAIL_TEXT', 'Hi %s, ' . "\n\n" . 'je persoonlijke informatie van je administratie account is aangepast!
	   						Het is mogelijk dat je wachtwoord of categorie toegang is aangepast.
							Is dit zonder toestemming of medeweten uitgevoerd neem dan contact op met de Top administrator.<br>
								 ' . "\n\n" . 'Website : %s' . "\n" . 'Gebrukersnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Met vriendelijke groeten,' . "\n" . '%s' . "\n\n" . '
							     Dit is een automatisch bericht! U kunt hier niet op reageren!');

define('ADMIN_EMAIL_NEW_MEMBER_SUBJECT', 'New admin account created on %s for user: %s %s');
define('ADMIN_EMAIL_NEW_MEMBER_TEXT', 'Hi %s, ' . "\n\n" . '
	   							  Op '. STORE_NAME .' is er een nieuw administratie account aangemaakt.<br>
								  Verander na inloggen op uw administratie paneel meteen het wachtwoord op uw administratie account.<br>
								 ' . "\n\n" . 'Website : %s' . "\n" . 'Gebrukersnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Met vriendelijke groeten,' . "\n" . '%s' . "\n\n" . '
							     Dit is een automatisch bericht! U kunt hier niet op reageren!');

define('ADMIN_EMAIL_EDIT_SUBJECT', 'Admin account update on %s from %s %s');
define('ADMIN_EMAIL_EDIT_TEXT',  'Hi %s,' . "\n\n" . 'Je persoonlijke informatie van je administratie account is aangepast!<br>
	   						     Het is mogelijk dat je wachtwoord of categorie toegang is aangepast.
								 ' . "\n\n" . 'Website : %s' . "\n" . 'Gebrukersnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Met vriendelijke groeten,' . "\n" . '%s' . "\n\n" . '
							     Dit is een automatisch bericht! U kunt hier niet op reageren!');

//store configuration changes
define('EMAIL_CONFIGURATION_CHANGE_TEXT_SUBJECT','Configuratie Aanpassing');
define('EMAIL_CONFIGURATION_CHANGE_TEXT_BODY','Er is een aanpassing uitgevoerd in de configuratie van uw webwinkel!<br>
	   										   Wanneer dit zonder uw toestemming is uitgevoerd dan is het aangeraden uw 
											   administratie paneel te bezoeken om te zien welke aanpssing is uitgevoerd.<br><br>
											   Dit is een automatisch bericht verstuurt van uw administratie paneel!');
// customer create account in admin
define('EMAIL_PASS_1', 'Your password: ');
define('EMAIL_PASS_2', "\n" . 'You can change it after login.' . "\n\n");

define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// control login
define('EMAIL_ACTIVATE_FROM', 'From: '.EMAIL_FROM);
define('EMAIL_ACTIVATE_SUBJECT', 'Your Account has been activated');
define('EMAIL_ACTIVATE_GREETING', 'Dear');
define('EMAIL_ACTIVATE_MESSAGE', 'Your account is now active.  Please login to take advantage of our online ordering system, track your order history, and use your permanent order form, which ensures that your incomplete orders are saved until you are ready to submit them.  If you have any questions, please contact us at ');
define('EMAIL_ACTIVATE_SIGNOFF', 'Best Regards,');

// affiliate_programm
// credit class gift voucher
// create_account
// orders
// password_forgotten
?>
