<?php
//$Id: /catalog/includes/languages/dutch/index.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'
//you can edit this content text at your administration panel-> tools-> edit text-> main page

define('TABLE_HEADING_NEW_PRODUCTS', 'Nieuw(e) artikel(en) voor %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Verwachte artikel(en)');
define('TABLE_HEADING_DATE_EXPECTED', 'Datum');
define('TABLE_HEADING_FEATURED_PRODUCTS', 'Aanbevolen Artikelen');
define('TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY', 'Aanbevolen Artikelen in %s');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('INFO_TEXT', '<SPAN class="smallText">(U kunt sorteren op prijs, artikelnaam, artikelID en aantal door op de kolomnaam te klikken)</SPAN>');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Artikelmodel');
  define('TABLE_HEADING_PRODUCTS', 'Artikelnaam');
  define('TABLE_HEADING_MANUFACTURER', 'Fabrikant');
  define('TABLE_HEADING_QUANTITY', 'Aantal');
  define('TABLE_HEADING_PRICE', 'Prijs');
  define('TABLE_HEADING_WEIGHT', 'Gewicht');
  define('TABLE_HEADING_BUY_NOW', 'Bestel NU');
  define('TEXT_NO_PRODUCTS', '<b><center>Er bevinden zich geen artikelen in deze categorie.</b></center>');
  define('TEXT_NO_PRODUCTS2', '<b><center>Er zijn geen artikelen van deze fabrikant beschikbaar.</b></center>');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Artikel: ');
  define('TEXT_SHOW', '<b>Toon:</b>');
  define('TEXT_BUY', 'Bestel \'');
  define('TEXT_NOW', '\' NU!');
  define('TEXT_ALL_CATEGORIES', 'Alle categorie&euml;n');
  define('TEXT_ALL_MANUFACTURERS', 'Alle fabrikanten');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Welkom op ' . STORE_NAME . '.');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Sub-categorie&euml;n');
}
?>