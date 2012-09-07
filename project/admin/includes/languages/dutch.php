<?php //$Id: /catalog/admin/includes/languages/dutch.php (osC)

// Define the project version
  define('PROJECT_VERSION', 'Huidige Versie:<br>osShoppy&nbsp;v2.0&nbsp;Beta');
  define('PROJECT_VERSION_UPDATE', 'Update Beschikbaar:');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'nl_NL.ISO8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_TIME_FORMAT_LONG', DATE_FORMAT_LONG . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}
// return a dbase formatted date for ddmmyyyy format adjust if you use the mmddyyyy format
function tep_store_date ($date) {

   return substr($date, 6, 4) . '-' . substr($date, 3, 2) . '-' . substr($date, 0, 2) . ' ' . date('H:i:s');
  
  }

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'Administratie Paneel van ' . STORE_NAME . '');

// header text in includes/header.php
define('HEADER_TITLE_ADMINISTRATION', 'Administratie');
define('HEADER_TITLE_ACCOUNT', 'Mijn Account');
define('HEADER_TITLE_LOGOFF_ADMIN', 'Uitloggen');
define('TEXT_INFO_GROUP', '<b>Administratie groep: </b>');

//header icons in includes/header.php
define('HEADER_LIVE_SUPPORT', 'Online HelpDesk');
define('HEADER_FORUM', 'Forum');
define('HEADER_ORDER', 'Bestellingen');
define('HEADER_RETURN_ARTICLE', 'Retour Aanvragen');
define('HEADER_CUSTOMERS', 'Klanten');
define('HEADER_SEND_MAIL', 'Stuur e-mail');
define('HEADER_POINTS', 'Winkel Punten');
define('HEADER_ACCOUNT_SALDO', 'Account Saldo');
define('HEADER_MANUAL_INDEX', 'osShoppy Handleiding');
define('HEADER_TO_SHOP', 'Naar Webwinkel');

// text for gender
define('MALE', 'Man');
define('FEMALE', 'Vrouw');

// text yes no
define('TEXT_YES', 'Ja');
define('TEXT_NO', 'Nee');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// text for _banned.php
define('HEADING_TITLE_BANNED', 'Geef een Gast of Klant een IP ban');
define('TEXT_ADD_IP', 'Voeg IP adres toe: ');
define('TEXT_IP_ADDRESS', 'IP Adressen');
define('TEXT_REMOVE_IP', ' (vink aan en klik update om te verwijderen)');

//-1 administrators_top box text in includes/boxes/administrators_top.php
define('BOX_HEADING_ADMIN_TOP', 'Top Admin');
define('BOX_ADMIN_TOP_MEMBERS', 'Administratie Leden');
define('BOX_ADMIN_TOP_BOXES', 'Bestands Toegang');
define('BOX_ADMIN_TOP_NOTES', 'Admin Notities Top');
define('BOX_ADMIN_TOP_CONFIGURATION_CHANGES', 'Configuratie Checker');
define('BOX_ADMIN_TOP_CONTRIBUTION_TRACKER', 'Ge&iuml;nstallerde Add-On Checker');
//-1.1 admin config submenu box text in includes/boxes/administrators_top.php
define('BOX_ADMIN_TOP_HEADING_ADMIN_CONFIG', 'Admin Configuratie');
define('BOX_ADMIN_TOP_ADMIN_INDEX', 'Admin Index Aanpassen');
define('BOX_ADMIN_TOP_WYSIWYG_CONFIG', 'WYSIWYG Editor');
define('BOX_ADMIN_TOP_PRICE_BREAK', 'Staffelprijzen');
define('BOX_ADMIN_TOP_OTHER_CONFIG', 'Overige Instellingen');
//-1.2 admin base config submenu box text in includes/boxes/administrators_top.php
define('BOX_ADMIN_TOP_HEADING_BASE_CONFIG', 'Basis Configuratie');
define('BOX_ADMIN_TOP_MY_STORE', 'Mijn Winkel');
define('BOX_ADMIN_TOP_STORE_MODE', 'Winkel Status');
define('BOX_ADMIN_TOP_CONTACT_US', 'Contactformulier');
define('BOX_ADMIN_TOP_CUSTOMER', 'Registratie Formulier');
define('BOX_ADMIN_TOP_ANTI_ROBOT', 'Anti Robot Registratie');
define('BOX_ADMIN_TOP_MATC', 'Algemene Voorwaaden');
define('BOX_ADMIN_TOP_MIN_VALUES', 'Minimale Waarden');
define('BOX_ADMIN_TOP_MAX_VALUES', 'Maximale Waarden');
define('BOX_ADMIN_TOP_IMAGES', 'Plaatjes');
define('BOX_ADMIN_TOP_THUMBS', 'On the Fly Thumbs');
define('BOX_ADMIN_TOP_SEO_URLS', 'Zoek Machine Optimalisatie');
define('BOX_ADMIN_TOP_MODULES', 'Module Opties');
define('BOX_ADMIN_TOP_PACKAGING', 'Verzenden/Verpakken');
define('BOX_ADMIN_TOP_PRODUCT_LISTING', 'Product Lijst');
define('BOX_ADMIN_TOP_STOCK', 'Voorraad');
define('BOX_ADMIN_TOP_LOGGING', 'Logging');
define('BOX_ADMIN_TOP_CACHE', 'Cache');
define('BOX_ADMIN_TOP_EMAIL', 'E-mail Opties');
define('BOX_ADMIN_TOP_DOWNLOAD', 'Download');
define('BOX_ADMIN_TOP_GZIP', 'Gzip Compressie');
define('BOX_ADMIN_TOP_SESSIONS', 'Sessies');

//-2 administrators_mid box text in includes/boxes/administrators_mid.php
define('BOX_HEADING_ADMIN_MID', 'Mid Admin');
define('BOX_ADMIN_MID_NOTES', 'Admin Notities Mid');

//-3 administrators_low box text in includes/boxes/administrators_low.php
define('BOX_HEADING_ADMIN_LOW', 'Low Admin');
define('BOX_ADMIN_LOW_NOTES', 'Admin Notities Low');

//-4 categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalogus');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Artikelopties');
define('BOX_CATALOG_MANUFACTURERS', 'Fabrikanten');
define('BOX_CATALOG_REVIEWS', 'Recensies');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Verwachte producten');
//-4.1 stock submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_CATALOG', 'Catalogus');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categori&euml;n/Producten');
define('BOX_CATALOG_CATEGORIES_IMAGES_PRODUCTS', 'Product Afbeeldingen');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_CONFIG', 'Catalogus Configuratie');
//-4.2 stock submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_STOCK', 'Voorraad');
define('BOX_CATALOG_STOCK_PRODUCTS_ACTIVE', 'Voorraad Actief');
define('BOX_CATALOG_STOCK_PRODUCTS_INACTIVE', 'Voorraad Inactief');
define('BOX_CATALOG_STOCK_LOW_STOCK', 'Voorraad Overzicht Laag');
define('BOX_CATALOG_STOCK_STATS_LOW_STOCK_ATTRIB', 'Voorraad Opties');
define('BOX_CATALOG_STOCK_QTPRO_DOCTOR', 'Voorraad Opties Database Fout');
define('BOX_CATALOG_STOCK_PRODUCTS_EXCEL', 'Voorraad Excell');
define('BOX_CATALOG_STOCK_PRODUCTS_UPDATE', 'Voorraad Prijs Aanpassen');
define('BOX_CATALOG_STOCK_PRODUCTS_MULTI', 'Voorraad Aanpassen');
//-4.3 modules submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES', 'Modules');
define('BOX_CATALOG_MODULES_GET_1_FREE', 'Krijg 1 gratis');
define('BOX_CATALOG_MODULES_SPECIALS', 'Aanbiedingen');
define('BOX_CATALOG_MODULES_FEATURED_PRODUCTS', 'Aanbevolen Producten');
//-4.4 discount categories submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_DISCOUNT_CATEGORIES', 'Kortings Groepen');
define('BOX_CATALOG_MODULES_CREATE_DISCOUNT_CATEGORIES', 'Maak Kortings Groepen');
define('BOX_CATALOG_MODULES_DISCOUNT_CATEGORIES_CONFIG', 'Kortings Groepen Configuratie');
//-4.5 related products submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_RELATED_PRODUCTS', 'Geralateerde Producten');
define('BOX_CATALOG_MODULES_RELATED_PRODUCTS', 'Geralateerde Producten Overzicht');
define('BOX_CATALOG_MODULES_RELATED_PRODUCTS_CONFIG', 'Geralateerde Producten Configuratie');
//-4.6 dangling carrot submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_CARROT', 'Kado');
define('BOX_CATALOG_MODULES_CARROT', 'Kado Overzicht');
define('BOX_CATALOG_MODULES_CARROT_CONFIG', 'Kado Configuratie');
//-4.7 2 gether discount submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_2GETHER', 'Koppel Korting');
define('BOX_CATALOG_MODULES_2GETHER', 'Koppel Korting Overzicht');
define('BOX_CATALOG_MODULES_2GETHER_CONFIG', 'Koppel Korting Configuratie');

//-5 customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Klanten');
//-5.1 overview submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_CUSTOMERS', 'Klanten Overzicht');
define('BOX_CUSTOMERS_CUSTOMERS', 'Klanten');
define('BOX_CUSTOMERS_ALL_CUSTOMERS', 'Uitgebreid Klanten Overzicht');
define('BOX_CUSTOMERS_CREATE_ACCOUNT', 'Maak Klanten Account');
//-5.2 orders submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_ORDERS', 'Bestellingen');
define('BOX_CUSTOMERS_ORDERS', 'Bestellingen Overzicht');
define('BOX_CUSTOMERS_CREATE_ORDER', 'Maak Klanten Bestelling');
define('BOX_CUSTOMERS_ORDER_CONFIGURATION', 'Bestellingen Configuratie');
//-5.3 returns submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_RETURNS', 'Retourneren');
define('BOX_CUSTOMERS_RETURNS_MAIN', 'Retour Aanvragen');
define('BOX_CUSTOMERS_RETURNS_REASONS', 'Retour Reden');
define('BOX_CUSTOMERS_REFUNDS', 'Retour Methodes');
define('BOX_CUSTOMERS_RETURNS_STATUS', 'Retour Status');
define('BOX_CUSTOMERS_RETURNS_TEXT', 'Retour Tekst Bewerken');
define('BOX_CUSTOMERS_RETURN_CONFIGURATION', 'Retour Configuratie');
//-5.4 points submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_POINTS', 'Spaarpunten');
define('BOX_CUSTOMERS_POINTS', 'Spaarpunten Overzicht');
define('BOX_CUSTOMERS_POINTS_PENDING', 'Spaarpunten Afwachting');
define('BOX_CUSTOMERS_POINTS_REFERRAL', 'Spaarpunten Verwijzing');
define('BOX_CUSTOMERS_POINTS_CONFIGURATION', 'Spaarpunten Configuratie');
//-5.5 coupons and gift voucher submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_GV_ADMIN', 'Coupons &amp; Account Saldo');
define('BOX_CUSTOMERS_COUPON_ADMIN', 'Coupon Administratie');
define('BOX_CUSTOMERS_GV_ADMIN_QUEUE', 'Coupon Wachtrij');
define('BOX_CUSTOMERS_STATS_CREDITS', 'Account Saldo Overzicht');
define('BOX_CUSTOMERS_GV_ADMIN_MAIL', 'Coupons Versturen');
define('BOX_CUSTOMERS_GV_ADMIN_SENT', 'Coupons Verstuurd');
define('BOX_CUSTOMERS_COUPON_CONFIGURATION', 'Coupon Configuratie');
//-5.6 report submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_REPORTS', 'Rapporten');
define('BOX_CUSTOMERS_PRODUCTS_VIEWED', 'Artikelen Bekeken');
define('BOX_CUSTOMERS_PRODUCTS_PURCHASED', 'Artikelen Gekocht');
define('BOX_CUSTOMERS_WHOS_ONLINE', 'Wie is Online');
define('BOX_CUSTOMERS_SUPERTRACKER', 'Klanten Gedrag');
define('BOX_CUSTOMERS_REFERRAL_SOURCES', 'Gevonden via.......');
define('BOX_CUSTOMERS_ORDERS_TOTAL', 'Totaal aankopen Klant');
//-5.7 email submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_CONFIG_EMAIL', 'Email');
define('BOX_CUSTOMERS_MAIL', 'Verstuur Email');
define('BOX_CUSTOMERS_NEWSLETTER_MANAGER', 'Verstuur Nieuwsbrief');
define('BOX_CUSTOMERS_PRODUCTS_NOTIFICATIONS', 'Artikel Notificatie Manager');
define('BOX_CUSTOMERS_STATS_PRODUCTS_NOTIFICATIONS', 'Overzicht Klant Notificaties');
//-5.8 tickets submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_TICKETS', 'Support Tickets');
define('BOX_CUSTOMERS_TICKETS_VIEW', 'Support Tickets Overzicht');
define('BOX_CUSTOMERS_TICKETS_REPLY', 'Support Tickets Beantwoorden');
define('BOX_CUSTOMERS_TICKETS_ADMIN', 'Support Tickets Admin');
define('BOX_CUSTOMERS_TICKETS_DEPARTMENT', 'Support Tickets Afdelingen');
define('BOX_CUSTOMERS_TICKETS_STATUS', 'Support Tickets Status');
define('BOX_CUSTOMERS_TICKETS_PRIORITY', 'Support Tickets Prioriteiten');
define('BOX_CUSTOMERS_TICKETS_CONFIG', 'Support Tickets Configuratie');
//-5.9 quotes submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_QUOTES', 'Klanten Quotes');
define('BOX_CUSTOMERS_QUOTES', 'Klanten Quotes Overzicht');
define('BOX_CUSTOMERS_QUOTES_CONFIG', 'Quotes Configuratie');
//-5.10 configuration submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_CONFIG_CUSTOMER', 'Configuratie');
define('BOX_CUSTOMERS_GROUPS', 'Klanten Groepen');
define('BOX_CUSTOMERS_BAN_IP_ADDRESS', 'Ban IP Adres');
define('BOX_CUSTOMERS_REFERRALS', 'Gevonden via Bronnen');
define('BOX_CUSTOMERS_WISHLIST', 'Wenslijst');

//-6 tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Gereedschap');
define('BOX_TOOLS_BACKUP', 'Backup');
define('BOX_TOOLS_CACHE', 'Cache Control');
define('BOX_TOOLS_FILE_MANAGER', 'Bestandsbeheer');
//-6.1 tools submenu template in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_TEMPLATE', 'Template Configuratie');
define('BOX_TOOLS_HEADER_CONFIG', 'Bewerk Header Footer Navigation');
define('BOX_TOOLS_TITLE_CONFIG', 'Bewerk Heading Title and Image');
define('BOX_TOOLS_INFO_BOXES_CONFIG', 'Bewerk Info Boxes (<font color=#ff9900>general</font>)');
define('BOX_TOOLS_BOXES', 'Bewerk Info Boxes (<font color=green>on</font>/<font color=red>off</font>)');
define('BOX_TOOLS_INPUT_CONFIG', 'Bewerk Input Boxes');
define('BOX_TOOLS_IMAGES_CONFIG', 'Bewerk Arfbeeldingen');
define('BOX_TOOLS_SITEMAP', 'Bewerk Site Map');
//-6.1.1 tools submenu control index pages in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_INDEX_PAGES_CONFIG', 'Bewerk Index and Product Pages');
define('BOX_TOOLS_PRODUCT_CONFIG', 'Bewerk Product Info Page');
define('BOX_TOOLS_INDEX_DEFAULT_CONFIG', 'Bewerk Index Default Page');
define('BOX_TOOLS_INDEX_NESTED_CONFIG', 'Bewerk Categories List Page');
define('BOX_TOOLS_INDEX_PRODUCT_CONFIG', 'Bewerk Products List Page');
//-6.1.2 tools submenu control other pages in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_OTHER_PAGES_CONFIG', 'Bewerk Other Pages');
define('BOX_TOOLS_CUSTOMER_CONFIG', 'Bewerk Klanten Account Pagina');
define('BOX_TOOLS_SHIPPING_CONFIG', 'Bewerk Verzend Pagina');
define('BOX_TOOLS_PRIVACY_CONFIG', 'Bewerk Privacy Pagina');
define('BOX_TOOLS_CONDITIONS_CONFIG', 'Bewerk Algemene Voorwwaarden Pagina');
define('BOX_TOOLS_PAYMENT_CONFIG', 'Bewerk Betalingen Pagina');
define('BOX_TOOLS_SHOPPING_CART_CONFIG', 'Bewerk Winkelwagen Pagina');
define('BOX_TOOLS_ALL_PRODS_CONFIG', 'Bewerk Alle Producten Pagina');
define('BOX_TOOLS_PRODUCT_REVIEWS', 'Bewerk Product Recensie Pagina\'s');
//-6.1.3 tools submenu infoboxes exclude in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_INFOBOX_EXCLUDE', 'Bewerk Info Boxes (<font color=#ff9900>configuratie</font>)');
define('BOX_AFFILIATE', 'Affiliate Infobox');
define('BOX_ARTICLES', 'Artikels Infobox');
define('BOX_AUTHORS', 'Auteurs Infobox');
define('BOX_FAQ_ARTICLES', 'FAQ Infobox');
define('BOX_FAQ_AUTHORS', 'FAQ Auteurs Infobox');
define('BOX_INFO_ARTICLES', 'Algemene Informatie Infobox');
define('BOX_INFO_AUTHORS', 'Algemene Info Auteurs Infobox');
define('BOX_BEST_SELLERS', 'Meest Verkocht Infobox');
define('BOX_CATEGORIES', 'Categorie&euml;n Infobox');
define('BOX_CATEGORIES_DROPDOWN', 'Categorie&euml;n Dropdown Infobox');
define('BOX_CATEGORIES_DYNAMENU', 'Categorie&euml;n Dynamenu Infobox');
define('BOX_CATEGORIES_FLYOUT', 'Categorie&euml;n Flyout Infobox');
define('BOX_CATEGORIES_IMAGES', 'Categorie&euml;n Plaatjes Infobox');
define('BOX_CURRENCIES', 'Valuta Infobox');
define('BOX_CUSTOMERGROUP', 'Klantengroep Infobox');
define('BOX_DOCUMENTS', 'Documenten Download Infobox');
define('BOX_FEATURED', 'Aanbevolen Infobox');
define('BOX_FREE_DOWNLOADS', 'Gratis Downloads');
define('BOX_FOLLOW_US', 'Volg Ons Infobox');
define('BOX_GALLERY_PLAIN', 'Gallery Plain Infobox');
define('BOX_GALLERY_SLIDESHOW', 'Gallery Slideshow Infobox');
define('BOX_GIFTS', 'Kado\'s Infobox');
define('BOX_HEADER_TAGS', 'Header Tags Infobox');
define('BOX_HEADER_TAGS_SEO', 'Headertags SEO Infobox');
define('BOX_INFORMATION', 'Informatie Infobox');
define('BOX_LANGUAGES', 'Talen Infobox');
define('BOX_LATEST_NEWS', 'Laatste Nieuws Infobox');
define('BOX_LIVE_SUPPORT', 'Live Support Infobox');
define('BOX_LOGINBOX', 'Loginbox Infobox');
define('BOX_MANUFACTURER_INFO', 'Fabrikant Info Infobox');
define('BOX_MANUFACTURERS', 'Fabrikanten Infobox');
define('BOX_MY_ACCOUNT', 'Mijn Account Infobox');
define('BOX_ONLINERS', 'Meest Online Infobox');
define('BOX_ORDER_HISTORY', 'Bestel geschiedenis Infobox');
define('BOX_PAYMENT_INFO', 'Betaal Info Infobox');
define('BOX_PRODUCT_NOTIFICATIONS', 'Product Notificaties Infobox');
define('BOX_QRCODE', 'QR Code Infobox');
define('BOX_POLLS', 'Enquete Infobox');
define('BOX_RECENTLY_VIEWED', 'Onlangs Bekeken Infobox');
define('BOX_REFERENCES', 'Referentie Infobox');
define('BOX_REVIEWS', 'Recensies Infobox');
define('BOX_SCR_BEST_SELLERS', 'Scrolling Meest Verkochte Infobox');
define('BOX_SCR_SPECIALS', 'Scrolling Aanbiedingen Infobox');
define('BOX_SCR_WHATS_NEW', 'Scrolling Nieuwe Producten Infobox');
define('BOX_SEARCH', 'Zoeken Infobox');
define('BOX_SEARCH_TAGCLOUD', 'Zoek Tagcloud Infobox');
define('BOX_SHIPPING_INFO', 'Verzend Info Infobox');
define('BOX_SHOP_BY_PRICE_DROP', 'Winkel op Prijs Drop Infobox');
define('BOX_SHOP_BY_PRICE_TEXT', 'Winkel op Prijs Tekst Infobox');
define('BOX_SHOPPING_CART', 'Winkelwagen Infobox');
define('BOX_SHOPPING_CART_SMALL', 'Winkelwagen Beknopt Infobox');
define('BOX_SPECIALS', 'Aanbiedingen Infobox');
define('BOX_TELL_FRIEND', 'Vertel een Vriend Infobox');
define('BOX_TESTIMONIALS', 'Testimonial Infobox');
define('BOX_WHATS_NEW', 'Nieuwe Producten Infobox');
define('BOX_WISHLIST', 'Wenslijst Infobox');
define('BOX_YOUTUBE', 'You Tube Infobox');
//-6.1.4 tools submenu infoboxes exclude in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_BANNER_MANAGER', 'Bewerk Banners');
define('BOX_TOOLS_BANNER_MANAGER', 'Banners Overzicht');
define('BOX_TOOLS_BANNER_MANAGER_CONFIG', 'Banners Configuratie');

//-7 modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAGE_MANAGER', 'Laatste Nieuws Manager');
//-7.1 header tags submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_HEADER_TAGS_SEO', 'Header Tags Manager');
define('BOX_MODULES_HEADER_TAGS_ADD_A_PAGE', 'Header Tags Add Page');
define('BOX_HEADER_TAGS_SILO', 'Silo Control');
define('BOX_MODULES_HEADER_TAGS_FILL_TAGS', 'Header Tags Fill Page');
define('BOX_MODULES_HEADER_TAGS_TEST', 'Header Tags Test');
define('BOX_MODULES_HEADER_TAGS_CONFIG', 'Header Tags Configuration');
//-7.2 polls submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_POLLS', 'Enquete Manager');
define('BOX_MODULES_POLLS', 'Polls');
define('BOX_MODULES_POLLS_CONFIG', 'Polls Configuration');
//-7.3 links submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_LINKS', 'Links Manager');
define('BOX_MODULES_LINKS', 'Links');
define('BOX_MODULES_LINKS_CATEGORIES', 'Links Categorie&euml;n');
define('BOX_MODULES_LINKS_CONTACT', 'Links Contact');
define('BOX_MODULES_LINKS_EXCHANGE', 'Links Exchange');
define('BOX_MODULES_LINKS_FEATURED', 'Links Featured');
define('BOX_MODULES_LINKS_STATUS', 'Links Status');
define('BOX_MODULES_LINKS_CONFIG', 'Links Configuratie');
//-7.4 articles tags submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_ARTICLES', 'Artikel Manager');
define('BOX_MODULES_TOPICS_ARTICLES', 'Artikel Categorie&euml;n');
define('BOX_MODULES_BLOGS_ARTICLES', 'Artikel Blogs');
define('BOX_MODULES_ARTICLES_CONFIG', 'Artikel Configuratie');
define('BOX_MODULES_ARTICLES_AUTHORS', 'Artikel Schrijvers');
define('BOX_MODULES_ARTICLES_REVIEWS', 'Artikel Recensies');
define('BOX_MODULES_ARTICLES_XSELL', 'Artikel Kruis Verkoop');
//-7.5 gallery tags submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_GALLERY', 'Foto Manager');
define('BOX_MODULES_GALLERY', 'Gallery Clean Up');
define('BOX_MODULES_GALLERY_UPLOAD', 'Gallery Upload');
define('BOX_MODULES_GALLERY_SUPERUSERS', 'Gallery Superusers');
define('BOX_MODULES_GALLERY_CONFIG', 'Gallery Configuratie');
//-7.6 affiliates submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_AFFILIATE', 'Affiliate Manager');
define('BOX_CATALOG_AFFILIATE_SUMMARY', 'Overzicht');
define('BOX_CATALOG_AFFILIATE', 'Affiliate');
define('BOX_CATALOG_AFFILIATE_PAYMENT', 'Betaling');
define('BOX_CATALOG_AFFILIATE_BANNERS', 'Banner');
define('BOX_CATALOG_AFFILIATE_CONTACT', 'Contact');
define('BOX_CATALOG_AFFILIATE_NEWS', 'Nieuws');
define('BOX_CATALOG_AFFILIATE_NEWSLETTER_MANAGER', 'Nieuwsbrief Manager');
define('BOX_CATALOG_AFFILIATE_SALES', 'Affiliate Verkopen');
define('BOX_CATALOG_AFFILIATE_CLICKS', 'Kliks');
define('BOX_MODULES_AFFILIATE_CONFIG', 'Affiliate Configuratie');
//-7.7 FAQ submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_FAQ', 'FAQ Manager (<font color="red">disabled</font>)');
define('BOX_MODULES_FAQ_TOPICS', 'FAQ Categorie&euml;n');
define('BOX_MODULES_FAQ_CONFIG', 'FAQ Configuratie');
define('BOX_MODULES_FAQ_AUTHORS', 'FAQ Schrijvers');
define('BOX_MODULES_FAQ_REVIEWS', 'FAQ Recensies');
define('BOX_MODULES_FAQ_XSELL', 'FAQ Kruis Verkoop');
//-7.8 INFO submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_INFO', 'Informatie Manager (<font color="red">disabled</font>)');
define('BOX_MODULES_INFO_TOPICS', 'Info Categorie&euml;n');
define('BOX_MODULES_INFO_CONFIG', 'Info Configuratie');
define('BOX_MODULES_INFO_AUTHORS', 'Info Schrijvers');
define('BOX_MODULES_INFO_REVIEWS', 'Info Recensies');
define('BOX_MODULES_INFO_XSELL', 'Info Kruis Verkoop');
//-7.9 FAQ one page submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_FAQ_ONE_PAGE', 'FAQ Manager One Page');
define('BOX_MODULES_FAQ_MANAGER', 'FAQ Manager');
define('BOX_MODULES_FAQ_VIEW', 'Bekijk FAQ');
define('BOX_MODULES_FAQ_VIEW_ALL', 'Bekijk alle FAQ\'s');
//-7.10 tools submenu define pages in includes/boxes/tools.php
define('BOX_MODULES_HEADING_LANGUAGE', 'Tekst Manager');
define('BOX_MODULES_DEFINE_LANGUAGE', 'Bewerk Andere pagina\'s');
define('BOX_MODULES_DEFINE_MAINPAGE', 'Bewerk Hoofdpagina');
define('BOX_MODULES_DEFINE_CONDITIONS', 'Bewerk Algemene Voorwaarden');
define('BOX_MODULES_DEFINE_PRIVACY', 'Bewerk Privacy Beleid');
define('BOX_MODULES_DEFINE_SHIPPING', 'Bewerk Verzending en Retourneren');
define('BOX_MODULES_DEFINE_PAYMENT', 'Bewerk Betalingen');
define('BOX_MODULES_DEFINE_ABOUT_US', 'Bewerk Over Ons');
//-7.11 tools submenu testimonial manager in includes/boxes/tools.php
define('BOX_MODULES_HEADING_TESTIMONIALS', 'Testimonial Manager');
define('BOX_MODULES_TESTIMONIALS_MANAGER', 'Bekijk Testimonials');
define('BOX_MODULES_TESTIMONIALS_CONFIG', 'Testimonial Configuratie');
//-7.12 reference submenu testimonial manager in includes/boxes/tools.php
define('BOX_MODULES_HEADING_REFERENCES', 'Referentie Manager');
define('BOX_MODULES_REFERENCE_MANAGER', 'Bekijk Referenties');
define('BOX_MODULES_REFERENCE_CONFIG', 'Referentie Configuratie');
//-7.13 documents submenu testimonial manager in includes/boxes/tools.php
define('BOX_MODULES_HEADING_DOCUMENTS', 'Documenten Manager');
define('BOX_MODULES_DOCUMENTS', 'Documenten Overzicht');
define('BOX_MODULES_DOCUMENTS_CONFIG', 'Documenten Configuratie ');

//-8 checkout box text in includes/boxes/checkout.php
define('BOX_HEADING_CHECKOUT', 'Kassa');
define('BOX_CHECKOUT_PAYMENT', 'Betaling');
define('BOX_CHECKOUT_SHIPPING', 'Verzenden');
define('BOX_CHECKOUT_ORDER_TOTAL', 'Totale Bestelling');
define('BOX_CHECKOUT_ORDER_STATUS', 'Bestelling Status');
define('BOX_CHECKOUT_ORDER_GIFTWRAP', 'Kado Verpakking');
//-8.1 configuration submenu text in includes/boxes/checkout.php
define('BOX_CHECKOUT_HEADING_CONFIGURATION', 'Configuratie');
define('BOX_CHECKOUT_CONFIGURATION_PAYMENT', 'Betaling');
define('BOX_CHECKOUT_CONFIGURATION_SHIPPING', 'Verzenden');
define('BOX_CHECKOUT_CONFIGURATION_ORDER_TOTAL', 'Totale Bestelling');
define('BOX_CHECKOUT_CONFIGURATION_ORDER_STATUS', 'Bestelling Status');

//-9 reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Rapporten');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Artikelen gezien');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Artikelen gekocht');
define('BOX_REPORTS_ORDERS_TOTAL', 'Klant Bestellingen-Totaal');
define('BOX_REPORTS_WISHLIST', 'Klanten Wenslijstjes');
define('BOX_REPORTS_SUPERTRACKER', 'Klanten Gedrag');
define('BOX_REPORTS_REFERRAL_SOURCES', 'Gevonden via.......');
define('BOX_REPORTS_STATS_PRODUCTS_NOTIFICATIONS', 'Overzicht Klant Notificaties');
define('BOX_REPORTS_STOCK_PRODUCTS_ACTIVE', 'Voorraad Actief');
define('BOX_REPORTS_STOCK_PRODUCTS_INACTIVE', 'Voorraad Inactief');
define('BOX_REPORTS_STOCK_LOW_STOCK', 'Voorraad Overzicht Laag');
define('BOX_REPORTS_STOCK_STATS_LOW_STOCK_ATTRIB', 'Voorraad Opties');

//-10 taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locatie / BTW');
define('BOX_TAXES_COUNTRIES', 'Landen');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'BTW Zones');
define('BOX_TAXES_TAX_CLASSES', 'Belastinggroepen');
define('BOX_TAXES_TAX_RATES', 'Belastingtarieven');

//-11 localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Plaatselijkheid');
define('BOX_LOCALIZATION_CURRENCIES', 'Valuta');
define('BOX_LOCALIZATION_LANGUAGES', 'Talen');

//-12 support box text in includes/boxes/support.php
define('BOX_HEADING_SUPPORT', 'Support');
define('BOX_SUPPORT_OSSHOPPY_EXTRA', 'osShoppy Extra');
define('BOX_SUPPORT_OSSHOPPY_INFO', 'osShoppy Info');
define('BOX_SUPPORT_OSSHOPPY_MANUAL', 'osShoppy Handleiding');
define('BOX_SUPPORT_OSSHOPPY_MODULES', 'osShoppy Modules');
define('BOX_SUPPORT_OSSHOPPY_SERVER_INFO', 'osShoppy Server Info');
define('BOX_SUPPORT_OSSHOPPY_UPDATES', 'osShoppy Updates');

// osShoppy Manual
define('HEADER_ADMIN_BACK', 'Terug naar Admin');

// javascript messages
define('JS_ERROR', 'Er zijn fouten opgetreden tijdens het verwerken van uw formulier!\nPBreng de volgende wijzigingen aan:\n\n');
define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');
define('JS_PRODUCTS_NAME', '* Het nieuwe product heeft een naam nodig\n');
define('JS_PRODUCTS_DESCRIPTION', '* Het nieuwe product heeft een beschrijving nodig\n');
define('JS_PRODUCTS_PRICE', '* Het nieuwe product heeft een prijs nodig\n');
define('JS_PRODUCTS_WEIGHT', '* Het nieuwe product heeft een gewicht nodig\n');
define('JS_PRODUCTS_QUANTITY', '* Het nieuwe product heeft een aantal nodig\n');
define('JS_PRODUCTS_MODEL', '* Het nieuwe product heeft een model nodig\n');
define('JS_PRODUCTS_IMAGE', '* Het nieuwe product heeft een afbeelding nodig\n');
define('JS_SPECIALS_PRODUCTS_PRICE', '* Een nieuwe prijs moet voor dit product worden ingevoerd\n');
define('JS_GENDER', '* Het \'Geslacht\' dient te worden gekozen.\n');
define('JS_FIRST_NAME', '* De  \'voornaam\' dient minstens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_LAST_NAME', '* De \'achternaam\' dient minstens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_DOB', '* De  \'geboortedatum\' dient in het volgende formaat te zijn: xx/xx/xxxx (dag/maand/jaar).\n');
define('JS_EMAIL_ADDRESS', '* Het \'emailadres\' dient minstens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_ADDRESS', '* Het \'adres\' dient minstens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_ADDRESS_NO', '* Het \'huisnummer\' dient minstens ' . ENTRY_STREET_NO_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_POST_CODE', '* De \'postcode\' dient minstens ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_CITY', '* De \'plaats\' dient minstens ' . ENTRY_CITY_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_STATE', '* De \'provincie\' dient geselecteerd te zijn\n');
define('JS_STATE_SELECT', '-- Selecteer --');
define('JS_ZONE', '* De \'provincie\' dient geselecteerd te zijn.');
define('JS_COUNTRY', '* Het \'land\' dient geselecteerd te zijn.\n');
define('JS_TELEPHONE', '* Het \'telefoonnummer\' dient minstens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_PASSWORD', '* Het wachtwoord in de velden \'Wachtwoord\' en \'Bevestiging\' dienen exact hetzelfde te zijn en tevens minimaal ' . ENTRY_PASSWORD_MIN_LENGTH . ' karakters te bevatten.\n');
define('JS_ORDER_DOES_NOT_EXIST', 'Bestelnummer ' . $HTTP_GET_VARS['error'] . ' komt niet voor in de database!');

// account categories
define('CATEGORY_PERSONAL', '<b>Persoonlijk</b>');
define('CATEGORY_ADDRESS', '<b>Adres</b>');
define('CATEGORY_CONTACT', '<b>Contact<b>');
define('CATEGORY_COMPANY', '<b>Bedrijfsnaam<b>');
define('CATEGORY_OPTIONS', '<b>Opties</b>');
define('CATEGORY_NOTES', 'Opmerkingen');

// create account entries
define('ENTRY_GENDER', 'Geslacht:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">verplicht</font></small>');
define('ENTRY_FIRST_NAME', 'Voornaam:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#AABBDD">verplicht</font></small>');
define('ENTRY_INSERTION_NAME', 'tussenvoegsel:');
define('ENTRY_INSERTION_NAME_ERROR', '');
define('ENTRY_LAST_NAME', 'Achternaam:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#AABBDD">verplicht</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Geboortedatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small>(bijv. 21/05/1970) <font color="#AABBDD">verplicht</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'Emailadres:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#AABBDD">verplicht</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">het email adres blijkt niet goed te zijn!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Dit email adres bestaat al!</span>');
define('ENTRY_COMPANY', 'Bedrijf');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TAX_ID', 'Bedrijf b.t.w of klant nummer:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_CUSTOMERS_GROUP_NAME', 'Klanten Groep:');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Zet alert uit voor verififcatie:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alarm uit');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alarm aan');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Straatnaam:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' karakters</span>');
define('ENTRY_STREET_NO', 'Huisnummer:');
define('ENTRY_STREET_NO_ERROR', '');
define('ENTRY_STREET_NO_ADD', 'toevoeging:');
define('ENTRY_STREET_NO_ADD_ERROR', '');
define('ENTRY_SUBURB', 'Wijk:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Postcode:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' karakters</span>');
define('ENTRY_CITY', 'Plaats:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' karakters</span>');
define('ENTRY_STATE', 'Provincie:');
define('ENTRY_STATE_ERROR', '');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '&nbsp;<small><font color="#AABBDD">verplicht</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telefoonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' karakters</span>');
define('ENTRY_FAX_NUMBER', 'Faxnummer:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Inschrijven voor de Nieuwsbrief:');
define('ENTRY_NEWSLETTER_YES', 'Ja');
define('ENTRY_NEWSLETTER_NO', 'Nee');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Wachtwoord:');
define('PASSWORD_HIDDEN', '--VERBORGEN--');

// images
define('IMAGE_ADD_BANNER','Voeg Banner Toe');
define('IMAGE_ADDITIONAL_NEW', 'Voeg Afbeelding toe');    
define('IMAGE_ADDITIONAL_DEL', 'Verwijder Afbeelding');
define('IMAGE_ANI_SEND_EMAIL', 'Verstuurd E-Mail');
define('IMAGE_APPROVE', 'Goed Keuren');
define('IMAGE_ASSOCIATE', 'Associeer Met');
define('IMAGE_BACK', 'Terug');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Annuleer');
define('IMAGE_CHECK_LINK', 'Controleer Link');
define('IMAGE_CHECK_LINKS', 'Controleer Links');
define('IMAGE_CLICKTHROUGHS', 'Affiliate Doorkliks');
define('IMAGE_CONFIRM', 'Bevestig');
define('IMAGE_COPY', 'Kopieer');
define('IMAGE_COPY_TO', 'Kopieer naar');
define('IMAGE_CREATE_ORDER', 'Maak een Bestelling');
define('IMAGE_DEFINE', 'Definieer');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Verwijder');
define('IMAGE_DISABLE', 'Stopzetten');
define('IMAGE_DISAPPROVE', 'Afkeuren');
define('IMAGE_EDIT', 'Aanpassen');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Bestandsbeheer');
define('IMAGE_FILE_PERMISSION', 'Permissies');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_HELP', 'Help');
define('IMAGE_ICON_STATUS_GREEN', 'Actief');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Maak Actief');
define('IMAGE_ICON_STATUS_RED', 'Inactief');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Maak Inactief');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Invoegen');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MANAGE_BANNERS', 'Beheer Banners');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_MODULE_INSTALL', 'Install Module');
define('IMAGE_MODULE_REMOVE', 'Verwijder Module');
define('IMAGE_MOVE', 'Verplaats');
define('IMAGE_NEW_AUTHOR', 'Nieuwe Schrijver');
define('IMAGE_NEW_ARTICLE', 'Nieuw Artikel');
define('IMAGE_NEW_BANNER', 'Nieuwe Banner');
define('IMAGE_NEW_CATEGORY', 'Nieuwe Categorie');
define('IMAGE_NEW_COUNTRY', 'Nieuw Land');
define('IMAGE_NEW_CURRENCY', 'Nieuwe Valuta');
define('IMAGE_NEW_DOCUMENT_TYPE', 'Nieuw Document');
define('IMAGE_NEW_FAQ', 'Nieuw FAQ');
define('IMAGE_NEW_FAQ_AUTHOR', 'Nieuwe FAQ Schrijver');
define('IMAGE_NEW_FAQ_CATEGORY', 'Nieuwe FAQ Categorie');
define('IMAGE_NEW_FAQ_TOPIC', 'Nieuwe FAQ Categorie');
define('IMAGE_NEW_FILE', 'Nieuw Bestand');
define('IMAGE_NEW_FOLDER', 'Nieuwe Folder');
define('IMAGE_NEW_G_INFO', 'Nieuw Algemene Informatie');
define('IMAGE_NEW_G_INFO_AUTHOR', 'Nieuwe Algemene Informatie Schrijver');
define('IMAGE_NEW_G_INFO_CATEGORY', 'Nieuwe Info Categorie');
define('IMAGE_NEW_G_INFO_TOPIC', 'Nieuwe Algemene Informatie Categorie');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_LANGUAGE', 'Nieuwe Taal');
define('IMAGE_NEW_LINK', 'Nieuwe Link');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEW_NEWSLETTER', 'Nieuwe Nieuwsbrief');
define('IMAGE_NEW_PRODUCT', 'Nieuw Product');
define('IMAGE_NEW_REFERENCES', 'Nieuwe Referentie');
define('IMAGE_NEW_TAX_CLASS', 'Nieuwe BTW Class');
define('IMAGE_NEW_TAX_RATE', 'Nieuwe BTW Rate');
define('IMAGE_NEW_TAX_ZONE', 'Nieuwe BTW Zone');
define('IMAGE_NEW_TESTIMONIAL', 'Nieuwe Testimonial');
define('IMAGE_NEW_TOPIC', 'Nieuwe Categorie');
define('IMAGE_NEW_ZONE', 'Nieuwe Zone');
define('IMAGE_NEXT', 'Next');
define('IMAGE_ORDERS', 'Bestellingen');
define('IMAGE_ORDERS_INVOICE', 'Facturen');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_RELATED_PRODUCTS', 'Gerelateerde Producten');
define('IMAGE_SALES', 'Affiliate Verkopen');
define('IMAGE_SAVE', 'Opslaan');
define('IMAGE_SEARCH', 'Zoeken');
define('IMAGE_SELECT', 'Selecteer');
define('IMAGE_SEND', 'Verstuur');
define('IMAGE_SEND_EMAIL', 'Verstuur Email');
define('IMAGE_SHOW_PRODUCTS', 'Toon Producten');
define('IMAGE_STOCK', 'Toon Voorraad');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Update');
define('IMAGE_UPDATE_CURRENCIES', 'Update Valutakoers');
define('IMAGE_UPLOAD', 'Upload');

// icons
define('ICON_CROSS', 'Nee');
define('ICON_CURRENT_FOLDER', 'Huidige Folder');
define('ICON_DELETE', 'Verwijder');
define('ICON_ERROR', 'Fout');
define('ICON_FILE', 'Bestand');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Omhoog');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistieken');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'Ja');
define('ICON_UNLOCKED', 'Vrijgegeven');
define('ICON_WARNING', 'Waarschuwing');
define('ICON_RSS_ON', 'Toon in RSS feed, maak inactief'); 
define('ICON_RSS_OFF', 'Toont niet in RSS feed, maak actief'); 

// constants for use in sort order
define('SORT_BY_ID_ASC', 'Sorteer op ID oplopend  --> 1-2-3 van boven ');
define('SORT_BY_ID_DESC', 'Sorteer op ID aflopend  --> 3-2-1 van boven ');
define('SORT_BY_NAME_ASC', 'Sorteer op Naam oplopend  --> a-b-c van boven ');
define('SORT_BY_NAME_DESC', 'Sorteer op Naam aflopend  --> z-y-x van boven ');
define('SORT_BY_PRODUCTS_ID_ASC', 'Sorteer op product ID oplopend  --> 1-2-3 van boven ');
define('SORT_BY_PRODUCTS_ID_DESC', 'Sorteer op product ID aflopend  --> 3-2-1 van boven ');
define('SORT_BY_PRODUCTS_NAME_ASC', 'Sorteer op products Naam oplopend  --> a-b-c van boven ');
define('SORT_BY_PRODUCTS_NAME_DESC', 'Sorteer op products Naam aflopend  --> z-y-x van boven ');
define('SORT_BY_PRODUCTS_MODEL_ASC', 'Sorteer op products Model oplopend  --> a-b-c van boven ');
define('SORT_BY_PRODUCTS_MODEL_DESC', 'Sorteer op products Model aflopend  --> z-y-x van boven ');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina %s van %d');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> artikel schrijvers)');
define('TEXT_DISPLAY_NUMBER_OF_FAQ_AUTHORS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> faq schrijvers)');
define('TEXT_DISPLAY_NUMBER_OF_INFO_AUTHORS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> info schrijvers)');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Vertoont <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> landen)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> klanten)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> valuta)');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CATEGORIES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> kortingsgropen)');
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Vertoont <b>%d</b> to <b>%d</b> (van <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> talen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> fabrikanten)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> nieuwsbrieven)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Vertoont <b>%d</b> to <b>%d</b> (van <b>%d</b> Admin Leden)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> bestellingen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_RETURN', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> retour bestellingen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Vertoont <b>%d</b> to <b>%d</b> (of <b>%d</b> bestellingen status)');
define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> pagina\'s)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> artikelen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> verwachte artikelen)');
define('TEXT_DISPLAY_NUMBER_OF_RETURN_REASON', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> retour redenen)');
define('TEXT_DISPLAY_NUMBER_OF_REFUND_METHODS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> retour methoden)');
define('TEXT_DISPLAY_NUMBER_OF_RETOUR_STATUS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> retour status)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> artikel recensies)');
define('TEXT_DISPLAY_NUMBER_OF_FAQ_REVIEWS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> faq recensies)');
define('TEXT_DISPLAY_NUMBER_OF_INFO_REVIEWS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> info recensies)');
define('TEXT_DISPLAY_NUMBER_OF_REFERRALS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> gevonden via bronnen)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> speciale aanbiedingen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> BTW groepen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Vertoont <b>%d</b> to <b>%d</b> (of <b>%d</b> BTW zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> BTW-tarieven)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'standaard');
define('TEXT_SET_DEFAULT', 'Maak standaard');
define('TEXT_FIELD_REQUIRED', ' *');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fout: Er is op dit moment geen standaard valuta ingesteld. Maak een valuta standaard bij: Administratie->Plaatselijkheid->Valuta');

define('TEXT_CACHE_CATEGORIES', 'Categorieen Box');
define('TEXT_CACHE_MANUFACTURERS', 'Leveranciers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Ook Gekocht Module');

define('TEXT_NONE', '--geen--');
define('TEXT_TOP', 'Naar boven');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');
define('WARNING_ADMIN_LOW_NOTES_TIME', '<b>Attentie:</b> Er is een notitie voor de <b>LOW</b> administrator! <a href="admin_low_notes.php">(klik hier)</a>');
define('WARNING_ADMIN_MID_NOTES_TIME', '<b>Attentie:</b> Er is een notitie voor de <b>MID</b> administrator! <a href="admin_mid_notes.php">(klik hier)</a>');
define('WARNING_ADMIN_TOP_NOTES_TIME', '<b>Attentie:</b> Er is een notitie voor de <b>TOP</b> administrator! <a href="admin_top_notes.php">(klik hier)</a>');
define('TEXT_QTPRO_FIRST', '<b>Attentie:</b> Er is/zijn ');
define('TEXT_QTPRO_SECOND', ' product(en) met incorrecte voorraad! ');
define('TEXT_CLICK', ' (klik hier)');
// mindsparx admin
define('LOGG_OUT', 'Uitloggen');
define('HEADING_TITLE2', '10 best bekeken producten');
define('TABLE_HEADING_VIEWED2', '(x) bekeken');
define('HEADER_WARNING', 'Here you can put a warning for your clients <br>Warning! Please take a database backup before change these settings. ');
// admin welcome text
define('TEXT5', 'Er zijn in totaal ');
define('TEXT6', ' klanten met een account. <br>Er zijn in totaal ');
define('TEXT7', ' producten aanwezig.<br> Er zijn in totaal ');
define('TEXT8', ' recensies geschreven.');
define('DO_USE', 'You can use the quick navigation at the top of the page to manage your orders.');
define('WELCOME_BACK', 'Welkom Terug ');
define('TEXT_INFO_LOGDATE', 'Laatst Ingelogd: ');
define('STOCK_TEXT_WARNING1', '<center><b><font color="#990000">Opgelet!</font></b></center><br> Er zijn ');
define('STOCK_TEXT_WARNING2', ' product(en) waarvan de voorraad begint op te raken. <br>Klik hier voor  ');
define('STOCK_TEXT_WARNING3', '');
define('STOCK_TEXT_OK1', '<b><center><font color="#009900 ">De voorraad is voldoende</font></center></b><br> Er zijn geen artikelen onder Bestel Niveau. <br>Klik hier voor');
define('STOCK_TEXT_OK2', '');

define('TEXT_SUMMARY_INFO_WHOS_ONLINE', 'Gebruikers Online: %s');
define('TEXT_SUMMARY_INFO_CUSTOMERS', 'Totaal Klanten: %s, Vandaag: %s');
define('TEXT_SUMMARY_INFO_ORDERS', 'Totaal Overzicht Bestellingen Aantal : <br> %s, <br><b>Vandaag:</b> %s');
define('TEXT_SUMMARY_INFO_REVIEWS', 'Totaal Recensies: %s, Vandaag: %s');
define('TEXT_SUMMARY_INFO_TICKETS', 'Ticket Status %s');
define('TEXT_SUMMARY_INFO_ORDERS_TOTAL', 'Totaal Overzicht Bestellingen Valuta: <br> %s,<br><b> Vandaag: </b>%s');

define('EMAIL_CONFIGURATION_CHANGE_TEXT_SUBJECT','Winkel Configuratie Aanpassing');
define('EMAIL_CONFIGURATION_CHANGE_TEXT_BODY','Er is vanuit het administratie paneel van ' . STORE_NAME . ' een configuratie aanpassing uitgevoerd.<br>Is dit zonder toestemming uitgevoerd dan is het verstandig om het administratie paneel <br>te bezoeken om te zien welke aanpassingen zijn uitgevoerd.');

define('TEXT_GIFT_HEADER', 'Kado\'s');
define('TEXT_NEW_GIFT_ADD', 'Voeg een Kado toe:');
define('TEXT_GIFT_ADD_CARROT', '<a href="' . tep_href_link(FILENAME_CATEGORIES) . '">Ga naar de product bewerk pagina om een kado aan de lijst toe te voegen.</a>');
define('TEXT_THRESHOLD', 'Grensbedrag');
define('TEXT_ADD', 'Voeg Toe');

define('BOX_HEADING_GV_ADMIN', 'Vouchers/Coupons');
define('BOX_GV_ADMIN_QUEUE', 'Gift Voucher Queue');
define('BOX_GV_ADMIN_MAIL', 'Mail Gift Voucher');
define('BOX_GV_ADMIN_SENT', 'Gift Vouchers sent');
define('BOX_COUPON_ADMIN','Coupon Admin');

define('IMAGE_RELEASE', 'Redeem Gift Voucher');

define('_JANUARY', 'Januari');
define('_FEBRUARY', 'February');
define('_MARCH', 'March');
define('_APRIL', 'April');
define('_MAY', 'May');
define('_JUNE', 'June');
define('_JULY', 'July');
define('_AUGUST', 'August');
define('_SEPTEMBER', 'September');
define('_OCTOBER', 'October');
define('_NOVEMBER', 'November');
define('_DECEMBER', 'December');

define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> gift vouchers)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> coupons)');

define('TEXT_VALID_PRODUCTS_LIST', 'Products List');
define('TEXT_VALID_PRODUCTS_ID', 'Products ID');
define('TEXT_VALID_PRODUCTS_NAME', 'Products Name');
define('TEXT_VALID_PRODUCTS_MODEL', 'Products Model');

define('TEXT_VALID_CATEGORIES_LIST', 'Categories List');
define('TEXT_VALID_CATEGORIES_ID', 'Category ID');
define('TEXT_VALID_CATEGORIES_NAME', 'Category Name');

require(DIR_WS_LANGUAGES . 'mail_dutch.php');
?>
