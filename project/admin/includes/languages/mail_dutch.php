<?php //$Id: /catalog/admin/includes/languages/email_dutch.php (osS)

//require(DIR_WS_LANGUAGES . 'mail_dutch.php');

// admin_acces_levels_account from files admin_account.php and admin_members.php
define('ADMIN_EMAIL_SUBJECT', 'Admin account aangepast op %s voor gebruiker: %s %s');
define('ADMIN_EMAIL_TEXT', 'Hallo %s, ' . "\n\n" . 'je persoonlijke informatie van je administratie account is aangepast!
	   						Het is mogelijk dat je wachtwoord of categorie toegang is aangepast.
							Is dit zonder toestemming of medeweten uitgevoerd neem dan contact op met de Top administrator.<br>
								 ' . "\n\n" . 'Website : %s' . "\n" . 'Gebrukersnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Met vriendelijke groeten,' . "\n" . '%s' . "\n\n" . '
							     Dit is een automatisch bericht! U kunt hier niet op reageren!');

define('ADMIN_EMAIL_NEW_MEMBER_SUBJECT', 'Nieuw admin account op %s: %s %s');
define('ADMIN_EMAIL_NEW_MEMBER_TEXT', 'Hallo %s, ' . "\n\n" . '
	   							  Op '. STORE_NAME .' is er een nieuw administratie account aangemaakt.<br>
								  Verander na inloggen op uw administratie paneel meteen het wachtwoord op uw administratie account.<br>
								 ' . "\n\n" . 'Website : %s' . "\n" . 'Gebrukersnaam: %s' . "\n" . 'Wachtwoord: %s' . "\n\n" . 'Met vriendelijke groeten,' . "\n" . '%s' . "\n\n" . '
							     Dit is een automatisch bericht! U kunt hier niet op reageren!');

define('ADMIN_EMAIL_EDIT_SUBJECT', 'Aanpassing in %s voor admin acount van %s %s');
define('ADMIN_EMAIL_EDIT_TEXT',  'Hallo %s,' . "\n\n" . 'Je persoonlijke informatie van je administratie account is aangepast!<br>
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
define('EMAIL_PASS_1', 'Uw Wachtwoord: ');
define('EMAIL_PASS_2', "\n" . 'U kunt uw wachtwoord na inloggen op uw account aanpassen.' . "\n\n");

define('EMAIL_SUBJECT', 'Welkom bij ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Geachte Mnr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Geachte Mevr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Beste ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'We heten u van harte welkom bij <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Er is door ' . STORE_NAME . ' een account voor u aangemaakt waardoor u nu makkelijker van onze verschillende services gebruik kan maken die wij u bieden.' ."\n" . 'Een paar van deze services zijn:' . "\n\n" . '<li><b>Onthouden Winkelwagentje</b> - Alle producten die u aan uw winkelwagentje toevoegd blijven bewaard totdat u ze zelf verwijderd of de bestelling heeft afgerond.' . "\n" . '<li><b>Adres Boek</b> - Bestellingen kunnen op een ander adres worden afgeleverddan het factuur adres. Dit is handig te gebruiken als u een kado wilt versturen of als bedrijf een bestelling op een ander locatie wil laten bezorgen.' . "\n" . '<li><b>Bestel Geschiedenis</b> - Bekijk al je bestellingen die je bij gemaakt heb.' . "\n" . '<li><b>Producten Recensies</b> - Deel je meningen over producten met andere klanten.' . "\n\n");
define('EMAIL_CONTACT', 'Voor hulp met een van onze online services , neemt u dan aub contact op met de webwinkel eigenaar: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Opmerking:</b> Dit email adres is gegeven aan ons door een van onze klanten. Als u zich niet heeft ingeschreven bij ons, neem aub contact op met ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// control login
define('EMAIL_ACTIVATE_FROM', 'From: '.EMAIL_FROM);
define('EMAIL_ACTIVATE_SUBJECT', 'Uw account op ' . STORE_NAME . ' is goed gekeurd en geactiveerd!');
define('EMAIL_ACTIVATE_GREETING', 'Beste');
define('EMAIL_ACTIVATE_MESSAGE', 'Uw account is door een van onze administrators geactiveerd. Het is nu mogelijk om in te loggen op uw account.' . "\n" . 'Heeft u nog vragen over de registratie van uw account, neem dan contact met ons op.');
define('EMAIL_ACTIVATE_SIGNOFF', 'Met vriendelijke groeten,');

// affiliate_programm
// credit class gift voucher
// create_account
// orders
// password_forgotten
// rma return
?>
