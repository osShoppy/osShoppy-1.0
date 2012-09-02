<?php //$Id: /catalog/featured_products.php (651)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_FEATURED_PRODUCTS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_FEATURED_PRODUCTS));
?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_FEATURED_PRODUCTS;
//  $content_template = TEMPLATENAME_STATIC;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
