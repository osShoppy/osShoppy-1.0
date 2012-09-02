<?php //$Id: /catalog/osshopyy_all_database_tables.php (osS)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_OSSHOPPY_ALL_DATABASE_TABLES);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_OSSHOPPY_ALL_DATABASE_TABLES));
  ?><head><title><?php echo TITLE; ?></title>
  <script language="javascript"><!--
window.onload=show;

function show(id) {
var d = document.getElementById(id);
	for (var i = 1; i<=200; i++) {
		if (document.getElementById('answer_q'+i)) {document.getElementById('answer_q'+i).style.display='none';}
	}
	
    if (d) {
	    d.style.display='block';
	    d.className='pointFaq';
    }
}
//--></script>
</head><?php

  $content = CONTENT_OSSHOPPY_ALL_DATABASE_TABLES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
