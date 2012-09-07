<?php //$Id: /catalog/admin/includes/languages/english/products_attributes.php

define('HEADING_TITLE_OPT', 'Product Options');
define('HEADING_TITLE_VAL', 'Option Values');
define('HEADING_TITLE_ATRIB', 'Products Attributes');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Product Name');
define('TABLE_HEADING_OPT_NAME', 'Option Name');
define('TABLE_HEADING_OPT_VALUE', 'Option Value');
define('TABLE_HEADING_OPT_PRICE', 'Value Price');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefix');
define('TABLE_HEADING_OPT_SORT_ORDER', 'Sort Order');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_DOWNLOAD', 'Downloadable products:');
define('TABLE_TEXT_FILENAME', 'Filename:');
define('TABLE_TEXT_MAX_DAYS', 'Expiry days:');
define('TABLE_TEXT_MAX_COUNT', 'Maximum download count:');
define('TABLE_TEXT_FROM', 'From: ');
define('TABLE_TEXT_TO', 'To: ');
define('HEADING_TITLE_CLONE', 'Clone Product Attributes');

define('HEADING_TITLE_FILEGROUP', 'File Groups');
define('HEADING_TITLE_FILEGROUP_FILES', 'Files In Group');
define('HEADING_TITLE_MASSIVE_FILES', 'Add Multiple Files To Group');
define('HEADING_TITLE_DELETE_FILE', 'Delete File');
define('TABLE_HEADING_FILEGROUP_NAME', 'File Group Name');
define('TABLE_HEADING_GROUPFILE_DESCRIPTION', 'File Decription');
define('TABLE_HEADING_GROUPFILE_NAME', 'File Name');
define('TABLE_TEXT_FILEGROUP', 'File Group:');
define('TEXT_OPTION_FILEGROUP', 'Group Name');
define('TEXT_TEMP_DESC', 'Download File');
define('TEXT_SELECT_INPUT', 'Select from list or input filename');
define('TEXT_MASSIVE_INPUT', 'Add mutiple files to this group');
define('TEXT_CREATE_GROUP_FIRST', 'Please create file group first.');
define('TEXT_DELETE_FROM_GROUP', 'Delete this file from group:');
define('TEXT_DELETE_FROM_ALL_GROUPS', 'Delete this file from <b>All Groups!</b><br><span class="smallText">Delete from all groups will clean up file description as well.</span>');
define('TEXT_FILE_IN_OTHER_GROUPS', 'This file is also in these groups:');
define('TEXT_FILE_IN_GROUP', 'files still in this group.<br><span class="smallText">If the files are not in any other groups, deleting this group will also clean up the descriptions of the files.</span>');
define('TEXT_DELETE_NO_OTHER_GROUP', 'This file is not in any other group.<br><span class="smallText">Delete this file will also clean up file description as well.</span>');
define('TEXT_UP_ONE_LEVEL', 'Up one level');
define('TEXT_NO_FILE_IN_FOLDER', 'No file found in this folder.');
define('ERROR_NO_FILENAME', 'You didn\'t assign a filename.');
define('ERROR_FILE_DOES_NOT_EXIST', 'The file %s doesn\'t exist.');

define('TEXT_WARNING_OF_DELETE', 'This option has products and values linked to it - it is not safe to delete it.');
define('TEXT_OK_TO_DELETE', 'This option has no products and values linked to it - it is safe to delete it.');
define('TEXT_OPTION_ID', 'Option ID');
define('TEXT_OPTION_NAME', 'Option Name');
define('TABLE_HEADING_TRACK_STOCK', 'Track Stock?');

define('TABLE_HEADING_HIDDEN', 'Hidden');
define('TEXT_HIDDEN_FROM_GROUPS', 'Hidden from groups: ');
define('TEXT_GROUPS_NONE', 'none');
// 0: Icons for all groups for which the category or product is hidden, mouse-over the icons to see what group
// 1: Only one icon and only if the category or product is hidden for a group, mouse-over the icon to what groups
define('LAYOUT_HIDE_FROM', '0'); 
define('NAME_WINDOW_ATTRIBUTES_GROUPS_POPUP', 'AttributeGroupPrices');
define('TEXT_GROUP_PRICES', 'Group Prices');
define('TEXT_MOUSE_OVER_GROUP_PRICES', 'Edit customer group prices for this attribute in a pop-up window');
?>