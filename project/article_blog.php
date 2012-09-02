<?php //$Id: /catalog/article_blog.php (1709)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_BLOG);


  if (isset($_POST['action']) && $_POST['action'] == 'process_comment') {

      // if the customer is not logged on, redirect them to the login page
      if (!tep_session_is_registered('customer_id')) {
          $navigation->set_snapshot();
          tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
      } else {

          $comment = tep_db_prepare_input($_POST['blog_comment']);

          if (! tep_not_null($comment)) {
              $messageStack->add('new_comment', ERROR_NO_COMMENT);
          } else {
              $sql_data_array = array('articles_id' => (int)$_GET['articles_id'],
                                       'comment_date_added' => 'now()',
                                       'comments_status' => 1,
                                       'customers_id' => (int)$customers_id,
                                       'commenters_name' => ucfirst($customer_first_name),
                                       'comment' => $comment,
                                       'language_id' => (int)$languages_id,
                                      );
              tep_db_perform(TABLE_ARTICLES_BLOG, $sql_data_array);

              /************************* SEND THE EMAIL *************************/
              $subject = sprintf(BLOG_EMAIL_TEXT_SUBJECT, STORE_NAME);
              $body = sprintf(BLOG_EMAIL_TEXT_BODY, $_POST['article_name'], $customer_first_name);
              tep_mail('', STORE_OWNER_EMAIL_ADDRESS, $subject, $body, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          }
      }
  }


  $articlePrintArray = array();
  $article_check_query = tep_db_query("SELECT COUNT(*) as total from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . (int)$_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
  $article_check = tep_db_fetch_array($article_check_query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<?php
  $content = CONTENT_ARTICLE_BLOG;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
