<?php // $Id: /catalog/includes/affiliate_application)top.php (0158)


// Set the local configuration parameters - mainly for developers
  require(DIR_WS_INCLUDES . 'affiliate_configure.php');

  require(DIR_WS_INCLUDES . 'affiliate_configure.php');
  require(DIR_WS_FUNCTIONS . 'affiliate_functions.php');

// define the database table names used in the contribution
  define('TABLE_AFFILIATE', 'affiliate_affiliate');
  define('TABLE_AFFILIATE_NEWS', 'affiliate_news');
  define('TABLE_AFFILIATE_NEWS_CONTENTS', 'affiliate_news_contents');

// if you change this -> affiliate_show_banner must be changed too
  define('TABLE_AFFILIATE_BANNERS', 'affiliate_banners');
  define('TABLE_AFFILIATE_BANNERS_HISTORY', 'affiliate_banners_history');
  define('TABLE_AFFILIATE_CLICKTHROUGHS', 'affiliate_clickthroughs');
  define('TABLE_AFFILIATE_SALES', 'affiliate_sales');
  define('TABLE_AFFILIATE_PAYMENT', 'affiliate_payment');
  define('TABLE_AFFILIATE_PAYMENT_STATUS', 'affiliate_payment_status');
  define('TABLE_AFFILIATE_PAYMENT_STATUS_HISTORY', 'affiliate_payment_status_history');

// include the language translations
//  require(DIR_WS_LANGUAGES . 'affiliate_' . $language . '.php');

  $affiliate_clientdate = (date ("Y-m-d H:i:s"));
  $affiliate_clientbrowser = $HTTP_SERVER_VARS["HTTP_USER_AGENT"];
  $affiliate_clientip = $HTTP_SERVER_VARS["REMOTE_ADDR"];
  $affiliate_clientreferer = $HTTP_SERVER_VARS["HTTP_REFERER"];

  if (!$HTTP_SESSION_VARS['affiliate_ref']) {
    tep_session_register('affiliate_ref');
    tep_session_register('affiliate_clickthroughs_id');
    if (($HTTP_GET_VARS['ref'] || $HTTP_POST_VARS['ref'])) {
      if ($HTTP_GET_VARS['ref']) $affiliate_ref = $HTTP_GET_VARS['ref'];
      if ($HTTP_POST_VARS['ref']) $affiliate_ref = $HTTP_POST_VARS['ref'];
      if ($HTTP_GET_VARS['products_id']) $affiliate_products_id = $HTTP_GET_VARS['products_id'];
      if ($HTTP_POST_VARS['products_id']) $affiliate_products_id = $HTTP_POST_VARS['products_id'];
      if ($HTTP_GET_VARS['affiliate_banner_id']) $affiliate_banner_id = $HTTP_GET_VARS['affiliate_banner_id'];
      if ($HTTP_POST_VARS['affiliate_banner_id']) $affiliate_banner_id = $HTTP_POST_VARS['affiliate_banner_id'];

      if (!$link_to) $link_to = "0";
      $sql_data_array = array('affiliate_id' => $affiliate_ref,
                              'affiliate_clientdate' => $affiliate_clientdate,
                              'affiliate_clientbrowser' => $affiliate_clientbrowser,
                              'affiliate_clientip' => $affiliate_clientip,
                              'affiliate_clientreferer' => $affiliate_clientreferer,
                              'affiliate_products_id' => $affiliate_products_id,
                              'affiliate_banner_id' => $affiliate_banner_id);
      tep_db_perform(TABLE_AFFILIATE_CLICKTHROUGHS, $sql_data_array);
      $affiliate_clickthroughs_id = tep_db_insert_id();

   // Banner has been clicked, update stats:
      if ($affiliate_banner_id && $affiliate_ref) {
        $today = date('Y-m-d');
        $sql = "select * from " . TABLE_AFFILIATE_BANNERS_HISTORY . " where affiliate_banners_id = '" . $affiliate_banner_id  . "' and  affiliate_banners_affiliate_id = '" . $affiliate_ref . "' and affiliate_banners_history_date = '" . $today . "'";
        $banner_stats_query = tep_db_query($sql);

     // Banner has been shown today
        if (tep_db_fetch_array($banner_stats_query)) {
        tep_db_query("update " . TABLE_AFFILIATE_BANNERS_HISTORY . " set affiliate_banners_clicks = affiliate_banners_clicks + 1 where affiliate_banners_id = '" . $affiliate_banner_id . "' and affiliate_banners_affiliate_id = '" . $affiliate_ref. "' and affiliate_banners_history_date = '" . $today . "'");
   // Initial entry if banner has not been shown
      } else {
        $sql_data_array = array('affiliate_banners_id' => $affiliate_banner_id,
                                'affiliate_banners_products_id' => $affiliate_products_id,
                                'affiliate_banners_affiliate_id' => $affiliate_ref,
                                'affiliate_banners_clicks' => '1',
                                'affiliate_banners_history_date' => $today);
        tep_db_perform(TABLE_AFFILIATE_BANNERS_HISTORY, $sql_data_array);
      }
    }

 // Set Cookie if the customer comes back and orders it counts
    setcookie('affiliate_ref', $affiliate_ref, time() + AFFILIATE_COOKIE_LIFETIME);
    }
    if ($HTTP_COOKIE_VARS['affiliate_ref']) { // Customer comes back and is registered in cookie
      $affiliate_ref = $HTTP_COOKIE_VARS['affiliate_ref'];
    }
  }

////
// Compatibility to older Snapshots

// set the type of request (secure or not)
  if (!isset($request_type)) $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// Emulate the breadcrumb class
  if (!class_exists(breadcrumb)) {
    class breadcrumb {
      function add($title, $link = '') {
        global $location;
        $location='&raquo; <a href="' . $link . '" class="headerNavigation">' . $title . '</a>';
      }
    }
    $breadcrumb = new breadcrumb;
  }
?>
