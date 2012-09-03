    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php if ($HTTP_GET_VARS['action'] == 'returns_show') { echo TEXT_SUPPORT_STATUS . ': ' . $returns_status; } else { echo HEADING_TITLE; } ; ?></h1></td>
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>

		<td width="100%" valign="top">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">

          <?php
      if ($HTTP_GET_VARS['action'] == 'returns_show') {
          include(DIR_WS_MODULES . 'returns_track.php');
     // }

      ?>
<?php
 //
?>
		<tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '20', '20'); ?><br /></td>
		</tr>

<?php
//}
?>

	   <table></td>
      <!-- if RMA number doesn't exist, show error message //-->
    <?php
} else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
        	<td width="100%" valign="top">
			  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                 <?php
                  if (isset($error)=='yes') {
                   $error_message = '<tr>
                                     <td width="10">&nbsp;</td>
                                     <td colspan="2" class="main">' . TEXT_TRACK_DETAILS_1 . '</td>
                                     </tr>
                                     <tr>';
                    new infoBox(array(array('text' => $error_message)));
                  // }
                    echo '<br /><br />';
              }
                    $returns = '<form action="' . $PHP_SELF . '?action=returns_show" method=post>
                             <tr>
                             <td colspan="2" class="main"><center>' . TEXT_TRACK_DETAILS_2 . '</center><br /></td>
                             </tr>
                             <tr>
                             <td width="45%" height="30" align="right" class="main">' . TEXT_YOUR_RMA_NUMBER . '&nbsp;</td>
     <td width="50%" height="30" align="left" class="main" colspan="2"><font color="CC0000"><input type="text" name="rma" value="" size="20"></font></td>
   
                             </tr>
                             <tr>
                             <td width="100%" colspan="2" class="main">&nbsp;</td>
                             </tr>
                             <tr>
                             <td width="100%" colspan="2" align="right"><input type=submit name="submit" value="' . TEXT_FIND_RETURN . '">&nbsp;&nbsp;&nbsp;</td>
                             </tr>
                             </form>


                             ';



                 new infoBox(array(array('text' => $returns)));



?>
            </table></td></tr>
           </table></td></tr>
<?php } ?>
            </td>
          </tr>
        </table></td>
      </tr>
    </table>
