<?php //$Id: /catalog/admin/includes/languages/english.php (osC)

// Define the project version
  define('PROJECT_VERSION', 'Current Version:<br>osShoppy&nbsp;v2.0&nbsp;Beta');
  define('PROJECT_VERSION_UPDATE', 'Update Available:');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
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
define('TITLE', 'Administration Panel off ' . STORE_NAME . '');

// header text in includes/header.php
define('HEADER_TITLE_ADMINISTRATION', 'Administration');
define('HEADER_TITLE_ACCOUNT', 'My Administration Account');
define('HEADER_TITLE_LOGOFF_ADMIN', 'Logg Off');
define('TEXT_INFO_GROUP', '<b>Administration group: </b>');

//header icons in includes/header.php
define('HEADER_LIVE_SUPPORT', 'Online Support');
define('HEADER_FORUM', 'Forum');
define('HEADER_ORDER', 'Order');
define('HEADER_RETURN_ARTICLE', 'Return Product');
define('HEADER_CUSTOMERS', 'Customers');
define('HEADER_SEND_MAIL', 'Send e-mail');
define('HEADER_POINTS', 'Shopping Points');
define('HEADER_ACCOUNT_SALDO', 'Account Balance');
define('HEADER_MANUAL_INDEX', 'osShoppy Manual');
define('HEADER_TO_SHOP', 'To Webshop');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');

// text yes no
define('TEXT_YES', 'Yes');
define('TEXT_NO', 'No');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// text for _banned.php
define('HEADING_TITLE_BANNED', 'Give a Guest or Customer an IP ban');
define('TEXT_ADD_IP', 'Add IP Address: ');
define('TEXT_IP_ADDRESS', 'IP Addresses');
define('TEXT_REMOVE_IP', ' (tick one, then press Update to remove)');

//-1 administrators_top box text in includes/boxes/administrators_top.php
define('BOX_HEADING_ADMIN_TOP', 'Top Admin');
define('BOX_ADMIN_TOP_MEMBERS', 'Administration Members');
define('BOX_ADMIN_TOP_BOXES', 'File Acces');
define('BOX_ADMIN_TOP_NOTES', 'Admin Notes Top');
define('BOX_ADMIN_TOP_CONFIGURATION_CHANGES', 'Configuration Changes');
define('BOX_ADMIN_TOP_CONTRIBUTION_TRACKER', 'Installed Add-Ons');
//-1.1 admin config submenu box text in includes/boxes/administrators_top.php
define('BOX_ADMIN_TOP_HEADING_ADMIN_CONFIG', 'Admin Configuration');
define('BOX_ADMIN_TOP_ADMIN_INDEX', 'Admin Index Edit');
define('BOX_ADMIN_TOP_WYSIWYG_CONFIG', 'WYSIWYG Editor');
define('BOX_ADMIN_TOP_PRICE_BREAK', 'Price Breaks');
define('BOX_ADMIN_TOP_OTHER_CONFIG', 'Other Configurations');
//-1.2 admin base config submenu box text in includes/boxes/administrators_top.php
define('BOX_ADMIN_TOP_HEADING_BASE_CONFIG', 'Base Configuration');
define('BOX_ADMIN_TOP_MY_STORE', 'My Store');
define('BOX_ADMIN_TOP_STORE_MODE', 'Store Status');
define('BOX_ADMIN_TOP_CONTACT_US', 'Contact Form');
define('BOX_ADMIN_TOP_CUSTOMER', 'Registration Form');
define('BOX_ADMIN_TOP_ANTI_ROBOT', 'Anti Robot Registration');
define('BOX_ADMIN_TOP_MATC', 'Terms of Condition');
define('BOX_ADMIN_TOP_MIN_VALUES', 'Minimum Values');
define('BOX_ADMIN_TOP_MAX_VALUES', 'Maximum Values');
define('BOX_ADMIN_TOP_IMAGES', 'Images');
define('BOX_ADMIN_TOP_THUMBS', 'On the Fly Thumbs');
define('BOX_ADMIN_TOP_SEO_URLS', 'Search Engine Optimalisation');
define('BOX_ADMIN_TOP_MODULES', 'Module Options');
define('BOX_ADMIN_TOP_PACKAGING', 'Shipping/Packaging');
define('BOX_ADMIN_TOP_PRODUCT_LISTING', 'Product Listing');
define('BOX_ADMIN_TOP_STOCK', 'Stock');
define('BOX_ADMIN_TOP_LOGGING', 'Logging');
define('BOX_ADMIN_TOP_CACHE', 'Cache');
define('BOX_ADMIN_TOP_EMAIL', 'E-mail Options');
define('BOX_ADMIN_TOP_DOWNLOAD', 'Download');
define('BOX_ADMIN_TOP_GZIP', 'Gzip Compressie');
define('BOX_ADMIN_TOP_SESSIONS', 'My Store');

//-2 administrators_mid box text in includes/boxes/administrators_mid.php
define('BOX_HEADING_ADMIN_MID', 'Mid Admin');
define('BOX_ADMIN_MID_NOTES', 'Admin Notes Mid');

//-3 administrators_low box text in includes/boxes/administrators_low.php
define('BOX_HEADING_ADMIN_LOW', 'Low Admin');
define('BOX_ADMIN_LOW_NOTES', 'Admin Notes Low');

//-4 categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Products Attributes');
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers');
define('BOX_CATALOG_REVIEWS', 'Reviews');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Products Expected');
//-4.1 stock submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categories/Products');
define('BOX_CATALOG_CATEGORIES_IMAGES_PRODUCTS', 'Product Images');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_CONFIG', 'Catalog Configuration');
//-4.2 stock submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_STOCK', 'Stock');
define('BOX_CATALOG_STOCK_PRODUCTS_ACTIVE', 'Stock Active');
define('BOX_CATALOG_STOCK_PRODUCTS_INACTIVE', 'Stock Inactive');
define('BOX_CATALOG_STOCK_LOW_STOCK', 'Stock Level Low');
define('BOX_CATALOG_STOCK_STATS_LOW_STOCK_ATTRIB', 'Stock Attributes Low');
define('BOX_CATALOG_STOCK_QTPRO_DOCTOR', 'Stock Attributes Database Error');
define('BOX_CATALOG_STOCK_PRODUCTS_EXCEL', 'Stock Excell');
define('BOX_CATALOG_STOCK_PRODUCTS_UPDATE', 'Stock Price Update');
define('BOX_CATALOG_STOCK_PRODUCTS_MULTI', 'Stock Update');
//-4.3 modules submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES', 'Modules');
define('BOX_CATALOG_MODULES_GET_1_FREE', 'Get 1 Free');
define('BOX_CATALOG_MODULES_SPECIALS', 'Specials');
define('BOX_CATALOG_MODULES_FEATURED_PRODUCTS', 'Featured Products');
//-4.4 discount categories submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_DISCOUNT_CATEGORIES', 'Discount Groups');
define('BOX_CATALOG_MODULES_CREATE_DISCOUNT_CATEGORIES', 'Create Discount Groups');
define('BOX_CATALOG_MODULES_DISCOUNT_CATEGORIES_CONFIG', 'Discount Groups Configuration');
//-4.5 related products submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_RELATED_PRODUCTS', 'Related Products');
define('BOX_CATALOG_MODULES_RELATED_PRODUCTS', 'Related Products Overview');
define('BOX_CATALOG_MODULES_RELATED_PRODUCTS_CONFIG', 'Related Products Configuration');
//-4.6 dangling carrot submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_CARROT', 'Gift');
define('BOX_CATALOG_MODULES_CARROT', 'Gift Overview');
define('BOX_CATALOG_MODULES_CARROT_CONFIG', 'Gift Configuration');
//-4.7 2 gether discount submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_MODULES_2GETHER', '2 Gether Discount');
define('BOX_CATALOG_MODULES_2GETHER', '2 Gether Discount Overview');
define('BOX_CATALOG_MODULES_2GETHER_CONFIG', '2 Gether Discount Configuration');

//-5 customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers');
//-5.1 overview submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_CUSTOMERS', 'Customers Overview');
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_ALL_CUSTOMERS', 'All Customers');
define('BOX_CUSTOMERS_CREATE_ACCOUNT', 'Create Customer Account');
//-5.2 orders submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_ORDERS', 'Orders');
define('BOX_CUSTOMERS_ORDERS', 'Order Overview');
define('BOX_CUSTOMERS_CREATE_ORDER', 'Create Customer Order');
define('BOX_CUSTOMERS_ORDER_CONFIGURATION', 'Order Configuration');
//-5.3 returns submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_RETURNS', 'Customers Returns');
define('BOX_CUSTOMERS_RETURNS_MAIN', 'Returned Products');
define('BOX_CUSTOMERS_RETURNS_REASONS', 'Return Reason');
define('BOX_CUSTOMERS_REFUNDS', 'Refund Methods');
define('BOX_CUSTOMERS_RETURNS_STATUS', 'Returns Status');
define('BOX_CUSTOMERS_RETURNS_TEXT', 'Return Text Edit');
define('BOX_CUSTOMERS_RETURN_CONFIGURATION', 'Return Configuration');
//-5.4 points submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_POINTS', 'Customers Points');
define('BOX_CUSTOMERS_POINTS', 'Customers Points');
define('BOX_CUSTOMERS_POINTS_PENDING', 'Pending Points');
define('BOX_CUSTOMERS_POINTS_REFERRAL', 'Referral Points');
define('BOX_CUSTOMERS_POINT_CONFIGURATION', 'Points Configuration');
//-5.5 coupons and gift voucher submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_GV_ADMIN', 'Cust. Coupons &amp; Balance');
define('BOX_CUSTOMERS_COUPON_ADMIN', 'Coupon Admin');
define('BOX_CUSTOMERS_GV_ADMIN_QUEUE', 'Gift Voucher Credits');
define('BOX_CUSTOMERS_STATS_CREDITS', 'Account Balance');
define('BOX_CUSTOMERS_GV_ADMIN_MAIL', 'Mail Gift Voucher');
define('BOX_CUSTOMERS_GV_ADMIN_SENT', 'Gift Vouchers Sent');
define('BOX_CUSTOMERS_COUPON_CONFIGURATION', 'Coupon Configuration');
//-5.6 report submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_REPORTS', 'Customers Reports');
define('BOX_CUSTOMERS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_CUSTOMERS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_CUSTOMERS_WHOS_ONLINE', 'Who\'s Online');
define('BOX_CUSTOMERS_SUPERTRACKER', 'Customers Behaviour');
define('BOX_CUSTOMERS_REFERRAL_SOURCES', 'Refferal Sources');
define('BOX_CUSTOMERS_ORDERS_TOTAL', 'Customers Orders Total');
//-5.7 email submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_CONFIG_EMAIL', 'Customers Mail');
define('BOX_CUSTOMERS_MAIL', 'Send Email');
define('BOX_CUSTOMERS_NEWSLETTER_MANAGER', 'Send Newsletter');
define('BOX_CUSTOMERS_PRODUCTS_NOTIFICATIONS', 'Product Notification Manager');
define('BOX_CUSTOMERS_STATS_PRODUCTS_NOTIFICATIONS', 'Product Notifications Stats');
//-5.8 tickets submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_TICKETS', 'Support Tickets');
define('BOX_CUSTOMERS_TICKETS_VIEW', 'Support Tickets View');
define('BOX_CUSTOMERS_TICKETS_REPLY', 'Support Tickets Reply');
define('BOX_CUSTOMERS_TICKETS_ADMIN', 'Support Tickets Admin');
define('BOX_CUSTOMERS_TICKETS_DEPARTMENT', 'Support Tickets Department');
define('BOX_CUSTOMERS_TICKETS_STATUS', 'Support Tickets Status');
define('BOX_CUSTOMERS_TICKETS_PRIORITY', 'Support Tickets Priority');
define('BOX_CUSTOMERS_TICKETS_CONFIG', 'Support Tickets Configuration');
//-5.9 quotes submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_QUOTES', 'Klanten Quotes');
define('BOX_CUSTOMERS_QUOTES', 'Klanten Quotes Overzicht');
define('BOX_CUSTOMERS_QUOTES', 'Quotes Configuratie');
//-5.10 configuration submenu box text in includes/boxes/customers.php
define('BOX_CUSTOMERS_HEADING_CONFIG_CUSTOMER', 'Customers Configuration');
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');
define('BOX_CUSTOMERS_BAN_IP_ADDRESS', 'Ban IP Address');
define('BOX_CUSTOMERS_REFERRALS', 'Refferals');
define('BOX_CUSTOMERS_WISHLIST', 'Wishlist');
define('BOX_REPORTS_SUPERTRACKER', 'Customers Beahviour');

//-6 tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_BACKUP', 'Database Backup');
define('BOX_TOOLS_CACHE', 'Cache Control');
define('BOX_TOOLS_FILE_MANAGER', 'File Manager');
//-6.1 tools submenu template in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_TEMPLATE', 'Template Configuration');
define('BOX_TOOLS_TITLE_CONFIG', 'Edit Header Footer Navigation');
define('BOX_TOOLS_HEADER_CONFIG', 'Edit Heading Title and Image');
define('BOX_TOOLS_INFO_BOXES_CONFIG', 'Edit Info Boxes (<font color=#ff9900>general</font>)');
define('BOX_TOOLS_BOXES', 'Edit Info Boxes (<font color=green>on</font>/<font color=red>off</font>)');
define('BOX_TOOLS_INPUT_CONFIG', 'Edit Input Boxes');
define('BOX_TOOLS_IMAGES_CONFIG', 'Edit Images');
define('BOX_TOOLS_SITEMAP', 'Edit Site Map');
//-6.1.1 tools submenu control index pages in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_INDEX_PAGES_CONFIG', 'Edit Index and Product Pages');
define('BOX_TOOLS_INDEX_DEFAULT_CONFIG', 'Edit Index Default Page');
define('BOX_TOOLS_INDEX_NESTED_CONFIG', 'Edit Categories List Page');
define('BOX_TOOLS_INDEX_PRODUCT_CONFIG', 'Edit Products List Page');
define('BOX_TOOLS_PRODUCT_CONFIG', 'Edit Product Info Page');
//-6.1.2 tools submenu control other pages in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_OTHER_PAGES_CONFIG', 'Edit Other Pages');
define('BOX_TOOLS_CUSTOMER_CONFIG', 'Edit Customer account Page');
define('BOX_TOOLS_SHIPPING_CONFIG', 'Edit Shipping Page');
define('BOX_TOOLS_PRIVACY_CONFIG', 'Edit Privacy Page');
define('BOX_TOOLS_CONDITIONS_CONFIG', 'Edit Conditions Page');
define('BOX_TOOLS_PAYMENT_CONFIG', 'Edit Payment Page');
define('BOX_TOOLS_SHOPPING_CART_CONFIG', 'Edit Shopping Cart Page');
define('BOX_TOOLS_ALL_PRODS_CONFIG', 'Edit All Products Page');
define('BOX_TOOLS_PRODUCT_REVIEWS', 'Edit Product Reviews Pages');
//-6.1.3 tools submenu infoboxes exclude in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_INFOBOX_EXCLUDE', 'Edit Info Boxes (<font color=#ff9900>configuration</font>)');
define('BOX_AFFILIATE', 'Affiliate Infobox');
define('BOX_ARTICLES', 'Articles Infobox');
define('BOX_AUTHORS', 'Authors Infobox');
define('BOX_FAQ_ARTICLES', 'FAQ Infobox');
define('BOX_FAQ_AUTHORS', 'FAQ Authors Infobox');
define('BOX_INFO_ARTICLES', 'General Info Infobox');
define('BOX_INFO_AUTHORS', 'Info Authors Infobox');
define('BOX_BEST_SELLERS', 'Best Sellers Infobox');
define('BOX_CATEGORIES', 'Categories Infobox');
define('BOX_CATEGORIES_DROPDOWN', 'Categories Dropdown Infobox');
define('BOX_CATEGORIES_DYNAMENU', 'Categories Dynamenu Infobox');
define('BOX_CATEGORIES_FLYOUT', 'Categories Flyout Infobox');
define('BOX_CATEGORIES_IMAGES', 'Categories Image Infobox');
define('BOX_CURRENCIES', 'Currencies Infobox');
define('BOX_CUSTOMERGROUP', 'Customergroup Infobox');
define('BOX_DOCUMENTS', 'Documents Download Infobox');
define('BOX_FREE_DOWNLOADS', 'Gratis Downloads');
define('BOX_FEATURED', 'Featured Infobox');
define('BOX_FREE_DOWNLOADS', 'Free Downloads');
define('BOX_FOLLOW_US', 'Follow Us Infobox');
define('BOX_GALLERY_PLAIN', 'Gallery Plain Infobox');
define('BOX_GALLERY_SLIDESHOW', 'Gallery Slideshow Infobox');
define('BOX_GIFTS', 'Gifts Infobox');
define('BOX_HEADER_TAGS', 'Header Tags Infobox');
define('BOX_HEADER_TAGS_SEO', 'Headertags SEO Infobox');
define('BOX_INFORMATION', 'Information Infobox');
define('BOX_LANGUAGES', 'Languages Infobox');
define('BOX_LATEST_NEWS', 'Latest News Infobox');
define('BOX_LIVE_SUPPORT', 'Live Support Infobox');
define('BOX_LOGINBOX', 'Loginbox Infobox');
define('BOX_MANUFACTURER_INFO', 'Manufacturer Infobox');
define('BOX_MANUFACTURERS', 'Manufacturers Info Infobox');
define('BOX_MY_ACCOUNT', 'My Account Infobox');
define('BOX_ONLINERS', 'Onliners Infobox');
define('BOX_ORDER_HISTORY', 'Order History Infobox');
define('BOX_PAYMENT_INFO', 'Payment Info Infobox');
define('BOX_PRODUCT_NOTIFICATIONS', 'Product Notifications Infobox');
define('BOX_POLLS', 'Polls Infobox');
define('BOX_QRCODE', 'QR Code Infobox');
define('BOX_RECENTLY_VIEWED', 'Recently Viewed Infobox');
define('BOX_REFERENCES', 'References Infobox');
define('BOX_REVIEWS', 'Reviews Infobox');
define('BOX_SCR_BEST_SELLERS', 'Scrolling Best Sellers Infobox');
define('BOX_SCR_SPECIALS', 'Scrolling Specials Infobox');
define('BOX_SCR_WHATS_NEW', 'Scrolling What\'s New Infobox');
define('BOX_SEARCH', 'Search Infobox');
define('BOX_SEARCH_TAGCLOUD', 'Search Tagcloud Infobox');
define('BOX_SHIPPING_INFO', 'Shipping Info Infobox');
define('BOX_SHOP_BY_PRICE_DROP', 'Shop by Price Drop Infobox');
define('BOX_SHOP_BY_PRICE_TEXT', 'Shop by Price Text Infobox');
define('BOX_SHOPPING_CART', 'Shopping Cart Infobox');
define('BOX_SHOPPING_CART_SMALL', 'Shopping Cart Small Infobox');
define('BOX_SPECIALS', 'Specials Infobox');
define('BOX_TELL_FRIEND', 'Tell a Friend Infobox');
define('BOX_TESTIMONIALS', 'Testimonial Infobox');
define('BOX_WHATS_NEW', 'What\'s New Infobox');
define('BOX_WISHLIST', 'Wishlist Infobox');
define('BOX_YOUTUBE', 'You Tube Infobox');
//-6.1.4 tools submenu infoboxes exclude in includes/boxes/tools.php
define('BOX_TOOLS_HEADING_BANNER_MANAGER', 'Edit Banners');
define('BOX_TOOLS_BANNER_MANAGER', 'Banners Overview');
define('BOX_TOOLS_BANNER_MANAGER_CONFIG', 'Banners Configuration');

//-7 modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAGE_MANAGER', 'Latest News Manager');
//-7.1 header tags submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_HEADER_TAGS_SEO', 'Header Tags Manager');
define('BOX_MODULES_HEADER_TAGS_ADD_A_PAGE', 'Header Tags Add Page');
define('BOX_HEADER_TAGS_SILO', 'Silo Control');
define('BOX_MODULES_HEADER_TAGS_FILL_TAGS', 'Header Tags Fill Page');
define('BOX_MODULES_HEADER_TAGS_TEST', 'Header Tags Test');
define('BOX_MODULES_HEADER_TAGS_CONFIG', 'Header Tags Configuration');
//-7.2 polls submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_POLLS', 'Polls Manager');
define('BOX_MODULES_POLLS', 'Polls');
define('BOX_MODULES_POLLS_CONFIG', 'Polls Configuration');
//-7.3 links submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_LINKS', 'Links Manager');
define('BOX_MODULES_LINKS', 'Links');
define('BOX_MODULES_LINKS_CATEGORIES', 'Links Catagories');
define('BOX_MODULES_LINKS_CONTACT', 'Links Contact');
define('BOX_MODULES_LINKS_EXCHANGE', 'Links Exchange');
define('BOX_MODULES_LINKS_FEATURED', 'Links Featured');
define('BOX_MODULES_LINKS_STATUS', 'Links Status');
define('BOX_MODULES_LINKS_CONFIG', 'Links Configuration');
//-7.4 articles tags submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_ARTICLES', 'Articles Manager');
define('BOX_MODULES_TOPICS_ARTICLES', 'Article Categories');
define('BOX_MODULES_BLOGS_ARTICLES', 'Article Blogs');
define('BOX_MODULES_ARTICLES_CONFIG', 'Article Configuration');
define('BOX_MODULES_ARTICLES_AUTHORS', 'Article Authors');
define('BOX_MODULES_ARTICLES_REVIEWS', 'Article Reviews');
define('BOX_MODULES_ARTICLES_XSELL', 'Articles Cross Sell');
//-7.5 gallery tags submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_GALLERY', 'Gallery Manager');
define('BOX_MODULES_GALLERY', 'Gallery Clean Up');
define('BOX_MODULES_GALLERY_UPLOAD', 'Gallery Upload');
define('BOX_MODULES_GALLERY_SUPERUSERS', 'Gallery Superusers');
define('BOX_MODULES_GALLERY_CONFIG', 'Gallery Configuration');
//-7.6 affiliates submenu box text in includes/boxes/catalog.php
define('BOX_CATALOG_HEADING_AFFILIATE', 'Affiliates');
define('BOX_CATALOG_AFFILIATE_SUMMARY', 'Summary');
define('BOX_CATALOG_AFFILIATE', 'Affiliate');
define('BOX_CATALOG_AFFILIATE_PAYMENT', 'Payment');
define('BOX_CATALOG_AFFILIATE_BANNERS', 'Banner');
define('BOX_CATALOG_AFFILIATE_CONTACT', 'Contact');
define('BOX_CATALOG_AFFILIATE_NEWS', 'News');
define('BOX_CATALOG_AFFILIATE_NEWSLETTER_MANAGER', 'Newsletter Manager');
define('BOX_CATALOG_AFFILIATE_SALES', 'Affiliate Sales');
define('BOX_CATALOG_AFFILIATE_CLICKS', 'Clicks');
define('BOX_MODULES_AFFILIATE_CONFIG', 'Affiliate Configuration');
//-7.7 FAQ submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_FAQ', 'FAQ Manager');
define('BOX_MODULES_FAQ_TOPICS', 'FAQ Categories');
define('BOX_MODULES_FAQ_CONFIG', 'FAQ Configuration');
define('BOX_MODULES_FAQ_AUTHORS', 'FAQ Authors');
define('BOX_MODULES_FAQ_REVIEWS', 'FAQ Reviews');
define('BOX_MODULES_FAQ_XSELL', 'FAQ Cross Sell');
//-7.8 general information submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_INFO', 'Info Manager');
define('BOX_MODULES_INFO_TOPICS', 'Info Categories');
define('BOX_MODULES_INFO_CONFIG', 'Info Configuration');
define('BOX_MODULES_INFO_AUTHORS', 'Info Authors');
define('BOX_MODULES_INFO_REVIEWS', 'Info Reviews');
define('BOX_MODULES_INFO_XSELL', 'Info Cross Sell');
//-7.9 FAQ one page submenu text in includes/boxes/modules.php
define('BOX_MODULES_HEADING_FAQ_ONE_PAGE', 'FAQ Manager One Page');
define('BOX_MODULES_FAQ_MANAGER', 'FAQ Manager');
define('BOX_MODULES_FAQ_VIEW', 'View FAQ');
define('BOX_MODULES_FAQ_VIEW_ALL', 'Viw All FAQ\'s');
//-7.10 tools submenu define pages in includes/boxes/tools.php
define('BOX_MODULES_HEADING_LANGUAGE', 'Edit Text');
define('BOX_MODULES_DEFINE_LANGUAGE', 'Edit Other Pages');
define('BOX_MODULES_DEFINE_MAINPAGE', 'Edit Mainpage');
define('BOX_MODULES_DEFINE_CONDITIONS', 'Edit Conditions');
define('BOX_MODULES_DEFINE_PRIVACY', 'Edit Privacy Policy');
define('BOX_MODULES_DEFINE_SHIPPING', 'Edit Shipping and Returns');
define('BOX_MODULES_DEFINE_PAYMENT', 'Edit Payments');
define('BOX_MODULES_DEFINE_ABOUT_US', 'Edit About Us');
//-7.11 testimonial submenu testimonial manager in includes/boxes/tools.php
define('BOX_MODULES_HEADING_TESTIMONIALS', 'Testimonial Manager');
define('BOX_MODULES_TESTIMONIALS_MANAGER', 'View Testimonials');
define('BOX_MODULES_TESTIMONIALS_CONFIG', 'Testimonial Configuration');
//-7.12 reference submenu testimonial manager in includes/boxes/tools.php
define('BOX_MODULES_HEADING_REFERENCES', 'Reference Manager');
define('BOX_MODULES_REFERENCE_MANAGER', 'View References');
define('BOX_MODULES_REFERENCE_CONFIG', 'References Configuration');
//-7.13 documents submenu testimonial manager in includes/boxes/tools.php
define('BOX_MODULES_HEADING_DOCUMENTS', 'Documents Manager');
define('BOX_MODULES_DOCUMENTS', 'Documents overview');
define('BOX_MODULES_DOCUMENTS_CONFIG', 'Documents Configuration ');

//-8 checkout box text in includes/boxes/checkout.php
define('BOX_HEADING_CHECKOUT', 'Kassa');
define('BOX_CHECKOUT_PAYMENT', 'Payment');
define('BOX_CHECKOUT_SHIPPING', 'Shipping');
define('BOX_CHECKOUT_ORDER_TOTAL', 'Order Total');
define('BOX_CHECKOUT_ORDER_STATUS', 'Orders Status');
//-8.1 configuration submenu text in includes/boxes/checkout.php
define('BOX_CHECKOUT_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CHECKOUT_CONFIGURATION_PAYMENT', 'Payment');
define('BOX_CHECKOUT_CONFIGURATION_SHIPPING', 'Shipping');
define('BOX_CHECKOUT_CONFIGURATION_ORDER_TOTAL', 'Order Total');
define('BOX_CHECKOUT_CONFIGURATION_ORDER_STATUS', 'Order Status');

//-9 reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Reports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_REPORTS_ORDERS_TOTAL', 'Customer Orders-Total');
define('BOX_REPORTS_WISHLIST', 'Customers Wishlist');
define('BOX_REPORTS_SUPERTRACKER', 'Customers Behaviour');
define('BOX_REPORTS_REFERRAL_SOURCES', 'Found us by.......');
define('BOX_REPORTS_STATS_PRODUCTS_NOTIFICATIONS', 'Overzicht Klant Notificaties');
define('BOX_REPORTS_STOCK_PRODUCTS_ACTIVE', 'Stock Active');
define('BOX_REPORTS_STOCK_PRODUCTS_INACTIVE', 'Stock Inactive');
define('BOX_REPORTS_STOCK_LOW_STOCK', 'Stock Level Low');
define('BOX_REPORTS_STOCK_STATS_LOW_STOCK_ATTRIB', 'Stock Attributes Low');

//-10 taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locations / Taxes');
define('BOX_TAXES_COUNTRIES', 'Countries');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Tax Zones');
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes');
define('BOX_TAXES_TAX_RATES', 'Tax Rates');

//-11 localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localization');
define('BOX_LOCALIZATION_CURRENCIES', 'Currencies');
define('BOX_LOCALIZATION_LANGUAGES', 'Languages');

//-12 support box text in includes/boxes/support.php
define('BOX_HEADING_SUPPORT', 'Support');
define('BOX_SUPPORT_OSSHOPPY_EXTRA', 'osShoppy Extra');
define('BOX_SUPPORT_OSSHOPPY_INFO', 'osShoppy Info');
define('BOX_SUPPORT_OSSHOPPY_MANUAL', 'osShoppy Manual');
define('BOX_SUPPORT_OSSHOPPY_MODULES', 'osShoppy Modules');
define('BOX_SUPPORT_OSSHOPPY_SERVER_INFO', 'osShoppy Server Info');
define('BOX_SUPPORT_OSSHOPPY_UPDATES', 'osShoppy Updates');

// osShoppy Manual
define('HEADER_ADMIN_BACK', 'Back to Admin');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');
define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');
define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');
define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');
define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/date/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS_NO', '* The \'House Number\' entry must have at least ' . ENTRY_STREET_NO_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE', '* The \'State\' entry is must be selected.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.');
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' amd \'Confirmation\' entries must match amd have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');
define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!');

// account categories
define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Company');
define('CATEGORY_NOTES', 'Notes');
define('CATEGORY_OPTIONS', 'Options');

// create account entries
define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_INSERTION_NAME', 'insertion:');
define('ENTRY_INSERTION_NAME_ERROR', '');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">The email address doesn\'t appear to be valid!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">This email address already exists!</span>');
define('ENTRY_COMPANY', 'Company name:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_CUSTOMERS_GROUP_NAME', 'Customer Group:');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Switch off alert for authentication:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alert off');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alert on');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_STREET_NO', 'House Number:');
define('ENTRY_STREET_NO_ERROR', '');
define('ENTRY_STREET_NO_ADD', 'addition:');
define('ENTRY_STREET_NO_ADD_ERROR', '');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('PASSWORD_HIDDEN', '--HIDDEN--');

// images
define('IMAGE_MANAGE_BANNERS', 'Manage Banners');
define('IMAGE_ADD_BANNER','Add Banner');
define('IMAGE_ADDITIONAL_NEW', 'Add Images');    
define('IMAGE_ADDITIONAL_DEL', 'Delete Images');
define('IMAGE_ADDITIONAL_NEW', 'Add Images');    
define('IMAGE_ADDITIONAL_DEL', 'Delete Images');
define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('IMAGE_APPROVE', 'Approve');
define('IMAGE_ASSOCIATE', 'Associate With');
define('IMAGE_BACK', 'Back');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_CHECK_LINK', 'Check Link');
define('IMAGE_CHECK_LINKS', 'Check Links');
define('IMAGE_CLICKTHROUGHS', 'Affiliate Clickthroughs');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_COPY', 'Copy');
define('IMAGE_COPY_TO', 'Copy To');
define('IMAGE_CREATE_ORDER', 'Create Order');
define('IMAGE_DEFINE', 'Define');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Delete');
define('IMAGE_DISABLE', 'Disable');
define('IMAGE_DISAPPROVE', 'Disapprove');
define('IMAGE_EDIT', 'Edit');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'File Manager');
define('IMAGE_FILE_PERMISSION', 'File Permissions');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_HELP', 'Help');
define('IMAGE_ICON_STATUS_GREEN', 'Active');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Set Active');
define('IMAGE_ICON_STATUS_RED', 'Inactive');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Insert');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_MODULE_INSTALL', 'Install Module');
define('IMAGE_MODULE_REMOVE', 'Remove Module');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_AUTHOR', 'New Author');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('IMAGE_NEW_BANNER', 'New Banner');
define('IMAGE_NEW_CATEGORY', 'New Category');
define('IMAGE_NEW_COUNTRY', 'New Country');
define('IMAGE_NEW_CURRENCY', 'New Currency');
define('IMAGE_NEW_DOCUMENT_TYPE', 'New Document');
define('IMAGE_NEW_FAQ', 'New FAQ');
define('IMAGE_NEW_FAQ_AUTHOR', 'New FAQ Author');
define('IMAGE_NEW_FAQ_CATEGORY', 'New FAQ Category');
define('IMAGE_NEW_FAQ_TOPIC', 'New FAQ Category');
define('IMAGE_NEW_FILE', 'New File');
define('IMAGE_NEW_FOLDER', 'New Folder');
define('IMAGE_NEW_G_INFO', 'New General Information');
define('IMAGE_NEW_G_INFO_AUTHOR', 'New General Information Author');
define('IMAGE_NEW_G_INFO_CATEGORY', 'New General Information Category');
define('IMAGE_NEW_G_INFO_TOPIC', 'New General Information Category');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_LANGUAGE', 'New Language');
define('IMAGE_NEW_LINK', 'New Link');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEW_NEWSLETTER', 'New Newsletter');
define('IMAGE_NEW_PRODUCT', 'New Product');
define('IMAGE_NEW_REFERENCES', 'Nieuwe Reference');
define('IMAGE_NEW_TAX_CLASS', 'New Tax Class');
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate');
define('IMAGE_NEW_TAX_ZONE', 'New Tax Zone');
define('IMAGE_NEW_TESTIMONIAL', 'New Testimonial');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ZONE', 'New Zone');
define('IMAGE_NEXT', 'Next');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Invoice');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_RELATED_PRODUCTS', 'Related Products');
define('IMAGE_SALES', 'Affiliate Sales');
define('IMAGE_SAVE', 'Save');
define('IMAGE_SEARCH', 'Search');
define('IMAGE_SELECT', 'Select');
define('IMAGE_SEND', 'Send');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_SHOW_PRODUCTS', 'Show Products');
define('IMAGE_STOCK', 'Show Stock');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Update');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPLOAD', 'Upload');

// icons
define('ICON_CROSS', 'False');
define('ICON_CURRENT_FOLDER', 'Current Folder');
define('ICON_DELETE', 'Delete');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'File');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'True');
define('ICON_UNLOCKED', 'Unlocked');
define('ICON_WARNING', 'Warning');
define('ICON_RSS_ON', 'Showing in RSS feed, click to remove'); 
define('ICON_RSS_OFF', 'Not showing in RSS feed, click to add'); 

// constants for use in sort order
define('SORT_BY_ID_ASC', 'Sort by ID ascending  --> 1-2-3 from top ');
define('SORT_BY_ID_DESC', 'Sort by ID descending  --> 3-2-1 from top ');
define('SORT_BY_NAME_ASC', 'Sort by Name ascending  --> a-b-c from top ');
define('SORT_BY_NAME_DESC', 'Sort by Name descending  --> z-y-x from top ');
define('SORT_BY_PRODUCTS_ID_ASC', 'Sort by products ID ascending  --> 1-2-3 From Top ');
define('SORT_BY_PRODUCTS_ID_DESC', 'Sort by products ID descending  --> 3-2-1 From Top ');
define('SORT_BY_PRODUCTS_NAME_ASC', 'Sort by products Name ascending  --> a-b-c From Top ');
define('SORT_BY_PRODUCTS_NAME_DESC', 'Sort by products Name descending  --> z-y-x From Top ');
define('SORT_BY_PRODUCTS_MODEL_ASC', 'Sort by products Model ascending  --> a-b-c From Top ');
define('SORT_BY_PRODUCTS_MODEL_DESC', 'Sort by products Model descending  --> z-y-x From Top ');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> article authors)');
define('TEXT_DISPLAY_NUMBER_OF_FAQ_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> faq authors)');
define('TEXT_DISPLAY_NUMBER_OF_INFO_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> info authors)');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> countries)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> customers)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CATEGORIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> discount categories)');
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> languages)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> manufacturers)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> members)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_RETURN', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders returned)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders status)');
define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Pages)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products expected)');
define('TEXT_DISPLAY_NUMBER_OF_RETURN_REASON', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> return reasons)');
define('TEXT_DISPLAY_NUMBER_OF_REFUND_METHODS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> return methods)');
define('TEXT_DISPLAY_NUMBER_OF_RETOUR_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> return status)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> product reviews)');
define('TEXT_DISPLAY_NUMBER_OF_FAQ_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> faq reviews)');
define('TEXT_DISPLAY_NUMBER_OF_INFO_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> info reviews)');
define('TEXT_DISPLAY_NUMBER_OF_REFERRALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> referral sources)'); //rmh referrals
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products on special)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax rates)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Set as default');
define('TEXT_FIELD_REQUIRED', ' *');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');
define('WARNING_ADMIN_LOW_NOTES_TIME', '<b>Attention:</b> The reminder date for a note for <b>LOW administrator</b>was reached. <a href="admin_low_notes.php">(click here)</a>');
define('WARNING_ADMIN_MID_NOTES_TIME', '<b>Attention:</b> The reminder date for a note for <b>MID administrator</b>was reached. <a href="admin_mid_notes.php">(click here)</a>');
define('WARNING_ADMIN_TOP_NOTES_TIME', '<b>Attention:</b> The reminder date for a note for <b>TOP administrator</b>was reached. <a href="admin_top_notes.php">(click here)</a>');
define('TEXT_QTPRO_FIRST', '<b>Attention:</b> There is/are ');
define('TEXT_QTPRO_SECOND', ' product(s) with wrong stock! ');
define('TEXT_CLICK', ' (click here)');

// mindsparx admin
define('LOGG_OUT', 'Logoff');
define('HEADING_TITLE2', '10 best viewed products');
define('TABLE_HEADING_VIEWED2', 'Viewed');
define('HEADER_WARNING', 'Here you can put a warning for your clients <br>Warning! Please take a database backup before change these settings. ');
// admin welcome text
define('TEXT5', 'You have ');
define('TEXT6', ' customers in total and ');
define('TEXT7', ' products in your store. ');
define('TEXT8', ' of your products has been reviewed.');
define('DO_USE', 'You can use the quick navigation at the top of the page to manage your orders.');
define('WELCOME_BACK', 'Welcome back ');
define('TEXT_INFO_LOGDATE', 'Last Acces: ');
define('STOCK_TEXT_WARNING1', '<b><font   color="#990000">Warning!</font></b> you have ');
define('STOCK_TEXT_WARNING2', ' product(s) that´s running out of stock. Click here  ');
define('STOCK_TEXT_WARNING3', ' to see your stock status.');
define('STOCK_TEXT_OK1', '<font color="#009900 ">Your stock status is good</font> and no new products need to be ordered. Click here ');
define('STOCK_TEXT_OK2', ' to see your stock status.');

define('TEXT_SUMMARY_INFO_WHOS_ONLINE', 'Users Online: %s');
define('TEXT_SUMMARY_INFO_CUSTOMERS', 'Total Customers: %s, Today: %s');
define('TEXT_SUMMARY_INFO_ORDERS', 'Your Order Status Is: <br> %s, <b>Today:</b> %s');
define('TEXT_SUMMARY_INFO_REVIEWS', 'Total Reviews: %s, Today: %s');
define('TEXT_SUMMARY_INFO_TICKETS', 'Ticket Status %s');
define('TEXT_SUMMARY_INFO_ORDERS_TOTAL', 'Your Order Total is: <br> %s,<b> Today: </b>%s');

define('EMAIL_CONFIGURATION_CHANGE_TEXT_SUBJECT','Store Configuration Change');
define('EMAIL_CONFIGURATION_CHANGE_TEXT_BODY','A configuration value in your store has changed. Visit your admin area for further details.');

define('TEXT_GIFT_HEADER', 'Free Gifts');
define('TEXT_NEW_GIFT_ADD', 'Add A New Gift:');
define('TEXT_GIFT_ADD_CARROT', '<a href="' . tep_href_link(FILENAME_CATEGORIES) . '">Go to product edit page to add items to the list.</a>');
define('TEXT_THRESHOLD', 'Threshold');
define('TEXT_ADD', 'Add');

define('BOX_HEADING_GV_ADMIN', 'Vouchers/Coupons');
define('BOX_GV_ADMIN_QUEUE', 'Gift Voucher Queue');
define('BOX_GV_ADMIN_MAIL', 'Mail Gift Voucher');
define('BOX_GV_ADMIN_SENT', 'Gift Vouchers sent');
define('BOX_COUPON_ADMIN','Coupon Admin');

define('IMAGE_RELEASE', 'Redeem Gift Voucher');

define('_JANUARY', 'January');
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

require(DIR_WS_LANGUAGES . 'mail_english.php');
?>
