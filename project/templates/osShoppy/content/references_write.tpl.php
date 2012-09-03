     <form name="references" method="post" action="<?php echo tep_href_link(FILENAME_REFERENCES_WRITE, 'action=insert', 'NONSSL'); ?>" enctype="multipart/form-data">
	 <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE2; ?></h1></td>
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
  if ($messageStack->size('references') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('references'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
      <tr>
        <td class="main" align="center"><?php echo TEXT_REFERENCES_SUCCESSFUL; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php if (USE_POINTS_AND_REWARDS == 'true') { ?>
      <tr>
        <td class="main" align="center"><?php echo TEXT_REFERENCES_POINTS; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php } ?>
      <tr>
        <td class="main" align="center"><?php echo TEXT_REFERENCES_SIGNATURE; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
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
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
  if (tep_session_is_registered('customer_id')) {
    $account_query = tep_db_query("select customers_firstname, customers_insertion, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $references_name = $account['customers_firstname'] . ' ' . $account['customers_insertion'] . ' ' . $account['customers_lastname'];
    $references_email = $account['customers_email_address'];
  }
?>
      <tr>
        <td>
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
		  <tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_REFERENCES_INTRO; ?></td>
          </tr>
		  <tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_REFERENCES_ALLOWED; ?></td>
          </tr>
		  <tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
		    <td><table align="center" width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
			  <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><b><?php echo TEXT_REFERENCES_WRITE; ?></b></td>
                    <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
                  </tr>
                </table></td>
              </tr>
			  <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
			      <tr>
                    <td class="main"><?php echo TEXT_REFERENCES_TITLE; ?><br>
                                     <?php echo tep_draw_input_field('references_title',  $references_title, '', true); ?> <span class="inputRequirement">*</span></td>
                  </tr>
		          <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                  </tr>
		          <tr>
                    <td class="main"><?php echo TEXT_REFERENCES_NAME; ?><br>
                                     <?php echo tep_draw_input_field('references_name', $references_name, '', true); ?> <span class="inputRequirement">*</span></td>
                  <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                  </tr>
		          <tr>
			        <td class="main"><?php echo TEXT_REFERENCES_EMAIL; ?><br>
			                         <?php echo tep_draw_input_field('references_email'); ?> <span class="inputRequirement">*</span></td>
		          </tr>
		          <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                  </tr>
		          <tr>
                    <td class="main"><?php echo TEXT_REFERENCES_LOCATION; ?><br>
                                     <?php echo tep_draw_input_field('references_location', $references_location); ?></td>
       	          </tr>
		          <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                  </tr>
                  <tr>
                    <td valign="top" class="main"><?php echo TEXT_BANNERS_HTML_TEXT; ?> <span class="inputRequirement">*</span><br>
											      <?php echo tep_draw_textarea_field('html_text', 'soft', '130', '10', $html_text); ?></td>
                  </tr>
		          <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                  </tr>

<?php
/*** Begin Customer Testimonials v6 ***/
  if (REFERENCES_IMAGE_ALLOW == 'Yes') {
?>
                  <tr>
                    <td valign="top" class="main"><?php echo TEXT_UPLOAD_REFERENCES_IMAGE; ?><br>
											      <?php echo tep_draw_file_field('references_image'); ?></td>
                  </tr>
<?php
	}
/*** End Customer Testimonials v6 ***/
?>

			    </table></td>
		      </tr>
			</table></td>
		  </tr></table>

<?php
/*** Begin Customer Testimonials v6 ***/
  if (REFERENCES_CAPTCHA == 'Yes') {
?>
<!-- start modification for reCaptcha -->
          <tr>
            <td class="main"><?php echo ENTRY_SECURITY_CHECK; ?></td>
          </tr>
          <tr>
			<?php
			$languages_query = tep_db_query("select code from " . TABLE_LANGUAGES . " where directory = '" . $language . "'");
			$language_id = tep_db_fetch_array($languages_query);
			?>
			<script>
			var RecaptchaOptions = {
			theme : 'white',
			tabindex : 3,
			lang : '<?php if (in_array($language_id['code'] ,array('en', 'fr', 'de', 'pt', 'es', 'au', 'nz', 'ca'))) {echo $language_id['code']; } else {echo 'en'; } ?>',
			};
			</script>
			<td><?php echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY, null, ($request_type == 'SSL')); ?></td>
          </tr>
<!-- end modification for reCaptcha -->
<?php
  }
/*** End Customer Testimonials v6 ***/
?>

          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
		  </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					<td class="main" align="left" valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_REFERENCES) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                    <td class="main" align="right" valign="middle"><?php echo tep_image_submit('button_send_reference.png', IMAGE_BUTTON_SUBMIT_REFERENCES); ?></td>
					<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></form></td>
      </tr>
<?php
}
?>
</td></table>
