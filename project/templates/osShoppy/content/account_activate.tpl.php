<?php echo tep_draw_form('account_activate', tep_href_link(FILENAME_ACCOUNT_ACTIVATE, '', 'SSL'), 'post', 'onSubmit="return check_account_activate();"') . tep_draw_hidden_field('action', 'activate'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE_ACTIVATE; ?></h1></td>
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
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('account_activate') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('account_activate'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
<?php
  if (sizeof($navigation->snapshot) > 0) {
	if($navigation->snapshot['page'] == 'create_account.php') {
?>
      <tr>
        <td><?php echo TEXT_ACCOUNT_CREATED_ACTIVATION_CODE; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
	}
  }  
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo CONFIRMATION_CODE; ?></td>
            <td class="inputRequirement" align="right">&nbsp;<?php echo tep_draw_hidden_field('activation_id', $activation_id); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="smallText"><br><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
			  <tr>
                <td class="main"><?php echo ENTER_CODE . tep_draw_input_field('activation_code', $activation_code); ?></td>
                <td class="main"><?php echo tep_image_submit('button_activate_account.png', IMAGE_BUTTON_CONTINUE); ?></td>
              </tr>
			</table></td>
		  </tr>
        </table></td>
      </tr>
    </table></form></td>
<!-- body_text_eof //-->
