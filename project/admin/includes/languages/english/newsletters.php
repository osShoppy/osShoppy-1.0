<?php //$Id: /catalog/admin/includes/languages/english/newsletter.php

define('HEADING_TITLE', 'Newsletter Manager');

define('TABLE_HEADING_NEWSLETTERS', 'Newsletters Title');
define('TABLE_HEADING_NEWSLETTERS_DATE', 'Newsletters Date');
define('TABLE_HEADING_SIZE', 'Size');
define('TABLE_HEADING_MODULE', 'Module');
define('TABLE_HEADING_SENT', 'Sent');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_NEWSLETTER_MODULE', 'Module:');
define('TEXT_NEWSLETTER_TITLE', 'Newsletter Title:');
define('TEXT_NEWSLETTER_HEADER_TEXT', 'Head:');
define('TEXT_NEWSLETTER_HEADER_DATE', 'Date:');
define('TEXT_NEWSLETTER_CONTENT', 'Content:');

define('TEXT_NEWSLETTER_DATE_ADDED', 'Date Added:');
define('TEXT_NEWSLETTER_DATE_SENT', 'Date Sent:');

define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this newsletter?');

define('TEXT_PROGRESS', 'Progress - ');
define('TEXT_OFF', ' of ');
define('TEXT_EMAILS_SENT', ' emails are sent.');
define('TEXT_PLEASE_WAIT', 'Please wait .. sending emails ..<br><br>Please do not interrupt this process!<br><br>
							If the process is interrupted somehow, there is no need to worry. <br>
							Just try to send the newsletter again and the process will continue where it was interrupted. <br>
							No customer will receive duplets of emails as which emails are sent is logged in the database.');
define('TEXT_FINISHED_SENDING_EMAILS', 'Finished sending e-mails!');

define('ERROR_NEWSLETTER_TITLE', 'Error: Newsletter title required');
define('ERROR_NEWSLETTER_MODULE', 'Error: Newsletter module required');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'Error: Please lock the newsletter before deleting it.');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'Error: Please lock the newsletter before editing it.');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'Error: Please lock the newsletter before sending it.');

define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Customer Groups');
define('TEXT_SEND_TO_CUSTOMERS_GROUPS', '<div align=\'center\' style=\'margin-top: 10px; margin-bottom: 5px; padding-top: 5px; font-weight: bold; border-top: 1px solid black;\'>Send to these customer groups:</div>');
?>