<?php // $Id: /catalog/admin/includes/configure.php

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', ''); // eg, http://localhost or - https://localhost should not be NULL for productive servers
  define('HTTP_CATALOG_SERVER', '');
  define('HTTPS_CATALOG_SERVER', '');
  define('ENABLE_SSL_CATALOG', 'false'); // secure webserver for catalog module
  define('DIR_FS_DOCUMENT_ROOT', $DOCUMENT_ROOT); // where your pages are located on the server. if $DOCUMENT_ROOT doesnt suit you, replace with your local path. (eg, /usr/local/apache/htdocs)
  define('DIR_WS_ADMIN', '/admin/');
  define('DIR_FS_ADMIN', DIR_FS_DOCUMENT_ROOT . DIR_WS_ADMIN);
  define('DIR_WS_CATALOG', '/catalog/');
  define('DIR_FS_CATALOG', DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG);
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_MANUAL_BOXES', DIR_WS_INCLUDES . 'manual_boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_WS_DOCUMENTS', 'documents/');
  define('DIR_FS_CATALOG_DOCUMENTS', DIR_FS_CATALOG . 'documents/');
  define('DIR_FS_CATALOG_DOWNLOAD', DIR_FS_CATALOG . 'download/');

// define our database connection
  define('DB_SERVER', ''); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'mysql');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'osshoppy');
  define('USE_PCONNECT', 'false'); // use persisstent connections?
  define('STORE_SESSIONS', ''); // leave empty '' for default handler or set to 'mysql'
?>