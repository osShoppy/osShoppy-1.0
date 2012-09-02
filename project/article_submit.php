<?php //$Id: /catalog/article_submit.php (1709)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_SUBMIT);

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $article = array();
  $wasSubmitted = false;

  if (isset($_POST['action']) && $_POST['action'] == 'process') {

      $article['name'] = tep_db_prepare_input($_POST['article_name']);
      $article['meta_desc'] = tep_db_prepare_input($_POST['article_short_desc']);
      $article['text'] = tep_db_prepare_input($_POST['article_long_desc']);
      $authors_name = tep_db_prepare_input($_POST['authors_name']);
      $authors_description = tep_db_prepare_input($_POST['authors_description']);
      $topic = $_POST['topics_list'];
      $imgName = '';

      $error = false;

      if (isset($_FILES['uploadedfile']) && tep_not_null($_FILES['uploadedfile']['tmp_name'])) {
          if (!is_dir(DIR_WS_IMAGES . 'article_manager_uploads')) {
              mkdir(DIR_WS_IMAGES . 'article_manager_uploads');
          }

          //Sanitize the filename (See note below)
          $remove_these = array(' ','`','"','\'','\\','/');
          $imgName = str_replace($remove_these,'',$_FILES['uploadedfile']['name']);
          $imgName = time().'-'.$imgName;       //Make the filename unique
          $imageDir = DIR_WS_IMAGES . 'article_manager_uploads/' . $imgName;     //Save the uploaded the file to another location
          $imgTmpName = str_replace("'", '', $_FILES['uploadedfile']['tmp_name']);

          if(! move_uploaded_file($imgTmpName, $imageDir)) {
              $error = true;
              $messageStack->add('article_submit', ERROR_FAILED_IMAGE_UPLOAD);
          }
      }

      if (! $error && isset($_FILES['uploadedfile']) && tep_not_null($_FILES['uploadedfile']['tmp_name'])) {
          if (!is_dir(DIR_WS_IMAGES . 'article_manager_uploads')) {
              mkdir(DIR_WS_IMAGES . 'article_manager_uploads');
          }

          //Sanitize the filename (See note below)
          $remove_these = array(' ','`','"','\'','\\','/');
          $imgAuthor = str_replace($remove_these,'',$_FILES['authors_image']['name']);
          $imgAuthor = time().'-'.$imgAuthor;       //Make the filename unique
          $imageDir = DIR_WS_IMAGES . 'article_manager_uploads/' . $imgAuthor;     //Save the uploaded the file to another location
          $imgTmpName = str_replace("'", '', $_FILES['authors_image']['tmp_name']);

          if(! move_uploaded_file($imgTmpName, $imageDir)) {
              $error = true;
              $messageStack->add('article_submit', ERROR_FAILED_IMAGE_UPLOAD);
          }
      }

      if ($topic == TEXT_SELECT_TOPIC) {
          $error = true;
          $messageStack->add('article_submit', ERROR_INVALID_TOPIC);
      }
      if (!tep_not_null($article['name'])) {
          $error = true;
          $messageStack->add('article_submit', ERROR_ARTICLE_NAME);
      }
      if (!tep_not_null($article['meta_desc'])) {
          $error = true;
          $messageStack->add('article_submit', ERROR_ARTICLE_META_DESC);
      }
      if (!tep_not_null($article['text'])) {
          $error = true;
          $messageStack->add('article_submit', ERROR_ARTICLE_TEXT);
      }
      if (!tep_not_null($authors_name)) {
          $error = true;
          $messageStack->add('article_submit', ERROR_AUTHORS_NAME);
      }

      if (! $error) {
          /************************* UPDATE THE AUTHOR *************************/
          $authorInfo_query = tep_db_query("select authors_id from " . TABLE_AUTHORS . " where customers_id = '" . (int)$customer_id . "' limit 1");
          if (tep_db_num_rows($authorInfo_query)) {
               tep_db_query("update " . TABLE_AUTHORS . " set authors_name = '" . tep_db_input($authors_name) . "', authors_image = '" . tep_db_input($imgAuthor) . "' where customers_id = " . (int)$customer_id );
               $authors = tep_db_fetch_array($authorInfo_query);
               $authors_id = $authors['authors_id'];
               tep_db_query("update " . TABLE_AUTHORS_INFO . " set authors_description = '" . tep_db_input($authors_description) . "' where authors_id = " . (int)$authors['authors_id'] );
          } else {
               $sql_data_array = array('authors_name' => tep_db_input($authors_name),
                                        'customers_id' => (int)$customer_id,
                                        'date_added' => date('Y-m-d'),
                                        'last_modified' => date('Y-m-d')
                                       );
               tep_db_perform(TABLE_AUTHORS, $sql_data_array);

               $authors_id = tep_db_insert_id();

               $sql_data_array = array('authors_id' => $authors_id,
                                        'languages_id' => (int)$languages_id,
                                        'authors_description' => tep_db_input($authors_description)
                                       );
               tep_db_perform(TABLE_AUTHORS_INFO, $sql_data_array);
          }

          /************************* UPDATE THE ARTICLE *************************/
          $articles_date_available = date('Y-m-d');
          $sql_data_array = array('articles_date_available' => $articles_date_available,
                                  'articles_date_added' => $articles_date_available,
                                  'articles_status' => 0,
                                  'authors_id' => (int)$authors_id
                                  );

          tep_db_perform(TABLE_ARTICLES, $sql_data_array);
          $articles_id = tep_db_insert_id();

          tep_db_query("insert into " . TABLE_ARTICLES_TO_TOPICS . " (articles_id, topics_id) values ('" . (int)$articles_id . "', '" . (int)$topic . "')");

          $sql_data_array = array('articles_name' => tep_db_prepare_input($article['name']),
                                  'articles_description' => tep_db_prepare_input($article['text']),
                                  'articles_url' => '',
                                  'articles_image' => $imgName,
                                  'articles_head_desc_tag' => tep_db_prepare_input($article['meta_desc']));

          $insert_sql_data = array('articles_id' => $articles_id,
                                    'language_id' => $languages_id);

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          tep_db_perform(TABLE_ARTICLES_DESCRIPTION, $sql_data_array);

          /************************* SEND THE EMAIL *************************/
          $topicName_query = tep_db_query("select topics_name from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = " . (int)$topic . " and language_id = " . (int)$languages_id . " limit 1");
          $topicName = tep_db_fetch_array($topicName_query);
          $subject = sprintf(ARTICLES_EMAIL_TEXT_SUBJECT, STORE_NAME);
          $body = sprintf(ARTICLES_EMAIL_TEXT_BODY, $customer_first_name, $article['name'], $topicName['topics_name']);
          tep_mail('', STORE_OWNER_EMAIL_ADDRESS, $subject, $body, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

          $wasSubmitted = true;
      }
  }


  if (! $wasSubmitted) {
      $topicsList = array();
      $topics_query = tep_db_query("select t.topics_id, td.topics_name from " . TABLE_TOPICS . " t left join " . TABLE_TOPICS_DESCRIPTION . " td on t.topics_id = td.topics_id  where td.language_id = '" . (int)$languages_id . "' order by td.topics_name");
      $topicsList[] = array('id' => TEXT_SELECT_TOPIC, 'text' => TEXT_SELECT_TOPIC);
      while ($topics = tep_db_fetch_array($topics_query)) {
        $topicsList[] = array('id' => $topics['topics_id'], 'text' => $topics['topics_name']);
      }

      $authorInfo = array();
      $authorInfo_query = tep_db_query("select a.authors_name, ai.authors_description from " . TABLE_AUTHORS . " a left join " . TABLE_AUTHORS_INFO . " ai on a.authors_id - ai.authors_id where a.customers_id = '" . (int)$customer_id . "' and ai.languages_id = " . (int)$languages_id . " limit 1");
      if (tep_db_num_rows($authorInfo_query)) {
          $authorInfo = tep_db_fetch_array($authorInfo_query);
      } else {
          $customer_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "' limit 1");
          $customer = tep_db_fetch_array($customer_query);
          $authorInfo['authors_name'] = $customer['customers_firstname'] . '  '. $customer['customers_lastname'];
          $authorInfo['authors_description'] = ''; //declare it to prevent warning
      }
  }

  $breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLE_SUBMIT));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<style type="text/css">
.textSmall {font-family: Verdana, Arial, sans-serif; font-size: 10px;}
</style>
</head>
<?php
  $content = CONTENT_ARTICLE_SUBMIT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
