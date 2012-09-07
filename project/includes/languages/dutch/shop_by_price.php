<?php
//$Id: /catalog/includes/languages/dutch/shop_by_price.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

$sel_currency = array();

$price_ranges = Array( 	"Onder " .  $currencies->format(10) ,
						"Van " . $currencies->format(10) . " tot " . $currencies->format(20),
						"Van " . $currencies->format(20). " tot " . $currencies->format(30),
						"Van " . $currencies->format(30). " tot " . $currencies->format(50),
						"Boven " . $currencies->format(50),
						"Toon alle Prijsklasses >>");

$price_min = Array(  0,
                    10,
					20,
					30,
					50,
					0);

$price_max = Array( 10,
                    20,
					30,
					50,
					0,
					0);

define('NAVBAR_TITLE', 'Zoek op Prijs');
// the following $range references come from catalog/shop_by_price.php
if ( isset($price_ranges[$range]) )
	define('HEADING_TITLE', 'Zoek op Prijs - ' . $price_ranges[$range]);
else
	define('HEADING_TITLE', 'Zoek op Prijs');
define('TABLE_HEADING_BUY_NOW', 'Bestel NU');
define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MANUFACTURER', 'Fabrikant');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRICE', 'Prijs');
define('TABLE_HEADING_PRODUCTS', 'Artikel Naam');
define('TABLE_HEADING_QUANTITY', 'Aantal');
define('TABLE_HEADING_WEIGHT', 'Gewicht');
// Product Listing in Columns - Start (You can remove those 3 lines if you are not using it).
define('TABLE_HEADING_MULTIPLE', 'Aantal: ');
// Product Listing in Columns - End
define('TEXT_NO_PRODUCTS', '<b><p align="center"><br>Er zijn op dit moment geen artikelen in deze prijsklasse.</p></b><br>');
?>