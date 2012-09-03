    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1><?php echo HEADING_ARTICLE_SUBMIT; ?></h1></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

<?php if ($wasSubmitted == true) { ?>
      <tr>
        <td class="pageHeading"><?php echo TEXT_ARTICLE_SUBMITTED; ?></td>
      </tr>
      <tr>
       <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
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
<?php } else { ?>
      <tr>
       <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
         <td><class="main"><?php echo TEXT_ARTICLE_SUBMIT; ?></td>
        </tr>
        <tr>
         <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
        </tr>
       </table></td>
      </tr>

<?php
  if ($messageStack->size('article_submit') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('article_submit'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
       <?php echo tep_draw_form('article_submit', tep_href_link(FILENAME_ARTICLE_SUBMIT, '', 'NONSSL'), 'post', 'enctype="multipart/form-data" onSubmit="return true;" onReset="return true"') . tep_draw_hidden_field('action', 'process'); ?>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="50%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <th class="textSmall" align="left" width="110"><?php echo TEXT_ARTICLE_NAME; ?></th>
                    <td class="textSmall"><?php echo tep_draw_input_field('article_name', $article['name'], 'maxlength="60" size="40"', false); ?> </td>
                  </tr>
                  <tr>
                    <th class="textSmall" align="left"><?php echo TEXT_SHORT_DESCRIPTION; ?></th>
                    <td class="textSmall"><?php echo tep_draw_input_field('article_short_desc', $article['meta_desc'], 'maxlength="60" size="40"', false); ?></td>
                  </tr>
                  <tr>
                   <th class="textSmall" align="left"><?php echo TEXT_ARTICLE_PLACEMENT; ?></th>
                   <td class="textSmall"><?php echo tep_draw_pull_down_menu('topics_list', $topicsList); ?></td>
                  </tr>
                  <tr>
                    <th class="textSmall" align="left"><?php echo TEXT_ARTICLE_UPLOAD_IMAGE; ?></th>
                    <td class="textSmall"><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="uploadedfile" type="file"></td>
                  </tr>
                  <tr>
                    <th colspan="2" class="textSmall" align="left"><?php echo TEXT_ARTICLE_TEXT; ?></th>
                  </tr>
                </table></td>
                <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <th class="textSmall" align="left" width="90"><?php echo TEXT_AUTHORS_NAME; ?></th>
                    <td class="textSmall"><?php echo tep_draw_input_field('authors_name', $authorInfo['authors_name'], 'maxlength="60" size="40"', false); ?> </td>
                  </tr>
                  <tr>
                    <th class="textSmall" align="left" width="90"><?php echo TEXT_AUTHORS_IMAGE; ?></th>
                    <td class="textSmall"><input type="hidden" name="authors_image_size" value="100000"><input name="authors_image" type="file"></td>
                  </tr>
                  <tr>
                    <td valign="top" colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="1">
                      <tr>
                        <th class="textSmall" align="left" width="90" valign="top"><?php echo TEXT_AUTHORS_INFO; ?></th>
                        <td class="textSmall"><?php echo tep_draw_textarea_field('authors_description', 'soft', '5', '2', $authorInfo['authors_description'], '', false); ?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>

              <tr>
                <td colspan="2" class="textSmall"><?php echo tep_draw_textarea_field('article_long_desc', 'soft', '40', '15', $article['text'], '', false); ?></td>
              </tr>
            </table></td>

          </tr>
        </table></td>
      </tr>



       <tr>
         <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
       </tr>
       <tr>
         <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
           <tr class="infoBoxContents">
             <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
               <tr>
                 <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                 <td align="right"><?php echo tep_image_submit('button_send.png', IMAGE_BUTTON_SUBMIT); ?></td>
                 <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
               </tr>
             </table></td>
           </tr>
         </table></td>
       </tr>
       </form>
      </tr>

     <?php } //end of wasSubmitted ?>
    </table>