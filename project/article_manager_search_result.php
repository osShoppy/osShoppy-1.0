<?php //$Id: /catalog/article_manager_search_result.php (1709)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_MANAGER_SEARCH_RESULT);

  $searchFor = preg_replace('/[^A-Za-z0-9_ -]/', '', $_GET['article_keywords']);

  $articles_query = tep_db_query("select * from " . TABLE_ARTICLES . " a left join " . TABLE_ARTICLES_DESCRIPTION . " ad on a.articles_id = ad.articles_id where a.articles_status = 1 and ( ad.articles_name LIKE '%" . $searchFor . "%' or ad.articles_description LIKE '%" . $searchFor . "%' ) and language_id = " . (int)$languages_id);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_MANAGER_SEARCH_RESULT));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<?php
  $content = CONTENT_ARTICLE_MANAGER_SEARCH_RESULT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
