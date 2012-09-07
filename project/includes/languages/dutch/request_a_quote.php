<?php
//$Id: /catalog/includes/languages/dutch/request_a_quote.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Citaat Aanvraag');
define('HEADING_TITLE', 'Citaat Aanvraag');

define('TEXT_INFORMATION', 'Vul onderstaand formulier in om een citaat aan te vragen.
	   de citaten worden <a title="Quotes" class="quotesLink" href="' . tep_href_link(FILENAME_QUOTES, '', 'NONSSL') . '">hier</a> geplaatst.');

define('TEXT_QUOTE_SENT_SUCCESS', 'Uw citaat is succesvol verzonden. Binnen 48 uur nemen we contact met uw op.');

define('TEXT_QUOTE_EMAIL_BODY', '%s heeft het volgende citaat verstuurd %s%s');
define('TEXT_QUOTE_EMAIL_SUBJECT', 'Citaat Aanvraag');
define('TEXT_QUOTE_FILL_FROM_CART', '(voeg inhoud winkelwagen toe)');
define('TEXT_QUOTE_FILL_FROM_PRODUCT_LIST', '(selecteer uit lijst)');

define('ENTRY_NAME', 'Jouw Naam:');
define('ENTRY_EMAIL_ADDRESS', 'Email Adres');
define('ENTRY_QUOTE_MESSAGE', 'Details van Citaat');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Er moet nog een email adres ingevuld te worden.');
define('ENTRY_NAME_CHECK_ERROR', 'Er moet nog een naam ingevuld worden.');
define('ENTRY_MESSAGE_CHECK_ERROR', 'Er moet nog een citaat ingevuld worden.');
?>