<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'enquetes_top')) { ?>
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
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
        <td><?php 
		  if (!isset($HTTP_GET_VARS['op'])) {
        	$HTTP_GET_VARS['op']="list";
        	}
			switch ($HTTP_GET_VARS['op']) {
		     case "results":
	         echo("<table align='center' valign='top'><tr><td>\n");
	            include("poll_results.php");
	            echo("</tr></table>\n");
	            break;

	      	case 'comment':
        	echo("<table align='center' valign='top'><tr><td>\n");
        	   include("poll_comment.php");
        	   echo("</tr></table>\n");
        	   break;

     		case 'list':
     		echo("<table align='center' valign='top'><tr><td>\n");
        	   include("poll_list.php");
        	   echo("</tr></table>\n");
        	   break;

     		case "vote":
        	echo("<table align='center' valign='top'><tr><td>\n");
        	   include("poll_vote.php");
        	   echo("</tr></table>\n");
        	   break;
			}
			?>
        </td>
	  </tr>
<?php
	if (!$nolink) {
?>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main" align="left" valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
	}
?>
	</table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'enquetes_bot')) { ?>
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
