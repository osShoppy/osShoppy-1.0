<?php
//$Id: /catalog/includes/languages/dutch/advanced_search.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE_1', 'Uitgebreid zoeken');
define('NAVBAR_TITLE_2', 'Zoek Resulaten');

define('HEADING_TITLE_1', 'Uitgebreid zoeken');
define('HEADING_TITLE_2', 'Producten die zijn gevonden met uw zoek opdracht');

define('HEADING_SEARCH_CRITERIA', 'Zoekcriteria');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Zoek in product omschrijving');
define('ENTRY_CATEGORIES', 'Categorie&euml;n:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Inclusief subcatogori&euml;en');
define('ENTRY_MANUFACTURERS', 'Fabrikanten:');
define('ENTRY_PRICE_FROM', 'Prijs vanaf:');
define('ENTRY_PRICE_TO', 'Prijs tot:');
define('ENTRY_DATE_FROM', 'Datum vanaf:');
define('ENTRY_DATE_TO', 'Datum tot:');

define('TEXT_SEARCH_HELP_LINK', '<u>Zoek Hulp</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Alle categorie&euml;n');
define('TEXT_ALL_MANUFACTURERS', 'Alle fabrikanten');

define('HEADING_SEARCH_HELP', 'Zoek hulp');
define('TEXT_SEARCH_HELP', 'Trefwoorden mogen gescheiden worden door AND en/of OR om meer controle te hebben over de zoek resultaten.<br><br>Bijvoorbeeld, <u>Microsoft AND muis</u> zou zoek resultaten genereren die beide woorden bevat. Maar, in het geval van <u>muise OR toetsenbord</u>, zouden de resultaten beide of een van de woorden bevatten.<br><br>Exacte overeenkomsten kunnen worden gezocht door de trefwoorden te vangen in aanhalingstekens.<br><br>Bijvoorbeeld, <u>"muziek dvd"</u> genereert zoek resultaten met deze exacte volgorde van trefwoorden.<br><br>Haakjes zijn ook toegestaan voor nog meer controle over uw zoekopdracht.<br><br>Bijvoorbeeld, <u>Microsoft and (toetsenbord or muis or "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Sluit scherm</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product naam');
define('TABLE_HEADING_MANUFACTURER', 'Fabrikant');
define('TABLE_HEADING_QUANTITY', 'Quantity');
define('TABLE_HEADING_PRICE', 'Prijs');
define('TABLE_HEADING_WEIGHT', 'Gewicht');
define('TABLE_HEADING_BUY_NOW', 'Koop Nu');

define('TEXT_NO_PRODUCTS', 'Er zijn geen producten gevonden.');

define('ERROR_AT_LEAST_ONE_INPUT', 'U moet minsten iets in het zoek veld invullen!.');
define('ERROR_INVALID_FROM_DATE', 'Verkeerde vanaf datum.');
define('ERROR_INVALID_TO_DATE', 'Verkeerde tot datum.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'De datum moet groter of gelijk zijn aan "Vanaf Datum".');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Prijs vanaf moet een getal zijn.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Prijs Tot moet een getal zijn.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Prijs tot moet groter of gelijk zijn aan prijs vanaf.');
define('ERROR_INVALID_KEYWORDS', 'Verkeerd trefwoord.');
?>