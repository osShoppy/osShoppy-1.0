<?php /* currencies infobox template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_CU_1))and(!strstr($_SERVER['PHP_SELF'],EX_CU_2))and(!strstr($_SERVER['PHP_SELF'],EX_CU_3))and(!strstr($_SERVER['PHP_SELF'],EX_CU_4))and(!strstr($_SERVER['PHP_SELF'],EX_CU_5))and(!strstr($_SERVER['PHP_SELF'],EX_CU_6))and(!strstr($_SERVER['PHP_SELF'],EX_CU_7))and(!strstr($_SERVER['PHP_SELF'],EX_CU_8))and(!strstr($_SERVER['PHP_SELF'],EX_CU_9))and(!strstr($_SERVER['PHP_SELF'],EX_CU_10))and(!strstr($_SERVER['PHP_SELF'],EX_CU_11))and(!strstr($_SERVER['PHP_SELF'],EX_CU_12))and(!strstr($_SERVER['PHP_SELF'],EX_CU_13))and(!strstr($_SERVER['PHP_SELF'],EX_CU_14))and(!strstr($_SERVER['PHP_SELF'],EX_CU_15))
and(!strstr($_SERVER['PHP_SELF'],EX_CU_16))and(!strstr($_SERVER['PHP_SELF'],EX_CU_17))and(!strstr($_SERVER['PHP_SELF'],EX_CU_18))and(!strstr($_SERVER['PHP_SELF'],EX_CU_19))and(!strstr($_SERVER['PHP_SELF'],EX_CU_20))and(!strstr($_SERVER['PHP_SELF'],EX_CU_21))and(!strstr($_SERVER['PHP_SELF'],EX_CU_22))and(!strstr($_SERVER['PHP_SELF'],EX_CU_23))and(!strstr($_SERVER['PHP_SELF'],EX_CU_24))and(!strstr($_SERVER['PHP_SELF'],EX_CU_25))and(!strstr($_SERVER['PHP_SELF'],EX_CU_26))and(!strstr($_SERVER['PHP_SELF'],EX_CU_27))and(!strstr($_SERVER['PHP_SELF'],EX_CU_28))and(!strstr($_SERVER['PHP_SELF'],EX_CU_29))and(!strstr($_SERVER['PHP_SELF'],EX_CU_30))
){ ?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeadingCurrencies"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeadingCurrencies"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeadingCurrencies" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxCurrencies">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsCurrencies">
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