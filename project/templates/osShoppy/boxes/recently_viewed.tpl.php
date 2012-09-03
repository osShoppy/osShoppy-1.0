<?php /* recently_viewed template  */
 if ((!strstr($_SERVER['PHP_SELF'],EX_REC_1))and(!strstr($_SERVER['PHP_SELF'],EX_REC_2))and(!strstr($_SERVER['PHP_SELF'],EX_REC_3))and(!strstr($_SERVER['PHP_SELF'],EX_REC_4))and(!strstr($_SERVER['PHP_SELF'],EX_REC_5))and(!strstr($_SERVER['PHP_SELF'],EX_REC_6))and(!strstr($_SERVER['PHP_SELF'],EX_REC_7))and(!strstr($_SERVER['PHP_SELF'],EX_REC_8))and(!strstr($_SERVER['PHP_SELF'],EX_REC_9))and(!strstr($_SERVER['PHP_SELF'],EX_REC_10))and(!strstr($_SERVER['PHP_SELF'],EX_REC_11))and(!strstr($_SERVER['PHP_SELF'],EX_REC_12))and(!strstr($_SERVER['PHP_SELF'],EX_REC_13))and(!strstr($_SERVER['PHP_SELF'],EX_REC_14))and(!strstr($_SERVER['PHP_SELF'],EX_REC_15))
and(!strstr($_SERVER['PHP_SELF'],EX_REC_16))and(!strstr($_SERVER['PHP_SELF'],EX_REC_17))and(!strstr($_SERVER['PHP_SELF'],EX_REC_18))and(!strstr($_SERVER['PHP_SELF'],EX_REC_19))and(!strstr($_SERVER['PHP_SELF'],EX_REC_20))and(!strstr($_SERVER['PHP_SELF'],EX_REC_21))and(!strstr($_SERVER['PHP_SELF'],EX_REC_22))and(!strstr($_SERVER['PHP_SELF'],EX_REC_23))and(!strstr($_SERVER['PHP_SELF'],EX_REC_24))and(!strstr($_SERVER['PHP_SELF'],EX_REC_25))and(!strstr($_SERVER['PHP_SELF'],EX_REC_26))and(!strstr($_SERVER['PHP_SELF'],EX_REC_27))and(!strstr($_SERVER['PHP_SELF'],EX_REC_28))and(!strstr($_SERVER['PHP_SELF'],EX_REC_29))and(!strstr($_SERVER['PHP_SELF'],EX_REC_30))
){ ?>
         <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeadingRecentlyViewed"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeadingRecentlyViewed"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeadingRecentlyViewed" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxRecentlyViewed">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsRecentlyViewed">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"<?php echo $boxContent_attributes; ?>><?php echo $boxContent; ?></td>
              </tr>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
             </table>
            </td>
           </tr>
          </table>
         </td>
        </tr>
<?php } ?>
