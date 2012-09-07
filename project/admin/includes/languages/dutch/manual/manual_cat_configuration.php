<?php // $Id: /catalog/admin/includes/languages/dutch/manual/manual_cat_configuration.php

define('TEXT_TITLE', 'Configuratie Instellingen');

define('TEXT_MAIN_HEADER', '<center>Deze configuratie heeft u nodig voor de basis instellingen van uw webwinkel.<br>
	   						Na het volgen van deze 12 stappen kunt u verder met het toevoegen van producten!</center>');

define('TEXT_MAIN_CONTENT', '
	   						<li>Van de volgende bestanden moeten de rechten veranderd worden naar <b>644</b></li>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/includes/configure.php	<br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/admin/includes/configure.php <br><br>
							
							<li>Verwijder de volledige installatie map van de server</li> <br>
							
	   						<li>Van de volgende folders moeten de rechten veranderd worden naar <b>777</b></li>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/admin/backups/ <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/admin/images/graphs/ <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/ <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/uploads_article_manager <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/uploads_faq_manager <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/uploads_info_manager <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/uploads_links_manager <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/uploads_testimonial_manager <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/images/uploads_reference_manager <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/includes/modules/ultimate_seo_urls5/cache_system/cache/ <br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/includes/modules/ultimate_seo_urls5/cache_system/sqlite/ <br><br>
							
	   						<li>Van de volgende bestanden moeten de rechten veranderd worden naar <b>777</b></li>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-> catalog/includes/header_tags.php <br><br>
							
							<li>De volgende bestanden moeten nog geladen worden in de database</li>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DB_SETUP_FILEGROUP) . '"><u>Klik Hier</u></a> om db_setup_filegroup.php te laden voor de download sectie.<br>					
							<br><center><b>Verwijder deze bestanden van de server nadat ze geladen zijn!</b></center><br>
							
							<li>Om gebruik te kunnen maken van Online Support moeten er eerst nog wat instellingen gedaan worden.</li>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_MANUAL_HEADER_ONLINE_SUPPORT) . '"><u>Klik Hier</u></a> voor uitgebreide uitleg over het gebruik van Online Support</li>	<br><br>
							
							<li>Ultimate seo URL\'s word gebruikt om links om te zetten naar zoek machine vriendelijke URL\'s</li>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Om de functie "rewrite" te gebruiken moet de .htacces file aangepast worden.<br>					
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS_BASE_CONTROL_SEO_URL) . '"><u>Klik Hier</u></a> voor de informatie van het updaten van .htacces bestand. <br><br>
							<li></li>	<br><br>
							<li></li>	<br><br>
							<li></li>	<br><br>
							<li></li>	<br><br>
							<li></li>	<br><br>
							<center><b>Lees de rest van de handleiding ook goed door om een uitgebreid overzicht te krijgen
							van de vele mogelijkheden die het osShoppy webwinkel systeem te bieden heeft.</b></center>	<br><br>
							');

define('TEXT_RIGHT_CONTENT', 'Met CHMOD word bedoelt dat bestanden of mappen andere bestandsrechten horen te krijgen!');

define('TEXT_INFO_CONTENT', 'Ga verder naar de configuratie van de <a href="' . tep_href_link(FILENAME_MANUAL_CAT_ADMINISTRATORS) . '"><u>administratie</u></a>!
 							 <br>Ga terug naar de <a href="' . tep_href_link(FILENAME_MANUAL_INDEX) . '"><u>home</u></a> pagina!');

define('TEXT_NOTICE_CONTENT', 'Klik<a href="' . tep_href_link(FILENAME_MANUAL_UPDATE) . '">hier</a> voor informatie over het updaten van je osShoppy handleiding!<br><br>');

define('TEXT_RELATED_CONTENT', '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_TEMPLATE) . '">Template</a><br><br><br><br>');

?>
