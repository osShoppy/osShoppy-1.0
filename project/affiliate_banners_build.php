<?php //$Id: /catalog/affiliate_banners_build.php (0158)

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_BANNERS_BUILD);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD));

  $affiliate_banners_values = tep_db_query("select * from " . TABLE_AFFILIATE_BANNERS . " order by affiliate_banners_title");
  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  <script language="javascript"><!--
  function popupWindow(url) {
    window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=300,screenX=150,screenY=150,top=150,left=150')
  }
  //--></script>
  </head><?php

  $content = CONTENT_AFFILIATE_BANNERS_BUILD;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
