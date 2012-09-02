<?php //$Id: /catalog/references.php (5477)

  require('includes/application_top.php');

/*** Begin Customer Testimonials v6 ***/
// Redirect user to login page if any of the following are true:
// 1) Admin has disabled Customer Testimonials mod; or 
// 2) only registered users permitted to view testimonials and user is not logged in

  if ( (REFERENCES_ACTIVE != 'Yes') || ((REFERENCES_REGISTERED_VIEW == "Registered Users Only") && (!tep_session_is_registered('customer_id'))) ) 
  {
  	    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
/*** End Customer Testimonials v6 ***/ 

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_REFERENCES);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_REFERENCES));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_REFERENCES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
