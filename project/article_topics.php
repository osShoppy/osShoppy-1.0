<?php //$Id: /catalog/article_topics.php (1709)

  require('includes/application_top.php');



  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_TOPICS);
  $breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLE_TOPICS));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php

if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
<title><?php echo TITLE; ?></title>
<?php
}

?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<?php
  $content = CONTENT_ARTICLE_TOPICS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
