    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
         <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="250px" align="center"><?php echo tep_image(DIR_WS_IMAGES . 'files/account/logged_off_success.png', HEADING_TITLE); ?></td>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="pageHeading" align="center"><h1><?php echo HEADING_TITLE; ?></h1></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
				<?php session_start();
				  $old_user = $affiliate_id;  // store  to test if they *were* logged in
				  $result = session_unregister("affiliate_id");

				//session_destroy();

 				if (!empty($old_user)) {
				    if ($result) { // if they were logged in and are not logged out 
				      echo '            <td class="main">' . TEXT_INFORMATION . '</td>';
				     } else { // they were logged in and could not be logged out
				      echo '            <td class="main">' . TEXT_INFORMATION_ERROR_1 . '</td>';
				     } 
				   } else { // if they weren't logged in but came to this page somehow
				     echo '            <td class="main">' . TEXT_INFORMATION_ERROR_2 . '</td>';
				} ?>
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
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>

