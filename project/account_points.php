<?php //$Id: /catalog/account_points.php (3220)

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_POINTS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT_POINTS, '', 'SSL'));

?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<script language="javascript"><!--
function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script>
<script language="javascript"><!--
window.onload=show;

function show(id) {
var d = document.getElementById(id);
	for (var i = 1; i<=20; i++) {
		if (document.getElementById('answer_q'+i)) {document.getElementById('answer_q'+i).style.display='none';}
	}
	
    if (d) {
	    d.style.display='block';
	    d.className='pointFaq';
    }
}
//--></script>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
  <title><?php echo TITLE; ?></title></head>
<?php
  $content = CONTENT_ACCOUNT_POINTS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
