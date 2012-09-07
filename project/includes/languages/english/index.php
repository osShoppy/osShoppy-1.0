<?php
//$Id: /catalog/includes/languages/english/index.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'
//you can edit this content text at your administration panel-> tools-> edit text-> main page

define('TABLE_HEADING_NEW_PRODUCTS', 'New Products For %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Upcoming Products');
define('TABLE_HEADING_DATE_EXPECTED', 'Date Expected');
define('TABLE_HEADING_FEATURED_PRODUCTS', 'Featured Products');
define('TABLE_HEADING_FEATURED_PRODUCTS_CATEGORY', 'Featured Products in %s');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('INFO_TEXT', '<SPAN class="smallText">(you can sort on price, product id, product name and quantity by klicking on the box heading name)</SPAN>');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Model');
  define('TABLE_HEADING_PRODUCTS', 'Product Name');
  define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
  define('TABLE_HEADING_QUANTITY', 'Quantity');
  define('TABLE_HEADING_PRICE', 'Price');
  define('TABLE_HEADING_WEIGHT', 'Weight');
  define('TABLE_HEADING_BUY_NOW', 'Buy Now');
  define('TEXT_NO_PRODUCTS', '<b><center>There are no products to list in this category.</b></center>');
  define('TEXT_NO_PRODUCTS2', '<b><centerThere is no product available from this manufacturer.</b></center>');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Number of Products: ');
  define('TEXT_SHOW', '<b>Show:</b>');
  define('TEXT_BUY', 'Buy 1 \'');
  define('TEXT_NOW', '\' now');
  define('TEXT_ALL_CATEGORIES', 'All Categories');
  define('TEXT_ALL_MANUFACTURERS', 'All Manufacturers');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Welcome at ' . STORE_NAME . '.');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categories');
}
  define('CLOSED_MESSAGE', STORE_NAME . ' is temporarily <u>closed</u>. You may create a ' . STORE_NAME . ' account, login to your ' . STORE_NAME . ' account, and add products to your shopping cart. Your shopping cart will be saved for delayed checkout.<br><br>We plan to reopen: ');
?>