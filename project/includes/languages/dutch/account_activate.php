<?php
//$Id: /catalog/includes/languages/dutch/account_activate.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE_1_ACTIVATION', 'Account Activeren');
define('NAVBAR_TITLE_2_ACTIVATION', 'Succes');
define('HEADING_TITLE_ACTIVATE', 'Account Activeren!');
define('HEADING_TITLE_ACTIVATION', 'Uw account is geactiveerd!');
define('TEXT_ACCOUNT_ACTIVATED', 'Uw account is succesvol geactiveerd!<br>
	   U kunt nu gebruik maken van alle services die ' .STORE_NAME. ' te bieden heeft.
	   <br>Wannner u nog een vraag heeft over uw registratie op ' . STORE_NAME . ', neem dan <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">contact</a> met ons op.');
define('CONFIRMATION_CODE','U bent nog 1 stap verwijderd voor het aanmaken van uw account!<br><br>
	   Er is naar het door u opgegeven e-mail adres een welkomst e-mail verstuurd met daarin een activeringscode.<br>
	   Klik op de activeringslink in de welkomst mail om uw account te activeren<br>
	   Ook kan in het invoerveld hieronder de activeringscode ingevuld worden. Klik dan ga verder om uw account te activeren.<br>
	   <br>');
define('ACTIVATION_ID_ERROR','Foute of niet correcte activeringscode, controleer uw activeringscode.');
define('ACTIVATION_STATUS_ERROR','Uw account is al geactiveerd!');
define('ACTIVATION_CODE_ERROR','U heeft een foute activeringscode ingevoerd, probeer het nog eens of neem contact met ons op.');
define('ENTER_CODE','Activerings code: ');
define('ENTRY_ACTIVATION_CODE_ERROR', 'Voer uw activeringscode eerst in.');
?>