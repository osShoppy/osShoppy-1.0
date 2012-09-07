<?php
//$Id: /catalog/includes/languages/english/faq_articles.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', 'New FAQ Articles in %s');

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', 'FAQ Articles');
  define('TABLE_HEADING_ARTICLES', 'FAQ Articles');
  define('TABLE_HEADING_AUTHOR', 'Author');
  define('TEXT_NO_ARTICLES', 'There are currently no FAQ articles in this topic.');
  define('TEXT_NO_ARTICLES2', 'There are currently no FAQ articles available from this author.');
  define('TEXT_NUMBER_OF_ARTICLES', 'Number of FAQ Articles: ');
  define('TEXT_SHOW', 'Display:');
  define('TEXT_NOW', '\' now');
  define('TEXT_ALL_TOPICS', 'All FAQ Topics');
  define('TEXT_ALL_AUTHORS', 'All Authors');
  define('TEXT_ARTICLES_BY', 'FAQ Articles by ');
  define('TEXT_ARTICLES', 'Below is a list of FAQ articles with the most recent ones listed first.');  
  define('TEXT_DATE_ADDED', 'Published:');
  define('TEXT_AUTHOR', 'Author:');
  define('TEXT_TOPIC', 'FAQ Topic:');
  define('TEXT_BY', 'by');
  define('TEXT_READ_MORE', 'Read More...');
  define('TEXT_MORE_INFORMATION', 'For more information, please visit this authors <a href="http://%s" target="_blank">web page</a>.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'All FAQ Articles');
  define('TEXT_ALL_ARTICLES', 'Below is a list of all FAQ articles with the most recent ones listed first.');
  define('TEXT_ARTICLES', 'Below is a list of all FAQ articles with the most recent ones listed first.');  
  define('TEXT_CURRENT_ARTICLES', 'Current FAQ Articles');
  define('TEXT_UPCOMING_ARTICLES', 'Upcoming FAQ Articles');
  define('TEXT_NO_ARTICLES', 'There are currently no FAQ articles listed.');
  define('TEXT_DATE_ADDED', 'Published:');
  define('TEXT_DATE_EXPECTED', 'Expected:');
  define('TEXT_AUTHOR', 'Author:');
  define('TEXT_TOPIC', 'FAQ Topic:');
  define('TEXT_BY', 'by');
  define('TEXT_READ_MORE', 'Read More...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'FAQ Articles');
}
?>