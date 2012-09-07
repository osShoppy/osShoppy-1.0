<?php //$Id: /catalog/admin/includes/languages/dutch/admin_account.php

define('HEADING_TITLE', 'Administratie Account');

define('TABLE_HEADING_ACCOUNT', 'Mijn Account');

define('TEXT_INFO_FULLNAME', '<b>Naam: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Voornaam: </b>');
define('TEXT_INFO_LASTNAME', '<b>Achternaam: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Adres: </b>');
define('TEXT_INFO_PASSWORD', '<b>Wachtwoord: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-verborgen-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Bevestig Wachtwoord: </b>');
define('TEXT_INFO_CREATED', '<b>Account Aangemaakt: </b>');
define('TEXT_INFO_LOGDATE', '<b>Laatst Ingelogd: </b>');
define('TEXT_INFO_LOGNUM', '<b> Ingelogd (x): </b>');
define('TEXT_INFO_GROUP', '<b>Administratie groep: </b>');
define('TEXT_INFO_ERROR', '<font color="red">Email adres is al in gebruik! Probeer het nog een keer.</font>');
define('TEXT_INFO_MODIFIED', 'Aangepast: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Bewerk Account ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Wachtwoord Bevestiging ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Wachtwoord:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>FOUT:</b> fout wachtwoord!</font>');
define('TEXT_INFO_INTRO_DEFAULT', '<center>Klik hieronder op de <b>wijzig</b> button om je account gegevens aan te passen.</center>');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<b><br>Hallo %s, er is een nieuw Admin account aangemaakt!</b><br>
	   <br><b><font color=red>LET OP:</font></b><br>Je komt voor het eerst op je administratie paneel! 
	   Het is voor de veiligheid aangeraden om je wachtwoord te veranderen.<br><br><center><hr>Wanneer wachtwoord niet word veranderd, dan blijft dit de pagina waarop u als eerste binnenkomt.<hr></center><br>
	   <center>Ga naar de <b><a href="manual_index.php" class="main"><u>handleiding</u></a></b> om informatie te vinden over osShoppy.</center><br>
	   ');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '
	   <br><b><font color=red>LET OP:</font></b><br>Hallo <b>%s</b>, je komt als Top Admin voor het eerst op je administratie paneel na een nieuwe installatie van <b>osShoppy</b>! 
	   <br>Het is voor de veiligheid aangeraden om je wachtwoord (<font color="red">changeme</font>) en e-mail adres (<font color="red">change@mail.nl</font>) te veranderen.<br><br><center><hr>Wanneer wachtwoord niet word veranderd, dan blijft dit de pagina waarop u als eerste binnenkomt.<hr></center><br>
	   <center>Ga naar de <b><a href="manual_index.php" class="main"><u>handleiding</u></a></b> om de vereiste configuratie aan uw winkel toe te passen na installatie.</center><br>
	   ');
define('TEXT_INFO_INTRO_EDIT_PROCESS', '<br><br><b><center>Alle invulvelden zijn verplicht.</center></b><br><br>');

define('JS_ALERT_FIRSTNAME',        '- Verplicht: Voornaam \n');
define('JS_ALERT_LASTNAME',         '- Verplicht: Achternaam \n');
define('JS_ALERT_EMAIL',            '- Verplicht: Email adres \n');
define('JS_ALERT_PASSWORD',         '- Verplicht: Wachtwoord \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Voornaam lengte moet meer zijn dan ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Achternaam lengte moet meer zijn dan ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Wachtwoord lengte moet meer zijn dan ');
define('JS_ALERT_EMAIL_FORMAT',     '- Email adres formaat is onjuist! \n');
define('JS_ALERT_EMAIL_USED',       '- Email adres is al in gebruik! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Bevestig wachtwoord in invoerveld! \n');

require(DIR_WS_LANGUAGES . 'mail_dutch.php');
//define('ADMIN_EMAIL_SUBJECT', 'Cambio de información personal en %s para el administrador: %s %s');
//define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'Your personal information, perhaps including your password and categories access has been changed.  If this was done without your knowledge or consent please contact the administrator immediatly!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');
?>