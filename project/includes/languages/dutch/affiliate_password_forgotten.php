<?php
//$Id: /catalog/includes/languages/dutch/affiliate_password_forgotten.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE_1', 'Wachtwoord');
define('NAVBAR_TITLE_2', 'Nieuw Wachtwoord');
define('HEADING_TITLE', 'Nieuw Affiliate Wachtwoord Aanvragen!');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>Fout</b></font>: Het ingevoerde e-mail adres is niet bij ons bekend, probeer het opnieuw.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nieuw Affiliate Wachtwoord');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Een nieuw affiliate wachtwoord is aangevraagd bij: ' . $REMOTE_ADDR . '.' . "\n\n" . 'Uw nieuw wachtwoord voor: \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'Geslaagd: Het nieuwe affiliate wachtwoord is verzonden naar het opgegeven email adres.');
?>