<?php
//$Id: /catalog/includes/languages/dutch/osshoppy_update.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'osShoppy Updates');
define('HEADING_TITLE', 'osShoppy Updates');

define('HEADING_CURRENT_UPDATE', 'Huidige Versie en laatste Update');
define('HEADING_CURRENT_CONTRIBUTE', 'Huidige Add-on Installatie');
define('HEADING_PLANNED_CONTRIBUTE', 'Geplande Add-on Installaties');
define('HEADING_INSTALLED_CONTRIBUTE', 'Ge&iuml;nstalleerde Add-ons');
define('HEADING_STATUS_CONTRIBUTE', 'Status Add-ons');
define('HEADING_THANKS', 'Een Dank aan...');

define('TEXT_CURRENT_UPDATE', '
<br>
<center><b>Geen nieuwe updates!</b><br><br>
Huidige versie: <b> '.PROJECT_VERSION.'<br></b>
Volgende versie: <b> '.NEXT_PROJECT_VERSION.'<br></b>
Geplande datum volgende versie: <b> December 2012<br><br></b>
Check hieronder de huidige add-on installatie!</center>
<br>
<br>Kijk op de <a href="http://'.STORE_URL.'/osshoppy_planned.php" target="_self"><u>osShoppy planning</u></a> om te zien wat de toekomst plannen zijn voor osShoppy.<br>
<br>Kijk op de <a href="http://'.STORE_URL.'/osshoppy_to_do_list.php" target="_self"><u>osShoppy te doen lijst</u></a> voor wat er nog aan de huidige versie moet worden aangepast.<br>
');

define('TEXT_STATUS_CONTRIBUTE', '<b><u><center>Zeven Status Levels</center></u></b><br>
	   Status:<b><font color="grey"> &nbsp;&nbsp;PLANNED</font></b>
	   <br>Status:<b><font color="red"> &nbsp;&nbsp;CHECK FILES</font></b>
	   <br>Status:<b><font color="blue"> &nbsp;&nbsp;INTEGRATE CODE</font></b>
	   <br>Status:<b><font color="purple"> &nbsp;&nbsp;NEW INSTALL</font></b>
	   <br>Status:<b><font color="orange"> &nbsp;&nbsp;TESTING</font></b>
	   <br>Status:<b><font color="green"> &nbsp;&nbsp;COMPLETED</font></b>
	   <br>Status:<b><font color="brown"> &nbsp;&nbsp;UPDATING</font></b>
	   ');
	   
// CURRENT CONTRIBUTES
define('TEXT_CURRENT_CONTRIBUTE', '
<br>
<center><b>Geen nieuwe installaties!</b><br><br>
Alle bestanden worden opgeschoond.<br>Check hieronder de geplande installaties!<br /></center>
<br><br>
<br>Kijk op de <a href="http://'.STORE_URL.'/osshoppy_news.php" target="_self"><u>nieuwspagina</u></a> voor het laatste osShoppy nieuws!<br></li>');

// PLANNED CONTRIBUTES
define('TEXT_PLANNED_CONTRIBUTE', '
<li><b>Add-on: </b>Support Tickets** <a href="http://addons.oscommerce.com/info/1230" target="_blank"><u>(1230)</u></a>
<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>Versie: </b>
<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>Info: </b>Klanten Support Tickets aanmaken.
<br>&nbsp;&nbsp;&nbsp;&nbsp;<b>Status:<font color="grey"> PLANNED</font></b> <small>(januari 2012)</small>
<br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://forums.oscommerce.com/" target="_blank"><u>Ga naar Support Forum</u></a>
<br></li>');

// INSTALLED CONTRIBUTES
define('TEXT_INSTALLED_CONTRIBUTE', '<br><br><center>Klik op meer voor het complete overzicht van ge&iuml;nstalleerde add-ons.</center><br><br>');

// THANKYOU TEXT
define('TEXT_THANKS', '
');
?>