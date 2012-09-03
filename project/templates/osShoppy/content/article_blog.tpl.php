    <table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
  if ($messageStack->size('new_comment') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('new_comment'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
<?php
  if ($article_check['total'] < 1) {
?>
      <tr>
        <td class="pageHeading" ><?php echo HEADING_ARTICLE_NOT_FOUND; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" ><?php echo TEXT_ARTICLE_NOT_FOUND; ?></td>
      </tr>
<?php
  } else {
    $article_info_query = tep_db_query("select a.articles_id, a.articles_date_added, a.articles_date_available, a.authors_id, ad.articles_name, ad.articles_description, ad.articles_image, ad.articles_url, au.authors_name, au.authors_image from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . (int)$_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
    $article_info = tep_db_fetch_array($article_info_query);

    tep_db_query("update " . TABLE_ARTICLES_DESCRIPTION . " set articles_viewed = articles_viewed+1 where articles_id = '" . (int)$_GET['articles_id'] . "' and language_id = '" . (int)$languages_id . "'");

    $articles_name = $article_info['articles_name'];
    $articles_author_id = $article_info['authors_id'];
    $articles_author = $article_info['authors_name'];
    $articlePrintArray = $article_info;
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><h1><?php echo $articles_name; ?></h1></td>
             <td align="right" valign="top"><h1>
             <?php
             if (tep_not_null($articles_author) && DISPLAY_AUTHOR_ARTICLE_LISTING == 'true') {
                $authorsImage = DIR_WS_IMAGES . 'article_manager_uploads/' . $article_info['authors_image'];
                if (file_exists($authorsImage) && is_file($authorsImage)) {
                    echo '<a href="' . tep_href_link(FILENAME_ARTICLES,'authors_id=' . $articles_author_id) . '">' . tep_image($authorsImage, HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '</a>';
                } else {
                    echo TEXT_BY . '<a href="' . tep_href_link(FILENAME_ARTICLES,'authors_id=' . $articles_author_id) . '">' . $articles_author . '</a>';
                }
             }
             ?>
             </h1></td>
          </tr>
        </table></td>
      </tr>
      <?php if (tep_not_null($article_info['articles_image']) && file_exists(DIR_WS_IMAGES . 'article_manager_uploads/'.$article_info['articles_image'])) { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo tep_image(DIR_WS_IMAGES . 'article_manager_uploads/'.$article_info['articles_image'], $article_info['articles_name'], ARTICLES_IMAGE_WIDTH, ARTICLES_IMAGE_HEIGHT); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main">
          <p><?php echo stripslashes($article_info['articles_description']); ?></p>
        </td>
      </tr>
<?php
    if (tep_not_null($article_info['articles_url'])) {
?>
      <tr>
        <td class="smallText"><?php echo sprintf(TEXT_MORE_INFORMATION, "http://" . urlencode($article_info['articles_url']) ); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    }

    if (DISPLAY_DATE_ADDED_ARTICLE_LISTING == 'true') {
     if ($article_info['articles_date_available'] > date('Y-m-d H:i:s')) {
?>
      <tr>
        <td align="left" class="smallText"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($article_info['articles_date_available'])); ?></td>
      </tr>
<?php
     } else {
?>
      <tr>
        <td align="left" class="smallText"><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($article_info['articles_date_added'])); ?></td>
      </tr>
      <tr>
        <td class="smallText"><?php echo TEXT_BY . '<b>' . $article_info['authors_name']; ?></b></td>
      </tr>
<?php
     }
    }
?>
      <tr>
        <td><?php echo tep_image(DIR_WS_IMAGES . 'pixel_black.gif', '', '100%', '1'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="smallText"><?php echo TEXT_COMMENT; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

      <!-- BEGIN SHOWING THE COMMENTS //-->
      <?php $comments_query = tep_db_query("SELECT * from " . TABLE_ARTICLES_BLOG . " where articles_id = " . (int)$_GET['articles_id'] . " and comments_status = 1 and language_id = " . (int)$languages_id);
        while($comments = tep_db_fetch_array($comments_query)) {
      ?>
        <tr><td><?php echo tep_image(DIR_WS_IMAGES . 'pixel_silver.gif', '', '100%', '1') .'<br>' . tep_draw_separator('pixel_trans.gif', '100%', '6'); ?></td></tr>

        <tr>
          <td class="smallText" style="background-color:lightyellow;"><?php echo sprintf(TEXT_WHO_SAID, $comments['commenters_name'], date ("F d, Y \a\\t h:i A", strtotime($comments['comment_date_added']))); ?></td>
        </tr>

        <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>

        <tr>
          <td class="smallText"><?php echo $comments['comment']; ?></td>
        </tr>

        <tr>
          <td><?php echo
            tep_draw_separator('pixel_trans.gif', '100%', '6') . '<br>' .
            tep_image(DIR_WS_IMAGES . 'pixel_silver.gif', '', '100%', '1') . '<br>' .
            tep_draw_separator('pixel_trans.gif', '100%', '6'); ?>
          </td>
        </tr>
      <?php } ?>
      <!-- END SHOWING THE COMMENTS //-->

      <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>

      <!-- BEGIN POST A COMMENT SECTION //-->
      <?php echo tep_draw_form('new_comment', tep_href_link(FILENAME_ARTICLE_BLOG, tep_get_all_get_params()), 'post') . tep_hide_session_id() . tep_draw_hidden_field('action', 'process_comment'); ?>
        <tr>
          <td class="smallText"><?php echo TEXT_POST_A_COMMENT; ?></td>
        </tr>
        <tr>
          <td class="smallText"><?php echo tep_draw_textarea_field('blog_comment', 'soft', 40, 5, '', '', false); ?></td>
        </tr>
        <tr>
          <td width="100%"><table border="0" cellpadding="2" width="100%">
            <tr>
              <td class="smallText"><?php echo tep_db_num_rows($comments_query) . ' ' . (tep_db_num_rows($comments_query) > 1 ? TEXT_TOTAL_COMMENTS : TEXT_TOTAL_COMMENT); ?></td>
              <td class="smallText" align="right"><?php echo tep_draw_hidden_field('article_name', $articles_name) . tep_image_submit('button_send_comment.png', IMAGE_BUTTON_SEND_COMMENT, 'name="add_comment"'); ?></td>
            </tr>
          </table></td>
        </tr>
      </form>
<?php
  } //end of article present block
?>
    </table>