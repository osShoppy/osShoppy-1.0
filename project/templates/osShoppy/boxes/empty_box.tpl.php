<?php /* infobox template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_EX_1))and(!strstr($_SERVER['PHP_SELF'],EX_EX_2))and(!strstr($_SERVER['PHP_SELF'],EX_EX_3))and(!strstr($_SERVER['PHP_SELF'],EX_EX_4))and(!strstr($_SERVER['PHP_SELF'],EX_EX_5))and(!strstr($_SERVER['PHP_SELF'],EX_EX_6))and(!strstr($_SERVER['PHP_SELF'],EX_EX_7))and(!strstr($_SERVER['PHP_SELF'],EX_EX_8))and(!strstr($_SERVER['PHP_SELF'],EX_EX_9))and(!strstr($_SERVER['PHP_SELF'],EX_EX_10))and(!strstr($_SERVER['PHP_SELF'],EX_EX_11))and(!strstr($_SERVER['PHP_SELF'],EX_EX_12))and(!strstr($_SERVER['PHP_SELF'],EX_EX_13))and(!strstr($_SERVER['PHP_SELF'],EX_EX_14))and(!strstr($_SERVER['PHP_SELF'],EX_EX_15))
and(!strstr($_SERVER['PHP_SELF'],EX_EX_16))and(!strstr($_SERVER['PHP_SELF'],EX_EX_17))and(!strstr($_SERVER['PHP_SELF'],EX_EX_18))and(!strstr($_SERVER['PHP_SELF'],EX_EX_19))and(!strstr($_SERVER['PHP_SELF'],EX_EX_20))and(!strstr($_SERVER['PHP_SELF'],EX_EX_21))and(!strstr($_SERVER['PHP_SELF'],EX_EX_22))and(!strstr($_SERVER['PHP_SELF'],EX_EX_23))and(!strstr($_SERVER['PHP_SELF'],EX_EX_24))and(!strstr($_SERVER['PHP_SELF'],EX_EX_25))and(!strstr($_SERVER['PHP_SELF'],EX_EX_26))and(!strstr($_SERVER['PHP_SELF'],EX_EX_27))and(!strstr($_SERVER['PHP_SELF'],EX_EX_28))and(!strstr($_SERVER['PHP_SELF'],EX_EX_29))and(!strstr($_SERVER['PHP_SELF'],EX_EX_30))
){ ?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeading"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
	              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
		              <tr>
		                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
		              <tr>
		                <td><img src="templates/<?php echo DIR_WS_TEMPLATES_DEFAULT ?>/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
		              </tr>
		              <tr>
		                <td class="boxText"<?php echo $boxContent_attributes; ?>><?php echo $boxContent; ?></td>
		              </tr>
		              <tr>
		                <td><img src="templates/<?php echo DIR_WS_TEMPLATES_DEFAULT ?>/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
		              </tr>
	             </table>
              </td></tr>
            </table>
         </td></tr>
<?php } ?>