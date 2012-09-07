<?php //$Id: /catalog/admin/includes/languages/dutch/products_attributes.php

define('HEADING_TITLE_OPT', 'Artikel optie\'s');
define('HEADING_TITLE_VAL', 'Optie waarde');
define('HEADING_TITLE_ATRIB', 'Artikel optie\'s');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', 'Artikel naam');
define('TABLE_HEADING_OPT_NAME', 'Optie naam');
define('TABLE_HEADING_OPT_VALUE', 'Optie waarde');
define('TABLE_HEADING_OPT_PRICE', 'Prijs');
define('TABLE_HEADING_OPT_PRICE_PREFIX', 'Prefix');
define('TABLE_HEADING_OPT_SORT_ORDER', 'Volgorde');
define('TABLE_HEADING_ACTION', 'Actie');
define('TABLE_HEADING_DOWNLOAD', 'Downloadbare Artikelen:');
define('TABLE_TEXT_FILENAME', 'Filenaam:');
define('TABLE_TEXT_MAX_DAYS', 'Vervaldagen:');
define('TABLE_TEXT_MAX_COUNT', 'Maximaal aantal downloads:');
define('TABLE_TEXT_FROM', 'kopieer van product: ');
define('TABLE_TEXT_TO', 'naar: ');
define('HEADING_TITLE_CLONE', 'Kopieer Product Opties');

define('HEADING_TITLE_FILEGROUP', 'Bestands Groepen');
define('HEADING_TITLE_FILEGROUP_FILES', 'Bestanden in Groepen');
define('HEADING_TITLE_MASSIVE_FILES', 'Voeg meerdere bestanden aan Groep toe');
define('HEADING_TITLE_DELETE_FILE', 'Verwijder Bestand');
define('TABLE_HEADING_FILEGROUP_NAME', 'Bestandsgroep Naam');
define('TABLE_HEADING_GROUPFILE_DESCRIPTION', 'Bestand Beschrijving');
define('TABLE_HEADING_GROUPFILE_NAME', 'Bestand Naam');
define('TABLE_TEXT_FILEGROUP', 'Bestand Groep:');
define('TEXT_OPTION_FILEGROUP', 'Groep Naam');
define('TEXT_TEMP_DESC', 'Download Bestand');
define('TEXT_SELECT_INPUT', 'Selecteer uit Lijst of vul Bestandsnaam in');
define('TEXT_MASSIVE_INPUT', 'Meerdere bestanden toevoegen aan deze Groep');
define('TEXT_CREATE_GROUP_FIRST', 'Maak eerst een Bestandsgroep aan.');
define('TEXT_DELETE_FROM_GROUP', 'Verwijder dit Bestand van Groep:');
define('TEXT_DELETE_FROM_ALL_GROUPS', 'Verwijder dit bestand van <b>Alle Groepen!</b><br><span class="smallText">Met het verwijderen van alle groepen worden ook alle beschrijvingen van de bestanden verwijderd.</span>');
define('TEXT_FILE_IN_OTHER_GROUPS', 'Dit bestand is ook in deze Groep(en) aanwezig:');
define('TEXT_FILE_IN_GROUP', 'bestanden nog in deze Groep.<br><span class="smallText">Als de bestanden niet in een andere groep aanwezig zijn. Het verwijderen van deze groep verwijdert ook de beschrijvingen van de bestanden.</span>');
define('TEXT_DELETE_NO_OTHER_GROUP', 'dit bestand is niet in een andere Groep aanwezig.<br><span class="smallText">Met het verwijderen van dit bestand word ook de beschrijving verwijdert.</span>');
define('TEXT_UP_ONE_LEVEL', 'Niveau naar Boven');
define('TEXT_NO_FILE_IN_FOLDER', 'Geen bestand gevonden in deze map.');
define('ERROR_NO_FILENAME', 'Er is geen bestandsnaam toegewezen.');
define('ERROR_FILE_DOES_NOT_EXIST', 'Het bestand %s bestaat niet.');

define('TEXT_WARNING_OF_DELETE', 'Deze optie heeft artikelen en waarden aan zich gelinkt - het is niet veilig om dit te verwijderen.');
define('TEXT_OK_TO_DELETE', 'Deze optie heeft geen artikelen en waarden aan zich gelinkt - het is veilig dit te verwijderen.');
define('TEXT_OPTION_ID', 'Optie ID');
define('TEXT_OPTION_NAME', 'Optie Naam');
define('TABLE_HEADING_TRACK_STOCK', 'Voorraad Bijhouden?');

define('TABLE_HEADING_HIDDEN', 'Verborgen');
define('TEXT_HIDDEN_FROM_GROUPS', 'Verborgen van groepen: ');
define('TEXT_GROUPS_NONE', 'geen');
// 0: Icons for all groups for which the category or product is hidden, mouse-over the icons to see what group
// 1: Only one icon and only if the category or product is hidden for a group, mouse-over the icon to what groups
define('LAYOUT_HIDE_FROM', '0'); 
define('NAME_WINDOW_ATTRIBUTES_GROUPS_POPUP', 'OptieGroepPrijzen');
define('TEXT_GROUP_PRICES', 'Groep Prijzen');
define('TEXT_MOUSE_OVER_GROUP_PRICES', 'Bewerk klanten groep prijzen voor deze optie in een pop-up window.');
?>