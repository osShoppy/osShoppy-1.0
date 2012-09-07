<?php
//$Id: /catalog/includes/languages/dutch/create_account.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Account maken');
define('NAVBAR_TITLE_PWA', 'Voer Verzend en Factuur adres in.');
define('HEADING_TITLE_PWA', 'Verzend en Factuur Informatie');

define('HEADING_TITLE', 'Account aanmaken');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>PS:</b></font></small> Indien u reeds een account bij ons heeft, dan kunt u inloggen op de <a href="%s"><u>login pagina</u></a>.');

// text also in modules/html_mail/
define('EMAIL_SUBJECT', 'Welkom bij ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Geachte Mnr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Geachte Mvr. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Geachte %s' . "\n\n");
define('EMAIL_WELCOME', 'Wij verwelkomen u bij <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Er is een account voor u aangemaakt waardoor u nu makkelijker van onze verschillende services gebruik kan maken die wij u bieden.' ."\n" . ' Een paar van deze services zijn:' . "\n\n" . '<li><b>Onthouden Winkelwagentje</b> - Alle producten die u aan uw winkelwagentje toevoegd blijven bewaard totdat u ze zelf verwijderd of de bestelling heeft afgerond.' . "\n" . '<li><b>Adres Boek</b> - Bestellingen kunnen op een ander adres worden afgeleverddan het factuur adres. Dit is handig te gebruiken als u een kado wilt versturen of als bedrijf een bestelling op een ander locatie wil laten bezorgen.' . "\n" . '<li><b>Bestel Geschiedenis</b> - Bekijk al je bestellingen die je bij gemaakt heb.' . "\n" . '<li><b>Producten Recensies</b> - Deel je meningen over producten met andere klanten.' . "\n\n");
define('EMAIL_CONTACT', 'Voor hulp met een van onze online services , neemt u dan aub contact op met de webwinkel eigenaar: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Opmerking:</b> Dit email adres is gegeven aan ons door een van onze klanten. Als u zich niet heeft ingeschreven bij ons, neem aub contact op met ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('EMAIL_WELCOME_POINTS', '<center><b><strong>Spaarpunten Systeem</strong></b><br> Door de op het moment lopende Aktie van ons Spaarpunten Systeem<br> ontvangt u op uw %s direct %s Spaarpunten<br> met een waarde van %s .' . "\n\n" . 'Lees %s voor de algemene voorwaarden.</center>');
define('EMAIL_POINTS_ACCOUNT', '<font color="#000000">Spaarpunten Pagina');
define('EMAIL_POINTS_FAQ', '<font color="#000000">Spaarpunten FAQ');

define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" .
                                        ' Below are details of the Discount Coupon created just for you' . "\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase');

define('EMAIL_TEXT_ACTIVATION','<b>Gebruik onderstaande link om uw account te activeren</b>' . "\n\n");
define('TEXT_ACTIVATION_CODE','Uw activerings code is: ');
// text also in modules/html_mail/

// notify store owner when new account is created
define('EMAIL_SUBJECT_OWNER', 'Nieuw Klanten Account: ' . STORE_NAME);
define('EMAIL_NEW_CLIENT_GREETING', '<b>Hallo Admin,</b>' . "\n\n" . 'er is op ' . STORE_NAME . ' een nieuw account aangemaakt!' . "\n\n" . 'Zie hieronder de klantgegevens:');
define('EMAIL_NEW_CLIENT_ID', 'Klant ID:');
define('EMAIL_NEW_CLIENT_NAME', 'Naam:'); 
define('EMAIL_NEW_CLIENT_COMPANY', 'Bedrijfsnaam:'); 
define('EMAIL_NEW_CLIENT_MAIL', 'E-Mail:'); 
define('EMAIL_NEW_CLIENT_NEWSLETTER', 'Nieuwsbrief:');
define('EMAIL_NEW_CLIENT_PHONE', 'Telefoon:');
define('EMAIL_NEW_CLIENT_FAX', 'Fax:'); 
define('EMAIL_NEW_CLIENT_ADDRESS', 'Adres:'); 
define('EMAIL_NEW_CLIENT_CITY', 'Plaats:'); 
define('EMAIL_NEW_CLIENT_SUBURB', 'Wijk:'); 
define('EMAIL_NEW_CLIENT_STATE', 'Provincie:');
define('EMAIL_NEW_CLIENT_ZIP', 'Postcode:');
define('EMAIL_NEW_CLIENT_COUNTRY', 'Land:'); 
?>