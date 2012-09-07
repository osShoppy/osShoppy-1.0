<?php
//$Id: /catalog/includes/languages/dutch/wishlist.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE_WISHLIST', 'Mijn Wenslijst');
define('HEADING_TITLE', 'Wat heb ik in mijn Wenslijst:');
define('HEADING_TITLE2', '\'s Wenslijst bevat:');
define('BOX_TEXT_PRICE', 'Prijs');
define('BOX_TEXT_PRODUCT', 'Product Naam');
define('BOX_TEXT_IMAGE', 'Afbeelding');
define('BOX_TEXT_SELECT', 'Selecteer');

define('BOX_TEXT_VIEW', 'Toon');
define('BOX_TEXT_HELP', 'Help');
define('BOX_WISHLIST_EMPTY', '<center><b>Er zijn geen producten in je wenslijst.</center></b>');
define('BOX_TEXT_NO_ITEMS', '<center><b>Er zijn geen producten in je wenslijst.</center></b>');

define('TEXT_NAME', 'Naam: ');
define('TEXT_EMAIL', 'Email: ');
define('TEXT_YOUR_NAME', 'Jouw Naam: ');
define('TEXT_YOUR_EMAIL', 'Jouw email: ');
define('TEXT_MESSAGE', 'Bericht: ');
define('TEXT_ITEM_IN_CART', '<center>Product al in Winkelwagen</center>');
define('TEXT_ITEM_NOT_AVAILABLE', 'Producten niet langer beschikbaar');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> producten in je wenslijst.)');
define('WISHLIST_EMAIL_TEXT', 'Het is mogelijk om de producten in je wenslijst per email te versturen naar vrienden.<br>
	   						   Vul hun naam en email adres in plaats een berichtje in het venster daaronder.<br>
							   Je kunt naar maximaal <b>' . DISPLAY_WISHLIST_EMAILS . '</b> mensen tegelijk een email versturen.<br>
							   Het ingevulde berichtje word naar alle ontvangers verstuurd.');
define('WISHLIST_EMAIL_TEXT_GUEST', 'Het is mogelijk om de producten in je wenslijst per email te versturen naar vrienden.<br>
	   								 Vul je eigen naam en email adres in en dan de naam en het email adres van de ontvanger(s).<br>
							   		 Je kunt naar maximaal <b>' . DISPLAY_WISHLIST_EMAILS . '</b> mensen tegelijk een email versturen.<br>
							   		 Het ingevulde berichtje word naar alle ontvangers verstuurd.');
define('WISHLIST_EMAIL_SUBJECT', 'heeft jouw zijn wenslijst verstuurd vanaf ' . STORE_NAME);  //Customers name will be automatically added to the beginning of this.
define('WISHLIST_SENT', 'Je wenslijst is succesvol verzonden');
define('WISHLIST_EMAIL_LINK', '

$from_name\'s publieke wenslijst is hier te vinden:
$link

Met vriendelijke groeten,
' . STORE_NAME); //$from_name = Customers name  $link = public wishlist link

define('WISHLIST_EMAIL_GUEST', 'Met vriendelijke groeten,
' . STORE_NAME);

define('ERROR_YOUR_NAME' , 'Vul alsjeblieft je naam in.');
define('ERROR_YOUR_EMAIL' , 'Vul alsjeblieft je email adres in.');
define('ERROR_VALID_EMAIL' , 'Vul alsjeblieft een geldig email adres in.');
define('ERROR_ONE_EMAIL' , 'Vul alsjeblieft tenminste 1 ontvanger in.');
define('ERROR_ENTER_EMAIL' , 'Vul alsjeblieft een email adres in.');
define('ERROR_ENTER_NAME' , 'Vul alsjeblieft de naam van de intvanger in.');
define('ERROR_MESSAGE', 'Schrijf alsjeblieft nog een klein berichtje');
?>
