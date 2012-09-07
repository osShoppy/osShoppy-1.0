<?php
//$Id: /catalog/includes/languages/dutch/articles.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', 'Nieuw Artikel in %s');


if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', 'Artikels');
  define('TABLE_HEADING_ARTICLES', 'Artikels');
  define('TABLE_HEADING_AUTHOR', 'Schrijver');
  define('TEXT_NO_ARTICLES', 'Er zijn op het moment geen artikels in deze categorie.');
  define('TEXT_NO_ARTICLES2', 'Er zijn op het moment geen artikels van deze schrijver');
  define('TEXT_NUMBER_OF_ARTICLES', 'Aantal Artikels: ');
  define('TEXT_SHOW', 'Toont:');
  define('TEXT_NOW', '\' nu');
  define('TEXT_ALL_TOPICS', 'Alle Categrie&euml;n');
  define('TEXT_ALL_AUTHORS', 'Alle Schrijvers');
  define('TEXT_ARTICLES_BY', ' door ');
  define('TEXT_ARTICLES', 'Hieronder is een lijst artikels met de messt recente bovenaan geplaatst.');  
  define('TEXT_DATE_ADDED', 'Geplaatst op:');
  define('TEXT_AUTHOR', 'Schrijver:');
  define('TEXT_TOPIC', 'Categorie:');
  define('TEXT_BY', 'door');
  define('TEXT_READ_MORE', 'Lees Meer...');
  define('TEXT_MORE_INFORMATION', 'Voor meer informatie bezoek de <a href="http://%s" target="_blank">website</a> van de schrijver.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'Alle Artikels');
  define('TEXT_ALL_ARTICLES', 'Hieronder is een lijst artikels met de meest recente bovenaan geplaatst.');
  define('TEXT_ARTICLES', 'Hieronder is een lijst artikels met de messt recente bovenaan geplaatst.');  
  define('TEXT_CURRENT_ARTICLES', 'Huidige Artikels');
  define('TEXT_UPCOMING_ARTICLES', 'Verwachte Artikels');
  define('TEXT_NO_ARTICLES', 'Er zijn op het moment geen artikels.');
  define('TEXT_DATE_ADDED', 'Geplaatst op:');
  define('TEXT_DATE_EXPECTED', 'Verwacht:');
  define('TEXT_AUTHOR', 'Schrijver:');
  define('TEXT_TOPIC', 'Categorie:');
  define('TEXT_BY', 'door');
  define('TEXT_READ_MORE', 'Lees Meer...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Artikels');
}

?>
