<?php
//$Id: /catalog/includes/languages/english/general_information.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', 'New Info Articles in %s');

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', 'Info Articles');
  define('TABLE_HEADING_ARTICLES', 'Info Articles');
  define('TABLE_HEADING_AUTHOR', 'Author');
  define('TEXT_NO_ARTICLES', 'There are currently no Info articles in this topic.');
  define('TEXT_NO_ARTICLES2', 'There are currently no Info articles available from this author.');
  define('TEXT_NUMBER_OF_ARTICLES', 'Number of Info Articles: ');
  define('TEXT_SHOW', 'Display:');
  define('TEXT_NOW', '\' now');
  define('TEXT_ALL_TOPICS', 'All Info Topics');
  define('TEXT_ALL_AUTHORS', 'All Info Authors');
  define('TEXT_ARTICLES_BY', 'Info Articles by ');
  define('TEXT_ARTICLES', 'Below is a list of Info articles with the most recent ones listed first.');  
  define('TEXT_DATE_ADDED', 'Published:');
  define('TEXT_AUTHOR', 'Author:');
  define('TEXT_TOPIC', 'Info Topic:');
  define('TEXT_BY', 'by');
  define('TEXT_READ_MORE', 'Read More...');
  define('TEXT_MORE_INFORMATION', 'For more information, please visit this authors <a href="http://%s" target="_blank">web page</a>.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'All Info Articles');
  define('TEXT_ALL_ARTICLES', 'Below is a list of all Info articles with the most recent ones listed first.');
  define('TEXT_ARTICLES', 'Below is a list of all Info articles with the most recent ones listed first.');  
  define('TEXT_CURRENT_ARTICLES', 'Current Info Articles');
  define('TEXT_UPCOMING_ARTICLES', 'Upcoming Info Articles');
  define('TEXT_NO_ARTICLES', 'There are currently no Info articles listed.');
  define('TEXT_DATE_ADDED', 'Published:');
  define('TEXT_DATE_EXPECTED', 'Expected:');
  define('TEXT_AUTHOR', 'Author:');
  define('TEXT_TOPIC', 'Info Topic:');
  define('TEXT_BY', 'by');
  define('TEXT_READ_MORE', 'Read More...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Info Articles');
}
?>