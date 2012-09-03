<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'testimonials_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_top_eof //-->
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
<!--      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr> //-->
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">
            <?php
            if ($testimonial_id != '') {
                $testimonial_id = ($testimonial_id);
                $full_testimonial = tep_db_query("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE testimonials_id = " . (int)$testimonial_id);
            }
            else {
                $full_testimonial = tep_db_query("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE status = '1' order by rand()");
            }
            while ($testimonials = tep_db_fetch_array($full_testimonial)) {
                $testimonial_array[] = array('id' => $testimonials['testimonials_id'],
                                             'author' => $testimonials['testimonials_name'],
											 'location' => $testimonials['testimonials_location'],
											 'title' => $testimonials['testimonials_title'],
                                             'testimonial' => $testimonials['testimonials_html_text'],
                                             'word_count' => tep_word_count($testimonials['testimonials_html_text'], ' '),
                                             'image' => $testimonials['testimonial_image'],
											 'date_added' => $testimonials['date_added'],
                                             'email' => $testimonials['testimonials_email']);
                }
            require(DIR_WS_MODULES  . 'customer_testimonials.php');
            ?>
            </td>
          </tr>
        </table></td>
      </tr>
	   <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>

<?php
/*** Begin Customer Testimonials v6 ***/ 
// Check to see if user is allowed to write testimonials
// If not, do not display the button link to the write testimonials page
// Check 1) writing testimonials by customers is not disabled; and 
// 2) admin set registered users only and user not logged in; or
// 3) admin set all users may write testimonials
  if ((TESTIMONIAL_REGISTERED_WRITE != "Disabled") && ((TESTIMONIAL_REGISTERED_WRITE == "All Users") || ((TESTIMONIAL_REGISTERED_WRITE == "Registered Users Only") && (tep_session_is_registered('customer_id'))))) {
?>
				<td align="left"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS_WRITE) . '">' . tep_image_button('button_write_testimonial.png', IMAGE_BUTTON_WRITE_TESTIMONIAL) . '</a>'; ?></td>
<?php
	}
/*** End Customer Testimonials v6 ***/ 
?>

              <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
        </table></td>
      </tr>
    </table>
	</td>
      </tr>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'testimonials_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_bot_eof //-->
