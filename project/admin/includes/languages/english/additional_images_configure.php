<?php //$Id: /catalog/admin/includes/languages/english/additional_images_configure.php

define('HEADING_TITLE', 'Additional Images Configuration Utility');

define('TEXT_SELECT_TASK', 'Select task');

define('TEXT_NORMAL_SETUP', 'Normal Update');
define('TEXT_FORCE_REFRESH', 'Force Configuration Defaults');
define('TEXT_UNINSTALL', 'Remove All');
define('TEXT_UNINSTALL_CONFIRMATION', 'This will remove all configuration and data items. Are you sure you wish to do this?');
define('TEXT_UNINSTALL_CONFIRMATION2', 'Are you ABSOLUTELY SURE you wish to remove all data related to this contribution installation ???');

define('TEXT_CONFIG_PROCESS_DESCRIPTION', 'Choose the setup option and click Run Configuration Utility to setup your database.');
define('TEXT_CONFIG_PROCESS', 'Run Configuration Utility');

define('TEXT_DATABASE_REQUIRES_UPDATE', 'Your database requires updates.');
define('TEXT_DATABASE_REQUIRES_UPDATE_WARNING', 'Please, please <a href="backup.php"><u>backup your database</u></a> before performing this operation.');
define('TEXT_DATABASE_IS_UP_TO_DATE', 'Your database is up to date.');

define('TEXT_REMOVING_CONFIGURATION', 'Removing Configuration');
define('TEXT_CHECKING_FOR_COLUMNS_REMOVE', 'Checking for Columns to remove...');
define('TEXT_COLUMN_FOUND_REMOVING', 'Column "%s" found in Table "%s". Removing column...');
define('TEXT_SUCCESS_REMOVING_COLUMN', 'Successfully removed Column "%s" in Table "%s".');
define('TEXT_ERROR_REMOVING_COLUMN', 'Error returned when removing Column "%s" in Table "%s".');
define('TEXT_COLUMN_NOT_FOUND_DOING_NOTHING', 'Column "%s" not found in Table "%s", doing nothing.');
define('TEXT_TABLE_FOUND_NOT_PROCESSING', 'Table "%s" was not found, not processing columns.');

define('TEXT_CHECKING_TABLES', 'Checking for Tables to remove...');
define('TEXT_TABLE_FOUND_REMOVING', 'Table "%s" found. Removing...');
define('TEXT_SUCCESS_REMOVE_TABLE', 'Successfully removed table "%s".');
define('TEXT_ERROR_REMOVING_TABLE', 'Error returned when removing table "%s".');
define('TEXT_TABLE_NOT_FOUND_DOING_NOTHING', 'Table "%s" was not found, doing nothing.');

define('TEXT_CHECKING_CONFIGURATION', 'Checking for Configuration table entries to remove...');
define('TEXT_REMOVING_CONFIGURATION_GROUP', 'Removing Configuration Group "%s" keys...');
define('TEXT_REMOVING_CONFIGURATION_KEY', 'Removing Configuration Key "%s".');
define('TEXT_ERROR_CONFIGURATION_KEY_NOT_EXIST', 'Configuration Key "%s" does not exist, doing nothing.');

define('TEXT_SUCCESS_REMOVE_GROUP', 'Successfully removed Configuration Group "%s".');
define('TEXT_ERROR_REMOVING_GROUP', 'Error returned when removing Configuration Group "%s".');
define('TEXT_GROUP_NOT_EMPTY', 'Configuration Group "%s" is not empty, skipping remove.');

define('TEXT_UPDATING_CONFIGURATION', 'Updating Configuration');
define('TEXT_UPDATING_CONFIGURATION_GROUP', 'Updating Configuration Group "%s".');
define('TEXT_ADDING_CONFIGURATION_GROUP', 'Adding Configuration Group "%s".');
define('TEXT_UPDATING_CONFIGURATION_KEY', 'Updating Configuration Key "%s".');
define('TEXT_ADDING_CONFIGURATION_KEY', 'Adding Configuration Key "%s".');

define('TEXT_TABLE_FOUND_DOING_NOTHING', 'Table "%s" found, doing nothing.');
define('TEXT_TABLE_NOT_FOUND_CREATING', 'Table "%s" was not found. Creating...');
define('TEXT_SUCCESS_CREATING_TABLE', 'Successfully created table "%s".');
define('TEXT_ERROR_CREATING_TABLE', 'Error returned when creating table "%s".');

define('TEXT_COLUMN_FOUND_DOING_NOTHING', 'Column "%s" found in Table "%s", doing nothing.');
define('TEXT_COLUMN_NOT_FOUND_CREATING', 'Column "%s" not found in Table "%s". Adding column...');
define('TEXT_SUCCESS_CREATING_COLUMN', 'Successfully created Column "%s" in Table "%s".');
define('TEXT_ERROR_CREATING_COLUMN', 'Error returned when creating Column "%s" in Table "%s".');

define('TEXT_CHECKING_CONFIGURATION_STATUS', 'Checking Configuration Status');
define('TEXT_CHECKING_FOR_ITEMS', 'Checking for items...');
define('TEXT_CONFIG_GROUP_EXIST', 'Configuration Group "%s" exists.');
define('TEXT_CONFIG_KEY_EXIST', 'Configuration Key "%s" exists.');
define('TEXT_CONFIG_KEY_NOT_EXIST', 'Configuration Key "%s" does not exist.');
define('TEXT_CONFIG_GROUP_NOT_EXIST', 'Configuration Group "%s" does not exist.');

define('TEXT_CHECKING_FOR_TABLES', 'Checking for Tables...');
define('TEXT_TABLE_FOUND', 'Table "%s" found.');
define('TEXT_TABLE_NOT_FOUND', 'Table "%s" was not found.');
define('TEXT_NO_TABLES', 'No Tables to check for.');

define('TEXT_CHECKING_FOR_COLUMNS', 'Checking for Columns...');
define('TEXT_COLUMN_FOUND', 'Column "%s" found in Table "%s".');
define('TEXT_COLUMN_NOT_FOUND', 'Column "%s" not found in Table "%s".');
define('TEXT_TABLE_NOT_FOUND_FOR_COLUMN', 'Table "%s" was not found, column check not performed.');
define('TEXT_NO_COLUMNS', 'No Columns to check for.');

define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_BACK', 'Back');

?>
