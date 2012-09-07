<?php
//$Id: /catalog/includes/languages/dutch.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

setlocale(LC_TIME, 'nl_NL.ISO8859-1');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_TIME_FORMAT_LONG', DATE_FORMAT_LONG . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format dd/mm/yyyy
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

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="nl"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Account aanmaken');
define('HEADER_TITLE_MY_ACCOUNT', 'Mijn account');
define('HEADER_TITLE_FORUM', 'Forum');
define('HEADER_TITLE_CART_CONTENTS', 'Inhoud winkelwagentje');
define('HEADER_TITLE_CHECKOUT', 'Afrekenen');
define('HEADER_TITLE_CONTACT_US', 'Neem contact op');
define('HEADER_TITLE_TOP', 'Home');
define('HEADER_TITLE_CATALOG', 'Productcatalogus');
define('HEADER_TITLE_LOGOFF', 'Uitloggen');
define('HEADER_TITLE_LOGIN', 'Inloggen');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'hits sinds');
define('FOOTER_INFORMATION_FAQ', 'FAQ');
define('FOOTER_INFORMATION_CONTACT', 'Neem contact op');
define('FOOTER_INFORMATION_DYNAMIC_SITEMAP', 'Sitemap');
define('FOOTER_INFORMATION_GENERAL_INFORMATION', 'ALgemene Informatie');

// text for gender
define('MALE', 'Man');
define('FEMALE', 'Vrouw');
define('MALE_ADDRESS', 'Dhr.');
define('FEMALE_ADDRESS', 'Mevr.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// rss feed
define('BOX_INFORMATION_RSS', 'Product Catalogus Feed');
define('BOX_INFORMATION_RSS_CATEGORY', 'Categori&euml;n RSS Feed');
define('BOX_INFORMATION_RSS_MANUFACTURER', 'Fabrikant RSS Feed');

//|| project infoboxen ||\\
// affiliate box text in includes/boxes/affiliate.php
define('BOX_HEADING_AFFILIATE', 'Affiliate Programma');
define('BOX_HEADING_AFFILIATE_NEWS', 'Affiliate News');
define('BOX_AFFILIATE_CONTACT', 'Neem Contact Op');
define('BOX_AFFILIATE_FAQ', 'Affiliate Programma FAQ');
define('BOX_AFFILIATE_LOGIN', 'Affiliate Inloggen');
define('BOX_AFFILIATE_LOGOUT', 'Affiliate Uitloggen');
define('BOX_INFORMATION_AFFILIATE', 'The Affiliate Programma');
define('BOX_AFFILIATE_CENTRE', 'Affiliate Centre');
define('BOX_AFFILIATE_BANNER_CENTRE', 'Affiliate Links');
define('BOX_AFFILIATE_REPORT_CENTRE', 'Affiliate Rapporten');
define('BOX_AFFILIATE_INFO', 'Affiliate Informatie');
define('BOX_AFFILIATE_SUMMARY', 'Affiliate Overzicht');
define('BOX_AFFILIATE_PASSWORD', 'Verander Wachtwoord');
define('BOX_AFFILIATE_NEWS', 'Affiliate Nieuws');
define('BOX_AFFILIATE_NEWSLETTER', 'Nieuwsbrief');
define('BOX_AFFILIATE_ACCOUNT', 'Bewerk Affiliate Account');
define('BOX_AFFILIATE_REPORTS', 'Affiliate Rapporten');
define('BOX_AFFILIATE_CLICKRATE', 'Doorklik Rapporten');
define('BOX_AFFILIATE_PAYMENT', 'Betaal Rapport');
define('BOX_AFFILIATE_SALES', 'Verkoop Rapport');
define('BOX_AFFILIATE_BANNERS', 'Affiliate Banners / Links');
define('BOX_AFFILIATE_BANNERS_BANNERS', 'WebSite Banners');
define('BOX_AFFILIATE_BANNERS_BUILD_CAT', 'Cre&euml;er Categorie Link');
define('BOX_AFFILIATE_BANNERS_BUILD', 'Cre&euml;er Product Link');
define('BOX_AFFILIATE_BANNERS_PRODUCT', 'Product Banners');
define('BOX_AFFILIATE_BANNERS_CATEGORY', 'Categorie Banners');
define('BOX_AFFILIATE_BANNERS_TEXT', 'Tekst Links');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Meest verkocht');
define('BOX_HEADING_BESTSELLERS_IN', 'Meest verkochte in<br>  ');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categoriëen');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Valuta');

// customergroup box text in includes/boxes/currencies.php
define('BOX_HEADING_CUSTOMERGROUP', 'Klantengroep');

// documents box text in includes/boxes/documents.php
define('BOX_HEADING_DOCUMENTS', 'Download Documenten');

// extra pages info info box in includes/boxes/extra_pages_info.php 
define('BOX_HEADING_LATEST_NEWS', 'Laatste Nieuws');

// free_downloads box text in includes/boxes/free_downloads.php
define('BOX_HEADING_FREE_DOWNLOADS', 'Gratis Downloads');

// follow_us box text in includes/boxes/follow_us.php
define('BOX_HEADING_FOLLOW_US', 'Volg ons op...');

// featured box text in includes/boxes/featured.php
define('BOX_CATALOG_FEATURED_PRODUCTS', 'Aanbevolen Producten');
define('BOX_HEADING_FEATURED', 'Aanbevolen');

// gallery box text in includes/boxes/gallery.php
define('BOX_HEADING_GALLERY', 'Product Foto\'s'); 
define('TEXT_GALLERY', 'Bekijk de Product Foto\'s');
define('BOX_TEXT_GALLERY_LINK', '<a href="gallery_user.php">Voeg je eigen plaatje toe!</a>');
define('BOX_SLIDESHOW_MAX_THUMBS','25');
define('BOX_GALLERY_TOOLTIP','Bekijk alle Product Foto\'s');
define('TEXT_PLACE_COMMENT_NOT_LOGIN','Login om een reactie te plaaten!');

// gifts box text in includes/boxes/gifts.php
define('BOX_HEADING_GIFTS', 'Kado\'s');

// header shopping cart
define('ITEM_IN_CART', 'Aantal:');
define('TOTAL_AMOUNT', 'Bedrag:');
define('BOX_HEADING_CART', 'Mijn Winkelwagen');
define('SHOPPING_BAG_CART_EMPTY', 'Mijn winkelwagen is leeg');
define('SHOPPING_BAG_CART_FULL', 'Er zit iets in mijn winkelwagen');

// header tags box text in includes/boxes/header_tags.php
define ('BOX_HEADING_HEADER_TAGS', 'Header Tags');

// headertags seo silo box text in includes/boxes/headertags_seo_silo.php
define ('BOX_HEADING_HEADERTAGS_SEO_SILO', 'Header Tags Silo');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informatie');
define('BOX_INFORMATION_PRIVACY', 'Privacy beleid');
define('BOX_INFORMATION_CONDITIONS', 'Algemene&nbsp;voorwaarden');
define('BOX_INFORMATION_SHIPPING', 'Verzenden&nbsp;&&nbsp;Retourneren');
define('BOX_INFORMATION_CONTACT', 'Neem contact op');
define('BOX_INFORMATION_ABOUT_US', 'Over ons');
define('BOX_INFORMATION_FAQ', 'Veel gestelde vragen');
define('BOX_INFORMATION_ARTICLES', 'Product Artikels');
define('BOX_INFORMATION_GENERAL_INFO', 'Algemene Informatie');
define('BOX_INFORMATION_TESTIMONIALS', 'Klanten Testimonials');
define('BOX_INFORMATION_GALLERY', 'Product Foto Album');
define('BOX_INFORMATION_REFERENCES', 'Bedrijfs Referenties');
define('BOX_INFORMATION_POLLS', 'Enquetes');
define('BOX_INFORMATION_LINKS', 'Links');
define('BOX_INFORMATION_ALL_PRODS', 'Alle Producten');
define('BOX_INFORMATION_PAYMENT', 'Betalingen');
define('BOX_INFORMATION_DOCUMENTS', 'Download Documenten');
define('BOX_INFORMATION_RETURNS_TRACK', 'Zoek Retour Aanvraag');
define('BOX_INFORMATION_FREE_DOWNLOADS', 'Gratis Downloads');
define('BOX_INFORMATION_QUOTES', 'Klant Citaat');
define('BOX_INFORMATION_TICKETS_VIEW', 'Zoek Support Ticket');
define('BOX_INFORMATION_TICKETS_CREATE', 'Maak Support Ticket');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Taalkeuze');

// links box text in includes/boxes/links.php
define('BOX_HEADING_LINKS', 'Top Links');
define('BOX_INFORMATION_LINKS', 'Links');

// live support box text in includes/boxes/live_support.php
define('BOX_HEADING_LIVE_SUPPORT', 'Live Support');
define('BOX_INFORMATION_PHPONLINE', 'Live Support');

// loginbox box text in includes/boxes/loginbox.php
define('BOX_HEADING_LOGIN_BOX', 'Login');
define('BOX_LOGINBOX_EMAIL', '<center>E-mailadres:</center>');
define('BOX_LOGINBOX_PASSWORD', '<center>Wachtwoord:</center>');
define('BOX_LOGINBOX_TEXT_NEW', '<center>Een nieuwe klant ?</center>');
define('BOX_LOGINBOX_NEW', '<center><u>registreer</u></center>'); 
define('BOX_LOGINBOX_FORGOT_PASSWORD', '<center><u>(vergeten)</u></center><br>');
define('LOGIN_BOX_PRODUCTS_NEW','Nieuwe producten');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','Mijn account info');
define('LOGIN_BOX_FRONTEND_NOTES','Berichten');
define('LOGIN_BOX_FRONTEND_NOTES_YES','<small><b><center>Er is een persoonlijk bericht van '.STORE_NAME.' voor u!</b><br><a href="' . tep_href_link(FILENAME_ACCOUNT) . '"><u>klik hier</u></a></small></center>');
define('LOGIN_BOX_FRONTEND_NOTES_NO','<small><b>Er is geen bericht voor u!</b></small>');
define('LOGIN_BOX_ACCOUNT_EDIT','Wijzig Account Info');
define('LOGIN_BOX_ACCOUNT_HISTORY','Eerdere bestellingen');
define('LOGIN_BOX_ADDRESS_BOOK','Mijn adresboek');
define('LOGIN_BOX_CHECKOUT_SHIPPING', 'Afrekenen');
define('LOGIN_BOX_ACCOUNT_NOTIFICATIONS','Product Notificatie');
define('LOGIN_BOX_MY_ACCOUNT','Mijn Account Info');
define('LOGIN_BOX_SHOPPING_CART','Mijn Winkelwagen');
define('LOGIN_BOX_AFFILIATE','Affiliate Programma');
define('LOGIN_BOX_ARTICLE_SUBMIT','Schrijf Artikel');
define('LOGIN_BOX_FAQ_ARTICLE_SUBMIT','Schrijf FAQ');
define('LOGIN_BOX_INFO_ARTICLE_SUBMIT','Schrijf Informatie Artikel');
define('LOGIN_BOX_RECENTLY_VIEWED','Producten Net Bekeken');
define('LOGIN_BOX_WISHLIST','Mijn Wenslijstje');
define('LOGIN_BOX_LOGOFF','Uitloggen');

// manufacturer info box text in includes/boxes/manufacturer_info.php
define('BOX_HEADING_MANUFACTURER_INFO', 'Fabrikanten Info');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepagina');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Andere Producten');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabrikanten');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notificaties');
define('BOX_NOTIFICATIONS_NOTIFY', 'Hou me op de hoogte van updates op <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Hou me niet op de hoogte van updates op <b>%s</b>');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Orderhistorie');

// polls box text in includes/boxes/polls.php
define('_RESULTS', 'resultaten'); 
define('_POLLS','Enquetes'); 
define('_VOTE', 'Stem'); 
define('_VOTES', 'Stemmen'); 
define('_NOPOLLS','Geen beschikbare Enquetes'); 
define('_NOPOLLSCONTENT','Er zijn geen Enquetes beschikbaar. Bekijk hier de resultaten van andere Enquetes<br><br><a href="pollbooth.php">['._POLLS.']');  

// onliners box in includes/boxes/onliners.php 
define('BOX_HEADING_ONLINECOUNTER','Nu online');
define('GUESTSONLINE_FIELD','Bezoekers nu online: ');
define('MOSTEVER_FIELD','Meeste tegelijk: ');
define('ONLINESINDS_FIELD',' bezoekers sinds: ');
define('PAGEVIEWS_FIELD','Pagina\'s bekeken: ');
define('TOTAL_ONLINE','Producten in Shop: ');

// payment info box in includes/boxes/payment_info.php 
define ('BOX_HEADING_PAYMENT_INFO', 'Betaal Info');

// points and coupons box text in includes/boxes/points_coupons_balance.php
define('BOX_HEADING_POINTS_CCGV', 'Spaarpunten en Coupons');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Snelzoeken');
define('BOX_SEARCH_TEXT', 'Gebruik trefwoorden om te vinden wat u zoekt');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Uitgebreid zoeken');

// recently viewed box in includes/boxes/recently_viewed.php 
define ('BOX_HEADING_RECENTLY_VIEWED', 'Onlangs Bekeken');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Recensies');
define('BOX_REVIEWS_WRITE_REVIEW', '<center>Ben jij de eerste die een recensie schrijft over dit product?</center>');
define('BOX_REVIEWS_NO_REVIEWS', '<center>Ben jij de eerste die een recensie schrijft?</center>');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s van 5 sterren!');

// shipping info box in includes/boxes/shipping_info.php 
define ('BOX_HEADING_SHIPPING_INFO', 'Verzend Info');

// shop by price info box in includes/boxes/shop_by_price.php 
define('BOX_HEADING_SHOP_BY_PRICE', 'Zoek op Prijs');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Winkelwagen');
define('BOX_SHOPPING_CART_EMPTY', 'Uw winkelwagen is leeg.');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Speciale aanbiedingen');

// tag cloud box in includes/boxes/tagcloud.php 
define ('BOX_HEADING_TAGCLOUD', 'Tag Cloud');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Vertel het verder');
define('BOX_TELL_A_FRIEND_TEXT', 'Vertel iemand over dit Product.');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Nieuwe Producten');
define('BOX_HEADING_WHATS_NEW_SCROLL', 'Nieuwe Producten');

// wishlist box text in includes/boxes/wishlist.php
define('BOX_HEADING_WISHLIST', 'Mijn Wenslijstje');
define('TEXT_WISHLIST_COUNT', 'Er staan %s producten in mijn wenslijst.');

// youtube box text in includes/boxes/languages.php
define('BOX_HEADING_YOUTUBE', 'Youtube Video');
//|| project infoboxen_eof ||\\

//|| project modules ||\\
// affiliate manager
define('TEXT_PAYMENT_ID', 'Shows the ID Number, of payments.');
define('TEXT_SALES_PAYMENT_DATE', 'Shows the date, of payments.');
define('TEXT_SALES_PAYMENT_Ammount', 'Affiliate Earnings represents the commission due on the sale');
define('TEXT_PAYMENT_STATUS', 'Sale Status represents the status the sale.');
define('ENTRY_AFFILIATE_PAYMENT_DETAILS', 'Maak betaalbaar aan:');
define('ENTRY_AFFILIATE_ACCEPT_AGB', 'Vink aan om te laten zien dat u op de hoogte bent van de Affiliate Voorwaarden! ');
define('ENTRY_AFFILIATE_ACCEPT_AGB_TEXT', 'Affiliate Programma Algemene Voorwaarden ');
define('ENTRY_AFFILIATE_AGB_ERROR', ' &nbsp;<small><font color="#FF0000">De algemene voorwaarden van ons affiliate programma moet nog geaccepteerd worden</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_CHECK', 'Paypal t.n.v.:');
define('ENTRY_AFFILIATE_PAYMENT_CHECK_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL', 'PayPal Account Email:');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME', 'Bank Naam:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME', 'Rekening t.n.v.:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER', 'Rekening Nummer:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER', 'IBAN nr.:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE', 'SWIFT/BIC nr.:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_COMPANY', 'Bedrijf');
define('ENTRY_AFFILIATE_COMPANY_TEXT', '');
define('ENTRY_AFFILIATE_COMPANY_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_COMPANY_TAXID', 'BTW nr.:');
define('ENTRY_AFFILIATE_COMPANY_TAXID_TEXT', '');
define('ENTRY_AFFILIATE_COMPANY_TAXID_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('ENTRY_AFFILIATE_HOMEPAGE', 'Homepage');
define('ENTRY_AFFILIATE_HOMEPAGE_TEXT', '&nbsp;<small><font color="#FF0000">* (incl. http://)</font></small>');
define('ENTRY_AFFILIATE_HOMEPAGE_ERROR', '&nbsp;<small><font color="#FF0000">* (incl. http://)</font></small>');
define('ENTRY_AFFILIATE_NEWSLETTER', 'Affiliate Nieuwsbrief');
define('ENTRY_AFFILIATE_NEWSLETTER_TEXT', '');
define('ENTRY_AFFILIATE_NEWSLETTER_ERROR', '&nbsp;<small><font color="#FF0000">vereist</font></small>');
define('CATEGORY_PAYMENT_DETAILS', 'Waar uw betalingen ontvangen:');

// article manager
define('BOX_HEADING_ARTICLES', 'Artikels');
define('BOX_ALL_ARTICLES', 'Alle Artikels');
define('BOX_ARTICLE_SUBMIT', 'Schrijf een Artikel');
define('BOX_ARTICLE_TOPICS', 'Alle Categorie&euml;n');
define('BOX_NEW_ARTICLES', 'Nieuwe Artikels: ');
define('TEXT_ARTICLE_SEARCH', 'Zoek een Artikel');
define('TEXT_ARTICLE_SEARCH_STRING', 'zoek artikel...');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> artikels)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> nieuwe artikels)');
define('TEXT_ARTICLES', 'Hieronder is een lijst artikels met de meest recente bovenaan geplaatst.');  
define('TABLE_HEADING_AUTHOR', 'Auteur');
define('TABLE_HEADING_ABSTRACT', 'Abstract');
define('TEXT_PXSELL_ARTICLES', 'Gerelateerde Artikels');
define('BOX_HEADING_AUTHOR', 'Artikels van Auteur');
define('BOX_HEADING_AUTHORS', 'Artikels van Auteurs');
define('BOX_ARTICLES_BLOG_COMMENTS', 'Blog Artikels');
define('NAVBAR_TITLE_DEFAULT', 'Artikels');
define('BOX_RSS_ARTICLES', 'Artikels RSS Feed');
define('BOX_UPCOMING_ARTICLES', 'Verwachte Artikels');

// faq manager
define('BOX_HEADING_FAQ', 'Veel Gestelde Vragen');
define('BOX_ALL_FAQ', 'Alle FAQ\'s');
define('BOX_FAQ_SUBMIT', 'Schrijf een Veel Gestelde Vraag');
define('BOX_FAQ_TOPICS', 'Alle FAQ Categorie&euml;n');
define('BOX_NEW_FAQ', 'Nieuwe FAQ\'s: ');
define('TEXT_FAQ_SEARCH', 'Zoek een FAQ');
define('TEXT_FAQ_SEARCH_STRING', 'zoek faq...');
define('TEXT_DISPLAY_NUMBER_OF_FAQ', 'faq <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> faq\'s)');
define('TEXT_DISPLAY_NUMBER_OF_FAQ_NEW', 'nieuwe faq <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> nieuwe faq\'s)');
define('TEXT_FAQ', 'Hieronder is een lijst FAQ\'s met de meest recente bovenaan geplaatst.');  
define('TABLE_HEADING_FAQ_AUTHOR', 'FAQ Auteur');
define('TABLE_HEADING_FAQ_ABSTRACT', 'Abstract');
define('TEXT_PXSELL_FAQ', 'Gerelateerde FAQ\'s');
define('BOX_HEADING_FAQ_AUTHOR', 'FAQ\'s van Auteur');
define('BOX_HEADING_FAQ_AUTHORS', 'FAQ\'s van Auteurs');
define('BOX_FAQ_BLOG_COMMENTS', 'Blog FAQ\'s');
define('NAVBAR_TITLE_FAQ_DEFAULT', 'FAQ\'s');
define('BOX_RSS_FAQ', 'FAQ RSS Feed');
define('BOX_UPCOMING_FAQ', 'Verwachte FAQ\'s');

// general information manager
define('BOX_HEADING_G_INFO', 'Algemene Informatie');
define('BOX_ALL_G_INFO', 'Alle Algemene Informatie');
define('BOX_G_INFO_SUBMIT', 'Schrijf Algemene Informatie');
define('BOX_G_INFO_TOPICS', 'Alle Algemene Informatie Categorie&euml;n');
define('BOX_NEW_G_INFO', 'Nieuwe Algemene Informatie: ');
define('TEXT_G_INFO_SEARCH', 'Zoek Algemene Informatie');
define('TEXT_G_INFO_SEARCH_STRING', 'zoek info...');
define('TEXT_DISPLAY_NUMBER_OF_G_INFO', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> Algemene Informatie)');
define('TEXT_DISPLAY_NUMBER_OF_G_INFOS_NEW', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> nieuwe Algemene Informatie)');
define('TEXT_G_INFO', 'Hieronder is een lijst Algemene Informatie met de meest recente bovenaan geplaatst.');  
define('TABLE_HEADING_G_INFO_AUTHOR', 'Algemene Informatie Auteur');
define('TABLE_HEADING_G_INFO_ABSTRACT', 'Abstract');
define('TEXT_PXSELL_G_INFO', 'Gerelateerde Algemene Informatie');
define('BOX_HEADING_G_INFO_AUTHOR', 'Algemene Informatie van Auteur');
define('BOX_HEADING_G_INFO_AUTHORS', 'Algemene Informatie van Auteurs');
define('BOX_G_INFO_BLOG_COMMENTS', 'Blog Informatie');
define('NAVBAR_TITLE_G_INFO_DEFAULT', 'Algemene Informatie Artikels');
define('BOX_RSS_G_INFO', 'Algemene Informatie RSS Feed');
define('BOX_UPCOMING_G_INFO', 'Verwachte Algemene Informatie');

// testimonials manager
define('BOX_HEADING_CUSTOMER_TESTIMONIALS', 'Klanten Testimonials');
define('TABLE_HEADING_TESTIMONIALS_ID', 'ID');
define('TABLE_HEADING_TESTIMONIALS_NAME', 'Naam');
define('TABLE_HEADING_TESTIMONIALS_DESCRIPTION', 'Klanten Testimonial');
define('TEXT_READ_MORE', '(lees meer)');
define('TEXT_TESTIMONY_TITLE', 'Titel: ');
define('TEXT_TESTIMONY_BY', 'Testimonial van: ');
define('TEXT_TESTIMONY_DATE_ADDED', 'Datum Toegevoegd: ');
define('TEXT_TESTIMONY_OF', ' uit ');
define('TEXT_MAILTO', 'mailto:');
define('TEXT_EMAIL_AUTHOR', 'Klik om schrijver te mailen');
define('TEXT_TESTIMONIAL_BY', 'Geplaatst door');

// reference mananger
define('BOX_HEADING_REFERENCES', 'Bedrijfs Referentie');
define('TABLE_HEADING_REFERENCES_ID', 'ID');
define('TABLE_HEADING_REFERENCES_NAME', 'Naam');
define('TABLE_HEADING_REFERENCES_DESCRIPTION', 'Bedrijfs Referenties');
define('TEXT_READ_MORE', '(lees meer)');
define('TEXT_REFERENCES_TITLE', 'Titel: ');
define('TEXT_REFERENCES_BY', 'Referentie van: ');
define('TEXT_REFERENCES_DATE_ADDED', 'Datum Toegevoegd: ');
define('TEXT_REFERENCES_OF', ' uit ');
define('TEXT_MAILTO', 'mailto:');
define('TEXT_EMAIL_AUTHOR', 'Klik om schrijver te mailen');
define('TEXT_REFERENCES_BY', 'Geplaatst door');

// product listing enhanced
define('TABLE_HEADING_DETAIL', 'Klik voor meer');
define('TEXT_POA', '<span class="list_info">P.O.A<span>prijs op aanvraag</span></span>');
define('IMAGE_BUTTON_DETAILS', 'Product Details'); 
define('PRODUCT_ADDED', 'Product is succesvol aan de winkelwagen toegevoegd');
define('NUM_ORDER', ', Laag naar Hoog');
define('APHA_ORDER', '');
define('REVERSE_ALPHA_ORDER', ', Andersom');
define('REVERSE_NUM_ORDER', ', Hoog naar Laag');
define('DATE_ORDER', 'Datum Toegevoegd');
define('LIST_VIEW', 'Lijst Overzicht');
define('THUMB_VIEW', 'Thumbnail Overzicht');
define('WEIGHT_ABRV', 'Kg');
define('MULTI_ADD_ALT','Voeg de hele voorraad aan winkelwagen toe');
define('TEXT_QUANTITY','Aantal: ');
define('TEXT_STOCK', 'In Voorraad: ');
define('TEXT_WEIGHT', 'Gewicht: ');
define('MORE','1 meer ');
define('LESS','1 minder');

// points and rewards
define('BOX_INFORMATION_MY_POINTS_HELP', 'hier');
define('REDEEM_SYSTEM_ERROR_POINTS_NOT', 'Points value are not enough to cover the cost of your purchase. Please select another payment method');
define('REDEEM_SYSTEM_ERROR_POINTS_OVER', 'REDEEM POINTS ERROR ! Points value can not be over the total value. Please Re enter points');
define('REFERRAL_ERROR_SELF', 'Het is niet mogelijk om jezelf te verwijzen.');
define('REFERRAL_ERROR_NOT_VALID', 'The referral email does not appear to be valid - please make any necessary corrections.');
define('REFERRAL_ERROR_NOT_FOUND', 'The referral email address you entered was not found.');
define('TEXT_POINTS_BALANCE', 'Totaal Spaarpunten');
define('TEXT_POINTS', 'Spaarpunten: ');
define('TEXT_VALUE', 'Waarde: ');
define('REVIEW_HELP_LINK', ' Schijf een recensie over dit Product en u ontvangt <b>%s</b> aan spaarpunten.<br />Lees %s voor meer informatie.');

// store modus
define('CLOSED_MESSAGE', STORE_NAME . ' is tijdelijk <u>gesloten</u>. U kunt een ' . STORE_NAME . ' account aanmaken, inloggen op uw ' . STORE_NAME . ' account, en producten toevoegen aan uw winkelwagentje. De inhoud van uw winkelwagen word bewaard tot we weer online zijn en u uw bestelling kan afrekenen.<br><br>Verwachte openings datum: ');
define('OFFLINE_MESSAGE_1', 'Notice: ' . STORE_NAME . ' will be offline from '); // the message customers will see when the Offline Warning is enabled in the admin
define('OFFLINE_MESSAGE_2', ' to '); // conjunction for customer message
define('ADMIN_OFFLINE_MESSAGE', 'Reminder: ' . STORE_NAME . ' is currently offline for maintenance. Customers are expecting ' . STORE_NAME . ' to be online by '); // the message you (the administrator) will see in the catalog when the store is offline for maintenance

// must agree terms of conditions
define('MATC_CONDITION_AGREEMENT', 'Ik heb de <a href="%s" target="_blank"><strong><u>Algemene Voorwaarden</u></strong></a> gelezen en ga ermee akkoord: ');
define('MATC_HEADING_CONDITIONS', 'Algemene Voorwaarden');
define('MATC_ERROR', 'U moet akkoord gaan met onze algemene voorwaarden om door te kunnen gaan.');

// quantity price breaks
define('MINIMUM_ORDER_NOTICE', 'Minimum te besteden bedrag voor %s is %d. Uw winkelwagen is automatisch aangepast.');
define('QUANTITY_BLOCKS_NOTICE', '%s kan alleen per %d gekocht worden. Uw winkelwagen is automatisch aangepast.');

// quotes
define('BOX_INFORMATION_QUOTES', 'Citaten');
define('TEXT_QUOTES_ACTIVE', 'Actief');
define('TEXT_QUOTES_PAID', 'Betaald');
define('TEXT_QUOTES_EXPIRED', 'Verlopen');
define('TEXT_QUOTES_CUSTOMER', 'ID');
define('TEXT_QUOTES_DATE_ADDED', 'Datum Citaat');
define('TEXT_QUOTES_STATUS', 'Status');
define('TEXT_QUOTES_NEED_LOGIN', 'U moet <a class="quotesLink" href="' . tep_href_link(FILENAME_LOGIN, '', SSL) . '">inloggen</a> om uw citaten te bekijken.');
define('TEXT_QUOTES_NONE_FOUND', 'Er zijn geen citaten beschikbaar.');
define('TEXT_QUOTES_RESPONSE', 'Ons Citaat');
define('TEXT_REQUEST_A_QUOTE', 'Klik <a class="quotesLink" href="' . tep_href_link(FILENAME_REQUEST_A_QUOTE, '', 'NONSSL') . '">hier</a> om een citaat te plaatsen.');

// credit class gift vouchers
define('BOX_INFORMATION_GV', 'Gift Voucher FAQ');
define('VOUCHER_BALANCE', 'Account Saldo');
define('BOX_HEADING_GIFT_VOUCHER', 'Gift Voucher Account'); 
define('GV_FAQ', 'Gift Voucher FAQ');
define('ERROR_REDEEMED_AMOUNT', 'Uw kortingsbon is succesvol aan uw winkelwagen toegevoegd!');
define('ERROR_NO_REDEEM_CODE', 'You did not enter a redeem code.');  
define('ERROR_NO_INVALID_REDEEM_GV', 'Invalid Gift Voucher Code'); 
define('TABLE_HEADING_CREDIT', 'Kortingsbonnen');
define('GV_HAS_VOUCHERA', 'You have funds in your Gift Voucher Account. If you want <br>
                         you can send those funds by <a class="pageResults" href="');
       
define('GV_HAS_VOUCHERB', '"><b>email</b></a> to someone'); 
define('ENTRY_AMOUNT_CHECK_ERROR', 'You do not have enough funds to send this amount.'); 
define('BOX_SEND_TO_FRIEND', 'Verstuur saldo naar kennis');

define('VOUCHER_REDEEMED', 'Voucher Redeemed');
define('CART_COUPON', 'Coupon verzilverd: ');
define('CART_COUPON_INFO', 'meer info');

define('MODULE_ORDER_TOTAL_COUPON_TEXT_ERROR', 'Kortingsbon Verzilveren Informatie');
define('ERROR_NO_ACCOUNT_GV', 'You must sign in to your account to redeem a Gift Certificate');
//|| project modules_eof ||\\

//|| project hints ||\\
//create account hints
define('HINT_CREATE_ACCOUNT_NAME', 'Vul hier je voornaam in.');
define('HINT_CREATE_ACCOUNT_INSERTION_NAME', 'Vul hier je tussenvoegsels in.');
define('HINT_CREATE_ACCOUNT_LAST_NAME', 'Vul hier je achternaam in.');
define('HINT_CREATE_ACCOUNT_DATE_OF_BIRTH', 'Vul hier je geboorte datum in.');
define('HINT_CREATE_ACCOUNT_EMAIL', 'Vul hier je email adres in.');
define('HINT_CREATE_ACCOUNT_CONFIRM_EMAIL', 'Bevestig je email adres door het nogmaals in te vullen.');
define('HINT_CREATE_ACCOUNT_COMPANY', 'Vul hier je bedrijfsnaam in.');
define('HINT_CREATE_ACCOUNT_COMPANY_ID', 'Indien aanwezig uw klantnummer.');
define('HINT_CREATE_ACCOUNT_STREET_NAME', 'Vul hier je straatnaam in.');
define('HINT_CREATE_ACCOUNT_STREET_NUMBER', 'Vul hier je huisnummer in.');
define('HINT_CREATE_ACCOUNT_STREET_NUMBER_ADD', 'Vul hier je huisnummer toevoeging in.');
define('HINT_CREATE_ACCOUNT_SUBURB', 'Vul hier je wijk in.');
define('HINT_CREATE_ACCOUNT_POSTCODE', 'Vul hier je postcode in.');
define('HINT_CREATE_ACCOUNT_CITY', 'Vul hier je plaatsnaam in.');
define('HINT_CREATE_ACCOUNT_STATE', 'Vul hier je provincie in.');
define('HINT_CREATE_ACCOUNT_PHONE_NUMBER', 'Vul hier je telefoon nummer in.');
define('HINT_CREATE_ACCOUNT_FAX_NUMBER', 'Vul hier je fax nummer in.');
define('HINT_CREATE_ACCOUNT_REFERRAL', 'Vul hier in hoe je ons gevonden hebt.');
define('HINT_CREATE_ACCOUNT_PASSWORD', 'Vul hier je wachtwoord in (min '. ENTRY_PASSWORD_MIN_LENGTH .' letter/cijfer).');
define('HINT_CREATE_ACCOUNT_CONFIRM_PASSWORD', 'Bevestig je wachwoord door het nogmaals in te vullen.');
// affiliate create account hints
define('HINT_AFFILIATE_ACCOUNT_NAME', 'Vul hier uw affiliate voornaam in');
define('HINT_AFFILIATE_ACCOUNT_NAME_ERROR', 'Uw affiliate voornaam moet minimaal '. ENTRY_FIRST_NAME_MIN_LENGTH .' letters hebben');
define('HINT_AFFILIATE_ACCOUNT_INSERTION_NAME', 'Vul hier uw affiliate tussenvoegsels in.');
define('HINT_AFFILIATE_ACCOUNT_LAST_NAME', 'Vul hier uw affiliate achternaam in.');
define('HINT_AFFILIATE_ACCOUNT_LAST_NAME_ERROR', 'Uw affiliate achternaam moet minimaal '. ENTRY_LAST_NAME_MIN_LENGTH .' letters hebben.');
define('HINT_AFFILIATE_ACCOUNT_DATE_OF_BIRTH', 'Vul hier uw affiliate geboorte datum in.');
define('HINT_AFFILIATE_ACCOUNT_DATE_OF_BIRTH_ERROR', 'Uw affiliate geboorte datum moet in deze vologorde: MM/DD/YYYY (bv 05/21/1970)');
define('HINT_AFFILIATE_ACCOUNT_EMAIL', 'Vul hier uw affiliate email in.');
define('HINT_AFFILIATE_ACCOUNT_EMAIL_ERROR', 'Uw affiliate email Adres moet minimaal '. ENTRY_EMAIL_ADDRESS_MIN_LENGTH .' letters/cijfers hebben.');
define('HINT_AFFILIATE_ACCOUNT_EMAIL_CHECK_ERROR', 'Uw affiliate email adres klopt niet, kijkt u het aub nog een keer goed na.');
define('HINT_AFFILIATE_ACCOUNT_EMAIL_EXISTS_ERROR', 'Uw affiliate email adres is al bekend in onze affiliate database.');
define('HINT_AFFILIATE_ACCOUNT_CONFIRM_EMAIL', 'Bevestig uw affiliate email adres.');
define('HINT_AFFILIATE_ACCOUNT_CONFIRM_EMAIL_ERROR', 'Uw email adressen komen niet overeen met elkaar.');
define('HINT_AFFILIATE_ACCOUNT_COMPANY', 'Vul hier uw affiliate bedrijfsnaam in.');
define('HINT_AFFILIATE_ACCOUNT_TAX_ID', 'Vul hier je affiliate btw nummer in.');
define('HINT_AFFILIATE_ACCOUNT_PAYPAL', 'Vul hier je paypal account naam in.');
define('HINT_AFFILIATE_ACCOUNT_PAYPAL_MAIL', 'Vul hier je paypal account email in.');
define('HINT_AFFILIATE_ACCOUNT_BANK_NAME', 'Vul hier de naam van je bank in.');
define('HINT_AFFILIATE_ACCOUNT_BANK_IBAN', 'Vul hier je IBAN nummer in.');
define('HINT_AFFILIATE_ACCOUNT_BANK_SWIFT', 'Vul hier je SWIFT/BIC nummer in.');
define('HINT_AFFILIATE_ACCOUNT_BANK_CLIENT', 'Vul hier in op welke naam onderstaand rekening nummer staat.');
define('HINT_AFFILIATE_ACCOUNT_BANK_NUMBER', 'Vul hier je rekening nummer in.');
define('HINT_AFFILIATE_ACCOUNT_STREET_NAME', 'Vul hier je affiliate straatnaam in.');
define('HINT_AFFILIATE_ACCOUNT_STREET_NAME_ERROR', 'Uw straatnaam moet minimaal '. ENTRY_STREET_ADDRESS_MIN_LENGTH .' letters hebben.');
define('HINT_AFFILIATE_ACCOUNT_STREET_NUMBER', 'Vul hier je affiliate huisnummer in.');
define('HINT_AFFILIATE_ACCOUNT_STREET_NUMBER_ERROR', 'Vul hier je achternaam in.');
define('HINT_AFFILIATE_ACCOUNT_STREET_NUMBER_ADD', 'Vul hier je affiliate huisnummer toevoeging in.');
define('HINT_AFFILIATE_ACCOUNT_SUBURB', 'Vul hier je affiliate wijk in.');
define('HINT_AFFILIATE_ACCOUNT_SUBURB_ERROR', 'Uw wijk moet minimaal 2 letters hebben.');
define('HINT_AFFILIATE_ACCOUNT_POSTCODE', 'Vul hier je affiliate postcode in.');
define('HINT_AFFILIATE_ACCOUNT_POSTCODE_ERROR', 'Uw affiliate postcode moet minimaal '. ENTRY_POSTCODE_MIN_LENGTH .' letters hebben.');
define('HINT_AFFILIATE_ACCOUNT_CITY', 'Vul hier je affiliate stad in.');
define('HINT_AFFILIATE_ACCOUNT_CITY_ERROR', 'Uw affiliate stad moet minimaal '. ENTRY_CITY_MIN_LENGTH .' letters hebben.');
define('HINT_AFFILIATE_ACCOUNT_STATE', 'Vul hier je affiliate provincie in.');
define('HINT_AFFILIATE_ACCOUNT_STATE_ERROR', 'Uw provincie moet minimaal '. ENTRY_STATE_MIN_LENGTH .' letters hebben.');
define('HINT_AFFILIATE_ACCOUNT_PHONE_NUMBER', 'Vul hier je affiliate telefoon nummer in.');
define('HINT_AFFILIATE_ACCOUNT_PHONE_NUMBER_ERROR', 'Uw affiliate telefoon nummer moet minimaal '. ENTRY_TELEPHONE_MIN_LENGTH .' cijfers hebben.');
define('HINT_AFFILIATE_ACCOUNT_FAX_NUMBER', 'Vul hier je affiliate faxnummer in.');
define('HINT_AFFILIATE_ACCOUNT_HOMEPAGE', 'Vul hier je website in. (incl. http://)');
define('HINT_AFFILIATE_ACCOUNT_HOMEPAGE_ERROR', 'U moet nog uw homepage invullen.');
define('HINT_AFFILIATE_ACCOUNT_REFERRAL', 'Vul hier in hoe je ons gevonden heb.');
define('HINT_AFFILIATE_ACCOUNT_PASSWORD', 'Vul hier je wachtwoord in (min '. ENTRY_PASSWORD_MIN_LENGTH .' letter/cijfer).');
define('HINT_AFFILIATE_ACCOUNT_PASSWORD_ERROR', 'Uw wachtwoord moet minimaal ' . ENTRY_PASSWORD_MIN_LENGTH . ' letters/cijfers bevatten.');
define('HINT_AFFILIATE_ACCOUNT_CONFIRM_PASSWORD', 'Bevestig je wachtwoord door het nogmaals in te voeren.');
define('HINT_AFFILIATE_ACCOUNT_CONFIRM_PASSWORD_ERROR', 'Vul hier je achternaam in.');
define('', '');
//|| project hints_eof ||\\

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Leveringsadres');
define('CHECKOUT_BAR_PAYMENT', 'Betalingswijze');
define('CHECKOUT_BAR_CONFIRMATION', 'Bevestiging');
define('CHECKOUT_BAR_FINISHED', 'Gereed!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selecteer');
define('PULL_DOWN_OTHER', 'anders - (specificeer)');
define('TYPE_BELOW', 'Vul in hieronder');

// in out stock images
define('TEXT_SOLDOUT', 'Niet op Voorraad');
define('TEXT_SOLDOUT_1', 'Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u <br>geïnteresseerd bent in dit product.');
define('TEXT_STOCK_1', 'Nog 1 op Voorraad');
define('TEXT_INSTOCK_1', 'Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u <br>er meer dan <b>1</b> nodig heeft.');
define('TEXT_STOCK_2', 'Nog 2 op Voorraad');
define('TEXT_INSTOCK_2', 'Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u <br>er meer dan <b>2</b> nodig heeft.');
define('TEXT_STOCK_3', 'Nog 3 op Voorraad');
define('TEXT_INSTOCK_3', 'Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u <br>er meer dan <b>3</b> nodig heeft.');
define('TEXT_STOCK_4', 'Nog 4 op Voorraad');
define('TEXT_INSTOCK_4', 'Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u <br>er meer dan <b>4</b> nodig heeft.');
define('TEXT_STOCK_5', 'Nog 5 op Voorraad');
define('TEXT_INSTOCK_5', 'Neem <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> met ons op wanneer u <br>er meer dan <b>5</b> nodig heeft.');
define('TEXT_STOCK_6', 'Nog 6 op Voorraad');
define('TEXT_INSTOCK_6', 'Nog <b>6</b> op Voorraad');
define('TEXT_STOCK_7', 'Nog 7 op Voorraad');
define('TEXT_INSTOCK_7', 'Nog <b>7</b> op Voorraad');
define('TEXT_STOCK_8', 'Nog 8 op Voorraad');
define('TEXT_INSTOCK_8', 'Nog <b>8</b> op Voorraad');
define('TEXT_STOCK_9', 'Nog 9 op Voorraad');
define('TEXT_INSTOCK_9', 'Nog <b>9</b> op Voorraad');
define('TEXT_STOCK_10', 'Nog 10 op Voorraad');
define('TEXT_INSTOCK_10', 'Nog <b>10</b> op Voorraad');
define('TEXT_STOCK_11', 'Nog 11 op Voorraad');
define('TEXT_INSTOCK_11', 'Nog <b>11</b> op Voorraad');
define('TEXT_STOCK_12', 'Nog 12 op Voorraad');
define('TEXT_INSTOCK_12', 'Nog <b>12</b> op Voorraad');
define('TEXT_STOCK_13', 'Nog 13 op Voorraad');
define('TEXT_INSTOCK_13', 'Nog <b>13</b> op Voorraad');
define('TEXT_STOCK_14', 'Nog 14 op Voorraad');
define('TEXT_INSTOCK_14', 'Nog <b>14</b> op Voorraad');
define('TEXT_STOCK_15', 'Nog 15 op Voorraad');
define('TEXT_INSTOCK_15', 'Nog <b>15</b> op Voorraad');
define('TEXT_STOCK_16', 'Nog 16 op Voorraad');
define('TEXT_INSTOCK_16', 'Nog <b>16</b> op Voorraad');
define('TEXT_STOCK_17', 'Nog 17 op Voorraad');
define('TEXT_INSTOCK_17', 'Nog <b>17</b> op Voorraad');
define('TEXT_STOCK_18', 'Nog 18 op Voorraad');
define('TEXT_INSTOCK_18', 'Nog <b>18</b> op Voorraad');
define('TEXT_STOCK_19', 'Nog 19 op Voorraad');
define('TEXT_INSTOCK_19', 'Nog <b>19</b> op Voorraad');
define('TEXT_STOCK_20', 'Nog 20 op Voorraad');
define('TEXT_INSTOCK_20', 'Nog <b>20</b> op Voorraad');
define('TEXT_STOCK_21', 'Nog 21 op Voorraad');
define('TEXT_INSTOCK_21', 'Nog <b>21</b> op Voorraad');
define('TEXT_STOCK_22', 'Nog 22 op Voorraad');
define('TEXT_INSTOCK_22', 'Nog <b>22</b> op Voorraad');
define('TEXT_STOCK_23', 'Nog 23 op Voorraad');
define('TEXT_INSTOCK_23', 'Nog <b>23</b> op Voorraad');
define('TEXT_STOCK_24', 'Nog 24 op Voorraad');
define('TEXT_INSTOCK_24', 'Nog <b>24</b> op Voorraad');
define('TEXT_STOCK_25', 'Nog 25 op Voorraad');
define('TEXT_INSTOCK_25', 'Nog <b>25</b> op Voorraad');
define('TEXT_STOCK_0', 'Nog meer dan 25 op Voorraad');
define('TEXT_INSTOCK_0', 'Nog meer dan <b>25</b> op voorraad.');

// javascript messages
define('JS_ERROR', 'Er zijn fouten opgetreden tijdens het verwerken van uw formulier!\nMaak de volgende aanpassingen:\n\n');
define('JS_REVIEW_TEXT', '* De tekst van de recensie moet minstens ' . REVIEW_TEXT_MIN_LENGTH . ' karakters lang zijn.\n');
define('JS_REVIEW_RATING', '* U dient het Product een puntenwaardering te geven.\n');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Selecteer een betalingswijze.\n');
define('JS_ERROR_SUBMITTED', 'Dit formulier is al verstuurt. Drukt u aub op OK en wacht tot het proces is afgerond.');
define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Selecteer aub een betalingswijze voor uw bestelling.');

// create account categories
define('CATEGORY_COMPANY', 'Bedrijfs gegevens');
define('CATEGORY_PERSONAL', 'Uw persoonlijke Details');
define('CATEGORY_ADDRESS', 'Uw Adres');
define('CATEGORY_CONTACT', 'Uw contact informatie');
define('CATEGORY_OPTIONS', 'Opties');
define('CATEGORY_SOURCE', 'Ons Gevonden Via');
define('CATEGORY_PASSWORD', 'Uw wachtwoord ');

// create account entries
define('ENTRY_COMPANY', 'Bedrijfs naam:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_ERROR', 'Foute bedrijfs naam');
define('ENTRY_COMPANY_TAX_ID', 'b.t.w. of klantnummer');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_GENDER', 'Geslacht:');
define('ENTRY_GENDER_ERROR', 'Selcteer aub uw Geslacht.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Voornaam:');
define('ENTRY_FIRST_NAME_ERROR', 'Uw voornaam moet minimaal ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letters hebben.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_INSERTION_NAME', 'tussenvoegsel:');
define('ENTRY_INSERTION_NAME_TEXT', '');
define('ENTRY_LAST_NAME', 'Achternaam:');
define('ENTRY_LAST_NAME_ERROR', 'Uw achternaam moet minimaal ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letters hebben.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geboorte Datum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Uw geboorte datum moet in deze vologorde: MM/DD/YYYY (bv 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (bv. 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adres:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Uw Email Adres moet minimaal ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letters hebben/cijfers.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Uw Email adres klopt niet, kijkt u het aub nog een keer goed na.');
define('ENTRY_CONFIRM_EMAIL_ADDRESS', 'Bevestig e-mail adres:');
define('ENTRY_CONFIRM_EMAIL_ADDRESS_CHECK_ERROR', 'De e-mail adressen komen niet overeen!');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Uw email adres is al bij ons bekend, logt u aub in met uw email adres waarmee u zich bij ons heeft ingeschreven.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Straat:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Uw straat naam moet minimaal ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letters hebben.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_STREET_NO', 'Huisnummer:');
define('ENTRY_STREET_NO_ERROR', 'Uw huisnummer moet minimaal ' . ENTRY_STREET_NO_MIN_LENGTH . ' teken lang zijn.');
define('ENTRY_STREET_NO_TEXT', '*');
define('ENTRY_STREET_NO_ADD', 'Toevoeging:');
define('ENTRY_STREET_NO_ADD_TEXT', '');
define('ENTRY_SUBURB', 'Wijk:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postcode:');
define('ENTRY_POST_CODE_ERROR', 'Uw postcode moet minimaal ' . ENTRY_POSTCODE_MIN_LENGTH . ' letters hebben.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Stad:');
define('ENTRY_CITY_ERROR', 'Uw stad moet minimaal ' . ENTRY_CITY_MIN_LENGTH . ' letters hebben.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Provincie:');
define('ENTRY_STATE_ERROR', 'Uw Provincie moet minimaal ' . ENTRY_STATE_MIN_LENGTH . ' letters hebben.');
define('ENTRY_STATE_ERROR_SELECT', 'Selecteer aub een Provincie uit het uitrekbaar menu.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'U moet een land selecteren uit het, uitrekbaar menu.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefoonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Uw telefoonnummer moet minimaal ' . ENTRY_TELEPHONE_MIN_LENGTH . ' cijfers hebben.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax Nummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Nieuwsbrief:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Abonneer');
define('ENTRY_NEWSLETTER_NO', 'Afmelden');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Wachtwoord:');
define('ENTRY_PASSWORD_ERROR', 'Uw wachtwoord moet minimaal ' . ENTRY_PASSWORD_MIN_LENGTH . ' letters/cijfers bevatten.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'U wachtwoordden moeten overeenkomen.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Wachtwoord Bevestiging:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Huidig Wachtwoord:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Uw wachtwoord moet minimaal ' . ENTRY_PASSWORD_MIN_LENGTH . ' letters/cijfers bevatten.');
define('ENTRY_PASSWORD_NEW', 'Nieuw Wachtwoord:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Uw wachtwoord moet minimaal ' . ENTRY_PASSWORD_MIN_LENGTH . ' letters/cijfers bevatten.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'De wachtwoord bevestiging moet overeenkomen met uw nieuwe wachtwoord.');
define('PASSWORD_HIDDEN', '--verborgen--');
define('ENTRY_SOURCE', 'Hoe heeft u ons gevonden:');
define('ENTRY_SOURCE_ERROR', 'U moet nog selecteren hoe u ons gevonden heeft.');
define('ENTRY_SOURCE_OTHER', '(vul in als anders)');
define('ENTRY_SOURCE_OTHER_ERROR', 'U moet nog invullen hoe u ons gevonden heeft.');
if (REFERRAL_REQUIRED == 'true') {
  define('ENTRY_SOURCE_TEXT', '*');
  define('ENTRY_SOURCE_OTHER_TEXT', '*');
} else {
  define('ENTRY_SOURCE_TEXT', '');
  define('ENTRY_SOURCE_OTHER_TEXT', '');
}
define('FORM_REQUIRED_INFORMATION', '* 	Vereiste informatie');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Aantal Pagina\'s:');
define('TEXT_SHOW_MORE', '(<u>lees&nbsp;meer</u>)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'product <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> producten)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'bestelling <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> bestellingen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'recensie <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> recensies)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'product <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> nieuwe producten)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'aanbieding <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> aanbiedingen)');
define('TEXT_DISPLAY_NUMBER_OF_FREE_DOWNLOADS', 'download <b>%d</b> tot en met <b>%d</b> (van <b>%d</b> gratis downloads)');
define('TEXT_PAGE', 'Pagina ');
define('TEXT_PAGE_OF', ' van ');
define('TEXT_PAGE_START', ' (begin) ');
define('PREVNEXT_TITLE_FIRST_PAGE', 'Eerste pagina');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorige Pagina');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Volgende Pagina');
define('PREVNEXT_TITLE_LAST_PAGE', 'Laatste Pagina');
define('PREVNEXT_TITLE_PAGE_NO', 'Pagina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorige Set van %d Pagina\'s');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Volgende Set van %d Pagina\'s');
define('PREVNEXT_BUTTON_FIRST', '<<EERSTE');
define('PREVNEXT_BUTTON_PREV', '[<< Vorige]');
define('PREVNEXT_BUTTON_NEXT', '[Volgende >>]');
define('PREVNEXT_BUTTON_LAST', 'LAATSTE>>');

// button image text
define('IMAGE_BUTTON_ACTIVATE_ACCOUNT', 'Activeer Account');
define('IMAGE_BUTTON_ADD_ADDRESS', ' Adres toevoegen');
define('IMAGE_BUTTON_ADD_NOW', 'Voeg Toe');
define('IMAGE_BUTTON_ADD_PRESENT', 'Voeg Kado Toe');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adressenboek');
define('IMAGE_BUTTON_ADVANCED_SEARCH', 'Uitgebreid Zoeken');
define('IMAGE_BUTTON_AFFILIATE_BANNERS', 'Affiliate Banners');
define('IMAGE_BUTTON_AFFILIATE_BUILD_A_LI', 'Affiliate Bouw');
define('IMAGE_BUTTON_AFFILIATE_BUILD_A_LINK', 'Affiliate Bouw een Link');
define('IMAGE_BUTTON_AFFILIATE_CLICKTHROUGHS', 'Affiliate Doorkliks');
define('IMAGE_BUTTON_AFFILIATE_JOIN', 'Affiliate Aanmelden');
define('IMAGE_BUTTON_AFFILIATE_PAYMENT', 'Affiliate Betalingen');
define('IMAGE_BUTTON_AFFILIATE_PRODUCT', 'Affiliate Producten');
define('IMAGE_BUTTON_AFFILIATE_SALES', 'Affiliate Verkopen');
define('IMAGE_BUTTON_AFFILIATE_TEXT', 'Affiliate Tekst');
define('IMAGE_BUTTON_BACK', 'Terug');
define('IMAGE_BUTTON_BUY_NOW', 'Koop Nu');
define('IMAGE_BUTTON_BUY_ALSO', 'Ook nog kopen');
define('IMAGE_BUTTON_CATEGORIES', 'Categori&euml;n');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Verander Adres');
define('IMAGE_BUTTON_CHECKOUT', 'Afrekenen');
define('IMAGE_BUTTON_CONFIRM', 'Bevestig');
define('IMAGE_BUTTON_CONFIRM_COUPON', 'Bevestig Account');
define('IMAGE_BUTTON_CONFIRM_CREATE_ACCOUNT', 'Bevestig Aanmaken Account');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Bevestig bestelling');
define('IMAGE_BUTTON_CONFIRM_QUESTION', 'Bevestig Vraag');
define('IMAGE_BUTTON_CONFIRM_REQUEST', 'Bevestig Aanvraag');
define('IMAGE_BUTTON_CONFIRM_RETOUR_REQUEST', 'Bevestig Retour Aanvraag');
define('IMAGE_BUTTON_CONTINUE', 'Ga verder');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Verder winkelen');
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Account Aanmaken');
define('IMAGE_BUTTON_DELETE', 'Verwijder');
define('IMAGE_BUTTON_DELETE_WISHLIST', 'Verwijder uit Wenslijst');
define('IMAGE_BUTTON_DOWNLOAD', 'Download');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Account aanpassen');
define('IMAGE_BUTTON_HISTORY', 'Bestel Geschiedenis');
define('IMAGE_BUTTON_LOGIN', 'Inloggen');
define('IMAGE_BUTTON_LOGOFF', 'Uitloggen');
define('IMAGE_BUTTON_MORE', 'meer...');
define('IMAGE_BUTTON_MORE_INFO', 'meer info...');
define('IMAGE_BUTTON_NEXT', 'Volgende');
define('IMAGE_BUTTON_IN_CART', 'In Winkelwagen');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificaties');
define('IMAGE_BUTTON_ORDER_HISTORY', 'Bestel geschiedenis');
define('IMAGE_BUTTON_OUT_OF_STOCK', 'Niet op Voorraad');
define('IMAGE_BUTTON_PRINT_ORDER', 'Afdrukken Factuur');
define('IMAGE_BUTTON_PRODUCT_INFO', 'Product Informatie');
define('IMAGE_BUTTON_QUICK_FIND', 'Snel Zoeken');
define('IMAGE_BUTTON_REACTIONS', 'Reacties');
define('IMAGE_BUTTON_REDEEM', 'Verzilveren');
define('IMAGE_BUTTON_REGISTER', 'Registreer');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Verwijder Notificaties');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Verwijder Product uit Winkelwagen');
define('IMAGE_BUTTON_RESPONSE', 'Reageer');
define('IMAGE_BUTTON_REVIEWS', 'Recensies');
define('IMAGE_BUTTON_REQUEST_QUOTE', 'Verstuur Citaat');
define('IMAGE_BUTTON_SEARCH', 'Zoek');
define('IMAGE_BUTTON_SEARCH_URL', 'Zoek Link');
define('IMAGE_BUTTON_SEND', 'Verstuur');
define('IMAGE_BUTTON_SEND_COMMENT', 'Verstuur Reactie');
define('IMAGE_BUTTON_SEND_LINK', 'Verstuur Link');
define('IMAGE_BUTTON_SEND_MESSAGE', 'Verstuur Bericht');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Leveringsopties');
define('IMAGE_BUTTON_SHOW_CART', 'Naar Winkelwagen');
define('IMAGE_BUTTON_SOLD_OUT', 'Uitverkocht');
define('IMAGE_BUTTON_SORT_PRODUCTS', 'Sorteer Producten');
define('IMAGE_BUTTON_SUBMIT', 'Verstuur naar ' . STORE_NAME);
define('IMAGE_BUTTON_SUBMIT_LINK', 'Verstuur link naar ' . STORE_NAME);
define('IMAGE_BUTTON_SUBMIT_TESTIMONIAL', 'Verstuur testimonial naar ' . STORE_NAME);
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Vertel verder');
define('IMAGE_BUTTON_UNSUBSCRIBE', 'Uitschrijven Nieuwsbrief');
define('IMAGE_BUTTON_UPDATE', 'Aanpassen');
define('IMAGE_BUTTON_UPDATE_CART', 'Aanpassen Winkelwagen');
define('IMAGE_BUTTON_VIEW', 'Bekijk');
define('IMAGE_BUTTON_WRITE_REFERENCES', 'Schrijf een Referentie');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Schrijf een Recensie');
define('IMAGE_BUTTON_WRITE_TESTIMONIAL', 'Schrijf een Testimonial');
define('IMAGE_BUTTON_WISHLIST', 'Zet in mijn Wenslijstje');

// small button image text
define('IMAGE_BUTTON_SMALL_BUY_NOW', 'Koop Nu');
define('IMAGE_BUTTON_SMALL_DELETE', 'Verwijder');
define('IMAGE_BUTTON_SMALL_EDIT', 'Bewerk');
define('IMAGE_BUTTON_SMALL_IN_CART', 'In Winkelwagen');
define('IMAGE_BUTTON_SMALL_OUT_OF_STOCK', 'Niet op Voorraad');
define('IMAGE_BUTTON_SMALL_SEARCH', 'Zoeken');
define('IMAGE_BUTTON_SMALL_SOLD_OUT', 'Uitverkocht');
define('IMAGE_BUTTON_SMALL_UPDATE_CART', 'Aanpassen  Winkelwagen');
define('IMAGE_BUTTON_SMALL_VIEW', 'Bekijk');

// icon image text
define('ICON_ARROW_RIGHT', 'meer');
define('ICON_CART', 'In winkelwagen');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Succes');
define('ICON_WARNING', 'Opgelet');

// index default greeting text
define('TEXT_GREETING_PERSONAL', 'Welkom terug, <span class="greetUser">%s!</span> Zou u graag willen zien welke  <a href="%s"><u>nieuwe Producten</u></a> beschikbaar zijn?<br>');
define('TEXT_GREETING_PERSONAL_BOX', 'Welkom terug, <span class="greetUser">%s</span><br>');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Indien U %s niet bent, gelieve <a href="%s"><u>uzelf in te loggen</u></a> met uw eigen informatie.</small>');
define('TEXT_GREETING_GUEST', 'Welkom <span class="greetUser">Gast!</span> Wilt u <a href="%s"><u>inloggen</u></a>? of wilt u een <a href="%s"><u>nieuw account</u></a> aanmaken?');
define('TEXT_GREETING_PRICES', 'U kunt alleen prijzen zien indien u bent ingelogd!');

// sort products
define('TEXT_SORT_PRODUCTS', 'Schik Producten ');
define('TEXT_DESCENDINGLY', 'Beginnend bovenaan');
define('TEXT_ASCENDINGLY', 'Beginnend onderaan');
define('TEXT_BY', ' van ');
define('TEXT_SEE_MORE', 'meer');

// review system
define('TEXT_REVIEW_BY', 'van %s');
define('TEXT_REVIEW_WORD_COUNT', '%s woorden');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Datum Plaatsing: %s');
define('TEXT_NO_REVIEWS', '<center><b>Ben jij de eerste die een recensie schrijft?</center></b>');
define('TEXT_NO_NEW_PRODUCTS', '<center><b>Er zijn momenteel geen Producten aanwezig.</b></center>');
define('TEXT_UNKNOWN_TAX_RATE', 'Onbekende tax voet');
define('TEXT_REQUIRED', '<span class="errorText">* verplicht</span>');
define('TEXT_LOG_IN_TO_SEE_PRICE', 'Log in voor prijs!');
define('TEXT_ERROR', '<span class="errorText">* fout</span>');

// project errors
define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> Kan geen email versturen met de huidige SMTP Server. Bekijk aub uw PHP.ini en verander het zo dat ik dat wel kan.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', '<font color=red><b>Opgelet!</b></font> De instalatie map is nog aanwezig.&nbsp;&nbsp; Locatie: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. <br><center><b>Verwijder deze map nu van de server!</center></b>');
define('WARNING_CONFIG_FILE_WRITEABLE', '<font color=red><b>Opgelet!</b></font> De configure.php file(s) zijn nog beschrijfbaar.&nbsp;&nbsp; Locatie: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. <br><center><b>Verander nu de bestandsrechten naar "alleen lezen" (644)!</center></b>');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', '<font color=red><b>Opgelet!</b></font> De sessie map bestaat niet: ' . tep_session_save_path() . '. Sessie zullen pas gaan werken wanner u deze map aanmaakt.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', '<font color=red><b>Opgelet!</b></font> Ik kan niet in de sessie map schrijven: ' . tep_session_save_path() . '. Sessie zullen niet werken zolang u dit niet veranderd.');
define('WARNING_SESSION_AUTO_START', '<font color=red><b>Opgelet!</b></font> session.auto_start is geactiveerd - zet deze functie uit in uw PHP.ini file.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', '<font color=red><b>Opgelet!</b></font> De download map bestaat niet: ' . DIR_FS_DOWNLOAD . '. Downloads zullen niet werken, zolang de map er niet is.');

// credit card errors
define('TEXT_CCVAL_ERROR_INVALID_DATE', 'De verloop datum van uw credit kaart is niet goed, bekijk de datum en verander hem aub.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Uw credit kaart nummer is niet goed, verbeter hem aub.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'De eerste vier getallen van het nummer zijn: %s. Als het nummer klopt, dan acepteren wij uw credit kaart niet, klopt het nummer niet verander het numer aub.');

// footer text
define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="http://' . STORE_URL . '" target="_blank">' . PROJECT_VERSION . '</a><br>Based on <a href="http://www.oscommerce.com" target="_blank">osCommerce</a> :: Hosted by <a href="http://www.hilvy.nl" target="_blank">HILVY</a>');

//require(DIR_WS_LANGUAGES . 'mail_dutch.php');
?>
