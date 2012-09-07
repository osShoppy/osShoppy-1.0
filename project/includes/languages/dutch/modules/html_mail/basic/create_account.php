<?php
define('UHE_SUBJECT', 'Welkom bij ' . STORE_NAME);
define('UHE_GREET_MR', 'Geachte Dhr. %s,' . "\n\n");
define('UHE_GREET_MS', 'Geachte Mevr. %s,' . "\n\n");
define('UHE_GREET_NONE', 'Beste %s' . "\n\n");
define('UHE_USERNAME_TEXT', '<b>Hier uw inloggegevens.</b>');
define('UHE_USERNAME', 'Uw gebruikersnaam is: <b>' . stripslashes($HTTP_POST_VARS['email_address']) . '</b>');
define('UHE_PASSWORD', 'Uw wachtwoord is: <b>' . stripslashes($HTTP_POST_VARS['password']) . '</b>');
define('UHE_WELCOME', 'wij verwelkomen u bij <b>' . STORE_NAME . '</b>.' . "\n\n");
define('UHE_TEXT', 'Er is een account voor u aangemaakt waardoor u nu makkelijker van onze verschillende services gebruik kan maken die wij u bieden.' ."\n" . ' Een paar van deze services zijn:' . "\n\n" . '<li><b>Onthouden Winkelwagentje</b> - Alle producten die u aan uw winkelwagentje toevoegd blijven bewaard totdat u ze zelf verwijderd of de bestelling heeft afgerond.' . "\n" . '<li><b>Adres Boek</b> - Bestellingen kunnen op een ander adres worden afgeleverddan het factuur adres. Dit is handig te gebruiken als u een kado wilt versturen of als bedrijf een bestelling op een ander locatie wil laten bezorgen.' . "\n" . '<li><b>Bestel Geschiedenis</b> - Bekijk al je bestellingen die je bij gemaakt heb.' . "\n" . '<li><b>Producten Recensies</b> - Deel je meningen over producten met andere klanten.' . "\n\n");
define('UHE_CONTACT', 'Voor hulp met een van onze online services , neemt u dan aub contact op met de webwinkel eigenaar: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('UHE_WARNING', '<b>Opmerking:</b> Dit email adres is gegeven aan ons door een van onze klanten. Als u zich niet heeft ingeschreven bij ons, neem aub contact op met ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('UHE_ACCOUNT_CONTROL_LOGIN', '<b><center>Uw account moet nog door ' . STORE_NAME . ' goedgekeurd worden.</b>' . "\n" . 'Tot die tijd kunt u niet inloggen op uw account.' . "\n" . 'U ontvangt een e-mail wanneer uw account goed gekeurd is.</center>');

define('UHE_TEXT_ACTIVATION','<b><center>Uw account moet nog geactiveerd worden.</b>' . "\n" . 'Gebruik de link onderaan deze email om uw account te activeren' . "\n" . 'of voer onderstaande activeringscode <a href="http://' . STORE_URL . '/account_activate.php" target="_blank">hier</a> in.</center>');
define('UHE_TEXT_ACTIVATION_CODE','Uw activerings code is: ');

define('EMAIL_WELCOME_POINTS', '<center><b><strong>Spaarpunten Systeem</strong></b><br> Door de op het moment lopende Aktie van ons Spaarpunten Systeem<br> ontvangt u op uw %s direct %s Spaarpunten<br> met een waarde van %s .' . "\n\n" . 'Lees %s voor de algemene voorwaarden.</center>');
define('EMAIL_POINTS_ACCOUNT', '<font color="#000000">Spaarpunten Pagina');
define('EMAIL_POINTS_FAQ', '<font color="#000000">Spaarpunten FAQ');

define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s');
define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase');
define('EMAIL_GV_LINK', 'or by following this link ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" .
                                        ' Below are details of the Discount Coupon created just for you' . "\n");
define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase');

define('LINK_ACCOUNT', 'Mijn Account');
define('LINK_ACCOUNT_ADRESS_BOOK', 'Mijn Adresboek');
define('LINK_ACCOUNT_EDIT', 'Mijn Gegevens');
define('LINK_ACCOUNT_ORDERS', 'Mijn Bestellingen');
define('LINK_ACCOUNT_NOTIFICATIONS', 'Mijn Notificaties');
define('LINK_CATEGORIES', 'Categori&euml;n');
define('LINK_CONDITIONS', 'Algemene Voorwaarden');
define('LINK_CONTACT_US', 'Neem Contact Op');
define('LINK_COPYRIGHT', 'Copyright &copy; ' . date('Y') . ' <a href="http://' . STORE_URL . '" title="Ga naar ' . STORE_NAME . '" target="_blank">' . STORE_NAME . '</a> :: Hosted by <a href="http://www.hilvy.nl" title="Webhosting and Design" target="_blank">HILVY</a>');
define('LINK_EMPTY', '');
define('LINK_GO_TO_STORE', 'Ga naar Webwinkel&nbsp;&nbsp;&nbsp;&nbsp;');
define('LINK_NEWSLETTER', '<u>Geen nieuwsbrief meer ontvangen? Log in op uw account.</u>');
define('LINK_NEW_PRODUCTS', 'Nieuw');
define('LINK_PRIVACY', 'Privacy Beleid');
define('LINK_REGISTER', 'Registreren');
define('LINK_REVIEWS', 'Recensies');
define('LINK_SPECIALS', 'Aanbiedingen');
define('LINK_SHIPPING', 'Verzendingen');
define('LINK_PAYMENT', 'Betalingen');
define('LINK_TESTIMONIALS', 'Testimonials');
define('LINK_WEBBROWSER', 'Problemen met de weergave van deze email?');
define('LINK_WEBBROWSER_CLICK', '<u>Klik Hier</u>');
?>
