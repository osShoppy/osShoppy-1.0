<script language="JavaScript" src="includes/javascript/qTip.js" type="text/JavaScript"></script>
    <?php echo tep_draw_form('create_account', tep_href_link(FILENAME_CREATE_ACCOUNT, (isset($HTTP_GET_VARS['guest'])? 'guest=guest':''), 'SSL'), 'post', 'onSubmit="return check_form(create_account);"') . tep_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { 
            if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])){
            ?>
              <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
            <?php }else{ ?>
              <td class="pageHeading"><h1><?php echo HEADING_TITLE_PWA; ?></h1></td>
            <?php }
            } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
              <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_create_account.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="smallText"><br><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php if ($messageStack->size('create_account') > 0) { ?>
      <tr>
        <td><?php echo $messageStack->output('create_account'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo CATEGORY_PERSONAL; ?></b></td>
           <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
<?php if (ACCOUNT_GENDER == 'true') { ?>
              <tr>
                <td class="main"><?php echo ENTRY_GENDER; ?></td>
                <td class="main"><?php echo tep_draw_radio_field('gender', 'm') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
              </tr>
<?php } ?>
              <tr>
                <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('firstname','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_NAME .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('firstname') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_INSERTION_NAME; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('insertion','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_INSERTION_NAME .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_INSERTION_NAME_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('insertion') . '&nbsp;' . (tep_not_null(ENTRY_INSERTION_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_INSERTION_NAME_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('lastname','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_LAST_NAME .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('lastname') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
<?php if (ACCOUNT_DOB == 'true') { ?>
              <tr>
                <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('dob','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_DATE_OF_BIRTH .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('dob') . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
<?php } ?>
			  <tr>
				<td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('email_address','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_EMAIL .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('email_address') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
			  <tr>
                <td class="main"><?php echo ENTRY_CONFIRM_EMAIL_ADDRESS; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('confirm_email_address','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_CONFIRM_EMAIL .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('confirm_email_address') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php if (ACCOUNT_COMPANY == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_COMPANY; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_COMPANY; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('company','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_COMPANY .'"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('company') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_COMPANY_TAX_ID; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('company_tax_id','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_COMPANY_ID .'"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TAX_ID_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TAX_ID_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('company_tax_id') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TAX_ID_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TAX_ID_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_ADDRESS; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('street_address','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_STREET_NAME .'"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('street_address') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_STREET_NO; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('street_no','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_STREET_NUMBER .'"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NO_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NO_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('street_no') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NO_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NO_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_STREET_NO_ADD; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('street_no_add','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_STREET_NUMBER_ADD .'"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NO_ADD_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NO_ADD_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('street_no_add') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NO_ADD_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NO_ADD_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
<?php if (ACCOUNT_SUBURB == 'true') { ?>
              <tr>
                <td class="main"><?php echo ENTRY_SUBURB; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('suburb','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_SUBURB .'"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('suburb') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
<?php } ?>
              <tr>
                <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('postcode','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_POSTCODE .'"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('postcode') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_CITY; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('city','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_CITY .'"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('city') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
<?php if (ACCOUNT_STATE == 'true') { ?>
              <tr>
                <td class="main"><?php echo ENTRY_STATE; ?></td>
                <td class="main">
<?php
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('state', $zones_array);
      } else {
        echo tep_draw_input_field('state');
      }
    } else {
	 if (USE_CREATE_ACCOUNT_HINTS == 'true') { 
      echo tep_draw_input_field('state','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_STATE .'"');
	 } else { 
      echo tep_draw_input_field('state');
	 }
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT . '</span>';
?>
                </td>
              </tr>
<?php } ?>
              <tr>
                <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
                <td class="main"><?php echo tep_get_country_list('country') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
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
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('telephone','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_PHONE_NUMBER .'"') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('telephone') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_FAX_NUMBER; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('fax','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_FAX_NUMBER .'"') . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('fax') . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?></td>
				<?php } ?>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])) {
?>
<?php if ((tep_not_null(tep_get_sources()) || DISPLAY_REFERRAL_OTHER == 'true') && (!tep_session_is_registered('referral_id') || (tep_session_is_registered('referral_id') && DISPLAY_REFERRAL_SOURCE == 'true')) ) { ?>
      <tr>
        <td class="main"><b><?php echo CATEGORY_SOURCE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_SOURCE; ?></td>
                <td class="main"><?php echo tep_get_source_list('source', (DISPLAY_REFERRAL_OTHER == 'true' || (tep_session_is_registered('referral_id') && tep_not_null($referral_id)) ? true : false), (tep_session_is_registered('referral_id') && tep_not_null($referral_id)) ? '9999' : '') . '&nbsp;' . (tep_not_null(ENTRY_SOURCE_TEXT) ? '<span class="inputRequirement">' . ENTRY_SOURCE_TEXT . '</span>': ''); ?></td>
              </tr>
			  <?php if (DISPLAY_REFERRAL_OTHER == 'true' || (tep_session_is_registered('referral_id') && tep_not_null($referral_id))) { ?>
              <tr>
                <td class="main"><?php echo ENTRY_SOURCE_OTHER; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_input_field('source_other','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_REFERRAL .'"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_input_field('source_other', (tep_not_null($referral_id) ? $referral_id : '')) . '&nbsp;' . (tep_not_null(ENTRY_SOURCE_OTHER_TEXT) ? '<span class="inputRequirement">' . ENTRY_SOURCE_OTHER_TEXT . '</span>': ''); ?></td>
			  	<?php } ?>
              </tr>
			  <?php } ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php } else if (DISPLAY_REFERRAL_SOURCE == 'false') {
      echo tep_draw_hidden_field('source', ((tep_session_is_registered('referral_id') && tep_not_null($referral_id)) ? '9999' : '')) . tep_draw_hidden_field('source_other', (tep_not_null($referral_id) ? $referral_id : ''));
  } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_OPTIONS; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_NEWSLETTER; ?></td>
                <td class="main"><?php echo tep_draw_checkbox_field('newsletter', '1') . '&nbsp;' . (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_PASSWORD; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_PASSWORD; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_password_field('password','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_PASSWORD .'"') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_password_field('password') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?></td>
			  	<?php } ?>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
				<?php if (USE_CREATE_ACCOUNT_HINTS == 'true') { ?>
                <td class="main"><?php echo tep_draw_password_field('confirmation','','id="TextBox" title="' . HINT_CREATE_ACCOUNT_CONFIRM_PASSWORD .'"') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?></td>
				<?php } else { ?>
                <td class="main"><?php echo tep_draw_password_field('confirmation') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?></td>
			  	<?php } ?>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
  else
  {
?>
 <tr>
   <td><?php echo tep_draw_hidden_field('guest', 'guest'); ?></td>
 </tr>
<?php } 
?>
<?php if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'create_account') &&  ACCOUNT_CREATE_VALIDATION == 'true') 
		include(DIR_WS_MODULES . FILENAME_DISPLAY_VALIDATION); ?>
<?php if(MATC_AT_REGISTER != 'false'){
		require(DIR_WS_MODULES . 'matc.php');
} ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo tep_image_submit('button_confirm_create_account.png', IMAGE_BUTTON_CONTINUE,'id="TheSubmitButton"'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></form>

