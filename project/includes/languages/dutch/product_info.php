<?php
//$Id: /catalog/includes/languages/dutch/product_info.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('TEXT_PRODUCT_NOT_FOUND', 'Artikel niet gevonden!');
define('TEXT_CURRENT_REVIEWS', 'Recente Recensies:');
define('TEXT_MORE_INFORMATION', 'Voor meer informatie over dit artikel, bezoek de <a href="%s" target="_blank"><u>website</u></a> van de fabrikant.');

define('TEXT_DATE_ADDED', 'Dit artikel is aan ons assortiment toegevoegd op %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">Dit artikel zal in voorraad zijn op %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Klanten die dit artikel kochten, kochten ook:');
define('TEXT_PRODUCT_OPTIONS', 'Opties:');
define('TEXT_CLICK_TO_ENLARGE', 'klik om te vergroten');

define('PRODUCT_ADDED_TO_WISHLIST', ' Product is succesvol aan mijn wenslijstje toegevoegd!');

define('TEXT_ENTER_QUANTITY', 'Aantal');
define('TEXT_PRICE_PER_PIECE', 'Per Stuk');
define('TEXT_PRODUCT_POINTS', 'Op dit artikel ontvangt u %s spaarpunten met een waarde van %s.');
define('TEXT_SAVINGS', 'U bespaart');
define('MINIMUM_ORDER_TEXT', 'Minimale bestelling: ');
define('PB_DROPDOWN_BEFORE', '');
define('PB_DROPDOWN_BETWEEN', ' bij ');
define('PB_DROPDOWN_AFTER', ' elk');
define('PB_FROM', 'vanaf');

define('TEXT_TAB_DESCRIPTION', 'Algemeen');
define('TEXT_TAB_DH', 'Algemene Informatie');

define('TEXT_TAB_SPEC', 'Specificaties');
define('TEXT_TAB_SH', 'Uitgebreide Artikel Specificaties');

define('TEXT_TAB_MUSTHAVE', 'Vereisten');
define('TEXT_TAB_MH', 'Vereisten voor dit artikel');

define('TEXT_TAB_EXTRAIMAGE', 'Afbeeldingen');
define('TEXT_TAB_ADDITTIONAL_IMAGES', 'Afbeeldingen');

define('TEXT_TAB_MANUAL', 'Handleiding');
define('TEXT_TAB_MN', 'Handleiding in kort uitvoering');

define('TEXT_TAB_EXTRA1', 'Extra');
define('TEXT_TAB_EX', 'Extra voor dit artikel');

define('TEXT_TAB_MOREINFO', 'meer Info');
define('TEXT_TAB_MI', 'meer Informatie over dit artikel');

define('TEXT_TAB_ASKAQUESTION', 'Stel een vraag');

define('TEXT_TAB_RELATED', 'Related');
define('TEXT_ASK_QUESTION', 'Stel hier uw vraag.');

define('TEXT_VIEWING', 'U bekijkt nu:');

define('TEXT_ARTICLES_RELATED', 'Artikels over dit product: ');
define('TEXT_FAQ_RELATED', 'Veel gestelde vragen over dit product: ');
define('TEXT_GENERAL_INFO_RELATED', 'Algemene Informatie over dit product: ');

define('BOX_HEADING_RELATED_PRODUCTS', 'Gerelateerde Producten');
define('RELATED_PRODUCTS_MODEL_COMBO', ' (%s)');
define('RELATED_PRODUCTS_PRICE_TEXT', 'Prijs %s');
define('RELATED_PRODUCTS_QUANTITY_TEXT', 'Nog <b>%s</b> in Voorraad!');

define('TEXT_FREE_GIFT', 'Gratis Kado bij &euro; ' . $product_gift['threshold'] . ',- aankoop.');
define('TEXT_DISCOUNT_GIFT', 'Voor maar ' . $currencies->display_price($gift['products_price'], tep_get_tax_rate($gift['products_tax_class_id'])) . ' bij &euro; ' . $product_gift['threshold'] . ',- aankoop.');

define('TEXT_GET_1_FREE_PROMOTION', '<b>Special tijdelijke aanbieding: Koop %u %s en krijg een %u %s gratis!</b>');

define('TEXT_OUT_OF_STOCK', 'Niet op Voorraad');
define('TEXT_OUT_OF_STOCK_MESSAGE', 'De combinatie van gekozen opties is tijdelijk niet op voorraad. ');
define('TEXT_SELECT_OPTIONS', 'Er moet nog een optie gekozen worden voordat het product aan de winkelwagen toegevoegd kan worden.');
define('STOCK_LIST_IN_PI_TEXT_HEADING', 'In Voorraad:');
define('STOCK_LIST_IN_PI_TEXT_PRICE', 'Prijs');
define('STOCK_LIST_IN_PI_TEXT_STOCK', 'Aantal.');

define('TEXT_INVALID_CUSTOMER', 'Het geselcteerde citaat is niet voor uw bestemd. <br>Is dit wel uw citaat dan moet u inloggen om het te bekijken.');
define('HEADING_INVALID_CUSTOMER', 'Ongeldige klanten ID');
define('TEXT_CUSTOMERS_EMAIL_ADDRESS', 'Email Adres');
?>