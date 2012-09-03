<script language="JavaScript" src="includes/javascript/qTip.js" type="text/JavaScript"></script>
    <?php echo tep_draw_form('affiliate_signup',  tep_href_link(FILENAME_AFFILIATE_SIGNUP, '', 'SSL'), 'post') . tep_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
        <td>
<?php
  if (isset($HTTP_GET_VARS['affiliate_email_address'])) $a_email_address = tep_db_prepare_input($HTTP_GET_VARS['affiliate_email_address']);
  $affiliate['affiliate_country_id'] = STORE_COUNTRY;

  require(DIR_WS_MODULES . 'affiliate_signup_details.php');
?>
        </td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo tep_image_submit('button_confirm_create_account.png', IMAGE_BUTTON_CONTINUE); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
    </table></form>
    
