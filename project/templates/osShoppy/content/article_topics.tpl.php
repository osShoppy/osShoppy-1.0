    <table border="0" width="100%" cellspacing="0" cellpadding="0">    
      <tr>
        <td><h1><?php echo HEADING_ARTICLE_TOPICS; ?></h1></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>


<?php
    $topics_array = array();
    $topics_array = tep_get_topics($topics_array);
    $totalTopics = count($topics_array);
 
    if ($totalTopics == 0) {
?>
      <tr>
        <td class="main" ><?php echo TEXT_ARTICLE_TOPICS_NOT_FOUND; ?></td>
      </tr>
<?php
    } else { 
      for ($i = 0; $i < $totalTopics; ++$i) {
       $articles_query = tep_db_query("select a.articles_id, ad.articles_name, ad.articles_description  from   " . TABLE_ARTICLES . " a left join " .  TABLE_ARTICLES_DESCRIPTION . " ad on a.articles_id = ad.articles_id left join " . TABLE_ARTICLES_TO_TOPICS . " a2t on a.articles_id = a2t.articles_id where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1'  and a2t.topics_id = " . $topics_array[$i]['id'] . " and ad.language_id = '" . (int)$languages_id . "' order by ad.articles_name");
  
        if ($topics_array[$i]['parent'] == 0)
          echo '<tr><td><hr style="border solid 2px;"></td></tr>';
          
        echo '<tr><td class="main"><a href="' . tep_href_link(FILENAME_ARTICLES, 'tPath='.$topics_array[$i]['id']) . '"><b>' . $topics_array[$i]['text'] . '</b></a> ( ' . tep_count_articles_in_topic($topics_array[$i]['id']) . ' )</td></tr>';
        echo '<tr><td><table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>'; 
        echo '<td width="5"><td class="smallText">';
        
        while ($articles = tep_db_fetch_array($articles_query))
        {
          $shortDescr = substr($articles['articles_description'], 0, 40);
          echo '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>'; 
          echo '<td class="smallText"><a href="' . tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id='.$articles['articles_id']) . '">' . $articles['articles_name'] . '</a> - ' .$shortDescr. '<span style="color:#ff0000;">...more</span></td>';
          echo '</tr></table>';
        }
        echo '</td>';
        echo '</tr></table></td></tr>';
        echo '<tr><td height="10"></td></tr>';
     }
   } // end of else
?> 
    </table>