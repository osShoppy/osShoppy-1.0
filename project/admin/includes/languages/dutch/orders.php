<?php //$Id: /catalog/admin/includes/languages/dutch/orders.php

define('HEADING_TITLE', 'Bestellingen');
define('HEADING_TITLE_SEARCH', 'Bestelnummer:');
define('HEADING_TITLE_STATUS', 'Status:');

define('TABLE_HEADING_COMMENTS', 'Commentaar');
define('TABLE_HEADING_CUSTOMERS', 'Klanten');
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Klanten Groep');
define('TABLE_HEADING_ORDER_TOTAL', 'Order totaal');
define('TABLE_HEADING_DATE_PURCHASED', 'Gekocht op');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actie');
define('TABLE_HEADING_QUANTITY', 'Aantal');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Artikelen');
define('TABLE_HEADING_TAX', 'BTW');
define('TABLE_HEADING_TOTAL', 'Totaal');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prijs (excl.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prijs (incl.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Totaal (excl.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Totaal (incl.)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Klant ingelicht');
define('TABLE_HEADING_DATE_ADDED', 'Datum toegevoegd');

define('ENTRY_CUSTOMER', 'Klant:');
define('ENTRY_SOLD_TO', 'Verkocht aan:');
define('ENTRY_DELIVERY_TO', 'Leveren aan:');
define('ENTRY_SHIP_TO', 'Verzenden naar:');
define('ENTRY_SHIPPING_ADDRESS', 'Afleveradres:');
define('ENTRY_BILLING_ADDRESS', 'Factuuradres:');
define('ENTRY_PAYMENT_METHOD', 'Betaalwijze:');
define('ENTRY_ORDER_ID', 'Bestelnummer:');
define('ENTRY_DATE_TIME', 'Besteldatum:');
define('ENTRY_CREDIT_CARD_TYPE', 'Creditcard type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Creditcard eigenaar:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Creditcard nummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Creditcard vervalt op:');
define('TEXT_INFO_CUSTOMER_NOTES_BACKEND','<b>Klant Opmerkingen:</b><br><small>(alleen zichtbaar in admin)</small>');
define('TEXT_INFO_CUSTOMER_NOTES_FRONTEND','<b>Klant Opmerkingen:</b><br><small>(ook zichtbaar op klant account pagina)</small>');
define('ENTRY_SUB_TOTAL', 'Subtotaal:');
define('ENTRY_TAX', 'BTW:');
define('ENTRY_SHIPPING', 'Verzendkosten:');
define('ENTRY_TOTAL', 'Totaal:');
define('ENTRY_DATE_PURCHASED', 'Datum gekocht:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Datum laatste update:');
define('ENTRY_NOTIFY_CUSTOMER', 'Licht klant in:');
define('ENTRY_NOTIFY_COMMENTS', 'Voeg commentaar toe:');
define('ENTRY_PRINTABLE', 'Print factuur');
define('ENTRY_NOTIFY_POINTS', 'Bevestig spaarpunten in wacht:');
define('ENTRY_QUE_POINTS', 'en zet in datbase rij');
define('ENTRY_QUE_DEL_POINTS', 'en verwijder:');
define('ENTRY_CONFIRMED_POINTS', 'Spaarpunten Bevestigd.  ');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Verwijder bestelling');
define('TEXT_INFO_DELETE_INTRO', 'Weet u zeker dat u deze bestelling wil verwijderen?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Voorraad bijwerken');
define('TEXT_DATE_ORDER_CREATED', 'Datum aangemaakt:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Laatst aangepast:');
define('TEXT_INFO_PAYMENT_METHOD', 'Betaalwijze:');

define('TABLE_HEADING_EDIT_ORDERS', 'Pas de bestelling aan');
define('TEXT_IMAGE_CREATE','Maak een bestelling');
define('TEXT_INFO_CUSTOMER_SERVICE_ID','Besteld door:');

define('TEXT_ALL_ORDERS', 'Alle bestellingen');
define('TEXT_NO_ORDER_HISTORY', 'Geen bestelgeschiedenis beschikbaar');
define('TEXT_NO_ACCOUNT', '<font color="red"> Let op:</font> Bij deze bestelling is geen account aangemaakt!');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Uw Bestelling op '.STORE_NAME.' is aangepast!');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestelnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Gedetailleerd overzicht:');
define('EMAIL_TEXT_DATE_ORDERED', 'Besteldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Uw order is aangepast naar de volgende status.' . "\n\n" . 'Nieuwe status: %s' . "\n\n" . 'Reageer s.v.p. op deze email als u nog vragen heeft.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Het commentaar voor uw order is' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fout: bestelling bestaat niet.');
define('SUCCESS_ORDER_UPDATED', 'Succes: De bestelling is succesvol ge-update.');
define('WARNING_ORDER_NOT_UPDATED', 'Waarschuwing: Er valt niets aan te passen. Geen order update uitgevoerd.');
?>