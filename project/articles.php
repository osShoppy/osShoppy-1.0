<?php //$Id: /catalog/articles.php (1709)

  require('includes/application_top.php');

  $authors_description = '';
  $authors_url = '';

// the following tPath references come from application_top.php
  $topic_depth = 'top';

  if (isset($tPath) && tep_not_null($tPath)) {
    $topics_articles_query = tep_db_query("SELECT COUNT(*) as total from " . TABLE_ARTICLES_TO_TOPICS . " where topics_id = '" . (int)$current_topic_id . "'");
    $topics_articles = tep_db_fetch_array($topics_articles_query);
    if ($topics_articles['total'] > 0) {
      $topic_depth = 'articles'; // display articles
    } else {
      $topic_parent_query = tep_db_query("SELECT COUNT(*) as total from " . TABLE_TOPICS . " where parent_id = '" . (int)$current_topic_id . "'");
      $topic_parent = tep_db_fetch_array($topic_parent_query);
      if ($topic_parent['total'] > 0) {
        $topic_depth = 'nested'; // navigate through the topics
      } else {
        $topic_depth = 'articles'; // topic has no articles, but display the 'no articles' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES);

  if ($topic_depth == 'top' && !isset($_GET['authors_id'])) {
    $breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLES));
  }

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
  $content = CONTENT_ARTICLES;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
