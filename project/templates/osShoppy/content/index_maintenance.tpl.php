    <?php echo tep_draw_form('maintenance', tep_href_link(FILENAME_INDEX_MAINTENANCE, 'action=send')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="80%" cellspacing="0" cellpadding="0" align="center">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_contact_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('maintenance') > 0) {
?>
      <tr>
        <td width=""><?php echo $messageStack->output('maintenance'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
      <tr>
        <td><table border="0" width="75%" cellspacing="1" cellpadding="2" class="infoBox" align="center">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
		      <tr>
		        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
		      </tr>
              <tr>
		        <td class="main" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'files/contact_us/contact_form_succes_send.png', HEADING_TITLE, '0', '0'); ?></td>
		        <td class="main" align="center"><?php echo TEXT_SUCCESS; ?></td>
          	  </tr>
		      <tr>
		        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
		      </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="80%" cellspacing="1" cellpadding="2" class="infoBox" align="center">
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
    $account_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $email = $account['customers_email_address'];
  }
?>
      <tr>
        <td><table border="0" width="75%" cellspacing="1" cellpadding="2" class="infoBox" align="center">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
            	<td class="main" align="center"><?php echo MAINTENANCE_TEXT ?></td>
              </tr>
              <tr>
            	<td class="main"><b><?php echo TEXT_ONLINE_DATE_TIME . ONLINE_DATE_TIME ?></b></td>
              </tr>
          	  <tr>
            	<td class="main" align="center"><?php echo MAINTENANCE_TEXT2 ?></td>
          	  </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="70%" cellspacing="0" cellpadding="2" align="center">
        </table></td>
      </tr>
<tr><td>
<table border="0" width="90%" cellspacing="1" cellpadding="2" class="infoBox" align="center">
<tr class="infoBoxContents"><td><table><tr>
         <td class="main" valign="top" width=40%>
<?php if(USE_TEXT_INDEX_MAINTENANCE_COMPANY_DETAILS == 'true') { ?>
                <table class="main"><b><?php echo TEXT_COMPANY_DETAILS; ?></b><br>
                <tr><td class="main"><?php echo TEXT_INDEX_MAINTENANCE_COMPANY_DETAILS; ?><br /><br /></td></tr>
<?php 	} ?>
<?php if(USE_TEXT_INDEX_MAINTENANCE_BANK_DETAILS == 'true') { ?>
                <table class="main"><b><?php echo TEXT_BANK_DETAILS; ?></b><br>
                <tr><td class="main"><?php echo TEXT_INDEX_MAINTENANCE_BANK_DETAILS; ?><br /><br /></td></tr>
<?php 	} ?>
                <table class="main"><?php echo TEXT_OPENING_HOURS; ?>&nbsp;<?php echo TEXT_INDEX_MAINTENANCE_PHONE_NUMBER; ?><br /><br />
<?php if(USE_MAINTENANCE_TEXT_OPENING_WEEK == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_WEEK; ?></td><td class="main" >&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_WEEK_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_MONDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_MONDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_MONDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_TUESDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_TUESDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_TUESDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_WEDNESDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_WEDNESDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_WEDNESDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_THURSDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_THURSDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_THURSDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_FRIDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_FRIDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_FRIDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_SATURDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_SATURDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_SATURDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_SUNDAY == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_SUNDAY; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_SUNDAY_TIME; ?></td></tr>
<?php 	}
	  if(USE_MAINTENANCE_TEXT_OPENING_WEEKEND == 'true') { ?>
                <tr><td class="main"><?php echo TEXT_OPENING_WEEKEND; ?></td><td class="main">&nbsp;&nbsp;<?php echo TEXT_MAINTENANCE_OPENING_WEEKEND_TIME; ?></td></tr>
<?php 	} ?>
                </table>
                <table class="main"><br /><br /><?php echo MAINTENANCE_EXTRA_INFO; ?><br><br>
                </table>
                </td>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_NAME; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_draw_input_field('name'); ?></td>
              </tr>
<?php if(USE_MAINTENANCE_ORDER_ID_INPUT_FIELD == 'true') { ?>
		      <tr>
                <td class="main"><?php echo ENTRY_ORDER_ID; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_draw_input_field('order_id'); ?></td>
              </tr>
<?php 	} ?>
<?php if(USE_MAINTENANCE_SUBJECT_INPUT_FIELD == 'true') { ?>
		      <tr>
                <td class="main"><?php echo ENTRY_SUBJECT; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_draw_input_field('subject'); ?></td>
              </tr>
<?php 	} 
	  if(USE_MAINTENANCE_SUBJECT_DROPDOWN_FIELD == 'true') { ?>
               <tr><td class="main"><?php echo ENTRY_SUBJECT; ?><br>
					<select name="reason">
						<?php if(USE_MAINTENANCE_REASONS1 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS1 . '">' . MAINTENANCE_REASONS1 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS2 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS2 . '">' . MAINTENANCE_REASONS2 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS3 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS3 . '">' . MAINTENANCE_REASONS3 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS4 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS4 . '">' . MAINTENANCE_REASONS4 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS5 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS5 . '">' . MAINTENANCE_REASONS5 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS6 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS6 . '">' . MAINTENANCE_REASONS6 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS7 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS7 . '">' . MAINTENANCE_REASONS7 . '</option>'; } ?>
						<?php if(USE_MAINTENANCE_REASONS8 == 'true') { 
								echo '<option value="' . MAINTENANCE_REASONS8 . '">' . MAINTENANCE_REASONS8 . '</option>'; } ?>
					</select><br />
              </td></tr>
<?php 	} ?>
              <tr>
                <td class="main"><?php echo ENTRY_EMAIL; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_draw_input_field('email'); ?></td>
              </tr>
<?php if(USE_MAINTENANCE_PHONE_NUMBER_INPUT_FIELD == 'true') { ?>
		      <tr>
                <td class="main"><?php echo ENTRY_PHONE_NUMBER; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo tep_draw_input_field('phone_number'); ?></td>
              </tr>
<?php 	} ?>
              <tr>
                <td class="main"><?php echo ENTRY_ENQUIRY; ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_textarea_field('enquiry', 'soft', '50', '15'); ?></td>
              </tr>
            </table></td>
                    </td></tr></table></td>
</tr>
</table>
<br />
<table border="0" width="80%" cellspacing="1" cellpadding="2" class="infoBox" align="center">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		        <td class="main" align="left"><?php echo tep_draw_checkbox_field('send_copy_customer', '1', true) . '&nbsp;' . (tep_not_null(TEXT_COPY_CUSTOMER) ? '<span class="main">' . TEXT_COPY_CUSTOMER . '</span>': ''); ?></td>
                <td align="right"><?php echo tep_image_submit('button_send.png', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td></tr>   
<?php

  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
    </table></form>
