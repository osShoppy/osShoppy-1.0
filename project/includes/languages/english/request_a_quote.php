<?php
//$Id: /catalog/includes/languages/english/request-a-quotes.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Request A quote');
define('HEADING_TITLE', 'Request A Quote');

define('TEXT_INFORMATION', 'Please fill out the form below to receive a personalized quote. We will
respond within 48 hours and your quote will displayed on our 
<a title="Quotes" class="quotesLink" href="' . tep_href_link(FILENAME_QUOTES, '', 'NONSSL') . '"> Quotes </a>page'
);

define('TEXT_QUOTE_SENT_SUCCESS', 'Your request has been successfully submitted. We will respond
within 48 hours with your personalized quote.'
);

define('TEXT_QUOTE_EMAIL_BODY', '%s has requested the following quote %s%s');
define('TEXT_QUOTE_EMAIL_SUBJECT', 'Quote request');
define('TEXT_QUOTE_FILL_FROM_CART', '(add cart contents)');
define('TEXT_QUOTE_FILL_FROM_PRODUCT_LIST', '(select from list)');

define('ENTRY_NAME', 'Your Name:');
define('ENTRY_EMAIL_ADDRESS', 'Email Address');
define('ENTRY_QUOTE_MESSAGE', 'Details of Quote');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'A valid Email address is required.');
define('ENTRY_NAME_CHECK_ERROR', 'A valid name is required.');
define('ENTRY_MESSAGE_CHECK_ERROR', 'Thank you. Your request is missing the details of the quote.');


define('IMAGE_BUTTON_REQUEST_QUOTE', 'Request Quote');
?>
