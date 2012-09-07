<?php
//$Id: /catalog/includes/languages/dutch/password_forgotten.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE_1', 'Inloggen');
define('NAVBAR_TITLE_2', 'Wachtwoord vergeten');
define('HEADING_TITLE', 'Ik ben mijn wachtwoord vergeten!');
define('TEXT_MAIN', 'Als u, uw wachtwoord ben vergeten, dan vult u uw email adres hier onder in en dan sturen wij een email met uw wachtwoord daarin.');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: Het ingevoerde e-mail adres is niet bij ons bekend, probeer het opnieuw.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nieuw wachtwoord');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Een nieuw wachtwoord is aangevraagt bij: ' . $REMOTE_ADDR . '.' . "\n\n" . 'Uw nieuw wachtwoord voor: \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");
define('SUCCESS_PASSWORD_SENT', 'Geslaagd: Het wachtwoord is verzonden naar het opgegeven email adres.');
?>