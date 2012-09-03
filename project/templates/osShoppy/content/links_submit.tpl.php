    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
			<?php } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="smallText"><?php echo TEXT_MAIN_INTRO; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php if (LINKS_ALLOW_EDITING == 'true') { ?>
      <tr>
        <td class="smallText"><?php echo TEXT_MAIN_ALLOW_EDITING; ?></td>
      </tr>
      <tr>
       <td align="center"><?php echo tep_draw_form('customer_edit', tep_href_link(FILENAME_LINKS_SUBMIT, '', 'SSL'), 'post', 'onSubmit="CheckLogin(customer_edit);"') . tep_draw_hidden_field('action', 'customer_edit'); ?>
        <table border="0" width="70%" cellspacing="0" cellpadding="0">
<?php
  if ($messageStack->size('customer_edit') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('submit_link'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
        <tr>
        <td class="main"><?php echo ENTRY_LINKS_USERNAME; ?></td>
        <td class="main"><?php echo tep_draw_input_field('links_customer_edit_username'); ?></td>
        <td class="main"><?php echo ENTRY_LINKS_PASSWORD; ?></td>
        <td class="main"><?php echo tep_draw_password_field('links_customer_edit_password'); ?></td>
        <td align="right"><?php echo tep_image_submit('button_small_edit.png', IMAGE_BUTTON_EDIT); ?></td>
        </tr>
       </table></form></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php } ?>
      <tr>
<?php if (LINKS_RECIPROCAL_REQUIRED == 'true') { ?>
        <td class="smallText"><?php echo TEXT_MAIN_RECIPROCAL; ?></td>
<?php } else { ?>
        <td class="smallText"><?php echo TEXT_MAIN; ?></td>
<?php } ?>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
     </table>


     <?php echo tep_draw_form('submit_link', tep_href_link(FILENAME_LINKS_SUBMIT, '', 'SSL'), 'post', 'enctype="multipart/form-data" onSubmit="return check_form(submit_link);"') . tep_draw_hidden_field('action', 'process'); ?>
     <table border="0" width="100%" cellspacing="0" cellpadding="0">

<?php
  if ($messageStack->size('submit_link') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('submit_link'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo CATEGORY_WEBSITE; ?></b>&nbsp;&nbsp;<span class="inputRequirement"><?php echo FORM_REQUIRED_INFORMATION; ?></span></td>
            <td><script>document.writeln('<a style="cursor:pointer" onclick="javascript:popup=window.open('
                                           + '\'<?php echo tep_href_link(FILENAME_POPUP_LINKS_HELP); ?>\',\'popup\','
                                           + '\'scrollbars,resizable,width=620,height=410,left=50,top=50\'); popup.focus(); return false;">'
                                           + '<span class="smallText" style="color: red;"><?php echo TEXT_LINKS_HELP_LINK; ?></span></a>');</script>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="linkSubmit">
          <tr class="linkSubmit">
            <td><table border="0" width="70%" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="25%"><?php echo ENTRY_LINKS_TITLE; ?></td>
                <td class="main"><nobr><?php echo tep_draw_input_field('links_title', $links_edit['links_title'], 'maxlength="64", size="35"') . '&nbsp;' . (tep_not_null(ENTRY_LINKS_TITLE_TEXT) ? '<span class="inputRequirement">' . ENTRY_LINKS_TITLE_TEXT . '</span>': ''); ?></nobr></td>
              </tr>
              <tr>
                <td class="main" width="25%"><?php echo ENTRY_LINKS_URL; ?></td>
                <td class="main"><nobr><?php echo tep_draw_input_field('links_url', (tep_not_null($links_edit['links_url'])) ?  $links_edit['links_url'] : 'http://', 'maxlength="255", size="35"') . '&nbsp;' . (tep_not_null(ENTRY_LINKS_URL_TEXT) ? '<span class="inputRequirement">' . ENTRY_LINKS_URL_TEXT . '</span>': ''); ?></nobr></td>
              </tr>
<?php
  //link category drop-down list
  $categories_array = tep_get_link_category_tree();

  if (isset($_GET['lPath'])) {
    $current_categories_id = $_GET['lPath'];

    $current_categories_query = tep_db_query("select link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id ='" . (int)$current_categories_id . "' and language_id ='" . (int)$languages_id . "'");
    if ($categories = tep_db_fetch_array($current_categories_query)) {
      $default_category = $categories['link_categories_name'];
    } else {
      $default_category = '';
    }
  }
?>
              <tr>
                <td class="main"><?php echo ENTRY_LINKS_CATEGORY; ?></td>
                <td class="main">
<?php
    echo tep_draw_pull_down_menu('links_category', $categories_array, $default_category);
?>
                </td>
<?php
    if (! tep_not_null($categories_array))
      echo '&nbsp;<span class="inputRequirement">' . ENTRY_LINKS_CATEGORY_TEXT;
?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_LINKS_SUGGESTION; ?></td>
                <td class="main"><nobr><?php echo tep_draw_input_field('links_cat_suggest', '', 'maxlength="32", size="35"'); ?></nobr></td>
              </tr>
              <tr>
                <td class="main" valign="top"><?php echo ENTRY_LINKS_DESCRIPTION; ?></td>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                 <tr>
                  <td class="main"><nobr><?php echo tep_draw_textarea_field('links_description', 'soft', 20, 5, $links_edit['links_description']);?></nobr></td>
                  <td valign="top"><?php echo (tep_not_null(ENTRY_LINKS_DESCRIPTION_TEXT) ? '<nobr><span class="inputRequirement">' . ENTRY_LINKS_DESCRIPTION_TEXT . '</span>': ''); ?></td>
                </tr>
                </table></td>
              </tr>
              <tr>
                <td class="main" align="left"><?php echo ENTRY_LINKS_UPLOAD_IMAGE; ?></td>
                <td class="textSmall"><input type="hidden" name="MAX_FILE_SIZE" value="10000"><input name="link_image_upload" type="file"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_CONTACT; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="linkSubmit">
          <tr class="linkSubmit">
            <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="18%"><?php echo ENTRY_LINKS_CONTACT_NAME; ?></td>
                <td class="main"><nobr><?php echo tep_draw_input_field('links_contact_name', $links_edit['links_contact_name'], 'maxlength="100", size="30"') . '&nbsp;' . (tep_not_null(ENTRY_LINKS_CONTACT_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LINKS_CONTACT_NAME_TEXT . '</span>': ''); ?></nobr></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                <td class="main"><nobr><?php echo tep_draw_input_field('links_contact_email', $links_edit['links_contact_email'], 'maxlength="96", size="30"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></nobr></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>

<?php if (LINKS_RECIPROCAL_REQUIRED == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_RECIPROCAL; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="linkSubmit">
          <tr class="linkSubmit">
            <td><table width="60%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="25%"><?php echo ENTRY_LINKS_RECIPROCAL_URL; ?></td>
                <td class="main"><nobr><?php echo tep_draw_input_field('links_reciprocal_url', (tep_not_null($links_edit['links_reciprocal_url'])) ? $links_edit['links_reciprocal_url'] : 'http://', 'maxlength="255", size="35"') . '&nbsp;' . (tep_not_null(ENTRY_LINKS_RECIPROCAL_URL_TEXT) ? '<span class="inputRequirement">' . ENTRY_LINKS_RECIPROCAL_URL_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php if (LINKS_ALLOW_EDITING == 'true') { ?>
      <tr>
        <td class="main"><b><?php echo CATEGORY_LOGIN_INFORMATION; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="linkSubmit">
          <tr class="linkSubmit">
            <td><table width="60%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="25%"><?php echo ENTRY_LINKS_USERNAME; ?></td>
                <td class="main"><?php echo tep_draw_input_field('links_username', $links_edit['links_partner_username']); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_LINKS_PASSWORD; ?></td>
                <td class="main"><?php echo tep_draw_password_field('links_password', $links_edit['links_partner_password']); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="linkSubmit">
          <tr class="linkSubmit">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
					    <?php $back = sizeof($navigation->path)-2;
						   if (isset($navigation->path[$back])) {
					    ?>
		            <td><?php echo '<a href="' . tep_href_link($navigation->path[$back]['page']) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
  				    <?php } else { ?>
		            <td><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
					    <?php } ?>

                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php if (LINKS_ALLOW_EDITING == 'true') {
                                          echo tep_draw_hidden_field('editmode', $editmode) .
                                               tep_draw_hidden_field('edit_links_id', $links_edit['links_id']) .
                                               tep_draw_hidden_field('edit_link_categories_id', $links_edit['link_categories_id']);
                                        }
                                        echo tep_image_submit('button_send_link.png', IMAGE_BUTTON_SEND_LINK); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
     </table></form>
