    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_article_search_result.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_INFORMATION; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

      <?php
      if (tep_db_num_rows($articles_query)) {
          echo '<tr><td><table border="0" cellpadding="2" width="100%">';
          while ($articles = tep_db_fetch_array($articles_query))  {
             $cleanedDescription = trim(strip_tags($articles['articles_description']));
             echo '<tr><td class="smallText" colspan="2"><a href="' . tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id='.$articles['articles_id'])  . '"><b>' . $articles['articles_name'] . '</b></a></td></tr>';
             echo '<tr><td width="8"></td><td class="smallText">' . (strlen($cleanedDescription) > MAX_ARTICLE_ABSTRACT_LENGTH ? substr($cleanedDescription, 0, MAX_ARTICLE_ABSTRACT_LENGTH) . '<a href="' . tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id='.$articles['articles_id'])  . '">' . TEXT_SEARCH_SEE_MORE . '</a>' : $cleanedDescription ) . '</td></tr>';
          }
          echo '</table></td></tr>';
      } else {
          echo '<tr><td class="main">' . TEXT_NO_ARTICLES_FOUND . '</td></tr>';
      }
      ?>

      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>