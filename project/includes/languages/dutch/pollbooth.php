<?php
//$Id: /catalog/includes/languages/dutch/pollbooth.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

if (!isset($HTTP_GET_VARS['op'])) {
	$HTTP_GET_VARS['op']="list";
	}
if ($HTTP_GET_VARS['op']=='results') {
  define('TOP_BAR_TITLE', 'Enquete');
  define('HEADING_TITLE', 'Enquete Resultaten');
  define('SUB_BAR_TITLE', 'Enquete Resultaten');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Enquete');
  define('HEADING_TITLE', 'Enquete Overzicht');
  define('SUB_BAR_TITLE', 'Vorige Enquetes');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Enquete');
  define('HEADING_TITLE', 'Bedankt voor uw Stem');
  define('SUB_BAR_TITLE', 'Geef uw stem in deze Enquete');
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'Reageer op deze Enquete');
}
define('_WARNING', 'Let op : ');
define('_ALREADY_VOTED', 'Sorry, u heeft al een stem uitgebracht in deze enquete.');
define('_NO_VOTE_SELECTED', 'Selecteer waar u voor wilt stemmen.');
define('_TOTALVOTES', 'Totaal aantal Stemmen');
define('_OTHERPOLLS', 'Ander Enquetes');
define('NAVBAR_TITLE_1', 'Enquetes');
define('NAVBAR_TITLE_POLLBOOTH', 'Enquete');
define('_POLLRESULTS', 'Enquete Resultaten');
define('_VOTING', 'Stem Nu');
define('_RESULTS', 'Bekijk Resultaten');
define('_VOTES', 'Stem');
define('_VOTE', 'Stem');
define('_COMMENT', 'Reactie');
define('_COMMENTS', 'Reacties');
define('_COMMENTS_POSTED', 'Reacties geplaatst');
define('_COMMENTS_BY', 'Reactie van ');
define('_COMMENTS_ON', ' op ');
define('_YOURNAME', 'Jouw Naam:');
define('_YOURCOMMENT', 'Jouw Reactie:');
define('_PUBLIC','Publiek');
define('_PRIVATE','Geregistreerd');
define('_POLLOPEN','Enquete Open');
define('_POLLCLOSED','Onze Excuses, deze Enquete is gesloten.');
define('_POLLPRIVATE','Geregistreerd Enquete, u moet inloggen om een stem uit te brengen.');
define('_ADD_COMMENTS', 'Plaats Reactie');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> reacties)');
?>
