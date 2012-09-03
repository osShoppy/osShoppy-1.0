<?php /* customer_testimonials template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_CT_1))and(!strstr($_SERVER['PHP_SELF'],EX_CT_2))and(!strstr($_SERVER['PHP_SELF'],EX_CT_3))and(!strstr($_SERVER['PHP_SELF'],EX_CT_4))and(!strstr($_SERVER['PHP_SELF'],EX_CT_5))and(!strstr($_SERVER['PHP_SELF'],EX_CT_6))and(!strstr($_SERVER['PHP_SELF'],EX_CT_7))and(!strstr($_SERVER['PHP_SELF'],EX_CT_8))and(!strstr($_SERVER['PHP_SELF'],EX_CT_9))and(!strstr($_SERVER['PHP_SELF'],EX_CT_10))and(!strstr($_SERVER['PHP_SELF'],EX_CT_11))and(!strstr($_SERVER['PHP_SELF'],EX_CT_12))and(!strstr($_SERVER['PHP_SELF'],EX_CT_13))and(!strstr($_SERVER['PHP_SELF'],EX_CT_14))and(!strstr($_SERVER['PHP_SELF'],EX_CT_15))
and(!strstr($_SERVER['PHP_SELF'],EX_CT_16))and(!strstr($_SERVER['PHP_SELF'],EX_CT_17))and(!strstr($_SERVER['PHP_SELF'],EX_CT_18))and(!strstr($_SERVER['PHP_SELF'],EX_CT_19))and(!strstr($_SERVER['PHP_SELF'],EX_CT_20))and(!strstr($_SERVER['PHP_SELF'],EX_CT_21))and(!strstr($_SERVER['PHP_SELF'],EX_CT_22))and(!strstr($_SERVER['PHP_SELF'],EX_CT_23))and(!strstr($_SERVER['PHP_SELF'],EX_CT_24))and(!strstr($_SERVER['PHP_SELF'],EX_CT_25))and(!strstr($_SERVER['PHP_SELF'],EX_CT_26))and(!strstr($_SERVER['PHP_SELF'],EX_CT_27))and(!strstr($_SERVER['PHP_SELF'],EX_CT_28))and(!strstr($_SERVER['PHP_SELF'],EX_CT_29))and(!strstr($_SERVER['PHP_SELF'],EX_CT_30))
){ ?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeadingTestimonials"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeadingTestimonials"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeadingTestimonials" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
	              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxTestimonials">
		              <tr>
		                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsTestimonials">
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
              </td></tr>
            </table>
         </td></tr>
<?php } ?>