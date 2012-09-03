<?php /* specials infobox template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_SP_1))and(!strstr($_SERVER['PHP_SELF'],EX_SP_2))and(!strstr($_SERVER['PHP_SELF'],EX_SP_3))and(!strstr($_SERVER['PHP_SELF'],EX_SP_4))and(!strstr($_SERVER['PHP_SELF'],EX_SP_5))and(!strstr($_SERVER['PHP_SELF'],EX_SP_6))and(!strstr($_SERVER['PHP_SELF'],EX_SP_7))and(!strstr($_SERVER['PHP_SELF'],EX_SP_8))and(!strstr($_SERVER['PHP_SELF'],EX_SP_9))and(!strstr($_SERVER['PHP_SELF'],EX_SP_10))and(!strstr($_SERVER['PHP_SELF'],EX_SP_11))and(!strstr($_SERVER['PHP_SELF'],EX_SP_12))and(!strstr($_SERVER['PHP_SELF'],EX_SP_13))and(!strstr($_SERVER['PHP_SELF'],EX_SP_14))and(!strstr($_SERVER['PHP_SELF'],EX_SP_15))
and(!strstr($_SERVER['PHP_SELF'],EX_SP_16))and(!strstr($_SERVER['PHP_SELF'],EX_SP_17))and(!strstr($_SERVER['PHP_SELF'],EX_SP_18))and(!strstr($_SERVER['PHP_SELF'],EX_SP_19))and(!strstr($_SERVER['PHP_SELF'],EX_SP_20))and(!strstr($_SERVER['PHP_SELF'],EX_SP_21))and(!strstr($_SERVER['PHP_SELF'],EX_SP_22))and(!strstr($_SERVER['PHP_SELF'],EX_SP_23))and(!strstr($_SERVER['PHP_SELF'],EX_SP_24))and(!strstr($_SERVER['PHP_SELF'],EX_SP_25))and(!strstr($_SERVER['PHP_SELF'],EX_SP_26))and(!strstr($_SERVER['PHP_SELF'],EX_SP_27))and(!strstr($_SERVER['PHP_SELF'],EX_SP_28))and(!strstr($_SERVER['PHP_SELF'],EX_SP_29))and(!strstr($_SERVER['PHP_SELF'],EX_SP_30))
){ ?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeadingSpecials"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeadingSpecials"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeadingSpecials" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxSpecials">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsSpecials">
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