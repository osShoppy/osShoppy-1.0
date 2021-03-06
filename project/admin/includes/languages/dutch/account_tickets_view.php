<?php
/*
  $Id: ticket_view.php,v 1.4 2003/07/13 20:22:02 hook Exp $

  OSC-SupportTicketSystem
  Copyright (c) 2003 Henri Schmidhuber IN-Solution
  
  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Bekijk Support Ticket');
define('NAVBAR_TITLE', 'Bekijk Support Ticket');

define('TABLE_HEADING_NR','Ticket Nr');
define('TABLE_HEADING_SUBJECT','Onderwerp');
define('TABLE_HEADING_STATUS','Status');
define('TABLE_HEADING_DEPARTMENT','Afdeling');
define('TABLE_HEADING_PRIORITY','Preferentie');
define('TABLE_HEADING_CREATED','Open');
define('TABLE_HEADING_LAST_MODIFIED','Laatste verandering');

define('TEXT_TICKET_BY', 'Van');
define('TEXT_COMMENT','Reply:');
define('TEXT_DATE','Datum:');
define('TEXT_DEPARTMENT','Afdeling:');
define('TEXT_DISPLAY_NUMBER_OF_TICKETS', 'Vertoning <b>%d</b> to <b>%d</b> (of <b>%d</b> tickets)');

define('TEXT_PRIORITY','Preferentie:');
define('TEXT_OPENED', 'Open:');
define('TEXT_STATUS', 'Status:');
define('TEXT_TICKET_NR','Ticket No.:');
define('TEXT_CUSTOMERS_ORDERS_ID','OrderID:');
define('TEXT_VIEW_TICKET_NR','Plaats hier uw Ticket nr:');

define('TICKET_WARNING_ENQUIRY_TOO_SHORT','Error: Uw vraag/opmerking is te kort het moet minstens ' . TICKET_ENTRIES_MIN_LENGTH . ' Tekens');
define('TICKET_MESSAGE_UPDATED','Uw Ticket is geupdated');

define ('TEXT_VIEW_TICKET_LOGIN','<a href="%s">Om uw ticket te bekijken logt u hier in</a>');
?>
