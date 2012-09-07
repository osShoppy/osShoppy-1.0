<?php // catalog/includes/modules/link_search.php (2021)

  $boxHeading = BOX_HEADING_LATEST_NEWS;
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  
?>
              <table border="0" width="80%" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td height="14" class="latestnewsboxheading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="latestnewsboxheadingcontent"><?php echo $boxHeading; ?></td>
                  <td height="14" class="latestnewsboxheading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
               </tr>
              </table>
              <table border="0" width="80%" cellspacing="0" cellpadding="1" class="latestnewsbox" align="center">
              	<tr>
                	<td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="latestnewsboxcontent" align="center">
              			<tr>
		        			<td class="latestnewsboxcontent"><?php echo $pagetext; ?></td>
              			</tr>
            		</table></td>
            	</tr>
              </table>
