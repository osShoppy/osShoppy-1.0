<?php //$Id: /catalog/admin/includes/languages/dutch/general_information.php

define('HEADING_TITLE_AUTHOR', 'by Jack_mcs from <a href="http://www.oscommerce-solution.com/" target="_blank"><span style="font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px;">oscommerce-solution.com</span></a>');
define('HEADING_TITLE_SUPPORT_THREAD', '<a href="http://forums.oscommerce.com/topic/68866-article-manager-v1-0/" target="_blank"><span style="color: sienna;">(visit the support thread)</span></a>');
define('TEXT_MISSING_VERSION_CHECKER', 'Version Checker is not installed. See <a href="http://addons.oscommerce.com/info/7148" target="_blank">here</a> for details.');

define('HEADING_TITLE', 'Categorie&euml;n&nbsp;/&nbsp;Artikels');
define('HEADING_TITLE_SEARCH', 'Zoeken:');
define('HEADING_TITLE_GOTO', 'Ga Naar:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_TOPICS_ARTICLES', 'Info Categorie&euml;n / Info Artikels');
define('TABLE_HEADING_ACTION', 'Actie');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_ARTICLES_CURRENT', 'Huidige:');

define('TEXT_NEW_ARTICLE', 'Nieuw Artikel in &quot;%s&quot;');
define('TEXT_TOPICS', 'Categorie&euml;n:');
define('TEXT_SUBTOPICS', 'Sub Categorie&euml;n:');
define('TEXT_ARTICLES', 'Artikel:');
define('TEXT_ARTICLES_AVERAGE_RATING', 'Gemiddelde Waardering:');
define('TEXT_ARTICLES_HEAD_TITLE_TAG', 'HTML Page Title:');
define('TEXT_ARTICLES_HEAD_DESC_TAG', 'Meta Beschrijving:<br><small>(Article Abstract =<br>first %s charachters)</small>');
define('TEXT_ARTICLES_HEAD_KEYWORDS_TAG', 'Meta Sletelwoorden:');
define('TEXT_ARTICLES_IMAGE', 'Plaatje');
define('TEXT_DATE_ADDED', 'Datum Toegevoegd:');
define('TEXT_DATE_AVAILABLE', 'Datum Verwacht:');
define('TEXT_LAST_MODIFIED', 'Laatst Aangepast:');
define('TEXT_NO_CHILD_TOPICS_OR_ARTICLES', 'Voeg in dit level een nieuw artikel of categorie in.');
define('TEXT_ARTICLE_MORE_INFORMATION', 'Voor meer informatie bezoek de<a href="http://%s" target="blank"><u>website</u></a> van dit artikel.');
define('TEXT_ARTICLE_DATE_ADDED', 'Dit artikel is op %s toegevoegd op '.STORE_NAME.'.');
define('TEXT_ARTICLE_DATE_AVAILABLE', 'Dit Artikel word verwacht op %s.');

define('TEXT_EDIT_INTRO', 'Maak de mogelijke veranderingen');
define('TEXT_EDIT_TOPICS_ID', 'Categorie ID:');
define('TEXT_EDIT_TOPICS_NAME', 'Categorie Naam:');
define('TEXT_EDIT_SORT_ORDER', 'Sorteer Volgorde:');

define('TEXT_INFO_COPY_TO_INTRO', 'Kies een nieuwe categorie om dit artikel naar te kopi&euml;ren.');
define('TEXT_INFO_CURRENT_TOPICS', 'Huidige Categorie&euml;n:');

define('TEXT_INFO_HEADING_NEW_TOPIC', 'Nieuwe Categorie');
define('TEXT_INFO_HEADING_EDIT_TOPIC', 'Bewerk Categorie');
define('TEXT_INFO_HEADING_DELETE_TOPIC', 'Verwijder Categorie');
define('TEXT_INFO_HEADING_MOVE_TOPIC', 'Verplaats Categorie');
define('TEXT_INFO_HEADING_DELETE_ARTICLE', 'Verwijder Artikel');
define('TEXT_INFO_HEADING_MOVE_ARTICLE', 'Verplaats Artikel');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieer naar');

define('TEXT_DELETE_TOPIC_INTRO', 'Weet je zeker dat je deze categorie wil verwijderen?');
define('TEXT_DELETE_ARTICLE_INTRO', 'weet je zeker dat je dit artikel definitief wil verwijderen?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>LET OP:</b> Er zijn nog %s sub-categorie&euml;n gelinkt aan deze categorie!');
define('TEXT_DELETE_WARNING_ARTICLES', '<b>LET OP:</b> Er zijn nog %s artikels gelinkt aan deze categorie!');

define('TEXT_MOVE_ARTICLES_INTRO', 'Selecteer naar welke categorie het artikel <b>%s</b> verplaatst moet worden.');
define('TEXT_MOVE_TOPICS_INTRO', 'Selecteer naar welke categorie de categorie <b>%s</b> verplaatst moet worden.');
define('TEXT_MOVE', 'Verplaats <b>%s</b> naar:');

define('TEXT_NEW_TOPIC_INTRO', 'Vul de volgende informatie in voor de nieuwe categorie.');
define('TEXT_TOPICS_NAME', 'Categorie Naam:');
define('TEXT_SORT_ORDER', 'Sorteer Volgorde:');

define('TEXT_EDIT_TOPICS_HEADING_TITLE', 'Categorie Hoofd Titel:');
define('TEXT_EDIT_TOPICS_DESCRIPTION', 'Categorie Beschrijving:');

define('TEXT_ARTICLES_STATUS', 'Artikel Status:');
define('TEXT_ARTICLES_DATE_AVAILABLE', 'Datum Verwacht:');
define('TEXT_ARTICLE_AVAILABLE', 'Gepubliceerd');
define('TEXT_ARTICLE_NOT_AVAILABLE', 'Geen Publicatie');
define('TEXT_ARTICLES_AUTHOR', 'Auteur:');
define('TEXT_ARTICLES_NAME', 'Artikel Naam:');
define('TEXT_ARTICLES_DESCRIPTION', 'Artikel Inhoud:');
define('TEXT_ARTICLES_URL', 'Artikel URL:');
define('TEXT_ARTICLES_URL_WITHOUT_HTTP', '<small>(zonder http://)</small>');

define('EMPTY_TOPIC', 'Leeg Categorie');

define('TEXT_HOW_TO_COPY', 'Kopieer Methode:');
define('TEXT_COPY_AS_LINK', 'Link Artikel');
define('TEXT_COPY_AS_DUPLICATE', 'Kopieer Artikel');

define('ERROR_CANNOT_LINK_TO_SAME_TOPIC', 'FOUT: Kan geen Link maken in dezelfde Categorie.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'FOUT: Catalog images directory is niet schrijfbaar: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'FOUT: Catalog images directory bestaat niet: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_TOPIC_TO_PARENT', 'FOUT: Categorie kan niet verplaatst worden naar sub topic.');
?>