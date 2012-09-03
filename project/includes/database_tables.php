<?php //$Id: /catalog/includes/database_tables.php

// this will define the maximum time in minutes between updates of a products_group_prices_cg_# table
// changes in table specials will trigger an immediate update if a query needs this particular table
  define('MAXIMUM_DELAY_UPDATE_PG_PRICES_TABLE', '15'); //SPPC

// define the database table names used in the project
  define('TABLE_2GETHER', 'products_2gether');
  define('TABLE_ADDITIONAL_IMAGES', 'additional_images');
  define('TABLE_ADDRESS_BOOK', 'address_book');
  define('TABLE_ADDRESS_FORMAT', 'address_format');
  define('TABLE_ADMINISTRATORS', 'administrators');
  define('TABLE_ANTI_ROBOT_REGISTRATION', 'anti_robotreg');
  define('TABLE_ARTICLES', 'articles');
  define('TABLE_ARTICLES_DESCRIPTION', 'articles_description');
  define('TABLE_ARTICLES_TO_TOPICS', 'articles_to_topics');
  define('TABLE_ARTICLES_BLOG', 'articles_blog');
  define('TABLE_AUTHORS', 'authors');
  define('TABLE_AUTHORS_INFO', 'authors_info');
  define('TABLE_ARTICLE_REVIEWS', 'article_reviews');
  define('TABLE_ARTICLE_REVIEWS_DESCRIPTION', 'article_reviews_description');
  define('TABLE_ARTICLES_XSELL', 'articles_xsell');
  define('TABLE_BANNERS', 'banners');
  define('TABLE_BANNERS_HISTORY', 'banners_history');
  define('TABLE_BANNERS_TO_CATEGORIES', 'banners_to_categories');
  define('TABLE_CARROT', 'free_gifts');
  define('TABLE_CATEGORIES', 'categories');
  define('TABLE_CATEGORIES_DESCRIPTION', 'categories_description');
  define('TABLE_CONFIGURATION', 'configuration');
  define('TABLE_CONFIGURATION_GROUP', 'configuration_group');
  define('TABLE_COUNTER', 'counter');
  define('TABLE_COUNTER_HISTORY', 'counter_history');
  define('TABLE_COUNTRIES', 'countries');
  define('TABLE_COUPON_EMAIL_TRACK', 'coupon_email_track');
  define('TABLE_COUPON_GV_CUSTOMER', 'coupon_gv_customer');
  define('TABLE_COUPON_GV_QUEUE', 'coupon_gv_queue');
  define('TABLE_COUPON_REDEEM_TRACK', 'coupon_redeem_track');
  define('TABLE_COUPONS', 'coupons');
  define('TABLE_COUPONS_DESCRIPTION', 'coupons_description');
  define('TABLE_CURRENCIES', 'currencies');
  define('TABLE_CUSTOMERS', 'customers');
  define('TABLE_CUSTOMERS_BASKET', 'customers_basket');
  define('TABLE_CUSTOMERS_BASKET_ATTRIBUTES', 'customers_basket_attributes');
  define('TABLE_CUSTOMERS_GROUPS', 'customers_groups');
  define('TABLE_CUSTOMERS_INFO', 'customers_info');
  define('TABLE_CUSTOMERS_POINTS_PENDING', 'customers_points_pending');
  define('TABLE_CUSTOMER_TESTIMONIALS', 'customer_testimonials');
  define('TABLE_DISCOUNT_CATEGORIES', 'discount_categories');
  define('TABLE_DOCUMENTS', 'documents');
  define('TABLE_DOCUMENT_TYPES', 'document_types');
  define('TABLE_FAQ_REVIEWS', 'faq_reviews');
  define('TABLE_FAQ_REVIEWS_DESCRIPTION', 'faq_reviews_description');
  define('TABLE_FAQ', 'faq');
  define('TABLE_FAQS', 'faqs');
  define('TABLE_FAQS_DESCRIPTION', 'faqs_description');
  define('TABLE_FAQS_TO_TOPICS', 'faqs_to_topics');
  define('TABLE_FAQS_BLOG', 'faqs_blog');
  define('TABLE_FAQS_AUTHORS', 'faqs_authors');
  define('TABLE_FAQS_AUTHORS_INFO', 'faqs_authors_info');
  define('TABLE_FAQS_REVIEWS', 'faqs_reviews');
  define('TABLE_FAQS_REVIEWS_DESCRIPTION', 'faqs_reviews_description');
  define('TABLE_FAQS_XSELL', 'faqs_xsell');
  define('TABLE_FAQS_TOPICS', 'faqs_topics');
  define('TABLE_FAQS_TOPICS_DESCRIPTION', 'faqs_topics_description');
  define('TABLE_FEATURED', 'featured');
  define('TABLE_GALLERY', 'gallery');
  define('TABLE_GALLERY_SUPERUSERS', 'gallery_superusers');
  define('TABLE_GET_1_FREE', 'get_1_free');
  define('TABLE_G_INFO', 'g_info');
  define('TABLE_G_INFO_DESCRIPTION', 'g_info_description');
  define('TABLE_G_INFO_TO_TOPICS', 'g_info_to_topics');
  define('TABLE_G_INFO_BLOG', 'g_info_blog');
  define('TABLE_G_INFO_AUTHORS', 'g_info_authors');
  define('TABLE_G_INFO_AUTHORS_INFO', 'g_info_authors_info');
  define('TABLE_G_INFO_REVIEWS', 'g_info_reviews');
  define('TABLE_G_INFO_REVIEWS_DESCRIPTION', 'g_info_reviews_description');
  define('TABLE_G_INFO_XSELL', 'g_info_xsell');
  define('TABLE_G_INFO_TOPICS', 'g_info_topics');
  define('TABLE_G_INFO_TOPICS_DESCRIPTION', 'g_info_topics_description');
  define('TABLE_HEADERTAGS', 'headertags');
  define('TABLE_HEADERTAGS_CACHE', 'headertags_cache');
  define('TABLE_HEADERTAGS_DEFAULT', 'headertags_default');
  define('TABLE_HEADERTAGS_SILO', 'headertags_silo');
  define('TABLE_LANGUAGES', 'languages');
  define('TABLE_LINK_CATEGORIES', 'link_categories');
  define('TABLE_LINK_CATEGORIES_DESCRIPTION', 'link_categories_description');
  define('TABLE_LINKS', 'links');
  define('TABLE_LINKS_DESCRIPTION', 'links_description');
  define('TABLE_LINKS_EXCHANGE', 'links_exchange');
  define('TABLE_LINKS_TO_LINK_CATEGORIES', 'links_to_link_categories');
  define('TABLE_LINKS_FEATURED', 'links_featured');
  define('TABLE_MANUFACTURERS', 'manufacturers');
  define('TABLE_MANUFACTURERS_INFO', 'manufacturers_info');
  define('TABLE_ORDERS', 'orders');
  define('TABLE_ORDERS_PRODUCTS', 'orders_products');
  define('TABLE_ORDERS_PRODUCTS_ATTRIBUTES', 'orders_products_attributes');
  define('TABLE_ORDERS_PRODUCTS_DOWNLOAD', 'orders_products_download');
  define('TABLE_ORDERS_STATUS', 'orders_status');
  define('TABLE_ORDERS_STATUS_HISTORY', 'orders_status_history');
  define('TABLE_ORDERS_TOTAL', 'orders_total');
  define('TABLE_PAGES', 'pages');
  define('TABLE_PAGES_DESCRIPTION', 'pages_description');
  define('TABLE_PRODUCTS', 'products');
  define('TABLE_PRODUCTS_ATTRIBUTES', 'products_attributes');
  define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD', 'products_attributes_download');
  define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS', 'products_attributes_download_groups');
  define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES', 'products_attributes_download_groups_files');
  define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES', 'products_attributes_download_groups_to_files');
  define('TABLE_PRODUCTS_ATTRIBUTES_GROUPS', 'products_attributes_groups');
  define('TABLE_PRODUCTS_DESCRIPTION', 'products_description');
  define('TABLE_PRODUCTS_GROUPS', 'products_groups');
  define('TABLE_PRODUCTS_GROUP_PRICES', 'products_group_prices_cg_');
  define('TABLE_PRODUCTS_NOTIFICATIONS', 'products_notifications');
  define('TABLE_PRODUCTS_OPTIONS', 'products_options');
  define('TABLE_PRODUCTS_OPTIONS_VALUES', 'products_options_values');
  define('TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS', 'products_options_values_to_products_options');
  define('TABLE_PRODUCTS_PRICE_BREAK', 'products_price_break');
  define('TABLE_PRODUCTS_STOCK', 'products_stock');
  define('TABLE_PRODUCTS_TO_CATEGORIES', 'products_to_categories');
  define('TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES', 'products_to_discount_categories');
  define('TABLE_PRODUCTS_TO_DOCUMENTS', 'products_to_documents');
  define('TABLE_PRODUCTS_RELATED_PRODUCTS', 'products_related_products');
  define('TABLE_QUOTES', 'quotes');
  define('TABLE_RETURN_REASONS', 'return_reasons');
  define('TABLE_RETURNS', 'returned_products');
  define('TABLE_RETURNS_STATUS', 'returns_status');
  define('TABLE_RETURNS_TEXT', 'return_text');
  define('TABLE_RETURNS_TOTAL', 'returns_total');
  define('TABLE_RETURNS_PRODUCTS_DATA', 'returns_products_data');
  define('TABLE_RETURN_PAYMENTS', 'refund_payments');
  define('TABLE_REFUND_METHOD', 'refund_method');
  define('TABLE_RETURNS_STATUS_HISTORY', 'returns_status_history');
  define('TABLE_REVIEWS', 'reviews');
  define('TABLE_REVIEWS_DESCRIPTION', 'reviews_description');
  define('TABLE_SESSIONS', 'sessions');
  define('TABLE_SHOP_REFERENCES', 'shop_references');
  define('TABLE_SITEMAP_EXCLUDE', 'sitemap_exclude');
  define('TABLE_SOURCES', 'sources');
  define('TABLE_SOURCES_OTHER', 'sources_other');
  define('TABLE_SPECIALS', 'specials');
  define('TABLE_SPECIALS_RETAIL_PRICES', 'specials_retail_prices');
  define('TABLE_TAX_CLASS', 'tax_class');
  define('TABLE_TAX_RATES', 'tax_rates');
  define('TABLE_THEME_CONFIGURATION', 'theme_configuration');
  define('TABLE_TICKET_DEPARTMENT', 'ticket_department');
  define('TABLE_TICKET_PRIORITY', 'ticket_priority');
  define('TABLE_TICKET_STATUS', 'ticket_status');
  define('TABLE_TICKET_STATUS_HISTORY', 'ticket_status_history');
  define('TABLE_TICKET_TICKET', 'ticket_ticket');
  define('TABLE_TOPICS', 'topics');
  define('TABLE_TOPICS_DESCRIPTION', 'topics_description');
  define('TABLE_GEO_ZONES', 'geo_zones');
  define('TABLE_ZONES_TO_GEO_ZONES', 'zones_to_geo_zones');
  define('TABLE_WISHLIST', 'customers_wishlist');
  define('TABLE_WISHLIST_ATTRIBUTES', 'customers_wishlist_attributes');
  define('TABLE_WHOS_ONLINE', 'whos_online');
  define('TABLE_ZONES', 'zones');
?>
