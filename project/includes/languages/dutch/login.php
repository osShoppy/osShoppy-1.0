<?php
//$Id: /catalog/includes/languages/dutch/login.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', CUSTOMERS_GROUP_EMAIL_CHECK);
define('TEXT_CHOOSE_CUSTOMER_GROUP', '<b>Kies een klantengroep.</b> ');
// NOTE: The above support@hilvy.nl entry should be replaced with the site Admin's email address. 
// This enables him to log-in as a member of each group for testing purposes. Frontend Account Needed 

define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Welkom, Logt u aub in');

define('HEADING_NEW_CUSTOMER', 'Registreren als nieuwe Klant?');
define('TEXT_NEW_CUSTOMER', 'Ik ben een nieuwe klant.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Met het aanmaken van een account op ' . STORE_NAME . ' kunt u van al onze webwinkel diensten gebruik maken.<br>
	   									  Met een account gaat het maken van een bestelling een stuk sneller en gemakkelijker.<br>
	   									  U kunt op uw account terugkijken naar de gemaakte bestellingen of de status van uw huidige bestelling bekijken.
										  <br><br><center><font color="#ff0000"><b>Opmerking:</b></font> Uw gegevens zullen uitsluitend gebruikt worden voor het verzenden en factureren van bestellingen op ' . STORE_NAME . ' en zullen niet verstrekt worden aan derden.</center>');

define('HEADING_RETURNING_CUSTOMER', 'Bent u al klant op ' . STORE_NAME . '?');
define('TEXT_RETURNING_CUSTOMER', 'Log hier in op uw account.');
define('TEXT_PASSWORD_FORGOTTEN', 'Wachtwoord vergeten? Klik hier.');
define('TEXT_LOGIN_ERROR_ACTIVATION', 'Het is ook mogelijk dat u uw account nog moet activeren. U kunt <a href="account_activate.php">hier</a> uw account activeren');
define('TEXT_LOGIN_ERROR', 'Error: Geen overenkomst gevonden met het ingevulde email adres en/of wachtwoord.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Opgelet:</b></font> Uw &quot;Winkelwagen&quot; zal worden overgenomen worden door&quot;Klanten Winkelwagen&quot; wanneer u zich heeft aangemeld. <a href="javascript:session_win();">[Meer info]</a>');
define('TEXT_GUEST_INTRODUCTION', '<b>Wilt u meteen doorgaan met afrekenen?</b><br><br>Wilt u afrekenen zonder klanten account? <br>
	   Houdt u er rekening mee dat niet al onze diensten beschikbaar zijn voor klanten die geen account bezitten. Ook kunt u niet de status van uw bestelling volgen of terug zien en elke keer dat u bij ons komt winkelen zult u steeds opnieuw uw gegevens moeten invoeren. <br><br><b><center> Een account aanmaken is gratis.</center></b><br>Wilt u doorgaan met afrekenen zonder registratie? Klik dan op de knop "Afrekenen".');
?>