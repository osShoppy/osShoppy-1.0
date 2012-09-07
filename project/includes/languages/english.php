<?php
//$Id: /catalog/includes/languages/english.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

@setlocale(LC_TIME, 'en_US.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
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

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'USD');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="en"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Create an Account');
define('HEADER_TITLE_MY_ACCOUNT', 'My Account');
define('HEADER_TITLE_FORUM', 'Forum');
define('HEADER_TITLE_CART_CONTENTS', 'Cart Contents');
define('HEADER_TITLE_CHECKOUT', 'Checkout');
define('HEADER_TITLE_CONTACT_US', 'Contact Us');
define('HEADER_TITLE_TOP', 'Top');
define('HEADER_TITLE_CATALOG', 'Catalog');
define('HEADER_TITLE_LOGOFF', 'Log Off');
define('HEADER_TITLE_LOGIN', 'Log In');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'hits since');
define('FOOTER_INFORMATION_FAQ', 'FAQ');
define('FOOTER_INFORMATION_CONTACT', 'Contact Us');
define('FOOTER_INFORMATION_DYNAMIC_SITEMAP', 'Sitemap');
define('FOOTER_INFORMATION_GENERAL_INFORMATION', 'General Information');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');
define('MALE_ADDRESS', 'Mr.');
define('FEMALE_ADDRESS', 'Ms.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// rss feed
define('BOX_INFORMATION_RSS', 'Catalog Feed');
define('BOX_INFORMATION_RSS_CATEGORY', 'Category RSS Feed');
define('BOX_INFORMATION_RSS_MANUFACTURER', 'Manufacturer RSS Feed');

//|| project infoboxen ||\\
// affiliate box text in includes/boxes/affiliate.php
define('BOX_HEADING_AFFILIATE', 'Affiliate Program');
define('BOX_HEADING_AFFILIATE_NEWS', 'Affiliate News');
define('BOX_AFFILIATE_CONTACT', 'Contact Us');
define('BOX_AFFILIATE_FAQ', 'Affiliate Program FAQ');
define('BOX_AFFILIATE_LOGIN', 'Affiliate Log In');
define('BOX_AFFILIATE_LOGOUT', 'Affiliate Log Out');
define('BOX_INFORMATION_AFFILIATE', 'The Affiliate Program');
define('BOX_AFFILIATE_CENTRE', 'Affiliate Centre');
define('BOX_AFFILIATE_BANNER_CENTRE', 'Affiliate Links');
define('BOX_AFFILIATE_REPORT_CENTRE', 'Affiliate Reports');
define('BOX_AFFILIATE_INFO', 'Affiliate Information');
define('BOX_AFFILIATE_SUMMARY', 'Affiliate Summary');
define('BOX_AFFILIATE_PASSWORD', 'Change Password');
define('BOX_AFFILIATE_NEWS', 'Affiliate News');
define('BOX_AFFILIATE_NEWSLETTER', 'Newsletter');
define('BOX_AFFILIATE_ACCOUNT', 'Edit Affiliate Account');
define('BOX_AFFILIATE_REPORTS', 'Affiliate Reports');
define('BOX_AFFILIATE_CLICKRATE', 'Clickthrough Report');
define('BOX_AFFILIATE_PAYMENT', 'Payment Report');
define('BOX_AFFILIATE_SALES', 'Sales Report');
define('BOX_AFFILIATE_BANNERS', 'Affiliate Banners / Links');
define('BOX_AFFILIATE_BANNERS_BANNERS', 'WebSite Banners');
define('BOX_AFFILIATE_BANNERS_BUILD_CAT', 'Build Category Link');
define('BOX_AFFILIATE_BANNERS_BUILD', 'Build Product Link');
define('BOX_AFFILIATE_BANNERS_PRODUCT', 'Product Banners');
define('BOX_AFFILIATE_BANNERS_CATEGORY', 'Category Banners');
define('BOX_AFFILIATE_BANNERS_TEXT', 'Text Links');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categories');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Currencies');

// customergroup box text in includes/boxes/currencies.php
define('BOX_HEADING_CUSTOMERGROUP', 'Customer Group');

// documents box text in includes/boxes/documents.php
define('BOX_HEADING_DOCUMENTS', 'Download Documents');

// free_downloads box text in includes/boxes/free_downloads.php
define('BOX_HEADING_FREE_DOWNLOADS', 'Free Downloads');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Manufacturers');

// featured box text in includes/boxes/featured.php
define('BOX_CATALOG_FEATURED_PRODUCTS', 'Featured Products');
define('BOX_HEADING_FEATURED', 'Featured');

// follow_us box text in includes/boxes/follow_us.php
define('BOX_HEADING_FOLLOW_US', 'Follow Us On...');

// gifts box text in includes/boxes/gifts.php
define('BOX_HEADING_GIFTS', 'Special Gifts');

// links box text in includes/boxes/links.php
define('BOX_HEADING_LINKS', 'Featured Links');
define('BOX_INFORMATION_LINKS', 'Links');

// loginbox box text in includes/boxes/loginbox.php
define('BOX_HEADING_LOGIN_BOX', 'Sign in');
define('BOX_LOGINBOX_EMAIL', '<center>E-mail address:</center>');
define('BOX_LOGINBOX_PASSWORD', '<center>Password:<center>');
define('BOX_LOGINBOX_TEXT_NEW', '<center>Are you a new client? <center>');
define('BOX_LOGINBOX_NEW', '<center><u>create an account</u><center>');
define('BOX_LOGINBOX_FORGOT_PASSWORD', '<center><u>(forgotten)</u></center><br>');
define('IMAGE_BUTTON_LOGIN', 'Login');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','My account info');
define('LOGIN_BOX_FRONTEND NOTE','<small><b>There is a personal message for you!</b></small><a href="' . tep_href_link(FILENAME_ACCOUNT) . '"><u>click here</u></a>');
define('LOGIN_BOX_PRODUCTS_NEW','New products');
define('LOGIN_BOX_MY_ACCOUNT','General information');
define('LOGIN_BOX_ACCOUNT_HISTORY','Account history');
define('LOGIN_BOX_CHECKOUT_SHIPPING', 'Checkout');
define('LOGIN_BOX_ACCOUNT_EDIT','Edit account info.');
define('LOGIN_BOX_ADDRESS_BOOK','My address book');
define('LOGIN_BOX_ACCOUNT_NOTIFICATIONS','Product notifications');
define('LOGIN_BOX_SHOPPING_CART','My Cart');
define('LOGIN_BOX_AFFILIATE','Affiliate Program');
define('LOGIN_BOX_ARTICLE_SUBMIT','Submit Article');
define('LOGIN_BOX_FAQ_ARTICLE_SUBMIT','Submit FAQ');
define('LOGIN_BOX_INFO_ARTICLE_SUBMIT','Submit Information Article');
define('LOGIN_BOX_RECENTLY_VIEWED','Recently Viewed Products');
define('LOGIN_BOX_WISHLIST','Mijn Wenslijstje');
define('LOGIN_BOX_LOGOFF','Log Off');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Quick Find');
define('BOX_SEARCH_TEXT', 'Use keywords to find the product you are looking for.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Advanced Search');

// header shopping cart
define('ITEM_IN_CART', 'Products:');
define('TOTAL_AMOUNT', 'Total:');
define('BOX_HEADING_CART', 'My Shopping Cart');
define('SHOPPING_BAG_CART_EMPTY', 'My Shopping Cart is Empty');
define('SHOPPING_BAG_CART_FULL', 'My Shopping Cart is Filled');

// polls box text in includes/boxes/polls.php
define('_RESULTS', 'Results'); 
define('_POLLS','Polls'); 
define('_VOTE', 'VOTE'); 
define('_VOTES', 'Votes'); 
define('_NOPOLLS','No eligible polls'); 
define('_NOPOLLSCONTENT','There are no polls that you are eligible for, however you can still view the results of other polls<br><br><a href="pollbooth.php">['._POLLS.']');  

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Reviews');
define('BOX_REVIEWS_WRITE_REVIEW', '<center>Are you the first to write a review on this product?</center>');
define('BOX_REVIEWS_NO_REVIEWS', '<center>Are you the first to write a review?</center>');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s of 5 Stars!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Shopping Cart');
define('BOX_SHOPPING_CART_EMPTY', '0 items');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Specials');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Order History');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestsellers');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestsellers in<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notifications');
define('BOX_NOTIFICATIONS_NOTIFY', 'Notify me of updates to <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Do not notify me of updates to <b>%s</b>');

// manufacturer info box text in includes/boxes/manufacturer_info.php
define('BOX_HEADING_MANUFACTURER_INFO', 'Manufacturer Info');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Other products');

// header tags box text in includes/boxes/header_tags.php
define ('BOX_HEADING_HEADER_TAGS', 'Header Tags');
// headertags seo silo box text in includes/boxes/headertags_seo_silo.php
define ('BOX_HEADING_HEADERTAGS_SEO_SILO', 'Header Tags Silo');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Languages');

// live support box text in includes/boxes/live_support.php
define('BOX_HEADING_LIVE_SUPPORT', 'Live Support');
define('BOX_INFORMATION_PHPONLINE', 'Request Live Support');







// gallery box text in includes/boxes/gallery.php
define('BOX_HEADING_GALLERY', 'Photo gallery'); 
define('TEXT_GALLERY', 'View some pictures of our clients');
define('BOX_TEXT_GALLERY_LINK', '<a href="gallery_user.php">Add Your Own Image</a>');
define('BOX_SLIDESHOW_MAX_THUMBS','25');
define('BOX_GALLERY_TOOLTIP','Go to the Image Gallery');
define('TEXT_PLACE_COMMENT_NOT_LOGIN','Login om een reactie te plaaten!');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Information');
define('BOX_INFORMATION_PRIVACY', 'Privacy Notice');
define('BOX_INFORMATION_CONDITIONS', 'Conditions of Use');
define('BOX_INFORMATION_SHIPPING', 'Shipping & Returns');
define('BOX_INFORMATION_CONTACT', 'Contact Us');
define('BOX_INFORMATION_ABOUT_US', 'About Us');
define('BOX_INFORMATION_FAQ', 'Frequently&nbsp;Asked&nbsp;Questions');
define('BOX_INFORMATION_ARTICLES', 'Articles');
define('BOX_INFORMATION_GENERAL_INFO', 'General Information');
define('BOX_INFORMATION_TESTIMONIALS', 'Customer Testimonials');
define('BOX_INFORMATION_GALLERY', 'Product Gallery');
define('BOX_INFORMATION_REFERENCES', 'Company References');
define('BOX_INFORMATION_POLLS', 'Enquetes');
define('BOX_INFORMATION_LINKS', 'Links');
define('BOX_INFORMATION_ALL_PRODS', 'All Products');
define('BOX_INFORMATION_PAYMENT', 'Payments');
define('BOX_INFORMATION_DOCUMENTS', 'Download Documents');
define('BOX_INFORMATION_RETURNS_TRACK', 'Track a Return');
define('BOX_INFORMATION_FREE_DOWNLOADS', 'Free Downloads');
define('BOX_INFORMATION_QUOTES', 'Customer Quotes');
define('BOX_INFORMATION_TICKETS_VIEW', 'View Support Ticket');
define('BOX_INFORMATION_TICKETS_CREATE', 'Create Support Ticket');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Tell A Friend');
define('BOX_TELL_A_FRIEND_TEXT', 'Tell someone you know about this product.');

// onliners box in includes/boxes/onliners.php 
define('BOX_HEADING_ONLINECOUNTER','Now online');
define ('GUESTSONLINE_FIELD','Visitors Online: ');
define('MOSTEVER_FIELD','Most Visitors Ever: ');
define('ONLINESINDS_FIELD',' visitors since: ');
define ('PAGEVIEWS_FIELD','Pageviews: ');
define ('TOTAL_ONLINE','Products in Shop: ');

// extra pages info info box in includes/boxes/extra_pages_info.php 
define('BOX_HEADING_LATEST_NEWS', 'Latest News');

// payment info box in includes/boxes/payment_info.php 
define ('BOX_HEADING_PAYMENT_INFO', 'Payment Info');

// recently viewed box in includes/boxes/recently_viewed.php 
define ('BOX_HEADING_RECENTLY_VIEWED', 'Recently Viewed');

// shipping info box in includes/boxes/shipping_info.php 
define ('BOX_HEADING_SHIPPING_INFO', 'Shipping Info');

// shop by price info box in includes/boxes/shop_by_price.php 
define('BOX_HEADING_SHOP_BY_PRICE', 'Shop by Price');

// tag cloud box in includes/boxes/tagcloud.php 
define ('BOX_HEADING_TAGCLOUD', 'Tag Cloud');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'New Products');

// wishlist box text in includes/boxes/wishlist.php
define('BOX_HEADING_WISHLIST', 'My Wishlist');
define('TEXT_WISHLIST_COUNT', 'Currently %s items are on your Wish List.');

// youtube box text in includes/boxes/languages.php
define('BOX_HEADING_YOUTUBE', 'Youtube Video');
//|| project infoboxen_eof ||\\

//|| project modules ||\\
// affiliate manager
define('TEXT_PAYMENT_ID', 'Shows the ID Number, of payments.');
define('TEXT_SALES_PAYMENT_DATE', 'Shows the date, of payments.');
define('TEXT_SALES_PAYMENT_Ammount', 'Affiliate Earnings represents the commission due on the sale');
define('TEXT_PAYMENT_STATUS', 'Sale Status represents the status the sale.');
define('ENTRY_AFFILIATE_PAYMENT_DETAILS', 'Payable to:');
define('ENTRY_AFFILIATE_ACCEPT_AGB', 'Check here to indicate that you have read and agree to the ');
define('ENTRY_AFFILIATE_ACCEPT_AGB_TEXT', 'Affiliate Program Terms and Conditions ');
define('ENTRY_AFFILIATE_AGB_ERROR', ' &nbsp;<small><font color="#FF0000">You must accept our Affiliate Program Terms & Conditions</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_CHECK', 'Check Payee Name:');
define('ENTRY_AFFILIATE_PAYMENT_CHECK_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL', 'PayPal Account Email:');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_PAYPAL_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME', 'Bank Name:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_NAME_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME', 'Account Name:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER', 'Account Number:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER', 'ABA/BSB number (branch number):');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE', 'SWIFT Code:');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE_TEXT', '');
define('ENTRY_AFFILIATE_PAYMENT_BANK_SWIFT_CODE_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_COMPANY', 'Company');
define('ENTRY_AFFILIATE_COMPANY_TEXT', '');
define('ENTRY_AFFILIATE_COMPANY_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_COMPANY_TAXID', 'TAX ID.:');
define('ENTRY_AFFILIATE_COMPANY_TAXID_TEXT', '');
define('ENTRY_AFFILIATE_COMPANY_TAXID_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_AFFILIATE_HOMEPAGE', 'Homepage');
define('ENTRY_AFFILIATE_HOMEPAGE_TEXT', '&nbsp;<small><font color="#FF0000">* (incl. http://)</font></small>');
define('ENTRY_AFFILIATE_HOMEPAGE_ERROR', '&nbsp;<small><font color="#FF0000">* (incl. http://)</font></small>');
define('ENTRY_AFFILIATE_NEWSLETTER', 'Affiliate Newsletter');
define('ENTRY_AFFILIATE_NEWSLETTER_TEXT', '');
define('ENTRY_AFFILIATE_NEWSLETTER_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('CATEGORY_PAYMENT_DETAILS', 'You get your money by:');

// article manager
define('BOX_HEADING_ARTICLES', 'Articles');
define('BOX_ALL_ARTICLES', 'All Articles');
define('BOX_ARTICLE_SUBMIT', 'Submit An Article');
define('BOX_ARTICLE_TOPICS', 'All Topics');
define('BOX_NEW_ARTICLES', 'New Articles: ');
define('TEXT_ARTICLE_SEARCH', 'Search Our Articles');
define('TEXT_ARTICLE_SEARCH_STRING', 'search article...');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> articles)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new articles)');
define('TEXT_ARTICLES', 'Below is a list of articles with the most recent ones listed first.');  
define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_ABSTRACT', 'Abstract');
define('TEXT_PXSELL_ARTICLES', 'Related Articles');
define('BOX_HEADING_AUTHOR', 'Articles by Author');
define('BOX_HEADING_AUTHORS', 'Articles by Authors');
define('BOX_ARTICLES_BLOG_COMMENTS', 'Blog Articles');
define('NAVBAR_TITLE_DEFAULT', 'Articles');
define('BOX_RSS_ARTICLES', 'Articles RSS Feed');
define('BOX_UPCOMING_ARTICLES', 'Upcoming Articles');

// faq article manager
define('BOX_HEADING_FAQ', 'Frequent Asked Questions');
define('BOX_ALL_FAQ', 'All FAQ\'s');
define('BOX_FAQ_SUBMIT', 'Submit An FAQ');
define('BOX_FAQ_TOPICS', 'All FAQ Topics');
define('BOX_NEW_FAQ', 'New FAQ\'s: ');
define('TEXT_FAQ_SEARCH', 'Search Our FAQ\'s');
define('TEXT_FAQ_SEARCH_STRING', 'search faq...');
define('TEXT_DISPLAY_NUMBER_OF_FAQ', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> faq\'s)');
define('TEXT_DISPLAY_NUMBER_OF_FAQ_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new faq\'s)');
define('TEXT_FAQ', 'Below is a list of FAQ\'swith the most recent ones listed first.');  
define('TABLE_HEADING_FAQ_AUTHOR', 'FAQ Author');
define('TABLE_HEADING_FAQ_ABSTRACT', 'Abstract');
define('TEXT_PXSELL_FAQ', 'Related FAQ\'s');
define('BOX_HEADING_FAQ_AUTHOR', 'FAQ\'s by Author');
define('BOX_HEADING_FAQ_AUTHORS', 'FAQ\'s by Authors');
define('BOX_FAQ_BLOG_COMMENTS', 'Blog FAQ\'s');
define('NAVBAR_TITLE_FAQ_DEFAULT', 'FAQ\'s');
define('BOX_RSS_FAQ', 'FAQ RSS Feed');
define('BOX_UPCOMING_FAQ', 'Upcoming FAQ\'s');

// general information manager
define('BOX_HEADING_G_INFO', 'General Information');
define('BOX_ALL_G_INFO', 'All General Information');
define('BOX_G_INFO_SUBMIT', 'Submit An General Information');
define('BOX_G_INFO_TOPICS', 'All General Information Topics');
define('BOX_NEW_G_INFO', 'New General Information');
define('TEXT_G_INFO_SEARCH', 'Search Our General Informations');
define('TEXT_G_INFO_SEARCH_STRING', 'search general information...');
define('TEXT_DISPLAY_NUMBER_OF_G_INFO', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> general information)');
define('TEXT_DISPLAY_NUMBER_OF_G_INFO_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new general information)');
define('TEXT_G_INFO', 'Below is a list of General Informations with the most recent ones listed first.');  
define('TABLE_HEADING_G_INFO_AUTHOR', 'General Information Author');
define('TABLE_HEADING_G_INFO_ABSTRACT', 'Abstract');
define('TEXT_PXSELL_G_INFO', 'Related General Information');
define('BOX_HEADING_G_INFO_AUTHOR', 'General Information by Author');
define('BOX_HEADING_G_INFO_AUTHORS', 'General Information by Authors');
define('BOX_G_INFO_BLOG_COMMENTS', 'Blog Information');
define('NAVBAR_TITLE_G_INFO_DEFAULT', 'General Information');
define('BOX_RSS_G_INFO', 'General Information RSS Feed');
define('BOX_UPCOMING_G_INFO', 'Upcoming General Information');

// testimonials manager
define('BOX_HEADING_CUSTOMER_TESTIMONIALS', 'Customer Testimonials');
define('TABLE_HEADING_TESTIMONIALS_ID', 'ID');
define('TABLE_HEADING_TESTIMONIALS_NAME', 'Name');
define('TABLE_HEADING_TESTIMONIALS_DESCRIPTION', 'Customer Testimonial');
define('TEXT_READ_MORE', '(read more)');
define('TEXT_TESTIMONY_TITLE', 'Title: ');
define('TEXT_TESTIMONY_BY', 'Testimonial by: ');
define('TEXT_TESTIMONY_DATE_ADDED', 'Date added: ');
define('TEXT_TESTIMONY_OF', ' of ');
define('TEXT_MAILTO', 'mailto:');
define('TEXT_EMAIL_AUTHOR', 'Click to email the author');
define('TEXT_TESTIMONIAL_BY', 'Placed by');

// reference mananger
define('BOX_HEADING_REFERENCES', 'Company References');
define('TABLE_HEADING_REFERENCES_ID', 'ID');
define('TABLE_HEADING_REFERENCES_NAME', 'Name');
define('TABLE_HEADING_REFERENCES_DESCRIPTION', 'Company References');
define('TEXT_READ_MORE', '(read more)');
define('TEXT_REFERENCES_TITLE', 'Title: ');
define('TEXT_REFERENCES_BY', 'Reference by: ');
define('TEXT_REFERENCES_DATE_ADDED', 'Date added: ');
define('TEXT_REFERENCES_OF', ' of ');
define('TEXT_MAILTO', 'mailto:');
define('TEXT_EMAIL_AUTHOR', 'Click to email the author');
define('TEXT_REFERENCES_BY', 'Placed by');

// product listing enhanced
define('TABLE_HEADING_DETAIL', 'Click For More');
define('TEXT_POA', '<span class="list_info">P.O.A<span>Price On Application</span></span>');
define('IMAGE_BUTTON_DETAILS', 'Product Details'); 
define('PRODUCT_ADDED', 'Product succesfully added to shoppingcart.');
define('NUM_ORDER', ', Low to High');
define('APHA_ORDER', '');
define('REVERSE_ALPHA_ORDER', ', Reverse');
define('REVERSE_NUM_ORDER', ', High to Low');
define('DATE_ORDER', 'Date Added');
define('LIST_VIEW', 'List View');
define('THUMB_VIEW', 'Thumbnail View');
define('WEIGHT_ABRV', 'Kg');
define('MULTI_ADD_ALT','Add all quantities to the cart');
define('TEXT_QUANTITY','Quantity: ');
define('TEXT_STOCK', 'In Stock: ');
define('TEXT_WEIGHT', 'Weight: ');
define('MORE','More');
define('LESS','Less');

// points and rewards
define('BOX_INFORMATION_MY_POINTS_HELP', 'here');
define('REDEEM_SYSTEM_ERROR_POINTS_NOT', 'Points value are not enough to cover the cost of your purchase. Please select another payment method');
define('REDEEM_SYSTEM_ERROR_POINTS_OVER', 'REDEEM POINTS ERROR ! Points value can not be over the total value. Please Re enter points');
define('REFERRAL_ERROR_SELF', 'Sorry you can not refer yourself.');
define('REFERRAL_ERROR_NOT_VALID', 'The referral email does not appear to be valid - please make any necessary corrections.');
define('REFERRAL_ERROR_NOT_FOUND', 'The referral email address you entered was not found.');
define('TEXT_POINTS_BALANCE', 'Points Status');
define('TEXT_POINTS', 'Points :');
define('TEXT_VALUE', 'Value:');
define('REVIEW_HELP_LINK', ' Write a Review and earn <b>%s</b> worth of points.<br />Please check the %s for more information.');

// store modus
define('CLOSED_MESSAGE', STORE_NAME . ' is temporarily <u>closed</u>. You may create a ' . STORE_NAME . ' account, login to your ' . STORE_NAME . ' account, and add products to your shopping cart. Your shopping cart will be saved for delayed checkout.<br><br>We plan to reopen: ');
define('OFFLINE_MESSAGE_1', 'Notice: ' . STORE_NAME . ' will be offline from '); // the message customers will see when the Offline Warning is enabled in the admin
define('OFFLINE_MESSAGE_2', ' to '); // conjunction for customer message
define('ADMIN_OFFLINE_MESSAGE', 'Reminder: ' . STORE_NAME . ' is currently offline for maintenance. Customers are expecting ' . STORE_NAME . ' to be online by '); // the message you (the administrator) will see in the catalog when the store is offline for maintenance

// must agree terms of conditions
define('MATC_CONDITION_AGREEMENT', 'I have read the <a href="%s" target="_blank"><strong><u>Terms &amp; Conditions</u></strong></a> and I agree to them: ');
define('MATC_HEADING_CONDITIONS', 'Terms and Conditions Agreement');
define('MATC_ERROR', 'You must agree to our terms and conditions in order to continue.');

// quantity price breaks
define('MINIMUM_ORDER_NOTICE', 'Minimum order amount for %s is %d. Your cart has been updated to reflect this.');
define('QUANTITY_BLOCKS_NOTICE', '%s can only by ordered in multiples of %d. Your cart has been updated to reflect this.');

// quotes
define('BOX_INFORMATION_QUOTES', 'Quotes');
define('TEXT_QUOTES_ACTIVE', 'Active');
define('TEXT_QUOTES_PAID', 'Paid');
define('TEXT_QUOTES_EXPIRED', 'Expired');
define('TEXT_QUOTES_CUSTOMER', 'ID');
define('TEXT_QUOTES_DATE_ADDED', 'Date Quoted');
define('TEXT_QUOTES_STATUS', 'Status');
define('TEXT_QUOTES_NEED_LOGIN', 'Please <a class="quotesLink" href="' . tep_href_link(FILENAME_LOGIN, '', SSL) . '">login</a> to view your quotes.');
define('TEXT_QUOTES_NONE_FOUND', 'There are not any quotes available at this time.');
define('TEXT_QUOTES_RESPONSE', 'Our Quote');
define('TEXT_REQUEST_A_QUOTE', 'To request a Quote, please click <a class="quotesLink" title="Request A Quote" href="' . tep_href_link(FILENAME_REQUEST_A_QUOTE, '', 'NONSSL') . '"> here.</a>');

// credit class gift vouchers
define('BOX_INFORMATION_GV', 'Gift Voucher FAQ');
define('VOUCHER_BALANCE', 'Voucher Balance');
define('BOX_HEADING_GIFT_VOUCHER', 'Gift Voucher Account'); 
define('GV_FAQ', 'Gift Voucher FAQ');
define('ERROR_REDEEMED_AMOUNT', 'The coupon has been successfully added to your shopping cart! ');
define('ERROR_NO_REDEEM_CODE', 'You did not enter a redeem code.');  
define('ERROR_NO_INVALID_REDEEM_GV', 'Invalid Gift Voucher Code'); 
define('TABLE_HEADING_CREDIT', 'Gift Vouchers &amp; Coupons');
define('GV_HAS_VOUCHERA', 'You have funds in your Gift Voucher Account. If you want <br>
                         you can send those funds by <a class="pageResults" href="');
       
define('GV_HAS_VOUCHERB', '"><b>email</b></a> to someone'); 
define('ENTRY_AMOUNT_CHECK_ERROR', 'You do not have enough funds to send this amount.'); 
define('BOX_SEND_TO_FRIEND', 'Send Gift Voucher');

define('VOUCHER_REDEEMED', 'Voucher Redeemed');
define('CART_COUPON', 'Coupon :');
define('CART_COUPON_INFO', 'more info');

define('MODULE_ORDER_TOTAL_COUPON_TEXT_ERROR', 'Coupon Redemption');
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
define('HINT_CREATE_ACCOUNT_PASSWORD', 'Vul hier je wachtwoord in (min '.ENTRY_PASSWORD_MIN_LENGTH.' letter/cijfer).');
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
define('HINT_CREATE_ACCOUNT_COMPANY_ID', 'Indien aanwezig uw klantnummer.');
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
define('CHECKOUT_BAR_DELIVERY', 'Delivery Information');
define('CHECKOUT_BAR_PAYMENT', 'Payment Information');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation');
define('CHECKOUT_BAR_FINISHED', 'Finished!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select');
define('PULL_DOWN_OTHER', 'Other - (please specifiy)');
define('TYPE_BELOW', 'Type Below');

// in out stock images
define('TEXT_SOLDOUT', 'Not in Stock');
define('TEXT_SOLDOUT_1', 'Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us when you are  <br>interested in this product.');
define('TEXT_STOCK_1', 'Still 1 in Stock');
define('TEXT_INSTOCK_1', 'Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us when you need <br>more than <b>1</b> of this product.');
define('TEXT_STOCK_2', 'Still 2 in Stock');
define('TEXT_INSTOCK_2', 'Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us when you need <br>more than <b>2</b> of this product.');
define('TEXT_STOCK_3', 'Still 3 in Stock');
define('TEXT_INSTOCK_3', 'Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us when you need <br>more than <b>3</b> of this product.');
define('TEXT_STOCK_4', 'Still 4 in Stock');
define('TEXT_INSTOCK_4', 'Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us when you need <br>more than <b>4</b> of this product.');
define('TEXT_STOCK_5', 'Still 5 in Stock');
define('TEXT_INSTOCK_5', 'Please <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>contact</u></a> us when you need <br>more than <b>5</b> of this product.');
define('TEXT_STOCK_6', 'Still 6 in Stock');
define('TEXT_INSTOCK_6', 'Still <b>6</b> in Stock');
define('TEXT_STOCK_7', 'Still 7 in Stock');
define('TEXT_INSTOCK_7', 'Still <b>7</b> in Stock');
define('TEXT_STOCK_8', 'Still 8 in Stock');
define('TEXT_INSTOCK_8', 'Still <b>8</b> in Stock');
define('TEXT_STOCK_9', 'Still 9 in Stock');
define('TEXT_INSTOCK_9', 'Still <b>9</b> in Stock');
define('TEXT_STOCK_10', 'Still 10 in Stock');
define('TEXT_INSTOCK_10', 'Still <b>10</b> in Stock');
define('TEXT_STOCK_11', 'Still 11 in Stock');
define('TEXT_INSTOCK_11', 'Still <b>11</b> in Stock');
define('TEXT_STOCK_12', 'Still 12 in Stock');
define('TEXT_INSTOCK_12', 'Still <b>12</b> in Stock');
define('TEXT_STOCK_13', 'Still 13 in Stock');
define('TEXT_INSTOCK_13', 'Still <b>13</b> in Stock');
define('TEXT_STOCK_14', 'Still 14 in Stock');
define('TEXT_INSTOCK_14', 'Still <b>14</b> in Stock');
define('TEXT_STOCK_15', 'Still 15 in Stock');
define('TEXT_INSTOCK_15', 'Still <b>15</b> in Stock');
define('TEXT_STOCK_16', 'Still 16 in Stock');
define('TEXT_INSTOCK_16', 'Still <b>16</b> in Stock');
define('TEXT_STOCK_17', 'Still 17 in Stock');
define('TEXT_INSTOCK_17', 'Still <b>17</b> in Stock');
define('TEXT_STOCK_18', 'Still 18 in Stock');
define('TEXT_INSTOCK_18', 'Still <b>18</b> in Stock');
define('TEXT_STOCK_19', 'Still 19 in Stock');
define('TEXT_INSTOCK_19', 'Still <b>19</b> in Stock');
define('TEXT_STOCK_20', 'Still 20 in Stock');
define('TEXT_INSTOCK_20', 'Still <b>20</b> in Stock');
define('TEXT_STOCK_21', 'Still 21 in Stock');
define('TEXT_INSTOCK_21', 'Still <b>21</b> in Stock');
define('TEXT_STOCK_22', 'Still 22 in Stock');
define('TEXT_INSTOCK_22', 'Still <b>22</b> in Stock');
define('TEXT_STOCK_23', 'Still 23 in Stock');
define('TEXT_INSTOCK_23', 'Still <b>23</b> in Stock');
define('TEXT_STOCK_24', 'Still 24 in Stock');
define('TEXT_INSTOCK_24', 'Still <b>24</b> in Stock');
define('TEXT_STOCK_25', 'Still 25 in Stock');
define('TEXT_INSTOCK_25', 'Still <b>25</b> in Stock');
define('TEXT_STOCK_0', 'Still more than 25 in Stock');
define('TEXT_INSTOCK_0', 'Still more than <b>25</b> in Stock.');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form.\n\nPlease make the following corrections:\n\n');
define('JS_REVIEW_TEXT', '* The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n');
define('JS_REVIEW_RATING', '* You must rate the product for your review.\n');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Please select a payment method for your order.\n');
define('JS_ERROR_SUBMITTED', 'This form has already been submitted. Please press Ok and wait for this process to be completed.');
define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Please select a payment method for your order.');

// create account categories
define('CATEGORY_COMPANY', 'Company Details');
define('CATEGORY_PERSONAL', 'Your Personal Details');
define('CATEGORY_ADDRESS', 'Your Address');
define('CATEGORY_CONTACT', 'Your Contact Information');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_SOURCE', 'Referral Source');
define('CATEGORY_PASSWORD', 'Your Password');

// create account entries
define('ENTRY_COMPANY', 'Company Name:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_TAX_ID', 'Company number');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', 'Please select your Gender.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', 'Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_INSERTION_NAME', 'insertion:');
define('ENTRY_INSERTION_NAME_TEXT', '');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', 'Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (eg. 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Your E-Mail Address does not appear to be valid - please make any necessary corrections.');
define('ENTRY_CONFIRM_EMAIL_ADDRESS', 'Confirm E-Mail Address:');
define('ENTRY_CONFIRM_EMAIL_ADDRESS_CHECK_ERROR', 'The E-Mail Address fields do not match.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Your E-Mail Address already exists in our records - please log in with the e-mail address or create an account with a different address.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_STREET_NO', 'Housenumber:');
define('ENTRY_STREET_NO_ERROR', 'Your Housenumber must contain a minimum of' . ENTRY_STREET_NO_MIN_LENGTH . ' characters.');
define('ENTRY_STREET_NO_TEXT', '*');
define('ENTRY_STREET_NO_ADD', 'addition:');
define('ENTRY_STREET_NO_ADD_TEXT', '');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', 'Your Post Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', 'Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'State/Province:');
define('ENTRY_STATE_ERROR', 'Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', 'You must select a country from the Countries pull down menu.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'The Password Confirmation must match your Password.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Current Password:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW', 'New Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'The Password Confirmation must match your new Password.');
define('PASSWORD_HIDDEN', '--HIDDEN--');
define('ENTRY_SOURCE', 'How did you hear about us:');
define('ENTRY_SOURCE_ERROR', 'Please select how you first heard about us.');
define('ENTRY_SOURCE_OTHER', '(if "Other" please specify)');
define('ENTRY_SOURCE_OTHER_ERROR', 'Please enter how you first heard about us.');
if (REFERRAL_REQUIRED == 'true') {
  define('ENTRY_SOURCE_TEXT', '*');
  define('ENTRY_SOURCE_OTHER_TEXT', '*');
} else {
  define('ENTRY_SOURCE_TEXT', '');
  define('ENTRY_SOURCE_OTHER_TEXT', '');
}
define('FORM_REQUIRED_INFORMATION', '* Required information');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Result Pages:');
define('TEXT_SHOW_MORE', '(<u>read&nbsp;more</u>)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> reviews)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new products)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> specials)');
define('TEXT_DISPLAY_NUMBER_OF_FREE_DOWNLOADS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> free downloads)');
define('TEXT_PAGE', 'Page ');
define('TEXT_PAGE_OF', ' of ');
define('TEXT_PAGE_START', ' (begin) ');
define('PREVNEXT_TITLE_FIRST_PAGE', 'First Page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Previous Page');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Next Page');
define('PREVNEXT_TITLE_LAST_PAGE', 'Last Page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Previous Set of %d Pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Next Set of %d Pages');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;FIRST');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Prev]');
define('PREVNEXT_BUTTON_NEXT', '[Next&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'LAST&gt;&gt;');

// button image text
define('IMAGE_BUTTON_ACTIVATE_ACCOUNT', 'Activate Account');
define('IMAGE_BUTTON_ADD_ADDRESS', 'Add Address');
define('IMAGE_BUTTON_ADD_NOW', 'Add');
define('IMAGE_BUTTON_ADD_PRESENT', 'Add Present');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Address Book');
define('IMAGE_BUTTON_ADVANCED_SEARCH', 'Advanced Search');
define('IMAGE_BUTTON_AFFILIATE_BANNERS', 'Banners');
define('IMAGE_BUTTON_AFFILIATE_BUILD_A_LI', 'Build');
define('IMAGE_BUTTON_AFFILIATE_BUILD_A_LINK', 'Build Link');
define('IMAGE_BUTTON_AFFILIATE_CLICKTHROUGHS', 'ClickThroughs');
define('IMAGE_BUTTON_AFFILIATE_JOIN', 'Join Affiliate');
define('IMAGE_BUTTON_AFFILIATE_PAYMENT', 'affiliate Payments');
define('IMAGE_BUTTON_AFFILIATE_PRODUCT', 'Affiliate Products');
define('IMAGE_BUTTON_AFFILIATE_SALES', 'Affiliate Sales');
define('IMAGE_BUTTON_AFFILIATE_TEXT', 'Affiliate Text');
define('IMAGE_BUTTON_BACK', 'Back');
define('IMAGE_BUTTON_BUY_NOW', 'Buy Now');
define('IMAGE_BUTTON_BUY_ALSO', 'Buy Also');
define('IMAGE_BUTTON_CATEGORIES', 'Categories');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Change Address');
define('IMAGE_BUTTON_CHECKOUT', 'Checkout');
define('IMAGE_BUTTON_CONFIRM', 'Confirm');
define('IMAGE_BUTTON_CONFIRM_COUPON', 'Confirm Coupon');
define('IMAGE_BUTTON_CONFIRM_CREATE_ACCOUNT', 'Confirm Create Account');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirm Order');
define('IMAGE_BUTTON_CONFIRM_QUESTION', 'Confirm Request');
define('IMAGE_BUTTON_CONFIRM_REQUEST', 'Confirm Request');
define('IMAGE_BUTTON_CONFIRM_RETOUR_REQUEST', 'Confirm retour request');
define('IMAGE_BUTTON_CONTINUE', 'Continue');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continue Shopping');
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Create Account');
define('IMAGE_BUTTON_DELETE', 'Delete');
define('IMAGE_BUTTON_DELETE_WISHLIST', 'Delete from Wishlist');
define('IMAGE_BUTTON_DOWNLOAD', 'Download');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Edit Account');
define('IMAGE_BUTTON_HISTORY', 'Order History');
define('IMAGE_BUTTON_LOGIN', 'Sign In');
define('IMAGE_BUTTON_LOGOFF', 'Log Off');
define('IMAGE_BUTTON_MORE', 'more...');
define('IMAGE_BUTTON_MORE_INFO', 'more info...');
define('IMAGE_BUTTON_NEXT', 'Next');
define('IMAGE_BUTTON_IN_CART', 'Add to Cart');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notifications');
define('IMAGE_BUTTON_ORDER_HISTORY', 'Order History');
define('IMAGE_BUTTON_OUT_OF_STOCK', 'Out of Stock');
define('IMAGE_BUTTON_PRINT_ORDER', 'Print INvoice');
define('IMAGE_BUTTON_PRODUCT_INFO', 'Product Info');
define('IMAGE_BUTTON_QUICK_FIND', 'Quick Find');
define('IMAGE_BUTTON_REACTIONS', 'Reactions');
define('IMAGE_BUTTON_REDEEM', 'Redeem');
define('IMAGE_BUTTON_REGISTER', 'Register');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remove Notifications');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Remove Item from Cart?');
define('IMAGE_BUTTON_RESPONSE', 'Response');
define('IMAGE_BUTTON_REVIEWS', 'Reviews');
define('IMAGE_BUTTON_SEARCH', 'Search');
define('IMAGE_BUTTON_SEARCH_URL', 'Search Url');
define('IMAGE_BUTTON_SEND', 'Send');
define('IMAGE_BUTTON_SEND_LINK', 'Send Link');
define('IMAGE_BUTTON_SEND_MESSAGE', 'Send Message');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Shipping Options');
define('IMAGE_BUTTON_SHOW_CART', 'Show Cart');
define('IMAGE_BUTTON_SOLD_OUT', 'Sold Out');
define('IMAGE_BUTTON_SORT_PRODUCTS', 'Sort Products');
define('IMAGE_BUTTON_SUBMIT', 'Submit to ' . STORE_NAME);
define('IMAGE_BUTTON_SUBMIT_LINK', 'Submit link to ' . STORE_NAME);
define('IMAGE_BUTTON_SUBMIT_TESTIMONIAL', 'Submit testimonial to ' . STORE_NAME);
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Tell a Friend');
define('IMAGE_BUTTON_UNSUBSCRIBE', 'Unsubscribe Newsletter');
define('IMAGE_BUTTON_UPDATE', 'Update');
define('IMAGE_BUTTON_UPDATE_CART', 'Update Cart');
define('IMAGE_BUTTON_VIEW', 'View');
define('IMAGE_BUTTON_WRITE_REFERENCES', 'Write an Reference');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Write an Review');
define('IMAGE_BUTTON_WRITE_TESTIMONIAL', 'Write an Testimonial');
define('IMAGE_BUTTON_WISHLIST', 'Put in My Wishlist');

// small button image text
define('IMAGE_BUTTON_SMALL_BUY_NOW', '');
define('IMAGE_BUTTON_SMALL_DELETE', '');
define('IMAGE_BUTTON_SMALL_EDIT', '');
define('IMAGE_BUTTON_SMALL_IN_CART', '');
define('IMAGE_BUTTON_SMALL_OUT_OF_STOCK', '');
define('IMAGE_BUTTON_SMALL_SEARCH', '');
define('IMAGE_BUTTON_SMALL_SOLD_OUT', '');
define('IMAGE_BUTTON_SMALL_UPDATE_CART', '');
define('IMAGE_BUTTON_SMALL_VIEW', '');

// icon image text
define('ICON_ARROW_RIGHT', 'more');
define('ICON_CART', 'In Cart');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Warning');

// index default greeting text
define('TEXT_GREETING_PERSONAL', 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?');
define('TEXT_GREETING_PERSONAL_BOX', 'Welcome Back, <span class="greetUser">%s</span><br>');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>');
define('TEXT_GREETING_GUEST', 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?');
define('TEXT_GREETING_PRICES', 'Prices can only be seen when logged in on account!');

// sort products
define('TEXT_SORT_PRODUCTS', 'Sort products ');
define('TEXT_DESCENDINGLY', 'descendingly');
define('TEXT_ASCENDINGLY', 'ascendingly');
define('TEXT_BY', ' by ');
define('TEXT_SEE_MORE', 'See More');

// review system
define('TEXT_REVIEW_BY', 'by %s');
define('TEXT_REVIEW_WORD_COUNT', '%s words');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date Added: %s');
define('TEXT_NO_REVIEWS', '<center><b>Are you the first to write a review?</center></b>');
define('TEXT_NO_NEW_PRODUCTS', '<center><b>There are currently no products.</b></center>');
define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate');
define('TEXT_REQUIRED', '<span class="errorText">* Required</span>');
define('TEXT_LOG_IN_TO_SEE_PRICE', 'Log In for Price!');
define('TEXT_ERROR', '<span class="errorText">* error</span>');

// project errors
define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', '<font color=red><b>Warning!</b></font> Installation directory exists at: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. <b>Please remove this directory for security reasons.</b>');
define('WARNING_CONFIG_FILE_WRITEABLE', '<font color=red><b>Warning!</b></font> I am able to write to the configuration file: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. <b>Change the file permissions back to "read only" (644)!</b>');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', '<font color=red><b>Warning!</b></font> The sessions directory does not exist: ' . tep_session_save_path() . '. Sessions will not work until this directory is created.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', '<font color=red><b>Warning!</b></font> I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.');
define('WARNING_SESSION_AUTO_START', '<font color=red><b>Warning!</b></font> session.auto_start is enabled - please disable this php feature in php.ini and restart the web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', '<font color=red><b>Warning!</b></font> The downloadable products directory does not exist: ' . DIR_FS_DOWNLOAD . '. Downloadable products will not work until this directory is valid.');

// credit card errors
define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.');

// footer text
define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="http://' . STORE_URL . '" target="_blank">' . PROJECT_VERSION . '</a><br>Based on <a href="http://www.oscommerce.com" target="_blank">osCommerce</a> :: Hosted by <a href="http://www.hilvy.nl" target="_blank">HILVY</a>');

//require(DIR_WS_LANGUAGES . 'mail_english.php');
?>
