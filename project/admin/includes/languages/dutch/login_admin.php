<?php //$Id: /catalog/admin/includes/languages/dutch/login_admin.php

define('NAVBAR_TITLE', 'Inloggen');
define('HEADING_TITLE', 'Welkom, log hier in op uw '.STORE_NAME.' Admin Paneel!');
define('TEXT_STEP_BY_STEP', ''); // should be empty
define('CHOOSE_LANGUAGE', 'Kies uw taal');

define('HEADING_RETURNING_ADMIN', 'Hier Inloggen:');
define('HEADING_PASSWORD_FORGOTTEN', 'Wachtwoord Vergeten:');
define('TEXT_RETURNING_ADMIN', 'Alleen Personeel!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adres:');
define('ENTRY_PASSWORD', 'Wachtwoord:');
define('ENTRY_FIRSTNAME', 'Voornaam:');
define('IMAGE_BUTTON_LOGIN', 'Bevestig');
define('TEXT_PASSWORD_FORGOTTEN', 'Wachtwoord Vergeten?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>FOUT:</b></font> gebruikersnaam of wachwoord onjuist!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>FOUT:</b></font> voornaam en wachtwoord komen niet overeen!');
define('TEXT_FORGOTTEN_FAIL', 'You have try over 3 times. For security reason, please contact your Web Administrator to get new password.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'The new password have sent to your email address. Please check your email and click back to login.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'New Password at %s for %s %s');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'You can access the admin panel with the following password. Once you access the admin, please change your password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');
?>