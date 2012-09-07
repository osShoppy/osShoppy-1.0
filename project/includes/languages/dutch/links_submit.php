<?php
//$Id: /catalog/includes/languages/dutch/links_submit.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

$linkInfo_query = tep_db_query("select * from " . TABLE_LINKS_EXCHANGE . " where language_id = '" . (int)$languages_id . "'");
$linkInfo = tep_db_fetch_array($linkInfo_query);

define('NAVBAR_TITLE_1', 'Links');
define('NAVBAR_TITLE_2', 'Aanmelden Link');

define('HEADING_TITLE', 'Link Informatie');

define('TEXT_MAIN', 'Vult u onderstaand formulier in voor de aanmelding van uw link.');
define('TEXT_MAIN_INTRO', '
<p class="main">Op deze pagina kunt u uw link aanmelden. 
Als u met ons links wilt uitwisselen dan kopieert u onze website informatie hieronder en plaats het op uw website. 
U kunt nu meteen uw link aanmelden wanneer onze link al op uw website staat. 
Vul ook in op welke URl onze link terug te vinden is voor referentie. 
Na het aanmelden van uw link krijgt u binnen 24 uur bericht hierover.<br><br>
Wilt u uw link al aanmelden maar u heeft nog niet de gelegenheid een link op uw website te plaatsen neem dan <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"> <u>contact</u></a> met ons op.
</p>

<p class="main"><b>Opmerking:</b> U kunt pas uw link aanmelden wanneer u ook een link van ons op uw website heeft staan. 
Er word op regelmatige basis automatisch gekeken of onze link nog op uw website staat. 
Wanneer we onze link niet meer op uw website aantreffen dan word de link automatisch bij ' . STORE_NAME . ' verwijderd. 
</p>
');

define('TEXT_MAIN_ALLOW_EDITING', '
<b><center>ALs u een bestaande link wilt aanpassen dan moet u inloggen en op wijzigen klikken.</center><br>');

define('TEXT_MAIN_RECIPROCAL_PART_1', '
<p class="main"><b>Onze Website Informatie</b>

<tr>
 <td><table class="linkSubmit" border="0" width="100%" cellpadding="0">
  <tr class="infoBoxContents">
   <td><table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
     <td class="main" width="15%">Link Naam:</td>
     <td class="main">' . $linkInfo['links_exchange_name'] . '</td>
    </tr>
    <tr>
     <td class="main">Link Beschrijving:</td>
     <td class="main">' . $linkInfo['links_exchange_description'] . '</td>
    </tr>
    <tr>
     <td class="main">Link URL:</td>
     <td class="main">' . $linkInfo['links_exchange_url'] . '</td>
    </tr>
   </table></td>
  </tr>
 </table></td>
</tr>

<tr><td  class="main" height="40" valign="bottom"><b>Kopieer en plak de code in uw link pagina.</b></td></tr>
<tr>
 <td><table class="linkSubmit" border="0" width="100%" cellpadding="0">
  <tr class="infoBoxContents">
');

if (LINKS_DISPLAY_SUBMIT_CODE_FORMAT == 'Below') {
define('TEXT_MAIN_RECIPROCAL_PART_2', '
      </tr><tr class="infoBoxContents"><td width="50%"><table border="0" width="100%" style="border-collapse: collapse;">
       <tr>
           <td><table border="0" width="100%" style="border-collapse: collapse;">
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;"><b><a href="' . $linkInfo['links_exchange_url'] . '" target="_blank" title="' . $linkInfo['links_exchange_name'] . '">' . $linkInfo['links_exchange_name'] . '</a></b></td>
            </tr>
            <tr><td height="10"></td><tr>
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;">' . $linkInfo['links_exchange_description'] . '</td>
            </tr>
            <tr><td height="10"></td><tr>
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;"><a href="' . $linkInfo['links_exchange_url'] . '" target="_blank" title="' . $linkInfo['links_exchange_name'] . '">' . $linkInfo['links_exchange_url'] . '</a></td>
            </tr>
           </table></td>
          </tr>
      </table></td></tr><tr class="infoBoxContents">');
} else {
define('TEXT_MAIN_RECIPROCAL_PART_2', '
      <td width="50%"><table border="0" width="100%" style="border-collapse: collapse;">
       <tr>
           <td><table border="0" width="100%" style="border-collapse: collapse;">
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;"><b><a href="' . $linkInfo['links_exchange_url'] . '" target="_blank" title="' . $linkInfo['links_exchange_name'] . '">' . $linkInfo['links_exchange_name'] . '</a></b></td>
            </tr>
            <tr><td height="10"></td><tr>
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;">' . $linkInfo['links_exchange_description'] . '</td>
            </tr>
            <tr><td height="10"></td><tr>
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;"><a href="' . $linkInfo['links_exchange_url'] . '" target="_blank" title="' . $linkInfo['links_exchange_name'] . '">' . $linkInfo['links_exchange_url'] . '</a></td>
            </tr>
           </table></td>
          </tr>
      </table></td>');
}

if (LINKS_DISPLAY_SUBMIT_CODE_FORMAT == 'Hide') {
define('TEXT_MAIN_RECIPROCAL_PART_3', '');
} else {
define('TEXT_MAIN_RECIPROCAL_PART_3', '
     <td width="50%"><table border="1" width="100%" style="border-collapse: collapse;">
      <tr>
       <td>
        <textarea rows="10" name="S1" cols="45" wrap="virtual">
          <tr>
           <td><table border="0" width="100%" style="border-collapse: collapse;"  cellpadding="0">
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;"><b><a href="' . $linkInfo['links_exchange_url'] . '" target="_blank" title="' . $linkInfo['links_exchange_name'] . '">' . $linkInfo['links_exchange_name'] . '</a></b></td>
            </tr>
            <tr><td height="10"></td><tr>
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;">' . $linkInfo['links_exchange_description'] . '</td>
            </tr>
            <tr><td height="10"></td><tr>
            <tr>
             <td style="font-family: Verdana, Arial, sans-serif; font-size: 11px;"><a href="' . $linkInfo['links_exchange_url'] . '" target="_blank" title="' . $linkInfo['links_exchange_name'] . '">' . $linkInfo['links_exchange_url'] . '</a></td>
            </tr>
           </table></td>
          </tr>
        </textarea>
       </td>
      </tr>
     </table></td>
');
}

define('TEXT_MAIN_RECIPROCAL', TEXT_MAIN_RECIPROCAL_PART_1 . TEXT_MAIN_RECIPROCAL_PART_2 . TEXT_MAIN_RECIPROCAL_PART_3
. '
  </tr>
 </table></td>
</tr>
</p>
');

define('EMAIL_SUBJECT', 'Aanmelding Link ' . STORE_NAME . '.');
define('EMAIL_SUBJECT_EDIT', 'Uw Link bij ' . STORE_NAME . ' is aangepast.');
define('EMAIL_GREET_NONE', 'Beste %s' . "\n\n");
define('EMAIL_WELCOME', 'We willen u bedanken voor de aanmelding van uw Link bij ' . STORE_NAME . "\n\n");
define('EMAIL_TEXT', 'Uw Link is succesvol verstuurd naar ' . STORE_NAME . '. De Link word na bevestiging op de Link pagina geplaatst. U ontvangt per e-mail een bevestiging van uw link. wanneer u binnen 24 uur geen bevestigings e-mail heeft ontvangen neem dan contact met ons op voordat u uw link weer opnieuw aanmeld.' . "\n\n");
define('EMAIL_TEXT_EDIT', 'Uw Link is aangepast en opnieuw verstuurd naar ' . STORE_NAME . '. De Link word na bevestiging op de Link pagina geplaatst. U ontvangt per e-mail een bevestiging van uw link. wanneer u binnen 24 uur geen bevestigings e-mail heeft ontvangen neem dan contact met ons op voordat u uw link weer opnieuw aanmeld.' . "\n\n");
define('EMAIL_CONTACT', 'Wanneer u nog vragen heeft over de aanmelding van uw Link neem dan <a href="http://' . STORE_URL . '/contact_us.php" target="_self"><u><font color="#000000">contact</u></a> met ons op.' . "\n\n");
define('EMAIL_WARNING', '<b>Opmerking:</b> Dit e-mail adres is bij ons opgegeven tijdens de aanmelding van een Link. Als deze e-mail niet voor u bestemd is neem dan <a href="http://' . STORE_URL . '/contact_us.php" target="_self"><u><font color="#000000">contact</u></a> op met de site-beheerder.' . "\n");
define('EMAIL_OWNER_SUBJECT', 'Aanmelding Link op ' . STORE_NAME);
define('EMAIL_OWNER_TEXT', 'Een nieuwe Link is aangemeld door %s voor %s.' . "\n\n" . 'De opgegeven link pagina is geverifieerd en staat op %s.' . "\n\n" . 'De link is nog niet goedgekeurd. Verifieer deze Link en activeer het.' . "\n\n");
define('EMAIL_OWNER_TEXT_EDIT', 'Een bestaande Link is aangepast door %s voor %s.' . "\n\n" . '%s' . 'De opgegeven link pagina is geverifieerd en staat op %s.' . "\n\n" . 'De link is nog niet goedgekeurd. Verifieer deze Link en activeer het.' . "\n\n");

define('TEXT_LINKS_HELP_LINK', '&nbsp;Help&nbsp;[?]');

define('HEADING_LINKS_HELP', 'Links Help');
define('TEXT_LINKS_HELP', '<b>
Website Titel:</b> Een opvallende titel van uw website.<br><br>
<b>URL:</b> Het correcte adres naar uw website, inclusief \'http://\'.<br><br>
<b>Categorie:</b> Kies de meest geschikte categorie passend bij uw website.<br><br>
<b>Suggestie voor Categorie:</b> Geef een suggestie voor een categorie wanneer u geen passende categorie voor uw website vind.<br><br>
<b>Omschrijving:</b> Een korte omschrijving van uw website.<br><br>
<b>Plaatje URL:</b> Het correcte pad naar uw plaatje als u een plaatje bij uw link wil, inclusief \'http://\'.<br>
bv: http://uw-domein-naam.com/pad/naar/uw/plaatje.gif <br><br>
<b>Volledige Naam:</b> Uw volledige naam.<br><br>
<b>E-mail:</b> Uw e-mail adres. Geef een geldig e-mail adres op omdat bevestiging en update e-mails naar het door u opgegeven e-mail adres worden gestuurd.<br><br>
<b>Uw Link Pagina URL:</b> Het correcte pad naar uw links pagina waarop een link naar ' . STORE_NAME . ' te zien is.<br>
Eg: http://uw-domein-naam.com/pad/naar/uw/links_pagina.php');

define('TEXT_CLOSE_WINDOW', '<u>Sluit Venster</u> [x]');
define('TEXT_TOP', 'Naar Boven');

// VJ todo - move to common language file
define('CATEGORY_CUSTOMER_EDIT', 'Klik hier om lijst aan te passen.');
define('CATEGORY_WEBSITE', 'Uw website Infomatie');
define('CATEGORY_RECIPROCAL', 'Locatie URL ' . STORE_NAME );
define('CATEGORY_LOGIN_INFORMATION', 'Login Gegevens - (alleen vereist als u op een later tijdstip uw link wil aanpassen)');

define('ENTRY_LINKS_TITLE', 'Website Titel:');
define('ENTRY_LINKS_TITLE_ERROR', 'Website Titel moet minimaal ' . ENTRY_LINKS_TITLE_MIN_LENGTH . ' letters hebben.');
define('ENTRY_LINKS_TITLE_TEXT', '*');
define('ENTRY_LINKS_URL', 'URL:');
define('ENTRY_LINKS_URL_ERROR', 'URL moet minimaal ' . ENTRY_LINKS_URL_MIN_LENGTH . ' letters/cijfers hebben.');
define('ENTRY_LINKS_URL_NOT_FOUND_ERROR', 'URL is niet gevonden => %s');
define('ENTRY_LINKS_URL_TEXT', '*');
define('ENTRY_LINKS_CATEGORY', 'Kies categorie:');
define('ENTRY_LINKS_CATEGORY_TEXT', '');
define('ENTRY_LINKS_DESCRIPTION', 'Omschrijving Website:');
define('ENTRY_LINKS_DESCRIPTION_ERROR', 'Omschrijving website moet minimaal ' . ENTRY_LINKS_DESCRIPTION_MIN_LENGTH . ' letters hebben.');
define('ENTRY_LINKS_MAX_DESCRIPTION_ERROR', 'Omschrijving website mag niet meer dan ' . ENTRY_LINKS_DESCRIPTION_MAX_LENGTH . ' letters hebben.');
define('ENTRY_LINKS_DESCRIPTION_TEXT', '*');
define('ENTRY_LINKS_IMAGE', 'URL Afbeelding:');
define('ENTRY_LINKS_IMAGE_TEXT', '');
define('ENTRY_LINKS_UPLOAD_IMAGE', 'Afbeelding:');
define('ENTRY_LINKS_BLACKLISTED', 'In uw website omschrijving staat een woord dat niet is toegestaan.');
define('ENTRY_LINKS_CONTACT_NAME', 'Volledige Naam:');
define('ENTRY_LINKS_CONTACT_NAME_ERROR', 'Uw volledige naam moet minimaal ' . ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH . ' letters hebben.');
define('ENTRY_LINKS_CONTACT_NAME_TEXT', '*');
define('ENTRY_LINKS_RECIPROCAL_URL', 'Uw link pagina URL:');
define('ENTRY_LINKS_RECIPROCAL_URL_ERROR', 'Link pagina URL moet minimal ' . ENTRY_LINKS_URL_MIN_LENGTH . ' letters/cijfers hebben.');
define('ENTRY_LINKS_RECIPROCAL_URL_MISSING_ERROR', 'Onze link kan niet terug gevonden worden op %s.');
define('ENTRY_LINKS_RECIPROCAL_URL_TEXT', '*');
define('ENTRY_LINKS_DUPLICATE_ERROR', 'This link is already on file.');
define('ENTRY_LINKS_SUGGESTION', 'Suggestie voor categorie:');
define('ENTRY_LINKS_URL_MISMATCH_MAIN_IMAGE_ERROR', 'De hoofd domeinnaam, %s, moet overeenkomen met de afbeelding domeinnaam, %s.');
define('ENTRY_LINKS_URL_MISMATCH_MAIN_PARENT_ERROR', 'Een link naar onze website, %s, kan niet worden terug gevonden op, %s.');
define('ENTRY_LINKS_URL_MISMATCH_MAIN_RECIPROCAL_ERROR', 'De domeinnaam voor de wederzijdse link, %s, moet overeenkomen met de hoofd domeinnaam, %s.');
define('ENTRY_LINKS_URL_MISMATCH_RECIPROCAL_IMAGE_ERROR', 'De domeinnaam voor de wederzijdse link, %s, moet overeenkomen met de afbeelding domeinnaam, %s.');
define('ENTRY_LINKS_USERNAME', 'Gebruikersnaam: ');
define('ENTRY_LINKS_PASSWORD', 'Wachwoord: ');

define('ERROR_FAILED_IMAGE_TYPE', 'Ongeldig bestands type voor afbeelding.');
define('ERROR_FAILED_IMAGE_UPLOAD', 'Mislukt om afbeelding te laden.');
define('ERROR_INVALID_LOGIN', 'Vul een geldig gebruilersnaam en wachtwoord in.');

define('IMAGE_BUTTON_EDIT' , 'bewerk');
?>