<?php
//$Id: /catalog/includes/languages/dutch/returns_emails.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

// This section covers the very first confirmation email sent to a customer, to say that their RMA request has been received.
define('EMAIL_SUBJECT_OPEN', 'Retouraanvraag verstuurd naar ' . STORE_NAME . ' met retournummer: ');
define('EMAIL_TEXT_TICKET_OPEN', 'Uw Retournummer is: <b><i>' . $rma_value . '</b></i>' . "\n\n");
define('EMAIL_THANKS_OPEN', 'Uw aanvraag voor een retournummer is succesvol ontvangen door ' . STORE_NAME . '<br>');
define('EMAIL_TEXT_OPEN', 'Uw aanvraag is verstuurd naar de desbetreffende afdeling voor afhandeling.<br>
Wanneer u contact met ons wil opnemen wat betreft uw retouraanvraag, vermeld dan bovenstaand retournummer in uw informatieaanvraag.<br>
Dit maakt het voor ons gemakkelijker uw retouraanvraag op juiste manier af te handelen.<br><br>');
define('EMAIL_CONTACT_OPEN', 'Voor hulp bij welke vraag u maar ook heeft kunt via het contactformulier op de website contact met ons opnemen.<br><br><br>');
define('EMAIL_WARNING_OPEN', '<b>Opmerking:</b> Dit email-adres is ons toegezonden bij het aanvragen van een retournummer. Wanneer u deze email onterecht ontvangen heeft neem dan contact op met ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// This section covers the confirmation email sent to the assigned administrator after an RMA request has been edited by a customer, in order to inform the admin that the ticket has been edited.
define('EMAIL_SUBJECT_ADMIN', 'Return request received');
define('EMAIL_TEXT_TICKET_ADMIN', 'RMA number -<b><i>' . $rma_value . '</b></i>' . "\n\n");
define('EMAIL_THANKS_ADMIN', 'This message is meant to inform you that the above return request has been updated by the customer' . "\n\n");
define('EMAIL_TEXT_ADMIN', 'Please log into the admin area to see the return information.' . "\n\n");
define('EMAIL_CONTACT_ADMIN', 'For help with any of our online services, please contact us at: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING_ADMIN', '<b>Note:</b> This email address was given to us by someone using it to submit a support request. If you did not send this request, please send a message to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
?>
