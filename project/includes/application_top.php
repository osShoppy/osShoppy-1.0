<?php // $Id: /catalog/includes/application_top.php (osC)

// define the project version
  define('PROJECT_VERSION', 'osShoppy v1.0 Beta');
  define('PROJECT_VERSION_DATE', '26-12-2011');
  define('NEXT_PROJECT_VERSION', 'osShoppy v2.0 Beta');
  define('NEXT_PROJECT_VERSION_DATE', 'December 2014');

// start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());

// set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);

// check if register_globals is enabled.
  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');

  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// set the type of request (secure or not)
  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

//// Ultimate SEO url's 5 PRO
/* original ->
// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $HTTP_SERVER_VARS['PHP_SELF'];
*/
  function usu5_base_filename() {
    // Probably won't get past SCRIPT_NAME unless this is reporting cgi location
    $base = new ArrayIterator( array( 'SCRIPT_NAME', 'PHP_SELF', 'REQUEST_URI', 'ORIG_PATH_INFO', 'HTTP_X_ORIGINAL_URL', 'HTTP_X_REWRITE_URL' ) );
    while ( $base->valid() ) {
      if ( array_key_exists(  $base->current(), $_SERVER ) && !empty(  $_SERVER[$base->current()] ) ) {
        if ( false !== strpos( $_SERVER[$base->current()], '.php' ) ) {
          preg_match( '@[a-z0-9_]+\.php@i', $_SERVER[$base->current()], $matches );
          if ( is_array( $matches ) && ( array_key_exists( 0, $matches ) )
                                    && ( substr( $matches[0], -4, 4 ) == '.php' )
                                    && ( is_readable( $matches[0] ) ) ) {
            return $matches[0];
          } 
        } 
      }
      $base->next();
    }
    // Some odd server set ups return / for SCRIPT_NAME and PHP_SELF when accessed as mysite.com (no index.php) where they usually return /index.php
    if ( ( $_SERVER['SCRIPT_NAME'] == '/' ) || ( $_SERVER['PHP_SELF'] == '/' ) ) {
      return 'index.php';
    }
    // Return the standard RC3 code 
    return ( ( ( strlen( ini_get( 'cgi.fix_pathinfo' ) ) > 0) && ( (bool)ini_get( 'cgi.fix_pathinfo' ) == false ) ) || !isset( $_SERVER['SCRIPT_NAME'] ) ) ? basename( $_SERVER['PHP_SELF'] ) : basename( $_SERVER['SCRIPT_NAME'] );
  } // End function
// set php_self in the local scope
  $PHP_SELF = usu5_base_filename();

  if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
  } else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
  }

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
//defined in admin panel  define('INPUT_SEARCH', 100); // how wide the search box should be in pixels in header(default: 125)
//defined in admin panel  define('BOX_WIDTH_LEFT', 125); // how wide the boxes should be in pixels (default: 125)
//defined in admin panel  define('BOX_WIDTH_RIGHT', 200); // how wide the boxes should be in pixels (default: 125)

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      if (PHP_VERSION >= '4.0.4') {
        ob_start('ob_gzhandler');
      } else {
        include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
        ob_start();
        ob_implicit_flush();
      }
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }

// set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $PHP_SELF = str_replace(getenv('PATH_INFO'), '', $PHP_SELF);
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars); $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $HTTP_GET_VARS[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $HTTP_GET_VARS[$key] = $value;
        }
      }
    }
  }

// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'general_modules.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// set the cookie domain
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
  if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS . 'cache.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include wishlist class
  require(DIR_WS_CLASSES . 'wishlist.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// check if sessions are supported, otherwise use the php3 compatible session class
  if (!function_exists('session_start')) {
    define('PHP_SESSION_NAME', 'osCsid');
    define('PHP_SESSION_PATH', $cookie_path);
    define('PHP_SESSION_DOMAIN', $cookie_domain);
    define('PHP_SESSION_SAVE_PATH', SESSION_WRITE_DIRECTORY);

    include(DIR_WS_CLASSES . 'sessions.php');
  }

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCsid');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, $cookie_path, $cookie_domain);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
  }

// set the session ID if it exists
   if (isset($HTTP_POST_VARS[tep_session_name()])) {
     tep_session_id($HTTP_POST_VARS[tep_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($HTTP_GET_VARS[tep_session_name()]) ) {
     tep_session_id($HTTP_GET_VARS[tep_session_name()]);
   }

// start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'True') {
    tep_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, $cookie_path, $cookie_domain);

    if (isset($HTTP_COOKIE_VARS['cookie_test'])) {
      tep_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'True') {
    $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (tep_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (tep_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      tep_session_start();
      $session_started = true;
    }
  } else {
    tep_session_start();
    $session_started = true;
  }

  if ( ($session_started == true) && (PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals') == false) ) {
    extract($_SESSION, EXTR_OVERWRITE+EXTR_REFS);
  }

// set SID once, even if empty
  $SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!tep_session_is_registered('SSL_SESSION_ID')) {
      $SESSION_SSL_ID = $ssl_session_id;
      tep_session_register('SESSION_SSL_ID');
    }

    if ($SESSION_SSL_ID != $ssl_session_id) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
  }

// verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
      $SESSION_USER_AGENT = $http_user_agent;
      tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'True') {
    $ip_address = tep_get_ip_address();
    if (!tep_session_is_registered('SESSION_IP_ADDRESS')) {
      $SESSION_IP_ADDRESS = $ip_address;
      tep_session_register('SESSION_IP_ADDRESS');
    }

    if ($SESSION_IP_ADDRESS != $ip_address) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// create the shopping cart & fix the cart if necesary
  if (tep_session_is_registered('cart') && is_object($cart)) {
    if (PHP_VERSION < 4) {
      $broken_cart = $cart;
      $cart = new shoppingCart;
      $cart->unserialize($broken_cart);
    }
  } else {
    tep_session_register('cart');
    $cart = new shoppingCart;
  }

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// BOF QPBPP for SPPC
  // include the price formatter classes for the price breaks contribution
  require(DIR_WS_CLASSES . 'PriceFormatter.php');
  $pf = new PriceFormatter;
  require(DIR_WS_CLASSES . 'PriceFormatterStore.php');
  $pfs = new PriceFormatterStore;
// EOF QPBPP for SPPC

// points and rewards
  require(DIR_WS_FUNCTIONS . 'redemptions.php');

// include the mail classes
  require(DIR_WS_CLASSES . 'mime.php');
  require(DIR_WS_CLASSES . 'email.php');

// file uploading class
  require(DIR_WS_CLASSES . 'upload.php');

// set the language
  if (!tep_session_is_registered('language') || isset($HTTP_GET_VARS['language'])) {
    if (!tep_session_is_registered('language')) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($HTTP_GET_VARS['language']) && tep_not_null($HTTP_GET_VARS['language'])) {
      $lng->set_language($HTTP_GET_VARS['language']);
    } else {
      $lng->get_browser_language();
    }

    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
  }

//// Ultimate SEO url's 5 PRO
  Usu_Main::i()->setVar( 'languages_id', $languages_id )
               ->setVar( 'request_type', $request_type ) 
               ->setVar( 'session_started', $session_started ) 
               ->setVar( 'sid', $SID ) 
               ->setVar( 'language', $language )
               ->setVar( 'filename', $PHP_SELF )
               ->initiate( ( isset( $lng ) && ( $lng instanceof language ) ) ? $lng : array(), $languages_id, $language );
			   
// include the language translations
  require(DIR_WS_LANGUAGES . $language . '.php');

// currency
  if (!tep_session_is_registered('currency') || isset($HTTP_GET_VARS['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency) ) ) {
    if (!tep_session_is_registered('currency')) tep_session_register('currency');

    if (isset($HTTP_GET_VARS['currency']) && $currencies->is_set($HTTP_GET_VARS['currency'])) {
      $currency = $HTTP_GET_VARS['currency'];
    } else {
      $currency = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }

// navigation history
  if (tep_session_is_registered('navigation')) {
    if (PHP_VERSION < 4) {
      $broken_navigation = $navigation;
      $navigation = new navigationHistory;
      $navigation->unserialize($broken_navigation);
    } elseif ( false === is_object($navigation) ) {
      $navigation = new navigationHistory;
    }
  } else {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
  }
  $navigation->add_current_page();

// BOF: Store Mode
if (OFFLINE_IP_ADDRESS != getenv('REMOTE_ADDR')){
  if (STORE_MODE == 'Maintenance' and !strstr($PHP_SELF,MAINTENANCE_FILENAME)) {
	tep_redirect(tep_href_link(MAINTENANCE_FILENAME)); }
  }
// do not let people get to down for maintenance page if not turned on
if (STORE_MODE != 'Maintenance' and strstr($PHP_SELF,MAINTENANCE_FILENAME)) {
  tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
// EOF: Store Mode
//BEGIN allprods modification  
  if (ALL_PRODUCTS=='false' and strstr($PHP_SELF,ALL_PRODUCTS_FILENAME)) {
   tep_redirect(tep_href_link(FILENAME_DEFAULT));
  }
//END allprods modification

// wishlist data
  if(!tep_session_is_registered('wishList')) {
  	tep_session_register('wishList');
  	$wishList = new wishlist;
  }

//Wishlist actions (must be before shopping cart actions)
  if(isset($HTTP_POST_VARS['wishlist_x'])) {
	if(isset($HTTP_POST_VARS['products_id'])) {
		if(isset($HTTP_POST_VARS['id'])) {
			$attributes_id = $HTTP_POST_VARS['id'];
			tep_session_register('attributes_id');
		}
		$wishlist_id = $HTTP_POST_VARS['products_id'];
		tep_session_register('wishlist_id');
	}
	tep_redirect(tep_href_link(FILENAME_WISHLIST));
  }

// Shopping cart actions
  if (isset($HTTP_GET_VARS['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

            if (DISPLAY_CART == 'true') {
              $goto =  FILENAME_SHOPPING_CART;
              $parameters = array('action', 'cPath', 'products_id', 'pid');
        /* Optional Related Products (ORP) */
            } elseif ($HTTP_GET_VARS['action'] == 'rp_buy_now') {
              $goto = FILENAME_PRODUCT_INFO;
              $parameters = array('action', 'pid', 'rp_products_id');
        //ORP: end
            } else {
              $goto = basename($PHP_SELF);
      if ($HTTP_GET_VARS['action'] == 'buy_now') {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($HTTP_GET_VARS['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product' : for ($i=0, $n=sizeof($HTTP_POST_VARS['products_id']); $i<$n; $i++) {
                                if (in_array($HTTP_POST_VARS['products_id'][$i], (is_array($HTTP_POST_VARS['cart_delete']) ? $HTTP_POST_VARS['cart_delete'] : array()))) {
                                  $cart->remove($HTTP_POST_VARS['products_id'][$i]);
                                } else {
                                  if (PHP_VERSION < 4) {
                                    // if PHP3, make correction for lack of multidimensional array.
                                    reset($HTTP_POST_VARS);
                                    while (list($key, $value) = each($HTTP_POST_VARS)) {
                                      if (is_array($value)) {
                                        while (list($key2, $value2) = each($value)) {
                                          if (ereg ("(.*)\]\[(.*)", $key2, $var)) {
                                            $id2[$var[1]][$var[2]] = $value2;
                                          }
                                        }
                                      }
                                    }
                                    $attributes = ($id2[$HTTP_POST_VARS['products_id'][$i]]) ? $id2[$HTTP_POST_VARS['products_id'][$i]] : '';
                                  } else {
                                    $attributes = ($HTTP_POST_VARS['id'][$HTTP_POST_VARS['products_id'][$i]]) ? $HTTP_POST_VARS['id'][$HTTP_POST_VARS['products_id'][$i]] : '';
                                  }
// get 1 free-start
                                  if ($HTTP_POST_VARS['free'][$i] != 1) {
                                    $cart->add_cart($HTTP_POST_VARS['products_id'][$i], $HTTP_POST_VARS['cart_quantity'][$i], $attributes, false);
                                  }
// get 1 free-end
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
							  
// customer adds a product from the products page
// 2gether discount-start
// product listing enhancement-start
/*      case 'add_product' :    if (isset($HTTP_POST_VARS['products_id']) && is_numeric($HTTP_POST_VARS['products_id'])) {
                                $cart->add_cart($HTTP_POST_VARS['products_id'], $cart->get_quantity(tep_get_uprid($HTTP_POST_VARS['products_id'], $HTTP_POST_VARS['id']))+1, $HTTP_POST_VARS['id']);
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
							  */
							  
/*      case 'add_product' :    if (isset($HTTP_POST_VARS['products_id']) && is_numeric($HTTP_POST_VARS['products_id'])) {
//++++ QT Pro: Begin Changed code
                                $attributes=array();
                                if (isset($HTTP_POST_VARS['attrcomb']) && (preg_match("/^\d{1,10}-\d{1,10}(,\d{1,10}-\d{1,10})*$/",$HTTP_POST_VARS['attrcomb']))) {
                                  $attrlist=explode(',',$HTTP_POST_VARS['attrcomb']);
                                  foreach ($attrlist as $attr) {
                                    list($oid, $oval)=explode('-',$attr);
                                    if (is_numeric($oid) && $oid==(int)$oid && is_numeric($oval) && $oval==(int)$oval)
                                      $attributes[$oid]=$oval;
                                  }
                                }
                                if (isset($HTTP_POST_VARS['id']) && is_array($HTTP_POST_VARS['id'])) {
                                  foreach ($HTTP_POST_VARS['id'] as $key=>$val) {
                                    if (is_numeric($key) && $key==(int)$key && is_numeric($val) && $val==(int)$val)
                                      $attributes=$attributes + $HTTP_POST_VARS['id'];
                                  }
                                }
                                $cart->add_cart($HTTP_POST_VARS['products_id'], $cart->get_quantity(tep_get_uprid($HTTP_POST_VARS['products_id'], $attributes))+1, $attributes);
//++++ QT Pro: End Changed Code
                              }*/
							  
	  case 'add_product' :    if (isset($HTTP_POST_VARS['products_id']) && is_numeric($HTTP_POST_VARS['products_id'])) {
                                // if (tep_get_products_stock($HTTP_POST_VARS['products_id']) > 0) 
					          if (tep_has_product_attributes($_POST['products_id']) && PRODUCT_LIST_OPTIONS != 'true' && basename($PHP_SELF) != FILENAME_PRODUCT_INFO) tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_POST['products_id']));
	    						  $add_quantity = (isset($_POST['cart_quantity']) ? (int)$_POST['cart_quantity'] : 1);
						          $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+$add_quantity, $_POST['id']);
                                  //$cart->add_cart($HTTP_POST_VARS['products_id'], $cart->get_quantity(tep_get_uprid($HTTP_POST_VARS['products_id'], $HTTP_POST_VARS['id']))+1, $HTTP_POST_VARS['id']);
                              }
                              if (isset($HTTP_POST_VARS['buy_tinn_add']) && is_numeric($HTTP_POST_VARS['buy_tinn_add'])) {
                                //if (tep_get_products_stock($HTTP_POST_VARS['buy_tinn_add']) > 0) {
                                  $cart->add_cart($HTTP_POST_VARS['buy_tinn_add'], $cart->get_quantity(tep_get_uprid($HTTP_POST_VARS['buy_tinn_add'], $HTTP_POST_VARS['id']))+1, $HTTP_POST_VARS['id_b']);
                                //}
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
// product listing enhancement-end
// 2gether discount-end
	  
// product listing enhancement-start
// performed by the 'multi buy now' button in product listings page
      case 'add_multi':  for ($i=0; $i<=sizeof($_POST['products_id']);$i++) {
	     	 if($_POST['cart_quantity'][$i]) { $px_id = $_POST['products_id'][$i];
	         $cart->add_cart($px_id, $cart->get_quantity(tep_get_uprid($px_id, $_POST['id'][$px_id]))+($_POST['cart_quantity'][$i]), $_POST['id'][$px_id]);
	  		}
		}
	  	tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
	  break;
// product listing enhancement-end
	  
// customer removes product from shopping_cart page
      case 'remove_product' :    if (isset($HTTP_GET_VARS['products_id'])) {
                                 $cart->remove($HTTP_GET_VARS['products_id']);
                              }
                              break;
// performed by the 'buy now' button in product listings and review page
      case 'buy_now' :        if (isset($HTTP_GET_VARS['products_id'])) {
                                if (tep_has_product_attributes($HTTP_GET_VARS['products_id'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id']));
                                } else {
                                  $cart->add_cart($HTTP_GET_VARS['products_id'], $cart->get_quantity($HTTP_GET_VARS['products_id'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
          case 'rp_buy_now' :     if (isset($HTTP_GET_VARS['rp_products_id'])) {
                                    if (tep_has_product_attributes($HTTP_GET_VARS['rp_products_id'])) {
                                      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['rp_products_id']));
                                    } else {
                                      $cart->add_cart($HTTP_GET_VARS['rp_products_id'], $cart->get_quantity($HTTP_GET_VARS['rp_products_id'])+1);
                                    }
                                  }
                                  tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                                  break;
          //ORP: end
          case 'notify' :         if (tep_session_is_registered('customer_id')) {
                                if (isset($HTTP_GET_VARS['products_id'])) {
                                  $notify = $HTTP_GET_VARS['products_id'];
                                } elseif (isset($HTTP_GET_VARS['notify'])) {
                                  $notify = $HTTP_GET_VARS['notify'];
                                } elseif (isset($HTTP_POST_VARS['notify'])) {
                                  $notify = $HTTP_POST_VARS['notify'];
                                } else {
                                  tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                                  $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $customer_id . "'");
                                  $check = tep_db_fetch_array($check_query);
                                  if ($check['count'] < 1) {
                                    tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
                                  }
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (tep_session_is_registered('customer_id') && isset($HTTP_GET_VARS['products_id'])) {
                                $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                $check = tep_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (tep_session_is_registered('customer_id') && isset($HTTP_GET_VARS['pid'])) {
                                if (tep_has_product_attributes($HTTP_GET_VARS['pid'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['pid']));
                                } else {
                                  $cart->add_cart($HTTP_GET_VARS['pid'], $cart->get_quantity($HTTP_GET_VARS['pid'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
    }
  }

//rmh referral start
// set the referral id
  if (!tep_session_is_registered('referral_id') || isset($HTTP_GET_VARS['ref'])) {
    if (!tep_session_is_registered('referral_id') && !tep_session_is_registered('customer_id')) {
      tep_session_register('referral_id');
    }

    if (isset($HTTP_GET_VARS['ref']) && tep_not_null($HTTP_GET_VARS['ref'])) {
      $referral_id = $HTTP_GET_VARS['ref'];
    } else {
      $referral_id = '';
    }
  }
//rmh referral end

// include the who's online functions
  require(DIR_WS_FUNCTIONS . 'whos_online.php');
  tep_update_whos_online();

// include the password crypto functions
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// additional images
  require(DIR_WS_CLASSES . 'displayimages.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// infobox
  require(DIR_WS_CLASSES . 'boxes.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  tep_activate_banners();
  tep_expire_banners();

// auto expire special products
  require(DIR_WS_FUNCTIONS . 'specials.php');
  tep_expire_specials();

// auto expire get_1_free products
  require(DIR_WS_FUNCTIONS . 'get_1_free.php');
  tep_expire_get_1_free();

// auto expire featured products
  require(DIR_WS_FUNCTIONS . 'featured.php');
  tep_expire_featured();

// calculate category path
  if (isset($HTTP_GET_VARS['cPath'])) {
    $cPath = $HTTP_GET_VARS['cPath'];
  } elseif (isset($HTTP_GET_VARS['products_id']) && !isset($HTTP_GET_VARS['manufacturers_id'])) {
    $cPath = tep_get_product_path($HTTP_GET_VARS['products_id']);
  } else {
    $cPath = '';
  }

  if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

// include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// BOF-A: Header Tags SEO
// add category names or the manufacturer name to the breadcrumb trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      $categories_query = tep_db_query("select categories_htc_title_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "' LIMIT 1");
      if (tep_db_num_rows($categories_query) > 0) {
        $categories = tep_db_fetch_array($categories_query);
        $breadcrumb->add($categories['categories_htc_title_tag'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id'])) {
    $manufacturers_query = tep_db_query("select manufacturers_htc_title_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' AND languages_id = '" . (int)$languages_id . "' LIMIT 1");
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
      $breadcrumb->add($manufacturers['manufacturers_htc_title_tag'], tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $_GET['manufacturers_id']));
    }
  }

// add the products name to the breadcrumb trail
 if (isset($_GET['products_id'])) {
  $products_query = tep_db_query("select pd.products_head_title_tag from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_id = '" . (int)$_GET['products_id'] . "' and pd.language_id ='" .  (int)$languages_id . "' LIMIT 1");
  if (tep_db_num_rows($products_query)) {
    $products = tep_db_fetch_array($products_query);
    $breadcrumb->add($products['products_head_title_tag'], tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $_GET['products_id']));
  }
 } 
// EOF-A: Header Tags SEO

/**** BEGIN ARTICLE MANAGER ****/
// include the articles functions
  require(DIR_WS_FUNCTIONS . 'articles.php');

// calculate topic path
  if (isset($HTTP_GET_VARS['tPath'])) {
    $tPath = $HTTP_GET_VARS['tPath'];
  } elseif (isset($HTTP_GET_VARS['articles_id']) && !isset($HTTP_GET_VARS['authors_id'])) {
    $tPath = tep_get_article_path($HTTP_GET_VARS['articles_id']);
  } else {
    $tPath = '';
  }

  if (tep_not_null($tPath)) {
    $tPath_array = tep_parse_topic_path($tPath);
    $tPath = implode('_', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array)-1)];
  } else {
    $current_topic_id = 0;
  }

  if (isset($_GET['articles_id'])) {
    $articlesPage = FILENAME_ARTICLE_INFO . "?articles_id=" . $_GET['articles_id'];
    $pageTags_query = tep_db_query("select page_name, page_title from " . TABLE_HEADERTAGS . " where page_name like '" . $articlesPage . "' and language_id = '" . (int)$languages_id . "' LIMIT 1");
    if (tep_db_num_rows($pageTags_query) == 1) {
      $pageTags = tep_db_fetch_array($pageTags_query);
      $breadcrumb->add('Articles', tep_href_link(FILENAME_ARTICLES));
      $breadcrumb->add($pageTags['page_title'], tep_href_link($articlesPage));
    }  
  }
 /**** END ARTICLE MANAGER ****/

// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;

// products in category for DynaMenu
  require(DIR_WS_CLASSES . 'ProductsInCategory.php');
  $pic = new ProductsInCategory;

// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');

// activate inactivate category
  $hiddencats = array();
  if (HIDE_HIDDEN_CAT_PRODS == 'true') {
    $hcquery = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where status_categ = 0");
    while ($cat = tep_db_fetch_array($hcquery)) {// build array of hidden categories and their subcategories
      $hiddencats[] = $cat['categories_id'];
      tep_get_subcategories($hiddencats, $cat['categories_id']);
    }
  }

// basic template system
 require(DIR_WS_INCLUDES . 'configure_bts.php');

// ban IP addresses
 require(DIR_WS_INCLUDES . '_banned.php');
 
// affiliate program
 require(DIR_WS_INCLUDES . 'affiliate_application_top.php');

// set the pollbooth parameters (can be modified through the administration tool)
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from phesis_poll_config');

while ($configuration = tep_db_fetch_array($configuration_query)) {     
     define($configuration['cfgKey'], $configuration['cfgValue']);   
} 

// supertracker
  require(DIR_WS_CLASSES . 'supertracker.php');
	$tracker = new supertracker;
	$tracker->update();
    echo $GLOBALS['dmfooter'];

// purchase without account
  if (tep_session_is_registered('customer_id') && tep_session_is_registered('customer_is_guest') && substr(basename($PHP_SELF),0,7)=='account') tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));

// support tickets
  if (file_exists(DIR_WS_INCLUDES . 'local/ticket_configure.php')) include(DIR_WS_INCLUDES . 'local/ticket_configure.php');

  require(DIR_WS_INCLUDES . 'ticket_configure.php');
 
?>
