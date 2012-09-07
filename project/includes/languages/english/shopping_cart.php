<?php
//$Id: /catalog/includes/languages/english/shopping_cart.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Cart Contents');
define('HEADING_TITLE', 'What\'s In My Cart?');
define('TABLE_HEADING_REMOVE', 'Remove');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product(s)');
define('TABLE_HEADING_TOTAL', 'Total');
define('TEXT_CART_EMPTY', '<center><b>Your Shopping Cart is empty!</center></b>');
define('SUB_TITLE_SUB_TOTAL', 'Sub-Total:');
define('SUB_TITLE_TOTAL', 'Total:');
define('OUT_OF_STOCK_CANT_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' <br>dont exist in desired quantity in our stock.<br><br><b>Please change the quantity!<br><br>Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us if you want to know when this product is back in stock!');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' <br>dont exist in desired quantity in our stock.<br><br><b>You can checkout with the selected quantity, but the order will only be accepted <br> when this product is back in stock!</b><br><br>Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us if you want to know when this product is back in stock!');
define('TEXT_ALTERNATIVE_CHECKOUT_METHODS', '- OR -');
define('TEXT_REMOVE_GIFT', '<span class="gift1">Please remove other gifts/offers from your cart first</span>');
define('TEXT_MAX_1_GIFT', '<span class="gift2">(Maximum 1 gift per order)</span>');
define('TEXT_QUALIFIED_FOR_GIFT', '<span class="gift3">By spending over %s you have qualified for the following gift!</span>');
define('TEXT_CLOSE_TO_FREE_GIFT', '<span class="gift4">Spend just %s more to get ...</span>');
?>