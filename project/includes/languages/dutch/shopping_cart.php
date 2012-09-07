<?php
//$Id: /catalog/includes/languages/dutch/shopping_cart.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Inhoud winkelwagen');
define('HEADING_TITLE', 'Wat zit er in mijn winkelwagen?');
define('TABLE_HEADING_REMOVE', 'Verwijder');
define('TABLE_HEADING_QUANTITY', 'Aantal');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product(en)');
define('TABLE_HEADING_TOTAL', 'Totaal');
define('TEXT_CART_EMPTY', '<b><center>Uw Winkelwagen is leeg!</b></center>');
define('SUB_TITLE_SUB_TOTAL', 'Subtotaal:');
define('SUB_TITLE_TOTAL', 'Totaal:');
define('OUT_OF_STOCK_CANT_CHECKOUT', 'Producten met de melding: <b>' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</b> <br>zijn momenteel niet beschikbaar in de door u gevraagde hoeveelheid.<br><br><b> Gelieve het aantal te veranderen!</b><br><br>Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u wilt weten wanneer dit product weer voorradig is!');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Producten met de melding: <b>' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</b> <br>zijn momenteel niet besckikbaar in de door u gevraagde hoeveelheid.<br><br><b>U kunt afrekenen met de geselecteerde hoeveelheid, maar de bestelling word pas<br> in behandeling genomen wanneer dit product weer in voorraad is!</b><br><br>Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u wilt weten wanneer dit product weer voorradig is!');
define('TEXT_ALTERNATIVE_CHECKOUT_METHODS', '- OF -');
define('TEXT_REMOVE_GIFT', '<span class="gift1">Verwijder eerst andere kado uit de winkelwagen.</span>');
define('TEXT_MAX_1_GIFT', '<span class="gift2">(max. 1 kado per bestelling)</span>');
define('TEXT_QUALIFIED_FOR_GIFT', '<span class="gift3">Bij een besteding van meer dan %s is dit kado aan de winkelwagen toe te voegen!</span>');
define('TEXT_CLOSE_TO_FREE_GIFT', '<span class="gift4">Nog %s om dit kado te kiezen!</span>');
?>