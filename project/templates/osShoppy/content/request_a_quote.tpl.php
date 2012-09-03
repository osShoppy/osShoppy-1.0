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
      <!-- BEGIN QUOTE REQUEST SUCCESS -->
      <?php if (isset($_GET['action']) && ($_GET['action'] == 'success')) {?>
      <tr>
       <td><table border="0" width="100%" cellspacing="0" cellpadding="2">      
        <tr>
         <td class="main"><?php echo TEXT_QUOTE_SENT_SUCCESS; ?></td>
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
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>           
      <?php } else { ?><!-- END QUOTE REQUEST SUCCESS -->
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
      if ($messageStack->size('request_quote') > 0) {
      ?>
       <tr>
        <td><?php echo $messageStack->output('request_quote'); ?></td>
       </tr>
       <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
       </tr>
      <?php
      }      
      ?><!-- BEGIN QUOTE REQUEST FORM -->
      <?php echo tep_draw_form('request_quote', tep_href_link(FILENAME_REQUEST_A_QUOTE), 'post', 'onSubmit="return true;" onReset="return true"') . tep_draw_hidden_field('action', 'process_quote'); ?>
      <tr>
       <td><table border="0" width="100%" cellspacing="0" cellpadding="2">      
        <tr>
         <td class="main" width="130"><?php echo ENTRY_NAME; ?></td>
         <td class="main"><?php echo tep_draw_input_field('name', $custArray['name'], 'maxlength="75"', false); ?> </td>
        </tr>
       </table></td>
      </tr>
      <tr>
       <td><table border="0" width="100%" cellspacing="0" cellpadding="2">      
        <tr>
         <td class="main" width="130"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
         <td class="main"><?php echo tep_draw_input_field('email', $custArray['email'], 'maxlength="90"', false); ?> </td>
        </tr>      
       </table></td>
      </tr>
      <tr>
       <td><table border="0" width="100%" cellspacing="0" cellpadding="2">      
        <tr>
         <td class="main" width="130" valign="top"><?php echo ENTRY_QUOTE_MESSAGE; ?>
          <p><INPUT TYPE="checkbox" NAME="loadcart" VALUE="" id="loadcart" onClick="LoadCartContents()"><span class="smallText"><?php echo TEXT_QUOTE_FILL_FROM_CART; ?></span></p>
          <p><input type=button name=choice onClick="window.open('quotes_popup_products.php','popuppage','width=500,height=200,top=100,left=100');" value="Add a Product"></p>          
         </td>
         <td class="main"><?php echo tep_draw_textarea_field('message', 'soft', 30, 15, $message, 'id="44"', false); ?></td>
        </tr>      
       </table></td>
      </tr>
      <tr>
       <td><table border="0" width="100%" cellspacing="1" cellpadding="2">
        <tr>
         <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
         <td align="right"><?php echo tep_image_submit('button_send_quote.png', IMAGE_BUTTON_REQUEST_QUOTE); ?></td>
         <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
        </tr>
       </table></td>
      </tr>
      
      </form>    
      <?php } ?>  
      <!-- END QUOTE REQUEST FORM -->      
    </table>