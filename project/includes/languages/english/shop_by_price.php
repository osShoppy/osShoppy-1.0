<?php
//$Id: /catalog/includes/languages/english/shop_by_price.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

$sel_currency = array();

$price_ranges = Array( 	"Under " .  $currencies->format(10) ,
						"From " . $currencies->format(10) . " to " . $currencies->format(20),
						"From " . $currencies->format(20). " to " . $currencies->format(30),
						"From " . $currencies->format(30). " to " . $currencies->format(50),
						"Above " . $currencies->format(50),
						"Show all price ranges");

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

define('NAVBAR_TITLE', 'Shop by Price');
// the following $range references come from catalog/shop_by_price.php
if ( isset($price_ranges[$range]) )
	define('HEADING_TITLE', 'Shop by Price - ' . $price_ranges[$range]);
else
	define('HEADING_TITLE', 'Shop by Price');
define('TABLE_HEADING_BUY_NOW', 'Buy Now!');
define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRICE', 'Price');
define('TABLE_HEADING_PRODUCTS', 'Product Name');
define('TABLE_HEADING_QUANTITY', 'Quantity');
define('TABLE_HEADING_WEIGHT', 'Weight');
// Product Listing in Columns - Start (You can remove those 3 lines if you are not using it).
define('TABLE_HEADING_MULTIPLE', 'Qty: ');
// Product Listing in Columns - End
define('TEXT_NO_PRODUCTS', '<p align="center"><br>Sorry no products currently available in this price range.</p>');
?>