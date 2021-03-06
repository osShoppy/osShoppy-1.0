<?php //$Id: /catalog/admin/includes/languages/dutch/create_order.php

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selecteer');
define('TYPE_BELOW', 'Type Below');

define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/day/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakters.\n');
define('JS_CITY', '* The \'Suburb\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' karakters.\n');
define('JS_STATE', '* The \'State\' must be entered.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.\n');
define('JS_COUNTRY', '* The \'Country\' entry must be selected.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakters.\n');
define('JS_PASSWORD', '* The \'Password\' entry must have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakters.\n');

define('CATEGORY_COMPANY', 'Bedrijfs Gegevens');
define('CATEGORY_PERSONAL', 'Persoonlijke Gegevens');
define('CATEGORY_ADDRESS', 'Adres');
define('CATEGORY_CONTACT', 'Contact Informatie');
define('CATEGORY_OPTIONS', 'Opties');
define('CATEGORY_PASSWORD', 'Wachtwoord');
define('CATEGORY_CORRECT', 'Als dit de juiste klant druk dan op bevestigen.');
define('ENTRY_CUSTOMERS_ID', 'Klant ID:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;');
define('ENTRY_COMPANY', 'Bedrijfsnaam:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Geslacht:');
define('ENTRY_GENDER_FEMALE', 'Vrouw:');
define('ENTRY_GENDER_MALE', 'Man:');
define('ENTRY_GENDER_ERROR', '&nbsp;');
define('ENTRY_GENDER_TEXT', '&nbsp;');
define('ENTRY_FIRST_NAME', 'Voornaam:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;');
define('ENTRY_INSERTION_NAME', 'tussenvoegsel:');
define('ENTRY_INSERTION_NAME_ERROR', '&nbsp;');
define('ENTRY_INSERTION_NAME_TEXT', '&nbsp;');
define('ENTRY_LAST_NAME', 'Achternaam:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;');
define('ENTRY_DATE_OF_BIRTH', 'Geboorte Datum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(eg. 05/21/1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(bv. 05/21/1970) ');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adres:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Jouw e-mail adres blijkt niet geldig te zijn!</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">e-mail adres bestaat reeds!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;');
define('ENTRY_STREET_ADDRESS', 'Straat:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;');
define('ENTRY_SUBURB', 'Wijk:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postcode:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_POST_CODE_TEXT', '&nbsp;');
define('ENTRY_CITY', 'Wijk:');
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_CITY_TEXT', '&nbsp;');
define('ENTRY_STATE', 'Provincie:');
define('ENTRY_STATE_ERROR', '&nbsp;');
define('ENTRY_STATE_TEXT', '&nbsp;');
define('ENTRY_COUNTRY', 'Stad:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;');
define('ENTRY_TELEPHONE_NUMBER', 'Telefoon nummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;');
define('ENTRY_FAX_NUMBER', 'Fax Nummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Nieuwsbrief:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Aangemeld');
define('ENTRY_NEWSLETTER_NO', 'Niet aangemeld');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Wachwoord:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Wachtwoord bevestiging:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakters</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;');
define('PASSWORD_HIDDEN', '--VERBORGEN--');

define('CREATE_ORDER_TEXT_EXISTING_CUST', 'Bestaand Klanten Account');
define('CREATE_ORDER_TEXT_NEW_CUST', 'Nieuw Klanten Account');
define('CREATE_ORDER_TEXT_NO_CUST', 'Zonder Klanten Account');

define('HEADING_TITLE', 'Nieuwe Bestelling');
define('TEXT_SELECT_CUST', '- Selecteer een klant -'); 
define('TEXT_SELECT_CURRENCY', '- Selecteer een Valuta -');
define('TEXT_SELECT_CURRENCY_TITLE', 'Selecteer een Valuta');
define('BUTTON_TEXT_SELECT_CUST', 'Selecteer een klant:'); 
define('TEXT_OR_BY', 'of selecteer met klanten ID:'); 
define('TEXT_STEP_1', 'Stap 1 - Kies bestaande klant, nieuw klanten account of zonder klanten account.');
define('TEXT_STEP_2', 'Stap 2 - Bevestig bestaande klant of voer hieronder de nieuwe klantgegevens in.');
define('BUTTON_SUBMIT', 'Selecteer');
define('ENTRY_CURRENCY','Valuta: ');
define('ENTRY_ADMIN','Bestelling geplaatst door:');
define('TEXT_CS','Klanten Service');

define('ACCOUNT_EXTRAS','Account extra\'s');
define('ENTRY_ACCOUNT_PASSWORD','Wachtwoord');
define('ENTRY_NEWSLETTER_SUBSCRIBE','Nieuwsbrief');
define('ENTRY_ACCOUNT_PASSWORD_TEXT','');
define('ENTRY_NEWSLETTER_SUBSCRIBE_TEXT','1 = aangemeld, of 0 = niet aangemeld.');
?>