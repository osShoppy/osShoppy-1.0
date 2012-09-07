<?php //$Id: /catalog/admin/includes/languages/dutch/additional_images.php


define('HEADING_TITLE', 'Additional Images Thumbnail Utility');

define('TEXT_NOTHING_SELECTED_TITLE', 'No products selected');
define('TEXT_NOTHING_SELECTED', 'No products selected');
define('TEXT_SELECT_TASK', 'Select task');

define('TEXT_AI_SHOW', 'Display');
define('TEXT_AI_PROCESS', 'Process');
define('TEXT_AI_PROCESS_ALL', 'Process All Shown');

define('TEXT_AI_IMAGES_CREATE_FAIL', 'Your PHP version must be greater then or equal to 4.3.2 to use the thumbnailing feature of this contirbution.');

define('TEXT_AI_UTILITY_DESCRIPTION', 'This utility will create thumbnails for products. To prevent time-outs, the number of thumbnails created at one time is limited. You may select the number of products to be shown before doing the thumbnail processing.');
define('TEXT_AI_PROCESS_DESCRIPTION', 'To create or recreate thumbnails on all the products shown click process.');
define('TEXT_AI_PROCESS_ALL_DESCRIPTION', 'This process is designed to reprocess product images. This will create a thumbnail and medium from the image defined as popup (largest) image. This is best used if you have uploaded new images for products.');
define('TEXT_AI_PROCESS_UNPROCESSED_DESCRIPTION', 'This is designed to process product images that were added to your shop before adding this contrib. It will look for empty product image fields that resulted from the Additional Images database additions and create them. ');

define('TEXT_AI_DATABASE_NEEDS_UPDATES', 'You database needs updated before this will operate correctly. Please run configuration utility.');
define('TEXT_AI_DATABASE_UPDATE_WARNING', 'Please, please <a href="backup.php"><u>backup your database</u></a> before performing this operation.');

define('TEXT_AI_LIST_ALL', 'All Product Images');
define('TEXT_AI_LIST_UNPROCESSED', 'Unprocessed Product Images');
define('TEXT_AI_LIST', 'list');
define('TEXT_AI_SHOW_IMAGES', 'showing images');
define('TEXT_AI_MANUFACTURER', '- manufacturer -');
define('TEXT_AI_CATEGORY', '- category -');
define('TEXT_AI_FILTER_BY', 'filter by:');
define('TEXT_AI_AND_FILTER_BY', 'and/or filter by:');

define('TEXT_AI_PRODUCTS', 'items at a time');
define('TEXT_AI_CONFIGURE', 'Database Configuration Utility');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_PRODUCTS', 'Product Name');
define('TABLE_HEADING_MANUFACTURER', 'Manufacturer');
define('TABLE_HEADING_PROCESS', '');

define('TEXT_NO_PRODUCTS', 'There are no products to list in this category.');

define('TEXT_DISPLAY_NUMBER_OF_ITEMS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> images)');
define('TEXT_RESULT_PAGE', 'Result Pages:');

?>
