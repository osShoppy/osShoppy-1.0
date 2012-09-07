<?php //$Id: /catalog/admin/includes/languages/english/banner_manager.php

define('HEADING_TITLE', 'Banner Manager');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Groups');
define('TABLE_HEADING_STATISTICS', 'Displays / Clicks');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_BANNERS_TITLE', 'Banner Title:');
define('TEXT_BANNERS_URL', 'Banner URL:');
define('TEXT_BANNERS_GROUP', 'Banner Group:');
define('TEXT_BANNERS_NEW_GROUP', ', or enter a new banner group below');
define('TEXT_BANNERS_IMAGE', 'Image:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', or enter local file below');
define('TEXT_BANNERS_IMAGE_TARGET', 'Image Target (Save To):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Expires On:');
define('TEXT_BANNERS_OR_AT', ', or at');
define('TEXT_BANNERS_IMPRESSIONS', 'impressions/views.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Scheduled At:');
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
define('TEXT_BANNERS_BANNER_NOTE', '<b>Banner Notes:</b><ul><li>Use an image or HTML text for the banner - not both.</li><li>HTML Text has priority over an image</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Image Notes:</b><ul><li>Uploading directories must have proper user (write) permissions setup!</li><li>Do not fill out the \'Save To\' field if you are not uploading an image to the webserver (ie, you are using a local (serverside) image).</li><li>The \'Save To\' field must be an existing directory with an ending slash (eg, banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Expiry Notes:</b><ul><li>Only one of the two fields should be submitted</li><li>If the banner is not to expire automatically, then leave these fields blank</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Schedule Notes:</b><ul><li>If a schedule is set, the banner will be activated on that date.</li><li>All scheduled banners are marked as deactive until their date has arrived, to which they will then be marked active.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Date Added:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Scheduled At: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expires At: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expires At: <b>%s</b> impressions');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status Change: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Last 3 Days');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner Views');
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner Clicks');

define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Delete banner image');

define('SUCCESS_BANNER_INSERTED', 'Success: The banner has been inserted.');
define('SUCCESS_BANNER_UPDATED', 'Success: The banner has been updated.');
define('SUCCESS_BANNER_REMOVED', 'Success: The banner has been removed.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Success: The status of the banner has been updated.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: Banner title required.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: Banner group required.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Target directory does not exist: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Target directory is not writeable: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: Image does not exist.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: Image can not be removed.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: Unknown status flag.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: Graphs directory does not exist. Please create a \'graphs\' directory inside \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: Graphs directory is not writeable.');

define('TEXT_BANNER_MANAGER_INDEX','Select Index Page:');
define('TEXT_BANNER_MANAGER','Add to Categories:');
define('TEXT_BANNER_HOMEPAGE', 'Select Index Page');
define('TEXT_BANNERS_SELECT_ALL', 'Select All');
define('TEXT_BANNERS_UNSELECT_ALL', 'Deselect All');
?>