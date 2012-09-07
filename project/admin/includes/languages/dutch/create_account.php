<?php //$Id: /catalog/admin/includes/languages/dutch/create_account.php

define('HEADING_TITLE_CREATE_ACCOUNT', 'Maak een Nieuw klanten Account aan.');
define('PULL_DOWN_DEFAULT', 'selecteer');

define('HEADING_TITLE_CREATE_ACCOUNT_SUCCESS', '<br><br>Nieuw Klanten Account is Succesvol aangemaakt.');

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

require(DIR_WS_LANGUAGES . 'mail_dutch.php');

//define('EMAIL_PASS_1', 'Uw Wachtwoord: ');
//define('EMAIL_PASS_2', "\n" . 'U kunt uw wachtwoord na inloggen op uw account aanpassen.' . "\n\n");

//define('EMAIL_SUBJECT', 'Welkom bij ' . STORE_NAME);
//define('EMAIL_GREET_MR', 'Geachte Mnr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
//define('EMAIL_GREET_MS', 'Geachte Mevr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
//define('EMAIL_GREET_NONE', 'Beste ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
//define('EMAIL_WELCOME', 'We heten u van harte welkom bij <b>' . STORE_NAME . '</b>.' . "\n\n");
//define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
//define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
//define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
?>