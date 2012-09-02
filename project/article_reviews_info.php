<?php //$Id: /catalog/article_reviews_info.php (1709)

  require('includes/application_top.php');

  if (isset($_GET['reviews_id']) && tep_not_null($_GET['reviews_id']) && isset($_GET['articles_id']) && tep_not_null($_GET['articles_id'])) {
    $review_check_query = tep_db_query("SELECT COUNT(*) as total from " . TABLE_ARTICLE_REVIEWS . " r, " . TABLE_ARTICLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$_GET['reviews_id'] . "' and r.articles_id = '" . (int)$_GET['articles_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "'");
    $review_check = tep_db_fetch_array($review_check_query);

    if ($review_check['total'] < 1) {
      tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params(array('reviews_id'))));
    }
  } else {
    tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params(array('reviews_id'))));
  }

  tep_db_query("update " . TABLE_ARTICLE_REVIEWS . " set reviews_read = reviews_read+1 where reviews_id = '" . (int)$_GET['reviews_id'] . "'");

  $review_query = tep_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, r.date_added, r.reviews_read, a.articles_id, ad.articles_name from " . TABLE_ARTICLE_REVIEWS . " r, " . TABLE_ARTICLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where r.reviews_id = '" . (int)$_GET['reviews_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and r.articles_id = a.articles_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '". (int)$languages_id . "'");
  $review = tep_db_fetch_array($review_query);

  $articles_name = $review['articles_name'];

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_REVIEWS_INFO);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params()));
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
<script language="javascript"><!--
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<?php
  $content = CONTENT_ARTICLE_REVIEWS_INFO;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
