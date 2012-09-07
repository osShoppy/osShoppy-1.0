<?php //$Id: /catalog/admin/includes/languages/dutch/banner_manager.php

define('HEADING_TITLE', 'Banner Manager');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Groepen');
define('TABLE_HEADING_STATISTICS', 'Bekeken / Geklikt');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actie');

define('TEXT_BANNERS_TITLE', 'Titel van banner:');
define('TEXT_BANNERS_URL', 'Banner URL:');
define('TEXT_BANNERS_GROUP', 'Banner groep:');
define('TEXT_BANNERS_NEW_GROUP', ', of maak hieronder een nieuwe groep');
define('TEXT_BANNERS_IMAGE', 'Plaatje:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', of vul hieronder een lokaal bestand in');
define('TEXT_BANNERS_IMAGE_TARGET', 'Plaatje bestemming (Opslaan als):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Tekst:');
define('TEXT_BANNERS_EXPIRES_ON', 'Verloopt op:');
define('TEXT_BANNERS_OR_AT', ', of op');
define('TEXT_BANNERS_IMPRESSIONS', 'impressies/overzichten.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Gepland op:');
define('TEXT_BANNERS_BANNER_GROUPS', '
	   <b>N.B. Banner Groepen:</b>
	   <br>&nbsp;&nbsp;&nbsp;De volgende banner groepen zijn standaard aanwezig in osShoppy. 
	   <ul>
	   <li>De Main Groepen zijn op alle pagina\'s te zien wanneer "Index Pagina" is geselecteerd. Selecteer een "Categorie" om de banner alleen in de geselecteerde categorie te tonen.</li>
	   <li>De Index Groepen zijn alleen op de index pagina\'s te zien.</li>
	   	<ul>
		<li>Index Default: Selecteer "Index Pagina" om te tonen op de Index Pagina</li>
		<li>Index Categories List: Selecteer een "Categorie" om de banner in de geselecteerde categorie&euml;n te tonen.</li>
		<li>Index Products List: Selecteer een "Categorie" om de banner in de geselecteerde categorie&euml;n te tonen.</li>
	   </ul>
	   <li>De Pagina Groepen zijn alle overige pagina\'s. Selecteer "Index Pagina" om de banner op de pagina te tonen.<br>Er is een selectie gemaakt van ongeveer 35 pagina\'s. <br>Raadpleeg de osShoppy handleiding wanneer je op de overige pagina\'s ook banners wil toevoegen.</li>
	   </ul>
	   <br>&nbsp;&nbsp;&nbsp;<b>Gebruik de code om de banner in de juiste groep te plaatsen.<br><br></b>');
define('TEXT_BANNER_GROUPS', '
	   <ul><b>Main Groepen</b>
	   <li>Main Top Banner <b>(main_top)</b></li>
	   <li>Main Header Top Banner <b>(main_head_top)</b></li>
	   <li>Main Header Bottom Banner <b>(main_head_bot)</b></li>
	   <li>Main Left Banner <b>(main_left)</b></li>
	   <li>Main Main Right Banner <b>(main_right)</b></li>
	   <li>Main Footer Top Banner <b>(main_foot_top)</b></li>
	   <li>Main Footer Bottom Banner <b>(main_foot_bot)</b></li>
	   <li>Main Bottom Banner <b>(main_bot)</b></li>
	   </ul>
	   <ul><b>Index Groepen</b>
	   <li>Index Default Top Banner <b>(index_def_top)</b></li>
	   <li>Index Default Bottom Banner <b>(index_def_bot)</b></li>
	   <li>Index Categories Top Banner <b>(index_cat_top)</b></li>
	   <li>Index Categories Bottom Banner <b>(index_cat_bot)</b></li>
	   <li>Index Product List Top Banner <b>(index_prod_top)</b></li>
	   <li>Index Product List Bottom Banner <b>(index_prod_bot)</b></li>
	   </ul><br>
	   <ul><b>Pagina Groepen</b>
	   <li>Over Ons Top <b>(aboutus_top)</b></li>
	   <li>Over Ons Bottom <b>(aboutus_bot)</b></li>
	   <li>Verzenden Top <b>(shipping_top)</b></li>
	   <li>Verzenden Bottom <b>(shipping_bot)</b></li>
	   <li>Betalingen Top <b>(payment_top)</b></li>
	   <li>Betalingen Bottom <b>(payment_bot)</b></li>
	   <li>Privacy Top <b>(privacy_top)</b></li>
	   <li>Privacy Bottom <b>(privacy_bot)</b></li>
	   <li>Algemene Voorwaarden Top <b>(conditions_top)</b></li>
	   <li>Algemene Voorwaarden Bottom <b>(conditions_bot)</b></li>
	   <li>Neem Contact Op Top <b>(contactus_top)</b></li>
	   <li>Neem Contact Op Bottom <b>(contactus_bot)</b></li>
	   <li>Veel Gestelde Vragen Top <b>(faq_top)</b></li>
	   <li>Veel Gestelde Vragen Bottom<b>(faq_bot)</b></li>
	   <li>Product Artikels Top <b>(articles_top)</b></li>
	   <li>Product Artikels Bottom <b>(articels_bot)</b></li>
	   <li>Algemene Informatie Top <b>(ginfo_top)</b></li>
	   <li>Algemene Informatie Bottom <b>(ginfo_bot)</b></li>
	   <li>Testimonials Top <b>(testimonials_top)</b></li>
	   <li>Testimonials Bottom <b>(testimonials_bot)</b></li>
	   <li>Referenties Top <b>(reference_top)</b></li>
	   <li>Referenties Bottom <b>(reference_bot)</b></li>
	   <li>Enquetes Top <b>(enquetes_top)</b></li>
	   <li>Enquetes Bottom <b>(enquetes_bot)</b></li>
	   </ul>');
define('TEXT_BANNER_GROUPS_PAGE', '
	   <ul><b>Pagina Groepen</b>
	   <li>Links Top <b>(links_top)</b></li>
	   <li>Links Bottom <b>(links_bot)</b></li>
	   <li>Alle Producten Top <b>(allprods_top)</b></li>
	   <li>Alle Producten Bottom<b>(allprods_bot)</b></li>
	   <li>Documenten Top <b>(documents_top)</b></li>
	   <li>Documenten Bottom <b>(documents_bot)</b></li>
	   <li>Gratis Downloads Top <b>(freedown_top)</b></li>
	   <li>Gratis Downloads Bottom <b>(freedown_bot)</b></li>
	   <li>Citaten Top <b>(quotes_top)</b></li>
	   <li>Citaten Bottom <b>(quotes_bot)</b></li>
	   <li>Affiliate Summary Top <b>(afsummary_top)</b></li>
	   <li>Affiliate Summary Bottom <b>(afsummary_bot)</b></li>
	   <li>Affiliate Banners Top <b>(afbanners_top)</b></li>
	   <li>Affiliate Banners Bottom <b>(afbanners_bot)</b></li>
	   <li>Affiliate Reports Top <b>(afreports_top)</b></li>
	   <li>Affiliate Reports Bottom <b>(afreports_bot)</b></li>
	   <li>Account Notificaties Top <b>(acnotific_top)</b></li>
	   <li>Account Notificaties Bottom<b>(acnotific_bot)</b></li>
	   <li>Account Bestel Geschiedenis Top <b>(achistory_top)</b></li>
	   <li>Account Bestel Geschiedenis Bottom <b>(achistory_bot)</b></li>
	   <li>Wishlist Top <b>(wishlist_top)</b></li>
	   <li>Wishlist Bottom <b>(wishlist_bot)</b></li>
	   <li>Winkelwagen Top <b>(cart_top)</b></li>
	   <li>Winkelwagen Bottom <b>(cart_bot)</b></li>
	   <li>Afrekenen-verzending Top <b>(chshipping_top)</b></li>
	   <li>Afrekenen-verzending Bottom<b>(chshipping_bot)</b></li>
	   <li>Afrekenen-betaling Top <b>(chpayment_top)</b></li>
	   <li>Afrekenen-betaling Bottom<b>(chpayment_bot)</b></li>
	   <li>Afrekenen-bevestiging Top <b>(chconfirm_top)</b></li>
	   <li>Afrekenen-bevestiging Bottom<b>(chconfirm_bot)</b></li>
	   <li>Afrekenen-succes Top <b>(chsucces_top)</b></li>
	   <li>Afrekenen-succes Bottom<b>(chsucces_bot)</b></li>
	   <li>Onlangs Bekeken Top <b>(viewed_top)</b></li>
	   <li>Onlangs Bekeken Bottom <b>(viewed_bot)</b></li>
	   <li>Meest Verkocht Top <b>(bestsellers_top)</b></li>
	   <li>Meest Verkocht Bottom <b>(bestsellers_bot)</b></li>
	   <li>Aanbevolen Producten Top <b>(featured_top)</b></li>
	   <li>Aanbevolen Producten Bottom <b>(featured_bot)</b></li>
	   <li>Aanbiedingen Top <b>(specials_top)</b></li>
	   <li>Aanbiedingen Bottom <b>(specials_bot)</b></li>
	   <li>Nieuwe Producten Top <b>(newprods_top)</b></li>
	   <li>Nieuwe Producten Bottom <b>(newprods_bot)</b></li>
	   </ul>');
define('TEXT_BANNERS_BANNER_NOTE', '<b>N.B. Banners:</b><ul><li>Gebruik een plaatje of een HTML tekst voor de banner - niet beide.</li><li>HTML Tekst heeft de hoogste prioriteit</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>N.B. Plaatjes:</b><ul><li>De te uploaden directory\'s hebben de juiste permissie\'s nodig!</li><li>Vul het \'Opslaan Als\' veld niet in als je geen plaatje gaat uploaden naar de server (bijv. als je een serverside foto gebruikt).</li><li>Het \'Opslaan Als\' veld moet een bestaande directory zijn en eindigen op een (bijv. banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>N.B. Verloopdata:</b><ul><li>Slechts &eacute;&eacute;n van de 2 velden mag worden ingevuld</li><li>Laat de velden leeg als de banner niet automatisch mag vervallen</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>N.B. Planning:</b><ul><li>Als een datum is gepland zal de banner actief worden op die datum.</li><li>Die banners zijn allemaal aangeduid als niet actief, ze zullen automatisch op actief worden gezet op de geplande datum.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Toegevoegd op:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Gepland op: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Verloopt op: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Verloopt na: <b>%s</b> impressies');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status veranderd: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Laatste 3 dagen');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner overzichten');
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner kliks');

define('TEXT_INFO_DELETE_INTRO', 'Weet u zeker dat u de banner wil verwijderen');
define('TEXT_INFO_DELETE_IMAGE', 'Verwijder banner plaatje');

define('SUCCESS_BANNER_INSERTED', 'Success: De banner is ingevoegd.');
define('SUCCESS_BANNER_UPDATED', 'Success: De banner is geupdate.');
define('SUCCESS_BANNER_REMOVED', 'Success: De banner is verwijderd.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Success: De status van de banner is geupdate.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Fout: Banner titel vereist.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Fout: Banner groep vereist');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fout: Bestemmingsdirectory bestaat niet: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fout: Bestemmingsdirectory niet beschrijfbaar: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Fout: Plaatje bestaat niet.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Fout: Plaatje kan niet worden verwijderd.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Fout: Onbekende status.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Fout: Graphs directory bestaat niet, maak een \'graphs\' directory aan in \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Fout: Graphs directory is niet schrijfbaar.');

define('TEXT_BANNER_MANAGER_INDEX','Selecteer Index Pagina:');
define('TEXT_BANNER_MANAGER','Selecteer Categorie:');
define('TEXT_BANNER_HOMEPAGE', '');
define('TEXT_BANNERS_SELECT_ALL', 'Selecteer Alles');
define('TEXT_BANNERS_UNSELECT_ALL', 'Deselecteer Alles');
?>