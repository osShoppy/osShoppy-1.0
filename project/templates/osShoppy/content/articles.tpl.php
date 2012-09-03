<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'articles_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_top_eof //-->
    <?php
  if ($topic_depth == 'nested') {
    $topic_query = tep_db_query("select td.topics_name, td.topics_heading_title, td.topics_description from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where t.topics_id = '" . (int)$current_topic_id . "' and td.topics_id = '" . (int)$current_topic_id . "' and td.language_id = '" . (int)$languages_id . "'");
    $topic = tep_db_fetch_array($topic_query);
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><h1><?php
                 echo ( tep_not_null($topic['topics_heading_title']) ? $topic['topics_heading_title'] : HEADING_TITLE);
                 ?></h1></td>
                <td valign="top" class="pageHeading" align="right"></td>
              </tr>
              <?php if ( tep_not_null($topic['topics_description']) ) { ?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td align="left" colspan="2"><h2><?php echo $topic['topics_description']; ?></h1></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <?php
                      if (isset($tPath) && strpos('_', $tPath)) {
                      // check to see if there are deeper topics within the current topic
                        $topic_links = array_reverse($tPath_array);
                        for($i=0, $n=sizeof($topic_links); $i<$n; $i++) {
                          $topics_query = tep_db_query("SELECT COUNT(*) as total from " . TABLE_TOPICS . " t left join " . TABLE_TOPICS_DESCRIPTION . " td on t.topics_id = td.topics_id where t.parent_id = '" . (int)$topic_links[$i] . "' and td.language_id = '" . (int)$languages_id . "'");
                          $topics = tep_db_fetch_array($topics_query);
                          if ($topics['total'] < 1) {
                            // do nothing, go through the loop
                          } else {
                            $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id from " . TABLE_TOPICS . " t left join " . TABLE_TOPICS_DESCRIPTION . " td on t.topics_id = td.topics_id where t.parent_id = '" . (int)$topic_links[$i] . "' and td.language_id = '" . (int)$languages_id . "' order by sort_order, td.topics_name");
                            break; // we've found the deepest topic the customer is in
                          }
                        }
                      } else {
                        $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id from " . TABLE_TOPICS . " t left join " . TABLE_TOPICS_DESCRIPTION . " td on t.topics_id = td.topics_id where t.parent_id = '" . (int)$current_topic_id . "' and td.language_id = '" . (int)$languages_id . "' order by sort_order, td.topics_name");
                      }

                      if (tep_db_num_rows($topics_query) > 0)
                      {
                         while ($topics = tep_db_fetch_array($topics_query)) {
                           $articles_query = tep_db_query("select count(*) as ttl from " . TABLE_ARTICLES_TO_TOPICS . " where topics_id = '" . (int)$topics['topics_id'] . "'");
                           $articles = tep_db_fetch_array($articles_query);
                           echo '<tr><td class="main"><a href="' . tep_href_link(FILENAME_ARTICLES, 'tPath='.$topics['topics_id']) . '"><b>' . $topics['topics_name'] . '</b></a> ( ' . $articles['ttl'] . ' )</td></tr>';
                           echo '<tr><td><table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>';
                           echo '<td width="5"></td><td class="smallText">' . $topics['topics_description'] . '<td>';
                           echo '</tr></table></td></tr>';
                           echo '<tr><td height="10"></td></tr>';
                         } //end of while
                      }

                  // needed for the new articles module shown below
                      $new_articles_topic_id = $current_topic_id;
                  ?>
                </table></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td><?php /*include(DIR_WS_MODULES . FILENAME_NEW_ARTICLES); */ ?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
    <?php
  } elseif ($topic_depth == 'articles' || isset($_GET['authors_id'])) {

/* bof catdesc for bts1a */
// Get the topic name and description from the database
    $topic_query = tep_db_query("select td.topics_name, td.topics_heading_title, td.topics_description from " . TABLE_TOPICS . " t, " . TABLE_TOPICS_DESCRIPTION . " td where t.topics_id = '" . (int)$current_topic_id . "' and td.topics_id = '" . (int)$current_topic_id . "' and td.language_id = '" . (int)$languages_id . "'");
    $topic = tep_db_fetch_array($topic_query);
/* bof catdesc for bts1a */

// show the articles of a specified author
    if (isset($_GET['authors_id'])) {
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only a specific topic
        $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and au.authors_id = '" . (int)$_GET['authors_id'] . "' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a2t.topics_id = '" . (int)$_GET['filter_id'] . "' order by a.articles_date_added desc, ad.articles_name";
      } else {
// We show them all
        $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and au.authors_id = '" . (int)$_GET['authors_id'] . "' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' order by a.articles_date_added desc, ad.articles_name";
      }
    } else {
// show the articles in a given category
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only specific catgeory
        $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a2t.topics_id = '" . (int)$current_topic_id . "' and au.authors_id = '" . (int)$_GET['filter_id'] . "' order by a.articles_date_added desc, ad.articles_name";
      } else {
// We show them all
        $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad, " . TABLE_ARTICLES_TO_TOPICS . " a2t left join " . TABLE_TOPICS_DESCRIPTION . " td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a2t.topics_id = '" . (int)$current_topic_id . "' order by a.articles_date_added desc, ad.articles_name";
      }
    }
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top" align="left"><h1><?php
                 echo ( tep_not_null($topic['topics_heading_title']) ? $topic['topics_heading_title'] : HEADING_TITLE);

                  if (isset($_GET['authors_id'])) {
                    $author_query = tep_db_query("select au.authors_name, aui.authors_description, au.authors_image, aui.authors_url from " . TABLE_AUTHORS . " au left join " . TABLE_AUTHORS_INFO . " aui on au.authors_id = aui.authors_id where au.authors_id = '" . (int)$_GET['authors_id'] . "' and aui.languages_id = '" . (int)$languages_id . "'");
                    $authors = tep_db_fetch_array($author_query);
                    $author_name = $authors['authors_name'];
                    $authors_description = $authors['authors_description'];
                    $authors_url = $authors['authors_url'];

                    echo TEXT_ARTICLES_BY . $author_name;
                  }
                 ?>
                </h1></td>
                <?php
                $authorsImage = DIR_WS_IMAGES . 'article_manager_uploads/' . $authors['authors_image'];
                if (file_exists($authorsImage) && is_file($authorsImage)) { ?>
                 <td align="right"><h1><?php echo tep_image($authorsImage, HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></h1></td>
                <?php } ?>
                <?php
                // optional Article List Filter
                if (ARTICLE_LIST_FILTER) {
                  if (isset($_GET['authors_id'])) {
                    $filterlist_sql = "select distinct t.topics_id as id, td.topics_name as name from " . TABLE_ARTICLES . " a left join " . TABLE_ARTICLES_TO_TOPICS . " a2t on a.articles_id = a2t.articles_id left join " . TABLE_TOPICS . " t on a2t.topics_id = t.topics_id left join " . TABLE_TOPICS_DESCRIPTION . " td on a2t.topics_id = td.topics_id where a.articles_status = '1' and td.language_id = '" . (int)$languages_id . "' and a.authors_id = '" . (int)$_GET['authors_id'] . "' order by td.topics_name";
                  } else {
                    $filterlist_sql = "select distinct au.authors_id as id, au.authors_name as name from " . TABLE_ARTICLES . " a left join " . TABLE_ARTICLES_TO_TOPICS . " a2t on a.articles_id = a2t.articles_id left join " . TABLE_AUTHORS . " au on a.authors_id = au.authors_id where a.articles_status = '1' and a2t.topics_id = '" . (int)$current_topic_id . "' order by au.authors_name";
                  }
                  $filterlist_query = tep_db_query($filterlist_sql);
                  if (tep_db_num_rows($filterlist_query) > 1) {
                    echo '<td align="right" class="main">' . tep_draw_form('filter', FILENAME_ARTICLES, 'get') . TEXT_SHOW . '&nbsp;';
                    if (isset($_GET['authors_id'])) {
                      echo tep_draw_hidden_field('authors_id', $_GET['authors_id']);
                      $options = array(array('id' => '', 'text' => TEXT_ALL_TOPICS));
                    } else {
                      echo tep_draw_hidden_field('tPath', $tPath);
                      $options = array(array('id' => '', 'text' => TEXT_ALL_AUTHORS));
                    }
                    echo tep_draw_hidden_field('sort', $_GET['sort']);
                    while ($filterlist = tep_db_fetch_array($filterlist_query)) {
                      $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
                    }
                    echo tep_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
                    echo '</form></td>' . "\n";
                  }
                }
               ?>
              </tr>
              <?php if ( tep_not_null($topic['topics_description']) ) { ?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td align="left" colspan="2"><h2><?php echo $topic['topics_description']; ?></h2></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <?php } ?>
              <?php if (tep_not_null($authors_description)) { ?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td class="main" colspan="2" valign="top"><?php echo $authors_description; ?></td>
              <tr>
                <?php } ?>
                <?php if (tep_not_null($authors_url)) { ?>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main" colspan="2" valign="top"><?php echo sprintf(TEXT_MORE_INFORMATION, $authors_url); ?></td>
              <tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <tr>
          <td><?php include(DIR_WS_MODULES . FILENAME_ARTICLE_LISTING); ?></td>
        </tr>
      </table>
    <?php
  } else { // default page
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><h1><?php echo HEADING_TITLE; ?></h1></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <tr>
          <td class="main"><?php echo '<b>' . TEXT_CURRENT_ARTICLES . '</b>'; ?></td>
        </tr>
        <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>

        <?php
  $articles_all_array = array();
  $articles_all_query_raw = "select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_id, au.authors_name, td.topics_id, td.topics_name from " . TABLE_ARTICLES . " a left join " . TABLE_ARTICLES_TO_TOPICS . " a2t on a.articles_id = a2t.articles_id left join " . TABLE_TOPICS_DESCRIPTION . " td on a2t.topics_id = td.topics_id left join " . TABLE_AUTHORS . " au on a.authors_id = au.authors_id left join " . TABLE_ARTICLES_DESCRIPTION . " ad on a.articles_id = ad.articles_id  where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now()))  and a.articles_status = '1' and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' order by a.articles_date_added desc, ad.articles_name";
  $listing_sql = $articles_all_query_raw;

  //$articles_all_split = new splitPageResults($articles_all_query_raw, MAX_ARTICLES_PER_PAGE);

?>
        <tr>
          <td><?php include(DIR_WS_MODULES . FILENAME_ARTICLE_LISTING); ?></td>
        </tr>
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
            </table></td>
        </tr>
        <?php
  if (($articles_all_split->number_of_rows > 0) && ((ARTICLE_PREV_NEXT_BAR_LOCATION == 'bottom') || (ARTICLE_PREV_NEXT_BAR_LOCATION == 'both'))) {
?>
        <tr>
          <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText"><?php echo $articles_all_split->display_count(TEXT_DISPLAY_NUMBER_OF_ARTICLES); ?></td>
                <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $articles_all_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
        </tr>
        <?php
  }
?>
        <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
        </tr>
        <tr>
          <td><?php include(DIR_WS_MODULES . FILENAME_ARTICLES_UPCOMING); ?></td>
        </tr>

      </table>
    <?php } ?>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'articles_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_bot_eof //-->
      </td>
