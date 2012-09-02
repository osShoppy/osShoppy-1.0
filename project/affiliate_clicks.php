<?php //$Id: /catalog/affiliate_clicks.php (0158)

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_CLICKS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'));

  $affiliate_clickthroughs_raw = "
    select a.*, pd.products_name from " . TABLE_AFFILIATE_CLICKTHROUGHS . " a 
    left join " . TABLE_PRODUCTS . " p on (p.products_id = a.affiliate_products_id) 
    left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on (pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "') 
    where a.affiliate_id = '" . $affiliate_id . "'  ORDER BY a.affiliate_clientdate desc
    ";
  $affiliate_clickthroughs_split = new splitPageResults($affiliate_clickthroughs_raw, MAX_DISPLAY_SEARCH_RESULTS);

  $affiliate_clickthroughs_numrows_raw = "select count(*) as count from " . TABLE_AFFILIATE_CLICKTHROUGHS . " where affiliate_id = '" . $affiliate_id . "'";
  $affiliate_clickthroughs_query = tep_db_query($affiliate_clickthroughs_numrows_raw);
  $affiliate_clickthroughs_numrows = tep_db_fetch_array($affiliate_clickthroughs_query);
  $affiliate_clickthroughs_numrows =$affiliate_clickthroughs_numrows['count'];
  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  <script language="javascript"><!--
  function popupWindow(url) {
    window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=450,height=120,screenX=150,screenY=150,top=150,left=150')
  }
  //--></script>
  </head><?php

  $content = CONTENT_AFFILIATE_CLICKS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
