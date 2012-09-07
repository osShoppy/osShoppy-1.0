<?php //faq_column infobox

  $topics_string = ''; 
  
  $articlesArray = array();
  $info_box_contents = array();

  $boxHeading = BOX_HEADING_FAQ;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'faq_column'; // for easy unique box template setup (added BTSv1.2)

  $info_box_contents = array();

  if (FAQ_BOX_DISPLAY_TOPICS_SECTION == 'true')
  {  
     $tree = array();
   
     $topics_query = tep_db_query("select t.faq_topics_id, td.faq_topics_name, t.faq_parent_id from " . TABLE_FAQ_TOPICS . " t, " . TABLE_FAQ_TOPICS_DESCRIPTION . " td where t.faq_parent_id = '0' and t.faq_topics_id = td.faq_topics_id and td.language_id = '" . (int)$languages_id . "' order by faq_sort_order, td.faq_topics_name");
     while ($topics = tep_db_fetch_array($topics_query))  {
       $tree[$topics['faq_topics_id']] = array('name' => $topics['faq_topics_name'],
                                           'parent' => $topics['faq_parent_id'],
                                           'level' => 0,
                                           'path' => $topics['faq_topics_id'],
                                           'next_id' => false);
   
       if (isset($parent_id)) {
         $tree[$parent_id]['next_id'] = $topics['faq_topics_id'];
       }
   
       $parent_id = $topics['faq_topics_id'];
   
       if (!isset($first_topic_element)) {
         $first_topic_element = $topics['faq_topics_id'];
       }
     }
   
     //------------------------
     if (tep_not_null($fPath)) {
       $new_path = '';
       reset($fPath_array);
       while (list($key, $value) = each($fPath_array)) {
         unset($parent_id);
         unset($first_id);
         $topics_query = tep_db_query("select t.faq_topics_id, td.faq_topics_name, t.faq_parent_id from " . TABLE_FAQ_TOPICS . " t, " . TABLE_FAQ_TOPICS_DESCRIPTION . " td where t.faq_parent_id = '" . (int)$value . "' and t.faq_topics_id = td.faq_topics_id and td.language_id = '" . (int)$languages_id . "' order by faq_sort_order, td.faq_topics_name");
         if (tep_db_num_rows($topics_query)) {
           $new_path .= $value;
           while ($row = tep_db_fetch_array($topics_query)) {
             $tree[$row['faq_topics_id']] = array('name' => $row['faq_topics_name'],
                                              'parent' => $row['faq_parent_id'],
                                              'level' => $key+1,
                                              'path' => $new_path . '_' . $row['faq_topics_id'],
                                              'next_id' => false);
   
             if (isset($parent_id)) {
               $tree[$parent_id]['next_id'] = $row['faq_topics_id'];
             }
   
             $parent_id = $row['faq_topics_id'];
   
             if (!isset($first_id)) {
               $first_id = $row['faq_topics_id'];
             }
   
             $last_id = $row['faq_topics_id'];
           }
           $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
           $tree[$value]['next_id'] = $first_id;
           $new_path .= '_';
         } else {
           break;
         }
       }
     }
     tep_show_topic($first_topic_element);
  }



  /********************* BUILD ALL ARTICLES ********************/
  if (FAQ_BOX_DISPLAY_ALL_SECTION == 'true') {  
      $articles_all_count = '';
      if (SHOW_FAQ_COUNTS == 'true') {
          $articles_new_query = tep_db_query("SELECT a.faq_id from " . TABLE_FAQ . " a, " . TABLE_FAQ_TO_TOPICS . " a2t, " . TABLE_FAQ_TOPICS_DESCRIPTION . " td, " . TABLE_FAQ_AUTHORS . " au, " . TABLE_FAQ_DESCRIPTION . " ad where a.faq_authors_id = au.faq_authors_id and a2t.faq_topics_id = td.faq_topics_id and (a.faq_date_available IS NULL or to_days(a.faq_date_available) <= to_days(now())) and a.faq_id = a2t.faq_id and a.faq_status = '1' and a.faq_id = ad.faq_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "'");
          $articles_all_count = (tep_db_num_rows($articles_new_query) ? tep_db_num_rows($articles_new_query) : '');
      }
 
      $articlesArray['all_articles']['sort_order'] = FAQ_BOX_DISPLAY_ALL_SECTION_SORT_ORDER;
      $boldTags = array();
      $boldTags = GetBoldTags(FILENAME_FAQ);
      $articlesArray = array();
      $articlesArray['all_articles']['string'] = '';
      $articlesArray['all_articles']['string'] .= '<a href="' . tep_href_link(FILENAME_FAQ, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_ALL_FAQ . $boldTags['stop'] . '</a>';
      $articlesArray['all_articles']['string'] .= $articles_all_count . '<br>';      
  
      if (FAQ_BOX_DISPLAY_All_LINKS == 'true')
      {
          $allArticles = tep_get_all_articles_array();
          foreach ($allArticles as $all)
          {
             $boldTags = GetBoldTags(FILENAME_FAQ_INFO, $all['id']);
             $articlesArray['all_articles']['string'] .= '&nbsp;<a href="' . tep_href_link(FILENAME_FAQ_INFO, 'faq_id='.$all['id'], 'NONSSL') . '">' . $boldTags['start'] . $all['text'] . $boldTags['stop'] . '</a><br>';
          }
      }    
  }
    

  /********************* BUILD NEW ARTICLES ********************/
  if (FAQ_BOX_DISPLAY_NEW_SECTION == 'true') {
      $articles_new_count = '';
      if (SHOW_FAQ_COUNTS == 'true') {
          $articles_new_query = tep_db_query("SELECT a.faq_id from " . TABLE_FAQ . " a, " . TABLE_FAQ_TO_TOPICS . " a2t, " . TABLE_FAQ_TOPICS_DESCRIPTION . " td, " . TABLE_FAQ_AUTHORS . " au, " . TABLE_FAQ_DESCRIPTION . " ad where a.faq_authors_id = au.faq_authors_id and a2t.faq_topics_id = td.faq_topics_id and (a.faq_date_available IS NULL or to_days(a.faq_date_available) <= to_days(now())) and a.faq_id = a2t.faq_id and a.faq_status = '1' and a.faq_id = ad.faq_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a.faq_date_added > SUBDATE(now( ), INTERVAL '" . NEW_FAQ_DAYS_DISPLAY . "' DAY)");
          $articles_new_count = (tep_db_num_rows($articles_new_query) ? tep_db_num_rows($articles_new_query) : '');
      }
  
      $articlesArray['new_articles']['sort_order'] = FAQ_BOX_DISPLAY_NEW_SECTION_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FAQ_NEW);
      $articlesArray = array();
      $articlesArray['new_articles']['string'] = '';
      $articlesArray['new_articles']['string'] .= '<a href="' . tep_href_link(FILENAME_FAQ_NEW, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_NEW_FAQ . $boldTags['stop'] . '</a>';
      $articlesArray['new_articles']['string'] .= $articles_new_count . '<br>';      
  
      if (FAQ_BOX_DISPLAY_NEW_LINKS == 'true')
      {  
          $newArticles = tep_get_new_articles_array();
          foreach ($newArticles as $new)
          {
             $boldTags = GetBoldTags(FILENAME_FAQ_INFO, $new['id']);
             $articlesArray['new_articles']['string'] .= '&nbsp;<a href="' . tep_href_link(FILENAME_FAQ_INFO, 'articles_id='.$new['id'], 'NONSSL') . '">' . $boldTags['start'] . $new['text'] . $boldTags['stop'] . '</a><br>';
          }
      }
  }
  

  /********************* BUILD TOPICS ********************/  
  if (FAQ_BOX_DISPLAY_TOPICS_SECTION == 'true') {
      $articlesArray['all_faq_topics']['sort_order'] = FAQ_BOX_DISPLAY_TOPICS_SECTION_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FAQ_TOPICS);
      $articlesArray['all_faq_topics']['string'] = '<a href="' . tep_href_link(FILENAME_FAQ_TOPICS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_FAQ_TOPICS . $boldTags['stop'] . '</a><br>';
      if (FAQ_BOX_DISPLAY_TOPICS_LINKS == 'true')
          $articlesArray['all_faq_topics']['string'] .= $topics_string;
  }  

  
  /********************* BUILD RSS LINK ********************/  
  if (FAQ_BOX_DISPLAY_RSS_FEED_SECTION == 'true') {
      $articlesArray['rss_feed']['sort_order'] = FAQ_BOX_DISPLAY_RSS_FEED_SECTION_SORT_ORDER;
      $articlesArray['rss_feed']['string'] = '<a href="' . tep_href_link(FILENAME_FAQ_RSS, '', 'NONSSL') . '" target="_blank">' . BOX_RSS_FAQ . '</a>';
  }
  

  /********************* BUILD SUBMIT LINK ********************/
  if (FAQ_BOX_DISPLAY_SUBMIT_SECTION == 'true') {    
      $articlesArray['submit_article']['sort_order'] = FAQ_BOX_DISPLAY_SUBMIT_SECTION_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FAQ_SUBMIT);
      $articlesArray['submit_article']['string'] = '<a href="' . tep_href_link(FILENAME_FAQ_SUBMIT, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_FAQ_SUBMIT . $boldTags['stop'] . '</a>'; 
  }
  

  /********************* BUILD UPCOMING ARTICLES LINK ********************/
  if (ARTICLE_BOX_DISPLAY_UPCOMING_SECTION == 'true')  {    
      $upcoming_query = tep_db_query("select a.articles_date_added, a.articles_date_available as date_expected, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_id, td.topics_name from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_TO_TOPICS . " a2t, " . TABLE_TOPICS_DESCRIPTION . " td, " . TABLE_AUTHORS . " au, " . TABLE_ARTICLES_DESCRIPTION . " ad where to_days(a.articles_date_available) > to_days(now()) and a.articles_id = a2t.articles_id and a2t.topics_id = td.topics_id and a.authors_id = au.authors_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '" . (int)$languages_id . "' order by date_expected limit " . MAX_DISPLAY_UPCOMING_ARTICLES);
      if (tep_db_num_rows($upcoming_query) > 0) {
          $articlesArray['upcoming']['sort_order'] = ARTICLE_BOX_DISPLAY_UPCOMING_SECTION_SORT_ORDER;
          $articlesArray['upcoming']['string'] = BOX_UPCOMING_ARTICLES . '<br>';
          while ($upcoming = tep_db_fetch_array($upcoming_query)) {
              $dateParts = explode(" ", $upcoming['date_expected']);
              $articlesArray['upcoming']['string'] .= '&nbsp;' . $upcoming['articles_name'] . '<br>&nbsp;&nbsp; '. $dateParts['0'] . '<br>';
          }  
          $articlesArray['upcoming']['string'] = substr($articlesArray['upcoming']['string'], 0, -4);
      }
  }
  
  
  /********************* ADD A SEARCH FUNCTION ********************/
  if (FAQ_BOX_DISPLAY_SEARCH_SECTION == 'true') {
      $articlesArray['search']['sort_order'] = FAQ_BOX_DISPLAY_SEARCH_SECTION_SORT_ORDER;
      $articlesArray['search']['string'] = '<table width="100%" border="0" align="center">' .
                                             '<form name="article_search" action="' .tep_href_link('faq_manager_search_result.php', '', 'NONSSL') . '" method="get">'.
                                             '<tr>'.
                                             '</tr><tr>' .  
                                               '<td width="560" align="center" class="main">'.
                                                '<input type="text" name="article_keywords" value="' . TEXT_FAQ_SEARCH_STRING . '" onFocus="form.article_keywords.value=\'\';" size="15" maxlength="35" >'.
                                                 tep_hide_session_id() . '&nbsp;' .tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) .
                                               '</td>'.
                                             '</tr>' .  
                                              '</form>'.
                                             ''.
                                            '</table>';
  }

  usort($articlesArray, "SortBySetting"); 
    
  /********************* DISPLAY IT ALL ********************/  
  
  $finalStr = '';
  foreach ($articlesArray as $item)
  {
     $finalStr .= $item['string'] .'<hr>';
  }
  $finalStr = substr($finalStr, 0, -4);

    $boxContent = $finalStr;
  
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)


include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
