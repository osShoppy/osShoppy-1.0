<?php
//$Id: /catalog/includes/languages/english/products_info.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('TEXT_PRODUCT_NOT_FOUND', 'Product not found!');
define('TEXT_CURRENT_REVIEWS', 'Current Reviews:');
define('TEXT_MORE_INFORMATION', 'For more information, please visit this products <a href="%s" target="_blank"><u>webpage</u></a>.');
define('TEXT_DATE_ADDED', 'This product was added to our catalog on %s.');
define('TEXT_DATE_AVAILABLE', '<font color="#ff0000">This product will be in stock on %s.</font>');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'Customers who bought this product also purchased');
define('TEXT_PRODUCT_OPTIONS', 'Available Options:');
define('TEXT_CLICK_TO_ENLARGE', 'Click to enlarge');
define('PRODUCT_ADDED_TO_WISHLIST', 'Product has been successfully added to your wishlist');
define('TEXT_ENTER_QUANTITY', 'Quantity');
define('TEXT_PRICE_PER_PIECE', 'Price&nbsp;for&nbsp;each');
define('TEXT_PRODUCT_POINTS', 'Buy this item and earn %s points valued at %s.');
define('TEXT_SAVINGS', 'Your savings');
define('MINIMUM_ORDER_TEXT', 'Minimum order: ');
define('PB_DROPDOWN_BEFORE', '');
define('PB_DROPDOWN_BETWEEN', ' at ');
define('PB_DROPDOWN_AFTER', ' each');
define('PB_FROM', 'from');
define('TEXT_TAB_RELATED', 'Related');
define('TEXT_TAB_SPEC', 'Specifications');
define('TEXT_TAB_DH', 'Product Details');
define('TEXT_TAB_SH', 'Product Specifications');
define('TEXT_TAB_MUSTHAVE', 'Requirements');
define('TEXT_TAB_EXTRAIMAGE', 'Product Pictures');
define('TEXT_TAB_ADDITTIONAL_IMAGES', 'Product Pictures');
define('TEXT_TAB_MANUAL', 'Manuals');
define('TEXT_TAB_EXTRA1', 'Extra');
define('TEXT_TAB_MOREINFO', 'More info');
define('TEXT_TAB_DESCRIPTION', 'Simple');
define('TEXT_TAB_ASKAQUESTION', 'Ask a question');
define('TEXT_ASK_QUESTION', 'Ask a question about<br>this product...');
define('TEXT_VIEWING', 'Currently viewing:');
define('TEXT_ARTICLES_RELATED', 'Articles about this product: ');
define('TEXT_FAQ_RELATED', 'Frequently asked question about this product: ');
define('TEXT_GENERAL_INFO_RELATED', 'General informatin about this product: ');
define('BOX_HEADING_RELATED_PRODUCTS', 'Related Products');
define('RELATED_PRODUCTS_MODEL_COMBO', ' (%s)');
define('RELATED_PRODUCTS_PRICE_TEXT', 'Price %s');
define('RELATED_PRODUCTS_QUANTITY_TEXT', 'Only <b>%s</b> in Stock!');
define('TEXT_FREE_GIFT', 'Free gift with &euro; ' . $product_gift['threshold'] . ',- purchase.');
define('TEXT_DISCOUNT_GIFT', 'Only ' . $currencies->display_price($gift['products_price'], tep_get_tax_rate($gift['products_tax_class_id'])) . ' with &euro; ' . $product_gift['threshold'] . ',- purchase.');
define('TEXT_GET_1_FREE_PROMOTION', '<b>Special limited offer: Buy %u %s and get %u %s free!</b>');
define('TEXT_OUT_OF_STOCK', 'Out of stock');
define('TEXT_OUT_OF_STOCK_MESSAGE', 'The combination of options you have selected is currently out of stock.  Please select another combination.');
define('TEXT_SELECT_OPTIONS', 'You must select product options before adding this product to your cart.');
define('STOCK_LIST_IN_PI_TEXT_HEADING', 'Currently on stock:');
define('STOCK_LIST_IN_PI_TEXT_PRICE', 'Price');
define('STOCK_LIST_IN_PI_TEXT_STOCK', 'Qty.');
define('TEXT_INVALID_CUSTOMER', 'The selected quote is meant for a particular customer.
If you are sure it is your quote, you must be logged in to view it.');
define('HEADING_INVALID_CUSTOMER', 'Invalid customer ID');
define('TEXT_CUSTOMERS_EMAIL_ADDRESS', 'Email Address');
?>