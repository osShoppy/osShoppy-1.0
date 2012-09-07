<?php //$Id: /catalog/admin/includes/languages/dutch/links_status.php

define('HEADING_TITLE_LINKS_STATUS', 'Links Status');
define('HEADING_TITLE_SEARCH', 'Search');
define('TEXT_HEADING_SUB_TEXT', 'This page shows the current status of the reciprocal link (so it may
take a while to load). Only approved or pending links are checked.
Whether the link was found is shown by the check mark or X in the left column.  You can also
change the status of the links or delete them (there\'s no warning so be careful) by clicking on the checkboxes
in the second column, selecting the option and clicking update. The <b>Domains Match</b> column indicates
a link where the domain names for the links are from different sites, which is a common ploy of people trying to get
credit for other sites. If that row is shown in yellow, it means that link is approved.
');
define('TEXT_DISPLAY_NUMBER_OF_LINKS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> links)');
define('TEXT_CHECK_ALL', 'Check All');
define('TEXT_LINK_DELETE', 'Delete');
define('TEXT_SITE_FOUND', 'Site Found');
define('TEXT_LINK_FOUND', 'Link Found');
define('TEXT_LINK_STATUS', 'Status');
define('TEXT_LINK_TITLE', 'Title');
define('TEXT_LINK_URL', 'URL');
define('TEXT_LINK_DOMAIN_MATCH', 'Domains Match');
define('TEXT_LINK_LAST_DATE_CHECKED', 'Last Date Checked');
define('TEXT_NOTIFY', 'Notify:');
define('TEXT_SET_TO', 'Set To:');
define('IMAGE_BUTTON_CHECK_ALL', 'Check All');
define('IMAGE_BUTTON_UPDATE', 'Update');

define('EMAIL_TEXT_SUBJECT', 'Link Status Update');
define('EMAIL_TEXT_STATUS_UPDATE', 'Dear %s,' . "\n\n" . 'The status of your link at ' . STORE_NAME . ' has been updated.' . "\n\n" . 'New status: %s' . "\n\n" . '%s' . "\n\n" . 'Please reply to this email if you have any questions.' . "\n");
?>